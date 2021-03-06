<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td class="index text-center">{{ $index }}</td>
    <td>
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <div class="image">
                <div class="image__thumbnail">
                   <img src="{{ !empty($value->image) ? url('/').$value->image : __IMAGE_DEFAULT__ }}"  
                   data-init="{{ __IMAGE_DEFAULT__ }}">
                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                    <i class="fa fa-times"></i></a>
                   <input type="hidden" value="{{ @$value->image }}" name="content[partner][content][{{ $key }}][image]"  />
                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
                </div>
            </div>
        </div>
    </td>
    <td>
        <div class="form-group">
            <label for="">Tên đối tác</label>
            <input type="text" name="content[partner][content][{{ $key }}][title]" class="form-control" value="{{ @$value->title }}">
        </div>
        <div class="form-group">
            <label for="">Link</label>
            <input type="text" name="content[partner][content][{{ $key }}][link]" class="form-control" value="{{ @$value->link }}">
        </div>
    </td>
    <td class="remove-td-item">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>