@extends('layouts.main-dashboard')
@section('title')اسلایدر هیرو@stop
@section('current-page-title')اسلایدر هیرو@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">هیرو </li>
    <li class="breadcrumb-item active">اسلایدر هیرو</li>
@stop
@section('content')
    <!-- List Customer -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal clearfix" id="" action="{{route('admin.front_hero.update',$hero->id)}}"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">عنوان : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$hero->title}}" placeholder="عنوان"
                                       name="title">
                                @if($errors->has('title'))
                                    {{$errors->first('title')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">زیرنویس : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$hero->sub}}" placeholder="زیرنویس"
                                       name="sub">
                                @if($errors->has('sub'))
                                    {{$errors->first('sub')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">متن سرچ : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$hero->search_placeholder}}"
                                       placeholder="متن سرچ" name="search_placeholder">
                                @if($errors->has('search_placeholder'))
                                    {{$errors->first('search_placeholder')}}
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <button type="submit"
                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">ثبت
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Customer -->

@stop
@section('script')

@endsection
