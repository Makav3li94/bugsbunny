<?php

namespace App\Http\Controllers\User;

use App\Traits\Helpers;
use App\Models\Faq;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class FaqController extends Controller
{
    use Helpers;

    public function store(Request $request, Ticket $ticket)
    {
        $user = auth()->user();
        if ($ticket->user_id == $user->id) {
            $this->validate(request(), [
                'question' => 'required',
                'file' => 'nullable|file|max:5000|mimes:jpg,jpeg,png,pdf,docx,doc,zip,rar'
            ]);

                $file = null;

            $faq = Faq::create([
                'ticket_id' => $ticket->id,
                'user_file' => $file,
                'question' => $request['question'],
            ]);
            $ticket->update(['answer' => '0']);
            $this->notifyAdmin($user->id, $user->name, $user->mobile, 'ticket', $ticket->id, 0,'کاربر تیکت جدیدی ارسال کرده است.');
            return redirect()->back()->with([
                'message' => 'sent','crud'=>'ticket_store'
            ]);
        } else {
            abort(404);
        }

    }

    public function downloadFile(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $mac = $request->input('mac');
        $hash = '(8&J.Ke#_MR%^2P91?/\G!xZ~97LaS' . $id;
        if (Hash::check($hash, $mac)) {
            if ($type == 'user') {
                return response()->download(public_path(Faq::find($id)->user_file));
            } else {
                if ($type == 'admin') {
                    return response()->download(public_path(Faq::find($id)->admin_file));
                }
            }

        } else {
            abort(404);
        }
    }
}
