/**
 * Created by dev on 2018/1/19.
 */
$(function() {
    $("#nowPTitle").text('庫存').after("<li>安全庫存清單</li>");

    $.fn.dataTable.ext.errMode = 'none';
    getSafeInventoryList();
});

/**
 * 取得安全庫存清單
 */
function getSafeInventoryList() {
    var subtraction = $('#itemName').val();
    if(subtraction == ''){
        subtraction = 0;
    }
    Loading();
    $.ajax({
        url: apiUrl + '/inventory/safe',
        method: 'GET',
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'Api-Token': $.cookie('invoicing_token')
        },
        dataType: 'json',
        async: false,
        data: {
            'subtraction': subtraction
        },
        success: function (data) {
            console.log(data);

            if(data.error_code == '1'){
                var result = data.result;
                var DataList = $('#DataList').DataTable();
                DataList.clear();
                for (var i = 0; i < parseInt(result.length); i++) {
                    DataList.row.add([
                        result[i].name,
                        result[i].item_no,
                        result[i].style,
                        result[i].quality,
                        result[i].safety_stock,
                        '<button type="button" class="btn btn-success">編輯</button>'
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
