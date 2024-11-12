<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // dd($products);
        return view('products.index',['products' => $products]);
    }
    
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request) {
        // $input = $request->all();
        // $name = $request->input('name');

        // create product save in original type 
        /*
        
        $product = new Product();

        $product-> name = $request->input('name');
        $product-> description = $request->input('description');
        $product-> size = $request->size;

        $product->save();
        */


        // validate data user sent here
        $request->validate([
            'name' =>  'required|max:100',
            'description' => 'nullable: min:3',
            'size' => 'required|decimal:0,2, max:100'
        ]);
        // other type short
        Product::create($request -> input());

        return redirect()->route('products.index');
    }

    public function showProduct(Product $product)
    {
        // check error and redirect to notfound page

        
    
        // if (Product::where('id',$product->id)->doesntExist()) {
        //     return redirect()->route('products.notfound');
        // }
        return view('products.show',compact('product'));
    }
    

    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    public function notfoundView()
    {
        return view('products.notfound');
    }

    public function update(Request $request, Product $product) 
    {
        
    }
}
