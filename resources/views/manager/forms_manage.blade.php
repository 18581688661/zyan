@extends('layouts.default')
@section('title','统计报表')
@section('title1', '后台管理系统')
@section('css')
/*左侧导航样式*/
        .yc a{
            text-decoration: none;
        }

        .biao1{
            margin-left: -30px;
            margin-top: 40px;
            background: #fff;
            width: 520px;
        }
        .biao2{
            margin-left: -10px;
            margin-top: 40px;
            width: 520px;
            background: #fff;
        }
        .biao1 .kz{
            width: 500px;
            /*background: #ccc;*/
            height: 40px;
        }
       
        .kong{
            height: 100px;
        }
        
        .kz span{
            /*font-weight: bold;*/
            border-radius: 30px;
            font-size: 14px;
            border:1px solid #12bcff;
            margin-top:20px;
            margin-left:36px;
        }
        .kz .btn1{
            width: 110px;
            color: #12bcff;
        }
        .kz .btn2{
            width:70px;
            color: #12bcff;
            margin-left: 10px;
        }
        .kz .btn3{
            width: 70px;
            margin-left: 10px;
            color: #ccc;
        }
        .kz .btn4{
            margin-left: 10px;
            width: 70px;
            color: #ccc;
        }
        .kz .btn5{
            margin-left: 10px;
            width: 70px;
            color: #ccc;
        }
        .lxtj{
            margin-top: 30px;
            margin-left:20px;
        }
        .butong{
            margin-top: 15px;
            margin-left:20px;
        }
        .rongqi1{
            margin-left: 48px;
        }
@stop


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
                <div class="tj ycdh" style="background: rgb(227, 247, 254);border-right: 3px solid rgb(107, 213, 255)">
                    <div class="tb tb2">
                        <p class="a2" style="color:#12BCFF"><img src="/admin/public/img/tj2.png" alt="">&nbsp统计报表</p>
                    </div>
                </div>
                </a>

                <a href="{{ route('users_manage', Auth::manager()->get()->id) }}">
                <div class="ry ycdh">
                    <div class="tb tb3">
                        <p class="a3"><img id="tb1-img" src="/admin/public/img/ry1.png" alt="">&nbsp人员管理</p>
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
        <div class="col-lg-10" href="">
            <div class="rongqi1">
                    <!-- 左侧图表 -->
                <div class="col-md-6">
                    <!-- 路线报警统计 -->
                    <div class="biao1">                 
                        <div class="kz">
                            <div class="time1">
                                <span class="btn btn1">显示数据</span>
                                <span class="btn btn2">全部</span>
                                <span class="btn btn3">年</span>
                                <span class="btn btn4">季</span>
                                <span class="btn btn5">月</span>
                            </div>
                        </div>
                        <div class="lxtj" id="main" style="width: 500px;height:400px;"></div>
                        <div class="kb" style="background:#fafafb;height:50px"></div>
                        <div style="width: 500px;height:350px;">
                            <div id="shebei" style="margin-top:20px;margin-left:25px;width: 450px;height:350px;"></div>
                        </div>
                    </div>
                    <!-- 设备使用率 -->
                   <!--  <div class="xiabiao">
                    </div> -->
                </div>
                <!-- 右侧图表 -->
                <div class="col-md-6">
                    <div class="biao2">
                         <div class="kz">
                            <div class="time2">
                                <span class="btn btn1">显示数据</span>
                                <span class="btn btn2">全部</span>
                                <span class="btn btn3">年</span>
                                <span class="btn btn4">季</span>
                                <span class="btn btn5">月</span>
                            </div>
                        </div>
                        <div class="butong" id="butong" style="width: 500px;height:400px;"></div>
                    </div>
                </div>
            </div>
            <div class="bijiao" style="margin-top:1000px">
                    <table class='table table-striped table-bordered table-hover table-condensed'>
                        <!-- 浅灰色 -->
                        <tr class='active'>
                            <th>
                                <button class="btn btn-xs" id="all">全选</button>
                                <button class="btn btn-xs" id="notall">全不选</button>
                                <button class="btn btn-xs" id="unall">反选</button>
                            </th>
                            <th>姓名</th>
                            <th>报警次数</th>
                            <th>查看个人报警</th>
                        </tr>
                        <!-- 浅绿色 -->
                        <tr>
                            <td><label><input type="checkbox" name="a" id=""> </label></td>
                            <td>张三</td>
                            <td>6</td>
                            <td><button class="btn btn-xs">查看</button></td>
                            
                        </tr>

                        <!-- 浅蓝色 -->
                        <tr class='active'>
                            <td><label><input type="checkbox" name="a" id=""> </label></td>
                            <td>李四</td>
                            <td>5</td>
                            <td><button class="btn btn-active btn-xs">查看</button></td>
                            
                        </tr>
                        
                        <!-- 浅黄色 -->
                        <tr>
                            <td><label><input type="checkbox" name="a" id=""> </label></td>
                            <td>王五</td>
                            <td>5</td>
                            <td><button class="btn btn-xs">查看</button></td>
                            
                        </tr>

                        <!-- 浅红色 -->
                        <tr class='active'>
                            <td><label><input type="checkbox" name="a" id=""> </label></td>
                            <td>张刚</td>
                            <td>4</td>
                            <td><button class="btn btn-active btn-xs">查看</button></td>
                        
                        </tr>
                    </table>
                    <button class="btn btn-info">比较</button>
                    <div class="kong">
                    </div>
                </div>
        </div>
