<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\Contact;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function welcome()
    {
        $categories = Category::has('products')->get();

        return view('welcome')->with(compact('categories'));
    }

    public function categoriesShow()
    {
        $categories = Category::all();
        if (request()->wantsJson())
        {
            return $categories;
        }
    }

    public function spa()
    {
        return view('spa');
    }

    public function contact(Request $request)
    {
        if (request()->wantsJson())
        {
            $name = $request->name;
            $email = $request->email;
            $message = $request->message;
            Mail::to(['danielkage9@gmail.com'])->send(new Contact($name, $email, $message));
        }
    }
}
