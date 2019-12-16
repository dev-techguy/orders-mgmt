<?php

namespace App\Http\Controllers;

use App\Contracts\Eloquent\UserContract;

class UsersController extends Controller
{
    public function index(UserContract $user)
    {
        $users = $user->limit(10)->select('id', 'name')->get();
        return $this->successJson($users);
    }
}
