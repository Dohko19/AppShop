<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index')->with(compact('categories')); //listado de productos
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, Category::$rules, Category::$messages);
        // dd($request->all());
        $category = Category::create($request->only('name', 'description')); // mass assigment
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

//            $thumbnail = public_path('storage/images/categories/'.$fileName);
//            $img = Image::make($thumbnail)->resize(250, 250)->save($thumbnail);
//        Image::make($image)
                    $category->image = $file->storeAs('public/images/categories', $fileName);
                    // $productImage->featured = false;
                    $category->save();
        }
        return redirect('/admin/categories');
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
    public function edit(Category $category)
    {
        // $category = Category::find($id);
        return view('admin.categories.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {

        $this->validate($request, Category::$rules, Category::$messages);
        $category->update($request->only('name', 'description'));
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $fileName = uniqid() . '-' . $file->getClientOriginalName();

//            $thumbnail = public_path('storage/images/categories/'.$fileName);
//            $img = Image::make($thumbnail)->resize(250, 250)->save($thumbnail);

                    $previusPath = $category->image;
                    $category->image = $file->storeAs('public/images/categories', $fileName);
                    // $productImage->featured = false;
                    $saved = $category->save();
                    if ($saved) {
                        \Storage::delete('public/images/categories/'.$previusPath);
//                    File::delete($previousPath);
                    }
                }

        return redirect("/admin/categories");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        \Storage::delete('public/images/categories/'.$category->image);
        $category->delete();
        return back();
    }
}
