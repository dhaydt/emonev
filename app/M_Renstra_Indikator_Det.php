<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Renstra_Indikator_Det extends Model
{
    protected $table = 'm_renstra_indikator_det';
    protected $fillable = [
        'id_kegindikator','sat_det','target_det','target2_det','target3_det','target4_det','target5_det','target6_det'
    ];
    public $timestamps = false;
    public function realisasi_target()
    {
            return $this->hasOne('App\Realisasi_Target','id_target','id');
    }
}
