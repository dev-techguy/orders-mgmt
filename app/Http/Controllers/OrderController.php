<?php

namespace App\Http\Controllers;

use App\Order;
use App\Traits\Timestamp;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use Timestamp;

    public function index(Order $order, Request $request)
    {
        $orders = $order->with('user:id,name', 'product:id,name');
        $period = $request->get('period');

        if ($period && $period !== 'all') {
            [$from, $to] = $this->getTimestamps($request);
            $orders = $orders->whereBetween('created_at', [$from, $to]);
        }

        $orders = $orders->orderBy('created_at', 'DESC')->paginate('10');
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

    public function update(Order $order, Request $request)
    {
        $order->updateRecord($request->get('quantity'));

        return $this->successJson();
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return $this->successJson();
    }
}
