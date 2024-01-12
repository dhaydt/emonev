<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Dafunit extends Model
{
    protected $table = 'dafunit';
    protected $fillable = [
        'id','parent_id','id_status','order_no','kdlevel','unitkey', 'kdunit','nm_unit','type'
    ];

    public function scopeLevel($query, $level)
    {
            return $query->where('kdlevel', $level);
    }

    public function children(){
      return $this->hasMany( 'App\Dafunit', 'parent_id', 'id' );
    }

    public function parent(){
      return $this->hasOne( 'App\Dafunit', 'id', 'parent_id' );
    }
    
    
    public function opd_rkpd($periode,$unitkey,$data_renja)
    {
        if($data_renja=="awal"){
            if($unitkey!='0_'){
                return Renja::select('id_instansi')->where('periode', $periode)->where('urusan_key', $unitkey)->where('bappeda',1)->groupby('id_instansi')->orderBy('id_instansi')->get();            
            }else{
                return Renja::select('id_instansi')->where('periode', $periode)->where('bappeda',1)->groupby('id_instansi')->orderBy('id_instansi')->get();
            }
        }elseif($data_renja=="perubahan"){
            if($unitkey!='0_'){
                return Renja_Per::select('id_instansi')->where('periode', $periode)->where('urusan_key', $unitkey)->where('bappeda',1)->groupby('id_instansi')->orderBy('id_instansi')->get();            
            }else{
                return Renja_Per::select('id_instansi')->where('periode', $periode)->where('bappeda',1)->groupby('id_instansi')->orderBy('id_instansi')->get();
            }
        }

    }

    public function opd_rpjmd($unitkey)
    {
        return Rpjmd_Prog::select('id_instansi')->where('unitkey', $unitkey)->groupby('id_instansi')->get();
    }

    public function pagu($idopd,$periode)
    {
        return Rkpd_subkeg::
           selectRaw('sum(pagu_awal) as jpagu_awal,sum(pagu_perubahan) as jpagu_perubahan')
           ->where('rkpd_subkeg.idopd',$idopd)
           // whereRaw("id=SUBSTRING('".$this->id."', 1, 4)")
           ->whereRaw("SUBSTRING(rkpd_subkeg.idsubkeg,1,4)='".$this->unitkey."'")
           ->where('rkpd_subkeg.periode',$periode)
           ->first();
    }

    // realisasi B_URUSAN
    public function rp_real_b_urusan($periode,$data_renja,$idopd)
    {   
        $sum='SUM(COALESCE(rp5,0)) as trp5, SUM(COALESCE(rp6,0)) as trp6, SUM(COALESCE(rpt1,0)) as t1, SUM(COALESCE(rpt2,0)) as t2, SUM(COALESCE(rpt3,0)) as t3, SUM(COALESCE(rpt4,0)) as t4';
            // $sum='SUM(COALESCE(rpt1,0)) as real';
            if($data_renja!="perubahan"){
                return realisasi::select(DB::raw($sum))
                ->where('id_instansi_renja', $idopd)
                ->whereRaw("SUBSTRING(kdkegunit_renja,1,4)='".$this->unitkey."'")
                ->where('periode_renja', $periode)
                ->first();
            }else{
                return realisasi::select(DB::raw($sum))
                ->where('id_instansi_renja', $idopd)
                ->whereRaw("SUBSTRING(kdkegunit_renja,1,4)='".$this->unitkey."'")
                ->where('periode_renja', $periode)
                ->first();
            }
    }

    public function pagu_turusan($idopd,$periode)
    {
        return Rkpd_subkeg::
           selectRaw('sum(pagu_awal) as jpagu_awal,sum(pagu_perubahan) as jpagu_perubahan')
           ->where('rkpd_subkeg.idopd',$idopd)
           // whereRaw("id=SUBSTRING('".$this->id."', 1, 4)")
           ->whereRaw("SUBSTRING(rkpd_subkeg.idsubkeg,1,1)='".$this->unitkey."'")
           ->where('rkpd_subkeg.periode',$periode)
           ->first();
    }

    // realisasi URUSAN
    public function rp_real_t_urusan($periode,$data_renja,$idopd)
    {   
        $sum='SUM(COALESCE(rp5,0)) as trp5, SUM(COALESCE(rp6,0)) as trp6, SUM(COALESCE(rpt1,0)) as t1, SUM(COALESCE(rpt2,0)) as t2, SUM(COALESCE(rpt3,0)) as t3, SUM(COALESCE(rpt4,0)) as t4';
            // $sum='SUM(COALESCE(rpt1,0)) as real';
            if($data_renja!="perubahan"){
                return realisasi::select(DB::raw($sum))
                ->where('id_instansi_renja', $idopd)
                ->whereRaw("SUBSTRING(kdkegunit_renja,1,1)='".$this->unitkey."'")
                ->where('periode_renja', $periode)
                ->first();
            }else{
                return realisasi::select(DB::raw($sum))
                ->where('id_instansi_renja', $idopd)
                ->whereRaw("SUBSTRING(kdkegunit_renja,1,1)='".$this->unitkey."'")
                ->where('periode_renja', $periode)
                ->first();
            }
    }
}
