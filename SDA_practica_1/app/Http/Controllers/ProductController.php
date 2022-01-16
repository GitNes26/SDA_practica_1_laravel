<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        if ($products->count() > 0) {
            return $products;
        }
        return response()->json(["message" => "Sin registros."],200);
    }
    public function store(Request $request) {
        try {
            $product = new Product();

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;

            if ($product->save()) {
                $response = response()->json(["message" => "Producto registrado.", "datos" => $this->index()],201);
                return $response;
            }
        } catch (\Exception $e) {
            return response()->json(["message" => "No se ha podido registrar el producto, revisa tus datos. Es posible que el nombre del articulo ya se encuentre registrado."],400);
        }
    }
}
