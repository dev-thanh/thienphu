@extends('backend.layouts.app')

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="mt-2 mb-4">
				<h2 class="text-white pb-2">Welcome back, {{auth()->user()->name}}!</h2>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="card card-dark bg-primary-gradient">
						<div class="card-body pb-0">
							<!-- <div class="h1 fw-bold float-right">+5%</div> -->
							<h2 class="mb-2">{{ \App\Models\Products::count() }}</h2>
							<p>Sản phẩm</p>
							<div class="pull-in sparkline-fix chart-as-background">
								<div id="lineChart"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-dark bg-secondary-gradient">
						<div class="card-body pb-0">
							<!-- <div class="h1 fw-bold float-right">-3%</div> -->
							<h2 class="mb-2">{{ \App\Models\Posts::count() }}</h2>
							<p>Tin tức</p>
							<div class="pull-in sparkline-fix chart-as-background">
								<div id="lineChart2"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-dark bg-success2">
						<div class="card-body pb-0">
							<!-- <div class="h1 fw-bold float-right">+7%</div> -->
							<h2 class="mb-2">{{ \App\Models\Contact::count() }}</h2>
							<p>Liên hệ</p>
							<div class="pull-in sparkline-fix chart-as-background">
								<div id="lineChart3"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-head-row">
								<div class="card-title">Danh sách trang</div>
								<div class="card-tools">
									<!-- <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
										<span class="btn-label">
											<i class="fa fa-pencil"></i>
										</span>
										Export
									</a>
									<a href="#" class="btn btn-info btn-border btn-round btn-sm">
										<span class="btn-label">
											<i class="fa fa-print"></i>
										</span>
										Print
									</a> -->
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="chart-container" style="min-height: 300px">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover">
								            <thead>
								                <tr>
								                    <th width="30px">STT</th>
								                    <th width="">Tên trang</th>
								                    <th width="">Liên kết</th>
								                </tr>
								            </thead>
								            <tbody class="table-body-pro">
								                @foreach ($dataPages as $item)
								                    <tr>
								                        <td>{{ $loop->index + 1 }}</td>
								                        <td>{{ $item->name_page }}</td>
								                        <td class="text-left">
								                            @if (\Route::has($item->route) && \Route::has($item->route_en))
								                                <a href="{{ route($item->route) }}" target="_blank">
								                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
								                                    Link Tiếng Việt: {{ route($item->route) }}
								                                </a>
								                                <br>
								                                <a href="{{ route($item->route_en) }}" target="_blank">
								                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
								                                    Link Tiếng Anh: {{ route($item->route_en) }}
								                                </a>
								                            @else
								                            	---------------
								                            @endif
								                        </td>
								                    </tr>
								                @endforeach
								            </tbody>
								        </table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer">
		<div class="container-fluid">
			<nav class="pull-left">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="https://www.themekita.com">
							ThemeKita
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">
							Help
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">
							Licenses
						</a>
					</li>
				</ul>
			</nav>
			<div class="copyright ml-auto">
				2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
			</div>				
		</div>
	</footer>
</div>
@endsection