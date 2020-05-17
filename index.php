<?php

  $link = mysqli_connect("localhost", "root", "root","memberapp");
  // サーバー名・データベースのユーザー名・パスワード・DB名
  if(mysqli_connect_error()){
      die("データーベースへの接続に失敗しました。");
  }
  session_start();
  if ( !empty($_POST) && empty($_SESSION['confirm_data'])){
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
      $error_message['email']= "<p>メールアドレス入力してください。</p>";
      
    }elseif($email !== $email2){
      
      $error_message['email']= "<p>メールアドレスが一致していません。</p>";
    }elseif(!preg_match($email_vali,$email)){
      
      $error_message['email']= "<p>使える文字はアルファベット大文字小文字 (a~z, A~Z) 、数字 (0~9)、記号 (. _ -)です。</p>";
    }
    elseif( mb_strlen($email) > 200 ){
      $error_message['email'] = "<p>Eメールは200文字以内にしてください</p>";
    }

    // 名前(姓)のチェック
    if( empty($name_first_full)){
      
      $error_message['name_first_full']= "<p>名前（姓）を入力してください。</p>" ;
      
    }
    elseif( mb_strlen($name_first_full) > 100 ){
      $error_message['name_first_full']= "<p>名前(姓)は100文字以内にしてください</p>" ;
    }


    // 名前(名)のチェック
    if( $name_last_full == ''){
      
      $error_message['name_last_full'] = "<p>名前（名）を入力してください。</p>";
      
    } 
    elseif( mb_strlen($name_last_full) > 100 ){
      $error_message['name_last_full']= "<p>名前(名)は100文字以内にしてください</p>" ;
    }
    
    // フリガナ(セイ)
    if($name_first_cana == ''){
      
      $error_message['name_first_cana'] = "<p>フリガナ（セイ）を入力してください。</p>";
      
    }
    elseif( mb_strlen($name_first_cana) > 100 ){
      $error_message['name_first_cana']= "<p>フリガナ（セイ）は100文字以内にしてください</p>" ;
    }
    elseif(preg_match("/[^ァ-ヶー]/u",$name_first_cana)){
      
      $error_message['name_first_cana']= "<p>フリガナ（セイ）をフリガナで入力してください。</p>";
    }

    // //フリガナ(メイ)
    if( $name_last_cana== ''){
      
      $error_message['name_last_cana']= "<p>フリガナ（メイ）を入力してください。</p>";
    }
    
    elseif(preg_match("/[^ァ-ヶー]/u",$name_last_cana)){
      
      $error_message['name_last_cana']= "<p>フリガナ（メイ）フリガナで入力してください。</p>";
    }
    elseif( $name_first_cana== ''){
      
      $error_message['name_first_cana']= "<p>フリガナ（メイ）を入力してください。</p>";
    }

    // 電話番号チェック
    if(empty($phone)){
      $error_message['phone'] =  "<p>電話番号を入力してください。</p>";
    }
    elseif(preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/', $phone)){
      
      $error_message['phone'] =  "<p>電話番号はハイフン抜き半角数字9~11桁で入力してください。</p>";

    }
    if (empty($error_message)) {
      $_SESSION['confirm_data'] = $_POST;
      
      header('Location:./confirm.php');
      
      exit();
  
    } 
  }
  elseif (!empty($_SESSION['confirm_data'])) {
  $_POST = $_SESSION['confirm_data'];
  }
  session_destroy();

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせフォーム</title>
<link rel="stylesheet" href="stylesheet/css/styles.css">

</head>
<body>

  <div class="input-form">
  <form  method="post" name= "users" action="index.php" >
    <!-- valueにはエラー時に値を保持するための処理を書いている -->
    <ul>
      <li>
      <label for="">名前（姓）</label>
      <input type="text" name="name_first_full" placeholder="（例）山田" value="<?php echo isset($_POST['name_first_full']) ? htmlspecialchars($_POST['name_first_full'],ENT_QUOTES) : ''; ?>">
      <span class="color"> <?php echo isset($error_message['name_first_full']) ? $error_message['name_first_full'] : ''; ?></span>
      </li>
      <li>
      <label for="">名前（名）</label>
      <input type="text" name="name_last_full" placeholder="（例）太郎" value="<?php echo isset($_POST['name_last_full']) ? htmlspecialchars($_POST['name_last_full'],ENT_QUOTES) : ''; ?>">
      <span class="color"> <?php echo isset($error_message['name_last_full']) ? $error_message['name_last_full'] : ''; ?></span>
      </li>
      <li>
      <label for="">フリガナ（セイ）</label>
      <input type="text" name="name_first_cana" placeholder="（例）ヤマダ" value="<?php echo isset($_POST['name_first_cana']) ? htmlspecialchars($_POST['name_first_cana'],ENT_QUOTES) : ''; ?>">
      <span class="color"> <?php echo isset($error_message['name_first_cana']) ? $error_message['name_first_cana'] : ''; ?></span>
      </li>
      <li>
      <label for="">フリガナ（メイ）</label>
      <input type="text" name="name_last_cana" placeholder="（例）タロウ" value="<?php echo isset($_POST['name_last_cana']) ? htmlspecialchars($_POST['name_last_cana'],ENT_QUOTES) : ''; ?>">
      <span class="color"> <?php echo isset($error_message['name_last_cana']) ? $error_message['name_last_cana'] : ''; ?></span>
      </li>
      <li>
      <label for="">電話番号</label>
      <input type="text" name="phone" placeholder="（例）09012345678" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone'],ENT_QUOTES) : ''; ?>">
      <span class="color"> <?php echo isset($error_message['phone']) ? $error_message['phone'] : ''; ?></span>
      </li>
      <li>
      <label for="">メールアドレス</label>
      <input type="text" name="email" placeholder="(例)example@.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'],ENT_QUOTES) : ''; ?>">
      <span class="color"> <?php echo isset($error_message['email']) ? $error_message['email'] : ''; ?></span>
      </li>
      <li>
      <label for="">メールアドレス（確認）</label>
      <input type="text" name="email2" placeholder="(例)example.com" value="<?php echo isset($_POST['email2']) ? htmlspecialchars($_POST['email2'],ENT_QUOTES) : ''; ?>">
      <span class="color"> <?php echo isset($error_message['email2']) ? $error_message['email2'] : ''; ?></span>
      </li>
      <li>
      <label for="">お問い合わせ内容</label>
      <textarea name="content" placeholder="お問い合わせ内容を入力してください。" rows="4" cols="40" value="<?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content'],ENT_QUOTES) : ''; ?>"></textarea>
      <span class="color"> <?php echo isset($error_message['content']) ? $error_message['content'] : ''; ?></span>
      </li>
      <li>
      <input type="submit" name="btn_submit" value="確認する">
      </li>
    </ul>
  </form>
</body>
