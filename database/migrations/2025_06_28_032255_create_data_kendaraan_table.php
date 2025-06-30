<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->onDelete('cascade');
            $table->foreignId('jenis_kendaraan_id')->constrained('jenis_kendaraan');
            $table->integer('jumlah_kendaraan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_kendaraan');
    }
};
