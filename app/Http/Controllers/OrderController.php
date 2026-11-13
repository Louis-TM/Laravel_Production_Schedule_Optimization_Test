<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductType;

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
        $validateData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_type_id' => 'required|exists:product_types,id',
            'need_by' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);
    }

}
