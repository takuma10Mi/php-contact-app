<?php
session_start();
$link = mysqli_connect("localhost", "root", "root","memberapp");
// リクエストでPOSTメソッドではないのがきたらindex.phpへリダイレクト
if (!isset($_SESSION['confirm_data'])) {
  header('Location:index.php');
  exit();
}

$_POST = $_SESSION['confirm_data'];

if($_POST['submit']){
  $query = "INSERT INTO `users`(`name_first_full`,`name_last_full`,`name_first_cana`,`name_last_cana`,`phone`,`email`,`content`) VALUES 
  ('".mysqli_real_escape_string($link,$_POST['name_first_full'])."','".mysqli_real_escape_string($link,$_POST['name_last_full'])."','".mysqli_real_escape_string($link,$_POST['name_first_cana'])."','".mysqli_real_escape_string($link,$_POST['name_last_cana'])."','".mysqli_real_escape_string($link,$_POST['phone'])."','".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['content'])."')";
}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせ確認ページ</title>
<link rel="stylesheet" href="stylesheet/css/styles.css">

</head>
<body>
  <div class="input-form">
  <form  method="post"  action= "thanks.php">
    <p>名前（姓）<?php echo htmlspecialchars($_POST['name_first_full'],ENT_QUOTES);?></p>
    <p>名前（名）<?php echo htmlspecialchars($_POST['name_last_full'],ENT_QUOTES);?></p>
    <p>フリガナ（セイ）<?php echo htmlspecialchars($_POST['name_last_full'],ENT_QUOTES);?></p>
    <p>フリガナ（メイ）<?php echo htmlspecialchars($_POST['name_first_cana'],ENT_QUOTES);?></p>
    <p>電話番号<?php echo htmlspecialchars($_POST['name_last_cana'],ENT_QUOTES);?></p>
    <p>メールアドレス<?php echo htmlspecialchars($_POST['email'],ENT_QUOTES);?></p>
    <p>お問い合わせ内容<?php echo htmlspecialchars($_POST['content'],ENT_QUOTES);?></p>
    <input type="submit" value="登録する">
    <p><a href="./index.php">戻る</a></p>
  </form>
</body>