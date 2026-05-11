<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category_slug')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable();
            $table->unsignedSmallInteger('duration_weeks')->default(0);
            $table->unsignedSmallInteger('hours_per_week')->default(0);
            $table->json('mode')->nullable();
            $table->enum('level', ['Beginner', 'Intermediate', 'Advanced', 'All Levels'])->default('Beginner');
            $table->json('language')->nullable();
            $table->unsignedInteger('price_inr')->default(0);
            $table->unsignedInteger('original_price_inr')->nullable();
            $table->boolean('emi_available')->default(false);
            $table->boolean('certificate')->default(true);
            $table->boolean('placement_support')->default(false);
            $table->decimal('rating', 3, 2)->default(0);
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('enrolled_count')->default(0);
            $table->json('highlights')->nullable();
            $table->json('what_you_learn')->nullable();
            $table->json('prerequisites')->nullable();
            $table->json('curriculum')->nullable();
            $table->json('instructor')->nullable();
            $table->json('faqs')->nullable();
            $table->json('upcoming_batch')->nullable();
            $table->json('tags')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
