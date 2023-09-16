<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'document',
        'quanity',
        'price',
        'buyer_name',
        'buyer_phone',
        'buyer_address',
        'buyer_driver',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
