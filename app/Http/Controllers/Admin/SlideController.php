<?php

namespace App\Http\Controllers\Admin;

use App\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::latest()->get();
        return view('admin.slide.index',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
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
            'image' => 'required|mimes:jpg,bmp,png,jpeg'
        ]);
        // get form image
        $image = $request->file('image');
        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check slide directory is exists
            if(!Storage::disk('public')->exists('slide'))
            {
                Storage::disk('public')->makeDirectory('slide');
            }
            // resize image for slide and upload
            $slide = Image::make($image)->resize(950,441)->stream();
            Storage::disk('public')->put('slide/'.$imageName,$slide);
        }else{
            $imageName = "default.png";
        }
        $slide = new Slide();
        $slide->image = $imageName;
        if(isset($request->status))
          {
              $slide->status = true;
          }else{
              $slide->status = false;
          }
        $slide->save();
        Toastr::success('Slide Added Successfully', 'Success');
        return redirect()->route('admin.slide.index');
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
        $slide = Slide::find($id);
        return view('admin.slide.edit',compact('slide'));
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
        $slide = Slide::find($id);
        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check slide directory is exists
            if(!Storage::disk('public')->exists('slide'))
            {
                Storage::disk('public')->makeDirectory('slide');
            }
            // delete old image
            if(Storage::disk('public')->exists('slide/'.$slide->image))
            {
                storage::disk('public')->delete('slide/'.$slide->image);
            }
            // resize image for category and upload
            $slideImage = Image::make($image)->resize(950,441)->stream();
            Storage::disk('public')->put('slide/'.$imageName,$slideImage);
        }else{
            $imageName = $slide->image;
        }
        $slide->image = $imageName;
        if(isset($request->status))
          {
              $slide->status = true;
          }else{
              $slide->status = false;
          }
        $slide->save();
        Toastr::success('Slide Updated Successfully', 'Success');
        return redirect()->route('admin.slide.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive(Request $request,$id)
    {

        $slide = Slide::find($id);
        if($slide->status == false)
        {
            $slide->status = true;
            $slide->save();
            Toastr::success('Slide Active Successfully', 'Success');
        }else
        {
            Toastr::info(' This Slide Is Already Actived', 'info');
        }
        return redirect()->back();
    }

    public function active(Request $request,$id)
    {

        $slide = Slide::find($id);
        if($slide->status == true)
        {
            $slide->status = false;
            $slide->save();
            Toastr::success('Slide Inctive Successfully', 'Success');
        }else
        {
            Toastr::info(' This Slide Is Already Inactived', 'info');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $slide = Slide::find($id);
        if(Storage::disk('public')->exists('slide/'.$slide->image))
            {
                storage::disk('public')->delete('slide/'.$slide->image);
            }
        $slide->delete();
        Toastr::success('Slide Delete Successfully', 'Success');
        return redirect()->back();
    }
}
