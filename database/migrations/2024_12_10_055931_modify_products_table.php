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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            }
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku')->unique()->nullable();
            }
            if (!Schema::hasColumn('products', 'weight')) {
                $table->bigInteger('weight')->nullable();
            }
            if (!Schema::hasColumn('products', 'width')) {
                $table->bigInteger('width')->nullable();
            }
            if (!Schema::hasColumn('products', 'height')) {
                $table->bigInteger('height')->nullable();
            }
            if (!Schema::hasColumn('products', 'length')) {
                $table->bigInteger('length')->nullable();
            }
            if (!Schema::hasColumn('products', 'status')) {
                $table->boolean('status')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'sku', 'weight', 'width', 'height', 'length', 'status']);
        });
    }
};
