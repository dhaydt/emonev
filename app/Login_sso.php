<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login_sso extends Authenticatable
{
    protected $table='sso';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','username', 'nm_pegawai', 'SESSION_VALUE','ID_INSTANSI_SAKATO','NAMA_INSTANSI','ID_GROUP','NAMA_GROUP','ID_APLIKASI','id_instansi','level','remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    public function data_opd()
    {
            return $this->belongsTo('App\Data_Opd','id_instansi','id');
    }
    
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
