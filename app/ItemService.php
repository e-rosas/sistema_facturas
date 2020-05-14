<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemService extends Model
{
    public $fillable = [
        'diagnosis_service_id',
        'code',
        'description',
        'descripcion',
        'item_id',
        'itax',
        'idtax',
        'sub_total_price',
        'sub_total_discounted_price',
        'total_price',
        'total_discounted_price',
        'price',
        'discounted_price',
        'quantity',
    ];
    public static $rules = [
        'diagnosis_service_id' => 'required',
        'item_id' => 'required',
        'code' => 'max:255',
        'description' => 'max:255',
        'descripcion' => 'max:255',
        'itax' => 'numeric|required|between:0,999999999.999',
        'idtax' => 'numeric|required|between:0,999999999.999',
        'sub_total_price' => 'numeric|required|between:0,999999999.999',
        'sub_total_discounted_price' => 'numeric|required|between:0,999999999.999',
        'total_price' => 'numeric|required|between:0,999999999.999',
        'total_discounted_price' => 'numeric|required|between:0,999999999.999',
        'price' => 'numeric|required|between:0,999999999.999',
        'discounted_price' => 'numeric|required|between:0,999999999.999',
        'quantity' => 'required',
    ];
    protected $casts = [
        'id' => 'integer',
        'diagnosis_service_id' => 'integer',
        'description' => 'string',
        'item_id' => 'integer',
        'itax' => 'decimal:13',
        'idtax' => 'decimal:13',
        'sub_total_price' => 'decimal:13',
        'sub_total_discounted_price' => 'decimal:13',
        'total_price' => 'decimal:13',
        'total_discounted_price' => 'decimal:13',
        'price' => 'decimal:13',
        'discounted_price' => 'decimal:13',
        'quantity' => 'integer',
    ];

    public function getIdtaxAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getItaxAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getSubTotalPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getSubTotalDiscountedPriceAttribute($value)
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

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function diagnosis_service()
    {
        return $this->belongsTo('App\DiagnosisService');
    }

    public function code()
    {
        return 'A'.$this->code;
    }
}
