<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = "datasets";
    protected $primaryKey = "id";
    protected $fillable = [
        'kode_siswa','jk','a1','a2','a3','a4','a5','a6','a7','a8','a9',
    ];
}
