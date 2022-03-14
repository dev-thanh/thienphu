@extends('backend.layouts.app')

@section('content')
	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<i class="far fa-list-alt icon-header"></i>
									<h4 class="card-title">Danh sách menu</h4>
									<!-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
										<a href="{{ route('users.create') }}">
										<i class="fa fa-plus"></i>
										
											Thêm tài khoản
										
										</a>
									</button> -->
								</div>
							</div>
							<div class="card-body">
								<table id="example1" class="display table table-striped table-hover">
						            <thead>
							            <tr>
							                <th>STT</th>
							                <th>Tiêu đề</th>
							                <th>Vị trí</th>
							                <th class="text-center">Thao tác</th>
							            </tr>
						            </thead>
						            <tbody>
						                @foreach ($data as $item)
						                    <tr>
						                        <td>{{ $loop->index +1 }}</td>
						                        <td>{{ $item->title }}</td>
						                        <td>{{ $item->position }}</td>
						                        <td class="text-center">
						                            <a href="{{ route('backend.config.menu.edit',$item->id ) }}">
						                                <i class="fa fa-edit"></i> Sửa Menu
						                            </a>
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
@endsection
