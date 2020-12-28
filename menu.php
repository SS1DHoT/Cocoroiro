<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<!--スマホサイズに合わせる-->
    <meta name="viewport"
    content="width=320,
    height=480,
    initial-scale=1.0,
    minimum-scale=1.0,
    maximum-scale=2.0,
    user-scalable=yes" />
<link rel="stylesheet" href="home.css">
</head>
<body>

<!--//感情整理画面へ遷移-->
<!--<input type="button" onclick="location.href='./emo_main.php'" value="感情整理">-->
<!--//記録画面へ遷移-->
<!--<input type="button" onclick="location.href='./emo_log.html'" value="記録">-->
<!--//心療内科紹介画面へ遷移-->
<!--<input type="button" onclick="location.href='./info.html'" value="心療内科紹介">-->
<!--//経験談表示画面へ遷移-->
<!--<input type="button" onclick="location.href='./timeline.html'" value="経験談">	-->

	 <div>
         <div align="center">
             <img class="img1" src="sikikantouka.png"></div>
    
    <form>
        <div class="box">
        <div class="card-1">
        <div  onclick="location.href='./emo_main.php'" class="content-img1">
        <img src="cocoro.png" />
        </div>
        <p class="content-1">メモ</p>
        </div>
        
        <div class="card-2">
        <div onclick="location.href='./emo_log.html'" class="content-img1">
        <img src="graf.png" />
        </div>
        <p class="content-2">レコード</p>
        </div>
        
        <div class="card-3">
        <div onclick="location.href='./info.html'" class="content-img2">
        <img src="soudan.png" />
        </div>
        <p class="content-3">クリニック</p>
        </div>
        
        <div class="card-4">
        <div onclick="location.href='./timeline.html'" class="content-img3">
        <img src="keiji.png" />
        </div>
        <p class="content-4">メッセージ</p>
        </div>
        </div>
    </form>
    </div>
    </body>
</html>
