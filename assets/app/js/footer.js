var gaEventQueue = gaEventQueue || {};
!function($) {
	function sendNext() {
		gaTimer = !1, "undefined" != typeof ga && 0 != gaEventQueue.hitsToSend.length && (gaTokens > 0 ? (gaTokens--, ga.apply(window, gaEventQueue.hitsToSend.shift()), sendNext()) : gaTimer = setTimeout(sendNext, 1e3))
	}
	var gaTokens = 20,
		gaTimer = !1;
	gaEventQueue.hitsToSend = [], setInterval(function() {
		gaTokens = Math.max(20, gaTokens + 2)
	}, 2e3), gaEventQueue.track = function() {
		var args = Array.prototype.slice.call(arguments);
		args.unshift("send", "event"), gaEventQueue.hitsToSend.push(args), sendNext()
	}, $(document).ready(function() {
		sendNext()
	})
}("undefined" != typeof jQuery ? jQuery : Zepto);
var libFuncName = null;
if ("undefined" == typeof jQuery && "undefined" == typeof Zepto && "function" == typeof $) libFuncName = $;
else if ("function" == typeof jQuery) libFuncName = jQuery;
else {
	if ("function" != typeof Zepto) throw new TypeError;
	libFuncName = Zepto
}
$(function() {
	
}),
function($, window, document, undefined) {
	"use strict";
	window.Foundation = {
		name: "Foundation",
		version: "4.2.2",
		cache: {},
		init: function(scope, libraries, method, options, response, nc) {
			var library_arr, args = [scope, method, options, response],
				responses = [];
			if ((nc = nc || !1) && (this.nc = nc), this.rtl = /rtl/i.test($("html").attr("dir")), this.scope = scope || this.scope, libraries && "string" == typeof libraries && !/reflow/i.test(libraries)) {
				if (/off/i.test(libraries)) return this.off();
				if ((library_arr = libraries.split(" ")).length > 0)
					for (var i = library_arr.length - 1; i >= 0; i--) responses.push(this.init_lib(library_arr[i], args))
			} else {
				/reflow/i.test(libraries) && (args[1] = "reflow");
				for (var lib in this.libs) responses.push(this.init_lib(lib, args))
			}
			return "function" == typeof libraries && args.unshift(libraries), this.response_obj(responses, args)
		},
		response_obj: function(response_arr, args) {
			for (var i = 0, len = args.length; i < len; i++)
				if ("function" == typeof args[i]) return args[i]({
					errors: response_arr.filter(function(s) {
						if ("string" == typeof s) return s
					})
				});
			return response_arr
		},
		init_lib: function(lib, args) {
			return this.trap(function() {
				return this.libs.hasOwnProperty(lib) ? (this.patch(this.libs[lib]), this.libs[lib].init.apply(this.libs[lib], args)) : function() {}
			}.bind(this), lib)
		},
		trap: function(fun, lib) {
			if (!this.nc) try {
				return fun()
			} catch (e) {
				return this.error({
					name: lib,
					message: "could not be initialized",
					more: e.name + " " + e.message
				})
			}
			return fun()
		},
		patch: function(lib) {
			this.fix_outer(lib), lib.scope = this.scope, lib.rtl = this.rtl
		},
		inherit: function(scope, methods) {
			for (var methods_arr = methods.split(" "), i = methods_arr.length - 1; i >= 0; i--) this.lib_methods.hasOwnProperty(methods_arr[i]) && (this.libs[scope.name][methods_arr[i]] = this.lib_methods[methods_arr[i]])
		},
		random_str: function(length) {
			var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz".split("");
			length || (length = Math.floor(Math.random() * chars.length));
			for (var str = "", i = 0; i < length; i++) str += chars[Math.floor(Math.random() * chars.length)];
			return str
		},
		libs: {},
		lib_methods: {
			set_data: function(node, data) {
				var id = [this.name, +new Date, Foundation.random_str(5)].join("-");
				return Foundation.cache[id] = data, node.attr("data-" + this.name + "-id", id), data
			},
			get_data: function(node) {
				return Foundation.cache[node.attr("data-" + this.name + "-id")]
			},
			remove_data: function(node) {
				node ? (delete Foundation.cache[node.attr("data-" + this.name + "-id")], node.attr("data-" + this.name + "-id", "")) : $("[data-" + this.name + "-id]").each(function() {
					delete Foundation.cache[$(this).attr("data-" + this.name + "-id")], $(this).attr("data-" + this.name + "-id", "")
				})
			},
			throttle: function(fun, delay) {
				var timer = null;
				return function() {
					var context = this,
						args = arguments;
					clearTimeout(timer), timer = setTimeout(function() {
						fun.apply(context, args)
					}, delay)
				}
			},
			data_options: function(el) {
				function trim(str) {
					return "string" == typeof str ? $.trim(str) : str
				}
				var ii, p, opts = {},
					opts_arr = (el.attr("data-options") || ":").split(";");
				for (ii = opts_arr.length - 1; ii >= 0; ii--) p = opts_arr[ii].split(":"), /true/i.test(p[1]) && (p[1] = !0), /false/i.test(p[1]) && (p[1] = !1),
					function(o) {
						return !isNaN(o - 0) && null !== o && "" !== o && !1 !== o && !0 !== o
					}(p[1]) && (p[1] = parseInt(p[1], 10)), 2 === p.length && p[0].length > 0 && (opts[trim(p[0])] = trim(p[1]));
				return opts
			},
			delay: function(fun, delay) {
				return setTimeout(fun, delay)
			},
			scrollTo: function(el, to, duration) {
				if (!(duration < 0)) {
					var perTick = (to - $(window).scrollTop()) / duration * 10;
					this.scrollToTimerCache = setTimeout(function() {
						isNaN(parseInt(perTick, 10)) || (window.scrollTo(0, $(window).scrollTop() + perTick), this.scrollTo(el, to, duration - 10))
					}.bind(this), 10)
				}
			},
			scrollLeft: function(el) {
				if (el.length) return "scrollLeft" in el[0] ? el[0].scrollLeft : el[0].pageXOffset
			},
			empty: function(obj) {
				if (obj.length && obj.length > 0) return !1;
				if (obj.length && 0 === obj.length) return !0;
				for (var key in obj)
					if (hasOwnProperty.call(obj, key)) return !1;
				return !0
			}
		},
		fix_outer: function(lib) {
			lib.outerHeight = function(el, bool) {
				return "function" == typeof Zepto ? el.height() : void 0 !== bool ? el.outerHeight(bool) : el.outerHeight()
			}, lib.outerWidth = function(el) {
				return "function" == typeof Zepto ? el.width() : "undefined" != typeof bool ? el.outerWidth(bool) : el.outerWidth()
			}
		},
		error: function(error) {
			return error.name + " " + error.message + "; " + error.more
		},
		off: function() {
			return $(this.scope).off(".fndtn"), $(window).off(".fndtn"), !0
		},
		zj: "undefined" != typeof Zepto ? Zepto : jQuery
	}, $.fn.foundation = function() {
		var args = Array.prototype.slice.call(arguments, 0);
		return this.each(function() {
			return Foundation.init.apply(Foundation, [this].concat(args)), this
		})
	}
}(libFuncName, this, this.document),


