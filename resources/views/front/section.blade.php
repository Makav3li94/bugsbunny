@extends('layouts.main-front',[
        'title'=>$section->title.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'sl'=> false,
       'sub'=>\Illuminate\Support\Str::limit($section->description,100),
        'subLink'=>'',
        'page'=>$section->title.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        ]
    )

@section('content')
    <section class="doc_blog_grid_area sec_pad chaleshkade-single-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- chaleshkade post top area -->
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="chaleshkade-post-top">
                                <a class="author-avatar" href="{{$section->type == 1 ? 'javascript:void(0)' : route('user',$section->user->username)}}">
                                    @if($section->type ==1)
                                        <img src="{{asset('admin/assets/images/2.png')}}" width="50" alt="cmm">
                                    @else
                                        <img
                                            src="@if($section->user->avatar!="" || $section->user->avatar !=null ) {{asset('images/user/'.$section->user->avatar) }}@else {{asset('front/img/home_one/1.png')}} @endif"
                                            width="50"
                                            alt="cmm">
                                    @endif
                                </a>
                                <div class="chaleshkade-post-author">
                                    <a class="author-name"
                                       href="{{$section->type == 1 ? 'javascript:void(0)' : route('user',$section->user->username)}}"> {{$section->type == 1 ? 'Admin' : $section->user->name}} </a>
                                    <div class="chaleshkade-author-meta mt-2">
                                        <div class="author-badge">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="16px"
                                                 height="15px">
                                                <path fill-rule="evenodd" fill="rgb(131, 135, 147)"
                                                      d="M11.729,12.136 L11.582,12.167 C11.362,12.415 11.125,12.645 10.869,12.857 L14.999,12.857 C15.134,12.857 15.255,12.944 15.307,13.077 C15.359,13.211 15.331,13.365 15.235,13.467 L14.488,14.268 C14.053,14.733 13.452,15.000 12.838,15.000 L2.495,15.000 C1.872,15.000 1.286,14.740 0.845,14.268 L0.098,13.467 C0.002,13.365 -0.026,13.211 0.026,13.077 C0.077,12.944 0.199,12.857 0.334,12.857 L4.463,12.857 C2.928,11.585 2.000,9.630 2.000,7.499 L2.000,6.785 C2.000,6.194 2.449,5.713 3.000,5.713 L12.333,5.713 C12.885,5.713 13.333,6.194 13.333,6.785 L13.333,7.343 C13.869,7.160 14.736,6.973 15.355,7.400 C15.783,7.696 16.000,8.209 16.000,8.928 C16.000,11.239 11.903,12.100 11.729,12.136 ZM14.994,8.002 C14.557,7.698 13.715,7.941 13.294,8.113 C13.197,9.261 12.837,10.339 12.255,11.269 C13.480,10.911 15.333,10.116 15.333,8.928 C15.333,8.462 15.223,8.158 14.994,8.002 ZM10.261,4.419 C10.376,4.573 10.353,4.798 10.209,4.921 C10.148,4.974 10.074,4.999 10.001,4.999 C9.903,4.999 9.807,4.954 9.740,4.865 C9.198,4.139 9.198,3.002 9.741,2.277 C10.086,1.816 10.086,1.040 9.742,0.580 C9.627,0.426 9.650,0.201 9.794,0.078 C9.937,-0.044 10.146,-0.020 10.263,0.134 C10.805,0.860 10.805,1.996 10.263,2.722 C9.917,3.183 9.917,3.959 10.261,4.419 ZM8.259,4.419 C8.373,4.573 8.350,4.798 8.207,4.921 C8.145,4.974 8.071,4.999 7.999,4.999 C7.901,4.999 7.804,4.954 7.738,4.865 C7.195,4.139 7.195,3.002 7.738,2.277 C8.082,1.816 8.082,1.040 7.739,0.580 C7.624,0.426 7.647,0.201 7.791,0.078 C7.935,-0.045 8.145,-0.020 8.259,0.134 C8.802,0.860 8.802,1.996 8.259,2.722 C7.915,3.183 7.915,3.959 8.259,4.419 ZM6.261,4.418 C6.376,4.572 6.353,4.797 6.210,4.920 C6.148,4.973 6.074,4.999 6.001,4.999 C5.903,4.999 5.807,4.953 5.741,4.865 C5.198,4.139 5.198,3.002 5.741,2.276 C6.085,1.815 6.085,1.039 5.742,0.580 C5.627,0.426 5.650,0.201 5.794,0.078 C5.937,-0.046 6.147,-0.020 6.262,0.133 C6.804,0.859 6.804,1.996 6.262,2.721 C5.918,3.182 5.918,3.959 6.261,4.418 Z"/>
                                            </svg>
                                            <span>{{$section->category->title}}</span>
                                        </div>
                                        <div class="author-badge">
                                            <i class="icon_calendar"></i>
                                            <a href="">مهلت تا
                                                : {{Verta::instance($section->expire_date)->format('Y-m-d')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            @if($section->kind == 0)
                                @switch($section->status)
                                    @case(0)
                                    <div class="alert alert-warning text-center">معلق</div>
                                    @break
                                    @case(1)
                                    <div class="alert alert-warning text-center">درحال بررسی</div>
                                    @break
                                    @case(2)
                                    <div class="alert alert-info text-center">چالش فعال است.</div>

                                    @break
                                    @case(3)
                                    <div class="alert alert-danger text-center">چالش رد شده است.</div>
                                    @break
                                    @case(4)
                                    <span class="badge badge-pill badge-danger">       چالش    پایان یافته</span>
                                    @break
                                    @default
                                @endswitch

                            @else
                                @switch($section->status)
                                    @case(0)
                                    <div class="alert alert-warning text-center">معلق</div>
                                    @break
                                    @case(1)
                                    <div class="alert alert-warning text-center">درحال بررسی</div>
                                    @break
                                    @case(2)
                                    <div class="alert alert-info text-center">سوال فعال است.</div>

                                    @break
                                    @case(3)
                                    <div class="alert alert-danger text-center">سوال رد شده است.</div>
                                    @break
                                    @case(4)
                                    <span class="badge badge-pill badge-danger"> سوال پایان یافته</span>
                                    @break
                                    @default
                                @endswitch
                            @endif
                        </div>
                    </div>
                    <hr>
                    <!-- chaleshkade post content -->
                    <div class="q-title mb-3">
                        <span class="question-icon" title="Question">{{$section->kind == 0 ? "چالش " : "سوال "}}:</span>
                        <h1>{{$section->title}}</h1>
                        @if($section->kind == 0)
                            <span class="badge prize_text">جایزه چالش: {{$section->prize_text}}</span>
                        @endif
                    </div>
                    <div class="chaleshkade-post-content">
                        <div class="content">
                            {!! $section->description !!}
                            <form action="{{route('quiz',$section)}}" method="post" class="">
                                @csrf

                                @forelse($section->questions as $key=> $question)
                                    <blockquote>
                                        <h4 class="c_head"> سوال{{$key+1}}: {{$question->question}}</h4>
                                        <div class="author">توضیحات سوال: {!! $question->explanation !!}</div>
                                        <div></div>
                                    </blockquote>
                                    <div class="row ">
                                        @forelse($question->answers as $key=> $answer)

                                            <div class="col-sm-6 form-group pb-5 ansy"
                                                 style="{{$key < 2 ? 'border-bottom: 1px dotted #313123' :''}}">
                                                <div id="registerInputWrapper">
                                                    <div class="form-check">
                                                        <input class="form-check-input" style="right: 0px" type="radio"
                                                               @if($section->status == 4 && $answer->is_checked == 1 )
                                                               checked="checked"
                                                               @endif

                                                               {{$section->status == 4  ? "hidden" : ""}}
                                                               {{$section->hasDone(auth()->id())  ? "hidden" : ""}}
                                                               id="answer{{$key}}" name="answer[{{$question->id}}]"
                                                               value="{{$answer->id}}">
                                                        <label class="form-check-label mr-4" for="answer{{$key}}">
                                                            @if($section->status == 4 && $answer->is_checked == 1 )
                                                                <span class="badge badge-success">گزینه صحیح: </span>
                                                            @endifگزینه {{$key+1}}: {{$answer->answer}}
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                @empty
                                    <hr>

                                @endforelse
                                @if($section->kind == 0)
                                    @if($section->status == 4)
                                        <div class="alert alert-danger text-center">چالش به پایان رسیده است.
                                        </div>
                                    @else

                                        @if(auth()->check())
                                            <div class="col-lg-12 text-center">
                                                @if($section->type != 1 && $section->user_id == auth()->id())
                                                    <div class="alert alert-info">شما نمیتوانید در چالش خود شرکت کنید
                                                        !
                                                    </div>
                                                @else
                                                    @if($section->hasDone(auth()->id()))
                                                        <div class="alert alert-success">با تشکر از شرکت شما در آزمون
                                                        </div>

                                                    @else
                                                        @if($section->questions->count() > 0)
                                                            <button type="submit" class="btn action_btn thm_btn">شرکت در
                                                                آزمون
                                                            </button>
                                                        @endif
                                                    @endif

                                                @endif
                                            </div>
                                        @else
                                            <div class="alert alert-warning text-center">
                                                <a href="{{route('login')}}"> جهت شرکت در چالش باید ثبت نام کنید یا وارد
                                                    شوید.</a>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </form>
                            @if($best_user != '' || $best_user != null)
                                <div class="best-answer">
                                    <div class="row">
                                        <div class="col-sm-1 text-center mb-1">
                                            <div class="chaleshkade-post-top">

                                                <div class="chaleshkade-post-author text-center">

                                                    <img src="{{asset('front/img/champion.png')}}" width="40"
                                                         alt="بهترین">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-10 mb-12" style="background: #eaff62;padding: 10px;">
                                            <span class="question-icon" title="The Best Answer">برنده چالش: </span>
                                            <p class="bst-p">
                                                برنده این چالش <a href="{{route('user',$best_user->user->username)}}">{{$best_user->user->name}}</a> است با
                                                کسب {{$best_user->score}}
                                                امتیاز !
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            @endif

                        </div>
                        <div class="chaleshkade-post-btm">
                            <div class="taxonomy chaleshkade-post-cat">
                                <img src="{{asset('front/img/favicon.png')}}" width="30px" alt="">
                            </div>
                        </div>
                        @if(auth()->check())
                            <div class="action-button-container action-btns text-center">
                                <button type="button" class="action_btn btn-ans ask-btn reply-btn"
                                        data-toggle="collapse" href="#collapseReply">افزودن کامنت
                                </button>
                            </div>

                            <form class="form-horizontal clearfix collapse mt-5" action="{{route('reply.store')}}"
                                  method="post"
                                  id="collapseReply">
                                @csrf
                                <input type="hidden" name="section_id" value="{{$section->id}}">
                                <div class="row form-group">
                                    <div class="col-sm-12">
                                    <textarea name="body" class="form-control" rows="2"
                                              cols="2">{{old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <button type="submit" class="btn btn-success btn-rounded m-t-10">ارسال
                                    </button>
                                </div>
                            </form>

                        @else
                            <div class="alert alert-info">جهات کامنت دادن باید وارد شوید یا ثبت نام کنید.</div>
                        @endif
                    </div>

                    <!-- Best answer -->

                    <!-- All answer -->
                    <div class="all-answers" id="replies">
                        <h3 class="title">تمام کامنت ها</h3>

                        @forelse($replies as $reply)
                            @if($reply->status == 1 || $reply->user_id == auth()->id())
                                <div class="chaleshkade-comment">
                                    <div class="chaleshkade-post-top">
                                        <a class="author-avatar" href="{{route('user',$reply->user->username)}}">
                                            <img
                                                src="@if($reply->user->avatar!="" || $reply->user->avatar !=null ) {{asset('images/user/'.$reply->user->avatar) }}@else {{asset('front/img/home_one/1.png')}} @endif"
                                                width="50"
                                                alt="{{$reply->user->username}}"/>
                                        </a>
                                        <div class="chaleshkade-post-author">
                                            @if($reply->status != 1 ) <span
                                                class="badge badge-danger">در انتظار تایید</span> @endif
                                            <a class="author-name"
                                               href="{{route('user',$reply->user->username)}}">{{$reply->user->username}}</a>
                                            <div class="chaleshkade-author-meta">
                                                <div class="author-badge">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="16px"
                                                         height="15px">
                                                        <path fill-rule="evenodd" fill="rgb(131, 135, 147)"
                                                              d="M11.729,12.136 L11.582,12.167 C11.362,12.415 11.125,12.645 10.869,12.857 L14.999,12.857 C15.134,12.857 15.255,12.944 15.307,13.077 C15.359,13.211 15.331,13.365 15.235,13.467 L14.488,14.268 C14.053,14.733 13.452,15.000 12.838,15.000 L2.495,15.000 C1.872,15.000 1.286,14.740 0.845,14.268 L0.098,13.467 C0.002,13.365 -0.026,13.211 0.026,13.077 C0.077,12.944 0.199,12.857 0.334,12.857 L4.463,12.857 C2.928,11.585 2.000,9.630 2.000,7.499 L2.000,6.785 C2.000,6.194 2.449,5.713 3.000,5.713 L12.333,5.713 C12.885,5.713 13.333,6.194 13.333,6.785 L13.333,7.343 C13.869,7.160 14.736,6.973 15.355,7.400 C15.783,7.696 16.000,8.209 16.000,8.928 C16.000,11.239 11.903,12.100 11.729,12.136 ZM14.994,8.002 C14.557,7.698 13.715,7.941 13.294,8.113 C13.197,9.261 12.837,10.339 12.255,11.269 C13.480,10.911 15.333,10.116 15.333,8.928 C15.333,8.462 15.223,8.158 14.994,8.002 ZM10.261,4.419 C10.376,4.573 10.353,4.798 10.209,4.921 C10.148,4.974 10.074,4.999 10.001,4.999 C9.903,4.999 9.807,4.954 9.740,4.865 C9.198,4.139 9.198,3.002 9.741,2.277 C10.086,1.816 10.086,1.040 9.742,0.580 C9.627,0.426 9.650,0.201 9.794,0.078 C9.937,-0.044 10.146,-0.020 10.263,0.134 C10.805,0.860 10.805,1.996 10.263,2.722 C9.917,3.183 9.917,3.959 10.261,4.419 ZM8.259,4.419 C8.373,4.573 8.350,4.798 8.207,4.921 C8.145,4.974 8.071,4.999 7.999,4.999 C7.901,4.999 7.804,4.954 7.738,4.865 C7.195,4.139 7.195,3.002 7.738,2.277 C8.082,1.816 8.082,1.040 7.739,0.580 C7.624,0.426 7.647,0.201 7.791,0.078 C7.935,-0.045 8.145,-0.020 8.259,0.134 C8.802,0.860 8.802,1.996 8.259,2.722 C7.915,3.183 7.915,3.959 8.259,4.419 ZM6.261,4.418 C6.376,4.572 6.353,4.797 6.210,4.920 C6.148,4.973 6.074,4.999 6.001,4.999 C5.903,4.999 5.807,4.953 5.741,4.865 C5.198,4.139 5.198,3.002 5.741,2.276 C6.085,1.815 6.085,1.039 5.742,0.580 C5.627,0.426 5.650,0.201 5.794,0.078 C5.937,-0.046 6.147,-0.020 6.262,0.133 C6.804,0.859 6.804,1.996 6.262,2.721 C5.918,3.182 5.918,3.959 6.261,4.418 Z"/>
                                                    </svg>
                                                    <span>{{$reply->user->name}}</span>
                                                </div>
                                                <div class="author-badge">
                                                    <i class="icon_calendar"></i>
                                                    <a href="">{{Verta::instance($reply->created_at)->formatDifference()}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-content">
                                        {!! $reply->body !!}
                                        @if($reply->status == 1 && auth()->check())
                                            <div class="action-button-container action-btns">
                                                <button type="button" class="action_btn btn-ans ask-btn reply-btn"
                                                        data-toggle="collapse" href="#collapseReplyChild{{$reply->id}}">
                                                    پاسخ
                                                    به
                                                    این کامنت
                                                </button>
                                                {{--                                        <a href="#" class="action_btn btn-ans ask-btn too-btn">مثبت</a>--}}
                                                @if($reply->user_id != auth()->id())
                                                    @if( \App\Models\Like::query()->whereMorphedTo('userable', auth()->user())->where([['likeable_id',$reply->id],['is_liked', true]])->get()->count() > 0)
                                                        <form action="{{route('unlikeReply',$reply->id)}}" method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-warning  ml-2">
                                                                مثبت <span>{{$reply->likes_count}}</span>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{route('likeReply',$reply->id)}}" method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-success ml-2">
                                                                مثبت <span>{{$reply->likes_count}}</span>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <form action="{{route('dislikeReply',$reply->id)}}" method="post">
                                                        @csrf
                                                        <button type="submit"
                                                                class="btn btn-sm btn-danger  ">
                                                            منفی <span>{{$reply->dislikes_count}}</span>
                                                        </button>
                                                    </form>
                                                @endif

                                            </div>
                                            <form class="form-horizontal clearfix collapse mt-5"
                                                  action="{{route('reply.store')}}"
                                                  method="post"
                                                  id="collapseReplyChild{{$reply->id}}">
                                                @csrf
                                                <input type="hidden" name="section_id" value="{{$section->id}}">
                                                <input type="hidden" name="parent_id" value="{{$reply->id}}">
                                                <div class="row form-group">
                                                    <div class="col-sm-12">
                                    <textarea name="body" class="form-control" rows="2"
                                              cols="2">{{old('body')}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <button type="submit" class="btn btn-success btn-rounded m-t-10">
                                                        ارسال
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                @forelse($reply->children as $replyChild)
                                    <div class="best-answer ">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="chaleshkade-post-top">
                                                    <a class="author-avatar"
                                                       href="{{route('user',$replyChild->user->username)}}">
                                                        <img
                                                            src="@if($replyChild->user->avatar!="" || $reply->user->avatar !=null ) {{asset('images/user/'.$replyChild->user->avatar) }}@else {{asset('front/img/home_one/1.png')}} @endif"
                                                            width="50"
                                                            alt="{{$replyChild->user->username}}"/>
                                                    </a>
                                                    <div class="chaleshkade-post-author">
                                                        <a class="author-name"
                                                           href="{{route('user',$replyChild->user->username)}}"> {{$replyChild->user->username}} </a>
                                                        <div class="chaleshkade-author-meta">
                                                            <div class="author-badge">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     width="16px"
                                                                     height="15px">
                                                                    <path fill-rule="evenodd" fill="rgb(131, 135, 147)"
                                                                          d="M11.729,12.136 L11.582,12.167 C11.362,12.415 11.125,12.645 10.869,12.857 L14.999,12.857 C15.134,12.857 15.255,12.944 15.307,13.077 C15.359,13.211 15.331,13.365 15.235,13.467 L14.488,14.268 C14.053,14.733 13.452,15.000 12.838,15.000 L2.495,15.000 C1.872,15.000 1.286,14.740 0.845,14.268 L0.098,13.467 C0.002,13.365 -0.026,13.211 0.026,13.077 C0.077,12.944 0.199,12.857 0.334,12.857 L4.463,12.857 C2.928,11.585 2.000,9.630 2.000,7.499 L2.000,6.785 C2.000,6.194 2.449,5.713 3.000,5.713 L12.333,5.713 C12.885,5.713 13.333,6.194 13.333,6.785 L13.333,7.343 C13.869,7.160 14.736,6.973 15.355,7.400 C15.783,7.696 16.000,8.209 16.000,8.928 C16.000,11.239 11.903,12.100 11.729,12.136 ZM14.994,8.002 C14.557,7.698 13.715,7.941 13.294,8.113 C13.197,9.261 12.837,10.339 12.255,11.269 C13.480,10.911 15.333,10.116 15.333,8.928 C15.333,8.462 15.223,8.158 14.994,8.002 ZM10.261,4.419 C10.376,4.573 10.353,4.798 10.209,4.921 C10.148,4.974 10.074,4.999 10.001,4.999 C9.903,4.999 9.807,4.954 9.740,4.865 C9.198,4.139 9.198,3.002 9.741,2.277 C10.086,1.816 10.086,1.040 9.742,0.580 C9.627,0.426 9.650,0.201 9.794,0.078 C9.937,-0.044 10.146,-0.020 10.263,0.134 C10.805,0.860 10.805,1.996 10.263,2.722 C9.917,3.183 9.917,3.959 10.261,4.419 ZM8.259,4.419 C8.373,4.573 8.350,4.798 8.207,4.921 C8.145,4.974 8.071,4.999 7.999,4.999 C7.901,4.999 7.804,4.954 7.738,4.865 C7.195,4.139 7.195,3.002 7.738,2.277 C8.082,1.816 8.082,1.040 7.739,0.580 C7.624,0.426 7.647,0.201 7.791,0.078 C7.935,-0.045 8.145,-0.020 8.259,0.134 C8.802,0.860 8.802,1.996 8.259,2.722 C7.915,3.183 7.915,3.959 8.259,4.419 ZM6.261,4.418 C6.376,4.572 6.353,4.797 6.210,4.920 C6.148,4.973 6.074,4.999 6.001,4.999 C5.903,4.999 5.807,4.953 5.741,4.865 C5.198,4.139 5.198,3.002 5.741,2.276 C6.085,1.815 6.085,1.039 5.742,0.580 C5.627,0.426 5.650,0.201 5.794,0.078 C5.937,-0.046 6.147,-0.020 6.262,0.133 C6.804,0.859 6.804,1.996 6.262,2.721 C5.918,3.182 5.918,3.959 6.261,4.418 Z"/>
                                                                </svg>
                                                                <span>{{$replyChild->user->name}} </span>
                                                            </div>
                                                            <div class="author-badge">
                                                                <i class="icon_calendar"></i>
                                                                <a href="">{{Verta::instance($replyChild->created_at)->formatDifference()}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <p class="accepted-ans-mark">
                                                    <i class="icon_check"></i>
                                                    <span>در پاسخ به {{$reply->user->username}} </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="best-ans-content d-flex">
                                            <div class="action-button-container action-btns">
                                                @if($replyChild->user_id != auth()->id())
                                                    <form action="{{route('likeReply',$replyChild->id)}}" method="post">
                                                        @csrf
                                                        <button type="submit"
                                                                class="action_btn btn-ans ask-btn too-btn">
                                                            مثبت <span>{{$replyChild->likes_count}}</span>
                                                        </button>
                                                    </form>
                                                    <form action="{{route('dislikeReply',$replyChild->id)}}"
                                                          method="post">
                                                        @csrf
                                                        <button type="submit"
                                                                class="action_btn btn-ans ask-btn too-btn">
                                                            منفی <span>{{$replyChild->dislikes_count}}</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <p>
                                                {!! $replyChild->body !!}
                                            </p>
                                        </div>
                                    </div>
                                @empty

                                @endforelse
                            @endif
                        @empty

                        @endforelse


                    </div>
                </div>
                <!-- /.col-lg-8 -->

            </div>
        </div>
    </section>
@endsection
@section('scripts')

@endsection
