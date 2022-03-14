<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
    <td class="index">{{ $index }}</td>
	<td class="brank row">
		<div class="col-sm-3">
			<div class="form-group">
				<input type="text" class="form-control" name="content[address][list][{{ $id }}][title]" value="{{ @$value->title }}" placeholder="Tên chi nhánh">
			</div>
		</div>
		<div class="col-sm-9">
			<div class="form-group">
				<input type="text" class="form-control" name="content[address][list][{{ $id }}][address]" value="{{ @$value->address }}" placeholder="Tên chi nhánh">
			</div>
		</div>
	</td>
	
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>