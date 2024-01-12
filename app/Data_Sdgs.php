<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data_Sdgs extends Model
{
    protected $table = 'data_sdgs';
    protected $fillable = [
        'periode','id_instansi','idprgrm','sdgscek'
    ];

	
    public function data_opd()
    {
            return $this->belongsTo('App\Data_Opd','id_instansi','id');
    }
}
