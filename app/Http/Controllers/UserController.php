<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\JenisUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function Get_Data_User() {
        $users = DB::table('users')->get()->toArray();
        return response()->json(['data' => $users]);
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
        $users = User::all();
        return view('users.index', compact('users', 'menus'));
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
        $jenisUsers = JenisUser::all();
        return view('users.create', compact('jenisUsers', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:60',
            'username' => 'nullable|string|max:60',
            'password' => 'nullable|string|max:60',
            'email' => 'required|string|email|max:200',
            'no_hp' => 'nullable|string|max:30',
            'wa' => 'nullable|string|max:30',
            'pin' => 'nullable|string|max:30',
            'id_jenis_user' => 'required|exists:jenis_user,id_jenis_user',

        ]);

        $user = User::create([
            'nama_user' => $request->input('nama_user'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'id_jenis_user' => $request->input('id_jenis_user'),
            'no_hp' => $request->input('no_hp'),
            'wa' => $request->input('wa'),
            'pin' => $request->input('pin'),
        ]);

        return redirect()->route('users.index');
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
        $jenisUsers = JenisUser::all();
        $users = User::findOrFail($id);
        return view('users.edit', compact('users','jenisUsers', 'menus'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_user' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:8',
        'id_jenis_user' => 'required|exists:jenis_user,id_jenis_user',
        'no_hp' => 'nullable|numeric',
        'wa' => 'nullable|numeric',
        'pin' => 'nullable|numeric',
    ]);

    $user = User::findOrFail($id);
    
    // Update data
    $user->update([
        'nama_user' => $request->nama_user,
        'username' => $request->username,
        'email' => $request->email,
        'id_jenis_user' => $request->id_jenis_user,
        'no_hp' => $request->no_hp,
        'wa' => $request->wa,
        'pin' => $request->pin,
        'password' => $request->password ? bcrypt($request->password) : $user->password,
    ]);

    return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui');
}

    

    public function destroy($id)
    {
        //delete post by ID
        User::where('id', $id)->delete();
        
    return redirect()->route('users.index');
    }
}