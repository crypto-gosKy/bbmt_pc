<!doctype html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit">
		<meta charset="utf-8">
		<link rel="stylesheet" href="/asset/css/common/global.css">
		<link rel="stylesheet" href="/asset/css/login.css">
		<link rel="stylesheet" href="/asset/css/widget.css">
		<link rel="shortcut" href="/favicon.ico" />
		<title>
			宝贝码头
		</title>

	</head>
	<body>
		<input type="hidden" id="basePath" value="" />
		<div class="login-container">
			<div class="va-m w-100" style="display: table-cell">
				<div class="login-box">
					<div class="login-text">
						<p class="login-p">
							宝贝码头
						</p>
						<p class="login-p1">
							商家登录后台
						</p>
					</div>
					<div class="login-outer">
						<div class="login-ipts">
							<form id="aform" name="formLogin" action="/index.php?m=default&c=user&a=login" method="post" class="validforms">
								<div class="ipt-wrap">
									<div class="ipt-icon">
										<i class="iconfont" style="font-size: 24px;">&#xe630;</i>
									</div>
									<label class="placeholder d-n">请输入您的手机</label>
									<input name="username" placeholder="请输入您的手机" value="" id="username" type="text" data-type="mobile" class="login-ipt require" autocomplete="off" />
								</div>
								<div class="ipt-wrap">
									<div class="ipt-icon">
										<i class="iconfont" style="font-size: 24px;">&#xe650;</i>
									</div>
									<label class="placeholder d-n">密码</label>
									<input name="password" id="password" placeholder="密码" type="password" data-type="password" class="login-ipt require" />
								</div>
								<div class="clearfix">
								</div>
								<div class="login-btn">
									登录
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="link-wrap mt-40" style="margin-top: 60px">
					<div class="link-inner clearfix">
					</div>
				</div>
			</div>
			<div class="w-100 mb-10 ta-c pos-a" style="top: 96%; left: 0; min-width: 1000px;">
			</div>
		</div>
		<div class="footer">
		</div>
		<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js">
		</script>
		<script type="text/javascript" src="/asset/js/login.js">
		</script>
	</body>
</html>