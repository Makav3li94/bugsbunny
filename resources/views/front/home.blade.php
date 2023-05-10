@extends('layouts.main-front',[
        'title'=>'buggy',
        'sl'=> false,
        'sub'=>'',
        'subLink'=>'',
        'page'=>'buggy'
        ]
    )
@section('content')
    <section class="doc_features_area_one">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="media doc_features_item_one wow fadeInLeft" data-wow-delay="0.2s">
                        <img src="{{asset('front/img/home_one/Lamp_idea.png')}}" alt="">
                        <div class="media-body">
                            <a href="#">
                                <h3>ثبت نام آسان</h3>
                            </a>
                            <p>به سادگی هر چه تمام تر بدون دردسر در ایزباگ ثبت نام کنید.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="media doc_features_item_one wow fadeInLeft" data-wow-delay="0.5s">
                        <img src="{{asset('front/img/home_one/chat.png')}}" alt="">
                        <div class="media-body">
                            <a href="#">
                                <h3>شرکت در چالش</h3>
                            </a>
                            <p>ما برای شما چالش های مختلف قرار می دهیم تا بتوانیم سطح شما را بسنجیم .</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="media doc_features_item_one wow fadeInLeft" data-wow-delay="0.7s">
                        <img src="{{asset('front/img/home_one/Duplicate.png')}}" alt="">
                        <div class="media-body">
                            <a href="#">
                                <h3>دریافت پاداش</h3>
                            </a>
                            <p>به صورت دوره ای جوایزی در نظر می گیریم تا باعث تشویق شما شویم. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="doc_tag_area">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="h_title wow fadeInUp">دسته بندی ها</h2>
            </div>
            <ul class="nav nav-tabs doc_tag" id="myTab" role="tablist">
                @forelse($categories as $key=> $cat)
                    <li class="nav-item wow fadeInLeft">
                        <a class="nav-link {{$key==1 ? 'active':''}}" id="or-tab" data-toggle="tab"
                           href="#{{$cat->title}}" role="tab"
                           aria-controls="or" aria-selected="true">{{$cat->title}}</a>
                    </li>
                @empty

                @endforelse
            </ul>
            <div class="tab-content" id="myTabContent">
                @forelse($categories as $key=> $cat)
                    <div class="tab-pane doc_tab_pane fade show {{$key==1 ? 'active':''}}" id="{{$cat->title}}"
                         role="tabpanel"
                         aria-labelledby="or-tab">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="doc_tag_item wow fadeInUp">
                                    <div class="doc_tag_title">
                                        <h4>Getting Started</h4>
                                        <div class="line"></div>
                                    </div>
                                    <ul class="list-unstyled tag_list">
                                        <li><a href="#"><i class="icon_document_alt"></i>{{$cat->title}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

            </div>
        </div>
    </section>
    <section class="h_doc_documentation_area bg_color sec_pad">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="h_title wow fadeInUp">مسیر همکاری تسترها با ایزباگ</h2>
                <p class="wow fadeInUp" data-wow-delay="0.4s">تستر ها طی چه مراحلی میتونن با ایزباگ همکاری داشته باشند
                    ؟</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div dir="rtl" class="documentation_text ">
                        <div class="round wow fadeInUp">
                            <img src="{{asset('front/img/home_one/icon/file1.png')}}" alt="">
                        </div>
                        <h4 class="wow fadeInUp" data-wow-delay="0.2s">بهترین تجربه تست و کیفیت نرم افزار</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.3s">
                            بهترین تجربه تست و کیفیت نرم افزار زمانی رخ می‌دهد که تمامی مراحل تست و کیفیت به صورت جدی و دقیق انجام شود و از تکنیک‌ها و ابزارهای مناسب برای انجام آن‌ها استفاده شود. برای دستیابی به کیفیت بهتر، می‌توانید از تکنیک‌هایی مانند تست یکپارچه، تست اتوماسیون، تست فشار، تست عملکرد، تست امنیت و ... استفاده کنید. همچنین استفاده از فرآیندهای مدیریت کیفیت نرم افزار و رعایت استانداردهای مربوطه نیز در بهبود کیفیت نرم افزار موثر است.</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="media documentation_item wow fadeInUp">
                                <div class="icon">
                                    <img src="{{asset('front/img/home_one/icon/folder.png')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#">
                                        <h5>ثبت نام آسان</h5>
                                    </a>
                                    <p> به سادگی هر چه تمام تر بدون دردسر در ایزباگ ثبت نام کنید و از خدمات و سرویس ها بهره مند شوید. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="media documentation_item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon">
                                    <img src="{{asset('front/img/home_one/icon/envelope.png')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#">
                                        <h5>شرکت در چالش</h5>
                                    </a>
                                    <p> ما برای شما چالش های مختلف قرار می دهیم تا بتوانیم سطح شما را بسنجیم و در همکاری های حرفه ای تر از شما کمک بگیریم. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="media documentation_item wow fadeInUp" data-wow-delay="0.3s">
                                <div class="icon">
                                    <img src="{{asset('front/img/home_one/icon/smartphone.png')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#">
                                        <h5>دریافت پاداش</h5>
                                    </a>
                                    <p> ما برای آزمونگرهایی که در چالش ها موفقیت به دست آورند، به صورت دوره ای جوایزی در نظر می گیریم تا باعث تشویق شما شویم. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="media documentation_item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon">
                                    <img src="{{asset('front/img/home_one/icon/management.png')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#">
                                        <h5>رتبه بندی</h5>
                                    </a>
                                    <p> ما تمام آزمونگرها را با استفاده از پارامترهای مختلف به صورت مستمر رتبه بندی می کنیم تا افراد برتر ایزباگ مشخص شوند. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="media documentation_item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon">
                                    <img src="{{asset('front/img/home_one/icon/newspaper.png')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#">
                                        <h5>دعوت تخصصی</h5>
                                    </a>
                                    <p> ما از افراد برتر در پروژه های مهم و تخصصی دعوت می کنیم تا بتوانند در تیم های حرفه ای و تخصصی حضور پیدا کنند. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="media documentation_item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon">
                                    <img src="{{asset('front/img/home_one/icon/android.png')}}" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#">
                                        <h5>پروژه های تجاری</h5>
                                    </a>
                                    <p> ما از افرادی که امتیازهای خوبی بدست آورده اند دعوت می کنیم تا در پروژه های تجاری با دریافت دستمزد حضور یابند. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="doc_feedback_area parallaxie sec_pad" data-background="img/bg.jpg"
             style="background: url({{asset('front/img/home_one/feedback_bg.jpg')}}) no-repeat scroll;">
        <div class="overlay_bg"></div>
        <div class="container">
            <div class="doc_feedback_info">
                <div class="doc_feedback_slider">
                    <div class="item">
                        <p>
                            ایزباگ یک پلتفرم برای تست امنیت و کیفیت نرم افزار است. هدف ایزباگ ارائه خدمات تخصصی در حوزه امنیت و کیفیت نرم افزار است. ما مجموعه ای از متخصصان و کارشناسان این حوزه را گرد هم آورده ایم تا بتوانیم خدماتی در شان و منزلت مشتریان محترم ارائه دهیم. همان طور که می دانید، کیفیت نرم افزار یک اصل اساسی در توسعه و حفظ نرم افزار است. همچنین امنیت نرم افزار از کلیدی ترین و اساسی ترین مسائل در ساخت و نگهداری نرم افزار است.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="doc_faq_area sec_pad">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="h_title wow fadeInUp">سوالات متداول</h2>
                <p class="wow fadeInUp" data-wow-delay="0.2s">اینجا میتوندی سوالات متداول رو مشاهده کنید.</p>
            </div>
            <div class="tab-content" id="myTabContentthree">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="accordion doc_faq_info" id="accordionExample">
                                <div class="card active">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                سوال<i class="icon_plus"></i><i
                                                    class="icon_minus-06"></i>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordionExample">
                                        <div class="card-body">
                                    پاسخ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="accordion doc_faq_info" id="accordionExamples">
                                <div class="card">
                                    <div class="card-header" id="headingSix">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseSix" aria-expanded="false"
                                                    aria-controls="collapseSix">
                                                سوال 2<i class="icon_plus"></i><i
                                                    class="icon_minus-06"></i>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                         data-parent="#accordionExamples">
                                        <div class="card-body">
                                      پاسخ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <section class="doc_action_area parallaxie" data-background="img/bg.jpg"
             style="background: url({{asset('front/img/home_one/action_bg.jpg')}}) no-repeat scroll;">
        <div class="overlay_bg"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 col-sm-8">
                    <div class="action_text">
                        <h2>میخواید عضو جامعه ایزباگ بشید ؟</h2>
                        <p>کافیه ثبت نام کنید.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4">
                    <a href="{{route('register')}}" class="action_btn">عضویت در سامانه <i class="arrow_left"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
