<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang_Urusan extends Model
{
    protected $table = 'bidang_urusan';
    protected $fillable = [
        'id','id_urusan','unit_key', 'kdunit','nm_burusan'
    ];

    public function urusan()
    {
            return $this->belongsTo('App\Urusan','id_urusan','id');
    }
}
