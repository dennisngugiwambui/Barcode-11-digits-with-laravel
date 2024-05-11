<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt with Barcode</title>
    <!-- Add any additional styling or meta tags here -->
    <style>

    </style>
</head>
<body>
<div class="barcode-container">
    <!-- Display the barcode image as a Data URI -->
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('barcodes/' . $barcode->image))) }}" class="barcode-image" alt="Barcode Image">

    {{--    {!! DNS1D::getBarcodeHTML($barcode->barcodeId, 'PHARMA', 2.5, 40) !!}--}}
    <div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center; font-size: 12px;">
        {{ $barcode->barcodeId }}
    </div>
</div>
</body>
</html>
