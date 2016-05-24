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
            <li><a href="<?php echo site_url('orders/index'); ?>" >所有订单 </a></li>
            <li><a href="<?php echo site_url('orders/no_pay'); ?>" class="active">待支付订单 </a></li>
        </ul>

    </div>
    <div class="main">
        <div class="bg-e p-10">
            <a class="cur-p mr-10">订单管理</a>
            <i class="icon iconfont cor-grey mr-10 fs-12"></i>
            <a class="cur-p mr-10">代付款订单</a>
        </div>
        <div class="order-list-wrap">
            <input type="hidden" value="0" id="isHidePay">
            <input type="hidden" value="0" id="isHidePrice">
            <input type="hidden" value="" id="hideOsdId">

            <div class="tags-wrap clearfix" style="margin-top: 20px;"  id="statusSearch">
                <a data-type="" class="active">全部</a>
                <a data-type="0">国内仓发货</a>
                <a data-type="1">保税区直供</a>
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
                                                <a href="<?php echo site_url('goods/detail?item_id=' . $item['item_id']);?>" target="_blank"> <img
                                                        src="<?php echo $item['pic_url']; ?>"
                                                        width="60" height="60" class="f-l mr-10"> </a>
                                                <div class="f-l">
                                                    <div class="goods-title" style="width:180px"><a
                                                            href="<?php echo site_url('goods/detail?item_id=' . $item['item_id']);?>" target="_blank" class="title"><?php echo $item['title']; ?></a>
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
                                                <a class="btn btn-purple mt-10 btn-confirm-express" data-id="<?php echo $order['tid']; ?>">确认收货</a>
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
<?php include_once(VIEWPATH . 'kefu.php'); ?>
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
                    <a href="<?php echo site_url('goods/detail?item_id=');?>{{item.item_id}}" target="_blank"> <img
                            src="{{item.pic_url}}"
                            width="60" height="60" class="f-l mr-10"> </a>
                    <div class="f-l">
                        <div class="goods-title" style="width:180px"><a
                                href="<?php echo site_url('goods/detail?item_id=');?>{{item.item_id}}" target="_blank" class="title">{{item.title}}</a>
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
                {{if value.trade_status == 10}} <div>已发货</div> {{/if}}
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
<script type="text/javascript" src="/asset/js/orders/no_pay_list.js"></script>

</body>

</html>