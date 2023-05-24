<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerManagement;
use App\Models\User;
use function App\helpers\numberConverter;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\CalendarUtils;

class TodosController extends Controller
{
    function __construct()
    {
//        $this->middleware('permission:file');
    }

    protected function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('admin.todos.index', compact('notifications'));
    }

    protected function filter(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'from_date' => 'required',
                'to_date' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['dateError' => $validator->errors()->toArray()]);
            }
            try {
                $from = numberConverter($request->input('from_date'));
                $to = numberConverter($request->input('to_date'));
                $from = CalendarUtils::createCarbonFromFormat('Y/m/d', $from)->format('Y-m-d');
                $to = CalendarUtils::createCarbonFromFormat('Y/m/d', $to)->format('Y-m-d');
                $type = $request->input('type');
                switch ($type) {
                    case '1':
                        $cmts = CustomerManagement::whereNotNull('reminder_date')
                            ->whereDate('reminder_date', '>=', $from)
                            ->whereDate('reminder_date', '<=', $to)
                            ->get();
                        break;
                    case '2':
                        $cmts = CustomerManagement::whereNotNull('reminder_date')
                            ->whereStatus('1')
                            ->whereDate('reminder_date', '>=', $from)
                            ->whereDate('reminder_date', '<=', $to)
                            ->get();
                        break;
                    case '3':
                        $cmts = CustomerManagement::whereNotNull('reminder_date')
                            ->whereStatus('0')
                            ->whereDate('reminder_date', '>=', $from)
                            ->whereDate('reminder_date', '<=', $to)
                            ->get();
                        break;
                }
                $rows = [];
                if (count($cmts) == 0) {
                    $html = (string)'<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">موردی یافت نشد.</td></tr>';
                } else {
                    foreach ($cmts as $key => $cmt) {
                        $rows[$key] = [
                            'user_uid' => $cmt->user->uid,
                            'user_name' => $cmt->user->name,
                            'cmt_title' => $cmt->customerManagementTitle->title,
                            'reminder_date' => Verta::instance($cmt->reminder_date)->format('Y/m/d') . '-' . $cmt->reminder_time,
                            'status' => $cmt->status,
                            'id' => $cmt->id,
                            'href' => route('admin.user.primary.edit', $cmt->user->id)
                        ];
                    }
                    $html = $rows;
                }
                return response()->json(['html' => $html]);
            } catch (\Exception $e) {
                return response()->json(['check' => 'inputs']);
            }
        }
    }
}
