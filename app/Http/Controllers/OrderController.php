<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Eloquent\OrderContract;

class OrderController extends Controller
{
    private $order;
    private $request;

    public function __construct()
    {
        $this->order = app(OrderContract::class);
        $this->request = app(Request::class);
    }

    public function index()
    {
        $orders = $this->order->withRelations(
            'user:id,name',
            'product:id,name'
        );

        if ($this->request->has('period')) {
            $orders = $orders->inPeriod($this->request->get('period'));
        }
        $orders = $orders->orderBy('created_at', 'DESC')
            ->paginate(config('product.pagination'));

        return $this->successJson($orders);
    }

    public function store()
    {
        $this->validate($this->request, [
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required'
        ]);

        $createdOrder = $this->order->make(
            $this->request->only(['user_id', 'product_id', 'quantity'])
        );
        return $this->successJson($createdOrder);
    }

    public function update($order)
    {
        $this->order->findById($order)
            ->update($this->request->get('quantity'));
        return $this->successJson();
    }

    public function destroy($order)
    {
        $this->order->findById($order)->delete();
        return $this->successJson();
    }
}
