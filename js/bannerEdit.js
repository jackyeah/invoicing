$(function() {
    var bannerID = GetURLParameter('bannerID');
    getPromotionList();
    if(bannerID == ''){
        $("#nowPTitle").text('橫幅').after("<li>新增橫幅</li>");
        $('#subTitle').text('新增橫幅');
    }else{
        $("#nowPTitle").text('橫幅').after("<li>編輯橫幅</li>");
        $('#subTitle').text('編輯橫幅');

        getBannerContent(bannerID);
    }
});

function chkSubmit(){
    $('#modal-type').val('2');
    modal_btn("請確認是否送出。");
}

function Back(){
	$('#modal-type').val('1');
	modal_btn("請確認是否離開。");
}

function modal_OK(){
	switch ($('#modal-type').val()){
		// 回上一頁
		case '1':
            location.href = "bannerList.html";
			break;
		// 送出新增/編輯
		case '2':
			SaveData();
			break;
		default:
			break;
	}
}

function showImg(webDomain, webUrl, mobileDomain, mobileUrl) {
    if(webUrl == ''){
        $('#webImg').hide();
    }else{
        $('#webImg').prop('src', webDomain + webUrl);
    }

    if(mobileUrl == ''){
        $('#mobileImg').hide();
    }else{
        $('#mobileImg').prop('src', mobileDomain + mobileUrl);
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

// 新增/編輯橫幅
function SaveData(){
    var msg = "";
    var bannerID = $("#bannerID").val();
    var chk_ptn = getChkVal('chk_ptn',',');
    var txt_url = $('#txt_url').val();
    var Remark_cn = $('#Remark_cn').val();
    var rdo_Status = getChkVal('rdo_Status',',');

    /*if(txt_url == ""){
        msg += "banner導向網址，請勿為空。<br />";
    }*/

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

    // 判斷是否上傳圖片
    var uploadFile_web = $("#uploadFile_web").get(0).files;
    var uploadFile_mobile = $("#uploadFile_mobile").get(0).files;
	 if(bannerID == '' && uploadFile_web.length == 0 ){
    	msg += '請上傳網頁板圖片。<br>';
	}
    if(bannerID == '' && uploadFile_mobile.length == 0){
        msg += '請上傳手機板圖片。';
    }

    if(msg == ""){
        Loading();
        alert_msg("已更改設定");

        var data_img = new FormData();
        if (uploadFile_web.length > 0) {
            data_img.append("web_image", uploadFile_web[0]);
        }
        if (uploadFile_mobile.length > 0) {
            data_img.append("mobile_image", uploadFile_mobile[0]);
        }
        data_img.append('url', txt_url);
        data_img.append('status', rdo_Status);
        data_img.append('promotion_code', data_chk_ptn);
        data_img.append('description', Remark_cn);

        var ajaxUrl = Guava_apiUrl + '/backend/upload/banner_img';
        if(bannerID != ''){
            ajaxUrl = Guava_apiUrl + '/backend/banner/update';
            data_img.append('banner_id', bannerID);
		}

        $.ajax({
            url: ajaxUrl,
            headers: {
                'Api-Code': '1025',
                'Api-Token' : $.cookie('guava_token')
            },
            method: 'POST',
            contentType: false,         // 告诉jQuery不要去這置Content-Type
            processData: false,         // 告诉jQuery不要去處理發送的數據
            data: data_img,
            success: function(data){
                UnLoading();
                console.log(data);
                if(data.error_code == '1') {
                    if(bannerID == '') {
                        location.href = 'bannerList.html?msg=1';
                    }else{
                        location.href = 'bannerList.html?msg=3';
					}
                }else{
                    if(bannerID == '') {
                        location.href = 'bannerList.html?msg=2';
                    }else{
                        location.href = 'bannerList.html?msg=4';
                    }
				}
            },
            error: function(data){
                console.log(data);
                location.href = 'bannerList.html?msg=2';
            }
        });
    }else{
        modal_btn(msg);
    }
}

// 取得橫幅詳細資料
function getBannerContent(bannerID) {
    $.ajax({
        url: Guava_apiUrl + '/backend/banner/detail',
        headers: {
            'Api-Code': '1026',
            'Api-Token' : $.cookie('guava_token')
        },
        method: 'POST',
        dataType: 'json',
        async: false,
        data: {
            'banner_id' : bannerID
        },
        success: function(data){
            if(data.error_code == '1') {
            	var result = data.result[0];

                $('#bannerID').val(result.id);
                $('#txt_url').val(result.url);
                $('#Remark_cn').val(result.description);
                $('input:radio[name=rdo_Status]').filter('[value=' + result.status + ']').prop('checked', true);

                // 所有的推廣站資料
                var arr_pCode_view = $('#pCode_value').val().split(',');
                // 有使用的推廣站
                var arr_pCode_value = result.pCode.split(',');
                // 比對之後，得到需要取消選取的推廣站
                var diff = $(arr_pCode_view).not(arr_pCode_value).get();
                if (diff.length > 0) {
                    for (var i = 0; i < parseInt(diff.length); i++) {
                        $('input:checkbox[name=chk_ptn]').filter('[value=' + diff[i] + ']').prop('checked', false);
                    }
                }
                showImg(result.web_domain, result.pic_web, result.mobile_domain, result.pic_mobile);
            }
        },
        error: function(data){
            console.log(data);
        }
    });

}