<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    public $fillable = [
        'code',
        'description',
        'descripcion',
        'price',
        'discounted_price',
        'category_id',
    ];
    public static $rules = [
        'code' => 'required|max:255',
        'description' => 'required|max:255',
        'description' => 'max:255',
        'price' => 'numeric|required|between:0,999999999.999',
        'discounted_price' => 'numeric|required|between:0,999999999.999',
        'category_id' => 'required|numeric',
    ];
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'description' => 'string',
        'price' => 'decimal:13',
        'discounted_price' => 'decimal:13',
        'category_id' => 'integer',
    ];

    public function getPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function getDiscountedPriceAttribute($value)
    {
        return number_format($value, 3);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function invoices()
    {
        return $this->belongsToMany('App\Invoice', 'invoice_services');
    }
}
