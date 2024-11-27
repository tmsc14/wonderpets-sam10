<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentimentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'sentiment',
        'positive_score',
        'negative_score',
        'neutral_score',
        'compound_score',
        'user_id', // Add user_id to fillable attributes
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}