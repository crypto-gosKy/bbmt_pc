<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut" href="/favicon.ico" />
		<title>订单详情</title>
		<link rel="stylesheet" href="/asset/css/common/style.css" />
		<link rel="stylesheet" href="/asset/css/common/style1.css" />
		<link rel="stylesheet" href="/asset/css/tablel_page/jq-tabel.css" />
		<link rel="stylesheet" href="/asset/css/good_list/goodslist.css" />
		<link rel="stylesheet" href="/asset/css/item_list/itemIndex.css" />
		<link rel="stylesheet" href="/asset/css/JQblockslide.css" />
		<link rel="stylesheet" href="/asset/css/index.css" />
		<link rel="stylesheet" href="/asset/css/orders_detail/itemDetail.css" />
		<link rel="stylesheet" href="/asset/css/order Detail.css" />
	</head>

	<body>
		<?php include_once(VIEWPATH . 'header.php'); ?>

		<!--修改密码-->

		<div class="content cf" id="con-container">
			<div class="side h-100 br-1" id="menu">

				<h4 class="bt-1"><i class="icon iconfont"></i>订单管理</h4>
				<ul>
					<li><a href="<?php echo site_url('orders/index'); ?>" class="active">所有订单 </a></li>
					<li><a href="<?php echo site_url('orders/no_pay');?>">待支付订单 </a></li>
				</ul>

			</div>
			<?php include_once(VIEWPATH . 'kefu.php'); ?>
			<div class="main">
				<div class="bg-e p-10">
					<a class="mr-10">下单</a> <i class="icon iconfont cor-grey mr-10 fs-12"></i>
					<a onclick="history.back()" class="mr-10 cur-p">订单列表</a> <i class="icon iconfont cor-grey mr-10 fs-12"></i>
					<a class="mr-10">订单详情</a>
				</div>
				<div class="order-detail" id="mainWrap">
					<div class="m-20">
						<div class="flow-step">
							<ol class="flowstep-5">
								<li class="step-first">
									<div class="step-done">
										<div class="step-name">买家下单</div>
										<div class="step-no"></div>
										<div class="step-time">
											<div class="step-time-wraper"> </div>
										</div>
									</div>
								</li>
								<li>
									<?php if($order['trade_status'] >= 4): ?>
										<div class="step-done">
											<div class="step-name">买家付款</div>
											<div class="step-no"></div>
										</div>
									<?php elseif($order['trade_status'] == 0 && $order['pay_time'] > 0): ?>
										<div class="step-done">
											<div class="step-name">买家付款</div>
											<div class="step-no"></div>
										</div>
									<?php else: ?>
										<div class="step-cur">
											<div class="step-name">买家付款</div>
											<div class="step-no">2</div>
										</div>
									<?php endif; ?>
								</li>
								<li>
									<?php if($order['trade_status'] >= 4): ?>
										<div class="step-done">
											<div class="step-name">支付采购金额</div>
											<div class="step-no"></div>
										</div>
									<?php elseif($order['trade_status'] == 0 && $order['pay_time'] > 0): ?>
										<div class="step-done">
											<div class="step-name">支付采购金额</div>
											<div class="step-no"></div>
										</div>
									<?php else: ?>
										<div>
											<div class="step-name">支付采购金额</div>
											<div class="step-no">3</div>
										</div>
									<?php endif; ?>
								</li>
								<?php if($order['trade_type'] == 1):?>		<!--保税区的发货流程变化-->
								<li>
									<?php if($order['trade_status'] >= 6): ?>
										<div class="step-done">
											<div class="step-name">海关报关中</div>
											<div class="step-no"></div>
										</div>
									<?php elseif($order['trade_status'] == 4): ?>
										<div class="step-cur">
											<div class="step-name">海关报关中</div>
											<div class="step-no">4</div>
										</div>
									<?php elseif($order['trade_status'] == 0 && $order['pay_time'] > 0): ?>
										<div class="step-cur">
											<div class="step-name">海关报关中</div>
											<div class="step-no">4</div>
										</div>
									<?php else: ?>
										<div>
											<div class="step-name">海关报关中</div>
											<div class="step-no">4</div>
										</div>
									<?php endif; ?>
								</li>
								<li>
									<?php if($order['trade_status'] >= 10): ?>
										<div class="step-done">
											<div class="step-name">保税仓发货</div>
											<div class="step-no"></div>
										</div>
									<?php elseif($order['trade_status'] == 8): ?>
										<div class="step-cur">
											<div class="step-name">保税仓发货</div>
											<div class="step-no">5</div>
										</div>
									<?php else: ?>
										<div>
											<div class="step-name">保税仓发货</div>
											<div class="step-no">5</div>
										</div>
									<?php endif; ?>

								</li>
								<li class="step-last">
									<?php if($order['trade_status'] == 100): ?>
										<div class="step-done">
											<div class="step-name">买家收货</div>
											<div class="step-no"></div>
										</div>
									<?php elseif($order['trade_status'] == 10): ?>
										<div class="step-cur">
											<div class="step-name">买家收货</div>
											<div class="step-no">6</div>
										</div>
									<?php else: ?>
										<div>
											<div class="step-name">买家收货</div>
											<div class="step-no">6</div>
										</div>
									<?php endif; ?>

								</li>
								<?php else: ?>   <!--保税区的发货流程变化结束,下面是国内仓的情况-->
								<li>
									<?php if($order['trade_status'] >= 10): ?>
										<div class="step-done">
											<div class="step-name">已发货</div>
											<div class="step-no"></div>
										</div>
									<?php elseif($order['trade_status'] == 8): ?>
										<div class="step-cur">
											<div class="step-name">已发货</div>
											<div class="step-no">4</div>
										</div>
									<?php else: ?>
										<div>
											<div class="step-name">已发货</div>
											<div class="step-no">4</div>
										</div>
									<?php endif; ?>

								</li>
								<li class="step-last">
									<?php if($order['trade_status'] == 100): ?>
										<div class="step-done">
											<div class="step-name">买家收货</div>
											<div class="step-no"></div>
										</div>
									<?php elseif($order['trade_status'] == 10): ?>
										<div class="step-cur">
											<div class="step-name">买家收货</div>
											<div class="step-no">5</div>
										</div>
									<?php else: ?>
										<div>
											<div class="step-name">买家收货</div>
											<div class="step-no">5</div>
										</div>
									<?php endif; ?>

								</li>
								<?php endif;?><!--国内仓的流程变化结束-->
							</ol>
						</div>
					</div>
					<div class="ml-20 mr-20 mt-20 b-1 p-20">
						<div>
							<div class="fs-15 mb-20 fw-b">
								当前状态：
								<span class="cor-red">
									<?php if($order['trade_status'] == 1): ?>   未付款 <?php endif; ?>
									<?php if($order['trade_status'] == 4): ?>   已付款 <?php endif; ?>
									<?php if($order['trade_status'] == 8): ?>   待发货 <?php endif; ?>
									<?php if($order['trade_status'] == 10): ?>  已发货 <?php endif; ?>
									<?php if($order['trade_status'] == 100): ?> 已收货 <?php endif; ?>
									<?php if($order['trade_status'] == 0): ?>   已关闭 <?php endif; ?>
								</span>
							</div>
							<?php if($order['trade_status'] == 0): ?>
							<div class="mb-20">
								 关闭原因：
								<span >
									<?php  echo $order['orders'][0]['close_mark'];?>
								</span>
							</div>
							<?php endif; ?>
							<div>
								订单编号：<?php echo $order['tid']; ?>
							</div>

						</div>
					</div>
					<div class="info-wrap">
						<div class="info-title">
							订单明细
						</div>
						<ul class="info-body p-20">
							<li class="clearfix p-20">
								<div class="f-l">
									<div class="mb-10">收货信息：<span class="mr-10"><?php echo $order['shippingaddr_state']; ?>-<?php echo $order['shippingaddr_city']; ?>-<?php echo $order['shippingaddr_district']; ?> &nbsp;&nbsp; <?php echo $order['shippingaddr_address']; ?></span><span class="mr-10"> <?php echo $order['shippingaddr_name']; ?> </span><span class="mr-10"><?php echo $order['shippingaddr_mobile'] ?></span> </div>
									<div>报关信息：<span class="mr-10"><?php echo $order['shippingaddr_name']; ?></span><span class="mr-10"><?php echo $order['shippingaddr_mobile'] ?></span><span class="mr-10">
											<?php if(isset($order['shippingaddr_idcard']) && $order['shippingaddr_idcard']){echo substr_replace($order['shippingaddr_idcard'],'********',6,8);} ?>
										</span></div>
									<div class="<?php if($order['trade_status'] < 10){ echo 'd-n';}?>">
									<div class="mt-10">物流信息：<span class="ff-w">（最新）</span></div>
									<div class="mt-10" id="logisticsBox" data-invoice_no="<?php echo $order['orders'][0]['invoice_no'];?>" data-logistics_company="<?php echo $order['orders'][0]['logistics_company'];?>"></div>
									</div>
								</div>
							</li>
							<li>
								<table width="100%" class="order-detail-table" style="border: 1px solid;">
									<tbody>
										<tr class="header-tr">
										</tr>
										<tr class="header-tr">
											<td width="40%">商品</td>
											<td width="10%">规格数量</td>
											<td width="10%">规格单价</td>
											<td width="10%">净重(g)</td>
											<td width="10%">采购价</td>
											<td width="10%">运费</td>
											<td width="10%">操作</td>
										</tr>
										<?php foreach($order['orders'] as $item): ?>
										<tr>
											<td class="ta-ltd">
												<div class="clearfix">
													<a href="<?php echo site_url('goods/detail?item_id=' . $item['item_id']); ?>" target="_blank">
														<img src="<?php echo $item['pic_url'];?>" width="60" height="60" class="f-l mr-10">
													</a>
													<div class="f-l w-70">
														<div class="goods-title">
															<a href="<?php echo site_url('goods/detail?item_id=' . $item['item_id']); ?>" target="_blank" class="title">
																<?php echo $item['title']; ?>
															</a>
														</div>
														<div class="cor-grey5"><?php echo $item['sku_spec_name']; ?></div>
													</div>

												</div>
											</td>
											<td><?php echo $item['num']; ?></td>
											<td>
												<?php echo $item['price']; ?>
											</td>
											<td>
												0
											</td>
											<td>
												<?php echo $item['total_fee']; ?>
											</td>
											<td>
												￥0.00
												<p>(快递)</p>
											</td>
											<td>
												<?php if($order['trade_status'] == 10){?>
													<a class="btn btn-purple mt-10" id="confirmReceive" data-tid="<?php echo $order['tid']; ?>">确认收货</a>
												<?php }else{?>
													-
												<?php }?>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</li>
							<li class="clearfix bb-1 mb-10" style="padding-bottom: 20px">
								<div class="f-l cor-greys">

								</div>
								<div class="f-r">
									成本价：<span class="cor-red fw-b fs-14">￥<?php echo $order['pay_amount']; ?></span>
								</div>
							</li>
							<li class="clearfix li-p10">
								<span class="col-w f-l">下单时间：<?php echo $order['created']; ?></span>
								<?php if($order['trade_status'] > 4): ?>
								<span class="col-w f-l">支付时间：<?php echo $order['pay_time']; ?></span>
								<?php endif;?>
							</li>
							<li class="clearfix li-p10">
<!--								<span class="col-w f-l">下单门店：xxx</span>-->
							</li>
							<li class="clearfix li-p10 mb-20">
<!--								<span class="col-w f-l">推广店员：阳光明媚（18657126827）</span>-->
							</li>
						</ul>
					</div>

				</div>

			</div>
			<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js"></script>
			<script type="text/javascript" src="/asset/js/orders/order_detail.js"></script>

	</body>

</html>