</div>
<script>

// 表一
 // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
             title: {
            text: '路线报警统计'
            },
            tooltip: {
                // 竖线查看
                trigger: 'axis'
            },
            legend: {
                // 数据组
                data:['1路','12路','136路']
            },
            // grid: {
            //     left: '3%',
            //     right: '4%',
            //     bottom: '3%',
            //     containLabel: true
            // },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            // X坐标
            xAxis: {
                // 区分拐点位置
                type: 'category',
                boundaryGap: false,
                data: ['4月','5月','6月','7月','8月']
            },
            // Y坐标
            yAxis: {
                type: 'value'
            },
            // 每组数据相应的值
        series: [
            {
                name:'1路',
                type:'line',
                stack: '总量',
                data:[6,3, 5, 7, 4]
            },
            {
                name:'12路',
                type:'line',
                stack: '总量',
                data:[4,5, 8, 4,6]
            },
            {
                name:'136路',
                type:'line',
                stack: '总量',
                data:[5,10,5,9,3]
            },
            
        ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);


        // 表二
         // 基于准备好的dom，初始化echarts实例
        var IChart = echarts.init(document.getElementById('butong'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '不同地点报警'
            },
            tooltip: {
                // 竖线查看
                trigger: 'axis'
            },
            legend: {
                data:['报警次数']
            },
            xAxis: {
                // 区分拐点位置
                type: 'category',
                boundaryGap: false,
                data: ["江华路口","永丰立交","三岔口","成渝立交","十陵立交","建设路口"]
            },
            yAxis: {},
            series: [{
                name: '报警次数',
                type: 'line',
                data: [12, 7, 14, 9, 12,7]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        IChart.setOption(option);


        // 左侧设备使用率
        // 基于准备好的dom，初始化echarts实例
        var SChart = echarts.init(document.getElementById('shebei'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '设备使用情况'

            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            // 标注类型
            legend: {
                orient: 'vertical',
                x: 'right',
                data:['运行中','离线','故障']
            },

            // series: [
            // {
            //     name:'次数',
            //     type:'pie',
            //     // 控制内环大小
            //     radius: ['50%', '70%'],
            //     avoidLabelOverlap: false,
            //     label: {
            //         normal: {
            //             show: false,
            //             position: 'center',
            //             textStyle: {color: 'rgba(155, 155, 155, 0.3)'}
            //         },
            //         emphasis: {
            //             show: true,
            //             textStyle: {
            //             fontSize: '30',
            //             fontWeight: 'bold'
            //                 }
            //             }
            //         },
            //     labelLine: {
            //         normal: {
            //             show: false
            //         }
            //     },
            //     // 图形比例
            //     data:[
            //         {value:234, name:'运行中'},
            //         {value:90, name:'离线'},
            //         {value:20,name:'故障'},
            //         ]
            //     }
            // ]
            series : [
                {
                    name: '设备使用情况',
                    type: 'pie',
                    radius: '70%',
                    label: {
                        normal: {
                        textStyle: {
                        fontSize: '18'
                        }
                        }
                    },
                    data:[
                        {value:295, name:'运行中'},
                        {value:200, name:'离线'},
                        {value:40, name:'故障'}
                    ]
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        SChart.setOption(option);


        // 比较表格的选择效果
        $('#all').click(function(){
            $(':checkbox').attr({'checked':true});
        });

        $('#notall').click(function(){
            $(':checkbox').attr({'checked':false});
        });

        $('#unall').click(function(){
            $(':checkbox').each(function(){
                this.checked=!this.checked;
            });
        });
</script>
@stop