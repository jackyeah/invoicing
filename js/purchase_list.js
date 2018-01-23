/**
 * Created by dev on 2018/1/19.
 */
$(function() {
    $("#nowPTitle").text('我要進貨').after("<li>查看進貨紀錄</li>");

    $.fn.dataTable.ext.errMode = 'none';
    getPurchaseList();
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

            if(data.error_code == '1'){
                var result = data.result;
                var DataList = $('#DataList').DataTable();
                for (var i = 0; i < parseInt(result.length); i++) {
                    DataList.row.add([
                        '<button type="button" class="btn btn-success">編輯</button> <button type="button" class="btn btn-danger">刪除</button>',
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
            console.log(data);
            modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}

function editPurchase() {

}

function deletePurchase(itemName) {
    $('.modal-body').html('請確認是否刪除此進貨紀錄<br>名稱：' + itemName);
}