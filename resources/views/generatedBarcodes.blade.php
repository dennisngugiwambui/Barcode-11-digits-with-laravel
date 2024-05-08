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

    <table class="mt-3 table table-dark table-striped-columns">
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
                <td>
                    <img src="{{ asset('barcodes/' . $bar->image) }}" alt="Barcode Image" width="150">
                </td>
                <td>

                        <button type="submit" class="btn btn-secondary"><i class="fa fa-eye"></i> Print</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
