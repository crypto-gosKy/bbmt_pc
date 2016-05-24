<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="shortcut" href="/favicon.ico" />
		<title>店铺</title>
		<link rel="stylesheet" href="/asset/css/common/style.css" />
		<link rel="stylesheet" href="/asset/css/common/style1.css" />
		<link rel="stylesheet" href="/asset/css/jq-tabel.css" />
		<link rel="stylesheet" href="/asset/css/good_list/goodslist.css" />
		<link rel="stylesheet" href="/asset/css/item_list/itemIndex.css" />
		<link rel="stylesheet" href="/asset/css/JQblockslide.css" />
		<link rel="stylesheet" href="/asset/css/index.css" />
	</head>

	<body>
		<?php include_once(VIEWPATH . 'header.php'); ?>
		<!--修改密码-->

		<div class="content cf" id="con-container">
			<div class="side h-100 br-1" id="menu">

				<h4 class="bt-1"><i class="icon iconfont"></i>门店设置</h4>

				<ul>
					<li><a href="d_dianpu.html" class="active">基本信息 </a></li>
				</ul>

			</div>
			<?php include_once(VIEWPATH . 'kefu.php'); ?>
			<div class="main">

				<div class="bg-e p-10">
					<a class="mr-10">门店设置</a>
					<i class="icon iconfont cor-grey mr-10 fs-12"></i>
					<a class="mr-10">基本信息</a>

				</div>
				<div class="add-order-wrap" style="magin-top:50px;" id="mainWrap">
					<div class="m-20 b-1">
						<h4 class="bg-fa pt-10 pb-10 bb-1 fw-b pl-20 bt-1">门店基本信息</h4>
						<form class="addressForm" id="addressForm">
							<input type="hidden" name="id" value="32f84ab5ad0243c19137841016d3a283">
							<input type="hidden" name="recordAddress" id="isRecordAddress" value="">
							<input type="hidden" name="addDeleteId" value="" id="addDeleteId">
							<input type="hidden" name="recordShop" value="0" id="recordShop">
							<table class="w-100 fs-14">
								<tbody>
									<tr>
										<td class="pt-10 pb-10 ta-r w-150px">门店名称: </td>
										<td class="pl-10"><span><?php echo $info['shop_name']; ?></span>
										</td>
									</tr>
									<tr>
										<td class="pt-10 pb-10 ta-r w-150px">联系人: </td>
										<td class="pl-10"><span><?php echo $info['shop_contacts']; ?></span></td>
									</tr>
									<tr>
										<td class="pt-10 pb-10 ta-r w-150px">门店所属城市: </td>
										<td class="pl-10"><span><?php echo $info['state'];  ?>-<?php echo $info['city']; ?>-<?php echo $info['district']; ?></span></td>
									</tr>
									<tr>
										<td class="pt-10 pb-10 ta-r"><span class="red">*</span>门店地址:
											<br>
										</td>
										<td class="pl-10">
											<div id="address" class="b-1">
												<table class="address-table w-100" id="address-table">
													<tbody>
														<tr style="background-color: #F5F5F5">
															<td width="240" class="pt-10 pb-10 pl-10" style="border-bottom:1px solid #CCC">收货地址</td>
															<td width="100" class="pt-10 pb-10 pl-10" style="border-bottom:1px solid #CCC;">联系电话</td>
															<td width="50" class="pt-10 pb-10" style="border-bottom:1px solid #CCC;"> </td>
														</tr>
														<tr class="listrowArea">
															<td class="pt-10 pb-10 pl-10">
																<?php echo $info['address']; ?>
															</td>
															<td class="pt-10 pb-10 pl-10">
																<?php echo $info['mobile']; ?>
																<input type="hidden" name="addressId[$num]" value="">
															</td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</div>
										</td>
									</tr>

									<tr>
										<td class="pt-10 pb-10 ta-r w-150px"></td>
										<td class="pt-10 pb-10 pl-10">

										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>

				</div>

			</div>

		</div>
		<div class="footer"></div>

		<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js"></script>
	</body>

</html>