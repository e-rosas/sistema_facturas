<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceService extends Model
{
    public $dates = ['created_at', 'updated_at'];
    public $fillable = [
        'invoice_id',
        'service_id',
        'price',
        'discounted_price',
        'tax',
        'dtax',
        'sub_total',
        'sub_total_discounted',
        'total_price',
        'total_discounted_price',
        'description',
        'descripcion',
        'code',
        'quantity',
        'created_at',
        'diagnosis_code',
    ];
    public static $rules = [
        'invoice_id' => 'required',
        'service_id' => 'required',
        'code' => 'max:255',
        'diagnosis_code' => 'max:255',
        'price' => 'numeric|required|between:0,999999999.999',
        'discounted_price' => 'numeric|required|between:0,999999999.999',
        'tax' => 'numeric|required|between:0,999999999.999',
        'dtax' => 'numeric|required|between:0,999999999.999',
        'sub_total' => 'numeric|required|between:0,999999999.999',
        'sub_total_discounted' => 'numeric|required|between:0,999999999.999',
        'total_price' => 'numeric|required|between:0,999999999.999',
        'total_discounted_price' => 'numeric|required|between:0,999999999.999',
        'description' => 'max:255',
        'descripcion' => 'max:255',
        'quantity' => 'numeric|required',
        'created_at' => 'date',
    ];
    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'service_id' => 'integer',
        'price' => 'decimal:13',
        'discounted_price' => 'decimal:13',
        'tax' => 'decimal:13',
        'dtax' => 'decimal:13',
        'sub_total' => 'decimal:13',
        'sub_total_discounted' => 'decimal:13',
        'total_price' => 'decimal:13',
        'total_discounted_price' => 'decimal:13',
        'quantity' => 'integer',
    ];

    public function getTaxAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getDtaxAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getSubTotalAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getSubTotalDiscountedAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getTotalPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getTotalDiscountedPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getDiscountedPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function items()
    {
        return $this->hasMany('App\ItemService');
    }

    public function code()
    {
        return 'A'.$this->code;
    }
}
