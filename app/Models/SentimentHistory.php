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
    ];
}