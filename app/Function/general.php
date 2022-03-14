<?php 
	
define("__IMAGE_DEFAULT__", asset('public/backend/images/placeholder.png'));
define("__BASE_URL__", url('public/frontend'));
define("__URL__", url('public/backend'));

use App\Models\Options;
use Carbon\Carbon;

function renderImage($link)
{
    if (!empty($link)) {
        return $link;
    }
    return asset('public/backend/img/no-image.png');
}

function text_limit($str, $limit = 10)
{
    if (stripos($str, " ")) {
        $ex_str = explode(" ", $str);
        if (count($ex_str) > $limit) {
            $str_s = null;
            for ($i = 0; $i < $limit; $i++) {
                $str_s .= $ex_str[$i] .
                    " ";
            }
            return $str_s;
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}

function format_datetime($date,$setting)

{   

    $date_format = Carbon::parse($date);

    return $date_format->format($setting);

}

function getOptions($key = null, $field = null)
{
    if(!empty($key)){
        $data = Options::where('type', $key)->first();
        if(!empty($data)){
            $data = json_decode($data->content);
            if(!empty($field)){
                return !empty($data->{ $field }) ? $data->{ $field } : $data;
            }
            return $data;
        }
        return 'key does not exist';
    }
}

function menuChildren($data, $id, $item)
{
    if (count($item->get_child_cate) > 0) {
        echo '<ol class="dd-list">';
        foreach ($item->get_child_cate as $item) {
            if ($item->parent_id == $id) {
                echo '<li class="dd-item" data-id="' . $item->id . '">';
                echo '  <div class="dd-handle">' . $item->title . '(<i>' . $item->url . '</i>)</div>
                            <div class="button-group">
                                <a href="javascript:;" class="modalEditMenu" data-id="' . $item->id . '"> 
                                    <i class="fa fa-edit"></i>
                                </a> &nbsp; &nbsp; &nbsp;
                                <a class="text-danger" href="' . route('setting.menu.delete', $item['id']) . '" onclick="return confirm(\'Bạn có chắc chắn xóa không ?\')" title="Xóa"> <i class="fa fa-times"></i></a>
                            </div>';
                menuChildren($data, $item->id, $item);
                echo '</li>';
            }
        }
        echo '</ol>';
    }
}

// Danh mục sản phẩm
function listCategoriesProducts($data, $parent_id = 0, $str = '', $type)
{
    switch ($type) {
        case 'posts':
            $routeType = 'category-post';
            $assetType = 'danh-muc-tin-tuc/';
            break;
        
        default:
            $routeType = 'category';
            $assetType = 'danh-muc-san-pham/';
            
            break;
    }
    foreach ($data as $value) {
        if($type=='product'){
            $image = '<td><img src="'.$value->image.'"  class="img-thumbnail img_cate_thumb" width="80px" /></td>';
        }
        
        $link = '<a class="link_cate" href="' . asset($value->slug.'.xhtml') . '" target="_blank"> <i class="fas fa-hand-point-right" aria-hidden="true"></i> Link: ' . asset($value->slug.'.xhtml') . ' </a>';
        $status = '';

        $id   = $value->id;

        $name = $value->name;

        if ($value->parent_id == $parent_id) {
            if ($str == '') {
                $strName = '<b>' . $str . $name . '</b>';
                $className = '';
            } else {
                $strName = '<span>' . $str . $name . '</span>';
                $className = 'class="item-child"';
            }
            echo '<tr class="odd">';
            
            

            echo    '<td '.$className.'>
                        <a class="text-default" href="' . route($routeType.'.edit', $id) . '" title="Sửa">' . $strName . '</a>
                        <br>'.$link.'
                    </td>';

            echo    $routeType !='services' ? '<td class="text-center">
                        <a class="text-default" href="' . route($routeType.'.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate) ?: '_' . ' </a>
                    </td>' : '';

            echo    $routeType =='services' ? '<td class="text-center">'.$status.'</td>' : '';
            
            echo    '<td>
                        <button type="button" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                            <a href="' . route($routeType.'.edit', $id) . '" title="Sửa">
                                <span class="label label-primary action-span"><i class="fa fa-edit"></i></span>
                            </a>
                        </button>
                        <button type="button" class="btn btn-link btn-danger" data-original-title="Xóa">
                            <a href="javascript:;" class="btn-destroy" data-href="' . route($routeType.'.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                                <span class="label label-danger action-span"><i class="fa fa-times"></i></span>
                            </a>
                        </button>
                    </td>';
            echo '</tr>';

            listCategoriesProducts($data, $id, $str . '---| ',$type);
        }
    }
}

function listCategoriesPosts($data, $parent_id = 0, $str = '', $type)
{
    switch ($type) {
        case 'posts':
            $routeType = 'category-post';
            $assetType = 'danh-muc-tin-tuc/';
            break;
        
        default:
            $routeType = 'category';
            $assetType = 'danh-muc-san-pham/';
            
            break;
    }
    foreach ($data as $value) {
        if($type=='product'){
            $image = '<td><img src="'.$value->image.'"  class="img-thumbnail img_cate_thumb" width="80px" /></td>';
        }
        
        $link = '<a class="link_cate" href="' . asset('tin-tuc/'.$value->id.'/'.$value->slug) . '" target="_blank"> <i class="fas fa-hand-point-right" aria-hidden="true"></i> Link: ' . asset('tin-tuc/'.$value->id.'/'.$value->slug) . ' </a>';
        $status = '';

        $id   = $value->id;

        $name = $value->name;

        if ($value->parent_id == $parent_id) {
            if ($str == '') {
                $strName = '<b>' . $str . $name . '</b>';
                $className = '';
            } else {
                $strName = '<span>' . $str . $name . '</span>';
                $className = 'class="item-child"';
            }
            echo '<tr class="odd">';
            
            

            echo    '<td '.$className.'>
                        <a class="text-default" href="' . route($routeType.'.edit', $id) . '" title="Sửa">' . $strName . '</a>
                        <br>'.$link.'
                    </td>';

            echo    $routeType !='services' ? '<td class="text-center">
                        <a class="text-default" href="' . route($routeType.'.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate) ?: '_' . ' </a>
                    </td>' : '';

            echo    $routeType =='services' ? '<td class="text-center">'.$status.'</td>' : '';
            
            echo    '<td>
                        <button type="button" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                            <a href="' . route($routeType.'.edit', $id) . '" title="Sửa">
                                <span class="label label-primary action-span"><i class="fa fa-edit"></i></span>
                            </a>
                        </button>
                        <button type="button" class="btn btn-link btn-danger" data-original-title="Xóa">
                            <a href="javascript:;" class="btn-destroy" data-href="' . route($routeType.'.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                                <span class="label label-danger action-span"><i class="fa fa-times"></i></span>
                            </a>
                        </button>
                    </td>';
            echo '</tr>';

            listCategoriesPosts($data, $id, $str . '---| ',$type);
        }
    }
}

function listCate($data, $parent_id = 0, $str = '')

{

    foreach ($data as $value) {

        $id   = $value->id;

        $name = $value->name;

        if ($value->parent_id == $parent_id) {

            if ($str == '') {

                $strName = '<b>' . $str . $name . '</b>';

            } else {



                $strName = $str . $name;

            }

            echo '<tr class="odd">';

            echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';

            echo '<td>

                        <a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa">' . $strName . '</a></br>

                        <a href="' . asset($value->slug.'.xhtml') . '" target="_blank"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Link: ' . asset($value->slug.'.xhtml') . ' </a>

                    </td>';
            if(request()->type=='thu_vien_anh'){
                echo '<td class="text-center"><a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa"> ' . count($value->Images) ?: '_' . ' </a></td>';
            }else{
                echo '<td><a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate()) ?: '_' . ' </a></td>';
            }

            echo ' <td><a href="' . route('category.edit', $id) . '?type='.request()->type.'" title="Sửa">

                        <span class="edit-action label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>

                    </a> &nbsp;
                        <a href="javascript:;" class="btn-destroy" data-href="' . route('category.destroy', $id) . '" data-toggle="modal" data-target="#confim">

                        <span class="delete-action label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>

                        </a>

                    </td>';

            echo '</tr>';



            listCate($data, $id, $str . '---| ');

        }

    }

}

// Đệ quy danh mục
function listCategories($data, $parent_id = 0, $str = '', $type)
{
    $image = '';
    switch ($type) {
        case 'posts':
            $routeType = 'category-post';
            $assetType = 'danh-muc-tin-tuc/';
            break;
        
        default:
            $routeType = 'category';
            $assetType = 'danh-muc-san-pham/';
            
            break;
    }
    foreach ($data as $value) {
        if($type=='product'){
            $image = '<td><img src="'.$value->image.'"  class="img-thumbnail img_cate_thumb" width="80px" /></td>';
        }

        if($type == 'services')
        {
            $link = '';
            $status = $value->show ==1 ? '<span class="badge badge-success">Hiển thị</span>' : '<span class="badge badge-danger">Không hiển thị</span>';
        }else{
            $link = '<a class="link_cate" href="' . asset($assetType . $value->slug) . '" target="_blank"> <i class="fas fa-hand-point-right" aria-hidden="true"></i> Link: ' . asset($assetType . $value->slug) . ' </a>';
            $status = '';
        }

        $id   = $value->id;

        $name = $value->name;

        if ($value->parent_id == $parent_id) {
            if ($str == '') {
                $strName = '<b>' . $str . $name . '</b>';
                $className = '';
            } else {
                $strName = '<span>' . $str . $name . '</span>';
                $className = 'class="item-child"';
            }
            echo '<tr class="odd">';
            
            

            echo    '<td '.$className.'>
                        <a class="text-default" href="' . route($routeType.'.edit', $id) . '" title="Sửa">' . $strName . '</a>
                        <br>'.$link.'
                    </td>';

            echo  $image;

            echo    $routeType !='services' ? '<td class="text-center">
                        <a class="text-default" href="' . route($routeType.'.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate) ?: '_' . ' </a>
                    </td>' : '';

            echo    $routeType =='services' ? '<td class="text-center">'.$status.'</td>' : '';
            
            echo    '<td>
                        <button type="button" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                            <a href="' . route($routeType.'.edit', $id) . '" title="Sửa">
                                <span class="label label-primary action-span"><i class="fa fa-edit"></i></span>
                            </a>
                        </button>
                        <button type="button" class="btn btn-link btn-danger" data-original-title="Xóa">
                            <a href="javascript:;" class="btn-destroy" data-href="' . route($routeType.'.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                                <span class="label label-danger action-span"><i class="fa fa-times"></i></span>
                            </a>
                        </button>
                    </td>';
            echo '</tr>';

            listCategories($data, $id, $str . '---| ',$type);
        }
    }
}

/* Check mothod request */
function renderAction($method)
{
    return isUpdate($method) ? 'Cập nhật' : 'Thêm mới' ;
}

function isUpdate($method)
{
    return (bool)$method == 'update';
}

function updateOrStoreRouteRender($method, $model, $data)
{
    return isUpdate($method) ? route($model . '.update', $data) : route($model . '.store');
}

function generateRandomCode() 
{
    return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6/strlen($x)) )),1, 6);
}

