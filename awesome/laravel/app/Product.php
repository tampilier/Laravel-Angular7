<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function createProduct($name, $price, $amount, $userID)
    {
        $product = new Product();
        $product->name = $name;
        $product->price = $price;
        $product->amount = $amount;
        $product->created_by = $userID;
        $product->save();

        return $product;
    }

    public static function updateProduct($product, $name, $price, $amount)
    {
        $product->name = $name;
        $product->price = $price;
        $product->amount = $amount;
        $product->save();

        return $product;
    }

    public static function getProductById($id)
    {
        return Product::where('id', $id)->first();
    }
}
