@extends('layouts.main')
@section('title')اطلاعات ضروری | {{$setting!=null && $setting->brand!=null ? $setting->brand :  ''}}@stop
@section('content')
    <!-- Main wrapper -->
    <section id="wrapper">
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Profile -->
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">حساب کاربری</h4>
                            <p class="card-subtitle">پروفایل را برای نفر اصلی تکمیل نمایید.</p>
                            <form class="clearfix" method="post" id="primaryEssentialForm"
                                  action="{{route('essentials.store',$user->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>نام<span class="text-danger mr-1">*</span></label>
                                                <input type="text" class="form-control" placeholder=""
                                                       value="{{old('name')}}" name="name" required>
                                                @if($errors->has('name'))
                                                    <small class="invalid-text">{{$errors->first('name')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>نام کاربری<span class="text-danger mr-1">*</span></label>
                                                <input type="text" class="form-control" placeholder=""
                                                       value="{{old('username')}}" name="username" required>
                                                @if($errors->has('username'))
                                                    <small class="invalid-text">{{$errors->first('username')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ایمیل <span class="text-danger mr-1">*</span></label>
                                                <input dir="ltr" type="text" class="form-control" placeholder=""
                                                       value="{{old('email')}}" name="email" required>
                                                @if($errors->has('email'))
                                                    <small class="invalid-text">{{$errors->first('email')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>موبایل<span class="text-danger mr-1">*</span></label>
                                                <input dir="ltr" type="text" class="form-control" placeholder=""
                                                       value="{{old('mobile')}}" name="mobile" required>
                                                @if($errors->has('mobile'))
                                                    <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>تاریخ تولد <span class="text-danger mr-1">*</span></label>
                                                <input type="text" class="form-control datepicker-year" placeholder=""
                                                       value="{{old('birthDate')}}" name="birthDate">
                                                @if($errors->has('birthDate'))
                                                    <small class="invalid-text">{{$errors->first('birthDate')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>دسته مورد علاقه</label>
                                                <select class="select2 form-control custom-select" style="width: 100%;"
                                                        multiple="multiple"
                                                        name="cats[]">
                                                    <option></option>
                                                    @forelse($categories as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                                                    @empty

                                                    @endforelse

                                                </select>
                                                @if($errors->has('role'))
                                                    <small class="invalid-text">{{$errors->first('role')}}</small>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>نحوه آشنایی</label>
                                                <select class="select2 form-control custom-select" style="width: 100%;"
                                                        name="familiarity">
                                                    <option></option>
                                                    @foreach($familiarities as $familiarity)
                                                        <option value="{{$familiarity->id}}"
                                                                @if(collect(old('familiarity'))->contains($familiarity->id)) selected @endif>{{$familiarity->title}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('familiarity'))
                                                    <small class="invalid-text">{{$errors->first('familiarity')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>رمز عبور</label>
                                                <input dir="ltr" type="text" class="form-control text-left"
                                                       placeholder="پیش فرض : شماره همراه"
                                                       value="" name="password">
                                                @if($errors->has('password'))
                                                    <small class="invalid-text">{{$errors->first('password')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Date Migration -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group m-b-0">
                                                <div class="float-left">
                                                    <button type="submit"
                                                            class="btn btn-success btn-rounded waves-effect waves-light">ثبت و
                                                        ذخیره
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Profile -->
        </div>
        <!-- End Container fluid  -->
    </section>
    <!-- End Wrapper -->
@stop
