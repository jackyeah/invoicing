$(function() {
    Loading();
    initSample();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    });
    getPromotionList();
    getNewsTypeList();

    var newsID = GetURLParameter('newsID');
    if(newsID == ''){
        $("#nowPTitle").text('最新報導').after("<li>新增最新報導</li>");
        $('#subTitle').text('新增最新報導');
        showImg('');
    }else{
        $("#nowPTitle").text('最新報導').after("<li>編輯最新報導</li>");
        $('#subTitle').text('編輯最新報導');

        sleep(1000);
        getNewsContent(newsID);
    }
    UnLoading();
});

// 新增/編輯最新消息
function SaveData(){
	var msg = "";
	var newsID = $("#newsID").val();
	var Date = $("#Date").val();
	var chk_ptn = getChkVal('chk_ptn',',');
	var Title_cn = $("#Title_cn").val();
	var OverView_cn = $('#OverView_cn').val();
	var sl_Type = $("#sl_Type").val();
    var rdo_Status = getChkVal('rdo_Status',',');
	var editor_cn = CKEDITOR.instances.editor_cn.getData().replace(/\n/g, '');

	if(Date == ""){
		msg += "日期，請勿為空。<br />";
	}

	if(Title_cn == ""){
		msg += "標題，請勿為空。<br>";
	}

	if(sl_Type == '0'){
		msg += '類別，請選擇。<br>';
	}

	if(editor_cn == ""){
		msg += "內文，請勿為空。<br>";
	}

	if(chk_ptn == ''){
		msg += '推廣站，請至少選擇一個。<br>';
	}else{
		var data_chk_ptn = '[';
		var arr_chk_ptn = chk_ptn.split(',');
        for (var i=0; i < parseInt(arr_chk_ptn.length); i ++ ){
			data_chk_ptn += '{"pCode":"' + arr_chk_ptn[i] + '"},';
		}
        data_chk_ptn = data_chk_ptn.substring(0,data_chk_ptn.length-1);
        data_chk_ptn += ']';
	}



	if(msg == ""){
		Loading();
        alert_msg("已更改設定");

        var apiUrl = Guava_apiUrl + '/backend/news/update';
        var apiCode = '1028';
        if(newsID == ''){
            apiUrl = Guava_apiUrl + '/backend/news/create';
            apiCode = '1027';
        }

        $.ajax({
            url: apiUrl,
            headers: {
                'Api-Code': apiCode,
                'Api-Token' : $.cookie('guava_token')
            },
            method: 'POST',
            dataType: 'json',
            async: false,
            data: {
                'newsID' : newsID,
                'promotionCode' : data_chk_ptn,
                'date' : Date,
                'newsTypeID' : sl_Type,
                'img' : '',
                'title' : Title_cn,
                'overview' : OverView_cn,
                'status' : rdo_Status,
                'content' : editor_cn
            },
            success: function(data){
                console.log(data);

            	if(data.error_code == '1'){
            	    var updType = 'U';
            	    if(newsID == ''){
                        newsID = data.result.news_id;
                        updType = 'A';
                    }

                    // 判斷是否上傳圖片
                    var files = $("#uploadFile").get(0).files;
                    if (files.length > 0) {
                        var data_img = new FormData();
                        data_img.append("image", files[0]);
                        data_img.append('id', newsID);

                        $.ajax({
                            url: Guava_apiUrl + '/backend/upload/news_img',
                            headers: {
                                'Api-Token' : $.cookie('guava_token')
                            },
                            method: 'POST',
                            contentType: false,         // 告诉jQuery不要去這置Content-Type
                            processData: false,         // 告诉jQuery不要去處理發送的數據
                            async: false,
                            data: data_img,
                            success: function (data) {
                                if(updType == 'A') {
                                    location.href = 'newsList.html?msg=1';
                                }else{
                                    location.href = 'newsList.html?msg=3';
                                }
                            },
                            error: function (data) {
                                if(updType == 'A') {
                                    location.href = 'newsList.html?msg=2';
                                }else{
                                    location.href = 'newsList.html?msg=4';
                                }
                            }
                        });
                    }else{
                        if(updType == 'A') {
                            location.href = 'newsList.html?msg=1';
                        }else{
                            location.href = 'newsList.html?msg=3';
                        }
                    }
				}else{
                    if(newsID == '') {
                        location.href = 'newsList.html?msg=2';
                    }else{
                        location.href = 'newsList.html?msg=4';
                    }
				}
            },
            error: function(data){
                console.log(data);
            }
        });
	}else{
        modal_btn(msg);
	}
}

function Back(){
	$('#modal-type').val('1');
	modal_btn("請確認是否離開。");
}

function chkSubmit(){
    $('#modal-type').val('2');
    modal_btn("請確認是否送出。");
}

