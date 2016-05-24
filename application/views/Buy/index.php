<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut" href="/favicon.ico" />
		<title>订单确认</title>
		
		<link rel="stylesheet" href="/asset/css/common/style.css" />
		<link rel="stylesheet" href="/asset/css/common/style1.css" />
		<link rel="stylesheet" href="/asset/css/jq-tabel.css" />
		<link rel="stylesheet" href="/asset/css/good_list/goodslist.css" />
		<link rel="stylesheet" href="/asset/css/itemIndex.css" />
		<link rel="stylesheet" href="/asset/css/JQblockslide.css" />
		<link rel="stylesheet" href="/asset/css/itemDetail.css" />

	</head>
	<body style="background-color: #fff;">
		
		<?php include_once (VIEWPATH . 'header.php'); ?>

		<div class="content cf" id="con-container">
			<div class="fixed-container" style="margin-top: 75px;">
				<input type="hidden" value="1911" id="defItemId" data-cateid="154" data-brandid="561">
				<input type="hidden" id="goodsId" value="1911">
				<input type="hidden" id="specId" value="46583">
				<input type="hidden" value="32f84ab5ad0243c19137841016d3a283" id="shopId">
				<input type="hidden" value="1232" id="shopAreaId">
				<input type="hidden" value="" id="orderId">
				<input type="hidden" value="472" id="stock">
				<input type="hidden" id="defaultAddressId" name="addressId" value="">
				<input type="hidden" id="defaultSourceEnum" name="sourceEnum" value="">
				<div class="add-order-wrap" style="magin-top:50px;" id="mainWrap">
					<div class="m-20 pt-10">
						<div class="fs-18 fw-b cor-3 mt-20">
							收货地址选择
						</div>
						<div class="tags-wrap no-border clearfix ml-0 mt-20" id="tagsWrap">
							<a class="first-tag active fs-12" data-type="2">
								常用地址
							</a>
							<!--<a class="last-tag fs-12" data-type="1">
							消费者地址
							</a>-->
						</div>
						<div class="b-1 pt-20 pb-20 pl-10 pr-10">
							<div class="add-box" id="addNormalBox">
								<?php if(!empty($address)){
									foreach($address as $key => $addr){?>
									<div class="lh-18 add-item pl-20 pt-5 pr-20 clearfix <?php if ($addr['is_default']): ?>add-selected<?php endif; ?>">
										<div class="f-l address-wrap cur-p">
											<input type="radio" name="addNormalSelect" <?php if ($addr['is_default']): ?>checked="checked"<?php endif; ?> />
											<input type="hidden" name="address_data" data-id="<?php echo $addr['addr_id']; ?>" />
											<span class="ml-10 data-state"><?php echo $addr['state']; ?></span>
											<span class="ml-5 data-city"><?php echo $addr['city']; ?></span>
											<span class="ml-5 data-district"><?php echo $addr['district']; ?></span>
											<span class="ml-5 data-address"><?php echo $addr['address']; ?></span>
											<span class="ml-10 data-name"><?php echo $addr['name']; ?></span>
											<span class="ml-10 data-mobile"><?php echo $addr['mobile']; ?></span>
											<span class="ml-10 data-idcard">
											<?php if ($orderInfo['trade_type'] == 1) {
													 if(isset($addr['idcard']) && $addr['idcard'])
													 {echo substr_replace($addr['idcard'],'********',6,8);}
											} ?>
											</span>
											<span class="ml-10 data-id_card" style="display: none;"><?php echo $addr['idcard']; ?></span>
										</div>
										<span class="f-r add-deal-box d-n">
											<a class=" cor-blue cur-p  mr-10 setDefaultBtn" data-addr_id="<?php echo $addr['addr_id']; ?>">设为默认地址</a>
											<a class="cor-blue cur-p mr-20 edit-btn" data-type="<?php echo $orderInfo['trade_type']; ?>" data-addr_id="<?php echo $addr['addr_id']; ?>" data-idcard="<?php echo $addr['idcard'];?>"> 修改 </a>
											<a class="cor-blue cur-p del-btn" data-addr_id="<?php echo $addr['addr_id']; ?>"> 删除</a>
										</span>
									</div>
								<?php }} ?>
							</div>
							<div class="add-more-box pl-40 mt-10" id="addMoreBox">
								<span class="cur-p cor-9 ml-5 mr-10 d-n" id="moreAddBtn" style="display: none;">更多常用地址<i class="iconfont"></i></span>
								<span class="cor-blue cur-p ml-5" id="newAddBtn" data-type="<?php echo $orderInfo['trade_type']; ?>">新增收货地址</span>
							</div>
							<div class="mt-20 pt-20 bt-1 d-n" id="addEditBox" style="display:none;">
								<form id="addressForm">
									<input type="hidden" id="customerId" name="customerId" value="">
									<input type="hidden" id="addressId" name="addressId" value="0">
									<div class="clearfix h-30px">
										<div class="f-l w-70px ta-r fw-b">
											*手机号:
										</div>
										<div class="f-l w-800px ml-20">
											<input type="text" placeholder="输入可联系手机号" maxlength="11" id="customerPhone" name="deliveryPhone" class="pt-5 pb-5 pl-10 pr-10 w-200px">
										</div>
									</div>
									<div class="clearfix h-30px mt-10" id="cardID" style="display: none;">
										<div class="f-l w-70px ta-r fw-b">
											*身份证号:
										</div>
										<div class="f-l w-800px ml-20">
											<input type="text" placeholder="请输入报关身份证" id="custIdNum" name="custIdNum" class="pt-5 pb-5 pl-10 pr-10 w-200px">
											<span id="custNumTip">
											</span>
											<span class="cor-red ml-10 cur-p" id="cardReason">为什么要身份证?</span>
										</div>
									</div>
									<div class="clearfix h-30px mt-10">
										<div class="f-l w-70px ta-r fw-b">
											*收货人:
										</div>
										<div class="f-l w-800px ml-20">
											<input type="text" placeholder="请输入与身份证号匹配的姓名" id="custName" name="deliveryName" class="pt-5 pb-5 pl-10 pr-10 w-200px">
											<span class="cor-red ml-10" id="receiveName" style="display: none;">姓名必须与身份证号相匹配</span>
										</div>
									</div>
									<div class="clearfix h-30px mt-10">
										<div class="f-l w-70px ta-r fw-b">
											*所属区域:
										</div>
										<div class="f-l w-800px ml-20" id="selectWrap">
											<select  name="province" id="province" >
											</select>
											<select name="city" id="city">
											</select>
											<select  name="area" id="area">
											</select>
										</div>
									</div>
									<div class="clearfix mt-10">
										<div class="f-l w-70px ta-r fw-b">
											*详细地址:
										</div>
										<div class="f-l w-800px ml-20">
											<textarea rows="3" placeholder="请输入详细收货地址" name="addressDetail" id="custAddressDetail" class="w-550px pt-5 pb-5 pl-10 pr-10"></textarea>	
											<p class="cor-red mt-5">
												<!--		为避免地址使用频繁被海关拉黑,请尽量使用消费者地址收货-->
											</p>
											<div class="mt-20" id="oprBtnWrap">
												<a class="btn" id="saveAddBtn">
													保存
												</a>
												<a class="btn btn-secondary ml-20" id="cancelAddBtn">
													取消
												</a>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="m-20 pt-10">
						<div class="fs-18 fw-b cor-3 mt-20">
							确认商品信息
						</div>
						<?php if(isset($orderInfo)){?>
							<input type="hidden" id="js_item_info" data-itemid="<?php echo $orderInfo['orders']['item_id']; ?>" data-skuid="<?php echo $orderInfo['orders']['sku_id']; ?>"
							data-tradetype="<?php echo $orderInfo['trade_type']; ?>" />
						<table class="mt-20 w-100 b-1">
							<tbody>
								<tr class="bb-1 lh-20">
									<th class="w-30">
										商品
									</th>
									<th class="w-10">
										规格价(元)
									</th>
									<th class="w-10">
										规格数量
									</th>
									<th class="w-10">
										净重(g)
									</th>
									<th class="w-10">
										价格(元)
									</th>
									<th class="w-10">
										配送方式
									</th>
								</tr>
								
								<tr class="ta-c" id="tr">
									<td >
										<div class="clearfix p-5">
											<div class="f-l h-60 w-60px of-h">
												<img src="<?php echo $orderInfo['orders']['pic_url']?>" class="w-60px">
											</div>
											<div class="f-l ta-l w-350px of-h ml-10">
												<div class="h-20px cor-3 fw-b of-h" title="<?php echo $orderInfo['orders']['title']?>">
													<?php echo $orderInfo['orders']['title']?>
												</div>
												<div class="h-20px cor-9 of-h">
													规格:<span id="specNum"><?php echo $orderInfo['orders']['sku_spec_name']; ?></span>
												</div>
											</div>
										</div>
									</td>
									<td>
										<span id="specPrice"><?php echo $orderInfo['orders']['price']; ?></span>
									</td>
									<td class="ta-c">
										<input type="hidden" id="addcount" value="<?php echo $orderInfo['orders']['num']; ?>">
										<?php echo $orderInfo['orders']['num']; ?>
									</td>
									<td>
										--
									</td>
									<td>
										<span id="specTotalPrice">
											<?php if($orderInfo['orders']['total_fee'] !== '--'){ ?>
											￥
											<?php }?>
											<?php echo $orderInfo['orders']['total_fee']; ?>
										</span>
									</td>
									<td>
										快递
									</td>
								</tr>
							</tbody>
						</table>
						<?php if($orderInfo['orders']['total_fee'] !== '--'){ ?>
						<div class="p-10 bl-1 br-1 bb-1" style="overflow: hidden;">
							<div class="f-r">				
							<p class=" lh-18">
								合计:<span  class="fs-14 fw-b">¥<b class="fw-b" id="orderTotalPrcie"><?php echo $orderInfo['orders']['total_fee']; ?></b></span>
							</p>
							<div class=" lh-18">运费：<span id="logistics_fee"><?php echo (isset($orderInfo['logistics_fee']) && $orderInfo['logistics_fee'])? $orderInfo['logistics_fee'] :'0.00'?></span>元</div>
							</div>		
							<?php if(isset($orderInfo['discount_fee']) && $orderInfo['discount_fee']){?>
								<div class="shouDan_1 lh-18">【首单满200元立减<span><?php echo $orderInfo['discount_fee'];?></span>元】</div>
							<?php }?>
						</div>
						<?php }?>
						<div class="bg-f7 pt-20 pb-20 pl-10 pr-10 bl-1 br-1 bb-1">
							<?php if($orderInfo['orders']['total_fee'] !== '--'){ ?>
							<div class="ta-r">
								应付:<span class="cor-red fw-b fs-14">¥  <span id="sellerPayPrice"><?php echo $orderInfo['pay_amount']>0 ? $orderInfo['pay_amount'] : '0.00'; ?></span> </span>
							</div>
							<?php }?>
							<div class="ta-r mt-10">
								<a class="btn" id="saveOrderBtn">
									提交订单
								</a>
							</div>
							<div class="mt-10 ta-r cor-3" id="confirmAdress">
								<span class="mr-10 detial">
								</span>
								<span class="mr-10 name">
								</span>
								<span class="phone">
								</span>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div id="gobox" class="ta-l p-10" style="display: none;">
			<div style="color: #666666;">恭喜您，下单完成！</div>
			<br />
			<div style="color: #666666;">请您在24小时内支付，以免被系统自动关闭</div>
			<br />
			<div style="color: #666666;">请选择接下来的操作</div>
			<br />
			<a id="continueOrder"  class="b-btn active"> &lt; &nbsp;继续下单</a>
			<a id="showOrder"  class="b-btn active ml-10 mr-10">查看我的订单</a>
			<a id="payOrder"  class="btn">支付订单</a>
			</div>
			</div>

<script type="text/html" id="address_tpl">
	<div class="lh-18 add-item pl-20 pt-5 pr-20 clearfix">
		<div class="f-l address-wrap cur-p">
			<input type="radio" name="addNormalSelect">
			<input type="hidden" name="address_data" data-id="{{address.addr_id}}">
			<span class="ml-10 data-state">{{address.state}}</span>
			<span class="ml-5 data-city">{{address.city}}</span>
			<span class="ml-5 data-district">{{address.district}}</span>
			<span class="ml-5 data-address">{{address.address}}</span>
			<span class="ml-10 data-name">{{address.name}}</span>
			<span class="ml-10 data-mobile">{{address.mobile}}</span>
			<span class="ml-10 data-idcard">{{address.idcard}}</span>
			<span class="ml-10 data-id_card" style="display: none;">{{address.idcard}}</span>
		</div>
		<span class="f-r add-deal-box d-n">
			<a class=" cor-blue cur-p  mr-10 setDefaultBtn" data-addr_id="{{address.addr_id}}">设为默认地址</a>
			<a class="cor-blue cur-p mr-20 edit-btn" data-type="" data-addr_id="{{address.addr_id}}" data-idcard=""> 修改 </a>
			<a class="cor-blue cur-p del-btn" data-addr_id="{{address.addr_id}}"> 删除</a>
		</span>
	</div>
</script>
<script type="text/html" id="detail_good">

	<td>
										<div class="clearfix p-5">
											<div class="f-l h-60 w-60px of-h">
												<img src="{{orders.pic_url}}" class="w-60px">
											</div>
											<div class="f-l ta-l w-350px of-h ml-10">
												<div class="h-20px cor-3 fw-b of-h" title="{{orders.title}}">
												{{orders.title}}
												</div>
												<div class="h-20px cor-9 of-h">
													规格:<span id="specNum">{{orders.sku_spec_name}}</span>
												</div>
											</div>
										</div>
									</td>
									<td>
										<span id="specPrice">{{orders.price}}</span>
									</td>
									<td class="ta-c">
										<input type="hidden" id="addcount" value="{{orders.num}}">
										{{orders.num}}
									</td>
									<td>
										--
									</td>
									<td>
										<span id="specTotalPrice">
									
										&yen;	{{orders.total_fee}}
										</span>
									</td>
									<td>
										快递
									</td>

</script>

<div tabindex="-1" style="position: absolute; outline: 0px; left: 803px; top: 282px; z-index: 1024; display: none;"  id="idshen"  class="ui-popup ui-popup-modal ui-popup-show ui-popup-right ui-popup-follow ui-popup-focus" role="alertdialog" ><div i="dialog" class="ui-dialog"><div class="ui-dialog-arrow-a"></div><div class="ui-dialog-arrow-b"></div><table class="ui-dialog-grid"><tbody><tr><td i="header" class="ui-dialog-header" style="display: none;"><button i="close" class="ui-dialog-close" title="关闭">×</button><div i="title" class="ui-dialog-title" id="title:1462937905506"></div></td></tr><tr><td i="body" class="ui-dialog-body" style="padding: 2px;"><div i="content" class="ui-dialog-content" id="content:1462937905506" style="width: 500px;"><div class="cor-red p-10">海关总署令147号第二十二条规定：个人物品类进出境快件报关时，运营人应当向海关提交《中华人民共和国海关进出境快件个人物品申报表》（该申报单需提供真实、合法的个人身份证号码）、每一进出境快件的分运单、进境快件收件人或出境快件发件人身份证件影印件和海关需要的其他单证。 </div></div></td></tr><tr><td i="footer" class="ui-dialog-footer" style="display: none;"><div i="statusbar" class="ui-dialog-statusbar" style="display: none;"></div><div i="button" class="ui-dialog-button"></div></td></tr></tbody></table></div></div>
		</div>
		<div class="zhe"></div>
<div tabindex="-1" style="position: fixed; outline: 0px; left:38%; top: 127px; z-index: 1025; display: none;" id="dong"  class="ui-popup ui-popup-modal ui-popup-show ui-popup-focus" role="alertdialog"><div i="dialog" class="ui-dialog"><div class="ui-dialog-arrow-a"></div><div class="ui-dialog-arrow-b"></div><table class="ui-dialog-grid"><tbody><tr><td i="header" class="ui-dialog-header"><button i="close" class="ui-dialog-close" title="关闭" id="dongguan">×</button><div i="title" class="ui-dialog-title" id="title:1462969901858">温馨提示</div></td></tr><tr><td i="body" class="ui-dialog-body"><div i="content" class="ui-dialog-content" id="content:1462969901858" style="width: 350px; height: 40px;">您确认要删除该收货地址吗？</div></td></tr><tr><td i="footer" class="ui-dialog-footer"><div i="statusbar" class="ui-dialog-statusbar" style="display: none;"></div><div i="button" class="ui-dialog-button"><button type="button" i-id="cancel" id="dongqu">取&nbsp;&nbsp;消</button><button type="button" i-id="ok" autofocus="" id="dongque" class="ui-dialog-autofocus">确&nbsp;&nbsp;定</button></div></td></tr></tbody></table></div></div>
		<script type="text/javascript" src="/asset/js/goods_details/jquery-2.2.0.min.js" ></script>
		<script type="text/javascript" src="/asset/js/template.js" ></script>
		<script type="text/javascript" src="/asset/js/orders/orders.js" ></script>
		<script type="text/javascript" src="/asset/js/goods_details/PCASClass.js" ></script>
		<script>new PCAS("province", "city", "area");</script>
	</body>
</html>