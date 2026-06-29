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
        Schema::create('hero_banners', function (Blueprint $table) {
            $table->id();
            $table->string('page_name'); // sofa, chairs, homepage, etc
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('image'); // only filename like sofa4.jpg
            $table->boolean('status')->default(1); // 1 active, 0 inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_banners');
    }
};
