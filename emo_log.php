<?php
session_start();

if (isset($_SESSION['USER']) && $_SESSION['USER'] != null){
  $user = $_SESSION['USER'];
	
?>
<!DOCTYPE html>
<html lang="ja">
	<form action="emo_main.php">
		<button type="button" name="" value="感情整理">感情整理画面へ</button>
	</form>
<head>
<meta charset="UTF-8">
</head>
<body>
	<!-- 日付入力 -->
    <input type="date" id="date-input"></input>
	<button id="sele">表示</button>
	<button id="ore">月の変化</button>
	<canvas id="myChart" width="400" height="400"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
const btnse = document.getElementById("sele");
const btnore = document.getElementById("ore");

btnse.addEventListener('click',get_data);
btnore.addEventListener('click',get_month);

function get_data(){
	var day, month, year;
	
  var date = $('#date-input').val().split("-");
    console.log(date, $('#date-input').val())
	day = date[2];
	month = date[1];
	year = date[0];
	var param ={"year":year,"month":month,"day":day}
			$.post({
				url: 'request3.php', //　送り先
    			data: param, //　渡したいデータ
    			dataType : 'json', //　データ形式を指定
				success: function(data){
				var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["嬉しい", "喜び", "哀しい", "怒り"],
        datasets: [{
            label: '# of Votes',
            data: [data['ki'], data['raku'],data['ai'],data['do']],
			//data: [3, 3, 1, 1],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        rotation: 1 * Math.PI,
        circumference: 1 * Math.PI,
		title: {
           display: true,
           text: data['year']+"-"+data['month']+"-"+data['day'],
           position: 'bottom'
        }
		
    }
});
			},
			error: function(data){
        		alert('取得に失敗しました。');
				console.log(data);
			}
		});
	
	
}
function get_month(){
	var date = $('#date-input').val().split("-");
    console.log(date, $('#date-input').val())
	day = date[2];
	month = date[1];
	year = date[0];
	var under=new Array();
	var ki=new Array();
	var oko=new Array();
	var ai=new Array();
	var raku=new Array();
	var param ={"year":year,"month":month,"day":day}
			$.post({
				url: 'request4.php', //　送り先
    			data: param, //　渡したいデータ
    			dataType : 'json', //　データ形式を指定
				success: function(data){
				for(var key in data){
					under.push(data[key].day);
					ki.push(data[key].ki);
					oko.push(data[key].do);
					ai.push(data[key].ai);
					raku.push(data[key].raku);
				}
				console.log(under);
				var ctx = document.getElementById("myChart").getContext('2d');
var data = {
    labels: under,
    datasets: [
        {
            label: "喜び",
            backgroundColor: Chart.helpers.color('rgb(235, 62, 35)').alpha(0.5).rgbString(),
            borderColor: 'rgb(235, 62, 35)',
            pointBackgroundColor: 'rgb(235, 62, 35)',
            data: ki
        },
        {
            label: "怒り",
            backgroundColor: Chart.helpers.color('rgb(54, 162, 235)').alpha(0.5).rgbString(),
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            data: oko
        },
		{
            label: "哀しい",
            backgroundColor: Chart.helpers.color('rgb(235, 62, 35)').alpha(0.5).rgbString(),
            borderColor: 'rgb(235, 62, 35)',
            pointBackgroundColor: 'rgb(235, 62, 35)',
            data: ai
        },
		{
            label: "楽しい",
            backgroundColor: Chart.helpers.color('rgb(235, 62, 35)').alpha(0.5).rgbString(),
            borderColor: 'rgb(235, 62, 35)',
            pointBackgroundColor: 'rgb(235, 62, 35)',
            data: raku
        }
    ]
};
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: data,
  options: {}
});
			},
			error: function(data){
        		alert('変更に失敗しました。');
				console.log(data);
			}
		});
	
}
</script>
</body>
<?php
}else{
     session_destroy();
     print "<P>ちゃんとログインしてね！<BR>
            <A HREF='./pin.php'>ログイン</A></P>";
}
?>
