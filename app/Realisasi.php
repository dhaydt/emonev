<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $table = 'realisasi';
    protected $fillable = [
        'id','id_renja','rp5','rp6','rpt1','rpt2','rpt3','rpt4','id_renja_per','periode_renja','id_instansi_renja','kdkegunit_renja'
    ];

    // public function renja_det()
    // {
    //     return $this->belongsTo('App\Renja','id_renja','id_renja');
    // }

    public function realisasi_renja()
    {
        // return $this->hasMany('App\Renja','id_renja','id');
    }
}
