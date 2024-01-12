<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_E55 extends Model
{
    protected $table = 'status_e55';
    protected $fillable = [
        'thn', 'st1','st2','st3','st4','id_instansi'
    ];

	
    public function data_opd()
    {
            return $this->belongsTo('App\Data_Opd','id_instansi','id');
    }
}
