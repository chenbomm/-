@extends('common.admin_base')

@section('title','管理后台广告位列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 广告位列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/ad/position/add">+ 添加广告位</a>
        </div>
    </div>
@endsection

@section('content')

    <div class="row" id="list">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>广告位名称</th>
                        <th>广告位描述</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                        @foreach($list as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['position_name']}}</td>
                        <td>{{$v['position_desc']}}</td>
                        <td>
                            <a class="btn btn-sm btn-success" href="/admin/ad/position/edit/{{$v['id']}}">编辑</a>
                            <a class="btn btn-sm btn-danger" href="/admin/ad/position/del/{{$v['id']}}">删除</a>
                        </td>
                    </tr>
                        @endforeach
                     @endif
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection