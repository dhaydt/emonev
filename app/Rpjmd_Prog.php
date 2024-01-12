<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB; 
use App\Realisasi;
use App\Realisasi_Renstra;
use App\M_Renstra;
class Rpjmd_Prog extends Model
{
	protected $table = 'rpjmd_prog';
	protected $fillable = [
	    'id','idprgrm', 'id_indikator_rpjmd','tahun_awal_rpjmd','tahun_akhir_rpjmd','unitkey','nmprgrm','programindikator','id_instansi','nuprgrm','id_status','prioritas','id_periode_rpjmd'
	];

	public function master_program()
	{
	        return $this->belongsTo('App\Program','idprgrm','id');
	}
	
	public function kegiatan()
	{
	        return $this->hasMany('App\Renstra_Keg','idprgrm','idprgrm');
	}

	public function urusan_program()
	{
		if($this->unitkey=='80_'){
			//nm_unit : nm_instansi(sekda)
			    return Dafunit::where('unitkey', '212_')->first()->nm_unit;	
		}else{
		    return Dafunit::where('unitkey', $this->unitkey)->first()->nm_unit;		
		}
	}

	public function opd_program()
	{
		    return Data_Opd::where('id',$this->id_instansi)->first()->nm_instansi;	
	}

	public function indikator_program()
	{
		    return Rpjmd_Prog_Indikator::where('idprgrm', $this->idprgrm)->where('id_instansi', $this->id_instansi)->where('unitkey', $this->unitkey)->where('id_periode_rpjmd', $this->id_periode_rpjmd)->get();	
	}

	// UNTUK PER Program OPD
	
	
	//jml kegiatan 
	public function jml_keg($periode,$data_renja)
	{
		if($data_renja!="perubahan"){
			return Renja::where('idprgrm', $this->idprgrm)
			->where('id_instansi', $this->id_instansi)
			->where('bappeda', 1)
			// ->where('urusan_key', $this->unitkey)
			->where('periode', $periode)->count();
		}else{
			return Renja_Per::where('idprgrm', $this->idprgrm)
			->where('id_instansi', $this->id_instansi)
			->where('bappeda', 1)
			->where('periode', $periode)->count();			
		}
	
	}
	public function jml_keg_k($periode,$data_renja)
	{
		if($data_renja!="perubahan"){
		    return Renja::where('renja.periode', $periode)
		    	->where('renja.id_instansi', $this->id_instansi)
				->where('idprgrm', $this->idprgrm)
				->where('bappeda', 1)
		    	// ->where('urusan_key', $this->unitkey)
		    	->join('renja_indikator','renja_indikator.id_renja', '=', 'renja.id')
		        ->join('renja_indikator_det', 'renja_indikator.id', '=', 'renja_indikator_det.id_kegindikator')
		    	->count();
		}else{
		    return Renja_Per::where('renja_per.periode', $periode)
		    	->where('renja_per.id_instansi', $this->id_instansi)
				->where('idprgrm', $this->idprgrm)
				->where('bappeda', 1)
		    	// ->where('urusan_key', $this->unitkey)
		    	->join('renja_indikator_per','renja_indikator_per.id_renja', '=', 'renja_per.id')
		        ->join('renja_indikator_det', 'renja_indikator_per.id', '=', 'renja_indikator_det.id_kegindikator_per')
		    	->count();
		}
	}

