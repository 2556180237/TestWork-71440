<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_notes()
    {
        $body = [
            'email' => 'foo.bar@example.com',
            'password' => 'abcd'
        ];
        $auth = $this->json('POST','/api/login',$body,['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['data'=> ['token', 'name'], 'success', 'message']);
        $json = $auth->getContent();

        $array = json_decode($json, true);

        $result = $this->json('GET', '/api/notes', [], ['Accept' => 'application/json', 'Authorization' => 'Bearer '. $array['data']['token']])
            ->assertStatus(200);

        print_r($result->getContent());

    }
}
