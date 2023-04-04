var tips = new Array();
tips[0] = "听说利用长龙统计可以大大滴提升中奖率哦！";
tips[1] = "大神说，看准长龙统计等于百发百中！";
tips[2] = "会看长龙统计的人一般运气不会太差！你懂得！";
tips[3] = "从前，有个玩家经常关注长龙，后来，他赚了好多钱！";
tips[4] = "不管你有没有用长龙统计，反正我用了！哈哈";
tips[5] = "哈哈，我中了，因为我看了长龙统计！你还不研究长龙吗？";
var kj_mon = $("#kj_money");

function urlOnclick(url) {
    window.open(url, "mainFrame");
}
function prefix(val, len) {
    return (new Array(len).join('0') + val).slice(-len);
}
function gonggao() {
    var n = $(".news");
    if(n.find("li").length > 0) {
        layer.open({
            type: 1,
            area: '500px',
            shade: [0.1, '#333'],
            shadeClose: true,
            btn: '关闭',
            title: '重要公告',
            content: n
        });
    }
}
function getRandomNum(minNum, maxNum) {
    return parseInt(Math.random() * (maxNum - minNum + 1) + minNum);
}
function kjNum(t) {
    if(t == 's' || t == 'six_s') {
        var n = kj_mon.val();
        if(n > 0) {
            if(t == 'six_s') {
                $.cookie('six_money', n);
            } else {
                $.cookie('kj_money', n);
            }
            layer.msg('保存快速金额成功！');
        } else {
            layer.msg('请填写快速金额！');
            kj_mon.focus();
        }
    } else if(t == 'd' || t == 'six_d') {
        kj_mon.val('');
        if(t == 'six_d') {
            $.cookie('six_money', null);
        } else {
            $.cookie('kj_money', null);
        }
        layer.msg('已取消快速金额！');
    }
}
function changeNumType(gm, type, obj) {
    if(!$(obj).hasClass("cur")) {
        $(obj).addClass("cur").siblings().removeClass("cur");
    }
    var td = $("td[set=true]");
    if(gm == 'pk10' || gm == 'xyft') {
        switch (type) {
            case 0:
                td.each(function() {
                    var num = $(this).attr("num");
                    $(this).html('<i class="n_' + num + '">' + num + '</i>');
                });
                break;
            case 1:
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    $(this).html(num <= 5 ? '<em style="color: blue">小</em>' : '<em style="color: red">大</em>');
                });
                break;
            case 2:
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    $(this).html(num % 2 ? '<em style="color: blue">单</em>' : '<em style="color: red">双</em>');
                });
                break;
        }
    } else if(gm == 'cqssc') {
        switch (type) {
            case 0:
                td.each(function() {
                    var num = $(this).attr("num");
                    $(this).html('<i class="n_' + num + '">' + num + '</i>');
                });
                break;
            case 1:
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    var sum = parseFloat($(this).attr("sum"));
                    if(sum == 1) {
                        $(this).html(num < 23 ? '<em style="color: blue">小</em>' : '<em style="color: red">大</em>');
                    } else {
                        $(this).html(num < 5 ? '<em style="color: blue">小</em>' : '<em style="color: red">大</em>');
                    }
                });
                break;
            case 2:
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    $(this).html(num % 2 ? '<em style="color: blue">单</em>' : '<em style="color: red">双</em>');
                });
                break;
        }
    } else if(gm == 'gdsf' || gm == 'xync') {
        switch (type) {
            case 0:
                td.each(function() {
                    var num = $(this).attr("num");
                    $(this).html('<i class="n_' + num + '">' + num + '</i>');
                });
                break;
            case 1:
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    $(this).html(num <= 10 ? '<em style="color: blue">小</em>' : '<em style="color: red">大</em>');
                });
                break;
            case 2:
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    $(this).html(num % 2 ? '<em style="color: blue">单</em>' : '<em style="color: red">双</em>');
                });
                break;
            case 3:
                var d = [1,5,9,13,17];
                var n = [2,6,10,14,18];
                var x = [3,7,11,15,19];
                var b = [4,8,12,16,20];
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    if($.inArray(num, d) >= 0) {
                        $(this).html('<em style="color: blue">东</em>');
                    } else if($.inArray(num, n) >= 0) {
                        $(this).html('<em style="color: red">南</em>');
                    } else if($.inArray(num, x) >= 0) {
                        $(this).html('<em style="color: green">西</em>');
                    } else if($.inArray(num, b) >= 0) {
                        $(this).html('<em style="color: #000">北</em>');
                    }
                });
                break;
            case 4:
                var z = [1,2,3,4,5,6,7];
                var f = [8,9,10,11,12,13,14];
                var b = [15,16,17,18,19,20];
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    if($.inArray(num, z) >= 0) {
                        $(this).html('<em style="color: blue">中</em>');
                    } else if($.inArray(num, f) >= 0) {
                        $(this).html('<em style="color: red">发</em>');
                    } else if($.inArray(num, b) >= 0) {
                        $(this).html('<em style="color: green">白</em>');
                    }
                });
                break;
        }
    } else if(gm == 'six') {
        switch (type) {
            case 0:
                td.each(function() {
                    var num = $(this).attr("num");
                    $(this).html('<i class="n_' + num + '">' + num + '</i>');
                });
                break;
            case 1:
                var yang = [2, 14, 26, 38];
                var ma = [3, 15, 27, 39];
                var she = [4, 16, 28, 40];
                var long = [5, 17, 29, 41];
                var tu = [6, 18, 30, 42];
                var hu = [7, 19, 31, 43];
                var niu = [8, 20, 32, 44];
                var shu = [9, 21, 33, 45];
                var zhu = [10, 22, 34, 46];
                var gou = [11, 23, 35, 47];
                var ji = [12, 24, 36, 48];
                var hou = [1, 13, 25, 37, 49];
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    if($.inArray(num, yang) >= 0) {
                        $(this).html('<i class="n_' + num + '">羊</i>');
                    } else if($.inArray(num, ma) >= 0) {
                        $(this).html('<i class="n_' + num + '">马</i>');
                    } else if($.inArray(num, she) >= 0) {
                        $(this).html('<i class="n_' + num + '">蛇</i>');
                    } else if($.inArray(num, long) >= 0) {
                        $(this).html('<i class="n_' + num + '">龙</i>');
                    } else if($.inArray(num, tu) >= 0) {
                        $(this).html('<i class="n_' + num + '">兔</i>');
                    } else if($.inArray(num, hu) >= 0) {
                        $(this).html('<i class="n_' + num + '">虎</i>');
                    } else if($.inArray(num, niu) >= 0) {
                        $(this).html('<i class="n_' + num + '">牛</i>');
                    } else if($.inArray(num, shu) >= 0) {
                        $(this).html('<i class="n_' + num + '">鼠</i>');
                    } else if($.inArray(num, zhu) >= 0) {
                        $(this).html('<i class="n_' + num + '">猪</i>');
                    } else if($.inArray(num, gou) >= 0) {
                        $(this).html('<i class="n_' + num + '">狗</i>');
                    } else if($.inArray(num, ji) >= 0) {
                        $(this).html('<i class="n_' + num + '">鸡</i>');
                    } else if($.inArray(num, hou) >= 0) {
                        $(this).html('<i class="n_' + num + '">猴</i>');
                    }
                });
                break;
            case 2:
                var jin = [01,14,15,22,23,30,31,44,45];
                var mu = [04,05,12,13,26,27,34,35,42,43];
                var shui = [02,03,10,11,18,19,32,33,40,41,48,49];
                var huo = [06,07,20,21,28,29,36,37];
                var tu = [08,09,16,17,24,25,38,39,46,47];
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    if($.inArray(num, jin) >= 0) {
                        $(this).html('<i class="n_' + num + '">金</i>');
                    } else if($.inArray(num, mu) >= 0) {
                        $(this).html('<i class="n_' + num + '">木</i>');
                    } else if($.inArray(num, shui) >= 0) {
                        $(this).html('<i class="n_' + num + '">水</i>');
                    } else if($.inArray(num, huo) >= 0) {
                        $(this).html('<i class="n_' + num + '">火</i>');
                    } else if($.inArray(num, tu) >= 0) {
                        $(this).html('<i class="n_' + num + '">土</i>');
                    }
                });
                break;
            case 3:
                td.each(function() {
                    var num = parseFloat($(this).attr("num"));
                    $(this).html(num % 2 ? '<em style="color: blue">单</em>' : '<em style="color: red">双</em>');
                });
                break;
        }
    }
}
function getWin(obj) {
    var t = $(obj).val();
    var r = /^\+?[1-9][0-9]*$/;
    var w = $("#win_money");
    if(!r.test(t)) {
        $(obj).val('');
        w.html(0);
    } else {
        var odds = $("#tz_odds").text();
        w.html(Math.round(t * odds * 100) / 100);
    }
}
function cancelOrder() {
    $("#user_order").html('').hide();
    $("#info").show();
}
function saveOrder() {
    var inp = $(".inp1");
    var min = Number($("#tz_min").text());
    var max = Number($("#tz_max").text());
    if(Number(inp.val()) < min) {
        layer.msg("最低下注金额：" + min + "元！");
        inp.select();
        return false;
    }
    if(Number(inp.val()) > max) {
        layer.msg("最高下注金额：" + max + "元！");
        inp.select();
        return false;
    }
    var opt = {
        dataType: 'json',
        beforeSubmit: function() {
            var r = confirm("确定下注吗？");
            if(!r) {
                return false;
            }
        },
        success: function(data) {
            if(data.code == 0) {
                var html = getOrdersHtml(data);
                $("#info").hide();
                $("#user_order").html(html).show();
            } else if(data.code == 1) {
                layer.msg(data.info);
            } else if(data.code == 2) {
                layer.msg(data.info);
                cancelOrder();
            } else {
                window.top.location = "/";
            }
        }
    };
    $("#kj_frm").ajaxSubmit(opt);
}
function getOrdersHtml(data) {
    var html = '<table cellspacing="0" cellpadding="0" border="0">';
        html += '<tr>';
            html += '<th colspan="2">下注结果反馈</th>';
        html += '</tr>';
        html += '<tr>';
            html += '<td class="bg1" width="30%">会员账号：</td>';
            html += '<td class="pd5" align="left">' + data.username + '</td>';
        html += '</tr>';
        html += '<tr>';
            html += '<td class="bg1">可用金额：</td>';
            html += '<td class="pd5" align="left">' + data.balance + '元</td>';
        html += '</tr>';
        html += '<tr height="35">';
            html += '<td colspan="2"><button type="button" onclick="window.print();" title="打印">打印</button><button type="button" onclick="cancelOrder();" title="返回">返回</button></td>';
        html += '</tr>';
        html += '<tr>';
            html += '<th colspan="2">' + data.qishu + '期</th>';
        html += '</tr>';
    for(var i in data.tz_list) {
        html += '<tr>';
            html += '<td class="bg2">注单号：</td>';
            html += '<td class="bg2 pd5" align="left">' + data.tz_list[i]['orderId'] + '</td>';
        html += '</tr>';
        html += '<tr>';
            html += '<td colspan="2"><span class="gt">' + data.tz_list[i]['type'] + ' 『' + data.tz_list[i]['wanfa'] + '』</span> @ <span class="od">' + data.tz_list[i]['odds'] + '</span></td>';
        html += '</tr>';
        html += '<tr>';
            html += '<td>下注额：</td>';
            html += '<td class="pd5" align="left">' + data.tz_list[i]['money'] + '元</td>';
        html += '</tr>';
        html += '<tr>';
            html += '<td>可赢额：</td>';
            html += '<td class="pd5" align="left">' + data.tz_list[i]['win'] + '元</td>';
        html += '</tr>';
    }
        html += '<tr>';
            html += '<td class="bg1">下注笔数：</td>';
            html += '<td class="pd5" align="left">' + data.tz_sum + '笔</td>';
        html += '</tr>';
        html += '<tr>';
            html += '<td class="bg1">合计注额：</td>';
            html += '<td class="pd5" align="left">' + data.money_all + '元</td>';
        html += '</tr>';
    html += '</table>';
    return html;
}
function formReset() {
    $(".bian_td_inp input").val('');
    $(".tr_txt").find("input[type='radio'], input[type='checkbox']").attr("checked", false);
}
function gm_open(idx) {
    var url = "";
    switch (idx) {
        case 1:
            url = "/Lottery/ssc_list.php";
            break;
        case 2:
            url = "/Lottery/ssc_list.php?type=7";
            break;
        case 3:
            url = "/Lottery/ssc_list.php?type=14";
            break;
        case 4:
            url = "/Lottery/list_Pk10.php";
            break;
        case 5:
            url = "/Lottery/list_Pk10.php?type=8";
            break;
        case 6:
            url = "/Lottery/list_gdsf.php?type=11";
            break;
        case 7:
            url = "/Lottery/list_gdsf.php";
            break;
        case 8:
            url = "/Lottery/list_kl8.php";
            break;
        case 9:
            url = "/Lottery/list_3D.php";
            break;
        case 10:
            url = "/Lottery/list_3D.php?type=10";
            break;
        case 11:
            url = "/Six/Auto.php";
            break;
        case 12:
            url = "/Lottery/list_xy28.php";
            break;
        case 13:
            url = "/Lottery/list_xy28.php?type=13";
            break;
        default:
            url = "/Lottery/list_Pk10.php";
    }
    urlOnclick(url);
}
function gm_rules(idx) {
    var url = "";
    switch (idx) {
        case 1:
            url = "/Lottery/rules/cqssc.php";
            break;
        case 2:
            url = "/Lottery/rules/jxssc.php";
            break;
        case 3:
            url = "/Lottery/rules/xjssc.php";
            break;
        case 4:
            url = "/Lottery/rules/pk10.php";
            break;
        case 5:
            url = "/Lottery/rules/xyft.php";
            break;
        case 6:
            url = "/Lottery/rules/cqsf.php";
            break;
        case 7:
            url = "/Lottery/rules/klsf.php";
            break;
        case 8:
            url = "/Lottery/rules/kl8.php";
            break;
        case 9:
            url = "/Lottery/rules/3d.php";
            break;
        case 10:
            url = "/Lottery/rules/pl3.php";
            break;
        case 11:
            url = "/Six/6rules.php";
            break;
        case 12:
            url = "/Lottery/rules/xy28.php";
            break;
        case 13:
            url = "/Lottery/rules/jnd28.php";
            break;
        default:
            url = "/Lottery/rules/pk10.php";
    }
    urlOnclick(url);
}

