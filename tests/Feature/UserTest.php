<?php

namespace Tests\Feature;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function can_create_a_user()
    {
        $User = factory(User::class)->make()->toArray();
        $name = $User['name'];
        $User['password'] = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // password factory
        $c = $this->post('/api/v1/user', $User)
            ->assertStatus(201)
            ->assertSee($name);
    }

    /**
     * @test
     */
    public function can_edit_user()
    {
        $User = factory(User::class)->create()->toArray();
        $User['name'] = 'User #1';
        $User['password'] = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // password factory
        $this->put(route('user.update', $User['id']), $User)
            ->assertStatus(200)
            ->assertSee('User #1');
    }

    /**
     * @test
     */
    public function User_can_be_deleted()
    {
        $User = factory(User::class)->create()->toArray();
        $this->delete(route('user.destroy', $User['id']))
            ->assertStatus(200)
            ->assertJson([]);
    }

    /**
     * @test
     */
    public function it_can_listed()
    {
        $Users = factory(User::class, 3)->create()->toArray();
        $this->get(route('user.index'))
            ->assertStatus(200)
            ->assertSee($Users[0]['name'])
            ->assertSee($Users[1]['name'])
            ->assertSee($Users[2]['name']);
    }
}
