<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_sliders', function (Blueprint $table) {
            $table->id(); // BIGINT AUTO_INCREMENT PRIMARY KEY

            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();

            $table->string('button_text', 100)->nullable();
            $table->string('button_link')->nullable();

            $table->string('image'); // slider image name

            $table->integer('sort_order')->default(0);
            $table->tinyInteger('status')->default(1); // 1=active, 0=inactive

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_sliders');
    }
};
