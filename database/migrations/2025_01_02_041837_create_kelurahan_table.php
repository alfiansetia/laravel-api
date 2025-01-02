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
        Schema::create('kelurahan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('full_code');
            $table->string('pos_code');
            $table->unsignedBigInteger('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
