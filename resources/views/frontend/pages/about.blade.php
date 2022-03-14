@extends('frontend.master')
@section('main')
    <?php if(!empty($dataSeo->content)){
        $content = json_decode($dataSeo->content);
    }  ?>
    <main id="content-wapper">
        <!-- banner -->
        <div class="content-page">
            <div class="background-overlay">
                <div class="container">
                    <div class="entry-content">
                        {!! @$content->content !!}
                    </div>
                    <ul class="social-share-posts">
                        <li>Chia sẻ: </li>
                        <li><a href="#"><i class="fab fa-facebook-square"></i><span>Facebook</span></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i><span>Youtube</span></a></li>
                        <li><a href="#"><i class="fab fa-google-plus"></i><span>Google Plus</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection