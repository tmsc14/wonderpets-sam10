<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentiment\Analyzer;
use App\Models\SentimentHistory;

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
    
        // Save analysis result to history
        SentimentHistory::create([
            'text' => $text,
            'sentiment' => $sentiment,
            'positive_score' => round($positivePercentage, 2),
            'negative_score' => round($negativePercentage, 2),
            'neutral_score' => round($neutralPercentage, 2),
            'compound_score' => round($compoundPercentage, 2),
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
        // Retrieve the latest 10 sentiment analysis results
        $histories = SentimentHistory::orderBy('created_at', 'desc')->take(10)->get();

        return view('sentiment-history', compact('histories'));
    }
}