<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendapatans', function (Blueprint $table) {
            $table->id();
            $table->string('range_pendapatan');
            $table->timestamps();
        });

        DB::table('pendapatans')->insert([
            ['range_pendapatan' => 'Rp. 0 - Rp. 500.000,-'],
            ['range_pendapatan' => 'Rp. 500.001,- - Rp. 1.000.000,-'],
            ['range_pendapatan' => 'Rp. 1.000.001,- - Rp. 2.000.000,-'],
            ['range_pendapatan' => 'Rp. 2.000.001,- - Rp. 3.000.000,-'],
            ['range_pendapatan' => 'Rp. 3.000.001,- - Rp. 5.000.000,-'],
            ['range_pendapatan' => 'Rp. 5.000.001,- - Rp. 7.500.000,-'],
            ['range_pendapatan' => 'Rp. 7.500.001,- - Rp. 10.000.000,-'],
            ['range_pendapatan' => 'Rp. 10.000.001,- - Rp. 15.000.000,-'],
            ['range_pendapatan' => 'Rp. 15.000.001,- - Rp. 20.000.000,-'],
            ['range_pendapatan' => '> Rp. 20.000.000,-'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('pendapatans');
    }
};
