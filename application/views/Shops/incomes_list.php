<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut" href="/favicon.ico" />
		<meta name="format-detection" content="telephone=no">
		<title>店铺收入</title>
		<link rel="stylesheet" href="/asset/css/common/style.css" />
		<link rel="stylesheet" href="/asset/css/common/style1.css" />
		<link rel="stylesheet" href="/asset/css/tablel_page/jq-tabel.css" />
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

				<h4 class="bt-1"><i class="icon iconfont"></i>数据</h4>
				<ul>
					<li><a class="active">本店收入 </a></li>
				</ul>

			</div>
			<?php include_once(VIEWPATH . 'kefu.php'); ?>
			<div class="main">
				<div class="bg-e p-10">
					<a class="mr-10">店铺数据</a>
					<i class="icon iconfont cor-grey mr-10 fs-12"></i>
					<a class="mr-10">本店收入</a>
				</div>
				<div class="goods-list-wrap" id="mainWrap">
					<div class="search-wrap">
						<table class="w-100" id="searchWrapTable">
							<tbody>
								<tr>
									<td class="pt-10 pb-10 pl-10 ta-l" colspan="3">
										<label class="d-ib mr-10 height-30 pl-10">日期:</label>
										<input type="text" class="d-ib ipt w-100px maxw-200" id="begin_date" name="incomeTimeStartStr" value="<?php echo $begin_date; ?>" readonly="" onclick="WdatePicker()" />
										_ <input type="text" class="d-ib ipt w-100px maxw-200" name="incomeTimeEnd" value="<?php echo $now_date; ?>" readonly="" id="end_date" onclick="WdatePicker()" />

										<span class="d-ib btn search-btn ml-10" id="searchBtn"><i class="icon iconfont">
                            </i>查询</span>
										<span class="btn ml-10 d-ni"><i class="icon iconfont"></i>导出</span>

									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="tags-wrap clearfix" id="statusSearch">
						<a class="first-tag" data-status="1">昨天</a>
						<a class="active" data-status="2">近7天</a>
						<a data-status="3" class="last-tag">近30天</a>
					</div>

					<div>
						<table class="w-100 jq-table no-border" id="shopIncomeTable">
							<thead>
								<tr>
									<th width="20%" class="" data-field="aliasDailyTime">日期</th>
									<th width="20%" class="" data-field="sumValidOrderCount">有效订单数<i class="iconfont cur-p cor-rede ml-5" id="viewSumValidOrderCount" style="font-size: 16px"></i></th>
									<th width="20%" class="" data-field="sumValidOrderAmount">有效订单销售额</th>
									<th width="20%" class="" data-field="sumFinishOrderCount">已完成订单数<i class="iconfont cur-p cor-rede ml-5" id="viewSumFinishOrderCount" style="font-size: 16px"></i></th>
									<th width="20%" class="" data-field="sumFinishSalesAmount">已完成订单销售额</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($income_list as $k => $v): ?>
								<tr>
									<td width="20%" class=""><?php echo $v['r_date']; ?></td>
									<td width="20%" class=""><?php echo $v['valid_num']; ?></td>
									<td width="20%" class="">¥ <?php echo $v['valid_sell']; ?></td>
									<td width="20%" class=""><?php echo $v['finish_num']; ?></td>
									<td width="20%" class="">¥ <?php echo $v['finish_sell']; ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>

						<div id="pagination" class="clearfix mt-10 bg-f2 pt-5">
							<div class="pagination">
								<?php echo $page; ?>
								<div class="page-info">共<b id="total_count"><?php echo $total_count; ?></b>条，共<b id="total_page"><?php echo $total_page; ?></b>页</div>
								<input type="text" value="<?php echo $cur_page; ?>" id="cur_page" class="jumpipt jumpPage">
								<input type="button" value="确定" class="jumpipt jumpBtn">
							</div>
						</div>

					</div>

				</div>

			</div>

		</div>
		<div class="footer"></div>

		<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="/asset/js/template.js"></script>
		<script type="text/javascript" src="/asset/js/moment.js"></script>
		<script type="text/javascript" src="/asset/js/My97DatePicker/WdatePicker.js"></script>
		<script type="text/javascript" src="/asset/js/income_list.js"></script>

	</body>
<script type="text/html" id="income_tpl">
	{{each list as item}}
	<tr>
		<td width="20%" class="">{{item.r_date}}</td>
		<td width="20%" class="">{{item.valid_num}}</td>
		<td width="20%" class="">¥ {{item.valid_sell}}</td>
		<td width="20%" class="">{{item.finish_num}}</td>
		<td width="20%" class="">¥ {{item.finish_sell}}</td>
	</tr>
	{{/each}}
</script>
</html>