<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi_Renstra extends Model
{
    protected $table = 'realisasi_renstra';
    public $timestamps = false;
    protected $fillable = [
        'id','id_renstra','rpt1','rpt2','rpt3','rpt4','rpt5','rpt6','periode_renstra','id_instansi_renstra','kdkegunit_renstra'
    ];

    // public function renja_det()
    // {
    //     return $this->belongsTo('App\Renja','id_renja','id_renja');
    // }

    // public function realisasi_renja()
    // {
        // return $this->hasMany('App\Renja','id_renja','id');
    // }
}
