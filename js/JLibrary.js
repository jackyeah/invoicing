var apiUrl = 'http://invoicing-api.com';



//使IE也能使用indexOf
if(!Array.indexOf)
{
	Array.prototype.indexOf = function(obj)
	{
		for(var i=0; i<this.length; i++)
		{
			if(this[i]==obj)
			{
				return i;
			}
		}
	return -1;
	}
}

function alert_msg(msg){
	$("#alertMsg").text(msg);
	$("#alertDIv").slideDown();
	setTimeout(function() {
      $("#alertDIv").slideUp();
    }, 10000);
}

function modal_msg(msg){
	$(".modal-body").html(msg);
	$("#modalMsg").modal();
}

function modal_btn(msg){
	$(".modal-body").html(msg);
	$("#modalButton").modal();
}

/* 檢查字串有無包含str，整串檢查
   用來篩檢特殊字元
*/
function contain(str,charset){
	var i;
	for(i=0;i<charset.length;i++)
	if(str.indexOf(charset.charAt(i))>=0)
	return true;
	return false;
}

//去除頭尾空白
function Trim(str) {
	var start = -1,
	end = str.length;
	while (str.charCodeAt(--end) < 33);
	while (str.charCodeAt(++start) < 33);
	return Spc_Replace(str.slice(start, end + 1));
}

//輔助Trim，去除頭尾全型空白
function Spc_Replace(Str){
	Str= Str.replace(/(:?^　+|　+$)/, '');
	return Str;
}

//將日期格式 YYYY-MM-DD HH:II:SS 轉變為 YYYYMMDDHHIISS
function DateFilter(Dt){
	var chgDt = Dt;
	chgDt = chgDt.replace(" ","");
	chgDt = chgDt.replace("-","");
	chgDt = chgDt.replace(":","");
	chgDt = chgDt.replace("-","");
	chgDt = chgDt.replace(":","");
	return(chgDt);
}

//勾選所有的checkbox
function SelectAll(id){
	$("input:checkbox[id*=" + id + "]").attr("checked","checked");
}

//取消勾選所有的checkbox
function SelectNone(id){
	$("input:checkbox[id*=" + id + "]").removeAttr("checked");
}

//取得所有checkbox的值，並區隔開
function getChkVal(Name,Interval){
	var Str = "";
	$("input[name^=" + Name + "]:checked").each(function ()
	{
		Str += $(this).val() + Interval;
	});
	Str = Str.substring(0,Str.length-1);
	return Str;
}

//檢測是否有非英文數字的字串，若有，回傳true
function chkEngNum(str){
	re = /\W/;
	if(re.test(str))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//檢測是否非email格式，若不是，回傳true
function chkEmail(str){
	var regExp = /^[^@^\s]+@[^\.@^\s]+(\.[^\.@^\s]+)+$/;
	if(!str.match(regExp))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//檢測是否非數字，若不是，回傳true
function chkNum(str){
	var re = /\D/;
	if(re.test(str))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//treegrid load msg
function Loading(id){
	if (typeof id=="undefined"){
		$.blockUI({
			message: '<h5>Loading...</h5>' ,
			css: { border: '2px solid #95B8E7' } ,
			overlayCSS: { backgroundColor: '#333' } });
	}
	else{
		$("#"+id).block({
			message: '<h1>Loading...</h1>' ,
			css: { border: '2px solid #95B8E7' } ,
			overlayCSS: { backgroundColor: '#fff' }
		});
	}
}

//close treegrid load msg
function UnLoading(id){
	if (typeof id=="undefined"){
		$.unblockUI();
	}
	else{
		$("#"+id).unblock();
	}
}

function popMsg(str, type){
    if (type == ''){ type = "notice"; }
    str = str.replace(/<br \/>/g, "\n");
    $("#freeow").freeow('', str, { classes: ["gray", type] });
}

function logoutFun() {
    $("#logoutDialog").fbdialog({
                title: "登出",
                cancel: "取消",
                okay: "登出",
                okaybutton: true,
                cancelbutton: true,
                buttons: true,
                opacity: 0.0,
                dialogtop: ""
    },function(callback) {
            if (callback == 1) {
                location.href = "mk.php?fp=logout";
            }
    });
}

function chgMenu(no){

}

function myformatter(date){
    var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}

function myparser(s){
    if (!s) return new Date();
    var ss = (s.split('-'));
    var y = parseInt(ss[0],10);
    var m = parseInt(ss[1],10);
    var d = parseInt(ss[2],10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
        return new Date(y,m-1,d) ;
    } else {
        return new Date()  ;
    }
}

function getToday() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '/' + mm + '/' + dd;
    return today;
}

function getOneWeekAgo() {
    var now = new Date;
    var str = "";
    var year = "";
    var month = "";
    var day = "";
    for (var i = 0; i < 7; i++) {
        if (i == 6) {
            year = now.getFullYear();
            month = now.getMonth() + 1;
            day = now.getDate();
            str = year + "-" + month + "-" + day;
        }
        now.setDate(now.getDate() - 1);
        nowDate = now.toLocaleDateString();
    }
    return str;
}

// 取得 GET 參數
function GetURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    var result = '';
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam){
            result = sParameterName[1];
            break;
        }
    }
    return result;
}

function ajaxGet(apiName) {
    $.ajax({
        url: apiUrl + '/backend/' + apiName,
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'Api-Token' : $.cookie('invoicing_token')
        },
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(data){
        	return data;
        },
        error: function(data){
            console.log(data);
            modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
        }
    });
}

function ajaxPost(apiName, postData) {

    $.ajax({
        url: Guava_apiUrl + '/admin/' + apiName,
        xhrFields: {
            withCredentials: true
        },
        method: 'POST',
        async: false,
        dataType: 'json',
        data: postData,
        success: function (data) {
            return data;
        },
        error: function(data){
            console.log(data);
            return data;
            UnLoading();
            modal_msg('服務異常，請再度嘗試，若多次出現請聯繫管理員。');
        }
    });
}