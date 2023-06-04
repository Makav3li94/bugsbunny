@extends('layouts.main-front',[
        'title'=>' تضمین کیفیت و امنیت نرم افزار'.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'sl'=> false,
        'sub'=>$setting->description,
        'subLink'=>'',
        'page'=>' تضمین کیفیت و امنیت نرم افزار'.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        ]
    )
@section('content')
    <section class="doc_features_area_one">
        <div class="container">
            <div class="row">
                @forelse($frontFeatures as $item)
                    <div class="col-lg-4 col-sm-6">
                        <div class="media doc_features_item_one wow fadeInLeft" data-wow-delay="0.2s">
                            <img src="{{asset('images/front/feature/'.$item->icon)}}" alt="{{$item->title}}">
                            <div class="media-body">
                                <a href="javascript:void(0)">
                                    <h3>{{$item->title}}</h3>
                                </a>
                                <p>{{$item->sub}}</p>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse


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
                                        <h4>چالش های مرتبط با {{$cat->title}}</h4>
                                        <div class="line"></div>
                                    </div>
                                    <ul class="list-unstyled tag_list">
                                        @forelse($cat->sections as $section)
                                            <li><a href="{{route('section',$section->slug)}}"><i
                                                        class="icon_document_alt"></i>{{$section->title}}</a></li>
                                        @empty
                                            فعلا چالشی موجود نیست.
                                        @endforelse
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

                <h2 class="h_title wow fadeInUp">{{$frontWays[0]->title}}</h2>
                <p class="wow fadeInUp" data-wow-delay="0.4s">{{$frontWays[0]->sub}}</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div dir="rtl" class="documentation_text ">
                        <div class="round wow fadeInUp">
                            <img src="{{asset('images/front/way/'.$frontWays[1]->icon)}}" alt="">
                        </div>
                        <h4 class="wow fadeInUp" data-wow-delay="0.2s">{{$frontWays[1]->title}}</h4>
                        <p class="wow fadeInUp" data-wow-delay="0.3s">
                            {{$frontWays[1]->sub}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        @forelse($frontWays as $key => $item)
                            @if($key>1)
                                <div class="col-sm-6">
                                    <div class="media documentation_item wow fadeInUp">
                                        <div class="icon">
                                            <img src="{{asset('images/front/way/'.$item->icon)}}" alt="">
                                        </div>
                                        <div class="media-body">
                                            <a href="#">
                                                <h5>{{$item->title}}</h5>
                                            </a>
                                            <p>
                                                {{$item->sub}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="doc_feedback_area parallaxie sec_pad" data-background="img/bg.jpg"
             style="background: url({{asset('images/front/overlay/'.$frontOverlay->bg ?? '')}}) no-repeat scroll;">
        <div class="overlay_bg"></div>
        <div class="container">
            <div class="doc_feedback_info">
                <div class="doc_feedback_slider">
                    <div class="item">
                        <p>
                            {{$frontOverlay->body ??''}}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="doc_faq_area sec_pad">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="h_title wow fadeInUp">{{$frontFaqs[0]->title}}</h2>
                <p class="wow fadeInUp" data-wow-delay="0.2s">{{$frontFaqs[0]->sub}}</p>
            </div>
            <div class="tab-content" id="myTabContentthree">
                <div class="row">
                    @forelse($frontFaqs as $key => $item)
                        @if($key != 0)
                            <div class="col-lg-6">
                                <div class="accordion doc_faq_info" id="accordionExample">
                                    <div class="card active">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                    {{$item->question}}<i class="icon_plus"></i><i
                                                        class="icon_minus-06"></i>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                {{$item->answer}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <section class="doc_action_area parallaxie" data-background="img/bg.jpg"
             style="background: url({{asset('images/front/call/'.$frontCallTo->bg)}}) no-repeat scroll;">
        <div class="overlay_bg"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 col-sm-8">
                    <div class="action_text">
                        <h2>{{$frontCallTo->title}}</h2>
                        <p>{{$frontCallTo->sub}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4">
                    <a href="{{route($frontCallTo->link)}}" class="action_btn">{{$frontCallTo->link_title}}<i
                            class="arrow_left"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
