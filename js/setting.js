/**
 * Created by dev on 2018/1/20.
 */
$(function() {
    $("#nowPTitle").text('基本設定');

    getShippingMethod();
    getOrderSource();
});

/**
 * 取得訂單來源清單
 */
function getOrderSource() {
    Loading();
    $.ajax({
        url: apiUrl + '/setting/order_source',
        method: 'GET',
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'Api-Token': $.cookie('invoicing_token')
        },
        dataType: 'json',
        async: false,
        success: function (data) {
            if(data.error_code == '1'){
                var result = data.result;
                var resultData = '';
                for (var i = 0; i < parseInt(result.length); i++) {
                    resultData += '<li class="list-group-item">' + result[i].name + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<a href="#" onclick="editData(' + result[i].id + ', \'1\', \'' + result[i].name + '\')" title="編輯" style="color: #0f74a8;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;&nbsp;' +
                        '<a href="#" onclick="deleteData(' + result[i].id + ', \'1\', \'' + result[i].name + '\')" title="刪除" style="color: red;"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a></li>';
                }

                $('#order_source').html(resultData);
            }

            UnLoading();
        },
        error: function (data) {
            console.log(data);
            modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}

/**
 * 取得寄送方式清單
 */
function getShippingMethod() {
    Loading();
    $.ajax({
        url: apiUrl + '/setting/shipping_method',
        method: 'GET',
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'Api-Token': $.cookie('invoicing_token')
        },
        dataType: 'json',
        async: false,
        success: function (data) {
            if(data.error_code == '1'){
                var result = data.result;
                var resultData = '';
                for (var i = 0; i < parseInt(result.length); i++) {
                    resultData += '<li class="list-group-item">' + result[i].name + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<a href="#" onclick="editData(' + result[i].id + ', \'1\', \'' + result[i].name + '\')" title="編輯" style="color: #0f74a8;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;&nbsp;' +
                        '<a href="#" onclick="deleteData(' + result[i].id + ', \'1\', \'' + result[i].name + '\')" title="刪除" style="color: red;"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a></li>';
                }

                $('#shipping_method').html(resultData);
            }

            UnLoading();
        },
        error: function (data) {
            console.log(data);
            modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}

function editData(itemID, itemMethod, itemName) {
    modal_btn('請輸入欲修改的資料<br><br><input type="text" class="form-control" placeholder="'+itemName+'">');
}

function deleteData(itemID, itemMethod, itemName) {
    modal_btn('請確認是否刪除 <font color="red">'+itemName+'</font>');
}
