<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt with Barcode</title>
    <!-- Add any additional styling or meta tags here -->
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .barcode-container {
            width: 25.93mm;
            height: 37.29mm;
            margin: 0 auto;
            text-align: center;
        }
        .barcode-image {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
<div class="barcode-container">
    <!-- If you're using a blade directive to generate the barcode image -->
    {!! DNS1D::getBarcodeHTML($barcodeId, 'PHARMA', 2.5, 40) !!}
</div>
</body>
</html>
