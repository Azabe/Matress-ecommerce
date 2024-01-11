<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>MOST ORDERED PRODUCTS REPORT</title>
</head>
<style>

    @page {
        width: 100%;
        background-color: #ede837;
        font-family: 'Poppins', sans-serif;
    }

    .zui-table {
        border: solid 1px #DDEEEE;
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        font: normal 14px Arial, sans-serif;
    }


    .zui-table thead th {
        background-color: #ede837;
        border: solid 1px #DDEEEE;
        color: #00adef;
        padding: 14px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
    }


    .zui-table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 14px;
        text-shadow: 1px 1px 1px #fff;
    }
    .reports-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between
    }
    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 16px 0;
        text-align: center

    }
    footer span {
        color: black;
        text-align: center;
        width: 100%;
        font-size: 10px;
    }
</style>

<body>
    <div class="reports-header">
        <img src="https://dodoma-logo.s3.eu-north-1.amazonaws.com/logo.png" alt="" width="40%">
        <p style="float: right; font-size: 10px">Generated on <?php echo date('Y-m-d')?></p>
    </div>
    <div>
        <h2 style="text-align: center">MOST ORDERED PRODUCTS REPORT</h2>
        <p style="text-align: center;margin-top:-16px; font-size: 10px;">
            Report Period: {{ $startDate }} to {{ $endDate }}
        </p>
    </div>
    <table class="zui-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Total Products</th>
            <th>Percentage</th>
        </tr>
    </thead>
    <tbody>
        @php
            $counter = 1;
            $totalQuantity = 0;
            foreach ($tableData as $row) {
                $totalQuantity += $row['total_ordered_quantity'];
            }
        @endphp

        @foreach ($tableData as $row)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $row['title'] }}</td>
                <td>{{ $row['total_ordered_quantity'] }}</td>
                <td>
                    {{ number_format(($row['total_ordered_quantity'] / $totalQuantity) * 100, 2) }}%
                </td>
            </tr>
        @endforeach
        <tr>
            
        <td colspan="3"><strong>Total Quantity</strong></td>
            <td><strong>{{ $totalQuantity }}</strong></td>
        
        </tr>
    </tbody>
</table>
<footer>
    <span>&copy; Matelas Dodoma {{ date('Y') }}</span>
</footer>
</body>
</html>