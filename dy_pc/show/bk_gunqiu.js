// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("bk_gunqiu_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
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
			$("#datashow").html("<div class='empty'>您选择的项目暂时没有赛事</div>");
			$("#top").html("");
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
				if(dbs[i]["Match_BzM"]!="0" || dbs[i]["Match_Ho"]!="0" || dbs[i]["Match_DxDpl"]!="0" || dbs[i]["Match_DsDpl"]!="0" || dbs[i]["Match_DFzDpl"]!="0" || dbs[i]["Match_DFkDpl"]!="0"){
				if(lsm != dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
				}
			htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";	
				htmls+="<div class=\"bisai_bo\">";
				
			
			if ('Y' == dbs[i]["Match_IsMaster"]) {
            minute = Math.floor(dbs[i]["Match_LastTime"] / 60);
            if (minute < 10 && minute >= 0) {
                minute = '0' + minute;
			}else if (minute < 0) {
                minute = '0' + '0';
            }

            second = dbs[i]["Match_LastTime"] % 60;
            if (second < 10 && second >= 0) {
                second = '0' + second;
			}else if (second < 0) {	
			    second = '0' + '0';
            }

            timer = minute + ':' + second;
			}	

				var bf = dbs[i]["Match_NowSession"]; //节数
				if(bf == "Q1") {
					bf = "<div class=\"sijian_lq_color\">" + "<span style=color:#ffce39;>第一节</span>"+ " "+ timer +"</div>";
                }else if (bf == "Q2") {
				    bf = "<div class=\"sijian_lq_color\">" + "<span style=color:#ffce39;>第二节</span>"+ " "+ timer +"</div>";
				}else if (bf == "Q3") {
				    bf = "<div class=\"sijian_lq_color\">" + "<span style=color:#ffce39;>第三节</span>"+ " "+ timer +"</div>";
				}else if (bf == "Q4") {
				    bf = "<div class=\"sijian_lq_color\">" + "<span style=color:#ffce39;>第四节</span>"+ " "+ timer +"</div>";
				}else if (bf == "H1") {
				    bf = "<div class=\"sijian_lq_color\">" + "<span style=color:#ffce39;>上半场</span>"+ " "+ timer +"</div>";
				}else if (bf == "H2") {
				    bf = "<div class=\"sijian_lq_color\">" + "<span style=color:#ffce39;>下半场</span>"+ " "+ timer +"</div>";
				}else if (bf == "HT") {
					bf = "<div class=\"sijian_lq_color\">" + "<span style=color:#ffce39;>半场</span>"+"</div>";
				}else if (bf == "OT") {
					bf = "<div class=\"sijian_lq_color\">" + "<span style=color:#ffce39;>加时</span>"+ " "+ timer +"</div>";
					
					}	
					

                        var gqsjcs = dbs[i]["Match_IsMaster"];
				        if(dbs[i]["Match_IsMaster"] == "Y" && dbs[i]["Match_LastGoal"]=="H") {
					    htmls +="<div class=\"sijian_lq\">" + bf+ "<p>"+'<span style=color:#ba3800;>' + dbs[i]["Match_ScoreH"] + '</span>'+'<span style=color:#8c8169;>'+"-"+'</span>'+'<span style=color:#997e47;>' + dbs[i]["Match_ScoreC"] + '</span>'+"</div>";
						}else if (dbs[i]["Match_IsMaster"] == "Y" && dbs[i]["Match_LastGoal"]=="A") {
						htmls +="<div class=\"sijian_lq\">" + bf+ "<p>"+'<span style=color:#997e47;>' + dbs[i]["Match_ScoreH"] + '</span>'+'<span style=color:#8c8169;>'+"-"+'</span>'+'<span style=color:#ba3800;>' + dbs[i]["Match_ScoreC"] + '</span>'+"</div>";
						}else if (dbs[i]["Match_IsMaster"] == "Y") {
						htmls +="<div class=\"sijian_lq\">" + bf+ "<p>"+'<span style=color:#ba3800;>' + dbs[i]["Match_ScoreH"] + '</span>'+'<span style=color:#8c8169;>'+"-"+'</span>'+'<span style=color:#ba3800;>' + dbs[i]["Match_ScoreC"] + '</span>'+"</div>";
						}else {
						htmls +="<div class=\"sijian_lq2\">" + "</div>";
						}
					
					    htmls+="<div class=\"zhudui_bo\">";
						htmls+="<div class='bodan_x lan_gunqiu_zk zu_2Scolor1'>"+dbs[i]["Match_Master"]+"</div>";
						htmls+="<div class=\"bodan_x lan_gunqiu_dy\">";
                        htmls+="<div class='lan_gunqiu_dy_zu1'>"+(dbs[i]["Match_BzM"]=="0" ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('篮球滚球','标准盘-"+dbs[i]["Match_Master"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzM','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_BzM"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						htmls+="<div class=\"bodan_x lan_gunqiu_rf\">";
						htmls+="<div class='hui_z lan_gunqiu_rf_zu1'>"+((dbs[i]["Match_ShowType"]=="H" && dbs[i]["Match_Ho"]!=0)? dbs[i]["Match_RGG"] :"")+"</div>";
						htmls+="<div class='hui_z lan_gunqiu_rf_zu2'>"+((dbs[i]["Match_Ho"]==null || dbs[i]["Match_Ho"]<= 0) ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('篮球滚球','让球-"+(dbs[i]["Match_ShowType"]=="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Master"]+"','"+dbs[i]["Match_ID"]+"','Match_Ho','1','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Ho"]!=data[i]["Match_Ho"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_Ho"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						htmls+="<div class=\"bodan_x lan_gunqiu_dx\">";
						htmls+="<div class=\"hui_z lan_gunqiu_dx_zu3\">"+(dbs[i]["Match_DxGG1"]!="大" ? dbs[i]["Match_DxGG1"] :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_dx_zu4\">"+(dbs[i]["Match_DxDpl"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('篮球滚球','大小"+dbs[i]["Match_DxDpl"]+"','"+dbs[i]["Match_ID"]+"','Match_DxDpl','1','0','"+dbs[i]["Match_DxGG1"]+"');\" style='"+(dbs[i]["Match_DxDpl"]!=data[i]["Match_DxDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DxDpl"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						htmls+="<div class=\"bodan_x lan_gunqiu_ds\">";
						htmls+="<div class=\"hui_z lan_gunqiu_ds_zu1\">"+(dbs[i]["Match_DsDpl"]>"0" ? "单" :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_ds_zu2\">"+(dbs[i]["Match_DsDpl"]<="0" ? "" :("<a href=\"javascript:void(0)\" title=\"单\" onclick=\"javascript:setbet('篮球滚球','单双-单','"+dbs[i]["Match_ID"]+"','Match_DsDpl','0','0','单');\" style='"+(dbs[i]["Match_DsDpl"]!=data[i]["Match_DsDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DsDpl"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						
						htmls+="<div class=\"bodan_x lan_gunqiu_dfdx_zu lan_gunqiu_dfdx_bb\">";
						htmls+="<div class=\"hui_z lan_gunqiu_dfdx_zu1\">"+(dbs[i]["Match_DFzDX1"]!="大" ? dbs[i]["Match_DFzDX1"] :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_dfdx_zu2\">"+(dbs[i]["Match_DFzDpl"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\"主大\" onclick=\"javascript:setbet('篮球滚球','主队大小-"+dbs[i]["Match_DFzDX1"]+"','"+dbs[i]["Match_ID"]+"','Match_DFzDpl','1','0','"+dbs[i]["Match_DFzDX1"]+"');\" style='"+(dbs[i]["Match_DFzDX1"]!=data[i]["Match_DFzDX1"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DFzDpl"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						
						htmls+="<div class=\"bodan_lq lan_gunqiu_dfdx_zu lan_gunqiu_dfdx_bb\">";
						htmls+="<div class=\"hui_z lan_gunqiu_dfdx_zu1\">"+(dbs[i]["Match_DFzDX2"]!="小" ? dbs[i]["Match_DFzDX2"] :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_dfdx_zu2\">"+(dbs[i]["Match_DFzXpl"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\"主小\" onclick=\"javascript:setbet('篮球滚球','主队大小-"+dbs[i]["Match_DFzDX2"]+"','"+dbs[i]["Match_ID"]+"','Match_DFzXpl','1','0','"+dbs[i]["Match_DFzDX2"]+"');\" style='"+(dbs[i]["Match_DFzDX2"]!=data[i]["Match_DFzDX2"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DFzXpl"],2)+"</a>"))+"</div>";
						htmls+="</div>";
					    htmls+="</div>";
					    htmls+="<div class=\"kedui_bo\">";						
						htmls+="<div class=\"bodan_x_bor lan_gunqiu_zk zu_2Scolor2\">"+dbs[i]["Match_Guest"]+"</div>";
						htmls+="<div class=\"bodan_x_bor lan_gunqiu_dy\">";
						htmls+="<div class='lan_gunqiu_dy_zu1'>"+(dbs[i]["Match_BzG"]=="0" ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('篮球滚球','标准盘-"+dbs[i]["Match_Guest"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzG','0','0','"+dbs[i]["Match_Guest"]+"');\"  style='"+(dbs[i]["Match_Guest"]!=data[i]["Match_Guest"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_BzG"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						
						htmls+="<div class=\"bodan_x_bor lan_gunqiu_rf\">";
						htmls+="<div class=\"hui_z lan_gunqiu_rf_zu1\">"+((dbs[i]["Match_ShowType"]=="C" && dbs[i]["Match_Ho"]!=0)? dbs[i]["Match_RGG"] :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_rf_zu2\">"+(dbs[i]["Match_Ao"]<=0 ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('篮球滚球','让球-"+(dbs[i]["Match_ShowType"]=="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Guest"]+"','"+dbs[i]["Match_ID"]+"','Match_Ao','1','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Ao"]!=data[i]["Match_Ao"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_Ao"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						htmls+="<div class=\"bodan_x_bor lan_gunqiu_dx\">";
						htmls+="<div class=\"hui_z lan_gunqiu_dx_zu3\">"+(dbs[i]["Match_DxGG2"]!="小" ? dbs[i]["Match_DxGG2"] :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_dx_zu4\">"+(dbs[i]["Match_DxXpl"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('篮球滚球','大小"+dbs[i]["Match_DxXpl"]+"','"+dbs[i]["Match_ID"]+"','Match_DxXpl','1','0','"+dbs[i]["Match_DxGG2"]+"');\" style='"+(dbs[i]["Match_DxXpl"]!=data[i]["Match_DxXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DxXpl"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						htmls+="<div class=\"bodan_x_bor lan_gunqiu_ds\">";
						htmls+="<div class=\"hui_z lan_gunqiu_ds_zu1\">"+(dbs[i]["Match_DsSpl"]!="0" ? "双" :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_ds_zu2\">"+(dbs[i]["Match_DsDpl"]<="0" ? "" :("<a href=\"javascript:void(0)\" title=\"双\" onclick=\"javascript:setbet('篮球滚球','单双-双','"+dbs[i]["Match_ID"]+"','Match_DsSpl','0','0','双');\" style='"+(dbs[i]["Match_DsDpl"]!=data[i]["Match_DsDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DsSpl"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						htmls+="<div class=\"bodan_x_bor lan_gunqiu_dfdx_zu lan_gunqiu_dfdx_bb2\">";
						htmls+="<div class=\"hui_z lan_gunqiu_dfdx_zu1\">"+(dbs[i]["Match_DFkDX1"]!="大" ? dbs[i]["Match_DFkDX1"] :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_dfdx_zu2\">"+(dbs[i]["Match_DFkDpl"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\"客大\" onclick=\"javascript:setbet('篮球滚球','客队大小-"+dbs[i]["Match_DFkDX1"]+"','"+dbs[i]["Match_ID"]+"','Match_DFkDpl','1','0','"+dbs[i]["Match_DFkDX1"]+"');\" style='"+(dbs[i]["Match_DFkDX1"]!=data[i]["Match_DFkDX1"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DFkDpl"],2)+"</a>"))+"</div>";
						htmls+="</div>";
						
						htmls+="<div class=\"bodan_lq_bor lan_gunqiu_dfdx_zu lan_gunqiu_dfdx_bb2\">";
						htmls+="<div class=\"hui_z lan_gunqiu_dfdx_zu1\">"+(dbs[i]["Match_DFkDX2"]!="小" ? dbs[i]["Match_DFkDX2"] :"")+"</div>";
						htmls+="<div class=\"hui_z lan_gunqiu_dfdx_zu2\">"+(dbs[i]["Match_DFkXpl"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\"客小\" onclick=\"javascript:setbet('篮球滚球','客队大小-"+dbs[i]["Match_DFkDX2"]+"','"+dbs[i]["Match_ID"]+"','Match_DFkXpl','1','0','"+dbs[i]["Match_DFkDX2"]+"');\" style='"+(dbs[i]["Match_DFkDX2"]!=data[i]["Match_DFkDX2"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DFzXpl"],2)+"</a>"))+"</div>";
						htmls+="</div>";
					htmls+="</div>";
				htmls+="</div>";
				htmls+="</div>";
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
		JqueryDialog.Open('篮美滚球', 'dialog.php?lsm='+window_lsm, 600, window_hight);
	});
});