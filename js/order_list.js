/**
 * Created by dev on 2018/2/10.
 */
$(function() {
    Loading();
    $('#EndDate').datetimepicker({
        format: 'YYYY/MM/DD'
    }).val(getToday());

    $('#StartDate').datetimepicker({
        format: 'YYYY/MM/DD'
    }).val(getOneWeekAgo());

    $("#nowPTitle").text('我要出貨').after("<li>查閱訂單</li>");

    //console.log($.cookie('invoicing_token'));

    getOrderList();

    UnLoading();
});

function getOrderList() {
    Loading();
    $.ajax({
        url: apiUrl + '/shipping',
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
            'startDate': $('#StartDate').val(),
            'endDate': $('#EndDate').val()
        },
        success: function (data) {
            if (data.error_code == '1' && parseInt(data.result.length) > 0) {
                var result = data.result;
                var DataList = $('#DataList').DataTable();
                DataList.clear();
                for (var i = 0; i < parseInt(result.length); i++) {

                    var detail = '';
                    detail += '<span class="glyphicon glyphicon-plus" aria-hidden="true" style="color: #b3d271; cursor: pointer;" title="展開" onclick="$(\'#productDetail' + i + '\').show()"></span><span>';
                    for (var j = 0; j < parseInt(result[i].product_detail.length); j++) {
                        console.log(result[i].product_detail[j]);
                        if (j == 0) {
                            detail += result[i].product_detail[j].name + '(' + result[i].product_detail[j].style + ') * ' + result[i].product_detail[j].quantity;
                        } else {
                            detail += '<div id="productDetail' + i + '" style="display: none; padding-left: 17px;">';
                            detail += result[i].product_detail[j].name + '(' + result[i].product_detail[j].style + ') * ' + result[i].product_detail[j].quantity;
                            detail += '</div></span>';
                        }
                    }
                    DataList.row.add([
                        detail,
                        result[i].order_source_name,
                        result[i].shipping_method_name,
                        result[i].date + '/' + result[i].total_price,
                        result[i].profit,
                        '<button type="button" class="btn btn-success" onclick="editPurchaseModal(' + result[i].id + ')">編輯</button> ' +
                        '<button type="button" class="btn btn-danger" onclick="deletePurchaseModal(' + result[i].id + ')">刪除</button>'
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