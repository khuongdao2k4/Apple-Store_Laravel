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
        Schema::table('attributes', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name'); // 'mac', 'iphone', etc.
            $table->string('group_name')->nullable()->after('category'); // 'Tùy biến', etc.
        });

        Schema::table('product_options', function (Blueprint $table) {
            $table->string('sub_label')->nullable()->after('label');
            $table->text('description')->nullable()->change(); // Ensure it's text and nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropColumn(['category', 'group_name']);
        });

        Schema::table('product_options', function (Blueprint $table) {
            $table->dropColumn(['sub_label']);
        });
    }
};
