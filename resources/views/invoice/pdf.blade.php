<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $session->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
        }
        .invoice-details {
            margin-top: 20px;
            font-size: 1.2em;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details table, th, td {
            border: 1px solid black;
        }
        .invoice-details th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="invoice-header">
        <h1>Invoice #{{ $session->id }}</h1>
        <p>Payment Date: {{ now()->toFormattedDateString() }}</p>
    </div>

    <div class="invoice-details">
        <table>
            <tr>
                <th>Product</th>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <th>Amount Paid</th>
                <td>${{ number_format($product->price, 2) }}</td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td>{{ $session->payment_status }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