	//jml realisasi
	public function jml_realisasi_keg($periode,$rp,$data_renja)
	{
		if($data_renja!="perubahan"){
		    return Renja::where('periode', $periode)
		    ->where('id_instansi', $this->id_instansi)
		    // ->where('urusan_key', $this->unitkey)
		    ->where('idprgrm', $this->idprgrm)
		    ->join('realisasi','realisasi.id_renja', '=', 'renja.id')
		    ->where('realisasi.'.$rp,'!=',null)
		    ->count();	
		}else{
			return Renja_Per::where('periode', $periode)
			->where('id_instansi', $this->id_instansi)
			// ->where('urusan_key', $this->unitkey)
			->where('idprgrm', $this->idprgrm)
			->join('realisasi','realisasi.id_renja_per', '=', 'renja_per.id')
			->where('realisasi.'.$rp,'!=',null)
			->count();	
		}
	}
	public function jml_realisasi_keg_k($periode,$k,$data_renja)
	{
		if($data_renja!="perubahan"){
		    return Renja::where('renja.periode', $periode)
		    	->where('renja.id_instansi', $this->id_instansi)
		    	->where('idprgrm', $this->idprgrm)
		    	// ->where('urusan_key', $this->unitkey)
		    	->join('renja_indikator','renja_indikator.id_renja', '=', 'renja.id')
		        ->join('renja_indikator_det', 'renja_indikator.id', '=', 'renja_indikator_det.id_kegindikator')
		        ->join('realisasi_target', 'renja_indikator_det.id', '=', 'realisasi_target.id_target')
		        ->where('realisasi_target.'.$k,'!=',null)
		    	->count();	
		}else{
			return Renja_Per::where('renja_per.periode', $periode)
				->where('renja_per.id_instansi', $this->id_instansi)
				->where('idprgrm', $this->idprgrm)
				// ->where('urusan_key', $this->unitkey)
				->join('renja_indikator_per','renja_indikator_per.id_renja', '=', 'renja_per.id')
			    ->join('renja_indikator_det', 'renja_indikator_per.id', '=', 'renja_indikator_det.id_kegindikator_per')
			    ->join('realisasi_target', 'renja_indikator_det.id', '=', 'realisasi_target.id_target')
			    ->where('realisasi_target.'.$k,'!=',null)
				->count();	
		}
	}

