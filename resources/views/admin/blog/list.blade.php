@extends('layouts.main-dashboard')
@section('title')لیست صفحات@stop
@section('current-page-title')مدیریت صفحات@stop
@section('breadcrumbs')
    <li class="breadcrumb-item "><a href="javascript:void(0)">مدیریت صفحات</a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">لیست صفحات</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست صفحات</h4>
                    <p class="card-subtitle">در اینجا میتوانید لیست صفحات را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">لینک</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $key=>$blog)
                                <tr>
                                    <td style="width: 55px;">{{$key + 1}}</td>
                                    <td>{{$blog->title}}</td>
                                    <td>
                                        <div class="position-relative">
                                            <input type="text" value="{{$blog->slug}}"
                                                   class="form-control text-left w-75 mr-3" id="link-{{$blog->id}}">

                                        </div>
                                    </td>
                                    <td style="width: 120px;">
                                        <button class="btn btn-sm btn-success "
                                                style="top:5px;right: 0px" onclick="copyText('link-{{$blog->id}}')"><i class="fa fa-copy"></i></button>
                                        <a href="{{route('blog',$blog->slug)}}" target="_blank"
                                           class="btn btn-sm btn-primary "
                                           style="top:5px;right: 100px"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('admin.blog.edit',$blog->id)}}" class="btn btn-success btn-sm">
                                            <i class="d-inline-flex align-middle ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.blog.destroy',$blog->id) }}" id="{{ $blog->id}}" method="post" class="d-inline">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm delete-alert text-white"
                                               id="{{ $blog->id}}">
                                                <i class="d-inline-flex align-middle ti-close"></i>
                                            </button>
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
@endsection

@section('custome_scripts')
    <script>
        function copyText(val) {
            /* Get the text field */
            var copyText = document.getElementById(val);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            // alert("لینک کپی شد: " + copyText.value);
        }
    </script>
@endsection
