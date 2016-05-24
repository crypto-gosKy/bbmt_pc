<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut" href="/favicon.ico" />
		<title>订单支付</title>
		<link rel="stylesheet" href="/asset/css/common/style.css" />
		<link rel="stylesheet" href="/asset/css/common/style1.css" />
		<link rel="stylesheet" href="/asset/css/good_list/goodslist.css" />
		<link rel="stylesheet" href="/asset/css/JQblockslide.css" />
		<link rel="stylesheet" href="/asset/css/index.css" />
		<link rel="stylesheet" href="/asset/css/orderconfirm.css" />
	</head>

	<body>
	<?php include_once(VIEWPATH . 'header.php'); ?>
	<input type="hidden" id="js_tid" data-tid="<?php echo $tid;?>" />

		<!--修改密码-->
<?php include_once(VIEWPATH . 'kefu.php'); ?>
		<div class="content cf" id="con-container">
			<div class="side h-100 br-1" id="menu">

				<h4 class="bt-1"><i class="icon iconfont"></i>订单管理</h4>
				<ul>
					<li><a href="<?php echo site_url('orders/index'); ?>" >所有订单 </a></li>
					<li><a href="<?php echo site_url('orders/no_pay'); ?>" class="active">待支付订单 </a></li>
				</ul>

			</div>
			<div class="main">
				<input type="hidden" id="orderId" value="5211c1fcc01b4b8b89154d8f97f7c7d3">
				<input type="hidden" id="orderNum" value="YTmd1486853032334265">
				<div class="bg-e p-10">
					<a class="mr-10">下单</a>
					<i class="icon iconfont cor-grey mr-10 fs-12"></i>
					<a class="mr-10">付款</a>
				</div>
				<div class="add-order-wrap" style="magin-top:50px;" id="mainWrap">
					<div class="m-10 b-1 p-15">
						<div class="mt-10 bb-1 pb-15">
							<div class="clearfix h-25px">
								<img src="http://ytstatic.hipac.cn/1.0.14/static/images/paysuccessicon.png" class="f-l va-m">
								<p class="f-l va-m fs-14 fw-b ml-10">订单提交成功,现在只差最后一步啦!</p>
							</div>
							<div class="pl-35 cor-9 mt-10">
								订单金额:<span>￥<?php echo $detail['pay_amount']>0 ? $detail['pay_amount'] : '0.00';?></span>
							</div>
						</div>
						<div class="mt-15">
							<?php foreach($detail['orders'] as $key => $value){ ?>
							<div class="pl-35 cor-9">
								商品名称：<span><?php echo $value['title'];?></span>
							</div>
							<?php }?>
							<div class="pl-35 cor-9 mt-10">
								收货地址：<span><?php echo $detail['shippingaddr_state'].'-'.$detail['shippingaddr_city'].'-'.$detail['shippingaddr_district'].' '.$detail['shippingaddr_address'];?>  &nbsp;<?php echo $detail['shippingaddr_name'].' '.$detail['shippingaddr_mobile'];?> </span>
							</div>
							<div class="pl-35 mt-10 cor-red">
								<i class="iconfont mr-5"></i>请核对信息是否正确,支付后将无法修改订单信息
							</div>
						</div>
					</div>
					<div class="mt-30">
						<div class="tags-wrap clearfix" id="cardTypeBox">
							<a class="last-tag active" id="otherPay">支付宝</a>
						</div>
						<div class="ml-10 mt-20 mr-10 mb-20">
							应付总金额:<span class="fs-14 cor-red">￥<span><?php echo $detail['pay_amount']>0 ? $detail['pay_amount'] : '0.00';?></span>
						</div>
						<ul class="clearfix m-10" id="savingCardList" style="display: none;">
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="savingCardRadio" id="scIcbc" value="ICBC" checked="">
									</div>
									<label for="scIcbc">
										<div class="f-l ml-10 bank bank_icbc"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="savingCardRadio" id="scBoc" value="BOC">
									</div>
									<label for="scBoc">
										<div class="f-l ml-10 bank bank_boc"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="savingCardRadio" id="scAbc" value="ABC">
									</div>
									<label for="scAbc">
										<div class="f-l ml-10 bank bank_abc"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="savingCardRadio" id="scCmb" value="CMB">
									</div>
									<label for="scCmb">
										<div class="f-l ml-10 bank bank_cmb"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="savingCardRadio" id="scCcb" value="CCB">
									</div>
									<label for="scCcb">
										<div class="f-l ml-10 bank bank_ccb"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="savingCardRadio" id="scComm" value="COMM">
									</div>
									<label for="scComm">
										<div class="f-l ml-10 bank bank_comm"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="savingCardRadio" id="scPsbc" value="PSBC">
									</div>
									<label for="scPsbc">
										<div class="f-l ml-10 bank bank_psbc"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="savingCardRadio" id="scSzpab" value="SZPAB">
									</div>
									<label for="scSzpab">
										<div class="f-l ml-10 bank bank_szpab"></div>
									</label>
								</div>

							</li>

						</ul>
						<ul class="clearfix m-10 d-n" id="creditCardList" style="display: none;">
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="creditCardRadio" id="ccIcbc" value="ICBC" checked="">
									</div>
									<label for="ccIcbc">
										<div class="f-l ml-10 bank bank_icbc"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="creditCardRadio" id="ccCcb" value="CCB">
									</div>
									<label for="ccCcb">
										<div class="f-l ml-10 bank bank_ccb"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="creditCardRadio" id="ccCmb" value="CMB">
									</div>
									<label for="ccCmb">
										<div class="f-l ml-10 bank bank_cmb"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="creditCardRadio" id="ccBoc" value="BOC">
									</div>
									<label for="ccBoc">
										<div class="f-l ml-10 bank bank_boc"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="creditCardRadio" id="ccComm" value="COMM">
									</div>
									<label for="ccComm">
										<div class="f-l ml-10 bank bank_comm"></div>
									</label>
								</div>

							</li>
							<li class="f-l mr-40 mb-20">
								<div class="clearfix b-1 p-10">
									<div class="pt-5 f-l">
										<input type="radio" name="creditCardRadio" id="ccSzpab" value="SZPAB">
									</div>
									<label for="ccSzpab">
										<div class="f-l ml-10 bank bank_szpab"></div>
									</label>
								</div>

							</li>

						</ul>
						<ul class="clearfix m-10 d-n" id="otherPayList" style="display: block;">
							<li class="f-l mr-40">
								<div class="clearfix b-1 pt-5 pb-5 pl-15 pr-15">
									<div class="pt-10 f-l">
										<input type="radio" name="payRadio" id="aliPayRadio" value="aliPay" checked="">
									</div>
									<label for="aliPayRadio">
										<div class="f-l ml-10 cur-p"><img src="http://ytstatic.hipac.cn/1.0.14/static/images/zfblogo.png" class="f-l"></div>
									</label>
								</div>
							</li>
						</ul>
					</div>

					<div class="clearfix pt-10 pb-10 pl-10 pb-20 mt-10 mb-10 mr-20">
						<a id="openPage" class="f-l" target="_blank"><span class="btn f-l" id="confirmPayBtn" disabled="disabled">确认支付&nbsp;</span></a>
						<p class="f-l lh-20 ml-10 cor-3"><i class="iconfont mr-5 cor-red"></i>注:请在<span class="cor-red">24小时</span>内完成支付!</p>
					</div>

				</div>

			</div>
		<!-- excel导出form  -->
			<form action="" id="excelform" class="d-n">
			</form>

		</div>
		<div class="footer"></div>
		<div id="gobox" class="ta-l p-10" style="display: none;">
			<h1 style="font-weight: 600;font-size: 16px;border-bottom: 1px solid #999;padding-bottom:8px;">请付款</h1>
			<br>
			<div style="color:red;text-align: center;font-size: 16px;margin:20px 0px;font-weight: 600;">请您在新打开的页面完成付款</div>
			<br>
			<div style="font-size: 15px;margin-left: 25px;font-weight: 600;">付款完成前请不要关闭此窗口</div>
					<div style="font-size: 15px;margin-left: 25px;">完成付款后请根据您的具体情况点击下面的按钮</div>
			<br>
			<a id="continueOrder1" class="b-btn active" href="/index.php/orders/index"style="margin-left: 90px;"> &lt; &nbsp;已完成付款</a>
			<a id="showOrder1" class="b-btn active ml-10 mr-10" style="display: none;">查看我的订单</a>
			<a id="payOrder1" class="btn" style="margin-left: 20px;">重新支付</a>
			</div>
			<div class="zhe" style="display: none;"></div>
			<div id="gobox1" class="box_nopay" style="display: none;">
				<div>支付未完成，请重新支付</div>
			</div>

	</body>
		<script type="text/javascript" src="/asset/js/goods_details/jquery-2.2.0.min.js" ></script>
	<script type="text/javascript" src="../../../asset/js/orders/payment.js" ></script>

</html>