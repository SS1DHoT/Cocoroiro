<?php
session_start();
//ログイン済みの場合
if (isset($_SESSION['USER'])) {
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
$pdo = new pdo("mysql:host=mysql148.phy.lolipop.lan;dbname=LAA1210934-webapp","LAA1210934","12345");

header("Content-type: text/plain; charset=UTF-8");
$id = $_POST['id'];
$size = $_POST['size'];

if($id === 'ki'){
	// SQL文を作成(更新)
	$stmt = $pdo->prepare('UPDATE userdata SET kisize= :size WHERE user= :user');
	//変数を文字列に
	$stmt->bindValue(':size', $size, PDO::PARAM_STR);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();
}else if($id === 'do'){
	// SQL文を作成(更新)
	$stmt = $pdo->prepare('UPDATE userdata SET dosize= :size WHERE user= :user');
	//変数を文字列に
	$stmt->bindValue(':size', $size, PDO::PARAM_STR);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();
}else if($id === 'ai'){
	// SQL文を作成(更新)
	$stmt = $pdo->prepare('UPDATE userdata SET aisize= :size WHERE user= :user');
	//変数を文字列に
	$stmt->bindValue(':size', $size, PDO::PARAM_STR);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();
}else if($id === 'raku'){
	// SQL文を作成(更新)
	$stmt = $pdo->prepare('UPDATE userdata SET rakusize= :size WHERE user= :user');
	//変数を文字列に
	$stmt->bindValue(':size', $size, PDO::PARAM_STR);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();
}
}
