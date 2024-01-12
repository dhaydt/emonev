<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renstra_Keg extends Model
{
    protected $table = 'renstra_keg';
    public $incrementing = false;
    protected $fillable = [
        'id', 'idprgrm','kdperspektif','nmkegunit','levelkeg','type','kode','id_status'
    ];

    public function program()
    {
            return $this->belongsTo('App\Rpjmd_Prog','idprgrm','idprgrm');
    }

    public function master_program()
    {
            return $this->belongsTo('App\Program','idprgrm','id');
    }
}
