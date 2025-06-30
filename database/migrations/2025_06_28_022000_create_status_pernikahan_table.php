<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_pernikahan', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        // Insert default statuses
        DB::table('status_pernikahan')->insert([
            ['status' => 'Kawin Tercatat'],
            ['status' => 'Kawin Belum Tercatat'],
            ['status' => 'Cerai Mati'],
            ['status' => 'Cerai Hidup'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('status_pernikahan');
    }
};
