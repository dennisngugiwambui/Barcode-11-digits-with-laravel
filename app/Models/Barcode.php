<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    use HasFactory;

    protected $fillable = [
        'countryCode',
        'productCode',
        'companyCode',
        'lastDigit',
        'barcodeId',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productCode', 'productCode');
    }
}
