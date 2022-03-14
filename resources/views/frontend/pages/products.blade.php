@extends('frontend.master')
@section('main')
    <main id="content-wapper">
        <!-- banner -->
        <section id="banner-featured_page" class="fadeIn wow" data-wow-delay="0.2s">
            <img src="{{url('/').$dataSeo->image}}" alt="bannerchild">
            <div class="background-overlay">
                <div class="container">
                    <h2 class="title-featured_page">{{$dataSeo->meta_title}}</h2>
                </div>
            </div>
        </section>
        <section id="page-products">
            <div class="background-overlay">
                <div class="container">
                    <div class="page-breadcrumb">
                        <ul class="list-page-breadcrumb">
                            <li><a href="{{route('home')}}">Trang chủ</a></li>
                            <li><span>Sản phẩm</span></li>
                        </ul>
                    </div>
                    <!-- categories_carousel_1 -->
                    @foreach($collect as $k => $item)
                    <?php $products = $item->Products()->take(10)->get(); ?>
                    @if(count($products))
                    <div class="heading-categories_carousel">
                        <h2 class="name-categories_carousel">{{$item->name}}</h2>
                        <div class="readmore-categories_carousel">
                            <a href="{{route('home.cate-product',$item->slug)}}">Xem tất cả <i class='fal fa-chevron-right'></i></a>
                        </div>
                    </div>
                    <div id="categories_carousel_{{$k+1}}" class="owl-carousel owl-theme">
                        @foreach($products as $pro)
                        <div class="items-products">
                            <div class="box-products">
                                <div class="img-products">
                                    <a href="{{route('home.single-product',$pro->slug)}}">
                                    <img src="{{url('/').$pro->image}}" alt="{{$pro->name}}">
                                    </a>
                                </div>
                                <h3 class="name-products"><a href="{{route('home.single-product',$pro->slug)}}">{{$pro->name}}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    @section('script')
    <script>
      jQuery(document).ready(function($) {
        $('#page-products .owl-carousel').owlCarousel({
          loop: true,
          nav: true,
          navText: ["<i class='fal fa-chevron-left'></i>","<i class='fal fa-chevron-right'></i>"],
          dots:true,
          lazyLoad: true,
          margin: 20,
          autoplayTimeout:6000,
          autoplayHoverPause: true,
          autoplay: true,
          video: true,
          responsive: {
            0: {
              items: 1,
            },
            500: {
              items: 1,
            },
            768: {
              items: 2,
            },
            992: {
              items: 3,
            },
            1200: {
              items: 4,
            }
          }
        });
      });
    </script>
    <style type="text/css">
      #page-products .owl-carousel .owl-nav [class*="owl-"] {
          background: #FFF;
          width: 20px;
          height: 40px;
          text-align: center;
          border-radius: 60px;
          opacity: 1;
          border: solid 1px #FFF;
          position: absolute;
          top: 35%;
          padding: 0px;
          margin: 0px;
      }
      #page-products .owl-carousel .owl-nav [class*="owl-"]:hover{
          opacity: 1;
          background:#185ADB;
          color: #fff;
          border: solid 1px transparent;
      }
      #page-products .owl-carousel .owl-nav [class*="owl-"]:hover i:before {
          color: #fff;
      }
      #page-products .owl-carousel .owl-nav .owl-prev{
          left: 0;
          border-top-left-radius: 0px;
          border-bottom-left-radius: 0px;
          padding-right: 10px;
      }
      #page-products .owl-carousel .owl-nav .owl-next{
          right: 0;
          border-top-right-radius: 0px;
          border-bottom-right-radius: 0px;
          padding-left: 10px;
      }
      #page-products .owl-carousel .owl-nav i::before {
           color: #000;
           font-size: 16px;
      }
      #page-products .owl-carousel{
        margin-bottom: 30px;
      }
      .heading-categories_carousel {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }
      .name-categories_carousel {
        font-family: 'Roboto', sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        line-height: 28px;
        color: #0047BD;
        margin: 0;
        text-transform: uppercase;
      }
      .readmore-categories_carousel a{
        color: #333;
      }
      .readmore-categories_carousel a i{
        color: #0056b3;
        margin-left: 5px;
      }
    </style>
    @endsection
@endsection