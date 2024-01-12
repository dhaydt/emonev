<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rkpd_keg_ind;
use App\Rkpd_subkeg;
use App\Realisasi;
use DB;
class Rkpd_keg extends Model
{
    protected $table = 'rkpd_keg';
    protected $fillable = [
        'id','idkeg','idprog','keg_awal','keg_perubahan','idopd','periode','nmkeg'
    ];

    public function master_kegiatan()
    {
            return $this->belongsTo('App\Renstra_Keg','idkeg','id');
    }

    public function master_prog_rkpd()
    {
        // return $this->belongsTo('App\Renstra_Keg','idkeg','id');
        return Rkpd_prog::where('idprog', $this->idprog)
        ->where('idopd', $this->idopd)->first();
    }

    public function rkpd_keg($data_renja)
    {
        if($data_renja=="awal"){
            // where('idprog', $this->idprog)->
            return Rkpd_keg_ind::where('idkeg', $this->idkeg)
            ->where('idopd', $this->idopd)
            ->where('periode', $this->periode)
            ->where('keg_ind_awal', '1')
            ->orderby('id')
            ->get(); 
        }elseif ($data_renja=="perubahan") {
            // where('idprog', $this->idprog)->
           return Rkpd_keg_ind::where('idkeg', $this->idkeg)
           ->where('idopd', $this->idopd)
           ->where('periode', $this->periode)
           ->where('keg_ind_perubahan', '1')
           ->orderby('id')
           ->get(); 
        }           
    }

    public function rkpd_subkeg($data_renja)
    {
        if($data_renja=="awal"){
            // return Rkpd_keg_ind::where('idkeg', $this->idkeg)
            // ->where('idopd', $this->idopd)
            // ->where('periode', $this->periode)
            // ->where('keg_ind_awal', '1')
            // ->orderby('id')
            // ->get(); 
            return Rkpd_subkeg::where('idopd',$this->idopd)->where('idkeg',$this->idkeg)->where('periode',$this->periode)->where('subkeg_awal','1')->orderby('idsubkeg','asc')->get();

        }elseif ($data_renja=="perubahan") {
            // return Rkpd_keg_ind::where('idkeg', $this->idkeg)
           // ->where('idopd', $this->idopd)
           // ->where('periode', $this->periode)
           // ->where('keg_ind_perubahan', '1')
           // ->orderby('id')
           // ->get(); 
           return Rkpd_subkeg::where('idopd',$this->idopd)->where('idkeg',$this->idkeg)->where('periode',$this->periode)->where('subkeg_perubahan','1')->orderby('idsubkeg','asc')->get();
        }  
        // if(Request()->get('data_renja')=="perubahan"){
        //     $rkpd_subkeg=Rkpd_subkeg::where('idopd',$opd)->where('idkeg',$idkeg)->where('periode',$periode)->where('subkeg_perubahan','1')->get();
        // }else{
        //     $rkpd_subkeg=Rkpd_subkeg::where('idopd',$opd)->where('idkeg',$idkeg)->where('periode',$periode)->where('subkeg_awal','1')->get();
        // }         
    }

    public function pagu($idopd,$periode)
    {
        return Rkpd_subkeg::groupBy('idkeg')
           ->selectRaw('sum(pagu_awal) as jpagu_awal,sum(pagu_perubahan) as jpagu_perubahan')
           ->where('idkeg',$this->idkeg)
           ->where('idopd',$idopd)
           ->where('periode',$periode)
           ->first();
    }

    // public function rp_real_keg($periode,$triwulan,$data_renja)
    public function rp_real_keg($periode,$data_renja)
    {   
        $sum='SUM(COALESCE(rp5,0)) as trp5, SUM(COALESCE(rp6,0)) as trp6, SUM(COALESCE(rpt1,0)) as t1, SUM(COALESCE(rpt2,0)) as t2, SUM(COALESCE(rpt3,0)) as t3, SUM(COALESCE(rpt4,0)) as t4';
            // $sum='SUM(COALESCE(rpt1,0)) as real';
            if($data_renja!="perubahan"){
                return realisasi::select(DB::raw($sum))->join('rkpd_subkeg','rkpd_subkeg.id', '=', 'realisasi.id_renja')
                ->where('rkpd_subkeg.idopd', $this->idopd)
                ->where('rkpd_subkeg.idkeg', $this->idkeg)
                ->where('rkpd_subkeg.periode', $periode)
                ->first();
            }else{
                    return realisasi::select(DB::raw($sum))->join('rkpd_subkeg','rkpd_subkeg.id', '=', 'realisasi.id_renja_per')
                    ->where('rkpd_subkeg.idopd', $this->idopd)
                    ->where('rkpd_subkeg.idkeg', $this->idkeg)
                    ->where('rkpd_subkeg.periode', $periode)
                    ->first();
            }
    }
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