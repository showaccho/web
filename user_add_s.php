<?php include('page_header.php');
require_once('db_inc.php');

session_start();

 $u = $_POST['uid'];		//ユーザID
 $n = $_POST['uname'];		//ユーザ名
 $p = $_POST['upass'];		//パスワード
 $r = $_POST['urole'];		//ユーザ種別

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
 echo '<a href="user_add.php">ユーザ登録画面へ戻る</a>';
 include('page_footer.php');
?>