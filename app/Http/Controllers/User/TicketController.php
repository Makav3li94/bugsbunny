<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\fileUploader;

/**
 * @method fileUploader($file, string $string)
 */
class TicketController extends Controller
{
    use Helpers;

    public function index()
    {

        $tickets = Ticket::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('user.tickets.index', compact('tickets'));
    }


    public function create()
    {
        return view('user.tickets.create');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'section' => 'required|in:پشتیبانی,مدیریت,مالی',
            'priority' => 'required|in:خیلی مهم,مهم,عادی',
            'title' => 'required',
            'description' => 'required',
            'file' => 'nullable|max:5000|mimes:png,jpg,jpeg,pdf,doc,docx,zip,rar',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('for','ticket');
        }
        if ($request->file('file')) {
            $file = fileUploader($request->file('file'), '/uploads/tickets/user/');
        } else {
            $file = null;
        }
        $user  = User::find(auth()->id());
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => $request['title'],
            'section' => $request['section'],
            'priority' => $request['priority'],
        ]);
        Faq::create([
            'ticket_id' => $ticket->id,
            'user_file' => $file,
            'question' => $request['description'],
        ]);
        $this->notifyAdmin($user->id, $user->name, $user->mobile, 'ticket', $ticket->id, 0,'کاربر تیکت جدیدی ارسال کرده است.');
        return back()->with(['store'=>'success','crud'=>'ticket_store']);
    }


    public function edit(Ticket $ticket)
    {
        //seen=0 => karbar soal karde modir hanuz nadide
        //seen=1 => karbar soal karde modir dide vali javab nadade
        //seen=2 => karbar soal karde modir dide va javab dade vali karbar hanuz nadide
        //seen=3 => karbar soal karde modir dide va javab dade va karbar ham dide
        if ($ticket->user_id == auth()->user()->id) {
            $ticket->faqs()
                ->where('reply', '!=', null)
                ->orWhere('reply', '!=', '')
                ->where('seen', '2')
                ->update(['seen' => '3']);
            $ticket = $ticket->with('faqs')->first();
            $ticket['date'] = verta($ticket->created_at)->formatDifference();
            return response()->json(['ticket' =>$ticket ]);
        } else {
            abort(404);
        }
    }
//{{route('user.faq.download',['type'=>'user','id'=>$faq->id,'mac'=>Hash::make('(8&J.Ke#_MR%^2P91?/\G!xZ~97LaS'.$faq->id)])}}
    protected function status(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id == auth()->user()->id) {
            $previous = $ticket->status;
            switch ($previous) {
                case '0':
                    abort(403);
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
                            ->update(['reply' => 'مورد رسیدگی شد.', 'seen' => '3']);
                    }
                    break;
            }
            return back()->with(['update' => 'success']);
        } else {
            abort(403);
        }
    }

    public function update(Request $request, Ticket $ticket)
    {
        //
    }


    public function destroy(Ticket $ticket)
    {
        //
    }

}
