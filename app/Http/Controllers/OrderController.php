<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
  public function index()
  {
    $orders = Order::with('items')->get();
    return response()->json($orders);
  }

  public function store(StoreOrderRequest $request)
  {
    $order = null;

    DB::transaction(function () use ($request, &$order) {
      $order = Order::create($request->only([
        'customer_id',
        'company_id',
        'status',
        'total',
        'order_date'
      ]));

      foreach ($request->items as $item) {
        OrderItem::create([
          'order_id' => $order->id,
          'product_id' => $item['product_id'],
          'quantity' => $item['quantity'],
          'unit_price' => $item['unit_price']
        ]);
      }
    });

    if ($order === null) {
      return response()->json(['error' => 'Failed to create order'], 500);
    }

    $order->load('items');

    return response()->json($order, 201);
  }

  public function show($id)
  {
    $order = Order::with('items')->findOrFail($id);
    return response()->json($order);
  }

  public function update(Request $request, $id)
  {
    // Implement update logic as needed
  }

  public function destroy($id)
  {
    // Implement delete logic as needed
  }
}
