<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode_Rpjmd extends Model
{
    protected $table = 'periode_rpjmd';
    protected $fillable = [
        'thn_awal', 'thn_akhir','judul'
    ];
    public $timestamps = false;
}
