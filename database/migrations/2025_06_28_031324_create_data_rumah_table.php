<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_rumah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->onDelete('cascade');
            $table->foreignId('status_rumah_id')->constrained('status_rumah');
            $table->foreignId('jenis_rumah_id')->constrained('jenis_rumah');
            $table->foreignId('kondisi_rumah_id')->constrained('kondisi_rumah');
            $table->integer('luas_rumah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_rumah');
    }
};
