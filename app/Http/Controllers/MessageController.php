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
  // In app/Http/Controllers/MessageController.php

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
          ->where('message_status', '!=', 'draft') // Exclude drafted messages
          ->paginate(10);

      $sentMessages = Message::with('recipients')->where('sender', Auth::user()->email)->paginate(10);
      $draftMessages = Message::where('sender', Auth::user()->email)
          ->where('message_status', 'draft')
          ->paginate(10);

      return view('messages.index', compact('menus', 'inboxMessages', 'sentMessages', 'draftMessages'));
  }
  // In app/Http/Controllers/MessageController.php

public function publish($message_id)
{
    $message = Message::findOrFail($message_id);

    if ($message->sender !== Auth::user()->email) {
        abort(403, 'You do not have permission to publish this message.');
    }

    $message->update([
        'message_status' => 'sent',
    ]);

    return redirect()->route('messages.index')->with('status', 'Message published successfully!');
}

// In app/Http/Controllers/MessageController.php

// In app/Http/Controllers/MessageController.php

public function editDraft($message_id)
{
    $message = Message::findOrFail($message_id);
    $user = Auth::user(); // Dapatkan user yang sedang login
    $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
        $query->select('menu_id')
            ->from('setting_menu_user')
            ->where('id_jenis_user', $user->id_jenis_user)
            ->where('delete_mark', false);
    })->get();

    if ($message->sender !== Auth::user()->email) {
        abort(403, 'You do not have permission to edit this message.');
    }

    return view('messages.edit_draft', compact('message','menus'));
}

public function updateDraft(Request $request, $message_id)
{
    $message = Message::findOrFail($message_id);

    if ($message->sender !== Auth::user()->email) {
        abort(403, 'You do not have permission to update this message.');
    }

    $validator = Validator::make($request->all(), [
        'to' => 'required|email',
        'subject' => 'required|string|max:255',
        'message_text' => 'required|string',
        'document' => 'nullable|mimes:pdf,docx,doc,jpg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $message->recipients->first()->to = $request->input('to');
    $message->subject = $request->input('subject');
    $message->message_text = $request->input('message_text');

    if ($request->hasFile('document')) {
        $document = $request->file('document');
        $document->storeAs('public/documents', $document->getClientOriginalName());
        $message->document = $document->getClientOriginalName();
    }

    $message->save();

    return redirect()->route('messages.index')->with('success', 'Draft message updated successfully.');
}
// In app/Http/Controllers/MessageController.php

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'to' => 'required|email',
        'subject' => 'required|string|max:255',
        'message_text' => 'required|string',
        'document' => 'nullable|mimes:pdf,docx,doc,jpg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $request->validate([
        'to' => 'required|email',
        'subject' => 'required|string|max:255',
        'message_text' => 'required|string',
        'document' => 'nullable|mimes:pdf,docx,doc,jpg,png|max:2048',
    ]);

    $messageStatus = $request->input('action') === 'send' ? 'sent' : 'draft';

    $message = Message::create([
        'sender' => Auth::user()->email, // Assuming sender is the authenticated user's email
        'message_reference' => Auth::user()->email,
        'subject' => $request->subject,
        'message_text' => $request->message_text,
        'message_status' => $messageStatus,
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

    if ($request->hasFile('document')) {
        $document = $request->file('document');
        $documentName = time() . '.' . $document->getClientOriginalExtension();
        $document->move(public_path('documents'), $documentName);

        MessageDokumen::create([
            'no_mdok' => Str::uuid()->toString(),
            'file' => $documentName,
            'description' => 'Document attached to message',
            'message_id' => $message->message_id,
            'create_by' => Auth::user()->id,
            'delete_mark' => false,
            'update_by' => Auth::user()->id,
        ]);
    }

    if ($messageStatus === 'sent') {
        return redirect()->route('messages.index')->with('status', 'Message sent successfully!');
    } else {
        return redirect()->route('messages.index')->with('status', 'Message saved as draft!');
    }
}
// In app/Http/Controllers/MessageController.php

public function show($id)
{
    $message = Message::with(['recipients', 'category', 'documents'])->findOrFail($id);

    if ($message->sender !== Auth::user()->email) {
        abort(403, 'You do not have permission to view this message.');
    }

    $user = Auth::user(); // Dapatkan user yang sedang login
    $menus = Menu::whereIn('menu_id', function ($query) use ($user) {
        $query->select('menu_id')
            ->from('setting_menu_user')
            ->where('id_jenis_user', $user->id_jenis_user)
            ->where('delete_mark', false);
    })->get();

    return view('messages.show', compact('message', 'menus'));
}

    // Method to store new message in the database

}
