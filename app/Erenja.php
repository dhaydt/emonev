<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Erenja extends Model
{
    protected $table = 'erenja';
    protected $fillable = [
        'periode', 'idopd','idprgrm','kdkegunit','idindikatorkeg',
        'triwulan1k','triwulan1',
        'triwulan2k','triwulan2',
        'triwulan3k','triwulan3',
        'triwulan4k','triwulan4',
        'pjawab','ket'
    ];
}