function(window, $) {
	"use strict";
}(window, "undefined" != typeof jQuery ? jQuery : Zepto);

var sitepoint = sitepoint || {};
! function($) {
	function trackOrientation() {
		setTimeout(function() {
			var orientationStatus;
			orientationStatus = void 0 !== window.orientation ? 90 === Math.abs(window.orientation) ? "Landscape" : "Portrait" : window.innerHeight > window.innerWidth ? "Portrait" : "Landscape", gaEventQueue.track("Device", "Orientation", orientationStatus, {
				nonInteraction: !0
			})
		}, 1e3)
	}
	$(document).foundation(), $(document).ready(function() {
		sitepoint.imageSwapper = trackOrientation()
	}), sitepoint.timerChannelsNav = null, sitepoint.SidebarNav_toggle = function(e) {
		e.preventDefault();
		var $target = $("#SidebarNav"),isOpen = $target.hasClass("u-open");
		27 == e.keyCode && isOpen && $target.removeClass("u-open"), "click" === e.type || 13 == e.keyCode ? (window.clearTimeout(sitepoint.timerChannelsNav), isOpen ? $target.removeClass("u-open") : $target.addClass("u-open")) : 32 != e.keyCode || isOpen || $target.addClass("u-open")
	}
}("undefined" != typeof jQuery ? jQuery : Zepto),
! function($) {
	function trackOrientation() {
		setTimeout(function() {
			var orientationStatus;
			orientationStatus = void 0 !== window.orientation ? 90 === Math.abs(window.orientation) ? "Landscape" : "Portrait" : window.innerHeight > window.innerWidth ? "Portrait" : "Landscape", gaEventQueue.track("Device", "Orientation", orientationStatus, {
				nonInteraction: !0
			})
		}, 1e3)
	}
	$(document).foundation(), $(document).ready(function() {
		sitepoint.imageSwapper = trackOrientation()
	}), sitepoint.timerChannelsNav = null, sitepoint.SidebarFilter_toggle = function(e) {
		e.preventDefault();
		var $target = $("#SidebarFilter"),isOpen = $target.hasClass("u-open");
		27 == e.keyCode && isOpen && $target.removeClass("u-open"), "click" === e.type || 13 == e.keyCode ? (window.clearTimeout(sitepoint.timerChannelsNav), isOpen ? $target.removeClass("u-open") : $target.addClass("u-open")) : 32 != e.keyCode || isOpen || $target.addClass("u-open")
	}
}("undefined" != typeof jQuery ? jQuery : Zepto);