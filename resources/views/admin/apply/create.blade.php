@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加数据</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.apply.store')}}" method="post">
                @include('admin.apply._form')
            </form>
        </div>
    </div>
@endsection