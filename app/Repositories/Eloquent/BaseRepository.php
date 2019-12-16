<?php

namespace App\Repositories\Eloquent;

use App\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    use Timestamp;

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function limit(int $count)
    {
        $this->model = $this->model->limit($count);
        return $this;
    }

    public function select(...$args)
    {
        $this->model = $this->model->select($args);
        return $this;
    }

    public function get()
    {
        return $this->model->get();
    }
}
