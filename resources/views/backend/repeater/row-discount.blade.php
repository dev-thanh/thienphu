<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<div class="form-group">
            <label for="">Nội dung text cần chạy</label>
			<input type="text" class="form-control" name="content[discount][{{$id}}][name]" value="{{ @$val->name }}">
		</div>
        <div class="form-group">
            <label for="">Liên kết</label>
			<input type="text" class="form-control" name="content[discount][{{$id}}][link]" value="{{ @$val->link }}">
		</div>
	</td>
	
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>