@extends('layouts.main-dashboard')
@section('title')ویرایش نقش@stop
@section('current-page-title')ویرایش نقش @stop
@section('breadcrumbs')
    <li class="breadcrumb-item">مدیران</li>
    <li class="breadcrumb-item active">ویرایش نقش {{ $role->name }}</li>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ویرایش نقش</h4>
                    <p class="card-subtitle">در اینجا نقش را ویرایش کنید.</p>
                    <form class="clearfix" action="{{route('admin.roles.update',$role->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">عنوان</label>
                                    <input type="text" class="form-control" placeholder="" name="name"
                                           value="{{$role->name}}" id="name">
                                    @if($errors->has('name'))
                                        <small class="invalid-text">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from">از<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;"
                                            name="permission[]"  id="from" multiple="multiple" required>
                                        <option></option>
                                        @foreach($permissions as $permission)

                                            <option value="{{$permission->id}}"
                                                    @foreach($rolePermissions as $rolePermission)
                                                      {{$permission->id == $rolePermission ? 'selected="selected"' : ''}}
                                                    @endforeach>
                                                @include('admin.roles.permisions_switch')
                                            </option>

                                        @endforeach
                                    </select>
                                    @if($errors->has('permission[]'))
                                        <small class="invalid-text">{{$errors->first('permission[]')}}</small>
                                    @endif
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-b-0">
                                    <div class="float-left">
                                        <button type="submit"
                                                class="btn btn-success btn-rounded waves-effect waves-light">ویرایش
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

@stop
