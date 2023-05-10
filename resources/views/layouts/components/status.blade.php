@if($status == 0)
    <span class="badge badge-warning">در حال بررسی</span>
@elseif($status == 1)
    <span class="badge badge-primary">تایید شده</span>
@elseif($status == 2)
    <span class="badge badge-danger">رد شده</span>
@elseif($status == 3)
    <span class="badge badge-danger">منتظر تایید خریدار</span>
@elseif($status == 4)
    <span class="badge badge-danger">مصرف شده</span>
@elseif($status == 5)
    <span class="badge badge-danger">نقد شده</span>
@endif
