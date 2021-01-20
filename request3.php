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

}
