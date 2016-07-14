<?php
session_start();
include('page_header.php');
require_once('db_inc.php');



 $u = $_POST['uid'];
 $n = $_POST['uname'];
 $p = $_POST['upass'];
 $r = $_POST['urole'];

$sql = "INSERT INTO tb_user VALUES ('$u' , '$n' , '$p' , '$r')";

$rs = mysql_query($sql, $conn);


if (!$rs) {
    die('エラー: ' . mysql_error());
}else{ //エラーでない場合、登録完了した旨を表示
    echo '<h2>ユーザID:'. $u . '</h2>';
    echo '<h2>ユーザ名:'. $n. '</h2>';
    echo '<h2>パスワード:'. $p . '</h2>';
    echo '<h2>ユーザ種別:'. $r . '</h2>';
	echo '<h2>として登録しました！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！</h2>';
 }

 include('page_footer.php');
?>