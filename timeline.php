<?php
session_start();

if (isset($_SESSION['USER']) && $_SESSION['USER'] != null){
$user = $_SESSION['USER'];

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<!--スマホサイズに合わせる-->
		<meta name="viewport"
		content="width=device-width,
		height=480,
		initial-scale=1.0,
		minimum-scale=1.0,
		maximum-scale=2.0,
		user-scalable=yes" />
		<link rel="stylesheet" href="timeline.css">
	</head>
	<body>
		<div id="top">
			<button class="serch" type="button" onclick="location.href='./menu.php'"　value="ホーム"><img src="home.png">ホームへ</button>
			<div class="serch" id="box">
				<select id="cate">
					<option value="" hidden>カテゴリ選択</option>
					<option value="人間関係">人間関係</option>
					<option value="仕事">仕事</option>
					<option value="学校">学校</option>
					<option value="家庭">家庭</option>
					<option value="いじめ">いじめ</option>
					<option value="恋愛">恋愛</option>
				</select>
			</div>
			<button id="btn" class="serch">検索</button>
		</div>
		<div id="text-area">
			<div id="table"></div>
		</div>
		<button type="button" onclick ="location.href='./submiss.php'" class="button1" value="投稿"> 投稿 <br>
			<img src="plus.png" class="img1">
		</button>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script>
			const btn = document.getElementById("btn");
			btn.addEventListener('click',get_data);
			function get_data(){
				var cate = $('#cate').val();
				var param ={"cate":cate}
					$.post({
						//選択したカテゴリをrequest5.phpに送る
						url: 'request5.php', //　送り先
						data: param, //　渡したいデータ
						dataType : 'json', //　データ形式を指定
						success: function(data){
							for(var key in data){
							var text1 = document.createElement("p");
							text1.innerHTML = data[key].main+"<br>"+data[key].day+"  "+data[key].age;
							var x = document.getElementById("table");
							x.appendChild(text1);
							}
						},
						error: function(data){
							alert('取得に失敗しました。');
							console.log(data);
						}
					});
			}
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
