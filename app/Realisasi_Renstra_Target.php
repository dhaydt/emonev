<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi_Renstra_Target extends Model
{
    protected $table = 'realisasi_renstra_target';
    public $timestamps = false;
    protected $fillable = [
        'id_target','kt1','kt2','kt3','kt4','kt5','kt6','ket_keg','fpenghambat_keg','fpendorong_keg'
    ];
}
