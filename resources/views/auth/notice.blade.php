@extends('layouts.main-front',[
        'title'=>'تایید ایمیل',
        'sl'=> false,
        'sub'=>'',
        'subLink'=>'',
        'page'=>'تایید ایمیل'
        ]
    )
@section('content')
    <section class="doc_blog_grid_area sec_pad chaleshkade-page-content">
        <div class="container">
            <div class="card bb-radius">
                <div class="card-body">
                    <div class="row">
                        <div class="bg-light p-5 rounded">

                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    ایمیل فعال سازی جدید برای شما ارسال شد.
                                </div>
                            @endif

                            در صورتی که این صفحه را مشاهده می کنید، ایمیل خود را تایید نکرده اید. لطفا جهت استفاده از خدمات سامانه، ایمیل خود را تایید کنید.
                            <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="d-inline btn btn-link p-0">
                                  ایمیلی دریافت نکردم، یکی دیگه بفرست !
                                </button>
                                .
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')

@stop
