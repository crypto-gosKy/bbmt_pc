$(function() {
	function get_payment() {
		var tid = $("#js_tid").attr("data-tid");

		$.ajax({
			type: "get",
			url: "/index.php/payment/get_payment",
			data: {
				tid: tid
			},
			dataType: 'json',
			success: function(data) {
				$('body').append(data.data);
				$('#confirmPayBtn').attr('disabled', false);
			}
		});
	}

	$('#d_fenkai').hide();
	$(".d_setting").click(function() {
		$('#d_fenkai').show();
	});
	$("#d_fenkai").mouseover(function() {
		$(this).show();
	});
	$("#d_fenkai").mouseout(function() {
		$(this).hide();
	});
	$("#allType").mouseover(function() {
		$("#typeList").show();
	});
	$("#typeList").mouseover(function() {
		$("#typeList").show();
	});
	$("#typeList").mouseout(function() {
		$("#typeList").hide();
	});

	$("#confirmPayBtn").click(function() {
		var state = $('#confirmPayBtn').attr('disabled');
		if(state == 'disabled') {
			return false;
		}

		$(".zhe").show();
		$("#gobox").show();

		$('#btnPay').click();
	});

	$("#payOrder1").click(function() {
		$('#btnPay').click();
	});

	$('#continueOrder1').click(function() {
		var url = window.location.search;
		var loc = url.substring(url.lastIndexOf('=') + 1, url.length);

		$.ajax({
			type: "get",
			url: "/index.php/orders/index",
			data: {
				tid: loc
			},
			dataType: 'json',
			success: function(data) {
				if (data.orders[0].trade_status==1) {
					$("#gobox").hide();
					$(".box_nopay").show();
					setTimeout(function(){
						$(".box_nopay").hide();
						$(".zhe").hide();
					},2500)
				}
				if (data.orders[0].trade_status>1) {
					window.location.href="/index.php/orders/index";
				}
			}
		});

		return false;
	});

	get_payment();
});