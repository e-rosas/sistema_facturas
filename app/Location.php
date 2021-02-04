<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'first_line',
        'second_line',
        'third_line',
        'fourth_line',
        'phone_number',
    ];

    public function requiresThirdLine()
    {
        if (null == $this->third_line) {
            return '';
        }

        return $this->third_line;
    }
}