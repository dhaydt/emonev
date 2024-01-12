<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi_Renstra_Tprog extends Model
{
    protected $table = 'realisasi_renstra_tprog';
    public $timestamps = false;
    protected $fillable = [
        'id_ind_prog','ket_prog','p_re','p_t1','p_t2','p_t3','p_t4','p_t5','p_t6','fpenghambat_prog','fpendorong_prog'
    ];
}
