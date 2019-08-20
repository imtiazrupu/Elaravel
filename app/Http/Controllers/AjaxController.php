<?php

namespace App\Http\Controllers;
use App\SubCategory;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function subCat(Request $request)
    {
        if ($request->ajax()) {
            $cat_id = $request->input('cat_id');
            $subCategories = SubCategory::where('category_id', '=', $cat_id)->get();
            return response()->json($subCategories);
        }

        return response()->json(['message' => 'Only ajax request is accepted']);
    }
}
