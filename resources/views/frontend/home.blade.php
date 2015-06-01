@extends('layouts.frontend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-note2"></i>
                <span>VPN Plan</span>
            </h1>
            <ul class="main-header__breadcrumb">

            </ul>
        </div>

    </header>
@stop

@section('container')
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <article class="widget">
                <header class="widget__header">
                    <div class="widget__title full-width">
                        <i class="pe-7s-menu"></i><h3>Plans</h3>
                    </div>
                </header>

                <div class="widget__content table-responsive">

                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th width="100">Plan</th>
                            <th width="240">介绍</th>
                            <th width="50">状态</th>
                            <th width="50">价格</th>
                            <th>选择</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr class="spacer"></tr>
                        <tr>
                            <td>Plan A</td>
                            <td>每日流量2G，每月流量30G</td>
                            <td>可申请</td>
                            <td>免费</td>
                            <td>
                                <input type="checkbox" id="s-2" class="sw" checked />
                                <label class="switch" for="s-2"></label>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        <tr>
                            <td>Plan B</td>
                            <td>每日流量20G，每月流量100G</td>
                            <td>未开通</td>
                            <td>免费</td>
                            <td>
                                <input type="checkbox" id="s-8" class="sw" disabled />
                                <label class="switch" for="s-8"></label>
                            </td>
                        </tr>


                        </tbody>
                    </table>



                </div>

            </article><!-- /widget -->
        </div>


        <div class="col-md-4">
            <article class="widget widget__form">
                <header class="widget__header">
                    <div class="widget__title full-width">
                        <i class="pe-7s-menu"></i><h3>账号信息</h3>
                    </div>
                </header>

                <div class="widget__content">
                    <input type="text" placeholder="用户名">
                    <input type="password" placeholder="密码">
                    <button type="button">申请</button>
                </div>
        </div>


    </div>
@stop