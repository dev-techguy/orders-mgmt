<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_fecth_all_users()
    {
        $this->assertCount(0, User::all());
        factory(User::class, 2)->create();
        $response = $this->get(route('users.all'))->assertOk();
        $response->assertJsonCount(2, 'data');
    }
}
