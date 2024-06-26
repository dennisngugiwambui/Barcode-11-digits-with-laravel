<?php

namespace App\Http\Controllers;

use App\Models\GeneratedBarcode;
use Illuminate\Http\Request;
use App\Models\CountryCode;
use App\Models\Product;
use App\Models\Barcode;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Log;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Dompdf\Dompdf;
use Dompdf\Options;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;

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
        $barcodes = Product::all();
        $bar=Barcode::all();

        return view('barcodes', compact('barcodes', 'bar'));
    }

    public function GenerateBarcode(Request $request)
    {
        // Retrieve the product information based on the selected product ID
        $product = Product::find($request->id);

        if ($product) {
            // Check if a barcode already exists for the product
            $existingBarcode = Barcode::where('productCode', $product->productCode)->first();

            if ($existingBarcode) {
                // Return the existing barcode
                return response()->json(['barcodeId already exists' => $existingBarcode->barcodeId]);
            } else {
                // Generate a random last digit
                $lastDigit = mt_rand(0, 9);

                // Concatenate country code, company code, product code, and the random last digit
                $barcodeId = $product->countryCode . 12 . $product->productCode . $lastDigit;

                // Ensure the length of the barcodeId is 11 digits
                if (strlen($barcodeId) < 11) {
                    $barcodeId = str_pad($barcodeId, 11, '0', STR_PAD_RIGHT);
                } elseif (strlen($barcodeId) > 11) {
                    $barcodeId = substr($barcodeId, 0, 11); // Trim excess characters
                }

                // Store the generated barcode
                $barcode = new Barcode();
                $barcode->countryCode = $product->countryCode;
                $barcode->productCode = $product->productCode;
                $barcode->companyCode = 12;
                $barcode->lastDigit = $lastDigit;
                $barcode->barcodeId = $barcodeId;
                $barcode->save(); // Store in database

                // Return the generated barcodeId
                return response()->json(['barcodeId' => $barcodeId]);
            }
        } else {
            // Handle case where product is not found
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    // Controller
//    public function generateBarcodeImage(Request $request, $barcodeId)
//    {
//        // Generate barcode image
//        $barcode = new DNS1D();
//        $barcode->setStorPath(public_path('barcodes')); // Set storage path
//        $barcodeImage = $barcode->getBarcodePNG($barcodeId, 'C128');
//
//        // Return view with barcode image
//        return view('generatedBarcodes', ['barcodeImage' => $barcodeImage, 'barcodeId' => $barcodeId]);
//    }

    public function generateBarcodeImage(Request $request, $barcodeId)
    {
        // Check if the barcode already exists
        $existingBarcode = GeneratedBarcode::where('barcodeId', $barcodeId)->first();

        // If the barcode already exists, return without saving
        if ($existingBarcode) {
            // Optionally, you can return a response indicating that the barcode already exists
            return redirect()->back()->with('error', 'Barcode already generated for this product code.');
        }

        // Get the barcode details
        $barcodeDetails = Barcode::where('barcodeId', $barcodeId)->firstOrFail();

        // Create an instance of BarcodeGeneratorPNG
        $generatorPNG = new BarcodeGeneratorPNG();

        // Generate the barcode image in PNG format
        $barcodeImage = $generatorPNG->getBarcode($barcodeId, $generatorPNG::TYPE_EAN_8);

        // Save the barcode image to the disk
        $filename = time() . '_' . $barcodeId . '.png';
        $imagePath = public_path('barcodes/' . $filename);
        file_put_contents($imagePath, $barcodeImage);

        // Save the barcode to the generatedBarcodes table
        $generatedBarcode = new GeneratedBarcode();
        $generatedBarcode->barcodeId = $barcodeId;
        $generatedBarcode->image = $filename;
        $generatedBarcode->productCode = $barcodeDetails->productCode;
        $generatedBarcode->countryCode = $barcodeDetails->countryCode;
        $generatedBarcode->companyCode = $barcodeDetails->companyCode;
        $generatedBarcode->save();

        // Return view with barcode image
        return redirect()->back()->with('success', 'Barcode generated successfully.');
    }

    public function ShowgeneratedBarcodes()
    {
        $Showgenerated = GeneratedBarcode::all();

        //$barcodeImagePath = $this->generateBarcodeImage($request, $barcodeId);

        return view('generatedBarcodes', compact('Showgenerated'));
    }



    public function generateReceiptsPdf(Request $request, $barcodeId)
    {
        $barcode = GeneratedBarcode::where('barcodeId', $barcodeId)->first();

       // return response()->json();

        // Load the PDF view and pass the barcode data to it
        $pdf = \PDF::loadView('receipt', compact('barcode'));
        // Stream the PDF
        return $pdf->stream('receipt.pdf');
    }














}
