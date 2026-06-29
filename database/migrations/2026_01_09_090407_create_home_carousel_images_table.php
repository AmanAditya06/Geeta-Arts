<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_carousel_images', function (Blueprint $table) {
            $table->id();

            // Kis page ke liye (home, about etc)
            $table->string('page_slug', 100);

            // Kis section ke liye (home_premium_slider etc)
            $table->string('section_key', 100);

            // Image name
            $table->string('image');

            // Order control
            $table->integer('sort_order')->default(0);

            // Active / inactive
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_carousel_images');
    }
};
