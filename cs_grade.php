<?php
session_start();
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続


if ( isset($_SESSION['urole']) and $_SESSION['urole']==1 ) {
	//学生としてログインしているなら
	$uid   = $_SESSION['uid'];   // 認証済みのユーザID
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
	echo "<h2>成績一覧</h2>";
	echo $uname . '(' . $uid . ')';   // ログイン中のユーザ氏名とIDを表示
}

$sql="SELECT
    SUM(credit) AS 取得単位数
    FROM tb_study NATURAL JOIN tb_subject NATURAL JOIN tb_gp
    WHERE uid='$uid'AND point>=1";
$rs = mysql_query($sql, $conn);


if (!$rs) {
	die ('エラー: ' . mysql_error());
}

$row = mysql_fetch_array($rs) ;
$sql1="SELECT SUM(credit*point)/SUM(credit) AS GPA
	FROM tb_study NATURAL JOIN tb_subject NATURAL JOIN tb_gp
	WHERE uid='$uid'";
$rs1 = mysql_query($sql1, $conn);


if (!$rs1) {
	die ('エラー: ' . mysql_error());
}

$row1 = mysql_fetch_array($rs1) ;
echo '<table border=1>';
echo '<tr><th>取得単位数</th><th>GPA</th></tr>';
while ($row) {
	echo '<tr>';
	echo '<td>' . $row['取得単位数'] . '</td>';
	echo '<td>' . $row1['GPA']. '</td>';
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;
}
echo '</table>';

echo '<a href="menu.php">戻る</a>';

include('page_footer.php');  //画面出力終了
?>