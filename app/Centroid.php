<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centroid extends Model
{
    protected $table = "centroids";
    protected $primaryKey = "id";
    protected $fillable = [
        'centroid',
    ];
}
