@extends('layouts.default')
@section('title','员工审核')
@section('title1','公司管理系统')
@section('content')
<div class="row">
    <!-- 左边 -->
        <div class="col-lg-2">
            <div class="yc">
                <a href="{{ route('company.show', Auth::company()->get()->id) }}">
                <div class="wz ycdh">
                    <div class="tb tb1">
                            <p id="a1"><img src="/admin/public/img/tj1.png" alt=""><span>&nbsp报警情况</span></p>
                    </div>
                </div>
                </a>

                <a href="#">
                <div class="ry ycdh">
                    <div class="tb tb3">
                        <p class="a3"><img id="tb1-img" src="/admin/public/img/ej1.png" alt="">&nbsp公司资料</p>
                    </div>
                </div>
                </a>

                <a href="{{ route('employee_manage', Auth::company()->get()->id) }}">
                <div class="ry ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb3">
                        <p class="a3" style="color:#12BCFF"><img id="tb1-img" src="/admin/public/img/ry2.png" alt="">&nbsp员工管理</p>
                    </div>
                </div>
                </a>        
            </div>
        </div>
        
        <!-- 右边 -->
        <div class=" col-lg-10">
            @if (count($employees))
    所有员工：
        <table class="table table-bordered">
            <tr>
                <td class="text-center" style="vertical-align: middle">头像</td>
                <td class="text-center" style="vertical-align: middle">员工姓名</td>
                <td class="text-center" style="vertical-align: middle">性别</td>
                <td class="text-center" style="vertical-align: middle">联系方式</td>
                <td class="text-center" style="vertical-align: middle">身份证号</td>
                <td class="text-center" style="vertical-align: middle">居住地址</td>
                <td class="text-center" style="vertical-align: middle">车型</td>
                <td class="text-center" style="vertical-align: middle">车牌号</td>
                <td class="text-center" style="vertical-align: middle">驾驶证号</td>
                <td class="text-center" style="vertical-align: middle">操作</td>
            </tr>
            @foreach ($employees as $employee)
            <tr>
                <td class="text-center" style="vertical-align: middle"><section class="user_info">
                <img src="@if($employee->image_url)<?php echo '/images/'.$employee->image_url ?>@else /images/all.png @endif" width="70";height="70" alt="{{ $employee->name }}" class="gravatar"/>
                </section>
                </td>
                <td class="text-center" style="vertical-align: middle">{{ $employee->real_name }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $employee->gender }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $employee->mobile }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $employee->ID_card }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $employee->address }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $employee->model }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $employee->plate }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $employee->driver_licence_num }}</td>
                <td class="text-center" style="vertical-align: middle">
                    <form action="{{ route('employee_audit',$employee->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn">审核通过</button>
                    </form>
                    
                        
                    <button type="submit" class="btn" data-toggle="modal" data-target="#{{ $employee->id }}">拒绝申请</button>
                    <div class="modal fade container" id="{{ $employee->id }}" style=" background-color: #d5e4de;
                                            width: 500px;
                                            height:200px;
                                            border-radius: 10px;
                                            margin-top: 150px;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <form action="{{ route('employee_refuse_audit',$employee->id) }}" method="POST" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <h2 class="text-center">拒绝操作</h2>
                                                <div class="form-group">
                                                    
                                                    <div class="col-lg-12 ">
                                                    <input type="text" class="form-control" name="reason" placeholder="请输入拒绝原因">
                                                    </div>
                                                </div>
                                            <button type="submit" class="btn btn-success form-control">确认拒绝</button>
                                            </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $employees->render() !!}
    @else
    暂无数据！
    @endif
        </div>
</div>
@stop