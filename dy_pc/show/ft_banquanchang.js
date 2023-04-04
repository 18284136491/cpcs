// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("ft_banquanchang_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
		var pagecount	=	json.fy.p_page;
		var page		=	json.fy.page;
		var fenye		=	"";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
		if(dbs !=null){
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
			$("#datashow").html("<div class='empty'>暂无赛事</div>");
			$("#top").html('');
		}else {
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
				if(dbs[i]["Match_BqMM"]!="0" || dbs[i]["Match_BqMH"]!="0" || dbs[i]["Match_BqMG"]!="0" || dbs[i]["Match_BqHM"]!="0" || dbs[i]["Match_BqHH"]!="0" || dbs[i]["Match_BqHG"]!="0" || dbs[i]["Match_BqGM"]!="0" || dbs[i]["Match_BqGH"]!="0" || dbs[i]["Match_BqGG"]!="0"){
				if(lsm!=dbs[i]["Match_Name"]){
					lsm=dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
				}
				htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";
				htmls +=" <div class='bisai_bo'>";
				htmls +="	<div class='bodan_xx zu_1'><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\" valign=\"middle\">"+dbs[i]["Match_Date"]+"</td></tr></table></div>";
				htmls +="<div class='bodan_bi'>";
				htmls +="  <div class='bodan_x zu_banq_2_0 zu_2Scolor1'>"+dbs[i]["Match_Master"]+"</div>";
				htmls +="  <div class='bodan_x_bor zu_banq_2_0 zu_2Scolor2'>"+dbs[i]["Match_Guest"]+"</div>";
				htmls +="</div>";
				htmls +="<div class=\"bodan_banq_x zu_banq_4\">"+(dbs[i]["Match_BqMM"] !=null?"<a href=\"javascript:void(0)\" title=\"主/主\" onclick=\"setbet('足球单式','半全场-主/主','" + dbs[i]["Match_ID"] + "','Match_BqMM','0','0','主/主');\" style='"+(dbs[i]["Match_BqMM"]!=data[i]["Match_BqMM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqMM"]!="0"?dbs[i]["Match_BqMM"]:"")+"</a>":"")+"</div>";
				htmls +=" <div class='bodan_banq_x zu_banq_4'>"+(dbs[i]["Match_BqMH"] !=null?"<a href=\"javascript:void(0)\" title=\"主/和\" onclick=\"setbet('足球单式','半全场-主/和','" + dbs[i]["Match_ID"] + "','Match_BqMH','0','0','主/和');\" style='"+(dbs[i]["Match_BqMH"]!=data[i]["Match_BqMH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqMH"]!="0"?dbs[i]["Match_BqMH"]:"")+"</a>":"")+"</div>";
			    htmls +=" <div class='bodan_banq_x zu_banq_4'>"+(dbs[i]["Match_BqMG"] !=null?"<a href=\"javascript:void(0)\" title=\"主/客\" onclick=\"setbet('足球单式','半全场-主/客','" + dbs[i]["Match_ID"] + "','Match_BqMG','0','0','主/客');\" style='"+(dbs[i]["Match_BqMG"]!=data[i]["Match_BqMG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqMG"]!="0"?dbs[i]["Match_BqMG"]:"")+"</a>":"")+"</div>";
			    htmls +=" <div class='bodan_banq_x zu_banq_4'>"+(dbs[i]["Match_BqHM"] !=null?"<a href=\"javascript:void(0)\" title=\"和/主\" onclick=\"setbet('足球单式','半全场-和/主','" + dbs[i]["Match_ID"] + "','Match_BqHM','0','0','和/主');\" style='"+(dbs[i]["Match_BqHM"]!=data[i]["Match_BqHM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqHM"]!="0"?dbs[i]["Match_BqHM"]:"")+"</a>":"")+"</div>";
			   htmls +="  <div class='bodan_banq_x zu_banq_4'>"+(dbs[i]["Match_BqHH"] !=null?"<a href=\"javascript:void(0)\" title=\"和/和\" onclick=\"setbet('足球单式','半全场-和/和','" + dbs[i]["Match_ID"] + "','Match_BqHH','0','0','和/和');\" style='"+(dbs[i]["Match_BqHH"]!=data[i]["Match_BqHH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqHH"]!="0"?dbs[i]["Match_BqHH"]:"")+"</a>":"")+"</div>";
			    htmls +=" <div class='bodan_banq_x zu_banq_4'>"+(dbs[i]["Match_BqHG"] !=null?"<a href=\"javascript:void(0)\" title=\"和/客\" onclick=\"setbet('足球单式','半全场-和/客','" + dbs[i]["Match_ID"] + "','Match_BqHG','0','0','和/客');\" style='"+(dbs[i]["Match_BqHG"]!=data[i]["Match_BqHG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqHG"]!="0"?dbs[i]["Match_BqHG"]:"")+"</a>":"")+"</div>";
			    htmls +=" <div class='bodan_banq_x zu_banq_4'>"+(dbs[i]["Match_BqGM"] !=null?"<a href=\"javascript:void(0)\" title=\"客/主\" onclick=\"setbet('足球单式','半全场-客/主','" + dbs[i]["Match_ID"] + "','Match_BqGM','0','0','客/主');\" style='"+(dbs[i]["Match_BqGM"]!=data[i]["Match_BqGM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqGM"]!="0"?dbs[i]["Match_BqGM"]:"")+"</a>":"")+"</div>";
			    htmls +=" <div class='bodan_banq_x zu_banq_4'>"+(dbs[i]["Match_BqGH"] !=null?"<a href=\"javascript:void(0)\" title=\"客/和\" onclick=\"setbet('足球单式','半全场-客/和','" + dbs[i]["Match_ID"] + "','Match_BqGH','0','0','客/和');\" style='"+(dbs[i]["Match_BqGH"]!=data[i]["Match_BqGH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqGH"]!="0"?dbs[i]["Match_BqGH"]:"")+"</a>":"")+"</div>";
			    htmls +=" <div class='bodan_banq_z zu_banq_4'>"+(dbs[i]["Match_BqGG"] !=null?"<a href=\"javascript:void(0)\" title=\"客/客\" onclick=\"setbet('足球单式','半全场-客/客','" + dbs[i]["Match_ID"] + "','Match_BqGG','0','0','客/客');\" style='"+(dbs[i]["Match_BqGG"]!=data[i]["Match_BqGG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BqGG"]!="0"?dbs[i]["Match_BqGG"]:"")+"</a>":"")+"</div>";
				htmls +=" </div>";
			htmls+="</div>";
			}
			}
			htmls+="</div>";
			if(htmls == "<div></div>"){
				htmls = "<div class='empty'>暂无赛事！</div>";
			}
			$("#datashow").html(htmls);
		}
		document.documentElement.scrollTop	=	$("#top_f5").val(); //导航标题高度
		$("#top_f5").val('0');
		gdt();
        setfrmHeight(h + $("#datashow").height());
	});
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('足球半全场', 'dialog.php?lsm='+window_lsm, 600, window_hight);
	});
});