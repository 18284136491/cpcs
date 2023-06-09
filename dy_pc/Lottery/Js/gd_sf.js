var bool = auto_new = false;
var sound_off = 0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh = '';
var g_type = 0;
var p_sound = false;

//限制只能输入1-9纯数字
function digitOnly($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}

function gm_close() {
	var str = '<img class="gm_fp" src="/newindex/dy/fp.png" />';
	$("body").html(str);
}

//盘口信息
function loadinfo(type) {
    g_type = type;
	$.post("class/odds_3.php", function(data) {
		if(data.opentime > 0) {
			$("#open_qihao").html(data.number);
            $("#qi_num").val(data.number);
			ball_odds = data.oddslist;
			loadodds(data.oddslist);
			endtime(data.opentime);
            auto(type);
		} else {
            history(type);
            gm_close();
            return false;
		}
	}, "json");
}

//更新赔率
function loadodds(oddslist) {
    var ref = arguments[1] ? arguments[1] : false;
    var odds = '';

	if (oddslist == null || oddslist == "") {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
		return false;
	}
	for(var i = 1; i<10; i++) {
		if(i == 9) {
			for(var s = 1; s < 9; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		} else if(i >= 1 && i <= 8) {
			for(var s = 1; s < 36; s++) {
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html('<a href="javascript:void(0);" title="按此下注">' + odds + '</a>');
                if(!ref) {
                    loadinput(i, s);
                }
			}
		}
	}
}

//更新投注框
function loadinput(ball , s) {
    var b = "ball_" + ball + "_" + s;
    var n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>";
	if(ball >= 1 && ball <= 9) {
		$("#ball_" + ball + "_t" + s).html(n);
	}
}

function getIS(s) {
    var i = Math.floor(s / 60);
    if(i < 10) i = '0' + i;
    var ss = s % 60;
    if(ss < 10) ss = '0' + ss;
    return i + ":" + ss;
}

//封盘时间
function endtime(iTime) {
    if(iTime <= 60) {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
    }
    if(iTime < 0) {
        clearTimeout(fp);
        loadinfo(g_type);
    } else {
        iTime--;
        var t = iTime - 60;
        if(t > 0) {
            $("#fp_time").html(getIS(t));
        } else {
            $("#fp_time").html("00:00");
        }
        if(iTime > 0) {
            $("#kj_time").html(getIS(iTime));
        } else {
            $("#kj_time").html("00:00");
        }
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}

//刷新时间
function rf_time(time) {
    var rf = $("#rf_time");
    var fp = $("#fp_time");
    if(time < 0) {
        clearTimeout(c_rf);
        if(fp.html() != "00:00") {
            rf.html("载入中...");
            $.post("class/odds_3.php", function(data) {
                var qihao = $("#open_qihao").html();
                if(qihao == data.number) {
                    loadodds(data.oddslist, true);
                }
                rf_time(90);
            }, "json");
        } else {
            rf_time(90);
        }
    } else {
        rf.html(time + "秒");
        time--;
        c_rf = setTimeout("rf_time(" + time + ")", 1000);
    }
}

//更新开奖号码
function auto(ball) {
    var kj_qishu = $("#numbers");
    $.post("class/auto_3.php", {ball: ball}, function(data) {
        $("#user_sy").html(data.shuying);
        var qihao = kj_qishu.html();
        if(data.kj_list.length > 0 && qihao != data.kj_list[0]['qishu']) {
            var new_qh = '';
            var new_hm = '';
            var ls_kj = '<tr height="30">';
            ls_kj += '<td class="sub" colspan="9">';
            ls_kj += '<a class="cur" href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 0, this);">号码</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 1, this);">大小</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 2, this);">单双</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 3, this);">方位</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 4, this);">中发白</a>';
            ls_kj += '</td></tr>';
            ls_kj += '<tr>';
            ls_kj += '<td width="16%">期号</td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td>六</td><td>七</td><td>八</td>';
            ls_kj += '</tr>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="gdsf">';
                for(var j in data.kj_list[i]) {
                    if(i == 0) {
                        if(j == 'qishu') {
                            new_qh = data.kj_list[i][j];
                        } else {
                            new_hm += '<em class="n_' + data.kj_list[i][j] + '"></em>';
                        }
                    }
                    if(j == 'qishu') {
                        ls_kj += '<td>0' + data.kj_list[i][j].substr(-2) + '</td>';
                    } else {
                        ls_kj += '<td num="' + data.kj_list[i][j] + '" set="true"><i class="n_' + data.kj_list[i][j] + '">' + data.kj_list[i][j] + '</i></td>';
                    }
                }
                ls_kj += '</tr>';
            }
            kj_qishu.html(new_qh);
            $("#open_num").html(new_hm);
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("广东快乐十分");
            win_parent.find("#kj_list").html(ls_kj);
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();
            var tj = $("#tongji");
            if(tj.length > 0 && data.tongji != null) {
                var str = '';
                for(var i in data.tongji) {
                    str += '<tr>';
                    if(i == 'row_1') {
                        str += '<td class="t2">出 球 率</td>';
                    } else {
                        str += '<td class="t2">无出期数</td>';
                    }
                    for(var j in data.tongji[i]) {
                        if(i == 'row_1') {
                            str += '<td>' + data.tongji[i][j] + '</td>';
                        } else {
                            str += '<td' + (parseFloat(data.tongji[i][j]) > 15 ? ' class="red"' : '') + '>' + data.tongji[i][j] + '</td>';
                        }
                    }
                    str += '</tr>';
                }
                tj.html(str);
            }
            var luzhu = $("#luzhu");
            if(luzhu.length > 0) {
                var lz_str = '';
                for(var i in data.luzhu) {
					lz_str += '<tr' + (i == 0 ? ' class="on"' : '') + '>';
					for(var j in data.luzhu[i]) {
						lz_str += data.luzhu[i][j];
					}
					lz_str += '</tr>';
                }
                luzhu.html(lz_str);
            }
            $(".gm_lz th").removeClass("cur").eq(0).addClass("cur");
            var cl_str = '';
            for(var i in data.cl_list) {
                cl_str += '<tr><td class="cl_l">' + i + '</td>';
                cl_str += '<td class="cl_r">' + data.cl_list[i] + ' 期</td></tr>';
            }
            $("#changlong").html(cl_str);
            layer.tips(tips[getRandomNum(0, 4)], ".cl_list", {
                tips: [3, '#3595CC'],
                time: 5000
            });
            setTimeout("auto(" + g_type + ")", 10000);
        } else {
            $("#play_sound").html('');
            setTimeout("auto(" + g_type + ")", 10000);
        }
    }, "json");
}

//获取历史开奖
function history(ball) {
    $.post("class/auto_3.php", {ball: ball}, function(data) {
        if(data.kj_list.length > 0) {
            var ls_kj = '<tr height="30">';
            ls_kj += '<td class="sub" colspan="9">';
            ls_kj += '<a class="cur" href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 0, this);">号码</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 1, this);">大小</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 2, this);">单双</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 3, this);">方位</a>';
            ls_kj += '<a href="javascript:void(0);" onclick="changeNumType(\'gdsf\', 4, this);">中发白</a>';
            ls_kj += '</td></tr>';
            ls_kj += '<tr>';
            ls_kj += '<td width="16%">期号</td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td>六</td><td>七</td><td>八</td>';
            ls_kj += '</tr>';
            for(var i = 0; i < data.kj_list.length; i++) {
                ls_kj += '<tr class="gdsf">';
                for(var j in data.kj_list[i]) {
                    if(j == 'qishu') {
                        ls_kj += '<td>0' + data.kj_list[i][j].substr(-2) + '</td>';
                    } else {
                        ls_kj += '<td num="' + data.kj_list[i][j] + '" set="true"><i class="n_' + data.kj_list[i][j] + '">' + data.kj_list[i][j] + '</i></td>';
                    }
                }
                ls_kj += '</tr>';
            }
            var win_parent = $(window.parent.document);
            win_parent.find("#gm_name").html("广东快乐十分");
            win_parent.find("#kj_list").html(ls_kj);
            win_parent.find("#user_order").html('').hide();
            win_parent.find("#info").show();
        }
    }, "json");
}

//投注提交
function order() {
    if(!islg) {
        layer.msg("您尚未登录或登录已超时，请重新登录！");
        return false;
    }

    var cou =  0, txt = '';
    var mix = 5;
    var m = 0;
    var c = true;

	for (var i = 1; i < 10; i++) {
		if(i == 9) {
			for(var s = 1; s < 9; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).children("a").html();
					var q = did(i);
					var w = wan9(s);
					txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		} else {
			for(var s = 1; s < 36; s++) {
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
                        layer.msg("最低下注金额：" + mix + "元！");
                        return false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).children("a").html();
					var q = did(i);
					var w = wan(s);
					txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		}
	}
	if (!c) {layer.msg("最低下注金额：" + mix + "元！");return false;}
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
		case 1 : r = '第一球'; break;
		case 2 : r = '第二球'; break;
		case 3 : r = '第三球'; break;
		case 4 : r = '第四球'; break;
		case 5 : r = '第五球'; break;
		case 6 : r = '第六球'; break;
		case 7 : r = '第七球'; break;
		case 8 : r = '第八球'; break;
		case 9 : r = '总和、龙虎'; break;
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
		case 21 : r = '大'; break;
		case 22 : r = '小'; break;
		case 23 : r = '单'; break;
		case 24 : r = '双'; break;
		case 25 : r = '尾大'; break;
		case 26 : r = '尾小'; break;
		case 27 : r = '合数单'; break;
		case 28 : r = '合数双'; break;
		case 29 : r = '东'; break;
		case 30 : r = '南'; break;
		case 31 : r = '西'; break;
		case 32 : r = '北'; break;
		case 33 : r = '中'; break;
		case 34 : r = '发'; break;
		case 35 : r = '白'; break;
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
		case 5 : r = '总和尾大'; break;
		case 6 : r = '总和尾小'; break;
		case 7 : r = '龙'; break;
		case 8 : r = '虎'; break;
	}
	return r;
}