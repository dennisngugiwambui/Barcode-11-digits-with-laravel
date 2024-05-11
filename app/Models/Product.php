<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'countryCode',
        'category',
        'productName',
        'price',
        'quantity',
        'productCode',
        'status',
    ];


    public function barcodes()
    {
        return $this->hasMany(Barcode::class, 'productCode', 'productCode');
    }
}
