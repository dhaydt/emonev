<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dafunit;
class Program extends Model
{
    protected $table = 'program';
    public $incrementing = false;
    protected $fillable = [
        'id','nmprgrm','nomor','id_status','non_urusan'
    ];

    public function kegiatan()
    {
            return $this->hasMany('App\Renstra_Keg','id');
    }

    public function urusan()
    {
        // return $this->belongsTo('App\Dafunit',SUBSTRING('idprog', 1, 4),'id');
        return Dafunit::whereRaw("id=SUBSTRING('".$this->nomor."', 1, 4)")->first();
        // return "123";
    }
}
