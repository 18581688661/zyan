$(function(){
  //创建和初始化地图函数：
    function initMap(){
      createMap();//创建地图
      setMapEvent();//设置地图事件
      addMapControl();//向地图添加控件
      addMapOverlay();//向地图添加覆盖物
    }
    function createMap(){ 
      map = new BMap.Map("dituContent"); 
      map.centerAndZoom(new BMap.Point(104.192083,30.661379),16);
    }
    function setMapEvent(){
      map.enableScrollWheelZoom();
      map.enableKeyboard();
      map.enableDragging();
      map.enableDoubleClickZoom()
    }
    function addClickHandler(target,window){
      target.addEventListener("click",function(){
        target.openInfoWindow(window);
      });
    }
    function addMapOverlay()
    {
      var markers = [
        {content:"张三(车牌号:川A•S8661)",imgurl:"/admin/public/img/右转超速报警.png",title:"右转超速",imageOffset: {width:0,height:0},position:{lat:30.666101,lng:104.190709}},
        {content:"李四(车牌号:川A•A3546)",imgurl:"/admin/public/img/右转超速报警.png",title:"右转超速",imageOffset: {width:0,height:0},position:{lat:30.660075,lng:104.192047}},
        {content:"王五(车牌号:川B•B8896)",imgurl:"/admin/public/img/右转报警.png",title:"右转报警",imageOffset: {width:0,height:0},position:{lat:30.658521,lng:104.188166}},
        {content:"星源(车牌号:川B•E9945)",imgurl:"/admin/public/img/经常报警地点.png",title:"经常报警",imageOffset: {width:0,height:0},position:{lat:30.656005,lng:104.191724}},
        {content:"杜波(车牌号:川A•C4975)",imgurl:"/admin/public/img/正常行驶.png",title:"正常行驶",imageOffset: {width:0,height:0},position:{lat:30.661069,lng:104.183819}}

      ];
      for(var index = 0; index < markers.length; index++ ){
        var point = new BMap.Point(markers[index].position.lng,markers[index].position.lat);
        var marker = new BMap.Marker(point,{icon:new BMap.Icon(markers[index].imgurl,new BMap.Size(40,40),{
          imageOffset: new BMap.Size(markers[index].imageOffset.width,markers[index].imageOffset.height)
        })});
        var label = new BMap.Label(markers[index].title,{offset: new BMap.Size(35,8)});
        var opts = {
          width: 200,
          title: markers[index].title,
          enableMessage: false
        };
        var infoWindow = new BMap.InfoWindow(markers[index].content,opts);
        // marker.setLabel(label);
        addClickHandler(marker,infoWindow);
        map.addOverlay(marker);
      };
    }
    
    //向地图添加控件
    function addMapControl(){
      var scaleControl = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
      scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
      map.addControl(scaleControl);
      var navControl = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
      map.addControl(navControl);
      var overviewControl = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:true});
      map.addControl(overviewControl);
    }
    var map;
      initMap();
});


