@extends('layouts.default')
@section('title','用户管理')
@section('title1', '后台管理系统')
@section('content')
<div class="row">
    <!-- 左边 -->
        <div class="col-lg-2">
            <div class="yc">
                <a href="{{ route('manager.show', Auth::manager()->get()->id) }}">
                <div class="wz ycdh">
                    <div class="tb tb1">
                            <p id="a1"><img src="/admin/public/img/dw1.png" alt=""><span>&nbsp行车位置</span></p>
                    </div>
                </div>
                </a>

                <a href="{{ route('forms_manage', Auth::manager()->get()->id) }}">
                <div class="tj ycdh">
                    <div class="tb tb2">
                        <p class="a2"><img src="/admin/public/img/tj1.png" alt="">&nbsp统计报表</p>
                    </div>
                </div>
                </a>

                <a href="{{ route('users_manage', Auth::manager()->get()->id) }}">
                <div class="ry ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb3">
                        <p class="a3" style="color:#12BCFF"><img id="tb1-img" src="/admin/public/img/ry2.png" alt="">&nbsp人员管理</p>
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
            </div>
        </div>
        
        <!-- 右边 -->
        <div class="col-lg-10">
                <div class="form-group">
                    <form action="{{ route('users_manage',Auth::manager()->get()->id) }}" method="GET">
                        <label for="keyword">搜索用户</label>
                        <label for="type">搜索方式：</label>
                        <select  name="type">
                            <option value="username">用户名</option>
                            <option value="gender">性别</option>
                            <option value="mobile">手机号</option>
                            <option value="real_name">真实姓名</option>
                            <option value="ID_card">身份证号</option>
                            <option value="address">居住地址</option>
                            <option value="model">车型</option>
                            <option value="plate">车牌号</option>
                            <option value="driver_licence_num">驾驶证号</option>
                            <option value="company">所属公司</option>
                        </select>
                        <input type="text" name="keyword" class="form-control">
                        <button type="submit" class="btn btn-info">搜索</button>
                    </form>
                </div>
    @if (count($users))
        <table class="table table-bordered">
            <tr>
                <td class="text-center" style="vertical-align: middle">头像</td>
                <td class="text-center" style="vertical-align: middle">用户名</td>
                <td class="text-center" style="vertical-align: middle">性别</td>
                <td class="text-center" style="vertical-align: middle">联系方式</td>
                <td class="text-center" style="vertical-align: middle">真实姓名</td>
                <td class="text-center" style="vertical-align: middle">身份证号</td>
                <td class="text-center" style="vertical-align: middle">居住地址</td>
                <td class="text-center" style="vertical-align: middle">车型</td>
                <td class="text-center" style="vertical-align: middle">车牌号</td>
                <td class="text-center" style="vertical-align: middle">驾驶证号</td>
                <td class="text-center" style="vertical-align: middle">所属公司</td>
                <td class="text-center" style="vertical-align: middle">操作</td>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td class="text-center" style="vertical-align: middle">
                <section class="user_info">
                <img src="@if($user->image_url)<?php echo '/images/'.$user->image_url ?>@else /images/all.png @endif" width="70";height="70" alt="{{ $user->name }}" class="gravatar"/>
                </section>
                </td>
                <td class="text-center" style="vertical-align: middle">{{ $user->username }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $user->gender }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $user->mobile }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $user->real_name }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $user->ID_card }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $user->address }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $user->model }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $user->plate }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $user->driver_licence_num }}</td>
                <td class="text-center" style="vertical-align: middle">@if($user->company){{ $user->get_company_name($user->company) }}@else无@endif</td>
                <td class="text-center" style="vertical-align: middle">
                    <form action="{{ route('users.destroy', $user->id )}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn">删除用户</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $users->render() !!}
    @else
    暂无数据！
    @endif
        </div>
</div>
@stop