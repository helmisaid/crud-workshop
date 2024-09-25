<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\JenisUser;
use Illuminate\Http\Request;
use App\Models\SettingMenuUser;
use Illuminate\Support\Facades\Auth;

class SettingMenuUserController extends Controller
{
    
    public function index()
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();

        // Ambil semua data setting menu user yang belum dihapus (delete_mark = false)
        $settings = SettingMenuUser::where('delete_mark', false)->get();
        return view('settingsmenu.index', compact('settings', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $JenisUsers = JenisUser::all();
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::all();
        // Menampilkan form untuk menambah data baru
        return view('settingsmenu.create', compact('JenisUsers', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'no_setting' => 'required|string|max:30',
            'id_jenis_user' => 'required|exists:jenis_user,id_jenis_user',
            'menu_id' => 'required|exists:menus,menu_id',
            'create_by' => 'required|string|max:30', 
        ]);
        
        // Simpan data ke dalam database
        $setting = SettingMenuUser::create([
            'no_setting' => $request->no_setting,
            'id_jenis_user' => $request->id_jenis_user,
            'menu_id' => $request->menu_id,
            'create_by' => $request->create_by,
        ]);
        
        
        // Redirect dengan pesan sukses
        return redirect()->route('settingmenuuser.index')->with('success', 'Setting menu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(SettingMenuUser $settingMenuUser)
    // {
    //     // Menampilkan detail dari setting menu user tertentu
    //     return view('settingmenuuser.show', compact('settingMenuUser'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SettingMenuUser $settingMenuUser)
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $jenisUsers = JenisUser::all();
        // Menampilkan form untuk mengedit data setting menu
        return view('settingsmenu.edit', compact('settingMenuUser', 'menus', 'jenisUsers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SettingMenuUser $settingMenuUser)
    {
        // Validasi data input
        $request->validate([
            'no_setting' => 'required|string|max:30',
            'id_jenis_user' => 'required|exists:jenis_user,id_jenis_user',
            'menu_id' => 'required|exists:menus,menu_id',
            'create_by' => 'required|string|max:30',
        ]);

        // Update data ke dalam database
        $settingMenuUser->update([
            'no_setting' => $request->no_setting,
            'id_jenis_user' => $request->id_jenis_user,
            'menu_id' => $request->menu_id,
            'create_by' => $request->create_by,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('settingmenuuser.index')->with('success', 'Setting menu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SettingMenuUser $settingMenuUser)
    {
        // Menghapus data (soft delete dengan menandai delete_mark = true)
        $settingMenuUser->delete();
        $settingMenuUser->delete_mark = true;

        // Redirect dengan pesan sukses
        return redirect()->route('settingmenuuser.index')->with('success', 'Setting menu berhasil dihapus.');
    }
}
