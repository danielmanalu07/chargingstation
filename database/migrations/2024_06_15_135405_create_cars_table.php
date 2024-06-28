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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->json('id_voltages');
            $table->json('id_capacities');
            $table->unsignedBigInteger('id_plug');
            $table->string('image')->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('id_category_cars');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_plug')->references('id')->on('plugs');
            $table->foreign('id_category_cars')->references('id')->on('category_cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
