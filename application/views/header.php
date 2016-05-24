<!--<script type="text/javascript" src="/asset/js/goods_details/jquery-2.2.0.min.js" ></script>-->
	<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js"></script>
<style>.header a {
	color: #fff;
}

.header li.d_active a {
	color: #FF5000;
}

#err_msg {
	color: red;
}</style>

<div class="header">
	<div class="d_logo fl">
		<img src="/asset/img/logo.png"/>
	</div>
	<ul class="d_tab fl">
		<li <?php if(strtolower(get_c_m()['controller']) == 'shops' && get_c_m()['method'] == 'index'){echo 'class="d_active"';} ?>>
			<a href="<?php echo site_url('shops/index') ?>">
				店铺
			</a>
		</li>
		<li <?php if(strtolower(get_c_m()['controller']) == 'orders' || strtolower(get_c_m()['controller']) == 'buy') {echo 'class="d_active"';} ?>>
			<a href="<?php echo site_url('orders/index') ?>">
				订单
			</a>
		</li>
		<li <?php if(strtolower(get_c_m()['controller']) == 'shops' && get_c_m()['method'] == 'data'){echo 'class="d_active"';} ?>>
			<a href="<?php echo site_url('shops/data') ?>">
				数据
			</a>
		</li>
		<li <?php if(strtolower(get_c_m()['controller']) == 'goods'){echo 'class="d_active"';} ?>>
			<a href="<?php echo site_url('goods/index') ?>">
				商品
			</a>
		</li>
	</ul>
	<div class="d_set rl">
		<div class="d_id fl">
			<?php echo get_user()['data']['store_name']; ?>
		</div>
		<div class="d_fenge fl">
			丨
		</div>
		<div class="d_setting fl">
			<span>设置</span>
			<img src="/asset/img/iconfont-xia.png">
		</div>
	</div>
</div>
<div class="zhe">
	
</div>
<table class="ui-dialog-grid" style="border: 1px solid #002166;position:absolute;top: 100px;left: 40%;background-color: #FFFFFF;display: none;z-index:1000;" id="change_">
	修改密码
	<tbody>
		<tr>
			<td i="header" class="ui-dialog-header">
				<button i="close" id="close_" class="ui-dialog-close" title="关闭">
					×
				</button>
				<div i="title" class="ui-dialog-title" id="title:1458890189571">
					密码修改
				</div>
			</td>
		</tr>
		<tr>
			<td i="body" class="ui-dialog-body">
				<div i="content" class="ui-dialog-content" id="content:1458890189571" style="width: 420px; height: 140px;">
					<div id="editPasswordWrap">
						<table>
							<tbody>
								<tr>
									<td class="pb-10">
										原密码：
									</td>
									<td class="pb-10">
										<input class="ipt" type="password" id="formerPwd" name="formerPwd">
											<span  style="display: none;color:red">原密码错误<span>
									</td>
								</tr>
								<tr>
									<td class="pb-10">
										新密码：
									</td>
									<td class="pb-10">
										<input class="ipt" type="password" id="pwd1">
									</td>
								</tr>
								<tr>
									<td id="password2" class="pb-10">
										重复密码：
									</td>
									<td class="pb-10">
										<input class="ipt" type="password" id="pwd2">
											<span  style="display: none;color:red">两次输入的密码不一致<span>
									</td>
								</tr>
								<tr>
									<td></td>
									<td><span id="err_msg"></span></td>
								</tr>
							</tbody>
						</table>
						<div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td i="footer" class="ui-dialog-footer">
				<div i="statusbar" class="ui-dialog-statusbar" style="display: none;">
				</div>
				<div i="button" class="ui-dialog-button">
					<button type="button" i-id="ok" autofocus="" class="ui-dialog-autofocus" id="queren">
						确&nbsp;&nbsp;定
					</button>
				</div>
			</td>
		</tr>
	</tbody>
</table>

<div id="d_fenkai" tabindex="-1"  aria-labelledby="title:1458712059088" aria-describedby="content:1458712059088" class="ui-popup ui-popup-modal ui-popup-show ui-popup-bottom-right ui-popup-follow ui-popup-focus"
	 role="alertdialog">
	<div i="dialog" class="ui-dialog">
		<div class="ui-dialog-arrow-a"></div>
		<div class="ui-dialog-arrow-b"></div>
		<table class="ui-dialog-grid">
			<tbody>
			<tr>
				<td i="header" class="ui-dialog-header" style="display: none;">
					<button i="close" class="ui-dialog-close" title="关闭">×</button>
					<div i="title" class="ui-dialog-title" id="title:1458712059088"></div>
				</td>
			</tr>
			<tr>
				<td i="body" class="ui-dialog-body" style="padding: 2px;">
					<div i="content" class="ui-dialog-content" id="content:1458712059088" style="width: 170px;">
						<ul id="configWrap" class="of-h">
							<li id="setPriceCheckbox" class="height-30 pt-5 pb-5 pl-10 bb-1 cur-p cor-grey6 password-modify active">
								<i class="icon iconfont mr-10 cor-green" style="font-size:18px;"><?php if(get_user()['data']['show_price'] == 1): ?>&#xe65d;<?php else: ?>&#xe65e;<?php endif; ?></i>价格可见
							</li>

							<li id="editPasswordBtn" class="height-30 pt-5 pb-5 pl-10 bb-1 cur-p cor-grey6 password-modify"><i class="icon iconfont mr-10 cor-green" style="font-size:18px;"></i>修改密码</li>
							<li class="height-30 pt-5 pb-5 pl-10 cor-grey6"><i class="icon iconfont mr-10 cor-green" style="font-size:18px;"></i> 管理员
							</li>
							<li class="height-30 pt-5 pb-5 pl-40 cor-grey6 "><?php echo get_user()['data']['username']; ?></li>
							<li id="loginOutBtn" class="height-30 pt-5 pb-5 pl-10 cur-p cor-grey6 login-out bt-1"><i class="icon iconfont mr-10 cor-cs" style="font-size:18px;"></i>退出</li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<td i="footer" class="ui-dialog-footer" style="display: none;">
					<div i="statusbar" class="ui-dialog-statusbar" style="display: none;"></div>
					<div i="button" class="ui-dialog-button"></div>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
