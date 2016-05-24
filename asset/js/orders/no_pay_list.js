$(function() {
	var tid          = 0;
	var page         = 1;
	var begin_date   = '';
	var end_date     = '';

	function getParam() {
		var data     = {};
		var trade_type = parseInt($("#statusSearch a.active").attr('data-type'));

		if(trade_type == 0 || trade_type == 1) {
			data['trade_type'] = trade_type;
		}
		return data;
	}

	function getData(param) {
		$.ajax({
			type: 'GET',
			url: '/index.php/orders/no_pay' ,
			data:  param,
			dataType: 'json',
			success: function(data) {
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
		getData(getParam());
	});

	//导出订单
	$('body').delegate('#exportExcel', 'click', function() {
		location.href = '/index.php/orders/export';
	});

	//切换类型
	$('#statusSearch').delegate('a', 'click', function() {
		$('#statusSearch a').removeClass('active');
		$(this).addClass('active');

		getData(getParam());
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
});