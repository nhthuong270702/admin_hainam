<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportProduct extends Model
{
    use HasFactory;
    protected $table = 'export_products';

    protected $fillable = [
        'id',
        'date',
        'document',
        'quanity',
        'price',
        'buyer_name',
        'note',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
