<?php include('page_header.php');
require_once('db_inc.php');

session_start();
if ( isset($_SESSION['urole']) and $_SESSION['urole']==9 ) {
	//管理者としてログインしているなら
	$uid = $_POST['uid'];			//ユーザID
	$sql = "SELECT uid,urole FROM tb_user WHERE uid='{$uid}'";
	$rs = mysql_query($sql, $conn);
	$row= mysql_fetch_array($rs);
	if($row['urole'] == 1){
	$sql = "UPDATE tb_user SET upass='p{$uid}' WHERE uid = '{$uid}'";
	$rs = mysql_query($sql, $conn);
	}else 
	if ($row){	
	$sql = "UPDATE tb_user SET upass='abcd' WHERE uid = '{$uid}'";
	$rs = mysql_query($sql, $conn);
	}else{
		echo '<h2>ユーザIDが正しくありません。</h2>';
	}
}else if($uid == null){
	echo '<h3>ユーザIDを入力してください。</h3>';
}
else
if (!$rs) {
	die('エラー: ' . mysql_error());
}else{ //エラーでない場合、登録完了した旨を表示
	echo '<h3>' .$uid. 'のパスワードを初期化しました！！！！！！！！！！！！！！！！！！！！！！！！！！！</h3>';
}
echo '<a href="user_passwd.php">ユーザ登録画面へ戻る</a>';
include('page_footer.php');
?>