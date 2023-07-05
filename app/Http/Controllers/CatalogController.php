<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use App\Models\Style;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::with('author'  )->get();
        $categories = Category::all();
        $styles = Style::all();
        $materials = Material::all();

        return view('/catalog/catalog', ['products' => $products, 'categories' => $categories, 'styles'=>$styles, 'materials' => $materials]);
    }


    public function filter(Request $request)
    {
        $products = Product::query();
        $maxPrice = Product::max('price');

        $priceFrom =$request->priceFrom ?? 0;
        $priceTo = $request->priceTo ?? $maxPrice;

        if($request->categories) {
            $products->whereIn('id_category', $request->categories);
        }

        if($request->styles) {
            $products->whereIn('id_style', $request->styles);
        }

        if($request->materials) {
            $products->whereIn('id_material', $request->materials);
        }

        $products->whereBetween('price', [$priceFrom, $priceTo]);


        return response(view('/catalog/products', ['products' => $products->get()]));
    }
}
