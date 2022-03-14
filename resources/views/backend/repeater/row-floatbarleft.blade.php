<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
    <td>
        <div class="image">
			<div class="image__thumbnail">
			<img src="{{ !empty($val->icon) ? url('/').$val->icon : __IMAGE_DEFAULT__ }}"  
			data-init="{{ __IMAGE_DEFAULT__ }}">
			<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
				<i class="fa fa-times"></i></a>
			<input type="hidden" value="{{ @$val->icon }}" name="content[floatbarleft][{{$id}}][icon]"  />
			<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			</div>
		</div>
    </td>
	<td>
		<div class="form-group">
			<input type="text" class="form-control" name="content[floatbarleft][{{$id}}][name]" value="{{ @$val->name }}">
		</div>
	</td>
    <td>
		<div class="form-group">
			<input type="text" class="form-control" name="content[floatbarleft][{{$id}}][color]" value="{{ @$val->color }}">
		</div>
	</td>
    <td>
		<div class="form-group">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="category form-check-input" name="content[floatbarleft][{{$id}}][status]" value="1" @if(@$val->status==1) checked @endif>
                <span class="form-check-sign">
                </span> 
            </label>
        </div>
		</div>
	</td>
	<td class="text-center">
		<div class="image">
			<input type="text" class="form-control" name="content[floatbarleft][{{$id}}][link]" value="{{ @$val->link }}">
		</div>
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>