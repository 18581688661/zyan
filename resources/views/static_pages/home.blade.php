@extends('layouts.default')
@section('title1', '智眼')
@section('content')
  <!-- @if (Auth::check() or Auth::manager()->check() or Auth::company()->check())
   <div class="jumbotron">
      <h1 style="text-align:center">用户已登录</h1>
      <p class="lead" style="text-align:center">
        你现在所看到的是智能货车助手官网。
      </p>
      <p style="text-align:center">
        一切，将从这里开始。
      </p>
      <p style="text-align:center">
        <a class="btn btn-lg btn-success" href="{{ route('login') }}" role="button">现在登陆</a>
      </p>
    </div>
  @else
    <div class="jumbotron">
      <h1 style="text-align:center">智能货车助手</h1>
      <p class="lead" style="text-align:center">
        你现在所看到的是智能货车助手官网。
      </p>
      <p style="text-align:center">
        一切，将从这里开始。
      </p>
      <p style="text-align:center">
        <a class="btn btn-lg btn-success" href="{{ route('login') }}" role="button">现在登录</a>
      </p>
    </div>    
  @endif -->
  <div class="container" style="text-align: center">
    <video src="/video/zyan.mp4"  width="800" height="450" controls="controls">
  Your browser does not support the video tag.
    </video>
  </div>
@stop