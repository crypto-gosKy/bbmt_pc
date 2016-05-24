function $A(id) {
	return typeof id === 'string' ? document.getElementById(id) : id;
}

function $T(name, node) {
	return (node || document).getElementsByTagName(name);
}

function $N(name, node) {
	return (node || document).getElementsByName(name);
}

function addEvent(elem, event, func) {
	if (typeof(window.event) != 'undefined')
		elem.attachEvent('on' + event, func);
	else
		elem.addEventListener(event, func, false);
}

function Ajax(recvType) {
	var aj = new Object();
	aj.recvType = recvType ? recvType.toUpperCase() : 'HTML' //HTML XML
	aj.targetUrl = '';
	aj.sendString = '';
	aj.resultHandle = null;
	aj.createXMLHttpRequest = function() {
		var request = false;
		//window对象中有XMLHttpRequest存在就是非IE，包括（IE7，IE8）
		if (window.XMLHttpRequest) {
			request = new XMLHttpRequest();
			if (request.overrideMimeType) {
				request.overrideMimeType("text/xml");
			}
			//window对象中有ActiveXObject属性存在就是IE
		} else if (window.ActiveXObject) {
			var versions = ['Microsoft.XMLHTTP', 'MSXML.XMLHTTP', 'Msxml2.XMLHTTP.7.0', 'Msxml2.XMLHTTP.6.0', 'Msxml2.XMLHTTP.5.0', 'Msxml2.XMLHTTP.4.0', 'MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP'];
			for (var i = 0; i < versions.length; i++) {
				try {
					request = new ActiveXObject(versions[i]);
					if (request) {
						return request;
					}
				} catch (e) {
					request = false;
				}
			}
		}
		return request;
	}
	aj.XMLHttpRequest = aj.createXMLHttpRequest();
	aj.processHandle = function() {
		if (aj.XMLHttpRequest.readyState == 4) {
			if (aj.XMLHttpRequest.status == 200) {
				if (aj.recvType == "HTML")
					aj.resultHandle(aj.XMLHttpRequest.responseText);
				else if (aj.recvType == "XML")
					aj.resultHandle(aj.XMLHttpRequest.responseXML);
			}
		}
	}
	aj.get = function(targetUrl, resultHandle) {
		aj.targetUrl = targetUrl;
		if (resultHandle != null) {
			aj.XMLHttpRequest.onreadystatechange = aj.processHandle;
			aj.resultHandle = resultHandle;
		}
		if (window.XMLHttpRequest) {
			aj.XMLHttpRequest.open("get", aj.targetUrl);
			aj.XMLHttpRequest.send(null);
		} else {
			aj.XMLHttpRequest.open("get", aj.targetUrl, true);
			aj.XMLHttpRequest.send();
		}
	}
	aj.post = function(targetUrl, sendString, resultHandle) {
		aj.targetUrl = targetUrl;
		if (typeof(sendString) == "object") {
			var str = "";
			for (var pro in sendString) {
				str += pro + "=" + sendString[pro] + "&";
			}
			aj.sendString = str.substr(0, str.length - 1);
		} else {
			aj.sendString = sendString;
		}
		if (resultHandle != null) {
			aj.XMLHttpRequest.onreadystatechange = aj.processHandle;
			aj.resultHandle = resultHandle;
		}
		aj.XMLHttpRequest.open("post", targetUrl);
		aj.XMLHttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		aj.XMLHttpRequest.send(aj.sendString);
	}
	return aj;
}
var mapColors = {};
var html = '';
var instanceId = 0;
var loginCallback = null;
var json_province = [{
	"id": "310000",
	"name": "上海"
}, {
	"id": "320000",
	"name": "江苏"
}, {
	"id": "330000",
	"name": "浙江"
}, {
	"id": "340000",
	"name": "安徽"
}, {
	"id": "360000",
	"name": "江西"
}, {
	"id": "110000",
	"name": "北京"
}, {
	"id": "120000",
	"name": "天津"
}, {
	"id": "140000",
	"name": "山西"
}, {
	"id": "370000",
	"name": "山东"
}, {
	"id": "130000",
	"name": "河北"
}, {
	"id": "150000",
	"name": "内蒙古"
}, {
	"id": "430000",
	"name": "湖南"
}, {
	"id": "420000",
	"name": "湖北"
}, {
	"id": "410000",
	"name": "河南"
}, {
	"id": "440000",
	"name": "广东"
}, {
	"id": "450000",
	"name": "广西"
}, {
	"id": "350000",
	"name": "福建"
}, {
	"id": "460000",
	"name": "海南"
}, {
	"id": "210000",
	"name": "辽宁"
}, {
	"id": "220000",
	"name": "吉林"
}, {
	"id": "230000",
	"name": "黑龙江"
}, {
	"id": "610000",
	"name": "陕西"
}, {
	"id": "650000",
	"name": "新疆"
}, {
	"id": "620000",
	"name": "甘肃"
}, {
	"id": "640000",
	"name": "宁夏"
}, {
	"id": "630000",
	"name": "青海"
}, {
	"id": "500000",
	"name": "重庆"
}, {
	"id": "530000",
	"name": "云南"
}, {
	"id": "520000",
	"name": "贵州"
}, {
	"id": "540000",
	"name": "西藏"
}, {
	"id": "510000",
	"name": "四川"
}, {
	"id": "810000",
	"name": "香港"
}, {
	"id": "820000",
	"name": "澳门"
}, {
	"id": "710000",
	"name": "台湾"
}, {
	"id": "990000",
	"name": "海外"
}];
var json_city = {
	"110000": [{
		"id": "110100",
		"name": "北京"
	}],
	"120000": [{
		"id": "120100",
		"name": "天津"
	}],
	"130000": [{
		"id": "130100",
		"name": "石家庄"
	}, {
		"id": "130200",
		"name": "唐山"
	}, {
		"id": "130300",
		"name": "秦皇岛"
	}, {
		"id": "130400",
		"name": "邯郸"
	}, {
		"id": "130500",
		"name": "邢台"
	}, {
		"id": "130600",
		"name": "保定"
	}, {
		"id": "130700",
		"name": "张家口"
	}, {
		"id": "130800",
		"name": "承德"
	}, {
		"id": "130900",
		"name": "沧州"
	}, {
		"id": "131000",
		"name": "廊坊"
	}, {
		"id": "131100",
		"name": "衡水"
	}],
	"140000": [{
		"id": "140100",
		"name": "太原"
	}, {
		"id": "140200",
		"name": "大同"
	}, {
		"id": "140300",
		"name": "阳泉"
	}, {
		"id": "140400",
		"name": "长治"
	}, {
		"id": "140500",
		"name": "晋城"
	}, {
		"id": "140600",
		"name": "朔州"
	}, {
		"id": "140700",
		"name": "晋中"
	}, {
		"id": "140800",
		"name": "运城"
	}, {
		"id": "140900",
		"name": "忻州"
	}, {
		"id": "141000",
		"name": "临汾"
	}, {
		"id": "141100",
		"name": "吕梁"
	}],
	"150000": [{
		"id": "150100",
		"name": "呼和浩特"
	}, {
		"id": "150200",
		"name": "包头"
	}, {
		"id": "150300",
		"name": "乌海"
	}, {
		"id": "150400",
		"name": "赤峰"
	}, {
		"id": "150500",
		"name": "通辽"
	}, {
		"id": "150600",
		"name": "鄂尔多斯"
	}, {
		"id": "150700",
		"name": "呼伦贝尔"
	}, {
		"id": "150800",
		"name": "巴彦淖尔"
	}, {
		"id": "150900",
		"name": "乌兰察布"
	}, {
		"id": "152200",
		"name": "兴安"
	}, {
		"id": "152500",
		"name": "锡林郭勒"
	}, {
		"id": "152900",
		"name": "阿拉善"
	}],
	"210000": [{
		"id": "210100",
		"name": "沈阳"
	}, {
		"id": "210200",
		"name": "大连"
	}, {
		"id": "210300",
		"name": "鞍山"
	}, {
		"id": "210400",
		"name": "抚顺"
	}, {
		"id": "210500",
		"name": "本溪"
	}, {
		"id": "210600",
		"name": "丹东"
	}, {
		"id": "210700",
		"name": "锦州"
	}, {
		"id": "210800",
		"name": "营口"
	}, {
		"id": "210900",
		"name": "阜新"
	}, {
		"id": "211000",
		"name": "辽阳"
	}, {
		"id": "211100",
		"name": "盘锦"
	}, {
		"id": "211200",
		"name": "铁岭"
	}, {
		"id": "211300",
		"name": "朝阳"
	}, {
		"id": "211400",
		"name": "葫芦岛"
	}],
	"220000": [{
		"id": "220100",
		"name": "长春"
	}, {
		"id": "220200",
		"name": "吉林"
	}, {
		"id": "220300",
		"name": "四平"
	}, {
		"id": "220400",
		"name": "辽源"
	}, {
		"id": "220500",
		"name": "通化"
	}, {
		"id": "220600",
		"name": "白山"
	}, {
		"id": "220700",
		"name": "松原"
	}, {
		"id": "220800",
		"name": "白城"
	}, {
		"id": "222400",
		"name": "延边朝鲜族"
	}],
	"230000": [{
		"id": "230100",
		"name": "哈尔滨"
	}, {
		"id": "230200",
		"name": "齐齐哈尔"
	}, {
		"id": "230300",
		"name": "鸡西"
	}, {
		"id": "230400",
		"name": "鹤岗"
	}, {
		"id": "230500",
		"name": "双鸭山"
	}, {
		"id": "230600",
		"name": "大庆"
	}, {
		"id": "230700",
		"name": "伊春"
	}, {
		"id": "230800",
		"name": "佳木斯"
	}, {
		"id": "230900",
		"name": "七台河"
	}, {
		"id": "231000",
		"name": "牡丹江"
	}, {
		"id": "231100",
		"name": "黑河"
	}, {
		"id": "231200",
		"name": "绥化"
	}, {
		"id": "232700",
		"name": "大兴安岭"
	}],
	"310000": [{
		"id": "310100",
		"name": "上海"
	}],
	"320000": [{
		"id": "320100",
		"name": "南京"
	}, {
		"id": "320200",
		"name": "无锡"
	}, {
		"id": "320300",
		"name": "徐州"
	}, {
		"id": "320400",
		"name": "常州"
	}, {
		"id": "320500",
		"name": "苏州"
	}, {
		"id": "320600",
		"name": "南通"
	}, {
		"id": "320700",
		"name": "连云港"
	}, {
		"id": "320800",
		"name": "淮安"
	}, {
		"id": "320900",
		"name": "盐城"
	}, {
		"id": "321000",
		"name": "扬州"
	}, {
		"id": "321100",
		"name": "镇江"
	}, {
		"id": "321200",
		"name": "泰州"
	}, {
		"id": "321300",
		"name": "宿迁"
	}],
	"330000": [{
		"id": "330100",
		"name": "杭州"
	}, {
		"id": "330200",
		"name": "宁波"
	}, {
		"id": "330300",
		"name": "温州"
	}, {
		"id": "330400",
		"name": "嘉兴"
	}, {
		"id": "330500",
		"name": "湖州"
	}, {
		"id": "330600",
		"name": "绍兴"
	}, {
		"id": "330700",
		"name": "金华"
	}, {
		"id": "330800",
		"name": "衢州"
	}, {
		"id": "330900",
		"name": "舟山"
	}, {
		"id": "331000",
		"name": "台州"
	}, {
		"id": "331100",
		"name": "丽水"
	}],
	"340000": [{
		"id": "340100",
		"name": "合肥"
	}, {
		"id": "340200",
		"name": "芜湖"
	}, {
		"id": "340300",
		"name": "蚌埠"
	}, {
		"id": "340400",
		"name": "淮南"
	}, {
		"id": "340500",
		"name": "马鞍山"
	}, {
		"id": "340600",
		"name": "淮北"
	}, {
		"id": "340700",
		"name": "铜陵"
	}, {
		"id": "340800",
		"name": "安庆"
	}, {
		"id": "341000",
		"name": "黄山"
	}, {
		"id": "341100",
		"name": "滁州"
	}, {
		"id": "341200",
		"name": "阜阳"
	}, {
		"id": "341300",
		"name": "宿州"
	}, {
		"id": "341500",
		"name": "六安"
	}, {
		"id": "341600",
		"name": "亳州"
	}, {
		"id": "341700",
		"name": "池州"
	}, {
		"id": "341800",
		"name": "宣城"
	}],
	"350000": [{
		"id": "350100",
		"name": "福州"
	}, {
		"id": "350200",
		"name": "厦门"
	}, {
		"id": "350300",
		"name": "莆田"
	}, {
		"id": "350400",
		"name": "三明"
	}, {
		"id": "350500",
		"name": "泉州"
	}, {
		"id": "350600",
		"name": "漳州"
	}, {
		"id": "350700",
		"name": "南平"
	}, {
		"id": "350800",
		"name": "龙岩"
	}, {
		"id": "350900",
		"name": "宁德"
	}],
	"360000": [{
		"id": "360100",
		"name": "南昌"
	}, {
		"id": "360200",
		"name": "景德镇"
	}, {
		"id": "360300",
		"name": "萍乡"
	}, {
		"id": "360400",
		"name": "九江"
	}, {
		"id": "360500",
		"name": "新余"
	}, {
		"id": "360600",
		"name": "鹰潭"
	}, {
		"id": "360700",
		"name": "赣州"
	}, {
		"id": "360800",
		"name": "吉安"
	}, {
		"id": "360900",
		"name": "宜春"
	}, {
		"id": "361000",
		"name": "抚州"
	}, {
		"id": "361100",
		"name": "上饶"
	}],
	"370000": [{
		"id": "370100",
		"name": "济南"
	}, {
		"id": "370200",
		"name": "青岛"
	}, {
		"id": "370300",
		"name": "淄博"
	}, {
		"id": "370400",
		"name": "枣庄"
	}, {
		"id": "370500",
		"name": "东营"
	}, {
		"id": "370600",
		"name": "烟台"
	}, {
		"id": "370700",
		"name": "潍坊"
	}, {
		"id": "370800",
		"name": "济宁"
	}, {
		"id": "370900",
		"name": "泰安"
	}, {
		"id": "371000",
		"name": "威海"
	}, {
		"id": "371100",
		"name": "日照"
	}, {
		"id": "371200",
		"name": "莱芜"
	}, {
		"id": "371300",
		"name": "临沂"
	}, {
		"id": "371400",
		"name": "德州"
	}, {
		"id": "371500",
		"name": "聊城"
	}, {
		"id": "371600",
		"name": "滨州"
	}, {
		"id": "371700",
		"name": "菏泽"
	}],
	"410000": [{
		"id": "410100",
		"name": "郑州"
	}, {
		"id": "410200",
		"name": "开封"
	}, {
		"id": "410300",
		"name": "洛阳"
	}, {
		"id": "410400",
		"name": "平顶山"
	}, {
		"id": "410500",
		"name": "安阳"
	}, {
		"id": "410600",
		"name": "鹤壁"
	}, {
		"id": "410700",
		"name": "新乡"
	}, {
		"id": "410800",
		"name": "焦作"
	}, {
		"id": "410881",
		"name": "济源"
	}, {
		"id": "410900",
		"name": "濮阳"
	}, {
		"id": "411000",
		"name": "许昌"
	}, {
		"id": "411100",
		"name": "漯河"
	}, {
		"id": "411200",
		"name": "三门峡"
	}, {
		"id": "411300",
		"name": "南阳"
	}, {
		"id": "411400",
		"name": "商丘"
	}, {
		"id": "411500",
		"name": "信阳"
	}, {
		"id": "411600",
		"name": "周口"
	}, {
		"id": "411700",
		"name": "驻马店"
	}],
	"420000": [{
		"id": "420100",
		"name": "武汉"
	}, {
		"id": "420200",
		"name": "黄石"
	}, {
		"id": "420300",
		"name": "十堰"
	}, {
		"id": "420500",
		"name": "宜昌"
	}, {
		"id": "420600",
		"name": "襄阳"
	}, {
		"id": "420700",
		"name": "鄂州"
	}, {
		"id": "420800",
		"name": "荆门"
	}, {
		"id": "420900",
		"name": "孝感"
	}, {
		"id": "421000",
		"name": "荆州"
	}, {
		"id": "421100",
		"name": "黄冈"
	}, {
		"id": "421200",
		"name": "咸宁"
	}, {
		"id": "421300",
		"name": "随州"
	}, {
		"id": "422800",
		"name": "恩施"
	}, {
		"id": "429004",
		"name": "仙桃"
	}, {
		"id": "429005",
		"name": "潜江"
	}, {
		"id": "429006",
		"name": "天门"
	}, {
		"id": "429021",
		"name": "神农架"
	}],
	"430000": [{
		"id": "430100",
		"name": "长沙"
	}, {
		"id": "430200",
		"name": "株洲"
	}, {
		"id": "430300",
		"name": "湘潭"
	}, {
		"id": "430400",
		"name": "衡阳"
	}, {
		"id": "430500",
		"name": "邵阳"
	}, {
		"id": "430600",
		"name": "岳阳"
	}, {
		"id": "430700",
		"name": "常德"
	}, {
		"id": "430800",
		"name": "张家界"
	}, {
		"id": "430900",
		"name": "益阳"
	}, {
		"id": "431000",
		"name": "郴州"
	}, {
		"id": "431100",
		"name": "永州"
	}, {
		"id": "431200",
		"name": "怀化"
	}, {
		"id": "431300",
		"name": "娄底"
	}, {
		"id": "433100",
		"name": "湘西"
	}],
	"440000": [{
		"id": "440100",
		"name": "广州"
	}, {
		"id": "440200",
		"name": "韶关"
	}, {
		"id": "440300",
		"name": "深圳"
	}, {
		"id": "440400",
		"name": "珠海"
	}, {
		"id": "440500",
		"name": "汕头"
	}, {
		"id": "440600",
		"name": "佛山"
	}, {
		"id": "440700",
		"name": "江门"
	}, {
		"id": "440800",
		"name": "湛江"
	}, {
		"id": "440900",
		"name": "茂名"
	}, {
		"id": "441200",
		"name": "肇庆"
	}, {
		"id": "441300",
		"name": "惠州"
	}, {
		"id": "441400",
		"name": "梅州"
	}, {
		"id": "441500",
		"name": "汕尾"
	}, {
		"id": "441600",
		"name": "河源"
	}, {
		"id": "441700",
		"name": "阳江"
	}, {
		"id": "441800",
		"name": "清远"
	}, {
		"id": "441900",
		"name": "东莞"
	}, {
		"id": "442000",
		"name": "中山"
	}, {
		"id": "442101",
		"name": "东沙"
	}, {
		"id": "445100",
		"name": "潮州"
	}, {
		"id": "445200",
		"name": "揭阳"
	}, {
		"id": "445300",
		"name": "云浮"
	}],
	"450000": [{
		"id": "450100",
		"name": "南宁"
	}, {
		"id": "450200",
		"name": "柳州"
	}, {
		"id": "450300",
		"name": "桂林"
	}, {
		"id": "450400",
		"name": "梧州"
	}, {
		"id": "450500",
		"name": "北海"
	}, {
		"id": "450600",
		"name": "防城港"
	}, {
		"id": "450700",
		"name": "钦州"
	}, {
		"id": "450800",
		"name": "贵港"
	}, {
		"id": "450900",
		"name": "玉林"
	}, {
		"id": "451000",
		"name": "百色"
	}, {
		"id": "451100",
		"name": "贺州"
	}, {
		"id": "451200",
		"name": "河池"
	}, {
		"id": "451300",
		"name": "来宾"
	}, {
		"id": "451400",
		"name": "崇左"
	}],
	"460000": [{
		"id": "460100",
		"name": "海口"
	}, {
		"id": "460200",
		"name": "三亚"
	}, {
		"id": "460300",
		"name": "三沙"
	}, {
		"id": "469001",
		"name": "五指山"
	}, {
		"id": "469002",
		"name": "琼海"
	}, {
		"id": "469003",
		"name": "儋州"
	}, {
		"id": "469005",
		"name": "文昌"
	}, {
		"id": "469006",
		"name": "万宁"
	}, {
		"id": "469007",
		"name": "东方"
	}, {
		"id": "469025",
		"name": "定安"
	}, {
		"id": "469026",
		"name": "屯昌"
	}, {
		"id": "469027",
		"name": "澄迈"
	}, {
		"id": "469028",
		"name": "临高"
	}, {
		"id": "469030",
		"name": "白沙"
	}, {
		"id": "469031",
		"name": "昌江"
	}, {
		"id": "469033",
		"name": "乐东"
	}, {
		"id": "469034",
		"name": "陵水"
	}, {
		"id": "469035",
		"name": "保亭"
	}, {
		"id": "469036",
		"name": "琼中"
	}, {
		"id": "469037",
		"name": "西沙"
	}, {
		"id": "469038",
		"name": "南沙"
	}, {
		"id": "469039",
		"name": "中沙"
	}],
	"500000": [{
		"id": "500100",
		"name": "重庆"
	}],
	"510000": [{
		"id": "510100",
		"name": "成都"
	}, {
		"id": "510300",
		"name": "自贡"
	}, {
		"id": "510400",
		"name": "攀枝花"
	}, {
		"id": "510500",
		"name": "泸州"
	}, {
		"id": "510600",
		"name": "德阳"
	}, {
		"id": "510700",
		"name": "绵阳"
	}, {
		"id": "510800",
		"name": "广元"
	}, {
		"id": "510900",
		"name": "遂宁"
	}, {
		"id": "511000",
		"name": "内江"
	}, {
		"id": "511100",
		"name": "乐山"
	}, {
		"id": "511300",
		"name": "南充"
	}, {
		"id": "511400",
		"name": "眉山"
	}, {
		"id": "511500",
		"name": "宜宾"
	}, {
		"id": "511600",
		"name": "广安"
	}, {
		"id": "511700",
		"name": "达州"
	}, {
		"id": "511800",
		"name": "雅安"
	}, {
		"id": "511900",
		"name": "巴中"
	}, {
		"id": "512000",
		"name": "资阳"
	}, {
		"id": "513200",
		"name": "阿坝"
	}, {
		"id": "513300",
		"name": "甘孜"
	}, {
		"id": "513400",
		"name": "凉山"
	}],
	"520000": [{
		"id": "520100",
		"name": "贵阳"
	}, {
		"id": "520200",
		"name": "六盘水"
	}, {
		"id": "520300",
		"name": "遵义"
	}, {
		"id": "520400",
		"name": "安顺"
	}, {
		"id": "522200",
		"name": "铜仁"
	}, {
		"id": "522300",
		"name": "黔西南"
	}, {
		"id": "522400",
		"name": "毕节"
	}, {
		"id": "522600",
		"name": "黔东南"
	}, {
		"id": "522700",
		"name": "黔南"
	}],
	"530000": [{
		"id": "530100",
		"name": "昆明"
	}, {
		"id": "530300",
		"name": "曲靖"
	}, {
		"id": "530400",
		"name": "玉溪"
	}, {
		"id": "530500",
		"name": "保山"
	}, {
		"id": "530600",
		"name": "昭通"
	}, {
		"id": "530700",
		"name": "丽江"
	}, {
		"id": "530800",
		"name": "普洱"
	}, {
		"id": "530900",
		"name": "临沧"
	}, {
		"id": "532300",
		"name": "楚雄"
	}, {
		"id": "532500",
		"name": "红河"
	}, {
		"id": "532600",
		"name": "文山"
	}, {
		"id": "532800",
		"name": "西双版纳"
	}, {
		"id": "532900",
		"name": "大理"
	}, {
		"id": "533100",
		"name": "德宏"
	}, {
		"id": "533300",
		"name": "怒江"
	}, {
		"id": "533400",
		"name": "迪庆"
	}],
	"540000": [{
		"id": "540100",
		"name": "拉萨"
	}, {
		"id": "542100",
		"name": "昌都"
	}, {
		"id": "542200",
		"name": "山南"
	}, {
		"id": "542300",
		"name": "日喀则"
	}, {
		"id": "542400",
		"name": "那曲"
	}, {
		"id": "542500",
		"name": "阿里"
	}, {
		"id": "542600",
		"name": "林芝"
	}],
	"610000": [{
		"id": "610100",
		"name": "西安"
	}, {
		"id": "610200",
		"name": "铜川"
	}, {
		"id": "610300",
		"name": "宝鸡"
	}, {
		"id": "610400",
		"name": "咸阳"
	}, {
		"id": "610500",
		"name": "渭南"
	}, {
		"id": "610600",
		"name": "延安"
	}, {
		"id": "610700",
		"name": "汉中"
	}, {
		"id": "610800",
		"name": "榆林"
	}, {
		"id": "610900",
		"name": "安康"
	}, {
		"id": "611000",
		"name": "商洛"
	}],
	"620000": [{
		"id": "620100",
		"name": "兰州"
	}, {
		"id": "620200",
		"name": "嘉峪关"
	}, {
		"id": "620300",
		"name": "金昌"
	}, {
		"id": "620400",
		"name": "白银"
	}, {
		"id": "620500",
		"name": "天水"
	}, {
		"id": "620600",
		"name": "武威"
	}, {
		"id": "620700",
		"name": "张掖"
	}, {
		"id": "620800",
		"name": "平凉"
	}, {
		"id": "620900",
		"name": "酒泉"
	}, {
		"id": "621000",
		"name": "庆阳"
	}, {
		"id": "621100",
		"name": "定西"
	}, {
		"id": "621200",
		"name": "陇南"
	}, {
		"id": "622900",
		"name": "临夏"
	}, {
		"id": "623000",
		"name": "甘南"
	}],
	"630000": [{
		"id": "630100",
		"name": "西宁"
	}, {
		"id": "632100",
		"name": "海东"
	}, {
		"id": "632200",
		"name": "海北"
	}, {
		"id": "632300",
		"name": "黄南"
	}, {
		"id": "632500",
		"name": "海南藏族"
	}, {
		"id": "632600",
		"name": "果洛"
	}, {
		"id": "632700",
		"name": "玉树"
	}, {
		"id": "632800",
		"name": "海西"
	}],
	"640000": [{
		"id": "640100",
		"name": "银川"
	}, {
		"id": "640200",
		"name": "石嘴山"
	}, {
		"id": "640300",
		"name": "吴忠"
	}, {
		"id": "640400",
		"name": "固原"
	}, {
		"id": "640500",
		"name": "中卫"
	}],
	"650000": [{
		"id": "650100",
		"name": "乌鲁木齐"
	}, {
		"id": "650200",
		"name": "克拉玛依"
	}, {
		"id": "652100",
		"name": "吐鲁番"
	}, {
		"id": "652200",
		"name": "哈密"
	}, {
		"id": "652300",
		"name": "昌吉"
	}, {
		"id": "652700",
		"name": "博尔塔拉"
	}, {
		"id": "652800",
		"name": "巴音郭楞"
	}, {
		"id": "652900",
		"name": "阿克苏"
	}, {
		"id": "653000",
		"name": "克孜勒苏柯尔克孜"
	}, {
		"id": "653100",
		"name": "喀什"
	}, {
		"id": "653200",
		"name": "和田"
	}, {
		"id": "654000",
		"name": "伊犁"
	}, {
		"id": "654200",
		"name": "塔城"
	}, {
		"id": "654300",
		"name": "阿勒泰"
	}, {
		"id": "659001",
		"name": "石河子"
	}, {
		"id": "659002",
		"name": "阿拉尔"
	}, {
		"id": "659003",
		"name": "图木舒克"
	}, {
		"id": "659004",
		"name": "五家渠"
	}],
	"710000": [{
		"id": "710100",
		"name": "台北"
	}, {
		"id": "710200",
		"name": "高雄"
	}, {
		"id": "710300",
		"name": "台南"
	}, {
		"id": "710400",
		"name": "台中"
	}, {
		"id": "710500",
		"name": "金门"
	}, {
		"id": "710600",
		"name": "南投"
	}, {
		"id": "710700",
		"name": "基隆"
	}, {
		"id": "710800",
		"name": "新竹"
	}, {
		"id": "710900",
		"name": "嘉义"
	}, {
		"id": "711100",
		"name": "新北"
	}, {
		"id": "711200",
		"name": "宜兰"
	}, {
		"id": "711300",
		"name": "新竹"
	}, {
		"id": "711400",
		"name": "桃园"
	}, {
		"id": "711500",
		"name": "苗栗"
	}, {
		"id": "711700",
		"name": "彰化"
	}, {
		"id": "711900",
		"name": "嘉义"
	}, {
		"id": "712100",
		"name": "云林"
	}, {
		"id": "712400",
		"name": "屏东"
	}, {
		"id": "712500",
		"name": "台东"
	}, {
		"id": "712600",
		"name": "花莲"
	}, {
		"id": "712700",
		"name": "澎湖"
	}, {
		"id": "712800",
		"name": "连江"
	}],
	"810000": [{
		"id": "810100",
		"name": "香港岛"
	}, {
		"id": "810200",
		"name": "九龙"
	}, {
		"id": "810300",
		"name": "新界"
	}],
	"820000": [{
		"id": "820100",
		"name": "澳门半岛"
	}, {
		"id": "820200",
		"name": "离岛"
	}],
	"990000": [{
		"id": "990100",
		"name": "海外"
	}]
};
var selected_p = "";
var selected_c = "";
var stockCount = 1;
var dkr_prices = 1;
var color_imgs = 1;
var price;
//收藏商品
//隐藏错误提示
//			function hide_border() {
//				$("Prop").className = "Goodpromotion";
//				
//			}
function initProvince() {
	var html = "";
	$A("LK_AddressAllTitle_Province").innerHTML = "请选择<s></s>";
	$A("LK_AddressAllTitle_Province").className = "address-all-title address-all-title-selected";
	$A("LK_AddressAllTitle_city").innerHTML = "请选择<s></s>";
	$A("LK_AddressAllTitle_city").className = "address-all-title";
	$A("LK_AddressAllTitle_city").style.display = "none";
	for (var i = 0; i < json_province.length; i++) {
		html += '<li class="wl-list-item" data-id="' + json_province[i].id + '" data-title="' + json_province[i].name + '" onclick="selectProvince(this)">' + json_province[i].name + '</li>';
	}
	$A("wl-list-add-con").innerHTML = html;
}

