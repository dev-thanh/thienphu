<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td>
            <div class="col-sm-12 form-group">
                <label for="">Tiêu đề khối(tiếng Việt)</label>
                <input type="text" class="form-control" name="content[{{$key}}][hanhtrinh][title]" value="{{ @$value->title }}">
            </div>
        <div class="row">
            <div class="form-group col-sm-6 item-journey">
                <div class="form-group">
                    <label for="">Tiêu đề (tiếng Việt)</label>
                    <input type="text" name="content[{{$key}}][hanhtrinh][name1]" class="form-control" value="{{ @$value->name1 }}">
                </div>

                <div class="form-group">
                    <label for="">Nội dung (tiếng Việt)</label>
                    <textarea class="form-control" name="content[{{$key}}][hanhtrinh][desc1]" style="min-height:100px">{{ @$value->desc1 }}</textarea>
                </div>
            </div>
            <div class="form-group col-sm-6 item-journey">
                <div class="form-group">
                    <label for="">Tiêu đề (tiếng Việt)</label>
                    <input type="text" name="content[{{$key}}][hanhtrinh][name2]" class="form-control" value="{{ @$value->name2 }}">
                </div>

                <div class="form-group">
                    <label for="">Nội dung (tiếng Việt)</label>
                    <textarea class="form-control" name="content[{{$key}}][hanhtrinh][desc2]" style="min-height:100px">{{ @$value->desc2 }}</textarea>
                </div>
            </div>
        </div>
    </td>
    <td class="remove-td-item">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>