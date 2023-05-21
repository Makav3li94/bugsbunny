@extends('layouts.main-front',[
        'title'=>'ایزباگ',
        'sl'=> false,
        'sub'=>'',
        'subLink'=>'',
        'page'=>'ایزباگ'
        ]
    )
@section('content')
    <section class="doc_categories_guide_area sec_pad">
        <img class="shap" src="{{asset('front/img/home_one/dow_bg_two.png')}}" alt="">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="h_title wow fadeInUp">Check out our guide categories</h2>
                <p class="wow fadeInUp" data-wow-delay="0.2s">Some dodgy chav bevvy amongst argy-bargy spiffing
                    absolutely bladdered nancy boy cup of tea a load of old tosh porkies.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="categories_guide_item wow fadeInUp">
                        <img src="img/home_two/folder.png" alt="">
                        <div class="doc_tag_title">
                            <h4>Getting Started</h4>
                        </div>
                        <ul class="list-unstyled tag_list">
                            <li><a href="#"><i class="icon_document_alt"></i>Setup home page layout</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>BBpress sidebar layout styles</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Knowledgebase page setup</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Creating home page blocks</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>How do i add FAQ post</a></li>
                        </ul>
                        <a href="#" class="doc_border_btn">More<i class="arrow_left"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="categories_guide_item wow fadeInUp" data-wow-delay="0.2s">
                        <img src="img/home_two/info.png" alt="">
                        <div class="doc_tag_title">
                            <h4>Integrations</h4>
                        </div>
                        <ul class="list-unstyled tag_list">
                            <li><a href="#"><i class="icon_document_alt"></i>How To Install Manual Theme</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Theme license information</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>How do i create tree structure menu</a>
                            </li>
                            <li><a href="#"><i class="icon_document_alt"></i>How do I login forum section</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>How do I login forum section</a></li>
                        </ul>
                        <a href="#" class="doc_border_btn">More<i class="arrow_left"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="categories_guide_item wow fadeInUp" data-wow-delay="0.4s">
                        <img src="img/home_two/weather.png" alt="">
                        <div class="doc_tag_title">
                            <h4>Cloud Server</h4>
                        </div>
                        <ul class="list-unstyled tag_list">
                            <li><a href="#"><i class="icon_document_alt"></i>Mailbox and User Settings</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Preparing your server for
                                    installation</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Managing Docs in Docly</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>How do i add FAQ post</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Creating home page blocks</a></li>
                        </ul>
                        <a href="#" class="doc_border_btn">More<i class="arrow_left"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="categories_guide_item wow fadeInUp" data-wow-delay="0.2s">
                        <img src="img/home_two/settings.png" alt="">
                        <div class="doc_tag_title">
                            <h4>User Settings</h4>
                        </div>
                        <ul class="list-unstyled tag_list">
                            <li><a href="#"><i class="icon_document_alt"></i>Do I need to know coding</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Managing Docs in Docly</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Working with Conversations</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Copying Email to Docly</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Knowledgebase page setup</a></li>
                        </ul>
                        <a href="#" class="doc_border_btn">More<i class="arrow_left"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="categories_guide_item wow fadeInUp" data-wow-delay="0.4s">
                        <img src="img/home_two/memo.png" alt="">
                        <div class="doc_tag_title">
                            <h4>Reporting</h4>
                        </div>
                        <ul class="list-unstyled tag_list">
                            <li><a href="#"><i class="icon_document_alt"></i>Setup home page layout</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>BBpress sidebar layout styles</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Knowledgebase page setup</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Creating home page blocks</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>How do i add FAQ post</a></li>
                        </ul>
                        <a href="#" class="doc_border_btn">More<i class="arrow_left"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="categories_guide_item wow fadeInUp" data-wow-delay="0.6s">
                        <img src="img/home_two/share.png" alt="">
                        <div class="doc_tag_title">
                            <h4>Solar System</h4>
                        </div>
                        <ul class="list-unstyled tag_list">
                            <li><a href="#"><i class="icon_document_alt"></i>How do I contact Customer Care?</a>
                            </li>
                            <li><a href="#"><i class="icon_document_alt"></i>How to enable labs features</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Knowledgebase page setup</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>How do I login forum section</a></li>
                            <li><a href="#"><i class="icon_document_alt"></i>Mailbox and User Settings</a></li>
                        </ul>
                        <a href="#" class="doc_border_btn">More<i class="arrow_left"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="#" class="doc_border_btn all_doc_btn wow fadeInUp">View All Docs<i
                        class="arrow_left"></i></a>
            </div>
        </div>
    </section>
    <section class="doc_fun_fact_area">
        <div class="animated-waves">
            <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="animated-wave">
                <title>Wave</title>
                <defs></defs>
                <path id="animated-wave-three" d="" />
            </svg>
            <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="animated-wave">
                <title>Wave</title>
                <defs></defs>
                <path id="animated-wave-four" d="" />
            </svg>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="doc_fact_item wow fadeInUp">
                        <div class="counter">5486</div>
                        <p>Happy Customer</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="doc_fact_item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="counter">642</div>
                        <p>Cups of Coffee</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="doc_fact_item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="counter">100</div>
                        <p>Finished Projects</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="doc_fact_item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="counter">476</div>
                        <p>Staff Members</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
