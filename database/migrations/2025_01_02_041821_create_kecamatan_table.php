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
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('full_code');
            $table->string('name');
            $table->unsignedBigInteger('kabupaten_id');
            $table->foreign('kabupaten_id')->references('id')->on('kabupaten')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districs');
    }
};
