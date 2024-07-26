<?php

namespace Tests\Unit\Model;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testUserCreate()
    {
        # prepare
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john_doe@todolist.com',
            'password' => '12341234'
        ];

        # execute
        $user = User::create($data);

        # assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John', $user->first_name);
        $this->assertEquals('Doe', $user->last_name);
        $this->assertEquals('john_doe@todolist.com', $user->email);
    }

    /**
     * Test updating a user
     *
     * @return void
     */
    public function testUpdateUser()
    {
        # prepare
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john_doe@todolist.com',
            'password' => '12341234'
        ]);

        # execute
        $user->update([
            'first_name' => 'William',
            'last_name' => 'Smith'
        ]);

        # assert
        $this->assertDatabaseHas('users', [
            'first_name' => 'William',
            'last_name' => 'Smith'
        ]);
    }

    /**
     * @return void
     */
    public function testHiddenAttributes()
    {
        # prepare
        $user = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john_doe@todolist.com',
            'password' => 'password123'
        ];

        # execute
        $user = User::create($user);
        $userArray = $user->toArray();

        # assert
        $this->assertArrayHasKey('first_name', $userArray);
        $this->assertArrayHasKey('last_name', $userArray);
        $this->assertArrayHasKey('email', $userArray);
    }
}
