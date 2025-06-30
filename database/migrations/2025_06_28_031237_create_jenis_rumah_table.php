<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_rumah', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->timestamps();
        });

        DB::table('jenis_rumah')->insert([
            ['jenis' => 'Permanen'],
            ['jenis' => 'Semi Permanen'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_rumah');
    }
};
