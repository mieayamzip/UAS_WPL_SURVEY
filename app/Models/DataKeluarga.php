<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKeluarga extends Model
{
    use HasFactory;

    protected $table = 'data_keluarga';

    protected $fillable = [
        'survey_id',
        'status_pernikahan_id',
        'jumlah_anak',
        'jumlah_tanggungan',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }

    public function statusPernikahan()
    {
        return $this->belongsTo(StatusPernikahan::class, 'status_pernikahan_id');
    }
}
