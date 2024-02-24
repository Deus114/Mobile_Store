<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->paginate(5);
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
        
        $data = $request->only('content','image','priority','status');
        $imagename = $request->image->hashName();
        $data['image'] = $imagename;
        if(Banner::create($data)) {
            $request->image->move(public_path('uploads/banners'),$imagename);
            return redirect()->route('banner.index')->with('ok','Thêm mới thành công');
        }

        return redirect()->route('banner.create')->with('no','Thêm không thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif',
        ]);
        
        $data = $request->only('content','image','priority','status');
        if($request->has('image')){
            $imagename = $request->image->hashName();
            $request->image->move(public_path('uploads/banners'),$imagename);
            $data['image'] = $imagename;
        }
        if($banner->update($data)) {
            return redirect()->route('banner.index')->with('ok','Chỉnh sửa thành công');
        }

        return redirect()->route('banner.edit')->with('no','Chỉnh sửa không thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('banner.index');
    }
}
