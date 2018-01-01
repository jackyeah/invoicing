$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    });

    $("#nowPTitle").text('我要進貨').after("<li>進貨新產品</li>");
    $('#subTitle').text('進貨新產品');

    console.log($.cookie('invoicing_token'));

    getManufacturers();

    UnLoading();
});

function getManufacturers(){
    $.ajax({
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
                        $('#Ｍanufacturers').append($('<option>', {
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
    });


}