<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use DB;
class Apbd extends Model
{
    protected $table = 'apbd';
    protected $fillable = [
        'rkpd'
    ];
    public $timestamps = false;
    public function rkpd_kegiatan()
    {
        // return Renja::where('periode', $this->thn)
        // ->where('id_instansi', $this->id_instansi)->where('bappeda',1)
        // ->whereExists(function ($query) {
        //                 $query->select(DB::raw(1))
        //                       ->from('renstra_keg')
        //                       ->whereRaw('renstra_keg.id = renja.kdkegunit')
        //                       ->whereRaw('renstra_keg.nmkegunit =?',[625]);
        //             })
        // ->first();
        return Renja::where('periode', $this->thn)->where('id_instansi', $this->id_instansi)->where('bappeda',1)->where('kdkegunit',$this->kdkegunit)->first();
    //     // ->whereExists(function ($query) {
    //     //                 $query->select(DB::raw(1))
    //     //                       ->from('renstra_keg')
    //     //                       ->whereRaw('renstra_keg.id = renja.kdkegunit')
    //     //                       ->whereRaw('renstra_keg.nmkegunit= ?',[$this->nmkegunit]);
    //     //             })
    //     // ->first();
    //     // return Renja::where('periode', $this->thn)->where('id_instansi', $this->id_instansi)->where('bappeda',1)
    //     // ->join('renstra_keg', 'renja.kdkegunit', '=', 'renstra_keg.id')
    //     //             ->select('renja.*', 'renstra_keg.nmkegunit')->where('nmkegunit',$this->nmkegunit)
    //     //             ->first();
     	// return DB::select(DB::raw(" 
      //       SELECT r.*,k.nmkegunit
      //       FROM renja r, renstra_keg k
      //       WHERE r.kdkegunit=k.id and r.bappeda=1 and r.id_instansi='".$this->id_instansi."' and k.nmkegunit='".$this->nmkegunit."'"
      //   ));
    }

    public function data_opd(){
    	// return Data_Opd::where('id',$this->id_instansi)->first();
    	return $this->belongsTo('App\Data_Opd','id_instansi','id');
    }
}