function initCity(p_id) {
	var html = "";
	for (var i = 0; i < json_city[p_id].length; i++) {
		html += '<li class="wl-list-item" data-id="' + json_city[p_id][i].id + '" data-title="' + json_city[p_id][i].name + '" onclick="selectCity(this)">' + json_city[p_id][i].name + '</li>';
	}
	$A("wl-list-add-con").innerHTML = html;
}
// 选择省份
function selectProvince(node) {
	var province_id = node.getAttribute("data-id");
	var province_title = node.getAttribute("data-title");
	if (json_city[province_id] != undefined) {
		$A("LK_AddressAllTitle_Province").innerHTML = province_title + "<s></s>";
		$A("LK_AddressAllTitle_Province").className = "address-all-title";
		$A("LK_AddressAllTitle_city").className = "address-all-title address-all-title-selected";
		$A("LK_AddressAllTitle_city").style.display = "block";
	}
	$A("wl-list-add-con").innerHTML = "";
	selected_p = province_title;
	initCity(province_id);
}
// 选择城市
function selectCity(node) {
	var city_name = node.getAttribute("data-title");
	var lis = $T("li", node.parentNode);  
	for (var i = 0; i < lis.length; i++) {
		lis[i].className = "wl-list-item";
	}
	node.className = "wl-list-item  wl-list-add-active";
	$A("LK_AddressAllTitle_city").innerHTML = city_name + "<s></s>";
	selected_c = city_name;
	$A("to-address").innerHTML = selected_p + selected_c + '<s></s>';
	get_transport_costs(city_name);
	close_city_select_dialog();
}
//获取运费信息
function get_transport_costs(city) {
	var ajax = Ajax();
	var item_id = $A('buyBtn').getAttribute("data-itemid");
	ajax.post("/index.php/Goods/ajax_logistics_fee", {
		item_id: item_id,
		send_city: city
	}, function(data) {

		var data = JSON.parse(data);

		if (data.status == true) {
			var data = data.data;
			if (parseInt(data.logistics_fee) == 0) {

				//				var obj = eval("(" + data + ")");
				$A("wl-money").innerHTML = "商家包邮 ";
			}
			if (!parseInt(data.logistics_fee) == 0) {

				//				var obj = eval("(" + data + ")");
				$A("wl-money").innerHTML = data.logistics_fee + "元";
			}

		}
		if (data.status == false) {
			alert(data.msg);
		}
	});
}

function popup_city_select_dialog(node) {
	node.className = "to-address wl-info-active";
	$A('popup-city-select').style.display = 'block';
}

function close_city_select_dialog() {
	$A('popup-city-select').style.display = 'none';
	$A('to-address').className = 'to-address';
}
// 初始化规格和颜色
//无需等onload加载完
//初始化省份信息
initProvince();