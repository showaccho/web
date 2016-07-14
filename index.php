<?php
session_start();
include('page_header.php');    //ページヘッドを出力
if (isset($_SESSION['uid'])){
	echo '<h2>ようこそ！'. $_SESSION['uname'] . '</h2>';
	echo '<h2>ユーザID：'. $_SESSION['uid'] . '</h2>';
	echo '<h2>種別(1: 学生、2:教員、9:管理者)：'. $_SESSION['urole'] . '</h2>';
	echo '<h2>コース分け希望調査システム</h2>';

	echo '<a href=menu.php>メニュー</a>   ';
	echo '<a href="logout.php">ログアウト</a>';
}else{
	echo '<h4>このページは、ログインしないと利用できません！</h4>';
	echo '<a href="login.php">ログイン</a>';
}
include('page_footer.php');    //ページフッタを出力
?>