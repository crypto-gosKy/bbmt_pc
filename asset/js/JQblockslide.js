! function(i) {
	i.blockSlides = function(t, n) {
		var e = {
				wrapWidth: 1180,
				wrapHeight: 202,
				autoPlay: !0,
				speed: 5e3,
				isOpr: !0,
				isHideBtn: !0,
				callback: null
			},
			s = this,
			l = i(t),
			d = l.find("li").length,
			a = l.width(),
			c = l.find("ul.slides-content"),
			o = null;
		s.init = function(t) {
			this.settings = i.extend(!0, {}, e, t);
			var n = this.settings;
			n.isOpr && l.prepend('<div class="prev-btn" ></div><div class="next-btn"></div>'), c.find("li").css("width", n.wrapWidth + "px"), l.css("height", n.wrapHeight + "px"), this.bindEvent()
		}, s.bindEvent = function() {
			var i = this.settings,
				t = l.find(".prev-btn"),
				n = l.find(".next-btn");
			return 1 >= d ? (t.hide(), n.hide(), !1) : (l.hover(function() {
				o && clearInterval(o), i.isOpr && (t.show(), n.show())
			}, function() {
				i.isOpr && i.isHideBtn && (t.hide(), n.hide()), i.autoPlay && (o = setInterval(function() {
					s.play()
				}, i.speed))
			}).trigger("mouseleave"), void(i.isOpr && (t.on("click", function() {
				o && clearInterval(o), s.play(!0)
			}), n.on("click", function() {
				o && clearInterval(o), s.play()
			}))))
		}, s.play = function(i) {
			this.settings;
			c.is(":animated") || (i ? (0 == c.position().left && c.css({
				left: -a + "px"
			}).find("li:last").prependTo(c), c.animate({
				left: 0
			}, 600, function() {
				c.css({
					left: -a + "px"
				}).find("li:last").prependTo(c)
			})) : (c.position().left == -a && c.css({
				left: 0
			}).find("li:first").appendTo(c), c.animate({
				left: "-" + a
			}, 600, function() {
				c.css({
					left: 0
				}).find("li:first").appendTo(c)
			})))
		}, s.init(n)
	}, i.fn.blockSlides = function(t) {
		return this.each(function() {
			i(this).data("blockSlides") || i(this).data("blockSlides", new i.blockSlides(this, t))
		})
	}
}(jQuery);