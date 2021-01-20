<?php
session_start();
//ログイン済みの場合
if (isset($_SESSION['USER'])) {
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
$pdo = new pdo("mysql:host=mysql148.phy.lolipop.lan;dbname=LAA1210934-webapp","LAA1210934","12345");

header("Content-type: text/plain; charset=UTF-8");
$cate = $_POST['cate'];

	
$stmt = $pdo->prepare('SELECT * FROM tubuyaki WHERE category=:cate');
//変数を文字列に
$stmt->bindValue(':cate', $cate, PDO::PARAM_STR);
// クエリ実行
$stmt->execute();

$all = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($all);

}
