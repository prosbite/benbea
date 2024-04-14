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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_amount', 10, 2); // total amount of the transaction
            $table->decimal('amount_received', 10, 2); // amount received from the customer
            $table->decimal('discount', 10, 2); // discount applied to the transaction
            $table->decimal('change', 10, 2); // change returned to the customer
            $table->bigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
