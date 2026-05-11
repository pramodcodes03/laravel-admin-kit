<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_requests', function (Blueprint $table) {
            $table->id();
            $table->string('institute_name');
            $table->string('owner_name');
            $table->string('mobile', 15);
            $table->string('email')->nullable();
            $table->string('city');
            $table->string('pincode', 10)->nullable();
            $table->string('category')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_requests');
    }
};
