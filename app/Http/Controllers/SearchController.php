<?php

namespace App\Http\Controllers;

use App\Contracts\Eloquent\OrderContract;
use App\Order;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $order = app(OrderContract::class);

        $results = $order->searchFor($request->get('q'))
            ->withRelations('user:id,name', 'product:id,name')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return $this->successJson($results);
    }
}
