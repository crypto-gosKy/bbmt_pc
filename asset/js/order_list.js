$(function() {
	var tid          = 0;
	var page         = 1;
	var buyer_name   = '';
	var buyer_mobile = '';
	var goods_name   = '';
	var order_status = -1;
	var begin_date   = '';
	var end_date     = '';

	function getParam() {
		var data     = {};
		tid          = parseInt($("input[name='orderNum']").val());
		buyer_name   = $.trim($("input[name='deliveryName']").val());
		buyer_mobile = $.trim($("input[name='deliveryPhone']").val());
		goods_name   = $.trim($("input[name='goodsName']").val());
		order_status = parseInt($("#statusSelect").val());
		begin_date   = $('#begin_date').val();
		end_date     = $('#end_date').val();



		//tid
		if(tid > 0) {
			data['tid'] = tid;
		}

		//buyer_name
		if(buyer_name != '') {
			data['buyer_name'] = buyer_name;
		}

		//buyer_mobile
		if(buyer_mobile != '') {
			data['buyer_mobile'] = buyer_mobile;
		}

		//goods_name
		if(goods_name != '') {
			data['goods_name'] = goods_name;
		}

		//order_status
		if(order_status > -1) {
			data['order_status'] = order_status;
		}

		//begin_date
		if(begin_date != '') {
			data['begin_date'] = begin_date;
		}

		//end_date
		if(end_date != '') {
			data['end_date'] = end_date;
		}

		return data;
	}

	function getData(param) {
		//判断时差
		if(moment(param['begin_date']).isAfter(param['end_date'])) {
			alert('开始时间必须要小于结束时间');

			return false;
		}

		$.ajax({
			type: 'GET',
			url: '/index.php/orders/index' ,
			data:  param,
			dataType: 'json',
			success: function(data) {
				//
				$("#loading").hide();
				//清空填充列表
				$('#orderListTable tbody').remove();

				var html = template('order_tpl', {
					'list': data['orders']
				});

				$('#orderListTable').append(html);

				//更新分页
				$('.pagination span, .pagination a').remove();
				$('.pagination').prepend(data['page']);
				$('#total_page').html(data['total_page']);
				$('#cur_page').val(data['cur_page']);
				$('#total_count').html(data['total_count']);
			}
		});
	}

	//分页处理
	$('#pagination').delegate('a, input[type="button"]', 'click', function() {
		var data = getParam();
		page = parseInt($(this).attr('data-ci-pagination-page'));

		if($(this).is('input')) {
			page = parseInt($('#cur_page').val());
		}

		data['page'] = page;

		getData(data);

		return false;
	});
	
	//搜索事件
	$('body').delegate('.search-btn', 'click', function () {
		//
		$("#loading").show();
		getData(getParam());
	});

	//导出订单
	$('body').delegate('#exportExcel', 'click', function() {
		location.href = '/index.php/orders/export';
	});

	//切换状态
	$('#statusSearch').delegate('a', 'click', function() {
		$('#statusSearch a').removeClass('active');
		$(this).addClass('active');

		var status = parseInt($(this).attr('data-status'));

		//设置下拉列表框
		$('#statusSelect').val(status);

		getData(getParam());

	});

	//点击近7天链接
	$('body').delegate('#sevenDayLink', 'click', function(){
		$('#begin_date').val(moment().subtract(7, 'd').format('YYYY-MM-DD'));
		$('#end_date').val(moment().format('YYYY-MM-DD'));
	});

	//点击近30天链接
	$('body').delegate('#monthLink', 'click', function(){
		$('#begin_date').val(moment().subtract(30, 'd').format('YYYY-MM-DD'));
		$('#end_date').val(moment().format('YYYY-MM-DD'));
	});

	//取消订单
	$('body').delegate('.btn-cancel-order', 'click', function() {
		var param = {};
		var _this = this;
		param['tid'] = $(this).attr('data-id');


		if(confirm('确认取消订单吗?')) {
			$.ajax({
				type: 'POST',
				url: '/index.php/orders/cancel' ,
				data:  param,
				dataType: 'json',
				success: function(data) {
					if(data['return_code'] == 1) {
						alert(data['return_msg']);
					}

					if(data['return_code'] == 0) {
						$(_this).parent().html("<div>已关闭</div>");
					}
				}
			});
		}
	});

	//点击确认收货按钮事件
	$('body').delegate('.btn-confirm-express','click',function(){
		var tid = $(this).attr('data-id');
		var _this = this;
		if(confirm("是否已经收到货品？ （请认真核实已经收到货品，否则可能会钱货两空）")){
			$.ajax({
				type     : 'POST',
				url      : '/index.php/orders/confirm_receive_goods',
				data 	 : {'tid':tid},
				dataType : 'json',
				success  : function(data){
					if(data.return_code == 0){
						$(_this).parent().html("<div>已收货</div>");
					}else{
						alert('系统繁忙，给您带来不便请您包涵！');
						location.reload();
					}
				}
			});
		}
	});
});