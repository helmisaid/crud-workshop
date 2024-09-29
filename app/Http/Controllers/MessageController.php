<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\MessageTo;
use App\Models\MessageDokumen;
use App\Models\MessageKategori;
use App\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MessageController extends Controller
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
        $inboxMessages = Message::with('recipients')
            ->whereHas('recipients', function ($query) {
                $query->where('to', Auth::user()->email); // Reference 'to' from the recipients
            })
            ->paginate(10);

        $sentMessages = Message::with('recipients')->where('sender', Auth::user()->email)->paginate(10);
        $draftMessages = Message::where('message_status', 'draft')->paginate(10);

        return view('messages.index', compact('menus', 'inboxMessages', 'sentMessages', 'draftMessages'));
    }



    public function store(Request $request)
    {
        $messageId = (string) Str::uuid(); // Generates a UUID

        $validator = Validator::make($request->all(), [
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message_text' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
            $query->select('menu_id')
                ->from('setting_menu_user')
                ->where('id_jenis_user', $user->id_jenis_user)
                ->where('delete_mark', false);
        })->get();
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message_text' => 'required|string',
        ]);
        $message = Message::create([
            'sender' => Auth::user()->email, // Assuming sender is the authenticated user's email
            'message_reference' => Auth::user()->email,
            'subject' => $request->subject,
            'message_text' => $request->message_text,
            'message_status' => 'sent',
            'create_by' => Auth::user()->id,
            'no_mk' => $request->no_mk, // Ensure no_mk has a value
            'update_by' => Auth::user()->id,

        ]);

        MessageTo::create([
            'message_id' => $message->message_id,
            'to' => $request->to,
            'create_by' => Auth::user()->email,
            'cc' => $request->to,
            'update_by' => Auth::user()->email,
        ]);

        return redirect()->route('messages.index')->with('status', 'Message sent successfully!');
    }

    public function show($id)
    {
        $message = Message::with(['recipients', 'category', 'documents'])->findOrFail($id);
        return view('messages.show', compact('message'));
    }

    // Method to store new message in the database

}
