<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_keluarga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->onDelete('cascade');
            $table->foreignId('status_pernikahan_id')->constrained('status_pernikahan');
            $table->integer('jumlah_anak');
            $table->integer('jumlah_tanggungan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_keluarga');
    }
};
