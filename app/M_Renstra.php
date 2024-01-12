<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Program;
class M_Renstra extends Model
{
    protected $table = 'm_renstra';
    protected $fillable = [
        'id','id_instansi','periode','urusan_key','kdkegunit','id_prioritas','idprgrm','nmkegunit','sasaran','data_awl','trp_1','trp_2','trp_3','trp_4','trp_5','trp_6'
    ];
    public $timestamps = false;
    public function master_kegiatan()
    {
            return $this->belongsTo('App\Renstra_Keg','kdkegunit','id');
    }

    public function indikator_kegiatan()
    {
            return $this->hasMany('App\M_Renstra_Indikator','id_renstra','id');
    }

    public function indikator_kegiatan_target()
    {
            return M_Renstra_Indikator::where('m_renstra_indikator.id_renstra', $this->id)
            ->join('m_renstra_indikator_det', 'm_renstra_indikator.id', '=', 'm_renstra_indikator_det.id_kegindikator')
            ->leftjoin('realisasi_renstra_target', 'm_renstra_indikator_det.id','=','realisasi_renstra_target.id_target')
           ->select('m_renstra_indikator.*', 'm_renstra_indikator_det.id as id_target', 'm_renstra_indikator_det.target_det','m_renstra_indikator_det.target2_det','m_renstra_indikator_det.target3_det','m_renstra_indikator_det.target4_det','m_renstra_indikator_det.target5_det','m_renstra_indikator_det.target6_det', 'm_renstra_indikator_det.sat_det','realisasi_renstra_target.kt1','realisasi_renstra_target.kt2','realisasi_renstra_target.kt3','realisasi_renstra_target.kt4','realisasi_renstra_target.kt5','realisasi_renstra_target.kt6','realisasi_renstra_target.ket_keg','realisasi_renstra_target.fpenghambat_keg','realisasi_renstra_target.fpendorong_keg')
           ->orderby('m_renstra_indikator_det.id_kegindikator')
            ->get();   
    }

    public function realisasi_renstra()
    {
            return $this->hasOne('App\Realisasi_Renstra','id_renstra','id');
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