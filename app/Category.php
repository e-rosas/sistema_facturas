<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $services;
    public $total;
    public $fillable = [
        'name',
    ];
    public static $rules = [
        'name' => 'required|max:255',
    ];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];
}
