<?php
session_start();
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続


if ( isset($_SESSION['urole']) and $_SESSION['urole']==1 ) {
	//学生としてログインしているなら
	$uid   = $_SESSION['uid'];   // 認証済みのユーザID
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
	echo "<h2>コース分け結果</h2>";
	echo $uname . '(' . $uid . ')';   // ログイン中のユーザ氏名とIDを表示
}

	$sql="SELECT uid,cname
	FROM tb_decision
	WHERE 1;";
	$rs = mysql_query($sql, $conn);


if (!$rs) {
	die ('エラー: ' . mysql_error());
}

$row = mysql_fetch_array($rs) ;
echo '<table border=1>';
echo '<tr><th>学籍番号</th><th>コース名</th></tr>';
while ($row) {
	echo '<tr>';
	echo '<td>' . $row['uid'] . '</td>';
	echo '<td>' . $row['cname']. '</td>';
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;
}
echo '</table>';

echo '<a href="menu.php">戻る</a>';

include('page_footer.php');  //画面出力終了
?>