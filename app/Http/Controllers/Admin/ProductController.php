<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products')); //listado de productos
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories')); //formulario de registro
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //registrar nuevo Producto
        // dd($request->all());
        $messages = [
            'name.required' => 'Es necesario Ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripcion',
            'description.max' => 'No debe de exeder los 200 caracteres',
            'price.min' => 'El precio debe ser igual o mayor a 0',
            'price.required' => 'El campo Precio no debe estar vacio',
            'price.numeric' => 'Solo se admiten valores de tipo numerico (1,2,3,etc)',
        ];
        $rules = [
            'name' =>'required|min:3',
            'description' =>'required|max:200',
            'price' =>'required|numeric|min:0',
        ];
        $this->validate($request, $rules, $messages);
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id == 0 ? null : $request->category_id;
        $product->active = $request->active;
        $product->save();

        return redirect("/admin/products");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
            $messages = [
            'name.required' => 'Es necesario Ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'Es necesario ingresar una descripcion',
            'description.max' => 'No debe de exeder los 200 caracteres',
            'price.min' => 'El precio debe ser igual o mayor a 0',
            'price.required' => 'El campo Precio no debe estar vacio',
            'price.numeric' => 'Solo se admiten valores de tipo numerico (1,2,3,etc)',
        ];
        $rules = [
            'name' =>'required|min:3',
            'description' =>'required|max:200',
            'price' =>'required|numeric|min:0',
        ];
         // dd($request->active);

        $this->validate($request, $rules, $messages);
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id == 0 ? null : $request->category_id;
        $product->active = $request->active == null ? 0 : $request->active;

        $product->save(); //Update

        return redirect("/admin/products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back();
    }
}
