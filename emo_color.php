<?php
session_start();

if (isset($_SESSION['USER']) && $_SESSION['USER'] != null){
  $user = $_SESSION['USER'];
// データーベースへpdoで接続
    $pdo = new pdo("mysql:host=localhost;dbname=webapp","root","");

// SQL作成
	$sql = "SELECT * FROM user WHERE name= $user";
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
	<form action="emo_main.php">
		<button type="button" name="" value="感情整理">感情整理画面へ</button>
	</form>
<head>
<meta charset="UTF-8">
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
	<div id="1" class="sample1">嬉しい</div>
	<div id="2" class="sample2">哀しい</div>
	<div id="3" class="sample3">楽しい</div>
	<div id="4" class="sample4">怒り</div>
	<button id="btn">変更</button>
	<div id="c1" class="violet">violet</div>
	<div id="c2" class="hotpink">hotpink</div>
	<div id="c3" class="royalblue">royalblue</div>
	<div id="c4" class="deepskyblue">deepskyblue</div>
	<p>選択中の色</p>
	<div id="sele" class="slect">select</div>
		
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script>
	"use strict";
	
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

	tgki.addEventListener('click',js_cha1);
	function js_cha1(){
			select=1;
			tgki.style.backgroundColor="#98fb98";
		    tgdo.style.backgroundColor="white";
		    tgai.style.backgroundColor="white";
		    tgraku.style.backgroundColor="white";
	};
	tgai.addEventListener('click',function(){
			select=2;
			tgai.style.backgroundColor="#98fb98";
		    tgki.style.backgroundColor="white";
	        tgdo.style.backgroundColor="white";
		    tgraku.style.backgroundColor="white";
							 });
	tgraku.addEventListener('click',function(){
			select=3;
			tgraku.style.backgroundColor="#98fb98";
		    tgki.style.backgroundColor="white";
		    tgdo.style.backgroundColor="white";
	        tgai.style.backgroundColor="white";
							 });
	tgdo.addEventListener('click',function(){
			select=4;
			tgdo.style.backgroundColor="#98fb98";
		    tgki.style.backgroundColor="white";
		    tgai.style.backgroundColor="white";
		    tgraku.style.backgroundColor="white";
							 });
	
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
	
	btn.addEventListener('click',function(){
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
	</body>
</html>
