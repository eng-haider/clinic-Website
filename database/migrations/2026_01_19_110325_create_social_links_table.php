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
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g., "Facebook", "Instagram"
            $table->string('url'); // The actual link
            $table->string('icon')->nullable(); // Icon class or image URL
            $table->string('platform')->nullable(); // e.g., "facebook", "instagram", "custom"
            $table->text('description')->nullable(); // Optional description
            $table->integer('order')->default(0); // For sorting
            $table->boolean('is_active')->default(true); // Show/hide link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};
