<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_Keg extends Model
{
    protected $table = 'sub_kegiatan';
    public $incrementing = false;
    protected $fillable = [
        'id', 'kdkegunit','kdperspektif','nmsub_keg','id_status'
    ];

    public function master_keg()
    {
            return $this->belongsTo('App\Renstra_Keg','kdkegunit','id');
    }
}
