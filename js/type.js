$(function() {
    $( ".edit" ).click(function() {
	  	$( this ).parent().parent().parent().find(".info").hide();
	  	$( this ).parent().parent().parent().find(".input").show();
	});

    $( ".cnl" ).click(function() {
	  	$( this ).parent().parent().parent().find(".input").hide();
	  	$( this ).parent().parent().parent().find(".info").show();
	});
});

function gotoADD(){
	var newData = "<tr id='tr_new'><td><input type='text' value='' class='form-control'></td><td><button type='button' class='btn btn-primary'>儲存</button> <button type='button' class='btn btn-warning' onclick='cancelADD()'>取消</button></td></tr>"
	//$("#DataBody").prepend(newData);
	$("#tr_new").show();
	$(".btn-success").hide();
}

function cancelADD(){
	$("#tr_new").hide();
	$("#name_tw_0,#name_cn_0,#name_en_0").val('');
    $(".btn-success").show();
}

function delData(id){
	if(parseInt($("#Count" + id).text()) > 0) {
		modal_msg("該類別有子項目，無法刪除。");
	}else{
		$("#dID").val(id);
		modal_btn("請確認是否刪除。");
	}
}

function modal_OK(){
	updData($("#dID").val(),'D');
}