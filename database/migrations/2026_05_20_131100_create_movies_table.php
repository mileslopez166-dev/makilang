<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->string('image');
            $table->string('year');
            $table->string('duration');
            $table->string('genre');
            $table->string('rating');
            $table->text('description');
            $table->json('cast');
            $table->json('reviews');
            $table->json('gallery');
            $table->timestamps();
        });
    }
};