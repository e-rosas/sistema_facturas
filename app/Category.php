<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $services;
    public $total;
    public $fillable = [
        'name',
        'nombre'
    ];
    public static $rules = [
        'name' => 'required|max:255',
        'nombre' => 'required|max:255',
    ];
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];

    public function total()
    {
        return number_format($this->total, 2);
    }

    public function name()
    {
        if (1 == $this->id) {
            return 'ROOM AND BOARD';
        }

        return $this->name;
    }

    public function services2()
    {
        return $this->hasMany('App\Service');
    }
}