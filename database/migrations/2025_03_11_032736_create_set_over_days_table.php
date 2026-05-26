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
        Schema::create('set_over_days', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('customername');
            $table->integer('customer_id');
            $table->date('payondate');
            $table->integer('overday');
            $table->decimal('price',18,2);
            $table->integer('setoverday');
            $table->decimal('setoverpice',18,2);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_over_days');
    }
};
