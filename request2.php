<?php
session_start();
//ログイン済みの場合
if (isset($_SESSION['USER'])) {
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
$pdo = new pdo("mysql:host=localhost;dbname=webapp","root","");

header("Content-type: text/plain; charset=UTF-8");
$yesr = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
$ki = $_POST['ki'];
$do = $_POST['do'];
$ai = $_POST['ai'];
$raku = $_POST['raku'];

$stmt = $pdo->prepare('INSERT INTO emodata VALUE(:user,:year,:month,:day,:ki,:do,:ai,:raku)');
	//変数を文字列に
	$stmt->bindValue(':user', $user, PDO::PARAM_STR);
	$stmt->bindValue(':year', $year, PDO::PARAM_STR);
	$stmt->bindValue(':month', $month, PDO::PARAM_STR);
	$stmt->bindValue(':day', $day, PDO::PARAM_STR);
	$stmt->bindValue(':ki', $ki, PDO::PARAM_STR);
	$stmt->bindValue(':do', $do, PDO::PARAM_STR);
	$stmt->bindValue(':ai', $ai, PDO::PARAM_STR);
	$stmt->bindValue(':raku', $raku, PDO::PARAM_STR);
	// クエリ実行
	$stmt->execute();


}
