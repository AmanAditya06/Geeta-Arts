<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete()->after('name');
            $table->string('sku')->nullable()->after('name');
            $table->integer('stock')->default(0)->after('price');
            $table->boolean('is_featured')->default(false)->after('stock');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['category_id', 'sku', 'stock', 'is_featured']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });
    }
};
