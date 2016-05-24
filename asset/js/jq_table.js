! function(e) {
	e.PaginationCalculator = function(e, t) {
		this.maxentries = e, this.opts = t
	}, e.extend(e.PaginationCalculator.prototype, {
		numPages: function() {
			return Math.ceil(this.maxentries / this.opts.items_per_page)
		},
		getInterval: function(e) {
			var t = Math.floor(this.opts.num_display_entries / 2),
				n = this.numPages(),
				a = n - this.opts.num_display_entries,
				s = e > t ? Math.max(Math.min(e - t, a), 0) : 0,
				i = e > t ? Math.min(e + t + this.opts.num_display_entries % 2, n) : Math.min(this.opts.num_display_entries, n);
			return {
				start: s,
				end: i
			}
		}
	}), e.PaginationRenderers = {}, e.PaginationRenderers.defaultRenderer = function(t, n) {
		this.maxentries = t, this.opts = n, this.pc = new e.PaginationCalculator(t, n)
	}, e.extend(e.PaginationRenderers.defaultRenderer.prototype, {
		createLink: function(t, n, a) {
			var s, i = this.pc.numPages();
			return t = 0 > t ? 0 : i > t ? t : i - 1, a = e.extend({
				text: t + 1,
				classes: ""
			}, a || {}), t == n ? s = e("<span class='current'>" + a.text + "</span>") : (s = e("<a>" + a.text + "</a>"), this.opts.link_to && s.attr("href", this.opts.link_to.replace(/__id__/, t))), a.classes && s.addClass(a.classes), s.data("page_id", t), s
		},
		appendRange: function(e, t, n, a, s) {
			var i;
			for (i = n; a > i; i++) this.createLink(i, t, s).appendTo(e)
		},
		getLinks: function(t, n, a) {
			var s, i, r = this.pc.getInterval(t),
				p = this.pc.numPages(),
				o = e("<div class='pagination'></div>");
			return this.opts.prev_text && (t > 0 || this.opts.prev_show_always) && o.append(this.createLink(t - 1, t, {
				text: this.opts.prev_text,
				classes: "prev"
			})), r.start > 0 && this.opts.num_edge_entries > 0 && (i = Math.min(this.opts.num_edge_entries, r.start), this.appendRange(o, t, 0, i, {
				classes: "sp"
			}), this.opts.num_edge_entries < r.start && this.opts.ellipse_text && jQuery("<span>" + this.opts.ellipse_text + "</span>").appendTo(o)), this.appendRange(o, t, r.start, r.end), r.end < p && this.opts.num_edge_entries > 0 && (p - this.opts.num_edge_entries > r.end && this.opts.ellipse_text && jQuery("<span>" + this.opts.ellipse_text + "</span>").appendTo(o), s = Math.max(p - this.opts.num_edge_entries, r.end), this.appendRange(o, t, s, p, {
				classes: "ep"
			})), this.opts.next_text && (p - 1 > t || this.opts.next_show_always) && o.append(this.createLink(t + 1, t, {
				text: this.opts.next_text,
				classes: "next"
			})), o.append('<div class="page-info">\u5171' + this.pc.maxentries + "\u6761\uff0c\u5171" + p + "\u9875</div>"), p > 1 && this.opts.jump_page && o.append('<input type="text" value="' + (t + 1) + '" class="jumpipt jumpPage " /><input type="button" value="\u786e\u5b9a" class="jumpipt jumpBtn" />'), e("a", o).click(n), e(".jumpBtn", o).click(a), o
		}
	}), e.fn.pagination = function(t, n) {
		function a(t) {
			var n = e(t.target).data("page_id"),
				a = s(n);
			return a || t.stopPropagation(), a
		}

		function s(e) {
			u.data("current_page", e), p = r.getLinks(e, a, i), u.empty(), p.appendTo(u);
			var t = n.callback(e + 1, u);
			return t
		}

		function i(t) {
			var n = e(t.target),
				a = n.prev().val() - 1;
			a = 0 > a ? 0 : d > a ? a : d - 1, s(a)
		}
		n = jQuery.extend({
			items_per_page: 10,
			num_display_entries: 8,
			current_page: 0,
			num_edge_entries: 1,
			link_to: "",
			prev_text: "\u4e0a\u4e00\u9875",
			next_text: "\u4e0b\u4e00\u9875",
			ellipse_text: "...",
			prev_show_always: !0,
			next_show_always: !0,
			renderer: "defaultRenderer",
			load_first_page: !1,
			jump_page: !0,
			callback: function() {
				return !1
			}
		}, n || {});
		var r, p, o, u = this;
		if (o = n.current_page, u.data("current_page", o), t = !t || 0 > t ? 1 : t, n.items_per_page = !n.items_per_page || n.items_per_page < 0 ? 1 : n.items_per_page, !e.PaginationRenderers[n.renderer]) throw new ReferenceError("Pagination renderer '" + n.renderer + "' was not found in jQuery.PaginationRenderers object.");
		r = new e.PaginationRenderers[n.renderer](t, n);
		var _ = new e.PaginationCalculator(t, n),
			d = _.numPages();
		u.bind("setPage", {
			numPages: d
		}, function(e, t) {
			return t >= 0 && t < e.data.numPages ? (s(t), !1) : void 0
		}), u.bind("prevPage", function(t) {
			var n = e(this).data("current_page");
			return n > 0 && s(n - 1), !1
		}), u.bind("nextPage", {
			numPages: d
		}, function(t) {
			var n = e(this).data("current_page");
			return n < t.data.numPages - 1 && s(n + 1), !1
		}), p = r.getLinks(o, a, i), u.empty(), p.appendTo(u), n.load_first_page && n.callback(o, u)
	}
}(jQuery);