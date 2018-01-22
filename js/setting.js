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
                        '<a href="#" onclick="editData(' + result[i].id + ', \'2\', \'' + result[i].name + '\')" title="編輯" style="color: #0f74a8;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;&nbsp;' +
                        '<a href="#" onclick="deleteData(' + result[i].id + ', \'3\', \'' + result[i].name + '\')" title="刪除" style="color: red;"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a></li>';
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
                        '<a href="#" onclick="editData(' + result[i].id + ', \'5\', \'' + result[i].name + '\')" title="編輯" style="color: #0f74a8;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;&nbsp;' +
                        '<a href="#" onclick="deleteData(' + result[i].id + ', \'6\', \'' + result[i].name + '\')" title="刪除" style="color: red;"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a></li>';
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

/**
 * dialog，新增資料
 * @param itemMethod
 */
function createData(itemMethod) {
    $('#submitType').val(itemMethod);
    $('#submitID').empty();
    modal_btn('請輸入欲新增的資料<br><br><input type="text" id="submitName" class="form-control">');
}

/**
 * dialog，更新資料
 * @param itemID
 * @param itemMethod
 * @param itemName
 */
function editData(itemID, itemMethod, itemName) {
    $('#submitType').val(itemMethod);
    $('#submitID').val(itemID);
    modal_btn('請輸入欲修改的資料<br><br><input type="text" id="submitName" class="form-control" placeholder="'+itemName+'">');
}

/**
 * dialog，刪除資料
 * @param itemID
 * @param itemMethod
 * @param itemName
 */
function deleteData(itemID, itemMethod, itemName) {
    $('#submitType').val(itemMethod);
    $('#submitID').val(itemID);
    modal_btn('請確認是否刪除 <font color="red">'+itemName+'</font>');
}

/**
 * 送出資料，
 */
function modal_OK(){
    Loading();
    var method = '';
    var url = '';
    var data = [];
    switch($('#submitType').val()){
            // 新增訂單來源
        case '1':
            method = 'POST';
            url = 'order_source';
            data = {'name' : $('#submitName').val()};
            break;

            // 更新訂單來源
        case '2':
            method = 'PUT';
            url = 'order_source';
            data = {'id' : $('#submitID').val(),'name' : $('#submitName').val()};
            break;

            // 刪除訂單來源
        case '3':
            method = 'DELETE';
            url = 'order_source';
            data = {'id' : $('#submitID').val()};
            break;

            // 新增寄送方式
        case '4':
            method = 'POST';
            url = 'shipping_method';
            data = {'name' : $('#submitName').val()};
            break;

            // 更新寄送方式
        case '5':
            method = 'PUT';
            url = 'shipping_method';
            data = {'id' : $('#submitID').val(),'name' : $('#submitName').val()};
            break;

            // 刪除寄送方式
        case '6':
            method = 'DELETE';
            url = 'shipping_method';
            data = {'id' : $('#submitID').val()};
            break;
    }

    $.ajax({
        url: apiUrl + '/setting/' + url,
        method: method,
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'Api-Token': $.cookie('invoicing_token')
        },
        dataType: 'json',
        async: false,
        data: data,
        success: function (data) {
            console.log(data);
            if(data.error_code == '1'){
                //location.href='setting.html?msg=1';

                $("#modalButton").modal("hide")

                getShippingMethod();
                getOrderSource();

                alert_msg('執行成功。');
            }else{
                alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            }

            UnLoading();
        },
        error: function (data) {
            console.log(data);
            alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}
