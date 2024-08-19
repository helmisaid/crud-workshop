<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori',
        ]);

        Categories::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // public function show(Categories $category)
    // {
    //     return view('categories.show', compact('category'));
    // }

    public function edit(Categories $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori,' . $category->id_kategori,
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
