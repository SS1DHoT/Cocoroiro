<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>
<?php
if (isset($_SESSION['USER']) && $_SESSION['USER'] != null){
?>
<!--//感情整理画面へ遷移-->
<input type="button" onclick="location.href='./emo_main.php'" value="感情整理">
<!--//記録画面へ遷移-->
<input type="button" onclick="location.href='./emo_log.html'" value="記録">
<!--//心療内科紹介画面へ遷移-->
<input type="button" onclick="location.href='./info.html'" value="心療内科紹介">
<!--//経験談表示画面へ遷移-->
<input type="button" onclick="location.href='./timeline.html'" value="経験談">	
<?php
}else{
    session_destroy();
    print "<P>ちゃんとログオンしてね！<BR>
           <A HREF='g_logon.html'>ログオン</A></P>";
}
?>
	</body>
</html>
