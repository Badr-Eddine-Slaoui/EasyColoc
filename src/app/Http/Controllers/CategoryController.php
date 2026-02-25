<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(int $colocationId) {
        $categories = Category::where("colocation_id", $colocationId)->get();
        return view("category.index", compact("categories", "colocationId"));
    }

    public function store(Request $request, int $colocationId) {
        Validator::make($request->all(), [
            'name' => 'required',
        ])->validateWithBag('addCategory');

        Category::create([
            'name'=> $request->name,
            'description' => $request->description,
            'colocation_id' => $colocationId
        ]);

        return redirect()->route('colocation.category.index', $colocationId)->with('success','Category created successfully');
    }

    public function update(Request $request, Category $category) {
        Session::flash('categoryId', $category->id);
        Validator::make($request->all(), [
            'name' => 'required',
        ])->validateWithBag('editCategory');

        $category->update([
            'name'=> $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('colocation.category.index', $category->colocation_id)->with('success','Category updated successfully');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('colocation.category.index', $category->colocation_id)->with('success','Category deleted successfully');
    }
}
