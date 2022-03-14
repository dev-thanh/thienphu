<?php $routename = request()->path(); ?>
<header class="main-header header-shadow">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
       <div class="container">
        <div class="row-header-navbar">
          <a id="showmenu">
            <span class="hamburger hamburger--collapse">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </span>
          </a>
          <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{url('/').@$site_info->logo}}" alt="Logo">
          </a>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            @if(!empty($menuHeader))
              <ul class="navbar-nav">
                @foreach($menuHeader as $item)
                    @if($item->parent_id == null)
                    <li class="nav-item @if(count($item->get_child_cate)) dropdown @endif  @if($item->url=='/'.$routename) active @elseif($item->url=='/' && $routename=='/') active @endif">
                      <a class="nav-link @if(count($item->get_child_cate)) dropdown-toggle @endif" href="{{url('/').$item->url}}" title="{{$item->title}}"> {{$item->title}}</a>
                      @if (count($item->get_child_cate))
                      <ul class="dropdown-menu">
                          @foreach($item->get_child_cate as $k =>  $value)
                          <li @if(count($value->get_child_cate)) class="dropdown-submenu" @endif><a class="dropdown-item @if(count($value->get_child_cate)) dropdown-toggle @endif" href="#">{{$value->title}}</a>
                            @if(count($value->get_child_cate))  
                            <ul class="dropdown-menu">
                                    @foreach($value->get_child_cate as $child)
                                    <li class="dropdown-submenu"><a class="dropdown-item @if(count($child->get_child_cate)) dropdown-toggle @endif" href="{{url('/').$child->url}}" title="{{$child->title}}">{{$child->title}}</a>
                                        @if($child->get_child_cate)    
                                        <ul class="dropdown-menu">
                                            @foreach($child->get_child_cate as $child2)
                                            <li><a class="dropdown-item" href="{{url('/').$child2->url}}" title="{{$child2->title}}">{{$child2->title}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                              </ul>
                            @endif
                          </li>
                          @endforeach
                      </ul>
                      @endif
                  </li>
                  @endif
                @endforeach
              </ul>
              @endif
          </div>
          <div class="navbar-hotline">
              <a href="tel:0966295389"><i class="fal fa-phone"></i> {{@$site_info->phone}}</a>
            </div>
            <div class="navbar-search-wrap dropdown">
              <button type="button" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fal fa-search"></i></button>
              <div class="dropdown-menu">
                  <form class="form-group form-search" action="{{route('home.search')}}" method="GET">
                    <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search" value="{{request()->search}}">
                    <button class="btn btn-outline-success" type="submit"><i class="fal fa-search"></i></button>
                  </form>
              </div>
          </div>
      </div>
      </div>
    </nav>
    <div id="mobilenav">
        <div class="mobilenav__inner">
          <div class="toplg">
            <div class="logo-mobilenav">
              <img src="{{url('/').@$site_info->logo}}" alt="Logo">
            </div>
          </div>
          @if (!empty($menuHeader))
          <ul class="mobile-menu">
            @foreach ($menuHeader as $item)
                @if ($item->parent_id == null)
                <li class="nav-item @if($item->url=='/'.$routename) active @elseif($item->url=='/' && $routename=='/') active @endif">
                    <a @if(!empty($item->url)) href="{{url('/').$item->url}}" @else onclick="return false;" @endif class="nav-link" title="{{@$item->title}}"> {{@$item->title}}</a>
                    @if(count($item->get_child_cate))
                    <ul class="sub-menu">
                        @foreach($item->get_child_cate as $k =>  $value)
                        <li class="dropdown-submenu"><a class="nav-link" href="{{url('/').$value->url}}" title="{{@$value->title}}">{{@$value->title}}</a>
                            @if(count($value->get_child_cate))
                            <ul class="sub-menu">
                                @foreach($value->get_child_cate as $child)
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="{{url('/').$child->url}}" title="{{@$child->title}}">{{@$child->title}}</a>
                                        @if (count($child->get_child_cate))    
                                        <ul class="sub-menu">
                                            @foreach($child->get_child_cate as $child2)
                                            <li><a class="nav-link" href="{{url('/').$child2->url}}" title="{{$child2->title}}">{{$child2->title}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endif
            @endforeach
        </ul>
        @endif
        <a class="menu_close"><i class="fas fa-angle-left"></i></a>
    </div>
    </div>
</header>
