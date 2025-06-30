<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_pekerjaan_pendapatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->onDelete('cascade');
            $table->foreignId('pekerjaan_id')->constrained('pekerjaans');
            $table->foreignId('pendapatan_id')->constrained('pendapatans');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pekerjaan_pendapatan');
    }
};
