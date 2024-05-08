<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountryCode;
use App\Models\Product;
use App\Models\Barcode;

class BarcodeController extends Controller
{

    public function Index()
    {
        $countries = CountryCode::all();
        $products = Product::all();
        return view('welcome', compact('countries', 'products'));
    }

    public function NewProduct(Request $request)
    {
        $product = new Product();

        $product->countryCode = $request->countryCode;
        $product->category = 'N/A';
        $product->productName = $request->productName;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        // Generate a random numeric string of 5 digits for the product code
        $randomCode = str_pad(rand(0, pow(10, 5) - 1), 5, '0', STR_PAD_LEFT);

        // Set the product code to the generated random code
        $product->productCode = $randomCode;

        $product->save();

        return redirect()->back()->with('success', 'product added successfully');


        //return response()->json($product);
    }

    public function Barcode(Request $request)
    {
        //$barcode = Barcode::all();

        return view('barcodes');
    }

    public function GenerateBarcode(Request $request)
    {
        // Retrieve the product information based on the selected product name
        $product = Product::where('productCode', $request->productCode)->first();

        if ($product) {
            // Generate a random last digit
            $lastDigit = mt_rand(0, 9);

            // Concatenate country code, company code, product code, and the random last digit
            $barcodeId = $product->countryCode . $product->companyCode . $product->productCode . $lastDigit;

            // Ensure the length of the barcodeId is 11 digits
            if (strlen($barcodeId) < 11) {
                $barcodeId = str_pad($barcodeId, 11, '0', STR_PAD_RIGHT);
            } elseif (strlen($barcodeId) > 11) {
                $barcodeId = substr($barcodeId, 0, 11); // Trim excess characters
            }

            // Store or return the generated barcodeId
            $barcode = new Barcode();
            $barcode->countryCode = $product->countryCode;
            $barcode->productCode = $product->productCode;
            $barcode->companyCode = $product->companyCode;
            $barcode->lastDigit = $lastDigit;
            $barcode->barcodeId = $barcodeId;
            //$barcode->save(); // Store in database

            // Or return the generated barcodeId
            return response()->json(['barcodeId' => $barcodeId]);
        } else {
            // Handle case where product is not found
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

}
