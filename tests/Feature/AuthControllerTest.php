<?php

namespace Tests\Feature;

use App\Http\Traits\DatabaseTrait;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        DatabaseTrait::refresh();
    }
    /**
     * A basic feature test example.
     */
    public function test_login_success(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'gustavo@email.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'bearer'
                ]);
    }

    public function test_login_unsuccess(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'gustavo@email.com',
            'password' => 'senhaincorreta',
        ]);

        $response->assertStatus(400)
                ->assertJsonStructure([
                    'error'
                ]);
    }
}
