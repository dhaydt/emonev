<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Rkpd_prog;
class Rkpd_subkeg_ind extends Model
{
    protected $table = 'rkpd_subkeg_ind';
    protected $fillable = [
        'id','idsubkeg','indikator_awal','raw_sat_awal','sat_awal','target_awal','indikator_perubahan',
                    'raw_sat_perubahan',
                    'sat_perubahan',
                    'target_perubahan',
                    'subkeg_ind_awal',
                    'subkeg_ind_perubahan',
                    'idopd',
                    'periode'
    ];

    public function master_subkegiatan()
    {
            return $this->belongsTo('App\sub_kegiatan','idsubkeg','id');
    }

    public function det_indikator($data_renja)
    {
        if($data_renja!="perubahan"){
            return $this->hasMany('App\Renja_Indikator_Det','id_kegindikator','id')->get();
        }else{
            return $this->hasMany('App\Renja_Indikator_Det','id_kegindikator_per','id')->get();
        }
            // return $this->hasMany('App\Renja_Indikator_Det','id_kegindikator_per','id');
            
    }
}