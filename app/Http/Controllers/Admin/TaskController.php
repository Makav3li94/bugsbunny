<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use function App\Helpers\numberConverter;
use App\Models\Task;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\CalendarUtils;

class TaskController extends Controller
{
    function __construct()
    {
//        $this->middleware('permission:task');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function index()
    {

        $tasks = Task::orderBy('id', 'desc')->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()
    {
        $admins = Admin::all();
        return view('admin.tasks.create', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function store(Request $request)
    {
        $adminIds = Admin::all()->pluck('id')->toArray();
        $adminIdString=implode(',',$adminIds);
        $request->validate([
            'from_id' => "required|numeric|integer|in:{$adminIdString}",
            'to_id' => "required|numeric|integer|in:{$adminIdString}",
            'description' => "required",
        ]);
        Task::create([
            'from_id' => $request['from_id'],
            'to_id' => $request['to_id'],
            'date' => CalendarUtils::createCarbonFromFormat('Y/m/d', numberConverter($request['date']))->format('Y-m-d'),
            'description' => $request['description'],
        ]);
        return back()->with(['store' => 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    protected function edit(Task $task)
    {
        $admins = Admin::all();
        return view('admin.tasks.edit', compact('admins', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $request, Task $task)
    {
        $adminIds = Admin::all()->pluck('id')->toArray();
        $adminIdString=implode(',',$adminIds);
        $request->validate([
            'from_id' => "required|numeric|integer|in:{$adminIdString}",
            'to_id' => "required|numeric|integer|in:{$adminIdString}",
            'description' => "required",
        ]);
        $task->update([
            'from_id' => $request['from_id'],
            'to_id' => $request['to_id'],
            'date' => CalendarUtils::createCarbonFromFormat('Y/m/d', numberConverter($request['date']))->format('Y-m-d'),
            'description' => $request['description'],
        ]);
        return redirect(route('admin.task.index'))->with(['update' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     */
    protected function destroy(Task $task)
    {
        $task->forceDelete();
        return back()->with(['destroy' => 'success']);
    }

    protected function status(Request $request, Task $task)
    {
        if ($request->ajax()) {
            $previous = $task->status;
            switch ($previous) {
                case '0':
                    $task->update(['status' => '1']);
                    break;
                case '1':
                    $task->update(['status' => '0']);
                    break;
            }
        }
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
                        $tasks = Task::whereDate('date', '>=', $from)
                            ->whereDate('created_at', '<=', $to)
                            ->get();
                        break;
                    case '2':
                        $tasks = Task::whereStatus('1')
                            ->where('date', '>=', $from)
                            ->where('date', '<=', $to)
                            ->get();
                        break;
                    case '3':
                        $tasks = Task::whereStatus('0')
                            ->whereDate('date', '>=', $from)
                            ->whereDate('date', '<=', $to)
                            ->get();
                        break;
                }
                $rows = [];
                if (count($tasks) == 0) {
                    $html = (string)'<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">موردی یافت نشد.</td></tr>';
                } else {
                    foreach ($tasks as $key => $task) {
                        $task->date == null ? $date = '-' : $date = $task->date;
                        $rows[$key] = [
                            'from_name' => $task->fromAdmin->name,
                            'to_name' => $task->toAdmin->name,
                            'created_at' => Verta::instance($task->created_at)->format('Y/m/d'),
                            'date' => Verta::instance($date)->format('Y/m/d'),
                            'description' => $task->description,
                            'status' => $task->status,
                            'id' => $task->id,
                            'edit_url' => route('admin.task.edit', $task->id),
                            'destroy_url' => route('admin.task.destroy',  $task->id),
                            'token'=>csrf_token()
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
