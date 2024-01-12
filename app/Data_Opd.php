<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rkpd_subkeg;
use App\Realisasi;
use DB;
class Data_Opd extends Model
{
    protected $table = 'data_opd';
    protected $fillable = [
        'id','unit_key','kdunit', 'kdlevel','tipe','nm_instansi','nip','kepala','singkatan','akrounit','telp','alamat','non_urusan'
    ];

    public function urusan_opd()
    {
            return $this->hasOne('App\Urusan_opd','id_instansi','id');
    }

    public function akun_opd()
    {
            return $this->hasMany('App\Opd','id');
    }
    public function pagu($periode)
    {
        return Rkpd_subkeg::
           // join('rkpd_keg', 'rkpd_subkeg.idkeg', '=', 'rkpd_keg.idkeg')
           // ->join('rkpd_prog', 'rkpd_keg.idprog', '=', 'rkpd_prog.idprog')
           // ->join('rkpd_prog', 'users.id', '=', 'rkpd_prog.user_id')groupBy('idprog')
           selectRaw('sum(pagu_awal) as jpagu_awal,sum(pagu_perubahan) as jpagu_perubahan')
           ->where('rkpd_subkeg.idopd',$this->id)
           ->where('rkpd_subkeg.periode',$periode)
           ->first();
    }

