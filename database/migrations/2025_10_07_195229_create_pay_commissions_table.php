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
        Schema::create('pay_commissions', function (Blueprint $table) {
            $table->id();
            $table->date('dd');
            $table->string('tt');
            $table->integer('user_id');
            $table->decimal('amount',18,2);
            $table->string('cur',20);
            $table->string('payment_type',100);
            $table->string('note',191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_commissions');
    }
};
