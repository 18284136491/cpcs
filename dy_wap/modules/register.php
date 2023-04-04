<div id="J_regModal" class="reg-modal modal">
		<div class="inner container" style="padding-bottom:100px;">
			<div class="close" data-target="#J_regModal">&times;</div>
			<h1>— 注册 —</h1>
			<form action="" id="register_form" class="form-horizontal">
				<h2>登录资料</h2>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">会员账号：</label>
					<div class="col-sm-4">
					<input type="text" name="zcname" id="zcusername" class="form-control">
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>您在网站的登录账户，5-12个英文数字</span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">会员密码：</label>
					<div class="col-sm-4">
					<input type="password" name="zcpwd1" id="zcpwd1" maxlength="12" onblur="pwStrength(this.value,0);"  class="form-control">
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>由6-12位任意字符组成</span>
					</div>
				</div>
				<div class="form-group password-degree">
					<label for="" class="col-sm-2 control-label">密码强度：</label>
					<div class="col-sm-4">
						<div class="btn-group">
						  <button id="strength_L0" type="button" class="btn btn-default">弱</button>
						   <button id="strength_M0" type="button" class="btn btn-default">中</button>
						   <button id="strength_H0" type="button" class="btn btn-default">强</button>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">确认密码：</label>
					<div class="col-sm-4">
					<input type="password" name="zcpwd2" id="zcpwd2" maxlength="12" class="form-control">
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>由6-12位任意字符组成</span>
					</div>
				</div>
				<h2>个人资料</h2>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">持卡人姓名：</label>
					<div class="col-sm-4">
					<input type="text" name="zcturename" id="zcturename" class="form-control"></div>
					<div class="col-sm-6">
					<strong>*</strong><span>名字必须与您用于提款及存款的银行户口所用名字相同</span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">QQ：</label>
					<div class="col-sm-4">
					<input type="text" name="zctel" id="zctel" class="form-control">
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>请填写您的QQ以便我们线下联系您</span>
					</div>
				</div>
				<div class="form-group" <?php if(isset($_COOKIE['f']) && intval($_COOKIE['f']) ) {echo "style=\"display:none\"";}?>>
					<label for="" class="col-sm-2 control-label">介绍人：</label>
					<?php
						$referrals = '';
						if(isset($_COOKIE['tum']) && $_COOKIE['tum']!=null)
						{
							$referrals = $_COOKIE['tum'];
						}
					?>
					<div class="col-sm-4">
					<input type="text" name="jsr" id="jsr" value="<?=$referrals?>" class="form-control">
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>可不填,如果您是本站会员介绍过来,请填写该会员账号</span>
					<?php if(isset($_COOKIE['t']) && $_COOKIE['t']=="daili") { ?>
					<input name="type" type="hidden" value="daili" />
					<?php }?>
					</div>
				</div>
				<div class="form-group" style="display:<?=$_COOKIE['t']=="daili"?"block":"none"?>;">
					<label for="" class="col-sm-2 control-label">代理模式：</label>
					<div class="col-sm-4">
					<label class="checkbox-inline">
					<input name="daili_mode" type="radio" value="0" checked="checked"/>占成模式 </label>
					<label class="checkbox-inline">
					<input name="daili_mode" type="radio" value="1"/>返水模式</label>
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>请选择您想申请的代理的分成模式</span>
					</div>
				</div>
				<h2>保密资料</h2>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">密码提示问题：</label>
					<div class="col-sm-4">
						<select name="zcquestion" id="zcquestion" class="form-control">
						<option value="您的车牌号码是多少？">您的车牌号码是多少？</option>
						<option value="您初中同桌的名字？">您初中同桌的名字？</option>
						<option value="您就读的第一所学校的名称？">您就读的第一所学校的名称？</option>
						<option value="您第一次亲吻的对象是谁？">您第一次亲吻的对象是谁？</option>
						<option value="少年时代心目中的英雄是谁？">少年时代心目中的英雄是谁？</option>
						<option value="您最喜欢的休闲运动是什么？">您最喜欢的休闲运动是什么？</option>
						<option value="您最喜欢哪支运动队？">您最喜欢哪支运动队？</option>
						<option value="您最喜欢的运动员是谁？">您最喜欢的运动员是谁？</option>
						<option value="您的第一辆车是什么牌子？">您的第一辆车是什么牌子？</option>
						</select>
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>请选择密保问题</span>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">密码问题答案：</label>
					<div class="col-sm-4">
					<input type="text" name="zcanswer" id="zcanswer" class="form-control">
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>请填写您的密保答案</span>
					</div>
				</div>
				<h2>取款资料</h2>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">取款密码：</label>
					<div class="col-sm-4">
					<input type="password" name="qkpwd1" id="qkpwd1" maxlength="12" onblur="pwStrength(this.value,1);" class="form-control">
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>由6-12位任意字符组成</span>
					</div>
				</div>
				<div class="form-group password-degree">
					<label for="" class="col-sm-2 control-label">密码强度：</label>
					<div class="col-sm-4">
					<div class="btn-group">
						  <button id="strength_L1" type="button" class="btn btn-default">弱</button>
						   <button id="strength_M1" type="button" class="btn btn-default">中</button>
						   <button id="strength_H1" type="button" class="btn btn-default">强</button>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">确认密码：</label>
					<div class="col-sm-4">
					<input type="password" name="qkpwd2" id="qkpwd2" maxlength="12" class="form-control">
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>由6-20位任意字符组成</span>
					</div>
				</div>
				<div class="form-group captcha-row">
					<label for="" class="col-sm-2 control-label">验证码：</label>
					<div class="col-sm-4">
						<div class="input-group">
						<input type="text" name="zcyzm" id="zcyzm" class="form-control" style="height:44px;">
						<span class="input-group-addon" style="width:50%;">
						<img src="yzm.php" alt="点击刷新" name="zc_img" id="zc_img" style="cursor:pointer;" onclick="change_zc_yzm('zc_img')" width="80" height="30" />
						</span>
						</div>
					</div>
					<div class="col-sm-6">
					<strong>*</strong><span>请填写验证码</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 col-sm-offset-2">
					<input type="checkbox" name="zccheck" id="zccheck" value="1"> 我已届满合法博彩年龄﹐且同意各项开户条约。<a href="#" id="AGREEMENT" class="red">"开户协议"</a>
					</label>
				</div>
				<div class="form-group form-action">
					<div class="col-sm-4 col-sm-offset-2">
					<button class="btn btn-green btn-lg btn-block" id="register">提交</button>
					</div>
					<!-- <div class="col-sm-5">
					<input type="reset" value="重填" class="btn btn-danger" id="cancel_register" />
					</div> -->
				</div>
				<div class="h10"></div>
			</form>
		</div>
	</div>