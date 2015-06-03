@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>VPN用户</span>
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
                        <i class="pe-7s-display2"></i><h3>用户列表</h3>
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
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($members as $member)
                            <tr class="spacer m-{{$member->id}}"></tr>
                            <tr class="m-{{$member->id}}">
                                <td class="member-id">{{$member->id}}</td>
                                <td>{{$member->username}}</td>
                                <td>{{$member->value}}</td>
                                <td>{{$member->groupname}}</td>
                                <td>
                                    <a class="btn green fixed" href="/member/profile/{{$member->username}}" target="_blank">查看</a>
                                    <button class="btn red fixed" onclick="destroy('{{$member->id}}','{{$member->username}}')">删除</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </article>
            {!!$members->render()!!}
        </div>



    </div>
@stop


@section('scripts')
    <script>
        function destroy(id,username) {
            if(confirm("确定删除该用户吗")) {
                $.post("/admin/member/delete",{
                    _token : "{{csrf_token()}}",
                    id : id,
                    username : username
                },function(res){
                    if(res.ret) location.reload(); else alert(res.error);
                },'json')
            }
        }
    </script>
@stop