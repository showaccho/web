<?php
 session_start();
 unset($_SESSION);
 session_destroy();
 include('page_header.php');    //ページヘッドを出力
 if( isset($_SESSION['uid'] )){
 echo "<h4>ログアウトしました！</h4>";
 }else{
 	echo "<h4>ログインしてください！</h4>";
 }
 echo '<a href="index.php">トップページ</a>';
 include('page_footer.php');    //ページフッタを出力
?>