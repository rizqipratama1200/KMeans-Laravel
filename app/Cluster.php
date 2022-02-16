<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $table = "clusters";
    protected $primaryKey = "id";
    protected $fillable = [
        'cluster','datasets_id',
    ];
}
