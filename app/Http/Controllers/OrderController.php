<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Order $order)
    {
        $orders = $order->paginate('10');
        return $this->successJson($orders);
    }

    public function store(Order $order, Request $request)
    {
        $payload = $request->only(['user_id', 'product_id', 'quantity']);
        $createdOrder = $order->make($payload);
        return $this->successJson($createdOrder);
    }
}
