<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(User $user)
    {
        $users = $user->limit(10)->select(['id', 'name'])->get();
        return $this->successJson($users);
    }
}
