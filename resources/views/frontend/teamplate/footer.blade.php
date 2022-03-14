<footer id="section-footer">
    <div class="background-overlay">
    <div class="container">
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <h2 class="name-company-footer">CÔNG TY TNHH THƯƠNG MẠI VÀ CHẾ TẠO MÁY THIÊN PHÚ</h2>
            <div class="information-footer">
            <p><strong>{!! @$site_info->dcft_text !!}</strong> {!! @$site_info->dcft !!}</p>
            <p><strong>{!! @$site_info->xsx_text !!}</strong> {!! @$site_info->xsx !!}</p>
            <p><strong>{!! @$site_info->nmsx_text !!}</strong> {!! @$site_info->nmsx !!}</p>
            <p><strong>{!! @$site_info->tax_code_text !!}</strong> {!! @$site_info->tax_code !!}</p>
            <p><strong>Hotline:</strong> {!! @$site_info->phone_footer !!}}</p>
            <p><strong>Email:</strong> {!! @$site_info->email !!}</p>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
            <h3 class="tit-widget-footer">Danh mục</h3>
            <ul class="menu-footer">
                @foreach($menuFooter as $item)
                    @if($item->parent_id == null)
                    <li><a href="{{url('/').$item->url}}">{{$item->title}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        @if(!empty(@$site_info->social))
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
            <h3 class="tit-widget-footer">Liên kết</h3>
            <ul class="social-footer">
                @foreach(@$site_info->social as $social)
                <li><a target="_blank" href="{{$social->link}}">{!! $social->icon !!}<span>{{$social->name}}</span></a></li>
                @endforeach
            </ul>
        <!-- /End Social Media Icons-->
        </div>
        @endif
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <h3 class="tit-widget-footer">Chỉ đường</h3>
            <div class="iframe-googlemaps">
            {!! @$site_info->google_maps !!}
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="footer-copyright">
    <div class="container">
        <p class="txt-copyright">© Thien Phu 2022. All rights reserved</p>
    </div>
    </div>
</footer>


















<!-- <footer id="footer">
        <div class="container">
            <div class="footer__group">
                <div class="footer-box">
                    <div class="footer-logo">
                        <a href="{{route('home')}}" title="Trang chủ">
                            <img src="{{url('/').@$site_info->logo_footer}}" alt="logo">
                        </a>
                    </div>
                    <h2 class="footer-title">
                        {!! @$site_info->company !!}
                    </h2>
                    <ul class="footer-item">
                        @foreach($site_info->address->list as $item)
                        <li><b>{{@$item->title}}</b> {{@$item->address}}</li>
                        @endforeach
                    </ul>
                    <ul class="footer-item footer-contact">
                        <li>
                            <img src="{{ __BASE_URL__ }}/icons/icon__phone.svg" alt="icon__phone.svg">
                            <p>Phone: {{@$site_info->phone}}</p>
                        </li>
                        <li>
                            <img src="{{ __BASE_URL__ }}/icons/icon__mail-1.svg" alt="icon__mail-1.svg">
                            <p>Email: {{@$site_info->email}}</p>
                        </li>
                        <li>
                            <img src="{{ __BASE_URL__ }}/icons/icon__call-1.svg" alt="icon__call-1.svg">
                            <p>Hotline: {{@$site_info->hotline}}</p>
                        </li>
                    </ul>
                </div>
                <div class="footer-box">
                    <h2 class="footer-title">
                        Hỗ trợ khách hàng
                    </h2>
                    @if (!empty($menuFooter))
                    <ul class="footer-item">
                        @foreach ($menuFooter as $item)
                            @if ($item->parent_id == null)
                            <li>
                                <a href="{{url('/').$item->url}}" title="{{@$item->title}}">{{@$item->title}}</a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </div>

                @if(!empty($site_info->social))
                <div class="footer-box">
                    <h2 class="footer-title">
                        Theo dõi chúng tôi
                    </h2>
                    <ul class="footer-item icon__contact">
                        @foreach($site_info->social as $social)
                        <li>
                            <a target="_blank" href="{{@$social->link}}" title="{{@$social->name}}">
                                <img src="{{url('/').@$social->icon}}" alt="{{@$social->name}}">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="footer__bottom">
            <span>{!! @$site_info->copyright !!}</span>
        </div>
    </footer> -->