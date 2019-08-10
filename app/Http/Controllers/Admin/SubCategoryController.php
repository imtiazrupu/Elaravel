<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::latest()->get();
        return view('admin.subcategory.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('admin.subcategory.create',compact('categories'));
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
            'subcategory_description' => 'required',
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
            // check Subcategory directory is exists
            if(!Storage::disk('public')->exists('subcategory'))
            {
                Storage::disk('public')->makeDirectory('subcategory');
            }
            // resize image for Subcategory and upload
            $subcategory = Image::make($image)->resize(900,1269)->stream();
            Storage::disk('public')->put('subcategory/'.$imageName,$subcategory);
        }else{
            $imageName = "default.png";
        }
        $subcategory = new SubCategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->slug = $slug;
        $subcategory->subcategory_description = $request->subcategory_description;
        $subcategory->image = $imageName;
        if(isset($request->status))
          {
              $subcategory->status = true;
          }else{
              $subcategory->status = false;
          }
        $subcategory->save();
        Toastr::success('SubCategory Added Successfully', 'Success');
        return redirect()->route('admin.subcategory.index');
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
    public function destroy($id)
    {
        //
    }
}
