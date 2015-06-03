@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>用户申请</span>
            </h1>
            <ul class="main-header__breadcrumb">

            </ul>
        </div>
    </header>
@stop

@section('container')
    <div class="row">
        <div class="col-md-12">
            <article class="widget">
                <header class="widget__header">
                    <div class="widget__title">
                        <i class="pe-7s-display2"></i><h3>申请列表</h3>
                    </div>
                    <div class="widget__config">
                        <a href="/admin/member/create"><i class="pe-7f-plus"></i></a>
                        <a href="#" onclick="deleteOnPage()"><i class="pe-7s-close"></i></a>
                    </div>
                </header>

                <div class="widget__content table-responsive">

                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>用户名</th>
                            <th>密码</th>
                            <th>方案</th>
                            <th>申请时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($applies as $apply)
                            <tr class="spacer apply-{{$apply->id}}"></tr>
                            <tr class="apply-{{$apply->id}}">
                                <td class="apply-id">{{$apply->id}}</td>
                                <td>{{$apply->username}}</td>
                                <td>{{$apply->password}}</td>
                                <td>{{$apply->plan}}</td>
                                <td>{{$apply->created_at}}</td>
                                <td>
                                    <button class="btn green fixed" onclick="agree({{$apply->id}})">通过</button>
                                    <button class="btn red fixed" onclick="reject({{$apply->id}})">拒绝</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </article>
        </div>
    </div>
@stop


@section('scripts')
    <script>
        function agree(id){_post('agree',id)}
        function reject(id) {_post('reject',id)}
        function _post(method,id) {
            $.post("/admin/member/"+method,{
                _token : "{{csrf_token()}}",
                id : id
            },function(res){
                if(res.ret) $(".apply-"+id).remove(); else alert(res.error);
            },'json')
        }
        function deleteOnPage() {
            var id = [];
            $(".apply-id").each(function(i,e){
                id.push($(e).html())
            });
            if(confirm("确定删除本页所有申请吗?")) {
                $.post("/admin/member/delete/batch",{
                    _token : "{{csrf_token()}}",
                    id : id.join(",")
                },function(res){
                    if(res.ret) location.reload(); else alert(res.error);
                },'json')
            }
        }
    </script>
@stop