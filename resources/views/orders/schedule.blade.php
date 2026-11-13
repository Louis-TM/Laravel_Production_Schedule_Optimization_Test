<!DOCTYPE html>
<html>
<head>
    <title>Production Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2>Production Schedule</h2>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Product Type</th>
                <th>Quantity</th>
                <th>Need By</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->productType->type_name }}</td>
                    <td>{{ $order->items->sum('quantity') }}</td>
                    <td>{{ $order->need_by }}</td>
                    <td>{{ $order->scheduled_start_time }}</td>
                    <td>{{ $order->scheduled_end_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/orders/create" class="btn btn-primary">
        Create New Order
    </a>

</body>
</html>