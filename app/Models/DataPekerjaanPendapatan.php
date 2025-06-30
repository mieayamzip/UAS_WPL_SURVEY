<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPekerjaanPendapatan extends Model
{
    use HasFactory;
    protected $table = 'data_pekerjaan_pendapatan';

    protected $fillable = [
        'survey_id',
        'pekerjaan_id',
        'pendapatan_id',
    ];



    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }


    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class);
    }
}
