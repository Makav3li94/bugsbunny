@extends('layouts.main-front',[
        'title'=>'پروفایل',
        'sl'=> false,
        'sub'=>'',
        'subLink'=>'',
        'page'=>'پروفایل'
        ]
    )
@section('style')
    <link rel="stylesheet" href="{{asset('front/user/persian-datepicker/persian-datepicker.min')}}">
    <link rel="stylesheet" href="{{asset('front/user/select2/dist/css/select2.min.css')}}">
@endsection
@section('content')
    <div class="container emp-profile">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{asset('images/user/'.$user->avatar)}}" alt=""/>
                        <div class="file btn btn-lg btn-primary">
                            {{$user->username}}
                            <input type="file" name="file"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{$user->name}}
                        </h5>
                        <h6>
                            {{$user->username}}
                        </h6>
                        <p class="proile-rating">امتیاز شما : <span>8/10</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="home" aria-selected="true">ویرایش اطلاعات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="chalenges-tab" data-toggle="tab" href="#chalenges" role="tab"
                                   aria-controls="chalenges" aria-selected="false">چالش ها</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="scores-tab" data-toggle="tab" href="#scores" role="tab"
                                   aria-controls="scores" aria-selected="false">امتیازات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab"
                                   aria-controls="activity" aria-selected="false">فعالیت ها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab"
                                   aria-controls="activity" aria-selected="false">تیکت ها</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">


                    <form  method="post" action=" {{route('logout')}}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-power-off"></i>
                            خروج</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>چالش های فعال</p>
                        <a href="">تست</a><br/>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form class="clearfix" action="{{route('user.update',$user->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>نام<span class="text-danger mr-1">*</span></label>
                                            <input type="text" class="form-control" placeholder=""
                                                   value="{{$user->name}}" name="name">
                                            @if($errors->has('name'))
                                                <small class="invalid-text">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>نام کاربری<span class="text-danger mr-1">*</span></label>
                                            <input type="text" class="form-control" placeholder=""
                                                   value="{{$user->username}}" name="username" required>
                                            @if($errors->has('username'))
                                                <small class="invalid-text">{{$errors->first('username')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ایمیل <span class="text-danger mr-1">*</span></label>
                                            <input dir="ltr" type="text" class="form-control" placeholder=""
                                                   value="{{$user->email}}" name="email">
                                            @if($errors->has('email'))
                                                <small class="invalid-text">{{$errors->first('email')}}</small>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>موبایل <span class="text-danger mr-1">*</span></label>
                                            <input dir="ltr" type="text" class="form-control" placeholder=""
                                                   value="{{$user->mobile}}" name="mobile">
                                            @if($errors->has('mobile'))
                                                <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>تاریخ تولد</label>
                                            <input type="text" class="form-control datepicker-year" placeholder=""
                                                   value="{{$user->birthDate}}" name="birthDate">
                                            @if($errors->has('birthDate'))
                                                <small class="invalid-text">{{$errors->first('birthDate')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>دسته مورد علاقه</label>
                                            <select class="select2 form-control custom-select" style="width: 100%;"
                                                    multiple="multiple"
                                                    name="cats[]">
                                                <option></option>
                                                @forelse($cats as $cat)
                                                    <option value="{{$cat->id}}"
                                                            @if(in_array($cat->id,json_decode($user->cats))) selected @endif>{{$cat->title}}</option>
                                                @empty

                                                @endforelse

                                            </select>
                                            @if($errors->has('role'))
                                                <small class="invalid-text">{{$errors->first('role')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >تصویر:</label>
                                            <div >
                                                <input type="file" name="avatar" class="form-control"
                                                       placeholder="">
                                                @if($errors->has('avatar'))
                                                    <div class="alert alert-danger">
                                                        {{$errors->first('avatar')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>رمز عبور جدید </label>
                                            <input type="password" class="form-control" placeholder=""
                                                   value="" name="password">
                                            @if($errors->has('password'))
                                                <small class="invalid-text">{{$errors->first('password')}}</small>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group m-b-0">
                                            <div class="float-left">
                                                <button type="submit"
                                                        class="btn btn-success btn-rounded waves-effect waves-light"
                                                        id="">ثبت ویرایش
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="chalenges" role="tabpanel" aria-labelledby="chalenges-tab">
                            <div class="table-responsive">
                                <table class="table table_shortcode">
                                    <thead>
                                    <tr>
                                        <th>Sample ID</th>
                                        <th>Reading #1</th>
                                        <th>Reading #2</th>
                                        <th>Reading #3</th>
                                        <th>Reading #4</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Timeline</th>
                                        <td>16</td>
                                        <td>94</td>
                                        <td>74</td>
                                        <td>56</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="scores" role="tabpanel" aria-labelledby="scores-tab">
                            <div class="table-responsive">
                                <table class="table table_shortcode">
                                    <thead>
                                    <tr>
                                        <th>Sample ID</th>
                                        <th>Reading #1</th>
                                        <th>Reading #2</th>
                                        <th>Reading #3</th>
                                        <th>Reading #4</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Timeline</th>
                                        <td>16</td>
                                        <td>94</td>
                                        <td>74</td>
                                        <td>56</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                            <div class="table-responsive">
                                <table class="table table_shortcode">
                                    <thead>
                                    <tr>
                                        <th>Sample ID</th>
                                        <th>Reading #1</th>
                                        <th>Reading #2</th>
                                        <th>Reading #3</th>
                                        <th>Reading #4</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Timeline</th>
                                        <td>16</td>
                                        <td>94</td>
                                        <td>74</td>
                                        <td>56</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@stop
@section('scripts')
    <script src="{{asset('front/user/persian-datepicker/persian-date.min.js')}}"></script>
    <script src="{{asset('front/user/persian-datepicker/persian-datepicker.min.js')}}"></script>
    <script src="{{asset('front/user/select2/dist/js/select2.full.min.js')}}"></script>

    <script>
        // ==============================================================
        // Date Picker
        // ==============================================================
        $(".datepicker-year").pDatepicker({
            "format": "YYYY/MM/DD",
            "viewMode": "year",
            "initialValue": false,
            "autoClose": true,
            "position": "auto",
            "onlyTimePicker": false,
            "onlySelectOnDate": true,
            "calendarType": "persian",
            "observer": true,
            "responsive": true
        });
        $(".custom-select").select2({
            placeholder: "انتخاب کنید",
            minimumResultsForSearch: -1,
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });
        $(".custom-select-2").select2({
            placeholder: "انتخاب کنید",
            minimumResultsForSearch: 3,
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });
        $(".select2-multiple").select2({
            placeholder: "انتخاب کنید",
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });
    </script>
@endsection
