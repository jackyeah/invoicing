$(function() {
    Loading();
    $('#Date').datetimepicker({
        format: 'YYYY/MM/DD'
    });

    $("#nowPTitle").text('最新報導').after("<li>新增最新報導</li>");
    $('#subTitle').text('新增最新報導');
    UnLoading();
});