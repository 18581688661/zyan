@extends('layouts.default')
@section('title', '智眼注册')
@section('title1', '公司注册')
@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>公司注册<a class="btn btn-sm btn-success" href="{{ route('signup') }}" role="button">用户注册</a></h5>
    </div>
    <div class="panel-body">
    	@include('shared.errors')
      <form method="POST" action="{{ route('company.store') }}">
      	{{ csrf_field() }}
          <div class="form-group">
            <label for="company_account">公司账号：</label>
            <input type="text" name="company_account" class="form-control" value="{{ old('company_account') }}">
          </div>

          <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          </div>

          <div class="form-group">
            <label for="company_name">公司名称：</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}">
          </div>

          <div class="form-group">
            <label for="company_introduction">公司简介：</label>
            <input type="text" name="company_introduction" class="form-control" value="{{ old('company_introduction') }}">
          </div>
          
          <div class="form-group">
            <label for="email">公司邮箱：</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
          </div>

          <div class="form-group">
            <label for="company_address">公司地址：</label>
            <input type="text" name="company_address" class="form-control" value="{{ old('company_address') }}">
          </div>

          <div class="form-group">
            <label for="postalcode">公司邮编：</label>
            <input type="text" name="postalcode" class="form-control" value="{{ old('postalcode') }}">
          </div>

          <div class="form-group">
            <label for="business_licence">营业执照注册号：</label>
            <input type="text" name="business_licence" class="form-control" value="{{ old('business_licence') }}">
          </div>

          <div class="form-group">
            <label for="organization_code">组织机构代码：</label>
            <input type="text" name="organization_code" class="form-control" value="{{ old('organization_code') }}">
          </div>

          <button type="submit" class="btn btn-primary">注册</button>
      </form>
    </div>
  </div>
</div>
@stop