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
        Schema::table('hero_banners', function (Blueprint $table) {
            $table->string('ref_type')->after('id'); // e.g., 'page', 'category'
            $table->string('ref_slug')->after('ref_type'); // e.g., 'about', 'sofas'
            $table->dropColumn('page_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_banners', function (Blueprint $table) {
            $table->dropColumn(['ref_type', 'ref_slug']);
            $table->string('page_name')->after('id');
        });
    }
};
