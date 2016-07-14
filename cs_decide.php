<?php
session_start();
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続


if ( isset($_SESSION['urole']) and $_SESSION['urole']==2 ) {
	//教員としてログインしているなら
	$uid   = $_SESSION['uid'];   // 認証済みのユーザID
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
	echo "<h2>コース決定機能</h2>";
	echo $uname . '(' . $uid . ')';   // ログイン中のユーザ氏名とIDを表示
}else{
	echo "<h2>この機能を利用する権限がありません。</h2>";
}
$sql = "SELECT uid, uname, if(cid = 1,'応用コース','総合コース') as 希望コース,pr  FROM tb_entry NATURAL JOIN tb_student";
$rs = mysql_query($sql, $conn);

if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;

echo '<table border=1>';
echo '<tr><th>ユーザID</th><th>氏名</th><th>希望コース</th><th>自己PR</th></tr>';
while ($row) {
	echo '<tr>';
	echo '<td>' . $row['uid'] . '</td>';
	echo '<td>' . $row['uname']. '</td>';
	echo '<td>' . $row['希望コース']. '</td>';
	echo '<td>' . $row['pr']. '</td>';
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;
}
echo '</table>';
?>

<form action="cs_decide_s.php" method="post">
<input type="submit" value="コースを決定する">
</form>


<?php

echo '<a href="menu.php">戻る</a>';
include('page_footer.php');
?>
