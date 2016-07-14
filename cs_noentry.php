<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続
echo "<h2>未提出者一覧</h2>";

	$sql = "SELECT uid, uname FROM tb_student WHERE uid NOT IN(SELECT uid FROM tb_entry)";
	$rs = mysql_query($sql, $conn);


if (!$rs) {
	die ('エラー: ' . mysql_error());
}

$row = mysql_fetch_array($rs) ;
echo '<table border=1>';
echo '<tr><th>ユーザID</th><th>氏名</th></tr>';
while ($row) {
	echo '<tr>';
	echo '<td>' . $row['uid'] . '</td>';
	echo '<td>' . $row['uname']. '</td>';
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;
}
echo '</table>';

echo '<a href="menu.php">戻る</a>';

include('page_footer.php');  //画面出力終了
?>