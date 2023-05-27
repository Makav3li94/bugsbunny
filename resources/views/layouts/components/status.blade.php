@switch($section->status)
    @case(0)
    <span
        class="badge badge-pill badge-info">معلق</span>
    @break
    @case(1)

    <span class="badge badge-pill badge-warning">         درحال بررسی</span>
    @break
    @case(2)
    <span class="badge badge-pill badge-success">           تایید شده</span>

    @break
    @case(3)
    <span class="badge badge-pill badge-secondary">           رد شده</span>
    @break
    @case(4)
    <span class="badge badge-pill badge-primary">           پایان یافته</span>
    @break
    @default
@endswitch
