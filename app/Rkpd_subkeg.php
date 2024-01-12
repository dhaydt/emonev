<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rkpd_subkeg_ind;
use App\Data_opd;
class Rkpd_subkeg extends Model
{
    protected $table = 'rkpd_subkeg';
    protected $fillable = [
        'id','idsubkeg','idkeg','subkeg_awal','subkeg_perubahan','idopd','periode','pagu_awal','pagu_perubahan','lokasi','sumber_dana','pn','pd','nmsubkeg'
    ];

    public function master_subkegiatan()
    {
            return $this->belongsTo('App\Sub_Keg','idsubkeg','id');
    }
    public function master_keg_rkpd()
    {
            // return $this->belongsTo('App\Sub_Keg','idsubkeg','id');
      return Rkpd_keg::where('idkeg', $this->idkeg)
      ->where('idopd', $this->idopd)->first();
    }

    public function singkatan_opd()
    {
             return Data_Opd::where('id',$this->idopd)->first()->singkatan;
    }
    
    public function realisasi_renja($data_renja)
    {
      if($data_renja=="awal"){
       return $this->hasOne('App\Realisasi','id_renja','id')->first();
      }elseif ($data_renja=="perubahan") {
        return $this->hasOne('App\Realisasi','id_renja_per','id')->first();
      }
            
    }

    public function rkpd_subkeg($data_renja)
    {
        if($data_renja=="awal"){
            // where('idprog', $this->idprog)->
            return Rkpd_subkeg_ind::where('idsubkeg', $this->idsubkeg)
            ->where('idopd', $this->idopd)
            ->where('periode', $this->periode)
            ->where('subkeg_ind_awal', '1')
            ->orderby('id')
            ->get(); 
        }elseif ($data_renja=="perubahan") {
            // where('idprog', $this->idprog)->
           return Rkpd_subkeg_ind::where('idsubkeg', $this->idsubkeg)
           ->where('idopd', $this->idopd)
           ->where('periode', $this->periode)
           ->where('subkeg_ind_perubahan', '1')
           ->orderby('id')
           ->get(); 
        }           
    }

    public function det_indikator()
    {
            return $this->hasMany('App\Renja_Indikator_Det','id_kegindikator','id');
    }

    public function indikator_kegiatan_target($data_renja)
    {
           //  return Renja_Indikator::where('renja_indikator.id_renja', $this->id)
           //  ->join('renja_indikator_det', 'renja_indikator.id', '=', 'renja_indikator_det.id_kegindikator')
           //  ->leftjoin('realisasi_target', 'renja_indikator_det.id','=','realisasi_target.id_target')
           // ->select('renja_indikator.*', 'renja_indikator_det.id as id_target', 'renja_indikator_det.target_det', 'renja_indikator_det.sat_det','realisasi_target.k5','realisasi_target.k6','realisasi_target.kt1','realisasi_target.kt2','realisasi_target.kt3','realisasi_target.kt4','realisasi_target.ket_keg','realisasi_target.fpenghambat_keg','realisasi_target.fpendorong_keg')
           // ->orderby('renja_indikator_det.id_kegindikator')
           //  ->get(); 
        if($data_renja=="awal"){
            return Rkpd_subkeg_ind::
            where('rkpd_subkeg_ind.idsubkeg', $this->idsubkeg)
            ->where('rkpd_subkeg_ind.idopd', $this->idopd)
            ->where('rkpd_subkeg_ind.periode', $this->periode)
            ->where('rkpd_subkeg_ind.subkeg_ind_awal', 1)
            ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator')
            ->leftjoin('realisasi_target', 'renja_indikator_det.id','=','realisasi_target.id_target')
           ->select('rkpd_subkeg_ind.*', 'renja_indikator_det.id as id_target', 'renja_indikator_det.target_det', 'renja_indikator_det.sat_det','realisasi_target.k5','realisasi_target.k6','realisasi_target.kt1','realisasi_target.kt2','realisasi_target.kt3','realisasi_target.kt4','realisasi_target.ket_keg','realisasi_target.fpenghambat_keg','realisasi_target.fpendorong_keg')
           ->orderby('renja_indikator_det.id_kegindikator')
            ->get();   
        }elseif ($data_renja=="perubahan") {
             return Rkpd_subkeg_ind::
             where('rkpd_subkeg_ind.idsubkeg', $this->idsubkeg)
            ->where('rkpd_subkeg_ind.idopd', $this->idopd)
            ->where('rkpd_subkeg_ind.periode', $this->periode)
            ->where('rkpd_subkeg_ind.subkeg_ind_perubahan', 1)
             ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator_per')
             ->leftjoin('realisasi_target', 'renja_indikator_det.id','=','realisasi_target.id_target')
            ->select('rkpd_subkeg_ind.*', 'renja_indikator_det.id as id_target', 'renja_indikator_det.target_det_per', 'renja_indikator_det.sat_det','realisasi_target.k5','realisasi_target.k6','realisasi_target.kt1','realisasi_target.kt2','realisasi_target.kt3','realisasi_target.kt4','realisasi_target.ket_keg','realisasi_target.fpenghambat_keg','realisasi_target.fpendorong_keg')
            ->orderby('renja_indikator_det.id_kegindikator')
             ->get(); 
        }
    }
}