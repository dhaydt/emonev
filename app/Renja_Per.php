<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Program;
class Renja_Per extends Model
{
    protected $table = 'renja_per';
    protected $fillable = [
        'id','id_instansi','periode','unitkey','induk_key','urusan_key','idmslh','kdkegunit','nm_kegunit_awal','nm_kegunit_akhir',
        'tanda_lokasi','id_prioritas','id_sasaran_prioritas','id_prioritas_nasional','id_jenis_belanja','idprgrm','noprior','id_renstra_detail','tglawal','tglakhir','belanja_p_now','belanja_bj_now','belanja_m_now','belanja_p_after','belanja_bj_after','belanja_m_after','lokasi','jumlahmin1','pagu','pagu_after','target_before','target_after','sumber_dana','jumlahpls1','alasan_bappeda','alasan_bidang_evaluasi','kdstatus_urgency','keterangan_sumber_dana','tags','rpjmd_st','rkpd_st','apbd_st','bappeda','nmkegunit','sasaran'
    ];

    public function master_kegiatan()
    {
            return $this->belongsTo('App\Renstra_Keg','kdkegunit','id');
    }

    public function indikator_kegiatan()
    {
            return $this->hasMany('App\Renja_Indikator_Per','id_renja','id');
    }

    public function indikator_kegiatan_target()
    {
            return Renja_Indikator_Per::where('renja_indikator_per.id_renja', $this->id)
            ->join('renja_indikator_det', 'renja_indikator_per.id', '=', 'renja_indikator_det.id_kegindikator_per')
            ->leftjoin('realisasi_target', 'renja_indikator_det.id','=','realisasi_target.id_target')
           ->select('renja_indikator_per.*', 'renja_indikator_det.id as id_target', 'renja_indikator_det.target_det_per', 'renja_indikator_det.sat_det','realisasi_target.k5','realisasi_target.k6','realisasi_target.kt1','realisasi_target.kt2','realisasi_target.kt3','realisasi_target.kt4','realisasi_target.ket_keg','realisasi_target.fpenghambat_keg','realisasi_target.fpendorong_keg')
           ->orderby('renja_indikator_det.id_kegindikator_per')
            ->get();   
    }

    public function realisasi_renja()
    {
            return $this->hasOne('App\Realisasi','id_renja_per','id');
    }

    public function singkatan_opd()
    {
             return Data_Opd::where('id',$this->id_instansi)->first()->singkatan;
    }

    // UTK RKPD PER-URUSAN
    public function program_rkpd($periode,$unitkey,$id_instansi,$urusan)
    {
        // return Renja::select('idprgrm')->where('periode', $periode)->where('urusan_key', $unitkey)->where('id_instansi', $id_instansi)->where('bappeda',1)->groupby('idprgrm')->get();
        $prog_non=Program::where('non_urusan','1')->get();
        $arr_nonurusan=array();
        foreach ($prog_non as $pnu) {
            $arr_nonurusan[]=$pnu->id;
        }

        if($urusan=='urusan'){
            return Renja_Per::select('idprgrm')->where('periode', $periode)->where('urusan_key', $unitkey)->where('id_instansi', $id_instansi)->where('bappeda',1)->whereNotIn('idprgrm', $arr_nonurusan)->groupby('idprgrm')->get();
        }else{
            return Renja_Per::select('idprgrm')->where('periode', $periode)->where('id_instansi', $id_instansi)->whereIn('idprgrm', [1, 2, 3,4,5,6,7,8])->where('bappeda',1)->groupby('idprgrm')->get();
        }
    }
    // UTK RKPD
    // public function indikator_program($unitkey)
    // {
    //     if($this->idprgrm!=1 and $this->idprgrm!=2 and $this->idprgrm!=3 and $this->idprgrm!=4 and $this->idprgrm!=5 or $this->idprgrm!=6 and $this->idprgrm!=7 and $this->idprgrm!=8){
    //         return Rpjmd_Prog_Indikator::where('idprgrm', $this->idprgrm)->where('unitkey', $unitkey)->get();
    //     }else{
    //         return Rpjmd_Prog_Indikator::where('idprgrm', $this->idprgrm)->get();
    //     }
    // }
    
    //jml kegiatan 
    public function jml_keg($periode,$unitkey)
    {
            return Renja_Per::where('idprgrm', $this->idprgrm)
            // ->where('id_instansi', $this->id_instansi)
            ->where('bappeda', 1)
            ->where('urusan_key', $unitkey)
            ->where('periode', $periode)->count();  
    }

    public function master_program()
    {
            return $this->belongsTo('App\Program','idprgrm','id');
    }

    public function kegiatan_rkpd($periode,$unitkey)
    {
            return Renja_Per::where('periode',$periode)->where('urusan_key',$unitkey)->where('idprgrm',$this->idprgrm)->where('bappeda',1)->get();
    }

    public function sasaran_pembangunan()
    {
            return $this->belongsTo('App\Sasaran_Pembangunan','id_sasaran_prioritas','id');
    }

}