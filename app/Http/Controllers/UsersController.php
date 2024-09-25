<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\JenisUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // Mengambil data jenis user untuk API
    public function Get_Data_JU() {
        $jenisUsers = DB::table('jenis_user')->get()->toArray();
        return response()->json(['data' => $jenisUsers]);
    }

    // Menampilkan halaman index jenis user
    public function index() {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $jenisUsers = JenisUser::all(); // Mengambil semua data jenis user
        return view('jenis-user.index', compact('jenisUsers', 'menus'));
    }

    // Menampilkan halaman create jenis user
    public function create() {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        return view('jenis-user.create', compact('menus'));
    }

    // Menyimpan data jenis user baru ke database
    public function store(Request $request) {
        $request->validate([
            'jenis_user' => 'required|unique:jenis_user,jenis_user',
        ]);

        // Menyimpan data jenis user
        JenisUser::create([
            'jenis_user' => $request->jenis_user,
        ]);

        return redirect()->route('jenis-user.index')->with('success', 'Jenis User berhasil ditambahkan.');
    }

    // Menampilkan halaman edit jenis user berdasarkan ID
    public function edit($id) {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $jenisUser = JenisUser::findOrFail($id); // Mengambil data jenis user berdasarkan ID
        return view('jenis-user.edit', compact('jenisUser', 'menus'));
    }

    // Memperbarui data jenis user di database
    public function update(Request $request, $id)
{
    $request->validate([
        // Gantilah 'id' dengan 'id_jenis_user' di validasi unique
        'jenis_user' => 'required|unique:jenis_user,jenis_user,' . $id . ',id_jenis_user',
    ]);

    // Mengambil data jenis user berdasarkan ID dan memperbarui
    $jenisUser = JenisUser::findOrFail($id);
    $jenisUser->update([
        'jenis_user' => $request->jenis_user,
    ]);

    return redirect()->route('jenis-user.index')->with('success', 'Jenis User berhasil diperbarui.');
}


    // Menghapus data jenis user berdasarkan ID
    public function destroy($id) {
        JenisUser::where('id_jenis_user', $id)->delete(); // Menghapus jenis user berdasarkan ID
        return redirect()->route('jenis-user.index')->with('success', 'Jenis User berhasil dihapus.');
    }
}
