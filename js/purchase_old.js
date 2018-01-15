$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    }).val(getToday());

    $("#nowPTitle").text('我要進貨').after("<li>舊商品補貨</li>");

    //console.log($.cookie('invoicing_token'));

    $('#searchText').select2({
        maximumSelectionLength: 1
    });

    UnLoading();
});

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
    $('.modal-footer').hide();
    modal_btn('OK');
}