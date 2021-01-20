'use strict';

function initMap() {
    var btn = document.getElementById("searchbtn");
    //出力場所の指定
    var inputArea = document.getElementById('output');;
    var service = new google.maps.places.PlacesService(document.createElement('div'));;
    //var detail;
    var week_array = new Array(7);

    btn.onclick = function() {
        main();
    }
    function main() {   
        //textboxから受け取った値を変数に代入
        var search_place = document.getElementById('place').value;
        //受け取った値を出力
        console.log(search_place);
        //最初から入っていた要素を削除
        if($('div').find('.Data').length){
            console.log('子要素が存在');
            while (inputArea.firstChild) {
                inputArea.removeChild(inputArea.firstChild);
                console.log('子要素の削除');
            }
        }else {
            console.log('子要素が存在しません');
        }
        if(search_place == ""){
            window.alert("地名を入力してください");
        }else{
            btn.disabled = true;
            search_Id(search_place);
        }
    }
    //帰ってきた値を出力する関数
    function search_Id(place_Name){
        service.textSearch({
            query: `${place_Name}の心療内科`,
            fields: ['place_id']
        }, function(place, status) {
            console.log('1');
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                var tasks = [];
                Promise.all(tasks).then(result => {
                    console.log("2");
                    end();
                })
                for (let i=0; i<place.length && i < 10; ++i) {
                    inputArea.insertAdjacentHTML('beforeend', `<div class='Data' id='outputBox${i}'></div>`);
                    var details_id = place[i].place_id;
                    tasks.push(search_detail(details_id, i).then());
                }
            }
        })
    }

    //上で受け取った値をもとに場所の詳細を求める
    function search_detail(id, No){
        return new Promise((resolve, reject) => {
            service.getDetails({
                placeId: id,
                fields: ['name', 'formatted_address', 'formatted_phone_number','business_status', 'website', 'opening_hours']
            }, function(place, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    //結果の出力
                    var inputData = document.getElementById(`outputBox${No}`)
                    //診療所名
                    inputData.insertAdjacentHTML('beforeend', `<a href='${place.website}' class='name' id='name${No}'>${place.name}</a>`);

                    inputData.insertAdjacentHTML('beforeend', `<div class='add' id='add${No}'>${place.formatted_address.substr(3,8)}</div>`);
                    //診療所住所
                    inputData.insertAdjacentHTML('beforeend', `<div class='add' id='add${No}'>${place.formatted_address.substr(12)}</div>`);
                    //診療所電話番号
                    inputData.insertAdjacentHTML('beforeend', `<div class='phone' id='phone${No}'>${place.formatted_phone_number}</div>`);
                    //営業ステータス格納用タグ
                    inputData.insertAdjacentHTML('beforeend', `<div class='status' id='status${No}'></div>`);
                    //曜日ごとの営業時間を出力
                    for (var i = 0; i < 7; i++){
                        week_array[i] = place.opening_hours['weekday_text'][i].split(': ');
                        //week.insertAdjacentHTML('beforeend', `<div id='status_day${i}'>${place.opening_hours['weekday_text'][i].substr(4)}</div>`);
                    }
                    for(var i = 0; i < week_array.length; i++){
                        console.log(week_array[i]);
                    }
                    //営業時間テーブル作成用の関数を呼び出し
                    generate_table(No);
                    //営業中か判定
                    if(place.business_status == "OPERATIONAL") {
                        document.getElementById(`status${No}`).insertAdjacentHTML('beforeend', '営業中');
                    }else{
                        document.getElementById(`status${No}`).insertAdjacentHTML('beforeend', '営業していません');
                    }
                    console.log(place.name);
                }
            });
            resolve();
        })
    }

    //営業時間テーブル作成関数
    function generate_table(No) {
        // get the reference for the body
        var body = document.getElementById(`outputBox${No}`);
        // creates a <table> element and a <tbody> element
        var tbl = document.createElement("table");
        var tblBody = document.createElement("tbody");
        // creating all cells
        for (var i = 0; i < 2; i++) {
        // creates a table row
            var row = document.createElement("tr");
            for (var j = 0; j < 7; j++) {
                var cell = document.createElement("td");
                var str = week_array[j][i];
                var result = str.replace('時', ':').replace('分', '').replace(',', '');
                //「str」と「result」が同じ文字列になるまで繰り返す
                while(result !== str) {
                
                    str = str.replace('時', ':').replace('分', '').replace(',', '');
                    result = result.replace('時', ':').replace('分', '').replace(',', '');
                
                }
                var cellText = document.createTextNode(str);
                cell.appendChild(cellText);
                row.appendChild(cell);
            }
            tblBody.appendChild(row);
        }
        // put the <tbody> in the <table>
        tbl.appendChild(tblBody);
        // appends <table> into <body>
        body.appendChild(tbl);
        // sets the border attribute of tbl to 2;
        tbl.setAttribute("border", "2");
        week_array.splice(0);
    }

    function end(){
        btn.disabled = false;
    }
}

