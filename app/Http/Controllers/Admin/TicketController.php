<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use function App\Helpers\fileUploader;

class TicketController extends Controller
{
    function __construct()
    {
//        $this->middleware('permission:support');
    }

    protected function index()
    {
        $tickets = Ticket::orderBy('id', 'desc')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $users = User::where('is_primary', '1')->get();
        return view('admin.tickets.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'user_id' => 'required',
            'section' => 'required|in:پشتیبانی,مدیریت,مالی',
            'priority' => 'required|in:خیلی مهم,مهم,عادی',
            'title' => 'required',
            'description' => 'required',
            'file' => 'nullable|max:5000|mimes:png,jpg,jpeg,pdf,doc,docx,zip,rar',
        ]);
        if ($request->file('file')) {
            $file = fileUploader($request->file('file'), '/uploads/tickets/user/');
        } else {
            $file = null;
        }
        $ticket = Ticket::create([
            'user_id' => $request->user_id,
            'title' => $request['title'],
            'section' => $request['section'],
            'priority' => $request['priority'],
            'answer' => '2'
        ]);
        Faq::create([
            'ticket_id' => $ticket->id,
            'user_file' => $file,
            'reply' => $request['description'],
        ]);
        $user = User::find($request->user_id);
        $user->sendUserTicketNotification($user,$ticket);
        return redirect(route('admin.ticket.index', $ticket->id));
    }

    protected function show(Ticket $ticket)
    {
        if ($ticket->faqs()
                ->where('reply', null)
                ->orWhere('reply', '')->get()->count() > 0) {
            $ticket->update(['answer' => '1']);
        }
        $ticket->faqs()->where('seen', '0')->update(['seen' => '1']);
        return view('admin.tickets.show', compact('ticket'));
    }


    protected function destroy(Ticket $ticket)
    {
        foreach ($ticket->faqs as $faq) {
            if ($faq->user_file && file_exists(public_path($faq->user_file))) {
                unlink(public_path($faq->user_file));
            }
            if ($faq->admin_file && file_exists(public_path($faq->admin_file))) {
                unlink(public_path($faq->admin_file));
            }
        }
        $ticket->faqs()->delete();
        $ticket->delete();
        return redirect()->back()->with([
            'ticket_delete' => 'success'
        ]);
    }

    protected function status(Request $request, Ticket $ticket)
    {
        $previous = $ticket->status;
        switch ($previous) {
            case '0':
                $ticket->update(['status' => '1']);
                break;
            case '1':
                $ticket->update(['status' => '0']);
                if ($ticket->faqs()
                        ->where('reply', null)
                        ->orWhere('reply', '')
                        ->get()
                        ->count() > 0) {
                    $ticket->update(['answer' => '2']);
                    $ticket->faqs()
                        ->where('reply', null)
                        ->orWhere('reply', '')
                        ->update(['reply' => 'مورد رسیدگی شد.', 'seen' => '2', 'admin_id' => auth()->user()->id]);
                }
                break;
        }
        return back()->with(['update' => 'success']);
    }

    protected function checkReply(Request $request)
    {
        if ($request->ajax()) {
            $count = Ticket::find($request->input('id'))
                ->faqs()
                ->where('reply', null)
                ->orWhere('reply', '')
                ->get()
                ->count();
            if ($count == 0) {
                return response()->json(['count' => 0]);
            } else {
                return response()->json(['count' => $count]);
            }
        }
    }

}
