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
        Schema::table('payment_models', function (Blueprint $table) {
            $table->string('key')->nullable()->after('status');
            $table->string('value')->nullable()->after('key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_models', function (Blueprint $table) {
            $table->dropColumn('key');
            $table->dropColumn('value');
        });
    }
};
