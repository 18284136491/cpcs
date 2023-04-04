// JavaScript Document
var dbs	 = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("ft_gunqiu_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
		
		var pagecount = json.fy.p_page;
		var page = json.fy.page;
		var fenye = "";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
		
		if(dbs !=null)
        {
			if(thispage==0 && p!='p')
			{	
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
				if(lsm!=dbs[i]["Match_Name"]){
					lsm = dbs[i]["Match_Name"];
					htmls+="<div class=\"liansai\"><span class=\"spfloatleft\"><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" style=\"color:#005481;\" >"+lsm+"</a></span><span class=\"spfloatright\"></span></div>";
				}
     			htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";
				
                var home_let_point = (dbs[i]["Match_Ho"]!="@"?dbs[i]["Match_Ho"]:"0");
                if(home_let_point.length ==3){
                    home_let_point = home_let_point + "0";
                }
                if (home_let_point.length == 1){
                    home_let_point = home_let_point + ".00";
                }
				
                var home_dxp_point = (dbs[i]["Match_DxDpl"]!="@"?dbs[i]["Match_DxDpl"]:"0");
                if (home_dxp_point.length == 3){
                    home_dxp_point = home_dxp_point + "0";
                }
                if (home_dxp_point.length == 1){
                    home_dxp_point = home_dxp_point + ".00";
                }
				
                var sbc_home_let_point = (dbs[i]["Match_BHo"]!="@"?dbs[i]["Match_BHo"]:"0");
                if (sbc_home_let_point.length == 3){
                    sbc_home_let_point = sbc_home_let_point + "0";
                }
                if (sbc_home_let_point.length == 1){
                    sbc_home_let_point = sbc_home_let_point + ".00";
                }
				
                var sbc_home_dxp_point = (dbs[i]["Match_Bdpl"]!="@"?dbs[i]["Match_Bdpl"]:"0");
                if (sbc_home_dxp_point.length == 3){
                    sbc_home_dxp_point = sbc_home_dxp_point + "0";
                }
                if (sbc_home_dxp_point.length == 1){
                    sbc_home_dxp_point = sbc_home_dxp_point + ".00";
                }
				
                var guest_let_point = (dbs[i]["Match_Ao"]!="@"?dbs[i]["Match_Ao"]:"0");
                if (guest_let_point.length == 3){
                    guest_let_point = guest_let_point + "0";
                }
                if (guest_let_point.length == 1){
                    guest_let_point = guest_let_point + ".00";
                }
				
                var guest_dxp_point =(dbs[i]["Match_DxXpl"]!="0"?dbs[i]["Match_DxXpl"]:"0");
                if (guest_dxp_point.length == 3){
                    guest_dxp_point = guest_dxp_point + "0";
                }
                if (guest_dxp_point.length == 1){
                    guest_dxp_point = guest_dxp_point + ".00";
                }

                var sbc_guest_let_point = (dbs[i]["Match_BAo"]!="@"?dbs[i]["Match_BAo"]:"0");
                if (sbc_guest_let_point.length == 3){
                    sbc_guest_let_point = sbc_guest_let_point + "0";
                }
                if (sbc_guest_let_point.length == 1){
                    sbc_guest_let_point = sbc_guest_let_point + ".00";
                }
               
                var sbc_guest_dxp_point =(dbs[i]["Match_Bxpl"]!="@"?dbs[i]["Match_Bxpl"]:"0");
                if (sbc_guest_dxp_point.length == 3){
                    sbc_guest_dxp_point = sbc_guest_dxp_point + "0";
                }
                if (sbc_guest_dxp_point.length == 1){
                    sbc_guest_dxp_point = sbc_guest_dxp_point + ".00";
                }
				
                var fwin = (dbs[i]["Match_BzM"]);
                if (fwin.length == 3){
                    fwin = fwin + "0";
                }
                if (fwin.length == 1){
                    fwin = fwin + ".00";
                }
				
                var flose = (dbs[i]["Match_BzG"]!="@"?dbs[i]["Match_BzG"]:"0");
                if (flose.length == 3){
                    flose = flose + "0";
                }
                if (flose.length == 1){
                    flose = flose + ".00";
                }
				
                var fdraw = (dbs[i]["Match_BzH"]!="@"?dbs[i]["Match_BzH"]:"0");
                if (fdraw.length == 3){
                    fdraw = fdraw + "0";
                }
                if (fdraw.length == 1){
                    fdraw = fdraw + ".00";
                }
                
                var Hwin = (dbs[i]["Match_Bmdy"]!="@"?dbs[i]["Match_Bmdy"]:"0");
                if (Hwin.length == 3){
                    Hwin = Hwin + "0";
                }
                if (Hwin.length == 1){
                    Hwin = Hwin + ".00";
                }
				
                var Hlose = (dbs[i]["Match_Bgdy"]!="@"?dbs[i]["Match_Bgdy"]:"0");
                if (Hlose.length == 3){
                    Hlose = Hlose + "0";
                }
                if (Hlose.length == 1){
                    Hlose = Hlose + ".00";
                }
				
                var Hdraw = (dbs[i]["Match_Bhdy"]!="@"?dbs[i]["Match_Bhdy"]:"0");
                if (Hdraw.length == 3){
                    Hdraw = Hdraw + "0";
                }
                if (Hdraw.length == 1){
                    Hdraw = Hdraw + ".00";
                }
				dbs[i]["Match_Time"] = dbs[i]["Match_Time"] || "" || dbs[i]["Match_Time"] !=0;
                if((dbs[i]["Match_Time"].indexOf("font")==-1 && (dbs[i]["Match_Time"].indexOf("a") !=-1 || dbs[i]["Match_Time"].indexOf("p") !=-1) && (dbs[i]["Match_RGG"] !=null?dbs[i]["Match_RGG"]==0:false) && (dbs[i]["Match_DxGG"] !=null?dbs[i]["Match_DxGG"]=="O2.5":false)) ||(dbs[i]["Match_DxGG"] =="O0" || dbs[i]["Match_Bdxpk"] =="O0")){
					    var temphrgl="";
                 		var tempgrgl="";
                   		var temprsgl="";
                }else{
					
                var temphrgl="<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球滚球','让球-"+(dbs[i]["Match_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Master"] + "','" + dbs[i]["Match_ID"] + "','Match_Ho','1','1','"+ dbs[i]["Match_Master"] + "');\"  style='"+(dbs[i]["Match_Ho"]!=data[i]["Match_Ho"]&& data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (home_let_point!="0.00"?home_let_point:"") +  "</a>";
                var tempgrgl="<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球滚球','让球-"+(dbs[i]["Match_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Guest"] + "','" + dbs[i]["Match_ID"] + "','Match_Ao','1','1','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Ao"]!=data[i]["Match_Ao"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (guest_let_point !="0.00"?guest_let_point:"") + "</a>";
                var temprsgl=dbs[i]["Match_RGG"];
                if(dbs[i]["Match_RGG"] !=null && dbs[i]["Match_Time"] !=null)
                {
                   if(dbs[i]["Match_RGG"]=="0" && (dbs[i]["Match_Time"]=="00" || dbs[i]["Match_Time"] =="01"))
                   {
                   var temphrgl="";
                   var tempgrgl="";
                   var temprsgl="";
                   }
                }
                var tempshrgl="<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球滚球','上半场让球-"+(dbs[i]["Match_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Master"] + "','" + dbs[i]["Match_ID"] + "','Match_BHo','1','1','"+ dbs[i]["Match_Master"] + "');\" style='"+(dbs[i]["Match_BHo"]!=data[i]["Match_BHo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (sbc_home_let_point!="0.00"?sbc_home_let_point:"") + "</a>";
                var tempsgrgl="<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球滚球','上半场让球-"+(dbs[i]["Match_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Guest"] + "','" + dbs[i]["Match_ID"] + "','Match_BAo','1','1','"+dbs[i]["Match_Guest"]+"');\"  style='"+(dbs[i]["Match_BAo"]!=data[i]["Match_BAo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (sbc_guest_let_point !="0.00"?sbc_guest_let_point:"") + "</a>";
                var tempsrsgl=dbs[i]["Match_BRpk"];
                if(dbs[i]["Match_BRpk"] !=null && dbs[i]["Match_Time"] !=null)
                {
                if(dbs[i]["Match_BRpk"]=="0" && (dbs[i]["Match_Time"]=="00" || dbs[i]["Match_Time"] =="01"))
                   {
                   var tempshrgl="";
                   var tempsgrgl="";
                   var tempsrsgl="";
                   }
                }
                var tempfwin="<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球滚球','标准盘-"+ dbs[i]["Match_Master"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_BzM','0','1','"+ dbs[i]["Match_Master"] + "');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (fwin!="0.00"?fwin:"") + "</a>";
                var tempflose="<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球滚球','标准盘-"+ dbs[i]["Match_Guest"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_BzG','0','1','"+ dbs[i]["Match_Guest"] + "');\"  style='"+(dbs[i]["Match_BzG"]!=data[i]["Match_BzG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (flose !="0.00"?flose:"") + "</a>";
                var tempfdraw="<a href=\"javascript:void(0)\" title=\"和局\" onclick=\"javascript:setbet('足球滚球','标准盘-和局','" + dbs[i]["Match_ID"] + "','Match_BzH','0','1','和局');\" style='"+(dbs[i]["Match_BzH"]!=data[i]["Match_BzH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (fdraw !="0.00"?fdraw:"") + "</a>";
                var temphwin="<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球滚球','上半场标准盘-"+ dbs[i]["Match_Master"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bmdy','0','1','"+ dbs[i]["Match_Master"] + "');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (Hwin!="0.00"?Hwin:"") + "</a>";
                var temphlose="<a href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球滚球','上半场标准盘-"+ dbs[i]["Match_Guest"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bgdy','0','1','"+ dbs[i]["Match_Guest"] + "');\"  style='"+(dbs[i]["Match_BzG"]!=data[i]["Match_BzG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (Hlose !="0.00"?Hlose:"") + "</a>";
                var temphdraw="<a href=\"javascript:void(0)\" title=\"和局\" onclick=\"javascript:setbet('足球滚球','上半场标准盘-和局','" + dbs[i]["Match_ID"] + "','Match_Bhdy','0','1','和局');\" style='"+(dbs[i]["Match_BzH"]!=data[i]["Match_BzH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (Hdraw !="0.00"?Hdraw:"") + "</a>";
                
				var bf = dbs[i]["Match_Time"]; //比分
				if(bf == "45.5") {
					bf = "<div class=\"sijian_color\">" + "<span style=color:#ffce39;>半埸</span>"+"</div>";
				}else if (bf >= "45" && (dbs[i]["Match_sbscores"]==2 || bf >= "49" )) {
				    bf = "<div class=\"sijian_color\">" + "<span style=color:#ffce39;>下半埸</span>"+ " "+(dbs[i]["Match_Time"]-45)+"'"+"</div>";
				}else if ((bf < "45" || dbs[i]["Match_sbscores"]==1) && dbs[i]["Match_sbscores"]!=2) {
				    bf = "<div class=\"sijian_color\">" + "<span style=color:#ffce39;>上半埸</span>"+ " "+dbs[i]["Match_Time"]+"'"+"</div>";
				}else {
					bf = "<div class=\"sijian_color\">" + "<span style=color:#ffce39;>滚球</span>"+ " "+dbs[i]["Match_Time"]+"'"+"</div>";
					
					}
				
                 htmls +="<div class=\"bisai\">";
				 htmls +="<div class=\"sijian\">" + bf+ "<p>"+dbs[i]["Match_NowScore"]+"</div>";
				 
				 htmls +="<div class=\"zhudui\">";
				 htmls +="<div class=\"hui_x zu_gun_2 zu_2Scolor1\">" + dbs[i]["Match_Master"]+ "&nbsp;"+ (dbs[i]["Match_HRedCard"] !="0"?"<img src='../images/" + dbs[i]["Match_HRedCard"] + ".gif' width='12' height='13' border='0'/>":"") + "</div>";
				 htmls +="<div class=\"hui_x zu_gun_3_1\">"+tempfwin+"</div>";
				 htmls +="<div class=\"hui_x zu_gun_4\">";
				 htmls +="<div class=\"hui_z zu_gun_4_1\">" + (dbs[i]["Match_ShowType"]=="H" && dbs[i]["Match_Ho"] !="0"?temprsgl:"") + "</div>";
				 htmls +="<div class=\"hui_z zu_gun_4_2\">"+(data[i]["Match_Ho"] !=null?temphrgl:"")+"</div>";
				 htmls +="</div>";
				 htmls +="<div class=\"hui_x zu_gun_6\">";
				 htmls +="<div class=\"hui_z zu_gun_6_1\">" + (dbs[i]["Match_DxGG"]!="大"?dbs[i]["Match_DxGG"]:"") + "</div>";
				 htmls +="<div class=\"hui_z zu_gun_6_2\">"+(dbs[i]["Match_DxDpl"] !=null?"<a href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('足球滚球','大小-"+dbs[i]["Match_DxGG"]+"','" + dbs[i]["Match_ID"] + "','Match_DxDpl','1','1','"+dbs[i]["Match_DxGG"]+"');\"  style='"+(dbs[i]["Match_DxDpl"]!=data[i]["Match_DxDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (home_dxp_point!="0.00"?home_dxp_point:"") + "</a>":"")+"</div>";
				 htmls +="</div>";
				 htmls +="<div class=\"hui_x zu_gun_3\">"+temphwin+"</div>";
				 htmls +="<div class=\"hui_x zu_gun_4\">";
				 htmls +="<div class=\"hui_z zu_gun_4_1\">" +(dbs[i]["Match_Hr_ShowType"]=="H" && dbs[i]["Match_BAo"] !="0"?tempsrsgl:"") + "</div>";
				 htmls +="<div class=\"hui_z zu_gun_4_2\">"+(dbs[i]["Match_BHo"]!=null?tempshrgl:"")+"</div>";
				 htmls +="</div>";
				 htmls +="<div class=\"hui_z zu_gun_6\">";
				 htmls +="<div class=\"hui_z zu_gun_6_1\">" + (dbs[i]["Match_Bdxpk"]!="大"?dbs[i]["Match_Bdxpk"]:"") + "</div>";
				 htmls +="<div class=\"hui_z zu_gun_6_2\">"+(dbs[i]["Match_Bdpl"] !=null?"<a href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('足球滚球','上半场大小-"+dbs[i]["Match_Bdxpk"]+"','" + dbs[i]["Match_ID"] + "','Match_Bdpl','1','1','"+dbs[i]["Match_Bdxpk"]+"');\" style='"+(dbs[i]["Match_Bdpl"]!=data[i]["Match_Bdpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (sbc_home_dxp_point!="0.00"?sbc_home_dxp_point:"") + "</a>":"")+"</div>";
				 htmls +="</div>";
				 htmls +="</div>";
				 
				 htmls +="<div class=\"kedui\">";
				 htmls +="<div class=\"hui_x2 zu_gun_2 zu_2Scolor2\">" + dbs[i]["Match_Guest"] + "&nbsp;" + (dbs[i]["Match_GRedCard"] !="0"?"<img src='../images/" + dbs[i]["Match_GRedCard"] + ".gif' width='12' height='13' border='0' />":"")+ "</div>";
				 htmls +="<div class=\"hui_x2 zu_gun_3_1\">"+tempflose+"</div>";
				 htmls +="<div class=\"hui_x2 zu_gun_4\">";
				 htmls +="<div class=\"hui_z zu_gun_4_1\">" + (dbs[i]["Match_ShowType"]=="C" && dbs[i]["Match_Ho"] !="0"?temprsgl:"") + "</div>";
				 htmls +="<div class=\"hui_z zu_gun_4_2\">"+(dbs[i]["Match_Ao"] !=null?tempgrgl:"")+"</div>";
				 htmls +="</div>";
				 htmls +="<div class=\"hui_x2 zu_gun_6\">";
				 htmls +="<div class=\"hui_z zu_gun_6_1\">" +(dbs[i]["Match_DxGG1"]!="小"?dbs[i]["Match_DxGG1"]:"") + "</div>";
				 htmls +="<div class=\"hui_z zu_gun_6_2\">"+(dbs[i]["Match_DxXpl"] !=null?"<a href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('足球滚球','大小-"+dbs[i]["Match_DxGG1"]+"','" + dbs[i]["Match_ID"] + "','Match_DxXpl','1','1','"+dbs[i]["Match_DxGG1"]+"');\" style='"+(dbs[i]["Match_DxXpl"]!=data[i]["Match_DxXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (guest_dxp_point !="0.00"?guest_dxp_point:"") + "</a>":"")+"</div>";
				 htmls +="</div>";
				 
				 htmls +="<div class=\"hui_x2 zu_gun_3\">"+temphlose+"</div>";
				 htmls +="<div class=\"hui_x2 zu_gun_4\">";
				 htmls +="<div class=\"hui_z zu_gun_4_1\">" + (dbs[i]["Match_Hr_ShowType"]=="C" && dbs[i]["Match_BAo"] !="0"?tempsrsgl:"")+ "</div>";
				 htmls +="<div class=\"hui_z zu_gun_4_2\">"+(dbs[i]["Match_BAo"] !=null?tempsgrgl:"")+"</div>";
				 htmls +="</div>";
				 htmls +="<div class=\"hui_z_zq zu_gun_6\">";
				 htmls +="<div class=\"hui_z zu_gun_6_1\">" + (dbs[i]["Match_Bdxpk2"]!="小"?dbs[i]["Match_Bdxpk2"]:"")+ "</div>";
				 htmls +="<div class=\"hui_z zu_gun_6_2\">"+(dbs[i]["Match_Bxpl"] !=null ?"<a href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('足球滚球','上半场大小-"+dbs[i]["Match_Bdxpk2"]+"','" + dbs[i]["Match_ID"] + "','Match_Bxpl','1','1','"+dbs[i]["Match_Bdxpk2"]+"');\" style='"+(dbs[i]["Match_Bxpl"]!=data[i]["Match_Bxpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#FFCC00":"")+"'>" + (sbc_guest_dxp_point!="0.00"?sbc_guest_dxp_point:"") + "</a>":"")+"</div>";
				 htmls +="</div>";
				 htmls +="</div>";
				 htmls +="<div class=\"heju\">";
				 htmls +="<div class=\"hui_x_hj heju_zu_gun_2\">和局</div>";
				 htmls +="<div class=\"hui_x_hj zu_gun_3_1\">"+tempfdraw+"</div>";
				 htmls +="<div class='hui_x_hj heju_zq_gq_3'></div>";
				 htmls +="<div class=\"hui_x_hj zu_gun_3\">&nbsp;"+temphdraw+"&nbsp;</div>";
				 htmls +="<div class='hui_x_hj heju_zq_gq_4'></div>";
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
		JqueryDialog.Open('足球滚球', 'dialog.php?lsm='+window_lsm, 600, window_hight);
	});
});