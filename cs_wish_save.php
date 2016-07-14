<?php

session_start();
include('page_header.php');
require_once ('db_inc.php');  // データベース接続

if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=1 ) {
	// 学生としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else {
	$uid  = $_SESSION['uid']; //ログイン中のユーザのuidを$uidに代入
	if (isset($_POST['cid'])){
		$cid  = $_POST['cid'] ;//送信されたcidを受け取り、$cidに代入
		$act  = $_POST['act'] ;//送信されたactを受け取り、$actに代入
		$PR = $_POST['PR'];
		if ($act == 'insert'){//新規登録の場合
			$sql = "INSERT INTO tb_entry(uid,cid,pr) VALUES ('$uid','$cid','$PR')";
		}else{//再登録の場合
			$sql = "UPDATE tb_entry SET cid='.$cid.',pr='$PR' WHERE uid='$uid'";
		}
		$rs = mysql_query($sql, $conn); //SQL文を実行
		if (!$rs){
			echo "<h2>登録が失敗しました</h2>";
			echo mysql_error();
		}else{
			if ($cid==1){
				echo "<h2>情報技術応用コースに登録しました</h2>";
			}else {
				echo "<h2>情報科学総合コースに登録しました</h2>";
			}
		}
		echo '<a href="menu.php">戻る</a>';
	}else{ //エラーを表示
		echo '<h2>エラー：希望コースが選択されていません</h2>';
		echo '<p><a href="cs_wish.php">戻る</a>';
	}
}

include('page_footer.php');
?>