<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private Produto $Produto;
    public function __construct()
    {
        $this->Produto = new Produto();
    }

    /**
     * @OA\Post (
     *     path="/product/list",
     *     description="List all products",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property (property="filtro", type="string", example=null),
     *              @OA\Property (property="order", type="string", example="asc"),
     *              @OA\Property (property="orderCampo", type="string", example=null),
     *              @OA\Property (property="quantPagina", type="integer", example=20),
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     * )
     */
    public function showAllProducts(Request $request){
        return $this->Produto->showAll($request);
    }

    /**
     * @OA\Get (
     *     path="/product/list/{id}",
     *     description="List a single product with his respective id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter (
     *          description="Product id",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema (
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     * )
     */
    public function showOneProduto($id)
    {
        return $this->Produto->showOne($id);
    }

     /**
     * @OA\Post (
     *     path="/product/create",
     *     description="Create a new product",
     *     security={{"bearerAuth": {}}},
      *     @OA\RequestBody(
      *          required=true,
      *          @OA\JsonContent(
      *              type="object",
      *              @OA\Property (property="quantidade", type="integer", example=5),
      *              @OA\Property (property="valorUnitario", type="integer", example=9800),
      *              @OA\Property (property="nomeProduto", type="string", example="Relógio"),
      *          )
      *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     * )
     */
    public function createProduct(Request $request)
    {
        return $this->Produto->cadastro($request);
    }

     /**
     * @OA\Put (
     *     path="/product/update/{id}",
     *     description="Update an existent product",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter (
     *          description="Product id",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema (
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property (property="quantidade", type="integer", example=5),
     *              @OA\Property (property="valorUnitario", type="integer", example=9800),
     *              @OA\Property (property="nomeProduto", type="string", example="Relógio"),
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     * )
     */
    public function updateProduct(Request $request, $id){
        return $this->Produto->atualizar($request, $id);
    }

     /**
     * @OA\Delete (
     *     path="/product/delete/{id}",
     *     description="Delete an existent product",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter (
     *          description="Product id",
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema (
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     * )
     */
    public function deleteProduct($id)
    {
        return $this->Produto->deletar($id);
    }
}