/* Menu */
function menuMulti($data, $parent_id = 0, $str = '---| ', $select = 0)
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        if ($value->parent_id == $parent_id) {
            if ($select != 0 && $id == $select) {
                echo '<option value=' . $id . ' selected> ' . $str . $value->name . ' </option>';
            } else {
                echo '<option value=' . $id . '> ' . $str . $value->name . ' </option>';
            }
            menuMulti($data, $id, $str . '---|  ', $select);
        }
    }
}

/* get categories checkbox */
function checkBoxCategory($data, $id, $item, $list_id = null)
{
    if (count($item) > 0) {
        echo '<div style="padding-left:15px;">';
        foreach ($item as $value) {
            $checked = null;
            if (!empty($list_id)) {
                if (in_array($value->id, $list_id)) {
                    $checked = 'checked';
                }
            }
            if ($value->parent_id == $id) {
                echo    '<div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="category form-check-input" name="category[]" value="' . $value->id . '" ' . $checked . ' >
                                <span class="form-check-sign">' . $value->name .'</span>
                            </label>
                        </div>';
                checkBoxCategory($data, $value->id, $value->get_child_cate);
            }
        }
        echo '</div>';
    }
}

function checkBoxSophong($data, $id, $item, $list_id = null)
{
    if (count($item) > 0) {
        echo '<div style="padding-left:15px;">';
        foreach ($item as $value) {
            $checked = null;
            if (!empty($list_id)) {
                if (in_array($value->id, $list_id)) {
                    $checked = 'checked';
                }
            }
            if ($value->parent_id == $id) {
                echo    '<div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="category form-check-input" name="sophong[]" value="' . $value->id . '" ' . $checked . ' >
                                <span class="form-check-sign">' . $value->name .'</span>
                            </label>
                        </div>';
                checkBoxSophong($data, $value->id, $value->get_child_cate);
            }
        }
        echo '</div>';
    }
}

function getListParent($data)
{   
   $array = [];
    $parent = $data;
    if ($data->parent_id > 0) {
        $parent = $data->getParent();
        array_push($array, $parent->id);
        $parent = getListParent($parent);
    }
    return $array;
}
function listParent($data)
{   
   $array = [];
    $parent = $data;
    if ($data->parent_id > 0) {
        $parent = $data->getParent();
        array_push($array, $parent);
        $parent = getListParent($parent);
    }
    return $array;
}

function arrayGetDay($item){
    $array =[
        'Monday' => 'Thứ Hai,',
        'Tuesday' => 'Thứ Ba,',
        'Wednesday' => 'Thứ Tư,',
        'Thursday' => 'Thứ Năm,',
        'Friday' => 'Thứ Sáu,',
        'Saturday' => 'Thứ Bảy,',
        'Sunday' => 'Chủ Nhật,',
    ];
    return $array[$item];
}

