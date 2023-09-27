<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Traits\AuthenticateTrait;

class ProdutoControllerTest extends TestCase
{
    private static string $token;
    private static array $headers;

    public function setUp(): void
    {
        parent::setUp();
        self::$token = AuthenticateTrait::login();

        self::$headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . self::$token,
        ];
    }
    /**
     * A basic feature test example.
     */
    public function test_listar_todos_produtos(): void
    {
        $response = $this->json('POST', '/api/product/list', [], self::$headers);
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'current_page',
                    'data',
                    'first_page_url',
                    'last_page',
                    'last_page_url'
                ]);
    }

    public function test_criar_produto_valido(): void
    {
        $response = $this->json('POST', '/api/product/create', [
            'nomeProduto' => 'Produto Teste',
            'valorUnitario' => 10.00,
            'quantidade' => 10
        ], self::$headers);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'message'
                ]);
    }

    public function test_criar_produto_invalido(): void
    {
        $response = $this->json('POST', '/api/product/create', [
            'nomeProduto' => 'Produto Teste',
            'valorUnitario' => 10.00
        ], self::$headers);
        
        $response->assertStatus(400);
    }

    public function test_listar_produto_existe(): void
    {
        $response = $this->json('GET', '/api/product/list/1', [], self::$headers);
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'id',
                    'nomeProduto',
                    'valorUnitario',
                    'quantidade'
                ]);
    }

    public function test_listar_produto_nao_existe(): void
    {
        $response = $this->json('GET', '/api/product/list/2', [], self::$headers);
        
        $response->assertStatus(404)
                ->assertJsonStructure([
                    'Error'
                ]);
    }

    public function test_atualizar_produto_valido(): void
    {
        $response = $this->json('PUT', '/api/product/update/1', [
            'nomeProduto' => 'Produto Teste',
            'valorUnitario' => 10.00,
            'quantidade' => 10
        ], self::$headers);
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'message'
                ]);
    }

    public function test_atualizar_produto_invalido(): void
    {
        $response = $this->json('PUT', '/api/product/update/100', [
            'nomeProduto' => 'Produto Teste',
            'valorUnitario' => 10.00,
            'quantidade' => 10
        ], self::$headers);
        
        $response->assertStatus(400)
                ->assertJsonStructure([
                    'message',
                    'error'
                ]);
    }

    public function test_deletar_produto_valido(): void
    {
        $response = $this->json('DELETE', '/api/product/delete/1', [], self::$headers);
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'message'
                ]);
    }

    public function test_deletar_produto_invalido(): void
    {
        $response = $this->json('DELETE', '/api/product/delete/1', [], self::$headers);
        
        $response->assertStatus(400)
                ->assertJsonStructure([
                    'message'
                ]);
    }
}
