<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostComment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function getPosts()
    {
        $posts = Post::with('comments.user') // Eager load comments and their associated users
        ->orderBy('create_date', 'desc')
        ->get();

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
 // Pastikan post_id harus ada dan dalam format string
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

    $file_name = null;
    if ($request->hasFile('post_image')) {
        $file = $request->file('post_image');
        $file_name = $file->store('uploads', 'public');
    }

    // Pastikan post_id unik
    if (Post::where('post_id', $request->post_id)->exists()) {
        return redirect()->back()->with(['error' => 'post_id sudah digunakan!']);
    }

    // Membuat postingan baru
    $post = Post::create([
 // Ambil post_id dari input
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

// public function like($id)
// {
//     $post = Post::find($id);

//     if (!$post) {
//         return redirect()->back()->with('error', 'Post not found');
//     }

//     // Cek apakah user sudah menyukai post ini
//     $like = PostLike::firstOrCreate([
//         'post_id' => $id,
//         'user_id' => Auth::id(),
//     ]);

//     return redirect()->back()->with('success', 'You liked the post!');
// }

public function comment(Request $request, $post_id)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'comment_text' => 'required|string|max:255',
        'comment_image' => 'nullable|mimes:jpeg,png,jpg|max:2048', // Opsional jika ada gambar
    ]);

    if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
    }

    $user = Auth::user();
    $create_by = $user->username; // Menggunakan username untuk create_by
    $user_id = $user->id; // ID pengguna

    // Generate comment_id
    $lastCommentId = DB::table('post_comments')->max('comment_id');
    $newCommentId = str_pad((int)$lastCommentId + 1, 3, '0', STR_PAD_LEFT);

    // Menyimpan gambar komentar jika ada
    $comment_image = null;
    if ($request->hasFile('comment_image')) {
        $file = $request->file('comment_image');
        $comment_image = $file->store('uploads', 'public');
    }

    // Buat komentar dengan post_id yang sesuai
    $comment = PostComment::create([
        'comment_id' => $newCommentId,
        'post_id' => $post_id, // Gunakan post_id dari parameter route
        'user_id' => $user_id,
        'comment_text' => $request->comment_text,
        'comment_image' => $comment_image,
        'create_by' => $create_by,
        'create_date' => now(), // Tambahkan create_date jika diperlukan
    ]);

    if ($comment) {
        return redirect()->route('post.index')->with(['success' => 'Komentar Berhasil Disimpan!'])->with('reload', true);
    } else {
        return redirect()->route('post.index')->with(['error' => 'Komentar Gagal Disimpan!']);
    }
}


public function show($id)
{
    $user = Auth::user(); // Dapatkan user yang sedang login
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();

        $post = Post::where('post_id', $id)->first();
    return view('post.show', compact('id', 'menus', 'post', 'user'));
}

public function getPostDetail($id)
{

    $id = (int)$id;
    $post = Post::where('post_id', $id)->first();

    dd($post);

    if ($post) {
        return response()->json($post);
    } else {
        return response()->json(['error' => 'Post not found'], 404);
    }
}

public function getComments($post_id)
{
    // Mengambil komentar yang terkait dengan post_id
    $comments = PostComment::where('post_id', $post_id)->with('user')->get();

    if ($comments) {
        return response()->json($comments);
    } else {
        return response()->json(['error' => 'No comments found'], 404);
    }
}

}
