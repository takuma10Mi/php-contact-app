<?php
  if($_SERVER["REQUEST_METHOD"] != "POST"){
  header('Location: index.php'); 
  exit;
  }
  echo "お問い合わせありがとうございました。"."<br>";
  $link = mysqli_connect("localhost", "root", "root","memberapp");
  if( $link->connect_errno ) {
    echo $link->connect_errno . ' : ' . $link->connect_error;
  }
  // 文字コードを設定
  $link->set_charset('utf8');
  // データを取得最新のidだけ
  $sql = 'SELECT * FROM users WHERE id = (SELECT MAX(id) FROM users)' ;
  $result = $link->query($sql);
  
  if( $result ) {
    // fetch_all結果データを全件まとめて配列で取得
    var_dump($result->fetch_all());
  }
  // データベースとの接続を解除
  $link->close();
?>