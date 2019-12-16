<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\OrderContract;
use App\Order;
use App\Traits\Timestamp;

class OrderRepository implements OrderContract
{
    use Timestamp;

    private $model;

    public function __construct()
    {
        $this->model = new Order();
        return $this;
    }
    public function inPeriod(String $period)
    {
        if ($period && $period != 'all') {
            [$from, $to] = $this->getTimestamps($period);
            $this->model = $this->model->whereBetween('created_at', [$from, $to]);
        }
        return $this;
    }

    public function orderBy(String $field, String $order = 'asc')
    {
        $this->model = $this->model->orderBy($field, $order);
        return $this;
    }

    public function paginate(int $count = 15)
    {
        return $this->model->paginate($count);
    }

    public function withRelations(String ...$args)
    {
        $this->model = $this->model->with($args);
        return $this;
    }

    public function make($request)
    {
        return $this->model->make($request);
    }

    public function findById($id)
    {
        $this->model = $this->model->find($id);
        return $this;
    }

    public function update($quantity)
    {
        return $this->model->updateRecord($quantity);
    }

    public function delete()
    {
        return $this->model->delete();
    }

    public function get()
    {
        return $this->model->get();
    }

    public function searchFor($string)
    {
        $this->model = $this->model->whereIn('product_id', function ($query) use ($string) {
            return $query->select('id')->from('products')->where('name', 'LIKE', "%$string%");
        })->orWhereIn('user_id', function ($query) use ($string) {
            return $query->select('id')->from('users')->where('name', 'LIKE', "%$string%");
        });

        return $this;
    }
}
