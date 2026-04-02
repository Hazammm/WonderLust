<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name', 200);
            $table->string('slug', 200)->unique();
            $table->string('location', 200);
            $table->text('description');
            $table->string('short_description', 500);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('hero_image', 500)->nullable();
            $table->json('gallery')->nullable();
            $table->string('best_time', 100)->nullable();
            $table->string('budget', 50)->nullable();
            $table->string('language', 100)->nullable();
            $table->string('currency', 50)->nullable();
            $table->text('travel_tips')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hidden_gem')->default(false);
            $table->decimal('rating', 2, 1)->default(0.0);
            $table->string('meta_title', 200)->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
