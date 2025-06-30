<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skor extends Model
{
    use HasFactory;

    protected $table = 'skor';

    protected $fillable = [
        'survey_id',
        'skor_rumah',
        'skor_kendaraan',
        'skor_pendapatan',
        'skor_anak_tanggungan',
        'total_skor',
        'hasil_skor',
        'kelayakan',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
