<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Renstra_Indikator extends Model
{
    protected $table = 'm_renstra_indikator';
    protected $fillable = [
        'id','id_renstra','tolokur','kdjkk'
    ];
    public $timestamps = false;
    public function det_indikator()
    {
            return $this->hasMany('App\M_Renstra_Indikator_Det','id_kegindikator','id');
    }

    public function renja()
    {
            return $this->belongsTo('App\M_Renstra','id_renstra','id');
    }
}
