<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Opd extends Model
{
    protected $table = 'opd';

    protected $fillable = [
        'id','username','password','id_instansi','email','nip','nm_pegawai','status'
    ];

    public function data_opd()
    {
            return $this->belongsTo('App\Data_Opd','id_instansi','id');
    }
    
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    // public function program_rkpd($periode,$unitkey,$id_instansi)
    // {
    //     return Renja::select('idprgrm')->where('periode', $periode)->where('urusan_key', $unitkey)->where('id_instansi', $id_instansi)->where('bappeda',1)->groupby('idprgrm')->get();
    // }   
}
