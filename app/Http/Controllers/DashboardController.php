<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class DashboardController extends Controller
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
        $response = Http::get('https://api.jikan.moe/v4/genres/anime'); // Adjust API endpoint if necessary
        $genres = $response->json()['data']; // Assuming the API response structure is like this
        // Logic untuk menampilkan data dashboard
        return view('dashboard',['genres'=>$genres] ,compact('menus'));
    }

    public function random(){
        $user = Auth::user(); // Dapatkan user yang sedang login

        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();

        return view('random',compact('menus'));
    }

}
