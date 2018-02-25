/**
 * Created by dev on 2018/1/19.
 */
$(function() {
    $("#nowPTitle").text('我要進貨').after("<li>查看進貨紀錄</li>");

    $.fn.dataTable.ext.errMode = 'none';
    getPurchaseList();

    if($.getUrlParam('msg') == "1"){
        alert_msg('進貨成功。');
    }else if($.getUrlParam('msg') == "2"){
        alert_msg('補貨成功。');
    }
});

/**
 * 查看進貨紀錄
 */
function getPurchaseList() {
    Loading();
    $.ajax({
        url: apiUrl + '/purchase',
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
            console.log(data);

            if(data.error_code == '1') {
                var result = data.result;
                var DataList = $('#DataList').DataTable();
                DataList.clear();
                for (var i = 0; i < parseInt(result.length); i++) {
                    DataList.row.add([
                        '<button type="button" class="btn btn-success" onclick="editPurchaseModal(\'' + result[i].purchase_id + '\',\'' + result[i].name + ' - ' + result[i].style +  '\',\'' + result[i].purchase_time + '\',\'' + result[i].quantity + '\')">編輯</button> ' +
                        '<button type="button" class="btn btn-danger" onclick="deletePurchaseModal(\'' + result[i].purchase_id + '\',\'' + result[i].name + ' - ' + result[i].style + '\')">刪除</button>',
                        result[i].purchase_time,
                        result[i].name,
                        result[i].style,
                        result[i].quantity,
                        result[i].coast
                    ]).draw(false);
                }
            }

            UnLoading();
        },
        error: function (data) {
            if(data.status == "401"){
                location.href = 'index.html?msg=1';
            }
            console.log(data);
            modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}

/**
 * dialog，編輯進貨紀錄
 * @param itemID
 * @param itemName
 * @param itemDate
 * @param itemQuantity
 */
function editPurchaseModal(itemID, itemName, itemDate, itemQuantity) {
    $('#dataID').val(itemID);
    $('#dataName').text(itemName);
    $('#dataDate').empty().prop('placeholder', itemDate);
    $('#dataCount').empty().prop('placeholder', itemQuantity);
    $('#modalEdit').modal();
}

/**
 * 編輯進貨紀錄
 */
function editPurchase() {
    var dataID = $('#dataID').val();
    var dataDate = $('#dataDate').val();
    var dataCount = $('#dataCount').val();
    var msg = '';

    if(dataDate == ''){
        msg += "<span style='color: red;'>請輸入進貨日期。</span><br />";
    }

    if(dataCount == ''){
        msg += "<span style='color: red;'>請輸入進貨數量。</span><br />";
    }

    if(msg == ''){
        $.ajax({
            url: apiUrl + '/purchase/data',
            method: 'PUT',
            xhrFields: {
                withCredentials: true
            },
            headers: {
                'Api-Token': $.cookie('invoicing_token')
            },
            dataType: 'json',
            async: false,
            data: {
                'id' : dataID,
                'date' : dataDate,
                'quantity' : dataCount
            },
            success: function (data) {
                console.log(data);
                if(data.error_code == '1'){
                    getPurchaseList();
                    alert_msg('編輯成功');
                }else{
                    alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
                }

                UnLoading();
                $('#modalEdit').modal('hide');
            },
            error: function (data) {
                if(data.status == "401"){
                    location.href = 'index.html?msg=1';
                }
                console.log(data);
                alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
                UnLoading();
            }
        });
    }else{
        $('#modalEditBody').append(msg);
    }
}

/**
 * dialog，刪除進貨紀錄
 * @param itemName
 */
function deletePurchaseModal(itemID, itemName) {
    $('#deleteID').val(itemID);
    $('#modalButtonBody').html('請確認是否刪除此進貨紀錄<br>名稱：' + itemName);
    $('#modalButton').modal();
}

/**
 * 刪除進貨紀錄
 */
function modal_OK() {
    $.ajax({
        url: apiUrl + '/purchase/data',
        method: 'DELETE',
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'Api-Token': $.cookie('invoicing_token')
        },
        dataType: 'json',
        async: false,
        data: {
            'id':$('#deleteID').val()
        },
        success: function (data) {
            console.log(data);
            if(data.error_code == '1'){
                getPurchaseList();
                alert_msg('刪除成功');
            }else{
                alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            }

            UnLoading();
            $('#modalButton').modal('hide');
        },
        error: function (data) {
            if(data.status == "401"){
                location.href = 'index.html?msg=1';
            }
            console.log(data);
            alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}