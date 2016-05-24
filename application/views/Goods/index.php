<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut" href="/favicon.ico" />
		<title>首页</title>
		<link rel="stylesheet" href="/asset/css/common/style.css" />
		<link rel="stylesheet" href="/asset/css/common/style1.css" />
		<link rel="stylesheet" href="/asset/css/tablel_page/jq-tabel.css" />
		<link rel="stylesheet" href="/asset/css/good_list/goodslist.css" />
		<link rel="stylesheet" href="/asset/css/JQblockslide.css" />
		<link rel="stylesheet" href="/asset/css/item_list/itemIndex.css"/>
			<style>#moduleLiftList li {
	background: url(../../../asset/img/1.png) no-repeat;
	background-position: 0px 0px;
}

#moduleLiftList li:hover {
	background: url(../../../asset/img/1.png) no-repeat;
	
	background-position: -35px 0px;
}</style>	
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
							<input class="pl-10 pr-10" id="searchkeyIpt" placeholder="搜索">
						</div>
						<a class="searchBtn " id="headerSearchBtn">搜索</a>
					</div>
				</div>
			</div>
		
			<ul class="w-100 mt-35 navBox pos-r" id="channelWrap">
				<li class="navItem bg-red1 allType" id="allType">全部分类<i class="iconfont ml-10 arrow-bottom" style="display: inline;"></i><i class="d-n iconfont ml-10 arrow-top" style="display: none;"></i></li>
				<li class="navItem pos-r navItem checked" id="firstItem"><a href="<?php echo site_url('goods/index'); ?>">首页</a></li>
				<li class="navItem " data-type="2"><a href="<?php echo site_url('goods/goods_list'); ?>">国内仓发货</a></li>
				<li class="navItem senior-store" data-type="1"><a href="<?php echo site_url('goods/foreign_goods_list'); ?>">保税区直供</a></li>
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

		</div>
	<?php
	include_once (VIEWPATH . 'slider.php');
 ?>
		<div class="fixed-container clearfix pb-55">
			<?php if(isset($activity)){
			foreach($activity as $key => $value){ ?>
			<div class="mt-35">
				<div class="pro-title mb-5">
					<span class="fs-21 cor-3" data-id="<?php echo $value['item_activity_id']; ?>"><?php echo $value['name']; ?></span>
					<a class="f-r lh-32 hov-deline" href="<?php echo site_url('goods/search?item_activity_id=' . $value['item_activity_id']); ?>" target="_blank">更多 &gt;</a>
				</div>
				<div class="wrap mt-10 bg-w w-1188px b-1 mh-310" style="width: 1186px;">
					<div class="block-slides-wrap" id="slidesWrap<?php echo $key; ?>" style="height:310px">
						<div class="prev-btn"></div>
						<div class="next-btn"></div>
						<ul class="slides-content" style="left: 0px;">
							<?php foreach($value['item_list'] as $k => $item){?>
								<?php if($k % 5 == 0){ ?>
							<li style="width: 1188px;">
								<?php } ?>
								<div class="new-item f-l br-1 pt-10 cor-3 cur-p">
									<a href="<?php echo site_url('goods/detail'); ?>?item_id=<?php echo $item['item_id']; ?>" target="_blank">
										<div class="w-250px h-250px m-auto">
											<img src="<?php echo $item['pic_url']; ?>" class="d-ib w-100 va-m">
										</div>
										<div class="new-name w-250px m-auto ta-c fs-14 pt-10"><?php echo $item['title']; ?></div>

										<div class="cor-red w-250px m-auto ta-c pt-5 pb-30 fs-14">
											<?php if($item['price'] !== '--'){?>
											¥<span class="fs-21 fw-b"><?php echo $item['price']; ?></span>
											<span class="fs-12 cor-9 ml-10">市场价:¥<?php echo $item['market_price']; ?></span>
											<?php } ?>
										</div>
									</a>
								</div>
								<?php if(($k+1) % 5 == 0){ ?>
							</li>
								<?php } ?>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<?php }} ?>
			<div id="goodsModuleBox">
				<?php if(isset($allCats)){
					foreach($allCats as $_cat){ ?>
				<div class="pro-module mt-35" id="module<?php echo $_cat['cid']; ?>">
					<div class="pro-title"> <span class="fs-21 cor-3"><?php echo $_cat['name']?></span>
						<a class="f-r lh-32 hov-deline" href="<?php echo site_url('goods/search'); ?>?cat_id=<?php echo $_cat['cid']?>&amp;cat_name=<?php echo $_cat['name']; ?>" target="_blank">更多好货 &gt;</a>
					</div>
					<div class="pro-box bg-w b-1 pos-r of-h mt-5">
						<div class="w-199px of-h f-l br-1 pos-a bg-wating">
							<a class="f-r lh-32 hov-deline" href="<?php echo site_url('goods/search'); ?>?cat_id=<?php echo $_cat['cid']; ?>&amp;cat_name=<?php echo $_cat['name']; ?>" target="_blank">
								<img src="<?php echo $_cat['pic_url']; ?>" class="h-470px">
							</a>
						</div>
						<div class="f-l of-h w-990px ml-198px">
							<?php if(!empty($_cat['items'])){
								   foreach($_cat['items'] as $k => $value){ ?>
							<div class="pro-item br-1 bb-1 f-l">
								<a href="<?php echo site_url('goods/detail'); ?>?item_id=<?php echo $value['item_id']?>" target="_blank">
									<div class="pro-img pos-r bg-wating"> <img src="<?php echo $value['pic_url']; ?>" class="w-100 va-m"> </div>
									<div class="pl-10 pr-10 mt-10">
										<p class="fs-12 mt-5 pro-name"><?php echo $value['title']; ?></p>
										<?php if($value['price'] !== '--'){?>
										<p class="cor-red fs-12 mt-5"> ¥<span class="fw-b fs-14"><?php echo $value['price']; ?></span> <span class="fs-12 f-r lh-15 cor-9 ml-10">市场价:¥<?php echo $value['market_price']; ?></span> </p>
										<?php } ?>
									</div>
								</a>
							</div>
							<?php } } ?>
						</div>
					</div>
					<div class="brand-box mt-10 pt-10 pb-10 b-1 bg-w clearfix">
						<div class="f-l h-100px lh-100px ta-c w-198px fs-14 cor-3">热卖品牌:</div>
						<div class="f-l w-990px of-h h-100px of-h">
							<?php if(!empty($_cat['brands'])){
							      foreach($_cat['brands'] as $key => $brand){?>
							<div class="of-h w-100px d-ib h-100px lh-100px  mr-20  bg-wating-small">
								<a href="<?php echo site_url('goods/search'); ?>?brand_id=<?php echo $brand['brand_id']; ?>&amp;brandName=<?php echo $brand['name']?>" target="_blank">
									<img src="<?php echo $brand['pic_url']; ?>" class="d-ib w-100 va-m" title="<?php echo $brand['name']; ?>" alt="<?php echo $brand['name']; ?>">
								</a>
							</div>
							<?php } } ?>
						</div>
					</div>
				</div>
				<?php }} ?>
            <div class="pos-f w-35px t-210px r-50 mr-640" id="liftBox">
                <ul class="ta-c bg-w w-35px d-n" id="moduleLiftList" style="display: block;">
				<?php foreach($allCats as $key => $_cat){
				       if($_cat['icon_font']){ ?>
            		 <li class="cur-p w-100 h-32px lift-item pos-r" data-id="<?php echo $_cat['cid']; ?>" style="background-image: url(<?php echo $_cat['icon_font'];?>);" >
						 <p class="h-32px w-80px cor-w pl-10 pr-10 lift-checked lift-right d-n fs-14 fw-b" style="display: none;"><?php echo $_cat['name']; ?></p>
						 <div class="cor-6">
							 <i class="iconfont" style="font-size: 22px;"></i>
						 </div>
					 </li>
				<?php }}?>
				</ul>
			

       
        </div>
        	<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js"></script>
			<script type="text/javascript" src="/asset/js/goods_list/jquery.carouFredSel-6.0.4-packed.js" ></script>
			<script type="text/javascript" src="/asset/js/goods_details/index.js" ></script>		
		<!--	<script type="text/javascript" src="../../../asset/css/good_list/index.js" ></script>-->
	</body>

</html>
