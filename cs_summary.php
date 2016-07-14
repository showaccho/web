<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続
echo "<h2>コース希望状況</h2>";



echo '<table border=1>';
echo '<tr><th>応用コース希望者数</th><th>総合コース希望者数</th></tr>';

	$sql = "SELECT count(*) FROM tb_entry WHERE cid = 1";
	$rs = mysql_query($sql, $conn);
	$row = mysql_fetch_array($rs);
	echo '<tr>';
	echo '<td>' . $row['count(*)'] . '</td>';

	$sql = "SELECT count(*) FROM tb_entry WHERE cid = 2";
	$rs = mysql_query($sql, $conn);
	$row = mysql_fetch_array($rs);
	echo '<td>' . $row['count(*)'] . '</td>';
	echo '</tr>';

if (!$rs) {
	die ('エラー: ' . mysql_error());
}

echo '</table>';



echo '<a href="menu.php">戻る</a>';
include('page_footer.php');
?>