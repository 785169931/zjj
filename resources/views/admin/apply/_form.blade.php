{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">名称</label>
    <div class="layui-input-block">
        <input type="text" name="name" value="{{ $category->name ?? old('name') }}" lay-verify="required" placeholder="请输入名称" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">图片</label>
    <div style="display: inline-block">
        <div style="float: left">
            <button type="button" class="layui-btn"  id="test1">上传图片</button>
        </div>
        <div class="layui-upload-list"  style="float: left;margin-left: 30px;margin-top: 0px;">
            <img class="layui-upload-img" id="demo1"  style="width: 50px;height: 50px;border: none">
            <p id="demoText"></p>
            <input type="hidden" id="image_url" lay-verify="required" lay-reqText="请上传图片" name="image_url" value="">
        </div>
    </div>

</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">原价</label>
    <div class="layui-input-block">
{{--        <input type="text" name="price" value="{{ $category->sort ?? 0 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >--}}
        <input type="text" name="price" value="" lay-verify="required|number" placeholder="请输入原价" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">秒杀价</label>
    <div class="layui-input-block">
        <input type="text" name="sale_price" value="" lay-verify="required|number" placeholder="请输入秒杀价" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">福利</label>
    <div class="layui-input-block">
        <input type="text" name="benefits" value="" lay-verify="required" placeholder="请输入福利" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">抖音链接</label>
    <div class="layui-input-block">
        <input type="text" name="url_dy" value="" lay-verify="required|url" placeholder="请输入抖音链接" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">快手链接</label>
    <div class="layui-input-block">
        <input type="text" name="url_ks" value="" lay-verify="url" placeholder="请输入快手链接" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">类型</label>
    <div class="layui-input-block">
        <select name="type" id="type">
            @foreach($type as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">脚本</label>
    <button type="button" class="layui-btn" id="test3"><i class="layui-icon"></i>上传文件</button>
    <p id="script_name" style="display: inline-block;margin-left: 30px;margin-top: 0px;font-size: 16px"></p>
    <input type="hidden" id="script_url" lay-verify="required" lay-reqText="请上传脚本文件" name="script_url"  value="">
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.apply')}}" >返 回</a>
    </div>
</div>

<script>
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;

        //上传图片
        var uploadInst = upload.render({
            elem: '#test1'
            ,data:{"type":"image"}
            , url: "{{route('admin.post')}}" //改成您自己的上传接口
            , before: function (obj) {
                //预读本地文件示例，不支持ie8
                obj.preview(function (index, file, result) {
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            , done: function (res) {
                //如果上传失败
                if (res.code > 0) {
                    return layer.msg('上传失败',{icon:5});
                }
                $('#image_url').attr('value',res.data.src);
                layer.msg(res.msg,{icon:6});
            }
            , error: function () {
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function () {
                    uploadInst.upload();
                });
            }
        });

        //上传脚本
        //指定允许上传的文件类型
        upload.render({
            elem: '#test3'
            ,url: "{{route('admin.post')}}"
            ,data:{'type':"script"}
            ,accept: 'file' //普通文件
            ,done: function(res){
                if (res.code != 0){
                    layer.msg(res.msg,{icon:5});
                }
                let script = document.getElementById('script_name');
                script.innerHTML = '已上传：'+res.data.name;
                // $('#script_name').innerHTML = res.data.name;
                $('#script_url').attr('value',res.data.src);
                layer.msg('上传成功',{icon:6});
                console.log(res);
            }
        });


    });
</script>