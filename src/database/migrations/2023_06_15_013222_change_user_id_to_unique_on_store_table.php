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
        Schema::table('store_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unique_on_store', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });
    }
};
