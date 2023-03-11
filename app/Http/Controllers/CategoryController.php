<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Facade\FlareClient\View;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('admin.category.list', compact('categories'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
        ]);

        $category = Category::create($formFields);

        return redirect('admin/category')->with('message', 'Create category successfully');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $formFields = $request->validate([
            'name' => 'required',
        ]);

        Category::where('id', $id)->update($formFields);

        return back()->with('message', 'Category updated successfully');
    }

    public function delete($id) {
        Category::where('id', $id)->delete();

        return redirect('admin/category')->with('message', 'Category deleted successfully');
    }
}
