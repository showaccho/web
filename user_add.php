<?php
session_start();
include('page_header.php');
require_once('db_inc.php');


if ( isset($_SESSION['urole']) and $_SESSION['urole']==9 ) {
 //管理者としてログインしているなら
  $uid   = $_SESSION['uid'];   // 認証済みのユーザID
  $uname = $_SESSION['uname']; // 認証済みのユーザ名
  echo '<h2>アカウント登録</h2>';
  echo $uname . '(' . $uid . ')';   // ログイン中のユーザ氏名とIDを表示
}else { // その以外はcc
  die('エラー：この機能を利用する権限がありません');
}
?>

<form action="user_add_s.php" method="post">
<table>
<tr><td>ユーザID：</td><td><input type="text" name="uid"></td></tr>
<tr><td>ユーザ名：</td><td><input type="text" name="uname"></td></tr>
<tr><td>パスワード：</td><td><input type="text" name="upass"></td></tr>
<tr><td>ユーザ種別：</td><td><input type="text" name="urole"></td><td>(1:学生 2:教員 9:管理者)</td></tr>
</table>
<input type="submit" value="送信"><input type="reset" value="取消">
</form>


<?php
  echo '<a href="menu.php">メニュー画面へ戻る</a>';

 include('page_footer.php'); ?>