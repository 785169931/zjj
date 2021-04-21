@extends('admin.base')

@section('content')
    <div class="layui-row layui-col-space15">

        <div class="layui-col-md8">

            <div class="layui-card">

                <div class="layui-card-header">
                    最近更新
                </div>

                <div class="layui-card-body">

                    <div class="layui-row layui-col-space10">

                        <div class="layui-col-xs12 layui-col-sm4">

                            <div class="layuiadmin-card-text">

                                <div class="layui-text-top"><i class="layui-icon layui-icon-water"></i><a lay-href="http://www.layui.com/doc/modules/flow.html">flow</a></div>

                                <p class="layui-text-center">修复开启 isLazyimg:true 后, 图片懒加载但是图片不存在的报错问题</p>

                                <p class="layui-text-bottom"><a lay-href="http://www.layui.com/doc/modules/flow.html">流加载</a><span>7 天前</span></p>

                            </div>

                        </div>

                        <div class="layui-col-xs12 layui-col-sm4">

                            <div class="layuiadmin-card-text">

                                <div class="layui-text-top"><i class="layui-icon layui-icon-upload-circle"></i><a lay-href="http://www.layui.com/doc/modules/upload.html">upload</a></div>

                                <p class="layui-text-center">修复开启 size 参数后，文件超出规定大小时，提示信息有误的问题</p>

                                <p class="layui-text-bottom"><a lay-href="http://www.layui.com/doc/modules/upload.html">文件上传</a><span>7 天前</span></p>

                            </div>

                        </div>

                        <div class="layui-col-xs12 layui-col-sm4">

                            <div class="layuiadmin-card-text">

                                <div class="layui-text-top"><i class="layui-icon layui-icon-form"></i><a lay-href="http://www.layui.com/doc/modules/form.html#val">form</a></div>

                                <p class="layui-text-center">增加 form.val(filter, fields)方法，用于给指定表单集合的元素初始赋值</p>

                                <p class="layui-text-bottom"><a lay-href="http://www.layui.com/doc/modules/form.html">表单</a><span>7 天前</span></p>

                            </div>

                        </div>

                        <div class="layui-col-xs12 layui-col-sm4">

                            <div class="layuiadmin-card-text">

                                <div class="layui-text-top"><i class="layui-icon layui-icon-form"></i><a lay-href="http://www.layui.com/doc/modules/form.html">form</a></div>

                                <p class="layui-text-center">对 select 组件新增上下键（↑ ↓）回车键（Enter）选择功能</p>

                                <p class="layui-text-bottom"><a lay-href="http://www.layui.com/doc/modules/form.html">表单</a><span>7 天前</span></p>

                            </div>

                        </div>

                        <div class="layui-col-xs12 layui-col-sm4">

                            <div class="layuiadmin-card-text">

                                <div class="layui-text-top"><i class="layui-icon layui-icon-form"></i><a lay-href="http://www.layui.com/doc/modules/form.html">form</a></div>

                                <p class="layui-text-center">优化 switch 开关组件，让其能根据文本自由伸缩宽</p>

                                <p class="layui-text-bottom"><a lay-href="http://www.layui.com/doc/modules/form.html">表单</a><span>7 天前</span></p>

                            </div>

                        </div>

                        <div class="layui-col-xs12 layui-col-sm4">

                            <div class="layuiadmin-card-text">

                                <div class="layui-text-top"><i class="layui-icon layui-icon-form"></i><a lay-href="http://www.layui.com/doc/modules/form.html">form</a></div>

                                <p class="layui-text-center">修复 checkbox 复选框组件在高分辨屏下出现的样式不雅问题</p>

                                <p class="layui-text-bottom"><a lay-href="http://www.layui.com/doc/modules/form.html">表单</a><span>7 天前</span></p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



        </div>

{{--        <div class="layui-col-md4">--}}

{{--            <div class="layui-card">--}}

{{--                <div class="layui-card-header">便捷导航</div>--}}

{{--                <div class="layui-card-body">--}}

{{--                    <div class="layuiadmin-card-link">--}}

{{--                        <a href="javascript:;">操作一</a>--}}

{{--                        <a href="javascript:;">操作二</a>--}}

{{--                        <a href="javascript:;">操作三</a>--}}

{{--                        <a href="javascript:;">操作四</a>--}}

{{--                        <a href="javascript:;">操作五</a>--}}

{{--                        <a href="javascript:;">操作六</a>--}}

{{--                        <button class="layui-btn layui-btn-primary layui-btn-xs">--}}

{{--                            <i class="layui-icon layui-icon-add-1" style="position: relative; top: -1px;"></i>添加--}}

{{--                        </button>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--            <div class="layui-card">--}}

{{--                <div class="layui-card-header">八卦新闻</div>--}}

{{--                <div class="layui-card-body">--}}



{{--                    <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-pageone">--}}

{{--                        <div carousel-item id="LAY-index-pageone">--}}

{{--                            <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>--}}

{{--                        </div>--}}

{{--                    </div>--}}



{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}

    </div>
@endsection

@section('script')
    <script>
        layui.use(['index', 'sample']);
    </script>
@endsection