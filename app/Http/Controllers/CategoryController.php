<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        if (!$request->ajax()) return view('categories.index', compact('categories'));
        return response()->json($categories, 200);
    }

    public function categoryView(Request $request)
    {
        $category = Category::find($request->id);
        if (!$request->ajax()) return view('categories.categoryView', compact('category'));
        return response()->json(['category' => $category], 200);
    }

    public function getCategory(Request $request, $id)
    {
        $cname = Category::find($id)->name;
        if (!$request->ajax()) return view('categories.categoryView', compact("id"));
        $categoryWithProduct = Category::with('products')->find($id);
        return response()->json($categoryWithProduct, 200);
    }

    public function create(Request $categoryRequest)
    {
        $category = new Category($categoryRequest->all());
        $category->save();
        if (!$categoryRequest->ajax()) return back()->with('success', 'Category created');
        return response()->json(['status' => 'Category created', 'category' => $category], 201);
    }

    public function modify(Request $categoryRequest)
    {
        $category = Category::find($categoryRequest->id);
        $category->name = $categoryRequest->name;
        $category->save();
        if (!$categoryRequest->ajax()) return back()->with('success', 'Category modified');
        return response()->json(['status' => 'Category modified', 'category' => $category], 201);
    }

    public function destroy(Request $categoryRequest)
    {
        $category = Category::find($categoryRequest->id);
        $category->delete();
        if (!$categoryRequest->ajax()) return back()->with('success', 'Category destroyed');
        return response()->json(['status' => 'Category destroyed', 'categoty' => $category], 201);
    }
}
