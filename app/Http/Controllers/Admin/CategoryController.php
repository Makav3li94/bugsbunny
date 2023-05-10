<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return  view('admin.categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:categories,title,NULL,id,deleted_at,NULL'
            ]);
            if ($validator->fails()) {
                return response()->json(['catError' => $validator->errors()->toArray()]);
            }
            $title = $request->input('title');
            $record = Category::create([
                'title' => $title
            ]);
            $catCounts = Category::all()->count();
            $cat = [
                0 => $catCounts,
                1 => $record->title,
                2 => $record->id
            ];
            return response()->json(['catCreate' => 'submitted', 'cat' => $cat]);

        }
    }


    public function edit(Request $request,Category $category)
    {
        if ($request->ajax()) {
            return response()->json(['cat' => $category]);
        }
    }


    public function update(Request $request, Category $category)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'title' => "required|unique:categories,title,{$category->id},id,deleted_at,NULL"
            ]);
            if ($validator->fails()) {
                return response()->json(['collapseCatError' => $validator->errors()->toArray()]);
            }
            $title = $request->input('title');
            $category->update([
                'title' => $title,
            ]);
            $cat = [
                0 => $category->title,
                1 => $category->id
            ];
            return response()->json(['collapseCatEdit' => 'success', 'cat' => $cat]);
        }
    }


    public function destroy(Request $request,Category $category)
    {
        if ($request->ajax()) {
            $category->delete();
            return response()->json(['deleteCat' => 'success']);
        }
    }
}
