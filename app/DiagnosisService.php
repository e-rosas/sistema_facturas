<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosisService extends Model
{
    public $discounted_price_mxn = 0;
    public $total_discounted_price_mxn = 0;
    public $dates = ['DOS', 'DOS_to', 'updated_at'];
    public $fillable = [
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
        'DOS',
        'DOS_to',
        'invoice_id',
        'diagnoses_pointers',
    ];
    public static $rules = [
        'service_id' => 'required',
        'invoice_id' => 'required',
        'code' => 'max:255',
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
        'DOS' => 'date',
        'DOS_to' => 'date',
        'diagnoses_pointers' => 'max:255|required',
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

    public function price()
    {
        return number_format($this->price, 4);
    }

    public function discountedPrice()
    {
        return number_format($this->discounted_price, 4);
    }

    public function tax()
    {
        return number_format($this->tax, 4);
    }

    public function dTax()
    {
        return number_format($this->dtax, 4);
    }

    public function subtotal()
    {
        return number_format($this->sub_total, 4);
    }

    public function subTotalDiscounted()
    {
        return number_format($this->sub_total_discounted, 4);
    }

    public function totalPrice()
    {
        return number_format($this->total_price, 4);
    }

    public function totalDiscountedPrice()
    {
        return number_format($this->total_discounted_price, 4);
    }

    public function totalPriceMXN()
    {
        return number_format($this->total_price_mxn, 4);
    }

    public function totalDiscountedPriceMXN()
    {
        return number_format($this->total_discounted_price_mxn, 4);
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
