<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    public function Get_Data_Buku()
    {
        $bukus = Buku::all()->toArray();
        return response()->json(['data' => $bukus]);
    }

    public function index()
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $bukus = Buku::all();
        return view('bukus.index', compact('bukus', 'menus'));
    }

    public function create()
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $kategoris = Categories::all();
        return view('bukus.create', compact('kategoris', 'menus'));
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
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $kategoris = Categories::all();
        return view('bukus.edit', compact('buku', 'kategoris', 'menus'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku' => 'required|unique:bukus,kode_buku,' . $buku->idbuku . ',idbuku',
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
