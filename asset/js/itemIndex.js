$(function() {
	var t = function() {
		this.basePath = $("#basePath").val(), this.isLoad = !1
	};
	t.prototype = {
		initPage: function() {
			$("#slidesWrap").blockSlides({
				autoPlay: !0,
				wrapWidth: 1188,
				wrapHeight: 360,
				isHideBtn: !1
			}), $("#channelWrap").find("#firstItem").addClass("checked"), this.eventBind()
		},
		eventBind: function() {
			var t = this,
				e = $("#moduleLiftList");
			if (e.on("mouseover", ".lift-item", function() {
					$(this).css("background-color", "#FF5C5C"), $(this).find(".lift-checked").show(), $(this).find(".img-unhover").hide(), $(this).find(".img-hover").show()
				}), e.on("mouseout", ".lift-item", function() {
					$(this).css("background-color", "#fff"), $(this).find(".lift-checked").hide(), $(this).find(".img-hover").hide(), $(this).find(".img-unhover").show()
				}), e.on("click", ".lift-item", function() {
					var t = $(this).attr("data-id"),
						e = $("#" + t).offset().top;
					window.pageYOffset = e - 60, document.documentElement.scrollTop = e - 60, document.body.scrollTop = e - 60
				}), window.sessionStorage) {
				var i = sessionStorage.getItem("IndexData");
				if (i) {
					i = JSON.parse(i);
					var o = Yt.render($("#goodsListTpl").html(), i);
					t.putListItem(i), $("#noItem").remove(), $("#goodsModuleBox").append(o)
				} else $(window).one("scroll", function() {
					t.fGetData()
				});
				setTimeout(function() {
					sessionStorage.removeItem("IndexData")
				}, 3e4)
			} else $(window).one("scroll", function() {
				t.fGetData()
			})
		},
		fGetData: function() {
			var t = this;
			Yt.post(t.basePath + "/admin/item/itemIndex.json", {}, function(e) {
				var i = t.formatData(e),
					o = Yt.render($("#goodsListTpl").html(), i);
				t.putListItem(i), $("#noItem").remove(), $("#goodsModuleBox").append(o), window.sessionStorage && sessionStorage.setItem("IndexData", JSON.stringify(i))
			}, function() {}, !1)
		},
		formatData: function(t) {
			for (var e = t, i = new Array, o = "", n = 0; n < t.data.length; n++) {
				o = t.data[n].categoryId.replace(/,/g, ""), t.data[n].identify = o;
				var a = {};
				a.identify = o, a.id = t.data[n].categoryId, a.pic1 = t.data[n].picture1, a.pic2 = t.data[n].picture2, a.name = t.data[n].categoryName, i.push(a)
			}
			return e.liftList = i, e
		},
		putListItem: function(t) {
			var e = Yt.render($("#liftListTpl").html(), t);
			$("#moduleLiftList").append(e), $("#moduleLiftList").show()
		}
	};
	var e = new t;
	e.initPage()
});