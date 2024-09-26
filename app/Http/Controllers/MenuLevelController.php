<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuLevelController extends Controller
{
    
    
    public function index()
    {
        $user = Auth::user(); 
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $menuLevels = MenuLevel::where('delete_mark', false)->get();
        return view('menulevel.index', compact('menuLevels', 'menus'));
    }

    public function create()
    {
        $user = Auth::user(); 
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        return view('menulevel.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_level' => 'required|string|max:30|unique:menu_levels,id_level',
            'level' => 'required|string|max:60',
            'create_by' => 'required|string|max:30',
        ]);

        MenuLevel::create($request->all());
        return redirect()->route('menu-levels.index')->with('success', 'Menu level berhasil ditambahkan.');
    }

// Method untuk menampilkan data spesifik (bisa diabaikan jika tidak diperlukan)
// public function show(MenuLevel $menuLevel)
// {
//     return view('menu_levels.show', compact('menuLevel'));
// }

// Method untuk menampilkan form edit
public function edit(MenuLevel $menuLevel)
{
    $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
    return view('menulevel.edit', compact('menuLevel', 'menus'));
}

// Method untuk memperbarui data
public function update(Request $request, MenuLevel $menuLevel)
{
    $request->validate([
        'level' => 'required|string|max:60',
        'create_by' => 'required|string|max:30',
    ]);

    $menuLevel->update($request->all());
    return redirect()->route('menu-levels.index')->with('success', 'Menu level berhasil diperbarui.');
}

// Method untuk menghapus data (soft delete)
public function destroy(MenuLevel $menuLevel)
{
    $menuLevel->delete();
    $menuLevel->update(['delete_mark' => true]);
    return redirect()->route('menu-levels.index')->with('success', 'Menu level berhasil dihapus.');
}

}
