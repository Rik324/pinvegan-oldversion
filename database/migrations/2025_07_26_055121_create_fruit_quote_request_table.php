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
        // This schema defines the pivot table for the many-to-many relationship
        // between fruits and quote requests.
        Schema::create('fruit_quote_request', function (Blueprint $table) {
            $table->id();

            // Foreign key for the Fruit model.
            $table->foreignId('fruit_id')->constrained()->onDelete('cascade');

            // Foreign key for the QuoteRequest model.
            // This has been corrected from 'quote_id' to 'quote_request_id'
            // to match Laravel's naming conventions for relationships.
            $table->foreignId('quote_request_id')->constrained()->onDelete('cascade');

            // Additional data stored in the pivot table.
            $table->integer('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruit_quote_request');
    }
};