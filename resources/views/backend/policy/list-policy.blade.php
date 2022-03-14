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
                                    <i class="fas fa-user icon-header"></i>
                                    <h4 class="card-title">Điều khoản, chính sách</h4>
                                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
										<a href="{{ route('policy.add') }}">
										<i class="fa fa-plus"></i>
										
											Thêm mới
										
										</a>
									</button>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('flash::message')
                                <div class="table-responsive">

									<table class="table table-bordered table-striped table-hover">

							            <thead>

								            <tr>

								                <th>STT</th>

								                <th>Tiêu đề </th>

								                <th>Trạng thái</th>

								                <th>Thao tác</th>

								            </tr>

							            </thead>

							            <tbody>

							                @foreach ($data as $item)

							                    <tr>

							                        <td>{{ $loop->index +1 }}</td>

							                        <td>
							                        	{{ $item->name }}<br>
							                        	<a href="" target="_blank">{{route('home.policy',['slug'=>$item->slug])}}</a>
							                        </td>

							                        <td>
							                        	@if($item->status==1)
							                        		<span class="badge badge-success">Hiển thị</span>
							                        	@else
							                        		<span class="badge badge-danger">Đã ẩn</span>
							                        	@endif
							                        </td>

							                        <td>

							                            <div class="form-button-action">
															<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
																<a href="{{route('policy.edit',['id'=>@$item->id])}}">
																	<i class="fa fa-edit"></i>
																</a>
															</button>
															<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
																<a href="javascript:;" class="btn-destroy" data-href="{{route('policy.delete',['id'=>@$item->id])}}"
								    								data-toggle="modal" data-target="#confim">
																	<i class="fa fa-times"></i>
																</a>
															</button>
														</div>

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
@endsection

