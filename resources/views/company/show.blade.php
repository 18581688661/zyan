@extends('layouts.default')
@section('title','实时监控')
@section('title1','公司管理系统')
@section('content')
<div class="row">
    <!-- 左边 -->
        <div class="col-lg-2">
            <div class="yc">
                <a href="{{ route('company.show', Auth::company()->get()->id) }}">
                <div class="wz ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb1">
                            <p id="a1" style="color:#12BCFF"><img src="/admin/public/img/dw2.png" alt=""><span>&nbsp实时监控</span></p>
                    </div>
                </div>
                </a>

                <a href="{{ route('employee_manage', Auth::company()->get()->id) }}">
                <div class="ry ycdh">
                    <div class="tb tb3">
                        <p class="a3"><img id="tb1-img" src="/admin/public/img/ry1.png" alt="">&nbsp员工管理</p>
                    </div>
                </div>
                </a>    

                <a href="#">
                <div class="ry ycdh">
                    <div class="tb tb3">
                        <p class="a3"><img id="tb1-img" src="/admin/public/img/ry1.png" alt="">&nbsp待定。。</p>
                    </div>
                </div>
                </a>        
            </div>
        </div>
        
        <!-- 右边 -->
        <div class=" col-lg-10">
            come back soon！
        </div>
</div>
@stop