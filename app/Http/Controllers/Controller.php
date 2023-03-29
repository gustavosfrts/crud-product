<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Server(url="http://localhost:8000/api")
 * @OA\Info (title="API Produtos", version="1.0")
 * @OA\PathItem (path="http://localhost:8000/api")
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     securityScheme="bearerAuth",
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @OA\Post (
     *     path="/login",
     *     description="Login",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property (property="email", type="string", example="gustavo@email.com"),
     *              @OA\Property (property="password", type="string", example="123456"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     * )
     */
    public function login(Request $request) {
        $user = auth('api')->attempt(['email' => $request->email, 'password' => $request->password]);
        if($user){
            return response()->json(['bearer' => $user], 200);
        }
        return response()->json(['error' => 'Wrong email or password. Try again.'], 400);
    }
}
