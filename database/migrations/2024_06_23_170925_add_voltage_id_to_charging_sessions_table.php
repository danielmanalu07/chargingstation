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
        Schema::table('charging_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('voltage_id');
            $table->foreign('voltage_id')->references('id')->on('voltages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('charging_sessions', function (Blueprint $table) {
            //
        });
    }
};
