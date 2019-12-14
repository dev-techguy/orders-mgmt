<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Order $order)
    {
        $orders = $order->with('user:id,name', 'product:id,name')
            ->orderBy('id', 'DESC')->paginate('10');
        return $this->successJson($orders);
    }

    public function store(Order $order, Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required'
        ]);

        $payload = $request->only(['user_id', 'product_id', 'quantity']);
        $createdOrder = $order->make($payload);
        return $this->successJson($createdOrder);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return $this->successJson();
    }
}
