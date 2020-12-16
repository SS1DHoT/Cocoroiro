<?php
$user = '';
session_start();
//ログイン済みの場合
if (isset($_SESSION['USER'])) {
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
$pdo = new pdo("mysql:host=localhost;dbname=webapp","root","");

header("Content-type: text/plain; charset=UTF-8");
$sender_color_id = $_POST['sel'];
$contact_color = $_POST['color'];

if($sender_color_id === 'ki'){
	// SQL文を作成(更新)
	$stmt = $pdo->prepare('UPDATE user SET ki= :contact_color WHERE name= :user');
	//変数を文字列に
	$stmt->bindValue(':contact_color', $contact_color, PDO::PARAM_STR);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();
}else if($sender_color_id == 'do'){
	// SQL文を作成(更新)
	$stmt = $pdo->prepare('UPDATE user SET do= :contact_color WHERE name= :user');
	//変数を文字列に
	$stmt->bindValue(':contact_color', $contact_color, PDO::PARAM_STR);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();
}else if($sender_color_id == 'ai'){
	// SQL文を作成(更新)
	$stmt = $pdo->prepare('UPDATE user SET ai= :contact_color WHERE name= :user');
	//変数を文字列に
	$stmt->bindValue(':contact_color', $contact_color, PDO::PARAM_STR);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();
}else if($sender_color_id == 'raku'){
	// SQL文を作成(更新)
	$stmt = $pdo->prepare('UPDATE user SET raku= :contact_color WHERE name= :user');
	//変数を文字列に
	$stmt->bindValue(':contact_color', $contact_color, PDO::PARAM_STR);
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();
}
}
