<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_rumah', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        DB::table('status_rumah')->insert([
            ['status' => 'Milik Sendiri'],
            ['status' => 'Menumpang Orang Tua'],
            ['status' => 'Menumpang Saudara'],
            ['status' => 'Kos atau Sewa'],
            ['status' => 'Lainnya'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('status_rumah');
    }
};
