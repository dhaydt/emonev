<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Rkpd_prog_ind;
use App\Rkpd_keg;
use App\Rkpd_subkeg;
use App\Realisasi;

class Rkpd_prog extends Model
{
    protected $table = 'rkpd_prog';
    protected $fillable = [
        'id','idprog','prog_awal','prog_perubahan','idopd','periode','nmprog'
    ];

    public function master_program()
    {
           return $this->belongsTo('App\Program','idprog','id');
    }

    public function get_unit(){
        return Dafunit::where('id', $this->idunit)->first();
    }
    
    public function opd_program()
    {
            return Data_Opd::where('id',$this->idopd)->first()->nm_instansi;  
    }

    public function rkpd_prog($data_renja)
    {
        if($data_renja=="awal"){
            return Rkpd_prog_ind::where('idprog', $this->idprog)
            ->where('idopd', $this->idopd)
            ->where('periode', $this->periode)
            ->where('prog_ind_awal', '1')
            ->orderby('id')
            ->get(); 
        }elseif ($data_renja=="perubahan") {
           return Rkpd_prog_ind::where('idprog', $this->idprog)
           ->where('idopd', $this->idopd)
           ->where('periode', $this->periode)
           ->where('prog_ind_perubahan', '1')
           ->orderby('id')
           ->get(); 
        }      
    }

    // ->join('contacts', 'users.id', '=', 'contacts.user_id')
    //             ->join('orders', 'users.id', '=', 'orders.user_id')
    //             ->select('users.*', 'contacts.phone', 'orders.price')
    public function pagu($idopd,$periode,$prog)
    {
        return Rkpd_keg::
            join('rkpd_subkeg', 'rkpd_subkeg.idkeg', '=', 'rkpd_keg.idkeg')
            ->selectRaw('sum(pagu_awal) as jpagu_awal,sum(pagu_perubahan) as jpagu_perubahan,rkpd_keg.idprog as idprog, rkpd_keg.idopd as idopd, rkpd_keg.periode as periode')
            ->where('rkpd_subkeg.idopd',$idopd)
            ->where('rkpd_subkeg.periode',$periode)
            ->where('rkpd_keg.idopd',$idopd)
            ->where('rkpd_keg.periode',$periode)
            ->where('rkpd_keg.idprog',$prog)
            ->groupBy('rkpd_keg.idopd','rkpd_keg.periode','rkpd_keg.idprog')
            ->first();
        // return Rkpd_subkeg::
        //    join('rkpd_keg', 'rkpd_subkeg.idkeg', '=', 'rkpd_keg.idkeg')
        //    // ->join('rkpd_prog', 'users.id', '=', 'rkpd_prog.user_id')groupBy('idprog')
        //    ->selectRaw('sum(pagu_awal) as jpagu_awal,sum(pagu_perubahan) as jpagu_perubahan,')
        //    // ->where('idprog',$this->idprog)
        //    // ->where('idprog',$this->idprog)
        //    // ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
        //    ->where('rkpd_keg.idopd',$idopd)
        //    ->where('rkpd_keg.periode',$periode)
        //    ->where('rkpd_subkeg.idopd',$idopd)
        //    ->where('rkpd_subkeg.periode',$periode)
        //    ->groupBy('rkpd_keg.idprog')
        //    ->first();
    }
    
