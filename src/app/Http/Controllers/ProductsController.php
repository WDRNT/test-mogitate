<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::simplePaginate(6);
        return view('index', compact('products'));
    }

    public function search(Request $request){
        $query = Product::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->simplePaginate(6)->withQueryString();

        return view('index', compact('products'));
    }


    public function create(){
        return view('create');
    }

    public function register(ProductRequest $request){
        $path = $request->file('image')->store('products', 'public');

        $form =[
            'name' => $request->name,
            'price' => $request->price,
            'image' => $path,
            'description' => $request->description,
        ];

        $product = Product::create($form);
        $product->seasons()->sync($request->season_ids);

        return redirect('/products');
    }

        public function show($productId){
            $product = Product::with('seasons')->find($productId);
            $seasons = Season::all();

            return view('confirm', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, $productId){
        $product = Product::find($productId);

        $data = $request->only(['name', 'price', 'description']);

        // 画像が選ばれている時だけ更新
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $product->update($data);
        $product->seasons()->sync($request->input('season_ids', []));

        return redirect('/products');
}


    public function delete($productId){
        $product = Product::find($productId);
        $product->delete();

        return redirect('/products');
    }

}
