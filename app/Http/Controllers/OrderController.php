<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;


class OrderController
{
    public function index() {
        $orders = Order::with(['product_type', 'items'])->get();
            
        return view('orders.index', compact('orders'));
    }

    public function create() {
        $productTypes = ProductType::all();
        $products = Product::all();

        return view('orders.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_type_id' => 'required|exists:product_types,id',
            'need_by' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($validatedData) {

            $order = Order::create([
            'customer_name' => $validatedData['customer_name'],
            'product_type_id' => $validatedData['product_type_id'],
            'need_by' => $validatedData['need_by'],
        ]);

            foreach ($validatedData['items'] as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        });
        return redirect('/orders/create')
            ->with('success', 'Order created successfully!');
    }

    public function schedule()
{
    $orders = Order::with(['items', 'productType'])
        ->orderBy('need_by')
        ->get();

    $currentTime = Carbon::now();
    $previousTypeId = null;

    foreach ($orders as $order) {
            $totalQuantity = $order->items->sum('quantity');
            $productionSpeed = $order->productType->production_speed;
            $productionMinutes = ceil(
                ($totalQuantity / $productionSpeed) * 60
            );

            if (
                $previousTypeId !== null &&
                $previousTypeId != $order->product_type_id
            ) {
                $currentTime->addMinutes(30);
            }

            $startTime = $currentTime->copy();
            $endTime = $startTime->copy()->addMinutes($productionMinutes);

            $order->scheduled_start_time = $startTime;
            $order->scheduled_end_time = $endTime;
            $order->save();

            $currentTime = $endTime->copy();
            $previousTypeId = $order->product_type_id;
        }

        return view('orders.schedule', compact('orders'));
    }

}
