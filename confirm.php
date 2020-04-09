<?php
$link = mysqli_connect("localhost", "root", "root","memberapp");
// リクエストでPOSTメソッドではないのがきたらindex.phpへリダイレクト
var_dump($_POST);
if($_SERVER["REQUEST_METHOD"] != "POST"){
    header('Location: index.php'); 
    exit;
}
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
if($_POST['content']){
  echo "sendボタンが押されました。";
  $query = "INSERT INTO `users`(`name_first_full`,`name_last_full`,`name_first_cana`,`name_last_cana`,`phone`,`email`,`content`) VALUES 
  ('".mysqli_real_escape_string($link,$_POST['name_first_full'])."','".mysqli_real_escape_string($link,$_POST['name_last_full'])."','".mysqli_real_escape_string($link,$_POST['name_first_cana'])."','".mysqli_real_escape_string($link,$_POST['name_last_cana'])."','".mysqli_real_escape_string($link,$_POST['phone'])."','".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['content'])."')";
  if(mysqli_query($link,$query)){
    echo "登録されました。";
  } else {
    echo "登録に失敗しました。";
  }
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
    <p>名前（姓）<?php echo $_POST['name_first_full']; ?></p>
    <input type="hidden" name="name_first_full" value=""<?php echo $_POST['name_first_full']; ?>>
    <p>名前（名）<?php echo $_POST['name_last_full']; ?></p>
    <input type="hidden" name="name_last_full" value=""<?php echo $_POST['name_last_full']; ?>>
    <p>フリガナ（セイ）<?php echo $_POST['name_first_cana']; ?></p>
    <input type="hidden" name="name_first_cana" value=""<?php echo $_POST['name_first_cana']; ?>>
    <p>フリガナ（メイ）<?php echo $_POST['name_last_cana']; ?></p>
    <input type="hidden" name="name_last_cana" value=""<?php echo $_POST['name_last_cana']; ?>>
    <p>電話番号<?php echo $_POST['phone']; ?></p>
    <input type="hidden" name="phone" value=""<?php echo $_POST['phone']; ?>>
    <p>メールアドレス<?php echo $_POST['email']; ?></p>
    <input type="hidden" name="email" value=""<?php echo $_POST['email']; ?>>
    <p>お問い合わせ内容<?php echo $_POST['content']; ?></p>
    <input type="hidden" name="content" value=""<?php echo $_POST['content']; ?>>
    <input type="submit" value="登録する">
  </form>
</body>