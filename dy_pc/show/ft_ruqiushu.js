// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("ft_ruqiushu_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
		var pagecount	=	json.fy.p_page;
		var page		=	json.fy.page;
		var fenye		=	"";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
		
		if(dbs !=null) {
			if(thispage==0 && p!='p'){	
				data = dbs;
				dbs  = json.db;  
			}else{
				dbs  = json.db;  
				data = dbs;
			}
		}else{
			dbs  = json.db;
			data = dbs;
		}
        var h = $(document.body).height() - $("#datashow").height();
		if(pagecount == "error1"){
			$("#datashow").html("<div class='empty'>末登录,无法查看赛事信息.</div>");
			$("#top").html("");
		}else if(pagecount == "error2"){
			$("#datashow").html("<div id=\"location\" class='empty'>对不起,您点击页面太快,请在60秒后进行操作</div><script>check();</script>");
			$("#top").html("");
		}else if(pagecount == 0){
			$("#datashow").html("<div class='empty'>您选择的项目暂时没有赛事</div>");
			$("#top").html('');
		}else{
			for(var i=0; i<pagecount; i++){
				if(i != page){
					fenye+="<a href='javascript:NumPage(" + i + ");'><div class=\"sz_0\" id=\"page_this\">" + (i+1) + "</div></a>";
				}else{
					fenye+="<a href='javascript:NumPage(" + i + ");'><div class=\"sz_0\" id=\"page_this\"  style='color:#FFFFFF;background:url(../images/right_4.jpg);'>" + (i+1) + "</div></a>";
				}
			}
			$("#top").html(fenye);
			
			var htmls="<div>";
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				if(dbs[i]["Match_Bd10"] !="0" || dbs[i]["Match_Total01Pl"] !="0" || dbs[i]["Match_Total23Pl"] !="0" || dbs[i]["Match_Total46Pl"] !="0" || dbs[i]["Match_Total7upPl"] !="0"){
				if(lsm != dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
				}
				htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";
				htmls +="<div class='bisai'>";
				htmls +="<div class='hui_xx zu_1'><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\" valign=\"middle\">"+dbs[i]["Match_Date"]+"</td></tr></table></div>";
				htmls +="<div class='zhudui'>";
					htmls +=" <div class='hui_x zu_ruqiu_2 zu_2Scolor1'>"+dbs[i]["Match_Master"]+"</div>";
					htmls +="<div class='hui_x zu_ruqiu_zu'>"+((dbs[i]["Match_BzM"] !=null && dbs[i]["Match_BzM"] !="0")?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"setbet('足球单式','标准盘-"+ dbs[i]["Match_Master"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_BzM','0',0,'"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_BzM"],2)+"</a>":"")+"</div>";
					htmls +="<div class='hui_x zu_ruqiu_zu2'></div>";
					htmls +="<div class='hui_x zu_ruqiu_zu2'></div>";
					htmls +="<div class='hui_x zu_ruqiu_zu2'></div>";
					htmls +="<div class='hui_z zu_ruqiu_zu2'></div>";
				htmls +="</div>";
				htmls +="<div class='kedui'>";
					htmls +="<div class='hui_x2 zu_ruqiu_2 zu_2Scolor2'>"+dbs[i]["Match_Guest"]+"</div>";
					htmls +=" <div class='hui_x2 zu_ruqiu_zu'>"+(dbs[i]["Match_BzG"] !=null && dbs[i]["Match_BzG"] !="0"?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"setbet('足球单式','标准盘-"+ dbs[i]["Match_Guest"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_BzG','0',0,'"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_BzG"]!=data[i]["Match_BzG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_BzG"],2)+"</a>":"")+"</div>";
					htmls +="<div class='hui_x zu_ruqiu_3'>"+((dbs[i]["Match_Total01Pl"] !=null && dbs[i]["Match_Total01Pl"] !="0")?"<a href=\"javascript:void(0)\" title=\"0~1\" onclick=\"setbet('足球单式','入球数-0~1','" + dbs[i]["Match_ID"] + "','Match_Total01Pl','0',0,'0~1');\" style='"+(dbs[i]["Match_Total01Pl"]!=data[i]["Match_Total01Pl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_Total01Pl"],2)+"</a>":"")+"</div>";
					htmls +=" <div class='hui_x zu_ruqiu_3'>"+((dbs[i]["Match_Total23Pl"] !=null && dbs[i]["Match_Total23Pl"] !="0")?"<a href=\"javascript:void(0)\" title=\"2~3\" onclick=\"setbet('足球单式','入球数-2~3','" + dbs[i]["Match_ID"] + "','Match_Total23Pl','0',0,'2~3');\" style='"+(dbs[i]["Match_Total23Pl"]!=data[i]["Match_Total23Pl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_Total23Pl"],2)+"</a>":"")+"</div>";
					htmls +=" <div class='hui_x zu_ruqiu_3'>"+((dbs[i]["Match_Total46Pl"] !=null && dbs[i]["Match_Total46Pl"] !="0")?"<a href=\"javascript:void(0)\" title=\"4~6\" onclick=\"setbet('足球单式','入球数-4~6','" + dbs[i]["Match_ID"] + "','Match_Total46Pl','0',0,'4~6');\" style='"+(dbs[i]["Match_Total46Pl"]!=data[i]["Match_Total46Pl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_Total46Pl"],2)+"</a>":"")+"</div>";
					htmls +=" <div class='hui_z zu_ruqiu_3'>"+((dbs[i]["Match_Total7upPl"] !=null && dbs[i]["Match_Total7upPl"] !="0")?"<a href=\"javascript:void(0)\" title=\"7以上\" onclick=\"setbet('足球单式','入球数-7UP','" + dbs[i]["Match_ID"] + "','Match_Total7upPl','0',0,'7UP');\" style='"+(dbs[i]["Match_Total7upPl"]!=data[i]["Match_Total7upPl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_Total7upPl"],2)+"</a>":"")+"</div>";
				htmls +="</div>";
				htmls +="<div class='heju'>";
					htmls +="  <div class='hui_x_hj heju_zu_ruqiu_2'>和局</div>";
					htmls +=" <div class='hui_x_hj zu_ruqiu_zu'>"+((dbs[i]["Match_BzH"] !=null && dbs[i]["Match_BzH"] !="0")?"<a href=\"javascript:void(0)\" title=\"和局\" onclick=\"setbet('足球单式','标准盘-和局','" + dbs[i]["Match_ID"] + "','Match_BzH','0',0,'和局');\" style='"+(dbs[i]["Match_BzH"]!=data[i]["Match_BzH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_BzH"],2)+"</a>":"")+"</div>";
					htmls +=" <div class='hui_x zu_ruqiu_zu2'></div>";
					htmls +=" <div class='hui_x zu_ruqiu_zu2'></div>";
					htmls +=" <div class='hui_x zu_ruqiu_zu2'></div>";
					htmls +=" <div class='hui_z zu_ruqiu_zu2'></div>";
				htmls +="</div>";
				htmls+="</div>";
				htmls +="</div>"; 
			}
			}
			htmls+="</div>";
			if(htmls == "<div></div>"){
				htmls = "<div class='empty'>您选择的项目暂时没有赛事！</div>";
			}
			$("#datashow").html(htmls);
		}
		document.documentElement.scrollTop	=	$("#top_f5").val(); //导航标题高度
		$("#top_f5").val('0');
		gdt();
        setfrmHeight(h + $("#datashow").height());
	})
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('足球入球数', 'dialog.php?lsm='+window_lsm, 600, window_hight);
	});
});