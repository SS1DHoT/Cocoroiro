<?php
session_start();

$u = htmlspecialchars($_POST['user'],ENT_QUOTES);
$p = htmlspecialchars($_POST['pass'],ENT_QUOTES);
require_once("db_init.php");

// データーベースへpdoで接続
$pdo = new pdo("mysql:host=mysql148.phy.lolipop.lan;dbname=LAA1210934-webapp","LAA1210934","12345");
    
// 接続に失敗すれば強制終了
if(mysqli_connect_error()){
	die("Failed Connect DB.");
}

$ps = $pdo->query("SELECT password FROM userdata WHERE user='$u'");
if ($ps->rowCount()>0)
{     $r = $ps->fetch();
     if ($r['password'] === md5($p)){
         $_SESSION['USER']= $u;
		  header( "Location: ./menu.php" ) ;

    }else{
         session_destroy();
?>
<HTML lang="ja">
<HEAD>
<META HTTP EQUIV='Content-Type' CONTENT='text/html;charset=UTF-8'>
<TITLE>こころの色</TITLE>
</HEAD>
<BODY>
<P>パスワードが違います<BR>
<A HREF='logon.html'>ログイン画面へ</A></P>

<?php
    }
}else{
    session_destroy();
?>
<P>ユーザーが登録されていません<BR>
<A HREF='logon.html'></A>ログイン画面へ</P>

<?php
}
?>
</BODY>
</HTML>
