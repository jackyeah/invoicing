/**
 * Created by dev on 2018/1/11.
 */
$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    }).val(getToday());

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

function addProduct() {
    if ($('#itemName').val() != '') {
        var index = parseInt($('#productIndex').val()) + 1;
        var info = '<tr id="product' + index + '"> <td>' + $('#itemName option:selected').text() +
            '<input name="productID" type="hidden" value="' + $('#itemName option:selected').val() + '"></td> <td>' +
            '<input type="text" class="form-control" name="productQuantity" id="productQuantity' + index + '" placeholder="數量" value=""></td> <td>' +
            '<input type="text" class="form-control" name="productPrice" id="productPrice' + index + '" placeholder="售價" value="">' +
            '</td><td><span class="glyphicon glyphicon-remove" aria-hidden="true" style="float:right; color:red; cursor: pointer;" onclick="delProductDetail(' + index + ')"></span></td></tr>';

        $('#productInformation').append(info);

        $('#productIndex').val(index);
    }
}

function delProductDetail(index) {
    $('#product' + index).remove();
}

function saveData() {
    var msg = '';
    var p_msg = false;
    var Date = $('#Date').val();
    var orderSource = $('#orderSource').val();
    var Transport = $('#Transport').val();

    if(Date == ''){
        msg += "日期，請勿為空。<br />";
    }

    if(orderSource == ''){
        msg += "訂單來源，請勿為空。<br />";
    }

    if(Transport == ''){
        msg += "出貨方式，請勿為空。<br />";
    }

    var productID = [];
    var k = 1;
    $("input[name='productID']").each(function() {
        if($(this).val() == ''){
            p_msg = true;
        }
        productID.push($(this).val());
        k++;
    });

    if(productID.length < 1){
        msg += "產品資料，請至少加入一項。<br />";
    }else{
        var productQuantity = [];
        var i = 1;
        $("input[name='productQuantity']").each(function() {
            if($(this).val() == ''){
                p_msg = true;
            }
            productQuantity.push($(this).val());
            i++;
        });

        var productPrice = [];
        var j = 1;
        $("input[name='productPrice']").each(function() {
            if($(this).val() == ''){
                p_msg = true;
            }
            productPrice.push($(this).val());
            j++;
        });

        if(p_msg){
            msg += "產品資料，請勿遺漏。<br />";
        }
    }

    if(msg == ''){
        $('.modal-footer').show();
        modal_btn('請確認是否送出。');
    }else{
        modal_btn(msg);
    }
}

function modal_OK() {
    $('.modal-footer').hide();
    modal_btn('已成功儲存資料。');
}