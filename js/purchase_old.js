$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    }).val(getToday());

    $("#nowPTitle").text('我要進貨').after("<li>舊商品補貨</li>");

    getDataList();

    $('#searchText').change(function (){
        var optionSelected = $("option:selected", this);
        console.log(optionSelected.val());
        console.log(optionSelected[0].dataset.coast);
        console.log(optionSelected[0].dataset.quality);


        if(optionSelected.val() == ''){
            $('#coast').empty().prop('placeholder', '成本');
            $('#quantity').empty().prop('placeholder', '數量');
        }else{
            $('#coast').empty().prop('placeholder', '目前成本為: ' + optionSelected[0].dataset.coast + ' 元');
            $('#quantity').empty().prop('placeholder', '目前數量為: ' + optionSelected[0].dataset.quality + ' 個');
        }
    });

    UnLoading();
});

function getDataList() {
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
            if(data.error_code == '1'){
                var result = data.result;
                var DataList = $('#DataList').DataTable();
                for (var i = 0; i < parseInt(result.length); i++) {
                    $('#searchText').append($('<option>', {
                        value: result[i].id,
                        text: result[i].name + ' - ' + result[i].style + ' (' + result[i].item_no +  ')',
                        'data-coast': result[i].coast ,
                        'data-quality': result[i].quality
                    }));
                }
            }

            UnLoading();
        },
        error: function (data) {
            if(data.status == "401"){
                location.href = 'index.html?msg=1';
            }
            alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}

function checkDetail() {
    $('#dataName').text($('#searchText  option:selected').text());
    $('#dataProduct').val($('#searchText').val());
    $('#dataDate').text($('#Date').val());
    $('#dataCoast').text($('#coast').val());
    $('#dataCount').text($('#quantity').val());
}

function saveData() {
    var itemProduct = $('#dataProduct').val();
    var itemDate = $('#dataDate').text();
    var itemCoast = $('#dataCoast').text();
    var itemCount = $('#dataCount').text();
    var msg = '';

    if(itemProduct == ''){
        msg += "請選擇一項產品進行補貨。<br />";
    }

    if(itemDate == ''){
        msg += "請輸入進貨日期。<br />";
    }

    if(itemCoast == ''){
        msg += "請輸入進貨成本。<br />";
    }

    if(itemCount == ''){
        msg += "請輸入進貨數量。<br />";
    }

    if(msg == ''){
        $('.modal-footer').show();
        modal_btn('請確認是否送出');
    }else{
        $('.modal-footer').hide();
        modal_btn(msg);
    }
}

function modal_OK() {
    var sss = {
        'id' : $('#searchText').val(),
        'date' : $('#Date').val(),
        'quantity' : $('#quantity').val(),
        'coast' : $('#coast').val()
    };


    $.ajax({
        url: apiUrl + '/purchase',
        method: 'PUT',
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'Api-Token': $.cookie('invoicing_token')
        },
        dataType: 'json',
        async: false,
        data: {
            'id' : $('#searchText').val(),
            'date' : $('#Date').val(),
            'quantity' : $('#quantity').val(),
            'coast' : $('#coast').val()
        },
        success: function (data) {
            console.log(data);
            if(data.error_code == '1'){
                location.href = 'purchase_list.html?msg=2';
            }else{
                alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            }

            UnLoading();
        },
        error: function (data) {
            if(data.status == "401"){
                location.href = 'index.html?msg=1';
            }
            console.log(data);
            alert_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
            UnLoading();
        }
    });
}