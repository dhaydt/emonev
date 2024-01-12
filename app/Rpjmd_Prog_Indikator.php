<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpjmd_Prog_Indikator extends Model
{
    protected $table = 'rpjmd_prog_indikator';
	protected $fillable = [
	    'id', 'idprgrm','id_instansi','unitkey','indikator','satuan',
	    't1','t2','t3','t4','t5','t6',
	    'rt1','rt2','rt3','rt4','rt5','rt6',
	    'pe1','pe2','pe3','pe4','pe5','pe6','periode','id_periode_rpjmd'
	];

	public function realisasi_tprog()
	{
	        return $this->hasOne('App\Realisasi_Tprog','id_ind_prog','id');
	}

	public function realisasi_renstra_tprog()
	{
	        return $this->hasOne('App\Realisasi_Renstra_Tprog','id_ind_prog','id');
	}
}
