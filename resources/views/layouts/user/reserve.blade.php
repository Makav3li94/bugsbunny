<form action="{{route('user.do_reserve')}}" method="post">
    @csrf
    @auth
    @else
        <div class="row">
            <div class="col-md-6">
                <div class="form-group my-1">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="ti-calendar ml-2"></i>نام و نام خانوادگی: </span></div>
                        <input type="text" name="name"
                               class="form-control text-center " value=""
                               placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group my-1">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="ti-calendar ml-2"></i>شماره تلفن: </span></div>
                        <input dir="ltr" type="text" name="mobile"
                               class="form-control text-center " value=""
                               placeholder="">
                    </div>
                </div>
            </div>
            </div>
        <hr>
    @endauth

    <div class="row">
        <div class="col-md-3">
            <div class="form-group my-1">
                <div class="input-group">
                    <select name="service" id="service" class="select2 form-control custom-select"
                            style="width: 100%;">
                        <option value="">ابتدا نوع مشاوره را نتخاب کنید.</option>
                        @foreach($consulter_services as $consulter_service)
                            <option value="{{$consulter_service[0]->service->id}}">{{$consulter_service[0]->service->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group my-1">
                <div class="input-group">
                    <select name="consulter" id="consulter"
                            class="select2 form-control custom-select"
                            style="width: 100%;">

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group my-1">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="ti-calendar ml-2"></i>از تاریخ</span></div>
                    <input type="text" name="start_date" id="start_date"
                           class="form-control text-center datepicker-day" value=""
                           placeholder="">
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group my-1">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i
                                    class="ti-calendar ml-2"></i>تا تاریخ</span></div>
                    <input type="text" name="end_date" id="end_date"
                           class="form-control text-center datepicker-day" value=""
                           placeholder="">
                </div>
            </div>
        </div>

    </div>
    <div class="form-group m-b-0">
        <button type="button" onclick="reserveFunction()"
                class="btn btn-success btn-rounded waves-effect waves-light m-t-10">
            درخواست
        </button>
    </div>
</form>

<div id="reserve">

</div>


<form action="{{route('reserve_payment')}}" id="payment_form" method="post">

    {{ csrf_field() }}

    <input type="hidden" id="pay_consulter_id" name="consulter_id" value="">
    <input type="hidden" id="pay_reserve_id" name="reserve_id" value="">
    <input type="hidden" id="pay_cost" name="cost" value="">
</form>
