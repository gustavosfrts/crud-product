<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Request;

trait AuthenticateTrait
{
    public static function login() : string
    {
        $request = Request::create('/api/login', 'POST', [
            'email' => 'gustavo@email.com',
            'password' => '123456',
        ]);

        $response = app()->handle($request);
        
        return json_decode($response->getContent())->bearer;
    }
}