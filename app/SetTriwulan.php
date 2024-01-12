<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetTriwulan extends Model
{
    protected $table = 'settriwulan';
    protected $fillable = [
        'thn','tw1','tw2','tw3','tw4','tw1_src','tw2_src','tw3_src','tw4_src'
    ];
	public $timestamps = false;
}
