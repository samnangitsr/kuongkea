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
        Schema::create('customer_exchange_captures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_exchange_id')->nullable()->constrained()->nullOnDelete();
            $table->string('photo'); // storage path "customers/..."
            $table->timestamps();    // created_at = capture time
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_exchange_captures');
    }
};
