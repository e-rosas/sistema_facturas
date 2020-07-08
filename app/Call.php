<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    public $fillable = [
        'number',
        'comments',
        'status',
        'invoice_id',
        'claim',
        'date',
    ];
    public static $rules = [
        'comments' => 'max:1000',
        'status' => 'numeric',
        'invoice_id' => 'required',
        'date' => 'date',
        'claim' => 'max:255',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'comments' => 'string',
        'claim' => 'string',
    ];

    protected $dates = ['date'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return __('In process');

                break;
            case 1:
                return __('Deductibles');

                break;
            case 2:
                return __('Denied for non covered charges');

                break;
            case 3:
                return __('Paid');

                break;
            case 4:
                return __('Denied for untimely filing');

                break;
            case 5:
                return __('Other');

                break;
            default:
                // code...
                break;
        }
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}