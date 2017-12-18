/**
 * Created by dev on 2017/10/31.
 */
$(function() {
    $("#nowPTitle").text('橫幅');
    getBannerList();

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
});

function getBannerList() {
    Loading();
    $.ajax({
        url: Guava_apiUrl + '/backend/banner',
        headers: {
            'Api-Code': '1025',
            'Api-Token' : $.cookie('guava_token')
        },
        method: 'GET',
        dataType: 'json',
        data: {

        },
        success: function(data){
            UnLoading();
            console.log(data);
            if(data.error_code == '1') {
                var result = data.result;
                if (parseInt(result.length) > 0) {
                    var Data = '';

                    for (var i = 0; i < parseInt(result.length); i++) {
                        var newsStatus = '<font color="#556b2f">啟用</font>';
                        if(result[i].status == '0' || result[i].status == '3'){
                            newsStatus = '<font color="red">停用</font>';
                        }

                        Data += '<div class="col-sm-6 col-md-3"><div class="thumbnail">';
                        Data += '<img src="' + result[i].web_domain + result[i].pic_web +'" class="img-responsive">';
                        Data += '<div class="caption">';
                        Data += '<p>推廣站：' + result[i].pName;
                        Data += '<br />狀態：' + newsStatus;
                        Data += '</p><p><button class="btn btn-info" onclick="gotoADD(' + result[i].id + ')">變更</button>';
                        Data += '<button class="btn btn-danger" onclick="delBanner(' + result[i].id + ')">刪除</button>';
                        Data += '</p></div></div></div>';
                    }
                    $('#ImgData').html(Data);
                }
            }
        },
        error: function(data){
            console.log(data);
        }
    });
}

function delBanner(bannerID) {
    modal_btn("請確認是否刪除。");
    $('#delBannerID').val(bannerID);
}

function gotoADD(bannerID) {
    var link = 'bannerEdit.html';
    if (bannerID != undefined) {
        link += '?bannerID=' + bannerID;
    }

    location.href = link;
}

function modal_OK() {
    $.ajax({
        url: Guava_apiUrl + '/backend/banner/delete',
        headers: {
            'Api-Code': '1029',
            'Api-Token' : $.cookie('guava_token')
        },
        method: 'POST',
        dataType: 'json',
        data: {
            'banner_id' : $('#delBannerID').val()
        },
        success: function(data){
            if(data.error_code == '1') {
                location.href = 'bannerList.html?msg=5';
            }else{
                location.href = 'bannerList.html?msg=6';
            }
        },
        error: function(data){
            console.log(data);
            location.href = 'bannerList.html?msg=6';
        }
    });

}