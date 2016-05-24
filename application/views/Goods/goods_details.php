<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut" href="/favicon.ico" />
		<title>商品详情</title>
		<link rel="stylesheet" href="/asset/css/common/style.css" />
		<link rel="stylesheet" href="/asset/css/common/style1.css" />
		<link rel="stylesheet" href="/asset/css/tablel_page/jq-tabel.css" />
		<link rel="stylesheet" href="/asset/css/good_list/goodslist.css" />
		<link rel="stylesheet" href="/asset/css/item_list/itemIndex.css" />
		<link rel="stylesheet" href="/asset/css/orders_detail/itemDetail.css" />
		<link rel="stylesheet" href="/asset/css/good_list/goods_detail.css" />
	</head>
	<body>
		<?php
		include_once (VIEWPATH . 'header.php');
 ?>
			<div class="d_reset">
		<div class="fixed_container">
			<div class="clearfix" id="searchInputHeader">
				<div class="fl">
					<img src="/asset/img/bbq1.png">
				</div>
				<div class="rl clearfix searchBox">
					<div class="clearfix">
						<div class="searchInputBox f-l">
							<input class="pl-10 pr-10" id="searchkeyIpt" placeholder="奶粉">
						</div>
						<a class="searchBtn " id="headerSearchBtn">搜索</a>
					</div>
				</div>
			</div>
			<ul class="w-100 mt-35 navBox pos-r" id="channelWrap">
				<li class="navItem bg-red1 allType" id="allType">全部分类<i class="iconfont ml-10 arrow-bottom" style="display: inline;"></i><i class="d-n iconfont ml-10 arrow-top" style="display: none;"></i></li>
				<li class="navItem pos-r" id="firstItem"><a href="<?php echo site_url('goods/index'); ?>">首页</a></li>
				<li class="navItem "> <a href="<?php echo site_url('goods/goods_list'); ?>">国内仓发货</a>
				</li>
				<li class="navItem "><a href="<?php echo site_url('goods/foreign_goods_list'); ?>">保税区直供</a></li>
				<ul class="pos-a bg-w typeList pt-10 pb-10 cor-3 d-n" id="typeList" style="display:none;">
					<?php if(isset($parent_cats)){
						foreach($parent_cats as $key => $val){
							?>
							<li>
								<a target="_blank" data-id="<?php echo $key; ?>">
									<p class="w-80px pl-10 d-ib h-34px of-h"><?php echo $val; ?></p><i class="iconfont f-r cor-grey2 mr-10"></i>
								</a>
							</li>
						<?php } } ?>
				</ul>
			</ul>
		</div>
			<?php
			include_once (VIEWPATH . 'slider.php');
 ?>
		<div class="pageMain bg-e">
			<div class="fixed-container clearfix">
				<div class="h-35px fs-12 mt-10">
					<a class="fw-b cor-3"><?php echo $detail['type'] == 1 ? '国内仓发货' : '保税区直供'; ?></a>
					<i class="icon iconfont cor-grey fs-12"></i>
					<a><?php echo $detail['title']; ?> </a>
				</div>
				<div class="b-1 bg-w pt-20 pb-20 clearfix pos-r">
