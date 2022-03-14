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
                                    <i class="fas fa-align-justify icon-header"></i>
                                    <h4 class="card-title">{{@$module['name']}}</h4>
                                    <a class="btn btn-primary btn-round ml-auto" href="{{ route($module['module'].'.create') }}">
                                
                                        <i class="fa fa-plus"></i>
                                    
                                        Thêm mới
                                
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('flash::message')
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover" data-ordering="false">
                                        <thead>
                                            <tr>
                                                <th>Tên danh mục</th>
                                                <th class="text-center">Số danh mục con</th>
                                                <!-- <th>Order</th> -->
                                                <th class="text-center">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php listCategoriesProducts($data, $parent_id = 0, $str = '','product'); ?>
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
