<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // No-op: category_id is already added in the main fruits table migration
        // This migration is kept for historical reasons but doesn't do anything now
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: category_id is handled in the main fruits table migration
        // This migration is kept for historical reasons but doesn't do anything now
    }
};
