<?php
//関数
include("include/func.php");

//SQL
$pdo = db_con(); //DB接続
$stmt = $pdo->prepare("SELECT * FROM map_info");
$flag = $stmt->execute();

//データ表示
$view="";
if($flag==false){
  $view = "SQLエラー";
}else{
  //※データ作成処理
  //-----------------------------------------------------------------------------------
//  $i=0;
//  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
//    if($i==0){
//      //ループ初回のみ、ここを処理
//      $view .= '"'.$res['img'].','.$res['lat'].','.$res['lon'].','.$res['input_date'].'"';
//    }else{
//      //ループ2回めからこちらを処理
//      $view .=',"'.$res['img'].','.$res['lat'].','.$res['lon'].','.$res['input_date'].'"';
//    }
//    $i++;
//  }
  //-----------------------------------------------------------------------------------
  $view = viewData($stmt);
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CheckInデモ</title>
<style>p{color:white}#map_area{position: relative;height:500px;padding:20px;}#myMap{width:95%;}#myMapimg{width:100%}</style>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="main">

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="#">CheckIn!画像一覧</a></div>
  </nav>
</header>
<!-- Head[End] -->


<!-- IMG_LIST[Start] -->
 <div class="container-fluid">
  <!-- Main[Start] -->
   <div id="map_area">
    <div id="myMap"></div>
  </div>
  <!-- Main[End] -->
 <div><input id="img_width_range" type="range" step="10" max="400" min="50" value="200"></div>
</div>
<!-- IMG_LIST[END] -->

<!-- Javascript -->
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0&amp;mkt=ja-jp"></script>
<script>
//★POINT
$("#img_width_range").on("change",function(){
  $("#myMap div a>img").css("width", $(this).val()+"px");
});

//******************************************************************
//MAP
//******************************************************************

//初期化
var G = {
    point: new Array(<?=$view?>), //★PHP変数から配列データを作成
    map: null, //mapオブジェクトを代入するための変数
    zoom: 14  //地図表示ZOOM設定値（数値が大きいほうがZOOM）
    ,latitude: 0,  //小数点3位 くらいの数値を上下させると地図の中心も上下する（感覚値として）
    longitude: 0 //小数点3位 くらいの数値を上下させると地図の中心も上下する（感覚値として）
};
//メイン処理
function LoadMap() {
    //====================================================
    //MAP初期化処理
    //====================================================
    G.map = new Microsoft.Maps.Map($('#myMap')[0], {
        credentials: "AsreAgbxC6migJYko4L2GNMiV62LNRLpypoLepymSRQFlPZTz2htb--QXADRAuMQ",
        mapTypeId: Microsoft.Maps.MapTypeId.road, //.aerial, .birdseye[英語表記になる]
        zoom: G.zoom,
        center: new Microsoft.Maps.Location(G.latitude, G.longitude)
    });
    console.log(G.latitude);
    console.log(G.longitude);
    //zoom: G.zoomは20が最大
    //====================================================
    //複数ピン処理
  　//====================================================
    var pin_count = G.point.length;
    for (var i=0; i<pin_count; i++) {
        //point配列をスプリット
        var locations = G.point[i];
        var gpoint = locations.split(",");

      //-------------------------------------------------
      //ピン設定（Default機能を使う方法）
      //-------------------------------------------------
        //登録日時の文字数を取得(cssのemで使用※半角なので÷２)
        var strl = (gpoint[3].length) / 2; //gpoint[3]=登録日時
        //pinオプションを設定
        var pin_options = {
           //プッシュピンが指し示す地点
              anchor: new Microsoft.Maps.Point(0, 0),
           //htmlを使用して画像を表示
              htmlContent:'<img src="'+gpoint[0]+'" width="100"><p style="width:'+strl+'em;">'+gpoint[3]+'</p>'
         };
            navigator.geolocation.watchPosition( //getCurrentPosition :or: watchPosition
  // 位置情報の取得に成功した時の処理
  function (position) {
    try {
       var lat = position.coords.latitude;  //緯度
       var lon = position.coords.longitude; //経度
      G.latitude = lat;
      G.longitude = lon;
        LoadMap();
      $("#lat").val(lat);
      $("#lon").val(lon);
      $("#status").html("緯度・経度、取得完了");
    } catch (error) {
      console.log("getGeolocation: " + error);
    }
  },
  // 位置情報の取得に失敗した場合の処理
  function (error) {
    var e = "";
    if (error.code == 1) { //1＝位置情報取得が許可されてない（ブラウザの設定）
      e = "位置情報が許可されてません";
    }
    if (error.code == 2) { //2＝現在地を特定できない
      e = "現在位置を特定できません";
    }
    if (error.code == 3) { //3＝位置情報を取得する前にタイムアウトになった場合
      e = "位置情報を取得する前にタイムアウトになりました";
    }
    $("#status").html("エラー：" + e);
  }
);
        //-------------------------------------------------
        //PINをMAPに設定する処理
        //-------------------------------------------------
        var pushpin = new Microsoft.Maps.Pushpin(G.map.getCenter(), pin_options);
        pushpin.setLocation(new Microsoft.Maps.Location(gpoint[1], gpoint[2]));
        G.map.entities.push(pushpin);
    }

}

//メイン処理開始
LoadMap();
</script>
</body>
</html>
