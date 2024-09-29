<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function getPosts()
    {
        $posts = Post::orderBy('create_date', 'desc')->get();

        foreach ($posts as $post) {
            if (Carbon::parse($post->create_date)->isToday()) {
                $post->formatted_date = 'Hari ini, ' . Carbon::parse($post->create_date)->format('H:i');
            } else {
                $post->formatted_date = Carbon::parse($post->create_date)->format('d M Y, H:i');
            }
        }

        return response()->json($posts);
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



        return view('post.index', compact('menus'));
    }

    public function store(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'message_text' => 'required|string',
        'post_image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
    }

    $user = Auth::user();
    $username = $user->username;
    $create_by = $user->id;

    $lastPostId = DB::table('posts')->max('post_id');
    $newPostId = str_pad((int)$lastPostId + 1, 3, '0', STR_PAD_LEFT);


    $file_name = null;
    if ($request->hasFile('post_image')) {
        $file = $request->file('post_image');
        $file_name = $file->store('uploads', 'public');
    }


    $post = Post::create([
        'post_id' => $newPostId,
        'sender' => $username,
        'message_text' => $request->message_text,
        'post_image' => $file_name,
        'create_by' => $create_by,
    ]);

    if ($post) {
        return redirect()->route('post.index')->with(['success' => 'Data Berhasil Disimpan!'])->with('reload', true);
    } else {
        return redirect()->route('post.index')->with(['error' => 'Data Gagal Disimpan!']);
    }
}

public function destroy($post_id)
{
    // Tambahkan ini untuk memeriksa ID yang diterima
   // Lihat nilai $post_id

   $post_id = (int)$post_id; // Pastikan menjadi integer
   $post = Post::where('post_id', $post_id)->first();

    // Cek apakah post ditemukan
    if ($post) {
        // Hapus post
        $post->delete();
        return redirect()->route('post.index')->with(['success' => 'Postingan berhasil dihapus!']);
    } else {
        return redirect()->route('post.index')->with(['error' => 'Postingan tidak ditemukan!']);
    }
}



}
