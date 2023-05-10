@extends('layouts.main-dashboard')
@section('title')لیست اسلایدرها@stop
@section('current-page-title')لیست اسلایدرها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">تنظیمات</li>
    <li class="breadcrumb-item">اسلایدرها</li>
    <li class="breadcrumb-item active">لیست اسلایدرها</li>
@stop
@section('content')
    <!-- List Admin -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست اسلایدرها</h4>
                    <p class="card-subtitle">در اینجا لیست اسلایدرهای نمایش داده شده در صفحه کاربران سایت را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">لینک عکس</th>
                                <th class="text-center">آدرس مقصد</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $key=>$slider)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>
                                        {{$slider->image_link,100,'(...)'}}
                                    </td>

                                    <td>
                                        {{$slider->href==null ? '-' : $slider->href,100,'(...)'}}
                                    </td>
                                    <td style="width: 120px;">
                                        <a href="{{route('admin.slider.edit',$slider->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-slider"
                                                id="{{$slider->id}}"><i
                                                    class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.slider.destroy',$slider->id)}}"
                                              id="{{$slider->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Admin -->
@stop
