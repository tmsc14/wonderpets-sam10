<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToSentimentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('sentiment_histories', function (Blueprint $table) {
            // Add user_id as a foreign key referencing users table
            $table->foreignId('user_id')->constrained()->after('id'); 
        });
    }

    public function down()
    {
        Schema::table('sentiment_histories', function (Blueprint $table) {
            // Drop foreign key constraint and column if rolling back
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}