<?php
$env = "run"; // この行をコメントアウトすると、開発環境となる
if (isset($env) and $env==="run"){
  $conn = mysql_connect("localhost","k14jk138","joho2016");
  mysql_select_db("wpk14jk138", $conn);
}else{
 $conn = mysql_connect("localhost","root","");//MySQLサーバへ接続
  mysql_select_db("dbk2016", $conn);    // 使用するデータベースを指定
}
  mysql_query('set names utf8', $conn); //文字コードをutf8に設定（文字化け対策）
?>