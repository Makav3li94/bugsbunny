@extends('layouts.main-dashboard')
@section('title')پیشخوان {{isset($setting) && $setting->brand!=null ? $setting->brand : ''}}@stop
@section('current-page-title')پیشخوان@stop
@section('breadcrumbs')
    <li class="breadcrumb-item active">پیشخوان</li>
@stop
@section('content')
    <!-- Dashboard User -->
    <!-- row Slider + Detail -->
    <div class="row d-lg-flex align-items-lg-center mb-2">
        @if(count($sliders)>0)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body p-2">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @foreach($sliders as $key=>$slider)
                                    <div class="carousel-item {{$key==0 ? 'active' : ''}}">
                                        @if($slider->href!=null)
                                            <a href="{{$slider->href}}" target="_blank">
                                                @endif
                                                <img class="img-responsive"
                                                     src="{{$slider->image_link}}"
                                                     alt=""/>
                                                @if($slider->href!=null)
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="{{count($sliders)>0 ? 'col-lg-8' : 'col-lg-12'}}">
            <div class="card mb-0">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-lg-3 col-sm-3">
                            <div class="card mb-sm-0 mb-lg-3">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white mb-0">1 تومان</h1>
                                    <h6 class="text-white mb-0">تعداد</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="card mb-sm-0 mb-lg-3">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white mb-0">1</h1>
                                    <h6 class="text-white mb-0">تعداد</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="card mb-0 mb-sm-0">
                                <div class="box bg-warning text-center">
                                    <h1 class="font-light text-white mb-0">1عدد</h1>
                                    <h6 class="text-white mb-0">تعداد </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="card mb-sm-0 mb-lg-3">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white mb-0">{{$tickets}} تیکت</h1>
                                    <h6 class="text-white mb-0">تیکت های باز شما</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End row Slider + Detail -->
    <!-- Notifications -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">کاربر گرامی<strong
                                class="mr-1 text-success">{{auth()->user()->name}}</strong> به پنل ارزیابی خوش آمدید
                    </h4>
                    @if($setting!=null && $setting->wysiwyg!=null)
                        {!! $setting->wysiwyg !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Notifications -->
    <!-- End Dashboard User -->
@stop
