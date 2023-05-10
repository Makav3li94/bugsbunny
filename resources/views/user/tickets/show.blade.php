@extends('layouts.main-dashboard')
@section('title')مشاهده تیکت@stop
@section('current-page-title')مشاهده تیکت@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پشتیبانی</li>
    <li class="breadcrumb-item">لیست تیکت</li>
    <li class="breadcrumb-item active">مشاهده تیکت</li>
@stop
@section('content')
    <!-- Page Show Ticket -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">مشاهده تیکت {{$ticket->id}}</h4>
                    <p class="card-subtitle"> در اینجا جزئیات تیکت را مشاهده می کنید.</p>
                    <div class="table-responsive mt-4">
                        <table class="table table-sm table-striped color-table success-table table-hover text-center">
                            <thead>
                            <tr>
                                <th class="text-center">شماره تیکت</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">تاریخ ایجاد</th>
                                <th class="text-center">آخرین تغییر</th>
                                <th class="text-center">بخش مربوطه</th>
                                <th class="text-center">وضعیت پاسخ دهی</th>
                                <th class="text-center">وضعیت تیکت</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$ticket->id}}</td>
                                <td>{{$ticket->title}}</td>
                                <td>{{Verta::instance($ticket->created_at)->format('Y/n/j')}}</td>
                                <td>{{Verta::instance($ticket->updated_at)->format('Y/n/j')}}</td>
                                <td>{{$ticket->section}}</td>
                                <td>
                                    @if($ticket->answer=='0')
                                        <span class="label label-info">پیام کاربر</span>
                                    @elseif($ticket->answer=='1')
                                        <span class="label label-info">در حال رسیدگی</span>
                                    @elseif($ticket->answer=='2')
                                        <span class="label label-info">پیام مدیر</span>
                                    @endif
                                </td>
                                <td>
                                        <span class="label label-table label-{{$ticket->status=='0' ? 'danger' : 'success'}}">
                                           {{$ticket->status=='0' ? 'بسته' : 'باز'}}
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @foreach($ticket->faqs as $faq)
                        <ul class="list-unstyled p-0">
                            @if($faq->question !=null)
                            <li class="media">
                                <img class="d-none d-sm-block ml-3" src="{{asset('admin/assets/images/1.png')}}" width="60"
                                     alt="">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-2"><strong>{{$ticket->user->name}}</strong><span dir="ltr"
                                                                                                        class="float-left text-success">
                                            {{Verta::instance($faq->created_at)->format('Y/n/j - H:i')}}</span>
                                    </h5>
                                    <p class="mb-0 font-12 text-justify">{{$faq->question}}</p>
                                    @if($faq->user_file!=null)
                                        <div class="alert alert-success alert-rounded font-12 mt-2 mb-0 p-1">
                                            <i class="fa fa-check-circle fa-lg align-middle text-success"></i>
                                            <a href="{{route('user.faq.download',['type'=>'user','id'=>$faq->id,'mac'=>Hash::make('(8&J.Ke#_MR%^2P91?/\G!xZ~97LaS'.$faq->id)])}}">دانلود
                                                فایل ضمیمه کاربر</a>
                                        </div>
                                    @endif
                                </div>
                            </li>
                            @endif
                            @if($faq->reply!=null)
                                <li class="media">
                                    <img class="d-none d-sm-block ml-3" src="{{asset('admin/assets/images/2.png')}}"
                                         width="60" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-2"><strong>مدیریت</strong><span dir="ltr"
                                                                                           class="float-left text-success">
                                                {{Verta::instance($faq->reply_date)->format('Y/n/j - H:i')}}</span>
                                        </h5>
                                        <p class="mb-0 font-12 text-justify">{{$faq->reply}}</p>
                                        @if($faq->admin_file!=null)
                                            <div class="alert alert-success alert-rounded font-12 mt-2 mb-0 p-1">
                                                <i class="fa fa-check-circle fa-lg align-middle text-success"></i>
                                                <a href="{{route('user.faq.download',['type'=>'admin','id'=>$faq->id,'mac'=>Hash::make('(8&J.Ke#_MR%^2P91?/\G!xZ~97LaS'.$faq->id)])}}">دانلود
                                                    فایل ضمیمه مدیر</a>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        </ul>
                    @endforeach
                    @if($ticket->status=='1')
                        <div class="form-group text-center">
                            <button type="button"
                                    class="btn btn-outline-success btn-rounded waves-effect waves-light"
                                    data-toggle="collapse" href="#collapseticket"><i
                                        class="ti-target align-middle ml-1"></i>ارسال سوال
                            </button>
                        </div>
                        <form class="form-horizontal clearfix collapse {{$errors->has('question') || $errors->has('file') ? 'in' : ''}}"
                              id="collapseticket" method="post"
                              action="{{route('user.faq.store',$ticket->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">سوال جدید:<span
                                            class="text-danger mr-1">*</span></label>
                                <div class="col-sm-9">
                                <textarea name="question" type="text" class="form-control" rows="5"
                                          placeholder="فارسی تایپ کنید."
                                          required>{{old('question')}}</textarea>
                                    @if($errors->has('question'))
                                        <small class="invalid-text">{{$errors->first('question')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">پیوست فایل
                                    جدید:</label>
                                <div class="col-sm-9">
                                    <input name="file" type="file" class="form-control">
                                    <small class="text-info"> فقط فایل با فرمت zip و rar و pdf و doc و docx و jpg و png و حداکثر حجم
                                        5000
                                        کیلوبایت مجاز است.
                                    </small>
                                    @if($errors->has('file'))
                                        <p>
                                            <small class="invalid-text">{{$errors->first('file')}}</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <button type="submit"
                                        class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                    ارسال
                                    سوال
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Show Ticket -->
@stop
