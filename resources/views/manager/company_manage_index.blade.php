@extends('layouts.default')
@section('title','公司管理')
@section('title1','后台管理系统')
@section('content')
<div class="row">
    <!-- 左边 -->
        <div class="col-lg-2">
            <div class="yc">
                <a href="{{ route('manager.show', Auth::manager()->get()->id) }}">
                <div class="tj ycdh">
                    <div class="tb tb2">
                        <p class="a2"><img src="/admin/public/img/tj1.png" alt="">&nbsp信息总览</p>
                    </div>
                </div>
                </a>

                <a href="{{ route('company_manage', Auth::manager()->get()->id) }}">
                <div class="ej ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb4">
                        <p class="a" style="color:#12BCFF"><img src="/admin/public/img/ej2.png" alt="">&nbsp公司管理</p>
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
                <div class="form-group">
                    <form action="{{ route('company_manage',Auth::manager()->get()->id) }}" method="GET">
                        <label for="keyword">搜索公司</label>
                        <label for="type">搜索方式：</label>
                        <select  name="type">
                            <option value="company_account">公司账号</option>
                            <option value="company_name">公司名称</option>
                            <option value="company_introduction">公司简介</option>
                            <option value="company_address">公司地址</option>
                            <option value="email">公司邮箱</option>
                            <option value="postalcode">公司邮编</option>
                            <option value="business_licence">营业执照注册号</option>
                            <option value="organization_code">组织机构代码</option>
                        </select>
                        <input type="text" name="keyword" class="form-control">
                        <button type="submit" class="btn btn-info">搜索</button>
                    </form>
                </div>
        @if (count($companies))
        <table class="table table-bordered">
            <tr>
                <td class="text-center" style="vertical-align: middle">公司账号</td>
                <td class="text-center" style="vertical-align: middle">公司名称</td>
                <td class="text-center" style="vertical-align: middle">公司简介</td>
                <td class="text-center" style="vertical-align: middle">公司地址</td>
                <td class="text-center" style="vertical-align: middle">公司邮箱</td>
                <td class="text-center" style="vertical-align: middle">公司邮编</td>
                <td class="text-center" style="vertical-align: middle">营业执照注册号</td>
                <td class="text-center" style="vertical-align: middle">组织机构代码</td>
                <td class="text-center" style="vertical-align: middle">激活状态</td>
                <td class="text-center" style="vertical-align: middle">操作</td>
            </tr>
            @foreach ($companies as $company)
            <tr>
                <td class="text-center" style="vertical-align: middle">{{ $company->company_account }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->company_name }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->company_introduction }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->company_address }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->email }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->postalcode }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->business_licence }}</td>
                <td class="text-center" style="vertical-align: middle">{{ $company->organization_code }}</td>
                <td class="text-center" style="vertical-align: middle">@if($company->activated==0)未审核@elseif($company->activated==2)已驳回@else已审核@endif</td>
                <td class="text-center" style="vertical-align: middle">
                    @if($company->activated==0)
                    <form action="{{ route('audit',$company->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn">通过审核</button>
                    </form>
                    <form action="{{ route('refuse_audit',$company->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn">驳回信息</button>
                    </form>
                    @endif
                    <form action="{{ route('company.destroy',$company->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn">删除公司</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $companies->render() !!}
        @else
            暂无数据！
        @endif
        </div>
</div>
@stop
