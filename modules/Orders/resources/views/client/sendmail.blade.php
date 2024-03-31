<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn thanh toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .invoice-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            color: #333;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-items {
            border-collapse: collapse;
            width: 100%;
        }

        .invoice-items th,
        .invoice-items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-items th {
            background-color: #f2f2f2;
        }

        .total-row {
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="invoice-container">
    <div class="invoice-header">
        <h1>Hóa đơn thanh toán mua khóa học tại Dreams LMS</h1>
    </div>
    <div class="invoice-details">
        <p><strong>Khách hàng:</strong> {{$user['name']}}</p>
        <p><strong>Email:</strong> {{$user['email']}}</p>
    </div>
    <table class="invoice-items">
        <thead>
        <tr>
            <th>Mã hóa đơn</th>
            <th>Khóa học</th>
            <th>Giá khóa học</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($listCart[0]['teacher_id']))
            @foreach($listCart as $cart)
                <tr>
                    <td>#{{ $cart['id'] }}</td>
                    <td>{{ $cart['name'] }}</td>
                    <td>{{ checkSalePrice( $cart['price'], $cart['sale_price']) }}</td>
                </tr>
            @endforeach
        @else
            @foreach($listCart as $cart)
                <tr>
                    <td>#{{ $cart['id'] }}</td>
                    <td>{{ $cart['name'] }}</td>
                    <td>{{ formatCurrency(checkSalePrice($cart['price'],$cart['attributes']['sale_price'])) }}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
        <tr class="total-row">
            <td colspan="2">Tổng cộng</td>
            @if(isset($listCart[0]['teacher_id']))
                <td>{{ formatCurrency(checkSalePrice($listCart[0]['price'],$listCart[0]['sale_price'])) }}</td>
            @else
                <td>{{ formatCurrency(sumCart($listCart)) }}</td>
            @endif
        </tr>
        </tfoot>
    </table>
</div>
</body>

</html>
