<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportProduct extends Model
{
    use HasFactory;

    protected $table = 'import_products';

    protected $fillable = [
        'id',
        'date',
        'document',
        'quanity',
        'price',
        'supplier',
        'note',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
