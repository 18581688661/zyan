@extends('layouts.default')
@section('title', '智眼登录')
@section('title1', '公司登录')
@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>公司登录
      <a class="btn btn-sm btn-success" href="{{ route('login') }}" role="button">用户登录</a>
      <a class="btn btn-sm btn-success" href="{{ route('mana_login') }}" role="button">管理员登录</a>
      </h5>
    </div>
    <div class="panel-body">
      @include('shared.errors')

      <form method="POST" action="{{ route('company_login') }}">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="company_account">公司账号：</label>
            <input type="text" name="company_account" class="form-control" value="{{ old('company_account') }}">
          </div>

          <div class="form-group">
          <label for="password">密码（<a href="{{ route('password.reset') }}">忘记密码</a>）：</label>
          <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="remember">记住我</label>
          </div>

          <button type="submit" class="btn btn-primary">登录</button>
      </form>

      <hr>

      <p>还没有账号？<a href="{{ route('signup') }}">现在注册！</a></p>
    </div>
  </div>
</div>
@stop