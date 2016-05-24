<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut" href="/favicon.ico" />
    <title>订单列表</title>
    <link rel="stylesheet" href="/asset/css/common/style.css"/>
    <link rel="stylesheet" href="/asset/css/common/style1.css"/>
    <link rel="stylesheet" href="/asset/css/tablel_page/jq-tabel.css"/>
    <link rel="stylesheet" href="/asset/css/good_list/goodslist.css"/>
    <link rel="stylesheet" href="/asset/css/item_list/itemIndex.css"/>
    <link rel="stylesheet" href="/asset/css/JQblockslide.css"/>
    <link rel="stylesheet" href="/asset/css/index.css"/>
</head>

<body>
<?php include_once(VIEWPATH . 'header.php'); ?>

<div class="content cf" id="con-container">
    <div class="side h-100 br-1" id="menu">

        <h4 class="bt-1"><i class="icon iconfont"></i>订单管理</h4>
        <ul>
            <li><a href="<?php echo site_url('orders/index'); ?>" class="active">所有订单 </a></li>
            <li><a href="<?php echo site_url('orders/no_pay'); ?>">待支付订单 </a></li>
        </ul>

    </div>
    <?php include_once(VIEWPATH . 'kefu.php'); ?>
    <div class="main">
        <div class="bg-e p-10">
            <a class="cur-p mr-10">订单管理</a>
            <i class="icon iconfont cor-grey mr-10 fs-12"></i>
            <a class="cur-p mr-10">所有订单</a>
        </div>
        <div class="order-list-wrap">
            <input type="hidden" value="0" id="isHidePay">
            <input type="hidden" value="0" id="isHidePrice">
            <input type="hidden" value="" id="hideOsdId">

            <div class="search-wrap">
                <form id="searchForm">
                    <input type="hidden" id="pageSize" value="10" name="pageSize">
                    <table class="w-100" id="searchWrapTable">
                        <tbody>
                        <tr>
                            <td class="pt-10 pb-10 pl-10 ta-l w-25">
                                <label class="d-ib height-30 pl-10 search-label">订单编号:</label>
                                <input type="text" class="ipt w-55" name="orderNum">
                            </td>

                            <td class="pt-10 pb-10 pl-10 ta-l w-50" colspan="2">
                                <label class="d-ib height-30 pl-10 search-label search-label-in">下单时间:</label>
                                <input type="text" style="width: 24%" class="ipt maxw-200" id="begin_date"
                                       name="orderTimeStartStr" readonly="" value="<?php echo $begin_date; ?>" onclick="WdatePicker()">-
                                <input type="text" style="width: 24%" class="ipt maxw-200" name="orderTimeEndStr"
                                       readonly="" id="end_date" value="<?php echo $now_date; ?>" onclick="WdatePicker()">
                                <a class="link ml-10" id="sevenDayLink">近7天</a>
                                <a class="link ml-5" id="monthLink">近30天</a>
                            </td>

                        </tr>
                        <tr>
                            <td class="pt-10 pb-10 pl-10 ta-l w-25">
                                <label class="d-ib height-30 pl-10 search-label">订单状态:</label>
                                <select class="select w-55 d-ib" name="order_status" id="statusSelect">
                                    <option value="-1">全部</option>
                                    <option value="1">待支付</option>
                                    <option value="4">已支付</option>
                                    <option value="8">待发货</option>
                                    <option value="10">已发货</option>
                                    <option value="100">已完成</option>
                                    <option value="0">已关闭</option>
                                </select>

                            </td>
                            <td class="pt-10 pb-10 pl-10 ta-l w-25">
                                <label class="d-ib height-30 pl-10 search-label">商品名称:</label>
                                <input type="text" class="ipt w-55" name="goodsName" id="goodsName">
                            </td>
                            <td class="pt-10 pb-10 pl-10 ta-l w-50"></td>
                        </tr>

                        <tr>

                            <td class="pt-10 pb-10 pl-10 ta-l w-25">
                                <label class="d-ib height-30 pl-10 search-label">收货人姓名:</label>
                                <input type="text" class="ipt w-55" name="deliveryName">
                            </td>
                            <td class="pt-10 pb-10 pl-10 ta-l w-25">
                                <label class="d-ib height-30 pl-10 search-label">收货电话:</label>
                                <input type="text" class="ipt w-55" name="deliveryPhone" maxlength="11" id="custPhone">
                            </td>

                        </tr>

                        </tbody>
                    </table>
                    <div class="ta-r mr-50" style="position: relative;">
                    	<img src="/asset/img/load1.gif" / id="loading">
                        <span class="btn search-btn mr-5 ml-30"><i class="icon iconfont"></i>查询</span>
                        <span class="btn" id="exportExcel">订单导出</span>
                    </div>
                </form>
            </div>
            <style>

            </style>
            <div class="tags-wrap clearfix" style="margin-top: 20px;"  id="statusSearch">
                <a class="first-tag active" data-status="">全部订单</a>
                <a data-status="10">已发货</a>
                <a data-status="100">已完成</a>
                <a data-status="0" class="last-tag">已关闭</a>
