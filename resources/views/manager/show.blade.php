@extends('layouts.default')
@section('title','信息总览')
@section('title1', '后台管理系统')
@section('content')
<div class="row">
        <!-- 左边 -->
        <div class="col-lg-2">
            <div class="yc">
                <!-- <a href="{{ route('manager.show', Auth::manager()->get()->id) }}">
                <div class="wz ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb1">
                            <p id="a1" style="color:#12BCFF"><img src="/admin/public/img/dw2.png" alt=""><span>&nbsp行车位置</span></p>
                    </div>
                </div>
                </a>

                <a href="{{ route('forms_manage', Auth::manager()->get()->id) }}">
                <div class="tj ycdh">
                    <div class="tb tb2">
                        <p class="a2"><img src="/admin/public/img/tj1.png" alt="">&nbsp统计报表</p>
                    </div>
                </div>
                </a> -->

                <a href="{{ route('manager.show', Auth::manager()->get()->id) }}">
                <div class="tj ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb2">
                        <p class="a2" style="color:#12BCFF"><img src="/admin/public/img/tj2.png" alt="">&nbsp信息总览</p>
                    </div>
                </div>
                </a>

                <a href="{{ route('company_manage', Auth::manager()->get()->id) }}">
                <div class="ej ycdh">
                    <div class="tb tb4">
                        <p class="a"><img src="/admin/public/img/ej1.png" alt="">&nbsp公司管理</p>
                    </div>
                </div>   
                </a>

                <a href="{{ route('users_manage', Auth::manager()->get()->id) }}">
                <div class="ry ycdh">
                    <div class="tb tb3">
                        <p class="a3"><img id="tb1-img" src="/admin/public/img/ry1.png" alt="">&nbsp用户管理</p>
                    </div>
                </div>
                </a>

            </div>
        </div>

        <!-- 右边 -->
        <div class="col-lg-10">
            <!-- 地图上方图标 -->
            <div class="rongqi">
                <div class="tubiao" style="background:url(/admin/public/img/bg.png) no-repeat left top;">
                    <div class="biao1">
                        <table class="cs">
                            <tr>
                                <td><img src="/admin/public/img/cs.png"></td>
                                <td>
                                    <br>
                                    <span>转弯超速报警</span>
                                    <br>
                                    <h1>1</h1>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="biao2" style="background:url(/admin/public/img/bg.png) no-repeat left top;">
                        <table class='yz'>
                            <tr>
                                <td><img src="/admin/public/img/yz.png"></td>
                                <td>
                                    <br>
                                    <span>右转报警</span>
                                    <br>
                                    <h1>5</h1>
                                </td>
                            </tr>
                        </table>
                    </div>
                        <div class="biao3"  style="background:url(/admin/public/img/bg.png) no-repeat left top;">
                            <table class='jc'>
                                <tr>
                                    <td><img src="/admin/public/img/jc.png"></td>
                                    <td>
                                        <br>
                                        <span>经常报警</span>
                                        <br>
                                        <h1>4</h1>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="biao4"  style="background:url(/admin/public/img/bg.png) no-repeat left top;">
                            <table class='zc'>
                                <tr>
                                    <td><img src="/admin/public/img/zc.png"></td>
                                    <td>
                                        <br>
                                        <span>运行正常</span>
                                        <br>
                                        <h1>7</h1>
                                    </td>
                                </tr>   
                            </table>
                        </div>
                        
                </div>

                <!-- 地图 -->
                <div class="ditu">
                <!-- 地图容器 -->
                <div style="width:1055px;height:450px;border:#ccc solid 1px;" id="dituContent"></div>
                </div>

                <!-- 地图下方标识 -->
                <div class="bs">
                <span class="btn zc">不显示正常运行</span>
                <span class="btn yz">不显示右转报警</span>
                <span class="btn jc">不显示经常报警</span>
                <span class="btn cs">不显示超速运行</span>
                </div>
            </div>
        </div>
    </div>
@stop