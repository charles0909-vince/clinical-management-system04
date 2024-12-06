<!DOCTYPE html>
<html>
<head>
    <title>Bill #{{ $bill->id }}</title>
    <style>
      
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .bill-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Invoice</h1>
        <p>Bill #{{ $bill->id }}</p>
    </div>

    <div class="bill-info">
        <p><strong>Patient:</strong> {{ $bill->patient->full_name }}</p>
        <p><strong>Date:</strong> {{ $bill->bill_date->format('M d, Y') }}</p>
        <p><strong>Due Date:</strong> {{ $bill->due_date->format('M d, Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bill->items as $item)
                <tr>
                    <td>{{ $item['description'] }}</td>
                    <td>${{ number_format($item['amount'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Subtotal:</strong> ${{ number_format($bill->subtotal, 2) }}</p>
        <p><strong>Tax:</strong> ${{ number_format($bill->tax, 2) }}</p>
        <p><strong>Discount:</strong> ${{ number_format($bill->discount, 2) }}</p>
        <p><strong>Total:</strong> ${{ number_format($bill->total, 2) }}</p>
    </div>
</body>
</html>