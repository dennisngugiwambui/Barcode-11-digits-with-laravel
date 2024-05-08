<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Barcode</title>
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
    <table class="table mt-3">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Country Code</th>
            <th>Company Code</th>
            <th>Product Code</th>
            <th>Last Digit</th>
            <th>Barcode ID</th>
        </tr>
        </thead>
        <tbody>
        @foreach($barcodes as $barcode)
            <tr>
                <td>{{ $barcode->productName }}</td>
                <td>{{ $barcode->countryCode }}</td>
                <td>{{ $barcode->companyCode }}</td>
                <td>{{ $barcode->productCode }}</td>
                <td>{{ $barcode->lastDigit }}</td>
                <td>{{ $barcode->barcodeId }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
</body>
</html>
