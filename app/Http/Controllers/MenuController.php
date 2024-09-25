<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\ChildMenu;
use App\Models\MenuLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    
    public function Get_Data_Menu() {
        $menus = Menu::all()->toArray();
        return response()->json(['data' => $menus]);
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

        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $menuLevels = MenuLevel::all();
        $menus = Menu::all();
        return view('menus.create', compact('menuLevels', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|string|max:300',
            'menu_link' => 'required|string|max:300',
            'menu_icon' => 'required|string|max:300',
            'level_id' => 'required|string|max:30|exists:menu_levels,id_level',
            'parent_id' => 'nullable|string|max:30|exists:menus,menu_id',
            'create_by' => 'required|string|max:30',
        ]);

        // Simpan data ke dalam database
        Menu::create([
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_icon' => $request->menu_icon,
            'level_id' => $request->level_id,
            'parent_id' => $request->parent_id,
            'create_by' => $request->create_by,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $menu = Menu::findOrFail($id);
        $menuLevels = MenuLevel::all();
        $parentMenus = Menu::all();
        return view('menus.edit', compact('menu', 'menus', 'menuLevels', 'parentMenus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_link' => 'required|string|max:255',
            'menu_icon' => 'required|string|max:255',
            'level_id' => 'required|string',
            'parent_id' => 'nullable|string', // Bisa null jika tidak ada parent
            'create_by' => 'required|string|max:255',
        ]);

        // Temukan menu yang akan diperbarui
        $menu = Menu::findOrFail($id);

        // Update data menu berdasarkan input dari form
        $menu->update([
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_icon' => $request->menu_icon,
            'level_id' => $request->level_id,
            'parent_id' => $request->parent_id,
            'create_by' => $request->create_by,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        
        $menu->delete();
        $menu->delete_mark = true;

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
