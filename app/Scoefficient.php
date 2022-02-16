<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scoefficient extends Model
{
    protected $table = "scoefficients";
    protected $primaryKey = "id";
    protected $fillable = [
        'si','si_nilai',
    ];
}
