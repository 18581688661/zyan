@extends('layouts.default')
@section('title','添加Entity')
@section('content')
<div >
    <a href='http://localhost/zyan/public/'>首页</a><span class="sep">&gt;</span><span>公司管理中心</span>
</div>
<div class="container col-lg-2">
    <ul  class="nav nav-pills nav-stacked">
        <li>
            <a href="{{ route('monitor') }}">实时监控</a>
        </li>
        <li>
            <a href="#">报警管理</a>
        </li>
        
        <li>
            <a href="{{ route('employee_manage', Auth::company()->get()->id) }}">员工管理</a>
        </li>
    </ul>
</div>
<div class=" col-lg-10">
    <!-- <form action="http://yingyan.baidu.com/api/v3/entity/add" method="POST">
        <input type="text" name="ak" value="X85Fq4znsFj6G4TupjRCj14T9l6j0mGO">
        <input type="text" name="service_id" value="145932">
        <input type="text" name="entity_name" value="1">
        <input type="submit" value="提交">
    </form>

    <form action="http://yingyan.baidu.com/api/v3/track/addpoint" method="POST">
        <input type="text" name="ak" value="X85Fq4znsFj6G4TupjRCj14T9l6j0mGO">
        <input type="text" name="service_id" value="145932">
        <input type="text" name="entity_name" value="1">
        <input type="text" name="latitude" value="31.67">
        <input type="text" name="longitude" value="105.06">
        <input type="text" name="loc_time" value="1500461493">
        <input type="text" name="coord_type_input" value="wgs84">
        <input type="submit" value="提交">
    </form>

    <form action="http://yingyan.baidu.com/api/v3/entity/search" method="GET">
        <input type="text" name="ak" value="X85Fq4znsFj6G4TupjRCj14T9l6j0mGO">
        <input type="text" name="service_id" value="145932">
        
        <input type="submit" value="提交">
    </form> -->

    
</div>
@stop