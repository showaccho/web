<?php
session_start();
include('page_header.php');
require_once('db_inc.php');


if ( isset($_SESSION['urole']) and $_SESSION['urole']==9 ) {
	//管理者としてログインしているなら
	$uid = $_POST['uid'];			//ユーザID
	$upass = $_POST['upass'];		//現在のパスワード
	$npass = $_POST['npass'];		//変更後のパスワード
	$sql = "SELECT upass FROM tb_user WHERE uid='{$uid}'";
	$rs = mysql_query($sql, $conn);
	$row= mysql_fetch_array($rs);
	if($row['upass'] == $upass){
	$sql = "UPDATE tb_user SET upass='{$npass}' WHERE uid = '{$uid}'";
	$rs = mysql_query($sql, $conn);
	}else{
		echo '<h2>ユーザIDとパスワードが正しくありません。</h2>';
	}
}else{
	echo '<h2>エラー</h2>';
}

if (!$rs) {
	die('エラー: ' . mysql_error());
}else{ //エラーでない場合、登録完了した旨を表示
	echo '<h2>' .$uid. 'のパスワードを変更しました！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！</h2>';
}
echo '<a href="user_passwd.php">ユーザ登録画面へ戻る</a>';
include('page_footer.php');
?>