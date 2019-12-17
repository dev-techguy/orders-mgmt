<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;

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
