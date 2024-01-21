<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::orderBy('id', 'DESC')->select('id', 'name')->get();
        return view('admin.product.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:150|unique:products',
            'price' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'category_id' => 'required'
        ]);
        
        $data = $request->only('name','price','content','description','category_id');
        $imagename = $request->image->hashName();
        $data['image'] = $imagename;
        if(Product::create($data)) {
            $request->image->move(public_path('uploads/products'),$imagename);
            return redirect()->route('product.index')->with('ok','Thêm sản phẩm mới thành công');
        }

        return redirect()->route('product.create')->with('no','Thêm sản phẩm không thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
