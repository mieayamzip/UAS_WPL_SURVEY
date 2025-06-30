<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pekerjaan');
            $table->timestamps();
        });

        DB::table('pekerjaans')->insert([
            ['nama_pekerjaan' => 'Tidak Bekerja'],
            ['nama_pekerjaan' => 'Buruh Harian'],
            ['nama_pekerjaan' => 'Petani'],
            ['nama_pekerjaan' => 'Pedagang'],
            ['nama_pekerjaan' => 'PNS'],
            ['nama_pekerjaan' => 'Karyawan Swasta'],
            ['nama_pekerjaan' => 'Wiraswasta'],
            ['nama_pekerjaan' => 'Lainnya'],
        ]);
    }
    public function down(): void
    {
        Schema::dropIfExists('pekerjaans');
    }
};
