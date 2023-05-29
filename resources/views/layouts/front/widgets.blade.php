<div class="forum_sidebar">
    <div class="doc_rightsidebar scroll">
        <div class="doc_switch">
            <label for="something" class="tab-btn tab-btns"><i class="icon_lightbulb_alt"></i></label>
            <input type="checkbox" name="something" id="something" class="tab_switcher">
            <label for="something" class="tab-btn"><i class="far fa-moon"></i></label>
        </div>
    </div>
    <div class="widget ticket_widget">
        <h4 class="c_head">بهترین های کلی</h4>

        <ul class="list-unstyled ticket_categories">
            @forelse($HighAllTimeUsers as $item)
                <li>
                    <img src="@if($item['avatar']!="" || $item['avatar'] !=null ) {{asset('images/user/'.$item['avatar']) }}@else {{asset('front/img/home_one/1.png')}} @endif" alt="{{$item['username']}}" width="30">
                    <a href="{{route('user',$item['username'])}}">{{$item['username']}}</a>
                    <span class="count">
                        @foreach($HighAllTimeUsersScores as $score)
                            @if($score->user_id == $item['id'])
                                {{$score->total." امتیاز"}}
                            @endif

                        @endforeach

                    </span>
                </li>
            @empty

            @endforelse

        </ul>
    </div>
    <div class="widget ticket_widget">
        <h4 class="c_head">پربازدید ترین ها</h4>

        <ul class="list-unstyled ticket_categories">
            @forelse($mostViewed as $item)
                <li>
                    {{--                <img src="{{asset('front/img/home_support/cmm5.png')}}" alt="category">--}}
                    <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                    <span class="count">{{$item->total_views." بازدید"}}</span>
                </li>
            @empty

            @endforelse
        </ul>
    </div>
    <div class="widget ticket_widget">
        <h4 class="c_head">محبوب ترین ها</h4>

        <ul class="list-unstyled ticket_categories">
            @forelse($mostPopular as $item)
                <li>
                    {{--                <img src="{{asset('front/img/home_support/cmm5.png')}}" alt="category">--}}
                    <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                    <span class="count">{{$item->replies_count." پاسخ"}}</span>
                </li>
            @empty

            @endforelse

        </ul>
    </div>

    <div class="widget ticket_widget">
        <h4 class="c_head">بروزترین ها</h4>

        <ul class="list-unstyled ticket_categories">
            @forelse($latestComment as $item)
                <li>
                    {{--                <img src="{{asset('front/img/home_support/cmm5.png')}}" alt="category">--}}
                    <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                    <span class="count">{{verta($item->latestReply->created_at)->formatDifference()}}</span>
                </li>
            @empty

            @endforelse

        </ul>
    </div>
    <div class="widget tag_widget">
        <h4 class="c_head">دسته ها</h4>
        <ul class="list-unstyled w_tag_list style-light">
            @forelse($categories as $cat)
                <li><a href="{{route('archive',$cat->title)}}">{{$cat->title}}</a></li>
            @empty
            @endforelse
        </ul>
    </div>

</div>
