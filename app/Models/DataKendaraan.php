<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKendaraan extends Model
{
    use HasFactory;

    protected $table = 'data_kendaraan';

    protected $fillable = [
        'survey_id',
        'jenis_kendaraan_id',
        'jumlah_kendaraan',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function jenisKendaraan()
    {
        return $this->belongsTo(JenisKendaraan::class);
    }
}
