<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(User::getUserByToken($request->header('x-access-token')))
        {
            return response()->json(Product::all(), 200);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::getUserByToken($request->header('x-access-token'));

        if($user)
        {
            return response()->json(Product::createProduct(
                $request->post('name'),
                $request->post('price'),
                $request->post('amount'),
                $user->id
            ), 200);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::getUserByToken($request->header('x-access-token'));

        if($user)
        {
            $product = Product::getProductById($id);

            if(!$product || $product->created_by !== $user->id)
            {
                return response()->json(['error' => 'productID'], 400);
            }

            return response()->json($product, 200);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::getUserByToken($request->header('x-access-token'));

        if($user)
        {
            $product = Product::getProductById($id);

            if(!$product || $product->created_by !== $user->id)
            {
                return response()->json(['error' => 'productID'], 400);
            }

            return response()->json(Product::updateProduct(
                $product,
                $request->header('name'),
                $request->header('price'),
                $request->header('amount')
            ), 200);
        }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }
}
