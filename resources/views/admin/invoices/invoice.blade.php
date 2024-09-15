<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .invoice-header,
        .invoice-footer {
            text-align: center;
        }

        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .invoice-items th,
        .invoice-items td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .invoice-items th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <p>Order ID: {{ $order->id }}</p>
        </div>
        <div class="invoice-body">
            <h2>User Details</h2>
            <p>Name: {{ $order->user->name }}</p>
            <p>Email: {{ $order->user->email }}</p>
            <h2>Order Details</h2>
            <table class="invoice-items">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h2>Total Amount: ${{ number_format($order->total_amount, 2) }}</h2>
        </div>
        <div class="invoice-footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>

</html>
