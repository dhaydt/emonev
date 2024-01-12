<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi_Target extends Model
{
    protected $table = 'realisasi_target';
    protected $fillable = [
        'id_target','k5','k6','kt1','kt2','kt3','kt4','ket_keg','fpenghambat_keg','fpendorong_keg'
    ];
}
