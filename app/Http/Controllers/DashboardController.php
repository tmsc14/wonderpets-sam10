<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SentimentHistory;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Retrieve the latest 10 sentiment analysis results for the user
        $histories = SentimentHistory::orderBy('created_at', 'desc')->take(10)->get();

        // Pass the user and sentiment histories to the view
        return view('dashboard', compact('user', 'histories'));
    }
}