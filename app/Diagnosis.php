<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    public $fillable = [
        'code',
        'name',
        'nombre',
    ];
}
