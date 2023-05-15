@extends('layouts.main-dashboard')
@section('title')لیست سوالات {{$challenge->title}}@stop
@section('current-page-title')لیست سوالات {{$challenge->title}}@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">سوالات</li>
    <li class="breadcrumb-item active">{{$challenge->title}}لیست سوالات</li>
@stop
@section('content')
    <!-- List Customer -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست سوالات {{$challenge->title}}</h4>
                    <p class="card-subtitle">در اینجا لیست سوالات خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table-1"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">سوال</th>
                                <th class="text-center">واحد</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="questionBody">
                            @foreach($challenge->questions as $key=>$question)

                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>

                                    <td>{{$question->question}}</td>
                                    <td>{{$question->unit}}</td>
                                    <td>
                                        @if($question->is_active)
                                            <span class="badge badge-pill badge-success">تایید شده</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">تایید نشده</span>
                                        @endif
                                    </td>

                                    <td style="width: 120px;">
                                        <button class="btn btn-success btn-sm edit-question" id="{{$question->id}}"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm delete-question"
                                                id="{{$question->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.question.destroy',$question->id)}}"
                                              id="{{$question->id}}">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group text-center mt-3">
                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                                data-toggle="collapse" href="#collapseQuestion">افزودن سوال جدید
                        </button>
                    </div>
                    <form class="form-horizontal clearfix collapse" id="collapseQuestion"
                          action="{{route('admin.question.store',['id'=>$challenge->id])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">سوال : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{old('question')}}"
                                               placeholder="" name="question">
                                        @if($errors->has('question'))
                                            <small class="invalid-text">{{$errors->first('question')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">توضیحات سوال
                                        : </label>
                                    <div class="col-12">
                                <textarea name="explanation" id="editor1" rows="2"
                                          cols="2">{{old('explanation')}}</textarea>
                                        @if($errors->has('explanation'))
                                            <small class="invalid-text">{{$errors->first('explanation')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">واحد : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" value="{{old('unit')}}" placeholder=""
                                               name="unit">
                                        @if($errors->has('unit'))
                                            <small class="invalid-text">{{$errors->first('unit')}}</small>
                                        @endif
                                    </div>
                                    <label class="col-sm-3 text-right control-label col-form-label">وضعیت : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" name="is_active" class="form-control" data-on="فعال"
                                               data-off="معلق" style="width: 100%" checked
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios" @if((old('is_active'))) checked @endif />
                                        @if($errors->has('is_active'))
                                            <small class="invalid-text">{{$errors->first('is_active')}}</small>
                                        @endif
                                    </div>

                                </div>
                                <hr>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ اول : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required
                                               value="{{old('answer.0')}}" name="answer[]">


                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{0}}]" class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.1'))) checked @endif />

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ دوم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required
                                               value="{{old('answer.1')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{1}}]" class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.2'))) checked @endif />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ سوم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required
                                               value="{{old('answer.2')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{2}}]" class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.3'))) checked @endif />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ چهارم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required
                                               value="{{old('answer.3')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{3}}]" class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.4'))) checked @endif />
                                    </div>
                                    @if($errors->has('answer'))
                                        <small class="invalid-text">{{$errors->first('answer')}}</small>
                                    @endif
                                    @if($errors->has('is_active_answer'))
                                        <small class="invalid-text">{{$errors->first('is_active_answer')}}</small>
                                    @endif
                                </div>
                                <div class="form-group m-b-0">
                                    <button type="submit"
                                            class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left"
                                            id="submitQuestion">ثبت
                                        سوال جدید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Customer -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseQuestionEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form class="form-horizontal clearfix" action="" id="collapseQuestionForm" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">سوال : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{old('question')}}"
                                               placeholder="" name="question">
                                        @if($errors->has('question'))
                                            <small class="invalid-text">{{$errors->first('question')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">توضیحات سوال
                                        : </label>
                                    <div class="col-12">
                                <textarea name="explanation" id="editor3" rows="2"
                                          cols="2">{{old('explanation')}}</textarea>
                                        @if($errors->has('explanation'))
                                            <small class="invalid-text">{{$errors->first('explanation')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">واحد : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" value="{{old('unit')}}" placeholder=""
                                               name="unit">
                                        @if($errors->has('unit'))
                                            <small class="invalid-text">{{$errors->first('unit')}}</small>
                                        @endif
                                    </div>
                                    <label class="col-sm-3 text-right control-label col-form-label">وضعیت : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" id="questin_is_active" name="is_active"
                                               class="form-control" data-on="فعال"
                                               data-off="معلق" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success">
                                        @if($errors->has('is_active'))
                                            <small class="invalid-text">{{$errors->first('is_active')}}</small>
                                        @endif
                                    </div>

                                </div>
                                <hr>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ اول : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="answer0" placeholder="" required
                                               value="{{old('answer.0')}}" name="answer[]">


                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{0}}]" class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" id="is_active_answer0"
                                               data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.1'))) checked @endif />

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ دوم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="answer1" placeholder="" required
                                               value="{{old('answer.1')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{1}}]" id="is_active_answer1"
                                               class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.2'))) checked @endif />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ سوم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required id="answer2"
                                               value="{{old('answer.2')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{2}}]" id="is_active_answer2"
                                               class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.3'))) checked @endif />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ چهارم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required id="answer3"
                                               value="{{old('answer.3')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{3}}]" class="form-control"
                                               id="is_active_answer3"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.4'))) checked @endif />
                                    </div>
                                    @if($errors->has('answer'))
                                        <small class="invalid-text">{{$errors->first('answer')}}</small>
                                    @endif
                                    @if($errors->has('is_active_answer'))
                                        <small class="invalid-text">{{$errors->first('is_active_answer')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light" id="submitCollapseCat"
                                data-id="">ثبت ویرایش
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Customer -->

@stop

@section('script')
    <script src="{{ asset('admin/assets/node_modules/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1', {

            contentsLangDirection: 'rtl',
            // language: 'fa',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

        });

    </script>
@endsection
