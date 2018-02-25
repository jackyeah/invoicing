/**
 * Created by dev on 2018/1/19.
 */
$(function() {
    $("#nowPTitle").text('庫存').after("<li>庫存清單</li>");

    $.fn.dataTable.ext.errMode = 'none';
    getInventoryList();
});

/**
 * 庫存清單
 */
function getInventoryList() {
    Loading();
    $.ajax({
        url: apiUrl + '/inventory',
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

            if (data.error_code == '1') {
                var result = data.result;
                var DataList = $('#DataList').DataTable();
                for (var i = 0; i < parseInt(result.length); i++) {
                    DataList.row.add([
                        result[i].name,
                        result[i].item_no,
                        result[i].coast,
                        result[i].price,
                        result[i].style,
                        result[i].quality,
                        '<button type="button" class="btn btn-success" onclick="dataWindow(' + result[i].id + ')">編輯</button>'
                    ]).draw(false);
                }
            }

            UnLoading();
        },
        error: function (data) {
            if (data.status == "401") {
                location.href = 'index.html?msg=1';
            }
            modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}

function dataWindow(id) {
    $('#modalData').modal();
}