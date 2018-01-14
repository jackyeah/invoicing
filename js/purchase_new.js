$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    }).val(getToday());

    $("#nowPTitle").text('我要進貨').after("<li>進貨新產品</li>");

    //console.log($.cookie('invoicing_token'));

    UnLoading();
});

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

function addCount() {
    var count = parseInt($('#count').val()) + 1;


    var html = '<ul class="list-group" id="colorCount' + count + '"><li class="list-group-item form-group form-inline">' +
        '<a href="javascript:void(1);" onclick="delCount(' + count + ')">' +
        '<span class="glyphicon glyphicon-minus-sign" style="color: red !important; margin-right: 10px; font-size: 20px; vertical-align: middle;" aria-hidden="true"></span></a>' +
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

function delCount(index) {
    $('#colorCount' + index).remove();
}

function safeQuantity(index) {
    if($('#safeSetting_' + index).prop('checked')){
        $('#safeQuantity_' + $('#safeSetting_' + index).val()).show();
    }else{
        $('#safeQuantity_' + $('#safeSetting_' + index).val()).val('').hide();
    }
}

function saveData() {
    var msg = '';
    var Date = $('#Date').val();
    var Manufacturers = $('#Manufacturers').val();
    var Remark = $('#Remark').val();
    var itemName = $('#itemName').val();
    var itemNo = $('#itemNo').val();
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

    if(itemNo == ''){
        msg += "商品貨號，請勿為空。<br />";
    }else{
        if(chkEngNum(itemNo)){
            msg += "商品貨號，請勿輸入英數以外的字元。<br />";
        }
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

function getToday() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    today = yyyy + '/' + mm + '/' + dd;
    return today;
}