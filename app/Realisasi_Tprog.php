<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi_Tprog extends Model
{
    protected $table = 'realisasi_tprog';
    protected $fillable = [
        'id_ind_prog','ket_prog','p_ak','p_re','p_t1','p_t2','p_t3','p_t4','fpenghambat_prog','fpendorong_prog'
    ];
}