    //jml kegiatan 
    public function jml_kegiatan($periode,$data_renja)
    {
            if($data_renja!="perubahan"){
                    // return Renja::where('idprgrm', $this->idprgrm)
                    // ->where('id_instansi', $this->id_instansi)
                    // ->where('bappeda', 1)
                    // // ->where('urusan_key', $this->unitkey)
                    // ->where('periode', $periode)->count();

                    return Rkpd_subkeg::whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                    // ->where('id_instansi', $this->id_instansi)
                    // ->where('bappeda', 1)
                    // ->where('urusan_key', $unitkey)
                    ->where('subkeg_awal', '1')
                    ->where('idopd', $this->idopd)
                    ->select('idkeg')
                    ->groupBy('idkeg')
                    ->where('periode', $periode)->get();
                }else{
                    return Rkpd_subkeg::whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                    // ->where('id_instansi', $this->id_instansi)
                    // ->where('bappeda', 1)
                    // ->where('urusan_key', $unitkey)
                    ->where('subkeg_perubahan', '1')
                    ->where('idopd', $this->idopd)
                    ->select('idkeg')
                    ->groupBy('idkeg')
                    ->where('periode', $periode)->get();      
                }
    }
    public function jml_keg($periode,$data_renja)
    {
            if($data_renja!="perubahan"){
                    // return Renja::where('idprgrm', $this->idprgrm)
                    // ->where('id_instansi', $this->id_instansi)
                    // ->where('bappeda', 1)
                    // // ->where('urusan_key', $this->unitkey)
                    // ->where('periode', $periode)->count();

                    return Rkpd_subkeg::whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                    // ->where('id_instansi', $this->id_instansi)
                    // ->where('bappeda', 1)
                    // ->where('urusan_key', $unitkey)
                    ->where('subkeg_awal', '1')
                    ->where('idopd', $this->idopd)
                    ->where('periode', $periode)->count();
                }else{
                    return Rkpd_subkeg::whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                    // ->where('id_instansi', $this->id_instansi)
                    // ->where('bappeda', 1)
                    // ->where('urusan_key', $unitkey)
                    ->where('subkeg_perubahan', '1')
                    ->where('idopd', $this->idopd)
                    ->where('periode', $periode)->count();      
                }
    }
    public function jml_keg_k($periode,$data_renja)
    {
        if($data_renja!="perubahan"){
            // return Renja::where('renja.periode', $periode)
            //     ->where('renja.id_instansi', $this->id_instansi)
            //     ->where('idprgrm', $this->idprgrm)
            //     ->where('bappeda', 1)
            //     // ->where('urusan_key', $this->unitkey)
            //     ->join('renja_indikator','renja_indikator.id_renja', '=', 'renja.id')
            //     ->join('renja_indikator_det', 'renja_indikator.id', '=', 'renja_indikator_det.id_kegindikator')
            //     ->count();

            return Rkpd_subkeg::where('rkpd_subkeg.periode', $periode)
            ->where('rkpd_subkeg.idopd', $this->idopd)
            ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
            ->where('subkeg_awal', '1')
            // ->join('rkpd_subkeg_ind','rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
            ->join('rkpd_subkeg_ind',function($q) use ($periode)
                {
                    $q->on('rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                        ->where('rkpd_subkeg_ind.periode', '=', "$periode")
                        // ->where('rkpd_subkeg_ind.idopd', '=', 'rkpd_subkeg.idopd')
                        ->where('rkpd_subkeg_ind.idopd', '=', $this->idopd)
                        ->where('rkpd_subkeg_ind.subkeg_ind_awal', '=', '1');
                })
            // ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator_per')
            ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator')
            ->count();
        }else{
            // return Renja_Per::where('renja_per.periode', $periode)
            //     ->where('renja_per.id_instansi', $this->id_instansi)
            //     ->where('idprgrm', $this->idprgrm)
            //     ->where('bappeda', 1)
            //     // ->where('urusan_key', $this->unitkey)
            //     ->join('renja_indikator_per','renja_indikator_per.id_renja', '=', 'renja_per.id')
            //     ->join('renja_indikator_det', 'renja_indikator_per.id', '=', 'renja_indikator_det.id_kegindikator_per')
            //     ->count();
            return Rkpd_subkeg::where('rkpd_subkeg.periode', $periode)
                ->where('rkpd_subkeg.idopd', $this->idopd)
                ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                ->where('subkeg_perubahan', '1')
                // ->join('rkpd_subkeg_ind','rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                ->join('rkpd_subkeg_ind',function($q) use ($periode)
                {
                    $q->on('rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                        ->where('rkpd_subkeg_ind.periode', '=', "$periode")
                        // ->where('rkpd_subkeg_ind.idopd', '=', 'rkpd_subkeg.idopd')
                        ->where('rkpd_subkeg_ind.idopd', '=', $this->idopd)
                        ->where('rkpd_subkeg_ind.subkeg_ind_perubahan', '=', '1');
                })
                ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator_per')
                // ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator')
                ->count();

        }
    }

    //jml realisasi
    public function jml_realisasi_keg($periode,$rp,$data_renja)
    {
        if($data_renja!="perubahan"){
           return rkpd_subkeg::where('periode', $periode)
           ->where('idopd', $this->idopd)
           ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
           ->where('subkeg_awal', '1')
           ->join('realisasi','realisasi.id_renja', '=', 'rkpd_subkeg.id')
           ->where('realisasi.'.$rp,'!=',null)
           ->count();  
        }else{
            return rkpd_subkeg::where('periode', $periode)
            ->where('idopd', $this->idopd)
            ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
            ->where('subkeg_perubahan', '1')
            ->join('realisasi','realisasi.id_renja_per', '=', 'rkpd_subkeg.id')
            ->where('realisasi.'.$rp,'!=',null)
            ->count(); 
        }
    }

    public function jml_realisasi_keg_k($periode,$k,$data_renja)
    {
        if($data_renja!="perubahan"){
            return Rkpd_subkeg::where('rkpd_subkeg.periode', $periode)
                ->where('rkpd_subkeg.idopd', $this->idopd)
                ->where('subkeg_awal', '1')
                ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                // ->join('rkpd_subkeg_ind','rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                ->join('rkpd_subkeg_ind',function($q) use ($periode)
                {
                    $q->on('rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                        ->where('rkpd_subkeg_ind.periode', '=', "$periode")
                        // ->where('rkpd_subkeg_ind.idopd', '=', 'rkpd_subkeg.idopd')
                        ->where('rkpd_subkeg_ind.idopd', '=', $this->idopd)
                        ->where('rkpd_subkeg_ind.subkeg_ind_awal', '=', '1');
                })
                ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator')
                ->join('realisasi_target', 'renja_indikator_det.id', '=', 'realisasi_target.id_target')
                ->where('realisasi_target.'.$k,'!=',null)
                ->count();  
        }else{
            return Rkpd_subkeg::where('rkpd_subkeg.periode', $periode)
                ->where('rkpd_subkeg.idopd', $this->idopd)
                ->where('subkeg_perubahan', '1')
                ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                // ->join('rkpd_subkeg_ind','rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                ->join('rkpd_subkeg_ind',function($q) use ($periode)
                {
                    $q->on('rkpd_subkeg_ind.idsubkeg', '=', 'rkpd_subkeg.idsubkeg')
                        ->where('rkpd_subkeg_ind.periode', '=', "$periode")
                        ->where('rkpd_subkeg_ind.idopd', '=', $this->idopd)
                        ->where('rkpd_subkeg_ind.subkeg_ind_perubahan', '=', '1')
                        ;
                })
                ->join('renja_indikator_det', 'rkpd_subkeg_ind.id', '=', 'renja_indikator_det.id_kegindikator_per')
                ->join('realisasi_target', 'renja_indikator_det.id', '=', 'realisasi_target.id_target')
                ->where('realisasi_target.'.$k,'!=',null)
                ->count();    
        }
    }

