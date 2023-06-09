@extends('layouts.main-dashboard')
@section('title')پیشخوان @stop
@section('current-page-title')پیشخوان@stop
@section('breadcrumbs')
    <li class="breadcrumb-item active">پیشخوان</li>
@stop
@section('content')
    @if(auth()->user()->can('dashboard'))
        <!-- Dashboard Admin -->
        <!-- Status -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">تعداد کاربران </h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-truncate"><i class="icon-user display-5"></i></span>
                            <a class="link font-28 ml-auto">{{number_format($primaryUsers)}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">تعداد چالش اصلی</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-info"><i class="icon-question display-5"></i></span>
                            <a class="link font-28 ml-auto">{{number_format($adminChallengeCount)}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">تعداد چالش کاربر</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-success"><i class="icon-question display-5"></i></span>
                            <a class="link font-28 ml-auto">{{number_format($userChallengeCount)}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">تعداد تیکت های باز</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-warning"><i class="icon-support display-5"></i></span>
                            <a class="link font-28 ml-auto">{{number_format($openTickets)}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">تعداد سوال ادمین</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-primary"><i class="icon-bubbles display-5"></i></span>
                            <a class="link font-28 ml-auto">{{number_format($adminThreadCount)}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">تعداد سوال کاربر</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-primary"><i class="icon-bubbles display-5"></i></span>
                            <a class="link font-28 ml-auto">{{number_format($userThreadCount)}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">تعداد کامنت ها</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-danger"><i class="icon-speech display-5"></i></span>
                            <a class="link font-28 ml-auto">{{number_format($commentCount)}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">تعداد آزمون دهنده ها</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-success"><i class="icon-pencil display-5"></i></span>
                            <a class="link font-28 ml-auto">{{number_format($quizHeaderCount)}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Status -->
        <!-- Chart Status -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="ti-bar-chart-alt"></i> تعداد کاربران  جذب شده یک ماه اخیر</h4>
                        <div>
                            <canvas id="ChartTrafficMonthly" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Status -->
        <!-- End Dashboard Admin -->
    @else
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-12">خوش آمدید. </h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                            <span class="text-truncate"><i class="icon-heart display-5"></i></span>
                        </div>
                    </div>
                </div>
            </div>
    @endif
@stop
