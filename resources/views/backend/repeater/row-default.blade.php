<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label for="">Nội dung</label>
					<input type="hidden" name="content[{{$key}}][default][type]" value="default">
					<textarea class="form-control content" name="content[{{$key}}][default][content]">{{ @$value->content }}</textarea>
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
<script>
	CKEDITOR.replace( 'content[{{$key}}][default][content]',{
            filebrowserBrowseUrl : '{{url('/')}}/public/backend/plugins/ckfinder/ckfinder.html',
        } );
</script>