<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories',
            'category_description' => 'required',
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
            // check category directory is exists
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }
            // resize image for category and upload
            $category = Image::make($image)->resize(800,800)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category);
        }else{
            $imageName = "default.png";
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->category_description = $request->category_description;
        $category->image = $imageName;
        if(isset($request->status))
          {
              $category->status = true;
          }else{
              $category->status = false;
          }
        $category->save();
        Toastr::success('Category Added Successfully', 'Success');
        return redirect()->route('admin.category.index');
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
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
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
        $this->validate($request,[
            'image' => 'mimes:jpg,bmp,png,jpeg'
        ]);
        // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category = Category::find($id);
        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check category directory is exists
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }
            // delete old image
            if(Storage::disk('public')->exists('category/'.$category->image))
            {
                storage::disk('public')->delete('category/'.$category->image);
            }
            // resize image for category and upload
            $categoryImage = Image::make($image)->resize(800,800)->stream();
            Storage::disk('public')->put('category/'.$imageName,$categoryImage);
        }else{
            $imageName = $category->image;
        }
        $category->name = $request->name;
        $category->slug = $slug;
        $category->category_description = $request->category_description;
        $category->image = $imageName;
        if(isset($request->status))
          {
              $category->status = true;
          }else{
              $category->status = false;
          }
        $category->save();
        Toastr::success('Category Updated Successfully', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function inactive(Request $request,$id)
    {

        $category = Category::find($id);
        if($category->status == false)
        {
            $category->status = true;
            $category->save();
            Toastr::success('Category Active Successfully', 'Success');
        }else
        {
            Toastr::info(' This Category Is Already Actived', 'info');
        }
        return redirect()->back();
    }

    public function active(Request $request,$id)
    {

        $category = Category::find($id);
        if($category->status == true)
        {
            $category->status = false;
            $category->save();
            Toastr::success('Category Inctive Successfully', 'Success');
        }else
        {
            Toastr::info(' This Category Is Already Inactived', 'info');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(Storage::disk('public')->exists('category/'.$category->image))
            {
                storage::disk('public')->delete('category/'.$category->image);
            }
        $category->delete();
        Toastr::success('Category Delete Successfully', 'Success');
        return redirect()->back();
    }
}
