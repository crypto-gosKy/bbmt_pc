$(function() {
	function show() {
		var addEditBox = $("#addEditBox").slideDown();
	}

	//错误信息显示
	function error(msg) {
		$('.zhe').show();

		$("body").append('<div class="d_error" style="display:block;"><div class="d_error2"><p>' + msg + '</p></div>');

		setTimeout(function() {
			$(".d_error").remove();
		}, 2000);

		setTimeout(function() {
			$(".zhe").hide();
		}, 2000);
	};

	//显示确认对话框
	function show_confirm(fun) {
		$(".zhe").show();
		$("#dong").show();

		//确定按钮
		$("#dongque").bind('click', function() {
			$(this).unbind();
			fun();
		});

		//取消按钮
		$('#dongqu, #dongguan').bind('click', function() {
			$(this).unbind();
			$(".zhe").hide();
			$("#dong").hide();
		});
	}

	function isPhoneNo(phone) {
		var pattern = /^1[34578]\d{9}$/;
		return pattern.test(phone);
	};

	function checkStr(name) {

		var regx = /^[a-zA-Z\u4E00-\u9FA5]{1,20}$/;
		return regx.test(name);
	};

	function hidden() {
		var addEditBox = $("#addEditBox").slideUp();
	}
	var addNormalBox = $("#addNormalBox");
	var addAddress = $("#addNormalBox > div");

	//选中当前行
	$("#addNormalBox").delegate(">div", "click", function() {
		$(this).addClass("add-selected").siblings().removeClass("add-selected");
		$("#addNormalBox input[type='radio']").removeAttr('checked');
		$(this).find("input[type='radio']").prop("checked", true);
		var	send_addrs=$(this).find("span.data-city").html();
			var item_id  = $("#js_item_info").attr("data-itemid");
		var sku_id   = $("#js_item_info").attr("data-skuid");
		var num      = $("#addcount").val();
		$.ajax({
			type:"get",
			url:"/index.php/buy/ajax_get_order_data",
				dataType: "json",
			data:{
				item_id:item_id,
				sku_id:sku_id,
				num:num,
				send_addrs:send_addrs
			},
		  success:function(data){
		  	
		  	if(data.status==true){
		  		var data=data.data;
		 		var html = template('detail_good',data);
		 		$("#tr").html(" ");
				$('#tr').append(html);
				$("#logistics_fee").html(data.orders.logistics_fee);
				$("#orderTotalPrcie").html(data.orders.total_fee);
				$("#sellerPayPrice").html(data.pay_amount);
		  }
		  }
		});
		
		
		
	});

	//保存地址操作
	function save_address(addr_id)
	{
		var param = {};
		var type  = $("#newAddBtn").attr("data-type");
		var reg = /^[1-9]{1}[0-9]{14}$|^[1-9]{1}[0-9]{16}([0-9]|[xX])$/;

		param['mobile'] = $("#customerPhone").val();

		if (type > 0) {
			param['idcard'] = $("#custIdNum").val();
		} else {
			param['idcard'] = '';
		}

		if(addr_id > 0) {
			param['addr_id'] = addr_id;
		}

		param['name']     = $("#custName").val();
		param['state']    = $("#province option:selected").text();
		param['city']     = $("#city option:selected").text();
		param['district'] = $("#area option:selected").text();
		param['address']  = $("#custAddressDetail").val();

		if (
			param['mobile'] == "" ||
			param['name'] == "" ||
			param['address'] == "" ||
			param['state'] == "--请选择省份--" ||
			param['city'] == "--请选择城市--" ||
//			param['district'] == "--请选择地区--" ||
			param['district'] == "市辖区"
		) {
			error("必填项不能为空,亲");
			return false
		}

		if (type > 0 && param['idcard'] == "") {
			error("必填项不能为空,亲");
			return false
		}

		if (isPhoneNo(param['mobile']) == false) {
			error("请输入正确的手机号");
			return false
		}

		if (checkStr(param['name']) == false) {
			error("请输入正确的姓名");
			return false
		}

		if (type > 0 && !reg.test(param['idcard'])) {
			error("请输入正确的身份证号码");
			return false
		}

		do_save_address(param, function(data) {
			if(addr_id > 0) {
				var parent   = $("input[name='address_data'][data-id='" + addr_id + "']").parent();
				parent.find("span.data-name").html(param['name']);
				parent.find("span.data-mobile").html(param['mobile']);
				parent.find("span.data-idcard").html(param['idcard']);
				parent.find("span.data-state").html(param['state']);
				parent.find("span.data-city").html(param['city']);
				parent.find("span.data-district").html(param['district']);
				parent.find("span.data-address").html(param['address']);
				parent.find("span.data-id_card").html(param['idcard']);
				error("操作成功!");
				hidden();
			} else {
				var html = template('address_tpl', {
					'address': data['data']
				});

				$('#addNormalBox').append(html);

				error("操作成功!");
				hidden();
			}



		});
	}

	//保存地址
	function do_save_address(param, fun)
	{
		$.ajax({
			type: "post",
			url: "/index.php/buy/save_address",
			data: param,
			dataType: "json",
			success: function(data) {
				if (data.status == false) {
					error(data.msg)
				}

				if (data.status == true) {
					if(fun != null) {
						fun(data);
					}
				}
			}
		});
	}

	//删除地址
	function delete_address(addr_id)
	{
		$.ajax({
			type: "post",
			url: "/index.php/buy/delete_buyer_address",
			data: {
				addr_id: addr_id,
			},
			dataType: "json",
			success: function(data) {
				if (data.status == false) {
					error(data.msg);
				}
				if (data.status == true) {
					$("#dong").hide();
					$(".zhe").hide();
					error("删除成功");
					$("#addNormalBox > div.add-selected").remove();
				}
			}
		});
	}

	//点击保存
	$("#saveAddBtn").click(function(event) {
		var addr_id = $('#addressId').val();

		save_address(addr_id);
	});

	//新增加地址
	$("#newAddBtn").click(function() {
		var type  = $("#newAddBtn").attr("data-type");

		if (type > 0) {
			$("#cardID").show();
			$("#receiveName").show();
		}

		$("#addEditBox").find("input").val("");
		$("#addEditBox").find("textarea").val("");
		$('#addressId').val(0);

		show();

		return false;
	});

	//取消
	$("#cancelAddBtn").click(function() {
		hidden();
	});

	//设为默认地址
	$("#addNormalBox").delegate(".setDefaultBtn", "click", function() {
		var param = {};
		var addr_id = $(this).attr("data-addr_id");

		var parent   = $("input[name='address_data'][data-id='" + addr_id + "']").parent();

		param['addr_id']    = addr_id;
		param['name']       = parent.find("span.data-name").html();
		param['mobile']     = parent.find("span.data-mobile").html();
		param['idcard']     = parent.find("span.data-idcard").html();
		param['state']      = parent.find("span.data-state").html();
		param['city']       = parent.find("span.data-city").html();
		param['district']   = parent.find("span.data-district").html();
		param['address']    = parent.find("span.data-address").html();
		param['address']    = parent.find("span.data-address").html();
		param['idcard']    = parent.find("span.data-id_card").html();

		param['is_default'] = 1;
		do_save_address(param, function() {
			error("设置默认成功");
		});
	});

	//点击修改
	$("#addNormalBox").delegate(".edit-btn", "click", function() {
		var addr_id = $(this).attr("data-addr_id");

		if ($("#newAddBtn").attr("data-type")>0) {
			$("#receiveName").show();
			$("#cardID").show();
		}

		//查找对应的行
		var parent   = $("input[name='address_data'][data-id='" + addr_id + "']").parent();

		$("#custIdNum").val(parent.find("span.data-id_card").html());
		$('#addressId').val(addr_id);
		$("#customerPhone").val(parent.find("span.data-mobile").html());
		$("#custName").val(parent.find("span.data-name").html());
		$("#province option:selected").text(parent.find("span.data-state").html());
		$("#city option:selected").text(parent.find("span.data-city").html());
		$("#area option:selected").text(parent.find("span.data-district").html());
		$("#custAddressDetail").val(parent.find("span.data-address").html());

		show();

		return false;
	});

	//删除地址
	$("#addNormalBox").delegate(".del-btn", "click", function() {
		var addr_id = $(this).attr("data-addr_id");

		show_confirm(function(){
			delete_address(addr_id);
		});

	});

	//提交订单
	$('#saveOrderBtn').click(function() {
		var check_length = $('#addNormalBox input:radio:checked').length;

		//没选中
		if(check_length == 0) {
			error('没有选中地址');

			return false;
		}

		var parent = $('#addNormalBox input:radio:checked').parent();
		var idcard   = parent.find("span.data-id_card").html();
		var name     = parent.find("span.data-name").html();
		var mobile   = parent.find("span.data-mobile").html();
		var state    = parent.find("span.data-state").html();
		var city     = parent.find("span.data-city").html();
		var district = parent.find("span.data-district").html();
		var address  = parent.find("span.data-address").html();
		var item_id  = $("#js_item_info").attr("data-itemid");
		var sku_id   = $("#js_item_info").attr("data-skuid");
		var num      = $("#addcount").val();

		$.ajax({
			url: '/index.php/buy/create_order',
			type: 'POST',
			data: {
				idcard:   idcard,
				mobile:   mobile,
				name:     name,
				state:    state,
				city:     city,
				district: district,
				address:  address,
				item_id:  item_id,
				sku_id:   sku_id,
				num:      num

			},
			dataType: 'json',
			success: function(data) {
				if (data.status == false) {
					error(data.msg);
				} else {
					$('.zhe').show();
					$('#gobox').show();
					$("#payOrder").attr("href", '/index.php/orders/payment?tid=' + data.data.tid + '');
					$("#showOrder").attr("href", '/index.php/orders/detail?tid=' + data.data.tid + '');
					$("#continueOrder").attr("href", '/index.php/goods/index');
				}
			},
			error: function(data) {
				alert("提交数据失败");
			}
		});
	});

});