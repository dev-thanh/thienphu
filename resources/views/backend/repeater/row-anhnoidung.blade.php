<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td>
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-9">
                <div class="form-group">
                    <label for="">Tiêu đề (tiếng Việt)</label>
                    <input type="text" name="content[{{$key}}][anhnoidung][title]" class="form-control" value="{{ @$value->title }}">
                </div>

                <div class="form-group">
                    <label for="">Nội dung (tiếng Việt)</label>
                    
                    <textarea class="content" name="content[{{$key}}][anhnoidung][desc]">{{ @$value->desc }}</textarea>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3">
                <label for="">Hình ảnh khối</label>
                <div class="image">
                    <div class="image_thumb_page">
                    <img src="{{ !empty($value->image) ? url('/').$value->image : __IMAGE_DEFAULT__ }}"  
                    data-init="{{ __IMAGE_DEFAULT__ }}">
                    <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                        <i class="fa fa-times"></i></a>
                    <input type="hidden" value="{{ @$value->image }}" name="content[{{$key}}][anhnoidung][image]"  />
                    <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
                    </div>
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
    CKEDITOR.replace( 'content[{{$key}}][anhnoidung][desc]',{
            filebrowserBrowseUrl : '{{url('/')}}/public/backend/plugins/ckfinder/ckfinder.html',
        } );
</script>