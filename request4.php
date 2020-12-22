<?php
session_start();
//ログイン済みの場合
if (isset($_SESSION['USER'])) {
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
$pdo = new pdo("mysql:host=localhost;dbname=webapp","root","");

header("Content-type: text/plain; charset=UTF-8");
$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
	
$stmt = $pdo->prepare('SELECT * FROM emodata WHERE name=:user AND year=:year AND month=:month');
//変数を文字列に
$stmt->bindValue(':user', $user, PDO::PARAM_STR);
$stmt->bindValue(':year', $year, PDO::PARAM_STR);
$stmt->bindValue(':month', $month, PDO::PARAM_STR);
// クエリ実行
$stmt->execute();

$all = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($all);

}
