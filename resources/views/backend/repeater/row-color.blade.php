<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
    <td class="index">{{ $index }}</td>
	<td>
        <div class="form-grop">
            <input type="text" class="form-control" name="content[color][{{ $id }}][name]" value="{{ @$value->name }}">
        </div>
	</td>
	<td>
        <div class="form-grop">
            <input type="text" class="form-control" id="content_{{ $id }}" name="content[color][{{ $id }}][value]" value="{{ @$value->value ? @$value->value : '#000000' }}">
        </div>
	</td>
    <td>
		<input type="color" class="form-control" id="color-{{ $id }}" value="{{ @$value->value }}" value="#000">
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-times"></i>
        </a>
    </td>
</tr>
<script>
    let colorInput_{{$id}} = document.getElementById('color-{{ $id }}');
    
    colorInput_{{$id}}.addEventListener('input', () =>{
        let colorValue = colorInput_{{$id}}.value;
        document.getElementById('content_{{ $id }}').value = colorValue;
    });
</script>