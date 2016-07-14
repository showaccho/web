<?php
session_start();
include('page_header.php');//画面出力開始
require_once('db_inc.php');



if ( isset($_SESSION['urole']) and $_SESSION['urole']==1 ) {
	//学生としてログインしているなら
	$uid   = $_SESSION['uid'];   // 認証済みのユーザID
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
	echo '<h2>コース希望登録</h2>';
	echo $uname . '(' . $uid . ')';   // ログイン中のユーザ氏名とIDを表示
}else { // その以外は
	die('エラー：この機能を利用する権限がありません');
}
$courses = array(
1=>'情報技術応用コース',
2=>'情報科学総合コース'
);
//変数の初期化
$cid = 1;         //希望のコースID;
$act = 'insert';  //初回登録?（insert: 初回登録; update: 再登録）;

// ログイン中のユーザ($uid)の希望状況を検索する
$sql = "SELECT * FROM tb_entry WHERE uid='{$uid}'";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;
if ($row) {
	$cid = $row['cid']; // 現在登録しているコースのID
	$act = 'update';    // すでに登録したため「再登録」とする
}

echo '<form action="cs_wish_save.php" method="post">';
echo '<input type="hidden" name="act" value="'.  $act .'">'; //非表示送信
foreach ($courses as $id => $name ){
	if ($id == $cid){  //登録状況を反映したラジオボタンを作成
		echo '<input type="radio" name="cid" value="'.$id.'" checked>'.$name;
	}else{
		echo '<input type="radio" name="cid" value="'.$id.'" >'.$name;
	}
}
?>
 <table>
 <tr><td>自己PR：</td><td><textarea name="PR"  cols="40"> </textarea></td></tr>
 </table>
 <?php
echo '<input type="submit" value="送信"/>';
echo '</form>';

echo '<a href=menu.php>メニュー</a>   ';
echo '<a href=login.php>ログアウト</a>   ';

include('page_footer.php');//画面出力終了
?>