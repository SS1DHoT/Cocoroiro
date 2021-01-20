<?php
session_start();

if (isset($_SESSION['USER']) && $_SESSION['USER'] != null){
  $user = $_SESSION['USER'];
	
// データーベースへpdoで接続
    $pdo = new pdo("mysql:host=mysql148.phy.lolipop.lan;dbname=LAA1210934-webapp","LAA1210934","12345");

// SQL実行
	$ps = $pdo->query("SELECT * FROM userdata WHERE user = '$user'");
	$r = $ps->fetch(PDO::FETCH_ASSOC);
// 配列に色情報を格納
	$color = array($r['ki'],$r['do'],$r['ai'],$r['raku']);
// 配列をjsに渡すためJSON形式に変換
	$php_json = json_encode($color);
?>
<!DOCTYPE html>
<html lang="ja">
    <link rel="stylesheet" href="emo_main.css">

    <div class="btn">
	<form action="menu.php">
		<button type="button" onclick="location.href='./menu.php'" class="button1" value="ホーム">
        <img src="home.png">ホームへ</button>
	</form>
	<form action="emo_color.php">
		<button type="button" onclick="location.href='./emo_color.php'" class="button2" value="色変更">
        <img src="setting.png">色変更</button>
     </form>
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
<title></title>
<style>

.sample01 {  
   width:100px;
   height:100px;
   border-radius:50%;
   background-color:#ffb6c1;
   text-align:center;
   line-height:100px;

    display: inline-block;
    position: relative;
    left: 10px;
    top: 60px

}

.sample02 {  
   width:100px;
   height:100px;
   border-radius:50%;
   background-color:#87cefa;
   text-align:center;
   line-height:100px;

    display: inline-block;
    position: relative;
    left: 15px;
    top: 100px;
}

.sample03 {  
   width:100px;
   height:100px;
   border-radius:50%;
   background-color:#ffb6c1;
   text-align:center;
   line-height:100px;

    display: inline-block;
    position: relative;
    left: 20px;
    top: 60px;
}

.sample04 {  
   width:100px;
   height:100px;
   border-radius:50%;
   background-color:#87cefa;
   text-align:center;
   line-height:100px;

    display: inline-block;
    position: relative;
    left: 25px;
    top: 100px;

}

</style>
</head>
<body>
 <div id="1" class="sample01">嬉しい</div>
 <div id="2" class="sample02">哀しい</div>
 <div id="3" class="sample03">楽しい</div>
 <div id="4" class="sample04">怒り</div>

<script type="text/javascript">

"use strict";

var clrki = '';
var clrdo = '';
var clrai = '';
var clrraku = '';

var a1=0;
var a2=0;
var a3=0;
var a4=0;

const tgki = document.getElementById("1");
const tgai = document.getElementById("2");
const tgraku = document.getElementById("3");
const tgdo = document.getElementById("4");

tgki.addEventListener('click',js_size1);
tgai.addEventListener('click',js_size2);
tgraku.addEventListener('click',js_size3);
tgdo.addEventListener('click',js_size4);

document.addEventListener('DOMContentLoaded',get_data);

function js_size1(){
	if(a1==0){
		a1++;
		tgki.style.width='120px';
		tgki.style.height='120px';
		tgki.style.lineHeight='120px';
	}else if(a1==1){
		a1++;
		tgki.style.width='140px';
		tgki.style.height='140px';
		tgki.style.lineHeight='140px';
	}else{
		a1=0;
		tgki.style.width='100px';
		tgki.style.height='100px';
		tgki.style.lineHeight='100px';
	}
}
function js_size2(){
	if(a2==0){
		a2++;
		tgai.style.width='120px';
		tgai.style.height='120px';
		tgai.style.lineHeight='120px';
	}else if(a2==1){
		a2++;
		tgai.style.width='140px';
		tgai.style.height='140px';
		tgai.style.lineHeight='140px';
	}else{
		a2=0;
		tgai.style.width='100px';
		tgai.style.height='100px';
		tgai.style.lineHeight='100px';
	}
}
function js_size3(){
	if(a3==0){
		a3++;
		tgraku.style.width='120px';
		tgraku.style.height='120px';
		tgraku.style.lineHeight='120px';
	}else if(a3==1){
		a3++;
		tgraku.style.width='140px';
		tgraku.style.height='140px';
		tgraku.style.lineHeight='140px';
	}else{
		a3=0;
		tgraku.style.width='100px';
		tgraku.style.height='100px';
		tgraku.style.lineHeight='100px';
	}
}
function js_size4(){
	if(a4==0){
		a4++;
		tgdo.style.width='120px';
		tgdo.style.height='120px';
		tgdo.style.lineHeight='120px';
	}else if(a4==1){
		a4++;
		tgdo.style.width='140px';
		tgdo.style.height='140px';
		tgdo.style.lineHeight='140px';
	}else{
		a4=0;
		tgdo.style.width='100px';
		tgdo.style.height='100px';
		tgdo.style.lineHeight='100px';
	}
}


function get_data() {
	//PHPから配列を取得
	var js_array = JSON.parse('<?php echo $php_json; ?>');

	//JSONから色を取得し、代入
	clrki = js_array[0];
	clrdo = js_array[1];
	clrai = js_array[2];
	clrraku = js_array[3];

	//取得した色をbackgroundに設定
	tgki.style.backgroundColor=clrki;
	tgai.style.backgroundColor=clrai;
	tgraku.style.backgroundColor=clrraku;
	tgdo.style.backgroundColor=clrdo;

	//日付処理
	var day = new Date();
	var year = day.getFullYear();
 	//月だけ+1すること
 	var month = 1 + day.getMonth();
	var now = day.getDate();
	var before = '';
	if(!before){
		before = now;
	}else if(before === now){
		before =now;
	}else if(before != now){
		var param ={"year":year,"month":month,"day":before,"ki":a1,"do":a4,"ai":a2,"raku":a3}
		$.post({
			url: 'request2.php', // 送り先
			data: param, // 渡したいデータ
			//dataType : 'json', // データ形式を指定
			success: function(data){
				console.log('更新');
			},
			error: function(data){
				console.log(data);
			}
		});
		before = now;
	}
}


</script>
<?php
}else{
     session_destroy();
     print "<P>ちゃんとログインしてね！<BR>
            <A HREF='./logon.html'>ログイン</A></P>";
}
?>
</body>
	
	
</html>
