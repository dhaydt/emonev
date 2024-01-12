<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    protected $table = 'urusan';
    protected $fillable = [
        'unit_key', 'kdunit','nm_urusan'
    ];

    public function bidangurusan()
    {
            return $this->hasMany('App\Bidang_Urusan','id');
    }
}
