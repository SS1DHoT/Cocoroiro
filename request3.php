<?php
session_start();
//ログイン済みの場合
if (isset($_SESSION['USER'])) {
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
$pdo = new pdo("mysql:host=mysql148.phy.lolipop.lan;dbname=LAA1210934-webapp","LAA1210934","12345");

header("Content-type: text/plain; charset=UTF-8");
$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];

$ps = $pdo->query("SELECT * FROM emodata WHERE name='$user' AND year='$year' AND month='$month' AND day='$day'");
$r = $ps->fetch(PDO::FETCH_ASSOC);
echo json_encode($r);

//$stmt = $pdo->prepare('SELECT * FROM emodata WHERE name=:user AND year=:year AND month=:month AND day=:day');
//	//変数を文字列に
//	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
//	$stmt->bindValue(':year', $year, PDO::PARAM_STR);
//	$stmt->bindValue(':month', $month, PDO::PARAM_STR);
//	$stmt->bindValue(':day', $day, PDO::PARAM_STR);
//	// クエリ実行
//	$ps=$stmt->execute();
//	$r = $ps->fetch(PDO::FETCH_ASSOC);
//	echo($stmt);


}