<!--					<img src="img/hai_icon.png" class="pos-a trade-type" style="display: none;">-->
					<div class="w-500px ml-30 f-l">
						<div class="w-100px f-l ta-c">
							<div class="b-1 h-18 cur-p" id="goodsImgPrev"><i class="iconfont cor-9"></i></div>
							<div class="mt-10 of-h h-320px">
								<div id="goodsImgBox">
									<?php foreach($detail['pics'] as $key => $val){?>
									<div class="goods-img-small b-1 of-h h-98px bg-wating-small  cur-p" data-id="<?php echo $key; ?>"><img src="<?php echo $val; ?>" class="w-100 d-ib va-m"></div>
									<?php  } ?>
								</div>
							</div>
							<div class="b-1 h-18 mt-10 cur-p" id="goodsImgNext"><i class="iconfont cor-3"></i></div>

						</div>
						<div class="ml-20 f-l w-378px h-378px b-1 of-h bg-wating-big">
							<img src="<?php echo $detail['pic_url']?>" id="goodsImgBig" class="w-100 d-ib va-m">
						</div>
					</div>
					<div class="w-610px ml-20 f-l">
						<div class="pb-5 bb-1 fs-12 cor-9 mt-5"><?php echo $detail['made_from']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $detail['brand_name']; ?></div>
						<div class="fs-18 cor-3 pt-10 pb-10 fw-b">
							<?php if($detail['type']==1){?>
							<img src="/asset/img/tag_guonei.jpg" style="width: 80px;vertical-align: middle;margin-right: 8px;">
							<?php }else{ ?>
							<img src="/asset/img/tag_baoshui.jpg"style="width: 80px;vertical-align: middle;margin-right: 8px;" >
							<?php } ?>
							<?php echo $detail['title']; ?>
						</div>
						<?php if(isset($detail['buying_tips']) && $detail['buying_tips']){?>
						<div class="lh-20px">
							<span class="cor-red fw-b">重要提示:</span>
							<span class="cor-red"><?php echo $detail['buying_tips']; ?></span>
						</div>
						<?php } ?>
						<div class="cor-9 mt-10">
							<?php echo $detail['intro']; ?>
						</div>
						<div class="pb-10 bb-1 fs-12 cor-9 mt-10 clearfix">
							<div class="f-l w-48px ta-r cor-9 lh-45px">价格</div>
							<div class="ml-20 f-l w-542px cor-3">
								<?php if($detail['price'] !== '--'){?>
								<span class="fs-18 cor-red">¥</span>
								<span class="fs-28 cor-red" id="actualPrice"><?php echo $detail['price']?></span>

								<span class="ml-20" id="actualUnitPriceId">(单价: ¥<?php echo isset($detail['specs']['0']['price1']) ? $detail['specs']['0']['price1'] : $detail['price']; ?>)</span>
<!--								<span class="f-r mr-50 lh-45px">建议价:&nbsp;¥99.0/件</span>-->
								<?php }else{ ?>
									<span class="cor-red lh-45px">总管理员可见价格</span>
								<?php } ?>
							
							</div>
							<?php if(isset($detail['first_order_discount']) && $detail['first_order_discount']){?>
								<div class="shouDan">【首单满200元立减<span><?php echo $detail['first_order_discount']; ?></span>元】</div>
							<?php } ?>
								<div class="goodstxtbox fr ml-20" style="width:700px;">

			<div class="Goodpromotion Goodpromotion_Price" style="float:left; border-left:none; border-right:none;">

				<div id="lk-distribution" class="" style="display: block;">
					<span class="label">配送：</span>
					<div class="prop-content">
						<span class="location"><?php echo $detail['item_location']['city'];?></span><span>至</span>
						<span class="wl-addressinfo" style="margin-top: -2px;">
                        <a href="javascript:;" id="to-address" onclick="popup_city_select_dialog(this)" class="to-address">请选择 <i class="iconfont arrow-bottom" style="display: inline;margin-left:-1px;"></i></a><p class="ml-10" style="display: inline-block;">快递<p  style="display: inline-block;margin-left: 4px;" id="wl-money">免运费</p></p>
                        <div id="popup-city-select" class="wl-areatab-con" style="display:none">
                            <a href="javascript:;" class="address-all-close" onclick="close_city_select_dialog()"></a>
                            <div id="LK_AddressAllTitle" class="address-all-title-par clearfix ">
                                <div onclick="initProvince()" class="address-all-title address-all-title-selected" id="LK_AddressAllTitle_Province">请选择<s></s></div>
                                <div class="address-all-title" data-title="City" id="LK_AddressAllTitle_city" style="display: none;">请选择<s></s></div>
                            </div>
                            <div id="LK_AddressAllCon" class="address-all-con-par clearfix address-all-con-selected">
                                <ul id="wl-list-add-con" class="wl-list-add-con clearfix"></ul>
                            </div>
                        </div>
                    </span>
						<span id="wl-money"></span>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>

	</div>
						</div>
				
						<div class="lh-35px mt-10 clearfix">
							<div class="f-l w-48px ta-r cor-9">规格</div>
							<div class="ml-20 f-l w-542px cor-3" id="specificationsBox">
								<?php foreach($detail['specs'] as $key => $val){?>
								<div class="specifications-item d-ib pl-20 pr-20 b-1 h-25px mt-5 mr-10 cur-p " data-specid="<?php echo $val['sku_id']; ?>" data-specnum="<?php echo $val['quantity']; ?>" data-actualprice="<?php echo $val['price']?>" data-actualunitprice="<?php echo $val['price1']; ?>" data-singleguideprice="99.0 ">
									<?php echo $val['spec_name']; ?>
								</div>
								<?php } ?>
