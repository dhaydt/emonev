<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode_Renja extends Model
{
    protected $table = 'periode_renja';
    protected $fillable = [
        'id', 'id_periode_rpjmd'
    ];
    public $timestamps = false;

    public function prpjmd()
    {
            return $this->belongsTo('App\Periode_Rpjmd','id_periode_rpjmd','id');
    }
}
