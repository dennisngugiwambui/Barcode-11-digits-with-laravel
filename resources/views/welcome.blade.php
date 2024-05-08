<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Order Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            padding: 20px;
        }

        select.select2 {
            width: 300px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Product Order Form</h2>
        <form id="order-form" action="{{ route('newProduct') }}" method="post">
            @csrf
            <div class="form-group center">
                <label for="country">Country:</label>
                <select id="country" name="countryCode" class="form-control select2">
                    @foreach ($countries as $country)
                        <option value="{{ $country->countryCode }}">{{ $country->countryName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="product">Product Name:</label>
                <input type="text" id="product" name="productName" class="form-control" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" class="form-control" min="0" step="0.01" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" min="1" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success mb-3">Add Product</button>
        </form>

        <table id="product-table" class="table table-dark">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>countryCode</th>
                    <th>Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->productName }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->countryCode }}</td>
                    <td>{{ $product->productCode }}</td>
                    <td>
                        <button class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="/barcode" >Barcode</a>
</body>

<script>
    $(document).ready(function () {
        $(".select2").select2();
    });
</script>
</html>
