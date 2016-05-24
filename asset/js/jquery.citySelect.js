! function(e) {
	e.CitySelect = function(e, a) {
		this.config = a, this.wrap = e
	}, e.extend(e.CitySelect.prototype, {
		init: function() {
			var e = this.config,
				a = this.wrap,
				t = a.find("select").eq(0);
			this.setUpdateCache(), this.changeSelect(), this.createOptions(t, 0, e.prov)
		},
		createOptions: function(a, t, r) {
			var i = this,
				c = this.config,
				n = (i.wrap, c.data || {});
			n[c.paramName] = r || "", n.level = t + 1;
			var o = this.getStorageCache(t, r);
			return o ? (i.generateOption({
				curSelect: a,
				index: t,
				data: o
			}), !1) : (c.setParam.call(a, t + 1, r), void e.ajax({
				type: "POST",
				url: c.url,
				data: n,
				dataType: "json",
				error: function() {},
				success: function(e) {
					i.setStorageCache(e.data, t, r), i.generateOption({
						curSelect: a,
						index: t,
						data: e.data
					})
				}
			}))
		},
		generateOption: function(a) {
			var t = a.curSelect,
				r = a.index,
				i = a.data,
				c = this.config;
			if (t.find("option:gt(0)").remove(), i && i.length > 0) {
				var n = "",
					o = "";
				switch (r) {
					case 0:
						n = "\u8bf7\u9009\u62e9\u7701", o = c.provDef, c.provDef = "";
						break;
					case 1:
						n = "\u8bf7\u9009\u62e9\u5e02", o = c.cityDef, c.cityDef = "";
						break;
					case 2:
						n = "\u8bf7\u9009\u62e9\u53bf/\u533a", o = c.districtDef, c.districtDef = ""
				}
				e.each(i, function(e) {
					var a = this,
						r = a[c.valueProperty];
					text = a[c.textProperty], t[0].options[e + 1] = new Option(text, r)
				}), o && (t.val(o), t.trigger("change")), c.dataCallback.call(t, t, i)
			}
		},
		setStorageCache: function(e, a, t) {
			if (window.localStorage && e)
				if (0 == a) localStorage.setItem("area-provinceData", JSON.stringify(e));
				else if (1 == a) {
				var r = localStorage.getItem("area-cityData"),
					i = r && JSON.parse(r) || {};
				i[t] = e, localStorage.setItem("area-cityData", JSON.stringify(i))
			} else if (2 == a) {
				var c = localStorage.getItem("area-areaData"),
					n = c && JSON.parse(c) || {};
				n[t] = e, localStorage.setItem("area-areaData", JSON.stringify(n))
			}
		},
		getStorageCache: function(e, a) {
			if (window.localStorage) {
				if (0 == e && localStorage.getItem("area-provinceData")) return JSON.parse(localStorage.getItem("area-provinceData"));
				if (1 == e && localStorage.getItem("area-cityData")) {
					var t = JSON.parse(localStorage.getItem("area-cityData"));
					return t[a]
				}
				if (2 == e && localStorage.getItem("area-areaData")) {
					var r = JSON.parse(localStorage.getItem("area-areaData"));
					return r[a]
				}
			}
			return ""
		},
		setUpdateCache: function() {
			var e = localStorage.getItem("areaVersion") || "0.0.0";
			e !== this.config.version && (localStorage.setItem("areaVersion", this.config.version), localStorage.removeItem("area-provinceData"), localStorage.removeItem("area-cityData"), localStorage.removeItem("area-areaData"))
		},
		changeSelect: function() {
			var a = this;
			wrap = this.wrap, a.resetSelect(wrap.find("select:eq(0)")), wrap.off("change").on("change", "select", function() {
				var t = e(this),
					r = t.next();
				return index = wrap.find("select").index(r), a.config.changeCallback && a.config.changeCallback.call(t), 0 == r.length ? !1 : (a.resetSelect(t), void a.createOptions(r, index, t.val()))
			})
		},
		resetSelect: function(a) {
			var t = a;
			t.nextAll("select").each(function(a) {
				e(this).find("option:gt(0)").remove()
			})
		}
	}), e.fn.citySelect = function(a) {
		a = e.extend({
			url: "",
			data: null,
			provDef: "",
			cityDef: "",
			districtDef: "",
			version: "1.0.0",
			paramName: "areaId",
			valueProperty: "id",
			textProperty: "areaName",
			callback: null,
			dataCallback: function() {},
			changeCallback: null,
			setParam: function() {}
		}, a || {});
		var t = this,
			r = new e.CitySelect(t, a);
		r.init()
	}
}(window.$);