{{--    Tickets--}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true"  id="collapseTicketEdit">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="sort-table-1"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center">تیکت</th>
                                <th class="text-center">تاریخ ثبت</th>
                                <th class="text-center">بخش</th>
                                <th class="text-center">اهمیت</th>
                                <th class="text-center">وضعیت پاسخ</th>
                                <th class="text-center">وضعیت تیکت</th>
                            </tr>
                            </thead>
                            <tbody id="TicketBody">

                            </tbody>
                        </table>
                        <div id="chats" style="display:none;">

                        </div>
                        <div id="showForm" style="display: none">
                            <div class="form-group text-center">
                                <button type="button"
                                        class="btn btn-outline-success btn-rounded waves-effect waves-light"
                                        data-toggle="collapse" href="#collapseticket"><i
                                        class="ti-target align-middle ml-1"></i>ارسال سوال
                                </button>
                            </div>
                            <form
                                class="form-horizontal clearfix collapse {{$errors->has('question') || $errors->has('file') ? 'in' : ''}}"
                                id="collapseticket" method="post"
                                action="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">سوال جدید:<span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                <textarea name="question" type="text" class="form-control" rows="5"
                                          placeholder="فارسی تایپ کنید."
                                          required>{{old('question')}}</textarea>
                                        @if($errors->has('question'))
                                        <small class="invalid-text" style="float:right">{{$errors->first('question')}}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <button type="submit"
                                            class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                        ارسال
                                        سوال
                                    </button>
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                                        بستن
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

{{--    editQuestions--}}
<div class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         id="collapseQuestionEdit" aria-hidden="true">
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
                                    <small class="invalid-text" style="float:right">{{$errors->first('question')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 text-right control-label col-form-label">توضیحات سوال
                                    : </label>
                                <div class="col-12">
                                    <textarea class="tinymce-editor" id="info" name="explanation">{!! old("explanation") !!}</textarea>
                                    @if($errors->has('explanation'))
                                    <small class="invalid-text" style="float:right">{{$errors->first('explanation')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 text-right control-label col-form-label">امتیاز : <span
                                        class="text-danger mr-1">*</span></label>
                                <div class="col-sm-3">
                                    <input type="number" min="1" class="form-control" value="{{old('unit')}}" placeholder=""
                                           name="unit">
                                    @if($errors->has('unit'))
                                    <small class="invalid-text" style="float:right">{{$errors->first('unit')}}</small>
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
                                    <small class="invalid-text" style="float:right">{{$errors->first('is_active')}}</small>
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
                                    <input type="checkbox" name="is_active_answer[{{0}}]" class="form-control activy"
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
                                           class="form-control activy"
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
                                           class="form-control activy"
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
                                    <input type="checkbox" name="is_active_answer[{{3}}]" class="form-control activy"
                                           id="is_active_answer3"
                                           data-on="درست"
                                           data-off="غلط" style="width: 100%"
                                           data-toggle="toggle" data-size="bg" data-onstyle="success"
                                           data-style="ios"
                                           @if((old('is_active_answer.4'))) checked @endif />
                                </div>
                                @if($errors->has('answer'))
                                <small class="invalid-text" style="float:right">{{$errors->first('answer')}}</small>
                                @endif
                                @if($errors->has('is_active_answer'))
                                <small class="invalid-text" style="float:right">{{$errors->first('is_active_answer')}}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect waves-light" id="submitCollapseCat"
                            data-id="">ثبت ویرایش
                    </button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>

                </div>
            </form>

        </div>
    </div>
</div>
{{--Questions--}}

<div class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true"  id="collapseQuestionIndex">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="alert alert-info text-center">توجه کنید که چالش باید شامل حداقل یک سوال باشد، در غیر این
                صورت تایید نخواهد شد.
            </div>
            <div class="table-responsive px-1">
                <table id="sort-table-1"
                       class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                       width="100%">
                    <thead class="bg-success text-white">
                    <tr>
                        <th class="text-center">سوال</th>
                        <th class="text-center">نمره</th>
                        <th class="text-center">وضعیت</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="questionIndexBody">

                    </tbody>
                </table>
                <div class="form-group text-center mt-3">
                    <button type="button"
                            class="btn btn-success btn-rounded waves-effect waves-light"
                            data-toggle="collapse" href="#collapseQuestion">افزودن
                        سوال جدید
                    </button>
                </div>

                <form class="form-horizontal clearfix collapse {{session()->get('for')=='question'? 'show' : ''}}"
                      id="collapseQuestion" action="{{route('user.question.store')}}"
                      method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row form-group">
                                <input type="hidden" name="section_id" value="" id="section_id_input">
                                <label class="col-sm-3 text-right control-label col-form-label">سوال
                                    : <span
                                        class="text-danger mr-1">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" required
                                           value="{{old('question')}}"
                                           placeholder="" name="question">
                                    @if($errors->has('question'))
                                    <small
                                        class="invalid-text">{{$errors->first('question')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-12 text-right control-label col-form-label">توضیحات
                                    سوال
                                    : </label>
                                <div class="col-12">
                                    <textarea class="tinymce-editor" name="explanation">{!! old("explanation") !!}</textarea>
                                    @if($errors->has('explanation'))
                                    <small
                                        class="invalid-text" style="float:right">{{$errors->first('explanation')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 text-right control-label col-form-label">امتیاز
                                    : <span
                                        class="text-danger mr-1">*</span></label>
                                <div class="col-sm-3">
                                    <input type="number" min="0" class="form-control" value="{{old('unit')}}"
                                           placeholder="" required
                                           name="unit">
                                    @if($errors->has('unit'))
                                    <small
                                        class="invalid-text">{{$errors->first('unit')}}</small>
                                    @endif
                                </div>
                                <label class="col-sm-3 text-right control-label col-form-label">وضعیت
                                    : <span
                                        class="text-danger mr-1">*</span></label>
                                <div class="col-sm-3">
                                    <input type="checkbox" name="is_active" class="form-control"
                                           data-on="فعال"
                                           data-off="معلق" style="width: 100%" checked
                                           data-toggle="toggle" data-size="bg"
                                           data-onstyle="success"
                                           data-style="ios"
                                           @if((old('is_active'))) checked @endif />
                                    @if($errors->has('is_active'))
                                    <small
                                        class="invalid-text">{{$errors->first('is_active')}}</small>
                                    @endif
                                </div>

                            </div>
                            <hr>
                            <div class="row form-group">
                                <label class="col-sm-3 text-right control-label col-form-label">پاسخ
                                    اول : <span
                                        class="text-danger mr-1">*</span></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('answer.0')}}" name="answer[]">


                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" name="is_active_answer[{{0}}]"
                                           class="form-control activy"   id="is_active_answer-1"
                                           data-on="درست"
                                           data-off="غلط" style="width: 100%"
                                           data-toggle="toggle" data-size="bg"
                                           data-onstyle="success"
                                           data-style="ios"
                                           @if((old('is_active_answer.1'))) checked @endif />

                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 text-right control-label col-form-label">پاسخ
                                    دوم : <span
                                        class="text-danger mr-1">*</span></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('answer.1')}}" name="answer[]">

                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" name="is_active_answer[{{1}}]"
                                           class="form-control activy" id="is_active_answer-2"
                                           data-on="درست"
                                           data-off="غلط" style="width: 100%"
                                           data-toggle="toggle" data-size="bg"
                                           data-onstyle="success"
                                           data-style="ios"
                                           @if((old('is_active_answer.2'))) checked @endif />
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 text-right control-label col-form-label">پاسخ
                                    سوم : <span
                                        class="text-danger mr-1">*</span></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('answer.2')}}" name="answer[]">

                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" name="is_active_answer[{{2}}]"
                                           class="form-control activy" id="is_active_answer-3"
                                           data-on="درست"
                                           data-off="غلط" style="width: 100%"
                                           data-toggle="toggle" data-size="bg"
                                           data-onstyle="success"
                                           data-style="ios"
                                           @if((old('is_active_answer.3'))) checked @endif />
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 text-right control-label col-form-label">پاسخ
                                    چهارم : <span
                                        class="text-danger mr-1">*</span></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('answer.3')}}" name="answer[]">

                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" name="is_active_answer[{{3}}]"
                                           class="form-control activy" id="is_active_answer-4"
                                           data-on="درست"
                                           data-off="غلط" style="width: 100%"
                                           data-toggle="toggle" data-size="bg"
                                           data-onstyle="success"
                                           data-style="ios"
                                           @if((old('is_active_answer.4'))) checked @endif />
                                </div>
                                @if($errors->has('answer'))
                                <small class="invalid-text" style="float:right">{{$errors->first('answer')}}</small>
                                @endif
                                @if($errors->has('is_active_answer'))
                                <small
                                    class="invalid-text" style="float:right"> {{$errors->first('is_active_answer')}}</small>
                                @endif
                            </div>
                            <div class="form-group m-b-0">
                                <button type="submit"
                                        class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left"
                                        id="submitQuestion">ثبت
                                    سوال جدید
                                </button>
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>



                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{--section--}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" id="collapseSectionEdit">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-horizontal clearfix" id="collapseSectionForm">
                    <div class="row form-group">
                        <label class="col-sm-3 text-right control-label col-form-label">نام چالش :
                            <span
                                class="text-danger mr-1">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="title" value="{{{old('title')}}}"
                                   class="form-control"
                                   placeholder="">
                            <small class="invalid-text" style="float:right" id="toEditCollapseSectionTitle"></small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-3 text-right control-label col-form-label">دسته
                            چالش: </label>
                        <div class="col-3">
                            <select class="select2 form-control custom-select" style="width: 100%;"
                                    name="category_id">
                                <option></option>
                                @forelse($categories as $cat)
                                <option value="{{$cat->id}}"
                                        @if(collect(old('category_id'))->contains($cat->id)) selected @endif>{{$cat->title}}</option>
                                @empty

                                @endforelse

                            </select>
                            <small class="invalid-text" style="float:right" id="toEditCollapseSectionCat"></small>
                        </div>

                        <label class="col-sm-3 text-right control-label col-form-label">تاریخ
                            اتمام: </label>
                        <div class="col-3">
                            <input type="text" name="expire_date"
                                   class="form-control text-center datepicker-day"
                                   value="{{old('expire_date')}}" placeholder="">
                            <small class="invalid-text" style="float:right" id="toEditCollapseSectionExpire"></small>

                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-3 text-right control-label col-form-label">توضیحات چالش
                            : </label>
                        <div class="col-12">
                            <textarea class="tinymce-editor" id="section_info" name="description">{!! old("description") !!}</textarea>
                            <small class="invalid-text" style="float:right" id="toEditCollapseSectionDescription"></small>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label
                            class="col-sm-3 text-right control-label col-form-label">چکیده: </label>
                        <div class="col-12">
                                <textarea name="excerpt" class="form-control" rows="1"
                                          cols="1">{{old('excerpt')}}</textarea>
                            <small class="invalid-text" style="float:right"  id="toEditCollapseSectionExcerpt"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                <button type="button" class="btn btn-success waves-effect waves-light" id="submitCollapseSection"
                        data-id="">ثبت ویرایش
                </button>
            </div>
        </div>
    </div>
</div>
