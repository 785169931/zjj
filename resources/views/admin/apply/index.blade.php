@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
                @can('apply.apply.create')
                    <a class="layui-btn layui-btn-sm" href="{{ route('admin.apply.create') }}">添 加</a>
                @endcan
                @can('apply.apply.destory')
                        <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删除</button>
                    @endcan
                    <button type="button" class="layui-btn layui-btn-sm" id="applySearch">搜索</button>
            </div>
            <div class="layui-form" >
                <div class="layui-input-inline">
                    <input type="text" name="s_name" id="s_name" placeholder="请输入名称" class="layui-input" >
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="s_author" id="s_author" placeholder="请输入负责人" class="layui-input" >
                </div>
                <div class="layui-input-inline">
                    <select name="s_type" id="s_type" style="width: 100px">
                        <option value="">全部</option>
                        @foreach($type as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('apply.apply.download')
                        <a class="layui-btn layui-btn-sm" lay-event="download">脚本下载</a>
                    @endcan
{{--                    @can('apply.apply.edit')--}}
{{--                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>--}}
{{--                    @endcan--}}
                    @can('apply.apply.destory')
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                    @endcan
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('apply.apply')
        <script>
            layui.use(['layer','table','form'],function () {
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    ,height: 500
                    ,url: "{{ route('admin.apply.data') }}" //数据接口
                    ,page: true //开启分页
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID',hide:true, sort: true,width:60}
                        ,{field: 'image_url', title: '图片',templet:function (row) {
                                // return row['image_url'];
                                let url = row['image_url'];
                                return "<img style='width: 30px;height: 30px' src='{{asset('upload/image/c14220e536cc3a94c93d7d8995984269.jpg')}}'></img>"

                            }}
                        ,{field: 'name', title: '名称',width: 100}
                        ,{field: 'price', title: '原价',templet:function (row) {
                                return row['price'] / 100;
                            }}
                        ,{field: 'sale_price',width:100, title: '秒杀价',templet:function (row) {
                                return row['sale_price'] / 100;
                            }}
                        ,{field: 'benefits', title: '福利',width: 120}
                        ,{field: 'type', title: '类型',width:100,templet:function (row) {
                                let type = {
                                    1:'化妆品',
                                    2:'零食',
                                    3:'日常',
                                }
                                return type[row['type']]
                            }}
                        ,{field: 'author', title: '负责人',width: 80}
                        ,{field: 'url_dy', title: '抖音链接',width: 200}
                        ,{field: 'url_ks', title: '快手链接',width: 200}
                        ,{field: 'created_at', title: '创建时间',width: 180}
                        ,{fixed: 'right',align:'center', width: 150, toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                    if(layEvent === 'del'){
                        layer.confirm('确认删除吗？', function(index){
                            $.post("{{ route('admin.apply.destory') }}",{_method:'post',ids:data.id},function (result) {
                                if (result.code==0){
                                    layer.close(index);
                                    layer.msg(result.msg,{icon:6});
                                    dataTable.reload('dataTable', {
                                        where: {
                                            'name': ''
                                        },
                                        page:{curr:1}
                                    });
                                }else{
                                    layer.close(index);
                                    layer.msg(result.msg,{icon:5})
                                }

                            });
                        });
                    } else if(layEvent === 'edit'){
                        location.href = '/admin/apply/'+data.id+'/edit';
                    } else if (layEvent === 'download'){
                        window.location.href="http://admin.laravel/admin/apply/download?id="+data.id;
                    }
                });

                $("#listDelete").click(function () {
                    var ids = []
                    var hasCheck = table.checkStatus('dataTable')
                    var hasCheckData = hasCheck.data
                    if (hasCheckData.length>0){
                        $.each(hasCheckData,function (index,element) {
                            ids.push(element.id)
                        })
                    }

                    if (ids.length <= 0){
                        layer.msg('请选择删除项',{icon:5});
                        return false;
                    }else{
                        layer.confirm('确认删除'+ids.length+'条记录吗？',{icon:3,title:'提示'}, function(index){
                            $.post("{{ route('admin.apply.destory') }}",{_method:'post',ids:ids},function (result) {
                                if (result.code==0){
                                    layer.close(index);
                                    layer.msg(result.msg,{icon:6});
                                    dataTable.reload('dataTable', {
                                        where: {
                                            'name': ''
                                        },
                                        page:{curr:1}
                                    });
                                }else{
                                    layer.close(index);
                                    layer.msg(result.msg,{icon:5})
                                }

                            });
                        });
                    }
                });

                //搜索
                $("#applySearch").click(function () {
                    var name = $("#s_name").val()
                    var author = $("#s_author").val();
                    var type = $("#s_type").val();
                    dataTable.reload({
                        where:{name:name,author:author,type:type},
                        page:{curr:1}
                    })
                })


                //返回上一级
                $("#returnParent").click(function () {
                    var pid = $(this).attr("pid");
                    if (pid!='0'){
                        ids = pid.split('_');
                        parent_id = ids.pop();
                        $(this).attr("pid",ids.join('_'));
                    }else {
                        parent_id=pid;
                    }
                    dataTable.reload({
                        where:{model:"permission",parent_id:parent_id},
                        page:{curr:1}
                    })
                })
            })
        </script>
    @endcan
@endsection