function modal_OK(){
	switch ($('#modal-type').val()){
		// 回上一頁
		case '1':
            location.href = "newsList.html";
			break;
		// 送出新增/編輯
		case '2':
			SaveData();
			break;
		default:
			break;
	}
}

function showImg(imgDomain, imgUrl) {
    if(imgUrl == ''){
        $('#newsImg').hide();
    }else{
        $('#newsImg').prop('src', imgDomain + imgUrl);
    }
}

// 取得推廣站清單（status固定帶1，因是取啟用的類別）
function getPromotionList() {
    $.ajax({
        url: Guava_apiUrl + '/backend/promotion',
        headers: {
            'Api-Code': '1011',
            'Api-Token': $.cookie('guava_token')
        },
        method: 'POST',
        dataType: 'json',
        async: false,
        data: {
            'name': '',
            'status': 1
        },
        success: function (data) {
            if(data.error_code == '1') {
                var result = data.result;
                if (parseInt(result.length) > 0) {
                    var pCode = '';
                    for (var i = 0; i < parseInt(result.length); i++) {
                        var appData = '<div class="checkbox3 checkbox-success checkbox-inline checkbox-check checkbox-round  checkbox-light">';
                        appData += '<input type="checkbox" name="chk_ptn" id="chk_ptn_' + result[i]['id'] + '" value="' + result[i]['code'] + '" checked="">';
                        appData += '<label for="chk_ptn_' + result[i]['id'] + '">';
                        appData += result[i].name + ' ( <a href="' + result[i].url + '" target="_blank">' + result[i].url + '</a> )</label></div>';

                        pCode += result[i]['code'] + ',';

                        $('#div_Promotion').append(appData);
                    }
                    pCode = pCode.substring(0,pCode.length-1);
                    $('#pCode_value').val(pCode);
                }
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

// 取得最新報導類別（status固定帶1，因是取啟用的類別）
function getNewsTypeList(){
    $.ajax({
        url: Guava_apiUrl + '/backend/news_type',
        headers: {
            'Api-Code': '1021',
            'Api-Token' : $.cookie('guava_token')
        },
        method: 'POST',
        dataType: 'json',
        async: false,
        data: {
            'name' : '',
            'status' : 1
        },
        success: function(data){
            if(data.error_code == '1') {
                var result = data.result;
                if (parseInt(result.length) > 0) {
                    for (var i = 0; i < parseInt(result.length); i++) {
                        $('#sl_Type').append($('<option>', {
                            value: result[i].id,
                            text: result[i].type_name
                        }));
                    }
                }
            }
        },
        error: function(data){
            console.log(data);
        }
    });
}

// 取得最新報導詳細資料
function getNewsContent(newsID) {
    $.ajax({
        url: Guava_apiUrl + '/backend/news/content',
        headers: {
            'Api-Code': '1026',
            'Api-Token' : $.cookie('guava_token')
        },
        method: 'POST',
        dataType: 'json',
        async: false,
        data: {
            'newsID' : newsID
        },
        success: function(data){
            console.log(data);
            if(data.error_code == '1') {
                console.log(data.result[0]);
                console.log(data.result[0].news_details);
                $('#newsID').val(data.result[0].id);
                var newsDate = new Date(data.result[0].news_time);
                $('#Date').val(newsDate.getFullYear() + '/' + (newsDate.getMonth() + 1) + '/' + newsDate.getDate());
                //$('#Date').val(data.result[0].news_time);
                $('#Title_cn').val(data.result[0].title);
                $('#OverView_cn').val(data.result[0].overview);
                $('#editor_cn').html(data.result[0].content);
                $('#sl_Type').select2().val(data.result[0].type_id).trigger("change");
                $('input:radio[name=rdo_Status]').filter('[value=' + data.result[0].status + ']').prop('checked', true);
                showImg(data.result[0].domain, data.result[0].pic);

                // 所有的推廣站資料
                var arr_pCode_view = $('#pCode_value').val().split(',');
                // 有使用的推廣站
                var arr_pCode_value = getCol(data.result[0].news_details, 'promotion_code');

                // 比對之後，得到需要取消選取的推廣站
                var diff = $(arr_pCode_view).not(arr_pCode_value).get();
                if (diff.length > 0) {
                    for (var i = 0; i < parseInt(diff.length); i++) {
                        $('input:checkbox[name=chk_ptn]').filter('[value=' + diff[i] + ']').prop('checked', false);
                    }
                }
            }else{
                alert_msg('取得最新報導資料異常。')
            }
        },
        error: function(data){
            console.log(data);
        }
    });

}

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
            break;
        }
    }
}

// 用法跟php的 array_column 一樣
function getCol(matrix, col){
    var column = [];
    for(var i=0; i<matrix.length; i++){
        column.push(matrix[i][col]);
    }
    return column;
}