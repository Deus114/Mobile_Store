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
        $products = Product::orderBy('id', 'DESC')->paginate(5);
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
        
        $data = $request->only('name','price','status','content','description','category_id');
        $imagename = $request->image->hashName();
        $data['image'] = $imagename;
        if(Product::create($data)) {
            $request->image->move(public_path('uploads/products'),$imagename);
            return redirect()->route('product.index')->with('ok','Chỉnh sửa thành công');
        }

        return redirect()->route('product.create')->with('no','Chỉnh sửa thành công');
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
        $cats = Category::orderBy('id', 'DESC')->select('id', 'name')->get();
        return view('admin.product.edit', compact('cats', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:4|max:150|unique:products,name,'.$product->id,
            'price' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'category_id' => 'required'
        ]);
        
        $data = $request->only('name','price','status','content','description','category_id');
        if($request->has('image')){
            $imagename = $request->image->hashName();
            $request->image->move(public_path('uploads/products'),$imagename);
            $data['image'] = $imagename;
        }
        if($product->update($data)) {
            return redirect()->route('product.index')->with('ok','Thêm sản phẩm mới thành công');
        }

        return redirect()->route('product.create')->with('no','Thêm sản phẩm không thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
