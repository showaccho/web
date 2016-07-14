<?php
session_start();
include('page_header.php');
require_once ('db_inc.php');  // データベース接続
echo "<h2>コース決定</h2>";

if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=2 ) {
	// 学生としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else {
	$sql12= "TRUNCATE TABLE  tb_decision ";
	$rs12 = mysql_query($sql12, $conn); //SQL文を実行
	if (!$rs12){
		die ('エラー: ' . mysql_error());
	}
	$sql = "SELECT uid,cid FROM tb_entry NATURAL JOIN tb_student WHERE cid";
	$rs = mysql_query($sql, $conn); //SQL文を実行
	if (!$rs){
		die ('エラー: ' . mysql_error());
	}
	$row1 = mysql_fetch_array($rs) ;
	$uid=$row1['uid'];
	$cid=$row1['cid'];
	$sql10 = "SELECT * FROM tb_decision";
	$rs10 = mysql_query($sql10, $conn);
	if (!$rs10){die ('エラー: ' . mysql_error());}
	$row10 = mysql_fetch_array($rs10) ;
	$act = 1;
	if($uid==$row10['uid']){
		$act = 2;
	}
	while ($row1) {
		if($cid == 2){
			$sql = "SELECT
    		SUM(credit) AS 取得単位数
    		FROM tb_study NATURAL JOIN tb_subject NATURAL JOIN tb_gp
    		WHERE uid='$uid'AND point>=1
    		UNION
    		SELECT SUM(credit*point)/SUM(credit) AS GPA
			FROM tb_study NATURAL JOIN tb_subject NATURAL JOIN tb_gp
			WHERE uid='$uid'";

			$rs2 = mysql_query($sql, $conn);
			$row2 = mysql_fetch_array($rs2);
			if (!$rs2) {
				die ('エラー: ' . mysql_error());
			}
			if($act==1){
				if(isset($row['uid'])){
					$uid2 = $row2['uid'];
					$sql = "INSERT INTO tb_decision (uid, cid, cname) VALUES('$uid2', 2, '総合コース')";
					$rs2 = mysql_query($sql, $conn);
					if (!$rs2) {
						die ('エラー: ' . mysql_error());
					}
				}else{
					$sql = "INSERT INTO tb_decision (uid, cid, cname) VALUES('$uid', 1, '技術応用コース')";
					$rs2 = mysql_query($sql, $conn);
					if (!$rs2) {
						die ('エラー: ' . mysql_error());
					}
				}
			}else{
				if(isset($row['uid'])){
					$uid2 = $row2['uid'];
					$sql = "UPDATE tb_decision SET cid=2, cname= '総合コース' WHERE uid='$uid2'";
					$rs2 = mysql_query($sql, $conn);
					if (!$rs2) {
						die ('エラー: ' . mysql_error());
					}
				}else{
					$sql = "UPDATE tb_decision SET cid=1, cname= '技術応用コース'WHERE uid='$uid'";
					$rs2 = mysql_query($sql, $conn);
					if (!$rs2) {
						die ('エラー: ' . mysql_error());
					}
				}
			}
		}else{
			if($act==1){
				$sql = "INSERT INTO tb_decision (uid, cid, cname) VALUES('$uid', 1, '技術応用コース')";
				$rs3 = mysql_query($sql, $conn);
				if (!$rs3) {
					die ('エラー: ' . mysql_error());
				}
			}else{
				$sql = "UPDATE tb_decision SET cid=1, cname= '技術応用コース'WHERE uid='$uid'";
				$rs3 = mysql_query($sql, $conn);
				if (!$rs3) {
					die ('エラー: ' . mysql_error());
				}
			}
		}
		//mysql_query($sql, $conn);
		$row1 = mysql_fetch_array($rs) ;
		$uid=$row1['uid'];
		$cid=$row1['cid'];
	}
	echo 'コース決定完了しました。';
	echo '<a href="menu.php">戻る</a>';
}
include('page_footer.php');
?>