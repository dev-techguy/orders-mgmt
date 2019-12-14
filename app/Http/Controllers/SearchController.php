<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Order $order, Request $request)
    {
        $q = $request->get('q');

        $results = $order->whereIn('product_id', function ($query) use ($q) {
            return $query->select('id')->from('products')->where('name', 'LIKE', "%$q%");
        })->orWhereIn('user_id', function ($query) use ($q) {
            return $query->select('id')->from('users')->where('name', 'LIKE', "%$q%");
        })->with('user:id,name', 'product:id,name')->orderBy('created_at', 'DESC')->paginate(10);

        return $this->successJson($results);
    }
}
