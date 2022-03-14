@extends('backend.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-contact" action="{!! route($module['module'].'.postMultiDel') !!}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header card-header-product">
                                    <div class="d-flex align-items-center">
                                        <i class="icon-handbag icon-header"></i>
                                        <h4 class="card-title">Danh sách sản phẩm</h4>
                                        <a class="btn btn-primary btn-round ml-auto" href="{{ route($module['module'].'.create') }}">
                                
                                            <i class="fa fa-plus"></i>
                                        
                                            Thêm mới
                                    
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @include('flash::message')
                                    <div class="table-responsive table-products">
                                        @include('backend.layouts.components.table')
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <?php $url = route($module['module'].'.index') ?>
    @include('backend.layouts.components.table-js-config', ['route'=> $url ])
@endsection