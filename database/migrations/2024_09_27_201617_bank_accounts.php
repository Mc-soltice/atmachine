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

         Schema::create('bank_accounts', function (Blueprint $table) {
             $table->id();
             $table->string('bank_account_id', 8)->unique();
             $table->decimal('balance', 10, 2)->default(0);
             $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
             $table->timestamps();
            });
            // Schema::create('users', function (Blueprint $table) {
            // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('bank_accounts');

    }
};