$(function() {
    $(".gm_lz a").click(function() {
        var p = $(this).parent();
        var i = p.index();
        p.addClass("cur").siblings().removeClass("cur");
        $("#luzhu").find("tr").removeClass("on").eq(i).addClass("on");
    });
    var r_bar = $(".r_tools");
    var btn = r_bar.find("a.btn");
    btn.click(function() {
        var t = r_bar.find(".t_r");
        if($(this).hasClass("open")) {
            $(this).attr("title", "关闭在线客服").removeClass("open").addClass("close");
            t.animate({width: 'show', opacity: 'show'}, 100, function() {t.show()});
        } else {
            $(this).attr("title", "查看在线客服").removeClass("close").addClass("open");
            t.animate({width: 'hide', opacity: 'hide'}, 100, function() {t.hide()});
        }
    });
    kj_mon.keyup(function() {
        var t = $(this).val();
        var r = /^\+?[1-9][0-9]*$/;
        if(!r.test(t)) {
            $(this).val("");
        }
    });
    $(".bian_td_inp").on("click", "input", function() {
        if(kj_mon.val() > 0) {
            $(this).val(kj_mon.val());
        }
    });
    $(".bian_td_odds").on("click", "a", function() {
        var tmp = $(this).parent().attr("id").split('_');
        var t_num = parseFloat(tmp[1]);
        var w_num = parseFloat(tmp[2].replace(/[a-zA-Z]+/g, ''));
        var gm_mode = $("#gm_mode").val();
        var t_name = '';
        var w_name = '';
        var odds = $(this).text();
        var inp = $("#ball_" + t_num + "_" + w_num).val();
        var post_url = (gm_mode.indexOf('six') == 0 ? '/Six/' : '/Lottery/') + $("#orders").attr("action");
        var u_name = $("#u_name").val();
        switch (gm_mode) {
            case 'pk10':
            case 'xyft':
                t_name = did(t_num);
                if(t_num == 1) {
                    w_name = wan(w_num);
                } else if(t_num >= 2 && t_num <= 11) {
                    w_name = wan2(w_num);
                } else if(t_num == 17) {
                    w_name = wan17(w_num);
                } else {
                    w_name = wan12(w_num);
                }
                break;
            case 'cqssc':
            case 'tjssc':
            case 'xjssc':
                t_name = did(t_num);
                if(t_num == 6) {
                    w_name = wan6(w_num);
                } else if(t_num == 7 || t_num == 8 || t_num == 9) {
                    w_name = wan789(w_num);
                } else if(t_num == 10) {
                    w_name = wan10(w_num);
                } else if(t_num == 11) {
                    w_name = wan11(w_num);
                } else {
                    w_name = wan(w_num);
                }
                break;
            case 'gdsf':
            case 'xync':
                t_name = did(t_num);
                if(t_num == 9) {
                    w_name = wan9(w_num);
                } else {
                    w_name = wan(w_num);
                }
                break;
            case 'kl8':
                t_name = did(t_num);
                if(t_num == 1) {
                    w_name = w_num;
                } else if(t_num == 6) {
                    w_name = wan6(w_num);
                } else if(t_num == 7) {
                    w_name = wan7(w_num);
                } else if(t_num == 8) {
                    w_name = wan8(w_num);
                }
                break;
            case '3d':
            case 'pl3':
                t_name = did(t_num);
                if(t_num == 4) {
                    w_name = wan6(w_num);
                } else if(t_num == 5) {
                    w_name = wan789(w_num);
                } else if(t_num == 6) {
                    w_name = wanK(w_num);
                } else {
                    w_name = wan(w_num);
                }
                break;
            case 'six_1':
                t_name = did(t_num);
                if(t_num == 9) {
                    w_name = wan9(w_num);
                } else if(t_num == 10) {
                    w_name = wan(w_num + 64);
                } else {
                    w_name = wan(w_num);
                }
                break;
            case 'xy28':
                t_name = did(t_num);
                if(t_num == 1) {
                    w_name = wan(w_num);
                } else if(t_num == 2) {
                    w_name = wan2(w_num);
                } else if(t_num == 3) {
                    w_name = wan3(w_num);
                } else if(t_num == 4) {
                    w_name = wan4(w_num);
                }
                break;
        }
        var str = '<form id="kj_frm" method="post" action="' + post_url + '">';
        str += '<table cellspacing="0" cellpadding="0" border="0">';
            str += '<tr>';
                str += '<th colspan="2">' + t_name + ' - 下注</th>';
            str += '</tr>';
            str += '<tr>';
                str += '<td width="30%" class="bg1">会员账号：</td>';
                str += '<td align="left" class="pd5">' + u_name + '</td>';
            str += '</tr>';
            str += '<tr>';
                str += '<td class="bg1">可用金额：</td>';
                str += '<td align="left" class="pd5">' + $(window.parent.document).find("#money").html() + '</td>';
            str += '</tr>';
            str += '<tr height="38">';
                str += '<td colspan="2" class="bg2"><input type="hidden" name="qi_num" value="' + $("#open_qihao").html() + '"><span class="qh">' + $("#open_qihao").html() + ' 期</span><br><span class="gt">' + t_name + ' ' + w_name + '</span> @ <span id="tz_odds" class="od">' + odds + '</span></td>';
            str += '</tr>';
            str += '<tr>';
                str += '<td class="bg1">下注金额：</td>';
                str += '<td align="left" class="pd5"><input type="text" name="ball_' + t_num + '_' + w_num + '" value="' + inp + '" class="inp1" onkeyup="getWin(this)" onfocus="this.className=\'inp1m\'" onblur="this.className=\'inp1\'" size="8" maxlength="7"></td>';
            str += '</tr>';
            str += '<tr>';
                str += '<td class="bg1">可贏金额：</td>';
                str += '<td align="left" class="pd5"><span id="win_money">' + Math.round(inp * odds * 100) / 100 + '</span>元</td>';
            str += '</tr>';
            str += '<tr>';
                str += '<td class="bg1">最低下注：</td>';
                str += '<td align="left" class="pd5"><span id="tz_min">' + $("#cp_min").val() + '</span>元</td>';
            str += '</tr>';
            str += '<tr>';
                str += '<td class="bg1">最高下注：</td>';
                str += '<td align="left" class="pd5"><span id="tz_max">' + $("#cp_max").val() + '</span>元</td>';
            str += '</tr>';
            str += '<tr height="35">';
                str += '<td colspan="2"><button type="button" onclick="cancelOrder();" title="取消">取消</button><button type="button" onclick="saveOrder();" title="下注">下注</button></td>';
            str += '</tr>';
        str += '</table>';
        str += '</form>';
        $(window.parent.document).find("#info").hide();
        $(window.parent.document).find("#user_order").html(str).show();
    });
});