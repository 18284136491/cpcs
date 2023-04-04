﻿// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("bk_danshi_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){	
		var pagecount	=	json.fy.p_page;
		var page		=	json.fy.page;
		var fenye		=	"";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
		var dbwidth = $(parent.window).width()-10;
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
		if(pagecount == 0){
			$("#datashow").html('<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">独赢</th><th data-hide="phone,tablet">让分</th><th data-hide="phone,tablet">大小</th><th data-hide="phone,tablet">单双</th><th data-hide="phone,tablet">主队得分</th><th data-hide="phone,tablet">客队得分</th></tr></thead><tbody><tr><td height="100" colspan="8" align="center" bgcolor="#FFFFFF" style="line-height:25px;">您选择的项目暂时没有赛事</td></tr></tbody></table>');
			$("#top").html("");
		}else{
			for(var i=0; i<pagecount; i++){
				if(i != page){
					fenye+="<li><a href='javascript:NumPage(" + i + ");' id=\"page_this\">" + (i+1) + "</a></li>";
				}else{
					fenye+="<li class='active'><a href='javascript:NumPage(" + i + ");' id=\"page_this\">" + (i+1) + "</a></li>";
				}
			}
			$("#top").html(fenye);
			
			var htmls='<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">独赢</th><th data-hide="phone,tablet">让分</th><th data-hide="phone,tablet">大小</th><th data-hide="phone,tablet">单双</th><th data-hide="phone,tablet">主队得分</th><th data-hide="phone,tablet">客队得分</th></tr></thead><tbody>';
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				if(dbs[i]["Match_BzM"]!="0" || dbs[i]["Match_Ho"]!="0" || dbs[i]["Match_DxDpl"]!="0" || dbs[i]["Match_DsDpl"]!="0" || dbs[i]["Match_DFzDpl"]!="0" || dbs[i]["Match_DFkDpl"]!="0"){
				lsm = dbs[i]["Match_Name"];
				htmls+="<tr>";
				htmls+="<td>"+lsm+"</td>";
			htmls+="<td><span class=\"red\">"+dbs[i]["Match_Date"]+"</span><br><span class='zhu'>"+dbs[i]["Match_Master"]+"</span>-<span class='ke'>"+dbs[i]["Match_Guest"]+"</span></td>";
				htmls+="<td><div class=\"btn-group\">"+(dbs[i]["Match_BzM"]=="0" ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('篮球单式','标准盘-"+dbs[i]["Match_Master"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzM','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_BzM"],2)+"</a>"))+(dbs[i]["Match_BzG"]=="0" ? "" :("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('篮球单式','标准盘-"+dbs[i]["Match_Guest"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzG','0','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_BzG"]!=data[i]["Match_BzG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f;":"")+"'>"+formatNumber(dbs[i]["Match_BzG"],2)+"</a>"))+"</div></td>";
			
    		htmls+="<td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_Ho"]<="0" ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('篮球单式','让球-"+(dbs[i]["Match_ShowType"]=="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Master"]+"','"+dbs[i]["Match_ID"]+"','Match_Ho','1','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Ho"]!=data[i]["Match_Ho"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_Ho"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+((dbs[i]["Match_ShowType"]=="H" && dbs[i]["Match_Ho"]!="0")? dbs[i]["Match_RGG"] :"")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_Ao"]<="0" ? "" :("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('篮球单式','让球-"+(dbs[i]["Match_ShowType"]=="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Guest"]+"','"+dbs[i]["Match_ID"]+"','Match_Ao','1','0','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Ao"]!=data[i]["Match_Ao"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_Ao"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+((dbs[i]["Match_ShowType"]=="C" && dbs[i]["Match_Ho"]!="0")? dbs[i]["Match_RGG"] :"")+"</a></span></div></td>";
			
    		htmls+="<td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_DxDpl"]=="0" ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('篮球单式','大小-"+dbs[i]["Match_DxGG1"]+"','"+dbs[i]["Match_ID"]+"','Match_DxDpl','1','0','"+dbs[i]["Match_DxGG1"]+"');\" style='"+(dbs[i]["Match_DxGG1"]!=data[i]["Match_DxGG1"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DxDpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DxGG1"]!="O" ? dbs[i]["Match_DxGG1"] :"")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_DxXpl"]=="0" ? "" :("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('篮球单式','大小-"+dbs[i]["Match_DxGG2"]+"','"+dbs[i]["Match_ID"]+"','Match_DxXpl','1','0','"+dbs[i]["Match_DxGG2"]+"');\" style='"+(dbs[i]["Match_DxXpl"]!=data[i]["Match_DxXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DxXpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DxGG2"]!="U" ? dbs[i]["Match_DxGG2"] :"")+"</span></div></td>";
			
    		htmls+="<td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_DsDpl"]<="0" ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"单\" onclick=\"javascript:setbet('篮球单式','单双-单','"+dbs[i]["Match_ID"]+"','Match_DsDpl','0','0','单');\" style='"+(dbs[i]["Match_DsDpl"]!=data[i]["Match_DsDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DsDpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DsDpl"]>"0" ? "单" :"")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_DsDpl"]<="0" ? "" :("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\"双\" onclick=\"javascript:setbet('篮球单式','单双-双','"+dbs[i]["Match_ID"]+"','Match_DsSpl','0','0','双');\" style='"+(dbs[i]["Match_DsDpl"]!=data[i]["Match_DsDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DsSpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DsSpl"]!="0" ? "双" :"")+"</a></span></div></td>";
			
    		htmls+="<td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_DFzDpl"]=="0" ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('篮球单式','主队大小-"+dbs[i]["Match_DFzDX1"]+"','"+dbs[i]["Match_ID"]+"','Match_DFzDpl','1','0','"+dbs[i]["Match_DFzDX1"]+"');\" style='"+(dbs[i]["Match_DFzDX1"]!=data[i]["Match_DFzDX1"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DFzDpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DFzDX1"]!="大" ? dbs[i]["Match_DFzDX1"] :"")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_DFzXpl"]=="0" ? "" :("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('篮球单式','主队大小-"+dbs[i]["Match_DFzDX2"]+"','"+dbs[i]["Match_ID"]+"','Match_DFzXpl','1','0','"+dbs[i]["Match_DFzDX2"]+"');\" style='"+(dbs[i]["Match_DFzXpl"]!=data[i]["Match_DFzXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DFzXpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DFzDX2"]!="小" ? dbs[i]["Match_DFzDX2"] :"")+"</span></div></td>";
			
    		htmls+="<td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_DFkDpl"]=="0" ? "" :("<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('篮球单式','客队大小-"+dbs[i]["Match_DFkDX1"]+"','"+dbs[i]["Match_ID"]+"','Match_DFkDpl','1','0','"+dbs[i]["Match_DFkDX1"]+"');\" style='"+(dbs[i]["Match_DFkDX1"]!=data[i]["Match_DFkDX1"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DFkDpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DFkDX1"]!="大" ? dbs[i]["Match_DFkDX1"] :"")+"</a></span><br><span class='odds'>"+(dbs[i]["Match_DFkXpl"]=="0" ? "" :("<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('篮球单式','客队大小-"+dbs[i]["Match_DFkDX2"]+"','"+dbs[i]["Match_ID"]+"','Match_DFkXpl','1','0','"+dbs[i]["Match_DFkDX2"]+"');\" style='"+(dbs[i]["Match_DFkXpl"]!=data[i]["Match_DFkXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>"+formatNumber(dbs[i]["Match_DFkXpl"],2)+"</a>"))+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">"+(dbs[i]["Match_DFkDX2"]!="小" ? dbs[i]["Match_DFkDX2"] :"")+"</span></div></td>";
			
    		htmls+="</tr>";	
			}
			}
			
			htmls+="</tbody></table>";
			if(htmls == '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">独赢</th><th data-hide="phone,tablet">让分</th><th data-hide="phone,tablet">大小</th><th data-hide="phone,tablet">单双</th><th data-hide="phone,tablet">主队得分</th><th data-hide="phone,tablet">客队得分</th></tr></thead><tbody></tbody></table>'){
				htmls = '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间<br>主队 / 客队</th><th data-hide="phone,tablet">独赢</th><th data-hide="phone,tablet">让分</th><th data-hide="phone,tablet">大小</th><th data-hide="phone,tablet">单双</th><th data-hide="phone,tablet">主队得分</th><th data-hide="phone,tablet">客队得分</th></tr></thead><tbody><tr><td height="100" colspan="8" align="center" bgcolor="#FFFFFF" style="line-height:25px;">您选择的项目暂时没有赛事</td></tr></tbody></table>';
			}
			$("#datashow").html(htmls);
			//$(".panel").width(dbwidth);
			$('.table').footable();
		}
	})
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		if(window_lsm.length > 2000){
			if(window.XMLHttpRequest){ //Mozilla, Safari, IE7 
				if(!window.ActiveXObject){ // Mozilla, Safari, 
					JqueryDialog.Open('篮美单式', 'dialog.php?lsm='+window_lsm, 300, window_hight);
				}else{ //IE7
					JqueryDialog.Open('篮美单式', 'dialog.php?lsm=lqds', 300, window_hight);
				}
			}else{ //IE6
				JqueryDialog.Open('篮美单式', 'dialog.php?lsm=lqds', 300, window_hight);
			}
		}else{
			JqueryDialog.Open('篮美单式', 'dialog.php?lsm='+window_lsm, 300, window_hight);
		}
	});
});