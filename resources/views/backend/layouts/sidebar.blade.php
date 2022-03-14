<?php 
	if(!empty($$colorSetting->content)){
		$contents = json_decode($$colorSetting->content);
	}
	$routeName = request()->route()->getName();
?>
<div class="sidebar sidebar-style-2" data-background-color="{{ !empty($contents->sidebarColor) ? $contents->sidebarColor : 'dark' }}">
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="{{url('/').auth()->user()->image}}" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							{{auth()->user()->name}}
							<span class="user-level">Administrator</span>
							<span class="caret"></span>
						</span>
					</a>
					<div class="clearfix"></div>

					<div class="collapse in" id="collapseExample">
						<ul class="nav">
							<!-- <li>
								<a href="#profile">
									<span class="link-collapse">My Profile</span>
								</a>
							</li> -->
							<li>
								<a href="{{ route('users.edit', Auth::user()->id ) }}">
									<span class="link-collapse">Thông tin</span>
								</a>
							</li>
							<li>
								<a href="{{ url('/logout') }}" onclick="event.preventDefault(); check();">
									<span class="link-collapse">Đăng xuất</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<ul class="nav nav-primary">
				<li class="nav-item {{ Request::segment(2) == 'home' ? 'active' : null  }}">
					<a href="{{route('backend.home')}}" class="collapsed">
						<i class="fas fa-home"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Components</h4>
				</li>
				<li class="nav-item {{ Request::segment(2) == 'users' ? 'active' : null  }}">
					<a data-toggle="collapse" href="#tables">
						<i class="fas fa-user"></i>
						<p>Tài khoản</p>
						<span class="caret"></span>
					</a>
					<div class="collapse {{ Request::segment(2) == 'users' ? 'show' : null  }}" id="tables">
						<ul class="nav nav-collapse">
							<li class="{{ Request::segment(2) == 'users' ? 'active' : null  }}">
								<a href="{{ route('users.index') }}">
									<span class="sub-item">Tài khoản quản trị</span>
								</a>
							</li>
							<!-- <li>
								<a href="tables/datatables.html">
									<span class="sub-item">Tài khoản thành viên</span>
								</a>
							</li> -->
						</ul>
					</div>
				</li>



				<li class="nav-item {{ Request::segment(2) == 'category' || Request::segment(2) == 'products' ? 'active' : null  }}">
					<a data-toggle="collapse" href="#base">
						<i class="icon-handbag"></i>
						<p>Sản phẩm</p>
						<span class="caret"></span>
					</a>
					<div class="collapse {{ Request::segment(2) == 'category' || Request::segment(2) == 'products' ? 'show' : null  }}" id="base">
						<ul class="nav nav-collapse">
							<li class="{{ Request::segment(2) === 'products' ? 'active' : null }}">
								<a href="{{ route('products.index') }}">
									<span class="sub-item">Danh sách sản phẩm</span>
								</a>
							</li>
							<li class="{{ Request::segment(2) == 'category' ? 'active' : null  }}">
								<a href="{{ route('category.index') }}">
									<span class="sub-item">Danh mục sản phẩm</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				
				<li class="nav-item {{ ( Request::segment(2) === 'category-post' ) || ( Request::segment(2) === 'posts' ) ? 'active' : null }}">
					<a data-toggle="collapse" href="#forms">
						<i class="icon-notebook"></i>
						<p>Bài viết</p>
						<span class="caret"></span>
					</a>
					<div class="collapse {{ ( Request::segment(2) === 'category-post' ) || ( Request::segment(2) === 'posts' ) ? 'show' : null }}" id="forms">
						<ul class="nav nav-collapse">
							<li class="{{ ( Request::segment(2) === 'category-post' ) ? 'active' : null }}">
								<a href="{{ route('category-post.index') }}">
									<span class="sub-item">Danh mục bài viết</span>
								</a>
							</li>
							<li class="{{ ( Request::segment(2) === 'posts' ) ? 'active' : null }}">
								<a href="{{ route('posts.index') }}">
									<span class="sub-item">Danh sách bài viết</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item {{ ( Request::segment(2) === 'videos' ) ? 'active' : null }}">
					<a href="{{ route('videos.index') }}">
						<i class="fas fa-file-video"></i>
						<p>Quản lý videos</p>
					</a>
				</li>

				<li class="nav-item {{ ( Request::segment(2) === 'image' ) ? 'active' : null }}">
					<a href="{{ route('image.index', ['type'=> 'slider']) }}">
						<i class="far fa-image"></i>
						<p>Quản lý banner</p>
					</a>
				</li>
				
				<li class="nav-item {{ Request::segment(2) == 'pages' ? 'active' : null  }}">
					<a href="{{ route('pages.list') }}">
						<i class="icon-book-open"></i>
						<p>Cài đặt trang</p>
					</a>
				</li>
				<li class="nav-item {{ Request::segment(2) == 'contact' ? 'active' : null  }}">
					<a href="{{ route('get.list.contact') }}">
						<i class="icon-call-out"></i>
						<p>Liên hệ</p>
					</a>
				</li>
				<li class="nav-item {{ ( Request::segment(2) === 'options' && Request::segment(3) === 'general') || Request::segment(2) === 'menu'? 'active' : null }}">
					<a data-toggle="collapse" href="#submenu">
						<i class="fas fa-bars"></i>
						<p>Cấu hình</p>
						<span class="caret"></span>
					</a>
					<div class="collapse {{ Request::segment(2) === 'menu' || ( Request::segment(3) === 'general' && Request::segment(3) === 'general') ? 'show' : null }}" id="submenu">
						<ul class="nav nav-collapse">
							<li class='{{ Request::segment(3) === 'general' ? 'active' : null }}'>
								<a href="{{ route('backend.options.general') }}">
									<span class="sub-item">Cấu hình chung</span>
								</a>
							</li>
							
							<li class="{{ Request::segment(2) === 'menu' ? 'active' : null }}">
								<a href="{{ route('setting.menu') }}">
									<span class="sub-item">Menu</span>
								</a>
							</li>
							
						</ul>
					</div>
				</li>

				<li class="nav-item {{ ( Request::segment(2) === 'options' && Request::segment(3) == 'developer-config' ) || ( Request::segment(2) === 'options' && Request::segment(3) == 'css-js-config' ) || ( Request::segment(2) === 'options' && Request::segment(3) == 'smtp' ) ? 'active' : null }}">
					<a data-toggle="collapse" href="#sidebarLayouts">
						<i class="fas fa-cogs"></i>
						<p>Dev config</p>
						<span class="caret"></span>
					</a>
					<div class="collapse {{ ( Request::segment(2) === 'options' && Request::segment(3) == 'developer-config' ) || ( Request::segment(2) === 'options' && Request::segment(3) == 'css-js-config' ) || ( Request::segment(2) === 'options' && Request::segment(3) == 'smtp' ) ? 'show' : null }}" id="sidebarLayouts">
						<ul class="nav nav-collapse">
							<li class="{{ Request::segment(3) == 'css-js-config' ? 'active' : null  }}">
								<a href="{{route('backend.options.css-js')}}">
									<span class="sub-item">Add css, js</span>
								</a>
							</li>
							<li class="{{ Request::segment(3) == 'developer-config' ? 'active' : null  }}">
								<a href="{{ route('backend.options.developer-config') }}">
									<span class="sub-item">Logo,favicon config</span>
								</a>
							</li>
							<li class="{{ Request::segment(3) == 'smtp' ? 'active' : null  }}">
								<a href="{{ route('backend.options.smtp-config') }}">
									<span class="sub-item">Mail config</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				
			</ul>
		</div>
	</div>
</div>