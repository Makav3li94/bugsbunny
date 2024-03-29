<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\QuizHeader;
use App\Models\Reply;
use App\Models\Section;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
//        $this->middleware('permission:admin')->except('dashboard');
    }

    public function dashboard()
    {

        //Open Tickets Count
        $openTickets = Ticket::where('status', '1')->get()->count();
        //Total Primary Users
        $primaryUsers = User::where('is_primary', '1')->orderBy('id', 'desc')->get()->count();

        $adminChallengeCount = Section::where([['type',1],['kind',0]])->get()->count();
        $userChallengeCount = Section::where([['type',0],['kind',0]])->get()->count();

        $adminThreadCount = Section::where([['type',1],['kind',1]])->get()->count();
        $userThreadCount = Section::where([['type',0],['kind',1]])->get()->count();
        $quizHeaderCount = QuizHeader::get()->count();
        $commentCount = Reply::get()->count();
        return view('admin.dashboard', compact(  'adminChallengeCount','commentCount','quizHeaderCount','userChallengeCount','adminThreadCount','userChallengeCount','userThreadCount', 'openTickets','primaryUsers'));
    }

    protected function search(Request $request)
    {
        if ($request->ajax()) {
            $val = $request->input('val');
            $usersByName = User::where([['is_primary', '1'], ['name', 'like', "%$val%"]])->get();
            $usersByMobile = User::where([['is_primary', '1'], ['mobile', 'like', "%$val%"]])->get();

            $sectionByTitle = Section::where('title', 'like', "%$val%")->get();
            $merged = $usersByName->merge($usersByMobile);

            if (count($merged) == 0 && count($sectionByTitle) == 0) {
                return response()->json([
                    'records' => 'none'
                ]);
            } else {
                $result = [];
                foreach ($merged as $key => $user) {
                    $result[$key] = [
                        'name' => $user->name,
                        'link' => route('admin.user.primary.edit', $user->id),
                    ];
                }
                foreach ($sectionByTitle as $key => $section) {
                    $result[$key] = [
                        'name' => $section->title,
                        'link' => route('admin.challenge.edit', $section->id),
                    ];
                }
                return response()->json([
                    'records' => $result
                ]);
            }
        }
    }

    public function chart(Request $request)
    {
        $month = Verta::now()->month;
        $year = Verta::now()->year;
        $days = [];
        if ($month == 1 || $month == 2 || $month == 3 || $month == 4 || $month == 5 || $month == 6) {
            for ($i = 1; $i <= 31; $i++) {
                $days[] = $i;
            }
        } elseif ($month == 7 || $month == 8 || $month == 9 || $month == 10 || $month == 11) {
            for ($i = 1; $i <= 30; $i++) {
                $days[] = $i;
            }
        } else {
            for ($i = 1; $i <= 29; $i++) {
                $days[] = $i;
            }
        }
        $users = User::where('authStatus', '1')->get();
        $array = [];
        foreach ($days as $day) {
            $i = 0;
            foreach ($users->chunk(10) as $chunk) {
                foreach ($chunk as $user) {
                    $verta = Verta::instance($user->created_at);
                    $vertaDay = $verta->day;
                    $vertaMonth = $verta->month;
                    $vertaYear = $verta->year;
                    if ($vertaMonth == $month && $vertaYear == $year && $vertaDay == $day) {
                        $i++;
                    }
                }
            }
            $array[$day] = $i;
        }
        $labels = array_keys($array);
        $data = array_values($array);
        return response()->json(['labels' => $labels, 'data' => $data]);
    }

    public function contacts(){
        $contacts = Contact::all();
        return view('admin.contacts.index',compact('contacts'));
    }

    protected function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    protected function create()
    {
        $roles = Role::all();
        return view('admin.admins.create',compact('roles'));
    }

    protected function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'mobile' => 'required|numeric|regex:/09[0-9]{9}/|unique:admins,mobile',
            'password' => 'required|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8'
        ]);

        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'password' => Hash::make($request['password']),
        ]);
        $admin->assignRole($request->input('roles'));
        if ($request->input('roles') == 'فروشنده'){
            $admin->update(['is_marketer'=>1]);
        }
        return back()->with(['store' => 'success']);
    }

    protected function edit(Admin $admin)
    {

        $roles = Role::all();
        $adminRole = $admin->roles->all();
        return view('admin.admins.edit', compact('admin','roles','adminRole'));
    }

    protected function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:admins,email,{$admin->id}",
            'mobile' => "required|numeric|regex:/09[0-9]{9}/|unique:admins,mobile,{$admin->id}",
            'password' => 'nullable|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:8'
        ]);
        if ($request['password'] != null) {



            $password = Hash::make($request['password']);
            $admin->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'password' => $password,
            ]);

            DB::table('model_has_roles')->where('model_id',$admin->id)->delete();
            $admin->assignRole($request->input('roles'));
            if ($request->input('roles') == 'بازاریاب'){
                $admin->update(['is_marketer'=>1]);
            }
        } else {
            $admin->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
            ]);

            DB::table('model_has_roles')->where('model_id',$admin->id)->delete();

            $admin->assignRole($request->input('roles'));
            if ($request->input('roles') == 'بازاریاب'){
                $admin->update(['is_marketer'=>1]);
            }else{
                $admin->update(['is_marketer'=>0]);
            }
        }
        return redirect(route('admin.admins.index'))->with(['update' => 'success']);
    }

    protected function destroy(Admin $admin)
    {
        $admin->fromTask()->delete();
        $admin->toTask()->delete();
        $admin->faqs()->delete();
        $admin->delete();
        return back()->with(['destroy' => 'success']);
    }
}
