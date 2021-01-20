<?php
session_start();

if (isset($_SESSION['USER']) && $_SESSION['USER'] != null){
  $user = $_SESSION['USER'];

?>
<html lang="ja">
     <link rel="stylesheet" href="submiss.css">
     <div class="btn">
    <button type="button" onclick="location.href='./timeline.php'" value="戻る"><img src="modoru.png">戻る</button>
    <button id="btn" class="button1">投稿</button>
    </div>
         
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
</head>
<body>
    <div class="box">
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
    <div class="box1">
	<select id="age">
        <option value="" hidden>年齢選択</option>
		<option value="年齢非公開">年齢非公開</option>
		<option value="10代">10代</option>
		<option value="20代">20代</option>
		<option value="30代">30代</option>
		<option value="40代">40代</option>
		<option value="50代">50代</option>
		<option value="60代">60代</option>
	</select>
    </div>
	<input type="date" id="date-input" class="date"></input>
	
	<br><textarea id="code" col="50" rows="22"  class="textarea"></textarea><br>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
const btn = document.getElementById("btn");
btn.addEventListener('click',get_data);

function get_data(){

	var cate = $('#cate').val();
	var age = $('#age').val();
	var date = $('#date-input').val();
	var main = $('#code').val();
	//各種データをrequest6.phpに送る
	var param ={"day":date,"cate":cate,"age":age,"main":main}
	console.log(param);
			$.post({
				url: 'request6.php', //　送り先
    				data: param, //　渡したいデータ
				success: function(data){
					alert('投稿に成功しました。');
					console.log(data);
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
