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
        Schema::table('fruits', function (Blueprint $table) {
            // Add category_id column with foreign key constraint
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fruits', function (Blueprint $table) {
            // Drop the foreign key constraint and column
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
