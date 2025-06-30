<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->onDelete('cascade');
            $table->integer('skor_rumah');
            $table->integer('skor_kendaraan');
            $table->integer('skor_pendapatan');
            $table->integer('skor_anak_tanggungan');
            $table->integer('total_skor');
            $table->string('hasil_skor');
            $table->string('kelayakan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skor');
    }
};