<!--                <span class="bl-1 ml-20 pos-r" id="noticeBtn" style="border-top-right-radius: 4px;border-top-left-radius: 4px;">-->
<!--                <i id="noticeCount" class="iconfont mr-5 pos-a cor-red"-->
<!--                   style="top: -15px;right: -15px;font-size: 20px;"></i>有订单通知-->
<!--                </span>-->
            </div>

            <div class="pl-10 pr-10">
                <table class="w-100 order-list-table cor-6" id="orderListTable">
                    <thead>
                    <tr class="bg-f2">
                        <th width="20%">商品</th>
                        <th width="10%">实收/数量</th>
                        <th width="7%">成本价</th>
                        <th width="20%">买家</th>
                        <th width="10%">会员门店</th>
                        <th width="15%">订单状态</th>

                    </tr>
                    </thead>

                    <?php foreach($orders as $order): ?>
                        <tbody>
                            <tr class="sep-row">
                                <td colspan="8"></td>
                            </tr>
                            <tr class="bg-blue">
                                <td colspan="8">
                                    <div class="f-l height-30 pl-20 cor-6"><span class="mr-20">订单编号：<?php echo $order['tid'] ?></span>
                                        <span>下单时间：<?php echo $order['created'] ?></span></div>
                                    <div class="f-r height-30 pr-20">
                                        <a class="link mr-10" href="<?php echo site_url('orders/detail?tid=' . $order['tid']); ?>" target="_blank">查看详情</a>
                                    </div>
                                </td>
                            </tr>
                            <?php if(isset($order['orders'])): ?>
                                <?php foreach($order['orders'] as $item): ?>
                                    <tr class="main-tr lh-15">
                                        <td class="pl-20 pos-r">
                                            <div style="width:250px" class="clearfix">
                                                <a href="<?php echo site_url('goods/detail?item_id=' . $item['item_id']); ?>" target="_blank"> <img
                                                        src="<?php echo $item['pic_url']; ?>"
                                                        width="60" height="60" class="f-l mr-10"> </a>
                                                <div class="f-l">
                                                    <div class="goods-title" style="width:180px"><a
                                                            href="<?php echo site_url('goods/detail?item_id=' . $item['item_id']); ?>" target="_blank" class="title"><?php echo $item['title']; ?></a>
                                                    </div>
                                                    <div class="cor-grey5"><?php echo $item['sku_spec_name']; ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="ta-c">
                                            <div> ¥<?php echo $order['pay_amount']; ?></div>
                                            <div class="cor-grey5"><?php echo $item['num']; ?>件</div>
                                        </td>
                                        <td class="ta-c"> ¥<?php echo $item['price']; ?></td>
                                        <td class="ta-l pl-20">
                                            <div class=""><i class="iconfont mr-5"></i><?php echo $order['shippingaddr_name']; ?></div>
                                            <span class=""><i class="iconfont mr-5"></i><?php echo $order['shippingaddr_mobile']; ?></span></td>
                                        <td class="ta-c"><?php echo $order['store_name']; ?></td>
                                        <td class="ta-c">
                                            <?php if($order['trade_status'] == 1): ?>
                                                <div>未付款</div>
                                                <a class="btn btn-purple mt-10 btn-pay" href="<?php echo site_url('orders/payment?tid=' . $order['tid']) ?>" target="_blank">确认支付</a>
                                                <a class="btn btn-purple mt-10 btn-cancel-order" data-id="<?php echo $order['tid']; ?>">取消订单</a>
                                            <?php endif; ?>
                                            <?php if($order['trade_status'] == 4): ?>   <div>已付款</div> <?php endif; ?>
                                            <?php if($order['trade_status'] == 8): ?>   <div>待发货</div> <?php endif; ?>
                                            <?php if($order['trade_status'] == 10): ?>
                                                <div>已发货</div>
                                                <a class="btn btn-purple mt-10 btn-confirm-express" data-id="<?php echo $order['tid']; ?>" >确认收货</a>
                                                <a class="btn btn-purple mt-10 btn-view-express" href="<?php echo site_url('orders/detail?tid=' . $order['tid']); ?>">查看物流</a>
                                            <?php endif; ?>
                                            <?php if($order['trade_status'] == 100): ?> <div>已收货</div> <?php endif; ?>
                                            <?php if($order['trade_status'] == 0): ?>   <div>已关闭</div> <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif;  ?>
                        </tbody>
                    <?php endforeach; ?>
                </table>

                <div id="pagination" class="clearfix mt-20 bg-f2 pt-5">
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

