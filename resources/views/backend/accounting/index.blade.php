@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>Users Accounting</span>
            </h1>
            <ul class="main-header__breadcrumb">

            </ul>
        </div>
    </header>
@stop

@section('container')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <article class="widget">
                <div class="widget__content filled widget-ui">
                    <div class="row">
                        <div class="col-md-12 text-center btn-vars__showcase">
                            <a type="button" class="filter btn red" href="/admin/accounting">全部用户</a>
                            @foreach($users as $user)
                                <a type="button" class="filter btn green <?php echo $user->username == $username ? 'inverse' : '';?>" href="/admin/accounting?username={{$user->username}}">{{$user->username}}</a>
                            @endforeach
                            {!!$users->render()!!}
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <article class="widget">
                <div class="widget__content table-responsive">

                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th>用户名</th>
                            <th>连接时间</th>
                            <th>结束时间</th>
                            <th>总计</th>
                            <th>上传</th>
                            <th>下载</th>
                            <th>终止</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($records as $record)
                            <tr class="spacer m-{{$record->radacctid}}"></tr>
                            <tr class="m-{{$record->radacctid}}">
                                <td>{{$record->username}}</td>
                                <td>{{$record->acctstarttime}}</td>
                                <td>{{$record->acctstoptime}}</td>
                                <td>{{time2str($record->acctsessiontime)}}</td>
                                <td>{{toxbyte($record->acctinputoctets)}}</td>
                                <td>{{toxbyte($record->acctoutputoctets)}}</td>
                                <td>{{$record->acctterminatecause}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </article>
            {!!$records->appends($query)->render()!!}
        </div>
    </div>
@stop


@section('scripts')

@stop