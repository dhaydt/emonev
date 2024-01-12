<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Rkpd_prog;
class Rkpd_keg_ind extends Model
{
    protected $table = 'rkpd_keg_ind';
    protected $fillable = [
        'id','idkeg','indikator_awal','raw_sat_awal','sat_awal','target_awal','indikator_perubahan',
                    'raw_sat_perubahan',
                    'sat_perubahan',
                    'target_perubahan',
                    'keg_ind_awal',
                    'keg_ind_perubahan',
                    'idopd',
                    'periode'
    ];

    public function master_kegiatan()
    {
            return $this->belongsTo('App\Renstra_Keg','idkeg','id');
    }

    public function realisasi_tkegiatan()
    {
            return $this->hasOne('App\Realisasi_Tkegiatan','id_ind_kegiatan','id');
    }
    // public function master_kegiatan()
    // {
    //         return $this->belongsTo('App\Renstra_Keg','kdkegunit','id');
    // }

    // public function indikator_kegiatan()
    // {
    //         return $this->hasMany('App\Renja_Indikator','id_renja','id');
    // }

    // public function indikator_kegiatan_target()
    // {
    //         return Renja_Indikator::where('renja_indikator.id_renja', $this->id)
    //         ->join('renja_indikator_det', 'renja_indikator.id', '=', 'renja_indikator_det.id_kegindikator')
    //         ->leftjoin('realisasi_target', 'renja_indikator_det.id','=','realisasi_target.id_target')
    //        ->select('renja_indikator.*', 'renja_indikator_det.id as id_target', 'renja_indikator_det.target_det', 'renja_indikator_det.sat_det','realisasi_target.k5','realisasi_target.k6','realisasi_target.kt1','realisasi_target.kt2','realisasi_target.kt3','realisasi_target.kt4','realisasi_target.ket_keg','realisasi_target.fpenghambat_keg','realisasi_target.fpendorong_keg')
    //        ->orderby('renja_indikator_det.id_kegindikator')
    //         ->get();   
    // }

    // public function realisasi_renja()
    // {
    //         return $this->hasOne('App\Realisasi','id_renja','id');
    // }

    // public function singkatan_opd()
    // {
    //          return Data_Opd::where('id',$this->id_instansi)->first()->singkatan;
    // }

    // // UTK RKPD PER-URUSAN
    // public function program_rkpd($periode,$unitkey,$id_instansi,$urusan)
    // {
    //     // return Renja::select('idprgrm')->where('periode', $periode)->where('urusan_key', $unitkey)->where('id_instansi', $id_instansi)->where('bappeda',1)->groupby('idprgrm')->get();
    //     $prog_non=Program::where('non_urusan','1')->get();
    //     $arr_nonurusan=array();
    //     foreach ($prog_non as $pnu) {
    //         $arr_nonurusan[]=$pnu->id;
    //     }
    //     if($urusan=='urusan'){
    //         return Renja::select('idprgrm')->where('periode', $periode)->where('urusan_key', $unitkey)->where('id_instansi', $id_instansi)->where('bappeda',1)->whereNotIn('idprgrm', $arr_nonurusan)->groupby('idprgrm')->get();
    //     }else{
    //         return Renja::select('idprgrm')->where('periode', $periode)->where('id_instansi', $id_instansi)->whereIn('idprgrm', $arr_nonurusan)->where('bappeda',1)->groupby('idprgrm')->get();
    //     }
    // }
    // // UTK RKPD
    // // public function indikator_program($unitkey)
    // // {
    // //     if($this->idprgrm!=1 and $this->idprgrm!=2 and $this->idprgrm!=3 and $this->idprgrm!=4 and $this->idprgrm!=5 or $this->idprgrm!=6 and $this->idprgrm!=7 and $this->idprgrm!=8){
    // //         return Rpjmd_Prog_Indikator::where('idprgrm', $this->idprgrm)->where('unitkey', $unitkey)->get();
    // //     }else{
    // //         return Rpjmd_Prog_Indikator::where('idprgrm', $this->idprgrm)->get();
    // //     }
    // // }
    
    // //jml kegiatan 
    // public function jml_keg($periode,$unitkey)
    // {
    //         return Renja::where('idprgrm', $this->idprgrm)
    //         // ->where('id_instansi', $this->id_instansi)
    //         ->where('bappeda', 1)
    //         ->where('urusan_key', $unitkey)
    //         ->where('periode', $periode)->count();  
    // }

    // public function master_program()
    // {
    //         return $this->belongsTo('App\Program','idprgrm','id');
    // }

    // public function kegiatan_rkpd($periode,$unitkey)
    // {
    //         return Renja::where('periode',$periode)->where('urusan_key',$unitkey)->where('idprgrm',$this->idprgrm)->where('bappeda',1)->get();
    // }

    // public function sasaran_pembangunan()
    // {
    //         return $this->belongsTo('App\Sasaran_Pembangunan','id_sasaran_prioritas','id');
    // }

}