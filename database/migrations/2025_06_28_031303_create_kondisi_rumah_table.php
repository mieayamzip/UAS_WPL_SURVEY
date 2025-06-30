<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kondisi_rumah', function (Blueprint $table) {
            $table->id();
            $table->string('kondisi');
            $table->timestamps();
        });

        DB::table('kondisi_rumah')->insert([
            ['kondisi' => 'Baik'],
            ['kondisi' => 'Rusak Sebagian'],
            ['kondisi' => 'Rusak Parah'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kondisi_rumah');
    }
};