<script type="text/html" id="order_tpl">
    {{each list as value i}}
    <tbody>
    <tr class="sep-row">
        <td colspan="8"></td>
    </tr>
    <tr class="bg-blue">
        <td colspan="8">
            <div class="f-l height-30 pl-20 cor-6"><span class="mr-20">订单编号：{{value.tid}}</span>
                <span>下单时间：{{value.created}}</span></div>
            <div class="f-r height-30 pr-20">
                <a class="link mr-10" href="<?php echo site_url('orders/detail?tid='); ?>{{value.tid}}" target="_blank">查看详情</a>
            </div>
        </td>
    </tr>
    {{each value.orders as item}}
        <tr class="main-tr lh-15">
            <td class="pl-20 pos-r">
                <div style="width:250px" class="clearfix">
                    <a href="<?php echo site_url('orders/detail?item_id='); ?>{{item.item_id}}" target="_blank"> <img
                            src="{{item.pic_url}}"
                            width="60" height="60" class="f-l mr-10"> </a>
                    <div class="f-l">
                        <div class="goods-title" style="width:180px"><a
                                href="<?php echo site_url('orders/detail?item_id='); ?>{{item.item_id}}" target="_blank" class="title">{{item.title}}</a>
                        </div>
                        <div class="cor-grey5">{{item.sku_spec_name}}</div>
                    </div>
                </div>
            </td>
            <td class="ta-c">
                <div> ¥{{value.pay_amount}}</div>
                <div class="cor-grey5">{{item.num}}件</div>
            </td>
            <td class="ta-c"> ¥{{item.price}}</td>
            <td class="ta-l pl-20">
                <div class=""><i class="iconfont mr-5"></i>{{value.shippingaddr_name}}</div>
                <span class=""><i class="iconfont mr-5"></i>{{value.shippingaddr_mobile}}</span></td>
            <td class="ta-c">{{value.store_name}}</td>
            <td class="ta-c">
                {{if value.trade_status == 1}}
                    <div>未付款</div>
                    <a class="btn btn-purple mt-10 btn-pay" href="<?php echo site_url('orders/payment?tid=') ?>{{value.tid}}" target="_blank">确认支付</a>
                    <a class="btn btn-purple mt-10 btn-cancel-order" data-id="{{value.tid}}">取消订单</a>
                {{/if}}
                {{if value.trade_status == 4}} <div>已付款</div> {{/if}}
                {{if value.trade_status == 8}} <div>待发货</div> {{/if}}
                {{if value.trade_status == 10}}
                    <div>已发货</div>
                    <a class="btn btn-purple mt-10 btn-confirm-express" data-id="{{value.tid}}">确认收货</a>
                    <a class="btn btn-purple mt-10 btn-view-express" href="<?php echo site_url('orders/detail?tid='); ?>{{value.tid}}">查看物流</a>
                {{/if}}
                {{if value.trade_status == 100}} <div>已收货</div> {{/if}}
                {{if value.trade_status == 0}} <div>已关闭</div> {{/if}}
            </td>
        </tr>
    {{/each}}
    </tbody>
    {{/each}}
</script>
<script type="text/javascript" src="/asset/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/asset/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/asset/js/template.js"></script>
<script type="text/javascript" src="/asset/js/moment.js"></script>
<script type="text/javascript" src="/asset/js/order_list.js"></script>

</body>

</html>