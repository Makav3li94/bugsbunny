@foreach($cmts as $key=>$cmt)
    <tr>
        <td style="width: 55px;">{{$key+1}}</td>
        <td>VN-{{$cmt->user->uid}}</td>
        <td>{{$cmt->user->name}}</td>
        <td>{{$cmt->customerManagementTitle->title}}</td>
        <td dir="ltr">{{Verta::instance($cmt->reminder_date)->format('Y/m/d')}}
            - {{$cmt->reminder_time}}</td>
        <td><input type="checkbox"  class="toggle-cmt" data-on="بله"
                   data-off="خیر"
                   data-toggle="toggle" data-size="sm" data-onstyle="success"
                   data-style="ios" disabled
                   @if($cmt->status=='1') checked @endif id="{{$cmt->id}}"/></td>
        <td style="width: 120px;">
            <a href="{{route('admin.user.primary.edit',$cmt->user->id)}}" class="btn btn-success btn-sm"><i class="d-inline-flex align-middle ti-eye ml-1"></i>مشاهده پرونده</a>
        </td>
    </tr>
@endforeach