<div id="gobox2" style="display: none;">
	密码修改成功！
</div>

<script type="text/javascript">
$(function() { //回到顶部以及电话
	$("#backToTop").mouseover(function() {
		$(this).children().find("p").show();
	})
	$("#backToTop").click(function() {
		//		alert($(window).scrollTop())	
		//		$('body').animate({
		//			scrollTop: 0
		//		}, 600);
//		var timer;
//		var a = $(window).scrollTop();
//		timer = setInterval(function() {
//			a = a - 100;
//			$(window).scrollTop(a);
//
//			if (a <= 100) {
//
//				clearInterval(timer);
//			}
//
//		}, 10);
		$(window).scrollTop(0);

	});
	$("#backToTop").mouseout(function() {
		$(this).children().find("p").hide();
	})
	$("#meizu").hover(function() {
		$(this).find("p").show();
	}, function() {
		$(this).find("p").hide();
	})
	$(window).scroll(function() {
		$("#liftBox").fadeIn();
	})
	$("#moduleLiftList li").hover(function() {
		$(this).find("p").show();
	}, function() {
		$(this).find("p").hide();
	});
	$("#allType").mouseout(function() {
		$("#typeList").hide();
	});
	/*分类导航条*/
	$("#moduleLiftList li").click(function() {
			var nIndex = $(this).index();
			var Number=$(".block-slides-wrap").size()
			var t = (Number*380+126)+nIndex * 680;
			$(window).scrollTop(t);
		})
		/**
		 * 退出登录
		 */
	function logout() {
		$.ajax({
			type: 'GET',
			url: '/index.php/user/logout',
			dataType: 'json',
			success: function(data) {
				if (data['return_code'] == 0) {
					location.reload();
				}
			}
		});
	}

	/**
	 * 修改密码
	 */
	function changepwd() {
		var password = $("#pwd1").val();
		var password2 = $("#pwd2").val();
		var oldpassword = $("#formerPwd").val();

		if (password == password2) {
			$.ajax({
				type: "POST",
				url: "/index.php/user/changepwd",
				data: {
					'password': password,
					'password2': password2,
					'oldpassword': oldpassword
				},
				dataType: 'json',
				success: function(data) {
					if (data['return_code'] == 0) {
						$('#err_msg').html('');
						$("#change_").hide();
						$("#gobox2").show();

						setTimeout(function() {
							$("#gobox2").hide();
							$(".zhe").hide();
							logout();
						}, 2500);
					} else {
						$('#err_msg').html(data['return_msg']);
					}
				}
			});

		}
	}

	$(".d_setting").click(function() {
		$('#d_fenkai').show();
	});

	$("#d_fenkai").hover(function() {
		$(this).show();
	},function() {
		$(this).hide();
	});

	$("#editPasswordBtn").click(function() {
		$('.zhe').show();
		$("#change_").show();
		$("#close_").click(function() {
			$('.zhe').hide();
			$("#change_").hide();
		});

		$("#pwd2").blur(function() {
			if ($("#pwd2").val() !== $("#pwd1").val()) {
				$("#pwd2").siblings("span").show();
				return false;

			}
		});
		$("#pwd2,#pwd1").focus(function() {

			$("#pwd2").siblings("span").hide();
		});
		$("#formerPwd").focus(function() {
			$("#formerPwd").siblings("span").hide();
		});

		//修改密码事件
		$("#queren").click(function() {
			changepwd();
		});

	});

	//价格可见处理
	$('body').delegate('#setPriceCheckbox', 'click', function() {
		$.ajax({
			type: 'GET',
			url: '/index.php/user/setprice',
			dataType: 'json',
			success: function(data) {
				if (data['return_code'] == 0) {
					if (data['data']['show_price'] == 0) {
						$('#setPriceCheckbox i').html('&#xe65e;');
					}

					if (data['data']['show_price'] == 1) {
						$('#setPriceCheckbox i').html('&#xe65d;');
					}

					location.reload();
				}
			}
		});
	});

	//退出登录
	$('body').delegate('#loginOutBtn', 'click', function() {
		logout();
	});
});</script>