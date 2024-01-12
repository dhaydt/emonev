<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renja_Indikator_Det extends Model
{
    protected $table = 'renja_indikator_det';
    protected $fillable = [
        'id_kegindikator','tolokur_sumber','target_sumber','tolokur_det','sat_det','target_det','id_kegindikator_per','target_det_per','id_instansi','kdkegunit','perubahan','periode','sub_keg','sub_keg_per'
    ];

    public function realisasi_target()
    {
            return $this->hasOne('App\Realisasi_Target','id_target','id');
    }
}
