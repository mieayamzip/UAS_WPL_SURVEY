<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRumah extends Model
{
    use HasFactory;

    protected $table = 'data_rumah'; // <- tambahkan ini

    protected $fillable = [
        'survey_id',
        'status_rumah_id',
        'jenis_rumah_id',
        'kondisi_rumah_id',
        'luas_rumah',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function statusRumah()
    {
        return $this->belongsTo(StatusRumah::class);
    }

    public function jenisRumah()
    {
        return $this->belongsTo(JenisRumah::class);
    }

    public function kondisiRumah()
    {
        return $this->belongsTo(KondisiRumah::class);
    }
}
