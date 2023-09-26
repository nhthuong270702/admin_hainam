<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'name',
        'unit',
    ];

    public function export_products()
    {
        return $this->hasMany(ExportProduct::class);
    }

    public function import_products()
    {
        return $this->hasMany(ImportProduct::class);
    }
}
