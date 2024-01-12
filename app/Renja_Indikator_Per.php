<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renja_Indikator_Per extends Model
{
    protected $table = 'renja_indikator_per';
    protected $fillable = [
        'id','id_renja','kdjkk','kdkegunit','kdtahap','unitkey','tolokur','sat','target','ind_st'
    ];
    
    public function det_indikator()
    {
            return $this->hasMany('App\Renja_Indikator_Det','id_kegindikator_per','id');
    }
    public function renja()
    {
            return $this->belongsTo('App\Renja_Per','id_renja','id');
    }
}