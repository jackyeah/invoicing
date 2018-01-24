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

    getInventoryList();

    UnLoading();
});

/**
 * 取得訂單來源清單
 */
function getOrderSource(){
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
                    $('#orderSource').append($('<option>', {
                        value: result[i].id,
                        text: result[i].name
                    }));
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
function getShippingMethod(){
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
                    $('#Transport').append($('<option>', {
                        value: result[i].id,
                        text: result[i].name
                    }));
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
 * 取得庫存清單
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

            if(data.error_code == '1'){
                var result = data.result;
                for (var i = 0; i < parseInt(result.length); i++) {
                    $('#itemName').append($('<option>', {
                        value: result[i].id,
                        text: result[i].name + ' - ' + result[i].style + ' (' + result[i].item_no + ')',
                        'data-coast': result[i].coast ,
                        'data-price': result[i].price ,
                        'data-quality': result[i].quality
                    }));
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

/**
 * 增加要出貨的產品
 */
function addProduct() {
    if ($('#itemName').val() != '') {
        console.log($('#itemName option:selected')[0].dataset);
        var index = parseInt($('#productIndex').val()) + 1;
        var info = '<tr id="product' + index + '"> <td>' + $('#itemName option:selected').text() +
            '<input name="productID" type="hidden" value="' + $('#itemName option:selected').val() + '"></td> <td>' +
            '<input type="text" class="form-control" name="productQuantity" id="productQuantity' + index + '" placeholder="庫存數量為：'+$('#itemName option:selected')[0].dataset.quality+'" value=""></td> <td>' +
            '<input type="text" class="form-control" name="productPrice" id="productPrice' + index + '" placeholder="預計售價為：'+$('#itemName option:selected')[0].dataset.price+'" value="">' +
            '</td><td><span class="glyphicon glyphicon-remove" aria-hidden="true" style="float:right; color:red; cursor: pointer;" onclick="delProductDetail(' + index + ')"></span></td></tr>';

        $('#productInformation').append(info);

        $('#productIndex').val(index);
    }
}

/**
 * 刪除要出貨的產品
 * @param index
 */
function delProductDetail(index) {
    $('#product' + index).remove();
}

/**
 * dialog，出貨
 */
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

/**
 * 出貨
 */
function modal_OK() {
    $('.modal-footer').hide();
    modal_btn('已成功儲存資料。');
}