$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    }).val(getToday());

    $("#nowPTitle").text('我要進貨').after("<li>進貨新產品</li>");

    //console.log($.cookie('invoicing_token'));

    UnLoading();
});

/**
 * ajax - 取得訂貨廠商資料
 */
function getManufacturers(){
    $('#Manufacturers').append($('<option>', {value: 1, text: 'NIKE'}));
    $('#Manufacturers').append($('<option>', {value: 2, text: 'ADIDAS'}));
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

/**
 * 增加要進貨的產品
 */
function addCount() {
    var count = parseInt($('#count').val()) + 1;


    var html = '<ul class="list-group" id="colorCount' + count + '"><li class="list-group-item form-group form-inline">' +
        '<a href="javascript:void(1);" onclick="delCount(' + count + ')">' +
        '<span class="glyphicon glyphicon-minus-sign" style="color: red !important; margin-right: 10px; font-size: 20px; vertical-align: middle;" aria-hidden="true"></span></a>' +
        '<label>貨號(' + count + ')</label>&nbsp;' +
        '<input type="text" class="form-control" name="item" placeholder="請輸入英文數字" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
        '<label>顏色款式(' + count + ')</label>&nbsp;' +
        '<input type="text" class="form-control" name="other" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
        '<label>數量(' + count + ')</label>&nbsp;' +
        '<input type="text" class="form-control" name="quantity" placeholder="請輸入數字" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
        '<div class="checkbox3 checkbox-round" style="display: inline-block;">' +
        '<input type="checkbox" id="safeSetting_' + count + '" class="safeSetting" value="' + count + '"  onclick="safeQuantity(' + count + ')">' +
        '<label for="safeSetting_' + count + '">設定安全庫存(' + count + ')</label></div>' +
        '<input type="text" class="form-control safeQuantity" name="safeQuantity" id="safeQuantity_' + count + '" placeholder="請輸入安全庫存數量" style="display:none;" value="">' +
        '</li></ul>';


    $('#div_ColorCount').append(html);
    $('#count').val(count);
}

/**
 * 刪除要進貨的產品
 * @param index
 */
function delCount(index) {
    $('#colorCount' + index).remove();
}

/**
 * 顯示安全庫存的輸入框
 * @param index
 */
function safeQuantity(index) {
    if($('#safeSetting_' + index).prop('checked')){
        $('#safeQuantity_' + $('#safeSetting_' + index).val()).show();
    }else{
        $('#safeQuantity_' + $('#safeSetting_' + index).val()).val('').hide();
    }
}

/**
 * 儲存資料，確認
 */
function saveData() {
    var msg = '';
    var Date = $('#Date').val();
    var Manufacturers = $('#Manufacturers').val();
    var Remark = $('#Remark').val();
    var itemName = $('#itemName').val();
    var coast = $('#coast').val();
    var price = $('#price').val();

    if(Date == ''){
        msg += "日期，請勿為空。<br />";
    }

    if(Manufacturers == '0'){
        msg += "廠商，請勿為空。<br />";
    }

    if(itemName == ''){
        msg += "商品名稱，請勿為空。<br />";
    }

    if(coast == ''){
        msg += "成本，請勿為空。<br />";
    }else{
        if(chkNum(coast)){
            msg += "成本，請輸入數字。<br />";
        }
    }

    if(price == ''){
        msg += "售價，請勿為空。<br />";
    }else{
        if(chkNum(price)){
            msg += "售價，請輸入數字。<br />";
        }
    }

    var item = [];
    var k = 1;
    $("input[name='item']").each(function() {
        if($(this).val() == ''){
            msg += "貨號(" + k +  ")，請勿為空。<br />";
        }else{
            if(chkEngNum($(this).val())){
                msg += "貨號(" + k +  ")，請勿輸入英數以外的字元。<br />";
            }
        }
        item.push($(this).val());
        k++;
    });

    var other = [];
    var i = 1;
    $("input[name='other']").each(function() {
        if($(this).val() == ''){
            msg += "顏色款式(" + i +  ")，請勿為空。<br />";
        }
        other.push($(this).val());
        i++;
    });

    var quantity = [];
    var j = 1;
    $("input[name='quantity']").each(function() {
        if($(this).val() == ''){
            msg += "數量(" + j +  ")，請勿為空。<br />";
        }else{
            if(chkNum($(this).val())){
                msg += "數量(" + j +  ")，請輸入數字。<br />";
            }
        }

        quantity.push($(this).val());
        j++;
    });

    var safe = [];
    var m = 1;
    $("input[name='safeQuantity']").each(function() {
        var safe_value = "0";
        if($('#safeSetting_' + m).prop('checked')) {
            if ($(this).val() == '') {
                msg += "安全庫存數量(" + m + ")，請勿為空。<br />";
            } else {
                if (chkNum($(this).val())) {
                    msg += "安全庫存數量(" + m + ")，請輸入數字。<br />";
                }else{
                    safe_value = $(this).val();
                }
            }
        }

        safe.push(safe_value);
        m++;
    });

    var purchaseDetail = '[';
    for(var l=0;l<=j-2;l++) {
        purchaseDetail += '{"item_no":"' + item[l] + '","style":"' + other[l] + '","quality":"' + quantity[l] + '","safety_stock":"' + safe[l] + '"},';
    }
    purchaseDetail = purchaseDetail.substring(0,purchaseDetail.length-1);
    purchaseDetail += ']';

    if(msg == ''){
        $('#submit_date').val(Date);
        $('#submit_manufacturers').val(Manufacturers);
        $('#submit_remark').val(Remark);
        $('#submit_name').val(itemName);
        $('#submit_coast').val(coast);
        $('#submit_price').val(price);
        $('#submit_purchaseDetail').val(purchaseDetail);

        $('.modal-footer').show();
        modal_btn('請確認是否送出。');
    }else{
        modal_btn(msg);
    }
}

/**
 * ajax - 儲存資料，送出
 */
function modal_OK() {
    console.log($('#submit_purchaseDetail').val());

    $.ajax({
        url: apiUrl + '/purchase',
        method: 'POST',
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'Api-Token': $.cookie('invoicing_token')
        },
        dataType: 'json',
        async: false,
        data: {
            'date' : $('#submit_date').val(),
            'manufacturers' : $('#submit_manufacturers').val(),
            'remark' : $('#submit_remark').val(),
            'name' : $('#submit_name').val(),
            'coast' : $('#submit_coast').val(),
            'price' : $('#submit_price').val(),
            'purchaseDetail' : $('#submit_purchaseDetail').val()
        },
        success: function (data) {
            console.log(data);
            $('.modal-footer').hide();

            if(data.error_code == '1'){
                //modal_btn('已成功儲存資料。');
                location.href = 'purchase_list.html?msg=1';
            }else{
                modal_btn('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            }
        },
        error: function (data) {
            if(data.status == "401"){
                location.href = 'index.html?msg=1';
            }
            console.log(data);
            modal_btn('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
        }
    });
}