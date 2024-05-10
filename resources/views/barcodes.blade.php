<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Barcode</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 5%;
        }
        select.select2 {
            width: 500px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Generate Barcode</h2>
    <form action="{{ route('GenerateBarcode') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="productName">Product Name:</label>
            <select id="productName" name="id" class="select2 form-control">
                @foreach($barcodes as $barcode)
                    <option value="{{ $barcode->id }}">{{ $barcode->productName }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generate Barcode</button>
    </form>

    <h2 class="mt-5">Barcode Details</h2>
    <table class="mt-3 table table-dark table-striped-columns">
        <thead>
        <tr>
            <th>Country Code</th>
            <th>Company Code</th>
            <th>Product Code</th>
            <th>Last Digit</th>
            <th>Barcode ID</th>
            <th>Barcode Image</th>
            <th>Generate</th>
            <th>Print</th> <!-- Added column for printing -->
        </tr>
        </thead>
        <tbody>
        @foreach($bar as $bar)
            <tr>
                <td>{{ $bar->countryCode }}</td>
                <td>{{ $bar->companyCode }}</td>
                <td>{{ $bar->productCode }}</td>
                <td>{{ $bar->lastDigit }}</td>
                <td>{{ $bar->barcodeId }}</td>
                <td>@if (isset($barcodeImage) && $bar->barcodeId == $barcodeId)
                        <img src="data:image/png;base64,{{ base64_encode($barcodeImage) }}" alt="Barcode Image" style="max-width: 200px;">
                    @endif
                </td>
                <td>
                    <form action="{{ route('generate.barcode', ['barcodeId' => $bar->barcodeId]) }}" method="post">
                        @csrf
                        <button type="submit" class=" btn btn-secondary"><i class="fa fa-eye"></i> Generate</button>
                    </form>
                </td>
                <td>
                    <button onclick="printBarcode('{{ $bar->barcodeId }}')" class="btn btn-secondary"><i class="fa fa-print"></i> Print</button>
                </td> <!-- Added button for printing -->
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="/">Return home</a>

    <a href="/ShowgeneratedBarcodes">See Generated Barcodes</a>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();


    function printBarcode(barcodeId) {
        var barcodeImage = document.querySelector('img[src^="data:image/png;base64"]');
        if (barcodeImage) {
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Barcode Print</title></head><body>');
            printWindow.document.write('<img src="' + barcodeImage.src + '" style="max-width: 100%;">');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    }
</script>
</body>
</html>