<!--								<div class="specifications-item d-ib pl-20 pr-20 b-1 h-25px mt-5 mr-10 cur-p " data-specid="33723" data-specnum="1" data-actualprice="78.0" data-actualunitprice="78.0" data-singleguideprice="99.0 ">-->
<!--									2盒装-->
<!--								</div>-->
							</div>
						</div>
						<?php if($detail['type'] == 1){?>
							<div class="lh-35px mt-10 clearfix">
								<div class="f-l w-48px ta-r cor-9">数量</div>
								<div class="ml-20 f-l w-542px clearfix ta-c cor-3">
									<div class="f-l b-1 h-25px mt-5 w-25px us-n cur-p" id="numReduce">
										<i class="iconfont cor-9" style="font-size: 14px"></i>
									</div>
									<div class="f-l bt-1 bb-1 h-25px mt-5 w-50px">
										<input type="text" value="1" class="w-100 b-n ta-c" id="goodsNum">
									</div>
									<div class="f-l b-1 h-25px mt-5 w-25px us-n cur-p" id="numAdd">
										<i class="iconfont" style="font-size: 14px"></i>
									</div>
									<p class="f-l ml-20 d-n" id="stockBox" style="display: block;">可用库存<span><?php echo $detail['quantity']; ?></span>件</p>
								</div>
							</div>
						<?php  } ?>
						<div class="mt-20">
							<a class="btn buy-btn" id="buyBtn" data-itemid="<?php echo $detail['item_id']; ?>">立即抢购</a>
						</div>
					</div>
				</div>
				<div class="mt-30 clearfix" id="scrollTitle">
					<div class="w-198px bt-1 bl-1 br-1 bg-w f-l">
						<div class="h-50px bb-1 pl-20 fs-14 fw-b">推荐商品</div>
					</div>
					<div class="w-968px b-1 bg-w f-l  ml-20">
						<div class="h-50px bg-f8 of-h fs-14 fw-b cor-3 clearfix">
							<div class="ta-c h-50px f-l w-130 br-1 cur-p info-checked" id="goodsInfoTag">
								<div class="d-ib w-100 h-100">商品信息</div>
							</div>
							<div class="ta-c h-50px f-l w-130 br-1 cur-p" id="goodsDetailTag">
								<div class="d-ib w-100 h-100">商品详情</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix" id="infoBoxId" style="margin-top: 0px;">
					<div class="w-198px bb-1 bl-1 br-1 bg-w f-l">
						<ul class="pl-10 pr-10">
							<?php
							if(!empty($detail['tuijian'])){
								foreach($detail['tuijian'] as $key => $val){?>
							<li class="pt-10 pb-10 goods-item <?php if($key != 0) echo 'bt-1'?>">
								<a href="<?php echo site_url('goods/detail?item_id=').$val['item_id']?>" target="_blank">
									<div class="w-100 h-180px of-h bg-wating">
										<img src="<?php echo $val['pic_url']; ?>" class="w-100 d-ib va-m">
									</div>
									<div class="mt-20 fs-12 lh-15 cor-3 goods-title"><?php echo $val['title']; ?></div>
									<div class="mt-10 cor-red clearfix">
										<?php if($val['price'] !== '--'){?>
										¥<span class="fs-14"><?php echo $val['price']; ?></span>
										 <span class="f-r cor-9 fs-12 lh-15">市场价: ¥<?php echo $val['market_price']?></span>
										<?php }else{ ?>
										<span class="cor-red lh-45px">总管理员可见价格</span>
										<?php } ?>
									</div>
								</a>
							</li>
							<?php }} ?>
						</ul>
					</div>
					<div class="w-968px b-1 bg-w f-l  ml-20">
						<div class="bg-w">
							<div class="ta-c">
								<?php if($detail['type'] == 1){?>
									<img src="/asset/img/pc_guoneicangliucheng.jpg" class="d-ib w-100">
								<?php }else{ ?>
									<img src="/asset/img/pc_baoshuiliucheng.jpg" class="d-ib w-100">
								<?php } ?>
							</div>
						</div>
						<div class="bt-1 pos-r info-module-box clearfix mh-250" id="goodsInfo">
							<div class="b-1 pos-a info-module-title ta-c fs-18 cor-3 fw-b bg-w ">商品信息</div>
							<div class="info-box f-l">
								<div class="mt-20 clearfix">
									<p class="cor-3 w-120px ta-r f-l">品名：</p>
									<p class="ml-20 cor-6 w-300px f-l"><?php echo $detail['title']; ?></p>
								</div>
								<div class="mt-20 clearfix">
									<p class="cor-3 w-120px ta-r f-l">产地：</p>
									<p class="ml-20 cor-6 w-300px f-l"><?php echo $detail['made_from']; ?></p>
								</div>
								<div class="mt-20 clearfix">
									<p class="cor-3 w-120px ta-r f-l">品牌：</p>
									<p class="ml-20 cor-6 w-300px f-l"><?php echo $detail['brand_name']; ?></p>
								</div>
								<?php if(!empty($detail['detail'])){
									foreach($detail['detail'] as $key => $val){
								?>
								<div class="mt-20 clearfix">
									<p class="cor-3 w-120px ta-r f-l"><?php echo $val['name'] ? $val['name'] . '：' : ''; ?></p>
									<p class="ml-20 cor-6 w-300px f-l"><?php echo $val['value'] ? $val['value'] : ''; ?></p>
								</div>
								<?php } } ?>

<!--								<div class="mt-20 clearfix">-->
<!--									<p class="cor-3 w-120px ta-r f-l">保质期：</p>-->
<!--									<p class="ml-20 cor-6 w-300px f-l">3年</p>-->
<!--								</div>-->
							</div>
							<div class="f-l w-220px pt-20">
								<div class="w-220px h-220px of-h pos-a info-img">
									<img src="<?php echo $detail['pic_url']; ?>" class="d-ib w-100 va-m">
								</div>
							</div>
						</div>
						<div class="bt-1 pos-r info-module-box clearfix" id="goodsDetail">
							<div class="b-1 pos-a info-module-title ta-c fs-18 cor-3 fw-b bg-w">商品详情</div>
							<?php echo $detail['desc']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
		<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="/asset/js/goods_details/goods_details.js" ></script>
		<script type="text/javascript" src="/asset/js/goods_details/city.js" ></script>
</html>