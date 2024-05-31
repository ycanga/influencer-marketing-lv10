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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['multiple', 'click', 'sales'])->default('sales');
            $table->datetime('time')->nullable(); // If type is null, process will be eternal
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->string('image')->nullable();
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->string('sbm')->nullable();
            $table->string('tbm')->nullable();
            $table->string('ibm')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE campaigns AUTO_INCREMENT = 10000');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');

        DB::statement('ALTER TABLE campaigns AUTO_INCREMENT = 1');
    }
};
