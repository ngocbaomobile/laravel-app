<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\SaveProductRequest;
use Illuminate\Routing\Controller;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at')->paginate(3);
        // dd($products);
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(SaveProductRequest $request)
    {
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

        $product = Product::create($request->validated());

        return redirect()->route('products.show', $product)->with('status', 'Product created successfully');
    }

    public function showProduct(Product $product)
    {
        // check error and redirect to notfound page
        // if (Product::where('id',$product->id)->doesntExist()) {
        //     return redirect()->route('products.notfound');
        // }
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'))->with('status', 'product edit successfully');
    }

    public function notfoundView()
    {
        return view('products.notfound');
    }

    public function update(SaveProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.show', $product)->with('status', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Product deleted successfully');
    }

    public function getLargeProducts(Request $request)
    {
        // get minSize
        $size = $request->query('minSize', 10);
        // query product with size greater than 100
        $products = Product::where('size', '>=', $size)->get();
        if ($products->isEmpty()) {
            return response()->json(
                [
                    'data' => [],
                    'status' => 200,
                    'message' => "No products found with size greater than $size",
                ],
                200,
            );
        }
        return response()->json([
            'status' => 200,
            'message' => "Products found with size greater than $size. Hehehe",
            'data' => $products,
        ]);
    }
}
