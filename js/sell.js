/**
 * Created by dev on 2018/1/11.
 */
$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    });

    $("#nowPTitle").text('賣出產品');

    //console.log($.cookie('invoicing_token'));

    getOrderSource();

    getShippingMethod();

    UnLoading();
});

function getOrderSource(){
    $('#orderSource').append($('<option>', {value: 1, text: '蝦皮'}));
    $('#orderSource').append($('<option>', {value: 2, text: '露天'}));
    /*$.ajax({
     url: apiUrl + '/backend/manufacturers',
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
     if (data.error_code == '1') {
     var result = data.result;
     if (parseInt(result.length) > 0) {
     for (var i = 0; i < parseInt(result.length); i++) {
     $('#Manufacturers').append($('<option>', {
     value: result[i].id,
     text: result[i].name
     }));
     }
     }
     }
     },
     error: function (data) {
     console.log(data);
     modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
     }
     });*/
}

function getShippingMethod(){
    $('#Transport').append($('<option>', {value: 1, text: '全家-貨到付款'}));
    $('#Transport').append($('<option>', {value: 2, text: '7-11-貨到付款'}));
    /*$.ajax({
     url: apiUrl + '/backend/manufacturers',
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
     if (data.error_code == '1') {
     var result = data.result;
     if (parseInt(result.length) > 0) {
     for (var i = 0; i < parseInt(result.length); i++) {
     $('#Manufacturers').append($('<option>', {
     value: result[i].id,
     text: result[i].name
     }));
     }
     }
     }
     },
     error: function (data) {
     console.log(data);
     modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
     }
     });*/
}

function getProduct() {
    $('#schResult').html($('#itemName').val()).show();
    $('#btnAdd, #btnDel').show();
}

function addProduct() {
    var index = parseInt($('#productIndex').val()) + 1;

    var info = '<div id="product' + index + '" class="col-xs-6"><div class="panel panel-info"> <div class="panel-heading">';
    info += $('#schResult').text();
    info += '<span class="glyphicon glyphicon-remove" aria-hidden="true" style="float:right; color:red; cursor: pointer;" onclick="delProductDetail(' + index + ')"></span></div>';
    info += '<div class="panel-body">';
    info += '<div class="form-group">';
    info += '<label for="productColor' + index + '">顏色款式</label>';
    info += '<select id="productColor' + index + '" class="form-control">';
    info += '<option value="0">請選擇</option>';
    info += '</select>';
    info += '</div>';
    info += '<div class="form-group">';
    info += '<label for="productQuantity' + index + '' + index + '">數量</label>';
    info += '<input type="text" class="form-control" id="productQuantity' + index + '" placeholder="數量" value="">';
    info += '</div>';
    info += '<div class="form-group">';
    info += '<label for="productPrice' + index + '' + index + '">售價</label>';
    info += '<input type="text" class="form-control" id="productPrice' + index + '" placeholder="售價" value="">';
    info += '</div>';
    info += '</div> </div></div>';

    $('#productInformation').append(info);

    $('#productIndex').val(index);
    $('#schResult, #btnAdd, #btnDel').hide();
}

function delProduct() {
    $('#schResult, #btnAdd, #btnDel').hide();
}

function delProductDetail(index) {
    $('#product' + index).remove();
}