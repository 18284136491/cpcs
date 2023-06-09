var time = 0;
var odds = '', closeTime = '';

//限制只能输入1-9纯数字
function digitOnly($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

function endFun() {
    layer.msg('香港六合彩已经封盘，请留意本公司开盘公告！', {
        shade: [0.5, '#fff'],
        time: 0
    });
}

function loadInfo() {
	$.post("class/time_0.php?" + Date.parse(new Date()), function(data) {
		if(data.close > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
            $("#kj_time").html(data.kj_time);
			timer(data.close);
			oddsInfo();
            history(data.kj_list);
		} else {
			$(".bian_td_odds").html("-");
			$(".bian_td_inp").html("封盘");
			endFun();
            history(data.kj_list);
			return false;
		}
	}, "json");
}

function oddsInfo() {
	$.post("odds/6hc.php?" + Date.parse(new Date()), function(data) {
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("封盘");
            return false;
		}
		for(var s = 1; s < 7; s++) {
			for(var s1 = 50; s1 < 65; s1++) {
				var odds = oddslist.ball[s][s1];
				$("#ball_"+s+"_o"+s1).html(odds);
			}
		}
		loadInput();
	}, "json");
	odds = setTimeout("oddsInfo()",5000);
}

function loadInput() {
	var b = "money";
	var n = "下注金额：<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"6\"/>";
	if($("#moneys").html() == '&nbsp;') {
		$("#moneys").html(n);
	}
}

function timer(intDiff) {
    var hour = 0, minute = 0, second = 0; //时间默认值
    if(intDiff > 0){
        hour = Math.floor(intDiff / 3600);
        minute = Math.floor(intDiff / 60) - (hour * 60);
        second = Math.floor(intDiff) - (hour * 60 * 60) - (minute * 60);
    } else {
        clearTimeout(odds);
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
        clearTimeout(closeTime);
        endFun();
    }
    if (hour <= 9) hour = '0' + hour;
    if (minute <= 9) minute = '0' + minute;
    if (second <= 9) second = '0' + second;
    $('#hour_show').html(hour+'&nbsp;时');
    $('#minute_show').html(minute+'&nbsp;分');
    $('#second_show').html(second+'&nbsp;秒');
    intDiff--;
    closeTime = setTimeout("timer("+intDiff+")",1000);
}

function history(list) {
    if(list.length > 0) {
        var ls_kj = '<tr height="30">';
        ls_kj += '<td class="sub" colspan="8">';
        ls_kj += '<a class="cur" href="javascript:void(0);" onclick="changeNumType(\'six\', 0, this);">号码</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 1, this);">生肖</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 2, this);">五行</a>';
        ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'six\', 3, this);">单双</a>';
        ls_kj += '</td></tr>';
        ls_kj += '<tr>';
        ls_kj += '<td width="16%">期号</td><td width="12%">一</td><td width="12%">二</td><td width="12%">三</td><td width="12%">四</td><td width="12%">五</td><td width="12%">六</td><td width="12%">特</td>';
        ls_kj += '</tr>';
        for(var i in list) {
            ls_kj += '<tr class="six">';
            for(var j in list[i]) {
                if(j == 'qishu') {
                    ls_kj += '<td>' + list[i][j].substr(-3) + '</td>';
                } else {
                    ls_kj += '<td num="' + list[i][j] + '" set="true"><i class="n_' + list[i][j] + '">' + list[i][j] + '</i></td>';
                }
            }
            ls_kj += '</tr>';
        }
        var win_parent = $(window.parent.document);
        win_parent.find("#gm_name").html("香港六合彩");
        win_parent.find("#kj_list").html(ls_kj);
        win_parent.find("#user_order").html('').hide();
        win_parent.find("#info").show();
    }
}

//投注提交
function order() {
	var balls = '', arr = new Array();
    var cou =  0, txt = '';
    var m = 0;
    var t_money = $("#kj_money");

	if (t_money.val() != "" && t_money.val() != null) {
		m = parseInt(t_money.val());
	}
	if (m <= 0) {layer.msg("请输入下注金额！！！");return false;}
	for( var i = 1; i < 7; i++) {
		if($('input:radio[name="ball_'+ i +'"]:checked').val() != null) {
			balls		= $('input:radio[name="ball_'+ i +'"]:checked').val();
			arr			= balls.split('_');
			var q 		= did(parseInt(arr[0]));
			var w 		= wan(parseInt(arr[1]));
			var odds	= $("#ball_" + arr[0] + "_o" + arr[1]).html();
			txt 		= txt + q + ' [' + w +'] @ ' + odds +'\n';
			cou++;
		}
	}
	if (cou <= 1) {layer.msg("请至少选择2个过关项目！");return false;}
	var t = "过关下注 ￥"+m+"，确定下注吗？\n\n下注明细如下：\n\n";
	txt = t + txt;
    var opt = {
        dataType: 'json',
        beforeSubmit: function() {
            var ok = confirm(txt);
            if(!ok) {
                return false;
            }
        },
        success: function(data) {
            if(data.code == 0) {
                var html = getOrdersHtml(data);
                $(window.parent.document).find("#info").hide();
                $(window.parent.document).find("#user_order").html(html).show();
                formReset();
            } else if(data.code == 1) {
                layer.msg(data.info);
            } else if(data.code == 2) {
                layer.msg(data.info);
                location.replace(location.href);
            } else {
                window.top.location = "/";
            }
        }
    };
    $("#orders").ajaxSubmit(opt);
}

//读取第几球
function did(type) {
	var r = '';
	switch (type) {
		case 1 : r = '正一'; break;
		case 2 : r = '正二'; break;
		case 3 : r = '正三'; break;
		case 4 : r = '正四'; break;
		case 5 : r = '正五'; break;
		case 6 : r = '正六'; break;
	}
	return r;
}

//读取玩法
function wan (type) {
	var r = '';
	switch (type) {
		case 50 : r = '大'; break;
		case 51 : r = '小'; break;
		case 52 : r = '单'; break;
		case 53 : r = '双'; break;
		case 54 : r = '合大'; break;
		case 55 : r = '合小'; break;
		case 56 : r = '合单'; break;
		case 57 : r = '合双'; break;
		case 58 : r = '尾大'; break;
		case 59 : r = '尾小'; break;
		case 60 : r = '尾单'; break;
		case 61 : r = '尾双'; break;
		case 62 : r = '红波'; break;
		case 63 : r = '蓝波'; break;
		case 64 : r = '绿波'; break;
	}
	return r;
}