<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続
echo "<h2>コース希望一覧</h2>";

echo '<form action="cs_list.php" method="post">';
$users = array(1=>'応用コース',2=>'総合コース');
foreach ($users as $id=>$name){
	echo '<input type="radio" name="cid" value="' . $id . '">' . $name;
}
echo '<input type="submit" value="検索"><input type="reset" value="取消">';
echo '</form>';

if(isset($_POST{'cid'})){
	$cid = $_POST{'cid'};
	$where = "WHERE cid = '{$cid}' "  ;
	$sql = "SELECT * FROM tb_entry natural join tb_user natural join tb_course " . $where;
	$rs = mysql_query($sql, $conn);

}
else{

	$where = "WHERE 1";
	$sql = "SELECT * FROM tb_entry natural join tb_user natural join  tb_course " . $where;
	$rs = mysql_query($sql, $conn);
}

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
	echo '<td>' . $row['cname'] . '</td>';
	echo '<td>' . $row['pr'] . '</td>';

	$cids = array( 1=>'応用コース', 2=>'総合コース');
	$r= $row['cid'];       // 希望コースのコード（数字）を$rに代入
	$cid = $cids [ $r ];   // 希望コースの名前（配列要素）を$cidに代入
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;

}
echo '</table>';

echo '<a href="menu.php">戻る</a>';

include('page_footer.php');  //画面出力終了
?>