    //realisasi dan pagu perprogram
    public function rp_keg($periode,$data_renja)
    {
        if($data_renja!="perubahan"){
            return Rkpd_subkeg::select(DB::raw('SUM(pagu_awal) as pagu'))
            ->where('subkeg_awal', '1')
            ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
            ->where('idopd', $this->idopd)
            ->where('periode', $periode)->first();
        }else{
            return Rkpd_subkeg::select(DB::raw('SUM(pagu_perubahan) as pagu'))
            ->where('subkeg_perubahan', '1')
            ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
            ->where('idopd', $this->idopd)
            ->where('periode', $periode)->first();
        }
    }

        public function rp_real_keg($periode,$triwulan,$data_renja)
        {   
    //  COALESCE(TotalHoursM,0)
            if($triwulan==1){$sum='SUM(COALESCE(rpt1,0)) as real';}
            elseif($triwulan==2){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)) as real';}
            elseif($triwulan==3){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)) as real';}
            elseif($triwulan==4){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)+COALESCE(rpt4,0)) as real';}
                // $sum='SUM(COALESCE(rpt1,0)) as real';
                
                if($data_renja!="perubahan"){
                    return realisasi::select(DB::raw($sum))->join('rkpd_subkeg','rkpd_subkeg.idsubkeg', '=', 'realisasi.kdkegunit_renja')
                    ->where('rkpd_subkeg.idopd', $this->idopd)
                    ->where('realisasi.id_instansi_renja', $this->idopd)
                    ->where('rkpd_subkeg.subkeg_awal', '1')
                    ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                    ->where('rkpd_subkeg.periode', $periode)
                    ->first();
                }else{
                        return realisasi::select(DB::raw($sum))
                        ->join('rkpd_subkeg','rkpd_subkeg.idsubkeg', '=', 'realisasi.kdkegunit_renja')
                        //->where('rkpd_subkeg.idopd', $this->idopd)
                        ->where('rkpd_subkeg.idopd', $this->idopd)
                        ->where('realisasi.id_instansi_renja', $this->idopd)
                        ->where('rkpd_subkeg.subkeg_perubahan', '1')
                        ->whereRaw('SUBSTRING(rkpd_subkeg.idsubkeg,1,7)=?', $this->idprog)
                        ->where('rkpd_subkeg.periode', $periode)
                        ->first();
                }
        }

        // realisasi program
        public function rp_real_prog($periode,$data_renja)
        {   
            $sum='SUM(COALESCE(rp5,0)) as trp5, SUM(COALESCE(rp6,0)) as trp6, SUM(COALESCE(rpt1,0)) as t1, SUM(COALESCE(rpt2,0)) as t2, SUM(COALESCE(rpt3,0)) as t3, SUM(COALESCE(rpt4,0)) as t4';
                // $sum='SUM(COALESCE(rpt1,0)) as real';
                if($data_renja!="perubahan"){
                    return realisasi::select(DB::raw($sum))
                    ->join('rkpd_subkeg','rkpd_subkeg.id', '=', 'realisasi.id_renja')
                    ->join('rkpd_keg','rkpd_keg.idkeg', '=', 'rkpd_subkeg.idkeg')
                    ->where('rkpd_subkeg.idopd', $this->idopd)
                    // ->where('rkpd_subkeg.idkeg', $this->idkeg)
                    ->where('rkpd_keg.idprog', $this->idprog)
                    ->where('rkpd_subkeg.periode', $periode)
                    ->first();
                }else{
                    return realisasi::select(DB::raw($sum))
                    ->join('rkpd_subkeg','rkpd_subkeg.id', '=', 'realisasi.id_renja_per')
                    ->join('rkpd_keg','rkpd_keg.idkeg', '=', 'rkpd_subkeg.idkeg')
                    ->where('rkpd_subkeg.idopd', $this->idopd)
                    // ->where('rkpd_subkeg.idkeg', $this->idkeg)
                    ->where('rkpd_keg.idprog', $this->idprog)
                    ->where('rkpd_subkeg.periode', $periode)
                    ->first();
                }
        }
}