    // UNTUK Per OPD
    //jml kegiatan 
    public function pjml_keg($periode,$id_instansi,$data_renja)
    {
        if($data_renja!="perubahan"){
             return rkpd_subkeg::where('idopd', $id_instansi)
             ->where('subkeg_awal', '1')
             // ->where('urusan_key', $this->unitkey)
             // ->whereExists(function ($query) {
                //$query->select(DB::raw(1))
                    //  ->from('renja_indikator')
                  //    ->whereRaw('renja_indikator.id_renja = renja_per.id')
                //      ->whereRaw('renja_indikator.id = renja_indikator_det.id_kegindikator')
            //})
             ->where('periode', $periode)->count();  
        }else{
           return rkpd_subkeg::where('idopd', $id_instansi)
            ->where('subkeg_perubahan', '1')
            ->where('periode', $periode)->count();  
        }
    }
    public function pjml_keg_k($periode,$id_instansi,$data_renja)
    {
        if($data_renja!="perubahan"){
         // return Renja::where('renja.periode', $periode)
         //     ->where('renja.id_instansi', $id_instansi)
         //     ->where('bappeda', 1)
         //     // ->where('urusan_key', $this->unitkey)
         //     ->join('renja_indikator','renja_indikator.id_renja', '=', 'renja.id')
         //     ->join('renja_indikator_det', 'renja_indikator.id', '=', 'renja_indikator_det.id_kegindikator')
         //     ->count(); 
            return Rkpd_subkeg::where('rkpd_subkeg.periode', $periode)
             ->where('rkpd_subkeg.idopd', $id_instansi)
             ->where('rkpd_subkeg.subkeg_awal', '1')
             // ->where('urusan_key', $this->unitkey)
             // ->join('renja_indikator','renja_indikator.id_renja', '=', 'renja.id')
             ->join('rkpd_subkeg_ind',function($q) use ($periode, $id_instansi)
                 {
                     $q->on('rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                         ->where('rkpd_subkeg_ind.periode', '=', "$periode")
                         // ->where('rkpd_subkeg_ind.idopd', '=', 'rkpd_subkeg.idopd')
                         ->where('rkpd_subkeg_ind.idopd', '=', "$id_instansi")
                         ->where('rkpd_subkeg_ind.subkeg_ind_awal', '=', '1');
                 })
             ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator')
             ->count();  
        }else{
            return Rkpd_subkeg::where('rkpd_subkeg.periode', $periode)
             ->where('rkpd_subkeg.idopd', $id_instansi)
             ->where('rkpd_subkeg.subkeg_perubahan', '1')
                // ->where('urusan_key', $this->unitkey)
                // ->join('renja_indikator_per','renja_indikator_per.id_renja', '=', 'renja_per.id')
                ->join('rkpd_subkeg_ind',function($q) use ($periode,$id_instansi)
                    {
                        $q->on('rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                            ->where('rkpd_subkeg_ind.periode', '=', "$periode")
                            // ->where('rkpd_subkeg_ind.idopd', '=', 'rkpd_subkeg.idopd')
                            ->where('rkpd_subkeg_ind.idopd', '=', "$id_instansi")
                            ->where('rkpd_subkeg_ind.subkeg_ind_perubahan', '=', '1');
                    })
                ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator_per')
                ->count();  

            
        }
    }

    //jml realisasi
    public function pjml_realisasi_keg($periode,$rp,$id_instansi,$data_renja)
    {
        if($data_renja!="perubahan"){
             // return Renja::where('periode', $periode)
             // ->where('id_instansi',$id_instansi)
             // ->where('bappeda', 1)
             // // ->where('urusan_key', $this->unitkey)
             // ->join('realisasi','realisasi.id_renja', '=', 'renja.id')
             // ->where('realisasi.'.$rp,'!=',null)
             // ->count(); 
             return Rkpd_subkeg::where('periode', $periode)
            ->where('idopd',$id_instansi)
            // ->where('urusan_key', $this->unitkey)
            ->where('subkeg_awal', 1)
            ->join('realisasi','realisasi.id_renja', '=', 'rkpd_subkeg.id')
            ->where('realisasi.'.$rp,'!=',null)
            ->count(); 
        }else{
            // return Renja_Per::where('periode', $periode)
            // ->where('id_instansi',$id_instansi)
            // ->where('bappeda', 1)
            // // ->where('urusan_key', $this->unitkey)
            // ->join('realisasi','realisasi.id_renja_per', '=', 'renja_per.id')
            // ->where('realisasi.'.$rp,'!=',null)
            // ->count();
            return Rkpd_subkeg::where('periode', $periode)
            ->where('idopd',$id_instansi)
            // ->where('urusan_key', $this->unitkey)
            ->where('subkeg_perubahan', 1)
            ->join('realisasi','realisasi.id_renja_per', '=', 'rkpd_subkeg.id')
            // ->where('realisasi.id_instansi_renja','=',$id_instansi)
            ->where('realisasi.'.$rp,'!=',null)
            ->count();
        }
    }
    public function pjml_realisasi_keg_k($periode,$k,$id_instansi,$data_renja)
    {
        if($data_renja!="perubahan"){
             // return Renja::where('renja.periode', $periode)
             //     ->where('renja.id_instansi',$id_instansi)
             //     ->where('bappeda', 1)
                 // ->where('urusan_key', $this->unitkey)
                 // ->join('renja_indikator','renja_indikator.id_renja', '=', 'renja.id')
                return Rkpd_subkeg::where('rkpd_subkeg.periode', $periode)
                ->where('rkpd_subkeg.idopd',$id_instansi)
                ->join('rkpd_subkeg_ind',function($q) use ($periode,$id_instansi)
                     {
                         $q->on('rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                             ->where('rkpd_subkeg_ind.periode', '=', "$periode")
                             // ->where('rkpd_subkeg_ind.idopd', '=', 'rkpd_subkeg.idopd')
                             ->where('rkpd_subkeg_ind.idopd', '=', "$id_instansi")
                             ->where('rkpd_subkeg_ind.subkeg_ind_awal', '=', '1');
                     })
                 ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator')
                 ->join('realisasi_target', 'renja_indikator_det.id', '=', 'realisasi_target.id_target')
                 ->where('realisasi_target.'.$k,'!=',null)
                 ->count();
        }else{
            // return Renja_Per::where('renja_per.periode', $periode)
            //     ->where('renja_per.id_instansi',$id_instansi)
            //     ->where('bappeda', 1)
                // ->where('urusan_key', $this->unitkey)
                // ->join('renja_indikator_per','renja_indikator_per.id_renja', '=', 'renja_per.id')
            return Rkpd_subkeg::where('rkpd_subkeg.periode', $periode)
                ->where('rkpd_subkeg.idopd',$id_instansi)
                ->join('rkpd_subkeg_ind',function($q) use ($periode,$id_instansi)
                     {
                         $q->on('rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                             ->where('rkpd_subkeg_ind.periode', '=', "$periode")
                             // ->where('rkpd_subkeg_ind.idopd', '=', 'rkpd_subkeg.idopd')
                             ->where('rkpd_subkeg_ind.idopd', '=', "$id_instansi")
                             ->where('rkpd_subkeg_ind.subkeg_ind_perubahan', '=', '1');
                     })
                ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator_per')
                ->join('realisasi_target', 'renja_indikator_det.id', '=', 'realisasi_target.id_target')
                ->where('realisasi_target.'.$k,'!=',null)
                ->count();
        }  
    }

    public function program_rpjmd($unitkey)
    {
         return Rpjmd_Prog::where('id_instansi',$this->id)->where('unitkey',$unitkey)->get();  
    }

    // realisasi OPD
    public function rp_real_opd($periode,$data_renja)
    {   
        $sum='SUM(COALESCE(rp5,0)) as trp5, SUM(COALESCE(rp6,0)) as trp6, SUM(COALESCE(rpt1,0)) as t1, SUM(COALESCE(rpt2,0)) as t2, SUM(COALESCE(rpt3,0)) as t3, SUM(COALESCE(rpt4,0)) as t4';
            // $sum='SUM(COALESCE(rpt1,0)) as real';
            if($data_renja!="perubahan"){
                return realisasi::select(DB::raw($sum))
                ->where('id_instansi_renja', $this->id)
                ->where('periode_renja', $periode)
                ->first();
            }else{
                return realisasi::select(DB::raw($sum))
                ->where('id_instansi_renja', $this->id)
                ->where('periode_renja', $periode)
                ->first();
            }
    }
}
