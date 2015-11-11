<?php
/**
*  view
*  XSS対策
*  @Param: $val(string)
*  @return: (string)
*/
function view($val){
  return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
}

/**
*  db_con
*  DB接続
*  @Param:  void
*  @return: (db_object)
*/
function db_con(){
  //プロパティ
  $dbname="fsq";
  $host='localhost';
  $id='root';
  $pw='';
  $pdo = new PDO('mysql:dbname=fsq;host=localhost', $id, '');
  $pdo->query('SET NAMES utf8');
  return $pdo;
}


/**
* viewData
* view.php：mapData作成
* @Param:  (db_object) $stmt
* @return: (string)
*/
function viewData($stmt){
  $view="";
  $i=0;
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($i==0){
      //ループ初回のみ、ここを処理
      $view .= '"'.$res['img'].','.$res['lat'].','.$res['lon'].','.$res['input_date'].'"';
    }else{
      //ループ2回めからこちらを処理
      $view .=',"'.$res['img'].','.$res['lat'].','.$res['lon'].','.$res['input_date'].'"';
    }
    $i++;
  }
  return $view;
}

/**
* FileUniqRenam
* ファイル名変更
*/
function fileUniqRename($file_name){
  $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得
  $uniq_name = date("YmdHis").session_id() . "." . $extension; //ユニークファイル名作成
  return $uniq_name;
}


?>
