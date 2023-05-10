<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title"> {{$title ?? ""}} </h4>
                    <div class="page-next">
                        <nav aria-label="breadcrumb" class="d-inline-block">
                            <ul class="breadcrumb bg-white rounded shadow mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">خانه </a></li>
                                @if($sl == true)
                                    <li class="breadcrumb-item"><a href="{{$subLink}}">{{$sub ?? ""}} </a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>  <!--end col-->
        </div><!--end row-->
    </div> <!--end container-->
</section><!--end section-->
