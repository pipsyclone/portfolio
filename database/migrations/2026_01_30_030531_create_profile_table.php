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
        Schema::create('profile', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('foto')->nullable();
            $table->string('name', 100);
            $table->string('as');
            $table->text('bio');
            $table->integer('experience');
            $table->text('cv')->nullable();
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->string('address', 255);
            $table->string('github_url', 255)->nullable();
            $table->string('linkedin_url', 255)->nullable();
            $table->string('twitter_url', 255)->nullable();
            $table->string('instagram_url', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
