<?php
session_start();

if (isset($_SESSION['USER']) && $_SESSION['USER'] != null){
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
    $pdo = new pdo("mysql:host=mysql148.phy.lolipop.lan;dbname=LAA1210934-webapp","LAA1210934","12345");

// SQL作成
	$sql = "SELECT * FROM userdata WHERE user= $user";
// SQL実行
	$res = $pdo->query($sql);
// 配列に色情報を格納
	$color = array($res['ki'],$res['do'],$res['ai'],$res['raku']);
// 配列をjsに渡すためJSON形式に変換
	$php_json = json_encode($color);
	$php_user = json_encode($user);
?>
<!DOCTYPE html>
<html lang="ja">
     <link rel="stylesheet" href="emo_color.css">
	<form action="emo_main.php">
		<button type="button" name="" onclick="location.href='./emo_main.php'" value="戻る" class="button1"><img src="modoru.png">戻る</button>
	</form>
    
<head>
<meta charset="UTF-8">
 <!--スマホサイズに合わせる-->
    <meta name="viewport"
    content="width=320,
    height=480,
    initial-scale=1.0,
    minimum-scale=1.0,
    maximum-scale=2.0,
    user-scalable=yes" />
<style>
.sample01 {  
   width:100px;
   height:100px;
   background-color:white;
   text-align:center;
   line-height:100px;
}
.sample02 {  
   width:100px;
   height:100px;
   background-color:white;
   text-align:center;
   line-height:100px;
}
.sample03 {  
   width:100px;
   height:100px;
   background-color:white;
   text-align:center;
   line-height:100px;
}
.sample04 {  
   width:100px;
   height:100px;
   background-color:white;
   text-align:center;
   line-height:100px;
}
.violet{
   background-color:violet;
}
.hotpink{
   background-color:hotpink;
}
.royalblue{
   background-color:royalblue;
}
.deepskyblue{
   background-color:deepskyblue;
}
.slect{
   background-color:white;
}
</style>
	</head>
	<body>    
    <div class="radio">
    <p><img src="senntaku.png">感情と色を選択してください</p>
    <label><input type="radio" id="1" class="sample1" name="radio">嬉しい</input></label><br>
	<label><input type="radio" id="2" class="sample2" name="radio">哀しい</input></label><br>
	<label><input type="radio" id="3" class="sample3" name="radio">楽しい</input></label><br>
	<label><input type="radio" id="4" class="sample4" name="radio">怒り</input></label><br>
    </div>
	
	<div id="c1" class="violet">violet</div>
	<div id="c2" class="hotpink">hotpink</div>
	<div id="c3" class="royalblue">royalblue</div>
	<div id="c4" class="deepskyblue">deepskyblue</div>

    <div class="select">
    <p><img src="senntaku.png">選択中の色</p>
	<div id="sele" class="slect">select</div>
    </div>
        
    <button id="btn" class="button2">変更</button>
		
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script>
	"use strict";
	
	//各種宣言
	var select=0;
	var selectCl='';
	var Data = '';
	
	var check = document.getElementById("sele");
	
	var color1='';
	var color2='';
	var color3='';
	var color4='';
	const tgki = document.getElementById("1");
	const tgai = document.getElementById("2");
	const tgraku = document.getElementById("3");
	const tgdo = document.getElementById("4");
	
	const colcha1 = document.getElementById("c1");
	const colcha2 = document.getElementById("c2");
	const colcha3 = document.getElementById("c3");
	const colcha4 = document.getElementById("c4");
	
	const btn = document.getElementById("btn");
	//喜びが選択された時
	tgki.addEventListener('click',js_cha1);
	function js_cha1(){
			select=1;
	};
	//哀しいが選択された時
	tgai.addEventListener('click',function(){
			select=2;
	});
	//楽しいが選択された時
	tgraku.addEventListener('click',function(){
			select=3;
	});
	//怒りが選択された時
	tgdo.addEventListener('click',function(){
			select=4;
	});
	//各種色を選択したとき
	colcha1.addEventListener('click',function(){
		selectCl="violet";
		check.style.backgroundColor="violet";
	});
	colcha2.addEventListener('click',function(){
		selectCl="hotpink";
		check.style.backgroundColor="hotpink";
	});
	colcha3.addEventListener('click',function(){
		selectCl="royalblue";
		check.style.backgroundColor="royalblue";
	});
	colcha4.addEventListener('click',function(){
		selectCl="deepskyblue";
		check.style.backgroundColor="deepskyblue";
	});
	//変更ボタンをタップ
	btn.addEventListener('click',function(){
		各感情ごとの処理
		if(select==1){
			var param ={"sel":"ki","color":selectCl}
			$.post({
				url: 'request.php', //　送り先
    			data: param, //　渡したいデータ
    			//dataType : 'json', //　データ形式を指定
				success: function(data){
				alert('変更が完了しました。');
				console.log(data);
			},
			error: function(data){
        		alert('変更に失敗しました。');
				console.log(data);
			}
		});
		}else if(select==2){
			var param ={"sel":"ai","color":selectCl}
			$.post({
				url: 'request.php', //　送り先
    			data: param, //　渡したいデータ
    			//dataType : 'json', //　データ形式を指定
				success: function(data){
				alert('変更が完了しました。');
				console.log(data);
			},
			error: function(data){
        		alert('変更に失敗しました。');
				console.log(data);
			}
		});
		}else if(select==3){
			var param ={"sel":"raku","color":selectCl}
			$.post({
				url: 'request.php', //　送り先
    			data: param, //　渡したいデータ
    			//dataType : 'json', //　データ形式を指定
				success: function(data){
				alert('変更が完了しました。');
				console.log(data);
			},
			error: function(data){
        		alert('変更に失敗しました。');
				console.log(data);
			}
		});
		}else if(select==4){
			var param ={"sel":"do","color":selectCl}
			$.post({
				url: 'request.php', //　送り先
    			data: param, //　渡したいデータ
    			//dataType : 'json', //　データ形式を指定
				success: function(data){
				alert('変更が完了しました。');
				console.log(data);
			},
			error: function(data){
        		alert('変更に失敗しました。');
				console.log(data);
			}
		});
		}
	});
</script>
<?php
}else{
     session_destroy();
     print "<P>ちゃんとログインしてね！<BR>
            <A HREF='./pin.php'>ログイン</A></P>";
}
?>
