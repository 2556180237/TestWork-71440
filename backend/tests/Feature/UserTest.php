<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Laravel\Passport\Passport;

class UserTest extends TestCase
{

    // test example
    public function test_register()
    {
        $body = [
            'name' => 'Foo Bar',
            'email' => 'foo.bar@example.com',
            'password' => 'abcd',
            'c_password' => 'abcd'
        ];
        $result = $this->json('POST','/api/register',$body,['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['token', 'name']]);

    }

    // test example
    public function test_login(){
        $body = [
            'email' => 'foo.bar@example.com',
            'password' => 'abcd'
        ];
        $response = $this->json('POST','/api/login',$body,['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['data'=> ['token', 'name'], 'success', 'message']);
//            ->assertJson(['data'=> ['token', 'name'], 'success', 'message']);
        print_r($response->getContent());
    }
}
