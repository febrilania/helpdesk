<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get(){
        $categories = Category::all();
        return view('admin/category', compact('categories'));
    }

    public function add(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255|string'
        ]);

        Category::create($validated);
        return redirect()->back()->with('success','data berhasil ditambahkan');
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255|string'
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);
        return redirect()->back()->with('success','data berhasil diubah');
    }

    public function delete($id){
        $category = Category::findORFail($id);
        $category->delete();
        return redirect()->back()->with('danger','data berhasil dihapus');
    }

}