	//realisasi dan pagu perprogram
	public function rp_keg($periode,$data_renja)
	{
		if($data_renja!="perubahan"){
		    return Renja::select(DB::raw('SUM(belanja_p_now+belanja_bj_now+belanja_m_now) as pagu'))->where('idprgrm', $this->idprgrm)
		    ->where('id_instansi', $this->id_instansi)
		    ->where('bappeda', 1)
		    ->where('periode', $periode)->first();
		}else{
			return Renja_Per::select(DB::raw('SUM(belanja_p_now+belanja_bj_now+belanja_m_now) as pagu'))->where('idprgrm', $this->idprgrm)
			->where('id_instansi', $this->id_instansi)
			->where('bappeda', 1)
			->where('periode', $periode)->first();
		}
			//return Renja::where('id_instansi', $this->id_instansi)
		    //->where('bappeda', 1)
		    //->where('periode', $periode)
			//->sum('renja.belanja_p_now+renja.belanja_bj_now+renja.belanja_m_now');
	}
	public function rp_real_keg($periode,$triwulan,$data_renja)
	{	
//	COALESCE(TotalHoursM,0)
		if($triwulan==1){$sum='SUM(COALESCE(rpt1,0)) as real';}
		elseif($triwulan==2){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)) as real';}
		elseif($triwulan==3){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)) as real';}
		elseif($triwulan==4){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)+COALESCE(rpt4,0)) as real';}
			// $sum='SUM(COALESCE(rpt1,0)) as real';
			
			if($data_renja!="perubahan"){
				return realisasi::select(DB::raw($sum))->join('renja','renja.id', '=', 'realisasi.id_renja')
				->where('renja.bappeda', '=', 1)
				->where('renja.id_instansi', $this->id_instansi)
				->where('renja.idprgrm', $this->idprgrm)
			    ->where('renja.periode', $periode)
				->first();
			}else{
					return realisasi::select(DB::raw($sum))->join('renja_per','renja_per.id', '=', 'realisasi.id_renja_per')
					->where('renja_per.bappeda', '=', 1)
					->where('renja_per.id_instansi', $this->id_instansi)
					//->where('renja_per.id_instansi', 36)
					->where('renja_per.idprgrm', $this->idprgrm)
				    ->where('renja_per.periode', $periode)
					->first();
			}
	}

	// Jml Capaian kinerja kegiatan
	public function jml_keg_predikat($periode,$triwulan,$predikat,$pagu,$data_renja)
	{
		// if($triwulan==1){$sum='(COALESCE(rpt1,0))';}
		// elseif($triwulan==2){$sum='(COALESCE(rpt1,0)+COALESCE(rpt2,0))';}
		// elseif($triwulan==3){$sum='(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0))';}
		// elseif($triwulan==4){$sum='(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)+COALESCE(rpt4,0))';}
		
		
		if($predikat=='ST'){$op1='>90'; $op2='>90';}
		elseif($predikat=='T'){$op1='>75';$op2='<=90';}
		elseif($predikat=='S'){$op1='>65';$op2='<=75';}
		elseif($predikat=='R'){$op1='>50';$op2='<=65';}
		elseif($predikat=='SR'){$op1='<=50';$op2='<=50';}

		// return Renja::where('idprgrm', $this->idprgrm)
		// ->where('id_instansi', $this->id_instansi)
		// ->where('bappeda', 1)
		// ->where('periode', $periode)
		// ->join('realisasi', 'renja.id', '=', 'realisasi.id_renja')
		// ->select('renja.id')
		// ->whereRaw('(('.$sum.'/'.$pagu.')*100) '.$op1)
		// ->whereRaw('(('.$sum.'/'.$pagu.')*100) '.$op2)
		// ->count();

		// return count(DB::select( DB::raw("select r.id,(r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now)/(NULLIF(re.rpt1,0)) as persen from renja r,realisasi re where r.id=re.id_renja and bappeda=1 and id_instansi=".$this->id_instansi." and idprgrm=".$this->idprgrm." and periode=".$periode)));
		if($triwulan==1){$sum='(COALESCE(re.rpt1,0))';}
		elseif($triwulan==2){$sum='(COALESCE(re.rpt1,0)+COALESCE(re.rpt2,0))';}
		elseif($triwulan==3){$sum='(COALESCE(re.rpt1,0)+COALESCE(re.rpt2,0)+COALESCE(re.rpt3,0))';}
		elseif($triwulan==4){$sum='(COALESCE(re.rpt1,0)+COALESCE(re.rpt2,0)+COALESCE(re.rpt3,0)+COALESCE(re.rpt4,0))';}

	// return count(DB::select( DB::raw("select r.id from renja r,realisasi re where r.id=re.id_renja and bappeda=1 and id_instansi=".$this->id_instansi." and idprgrm=".$this->idprgrm." and periode=".$periode." and (((".$sum."/".$pagu.")*100) >50)")));
		if($data_renja!="perubahan"){
			return count(DB::select( DB::raw("select r.id,(((".$sum.")/NULLIF((r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now),0)))*100 as persen from renja r,realisasi re where r.id=re.id_renja and bappeda=1 and id_instansi='".$this->id_instansi."' and idprgrm='".$this->idprgrm."' and periode='".$periode."' and ((((".$sum.")/NULLIF((r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now),0)))*100) ".$op1."and ((((".$sum.")/NULLIF((r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now),0)))*100) ".$op2)));
		}else{
			return count(DB::select( DB::raw("select r.id,(((".$sum.")/NULLIF((r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now),0)))*100 as persen from renja_per r,realisasi re where r.id=re.id_renja_per and bappeda=1 and id_instansi='".$this->id_instansi."' and idprgrm='".$this->idprgrm."' and periode='".$periode."' and ((((".$sum.")/NULLIF((r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now),0)))*100) ".$op1."and ((((".$sum.")/NULLIF((r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now),0)))*100) ".$op2)));
		}
	// select r.id,(r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now)as pagu,(COALESCE(re.rpt1,0)+COALESCE(re.rpt2,0)+COALESCE(re.rpt3,0))as realisasi,(((COALESCE(re.rpt1,0)+COALESCE(re.rpt2,0)+COALESCE(re.rpt3,0))/NULLIF((r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now),0)))*100 as persen from renja r,realisasi re where r.id=re.id_renja and bappeda=1 and ((((COALESCE(re.rpt1,0)+COALESCE(re.rpt2,0)+COALESCE(re.rpt3,0))/NULLIF((r.belanja_p_now+r.belanja_bj_now+r.belanja_m_now),0)))*100)>90
	}

	// RENSTRA
	//jml kegiatan renstra
	public function jml_keg_renstra($periode)
	{
			return M_Renstra::where('idprgrm', $this->idprgrm)
			->where('id_instansi', $this->id_instansi)
			// ->where('bappeda', 1)
			// ->where('urusan_key', $this->unitkey)
			->where('periode', $periode)->count();
	}
	public function jml_keg_k_renstra($periode)
	{
		return M_Renstra::where('m_renstra.periode', $periode)
		->where('m_renstra.id_instansi', $this->id_instansi)
		->where('idprgrm', $this->idprgrm)
		// ->where('bappeda', 1)
		// ->where('urusan_key', $this->unitkey)
		->join('m_renstra_indikator','m_renstra_indikator.id_renstra', '=', 'm_renstra.id')
	    ->join('m_renstra_indikator_det', 'm_renstra_indikator.id', '=', 'm_renstra_indikator_det.id_kegindikator')
	    	->count();
	}
	//jml realisasi renstra
	public function jml_realisasi_keg_renstra($periode,$rp)
	{
	    return M_Renstra::where('periode', $periode)
	    ->where('id_instansi', $this->id_instansi)
	    // ->where('urusan_key', $this->unitkey)
	    ->where('idprgrm', $this->idprgrm)
	    ->join('realisasi_renstra','realisasi_renstra.id_renstra', '=', 'm_renstra.id')
	    ->where('realisasi_renstra.'.$rp,'!=',null)
	    ->count();	
	}
	public function jml_realisasi_keg_k_renstra($periode,$k)
	{
	    return M_Renstra::where('m_renstra.periode', $periode)
	    	->where('m_renstra.id_instansi', $this->id_instansi)
	    	->where('idprgrm', $this->idprgrm)
	    	// ->where('urusan_key', $this->unitkey)
	    	->join('m_renstra_indikator','m_renstra_indikator.id_renstra', '=', 'm_renstra.id')
	        ->join('m_renstra_indikator_det', 'm_renstra_indikator.id', '=', 'm_renstra_indikator_det.id_kegindikator')
	        ->join('realisasi_renstra_target', 'm_renstra_indikator_det.id', '=', 'realisasi_renstra_target.id_target')
	        ->where('realisasi_renstra_target.'.$k,'!=',null)
	    	->count();		
	}
	public function realisasi_renstra($periode)
	{	
//	COALESCE(TotalHoursM,0)
		// if($thn==1){$sum='SUM(COALESCE(rpt1,0)) as real';}
		// elseif($thn==2){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)) as real';}
		// elseif($thn==3){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)) as real';}
		// elseif($thn==4){
		// $sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)+COALESCE(rpt4,0)) as real';
		// }
		$sum='SUM(COALESCE(rpt1,0)) as t_rpt1,SUM(COALESCE(rpt2,0)) as t_rpt2,SUM(COALESCE(rpt3,0)) as t_rpt3,SUM(COALESCE(rpt4,0)) as t_rpt4,SUM(COALESCE(rpt5,0)) as t_rpt5,SUM(COALESCE(rpt6,0)) as t_rpt6';
		return Realisasi_Renstra::select(DB::raw($sum))->join('m_renstra','m_renstra.id', '=', 'realisasi_renstra.id_renstra')
		->where('m_renstra.id_instansi', $this->id_instansi)
		->where('m_renstra.idprgrm', $this->idprgrm)
	    ->where('m_renstra.periode', $periode)
		->first();
			
	}
	public function target_renstra($periode)
	{	
//	COALESCE(TotalHoursM,0)
		// if($thn==1){$sum='SUM(COALESCE(rpt1,0)) as real';}
		// elseif($thn==2){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)) as real';}
		// elseif($thn==3){$sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)) as real';}
		// elseif($thn==4){
		// $sum='SUM(COALESCE(rpt1,0)+COALESCE(rpt2,0)+COALESCE(rpt3,0)+COALESCE(rpt4,0)) as real';
		// }
		$sum='SUM(COALESCE(m_renstra.trp_1,0)) as t_trp_1,SUM(COALESCE(m_renstra.trp_2,0)) as t_trp_2,SUM(COALESCE(m_renstra.trp_3,0)) as t_trp_3,SUM(COALESCE(m_renstra.trp_4,0)) as t_trp_4,SUM(COALESCE(m_renstra.trp_5,0)) as t_trp_5,SUM(COALESCE(m_renstra.trp_6,0)) as t_trp_6';
		return M_Renstra::select(DB::raw($sum))
		->where('m_renstra.id_instansi', $this->id_instansi)
		->where('m_renstra.idprgrm', $this->idprgrm)
	    ->where('m_renstra.periode', $periode)
		->first();		
	}
}
