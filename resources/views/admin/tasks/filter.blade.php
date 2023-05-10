@foreach($tasks as $key=>$task)
    <tr>
        <td style="width: 55px;">{{$key+1}}</td>
        <td>{{$task->fromAdmin->name}}</td>
        <td>{{$task->toAdmin->name}}</td>
        <td  dir="ltr">{{Verta::instance($task->created_at)->format('Y/m/d - H:i')}}</td>
        <td>{{$task->date}}</td>
        <td>{{$task->description}}</td>
        <td><input type="checkbox" class="toggle-task"  data-on="بله"
                   data-off="خیر"
                   data-toggle="toggle" data-size="sm" data-onstyle="success"
                   data-style="ios" disabled
                   @if($task->status=='1') checked @endif id="{{$task->id}}"/></td>
        <td style="width: 120px;">
            <a href="{{route('admin.task.edit',$task->id)}}"
               class="btn btn-success btn-sm"><i
                        class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
            </a>
            <button type="button" class="btn btn-danger btn-sm delete-task" id="{{$task->id}}"><i
                        class="d-inline-flex align-middle ti-close"></i></button>
            <form method="post" action="{{route('admin.task.destroy',$task->id)}}" id="{{$task->id}}">
                @csrf
                @method('DELETE')
            </form>
        </td>
    </tr>
@endforeach
