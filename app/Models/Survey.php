<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'tanggal_survey',
    ];

    public function dataRumah()
    {
        return $this->hasOne(DataRumah::class);
    }

    public function dataKeluarga()
    {
        return $this->hasOne(DataKeluarga::class);
    }

    public function dataPekerjaanPendapatan()
    {
        return $this->hasOne(DataPekerjaanPendapatan::class);
    }

    public function dataKendaraan()
    {
        return $this->hasMany(DataKendaraan::class);
    }

    public function skor()
    {
        return $this->hasOne(Skor::class);
    }
}
