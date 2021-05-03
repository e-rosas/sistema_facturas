<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'template',
        'comments',
        'date',
        'to_date',
    ];
    protected $dates = ['date', 'to_date'];

    public function emails()
    {
        return $this->hasMany('App\Email');
    }
}