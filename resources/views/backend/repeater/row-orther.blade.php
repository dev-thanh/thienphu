<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td>
        <div class="form-group">
            <div class="image">
                <div class="image__thumbnail">
                   <img src="{{ !empty($value->image) ? url('/').$value->image : __IMAGE_DEFAULT__ }}"  
                   data-init="{{ __IMAGE_DEFAULT__ }}">
                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                    <i class="fa fa-times"></i></a>
                   <input type="hidden" value="{{ @$value->image }}" name="content[orther][{{ $key }}][image]"  />
                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
                </div>
            </div>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" name="content[orther][{{ $key }}][title]" class="form-control" value="{{ @$value->title }}">
        </div>
    </td>
    <td class="remove-td-item">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>