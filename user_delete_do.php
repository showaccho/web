<?php
include('page_header.php');
if (isset($_GET['uid'])){
  $uid = $_GET['uid'];
  $sql = "DELETE FROM tb_user WHERE uid='{$uid}'";
  include ('db_inc.php');
  $rs = mysql_query($sql, $conn);
  echo '<h2>' . $uid . 'を削除しました</h2>';
  echo '<a href="user_list.php">戻る</a>';
}else{
  echo '<h2>削除するユーザIDが与えられていません</h2>';
  echo '<a href="user_list.php">戻る</a>';
}
include('page_footer.php');
?>