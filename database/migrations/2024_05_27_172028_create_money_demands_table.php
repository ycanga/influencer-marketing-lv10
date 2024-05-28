<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('money_demands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('amount');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('transaction_note')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE money_demands AUTO_INCREMENT = 10000;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money_demands');
    }
};
