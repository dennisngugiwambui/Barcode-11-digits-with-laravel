<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Barcode</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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

       @foreach ($Showgenerated as $bar)
        <tr>
            <td><?= $bar['countryCode'] ?></td>
            <td><?= $bar['companyCode'] ?></td>
            <td><?= $bar['productCode'] ?></td>
            <td><?= $bar['barcodeId'] ?></td>
            <td style="position: relative; text-align: center;">
{{--                <div id="barcode_<?= $bar['barcodeId'] ?>">--}}

{{--                    {!! DNS1D::getBarcodeHTML($bar->barcodeId, 'PHARMA') !!}--}}
{{--                    <div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center; font-size: 12px;">--}}
{{--                        {{$bar->barcodeId}}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </td>--}}
                <div class="barcode-container">
                    <!-- Display the barcode image -->
                    <img src="{{ asset('barcodes/' . $bar->image) }}" class="barcode-image" alt="Barcode Image">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center; font-size: 12px;">
                         {{ $bar->barcodeId }}
                    </div>
                </div>
            <td>
{{--                <button type="button" class="btn btn-secondary" onclick="printBarcode('barcode_<?= $bar['barcodeId'] ?>')">--}}
{{--                    <i class="fa fa-eye"></i> Print--}}
{{--                </button>--}}

                <a href="{{route('generateReceiptsPdf', $bar->barcodeId)}}" type="button" class="btn btn-danger" >
                    <i class="fa fa-eye"></i> Download Barcode
                </a>
            </td>


        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    function printBarcode(barcodeId, delay) {
        const barcodeContent = document.getElementById(barcodeId).innerHTML;
        setTimeout(function() {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`<html><head><title>Print Barcode</title><style>@media print { body * { display: none; } #${barcodeId} { display: block; } }</style></head><body>${barcodeContent}</body></html>`);
            printWindow.document.close();
            printWindow.print();
        }, delay);
    }
</script>

</body>
</html>
