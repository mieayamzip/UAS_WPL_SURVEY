<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->timestamps();
        });

        DB::table('jenis_kendaraan')->insert([
            ['jenis' => 'Tidak Punya'],
            ['jenis' => 'Sepeda'],
            ['jenis' => 'Sepeda Motor'],
            ['jenis' => 'Mobil'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_kendaraan');
    }
};
