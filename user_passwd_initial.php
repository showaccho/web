<?php include('page_header.php');
require_once('db_inc.php');


echo "<h2>パスワード初期化</h2>";
echo "<h3>パスワードを初期化させるユーザIDを入力してください。</h3>";

?>

<form action="user_passwd_initial_save.php" method="post">
<table>

<tr><td>ユーザID：</td><td><input type="text" name="uid"></td></tr>
</table>
<input type="submit" value="初期化">

</form>


<?php

echo '<a href="user_passwd.php">ユーザ登録画面へ戻る</a>';
include('page_footer.php');
?>