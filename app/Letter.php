<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    public $fillable = [
        'comments',
        'file_path',
        'date',
        'charge_id',
        'number',
    ];
    protected $dates = ['date', 'created_at', 'updated_at'];

    public function charge()
    {
        return $this->belongsTo('App\Charge', 'invoice_id', 'charge_id');
    }
}
