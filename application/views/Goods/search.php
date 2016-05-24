<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
				<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut" href="/favicon.ico" />
		<title>商品搜索</title>
		<link rel="stylesheet" href="/asset/css/common/style.css" />
		<link rel="stylesheet" href="/asset/css/common/style1.css" />
		<link rel="stylesheet" href="/asset/css/good_list/goodslist.css" />
		<link rel="stylesheet" href="/asset/css/tablel_page/jq-tabel.css" />
		<link rel="stylesheet" href="/asset/css/item_list/itemIndex.css" />
		<script>var cats_json =<?php echo $cats_json; ?>;</script>
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
				<li class="navItem pos-r" id="firstItem"><a href="index">首页</a></li>
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
	<?php include_once(VIEWPATH . 'slider.php'); ?>
		
<!--		<div class="of-h pos-r h-350px">-->
<!--			<img src="/asset/img/banne.jpg" width="1920" class="banner-img">-->
<!--		</div>-->
		<div id="js_keyword" data-keyword="<?php echo (isset($keyword) && $keyword) ? $keyword : '';?>"></div>
		<input id="js_item_activity_id" type="hidden" value="<?php echo (isset($item_activity_id) && $item_activity_id) ? $item_activity_id : '';?>" />
		<input id="js_brand_id" type="hidden" value="<?php echo (isset($brand_id) && $brand_id) ? $brand_id : '';?>" name="js_brand_id" />
		<div class="fixed-container">
			<div id="searchCon" class="d-n" style="display: block;">
				<div class="pt-10 cor-grey6 fs-14 search-crumbs" id="searchCrumbs">
					<span class="con-block d-ib ml-10 cate-crumbs" data-id="257">
						<span></span>
						<i class="iconfont ml-5 delete-icon"></i>
					</span>
					<i class="iconfont ml-10"></i>
					<span class="con-block d-ib ml-10 subcate-crumbs" data-id="262">
						<span></span>
						<i class="iconfont ml-5 delete-icon"></i>
					</span>
					<i class="iconfont ml-10"></i>
					<span class="con-block d-ib ml-10 brand-crumbs" data-type="brand" data-for="brand668">
						<span></span>
						<i class="iconfont ml-5 delete-icon"></i>
					</span>
				</div>
				<div class="mt-10 bg-w cate-wrap cor-grey bt-1 bl-1 br-1" id="searchWrap">
					<ul>
						<li id="cateLi" class="d-n" style="display: list-item;">
							<label class="cate-label">类目：</label>
							<span class="cate-more" style="display: block;">更多<span class="iconfont"></span></span>
							<div class="cate-block">
								<div class="inner-cate">
									<?php if(isset($parent_cats)){
											foreach($parent_cats as $key => $cat){?>
									<a class="d-ib cate-a <?php if($key == $search_cid){echo 'active';}?>" data-type="cate" data-id="<?php echo $key; ?>" id="cate<?php echo $key; ?>"><?php echo $cat; ?></a>
									<?php } } ?>
								</div>
							</div>
						</li>
						<li id="secondCateLi" class="d-n" style="display:none">
							<label class="cate-label">分类：</label>
							<span class="cate-more" style="display: none;">更多<i class="iconfont"></i></span>
							<div class="cate-block" style="height: 31px;">
								<div class="inner-cate">
				
								</div>
							</div>
						</li>
						<li id="brandLi" class="d-n last" style="display:none;">
							<label class="cate-label">品牌：</label>
							<span class="cate-more" style="display: none;">更多<i class="iconfont"></i></span>
							<div class="cate-block">
								<div class="inner-cate"><a class="d-ib brand-a" data-type="brand" data-id="668" id="brand668"><span>澳洲贝儿Bubs</span><i class="iconfont ml-5"></i></a><a class="d-ib brand-a" data-type="brand" data-id="656" id="brand656"><span>新西兰可瑞康Karicare</span> <i class="iconfont ml-5"></i></a></div>
							</div>
						</li>
					</ul>
				</div>
				<div class="pt-10 pb-10 bg-w mt-15 pl-20 pr-20 b-1 fs-14" id="sortWrap">
                <label class="sort-label d-ib">排序：</label>
                <span class="d-ib sort-block active">最新</span>

                <span class="d-ib type-block"><input type="checkbox" value="2" class="d-ib" id="type1"><label for="type1">国内仓发货</label></span>
                                    <span class="d-ib type-block"><input type="checkbox" value="1" class="d-ib" id="type2"><label for="type2">保税区直供</label></span>
                   
                            </div>
			</div>

			<ul class="goods-list mt-15 clearfix" id="goodsListUl">
				<?php if(!empty($goods_list)){
					foreach($goods_list as $key => $item){ ?>
				<li class="b-1 f-l bg-w pos-r ">
					<div class="bb-1 clearfix">
						<a target="_blank" href="<?php echo site_url('goods/detail'); ?>?item_id=<?php echo $item['item_id']; ?>"> <img src="<?php echo $item['pic_url']?>" width="100%" class="f-l goods-img"> </a>
					</div>
					<div class="pt-20 pb-20 pl-10 pr-10">
						<div class="title"> <a target="_blank" href=""><?php echo $item['title']?></a> </div>
						<?php if($item['price'] !== '--'){?>
							<span class="cor-red fs-18 f-l">￥<?php echo $item['price']?> </span>
						<?php }else{?>
							<span class="cor-red lh-45px">总管理员可见价格</span>
						<?php }?>
					</div>
				</li>
				<?php } }else{ echo "暂无数据";} ?>
			</ul>
		<div id="pagination" class="mb-40 clearfix">
				<div class="pagination">
					<?php echo $page; ?>
					<div class="page-info">共<b id="total_count"><?php echo $total_count_num; ?></b>条，共<b id="total_page"><?php echo $total_page_num; ?></b>页</div>
					<input type="text" value="1" class="jumpipt jumpPage " id="cur_page">
					<input type="button" value="确定" class="jumpipt jumpBtn">
				</div>
				
			</div>
		</div>
						<script id="goodslist" type="text/html">
				{{each data.item_list as value i }}
							<li class="b-1 f-l bg-w pos-r ">
					<div class="bb-1 clearfix">
						<a target="_blank" href="detail?item_id={{value.item_id}}"> <img src="{{value.pic_url}}" width="100%" class="f-l goods-img"> </a>
					</div>
					<div class="pt-20 pb-20 pl-10 pr-10">
						<div class="title"> <a target="_blank" href="">{{value.title}}</a> </div>
						<div class="clearfix mt-10"> {{if value.price != '--'}}<span class="cor-red fs-18 f-l">￥{{value.price}}</span>{{else}}<span class="cor-red lh-45px">总管理员可见价格</span>{{/if}} </div>
					</div>
				</li>
			{{/each}}
		</script>
		<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="../../../asset/js/template.js" ></script>
		<script type="text/javascript" src="../../../asset/js/search/search.js" ></script>
	</body>

</html>