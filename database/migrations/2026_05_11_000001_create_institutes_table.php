<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('about')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->foreignId('city_id')->constrained()->onDelete('restrict');
            $table->foreignId('category_id')->constrained('institute_categories')->onDelete('restrict');
            $table->string('area')->nullable();
            $table->string('pincode', 10)->nullable();
            $table->text('full_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('students_trained')->default(0);
            $table->unsignedSmallInteger('years_active')->default(0);
            $table->json('certifications')->nullable();
            $table->json('facilities')->nullable();
            $table->json('socials')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
