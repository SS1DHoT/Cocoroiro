<?php
session_start();

$u = htmlspecialchars($_POST['user'],ENT_QUOTES);
$p = htmlspecialchars($_POST['password'],ENT_QUOTES);
require_once("db_init.php");
?>
<HTML lang="ja">
<link rel="stylesheet" href="pin2.css">
<HEAD>
<META HTTP EQUIV='Content-Type' CONTENT='text/html;charset=UTF-8'>
     <!--スマホサイズに合わせる-->
    <meta name="viewport"
    content="width=320,
    height=480,
    initial-scale=1.0,
    minimum-scale=1.0,
    maximum-scale=2.0,
    user-scalable=yes" />
<TITLE>こころの色</TITLE>
</HEAD>
<BODY>
<?php

// データーベースへpdoで接続
$pdo = new pdo("mysql:host=localhost;dbname=webapp","root","");

// 接続に失敗すれば強制終了
if(mysqli_connect_error()){
	die("Failed Connect DB.");
}
$out=0;
$ps = $pdo->query("SELECT name FROM user ");
if (!empty($ps)){
	$ps->rowCount()>0;
	//FETCH_ASSOCは配列のキーがカラム名のみ準備される
	$r = $ps->fetch(PDO::FETCH_ASSOC);
	//ユーザー名の重複検知
	foreach($r as $vals){
		if($vals === $u){
			$out=1;
		}
	}
}
if($_POST['user'] == ''){
    echo "ユーザー名を入力してください";
}elseif($_POST['password']==''){
    echo "Passwordを入力してください";
}elseif ($out === 1){

?>
<P>そのユーザー名は既に使われています<BR>
<A HREF='user_make.html'>新規登録画面</A></P>

<?php
}else{
	 $pdo->query("INSERT INTO user (name,pass) VALUES('$u',md5('$p'))");
	 echo '登録完了';
?>
<P>登録完了<BR>
<A HREF='logon.html'>ログイン画面</A></P>
<?php
}
?>
</BODY>
</HTML>
