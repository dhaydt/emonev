<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi_Tkegiatan extends Model
{
    protected $table = 'realisasi_tkegiatan';
    protected $fillable = [
        'id_ind_kegiatan','ket_kegiatan','k_ak','k_re','k_t1','k_t2','k_t3','k_t4','fpenghambat_kegiatan','fpendorong_kegiatan'
    ];
}
