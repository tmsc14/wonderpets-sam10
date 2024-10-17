<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SentimentController extends Controller
{
    // Predefined lists of positive and negative words
    protected $positiveWords = ['good', 'happy', 'love', 'excellent', 'amazing', 'awesome', 'fantastic', 'great'];
    protected $negativeWords = ['bad', 'sad', 'hate', 'terrible', 'awful', 'horrible', 'worst', 'poor'];

    public function analyze(Request $request)
    {
        // Validate the input text
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);

        $text = strtolower($request->text); // Convert text to lowercase for matching
        $words = explode(' ', $text); // Split text into individual words

        // Count positive and negative words
        $positiveCount = 0;
        $negativeCount = 0;

        foreach ($words as $word) {
            if (in_array($word, $this->positiveWords)) {
                $positiveCount++;
            } elseif (in_array($word, $this->negativeWords)) {
                $negativeCount++;
            }
        }

        // Determine sentiment based on counts
        if ($positiveCount > $negativeCount) {
            $sentiment = 'Positive';
        } elseif ($negativeCount > $positiveCount) {
            $sentiment = 'Negative';
        } else {
            $sentiment = 'Neutral';
        }

        // Pass result back to the view
        return redirect()->back()->with('result', [
            'sentiment' => $sentiment,
            'positiveCount' => $positiveCount,
            'negativeCount' => $negativeCount,
        ]);
    }
}
