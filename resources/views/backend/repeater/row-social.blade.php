<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<div class="form-group">
			<input type="text" class="form-control" name="content[social][{{$id}}][name]" value="{{ @$val->name }}">
		</div>
	</td>
	<td class="text-center">
		<div class="image">
			<input type="text" class="form-control" name="content[social][{{$id}}][icon]" value="{{ @$val->icon }}">
		</div>
    </td>
	<td>
		<div class="form-group">
			<input type="text" class="form-control" required="" name="content[social][{{$id}}][link]" value="{{ @$val->link }}">
		</div>
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>