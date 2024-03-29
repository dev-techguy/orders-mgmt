<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Contracts\UserContract;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct()
    {
        parent::__construct(new User());
    }
}
