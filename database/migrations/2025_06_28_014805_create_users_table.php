<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // otomatis 0000001 dst
            $table->string('nik')->unique();
            $table->string('name');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->text('alamat');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // ✅ tambahkan ini
            $table->string('password');
            $table->rememberToken(); // ✅ tambahkan ini juga untuk auth
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
