<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // /**
    //  * Run the migrations.
    //  */
    // public function up(): void
    // {
    //     Schema::table('campaign_user_logs', function (Blueprint $table) {
    //         $table->foreignId('campaign_id')->constrained()->onDelete('cascade')->change();
    //         $table->foreignId('campaign_user_id')->constrained()->onDelete('cascade')->change();
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::table('campaign_user_logs', function (Blueprint $table) {
    //         $table->dropForeign(['campaign_id']);
    //         $table->dropForeign(['campaign_user_id']);
    //     });
    // }

     /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('campaign_user_logs', function (Blueprint $table) {
            // Önce var olan foreign key'leri kaldırma
            $table->dropForeign(['campaign_id']);
            $table->dropForeign(['campaign_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaign_user_logs', function (Blueprint $table) {
            // Önce var olan foreign key'leri kaldırma
            $table->dropForeign(['campaign_id']);
            $table->dropForeign(['campaign_user_id']);
        });
    }
};

