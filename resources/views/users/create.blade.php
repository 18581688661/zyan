@extends('layouts.default')
@section('title', '智眼注册')
@section('title1', '用户注册')
@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>用户注册<a class="btn btn-sm btn-success" href="{{ route('company_signup') }}" role="button">公司注册</a></h5>
    </div>
    <div class="panel-body">
    	@include('shared.errors')
      <form method="POST" action="{{ route('users.store') }}">
      	{{ csrf_field() }}
          <div class="form-group">
            <label for="username">用户名：</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
          </div>

          
            <label>性别：</label>
        <input checked type="radio" name="gender" value="男">男
        <input type="radio" name="gender" value="女">女
        <input type="radio" name="gender" value="保密">保密
          

          <div class="form-group">
            <label for="mobile">手机号：</label>
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}">
            <input id="btn" class=" btn btn-info" type="button" value="免费获取验证码"/>
          </div>
          
          <div class="form-group">
            <label for="verification_code">验证码：</label>
            <input type="text" name="verification_code" class="form-control" value="{{ old('verification_code') }}">
          </div>

          <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          </div>

          <button type="submit" class="btn btn-primary">注册</button>
      </form>
    </div>
  </div>
</div>
@stop