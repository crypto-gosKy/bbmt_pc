$(function() {
	var e = function() {
		this.basePath = $("#basePath").val(), this.goodsImgBig = $("#goodsImgBig"), this.itemId = $("#itemId").val(), this.itemType = $("#itemType").val(), this.areaDialog = void 0, this.weight = 0, this.canPost = void 0, this.specId = void 0, this.stock = 1e5, this.priceHide = $("#isHide").val(), this.scrollTitleTop = $("#scrollTitle").offset().top, this.goodsInfoTag = $("#goodsInfoTag"), this.goodsDetailTag = $("#goodsDetailTag"), this.goodsFaqTag = $("#goodsFaqTag"), this.goodsInfo = $("#goodsInfo"), this.goodsDetail = $("#goodsDetail"), this.goodsFaq = $("#goodsFaq"), this.productionDate = ""
	};
	e.prototype = {
		initPage: function() {
			this.eventBind()
		},
		eventBind: function() {
			var e = this;
			$(".faq-title").on("click", function() {
				var e = $(this);
				e.toggleClass("cor-red"), e.hasClass("cor-red") ? (e.find(".faq-arrow-bottom").hide(), e.find(".faq-arrow-top").show()) : (e.find(".faq-arrow-bottom").show(), e.find(".faq-arrow-top").hide()), e.parent("div").find(".faq-content").slideToggle()
			});
			var t = $("#goodsImgPrev"),
				i = $("#goodsImgNext"),
				a = $(".goods-img-small"),
				o = $(".goods-img-small").length;
			2 > o && i.find(".iconfont").addClass("cor-9"), a.on("click", function() {
				if ($(this).hasClass("img-checked")) return !1;
				var a = $(this).attr("data-id");
				0 == a ? t.find(".iconfont").addClass("cor-9") : t.find(".iconfont").removeClass("cor-9"), a == o - 1 ? i.find(".iconfont").addClass("cor-9") : i.find(".iconfont").removeClass("cor-9"), $(this).addClass("img-checked").siblings(".goods-img-small").removeClass("img-checked");
				var s = $(this).find("img").attr("src");
				e.goodsImgBig.attr("src", s)
			}), t.on("click", function() {
				e.changeImg("prev")
			}), i.on("click", function() {
				e.changeImg("next")
			});
			var s = $("#goodsNum"),
				d = $("#specificationsBox");
			d.on("click", ".specifications-item", function() {
				var t = $(this);
				if (!t.hasClass("specifications-lack")) {
					t.addClass("specifications-checked").siblings(".specifications-item").removeClass("specifications-checked");
					var i;
					if ("2" == e.itemType) s.val(1), e.getdeliveryFee();
					else {
						var a = t.attr("data-actualUnitPrice"),
							o = t.attr("data-actualPrice");
						$("#actualPrice").text(o); {
							t.attr("data-singleguideprice")
						}
						i = "(单价: ¥" + (a || 0) + ")", $("#actualUnitPriceId").html(i)
					}
				}
			}), $("#addressBtn").on("click", function() {
				e.getProvince()
			});
			var n = $("#areaListWrap");
			e.onAreaSelect(n);
			var c = $("#numAdd"),
				r = $("#numReduce");
			c.on("click", function() {
				var t = $(".specifications-checked").attr("data-specnum");
				return Number(s.val() * t) + 1 > e.stock ? !1 : ((Number(s.val()) + 2) * t > e.stock && $(this).find(".iconfont").addClass("cor-9"), r.find(".iconfont").removeClass("cor-9"), s.val(Number(s.val()) + 1), void e.getdeliveryFee())
			}), r.on("click", function() {
				return Number(s.val()) < 2 ? !1 : (Number(s.val()) < 3 && $(this).find(".iconfont").addClass("cor-9"), c.find(".iconfont").removeClass("cor-9"), s.val(Number(s.val()) - 1), void e.getdeliveryFee())
			}), s.on("change", function() {
				var t = $(".specifications-checked").attr("data-specnum");
				return 0 == s.val() ? r.find(".iconfont").addClass("cor-9") : r.find(".iconfont").removeClass("cor-9"), s.val() * t == (e.stock / t).toFixed(0) ? c.find(".iconfont").addClass("cor-9") : c.find(".iconfont").removeClass("cor-9"), e.stock / t < s.val() ? (s.val((e.stock / t).toFixed(0)), c.find(".iconfont").addClass("cor-9"), !1) : void e.getdeliveryFee()
			}), $("#buyBtn").on("click", function() {
				if (!$(this).hasClass("buy-disable")) {
					if ($(".specifications-checked").length < 1) return void Yt.tips("请选择规格!");
					if (1 == e.itemType || 3 == e.itemType) {
						var t = $(".specifications-checked").attr("data-specid");
						window.location.href = e.basePath + "/admin/order/order/addOrEdit.do?itemId=" + e.itemId + "&itemSpecId=" + t
					} else 2 == e.itemType && e.buyFunction()
				}
			}), $("#deliveryId").on("change", function() {
				var e = $(this).find("option:selected").attr("data-deliveryFeeYuan");
				$("#deliveryFeeId").text(e)
			}), e.goodsInfoTag.on("click", function() {
				var t = e.goodsInfo.offset().top;
				$("html, body").animate({
					scrollTop: t - 138
				}, 200)
			}), e.goodsDetailTag.on("click", function() {
				if (e.goodsDetail.length < 1) return !1;
				var t = e.goodsDetail.offset().top;
				$("html, body").animate({
					scrollTop: t - 138
				}, 200)
			}), e.goodsFaqTag.on("click", function() {
				if (e.goodsFaq.length < 1) return !1;
				var t = e.goodsFaq.offset().top;
				$("html, body").animate({
					scrollTop: t - 138
				}, 200)
			}), $(window).on("scroll", function(t) {
				t.stopPropagation();
				var i = $("#scrollTitle"),
					a = $("#infoBoxId"),
					o = $(window).scrollTop();
				o > e.scrollTitleTop - 60 ? i.hasClass("scrollFix") || (i.addClass("scrollFix"), a.css("margin-top", "74px")) : i.hasClass("scrollFix") && (i.removeClass("scrollFix"), a.css("margin-top", "0px")), e.goodsDetail.length > 0 && o > e.goodsDetail.offset().top - 500 && o < e.goodsDetail.offset().top + e.goodsDetail.height() - 500 && e.goodsDetailTag.addClass("info-checked").siblings("div").removeClass("info-checked"), e.goodsFaq.length > 0 && o > e.goodsFaq.offset().top - 500 && o < e.goodsFaq.offset().top + e.goodsFaq.height() - 500 && e.goodsFaqTag.addClass("info-checked").siblings("div").removeClass("info-checked"), o > e.goodsInfo.offset().top - 300 && o < e.goodsInfo.offset().top + e.goodsInfo.height() - 300 && e.goodsInfoTag.addClass("info-checked").siblings("div").removeClass("info-checked")
			})
		},

		changeImg: function(e) {
			var t, i = this,
				a = $(".img-checked"),
				o = a.attr("data-id"),
				s = $(".goods-img-small").length,
				d = $("#goodsImgBox"),
				n = (d.css("margin-top"), $("#goodsImgPrev")),
				c = $("#goodsImgNext");
			if ("prev" == e) {
				if (0 == o) return !1;
				1 == o && n.find(".iconfont").addClass("cor-9"), c.find(".iconfont").removeClass("cor-9"), s - 2 > o && d.animate({
					"margin-top": 110 * -(o - 1) + "px"
				}, 300), a.removeClass("img-checked"), t = a.prev(".goods-img-small").find("img").attr("src"), a.prev(".goods-img-small").addClass("img-checked")
			}
			if ("next" == e) {
				if (o == s - 1) return !1;
				o == s - 2 && c.find(".iconfont").addClass("cor-9"), n.find(".iconfont").removeClass("cor-9"), o > 1 && d.animate({
					"margin-top": 110 * -(o - 1) + "px"
				}, 300), a.removeClass("img-checked"), t = a.next(".goods-img-small").find("img").attr("src"), a.next(".goods-img-small").addClass("img-checked")
			}
			i.goodsImgBig.attr("src", t)
		}
	};
	var t = new e;
	t.initPage()
});