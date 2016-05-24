$(function() {
	var _html 			   = '';
	var $logistics		   = $('#logisticsBox');
	var invoice_no        = $logistics.attr('data-invoice_no');
	var logistics_company = $logistics.attr('data-logistics_company');
	$.ajax({
		type: 'GET',
		url: '/index.php/orders/get_logistics_trace_info' ,
		data:  {'invoice_no':invoice_no,'logistics_company':logistics_company},
		dataType: 'json',
		success: function(data) {
			if(data.status){        //有物流数据
				var info = data.data.logistics.lastResult.data;
				if(info != ''){
					for(i=0;i<info.length;i++ ){
						_html += "<div class='mb-15'><span class='cor-pink'>"+info[i].time+"</span>&nbsp;&nbsp;&nbsp;&nbsp;"+
							"<span class='cor-pink'>"+info[i].context+"</span></div>";
					}
				}else{
					_html = '<span class="cor-pink">暂无物流数据</span>';
				}


			}else{					//没有物流数据
				_html = '<span class="cor-pink">暂无物流数据</span>';
			}
			$logistics.append(_html);
		}
	});

	//点击确认收货按钮事件
	$('#confirmReceive').on('click',function(){
		var tid = $(this).attr('data-tid');
		if(confirm("是否已经收到货品？ （请认真核实已经收到货品，否则可能会钱货两空）")){
			$.ajax({
				type     : 'POST',
				url      : '/index.php/orders/confirm_receive_goods',
				data 	 : {'tid':tid},
				dataType : 'json',
				success  : function(data){
					if(data.return_code == 0){
						alert('恭喜您成功收货，祝您生活愉快！');
						window.location = '/index.php/orders/index';
					}else{
						alert('系统繁忙，给您带来不便请您包涵！');
						location.reload();
					}
				}
			});
		}
	});
});