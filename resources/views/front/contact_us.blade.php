@extends('layouts.main-front',[
        'title'=>'تماس با ما'.' - '.(!isset($setting) ? $setting->brand : 'ایزباگ'),
        'sl'=> false,
        'sub'=>'فرم تماس با ما'.' - '.(!isset($setting) ? $setting->brand : 'ایزباگ'),
        'subLink'=>'',
        'page'=>'تماس با ما'.' - '.(!isset($setting) ? $setting->brand : 'ایزباگ'),
        ]
    )
@section('content')
    <section class="contact_area sec_pad">
        <div class="container">
            <div class="section_title text-left">
                <h2 class="h_title wow fadeInUp">سوالی دارید ؟ چیزی تو ذهنتونه ؟ بپرسید</h2>
            </div>
            <div class="contact_info">
                <div class="section_title text-left">
                    <h2 class="h_title wow fadeInUp">فرم زیر را پر کنید</h2>
                    <p>فرم تماس با ما</p>
                </div>
                <form action="{{route('contact_us_store')}}" class="contact_form" method="post">
                    @csrf
                    <div class="row contact_fill">
                        <div class="col-lg-6 form-group">
                            <h6>نام و نام خانوادگی</h6>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required id="name" placeholder="">
                            @if($errors->has('name'))
                                <small class="invalid-text">{{$errors->first('name')}}</small>
                            @endif
                        </div>
                        <div class="col-lg-6 form-group">
                            <h6>ایمیل</h6>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}" required id="email" placeholder="">
                            @if($errors->has('email'))
                                <small class="invalid-text">{{$errors->first('email')}}</small>
                            @endif
                        </div>
                        <div class="col-lg-6 form-group">
                            <h6>شماره تلفن</h6>
                            <input type="tel" class="form-control" name="tel" value="{{old('tel')}}" required id="phone" placeholder="">
                            @if($errors->has('phone'))
                                <small class="invalid-text">{{$errors->first('tel')}}</small>
                            @endif
                        </div>
                        <div class="col-lg-6 form-group">
                            <h6>کپچا</h6>
                            <input class="form-control text-center" type="text" required       style="direction: rtl"
                                   placeholder="{{$array[2].' '.$array[1].' '.$array[0]}} برابر با چه عددی است؟ "
                                   name="result">
                            @if(session()->get('result')=='incorrect')
                                <small class="invalid-text">حاصل عبارت فوق نادرست می باشد</small>
                            @endif
                            <input type="hidden" name="a" value="{{$array[0]}}">
                            <input type="hidden" name="operator" value="{{$array[1]}}">
                            <input type="hidden" name="b" value="{{$array[2]}}">
                        </div>
                        <div class="col-lg-12 form-group">
                            <h6>متن پیام</h6>
                            <textarea class="form-control message" name="message" required id="message"
                                      placeholder="">{{old('message')}}</textarea>
                            @if($errors->has('message'))
                                <small class="invalid-text">{{$errors->first('message')}}</small>
                            @endif
                        </div>
                        <div class="col-lg-12 form-group">
                            <button type="submit" class="btn action_btn thm_btn">ارسال</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
