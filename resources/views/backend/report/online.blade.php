@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>在线VPN用户</span>
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

                <div class="widget__content table-responsive">

                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th width="50">用户名</th>
                            <th width="80">IP</th>
                            <th width="50">连接时间</th>
                            <th width="80">总用时</th>
                            <th width="200">流量</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($members as $member)
                            <tr class="spacer m-{{$member->radacctid}}"></tr>
                            <tr class="m-{{$member->radacctid}}">
                                <td>{{$member->username}}</td>
                                <td>{{$member->framedipaddress}}<br>{{$member->callingstationid}}</td>
                                <td>{{$member->acctstarttime}}</td>
                                <td>{{time2str($member->acctsessiontime)}}</td>
                                <td>
                                    上传:{{toxbyte($member->acctinputoctets)}}<br>
                                    下载:{{toxbyte($member->acctoutputoctets)}}<br>
                                    总计:{{toxbyte($member->acctinputoctets + $member->acctoutputoctets)}}<br>
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