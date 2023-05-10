@if($method == 1)
    <span class="badge badge-warning">نقدی</span>
@elseif($method == 2)
    <span class="badge badge-primary">اعتباری</span>
@else
    <span class="badge badge-danger">کیف پول</span>
@endif
