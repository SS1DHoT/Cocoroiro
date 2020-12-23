<?php
session_start();
//ログイン済みの場合
if (isset($_SESSION['USER'])) {
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
$pdo = new pdo("mysql:host=localhost;dbname=webapp","root","");

header("Content-type: text/plain; charset=UTF-8");
$day = $_POST['day'];
$cate = $_POST['cate'];
$age = $_POST['age'];
$main = $_POST['main'];
	
$stmt = $pdo->prepare('INSERT INTO tubuyaki VALUE(:user,:cate,:day,:age,:main)');
//変数を文字列に
$stmt->bindValue(':user', $user, PDO::PARAM_STR);
$stmt->bindValue(':cate', $cate, PDO::PARAM_STR);
$stmt->bindValue(':day', $day, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':main', $main, PDO::PARAM_STR);
// クエリ実行
$stmt->execute();

$all = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($all);

}
