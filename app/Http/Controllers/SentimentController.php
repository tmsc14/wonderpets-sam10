<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentiment\Analyzer;
use App\Models\SentimentHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SentimentController extends Controller
{
    public function analyze(Request $request)
    {
        // Validate the input text
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);
    
        $text = $request->text; // Get the input text
    
        // Create a new instance of the Analyzer
        $analyzer = new Analyzer();
        
        // Analyze the sentiment of the input text
        $sentimentScores = $analyzer->getSentiment($text);
    
        // Convert scores to percentages
        $positivePercentage = $sentimentScores['pos'] * 100;
        $negativePercentage = $sentimentScores['neg'] * 100;
        $neutralPercentage = $sentimentScores['neu'] * 100;
        $compoundPercentage = ($sentimentScores['compound'] + 1) * 50; // Scale compound score to 0-100
    
        // Determine sentiment based on compound score
        if ($sentimentScores['compound'] >= 0.05) {
            $sentiment = 'Positive';
        } elseif ($sentimentScores['compound'] <= -0.05) {
            $sentiment = 'Negative';
        } else {
            $sentiment = 'Neutral';
        }
    
        // Save analysis result to history with user_id
        SentimentHistory::create([
            'text' => $text,
            'sentiment' => $sentiment,
            'positive_score' => round($positivePercentage, 2),
            'negative_score' => round($negativePercentage, 2),
            'neutral_score' => round($neutralPercentage, 2),
            'compound_score' => round($compoundPercentage, 2),
            'user_id' => Auth::id(), // Associate the analysis with the authenticated user
        ]);
    
        // Pass result back to the view
        return redirect()->back()->with('result', [
            'sentiment' => $sentiment,
            'positiveScore' => round($positivePercentage, 2),
            'negativeScore' => round($negativePercentage, 2),
            'neutralScore' => round($neutralPercentage, 2),
            'compoundScore' => round($compoundPercentage, 2),
            'scores' => [
                'Positive' => round($positivePercentage, 2),
                'Negative' => round($negativePercentage, 2),
                'Neutral' => round($neutralPercentage, 2),
            ],
        ]);
    }

    public function history()
    {
        // Fetch histories based on user role
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $histories = SentimentHistory::orderBy('created_at', 'desc')->take(10)->get();
        } else {
            $histories = SentimentHistory::where('user_id', $user->id)
                                         ->orderBy('created_at', 'desc')
                                         ->take(10)
                                         ->get();
        }

        return view('sentiment-history', compact('histories'));
    }
    
    public function exportToPDF()
    {
        $user = Auth::user(); // Get the authenticated user
    
        if ($user->role === 'admin') {
            // Admin: Fetch all sentiment histories
            $histories = SentimentHistory::orderBy('created_at', 'desc')->get();
        } else {
            // Regular user: Fetch only their sentiment histories
            $histories = SentimentHistory::where('user_id', $user->id)
                                         ->orderBy('created_at', 'desc')
                                         ->get();
        }
    
        // Load the view and pass data to it
        $pdf = PDF::loadView('exports.sentiment_history', compact('histories'));
    
        // Download the generated PDF file
        return $pdf->download('sentiment_history.pdf');
    }
    
    public function exportToCSV()
    {
        $user = Auth::user(); // Get the authenticated user
    
        if ($user->role === 'admin') {
            // Admin: Fetch all sentiment histories
            $histories = SentimentHistory::orderBy('created_at', 'desc')->get();
        } else {
            // Regular user: Fetch only their sentiment histories
            $histories = SentimentHistory::where('user_id', $user->id)
                                         ->orderBy('created_at', 'desc')
                                         ->get();
        }
    
        $csvFileName = 'sentiment_history.csv';
        $handle = fopen('php://output', 'w');
    
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $csvFileName . '"');
    
        fputcsv($handle, ['Text', 'Sentiment', 'Positive Score', 'Negative Score', 'Neutral Score', 'Compound Score', 'Date']);
    
        foreach ($histories as $history) {
            fputcsv($handle, [
                $history->text,
                $history->sentiment,
                $history->positive_score,
                $history->negative_score,
                $history->neutral_score,
                $history->compound_score,
                $history->created_at->format('Y-m-d H:i')
            ]);
        }
    
        fclose($handle);
        exit; 
    }
}