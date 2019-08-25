<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::active()->get();
        $products = Product::active()->limit(9)->get();
        $slides = Slide::active()->get();
        return view('frontend.home_content',compact('categories','products','slides'));
    }
}
