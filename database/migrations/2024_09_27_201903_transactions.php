<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_account_id');
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['deposit', 'withdraw','transfer']);
            $table->timestamps();
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('transactions');
    }
};
