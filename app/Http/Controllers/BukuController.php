<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Categories;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('bukus.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Categories::all();
        return view('bukus.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:bukus',
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'id_kategori' => 'required|exists:categories,id_kategori',
        ]);

        Buku::create($request->all());
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan.');
    }


    public function edit(Buku $buku)
    {
        $kategoris = Categories::all();
        return view('bukus.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku' => 'required|unique:bukus,kode_buku,' . $buku->id,
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'id_kategori' => 'required|exists:categories,id_kategori',
        ]);

        $buku->update($request->all());
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus.');
    }
}
