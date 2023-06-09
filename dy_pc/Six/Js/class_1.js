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

function loadInfo(i) {
	$.post("class/time_0.php?" + Date.parse(new Date()), function(data) {
		if(data.close > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
            $("#kj_time").html(data.kj_time);
			timer(data.close);
			oddsInfo(i);
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

function oddsInfo(i) {
	$.post("odds/6hc.php?" + Date.parse(new Date()), function(data) {
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("封盘");
		    return false;
		}
		if(i < 8) {
			for(var s = 1; s < 87; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 16) {
			for(var s = 1; s < 62; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 17) {
			for(var s = 1; s < 50; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 8) {
			for(var s = 1; s < 50; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 9) {
			for(var s = 1; s < 5; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 10) {
			for(var s = 1; s < 23; s++) {
				var odds = oddslist.ball[i][s];
				$("#ball_"+i+"_o"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
				loadInput(i , s);
			}
		}
		if(i == 'sm') {
			for(var s = 1; s < 7; s++) {
				for(var s1 = 50; s1 < 65; s1++) {
					var odds = oddslist.ball[s][s1];
					$("#ball_"+s+"_o"+s1).html(odds);
					loadInput(s , s1);
				}
			}
		}
	}, "json");
	odds = setTimeout("oddsInfo(" + i + ")", 5000);
}

function loadInput(i , s) {
	var b = "ball_" + i + "_" + s;
	var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
	if($("#ball_" + i + "_m" + s).html() == '&nbsp;') {
		$("#ball_" + i + "_m" + s).html(n);
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
    closeTime = setTimeout("timer(" + intDiff + ")",1000);
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
    var cou =  0, txt = '';
    var m = 0;

	for (var i = 1; i < 18; i++) {
		if(i == 9) {
			for(var s = 1; s < 5; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_o" + s).children("a").html();
					var q = did(i);
					var w = wan9(s);
					txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		} else if(i == 10) {
			for(var s = 1; s < 23; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_o" + s).children("a").html();
					var q = did(i);
					var w = wan(s+64);
					txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		} else {
			for(var s = 1; s < 87; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_" + i + "_o" + s).children("a").html();
					var q = did(i);
					var w = wan(s);
					txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		}
	}
	if (cou <= 0) {layer.msg("请输入下注金额！！！");return false;}
	var t = "共 ￥"+m+" / "+cou+" 笔，确定下注吗？\n\n下注明细如下：\n\n";
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
		case 7 : r = '特码B'; break;
		case 16 : r = '特码A'; break;
		case 8 : r = '正码B'; break;
		case 17 : r = '正码A'; break;
		case 9 : r = '总和'; break;
		case 10 : r = '一肖、尾数'; break;
	}
	return r;
}

//读取玩法
function wan(type) {
	var r = '';
	switch (type) {
		case 1 : r = '01'; break;
		case 2 : r = '02'; break;
		case 3 : r = '03'; break;
		case 4 : r = '04'; break;
		case 5 : r = '05'; break;
		case 6 : r = '06'; break;
		case 7 : r = '07'; break;
		case 8 : r = '08'; break;
		case 9 : r = '09'; break;
		case 10 : r = '10'; break;
		case 11 : r = '11'; break;
		case 12 : r = '12'; break;
		case 13 : r = '13'; break;
		case 14 : r = '14'; break;
		case 15 : r = '15'; break;
		case 16 : r = '16'; break;
		case 17 : r = '17'; break;
		case 18 : r = '18'; break;
		case 19 : r = '19'; break;
		case 20 : r = '20'; break;
		case 21 : r = '21'; break;
		case 22 : r = '22'; break;
		case 23 : r = '23'; break;
		case 24 : r = '24'; break;
		case 25 : r = '25'; break;
		case 26 : r = '26'; break;
		case 27 : r = '27'; break;
		case 28 : r = '28'; break;
		case 29 : r = '29'; break;
		case 30 : r = '30'; break;
		case 31 : r = '31'; break;
		case 32 : r = '32'; break;
		case 33 : r = '33'; break;
		case 34 : r = '34'; break;
		case 35 : r = '35'; break;
		case 36 : r = '36'; break;
		case 37 : r = '37'; break;
		case 38 : r = '38'; break;
		case 39 : r = '39'; break;
		case 40 : r = '40'; break;
		case 41 : r = '41'; break;
		case 42 : r = '42'; break;
		case 43 : r = '43'; break;
		case 44 : r = '44'; break;
		case 45 : r = '45'; break;
		case 46 : r = '46'; break;
		case 47 : r = '47'; break;
		case 48 : r = '48'; break;
		case 49 : r = '49'; break;
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
		case 65 : r = '鼠'; break;
		case 66 : r = '牛'; break;
		case 67 : r = '虎'; break;
		case 68 : r = '兔'; break;
		case 69 : r = '龙'; break;
		case 70 : r = '蛇'; break;
		case 71 : r = '马'; break;
		case 72 : r = '羊'; break;
		case 73 : r = '猴'; break;
		case 74 : r = '鸡'; break;
		case 75 : r = '狗'; break;
		case 76 : r = '猪'; break;
		case 77 : r = '0尾'; break;
		case 78 : r = '1尾'; break;
		case 79 : r = '2尾'; break;
		case 80 : r = '3尾'; break;
		case 81 : r = '4尾'; break;
		case 82 : r = '5尾'; break;
		case 83 : r = '6尾'; break;
		case 84 : r = '7尾'; break;
		case 85 : r = '8尾'; break;
		case 86 : r = '9尾'; break;
	}
	return r;
}

//读取玩法
function wan9(type) {
	var r = '';
	switch (type) {
		case 1 : r = '总和大'; break;
		case 2 : r = '总和小'; break;
		case 3 : r = '总和单'; break;
		case 4 : r = '总和双'; break;
	}
	return r;
}