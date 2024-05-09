<!-- generatedBarcodes.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Barcode</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Generated Barcode</h2>

    <table class="mt-3 table table-striped-columns">
        <thead>
        <tr>

            <th>Country Code</th>
            <th>Company Code</th>
            <th>Product Code</th>
            <th>Barcode ID</th>
            <th>Barcode Image</th>
            <th>Generate</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Showgenerated as $bar)
            <tr>

                <td>{{ $bar->countryCode }}</td>
                <td>{{ $bar->companyCode }}</td>
                <td>{{ $bar->productCode }}</td>
                <td>{{ $bar->barcodeId }}</td>
                <td style="position: relative; text-align: center;">
                    {!! DNS1D::getBarcodeHTML($bar->barcodeId, 'PHARMA') !!}
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center; font-size: 12px;">
                        {{$bar->barcodeId}}
                    </div>
                </td>

                <td>

                        <button type="submit" onclick="printBarcode('barcode{{$loop->index}}')" class="btn btn-secondary"><i class="fa fa-eye"></i> Print</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    function printBarcode(barcodeId) {
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Barcode Print</title></head><body>');
        printWindow.document.write(document.getElementById(barcodeId).outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
</body>
</html>
