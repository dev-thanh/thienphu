@extends('frontend.master')
@section('main')
    <main id="content-wapper">
        <!-- banner -->
        <!-- banner -->
        <section id="banner-featured_page" class="fadeIn wow" data-wow-delay="0.2s">
            <img src="{{url('/').@$cateParent->image}}" alt="bannerchild">
            <div class="background-overlay">
                <div class="container">
                    <p class="date-featured_page">{{format_datetime($data->created_at,'d/m/Y')}}</p>
                    <h2 class="caption-featured_page">{{$data->name}}</h2>
                </div>
            </div>
        </section>
        <div class="content-single">
            <div class="background-overlay">
                <div class="container">
                    <div class="row">
                        <div class="@if(count($postSame)-1 > 0) col-xs-12 col-sm-8 col-md-8 col-lg-8 main-content @else col-xs-12 col-sm-12 col-md-12 col-lg-12 @endif">
                            <div class="entry-content">
                                {!! $data->content !!}
                            </div>
                            <ul class="social-share-posts">
                                <li>Chia sẻ: </li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{url()->current()}}&display=popup&ref=plugin&src=share_button"><i class="fab fa-facebook-square"></i><span>Facebook</span></a></li>
                                <li><a href="https://twitter.com/intent/tweet?text={{$data->name}}&url=https%3A%2F%2Fbit.ly%2F3tQsRuJ"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
                                <!-- <li><a href="#"><i class="fab fa-youtube"></i><span>Youtube</span></a></li>
                                <li><a href="#"><i class="fab fa-google-plus"></i><span>Google Plus</span></a></li> -->
                            </ul>
                            <div class="pagination-posts">
                                <div class="nav-pagination-posts nav-pagination-top">
                                    @if($postPre !=null)
                                    <a href="{{route('home.single-news',['id'=>$postPre->id,'slug'=>$postPre->slug])}}">Bài trước</a>
                                    @endif
                                    @if($postNext !=null)
                                    <a href="{{route('home.single-news',['id'=>$postNext->id,'slug'=>$postNext->slug])}}">Bài Sau</a>
                                    @endif
                                </div>
                                <div class="nav-pagination-posts nav-pagination-bottom">
                                    @if($postPre !=null)
                                    <a href="{{route('home.single-news',['id'=>$postPre->id,'slug'=>$postPre->slug])}}">{{$postPre->name}}</a>
                                    @endif
                                    @if($postNext !=null)
                                    <a href="{{route('home.single-news',['id'=>$postNext->id,'slug'=>$postNext->slug])}}">{{$postNext->name}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($postSame)-1 > 0)
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 sidebar-content">
                            <h3 class="title-widget-sidebar">Bài viết liên quan</h3>
                            <div class="related-posts">
                                @foreach($postSame as $item)
                                @if($item->id != $data->id)
                                <div class="items-posts">
                                    <div class="img-posts">
                                        <a href="{{route('home.single-news',['id'=>$item->id,'slug'=>$item->slug])}}">
                                            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                        </a>
                                    </div>
                                    <div class="infor-posts">
                                        <p class="name-posts"><a href="{{route('home.single-news',['id'=>$item->id,'slug'=>$item->slug])}}">{{$item->name}}</a></p>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection