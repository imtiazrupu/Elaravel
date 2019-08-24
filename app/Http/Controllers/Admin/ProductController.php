<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create',compact('categories'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
            'name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'description' => 'required',
            'long_description' => 'required',
            'price' => 'required',
            'color' => 'required',
            'stock' => 'required',
            'image' => 'required|mimes:jpg,bmp,png,jpeg'
        ]);
        // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check product directory is exists
            if(!Storage::disk('public')->exists('product'))
            {
                Storage::disk('public')->makeDirectory('product');
            }
            // resize image for product and upload
            $product = Image::make($image)->resize(268,249)->stream();
            Storage::disk('public')->put('product/'.$imageName,$product);
        }else{
            $imageName = "default.png";
        }

        $data = [
            'category_id' => request('category_id'),
            'subcategory_id' => request('subcategory_id'),
            'name' => request('name'),
            'slug' => $slug,
            'price' => request('price'),
            'description' => request('description'),
            'long_description' => request('long_description'),
            'price' => request('price'),
            'color' => request('color'),
            'stock' => request('stock'),
            'status' => request('status'),
            'image' => $imageName,
        ];

        $productId = Product::create($data)->id;
        if (!empty($request->sizes)) {
            $sizes = $request->sizes;
            $this->saveSizes($sizes, $productId);
        }
        Toastr::success('Product Added Successfully', 'Success');
        return redirect()->route('admin.product.index');
    }

    private function saveSizes(array $sizes, $productId)
    {
        foreach ($sizes as $size) {
            if ($size !== null) {
                $productSize = new ProductSize();
                $productSize->size = $size;
                $productSize->product_id = $productId;
                $productSize->save();
            }
        }
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
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $productsizes = ProductSize::all();
        return view('admin.product.edit',compact('product','categories','subcategories','productsizes'));
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

    public function inactive(Request $request,$id)
    {

        $product = Product::find($id);
        if($product->status == false)
        {
            $product->status = true;
            $product->save();
            Toastr::success('Product Active Successfully', 'Success');
        }else
        {
            Toastr::info(' This Product Is Already Actived', 'info');
        }
        return redirect()->back();
    }

    public function active(Request $request,$id)
    {

        $product = Product::find($id);
        if($product->status == true)
        {
            $product->status = false;
            $product->save();
            Toastr::success('Product Inctive Successfully', 'Success');
        }else
        {
            Toastr::info(' This Product Is Already Inactived', 'info');
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        //
    }
}
