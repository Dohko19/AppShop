<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = Product::find($id);
        $images = $product->images()->orderBy('featured','DESC')->get();
        return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $file = $request->file('photo');
        $path = public_path() . '/images/products';
        $fileName = uniqid() . $file->getClientOriginalName();
        Image::make($request->file('photo'))
        ->resize(250, 250)
        ->save(public_path() . '/images/products/' . $fileName);
        $moved = $file->move($path, $fileName);
        if ($moved)
        {
        $productImage = new ProductImage;
        $productImage->image = $fileName;
        // $productImage->featured = false;
        $productImage->product_id = $id;
        $productImage->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $productImage = ProductImage::find($request->image_id);
        if(substr($productImage->image, 0, 4) === "http")
        {
            $deleted = true;
        }
        else
        {
        $fullPath = public_path() . '/images/products/' . $productImage->image;
        $deleted = File::delete($fullPath);
        }
        if ($deleted)
        {
            $productImage->delete();
        }
        return back();
    }

    public function select($id, $image)
    {
        ProductImage::where('product_id', $id)->update([
            'featured' => false,
        ]);
        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();
        return back();
    }
}
