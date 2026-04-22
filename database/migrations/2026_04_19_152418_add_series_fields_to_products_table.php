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
            $table->string('series')->nullable()->after('name');
            $table->string('series_title')->nullable()->after('series');
            $table->string('series_image')->nullable()->after('series_title');
            $table->integer('sort_order')->default(0)->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['series', 'series_title', 'series_image', 'sort_order']);
        });
    }
};
