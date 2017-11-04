<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '智眼首页')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/public/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/public/css/admin.css">
    <script src='/public/bs/js/jquery.min.js'></script>
    <script src='/public/bs/js/bootstrap.min.js'></script>
    <script src='/public/bs/js/docs.min.js'></script>
    <script src="/admin/public/js/admin.js"></script>
    <script src="/js/app.js"></script>
    <script src="/admin/public/js/echarts.js"></script>
    <script src="/js/vintage.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=X85Fq4znsFj6G4TupjRCj14T9l6j0mGO"></script>
    <style type="text/css">
    @yield('css')
    </style>
 

    <script type="text/javascript">
    var sleep = 60, interval = null;
    window.onload = function ()
    {
        var btn = document.getElementById ('btn');
        btn.onclick = function ()
        {
            if (!interval)
            {
              $.ajax({  
           　 type: "get", //用POST方式传输     　　  
           　 url: "{{ route('sms') }}", 
              data: {mobile:$("input[name='mobile']").val()},
              }); 
                this.style.backgroundColor = 'rgb(243, 182, 182)';
                this.disabled = "disabled";
                this.style.cursor = "wait";
                this.value = "重新发送 (" + sleep-- + ")";
                interval = setInterval (function ()
                {
                    if (sleep == 0)
                    {
                        if (!!interval)
                        {
                            clearInterval (interval);
                            interval = null;
                            sleep = 60;
                            btn.style.cursor = "pointer";
                            btn.removeAttribute ('disabled');
                            btn.value = "免费获取验证码";
                            btn.style.backgroundColor = '';
                        }
                        return false;
                    }
                    btn.value = "重新发送 (" + sleep-- + ")";
                }, 1000);
            }
        }
    }
</script>
  </head>
  <body>
    @include('layouts._header')

    <!-- <div class="container"> -->
      <!-- <div class="col-md-offset-1 col-md-10"> -->
        @include('shared.messages')
        @yield('content')
        @include('layouts._footer')
      <!-- </div> -->
    <!-- </div> -->
    <script src="http://localhost/zyan/public/js/app.js"></script>
  </body>
</html>