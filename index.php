<?php
  // エスケープ処理ｈという関数に設定してコードを短くした。
  function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
  }
  $link = mysqli_connect("localhost", "root", "root","memberapp");
  // サーバー名・データベースのユーザー名・パスワード・DB名
  if(mysqli_connect_error()){
      die("データーベースへの接続に失敗しました。");
  }
  // sessionを使うためのメモ
  session_start();
  // issetは変数に値が入っているか確かめる関数。なので今回はbtn_submitが押されたときの処理
  if ( isset ($_POST["btn_submit"] ) ){
    // バリデーションのための変数
    $email=$_POST['email'];
    $email2=$_POST['email2'];
    $name_first_full=$_POST['name_first_full'];
    $name_last_full=$_POST['name_last_full'];
    $name_first_cana=$_POST['name_first_cana'];
    $name_last_cana=$_POST['name_last_cana'];
    $phone=$_POST['phone'];
    $content=$_POST['content'];
    $email_vali="/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
    // メールアドレスのチェック
    if(empty($email)|| empty($email2)){
      
      echo "<p>メールアドレス入力してください。</p>";
      $error_mail = true;
    }elseif($email !== $email2){
      
        echo "<p>メールアドレスが一致していません。</p>";
        $error_mail = true;
    }elseif(!preg_match($email_vali,$email)){
      
      echo "<p>使える文字はアルファベット大文字小文字 (a~z, A~Z) 、数字 (0~9)、記号 (. _ -)です。</p>";
      $error_mail = true;
    }else{
      "正しいメールアドレスです。";
      $error_mail = false;
    }

    // 名前の入力チェック
    if( empty($name_first_full)){
      
      echo "<p>名前（姓）を入力してください。</p>" ;
      $error_name =true;
    } 
    elseif( $name_last_full == ''){
      
      echo "<p>名前（名）を入力してください。</p>";
      $error_name =true;
    } elseif($name_first_cana == ''){
      
      echo "<p>フリガナ（セイ）を入力してください。</p>";
      $error_name =true;
    }
    elseif( $name_last_cana== ''){
      
      echo "<p>フリガナ（メイ）を入力してください。</p>";
      $error_name =true;
    }
    elseif(preg_match("/[^ァ-ヶー]/u",$name_first_cana)){
      
      echo "<p>フリガナ（セイ）をフリガナで入力してください。</p>";
      $error_name =true;
    }
    elseif(preg_match("/[^ァ-ヶー]/u",$name_last_cana)){
      
      echo "<p>フリガナ（メイ）フリガナで入力してください。</p>";
      $error_name =true;
    }
    elseif( $name_first_cana== ''){
      
      echo "<p>フリガナ（メイ）を入力してください。</p>";
    }else{
      echo "名前を入力○";
      $error_name =false;
    }

    // 電話番号チェック
    if(empty($phone)){
      echo "<p>電話番号を入力してください。</p>";
      $error_phone =true;
    }
    elseif(preg_match("/^[0-9]{9-11}$/",$phone)){
      
      echo "<p>電話番号はハイフン抜き半角数字9~11桁で入力してください。</p>";
      $error_phone =true;
    }
    else{
      echo "電話番号○";
      $error_phone =false;
      
    }
    if($error_mail == false && $error_name == false && $error_phone== false){
      "";
    }else{
      // header('Location: index.php');
    }
  } 

  
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせフォーム</title>
<link rel="stylesheet" href="stylesheet/css/styles.css">

</head>
<body>

  <div class="input-form">
  <form  method="post" name= "users" >
    <!-- valueにはエラー時に値を保持するための処理を書いている -->
    <ul>
      <li>
      <label for="">名前（姓）</label>
      <input type="text" name="name_first_full" placeholder="（例）山田" value="<?php if( !empty($name_first_full) ){ echo h($name_first_full); } ?>">
      </li>
      <li>
      <label for="">名前（名）</label>
      <input type="text" name="name_last_full" placeholder="（例）太郎" value="<?php if( !empty($name_last_full) ){ echo h($name_last_full); } ?>">
      </li>
      <li>
      <label for="">フリガナ（セイ）</label>
      <input type="text" name="name_first_cana" placeholder="（例）ヤマダ" value="<?php if( !empty($name_first_cana) ){ echo h($name_first_cana); } ?>">
      </li>
      <li>
      <label for="">フリガナ（メイ）</label>
      <input type="text" name="name_last_cana" placeholder="（例）タロウ" value="<?php if( !empty($name_last_cana) ){ echo h($name_last_cana); } ?>">
      </li>
      <li>
      <label for="">電話番号</label>
      <input type="text" name="phone" placeholder="（例）09012345678" value="<?php if( !empty($phone) ){ echo h($phone); } ?>">
      </li>
      <li>
      <label for="">メールアドレス</label>
      <input type="text" name="email" placeholder="(例)example@.com" value="<?php if( !empty($email) ){ echo h($email); } ?>">
      </li>
      <li>
      <label for="">メールアドレス（確認）</label>
      <input type="text" name="email2" placeholder="(例)example.com" value="<?php if( !empty($email2) ){ echo h($email2); } ?>">
      </li>
      <li>
      <label for="">お問い合わせ内容</label>
      <textarea name="content" placeholder="お問い合わせ内容を入力してください。" rows="4" cols="40" value="<?php if( !empty($content) ){ echo h($content); } ?>"></textarea>
      </li>
      <li>
      <input type="submit" name="btn_submit" value="登録する">
      </li>
    </ul>
  </form>
</body>
