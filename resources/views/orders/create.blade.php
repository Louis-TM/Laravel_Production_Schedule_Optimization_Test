<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Production Scheduler and Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="card">
        <h2 class="card-header">Create New Order</h2>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="/orders">
                @csrf
                <div class="row">
                    <div class="row">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    </div>
                    
                    <div class="col-md-4">
                            <label for="product_type_id" class="form-label">Product Type</label>
                            <select class="form-select" id="product_type_id" name="product_type_id" required>
                                <option value="">Select Product Type...</option>
                                @foreach(\App\Models\ProductType::all() as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_name }} ({{ $type->production_speed }} units/hr)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="need_by" class="form-label">Need By Date</label>
                            <input type="datetime-local" class="form-control" id="needBy" name="need_by" required>
                        </div>
                </div>
                <div class="col-md-4">
                    <label for="product_id" class="form-label">Product</label>
                    <select
                        class="form-select"
                        id="product_id"
                        name="items[0][product_id]"
                        required
                    >
                        <option value="">Select Product...</option>
                        @foreach(\App\Models\Product::all() as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input
                        type="number"
                        class="form-control"
                        id="quantity"
                        name="items[0][quantity]"
                        min="1"
                        required
                    >
                </div>
                
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    
</body>
</html>

<script>
    let itemIndex = 1;

    document.getElementById('add-item').addEventListener('click', () => {
        const container = document.getElementById('items-container');
        const row = container.querySelector('.item-row').cloneNode(true);

        row.querySelectorAll('input, select').forEach(field => {
            field.name = field.name.replace(/\[\d+\]/, `[${itemIndex}]`);
            field.value = '';
        });

        container.appendChild(row);
        itemIndex++;
    });

    document.getElementById('items-container').addEventListener('click', (event) => {
        if (!event.target.classList.contains('remove-item')) return;

        const container = document.getElementById('items-container');

        if (container.querySelectorAll('.item-row').length > 1) {
            event.target.closest('.item-row').remove();
        }
    });
</script>