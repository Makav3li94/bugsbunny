<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\User;
use App\Traits\Helpers;
use App\Traits\SmsableMokhaberat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function App\Helpers\fileUploader;


class FaqController extends Controller
{
    use Helpers;

    protected function update(Request $request, Faq $faq)
    {
        $this->validate(request(), [
            'reply.*' => 'required',
            'file.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,rar,zip|max:5000',
        ]);
        if ($request->file('file.' . $faq->id)) {
            $file = fileUploader($request->file('file.' . $faq->id),
                '/uploads/tickets/admin/');
        } else {
            $file = null;
        }
        $check = $faq->reply;
        $faq->update([
            'admin_id' => auth()->user()->id,
            'admin_file' => $file,
            'reply' => $request['reply'][$faq->id],
            'seen' => '2',
            'reply_date' => Carbon::now()
        ]);
        $ticket = $faq->ticket()->first();
        if ($ticket->faqs()
                ->where('reply', null)
                ->orWhere('reply', '')
                ->get()
                ->count() == 0) {
            $faq->ticket()->update(['answer' => '2']);
        }
        $user = User::find($ticket->user_id);
        $user->sendUserTicketNotification($user,$ticket);
        $this->readMFNotification($user->id,'ticket',$ticket->id);
        return redirect()->back()->with([
            'message' => 'sent'
        ]);
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
