<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        if(session()->has("basket")){
            $products = Product::with(['author', 'size'])->whereIn('id_product', session()->get('basket'))->get();
            $totalPrice = $products->sum('price');
        }
        return view('cart', ['products' => $products ?? null, 'totalPrice' => $totalPrice ?? 0]);
    }

    public function addToCart(Request $request){
        if(Auth::check()) {
            session()->push("basket", $request->id_product);
            $add = 1;
        }
        return response()->json(['add' => $add]);
    }

    public function removeFromCart(Request $request){
        $basket = session()->get("basket");

        unset($basket[array_search($request->id_product, $basket)]);

        if(empty($basket)) {
            session()->forget("basket");
        }else {
            session(["basket" => $basket]);
            $newTotalPrice = $request->totalPrice - $request->currentPrice;
        }

        return response()->json(["basket" => session()->get("basket"),"totalPrice" => $newTotalPrice ?? 0]);

    }

}
