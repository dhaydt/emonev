<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class urusan_opd extends Model
{
    protected $table = 'urusan_opd';
    protected $fillable = [
        'id', 'id_instansi','arr_urusan','th_awal','th_akhir'
    ];

    public function opd()
    {
            return $this->belongsTo('App\Data_Opd','id_instansi','id');
    }

}
