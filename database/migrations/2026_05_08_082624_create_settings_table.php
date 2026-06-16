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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->default('Unit Layanan Terpadu');
            $table->string('app_name_short')->default('LLDIKTI XIV');
            $table->string('app_color')->default('#4F46E5');
            $table->json('app_logo')->nullable();
            $table->string('app_favicon')->nullable();
            $table->string('app_stempel')->nullable();
            $table->string('app_background_login_image')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('tiktok_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('x_twitter_link')->nullable();
            $table->string('github_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
