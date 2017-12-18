$(function() {
    $("#nowPTitle").text('最新報導');
    $('#StartDate,#EndDate').datetimepicker({
		format: 'YYYY/MM/DD'
    });
    getNewsTypeList();
    getNewsList();
    getPromotionList();

    var msg = GetURLParameter('msg');
    switch (msg){
		case '1':
            alert_msg('新增成功。');
			break;
		case '2':
            alert_msg('新增失敗，若重複出現錯誤，請聯繫系統管理員。');
			break;
        case '3':
            alert_msg('編輯成功。');
            break;
        case '4':
            alert_msg('編輯失敗，若重複出現錯誤，請聯繫系統管理員。');
            break;
        case '5':
            alert_msg('刪除成功。');
            break;
        case '6':
            alert_msg('刪除失敗，若重複出現錯誤，請聯繫系統管理員。');
            break;
		default:
			break;
	}
    $.fn.dataTable.ext.errMode = 'none';
    $('#DataList_filter, #DataList_length').hide();
});

function gotoADD(newsID) {
	var link = 'newsEdit.html';
    if (newsID != undefined) {
        link += '?newsID=' + newsID;
    }

    location.href = link;
}

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
        UnLoading();
    	if(data.error_code == '1'){
    		var result = data.result;
            if(parseInt(result.length) > 0){
                for (var i=0; i < parseInt(result.length); i ++ ){
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

function getNewsList(){
    Loading();
    $.ajax({
        url: Guava_apiUrl + '/backend/news',
        headers: {
            'Api-Code': '1025',
            'Api-Token' : $.cookie('guava_token')
        },
        method: 'POST',
        dataType: 'json',
        async: false,
        data: {
            'newsTypeID' : $('#sl_Type').val(),
            'promotionCode' : $('#sl_promotion').val(),
            's_Date' : $('#StartDate').val(),
            'e_Date' : $('#EndDate').val(),
            'adminAccount' : $('#sl_User').val(),
            'title' : $('#newsTitle').val(),
            'status' : $('#sl_Status').val()
        },
        success: function(data) {
            var arr_type = [];
            $('#sl_Type option').each(function () {
                arr_type[$(this).attr('value')] = $(this)[0].innerText;
            });

            UnLoading();
            console.log(data);
            if (data.error_code == '1') {
                var result = data.result;
                var t = $('#DataList').DataTable();
                t.clear().draw();
                if (parseInt(result.length) > 0) {

                    for (var i = 0; i < parseInt(result.length); i++) {
                        var newsStatus = '<font color="#556b2f">啟用</font>';
                        if (result[i].status == '0' || result[i].status == '3') {
                            newsStatus = '<font color="red">停用</font>';
                        }
                        var newsTime = result[i].news_time;

                        t.row.add([
                            newsTime.split(" ")[0],
                            arr_type[result[i].type_id],
                            result[i].title,
                            result[i].pName,
                            result[i].mod_user,
                            newsStatus,
                            '<button class="btn btn-info" onclick="gotoADD(' + result[i].id + ')">編輯</button>&nbsp;<button class="btn btn-warning" onclick="delNews(' + result[i].id + ')">刪除</button>'
                        ]).draw(false);
                    }
                }
            }
        },
        error: function(data){
            console.log(data);
        }
    });
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
                for (var i = 0; i < parseInt(result.length); i++) {
                    $('#sl_promotion').append($('<option>', {
                        value: result[i]['code'],
                        text: result[i]['name']
                    }));
                }
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function delNews(newsID) {
    modal_btn("請確認是否刪除。");
    $('#delNewsID').val(newsID);
}

function modal_OK() {
    $.ajax({
        url: Guava_apiUrl + '/backend/news/delete',
        headers: {
            'Api-Code': '1029',
            'Api-Token' : $.cookie('guava_token')
        },
        method: 'POST',
        dataType: 'json',
        data: {
            'newsID' : $('#delNewsID').val()
        },
        success: function(data){
            if(data.error_code == '1') {
                location.href = 'newsList.html?msg=5';
            }else{
                location.href = 'newsList.html?msg=6';
            }
        },
        error: function(data){
            console.log(data);
            location.href = 'newsList.html?msg=6';
        }
    });

}