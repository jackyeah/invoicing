$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    });

    $("#nowPTitle").text('我要進貨').after("<li>進貨新產品</li>");

    //console.log($.cookie('invoicing_token'));

    getManufacturers();

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
    $('#div_ColorCount').append('<div class="form-group"> <label>顏色款式</label> <input type="text" class="form-control" name="other" placeholder="顏色款式" value=""> </div> <div class="form-group"> <label>數量</label> <input type="text" class="form-control" name="quantity" placeholder="數量" value=""> </div>');
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
    }

    if(coast == ''){
        msg += "成本，請勿為空。<br />";
    }

    if(price == ''){
        msg += "售價，請勿為空。<br />";
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
        }
        quantity.push($(this).val());
        j++;
    });

    if(msg == ''){
        modal_btn('OK');
    }else{
        modal_btn(msg);
    }
}