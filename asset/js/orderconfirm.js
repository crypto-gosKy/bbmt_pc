$(function() {
	var a = $("#basePath").val(),
		e = /(msie|trident|edge)/i.test(navigator.userAgent) && !window.opera,
		i = {
			initPage: function() {
				this.eventBind()
			},
			eventBind: function() {
				var a = this,
					i = $("#cardTypeBox"),
					n = $("#creditCardList"),
					t = $("#savingCardList"),
					d = $("#otherPayList");
				i.on("click", "#savingCard", function() {
					i.find("a").removeClass("active"), $(this).addClass("active"), n.hide(), t.show(), d.hide()
				}), i.on("click", "#creditCard", function() {
					i.find("a").removeClass("active"), $(this).addClass("active"), t.hide(), n.show(), d.hide()
				}), i.on("click", "#otherPay", function() {
					i.find("a").removeClass("active"), $(this).addClass("active"), t.hide(), n.hide(), d.show()
				}), e ? $("#confirmPayBtn").mousedown(function() {
					if ($("#otherPay").hasClass("active")) {
						if ($('input:radio[name="payRadio"]:checked').length < 1) return Yt.tips("请选择支付方式"), !1;
						var e = $('input:radio[name="payRadio"]:checked').val();
						a.checkAndPay($(this), e)
					} else a.doConfirmCard($(this));
					return !1
				}) : $("#confirmPayBtn").click(function() {
					if ($("#otherPay").hasClass("active")) {
						var e = $('input:radio[name="payRadio"]:checked').val();
						a.checkAndPay($(this), e)
					} else a.doConfirmCard($(this))
				})
			},
			doConfirmCard: function(a) {
				var e = this,
					i = $("#savingCardList"),
					n = $("#creditCardList"),
					t = $("#cardTypeBox").find(".active").attr("data-channel"),
					d = "";
				if ("19" == t) {
					if (i.find('input:radio[name="savingCardRadio"]:checked').length < 1) return Yt.tips("请选择支付银行"), !1;
					d = i.find('input:radio[name="savingCardRadio"]:checked').val()
				} else if ("20" == t) {
					if (n.find('input:radio[name="creditCardRadio"]:checked').length < 1) return Yt.tips("请选择支付银行"), !1;
					d = n.find('input:radio[name="creditCardRadio"]:checked').val()
				}
				e.cardPayFun(a, d, t)
			},
			openTarget: $("#openPage"),
			checkAndPay: function(e, i) {
				var n = this;
				return e.data("hasClick") ? !1 : (e.data("hasClick", !0), void Yt.ajax({
					type: "post",
					async: !1,
					url: a + "/admin/order/order/getOrderOsdIdByIdOrNum.json",
					data: {
						orderNum: $("#orderNum").val()
					},
					dataType: "json",
					complete: function() {
						e.data("hasClick", !1)
					},
					success: function(e) {
						"6" == e.data ? (Yt.tips("此订单已支付，请勿重复付款！"), window.location.href = a + "/admin/order/orderpay/turnSuccessPage.do?orderNum=" + $("#orderNum").val()) : n.openPayPage(i, "")
					}
				}))
			},
			cardPayFun: function(e, i, n) {
				var t = this;
				if (e.data("hasClick")) return !1;
				e.data("hasClick", !0);
				var d = {
					orderNum: $("#orderNum").val(),
					bankCode: i,
					payChannel: n
				};
				Yt.ajax({
					type: "post",
					async: !1,
					url: a + "/admin/order/orderPay/shengFuTongPay.json",
					data: d,
					dataType: "json",
					complete: function() {
						e.data("hasClick", !1)
					},
					success: function(a) {
						200 == a.code ? t.openPayPage("shengfutong", a.data) : Yt.tips(a.message)
					}
				})
			},
			openPayPage: function(e, i) {
				var n = this,
					t = $("#orderNum").val();
				"aliPay" === e ? this.openNewWin(a + "/admin/order/orderpay/alipayReq.do?orderNum=" + t) : "tenPay" === e ? this.openNewWin(a + "/admin/order/orderpay/weixinScanReq.do?orderNum=" + t) : this.openNewWin(i, e), setTimeout(function() {
					n.payDialog()
				}, 5)
			},
			openNewWin: function(a) {
				if (e) {
					var i = this;
					i.openTarget.attr("href", a), i.openTarget.trigger("click")
				} else window.open(a, "_blank")
			},
			payDialog: function() {
				var e = dialog({
					title: "请付款",
					content: $("#payTipTemp").html(),
					width: 340,
					height: 260,
					cancel: !1,
					fixed: !0
				});
				e.showModal(), $("#finishPayBtn").off("click").on("click", function() {
					e.close().remove(), Yt.post(a + "/admin/order/order/getOrderOsdIdByIdOrNum.json", {
						orderNum: $("#orderNum").val()
					}, function(e) {
						"6" == e.data ? (Yt.tips("付款成功！"), window.location.href = a + "/admin/order/order/now.do") : Yt.tips("付款失败，请重新支付！")
					})
				}), $("#changePayType").off("click").on("click", function() {
					e.close().remove(), Yt.post(a + "/admin/order/order/getOrderOsdIdByIdOrNum.json", {
						orderNum: $("#orderNum").val()
					}, function(e) {
						"6" == e.data && (Yt.tips("此商品已完成付款，请勿重复支付！"), window.location.href = a + "/admin/order/order/now.do")
					})
				})
			}
		};
	i.initPage()
});