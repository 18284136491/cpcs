// JavaScript Document
var dbs  = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("ftz_danshi_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
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
				if(dbs[i]["Match_BzM"]!="0" || dbs[i]["Match_Ho"]!=0 || dbs[i]["Match_DxXpl"]!="0" || dbs[i]["Match_DsDpl"]!="0"){
				if(lsm != dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
				}
				 
			htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";
				htmls+="<div class='bisai'>";
					htmls+="<div class='hui_xx zu_danshi_time'><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\" valign=\"middle\">"+dbs[i]["Match_Date"]+"</td></tr></table></div>";
					htmls+="<div class='zhudui'>";
						htmls+="<div class='hui_x zu_danshi_zk zu_2Scolor1'>"+dbs[i]["Match_Master"]+"</div>";
						htmls+="<div class='hui_x zu_danshi_dy2'>"+(dbs[i]["Match_BzM"]=="0" ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球早餐','标准盘-"+dbs[i]["Match_Master"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzM','0','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_BzM"],2)+"</a>"))+"</div>";
						htmls +="<div class='hui_x zu_danshi_rf'>";
						htmls+="<div class='hui_z zu_danshi_rf_zu1'>"+((dbs[i]["Match_ShowType"]=="H" && dbs[i]["Match_Ho"]!="0") ?dbs[i]["Match_RGG"] : "")+"</div>";
						htmls+="<div class='hui_z zu_danshi_rf_zu2'>"+(dbs[i]["Match_Ho"]==null || dbs[i]["Match_Ho"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球早餐','让球-"+(dbs[i]["Match_ShowType"]=="H" ? "主让" :"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Master"]+"','"+dbs[i]["Match_ID"]+"','Match_Ho','1','0','"+dbs[i]["Match_Master"]+"');\" style='"+(dbs[i]["Match_Ho"]!=data[i]["Match_Ho"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_Ho"],2)+"</a>"))+"</div>";
						htmls +="</div>";
						
						
						htmls +="<div class='hui_x zu_danshi_dx'>";
						htmls+="<div class='hui_z zu_danshi_dx_zu1'>"+(dbs[i]["Match_DxGG1"]=="大" || dbs[i]["Match_DxXpl"]=="0" ? "" :dbs[i]["Match_DxGG1"])+"</div>";
						htmls+="<div class='hui_z zu_danshi_dx_zu2'>"+(dbs[i]["Match_DxDpl"]==null || dbs[i]["Match_DxXpl"]=="0" ? "" :("<a href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('足球早餐','大小-"+dbs[i]["Match_DxGG1"]+"','"+dbs[i]["Match_ID"]+"','Match_DxDpl','1','0','"+dbs[i]["Match_DxGG1"]+"');\" style='"+(dbs[i]["Match_DxGG1"]!=data[i]["Match_DxGG1"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DxDpl"],2)+"</a>"))+"</div>";
						htmls +="</div>";
						
						htmls +="<div class='hui_x zu_danshi_ds'>";
						htmls+="<div class='hui_z zu_danshi_ds_zu1'>"+((dbs[i]["Match_DsDpl"]==null || dbs[i]["Match_DsDpl"]=="0") ? "" :("单"))+"</div>";
						htmls+="<div class='hui_z zu_danshi_ds_zu2'>"+((dbs[i]["Match_DsDpl"]==null || dbs[i]["Match_DsDpl"]=="0") ? "" :("<a href=\"javascript:void(0)\" title=\"单\" onclick=\"javascript:setbet('足球早餐','单双-单','"+dbs[i]["Match_ID"]+"','Match_DsDpl','0','0','单');\" style='"+(dbs[i]["Match_DsDpl"]!=data[i]["Match_DsDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DsDpl"],2)+"</a>"))+"</div>";
						htmls +="</div>";
						htmls +="<div class='hui_x zu_danshi_dy'>"+(dbs[i]["Match_Bmdy"] !=null?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"setbet('足球早餐','上半场标准盘-"+ dbs[i]["Match_Master"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bmdy','0','0','"+dbs[i]["Match_Master"]+"-[上半]');\" style='"+(dbs[i]["Match_Bmdy"]!=data[i]["Match_Bmdy"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bmdy"]!="0"?formatNumber(dbs[i]["Match_Bmdy"],2):"")+"</a>":"")+"</div>";
						htmls +="<div class='hui_x zu_danshi_rf'>";
						htmls +="<div class='hui_z zu_danshi_rf_zu1'>"+((dbs[i]["Match_Hr_ShowType"] =="H" && dbs[i]["Match_BHo"] !=0)?dbs[i]["Match_BRpk"]:"")+"</div>";
						htmls +="<div class='hui_z zu_danshi_rf_zu2'>"+(dbs[i]["Match_BHo"] !=null?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"setbet('足球早餐','上半场让球-"+(dbs[i]["Match_Hr_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Master"] + "','" + dbs[i]["Match_ID"] + "','Match_BHo','1','0','"+dbs[i]["Match_Master"]+"-[上半]'); \"style='"+(dbs[i]["Match_BHo"]!=data[i]["Match_BHo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BHo"]!="0"?formatNumber(dbs[i]["Match_BHo"],2):"")+"</a>":"")+"</div>";
						htmls +="</div>";
						htmls +="<div class='hui_z zu_danshi_dx'>";
						htmls +="<div class='hui_z zu_danshi_dx_zu1'>"+((dbs[i]["Match_Bdxpk1"]!="大")?dbs[i]["Match_Bdxpk1"].replace("@",""):"")+"</div>";
						htmls +="<div class='hui_z zu_danshi_dx_zu2'>"+(dbs[i]["Match_Bdpl"] !=null?"<a href=\"javascript:void(0)\" title=\"大\" onclick=\"setbet('足球早餐','上半场大小-"+dbs[i]["Match_Bdxpk1"]+"','" + dbs[i]["Match_ID"] + "','Match_Bdpl','1','0','"+dbs[i]["Match_Bdxpk1"].replace("@","")+"');\" style='"+(dbs[i]["Match_Bdpl"]!=data[i]["Match_Bdpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bdpl"]!="0"?formatNumber(dbs[i]["Match_Bdpl"],2):"")+"</a>":"")+"</div>";
						htmls +="</div>";
						
					    htmls+="</div>";
					    htmls+="<div class='kedui'>";
						htmls+="<div class='hui_x2 zu_danshi_zk zu_2Scolor2'>"+dbs[i]["Match_Guest"]+"</div>";
						htmls+="<div class='hui_x2 zu_danshi_dy2'>"+(dbs[i]["Match_BzG"]=="0" ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球早餐','标准盘-"+dbs[i]["Match_Guest"]+"-独赢','"+dbs[i]["Match_ID"]+"','Match_BzG','0','0','"+dbs[i]["Match_Guest"]+"');\"  style='"+(dbs[i]["Match_Guest"]!=data[i]["Match_Guest"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_BzG"],2)+"</a>"))+"</div>";
						htmls +="<div class='hui_x2 zu_danshi_rf'>";
						htmls+="<div class='hui_z zu_danshi_rf_zu1'>"+((dbs[i]["Match_ShowType"]=="C" && dbs[i]["Match_Ao"]!="0") ?dbs[i]["Match_RGG"] : "")+"</div>";
						htmls+="<div class='hui_z zu_danshi_rf_zu2'>"+(dbs[i]["Match_Ao"]==null || dbs[i]["Match_Ao"]==0 ? "" :("<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球早餐','让球-"+(dbs[i]["Match_ShowType"]=="H" ? "主让" :"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Guest"]+"','"+dbs[i]["Match_ID"]+"','Match_Ao','1','0','"+dbs[i]["Match_Guest"]+"');\"  style='"+(dbs[i]["Match_Ao"]!=data[i]["Match_Ao"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_Ao"],2)+"</a>"))+"</div>";
						htmls +="</div>";
						
						htmls +="<div class='hui_x2 zu_danshi_dx'>";
						htmls+="<div class='hui_z zu_danshi_dx_zu1'>"+(dbs[i]["Match_DxGG2"]=="小" || dbs[i]["Match_DxXpl"]=="0" ? "" :dbs[i]["Match_DxGG2"])+"</div>";
						htmls+="<div class='hui_z zu_danshi_dx_zu2'>"+(dbs[i]["Match_DxXpl"]==null || dbs[i]["Match_DxXpl"]=="0" ? "" :("<a href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('足球早餐','大小-"+dbs[i]["Match_DxGG2"]+"','"+dbs[i]["Match_ID"]+"','Match_DxXpl','1','0','"+dbs[i]["Match_DxGG2"]+"');\"  style='"+(dbs[i]["Match_DxXpl"]!=data[i]["Match_DxXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DxXpl"],2)+"</a>"))+"</div>";
						htmls +="</div>";
						
						htmls +="<div class='hui_x2 zu_danshi_ds'>";
						htmls+="<div class='hui_z zu_danshi_ds_zu1'>"+((dbs[i]["Match_DsSpl"]==null || dbs[i]["Match_DsSpl"]=="0") ? "" :("双"))+"</div>";
						htmls+="<div class='hui_z zu_danshi_ds_zu2'>"+((dbs[i]["Match_DsSpl"]==null || dbs[i]["Match_DsSpl"]=="0") ? "" :("<a href=\"javascript:void(0)\" title=\"双\" onclick=\"javascript:setbet('足球早餐','单双-双','"+dbs[i]["Match_ID"]+"','Match_DsSpl','0','0','双');\"  style='"+(dbs[i]["Match_DsSpl"]!=data[i]["Match_DsSpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_DsSpl"],2)+"</a>"))+"</div>";
						htmls +="</div>";
						htmls +="<div class='hui_x2 zu_danshi_dy'>"+(dbs[i]["Match_Bgdy2"] !=null?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"setbet('足球早餐','上半场标准盘-"+ dbs[i]["Match_Guest"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bgdy','0','0','"+dbs[i]["Match_Guest"]+"-[上半]');\" style='"+(dbs[i]["Match_Bgdy2"]!=data[i]["Match_Bgdy2"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bgdy2"]!="0"?formatNumber(dbs[i]["Match_Bgdy2"],2):"")+"</a>":"")+"</div>";
						htmls +="<div class='hui_x2 zu_danshi_rf'>";
						htmls +="<div class='hui_z zu_danshi_rf_zu1'>"+((dbs[i]["Match_Hr_ShowType"] =="C" && dbs[i]["Match_BAo"] !="0")?dbs[i]["Match_BRpk"]:"")+"</div>";
						htmls +="<div class='hui_z zu_danshi_rf_zu2'>"+(dbs[i]["Match_BAo"] !=null?"<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"setbet('足球早餐','上半场让球-"+(dbs[i]["Match_Hr_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Guest"] + "','" + dbs[i]["Match_ID"] + "','Match_BAo','1','0','"+dbs[i]["Match_Guest"]+"-[上半]');\" style='"+(dbs[i]["Match_BAo"]!=data[i]["Match_BAo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_BAo"]!="0"?formatNumber(dbs[i]["Match_BAo"],2):"")+"</a>":"")+"</div>";
						htmls +="</div>";
						htmls +="<div class='hui_z_zq zu_danshi_dx'>";
						htmls +="<div class='hui_z zu_danshi_dx_zu1'>"+((dbs[i]["Match_Bdxpk2"]!="小")?dbs[i]["Match_Bdxpk2"].replace("@",""):"")+"</div>";
						htmls +="<div class='hui_z zu_danshi_dx_zu2'>"+(dbs[i]["Match_Bxpl"] !=null?"<a href=\"javascript:void(0)\" title=\"小\" onclick=\"setbet('足球早餐','上半场大小-"+dbs[i]["Match_Bdxpk2"]+"','" + dbs[i]["Match_ID"] + "','Match_Bxpl','1','0','"+dbs[i]["Match_Bdxpk2"].replace("@","")+"');\" style='"+(dbs[i]["Match_Bxpl"]!=data[i]["Match_Bxpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bxpl"]!="0"?formatNumber(dbs[i]["Match_Bxpl"],2):"")+"</a>":"")+"</div>";
						htmls +="</div>";
					    htmls+="</div>";
					    htmls +="<div class='heju'>";
						htmls +="<div class='hui_x_hj heju_zu_2'>和局</div>";
						htmls +="<div class=\"heju_1\">"+((dbs[i]["Match_BzH"]==null || (dbs[i]["Match_BzH"]-0.05<=0)) ? "" :("<a href=\"javascript:void(0)\" title=\"和局\" onclick=\"javascript:setbet('足球早餐','标准盘-和局','"+dbs[i]["Match_ID"]+"','Match_BzH','0','0','和局');\"  style='"+(dbs[i]["Match_BzH"]!=data[i]["Match_BzH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+formatNumber(dbs[i]["Match_BzH"],2)+"</a>"))+"</div><div class='hui_d zu_heju1'></div>";
						htmls +="<div class=\"heju_2\">"+(dbs[i]["Match_Bhdy2"] !=null?((dbs[i]["Match_Bhdy2"]-0.05)>0 ?"<a href=\"javascript:void(0)\"  title=\"和局\" onclick=\"setbet('足球早餐','上半场标准盘-和局','" + dbs[i]["Match_ID"] + "','Match_Bhdy','0','0','和局');\" style='"+(dbs[i]["Match_Bhdy2"]!=data[i]["Match_Bhdy2"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>"+(dbs[i]["Match_Bhdy2"]!="0"?formatNumber(dbs[i]["Match_Bhdy2"],2):"")+"</a>":""):"")+"</div><div class='hui_d zu_heju2'></div>";
					htmls +="</div>";
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
		if(window_lsm.length > 2000){
			if(window.XMLHttpRequest){ //Mozilla, Safari, IE7 
				if(!window.ActiveXObject){ // Mozilla, Safari, 
					JqueryDialog.Open('足球早餐单式', 'dialog.php?lsm='+window_lsm, 600, window_hight);
				}else{ //IE7
					JqueryDialog.Open('足球早餐单式', 'dialog.php?lsm=zqzcds', 600, window_hight);
				}
			}else{ //IE6
				JqueryDialog.Open('足球早餐单式', 'dialog.php?lsm=zqzcds', 600, window_hight);
			}
		}else{
			JqueryDialog.Open('足球早餐单式', 'dialog.php?lsm='+window_lsm, 600, window_hight);
		}
	});
});