<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentimentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('sentiment_histories', function (Blueprint $table) {
            $table->id();
            $table->text('text'); // Store the analyzed text
            $table->string('sentiment'); // Store the sentiment result
            $table->float('positive_score', 8, 2); // Store positive score
            $table->float('negative_score', 8, 2); // Store negative score
            $table->float('neutral_score', 8, 2); // Store neutral score
            $table->float('compound_score', 8, 2); // Store compound score
            $table->timestamps(); // For created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('sentiment_histories');
    }
}