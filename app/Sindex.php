<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sindex extends Model
{
    protected $table = "sindices";
    protected $primaryKey = "id";
    protected $fillable = [
        'datasets_id','a_i','b_i','si_i',
    ];
}
