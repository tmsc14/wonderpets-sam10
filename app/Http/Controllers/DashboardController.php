<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SentimentHistory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalUsers = User::count();

        $totalSentimentAnalyses = SentimentHistory::count();
    
        if ($user->role === 'admin') {
            $histories = SentimentHistory::orderBy('created_at', 'desc')->take(10)->get();
        } else {
            $histories = SentimentHistory::where('user_id', $user->id)
                                         ->orderBy('created_at', 'desc')
                                         ->take(10)
                                         ->get();
        }
    
        return view('dashboard', compact('user', 'histories', 'totalUsers', 'totalSentimentAnalyses'));
    }
}