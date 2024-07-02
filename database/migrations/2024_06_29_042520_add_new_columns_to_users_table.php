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
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_media')->after('email')->nullable();
            $table->string('social_platform')->after('social_media')->nullable();
            $table->string('tax_no')->after('social_platform')->nullable();
            $table->string('tax_office')->after('tax_no')->nullable();
            $table->string('address')->after('tax_office')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('social_media');
            $table->dropColumn('social_platform');
            $table->dropColumn('tax_no');
            $table->dropColumn('tax_office');
            $table->dropColumn('address');
        });
    }
};
