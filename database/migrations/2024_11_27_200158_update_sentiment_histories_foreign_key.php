<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSentimentHistoriesForeignKey extends Migration
{
    public function up()
    {
        Schema::table('sentiment_histories', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop existing foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Add new foreign key with cascade
        });
    }

    public function down()
    {
        Schema::table('sentiment_histories', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users'); // Restore without cascade
        });
    }
}