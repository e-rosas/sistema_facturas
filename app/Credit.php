<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public $fillable = [
        'amount_due',
        'series',
        'number',
        'comments',
        'original_amount_due',
        'concept',
        'date',
        'invoice_id',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function getAmountDueAttribute($value)
    {
        return number_format($value, 4);
    }

    public function getOriginalAmountDueAttribute($value)
    {
        return number_format($value, 4);
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
