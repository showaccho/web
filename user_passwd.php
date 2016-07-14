<?php
session_start();
include('page_header.php');
require_once('db_inc.php');  //データベース接続


if ( isset($_SESSION['urole']) and $_SESSION['urole']==9 ) {
 //管理者としてログインしているなら
  $uid   = $_SESSION['uid'];   // 認証済みのユーザID
  $uname = $_SESSION['uname']; // 認証済みのユーザ名
  echo "<h2>パスワード変更</h2>";
  echo $uname . '(' . $uid . ')';   // ログイン中のユーザ氏名とIDを表示
}else { // その以外はcc
  die('エラー：この機能を利用する権限がありません');
}
?>

<form action="user_passwd_change.php" method="post">
<table>
<tr><td>ユーザID：</td><td><input type="text" name="uid"></td></tr>
<tr><td>現在のパスワード：</td><td><input type="text" name="upass"></td></tr>
<tr><td>変更後のパスワード：</td><td><input type="text" name="npass"></td></tr>

</table>
<input type="submit" value="送信"><input type="reset" value="取消">
</form>




<?php

echo '<a href="menu.php">メニュー画面へ戻る</a>';
include('page_footer.php');
?>