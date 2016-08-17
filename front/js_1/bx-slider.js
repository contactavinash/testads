function toJsonFormat(t) {
    return t = t.replace(/([a-zA-Z0-9]+?):/g, '"$1":'), t = t.replace(/:(?!true|false)([a-zA-Z]+)/g, ':"$1"'), t = t.replace(/'/g, '"')
}

function jsonify(t) {
    return t = toJsonFormat(t), jQuery.parseJSON(t)
}

function escapeHtml(t) {
    return String(t).replace(/[&<>"'\/]/g, function(t) {
        return htmlMap[t]
    })
}

function callBxSlider() {
    return $('[data-call="bxslider"]').each(function() {
        var t = $(this).attr("data-bxid");
        t ? bxSliders[t] = $(this).bxSlider() : $(this).bxSlider()
    }), "BxSlider initialised"
}

function callJUI() {
    return $('[data-call="jui-datepicker"]').each(function() {
        var t = $(this).attr("data-options");
        if (t) {
            var e = jsonify(t);
            $(this).datepicker(e)
        } else $(this).datepicker()
    }), $('[data-call="jui-slider"]').each(function() {
        var t = $(this).attr("data-options"),
            e = $(this).attr("data-target");
        if (t) {
            var i = jsonify(t);
            null == i.range && (i.range = "min"), e && (i.slide = function(t, i) {
                $(e).val(i.value)
            }), $(this).slider(i)
        }
    }), "jqueryUI initialised"
}

function toJsonFormat(t) {
    return t = t.replace(/([a-zA-Z0-9]+?):/g, '"$1":'), t = t.replace(/:(?!true|false)([a-zA-Z]+)/g, ':"$1"'), t = t.replace(/'/g, '"')
}

function jsonify(t) {
    return t = toJsonFormat(t), jQuery.parseJSON(t)
}

function escapeHtml(t) {
    return String(t).replace(/[&<>"'\/]/g, function(t) {
        return htmlMap[t]
    })
}

function changeView(t) {
    switch (t) {
        case "grid":
            $(".product-grid").removeClass("product-listview"), $(".product-grid > div").removeClass("reset-col");
            break;
        case "list":
            $(".product-grid").addClass("product-listview"), $(".product-grid > div").addClass("reset-col")
    }
}
if (function() {
        window.console || (window.console = {});
        for (var t = ["log", "info", "warn", "error", "debug", "trace", "dir", "group", "groupCollapsed", "groupEnd", "time", "timeEnd", "profile", "profileEnd", "dirxml", "assert", "count", "markTimeline", "timeStamp", "clear"], e = 0; e < t.length; e++) window.console[t[e]] || (window.console[t[e]] = function() {})
    }(), "undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery"); + function(t) {
    var e = t.fn.jquery.split(" ")[0].split(".");
    if (e[0] < 2 && e[1] < 9 || 1 == e[0] && 9 == e[1] && e[2] < 1) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")
}(jQuery), + function(t) {
    "use strict";

    function e() {
        var t = document.createElement("bootstrap"),
            e = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                transition: "transitionend"
            };
        for (var i in e)
            if (void 0 !== t.style[i]) return {
                end: e[i]
            };
        return !1
    }
    t.fn.emulateTransitionEnd = function(e) {
        var i = !1,
            n = this;
        t(this).one("bsTransitionEnd", function() {
            i = !0
        });
        var s = function() {
            i || t(n).trigger(t.support.transition.end)
        };
        return setTimeout(s, e), this
    }, t(function() {
        t.support.transition = e(), t.support.transition && (t.event.special.bsTransitionEnd = {
            bindType: t.support.transition.end,
            delegateType: t.support.transition.end,
            handle: function(e) {
                return t(e.target).is(this) ? e.handleObj.handler.apply(this, arguments) : void 0
            }
        })
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var i = t(this),
                s = i.data("bs.alert");
            s || i.data("bs.alert", s = new n(this)), "string" == typeof e && s[e].call(i)
        })
    }
    var i = '[data-dismiss="alert"]',
        n = function(e) {
            t(e).on("click", i, this.close)
        };
    n.VERSION = "3.3.1", n.TRANSITION_DURATION = 150, n.prototype.close = function(e) {
        function i() {
            o.detach().trigger("closed.bs.alert").remove()
        }
        var s = t(this),
            a = s.attr("data-target");
        a || (a = s.attr("href"), a = a && a.replace(/.*(?=#[^\s]*$)/, ""));
        var o = t(a);
        e && e.preventDefault(), o.length || (o = s.closest(".alert")), o.trigger(e = t.Event("close.bs.alert")), e.isDefaultPrevented() || (o.removeClass("in"), t.support.transition && o.hasClass("fade") ? o.one("bsTransitionEnd", i).emulateTransitionEnd(n.TRANSITION_DURATION) : i())
    };
    var s = t.fn.alert;
    t.fn.alert = e, t.fn.alert.Constructor = n, t.fn.alert.noConflict = function() {
        return t.fn.alert = s, this
    }, t(document).on("click.bs.alert.data-api", i, n.prototype.close)
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var n = t(this),
                s = n.data("bs.button"),
                a = "object" == typeof e && e;
            s || n.data("bs.button", s = new i(this, a)), "toggle" == e ? s.toggle() : e && s.setState(e)
        })
    }
    var i = function(e, n) {
        this.$element = t(e), this.options = t.extend({}, i.DEFAULTS, n), this.isLoading = !1
    };
    i.VERSION = "3.3.1", i.DEFAULTS = {
        loadingText: "loading..."
    }, i.prototype.setState = function(e) {
        var i = "disabled",
            n = this.$element,
            s = n.is("input") ? "val" : "html",
            a = n.data();
        e += "Text", null == a.resetText && n.data("resetText", n[s]()), setTimeout(t.proxy(function() {
            n[s](null == a[e] ? this.options[e] : a[e]), "loadingText" == e ? (this.isLoading = !0, n.addClass(i).attr(i, i)) : this.isLoading && (this.isLoading = !1, n.removeClass(i).removeAttr(i))
        }, this), 0)
    }, i.prototype.toggle = function() {
        var t = !0,
            e = this.$element.closest('[data-toggle="buttons"]');
        if (e.length) {
            var i = this.$element.find("input");
            "radio" == i.prop("type") && (i.prop("checked") && this.$element.hasClass("active") ? t = !1 : e.find(".active").removeClass("active")), t && i.prop("checked", !this.$element.hasClass("active")).trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active"));
        t && this.$element.toggleClass("active")
    };
    var n = t.fn.button;
    t.fn.button = e, t.fn.button.Constructor = i, t.fn.button.noConflict = function() {
        return t.fn.button = n, this
    }, t(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function(i) {
        var n = t(i.target);
        n.hasClass("btn") || (n = n.closest(".btn")), e.call(n, "toggle"), i.preventDefault()
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function(e) {
        t(e.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(e.type))
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var n = t(this),
                s = n.data("bs.carousel"),
                a = t.extend({}, i.DEFAULTS, n.data(), "object" == typeof e && e),
                o = "string" == typeof e ? e : a.slide;
            s || n.data("bs.carousel", s = new i(this, a)), "number" == typeof e ? s.to(e) : o ? s[o]() : a.interval && s.pause().cycle()
        })
    }
    var i = function(e, i) {
        this.$element = t(e), this.$indicators = this.$element.find(".carousel-indicators"), this.options = i, this.paused = this.sliding = this.interval = this.$active = this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", t.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", t.proxy(this.pause, this)).on("mouseleave.bs.carousel", t.proxy(this.cycle, this))
    };
    i.VERSION = "3.3.1", i.TRANSITION_DURATION = 600, i.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0,
        keyboard: !0
    }, i.prototype.keydown = function(t) {
        if (!/input|textarea/i.test(t.target.tagName)) {
            switch (t.which) {
                case 37:
                    this.prev();
                    break;
                case 39:
                    this.next();
                    break;
                default:
                    return
            }
            t.preventDefault()
        }
    }, i.prototype.cycle = function(e) {
        return e || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(t.proxy(this.next, this), this.options.interval)), this
    }, i.prototype.getItemIndex = function(t) {
        return this.$items = t.parent().children(".item"), this.$items.index(t || this.$active)
    }, i.prototype.getItemForDirection = function(t, e) {
        var i = "prev" == t ? -1 : 1,
            n = this.getItemIndex(e),
            s = (n + i) % this.$items.length;
        return this.$items.eq(s)
    }, i.prototype.to = function(t) {
        var e = this,
            i = this.getItemIndex(this.$active = this.$element.find(".item.active"));
        return t > this.$items.length - 1 || 0 > t ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function() {
            e.to(t)
        }) : i == t ? this.pause().cycle() : this.slide(t > i ? "next" : "prev", this.$items.eq(t))
    }, i.prototype.pause = function(e) {
        return e || (this.paused = !0), this.$element.find(".next, .prev").length && t.support.transition && (this.$element.trigger(t.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, i.prototype.next = function() {
        return this.sliding ? void 0 : this.slide("next")
    }, i.prototype.prev = function() {
        return this.sliding ? void 0 : this.slide("prev")
    }, i.prototype.slide = function(e, n) {
        var s = this.$element.find(".item.active"),
            a = n || this.getItemForDirection(e, s),
            o = this.interval,
            r = "next" == e ? "left" : "right",
            l = "next" == e ? "first" : "last",
            d = this;
        if (!a.length) {
            if (!this.options.wrap) return;
            a = this.$element.find(".item")[l]()
        }
        if (a.hasClass("active")) return this.sliding = !1;
        var c = a[0],
            h = t.Event("slide.bs.carousel", {
                relatedTarget: c,
                direction: r
            });
        if (this.$element.trigger(h), !h.isDefaultPrevented()) {
            if (this.sliding = !0, o && this.pause(), this.$indicators.length) {
                this.$indicators.find(".active").removeClass("active");
                var p = t(this.$indicators.children()[this.getItemIndex(a)]);
                p && p.addClass("active")
            }
            var u = t.Event("slid.bs.carousel", {
                relatedTarget: c,
                direction: r
            });
            return t.support.transition && this.$element.hasClass("slide") ? (a.addClass(e), a[0].offsetWidth, s.addClass(r), a.addClass(r), s.one("bsTransitionEnd", function() {
                a.removeClass([e, r].join(" ")).addClass("active"), s.removeClass(["active", r].join(" ")), d.sliding = !1, setTimeout(function() {
                    d.$element.trigger(u)
                }, 0)
            }).emulateTransitionEnd(i.TRANSITION_DURATION)) : (s.removeClass("active"), a.addClass("active"), this.sliding = !1, this.$element.trigger(u)), o && this.cycle(), this
        }
    };
    var n = t.fn.carousel;
    t.fn.carousel = e, t.fn.carousel.Constructor = i, t.fn.carousel.noConflict = function() {
        return t.fn.carousel = n, this
    };
    var s = function(i) {
        var n, s = t(this),
            a = t(s.attr("data-target") || (n = s.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, ""));
        if (a.hasClass("carousel")) {
            var o = t.extend({}, a.data(), s.data()),
                r = s.attr("data-slide-to");
            r && (o.interval = !1), e.call(a, o), r && a.data("bs.carousel").to(r), i.preventDefault()
        }
    };
    t(document).on("click.bs.carousel.data-api", "[data-slide]", s).on("click.bs.carousel.data-api", "[data-slide-to]", s), t(window).on("load", function() {
        t('[data-ride="carousel"]').each(function() {
            var i = t(this);
            e.call(i, i.data())
        })
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        var i, n = e.attr("data-target") || (i = e.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, "");
        return t(n)
    }

    function i(e) {
        return this.each(function() {
            var i = t(this),
                s = i.data("bs.collapse"),
                a = t.extend({}, n.DEFAULTS, i.data(), "object" == typeof e && e);
            !s && a.toggle && "show" == e && (a.toggle = !1), s || i.data("bs.collapse", s = new n(this, a)), "string" == typeof e && s[e]()
        })
    }
    var n = function(e, i) {
        this.$element = t(e), this.options = t.extend({}, n.DEFAULTS, i), this.$trigger = t(this.options.trigger).filter('[href="#' + e.id + '"], [data-target="#' + e.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    n.VERSION = "3.3.1", n.TRANSITION_DURATION = 350, n.DEFAULTS = {
        toggle: !0,
        trigger: '[data-toggle="collapse"]'
    }, n.prototype.dimension = function() {
        var t = this.$element.hasClass("width");
        return t ? "width" : "height"
    }, n.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var e, s = this.$parent && this.$parent.find("> .panel").children(".in, .collapsing");
            if (!(s && s.length && (e = s.data("bs.collapse"), e && e.transitioning))) {
                var a = t.Event("show.bs.collapse");
                if (this.$element.trigger(a), !a.isDefaultPrevented()) {
                    s && s.length && (i.call(s, "hide"), e || s.data("bs.collapse", null));
                    var o = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[o](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var r = function() {
                        this.$element.removeClass("collapsing").addClass("collapse in")[o](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!t.support.transition) return r.call(this);
                    var l = t.camelCase(["scroll", o].join("-"));
                    this.$element.one("bsTransitionEnd", t.proxy(r, this)).emulateTransitionEnd(n.TRANSITION_DURATION)[o](this.$element[0][l])
                }
            }
        }
    }, n.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var e = t.Event("hide.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var i = this.dimension();
                this.$element[i](this.$element[i]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var s = function() {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return t.support.transition ? void this.$element[i](0).one("bsTransitionEnd", t.proxy(s, this)).emulateTransitionEnd(n.TRANSITION_DURATION) : s.call(this)
            }
        }
    }, n.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, n.prototype.getParent = function() {
        return t(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(t.proxy(function(i, n) {
            var s = t(n);
            this.addAriaAndCollapsedClass(e(s), s)
        }, this)).end()
    }, n.prototype.addAriaAndCollapsedClass = function(t, e) {
        var i = t.hasClass("in");
        t.attr("aria-expanded", i), e.toggleClass("collapsed", !i).attr("aria-expanded", i)
    };
    var s = t.fn.collapse;
    t.fn.collapse = i, t.fn.collapse.Constructor = n, t.fn.collapse.noConflict = function() {
        return t.fn.collapse = s, this
    }, t(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(n) {
        var s = t(this);
        s.attr("data-target") || n.preventDefault();
        var a = e(s),
            o = a.data("bs.collapse"),
            r = o ? "toggle" : t.extend({}, s.data(), {
                trigger: this
            });
        i.call(a, r)
    })
}(jQuery), + function(t) {
//    "use strict";
//
//    function e(e) {
//        e && 3 === e.which || (t(s).remove(), t(a).each(function() {
//            var n = t(this),
//                s = i(n),
//                a = {
//                    relatedTarget: this
//                };
//            s.hasClass("open") && (s.trigger(e = t.Event("hide.bs.dropdown", a)), e.isDefaultPrevented() || (n.attr("aria-expanded", "false"), s.removeClass("open").trigger("hidden.bs.dropdown", a)))
//        }))
//    }
//
//    function i(e) {
//        var i = e.attr("data-target");
//        i || (i = e.attr("href"), i = i && /#[A-Za-z]/.test(i) && i.replace(/.*(?=#[^\s]*$)/, ""));
//        var n = i && t(i);
//        return n && n.length ? n : e.parent()
//    }
//
//    function n(e) {
//        return this.each(function() {
//            var i = t(this),
//                n = i.data("bs.dropdown");
//            n || i.data("bs.dropdown", n = new o(this)), "string" == typeof e && n[e].call(i)
//        })
//    }
//    var s = ".dropdown-backdrop",
//        a = '[data-toggle="dropdown"]',
//        o = function(e) {
//            t(e).on("click.bs.dropdown", this.toggle)
//        };
//    o.VERSION = "3.3.1", o.prototype.toggle = function(n) {
//        var s = t(this);
//        if (!s.is(".disabled, :disabled")) {
//            var a = i(s),
//                o = a.hasClass("open");
//            if (e(), !o) {
//                "ontouchstart" in document.documentElement && !a.closest(".navbar-nav").length && t('<div class="dropdown-backdrop"/>').insertAfter(t(this)).on("click", e);
//                var r = {
//                    relatedTarget: this
//                };
//                if (a.trigger(n = t.Event("show.bs.dropdown", r)), n.isDefaultPrevented()) return;
//                s.trigger("focus").attr("aria-expanded", "true"), a.toggleClass("open").trigger("shown.bs.dropdown", r)
//            }
//            return !1
//        }
//    }, o.prototype.keydown = function(e) {
//        if (/(38|40|27|32)/.test(e.which) && !/input|textarea/i.test(e.target.tagName)) {
//            var n = t(this);
//            if (e.preventDefault(), e.stopPropagation(), !n.is(".disabled, :disabled")) {
//                var s = i(n),
//                    o = s.hasClass("open");
//                if (!o && 27 != e.which || o && 27 == e.which) return 27 == e.which && s.find(a).trigger("focus"), n.trigger("click");
//                var r = " li:not(.divider):visible a",
//                    l = s.find('[role="menu"]' + r + ', [role="listbox"]' + r);
//                if (l.length) {
//                    var d = l.index(e.target);
//                    38 == e.which && d > 0 && d--, 40 == e.which && d < l.length - 1 && d++, ~d || (d = 0), l.eq(d).trigger("focus")
//                }
//            }
//        }
//    };
//    var r = t.fn.dropdown;
//    t.fn.dropdown = n, t.fn.dropdown.Constructor = o, t.fn.dropdown.noConflict = function() {
//        return t.fn.dropdown = r, this
//    }, t(document).on("click.bs.dropdown.data-api", e).on("click.bs.dropdown.data-api", ".dropdown form", function(t) {
//        t.stopPropagation()
//    }).on("click.bs.dropdown.data-api", a, o.prototype.toggle).on("keydown.bs.dropdown.data-api", a, o.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="menu"]', o.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="listbox"]', o.prototype.keydown)
//}(jQuery), + function(t) {
//    "use strict";

//    function e(e, n) {
//        return this.each(function() {
//            var s = t(this),
//                a = s.data("bs.modal"),
//                o = t.extend({}, i.DEFAULTS, s.data(), "object" == typeof e && e);
//            a || s.data("bs.modal", a = new i(this, o)), "string" == typeof e ? a[e](n) : o.show && a.show(n)
//        })
//    }
//    var i = function(e, i) {
//        this.options = i, this.$body = t(document.body), this.$element = t(e), this.$backdrop = this.isShown = null, this.scrollbarWidth = 0, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, t.proxy(function() {
//            this.$element.trigger("loaded.bs.modal")
//        }, this))
//    };
//    i.VERSION = "3.3.1", i.TRANSITION_DURATION = 300, i.BACKDROP_TRANSITION_DURATION = 150, i.DEFAULTS = {
//        backdrop: !0,
//        keyboard: !0,
//        show: !0
//    }, i.prototype.toggle = function(t) {
//        return this.isShown ? this.hide() : this.show(t)
//    }, i.prototype.show = function(e) {
//        var n = this,
//            s = t.Event("show.bs.modal", {
//                relatedTarget: e
//            });
//        this.$element.trigger(s), this.isShown || s.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', t.proxy(this.hide, this)), this.backdrop(function() {
//            var s = t.support.transition && n.$element.hasClass("fade");
//            n.$element.parent().length || n.$element.appendTo(n.$body), n.$element.show().scrollTop(0), n.options.backdrop && n.adjustBackdrop(), n.adjustDialog(), s && n.$element[0].offsetWidth, n.$element.addClass("in").attr("aria-hidden", !1), n.enforceFocus();
//            var a = t.Event("shown.bs.modal", {
//                relatedTarget: e
//            });
//            s ? n.$element.find(".modal-dialog").one("bsTransitionEnd", function() {
//                n.$element.trigger("focus").trigger(a)
//            }).emulateTransitionEnd(i.TRANSITION_DURATION) : n.$element.trigger("focus").trigger(a)
//        }))
//    }, i.prototype.hide = function(e) {
//        e && e.preventDefault(), e = t.Event("hide.bs.modal"), this.$element.trigger(e), this.isShown && !e.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), t(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.bs.modal"), t.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", t.proxy(this.hideModal, this)).emulateTransitionEnd(i.TRANSITION_DURATION) : this.hideModal())
//    }, i.prototype.enforceFocus = function() {
//        t(document).off("focusin.bs.modal").on("focusin.bs.modal", t.proxy(function(t) {
//            this.$element[0] === t.target || this.$element.has(t.target).length || this.$element.trigger("focus")
//        }, this))
//    }, i.prototype.escape = function() {
//        this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", t.proxy(function(t) {
//            27 == t.which && this.hide()
//        }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
//    }, i.prototype.resize = function() {
//        this.isShown ? t(window).on("resize.bs.modal", t.proxy(this.handleUpdate, this)) : t(window).off("resize.bs.modal")
//    }, i.prototype.hideModal = function() {
//        var t = this;
//        this.$element.hide(), this.backdrop(function() {
//            t.$body.removeClass("modal-open"), t.resetAdjustments(), t.resetScrollbar(), t.$element.trigger("hidden.bs.modal")
//        })
//    }, i.prototype.removeBackdrop = function() {
//        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
//    }, i.prototype.backdrop = function(e) {
//        var n = this,
//            s = this.$element.hasClass("fade") ? "fade" : "";
//        if (this.isShown && this.options.backdrop) {
//            var a = t.support.transition && s;
//            if (this.$backdrop = t('<div class="modal-backdrop ' + s + '" />').prependTo(this.$element).on("click.dismiss.bs.modal", t.proxy(function(t) {
//                    t.target === t.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this))
//                }, this)), a && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !e) return;
//            a ? this.$backdrop.one("bsTransitionEnd", e).emulateTransitionEnd(i.BACKDROP_TRANSITION_DURATION) : e()
//        } else if (!this.isShown && this.$backdrop) {
//            this.$backdrop.removeClass("in");
//            var o = function() {
//                n.removeBackdrop(), e && e()
//            };
//            t.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", o).emulateTransitionEnd(i.BACKDROP_TRANSITION_DURATION) : o()
//        } else e && e()
//    }, i.prototype.handleUpdate = function() {
//        this.options.backdrop && this.adjustBackdrop(), this.adjustDialog()
//    }, i.prototype.adjustBackdrop = function() {
//        this.$backdrop.css("height", 0).css("height", this.$element[0].scrollHeight)
//    }, i.prototype.adjustDialog = function() {
//        var t = this.$element[0].scrollHeight > document.documentElement.clientHeight;
//        this.$element.css({
//            paddingLeft: !this.bodyIsOverflowing && t ? this.scrollbarWidth : "",
//            paddingRight: this.bodyIsOverflowing && !t ? this.scrollbarWidth : ""
//        })
//    }, i.prototype.resetAdjustments = function() {
//        this.$element.css({
//            paddingLeft: "",
//            paddingRight: ""
//        })
//    }, i.prototype.checkScrollbar = function() {
//        this.bodyIsOverflowing = document.body.scrollHeight > document.documentElement.clientHeight, this.scrollbarWidth = this.measureScrollbar()
//    }, i.prototype.setScrollbar = function() {
//        var t = parseInt(this.$body.css("padding-right") || 0, 10);
//        this.bodyIsOverflowing && this.$body.css("padding-right", t + this.scrollbarWidth)
//    }, i.prototype.resetScrollbar = function() {
//        this.$body.css("padding-right", "")
//    }, i.prototype.measureScrollbar = function() {
//        var t = document.createElement("div");
//        t.className = "modal-scrollbar-measure", this.$body.append(t);
//        var e = t.offsetWidth - t.clientWidth;
//        return this.$body[0].removeChild(t), e
//    };
//    var n = t.fn.modal;
//    t.fn.modal = e, t.fn.modal.Constructor = i, t.fn.modal.noConflict = function() {
//        return t.fn.modal = n, this
//    }, t(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(i) {
//        var n = t(this),
//            s = n.attr("href"),
//            a = t(n.attr("data-target") || s && s.replace(/.*(?=#[^\s]+$)/, "")),
//            o = a.data("bs.modal") ? "toggle" : t.extend({
//                remote: !/#/.test(s) && s
//            }, a.data(), n.data());
//        n.is("a") && i.preventDefault(), a.one("show.bs.modal", function(t) {
//            t.isDefaultPrevented() || a.one("hidden.bs.modal", function() {
//                n.is(":visible") && n.trigger("focus")
//            })
//        }), e.call(a, o, this)
//    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var n = t(this),
                s = n.data("bs.tooltip"),
                a = "object" == typeof e && e,
                o = a && a.selector;
            (s || "destroy" != e) && (o ? (s || n.data("bs.tooltip", s = {}), s[o] || (s[o] = new i(this, a))) : s || n.data("bs.tooltip", s = new i(this, a)), "string" == typeof e && s[e]())
        })
    }
    var i = function(t, e) {
        this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", t, e)
    };
    i.VERSION = "3.3.1", i.TRANSITION_DURATION = 150, i.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {
            selector: "body",
            padding: 0
        }
    }, i.prototype.init = function(e, i, n) {
        this.enabled = !0, this.type = e, this.$element = t(i), this.options = this.getOptions(n), this.$viewport = this.options.viewport && t(this.options.viewport.selector || this.options.viewport);
        for (var s = this.options.trigger.split(" "), a = s.length; a--;) {
            var o = s[a];
            if ("click" == o) this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this));
            else if ("manual" != o) {
                var r = "hover" == o ? "mouseenter" : "focusin",
                    l = "hover" == o ? "mouseleave" : "focusout";
                this.$element.on(r + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = t.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, i.prototype.getDefaults = function() {
        return i.DEFAULTS
    }, i.prototype.getOptions = function(e) {
        return e = t.extend({}, this.getDefaults(), this.$element.data(), e), e.delay && "number" == typeof e.delay && (e.delay = {
            show: e.delay,
            hide: e.delay
        }), e
    }, i.prototype.getDelegateOptions = function() {
        var e = {},
            i = this.getDefaults();
        return this._options && t.each(this._options, function(t, n) {
            i[t] != n && (e[t] = n)
        }), e
    }, i.prototype.enter = function(e) {
        var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
        return i && i.$tip && i.$tip.is(":visible") ? void(i.hoverState = "in") : (i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i)), clearTimeout(i.timeout), i.hoverState = "in", i.options.delay && i.options.delay.show ? void(i.timeout = setTimeout(function() {
            "in" == i.hoverState && i.show()
        }, i.options.delay.show)) : i.show())
    }, i.prototype.leave = function(e) {
        var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
        return i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i)), clearTimeout(i.timeout), i.hoverState = "out", i.options.delay && i.options.delay.hide ? void(i.timeout = setTimeout(function() {
            "out" == i.hoverState && i.hide()
        }, i.options.delay.hide)) : i.hide()
    }, i.prototype.show = function() {
        var e = t.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(e);
            var n = t.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (e.isDefaultPrevented() || !n) return;
            var s = this,
                a = this.tip(),
                o = this.getUID(this.type);
            this.setContent(), a.attr("id", o), this.$element.attr("aria-describedby", o), this.options.animation && a.addClass("fade");
            var r = "function" == typeof this.options.placement ? this.options.placement.call(this, a[0], this.$element[0]) : this.options.placement,
                l = /\s?auto?\s?/i,
                d = l.test(r);
            d && (r = r.replace(l, "") || "top"), a.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(r).data("bs." + this.type, this), this.options.container ? a.appendTo(this.options.container) : a.insertAfter(this.$element);
            var c = this.getPosition(),
                h = a[0].offsetWidth,
                p = a[0].offsetHeight;
            if (d) {
                var u = r,
                    g = this.options.container ? t(this.options.container) : this.$element.parent(),
                    f = this.getPosition(g);
                r = "bottom" == r && c.bottom + p > f.bottom ? "top" : "top" == r && c.top - p < f.top ? "bottom" : "right" == r && c.right + h > f.width ? "left" : "left" == r && c.left - h < f.left ? "right" : r, a.removeClass(u).addClass(r)
            }
            var m = this.getCalculatedOffset(r, c, h, p);
            this.applyPlacement(m, r);
            var v = function() {
                var t = s.hoverState;
                s.$element.trigger("shown.bs." + s.type), s.hoverState = null, "out" == t && s.leave(s)
            };
            t.support.transition && this.$tip.hasClass("fade") ? a.one("bsTransitionEnd", v).emulateTransitionEnd(i.TRANSITION_DURATION) : v()
        }
    }, i.prototype.applyPlacement = function(e, i) {
        var n = this.tip(),
            s = n[0].offsetWidth,
            a = n[0].offsetHeight,
            o = parseInt(n.css("margin-top"), 10),
            r = parseInt(n.css("margin-left"), 10);
        isNaN(o) && (o = 0), isNaN(r) && (r = 0), e.top = e.top + o, e.left = e.left + r, t.offset.setOffset(n[0], t.extend({
            using: function(t) {
                n.css({
                    top: Math.round(t.top),
                    left: Math.round(t.left)
                })
            }
        }, e), 0), n.addClass("in");
        var l = n[0].offsetWidth,
            d = n[0].offsetHeight;
        "top" == i && d != a && (e.top = e.top + a - d);
        var c = this.getViewportAdjustedDelta(i, e, l, d);
        c.left ? e.left += c.left : e.top += c.top;
        var h = /top|bottom/.test(i),
            p = h ? 2 * c.left - s + l : 2 * c.top - a + d,
            u = h ? "offsetWidth" : "offsetHeight";
        n.offset(e), this.replaceArrow(p, n[0][u], h)
    }, i.prototype.replaceArrow = function(t, e, i) {
        this.arrow().css(i ? "left" : "top", 50 * (1 - t / e) + "%").css(i ? "top" : "left", "")
    }, i.prototype.setContent = function() {
        var t = this.tip(),
            e = this.getTitle();
        t.find(".tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("fade in top bottom left right")
    }, i.prototype.hide = function(e) {
        function n() {
            "in" != s.hoverState && a.detach(), s.$element.removeAttr("aria-describedby").trigger("hidden.bs." + s.type), e && e()
        }
        var s = this,
            a = this.tip(),
            o = t.Event("hide.bs." + this.type);
        return this.$element.trigger(o), o.isDefaultPrevented() ? void 0 : (a.removeClass("in"), t.support.transition && this.$tip.hasClass("fade") ? a.one("bsTransitionEnd", n).emulateTransitionEnd(i.TRANSITION_DURATION) : n(), this.hoverState = null, this)
    }, i.prototype.fixTitle = function() {
        var t = this.$element;
        (t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "")
    }, i.prototype.hasContent = function() {
        return this.getTitle()
    }, i.prototype.getPosition = function(e) {
        e = e || this.$element;
        var i = e[0],
            n = "BODY" == i.tagName,
            s = i.getBoundingClientRect();
        null == s.width && (s = t.extend({}, s, {
            width: s.right - s.left,
            height: s.bottom - s.top
        }));
        var a = n ? {
                top: 0,
                left: 0
            } : e.offset(),
            o = {
                scroll: n ? document.documentElement.scrollTop || document.body.scrollTop : e.scrollTop()
            },
            r = n ? {
                width: t(window).width(),
                height: t(window).height()
            } : null;
        return t.extend({}, s, o, r, a)
    }, i.prototype.getCalculatedOffset = function(t, e, i, n) {
        return "bottom" == t ? {
            top: e.top + e.height,
            left: e.left + e.width / 2 - i / 2
        } : "top" == t ? {
            top: e.top - n,
            left: e.left + e.width / 2 - i / 2
        } : "left" == t ? {
            top: e.top + e.height / 2 - n / 2,
            left: e.left - i
        } : {
            top: e.top + e.height / 2 - n / 2,
            left: e.left + e.width
        }
    }, i.prototype.getViewportAdjustedDelta = function(t, e, i, n) {
        var s = {
            top: 0,
            left: 0
        };
        if (!this.$viewport) return s;
        var a = this.options.viewport && this.options.viewport.padding || 0,
            o = this.getPosition(this.$viewport);
        if (/right|left/.test(t)) {
            var r = e.top - a - o.scroll,
                l = e.top + a - o.scroll + n;
            r < o.top ? s.top = o.top - r : l > o.top + o.height && (s.top = o.top + o.height - l)
        } else {
            var d = e.left - a,
                c = e.left + a + i;
            d < o.left ? s.left = o.left - d : c > o.width && (s.left = o.left + o.width - c)
        }
        return s
    }, i.prototype.getTitle = function() {
        var t, e = this.$element,
            i = this.options;
        return t = e.attr("data-original-title") || ("function" == typeof i.title ? i.title.call(e[0]) : i.title)
    }, i.prototype.getUID = function(t) {
        do t += ~~(1e6 * Math.random()); while (document.getElementById(t));
        return t
    }, i.prototype.tip = function() {
        return this.$tip = this.$tip || t(this.options.template)
    }, i.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, i.prototype.enable = function() {
        this.enabled = !0
    }, i.prototype.disable = function() {
        this.enabled = !1
    }, i.prototype.toggleEnabled = function() {
        this.enabled = !this.enabled
    }, i.prototype.toggle = function(e) {
        var i = this;
        e && (i = t(e.currentTarget).data("bs." + this.type), i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i))), i.tip().hasClass("in") ? i.leave(i) : i.enter(i)
    }, i.prototype.destroy = function() {
        var t = this;
        clearTimeout(this.timeout), this.hide(function() {
            t.$element.off("." + t.type).removeData("bs." + t.type)
        })
    };
    var n = t.fn.tooltip;
    t.fn.tooltip = e, t.fn.tooltip.Constructor = i, t.fn.tooltip.noConflict = function() {
        return t.fn.tooltip = n, this
    }
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var n = t(this),
                s = n.data("bs.popover"),
                a = "object" == typeof e && e,
                o = a && a.selector;
            (s || "destroy" != e) && (o ? (s || n.data("bs.popover", s = {}), s[o] || (s[o] = new i(this, a))) : s || n.data("bs.popover", s = new i(this, a)), "string" == typeof e && s[e]())
        })
    }
    var i = function(t, e) {
        this.init("popover", t, e)
    };
    if (!t.fn.tooltip) throw new Error("Popover requires tooltip.js");
    i.VERSION = "3.3.1", i.DEFAULTS = t.extend({}, t.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), i.prototype = t.extend({}, t.fn.tooltip.Constructor.prototype), i.prototype.constructor = i, i.prototype.getDefaults = function() {
        return i.DEFAULTS
    }, i.prototype.setContent = function() {
        var t = this.tip(),
            e = this.getTitle(),
            i = this.getContent();
        t.find(".popover-title")[this.options.html ? "html" : "text"](e), t.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof i ? "html" : "append" : "text"](i), t.removeClass("fade top bottom left right in"), t.find(".popover-title").html() || t.find(".popover-title").hide()
    }, i.prototype.hasContent = function() {
        return this.getTitle() || this.getContent()
    }, i.prototype.getContent = function() {
        var t = this.$element,
            e = this.options;
        return t.attr("data-content") || ("function" == typeof e.content ? e.content.call(t[0]) : e.content)
    }, i.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    }, i.prototype.tip = function() {
        return this.$tip || (this.$tip = t(this.options.template)), this.$tip
    };
    var n = t.fn.popover;
    t.fn.popover = e, t.fn.popover.Constructor = i, t.fn.popover.noConflict = function() {
        return t.fn.popover = n, this
    }
}(jQuery), + function(t) {
    "use strict";

    function e(i, n) {
        var s = t.proxy(this.process, this);
        this.$body = t("body"), this.$scrollElement = t(t(i).is("body") ? window : i), this.options = t.extend({}, e.DEFAULTS, n), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", s), this.refresh(), this.process()
    }

    function i(i) {
        return this.each(function() {
            var n = t(this),
                s = n.data("bs.scrollspy"),
                a = "object" == typeof i && i;
            s || n.data("bs.scrollspy", s = new e(this, a)), "string" == typeof i && s[i]()
        })
    }
    e.VERSION = "3.3.1", e.DEFAULTS = {
        offset: 10
    }, e.prototype.getScrollHeight = function() {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }, e.prototype.refresh = function() {
        var e = "offset",
            i = 0;
        t.isWindow(this.$scrollElement[0]) || (e = "position", i = this.$scrollElement.scrollTop()), this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight();
        var n = this;
        this.$body.find(this.selector).map(function() {
            var n = t(this),
                s = n.data("target") || n.attr("href"),
                a = /^#./.test(s) && t(s);
            return a && a.length && a.is(":visible") && [
                [a[e]().top + i, s]
            ] || null
        }).sort(function(t, e) {
            return t[0] - e[0]
        }).each(function() {
            n.offsets.push(this[0]), n.targets.push(this[1])
        })
    }, e.prototype.process = function() {
        var t, e = this.$scrollElement.scrollTop() + this.options.offset,
            i = this.getScrollHeight(),
            n = this.options.offset + i - this.$scrollElement.height(),
            s = this.offsets,
            a = this.targets,
            o = this.activeTarget;
        if (this.scrollHeight != i && this.refresh(), e >= n) return o != (t = a[a.length - 1]) && this.activate(t);
        if (o && e < s[0]) return this.activeTarget = null, this.clear();
        for (t = s.length; t--;) o != a[t] && e >= s[t] && (!s[t + 1] || e <= s[t + 1]) && this.activate(a[t])
    }, e.prototype.activate = function(e) {
        this.activeTarget = e, this.clear();
        var i = this.selector + '[data-target="' + e + '"],' + this.selector + '[href="' + e + '"]',
            n = t(i).parents("li").addClass("active");
        n.parent(".dropdown-menu").length && (n = n.closest("li.dropdown").addClass("active")), n.trigger("activate.bs.scrollspy")
    }, e.prototype.clear = function() {
        t(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
    };
    var n = t.fn.scrollspy;
    t.fn.scrollspy = i, t.fn.scrollspy.Constructor = e, t.fn.scrollspy.noConflict = function() {
        return t.fn.scrollspy = n, this
    }, t(window).on("load.bs.scrollspy.data-api", function() {
        t('[data-spy="scroll"]').each(function() {
            var e = t(this);
            i.call(e, e.data())
        })
    })
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var n = t(this),
                s = n.data("bs.tab");
            s || n.data("bs.tab", s = new i(this)), "string" == typeof e && s[e]()
        })
    }
    var i = function(e) {
        this.element = t(e)
    };
    i.VERSION = "3.3.1", i.TRANSITION_DURATION = 150, i.prototype.show = function() {
        var e = this.element,
            i = e.closest("ul:not(.dropdown-menu)"),
            n = e.data("target");
        if (n || (n = e.attr("href"), n = n && n.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("active")) {
            var s = i.find(".active:last a"),
                a = t.Event("hide.bs.tab", {
                    relatedTarget: e[0]
                }),
                o = t.Event("show.bs.tab", {
                    relatedTarget: s[0]
                });
            if (s.trigger(a), e.trigger(o), !o.isDefaultPrevented() && !a.isDefaultPrevented()) {
                var r = t(n);
                this.activate(e.closest("li"), i), this.activate(r, r.parent(), function() {
                    s.trigger({
                        type: "hidden.bs.tab",
                        relatedTarget: e[0]
                    }), e.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: s[0]
                    })
                })
            }
        }
    }, i.prototype.activate = function(e, n, s) {
        function a() {
            o.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), e.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), r ? (e[0].offsetWidth, e.addClass("in")) : e.removeClass("fade"), e.parent(".dropdown-menu") && e.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), s && s()
        }
        var o = n.find("> .active"),
            r = s && t.support.transition && (o.length && o.hasClass("fade") || !!n.find("> .fade").length);
        o.length && r ? o.one("bsTransitionEnd", a).emulateTransitionEnd(i.TRANSITION_DURATION) : a(), o.removeClass("in")
    };
    var n = t.fn.tab;
    t.fn.tab = e, t.fn.tab.Constructor = i, t.fn.tab.noConflict = function() {
        return t.fn.tab = n, this
    };
    var s = function(i) {
        i.preventDefault(), e.call(t(this), "show")
    };
    t(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', s).on("click.bs.tab.data-api", '[data-toggle="pill"]', s)
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var n = t(this),
                s = n.data("bs.affix"),
                a = "object" == typeof e && e;
            s || n.data("bs.affix", s = new i(this, a)), "string" == typeof e && s[e]()
        })
    }
    var i = function(e, n) {
        this.options = t.extend({}, i.DEFAULTS, n), this.$target = t(this.options.target).on("scroll.bs.affix.data-api", t.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", t.proxy(this.checkPositionWithEventLoop, this)), this.$element = t(e), this.affixed = this.unpin = this.pinnedOffset = null, this.checkPosition()
    };
    i.VERSION = "3.3.1", i.RESET = "affix affix-top affix-bottom", i.DEFAULTS = {
        offset: 0,
        target: window
    }, i.prototype.getState = function(t, e, i, n) {
        var s = this.$target.scrollTop(),
            a = this.$element.offset(),
            o = this.$target.height();
        if (null != i && "top" == this.affixed) return i > s ? "top" : !1;
        if ("bottom" == this.affixed) return null != i ? s + this.unpin <= a.top ? !1 : "bottom" : t - n >= s + o ? !1 : "bottom";
        var r = null == this.affixed,
            l = r ? s : a.top,
            d = r ? o : e;
        return null != i && i >= l ? "top" : null != n && l + d >= t - n ? "bottom" : !1
    }, i.prototype.getPinnedOffset = function() {
        if (this.pinnedOffset) return this.pinnedOffset;
        this.$element.removeClass(i.RESET).addClass("affix");
        var t = this.$target.scrollTop(),
            e = this.$element.offset();
        return this.pinnedOffset = e.top - t
    }, i.prototype.checkPositionWithEventLoop = function() {
        setTimeout(t.proxy(this.checkPosition, this), 1)
    }, i.prototype.checkPosition = function() {
        if (this.$element.is(":visible")) {
            var e = this.$element.height(),
                n = this.options.offset,
                s = n.top,
                a = n.bottom,
                o = t("body").height();
            "object" != typeof n && (a = s = n), "function" == typeof s && (s = n.top(this.$element)), "function" == typeof a && (a = n.bottom(this.$element));
            var r = this.getState(o, e, s, a);
            if (this.affixed != r) {
                null != this.unpin && this.$element.css("top", "");
                var l = "affix" + (r ? "-" + r : ""),
                    d = t.Event(l + ".bs.affix");
                if (this.$element.trigger(d), d.isDefaultPrevented()) return;
                this.affixed = r, this.unpin = "bottom" == r ? this.getPinnedOffset() : null, this.$element.removeClass(i.RESET).addClass(l).trigger(l.replace("affix", "affixed") + ".bs.affix")
            }
            "bottom" == r && this.$element.offset({
                top: o - e - a
            })
        }
    };
    var n = t.fn.affix;
    t.fn.affix = e, t.fn.affix.Constructor = i, t.fn.affix.noConflict = function() {
        return t.fn.affix = n, this
    }, t(window).on("load", function() {
        t('[data-spy="affix"]').each(function() {
            var i = t(this),
                n = i.data();
            n.offset = n.offset || {}, null != n.offsetBottom && (n.offset.bottom = n.offsetBottom), null != n.offsetTop && (n.offset.top = n.offsetTop), e.call(i, n)
        })
    })
}(jQuery);
var htmlMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;",
    "/": "&#x2F;"
};
! function(t) {
    var e = {},
        n = {
            mode: "horizontal",
            slideSelector: "",
            infiniteLoop: !0,
            hideControlOnEnd: !1,
            speed: 500,
            easing: null,
            slideMargin: 0,
            startSlide: 0,
            randomStart: !1,
            captions: !1,
            ticker: !1,
            tickerHover: !1,
            adaptiveHeight: !1,
            adaptiveHeightSpeed: 500,
            video: !1,
            useCSS: !0,
            preloadImages: "visible",
            responsive: !0,
            slideZIndex: 50,
            wrapperClass: "bx-wrapper",
            touchEnabled: !0,
            swipeThreshold: 50,
            oneToOneTouch: !0,
            preventDefaultSwipeX: !0,
            preventDefaultSwipeY: !1,
            pager: !0,
            pagerType: "full",
            pagerShortSeparator: " / ",
            pagerSelector: null,
            buildPager: null,
            pagerCustom: null,
            controls: !0,
            nextText: "",
            prevText: "",
            nextSelector: null,
            prevSelector: null,
            autoControls: !1,
            startText: "",
            stopText: "",
            autoControlsCombine: !1,
            autoControlsSelector: null,
            auto: !1,
            pause: 4e3,
            autoStart: !0,
            autoDirection: "next",
            autoHover: !1,
            autoDelay: 0,
            autoSlideForOnePage: !1,
            minSlides: 1,
            maxSlides: 1,
            moveSlides: 0,
            slideWidth: 0,
            onSliderLoad: function() {},
            onSlideBefore: function() {},
            onSlideAfter: function() {},
            onSlideNext: function() {},
            onSlidePrev: function() {},
            onSliderResize: function() {},
            autoReload: !0
        };
    t.fn.bxSlider = function(s) {
        function a(e) {
            t(e).find(".bx-layer").each(function() {
                var e = t(this).attr("data-anim");
                t(this).removeClass("animated " + e)
            })
        }

        function o(e) {
            var i = [];
            return t(e).find(".bx-layer").each(function(e) {
                var n = parseInt(t(this).attr("data-dur")),
                    s = parseInt(t(this).attr("data-delay"));
                i[e] = n + s;
                var a = t(this).attr("data-anim");
                t(this).css({
                    "animation-duration": n + "ms",
                    "animation-delay": s + "ms",
                    "animation-fill-mode": "both"
                }).addClass("animated " + a)
            }), i[0] ? Math.max.apply(Math, i) : null
        }
        if (0 == this.length) return this;
        if (this.length > 1) return this.each(function() {
            t(this).bxSlider(s)
        }), this;
        var r = {},
            l = this;
        e.el = this;
        var d = t(window).width(),
            c = t(window).height(),
            h = function() {
                function e(t, e, i) {
                    var n = (t - i * (e - 1)) / e;
                    return Math.floor(n)
                }

                function i(t) {
                    for (var e in t) r.settings[e] = t[e]
                }

                function a() {
                    r.settings.slides && (r.settings.maxSlides = r.settings.slides, r.settings.minSlides = r.settings.slides, r.settings.slideWidth = e(d, r.settings.slides, r.settings.slideMargin))
                }

                function o(t) {
                    t = t.replace(/([a-zA-Z]+?):/g, '"$1":'), t = t.replace(/'/g, '"');
                    var e = jQuery.parseJSON(t);
                    return e
                }
                r.settings = t.extend({}, n, s), a();
                var c = t(window).width();
                d = c;
                var h = t(l).attr("data-options");
                if (h) {
                    var u = h.charAt(h.length - 1),
                        g = h.charAt(0);
                    "{" != g && "}" != u && (h = "{" + h + "}");
                    var f = o(h);
                    for (var m in f) r.settings[m] = f[m];
                    a()
                }
                var v = t(l).attr("data-breaks");
                if (v && (r.settings.breaks = o(v)), r.settings.breaks) {
                    r.settings.breaks.sort(function(t, e) {
                        return t.screen - e.screen
                    });
                    for (var _ = 0; _ < r.settings.breaks.length; ++_) {
                        var b, y = r.settings.breaks[_],
                            w = {},
                            k = y.screen;
                        _ < r.settings.breaks.length - 1 ? (w = r.settings.breaks[_ + 1], b = w.screen, c >= k && b > c && i(y)) : c >= k && i(y)
                    }
                    a()
                }
                if (r.settings.fullscreen) {
                    {
                        var x = t(window).width();
                        t(window).height()
                    }
                    r.settings.maxSlides = 1, r.settings.minSlides = 1, r.settings.slideWidth = x
                }
                r.settings.slideWidth = parseInt(r.settings.slideWidth), r.children = l.children(r.settings.slideSelector), r.children.length < r.settings.minSlides && (r.settings.minSlides = r.children.length), r.children.length < r.settings.maxSlides && (r.settings.maxSlides = r.children.length), r.settings.randomStart && (r.settings.startSlide = Math.floor(Math.random() * r.children.length)), r.active = {
                    index: r.settings.startSlide
                }, r.carousel = r.settings.minSlides > 1 || r.settings.maxSlides > 1, r.carousel && (r.settings.preloadImages = "all"), r.minThreshold = r.settings.minSlides * r.settings.slideWidth + (r.settings.minSlides - 1) * r.settings.slideMargin, r.maxThreshold = r.settings.maxSlides * r.settings.slideWidth + (r.settings.maxSlides - 1) * r.settings.slideMargin, r.working = !1, r.controls = {}, r.interval = null, r.animProp = "vertical" == r.settings.mode ? "top" : "left", r.usingCSS = r.settings.useCSS && "fade" != r.settings.mode && function() {
                    var t = document.createElement("div"),
                        e = ["WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                    for (var i in e)
                        if (void 0 !== t.style[e[i]]) return r.cssPrefix = e[i].replace("Perspective", "").toLowerCase(), r.animProp = "-" + r.cssPrefix + "-transform", !0;
                    return !1
                }(), "vertical" == r.settings.mode && (r.settings.maxSlides = r.settings.minSlides), l.data("origStyle", l.attr("style")), l.children(r.settings.slideSelector).each(function() {
                    t(this).data("origStyle", t(this).attr("style"))
                }), p()
            },
            p = function() {
                var e, i = l.width();
                e = 400 >= i ? "size-xs" : i > 400 && 767 >= i ? "size-sm" : i > 767 && 1023 >= i ? "size-md" : "size-lg", l.wrap('<div class="' + r.settings.wrapperClass + " " + e + '"><div class="bx-viewport"></div></div>'), r.viewport = l.parent(), r.loader = t('<div class="bx-loading" />'), r.viewport.prepend(r.loader), l.css({
                    width: "horizontal" == r.settings.mode ? 100 * r.children.length + 215 + "%" : "auto",
                    position: "relative"
                }), r.usingCSS && r.settings.easing ? l.css("-" + r.cssPrefix + "-transition-timing-function", r.settings.easing) : r.settings.easing || (r.settings.easing = "swing");
                _();
                r.viewport.css({
                    width: "100%",
                    overflow: "hidden",
                    position: "relative"
                }), r.viewport.parent().css({
                    maxWidth: m()
                }), r.settings.pager || r.viewport.parent().css({
                    margin: "0 auto 0px"
                }), r.children.css({
                    "float": "horizontal" == r.settings.mode ? "left" : "none",
                    listStyle: "none",
                    position: "relative"
                }), r.children.css("width", v()), "horizontal" == r.settings.mode && r.settings.slideMargin > 0 && r.children.css("marginRight", r.settings.slideMargin), "vertical" == r.settings.mode && r.settings.slideMargin > 0 && r.children.css("marginBottom", r.settings.slideMargin), "fade" == r.settings.mode && (r.children.css({
                    position: "absolute",
                    zIndex: 0,
                    display: "none"
                }), r.children.eq(r.settings.startSlide).css({
                    zIndex: r.settings.slideZIndex,
                    display: "block"
                })), r.controls.el = t('<div class="bx-controls" />'), r.settings.captions && T(), r.active.last = r.settings.startSlide == b() - 1, r.settings.video && l.fitVids();
                var n = r.children.eq(r.settings.startSlide);
                "all" == r.settings.preloadImages && (n = r.children), r.settings.ticker ? r.settings.pager = !1 : (r.settings.pager && D(), r.settings.controls && C(), r.settings.auto && r.settings.autoControls && S(), (r.settings.controls || r.settings.autoControls || r.settings.pager) && r.viewport.after(r.controls.el)), u(n, g)
            },
            u = function(e, i) {
                var n = e.find("img, iframe").length;
                if (0 == n) return void i();
                var s = 0;
                e.find("img, iframe").each(function() {
                    t(this).one("load", function() {
                        ++s == n && i()
                    }).each(function() {
                        this.complete && t(this).load()
                    })
                })
            },
            g = function() {
                if (r.settings.infiniteLoop && "fade" != r.settings.mode && !r.settings.ticker) {
                    var e = "vertical" == r.settings.mode ? r.settings.minSlides : r.settings.maxSlides,
                        i = r.children.slice(0, e).clone().addClass("bx-clone"),
                        n = r.children.slice(-e).clone().addClass("bx-clone");
                    l.append(i).prepend(n)
                }
                r.settings.removeClass && l.removeClass(r.settings.removeClass), r.loader.remove(), w(), "vertical" == r.settings.mode && (r.settings.adaptiveHeight = !0), r.viewport.height(f()), l.redrawSlider(), r.settings.onSliderLoad(r.active.index), r.initialized = !0;
                var s = r.children.eq(r.active.index);
                s.addClass("active");
                var d = o(s);
                d && setTimeout(function() {
                    a(s)
                }, d), r.settings.responsive && t(window).bind("resize", U), r.settings.auto && r.settings.autoStart && (b() > 1 || r.settings.autoSlideForOnePage) && W(), r.settings.ticker && z(), r.settings.pager && A(r.settings.startSlide), r.settings.controls && j(), r.settings.touchEnabled && !r.settings.ticker && R()
            },
            f = function() {
                var e = 0,
                    n = t();
                if ("vertical" == r.settings.mode || r.settings.adaptiveHeight)
                    if (r.carousel) {
                        var s = 1 == r.settings.moveSlides ? r.active.index : r.active.index * y();
                        for (n = r.children.eq(s), i = 1; i <= r.settings.maxSlides - 1; i++) n = n.add(s + i >= r.children.length ? r.children.eq(i - 1) : r.children.eq(s + i))
                    } else n = r.children.eq(r.active.index);
                else n = r.children;
                return "vertical" == r.settings.mode ? (n.each(function() {
                    e += t(this).outerHeight()
                }), r.settings.slideMargin > 0 && (e += r.settings.slideMargin * (r.settings.minSlides - 1))) : e = Math.max.apply(Math, n.map(function() {
                    return t(this).outerHeight(!1)
                }).get()), "border-box" == r.viewport.css("box-sizing") ? e += parseFloat(r.viewport.css("padding-top")) + parseFloat(r.viewport.css("padding-bottom")) + parseFloat(r.viewport.css("border-top-width")) + parseFloat(r.viewport.css("border-bottom-width")) : "padding-box" == r.viewport.css("box-sizing") && (e += parseFloat(r.viewport.css("padding-top")) + parseFloat(r.viewport.css("padding-bottom"))), e
            },
            m = function() {
                var t = "100%";
                return r.settings.slideWidth > 0 && (t = "horizontal" == r.settings.mode ? r.settings.maxSlides * r.settings.slideWidth + (r.settings.maxSlides - 1) * r.settings.slideMargin : r.settings.slideWidth), t
            },
            v = function() {
                var t = r.settings.slideWidth,
                    e = r.viewport.width();
                return 0 == r.settings.slideWidth || r.settings.slideWidth > e && !r.carousel || "vertical" == r.settings.mode ? t = e : r.settings.maxSlides > 1 && "horizontal" == r.settings.mode && (e > r.maxThreshold || e < r.minThreshold && (t = (e - r.settings.slideMargin * (r.settings.minSlides - 1)) / r.settings.minSlides)), t
            },
            _ = function() {
                var t = 1;
                if ("horizontal" == r.settings.mode && r.settings.slideWidth > 0)
                    if (r.viewport.width() < r.minThreshold) t = r.settings.minSlides;
                    else if (r.viewport.width() > r.maxThreshold) t = r.settings.maxSlides;
                else {
                    var e = r.children.first().width() + r.settings.slideMargin;
                    t = Math.floor((r.viewport.width() + r.settings.slideMargin) / e)
                } else "vertical" == r.settings.mode && (t = r.settings.minSlides);
                return t
            },
            b = function() {
                var t = 0;
                if (r.settings.moveSlides > 0)
                    if (r.settings.infiniteLoop) t = Math.ceil(r.children.length / y());
                    else
                        for (var e = 0, i = 0; e < r.children.length;) ++t, e = i + _(), i += r.settings.moveSlides <= _() ? r.settings.moveSlides : _();
                else t = Math.ceil(r.children.length / _());
                return t
            },
            y = function() {
                return r.settings.moveSlides > 0 && r.settings.moveSlides <= _() ? r.settings.moveSlides : _()
            },
            w = function() {
                if (r.children.length > r.settings.maxSlides && r.active.last && !r.settings.infiniteLoop) {
                    if ("horizontal" == r.settings.mode) {
                        var t = r.children.last(),
                            e = t.position();
                        k(-(e.left - (r.viewport.width() - t.outerWidth())), "reset", 0)
                    } else if ("vertical" == r.settings.mode) {
                        var i = r.children.length - r.settings.minSlides,
                            e = r.children.eq(i).position();
                        k(-e.top, "reset", 0)
                    }
                } else {
                    var e = r.children.eq(r.active.index * y()).position();
                    r.active.index == b() - 1 && (r.active.last = !0), void 0 != e && ("horizontal" == r.settings.mode ? k(-e.left, "reset", 0) : "vertical" == r.settings.mode && k(-e.top, "reset", 0))
                }
            },
            k = function(t, e, i, n) {
                if (r.usingCSS) {
                    var s = "vertical" == r.settings.mode ? "translate3d(0, " + t + "px, 0)" : "translate3d(" + t + "px, 0, 0)";
                    l.css("-" + r.cssPrefix + "-transition-duration", i / 1e3 + "s"), "slide" == e ? (l.css(r.animProp, s), l.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                        l.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), P()
                    })) : "reset" == e ? l.css(r.animProp, s) : "ticker" == e && (l.css("-" + r.cssPrefix + "-transition-timing-function", "linear"), l.css(r.animProp, s), l.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                        l.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), k(n.resetValue, "reset", 0), F()
                    }))
                } else {
                    var a = {};
                    a[r.animProp] = t, "slide" == e ? l.animate(a, i, r.settings.easing, function() {
                        P()
                    }) : "reset" == e ? l.css(r.animProp, t) : "ticker" == e && l.animate(a, speed, "linear", function() {
                        k(n.resetValue, "reset", 0), F()
                    })
                }
            },
            x = function() {
                for (var e = "", i = b(), n = 0; i > n; n++) {
                    var s = "";
                    r.settings.buildPager && t.isFunction(r.settings.buildPager) ? (s = r.settings.buildPager(n), r.pagerEl.addClass("bx-custom-pager")) : (s = n + 1, r.pagerEl.addClass("bx-default-pager")), e += '<div class="bx-pager-item"><a href="" data-slide-index="' + n + '" class="bx-pager-link">' + s + "</a></div>"
                }
                r.pagerEl.html(e)
            },
            D = function() {
                r.settings.pagerCustom ? r.pagerEl = t(r.settings.pagerCustom) : (r.pagerEl = t('<div class="bx-pager" />'), r.settings.pagerSelector ? t(r.settings.pagerSelector).html(r.pagerEl) : r.controls.el.addClass("bx-has-pager").append(r.pagerEl), x()), r.pagerEl.on("click", "a", E)
            },
            C = function() {
                r.controls.next = t('<a class="bx-next" href="">' + r.settings.nextText + "</a>"), r.controls.prev = t('<a class="bx-prev" href="">' + r.settings.prevText + "</a>"), r.controls.next.bind("click", M), r.controls.prev.bind("click", I), r.settings.nextSelector && t(r.settings.nextSelector).append(r.controls.next), r.settings.prevSelector && t(r.settings.prevSelector).append(r.controls.prev), r.settings.nextSelector || r.settings.prevSelector || (r.controls.directionEl = t('<div class="bx-controls-direction" />'), r.controls.directionEl.append(r.controls.prev).append(r.controls.next), r.controls.el.addClass("bx-has-controls-direction").append(r.controls.directionEl))
            },
            S = function() {
                r.controls.start = t('<div class="bx-controls-auto-item"><a class="bx-start" href="">' + r.settings.startText + "</a></div>"), r.controls.stop = t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">' + r.settings.stopText + "</a></div>"), r.controls.autoEl = t('<div class="bx-controls-auto" />'), r.controls.autoEl.on("click", ".bx-start", N), r.controls.autoEl.on("click", ".bx-stop", $), r.settings.autoControlsCombine ? r.controls.autoEl.append(r.controls.start) : r.controls.autoEl.append(r.controls.start).append(r.controls.stop), r.settings.autoControlsSelector ? t(r.settings.autoControlsSelector).html(r.controls.autoEl) : r.controls.el.addClass("bx-has-controls-auto").append(r.controls.autoEl), O(r.settings.autoStart ? "stop" : "start")
            },
            T = function() {
                r.children.each(function() {
                    var e = t(this).find("img:first").attr("title");
                    void 0 != e && ("" + e).length && t(this).append('<div class="bx-caption"><span>' + e + "</span></div>")
                })
            },
            M = function(t) {
                r.settings.auto && l.stopAuto(), l.goToNextSlide(), t.preventDefault()
            },
            I = function(t) {
                r.settings.auto && l.stopAuto(), l.goToPrevSlide(), t.preventDefault()
            },
            N = function(t) {
                l.startAuto(), t.preventDefault()
            },
            $ = function(t) {
                l.stopAuto(), t.preventDefault()
            },
            E = function(e) {
                r.settings.auto && l.stopAuto();
                var i = t(e.currentTarget);
                if (void 0 !== i.attr("data-slide-index")) {
                    var n = parseInt(i.attr("data-slide-index"));
                    n != r.active.index && l.goToSlide(n), e.preventDefault()
                }
            },
            A = function(e) {
                var i = r.children.length;
                return "short" == r.settings.pagerType ? (r.settings.maxSlides > 1 && (i = Math.ceil(r.children.length / r.settings.maxSlides)), void r.pagerEl.html(e + 1 + r.settings.pagerShortSeparator + i)) : (r.pagerEl.find("a").removeClass("active"), void r.pagerEl.each(function(i, n) {
                    t(n).find("a").eq(e).addClass("active")
                }))
            },
            P = function() {
                if (r.settings.infiniteLoop) {
                    var t = "";
                    0 == r.active.index ? t = r.children.eq(0).position() : r.active.index == b() - 1 && r.carousel ? t = r.children.eq((b() - 1) * y()).position() : r.active.index == r.children.length - 1 && (t = r.children.eq(r.children.length - 1).position()), t && ("horizontal" == r.settings.mode ? k(-t.left, "reset", 0) : "vertical" == r.settings.mode && k(-t.top, "reset", 0))
                }
                var e = r.children.eq(r.active.index);
                r.children.removeClass("active"), e.addClass("active");
                var i = o(e);
                i && setTimeout(function() {
                    a(e)
                }, i), r.working = !1, r.settings.onSlideAfter(r.children.eq(r.active.index), r.oldIndex, r.active.index)
            },
            O = function(t) {
                r.settings.autoControlsCombine ? r.controls.autoEl.html(r.controls[t]) : (r.controls.autoEl.find("a").removeClass("active"), r.controls.autoEl.find("a:not(.bx-" + t + ")").addClass("active"))
            },
            j = function() {
                1 == b() ? (r.controls.prev.addClass("disabled"), r.controls.next.addClass("disabled")) : !r.settings.infiniteLoop && r.settings.hideControlOnEnd && (0 == r.active.index ? (r.controls.prev.addClass("disabled"), r.controls.next.removeClass("disabled")) : r.active.index == b() - 1 ? (r.controls.next.addClass("disabled"), r.controls.prev.removeClass("disabled")) : (r.controls.prev.removeClass("disabled"), r.controls.next.removeClass("disabled")))
            },
            W = function() {
                if (r.settings.autoDelay > 0) {
                    setTimeout(l.startAuto, r.settings.autoDelay)
                } else l.startAuto();
                r.settings.autoHover && l.hover(function() {
                    r.interval && (l.stopAuto(!0), r.autoPaused = !0)
                }, function() {
                    r.autoPaused && (l.startAuto(!0), r.autoPaused = null)
                })
            },
            z = function() {
                var e = 0;
                if ("next" == r.settings.autoDirection) l.append(r.children.clone().addClass("bx-clone"));
                else {
                    l.prepend(r.children.clone().addClass("bx-clone"));
                    var i = r.children.first().position();
                    e = "horizontal" == r.settings.mode ? -i.left : -i.top
                }
                k(e, "reset", 0), r.settings.pager = !1, r.settings.controls = !1, r.settings.autoControls = !1, r.settings.tickerHover && !r.usingCSS && r.viewport.hover(function() {
                    l.stop()
                }, function() {
                    var e = 0;
                    r.children.each(function() {
                        e += "horizontal" == r.settings.mode ? t(this).outerWidth(!0) : t(this).outerHeight(!0)
                    });
                    var i = r.settings.speed / e,
                        n = "horizontal" == r.settings.mode ? "left" : "top",
                        s = i * (e - Math.abs(parseInt(l.css(n))));
                    F(s)
                }), F()
            },
            F = function(t) {
                speed = t ? t : r.settings.speed;
                var e = {
                        left: 0,
                        top: 0
                    },
                    i = {
                        left: 0,
                        top: 0
                    };
                "next" == r.settings.autoDirection ? e = l.find(".bx-clone").first().position() : i = r.children.first().position();
                var n = "horizontal" == r.settings.mode ? -e.left : -e.top,
                    s = "horizontal" == r.settings.mode ? -i.left : -i.top,
                    a = {
                        resetValue: s
                    };
                k(n, "ticker", speed, a)
            },
            R = function() {
                r.touch = {
                    start: {
                        x: 0,
                        y: 0
                    },
                    end: {
                        x: 0,
                        y: 0
                    }
                }, r.viewport.bind("touchstart", L)
            },
            L = function(t) {
                if (r.working) t.preventDefault();
                else {
                    r.touch.originalPos = l.position();
                    var e = t.originalEvent;
                    r.touch.start.x = e.changedTouches[0].pageX, r.touch.start.y = e.changedTouches[0].pageY, r.viewport.bind("touchmove", H), r.viewport.bind("touchend", Y)
                }
            },
            H = function(t) {
                var e = t.originalEvent,
                    i = Math.abs(e.changedTouches[0].pageX - r.touch.start.x),
                    n = Math.abs(e.changedTouches[0].pageY - r.touch.start.y);
                if (3 * i > n && r.settings.preventDefaultSwipeX ? t.preventDefault() : 3 * n > i && r.settings.preventDefaultSwipeY && t.preventDefault(), "fade" != r.settings.mode && r.settings.oneToOneTouch) {
                    var s = 0;
                    if ("horizontal" == r.settings.mode) {
                        var a = e.changedTouches[0].pageX - r.touch.start.x;
                        s = r.touch.originalPos.left + a
                    } else {
                        var a = e.changedTouches[0].pageY - r.touch.start.y;
                        s = r.touch.originalPos.top + a
                    }
                    k(s, "reset", 0)
                }
            },
            Y = function(t) {
                r.viewport.unbind("touchmove", H);
                var e = t.originalEvent,
                    i = 0;
                if (r.touch.end.x = e.changedTouches[0].pageX, r.touch.end.y = e.changedTouches[0].pageY, "fade" == r.settings.mode) {
                    var n = Math.abs(r.touch.start.x - r.touch.end.x);
                    n >= r.settings.swipeThreshold && (r.touch.start.x > r.touch.end.x ? l.goToNextSlide() : l.goToPrevSlide(), l.stopAuto())
                } else {
                    var n = 0;
                    "horizontal" == r.settings.mode ? (n = r.touch.end.x - r.touch.start.x, i = r.touch.originalPos.left) : (n = r.touch.end.y - r.touch.start.y, i = r.touch.originalPos.top), !r.settings.infiniteLoop && (0 == r.active.index && n > 0 || r.active.last && 0 > n) ? k(i, "reset", 200) : Math.abs(n) >= r.settings.swipeThreshold ? (0 > n ? l.goToNextSlide() : l.goToPrevSlide(), l.stopAuto()) : k(i, "reset", 200)
                }
                r.viewport.unbind("touchend", Y)
            },
            U = function() {
                if (r.initialized) {
                    var e = t(window).width(),
                        i = t(window).height();
                    (d != e || c != i) && (d = e, c = i, l.redrawSlider(), r.settings.onSliderResize.call(l, r.active.index))
                }
            };
        return l.goToSlide = function(e, i) {
            if (!r.working && r.active.index != e)
                if (r.working = !0, r.oldIndex = r.active.index, r.active.index = 0 > e ? b() - 1 : e >= b() ? 0 : e, r.settings.onSlideBefore(r.children.eq(r.active.index), r.oldIndex, r.active.index), "next" == i ? r.settings.onSlideNext(r.children.eq(r.active.index), r.oldIndex, r.active.index) : "prev" == i && r.settings.onSlidePrev(r.children.eq(r.active.index), r.oldIndex, r.active.index), r.active.last = r.active.index >= b() - 1, r.settings.pager && A(r.active.index), r.settings.controls && j(), "fade" == r.settings.mode) r.settings.adaptiveHeight && r.viewport.height() != f() && r.viewport.animate({
                    height: f()
                }, r.settings.adaptiveHeightSpeed), r.children.filter(":visible").fadeOut(r.settings.speed).css({
                    zIndex: 0
                }), r.children.eq(r.active.index).css("zIndex", r.settings.slideZIndex + 1).fadeIn(r.settings.speed, function() {
                    t(this).css("zIndex", r.settings.slideZIndex), P()
                });
                else {
                    r.settings.adaptiveHeight && r.viewport.height() != f() && r.viewport.animate({
                        height: f()
                    }, r.settings.adaptiveHeightSpeed);
                    var n = 0,
                        s = {
                            left: 0,
                            top: 0
                        };
                    if (!r.settings.infiniteLoop && r.carousel && r.active.last)
                        if ("horizontal" == r.settings.mode) {
                            var a = r.children.eq(r.children.length - 1);
                            s = a.position(), n = r.viewport.width() - a.outerWidth()
                        } else {
                            var o = r.children.length - r.settings.minSlides;
                            s = r.children.eq(o).position()
                        } else if (r.carousel && r.active.last && "prev" == i) {
                        var d = 1 == r.settings.moveSlides ? r.settings.maxSlides - y() : (b() - 1) * y() - (r.children.length - r.settings.maxSlides),
                            a = l.children(".bx-clone").eq(d);
                        s = a.position()
                    } else if ("next" == i && 0 == r.active.index) s = l.find("> .bx-clone").eq(r.settings.maxSlides).position(), r.active.last = !1;
                    else if (e >= 0) {
                        var c = e * y();
                        s = r.children.eq(c).position()
                    }
                    if ("undefined" != typeof s) {
                        var h = "horizontal" == r.settings.mode ? -(s.left - n) : -s.top;
                        k(h, "slide", r.settings.speed)
                    }
                }
        }, l.goToNextSlide = function() {
            if (r.settings.infiniteLoop || !r.active.last) {
                var t = parseInt(r.active.index) + 1;
                l.goToSlide(t, "next")
            }
        }, l.goToPrevSlide = function() {
            if (r.settings.infiniteLoop || 0 != r.active.index) {
                var t = parseInt(r.active.index) - 1;
                l.goToSlide(t, "prev")
            }
        }, l.startAuto = function(t) {
            r.interval || (r.interval = setInterval(function() {
                "next" == r.settings.autoDirection ? l.goToNextSlide() : l.goToPrevSlide()
            }, r.settings.pause), r.settings.autoControls && 1 != t && O("stop"))
        }, l.stopAuto = function(t) {
            r.interval && (clearInterval(r.interval), r.interval = null, r.settings.autoControls && 1 != t && O("start"))
        }, l.getCurrentSlide = function() {
            return r.active.index
        }, l.getCurrentSlideElement = function() {
            return r.children.eq(r.active.index)
        }, l.getSlideCount = function() {
            return r.children.length
        }, l.redrawSlider = function() {
            r.children.add(l.find(".bx-clone")).width(v()), r.viewport.css("height", f()), r.settings.ticker || w(), r.active.last && (r.active.index = b() - 1), r.active.index >= b() && (r.active.last = !0), r.settings.pager && !r.settings.pagerCustom && (x(), A(r.active.index))
        }, l.destroySlider = function() {
            r.initialized && (r.initialized = !1, t(".bx-clone", this).remove(), r.children.each(function() {
                void 0 != t(this).data("origStyle") ? t(this).attr("style", t(this).data("origStyle")) : t(this).removeAttr("style")
            }), void 0 != t(this).data("origStyle") ? this.attr("style", t(this).data("origStyle")) : t(this).removeAttr("style"), t(this).unwrap().unwrap(), r.controls.el && r.controls.el.remove(), r.controls.next && r.controls.next.remove(), r.controls.prev && r.controls.prev.remove(), r.settings.pagerCustom || r.pagerEl && r.settings.controls && r.pagerEl.remove(), t(".bx-caption", this).remove(), r.controls.autoEl && r.controls.autoEl.remove(), clearInterval(r.interval), r.settings.responsive && t(window).unbind("resize", U))
        }, l.reloadSlider = function(t) {
            void 0 != t && (s = t), l.destroySlider(), h()
        }, t(window).resize(function() {
            r.settings.autoReload && l.reloadSlider()
        }), h(), this
    }
}(jQuery);
var bxSliders = {};
callBxSlider(),
    function(t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
    }(function(t) {
        function e(e, n) {
            var s, a, o, r = e.nodeName.toLowerCase();
            return "area" === r ? (s = e.parentNode, a = s.name, e.href && a && "map" === s.nodeName.toLowerCase() ? (o = t("img[usemap='#" + a + "']")[0], !!o && i(o)) : !1) : (/input|select|textarea|button|object/.test(r) ? !e.disabled : "a" === r ? e.href || n : n) && i(e)
        }

        function i(e) {
            return t.expr.filters.visible(e) && !t(e).parents().addBack().filter(function() {
                return "hidden" === t.css(this, "visibility")
            }).length
        }

        function n(t) {
            for (var e, i; t.length && t[0] !== document;) {
                if (e = t.css("position"), ("absolute" === e || "relative" === e || "fixed" === e) && (i = parseInt(t.css("zIndex"), 10), !isNaN(i) && 0 !== i)) return i;
                t = t.parent()
            }
            return 0
        }

        function s() {
            this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
                closeText: "Done",
                prevText: "Prev",
                nextText: "Next",
                currentText: "Today",
                monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                weekHeader: "Wk",
                dateFormat: "mm/dd/yy",
                firstDay: 0,
                isRTL: !1,
                showMonthAfterYear: !1,
                yearSuffix: ""
            }, this._defaults = {
                showOn: "focus",
                showAnim: "fadeIn",
                showOptions: {},
                defaultDate: null,
                appendText: "",
                buttonText: "...",
                buttonImage: "",
                buttonImageOnly: !1,
                hideIfNoPrevNext: !1,
                navigationAsDateFormat: !1,
                gotoCurrent: !1,
                changeMonth: !1,
                changeYear: !1,
                yearRange: "c-10:c+10",
                showOtherMonths: !1,
                selectOtherMonths: !1,
                showWeek: !1,
                calculateWeek: this.iso8601Week,
                shortYearCutoff: "+10",
                minDate: null,
                maxDate: null,
                duration: "fast",
                beforeShowDay: null,
                beforeShow: null,
                onSelect: null,
                onChangeMonthYear: null,
                onClose: null,
                numberOfMonths: 1,
                showCurrentAtPos: 0,
                stepMonths: 1,
                stepBigMonths: 12,
                altField: "",
                altFormat: "",
                constrainInput: !0,
                showButtonPanel: !1,
                autoSize: !1,
                disabled: !1
            }, t.extend(this._defaults, this.regional[""]), this.regional.en = t.extend(!0, {}, this.regional[""]), this.regional["en-US"] = t.extend(!0, {}, this.regional.en), this.dpDiv = a(t("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))
        }

        function a(e) {
            var i = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
            return e.delegate(i, "mouseout", function() {
                t(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).removeClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).removeClass("ui-datepicker-next-hover")
            }).delegate(i, "mouseover", o)
        }

        function o() {
            t.datepicker._isDisabledDatepicker(h.inline ? h.dpDiv.parent()[0] : h.input[0]) || (t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), t(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).addClass("ui-datepicker-next-hover"))
        }

        function r(e, i) {
            t.extend(e, i);
            for (var n in i) null == i[n] && (e[n] = i[n]);
            return e
        }
        t.ui = t.ui || {}, t.extend(t.ui, {
            version: "1.11.2",
            keyCode: {
                BACKSPACE: 8,
                COMMA: 188,
                DELETE: 46,
                DOWN: 40,
                END: 35,
                ENTER: 13,
                ESCAPE: 27,
                HOME: 36,
                LEFT: 37,
                PAGE_DOWN: 34,
                PAGE_UP: 33,
                PERIOD: 190,
                RIGHT: 39,
                SPACE: 32,
                TAB: 9,
                UP: 38
            }
        }), t.fn.extend({
            scrollParent: function(e) {
                var i = this.css("position"),
                    n = "absolute" === i,
                    s = e ? /(auto|scroll|hidden)/ : /(auto|scroll)/,
                    a = this.parents().filter(function() {
                        var e = t(this);
                        return n && "static" === e.css("position") ? !1 : s.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"))
                    }).eq(0);
                return "fixed" !== i && a.length ? a : t(this[0].ownerDocument || document)
            },
            uniqueId: function() {
                var t = 0;
                return function() {
                    return this.each(function() {
                        this.id || (this.id = "ui-id-" + ++t)
                    })
                }
            }(),
            removeUniqueId: function() {
                return this.each(function() {
                    /^ui-id-\d+$/.test(this.id) && t(this).removeAttr("id")
                })
            }
        }), t.extend(t.expr[":"], {
            data: t.expr.createPseudo ? t.expr.createPseudo(function(e) {
                return function(i) {
                    return !!t.data(i, e)
                }
            }) : function(e, i, n) {
                return !!t.data(e, n[3])
            },
            focusable: function(i) {
                return e(i, !isNaN(t.attr(i, "tabindex")))
            },
            tabbable: function(i) {
                var n = t.attr(i, "tabindex"),
                    s = isNaN(n);
                return (s || n >= 0) && e(i, !s)
            }
        }), t("<a>").outerWidth(1).jquery || t.each(["Width", "Height"], function(e, i) {
            function n(e, i, n, a) {
                return t.each(s, function() {
                    i -= parseFloat(t.css(e, "padding" + this)) || 0, n && (i -= parseFloat(t.css(e, "border" + this + "Width")) || 0), a && (i -= parseFloat(t.css(e, "margin" + this)) || 0)
                }), i
            }
            var s = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
                a = i.toLowerCase(),
                o = {
                    innerWidth: t.fn.innerWidth,
                    innerHeight: t.fn.innerHeight,
                    outerWidth: t.fn.outerWidth,

                    outerHeight: t.fn.outerHeight
                };
            t.fn["inner" + i] = function(e) {
                return void 0 === e ? o["inner" + i].call(this) : this.each(function() {
                    t(this).css(a, n(this, e) + "px")
                })
            }, t.fn["outer" + i] = function(e, s) {
                return "number" != typeof e ? o["outer" + i].call(this, e) : this.each(function() {
                    t(this).css(a, n(this, e, !0, s) + "px")
                })
            }
        }), t.fn.addBack || (t.fn.addBack = function(t) {
            return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
        }), t("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (t.fn.removeData = function(e) {
            return function(i) {
                return arguments.length ? e.call(this, t.camelCase(i)) : e.call(this)
            }
        }(t.fn.removeData)), t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), t.fn.extend({
            focus: function(e) {
                return function(i, n) {
                    return "number" == typeof i ? this.each(function() {
                        var e = this;
                        setTimeout(function() {
                            t(e).focus(), n && n.call(e)
                        }, i)
                    }) : e.apply(this, arguments)
                }
            }(t.fn.focus),
            disableSelection: function() {
                var t = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
                return function() {
                    return this.bind(t + ".ui-disableSelection", function(t) {
                        t.preventDefault()
                    })
                }
            }(),
            enableSelection: function() {
                return this.unbind(".ui-disableSelection")
            },
            zIndex: function(e) {
                if (void 0 !== e) return this.css("zIndex", e);
                if (this.length)
                    for (var i, n, s = t(this[0]); s.length && s[0] !== document;) {
                        if (i = s.css("position"), ("absolute" === i || "relative" === i || "fixed" === i) && (n = parseInt(s.css("zIndex"), 10), !isNaN(n) && 0 !== n)) return n;
                        s = s.parent()
                    }
                return 0
            }
        }), t.ui.plugin = {
            add: function(e, i, n) {
                var s, a = t.ui[e].prototype;
                for (s in n) a.plugins[s] = a.plugins[s] || [], a.plugins[s].push([i, n[s]])
            },
            call: function(t, e, i, n) {
                var s, a = t.plugins[e];
                if (a && (n || t.element[0].parentNode && 11 !== t.element[0].parentNode.nodeType))
                    for (s = 0; a.length > s; s++) t.options[a[s][0]] && a[s][1].apply(t.element, i)
            }
        };
        var l = 0,
            d = Array.prototype.slice;
        t.cleanData = function(e) {
            return function(i) {
                var n, s, a;
                for (a = 0; null != (s = i[a]); a++) try {
                    n = t._data(s, "events"), n && n.remove && t(s).triggerHandler("remove")
                } catch (o) {}
                e(i)
            }
        }(t.cleanData), t.widget = function(e, i, n) {
            var s, a, o, r, l = {},
                d = e.split(".")[0];
            return e = e.split(".")[1], s = d + "-" + e, n || (n = i, i = t.Widget), t.expr[":"][s.toLowerCase()] = function(e) {
                return !!t.data(e, s)
            }, t[d] = t[d] || {}, a = t[d][e], o = t[d][e] = function(t, e) {
                return this._createWidget ? void(arguments.length && this._createWidget(t, e)) : new o(t, e)
            }, t.extend(o, a, {
                version: n.version,
                _proto: t.extend({}, n),
                _childConstructors: []
            }), r = new i, r.options = t.widget.extend({}, r.options), t.each(n, function(e, n) {
                return t.isFunction(n) ? void(l[e] = function() {
                    var t = function() {
                            return i.prototype[e].apply(this, arguments)
                        },
                        s = function(t) {
                            return i.prototype[e].apply(this, t)
                        };
                    return function() {
                        var e, i = this._super,
                            a = this._superApply;
                        return this._super = t, this._superApply = s, e = n.apply(this, arguments), this._super = i, this._superApply = a, e
                    }
                }()) : void(l[e] = n)
            }), o.prototype = t.widget.extend(r, {
                widgetEventPrefix: a ? r.widgetEventPrefix || e : e
            }, l, {
                constructor: o,
                namespace: d,
                widgetName: e,
                widgetFullName: s
            }), a ? (t.each(a._childConstructors, function(e, i) {
                var n = i.prototype;
                t.widget(n.namespace + "." + n.widgetName, o, i._proto)
            }), delete a._childConstructors) : i._childConstructors.push(o), t.widget.bridge(e, o), o
        }, t.widget.extend = function(e) {
            for (var i, n, s = d.call(arguments, 1), a = 0, o = s.length; o > a; a++)
                for (i in s[a]) n = s[a][i], s[a].hasOwnProperty(i) && void 0 !== n && (e[i] = t.isPlainObject(n) ? t.isPlainObject(e[i]) ? t.widget.extend({}, e[i], n) : t.widget.extend({}, n) : n);
            return e
        }, t.widget.bridge = function(e, i) {
            var n = i.prototype.widgetFullName || e;
            t.fn[e] = function(s) {
                var a = "string" == typeof s,
                    o = d.call(arguments, 1),
                    r = this;
                return s = !a && o.length ? t.widget.extend.apply(null, [s].concat(o)) : s, this.each(a ? function() {
                    var i, a = t.data(this, n);
                    return "instance" === s ? (r = a, !1) : a ? t.isFunction(a[s]) && "_" !== s.charAt(0) ? (i = a[s].apply(a, o), i !== a && void 0 !== i ? (r = i && i.jquery ? r.pushStack(i.get()) : i, !1) : void 0) : t.error("no such method '" + s + "' for " + e + " widget instance") : t.error("cannot call methods on " + e + " prior to initialization; attempted to call method '" + s + "'")
                } : function() {
                    var e = t.data(this, n);
                    e ? (e.option(s || {}), e._init && e._init()) : t.data(this, n, new i(s, this))
                }), r
            }
        }, t.Widget = function() {}, t.Widget._childConstructors = [], t.Widget.prototype = {
            widgetName: "widget",
            widgetEventPrefix: "",
            defaultElement: "<div>",
            options: {
                disabled: !1,
                create: null
            },
            _createWidget: function(e, i) {
                i = t(i || this.defaultElement || this)[0], this.element = t(i), this.uuid = l++, this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = t(), this.hoverable = t(), this.focusable = t(), i !== this && (t.data(i, this.widgetFullName, this), this._on(!0, this.element, {
                    remove: function(t) {
                        t.target === i && this.destroy()
                    }
                }), this.document = t(i.style ? i.ownerDocument : i.document || i), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)), this.options = t.widget.extend({}, this.options, this._getCreateOptions(), e), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init()
            },
            _getCreateOptions: t.noop,
            _getCreateEventData: t.noop,
            _create: t.noop,
            _init: t.noop,
            destroy: function() {
                this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(t.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")
            },
            _destroy: t.noop,
            widget: function() {
                return this.element
            },
            option: function(e, i) {
                var n, s, a, o = e;
                if (0 === arguments.length) return t.widget.extend({}, this.options);
                if ("string" == typeof e)
                    if (o = {}, n = e.split("."), e = n.shift(), n.length) {
                        for (s = o[e] = t.widget.extend({}, this.options[e]), a = 0; n.length - 1 > a; a++) s[n[a]] = s[n[a]] || {}, s = s[n[a]];
                        if (e = n.pop(), 1 === arguments.length) return void 0 === s[e] ? null : s[e];
                        s[e] = i
                    } else {
                        if (1 === arguments.length) return void 0 === this.options[e] ? null : this.options[e];
                        o[e] = i
                    }
                return this._setOptions(o), this
            },
            _setOptions: function(t) {
                var e;
                for (e in t) this._setOption(e, t[e]);
                return this
            },
            _setOption: function(t, e) {
                return this.options[t] = e, "disabled" === t && (this.widget().toggleClass(this.widgetFullName + "-disabled", !!e), e && (this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus"))), this
            },
            enable: function() {
                return this._setOptions({
                    disabled: !1
                })
            },
            disable: function() {
                return this._setOptions({
                    disabled: !0
                })
            },
            _on: function(e, i, n) {
                var s, a = this;
                "boolean" != typeof e && (n = i, i = e, e = !1), n ? (i = s = t(i), this.bindings = this.bindings.add(i)) : (n = i, i = this.element, s = this.widget()), t.each(n, function(n, o) {
                    function r() {
                        return e || a.options.disabled !== !0 && !t(this).hasClass("ui-state-disabled") ? ("string" == typeof o ? a[o] : o).apply(a, arguments) : void 0
                    }
                    "string" != typeof o && (r.guid = o.guid = o.guid || r.guid || t.guid++);
                    var l = n.match(/^([\w:-]*)\s*(.*)$/),
                        d = l[1] + a.eventNamespace,
                        c = l[2];
                    c ? s.delegate(c, d, r) : i.bind(d, r)
                })
            },
            _off: function(e, i) {
                i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, e.unbind(i).undelegate(i), this.bindings = t(this.bindings.not(e).get()), this.focusable = t(this.focusable.not(e).get()), this.hoverable = t(this.hoverable.not(e).get())
            },
            _delay: function(t, e) {
                function i() {
                    return ("string" == typeof t ? n[t] : t).apply(n, arguments)
                }
                var n = this;
                return setTimeout(i, e || 0)
            },
            _hoverable: function(e) {
                this.hoverable = this.hoverable.add(e), this._on(e, {
                    mouseenter: function(e) {
                        t(e.currentTarget).addClass("ui-state-hover")
                    },
                    mouseleave: function(e) {
                        t(e.currentTarget).removeClass("ui-state-hover")
                    }
                })
            },
            _focusable: function(e) {
                this.focusable = this.focusable.add(e), this._on(e, {
                    focusin: function(e) {
                        t(e.currentTarget).addClass("ui-state-focus")
                    },
                    focusout: function(e) {
                        t(e.currentTarget).removeClass("ui-state-focus")
                    }
                })
            },
            _trigger: function(e, i, n) {
                var s, a, o = this.options[e];
                if (n = n || {}, i = t.Event(i), i.type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), i.target = this.element[0], a = i.originalEvent)
                    for (s in a) s in i || (i[s] = a[s]);
                return this.element.trigger(i, n), !(t.isFunction(o) && o.apply(this.element[0], [i].concat(n)) === !1 || i.isDefaultPrevented())
            }
        }, t.each({
            show: "fadeIn",
            hide: "fadeOut"
        }, function(e, i) {
            t.Widget.prototype["_" + e] = function(n, s, a) {
                "string" == typeof s && (s = {
                    effect: s
                });
                var o, r = s ? s === !0 || "number" == typeof s ? i : s.effect || i : e;
                s = s || {}, "number" == typeof s && (s = {
                    duration: s
                }), o = !t.isEmptyObject(s), s.complete = a, s.delay && n.delay(s.delay), o && t.effects && t.effects.effect[r] ? n[e](s) : r !== e && n[r] ? n[r](s.duration, s.easing, a) : n.queue(function(i) {
                    t(this)[e](), a && a.call(n[0]), i()
                })
            }
        }), t.widget;
        var c = !1;
        t(document).mouseup(function() {
                c = !1
            }), t.widget("ui.mouse", {
                version: "1.11.2",
                options: {
                    cancel: "input,textarea,button,select,option",
                    distance: 1,
                    delay: 0
                },
                _mouseInit: function() {
                    var e = this;
                    this.element.bind("mousedown." + this.widgetName, function(t) {
                        return e._mouseDown(t)
                    }).bind("click." + this.widgetName, function(i) {
                        return !0 === t.data(i.target, e.widgetName + ".preventClickEvent") ? (t.removeData(i.target, e.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1) : void 0
                    }), this.started = !1
                },
                _mouseDestroy: function() {
                    this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
                },
                _mouseDown: function(e) {
                    if (!c) {
                        this._mouseMoved = !1, this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
                        var i = this,
                            n = 1 === e.which,
                            s = "string" == typeof this.options.cancel && e.target.nodeName ? t(e.target).closest(this.options.cancel).length : !1;
                        return n && !s && this._mouseCapture(e) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                            i.mouseDelayMet = !0
                        }, this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(e) !== !1, !this._mouseStarted) ? (e.preventDefault(), !0) : (!0 === t.data(e.target, this.widgetName + ".preventClickEvent") && t.removeData(e.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(t) {
                            return i._mouseMove(t)
                        }, this._mouseUpDelegate = function(t) {
                            return i._mouseUp(t)
                        }, this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), e.preventDefault(), c = !0, !0)) : !0
                    }
                },
                _mouseMove: function(e) {
                    if (this._mouseMoved) {
                        if (t.ui.ie && (!document.documentMode || 9 > document.documentMode) && !e.button) return this._mouseUp(e);
                        if (!e.which) return this._mouseUp(e)
                    }
                    return (e.which || e.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(e), e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, e) !== !1, this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted)
                },
                _mouseUp: function(e) {
                    return this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)), c = !1, !1
                },
                _mouseDistanceMet: function(t) {
                    return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance
                },
                _mouseDelayMet: function() {
                    return this.mouseDelayMet
                },
                _mouseStart: function() {},
                _mouseDrag: function() {},
                _mouseStop: function() {},
                _mouseCapture: function() {
                    return !0
                }
            }),
            function() {
                function e(t, e, i) {
                    return [parseFloat(t[0]) * (u.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (u.test(t[1]) ? i / 100 : 1)]
                }

                function i(e, i) {
                    return parseInt(t.css(e, i), 10) || 0
                }

                function n(e) {
                    var i = e[0];
                    return 9 === i.nodeType ? {
                        width: e.width(),
                        height: e.height(),
                        offset: {
                            top: 0,
                            left: 0
                        }
                    } : t.isWindow(i) ? {
                        width: e.width(),
                        height: e.height(),
                        offset: {
                            top: e.scrollTop(),
                            left: e.scrollLeft()
                        }
                    } : i.preventDefault ? {
                        width: 0,
                        height: 0,
                        offset: {
                            top: i.pageY,
                            left: i.pageX
                        }
                    } : {
                        width: e.outerWidth(),
                        height: e.outerHeight(),
                        offset: e.offset()
                    }
                }
                t.ui = t.ui || {};
                var s, a, o = Math.max,
                    r = Math.abs,
                    l = Math.round,
                    d = /left|center|right/,
                    c = /top|center|bottom/,
                    h = /[\+\-]\d+(\.[\d]+)?%?/,
                    p = /^\w+/,
                    u = /%$/,
                    g = t.fn.position;
                t.position = {
                        scrollbarWidth: function() {
                            if (void 0 !== s) return s;
                            var e, i, n = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                                a = n.children()[0];
                            return t("body").append(n), e = a.offsetWidth, n.css("overflow", "scroll"), i = a.offsetWidth, e === i && (i = n[0].clientWidth), n.remove(), s = e - i
                        },
                        getScrollInfo: function(e) {
                            var i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"),
                                n = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"),
                                s = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth,
                                a = "scroll" === n || "auto" === n && e.height < e.element[0].scrollHeight;
                            return {
                                width: a ? t.position.scrollbarWidth() : 0,
                                height: s ? t.position.scrollbarWidth() : 0
                            }
                        },
                        getWithinInfo: function(e) {
                            var i = t(e || window),
                                n = t.isWindow(i[0]),
                                s = !!i[0] && 9 === i[0].nodeType;
                            return {
                                element: i,
                                isWindow: n,
                                isDocument: s,
                                offset: i.offset() || {
                                    left: 0,
                                    top: 0
                                },
                                scrollLeft: i.scrollLeft(),
                                scrollTop: i.scrollTop(),
                                width: n || s ? i.width() : i.outerWidth(),
                                height: n || s ? i.height() : i.outerHeight()
                            }
                        }
                    }, t.fn.position = function(s) {
                        if (!s || !s.of) return g.apply(this, arguments);
                        s = t.extend({}, s);
                        var u, f, m, v, _, b, y = t(s.of),
                            w = t.position.getWithinInfo(s.within),
                            k = t.position.getScrollInfo(w),
                            x = (s.collision || "flip").split(" "),
                            D = {};
                        return b = n(y), y[0].preventDefault && (s.at = "left top"), f = b.width, m = b.height, v = b.offset, _ = t.extend({}, v), t.each(["my", "at"], function() {
                            var t, e, i = (s[this] || "").split(" ");
                            1 === i.length && (i = d.test(i[0]) ? i.concat(["center"]) : c.test(i[0]) ? ["center"].concat(i) : ["center", "center"]), i[0] = d.test(i[0]) ? i[0] : "center", i[1] = c.test(i[1]) ? i[1] : "center", t = h.exec(i[0]), e = h.exec(i[1]), D[this] = [t ? t[0] : 0, e ? e[0] : 0], s[this] = [p.exec(i[0])[0], p.exec(i[1])[0]]
                        }), 1 === x.length && (x[1] = x[0]), "right" === s.at[0] ? _.left += f : "center" === s.at[0] && (_.left += f / 2), "bottom" === s.at[1] ? _.top += m : "center" === s.at[1] && (_.top += m / 2), u = e(D.at, f, m), _.left += u[0], _.top += u[1], this.each(function() {
                            var n, d, c = t(this),
                                h = c.outerWidth(),
                                p = c.outerHeight(),
                                g = i(this, "marginLeft"),
                                b = i(this, "marginTop"),
                                C = h + g + i(this, "marginRight") + k.width,
                                S = p + b + i(this, "marginBottom") + k.height,
                                T = t.extend({}, _),
                                M = e(D.my, c.outerWidth(), c.outerHeight());
                            "right" === s.my[0] ? T.left -= h : "center" === s.my[0] && (T.left -= h / 2), "bottom" === s.my[1] ? T.top -= p : "center" === s.my[1] && (T.top -= p / 2), T.left += M[0], T.top += M[1], a || (T.left = l(T.left), T.top = l(T.top)), n = {
                                marginLeft: g,
                                marginTop: b
                            }, t.each(["left", "top"], function(e, i) {
                                t.ui.position[x[e]] && t.ui.position[x[e]][i](T, {
                                    targetWidth: f,
                                    targetHeight: m,
                                    elemWidth: h,
                                    elemHeight: p,
                                    collisionPosition: n,
                                    collisionWidth: C,
                                    collisionHeight: S,
                                    offset: [u[0] + M[0], u[1] + M[1]],
                                    my: s.my,
                                    at: s.at,
                                    within: w,
                                    elem: c
                                })
                            }), s.using && (d = function(t) {
                                var e = v.left - T.left,
                                    i = e + f - h,
                                    n = v.top - T.top,
                                    a = n + m - p,
                                    l = {
                                        target: {
                                            element: y,
                                            left: v.left,
                                            top: v.top,
                                            width: f,
                                            height: m
                                        },
                                        element: {
                                            element: c,
                                            left: T.left,
                                            top: T.top,
                                            width: h,
                                            height: p
                                        },
                                        horizontal: 0 > i ? "left" : e > 0 ? "right" : "center",
                                        vertical: 0 > a ? "top" : n > 0 ? "bottom" : "middle"
                                    };
                                h > f && f > r(e + i) && (l.horizontal = "center"), p > m && m > r(n + a) && (l.vertical = "middle"), l.important = o(r(e), r(i)) > o(r(n), r(a)) ? "horizontal" : "vertical", s.using.call(this, t, l)
                            }), c.offset(t.extend(T, {
                                using: d
                            }))
                        })
                    }, t.ui.position = {
                        fit: {
                            left: function(t, e) {
                                var i, n = e.within,
                                    s = n.isWindow ? n.scrollLeft : n.offset.left,
                                    a = n.width,
                                    r = t.left - e.collisionPosition.marginLeft,
                                    l = s - r,
                                    d = r + e.collisionWidth - a - s;
                                e.collisionWidth > a ? l > 0 && 0 >= d ? (i = t.left + l + e.collisionWidth - a - s, t.left += l - i) : t.left = d > 0 && 0 >= l ? s : l > d ? s + a - e.collisionWidth : s : l > 0 ? t.left += l : d > 0 ? t.left -= d : t.left = o(t.left - r, t.left)
                            },
                            top: function(t, e) {
                                var i, n = e.within,
                                    s = n.isWindow ? n.scrollTop : n.offset.top,
                                    a = e.within.height,
                                    r = t.top - e.collisionPosition.marginTop,
                                    l = s - r,
                                    d = r + e.collisionHeight - a - s;
                                e.collisionHeight > a ? l > 0 && 0 >= d ? (i = t.top + l + e.collisionHeight - a - s, t.top += l - i) : t.top = d > 0 && 0 >= l ? s : l > d ? s + a - e.collisionHeight : s : l > 0 ? t.top += l : d > 0 ? t.top -= d : t.top = o(t.top - r, t.top)
                            }
                        },
                        flip: {
                            left: function(t, e) {
                                var i, n, s = e.within,
                                    a = s.offset.left + s.scrollLeft,
                                    o = s.width,
                                    l = s.isWindow ? s.scrollLeft : s.offset.left,
                                    d = t.left - e.collisionPosition.marginLeft,
                                    c = d - l,
                                    h = d + e.collisionWidth - o - l,
                                    p = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0,
                                    u = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0,
                                    g = -2 * e.offset[0];
                                0 > c ? (i = t.left + p + u + g + e.collisionWidth - o - a, (0 > i || r(c) > i) && (t.left += p + u + g)) : h > 0 && (n = t.left - e.collisionPosition.marginLeft + p + u + g - l, (n > 0 || h > r(n)) && (t.left += p + u + g))
                            },
                            top: function(t, e) {
                                var i, n, s = e.within,
                                    a = s.offset.top + s.scrollTop,
                                    o = s.height,
                                    l = s.isWindow ? s.scrollTop : s.offset.top,
                                    d = t.top - e.collisionPosition.marginTop,
                                    c = d - l,
                                    h = d + e.collisionHeight - o - l,
                                    p = "top" === e.my[1],
                                    u = p ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0,
                                    g = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0,
                                    f = -2 * e.offset[1];
                                0 > c ? (n = t.top + u + g + f + e.collisionHeight - o - a, t.top + u + g + f > c && (0 > n || r(c) > n) && (t.top += u + g + f)) : h > 0 && (i = t.top - e.collisionPosition.marginTop + u + g + f - l, t.top + u + g + f > h && (i > 0 || h > r(i)) && (t.top += u + g + f))
                            }
                        },
                        flipfit: {
                            left: function() {
                                t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments)
                            },
                            top: function() {
                                t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments)
                            }
                        }
                    },
                    function() {
                        var e, i, n, s, o, r = document.getElementsByTagName("body")[0],
                            l = document.createElement("div");
                        e = document.createElement(r ? "div" : "body"), n = {
                            visibility: "hidden",
                            width: 0,
                            height: 0,
                            border: 0,
                            margin: 0,
                            background: "none"
                        }, r && t.extend(n, {
                            position: "absolute",
                            left: "-1000px",
                            top: "-1000px"
                        });
                        for (o in n) e.style[o] = n[o];
                        e.appendChild(l), i = r || document.documentElement, i.insertBefore(e, i.firstChild), l.style.cssText = "position: absolute; left: 10.7432222px;", s = t(l).offset().left, a = s > 10 && 11 > s, e.innerHTML = "", i.removeChild(e)
                    }()
            }(), t.ui.position, t.extend(t.ui, {
                datepicker: {
                    version: "1.11.2"
                }
            });
        var h;
        t.extend(s.prototype, {
            markerClassName: "hasDatepicker",
            maxRows: 4,
            _widgetDatepicker: function() {
                return this.dpDiv
            },
            setDefaults: function(t) {
                return r(this._defaults, t || {}), this
            },
            _attachDatepicker: function(e, i) {
                var n, s, a;
                n = e.nodeName.toLowerCase(), s = "div" === n || "span" === n, e.id || (this.uuid += 1, e.id = "dp" + this.uuid), a = this._newInst(t(e), s), a.settings = t.extend({}, i || {}), "input" === n ? this._connectDatepicker(e, a) : s && this._inlineDatepicker(e, a)
            },
            _newInst: function(e, i) {
                var n = e[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1");
                return {
                    id: n,
                    input: e,
                    selectedDay: 0,
                    selectedMonth: 0,
                    selectedYear: 0,
                    drawMonth: 0,
                    drawYear: 0,
                    inline: i,
                    dpDiv: i ? a(t("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
                }
            },
            _connectDatepicker: function(e, i) {
                var n = t(e);
                i.append = t([]), i.trigger = t([]), n.hasClass(this.markerClassName) || (this._attachments(n, i), n.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp), this._autoSize(i), t.data(e, "datepicker", i), i.settings.disabled && this._disableDatepicker(e))
            },
            _attachments: function(e, i) {
                var n, s, a, o = this._get(i, "appendText"),
                    r = this._get(i, "isRTL");
                i.append && i.append.remove(), o && (i.append = t("<span class='" + this._appendClass + "'>" + o + "</span>"), e[r ? "before" : "after"](i.append)), e.unbind("focus", this._showDatepicker), i.trigger && i.trigger.remove(), n = this._get(i, "showOn"), ("focus" === n || "both" === n) && e.focus(this._showDatepicker), ("button" === n || "both" === n) && (s = this._get(i, "buttonText"), a = this._get(i, "buttonImage"), i.trigger = t(this._get(i, "buttonImageOnly") ? t("<img/>").addClass(this._triggerClass).attr({
                    src: a,
                    alt: s,
                    title: s
                }) : t("<button type='button'></button>").addClass(this._triggerClass).html(a ? t("<img/>").attr({
                    src: a,
                    alt: s,
                    title: s
                }) : s)), e[r ? "before" : "after"](i.trigger), i.trigger.click(function() {
                    return t.datepicker._datepickerShowing && t.datepicker._lastInput === e[0] ? t.datepicker._hideDatepicker() : t.datepicker._datepickerShowing && t.datepicker._lastInput !== e[0] ? (t.datepicker._hideDatepicker(), t.datepicker._showDatepicker(e[0])) : t.datepicker._showDatepicker(e[0]), !1
                }))
            },
            _autoSize: function(t) {
                if (this._get(t, "autoSize") && !t.inline) {
                    var e, i, n, s, a = new Date(2009, 11, 20),
                        o = this._get(t, "dateFormat");
                    o.match(/[DM]/) && (e = function(t) {
                        for (i = 0, n = 0, s = 0; t.length > s; s++) t[s].length > i && (i = t[s].length, n = s);
                        return n
                    }, a.setMonth(e(this._get(t, o.match(/MM/) ? "monthNames" : "monthNamesShort"))), a.setDate(e(this._get(t, o.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - a.getDay())), t.input.attr("size", this._formatDate(t, a).length)
                }
            },
            _inlineDatepicker: function(e, i) {
                var n = t(e);
                n.hasClass(this.markerClassName) || (n.addClass(this.markerClassName).append(i.dpDiv), t.data(e, "datepicker", i), this._setDate(i, this._getDefaultDate(i), !0), this._updateDatepicker(i), this._updateAlternate(i), i.settings.disabled && this._disableDatepicker(e), i.dpDiv.css("display", "block"))
            },
            _dialogDatepicker: function(e, i, n, s, a) {
                var o, l, d, c, h, p = this._dialogInst;
                return p || (this.uuid += 1, o = "dp" + this.uuid, this._dialogInput = t("<input type='text' id='" + o + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.keydown(this._doKeyDown), t("body").append(this._dialogInput), p = this._dialogInst = this._newInst(this._dialogInput, !1), p.settings = {}, t.data(this._dialogInput[0], "datepicker", p)), r(p.settings, s || {}), i = i && i.constructor === Date ? this._formatDate(p, i) : i, this._dialogInput.val(i), this._pos = a ? a.length ? a : [a.pageX, a.pageY] : null, this._pos || (l = document.documentElement.clientWidth, d = document.documentElement.clientHeight, c = document.documentElement.scrollLeft || document.body.scrollLeft, h = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [l / 2 - 100 + c, d / 2 - 150 + h]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), p.settings.onSelect = n, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), this._showDatepicker(this._dialogInput[0]), t.blockUI && t.blockUI(this.dpDiv), t.data(this._dialogInput[0], "datepicker", p), this
            },
            _destroyDatepicker: function(e) {
                var i, n = t(e),
                    s = t.data(e, "datepicker");
                n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), t.removeData(e, "datepicker"), "input" === i ? (s.append.remove(), s.trigger.remove(), n.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp)) : ("div" === i || "span" === i) && n.removeClass(this.markerClassName).empty())
            },
            _enableDatepicker: function(e) {
                var i, n, s = t(e),
                    a = t.data(e, "datepicker");
                s.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !1, a.trigger.filter("button").each(function() {
                    this.disabled = !1
                }).end().filter("img").css({
                    opacity: "1.0",
                    cursor: ""
                })) : ("div" === i || "span" === i) && (n = s.children("." + this._inlineClass), n.children().removeClass("ui-state-disabled"), n.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = t.map(this._disabledInputs, function(t) {
                    return t === e ? null : t
                }))
            },
            _disableDatepicker: function(e) {
                var i, n, s = t(e),
                    a = t.data(e, "datepicker");
                s.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !0, a.trigger.filter("button").each(function() {
                    this.disabled = !0
                }).end().filter("img").css({
                    opacity: "0.5",
                    cursor: "default"
                })) : ("div" === i || "span" === i) && (n = s.children("." + this._inlineClass), n.children().addClass("ui-state-disabled"), n.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = t.map(this._disabledInputs, function(t) {
                    return t === e ? null : t
                }), this._disabledInputs[this._disabledInputs.length] = e)
            },
            _isDisabledDatepicker: function(t) {
                if (!t) return !1;
                for (var e = 0; this._disabledInputs.length > e; e++)
                    if (this._disabledInputs[e] === t) return !0;
                return !1
            },
            _getInst: function(e) {
                try {
                    return t.data(e, "datepicker")
                } catch (i) {

                    throw "Missing instance data for this datepicker"
                }
            },
            _optionDatepicker: function(e, i, n) {
                var s, a, o, l, d = this._getInst(e);
                return 2 === arguments.length && "string" == typeof i ? "defaults" === i ? t.extend({}, t.datepicker._defaults) : d ? "all" === i ? t.extend({}, d.settings) : this._get(d, i) : null : (s = i || {}, "string" == typeof i && (s = {}, s[i] = n), void(d && (this._curInst === d && this._hideDatepicker(), a = this._getDateDatepicker(e, !0), o = this._getMinMaxDate(d, "min"), l = this._getMinMaxDate(d, "max"), r(d.settings, s), null !== o && void 0 !== s.dateFormat && void 0 === s.minDate && (d.settings.minDate = this._formatDate(d, o)), null !== l && void 0 !== s.dateFormat && void 0 === s.maxDate && (d.settings.maxDate = this._formatDate(d, l)), "disabled" in s && (s.disabled ? this._disableDatepicker(e) : this._enableDatepicker(e)), this._attachments(t(e), d), this._autoSize(d), this._setDate(d, a), this._updateAlternate(d), this._updateDatepicker(d))))
            },
            _changeDatepicker: function(t, e, i) {
                this._optionDatepicker(t, e, i)
            },
            _refreshDatepicker: function(t) {
                var e = this._getInst(t);
                e && this._updateDatepicker(e)
            },
            _setDateDatepicker: function(t, e) {
                var i = this._getInst(t);
                i && (this._setDate(i, e), this._updateDatepicker(i), this._updateAlternate(i))
            },
            _getDateDatepicker: function(t, e) {
                var i = this._getInst(t);
                return i && !i.inline && this._setDateFromField(i, e), i ? this._getDate(i) : null
            },
            _doKeyDown: function(e) {
                var i, n, s, a = t.datepicker._getInst(e.target),
                    o = !0,
                    r = a.dpDiv.is(".ui-datepicker-rtl");
                if (a._keyEvent = !0, t.datepicker._datepickerShowing) switch (e.keyCode) {
                    case 9:
                        t.datepicker._hideDatepicker(), o = !1;
                        break;
                    case 13:
                        return s = t("td." + t.datepicker._dayOverClass + ":not(." + t.datepicker._currentClass + ")", a.dpDiv), s[0] && t.datepicker._selectDay(e.target, a.selectedMonth, a.selectedYear, s[0]), i = t.datepicker._get(a, "onSelect"), i ? (n = t.datepicker._formatDate(a), i.apply(a.input ? a.input[0] : null, [n, a])) : t.datepicker._hideDatepicker(), !1;
                    case 27:
                        t.datepicker._hideDatepicker();
                        break;
                    case 33:
                        t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(a, "stepBigMonths") : -t.datepicker._get(a, "stepMonths"), "M");
                        break;
                    case 34:
                        t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(a, "stepBigMonths") : +t.datepicker._get(a, "stepMonths"), "M");
                        break;
                    case 35:
                        (e.ctrlKey || e.metaKey) && t.datepicker._clearDate(e.target), o = e.ctrlKey || e.metaKey;
                        break;
                    case 36:
                        (e.ctrlKey || e.metaKey) && t.datepicker._gotoToday(e.target), o = e.ctrlKey || e.metaKey;
                        break;
                    case 37:
                        (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? 1 : -1, "D"), o = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(a, "stepBigMonths") : -t.datepicker._get(a, "stepMonths"), "M");
                        break;
                    case 38:
                        (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, -7, "D"), o = e.ctrlKey || e.metaKey;
                        break;
                    case 39:
                        (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? -1 : 1, "D"), o = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(a, "stepBigMonths") : +t.datepicker._get(a, "stepMonths"), "M");
                        break;
                    case 40:
                        (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, 7, "D"), o = e.ctrlKey || e.metaKey;
                        break;
                    default:
                        o = !1
                } else 36 === e.keyCode && e.ctrlKey ? t.datepicker._showDatepicker(this) : o = !1;
                o && (e.preventDefault(), e.stopPropagation())
            },
            _doKeyPress: function(e) {
                var i, n, s = t.datepicker._getInst(e.target);
                return t.datepicker._get(s, "constrainInput") ? (i = t.datepicker._possibleChars(t.datepicker._get(s, "dateFormat")), n = String.fromCharCode(null == e.charCode ? e.keyCode : e.charCode), e.ctrlKey || e.metaKey || " " > n || !i || i.indexOf(n) > -1) : void 0
            },
            _doKeyUp: function(e) {
                var i, n = t.datepicker._getInst(e.target);
                if (n.input.val() !== n.lastVal) try {
                    i = t.datepicker.parseDate(t.datepicker._get(n, "dateFormat"), n.input ? n.input.val() : null, t.datepicker._getFormatConfig(n)), i && (t.datepicker._setDateFromField(n), t.datepicker._updateAlternate(n), t.datepicker._updateDatepicker(n))
                } catch (s) {}
                return !0
            },
            _showDatepicker: function(e) {
                if (e = e.target || e, "input" !== e.nodeName.toLowerCase() && (e = t("input", e.parentNode)[0]), !t.datepicker._isDisabledDatepicker(e) && t.datepicker._lastInput !== e) {
                    var i, s, a, o, l, d, c;
                    i = t.datepicker._getInst(e), t.datepicker._curInst && t.datepicker._curInst !== i && (t.datepicker._curInst.dpDiv.stop(!0, !0), i && t.datepicker._datepickerShowing && t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])), s = t.datepicker._get(i, "beforeShow"), a = s ? s.apply(e, [e, i]) : {}, a !== !1 && (r(i.settings, a), i.lastVal = null, t.datepicker._lastInput = e, t.datepicker._setDateFromField(i), t.datepicker._inDialog && (e.value = ""), t.datepicker._pos || (t.datepicker._pos = t.datepicker._findPos(e), t.datepicker._pos[1] += e.offsetHeight), o = !1, t(e).parents().each(function() {
                        return o |= "fixed" === t(this).css("position"), !o
                    }), l = {
                        left: t.datepicker._pos[0],
                        top: t.datepicker._pos[1]
                    }, t.datepicker._pos = null, i.dpDiv.empty(), i.dpDiv.css({
                        position: "absolute",
                        display: "block",
                        top: "-1000px"
                    }), t.datepicker._updateDatepicker(i), l = t.datepicker._checkOffset(i, l, o), i.dpDiv.css({
                        position: t.datepicker._inDialog && t.blockUI ? "static" : o ? "fixed" : "absolute",
                        display: "none",
                        left: l.left + "px",
                        top: l.top + "px"
                    }), i.inline || (d = t.datepicker._get(i, "showAnim"), c = t.datepicker._get(i, "duration"), i.dpDiv.css("z-index", n(t(e)) + 1), t.datepicker._datepickerShowing = !0, t.effects && t.effects.effect[d] ? i.dpDiv.show(d, t.datepicker._get(i, "showOptions"), c) : i.dpDiv[d || "show"](d ? c : null), t.datepicker._shouldFocusInput(i) && i.input.focus(), t.datepicker._curInst = i))
                }
            },
            _updateDatepicker: function(e) {
                this.maxRows = 4, h = e, e.dpDiv.empty().append(this._generateHTML(e)), this._attachHandlers(e);
                var i, n = this._getNumberOfMonths(e),
                    s = n[1],
                    a = 17,
                    r = e.dpDiv.find("." + this._dayOverClass + " a");
                r.length > 0 && o.apply(r.get(0)), e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), s > 1 && e.dpDiv.addClass("ui-datepicker-multi-" + s).css("width", a * s + "em"), e.dpDiv[(1 !== n[0] || 1 !== n[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), e.dpDiv[(this._get(e, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), e === t.datepicker._curInst && t.datepicker._datepickerShowing && t.datepicker._shouldFocusInput(e) && e.input.focus(), e.yearshtml && (i = e.yearshtml, setTimeout(function() {
                    i === e.yearshtml && e.yearshtml && e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml), i = e.yearshtml = null
                }, 0))
            },
            _shouldFocusInput: function(t) {
                return t.input && t.input.is(":visible") && !t.input.is(":disabled") && !t.input.is(":focus")
            },
            _checkOffset: function(e, i, n) {
                var s = e.dpDiv.outerWidth(),
                    a = e.dpDiv.outerHeight(),
                    o = e.input ? e.input.outerWidth() : 0,
                    r = e.input ? e.input.outerHeight() : 0,
                    l = document.documentElement.clientWidth + (n ? 0 : t(document).scrollLeft()),
                    d = document.documentElement.clientHeight + (n ? 0 : t(document).scrollTop());
                return i.left -= this._get(e, "isRTL") ? s - o : 0, i.left -= n && i.left === e.input.offset().left ? t(document).scrollLeft() : 0, i.top -= n && i.top === e.input.offset().top + r ? t(document).scrollTop() : 0, i.left -= Math.min(i.left, i.left + s > l && l > s ? Math.abs(i.left + s - l) : 0), i.top -= Math.min(i.top, i.top + a > d && d > a ? Math.abs(a + r) : 0), i
            },
            _findPos: function(e) {
                for (var i, n = this._getInst(e), s = this._get(n, "isRTL"); e && ("hidden" === e.type || 1 !== e.nodeType || t.expr.filters.hidden(e));) e = e[s ? "previousSibling" : "nextSibling"];
                return i = t(e).offset(), [i.left, i.top]
            },
            _hideDatepicker: function(e) {
                var i, n, s, a, o = this._curInst;
                !o || e && o !== t.data(e, "datepicker") || this._datepickerShowing && (i = this._get(o, "showAnim"), n = this._get(o, "duration"), s = function() {
                    t.datepicker._tidyDialog(o)
                }, t.effects && (t.effects.effect[i] || t.effects[i]) ? o.dpDiv.hide(i, t.datepicker._get(o, "showOptions"), n, s) : o.dpDiv["slideDown" === i ? "slideUp" : "fadeIn" === i ? "fadeOut" : "hide"](i ? n : null, s), i || s(), this._datepickerShowing = !1, a = this._get(o, "onClose"), a && a.apply(o.input ? o.input[0] : null, [o.input ? o.input.val() : "", o]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
                    position: "absolute",
                    left: "0",
                    top: "-100px"
                }), t.blockUI && (t.unblockUI(), t("body").append(this.dpDiv))), this._inDialog = !1)
            },
            _tidyDialog: function(t) {
                t.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")
            },
            _checkExternalClick: function(e) {
                if (t.datepicker._curInst) {
                    var i = t(e.target),
                        n = t.datepicker._getInst(i[0]);
                    (i[0].id !== t.datepicker._mainDivId && 0 === i.parents("#" + t.datepicker._mainDivId).length && !i.hasClass(t.datepicker.markerClassName) && !i.closest("." + t.datepicker._triggerClass).length && t.datepicker._datepickerShowing && (!t.datepicker._inDialog || !t.blockUI) || i.hasClass(t.datepicker.markerClassName) && t.datepicker._curInst !== n) && t.datepicker._hideDatepicker()
                }
            },
            _adjustDate: function(e, i, n) {
                var s = t(e),
                    a = this._getInst(s[0]);
                this._isDisabledDatepicker(s[0]) || (this._adjustInstDate(a, i + ("M" === n ? this._get(a, "showCurrentAtPos") : 0), n), this._updateDatepicker(a))
            },
            _gotoToday: function(e) {
                var i, n = t(e),
                    s = this._getInst(n[0]);
                this._get(s, "gotoCurrent") && s.currentDay ? (s.selectedDay = s.currentDay, s.drawMonth = s.selectedMonth = s.currentMonth, s.drawYear = s.selectedYear = s.currentYear) : (i = new Date, s.selectedDay = i.getDate(), s.drawMonth = s.selectedMonth = i.getMonth(), s.drawYear = s.selectedYear = i.getFullYear()), this._notifyChange(s), this._adjustDate(n)
            },
            _selectMonthYear: function(e, i, n) {
                var s = t(e),
                    a = this._getInst(s[0]);
                a["selected" + ("M" === n ? "Month" : "Year")] = a["draw" + ("M" === n ? "Month" : "Year")] = parseInt(i.options[i.selectedIndex].value, 10), this._notifyChange(a), this._adjustDate(s)
            },
            _selectDay: function(e, i, n, s) {
                var a, o = t(e);
                t(s).hasClass(this._unselectableClass) || this._isDisabledDatepicker(o[0]) || (a = this._getInst(o[0]), a.selectedDay = a.currentDay = t("a", s).html(), a.selectedMonth = a.currentMonth = i, a.selectedYear = a.currentYear = n, this._selectDate(e, this._formatDate(a, a.currentDay, a.currentMonth, a.currentYear)))
            },
            _clearDate: function(e) {
                var i = t(e);
                this._selectDate(i, "")
            },
            _selectDate: function(e, i) {
                var n, s = t(e),
                    a = this._getInst(s[0]);
                i = null != i ? i : this._formatDate(a), a.input && a.input.val(i), this._updateAlternate(a), n = this._get(a, "onSelect"), n ? n.apply(a.input ? a.input[0] : null, [i, a]) : a.input && a.input.trigger("change"), a.inline ? this._updateDatepicker(a) : (this._hideDatepicker(), this._lastInput = a.input[0], "object" != typeof a.input[0] && a.input.focus(), this._lastInput = null)
            },
            _updateAlternate: function(e) {
                var i, n, s, a = this._get(e, "altField");
                a && (i = this._get(e, "altFormat") || this._get(e, "dateFormat"), n = this._getDate(e), s = this.formatDate(i, n, this._getFormatConfig(e)), t(a).each(function() {
                    t(this).val(s)
                }))
            },
            noWeekends: function(t) {
                var e = t.getDay();
                return [e > 0 && 6 > e, ""]
            },
            iso8601Week: function(t) {
                var e, i = new Date(t.getTime());
                return i.setDate(i.getDate() + 4 - (i.getDay() || 7)), e = i.getTime(), i.setMonth(0), i.setDate(1), Math.floor(Math.round((e - i) / 864e5) / 7) + 1
            },
            parseDate: function(e, i, n) {
                if (null == e || null == i) throw "Invalid arguments";
                if (i = "object" == typeof i ? "" + i : i + "", "" === i) return null;
                var s, a, o, r, l = 0,
                    d = (n ? n.shortYearCutoff : null) || this._defaults.shortYearCutoff,
                    c = "string" != typeof d ? d : (new Date).getFullYear() % 100 + parseInt(d, 10),
                    h = (n ? n.dayNamesShort : null) || this._defaults.dayNamesShort,
                    p = (n ? n.dayNames : null) || this._defaults.dayNames,
                    u = (n ? n.monthNamesShort : null) || this._defaults.monthNamesShort,
                    g = (n ? n.monthNames : null) || this._defaults.monthNames,
                    f = -1,
                    m = -1,
                    v = -1,
                    _ = -1,
                    b = !1,
                    y = function(t) {
                        var i = e.length > s + 1 && e.charAt(s + 1) === t;
                        return i && s++, i
                    },
                    w = function(t) {
                        var e = y(t),
                            n = "@" === t ? 14 : "!" === t ? 20 : "y" === t && e ? 4 : "o" === t ? 3 : 2,
                            s = "y" === t ? n : 1,
                            a = RegExp("^\\d{" + s + "," + n + "}"),
                            o = i.substring(l).match(a);
                        if (!o) throw "Missing number at position " + l;
                        return l += o[0].length, parseInt(o[0], 10)
                    },
                    k = function(e, n, s) {
                        var a = -1,
                            o = t.map(y(e) ? s : n, function(t, e) {
                                return [
                                    [e, t]
                                ]
                            }).sort(function(t, e) {
                                return -(t[1].length - e[1].length)
                            });
                        if (t.each(o, function(t, e) {
                                var n = e[1];
                                return i.substr(l, n.length).toLowerCase() === n.toLowerCase() ? (a = e[0], l += n.length, !1) : void 0
                            }), -1 !== a) return a + 1;
                        throw "Unknown name at position " + l
                    },
                    x = function() {
                        if (i.charAt(l) !== e.charAt(s)) throw "Unexpected literal at position " + l;
                        l++
                    };
                for (s = 0; e.length > s; s++)
                    if (b) "'" !== e.charAt(s) || y("'") ? x() : b = !1;
                    else switch (e.charAt(s)) {
                        case "d":
                            v = w("d");
                            break;
                        case "D":
                            k("D", h, p);
                            break;
                        case "o":
                            _ = w("o");
                            break;
                        case "m":
                            m = w("m");
                            break;
                        case "M":
                            m = k("M", u, g);
                            break;
                        case "y":
                            f = w("y");
                            break;
                        case "@":
                            r = new Date(w("@")), f = r.getFullYear(), m = r.getMonth() + 1, v = r.getDate();
                            break;
                        case "!":
                            r = new Date((w("!") - this._ticksTo1970) / 1e4), f = r.getFullYear(), m = r.getMonth() + 1, v = r.getDate();
                            break;
                        case "'":
                            y("'") ? x() : b = !0;
                            break;
                        default:
                            x()
                    }
                    if (i.length > l && (o = i.substr(l), !/^\s+/.test(o))) throw "Extra/unparsed characters found in date: " + o;
                if (-1 === f ? f = (new Date).getFullYear() : 100 > f && (f += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (c >= f ? 0 : -100)), _ > -1)
                    for (m = 1, v = _; a = this._getDaysInMonth(f, m - 1), !(a >= v);) m++, v -= a;
                if (r = this._daylightSavingAdjust(new Date(f, m - 1, v)), r.getFullYear() !== f || r.getMonth() + 1 !== m || r.getDate() !== v) throw "Invalid date";
                return r
            },
            ATOM: "yy-mm-dd",
            COOKIE: "D, dd M yy",
            ISO_8601: "yy-mm-dd",
            RFC_822: "D, d M y",
            RFC_850: "DD, dd-M-y",
            RFC_1036: "D, d M y",
            RFC_1123: "D, d M yy",
            RFC_2822: "D, d M yy",
            RSS: "D, d M y",
            TICKS: "!",
            TIMESTAMP: "@",
            W3C: "yy-mm-dd",
            _ticksTo1970: 864e9 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)),
            formatDate: function(t, e, i) {
                if (!e) return "";
                var n, s = (i ? i.dayNamesShort : null) || this._defaults.dayNamesShort,
                    a = (i ? i.dayNames : null) || this._defaults.dayNames,
                    o = (i ? i.monthNamesShort : null) || this._defaults.monthNamesShort,
                    r = (i ? i.monthNames : null) || this._defaults.monthNames,
                    l = function(e) {
                        var i = t.length > n + 1 && t.charAt(n + 1) === e;
                        return i && n++, i
                    },
                    d = function(t, e, i) {
                        var n = "" + e;
                        if (l(t))
                            for (; i > n.length;) n = "0" + n;
                        return n
                    },
                    c = function(t, e, i, n) {
                        return l(t) ? n[e] : i[e]
                    },
                    h = "",
                    p = !1;
                if (e)
                    for (n = 0; t.length > n; n++)
                        if (p) "'" !== t.charAt(n) || l("'") ? h += t.charAt(n) : p = !1;
                        else switch (t.charAt(n)) {
                            case "d":
                                h += d("d", e.getDate(), 2);
                                break;
                            case "D":
                                h += c("D", e.getDay(), s, a);
                                break;
                            case "o":
                                h += d("o", Math.round((new Date(e.getFullYear(), e.getMonth(), e.getDate()).getTime() - new Date(e.getFullYear(), 0, 0).getTime()) / 864e5), 3);
                                break;
                            case "m":
                                h += d("m", e.getMonth() + 1, 2);
                                break;
                            case "M":
                                h += c("M", e.getMonth(), o, r);
                                break;
                            case "y":
                                h += l("y") ? e.getFullYear() : (10 > e.getYear() % 100 ? "0" : "") + e.getYear() % 100;
                                break;
                            case "@":
                                h += e.getTime();
                                break;
                            case "!":
                                h += 1e4 * e.getTime() + this._ticksTo1970;
                                break;
                            case "'":
                                l("'") ? h += "'" : p = !0;
                                break;
                            default:
                                h += t.charAt(n)
                        }
                        return h
            },
            _possibleChars: function(t) {
                var e, i = "",
                    n = !1,
                    s = function(i) {
                        var n = t.length > e + 1 && t.charAt(e + 1) === i;
                        return n && e++, n
                    };
                for (e = 0; t.length > e; e++)
                    if (n) "'" !== t.charAt(e) || s("'") ? i += t.charAt(e) : n = !1;
                    else switch (t.charAt(e)) {
                        case "d":
                        case "m":
                        case "y":
                        case "@":
                            i += "0123456789";
                            break;
                        case "D":
                        case "M":
                            return null;
                        case "'":
                            s("'") ? i += "'" : n = !0;
                            break;
                        default:
                            i += t.charAt(e)
                    }
                    return i
            },
            _get: function(t, e) {
                return void 0 !== t.settings[e] ? t.settings[e] : this._defaults[e]
            },
            _setDateFromField: function(t, e) {
                if (t.input.val() !== t.lastVal) {
                    var i = this._get(t, "dateFormat"),
                        n = t.lastVal = t.input ? t.input.val() : null,
                        s = this._getDefaultDate(t),
                        a = s,
                        o = this._getFormatConfig(t);
                    try {
                        a = this.parseDate(i, n, o) || s
                    } catch (r) {
                        n = e ? "" : n
                    }
                    t.selectedDay = a.getDate(), t.drawMonth = t.selectedMonth = a.getMonth(), t.drawYear = t.selectedYear = a.getFullYear(), t.currentDay = n ? a.getDate() : 0, t.currentMonth = n ? a.getMonth() : 0, t.currentYear = n ? a.getFullYear() : 0, this._adjustInstDate(t)
                }
            },
            _getDefaultDate: function(t) {
                return this._restrictMinMax(t, this._determineDate(t, this._get(t, "defaultDate"), new Date))
            },
            _determineDate: function(e, i, n) {
                var s = function(t) {
                        var e = new Date;
                        return e.setDate(e.getDate() + t), e
                    },
                    a = function(i) {
                        try {
                            return t.datepicker.parseDate(t.datepicker._get(e, "dateFormat"), i, t.datepicker._getFormatConfig(e))
                        } catch (n) {}
                        for (var s = (i.toLowerCase().match(/^c/) ? t.datepicker._getDate(e) : null) || new Date, a = s.getFullYear(), o = s.getMonth(), r = s.getDate(), l = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, d = l.exec(i); d;) {
                            switch (d[2] || "d") {
                                case "d":
                                case "D":
                                    r += parseInt(d[1], 10);
                                    break;
                                case "w":
                                case "W":
                                    r += 7 * parseInt(d[1], 10);
                                    break;
                                case "m":
                                case "M":
                                    o += parseInt(d[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(a, o));
                                    break;
                                case "y":
                                case "Y":
                                    a += parseInt(d[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(a, o))
                            }
                            d = l.exec(i)
                        }
                        return new Date(a, o, r)
                    },
                    o = null == i || "" === i ? n : "string" == typeof i ? a(i) : "number" == typeof i ? isNaN(i) ? n : s(i) : new Date(i.getTime());
                return o = o && "Invalid Date" == "" + o ? n : o, o && (o.setHours(0), o.setMinutes(0), o.setSeconds(0), o.setMilliseconds(0)), this._daylightSavingAdjust(o)
            },
            _daylightSavingAdjust: function(t) {
                return t ? (t.setHours(t.getHours() > 12 ? t.getHours() + 2 : 0), t) : null
            },
            _setDate: function(t, e, i) {
                var n = !e,
                    s = t.selectedMonth,
                    a = t.selectedYear,
                    o = this._restrictMinMax(t, this._determineDate(t, e, new Date));
                t.selectedDay = t.currentDay = o.getDate(), t.drawMonth = t.selectedMonth = t.currentMonth = o.getMonth(), t.drawYear = t.selectedYear = t.currentYear = o.getFullYear(), s === t.selectedMonth && a === t.selectedYear || i || this._notifyChange(t), this._adjustInstDate(t), t.input && t.input.val(n ? "" : this._formatDate(t))
            },
            _getDate: function(t) {
                var e = !t.currentYear || t.input && "" === t.input.val() ? null : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
                return e
            },
            _attachHandlers: function(e) {
                var i = this._get(e, "stepMonths"),
                    n = "#" + e.id.replace(/\\\\/g, "\\");
                e.dpDiv.find("[data-handler]").map(function() {
                    var e = {
                        prev: function() {
                            t.datepicker._adjustDate(n, -i, "M")
                        },
                        next: function() {
                            t.datepicker._adjustDate(n, +i, "M")
                        },
                        hide: function() {
                            t.datepicker._hideDatepicker()
                        },
                        today: function() {
                            t.datepicker._gotoToday(n)
                        },
                        selectDay: function() {
                            return t.datepicker._selectDay(n, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), !1
                        },
                        selectMonth: function() {
                            return t.datepicker._selectMonthYear(n, this, "M"), !1
                        },
                        selectYear: function() {
                            return t.datepicker._selectMonthYear(n, this, "Y"), !1
                        }
                    };
                    t(this).bind(this.getAttribute("data-event"), e[this.getAttribute("data-handler")])
                })
            },
            _generateHTML: function(t) {
                var e, i, n, s, a, o, r, l, d, c, h, p, u, g, f, m, v, _, b, y, w, k, x, D, C, S, T, M, I, N, $, E, A, P, O, j, W, z, F, R = new Date,
                    L = this._daylightSavingAdjust(new Date(R.getFullYear(), R.getMonth(), R.getDate())),
                    H = this._get(t, "isRTL"),
                    Y = this._get(t, "showButtonPanel"),
                    U = this._get(t, "hideIfNoPrevNext"),
                    B = this._get(t, "navigationAsDateFormat"),
                    q = this._getNumberOfMonths(t),
                    V = this._get(t, "showCurrentAtPos"),
                    K = this._get(t, "stepMonths"),
                    Q = 1 !== q[0] || 1 !== q[1],
                    Z = this._daylightSavingAdjust(t.currentDay ? new Date(t.currentYear, t.currentMonth, t.currentDay) : new Date(9999, 9, 9)),
                    G = this._getMinMaxDate(t, "min"),
                    J = this._getMinMaxDate(t, "max"),
                    X = t.drawMonth - V,
                    te = t.drawYear;
                if (0 > X && (X += 12, te--), J)
                    for (e = this._daylightSavingAdjust(new Date(J.getFullYear(), J.getMonth() - q[0] * q[1] + 1, J.getDate())), e = G && G > e ? G : e; this._daylightSavingAdjust(new Date(te, X, 1)) > e;) X--, 0 > X && (X = 11, te--);
                for (t.drawMonth = X, t.drawYear = te, i = this._get(t, "prevText"), i = B ? this.formatDate(i, this._daylightSavingAdjust(new Date(te, X - K, 1)), this._getFormatConfig(t)) : i, n = this._canAdjustMonth(t, -1, te, X) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (H ? "e" : "w") + "'>" + i + "</span></a>" : U ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (H ? "e" : "w") + "'>" + i + "</span></a>", s = this._get(t, "nextText"), s = B ? this.formatDate(s, this._daylightSavingAdjust(new Date(te, X + K, 1)), this._getFormatConfig(t)) : s, a = this._canAdjustMonth(t, 1, te, X) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + s + "'><span class='ui-icon ui-icon-circle-triangle-" + (H ? "w" : "e") + "'>" + s + "</span></a>" : U ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + s + "'><span class='ui-icon ui-icon-circle-triangle-" + (H ? "w" : "e") + "'>" + s + "</span></a>", o = this._get(t, "currentText"), r = this._get(t, "gotoCurrent") && t.currentDay ? Z : L, o = B ? this.formatDate(o, r, this._getFormatConfig(t)) : o, l = t.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(t, "closeText") + "</button>", d = Y ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (H ? l : "") + (this._isInRange(t, r) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + o + "</button>" : "") + (H ? "" : l) + "</div>" : "", c = parseInt(this._get(t, "firstDay"), 10), c = isNaN(c) ? 0 : c, h = this._get(t, "showWeek"), p = this._get(t, "dayNames"), u = this._get(t, "dayNamesMin"), g = this._get(t, "monthNames"), f = this._get(t, "monthNamesShort"), m = this._get(t, "beforeShowDay"), v = this._get(t, "showOtherMonths"), _ = this._get(t, "selectOtherMonths"), b = this._getDefaultDate(t), y = "", k = 0; q[0] > k; k++) {
                    for (x = "", this.maxRows = 4, D = 0; q[1] > D; D++) {
                        if (C = this._daylightSavingAdjust(new Date(te, X, t.selectedDay)), S = " ui-corner-all", T = "", Q) {
                            if (T += "<div class='ui-datepicker-group", q[1] > 1) switch (D) {
                                case 0:
                                    T += " ui-datepicker-group-first", S = " ui-corner-" + (H ? "right" : "left");
                                    break;
                                case q[1] - 1:
                                    T += " ui-datepicker-group-last", S = " ui-corner-" + (H ? "left" : "right");
                                    break;
                                default:
                                    T += " ui-datepicker-group-middle", S = ""
                            }
                            T += "'>"
                        }
                        for (T += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + S + "'>" + (/all|left/.test(S) && 0 === k ? H ? a : n : "") + (/all|right/.test(S) && 0 === k ? H ? n : a : "") + this._generateMonthYearHeader(t, X, te, G, J, k > 0 || D > 0, g, f) + "</div><table class='ui-datepicker-calendar'><thead><tr>", M = h ? "<th class='ui-datepicker-week-col'>" + this._get(t, "weekHeader") + "</th>" : "", w = 0; 7 > w; w++) I = (w + c) % 7, M += "<th scope='col'" + ((w + c + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + "><span title='" + p[I] + "'>" + u[I] + "</span></th>";
                        for (T += M + "</tr></thead><tbody>", N = this._getDaysInMonth(te, X), te === t.selectedYear && X === t.selectedMonth && (t.selectedDay = Math.min(t.selectedDay, N)), $ = (this._getFirstDayOfMonth(te, X) - c + 7) % 7, E = Math.ceil(($ + N) / 7), A = Q && this.maxRows > E ? this.maxRows : E, this.maxRows = A, P = this._daylightSavingAdjust(new Date(te, X, 1 - $)), O = 0; A > O; O++) {
                            for (T += "<tr>", j = h ? "<td class='ui-datepicker-week-col'>" + this._get(t, "calculateWeek")(P) + "</td>" : "", w = 0; 7 > w; w++) W = m ? m.apply(t.input ? t.input[0] : null, [P]) : [!0, ""], z = P.getMonth() !== X, F = z && !_ || !W[0] || G && G > P || J && P > J, j += "<td class='" + ((w + c + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (z ? " ui-datepicker-other-month" : "") + (P.getTime() === C.getTime() && X === t.selectedMonth && t._keyEvent || b.getTime() === P.getTime() && b.getTime() === C.getTime() ? " " + this._dayOverClass : "") + (F ? " " + this._unselectableClass + " ui-state-disabled" : "") + (z && !v ? "" : " " + W[1] + (P.getTime() === Z.getTime() ? " " + this._currentClass : "") + (P.getTime() === L.getTime() ? " ui-datepicker-today" : "")) + "'" + (z && !v || !W[2] ? "" : " title='" + W[2].replace(/'/g, "&#39;") + "'") + (F ? "" : " data-handler='selectDay' data-event='click' data-month='" + P.getMonth() + "' data-year='" + P.getFullYear() + "'") + ">" + (z && !v ? "&#xa0;" : F ? "<span class='ui-state-default'>" + P.getDate() + "</span>" : "<a class='ui-state-default" + (P.getTime() === L.getTime() ? " ui-state-highlight" : "") + (P.getTime() === Z.getTime() ? " ui-state-active" : "") + (z ? " ui-priority-secondary" : "") + "' href='#'>" + P.getDate() + "</a>") + "</td>", P.setDate(P.getDate() + 1), P = this._daylightSavingAdjust(P);
                            T += j + "</tr>"
                        }
                        X++, X > 11 && (X = 0, te++), T += "</tbody></table>" + (Q ? "</div>" + (q[0] > 0 && D === q[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : ""), x += T
                    }
                    y += x
                }
                return y += d, t._keyEvent = !1, y
            },
            _generateMonthYearHeader: function(t, e, i, n, s, a, o, r) {
                var l, d, c, h, p, u, g, f, m = this._get(t, "changeMonth"),
                    v = this._get(t, "changeYear"),
                    _ = this._get(t, "showMonthAfterYear"),
                    b = "<div class='ui-datepicker-title'>",
                    y = "";
                if (a || !m) y += "<span class='ui-datepicker-month'>" + o[e] + "</span>";
                else {
                    for (l = n && n.getFullYear() === i, d = s && s.getFullYear() === i, y += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", c = 0; 12 > c; c++)(!l || c >= n.getMonth()) && (!d || s.getMonth() >= c) && (y += "<option value='" + c + "'" + (c === e ? " selected='selected'" : "") + ">" + r[c] + "</option>");
                    y += "</select>"
                }
                if (_ || (b += y + (!a && m && v ? "" : "&#xa0;")), !t.yearshtml)
                    if (t.yearshtml = "", a || !v) b += "<span class='ui-datepicker-year'>" + i + "</span>";
                    else {
                        for (h = this._get(t, "yearRange").split(":"), p = (new Date).getFullYear(), u = function(t) {
                                var e = t.match(/c[+\-].*/) ? i + parseInt(t.substring(1), 10) : t.match(/[+\-].*/) ? p + parseInt(t, 10) : parseInt(t, 10);
                                return isNaN(e) ? p : e
                            }, g = u(h[0]), f = Math.max(g, u(h[1] || "")), g = n ? Math.max(g, n.getFullYear()) : g, f = s ? Math.min(f, s.getFullYear()) : f, t.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; f >= g; g++) t.yearshtml += "<option value='" + g + "'" + (g === i ? " selected='selected'" : "") + ">" + g + "</option>";
                        t.yearshtml += "</select>", b += t.yearshtml, t.yearshtml = null
                    }
                return b += this._get(t, "yearSuffix"), _ && (b += (!a && m && v ? "" : "&#xa0;") + y), b += "</div>"
            },
            _adjustInstDate: function(t, e, i) {
                var n = t.drawYear + ("Y" === i ? e : 0),
                    s = t.drawMonth + ("M" === i ? e : 0),
                    a = Math.min(t.selectedDay, this._getDaysInMonth(n, s)) + ("D" === i ? e : 0),
                    o = this._restrictMinMax(t, this._daylightSavingAdjust(new Date(n, s, a)));
                t.selectedDay = o.getDate(), t.drawMonth = t.selectedMonth = o.getMonth(), t.drawYear = t.selectedYear = o.getFullYear(), ("M" === i || "Y" === i) && this._notifyChange(t)
            },
            _restrictMinMax: function(t, e) {
                var i = this._getMinMaxDate(t, "min"),
                    n = this._getMinMaxDate(t, "max"),
                    s = i && i > e ? i : e;
                return n && s > n ? n : s
            },
            _notifyChange: function(t) {
                var e = this._get(t, "onChangeMonthYear");
                e && e.apply(t.input ? t.input[0] : null, [t.selectedYear, t.selectedMonth + 1, t])
            },
            _getNumberOfMonths: function(t) {
                var e = this._get(t, "numberOfMonths");
                return null == e ? [1, 1] : "number" == typeof e ? [1, e] : e
            },
            _getMinMaxDate: function(t, e) {
                return this._determineDate(t, this._get(t, e + "Date"), null)
            },
            _getDaysInMonth: function(t, e) {
                return 32 - this._daylightSavingAdjust(new Date(t, e, 32)).getDate()
            },
            _getFirstDayOfMonth: function(t, e) {
                return new Date(t, e, 1).getDay()
            },
            _canAdjustMonth: function(t, e, i, n) {
                var s = this._getNumberOfMonths(t),
                    a = this._daylightSavingAdjust(new Date(i, n + (0 > e ? e : s[0] * s[1]), 1));
                return 0 > e && a.setDate(this._getDaysInMonth(a.getFullYear(), a.getMonth())), this._isInRange(t, a)
            },
            _isInRange: function(t, e) {
                var i, n, s = this._getMinMaxDate(t, "min"),
                    a = this._getMinMaxDate(t, "max"),
                    o = null,
                    r = null,
                    l = this._get(t, "yearRange");
                return l && (i = l.split(":"), n = (new Date).getFullYear(), o = parseInt(i[0], 10), r = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (o += n), i[1].match(/[+\-].*/) && (r += n)), (!s || e.getTime() >= s.getTime()) && (!a || e.getTime() <= a.getTime()) && (!o || e.getFullYear() >= o) && (!r || r >= e.getFullYear())
            },
            _getFormatConfig: function(t) {
                var e = this._get(t, "shortYearCutoff");
                return e = "string" != typeof e ? e : (new Date).getFullYear() % 100 + parseInt(e, 10), {
                    shortYearCutoff: e,
                    dayNamesShort: this._get(t, "dayNamesShort"),
                    dayNames: this._get(t, "dayNames"),
                    monthNamesShort: this._get(t, "monthNamesShort"),
                    monthNames: this._get(t, "monthNames")
                }
            },
            _formatDate: function(t, e, i, n) {
                e || (t.currentDay = t.selectedDay, t.currentMonth = t.selectedMonth, t.currentYear = t.selectedYear);
                var s = e ? "object" == typeof e ? e : this._daylightSavingAdjust(new Date(n, i, e)) : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
                return this.formatDate(this._get(t, "dateFormat"), s, this._getFormatConfig(t))
            }
        }), t.fn.datepicker = function(e) {
            if (!this.length) return this;
            t.datepicker.initialized || (t(document).mousedown(t.datepicker._checkExternalClick), t.datepicker.initialized = !0), 0 === t("#" + t.datepicker._mainDivId).length && t("body").append(t.datepicker.dpDiv);
            var i = Array.prototype.slice.call(arguments, 1);
            return "string" != typeof e || "isDisabled" !== e && "getDate" !== e && "widget" !== e ? "option" === e && 2 === arguments.length && "string" == typeof arguments[1] ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i)) : this.each(function() {
                "string" == typeof e ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this].concat(i)) : t.datepicker._attachDatepicker(this, e)
            }) : t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i))
        }, t.datepicker = new s, t.datepicker.initialized = !1, t.datepicker.uuid = (new Date).getTime(), t.datepicker.version = "1.11.2", t.datepicker, t.widget("ui.slider", t.ui.mouse, {
            version: "1.11.2",
            widgetEventPrefix: "slide",
            options: {
                animate: !1,
                distance: 0,
                max: 100,
                min: 0,
                orientation: "horizontal",
                range: !1,
                step: 1,
                value: 0,
                values: null,
                change: null,
                slide: null,
                start: null,
                stop: null
            },
            numPages: 5,
            _create: function() {
                this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this._calculateNewMax(), this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all"), this._refresh(), this._setOption("disabled", this.options.disabled), this._animateOff = !1
            },
            _refresh: function() {
                this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue()
            },
            _createHandles: function() {
                var e, i, n = this.options,
                    s = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                    a = "<span class='ui-slider-handle ui-state-default ui-corner-all' tabindex='0'></span>",
                    o = [];
                for (i = n.values && n.values.length || 1, s.length > i && (s.slice(i).remove(), s = s.slice(0, i)), e = s.length; i > e; e++) o.push(a);
                this.handles = s.add(t(o.join("")).appendTo(this.element)), this.handle = this.handles.eq(0), this.handles.each(function(e) {
                    t(this).data("ui-slider-handle-index", e)
                })
            },
            _createRange: function() {
                var e = this.options,
                    i = "";
                e.range ? (e.range === !0 && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [e.values[0], e.values[0]] : t.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
                    left: "",
                    bottom: ""
                }) : (this.range = t("<div></div>").appendTo(this.element), i = "ui-slider-range ui-widget-header ui-corner-all"), this.range.addClass(i + ("min" === e.range || "max" === e.range ? " ui-slider-range-" + e.range : ""))) : (this.range && this.range.remove(), this.range = null)
            },
            _setupEvents: function() {
                this._off(this.handles), this._on(this.handles, this._handleEvents), this._hoverable(this.handles), this._focusable(this.handles)
            },
            _destroy: function() {
                this.handles.remove(), this.range && this.range.remove(), this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"), this._mouseDestroy()
            },
            _mouseCapture: function(e) {
                var i, n, s, a, o, r, l, d, c = this,
                    h = this.options;
                return h.disabled ? !1 : (this.elementSize = {
                    width: this.element.outerWidth(),
                    height: this.element.outerHeight()
                }, this.elementOffset = this.element.offset(), i = {
                    x: e.pageX,
                    y: e.pageY
                }, n = this._normValueFromMouse(i), s = this._valueMax() - this._valueMin() + 1, this.handles.each(function(e) {
                    var i = Math.abs(n - c.values(e));
                    (s > i || s === i && (e === c._lastChangedValue || c.values(e) === h.min)) && (s = i, a = t(this), o = e)
                }), r = this._start(e, o), r === !1 ? !1 : (this._mouseSliding = !0, this._handleIndex = o, a.addClass("ui-state-active").focus(), l = a.offset(), d = !t(e.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = d ? {
                    left: 0,
                    top: 0
                } : {
                    left: e.pageX - l.left - a.width() / 2,
                    top: e.pageY - l.top - a.height() / 2 - (parseInt(a.css("borderTopWidth"), 10) || 0) - (parseInt(a.css("borderBottomWidth"), 10) || 0) + (parseInt(a.css("marginTop"), 10) || 0)
                }, this.handles.hasClass("ui-state-hover") || this._slide(e, o, n), this._animateOff = !0, !0))
            },
            _mouseStart: function() {
                return !0
            },
            _mouseDrag: function(t) {
                var e = {
                        x: t.pageX,
                        y: t.pageY
                    },
                    i = this._normValueFromMouse(e);
                return this._slide(t, this._handleIndex, i), !1
            },
            _mouseStop: function(t) {
                return this.handles.removeClass("ui-state-active"), this._mouseSliding = !1, this._stop(t, this._handleIndex), this._change(t, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1, !1
            },
            _detectOrientation: function() {
                this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal"
            },
            _normValueFromMouse: function(t) {
                var e, i, n, s, a;
                return "horizontal" === this.orientation ? (e = this.elementSize.width, i = t.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (e = this.elementSize.height, i = t.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), n = i / e, n > 1 && (n = 1), 0 > n && (n = 0), "vertical" === this.orientation && (n = 1 - n), s = this._valueMax() - this._valueMin(), a = this._valueMin() + n * s, this._trimAlignValue(a)
            },
            _start: function(t, e) {
                var i = {
                    handle: this.handles[e],
                    value: this.value()
                };
                return this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._trigger("start", t, i)
            },
            _slide: function(t, e, i) {
                var n, s, a;
                this.options.values && this.options.values.length ? (n = this.values(e ? 0 : 1), 2 === this.options.values.length && this.options.range === !0 && (0 === e && i > n || 1 === e && n > i) && (i = n), i !== this.values(e) && (s = this.values(), s[e] = i, a = this._trigger("slide", t, {
                    handle: this.handles[e],
                    value: i,
                    values: s
                }), n = this.values(e ? 0 : 1), a !== !1 && this.values(e, i))) : i !== this.value() && (a = this._trigger("slide", t, {
                    handle: this.handles[e],
                    value: i
                }), a !== !1 && this.value(i))
            },
            _stop: function(t, e) {
                var i = {
                    handle: this.handles[e],
                    value: this.value()
                };
                this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._trigger("stop", t, i)
            },
            _change: function(t, e) {
                if (!this._keySliding && !this._mouseSliding) {
                    var i = {
                        handle: this.handles[e],
                        value: this.value()
                    };
                    this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._lastChangedValue = e, this._trigger("change", t, i)
                }
            },
            value: function(t) {
                return arguments.length ? (this.options.value = this._trimAlignValue(t), this._refreshValue(), void this._change(null, 0)) : this._value()
            },
            values: function(e, i) {
                var n, s, a;
                if (arguments.length > 1) return this.options.values[e] = this._trimAlignValue(i), this._refreshValue(), void this._change(null, e);
                if (!arguments.length) return this._values();
                if (!t.isArray(arguments[0])) return this.options.values && this.options.values.length ? this._values(e) : this.value();
                for (n = this.options.values, s = arguments[0], a = 0; n.length > a; a += 1) n[a] = this._trimAlignValue(s[a]), this._change(null, a);
                this._refreshValue()
            },
            _setOption: function(e, i) {
                var n, s = 0;
                switch ("range" === e && this.options.range === !0 && ("min" === i ? (this.options.value = this._values(0), this.options.values = null) : "max" === i && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), t.isArray(this.options.values) && (s = this.options.values.length), "disabled" === e && this.element.toggleClass("ui-state-disabled", !!i), this._super(e, i), e) {
                    case "orientation":
                        this._detectOrientation(), this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation), this._refreshValue(), this.handles.css("horizontal" === i ? "bottom" : "left", "");
                        break;
                    case "value":
                        this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
                        break;
                    case "values":
                        for (this._animateOff = !0, this._refreshValue(), n = 0; s > n; n += 1) this._change(null, n);
                        this._animateOff = !1;
                        break;
                    case "step":
                    case "min":
                    case "max":
                        this._animateOff = !0, this._calculateNewMax(), this._refreshValue(), this._animateOff = !1;
                        break;
                    case "range":
                        this._animateOff = !0, this._refresh(), this._animateOff = !1
                }
            },
            _value: function() {
                var t = this.options.value;
                return t = this._trimAlignValue(t)
            },
            _values: function(t) {
                var e, i, n;
                if (arguments.length) return e = this.options.values[t], e = this._trimAlignValue(e);
                if (this.options.values && this.options.values.length) {
                    for (i = this.options.values.slice(), n = 0; i.length > n; n += 1) i[n] = this._trimAlignValue(i[n]);
                    return i
                }
                return []
            },
            _trimAlignValue: function(t) {
                if (this._valueMin() >= t) return this._valueMin();
                if (t >= this._valueMax()) return this._valueMax();
                var e = this.options.step > 0 ? this.options.step : 1,
                    i = (t - this._valueMin()) % e,
                    n = t - i;
                return 2 * Math.abs(i) >= e && (n += i > 0 ? e : -e), parseFloat(n.toFixed(5))
            },
            _calculateNewMax: function() {
                var t = (this.options.max - this._valueMin()) % this.options.step;
                this.max = this.options.max - t
            },
            _valueMin: function() {
                return this.options.min
            },
            _valueMax: function() {
                return this.max
            },
            _refreshValue: function() {
                var e, i, n, s, a, o = this.options.range,
                    r = this.options,
                    l = this,
                    d = this._animateOff ? !1 : r.animate,
                    c = {};
                this.options.values && this.options.values.length ? this.handles.each(function(n) {
                    i = 100 * ((l.values(n) - l._valueMin()) / (l._valueMax() - l._valueMin())), c["horizontal" === l.orientation ? "left" : "bottom"] = i + "%", t(this).stop(1, 1)[d ? "animate" : "css"](c, r.animate), l.options.range === !0 && ("horizontal" === l.orientation ? (0 === n && l.range.stop(1, 1)[d ? "animate" : "css"]({
                        left: i + "%"
                    }, r.animate), 1 === n && l.range[d ? "animate" : "css"]({
                        width: i - e + "%"
                    }, {
                        queue: !1,
                        duration: r.animate
                    })) : (0 === n && l.range.stop(1, 1)[d ? "animate" : "css"]({
                        bottom: i + "%"
                    }, r.animate), 1 === n && l.range[d ? "animate" : "css"]({
                        height: i - e + "%"
                    }, {
                        queue: !1,
                        duration: r.animate
                    }))), e = i
                }) : (n = this.value(), s = this._valueMin(), a = this._valueMax(), i = a !== s ? 100 * ((n - s) / (a - s)) : 0, c["horizontal" === this.orientation ? "left" : "bottom"] = i + "%", this.handle.stop(1, 1)[d ? "animate" : "css"](c, r.animate), "min" === o && "horizontal" === this.orientation && this.range.stop(1, 1)[d ? "animate" : "css"]({
                    width: i + "%"
                }, r.animate), "max" === o && "horizontal" === this.orientation && this.range[d ? "animate" : "css"]({
                    width: 100 - i + "%"
                }, {
                    queue: !1,
                    duration: r.animate
                }), "min" === o && "vertical" === this.orientation && this.range.stop(1, 1)[d ? "animate" : "css"]({
                    height: i + "%"
                }, r.animate), "max" === o && "vertical" === this.orientation && this.range[d ? "animate" : "css"]({
                    height: 100 - i + "%"
                }, {
                    queue: !1,
                    duration: r.animate
                }))
            },
            _handleEvents: {
                keydown: function(e) {
                    var i, n, s, a, o = t(e.target).data("ui-slider-handle-index");
                    switch (e.keyCode) {
                        case t.ui.keyCode.HOME:
                        case t.ui.keyCode.END:
                        case t.ui.keyCode.PAGE_UP:
                        case t.ui.keyCode.PAGE_DOWN:
                        case t.ui.keyCode.UP:
                        case t.ui.keyCode.RIGHT:
                        case t.ui.keyCode.DOWN:
                        case t.ui.keyCode.LEFT:
                            if (e.preventDefault(), !this._keySliding && (this._keySliding = !0, t(e.target).addClass("ui-state-active"), i = this._start(e, o), i === !1)) return
                    }
                    switch (a = this.options.step, n = s = this.options.values && this.options.values.length ? this.values(o) : this.value(), e.keyCode) {
                        case t.ui.keyCode.HOME:
                            s = this._valueMin();
                            break;
                        case t.ui.keyCode.END:
                            s = this._valueMax();
                            break;
                        case t.ui.keyCode.PAGE_UP:
                            s = this._trimAlignValue(n + (this._valueMax() - this._valueMin()) / this.numPages);
                            break;
                        case t.ui.keyCode.PAGE_DOWN:
                            s = this._trimAlignValue(n - (this._valueMax() - this._valueMin()) / this.numPages);
                            break;
                        case t.ui.keyCode.UP:
                        case t.ui.keyCode.RIGHT:
                            if (n === this._valueMax()) return;
                            s = this._trimAlignValue(n + a);
                            break;
                        case t.ui.keyCode.DOWN:
                        case t.ui.keyCode.LEFT:
                            if (n === this._valueMin()) return;
                            s = this._trimAlignValue(n - a)
                    }
                    this._slide(e, o, s)
                },
                keyup: function(e) {
                    var i = t(e.target).data("ui-slider-handle-index");
                    this._keySliding && (this._keySliding = !1, this._stop(e, i), this._change(e, i), t(e.target).removeClass("ui-state-active"))
                }
            }
        })
    }), callJUI(), ! function(t) {
        "undefined" != typeof exports ? t(exports) : (window.hljs = t({}), "function" == typeof define && define.amd && define([], function() {
            return window.hljs
        }))
    }(function(t) {
        function e(t) {
            return t.replace(/&/gm, "&amp;").replace(/</gm, "&lt;").replace(/>/gm, "&gt;")
        }

        function i(t) {
            return t.nodeName.toLowerCase()
        }

        function n(t, e) {
            var i = t && t.exec(e);
            return i && 0 == i.index
        }

        function s(t) {
            var e = (t.className + " " + (t.parentNode ? t.parentNode.className : "")).split(/\s+/);
            return e = e.map(function(t) {
                return t.replace(/^lang(uage)?-/, "")
            }), e.filter(function(t) {
                return b(t) || /no(-?)highlight/.test(t)
            })[0]
        }

        function a(t, e) {
            var i = {};
            for (var n in t) i[n] = t[n];
            if (e)
                for (var n in e) i[n] = e[n];
            return i
        }

        function o(t) {
            var e = [];
            return function n(t, s) {
                for (var a = t.firstChild; a; a = a.nextSibling) 3 == a.nodeType ? s += a.nodeValue.length : 1 == a.nodeType && (e.push({
                    event: "start",
                    offset: s,
                    node: a
                }), s = n(a, s), i(a).match(/br|hr|img|input/) || e.push({
                    event: "stop",
                    offset: s,
                    node: a
                }));
                return s
            }(t, 0), e
        }

        function r(t, n, s) {
            function a() {
                return t.length && n.length ? t[0].offset != n[0].offset ? t[0].offset < n[0].offset ? t : n : "start" == n[0].event ? t : n : t.length ? t : n
            }

            function o(t) {
                function n(t) {
                    return " " + t.nodeName + '="' + e(t.value) + '"'
                }
                c += "<" + i(t) + Array.prototype.map.call(t.attributes, n).join("") + ">"
            }

            function r(t) {
                c += "</" + i(t) + ">"
            }

            function l(t) {
                ("start" == t.event ? o : r)(t.node)
            }
            for (var d = 0, c = "", h = []; t.length || n.length;) {
                var p = a();
                if (c += e(s.substr(d, p[0].offset - d)), d = p[0].offset, p == t) {
                    h.reverse().forEach(r);
                    do l(p.splice(0, 1)[0]), p = a(); while (p == t && p.length && p[0].offset == d);
                    h.reverse().forEach(o)
                } else "start" == p[0].event ? h.push(p[0].node) : h.pop(), l(p.splice(0, 1)[0])
            }
            return c + e(s.substr(d))
        }

        function l(t) {
            function e(t) {
                return t && t.source || t
            }

            function i(i, n) {
                return RegExp(e(i), "m" + (t.cI ? "i" : "") + (n ? "g" : ""))
            }

            function n(s, o) {
                if (!s.compiled) {
                    if (s.compiled = !0, s.k = s.k || s.bK, s.k) {
                        var r = {},
                            l = function(e, i) {
                                t.cI && (i = i.toLowerCase()), i.split(" ").forEach(function(t) {
                                    var i = t.split("|");
                                    r[i[0]] = [e, i[1] ? Number(i[1]) : 1]
                                })
                            };
                        "string" == typeof s.k ? l("keyword", s.k) : Object.keys(s.k).forEach(function(t) {
                            l(t, s.k[t])
                        }), s.k = r
                    }
                    s.lR = i(s.l || /\b[A-Za-z0-9_]+\b/, !0), o && (s.bK && (s.b = "\\b(" + s.bK.split(" ").join("|") + ")\\b"), s.b || (s.b = /\B|\b/), s.bR = i(s.b), s.e || s.eW || (s.e = /\B|\b/), s.e && (s.eR = i(s.e)), s.tE = e(s.e) || "", s.eW && o.tE && (s.tE += (s.e ? "|" : "") + o.tE)), s.i && (s.iR = i(s.i)), void 0 === s.r && (s.r = 1), s.c || (s.c = []);
                    var d = [];
                    s.c.forEach(function(t) {
                        t.v ? t.v.forEach(function(e) {
                            d.push(a(t, e))
                        }) : d.push("self" == t ? s : t)
                    }), s.c = d, s.c.forEach(function(t) {
                        n(t, s)
                    }), s.starts && n(s.starts, o);
                    var c = s.c.map(function(t) {
                        return t.bK ? "\\.?(" + t.b + ")\\.?" : t.b
                    }).concat([s.tE, s.i]).map(e).filter(Boolean);
                    s.t = c.length ? i(c.join("|"), !0) : {
                        exec: function() {
                            return null
                        }
                    }
                }
            }
            n(t)
        }

        function d(t, i, s, a) {
            function o(t, e) {
                for (var i = 0; i < e.c.length; i++)
                    if (n(e.c[i].bR, t)) return e.c[i]
            }

            function r(t, e) {
                return n(t.eR, e) ? t : t.eW ? r(t.parent, e) : void 0
            }

            function h(t, e) {
                return !s && n(e.iR, t)
            }

            function p(t, e) {
                var i = k.cI ? e[0].toLowerCase() : e[0];
                return t.k.hasOwnProperty(i) && t.k[i]
            }

            function u(t, e, i, n) {
                var s = n ? "" : y.classPrefix,
                    a = '<span class="' + s,
                    o = i ? "" : "</span>";
                return a += t + '">', a + e + o
            }

            function g() {
                if (!x.k) return e(T);
                var t = "",
                    i = 0;
                x.lR.lastIndex = 0;
                for (var n = x.lR.exec(T); n;) {
                    t += e(T.substr(i, n.index - i));
                    var s = p(x, n);
                    s ? (M += s[1], t += u(s[0], e(n[0]))) : t += e(n[0]), i = x.lR.lastIndex, n = x.lR.exec(T)
                }
                return t + e(T.substr(i))
            }

            function f() {
                if (x.sL && !w[x.sL]) return e(T);
                var t = x.sL ? d(x.sL, T, !0, D[x.sL]) : c(T);
                return x.r > 0 && (M += t.r), "continuous" == x.subLanguageMode && (D[x.sL] = t.top), u(t.language, t.value, !1, !0)
            }

            function m() {
                return void 0 !== x.sL ? f() : g()
            }

            function v(t, i) {
                var n = t.cN ? u(t.cN, "", !0) : "";
                t.rB ? (C += n, T = "") : t.eB ? (C += e(i) + n, T = "") : (C += n, T = i), x = Object.create(t, {
                    parent: {
                        value: x
                    }
                })
            }

            function _(t, i) {
                if (T += t, void 0 === i) return C += m(), 0;
                var n = o(i, x);
                if (n) return C += m(), v(n, i), n.rB ? 0 : i.length;
                var s = r(x, i);
                if (s) {
                    var a = x;
                    a.rE || a.eE || (T += i), C += m();
                    do x.cN && (C += "</span>"), M += x.r, x = x.parent; while (x != s.parent);
                    return a.eE && (C += e(i)), T = "", s.starts && v(s.starts, ""), a.rE ? 0 : i.length
                }
                if (h(i, x)) throw new Error('Illegal lexeme "' + i + '" for mode "' + (x.cN || "<unnamed>") + '"');
                return T += i, i.length || 1
            }
            var k = b(t);
            if (!k) throw new Error('Unknown language: "' + t + '"');
            l(k);
            for (var x = a || k, D = {}, C = "", S = x; S != k; S = S.parent) S.cN && (C = u(S.cN, "", !0) + C);
            var T = "",
                M = 0;
            try {
                for (var I, N, $ = 0; x.t.lastIndex = $, I = x.t.exec(i), I;) N = _(i.substr($, I.index - $), I[0]), $ = I.index + N;
                _(i.substr($));
                for (var S = x; S.parent; S = S.parent) S.cN && (C += "</span>");
                return {
                    r: M,
                    value: C,
                    language: t,
                    top: x
                }
            } catch (E) {
                if (-1 != E.message.indexOf("Illegal")) return {
                    r: 0,
                    value: e(i)
                };
                throw E
            }
        }

        function c(t, i) {
            i = i || y.languages || Object.keys(w);
            var n = {
                    r: 0,
                    value: e(t)
                },
                s = n;
            return i.forEach(function(e) {
                if (b(e)) {
                    var i = d(e, t, !1);
                    i.language = e, i.r > s.r && (s = i), i.r > n.r && (s = n, n = i)
                }
            }), s.language && (n.second_best = s), n
        }

        function h(t) {
            return y.tabReplace && (t = t.replace(/^((<[^>]+>|\t)+)/gm, function(t, e) {
                return e.replace(/\t/g, y.tabReplace)
            })), y.useBR && (t = t.replace(/\n/g, "<br>")), t
        }

        function p(t, e, i) {
            var n = e ? k[e] : i,
                s = [t.trim()];
            return t.match(/(\s|^)hljs(\s|$)/) || s.push("hljs"), n && s.push(n), s.join(" ").trim()
        }

        function u(t) {
            var e = s(t);
            if (!/no(-?)highlight/.test(e)) {
                var i;
                y.useBR ? (i = document.createElementNS("http://www.w3.org/1999/xhtml", "div"), i.innerHTML = t.innerHTML.replace(/\n/g, "").replace(/<br[ \/]*>/g, "\n")) : i = t;
                var n = i.textContent,
                    a = e ? d(e, n, !0) : c(n),
                    l = o(i);
                if (l.length) {
                    var u = document.createElementNS("http://www.w3.org/1999/xhtml", "div");
                    u.innerHTML = a.value, a.value = r(l, o(u), n)
                }
                a.value = h(a.value), t.innerHTML = a.value, t.className = p(t.className, e, a.language), t.result = {
                    language: a.language,
                    re: a.r
                }, a.second_best && (t.second_best = {
                    language: a.second_best.language,
                    re: a.second_best.r
                })
            }
        }

        function g(t) {
            y = a(y, t)
        }

        function f() {
            if (!f.called) {
                f.called = !0;
                var t = document.querySelectorAll("pre code");
                Array.prototype.forEach.call(t, u)
            }
        }

        function m() {
            addEventListener("DOMContentLoaded", f, !1), addEventListener("load", f, !1)
        }

        function v(e, i) {
            var n = w[e] = i(t);
            n.aliases && n.aliases.forEach(function(t) {
                k[t] = e
            })
        }

        function _() {
            return Object.keys(w)
        }

        function b(t) {
            return w[t] || w[k[t]]
        }
        var y = {
                classPrefix: "hljs-",
                tabReplace: null,
                useBR: !1,
                languages: void 0
            },
            w = {},
            k = {};
        return t.highlight = d, t.highlightAuto = c, t.fixMarkup = h, t.highlightBlock = u, t.configure = g, t.initHighlighting = f, t.initHighlightingOnLoad = m, t.registerLanguage = v, t.listLanguages = _, t.getLanguage = b, t.inherit = a, t.IR = "[a-zA-Z][a-zA-Z0-9_]*", t.UIR = "[a-zA-Z_][a-zA-Z0-9_]*", t.NR = "\\b\\d+(\\.\\d+)?", t.CNR = "(\\b0[xX][a-fA-F0-9]+|(\\b\\d+(\\.\\d*)?|\\.\\d+)([eE][-+]?\\d+)?)", t.BNR = "\\b(0b[01]+)", t.RSR = "!|!=|!==|%|%=|&|&&|&=|\\*|\\*=|\\+|\\+=|,|-|-=|/=|/|:|;|<<|<<=|<=|<|===|==|=|>>>=|>>=|>=|>>>|>>|>|\\?|\\[|\\{|\\(|\\^|\\^=|\\||\\|=|\\|\\||~", t.BE = {
            b: "\\\\[\\s\\S]",
            r: 0
        }, t.ASM = {
            cN: "string",
            b: "'",
            e: "'",
            i: "\\n",
            c: [t.BE]
        }, t.QSM = {
            cN: "string",
            b: '"',
            e: '"',
            i: "\\n",
            c: [t.BE]
        }, t.PWM = {
            b: /\b(a|an|the|are|I|I'm|isn't|don't|doesn't|won't|but|just|should|pretty|simply|enough|gonna|going|wtf|so|such)\b/
        }, t.CLCM = {
            cN: "comment",
            b: "//",
            e: "$",
            c: [t.PWM]
        }, t.CBCM = {
            cN: "comment",
            b: "/\\*",
            e: "\\*/",
            c: [t.PWM]
        }, t.HCM = {
            cN: "comment",
            b: "#",
            e: "$",
            c: [t.PWM]
        }, t.NM = {
            cN: "number",
            b: t.NR,
            r: 0
        }, t.CNM = {
            cN: "number",
            b: t.CNR,
            r: 0
        }, t.BNM = {
            cN: "number",
            b: t.BNR,
            r: 0
        }, t.CSSNM = {
            cN: "number",
            b: t.NR + "(%|em|ex|ch|rem|vw|vh|vmin|vmax|cm|mm|in|pt|pc|px|deg|grad|rad|turn|s|ms|Hz|kHz|dpi|dpcm|dppx)?",
            r: 0
        }, t.RM = {
            cN: "regexp",
            b: /\//,
            e: /\/[gimuy]*/,
            i: /\n/,
            c: [t.BE, {
                b: /\[/,
                e: /\]/,
                r: 0,
                c: [t.BE]
            }]
        }, t.TM = {
            cN: "title",
            b: t.IR,
            r: 0
        }, t.UTM = {
            cN: "title",
            b: t.UIR,
            r: 0
        }, t
    }), hljs.registerLanguage("xml", function() {
        var t = "[A-Za-z0-9\\._:-]+",
            e = {
                b: /<\?(php)?(?!\w)/,
                e: /\?>/,
                sL: "php",
                subLanguageMode: "continuous"
            },
            i = {
                eW: !0,
                i: /</,
                r: 0,
                c: [e, {
                    cN: "attribute",
                    b: t,
                    r: 0
                }, {
                    b: "=",
                    r: 0,
                    c: [{
                        cN: "value",
                        c: [e],
                        v: [{
                            b: /"/,
                            e: /"/
                        }, {
                            b: /'/,
                            e: /'/
                        }, {
                            b: /[^\s\/>]+/
                        }]
                    }]
                }]
            };
        return {
            aliases: ["html", "xhtml", "rss", "atom", "xsl", "plist"],
            cI: !0,
            c: [{
                cN: "doctype",
                b: "<!DOCTYPE",
                e: ">",
                r: 10,
                c: [{
                    b: "\\[",
                    e: "\\]"
                }]
            }, {
                cN: "comment",
                b: "<!--",
                e: "-->",
                r: 10
            }, {
                cN: "cdata",
                b: "<\\!\\[CDATA\\[",
                e: "\\]\\]>",
                r: 10
            }, {
                cN: "tag",
                b: "<style(?=\\s|>|$)",
                e: ">",
                k: {
                    title: "style"
                },
                c: [i],
                starts: {
                    e: "</style>",
                    rE: !0,
                    sL: "css"
                }
            }, {
                cN: "tag",
                b: "<script(?=\\s|>|$)",
                e: ">",
                k: {
                    title: "script"
                },
                c: [i],
                starts: {
                    e: "</script>",
                    rE: !0,
                    sL: "javascript"
                }
            }, e, {
                cN: "pi",
                b: /<\?\w+/,
                e: /\?>/,
                r: 10
            }, {
                cN: "tag",
                b: "</?",
                e: "/?>",
                c: [{
                    cN: "title",
                    b: /[^ \/><\n\t]+/,
                    r: 0
                }, i]
            }]
        }
    }), hljs.registerLanguage("javascript", function(t) {
        return {
            aliases: ["js"],
            k: {
                keyword: "in if for while finally var new function do return void else break catch instanceof with throw case default try this switch continue typeof delete let yield const class",
                literal: "true false null undefined NaN Infinity",
                built_in: "eval isFinite isNaN parseFloat parseInt decodeURI decodeURIComponent encodeURI encodeURIComponent escape unescape Object Function Boolean Error EvalError InternalError RangeError ReferenceError StopIteration SyntaxError TypeError URIError Number Math Date String RegExp Array Float32Array Float64Array Int16Array Int32Array Int8Array Uint16Array Uint32Array Uint8Array Uint8ClampedArray ArrayBuffer DataView JSON Intl arguments require module console window document"
            },
            c: [{
                cN: "pi",
                r: 10,
                v: [{
                    b: /^\s*('|")use strict('|")/
                }, {
                    b: /^\s*('|")use asm('|")/
                }]
            }, t.ASM, t.QSM, t.CLCM, t.CBCM, t.CNM, {
                b: "(" + t.RSR + "|\\b(case|return|throw)\\b)\\s*",
                k: "return throw case",
                c: [t.CLCM, t.CBCM, t.RM, {
                    b: /</,
                    e: />;/,
                    r: 0,
                    sL: "xml"
                }],
                r: 0
            }, {
                cN: "function",
                bK: "function",
                e: /\{/,
                eE: !0,
                c: [t.inherit(t.TM, {
                    b: /[A-Za-z$_][0-9A-Za-z$_]*/
                }), {
                    cN: "params",
                    b: /\(/,
                    e: /\)/,
                    c: [t.CLCM, t.CBCM],
                    i: /["'\(]/
                }],
                i: /\[|%/
            }, {
                b: /\$[(.]/
            }, {
                b: "\\." + t.IR,
                r: 0
            }]
        }
    }), hljs.registerLanguage("scss", function(t) {
        var e = "[a-zA-Z-][a-zA-Z0-9_-]*",
            i = {
                cN: "variable",
                b: "(\\$" + e + ")\\b"
            },
            n = {
                cN: "function",
                b: e + "\\(",
                rB: !0,
                eE: !0,
                e: "\\("
            },
            s = {
                cN: "hexcolor",
                b: "#[0-9A-Fa-f]+"
            };
        return {
            cN: "attribute",
            b: "[A-Z\\_\\.\\-]+",
            e: ":",
            eE: !0,
            i: "[^\\s]",
            starts: {
                cN: "value",
                eW: !0,
                eE: !0,
                c: [n, s, t.CSSNM, t.QSM, t.ASM, t.CBCM, {
                    cN: "important",
                    b: "!important"
                }]
            }
        }, {
            cI: !0,
            i: "[=/|']",
            c: [t.CLCM, t.CBCM, n, {
                cN: "id",
                b: "\\#[A-Za-z0-9_-]+",
                r: 0
            }, {
                cN: "class",
                b: "\\.[A-Za-z0-9_-]+",
                r: 0
            }, {
                cN: "attr_selector",
                b: "\\[",
                e: "\\]",
                i: "$"
            }, {
                cN: "tag",
                b: "\\b(a|abbr|acronym|address|area|article|aside|audio|b|base|big|blockquote|body|br|button|canvas|caption|cite|code|col|colgroup|command|datalist|dd|del|details|dfn|div|dl|dt|em|embed|fieldset|figcaption|figure|footer|form|frame|frameset|(h[1-6])|head|header|hgroup|hr|html|i|iframe|img|input|ins|kbd|keygen|label|legend|li|link|map|mark|meta|meter|nav|noframes|noscript|object|ol|optgroup|option|output|p|param|pre|progress|q|rp|rt|ruby|samp|script|section|select|small|span|strike|strong|style|sub|sup|table|tbody|td|textarea|tfoot|th|thead|time|title|tr|tt|ul|var|video)\\b",
                r: 0
            }, {
                cN: "pseudo",
                b: ":(visited|valid|root|right|required|read-write|read-only|out-range|optional|only-of-type|only-child|nth-of-type|nth-last-of-type|nth-last-child|nth-child|not|link|left|last-of-type|last-child|lang|invalid|indeterminate|in-range|hover|focus|first-of-type|first-line|first-letter|first-child|first|enabled|empty|disabled|default|checked|before|after|active)"
            }, {
                cN: "pseudo",
                b: "::(after|before|choices|first-letter|first-line|repeat-index|repeat-item|selection|value)"
            }, i, {
                cN: "attribute",
                b: "\\b(z-index|word-wrap|word-spacing|word-break|width|widows|white-space|visibility|vertical-align|unicode-bidi|transition-timing-function|transition-property|transition-duration|transition-delay|transition|transform-style|transform-origin|transform|top|text-underline-position|text-transform|text-shadow|text-rendering|text-overflow|text-indent|text-decoration-style|text-decoration-line|text-decoration-color|text-decoration|text-align-last|text-align|tab-size|table-layout|right|resize|quotes|position|pointer-events|perspective-origin|perspective|page-break-inside|page-break-before|page-break-after|padding-top|padding-right|padding-left|padding-bottom|padding|overflow-y|overflow-x|overflow-wrap|overflow|outline-width|outline-style|outline-offset|outline-color|outline|orphans|order|opacity|object-position|object-fit|normal|none|nav-up|nav-right|nav-left|nav-index|nav-down|min-width|min-height|max-width|max-height|mask|marks|margin-top|margin-right|margin-left|margin-bottom|margin|list-style-type|list-style-position|list-style-image|list-style|line-height|letter-spacing|left|justify-content|initial|inherit|ime-mode|image-orientation|image-resolution|image-rendering|icon|hyphens|height|font-weight|font-variant-ligatures|font-variant|font-style|font-stretch|font-size-adjust|font-size|font-language-override|font-kerning|font-feature-settings|font-family|font|float|flex-wrap|flex-shrink|flex-grow|flex-flow|flex-direction|flex-basis|flex|filter|empty-cells|display|direction|cursor|counter-reset|counter-increment|content|column-width|column-span|column-rule-width|column-rule-style|column-rule-color|column-rule|column-gap|column-fill|column-count|columns|color|clip-path|clip|clear|caption-side|break-inside|break-before|break-after|box-sizing|box-shadow|box-decoration-break|bottom|border-width|border-top-width|border-top-style|border-top-right-radius|border-top-left-radius|border-top-color|border-top|border-style|border-spacing|border-right-width|border-right-style|border-right-color|border-right|border-radius|border-left-width|border-left-style|border-left-color|border-left|border-image-width|border-image-source|border-image-slice|border-image-repeat|border-image-outset|border-image|border-color|border-collapse|border-bottom-width|border-bottom-style|border-bottom-right-radius|border-bottom-left-radius|border-bottom-color|border-bottom|border|background-size|background-repeat|background-position|background-origin|background-image|background-color|background-clip|background-attachment|background|backface-visibility|auto|animation-timing-function|animation-play-state|animation-name|animation-iteration-count|animation-fill-mode|animation-duration|animation-direction|animation-delay|animation|align-self|align-items|align-content)\\b",
                i: "[^\\s]"
            }, {
                cN: "value",
                b: "\\b(whitespace|wait|w-resize|visible|vertical-text|vertical-ideographic|uppercase|upper-roman|upper-alpha|underline|transparent|top|thin|thick|text|text-top|text-bottom|tb-rl|table-header-group|table-footer-group|sw-resize|super|strict|static|square|solid|small-caps|separate|se-resize|scroll|s-resize|rtl|row-resize|ridge|right|repeat|repeat-y|repeat-x|relative|progress|pointer|overline|outside|outset|oblique|nowrap|not-allowed|normal|none|nw-resize|no-repeat|no-drop|newspaper|ne-resize|n-resize|move|middle|medium|ltr|lr-tb|lowercase|lower-roman|lower-alpha|loose|list-item|line|line-through|line-edge|lighter|left|keep-all|justify|italic|inter-word|inter-ideograph|inside|inset|inline|inline-block|inherit|inactive|ideograph-space|ideograph-parenthesis|ideograph-numeric|ideograph-alpha|horizontal|hidden|help|hand|groove|fixed|ellipsis|e-resize|double|dotted|distribute|distribute-space|distribute-letter|distribute-all-lines|disc|disabled|default|decimal|dashed|crosshair|collapse|col-resize|circle|char|center|capitalize|break-word|break-all|bottom|both|bolder|bold|block|bidi-override|below|baseline|auto|always|all-scroll|absolute|table|table-cell)\\b"
            }, {
                cN: "value",
                b: ":",
                e: ";",
                c: [n, i, s, t.CSSNM, t.QSM, t.ASM, {
                    cN: "important",
                    b: "!important"
                }]
            }, {
                cN: "at_rule",
                b: "@",
                e: "[{;]",
                k: "mixin include extend for if else each while charset import debug media page content font-face namespace warn",
                c: [n, i, t.QSM, t.ASM, s, t.CSSNM, {
                    cN: "preprocessor",
                    b: "\\s[A-Za-z0-9_.-]+",
                    r: 0
                }]
            }]
        }
    }), hljs.registerLanguage("json", function(t) {
        var e = {
                literal: "true false null"
            },
            i = [t.QSM, t.CNM],
            n = {
                cN: "value",
                e: ",",
                eW: !0,
                eE: !0,
                c: i,
                k: e
            },
            s = {
                b: "{",
                e: "}",
                c: [{
                    cN: "attribute",
                    b: '\\s*"',
                    e: '"\\s*:\\s*',
                    eB: !0,
                    eE: !0,
                    c: [t.BE],
                    i: "\\n",
                    starts: n
                }],
                i: "\\S"
            },
            a = {
                b: "\\[",
                e: "\\]",
                c: [t.inherit(n, {
                    cN: null
                })],
                i: "\\S"
            };
        return i.splice(i.length, 0, s, a), {
            c: i,
            k: e,
            i: "\\S"
        }
    }), hljs.registerLanguage("css", function(t) {
        var e = "[a-zA-Z-][a-zA-Z0-9_-]*",
            i = {
                cN: "function",
                b: e + "\\(",
                rB: !0,
                eE: !0,
                e: "\\("
            };
        return {
            cI: !0,
            i: "[=/|']",
            c: [t.CBCM, {
                cN: "id",
                b: "\\#[A-Za-z0-9_-]+"
            }, {
                cN: "class",
                b: "\\.[A-Za-z0-9_-]+",
                r: 0
            }, {
                cN: "attr_selector",
                b: "\\[",
                e: "\\]",
                i: "$"
            }, {
                cN: "pseudo",
                b: ":(:)?[a-zA-Z0-9\\_\\-\\+\\(\\)\\\"\\']+"
            }, {
                cN: "at_rule",
                b: "@(font-face|page)",
                l: "[a-z-]+",
                k: "font-face page"
            }, {
                cN: "at_rule",
                b: "@",
                e: "[{;]",
                c: [{
                    cN: "keyword",
                    b: /\S+/
                }, {
                    b: /\s/,
                    eW: !0,
                    eE: !0,
                    r: 0,
                    c: [i, t.ASM, t.QSM, t.CSSNM]
                }]
            }, {
                cN: "tag",
                b: e,
                r: 0
            }, {
                cN: "rules",
                b: "{",
                e: "}",
                i: "[^\\s]",
                r: 0,
                c: [t.CBCM, {
                    cN: "rule",
                    b: "[^\\s]",
                    rB: !0,
                    e: ";",
                    eW: !0,
                    c: [{
                        cN: "attribute",
                        b: "[A-Z\\_\\.\\-]+",
                        e: ":",
                        eE: !0,
                        i: "[^\\s]",
                        starts: {
                            cN: "value",
                            eW: !0,
                            eE: !0,
                            c: [i, t.CSSNM, t.QSM, t.ASM, t.CBCM, {
                                cN: "hexcolor",
                                b: "#[0-9A-Fa-f]+"
                            }, {
                                cN: "important",
                                b: "!important"
                            }]
                        }
                    }]
                }]
            }]
        }
    }),
    function(t, e, i) {
        "undefined" != typeof module && module.exports ? module.exports = i() : "function" == typeof define && define.amd ? define(i) : e[t] = i()
    }("jquery-scrollto", this, function() {
        var t, e, i;
        return t = e = window.jQuery || require("jquery"), e.propHooks.scrollTop = e.propHooks.scrollLeft = {
            get: function(t, e) {
                var i = null;
                return ("HTML" === t.tagName || "BODY" === t.tagName) && ("scrollLeft" === e ? i = window.scrollX : "scrollTop" === e && (i = window.scrollY)), null == i && (i = t[e]), i
            }
        }, e.Tween.propHooks.scrollTop = e.Tween.propHooks.scrollLeft = {
            get: function(t) {
                return e.propHooks.scrollTop.get(t.elem, t.prop)
            },
            set: function(t) {
                "HTML" === t.elem.tagName || "BODY" === t.elem.tagName ? (t.options.bodyScrollLeft = t.options.bodyScrollLeft || window.scrollX, t.options.bodyScrollTop = t.options.bodyScrollTop || window.scrollY, "scrollLeft" === t.prop ? t.options.bodyScrollLeft = Math.round(t.now) : "scrollTop" === t.prop && (t.options.bodyScrollTop = Math.round(t.now)), window.scrollTo(t.options.bodyScrollLeft, t.options.bodyScrollTop)) : t.elem.nodeType && t.elem.parentNode && (t.elem[t.prop] = t.now)
            }
        }, i = {
            config: {
                duration: 400,
                easing: "swing",
                callback: void 0,
                durationMode: "each",
                offsetTop: 0,
                offsetLeft: 0
            },
            configure: function(t) {
                return e.extend(i.config, t || {}), this
            },
            scroll: function(t, n) {
                var s, a, o, r, l, d, c, h, p, u, g, f, m, v, _, b, y, w;
                return s = t.pop(), a = s.$container, o = s.$target, d = a.prop("tagName"), r = e("<span/>").css({
                    position: "absolute",
                    top: "0px",
                    left: "0px"
                }), l = a.css("position"), a.css({
                    position: "relative"
                }), r.appendTo(a), g = r.offset().top, f = o.offset().top, m = f - g - parseInt(n.offsetTop, 10), v = r.offset().left, _ = o.offset().left, b = _ - v - parseInt(n.offsetLeft, 10), c = a.prop("scrollTop"), h = a.prop("scrollLeft"), r.remove(), a.css({
                    position: l
                }), y = {}, w = function() {
                    return 0 === t.length ? "function" == typeof n.callback && n.callback() : i.scroll(t, n), !0
                }, n.onlyIfOutside && (p = c + a.height(), u = h + a.width(), m > c && p > m && (m = c), b > h && u > b && (b = h)), m !== c && (y.scrollTop = m), b !== h && (y.scrollLeft = b), a.prop("scrollHeight") === a.width() && delete y.scrollTop, a.prop("scrollWidth") === a.width() && delete y.scrollLeft, null != y.scrollTop || null != y.scrollLeft ? a.animate(y, {
                    duration: n.duration,
                    easing: n.easing,
                    complete: w
                }) : w(), !0
            },
            fn: function(t) {
                var n, s, a, o;
                n = [];
                var r = e(this);
                if (0 === r.length) return this;
                for (s = e.extend({}, i.config, t), a = r.parent(), o = a.get(0); 1 === a.length && o !== document.body && o !== document;) {
                    var l, d;
                    l = "visible" !== a.css("overflow-y") && o.scrollHeight !== o.clientHeight, d = "visible" !== a.css("overflow-x") && o.scrollWidth !== o.clientWidth, (l || d) && (n.push({
                        $container: a,
                        $target: r
                    }), r = a), a = a.parent(), o = a.get(0)
                }
                return n.push({
                    $container: e("html"),
                    $target: r
                }), "all" === s.durationMode && (s.duration /= n.length), i.scroll(n, s), this
            }
        }, e.ScrollTo = e.ScrollTo || i, e.fn.ScrollTo = e.fn.ScrollTo || i.fn, i
    }),
    function(t) {
        function e() {
            var t = location.href;
            return hashtag = -1 !== t.indexOf("#prettyPhoto") ? decodeURI(t.substring(t.indexOf("#prettyPhoto") + 1, t.length)) : !1
        }

        function i() {
            "undefined" != typeof theRel && (location.hash = theRel + "/" + rel_index + "/")
        }

        function n() {
            -1 !== location.href.indexOf("#prettyPhoto") && (location.hash = "prettyPhoto")
        }

        function s(t, e) {
            t = t.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var i = "[\\?&]" + t + "=([^&#]*)",
                n = new RegExp(i),
                s = n.exec(e);
            return null == s ? "" : s[1]
        }
        t.prettyPhoto = {
            version: "3.1.5"
        }, t.fn.prettyPhoto = function(a) {
            function o() {
                t(".pp_loaderIcon").hide(), projectedTop = scroll_pos.scrollTop + (S / 2 - v.containerHeight / 2), 0 > projectedTop && (projectedTop = 0), $ppt.fadeTo(settings.animation_speed, 1), $pp_pic_holder.find(".pp_content").animate({
                    height: v.contentHeight,
                    width: v.contentWidth
                }, settings.animation_speed), $pp_pic_holder.animate({
                    top: projectedTop,
                    left: T / 2 - v.containerWidth / 2 < 0 ? 0 : T / 2 - v.containerWidth / 2,
                    width: v.containerWidth
                }, settings.animation_speed, function() {
                    $pp_pic_holder.find(".pp_hoverContainer,#fullResImage").height(v.height).width(v.width), $pp_pic_holder.find(".pp_fade").fadeIn(settings.animation_speed), isSet && "image" == h(pp_images[set_position]) ? $pp_pic_holder.find(".pp_hoverContainer").show() : $pp_pic_holder.find(".pp_hoverContainer").hide(), settings.allow_expand && (v.resized ? t("a.pp_expand,a.pp_contract").show() : t("a.pp_expand").hide()), !settings.autoplay_slideshow || x || _ || t.prettyPhoto.startSlideshow(), settings.changepicturecallback(), _ = !0
                }), f(), a.ajaxcallback()
            }

            function r(e) {
                $pp_pic_holder.find("#pp_full_res object,#pp_full_res embed").css("visibility", "hidden"), $pp_pic_holder.find(".pp_fade").fadeOut(settings.animation_speed, function() {
                    t(".pp_loaderIcon").show(), e()
                })
            }

            function l(e) {
                e > 1 ? t(".pp_nav").show() : t(".pp_nav").hide()
            }

            function d(t, e) {
                if (resized = !1, c(t, e), imageWidth = t, imageHeight = e, (k > T || w > S) && doresize && settings.allow_resize && !C) {
                    for (resized = !0, fitting = !1; !fitting;) k > T ? (imageWidth = T - 200, imageHeight = e / t * imageWidth) : w > S ? (imageHeight = S - 200, imageWidth = t / e * imageHeight) : fitting = !0, w = imageHeight, k = imageWidth;
                    (k > T || w > S) && d(k, w), c(imageWidth, imageHeight)
                }
                return {
                    width: Math.floor(imageWidth),
                    height: Math.floor(imageHeight),
                    containerHeight: Math.floor(w),
                    containerWidth: Math.floor(k) + 2 * settings.horizontal_padding,
                    contentHeight: Math.floor(b),
                    contentWidth: Math.floor(y),
                    resized: resized
                }
            }

            function c(e, i) {
                e = parseFloat(e), i = parseFloat(i), $pp_details = $pp_pic_holder.find(".pp_details"), $pp_details.width(e), detailsHeight = parseFloat($pp_details.css("marginTop")) + parseFloat($pp_details.css("marginBottom")), $pp_details = $pp_details.clone().addClass(settings.theme).width(e).appendTo(t("body")).css({
                    position: "absolute",
                    top: -1e4
                }), detailsHeight += $pp_details.height(), detailsHeight = 34 >= detailsHeight ? 36 : detailsHeight, $pp_details.remove(), $pp_title = $pp_pic_holder.find(".ppt"), $pp_title.width(e), titleHeight = parseFloat($pp_title.css("marginTop")) + parseFloat($pp_title.css("marginBottom")), $pp_title = $pp_title.clone().appendTo(t("body")).css({
                    position: "absolute",
                    top: -1e4
                }), titleHeight += $pp_title.height(), $pp_title.remove(), b = i + detailsHeight, y = e, w = b + titleHeight + $pp_pic_holder.find(".pp_top").height() + $pp_pic_holder.find(".pp_bottom").height(), k = e
            }

            function h(t) {
                return t.match(/youtube\.com\/watch/i) || t.match(/youtu\.be/i) ? "youtube" : t.match(/vimeo\.com/i) ? "vimeo" : t.match(/\b.mov\b/i) ? "quicktime" : t.match(/\b.swf\b/i) ? "flash" : t.match(/\biframe=true\b/i) ? "iframe" : t.match(/\bajax=true\b/i) ? "ajax" : t.match(/\bcustom=true\b/i) ? "custom" : "#" == t.substr(0, 1) ? "inline" : "image"
            }

            function p() {
                if (doresize && "undefined" != typeof $pp_pic_holder) {
                    if (scroll_pos = u(), contentHeight = $pp_pic_holder.height(), contentwidth = $pp_pic_holder.width(), projectedTop = S / 2 + scroll_pos.scrollTop - contentHeight / 2, 0 > projectedTop && (projectedTop = 0), contentHeight > S) return;
                    $pp_pic_holder.css({
                        top: projectedTop,
                        left: T / 2 + scroll_pos.scrollLeft - contentwidth / 2
                    })
                }
            }

            function u() {
                return self.pageYOffset ? {
                    scrollTop: self.pageYOffset,
                    scrollLeft: self.pageXOffset
                } : document.documentElement && document.documentElement.scrollTop ? {
                    scrollTop: document.documentElement.scrollTop,
                    scrollLeft: document.documentElement.scrollLeft
                } : document.body ? {
                    scrollTop: document.body.scrollTop,
                    scrollLeft: document.body.scrollLeft
                } : void 0
            }

            function g() {
                S = t(window).height(), T = t(window).width(), "undefined" != typeof $pp_overlay && $pp_overlay.height(t(document).height()).width(T)
            }

            function f() {
                isSet && settings.overlay_gallery && "image" == h(pp_images[set_position]) ? (itemWidth = 57, navWidth = "facebook" == settings.theme || "pp_default" == settings.theme ? 50 : 30, itemsPerPage = Math.floor((v.containerWidth - 100 - navWidth) / itemWidth), itemsPerPage = itemsPerPage < pp_images.length ? itemsPerPage : pp_images.length, totalPage = Math.ceil(pp_images.length / itemsPerPage) - 1, 0 == totalPage ? (navWidth = 0, $pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").hide()) : $pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").show(), galleryWidth = itemsPerPage * itemWidth, fullGalleryWidth = pp_images.length * itemWidth, $pp_gallery.css("margin-left", -(galleryWidth / 2 + navWidth / 2)).find("div:first").width(galleryWidth + 5).find("ul").width(fullGalleryWidth).find("li.selected").removeClass("selected"), goToPage = Math.floor(set_position / itemsPerPage) < totalPage ? Math.floor(set_position / itemsPerPage) : totalPage, t.prettyPhoto.changeGalleryPage(goToPage), $pp_gallery_li.filter(":eq(" + set_position + ")").addClass("selected")) : $pp_pic_holder.find(".pp_content").unbind("mouseenter mouseleave")
            }

            function m() {
                if (settings.social_tools && (facebook_like_link = settings.social_tools.replace("{location_href}", encodeURIComponent(location.href))), settings.markup = settings.markup.replace("{pp_social}", ""), t("body").append(settings.markup), $pp_pic_holder = t(".pp_pic_holder"), $ppt = t(".ppt"), $pp_overlay = t("div.pp_overlay"), isSet && settings.overlay_gallery) {
                    currentGalleryPage = 0, toInject = "";
                    for (var e = 0; e < pp_images.length; e++) pp_images[e].match(/\b(jpg|jpeg|png|gif)\b/gi) ? (classname = "", img_src = pp_images[e]) : (classname = "default", img_src = ""), toInject += "<li class='" + classname + "'><a href='#'><img src='" + img_src + "' width='50' alt='' /></a></li>";
                    toInject = settings.gallery_markup.replace(/{gallery}/g, toInject), $pp_pic_holder.find("#pp_full_res").after(toInject), $pp_gallery = t(".pp_pic_holder .pp_gallery"), $pp_gallery_li = $pp_gallery.find("li"), $pp_gallery.find(".pp_arrow_next").click(function() {
                        return t.prettyPhoto.changeGalleryPage("next"), t.prettyPhoto.stopSlideshow(), !1
                    }), $pp_gallery.find(".pp_arrow_previous").click(function() {
                        return t.prettyPhoto.changeGalleryPage("previous"), t.prettyPhoto.stopSlideshow(), !1
                    }), $pp_pic_holder.find(".pp_content").hover(function() {
                        $pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeIn()
                    }, function() {
                        $pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeOut()
                    }), itemWidth = 57, $pp_gallery_li.each(function(e) {
                        t(this).find("a").click(function() {
                            return t.prettyPhoto.changePage(e), t.prettyPhoto.stopSlideshow(), !1
                        })
                    })
                }
                settings.slideshow && ($pp_pic_holder.find(".pp_nav").prepend('<a href="#" class="pp_play"></a>'), $pp_pic_holder.find(".pp_nav .pp_play").click(function() {
                    return t.prettyPhoto.startSlideshow(), !1
                })), $pp_pic_holder.attr("class", "pp_pic_holder " + settings.theme), $pp_overlay.css({
                    opacity: 0,
                    height: t(document).height(),
                    width: t(window).width()
                }).bind("click", function() {
                    settings.modal || t.prettyPhoto.close()
                }), t("a.pp_close").bind("click", function() {
                    return t.prettyPhoto.close(), !1
                }), settings.allow_expand && t("a.pp_expand").bind("click", function() {
                    return t(this).hasClass("pp_expand") ? (t(this).removeClass("pp_expand").addClass("pp_contract"), doresize = !1) : (t(this).removeClass("pp_contract").addClass("pp_expand"), doresize = !0), r(function() {
                        t.prettyPhoto.open()
                    }), !1
                }), $pp_pic_holder.find(".pp_previous, .pp_nav .pp_arrow_previous").bind("click", function() {
                    return t.prettyPhoto.changePage("previous"), t.prettyPhoto.stopSlideshow(), !1
                }), $pp_pic_holder.find(".pp_next, .pp_nav .pp_arrow_next").bind("click", function() {
                    return t.prettyPhoto.changePage("next"), t.prettyPhoto.stopSlideshow(), !1
                }), p()
            }
            a = jQuery.extend({
                hook: "rel",
                animation_speed: "fast",
                ajaxcallback: function() {},
                slideshow: 5e3,
                autoplay_slideshow: !1,
                opacity: .8,
                show_title: !0,
                allow_resize: !0,
                allow_expand: !0,
                default_width: 500,
                default_height: 344,
                counter_separator_label: "/",
                theme: "pp_default",
                horizontal_padding: 20,
                hideflash: !1,
                wmode: "opaque",
                autoplay: !0,
                modal: !1,
                deeplinking: !0,
                overlay_gallery: !0,
                overlay_gallery_max: 30,
                keyboard_shortcuts: !0,
                changepicturecallback: function() {},
                callback: function() {},
                ie6_fallback: !0,
                markup: '<div class="pp_pic_holder"> 						<div class="ppt">Â </div> 						<div class="pp_top"> 							<div class="pp_left"></div> 							<div class="pp_middle"></div> 							<div class="pp_right"></div> 						</div> 						<div class="pp_content_container"> 							<div class="pp_left"> 							<div class="pp_right"> 								<div class="pp_content"> 									<div class="pp_loaderIcon"></div> 									<div class="pp_fade"> 										<a href="#" class="pp_expand" title="Expand the image"></a> 										<div class="pp_hoverContainer"> 											<a class="pp_next" href="#"></a> 											<a class="pp_previous" href="#"></a> 										</div> 										<div id="pp_full_res"></div> 										<div class="pp_details"> 											<div class="pp_nav"> 												<a href="#" class="pp_arrow_previous"></a> 												<p class="currentTextHolder">0/0</p> 												<a href="#" class="pp_arrow_next"></a> 											</div> 											<p class="pp_description"></p> 											<div class="pp_social">{pp_social}</div> 											<a class="pp_close" href="#"></a> 										</div> 									</div> 								</div> 							</div> 							</div> 						</div> 						<div class="pp_bottom"> 							<div class="pp_left"></div> 							<div class="pp_middle"></div> 							<div class="pp_right"></div> 						</div> 					</div> 					<div class="pp_overlay"></div>',
                gallery_markup: '<div class="pp_gallery"> 								<a href="#" class="pp_arrow_previous"></a> 								<div> 									<ul> 										{gallery} 									</ul> 								</div> 								<a href="#" class="pp_arrow_next"></a> 							</div>',
                image_markup: '<img id="fullResImage" src="{path}" />',
                flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
                quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
                iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
                inline_markup: '<div class="pp_inline">{content}</div>',
                custom_markup: "",
                social_tools: '<div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href={location_href}&layout=button_count&show_faces=true&width=500&action=like&font&colorscheme=light&height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div>'
            }, a);
            var v, _, b, y, w, k, x, D = this,
                C = !1,
                S = t(window).height(),
                T = t(window).width();
            return doresize = !0, scroll_pos = u(), t(window).unbind("resize.prettyphoto").bind("resize.prettyphoto", function() {
                p(), g()
            }), a.keyboard_shortcuts && t(document).unbind("keydown.prettyphoto").bind("keydown.prettyphoto", function(e) {
                if ("undefined" != typeof $pp_pic_holder && $pp_pic_holder.is(":visible")) switch (e.keyCode) {
                    case 37:
                        t.prettyPhoto.changePage("previous"), e.preventDefault();
                        break;
                    case 39:
                        t.prettyPhoto.changePage("next"), e.preventDefault();
                        break;
                    case 27:
                        settings.modal || t.prettyPhoto.close(), e.preventDefault()
                }
            }), t.prettyPhoto.initialize = function() {
                return settings = a, "pp_default" == settings.theme && (settings.horizontal_padding = 16), theRel = t(this).attr(settings.hook), galleryRegExp = /\[(?:.*)\]/, isSet = galleryRegExp.exec(theRel) ? !0 : !1, pp_images = isSet ? jQuery.map(D, function(e) {
                    return -1 != t(e).attr(settings.hook).indexOf(theRel) ? t(e).attr("href") : void 0
                }) : t.makeArray(t(this).attr("href")), pp_titles = isSet ? jQuery.map(D, function(e) {
                    return -1 != t(e).attr(settings.hook).indexOf(theRel) ? t(e).find("img").attr("alt") ? t(e).find("img").attr("alt") : "" : void 0
                }) : t.makeArray(t(this).find("img").attr("alt")), pp_descriptions = isSet ? jQuery.map(D, function(e) {
                    return -1 != t(e).attr(settings.hook).indexOf(theRel) ? t(e).attr("title") ? t(e).attr("title") : "" : void 0
                }) : t.makeArray(t(this).attr("title")), pp_images.length > settings.overlay_gallery_max && (settings.overlay_gallery = !1), set_position = jQuery.inArray(t(this).attr("href"), pp_images), rel_index = isSet ? set_position : t("a[" + settings.hook + "^='" + theRel + "']").index(t(this)), m(this), settings.allow_resize && t(window).bind("scroll.prettyphoto", function() {
                    p()
                }), t.prettyPhoto.open(), !1
            }, t.prettyPhoto.open = function(e) {
                return "undefined" == typeof settings && (settings = a, pp_images = t.makeArray(arguments[0]), pp_titles = t.makeArray(arguments[1] ? arguments[1] : ""), pp_descriptions = t.makeArray(arguments[2] ? arguments[2] : ""), isSet = pp_images.length > 1 ? !0 : !1, set_position = arguments[3] ? arguments[3] : 0, m(e.target)), settings.hideflash && t("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility", "hidden"), l(t(pp_images).size()), t(".pp_loaderIcon").show(), settings.deeplinking && i(), settings.social_tools && (facebook_like_link = settings.social_tools.replace("{location_href}", encodeURIComponent(location.href)), $pp_pic_holder.find(".pp_social").html(facebook_like_link)), $ppt.is(":hidden") && $ppt.css("opacity", 0).show(), $pp_overlay.show().fadeTo(settings.animation_speed, settings.opacity), $pp_pic_holder.find(".currentTextHolder").text(set_position + 1 + settings.counter_separator_label + t(pp_images).size()), "undefined" != typeof pp_descriptions[set_position] && "" != pp_descriptions[set_position] ? $pp_pic_holder.find(".pp_description").show().html(unescape(pp_descriptions[set_position])) : $pp_pic_holder.find(".pp_description").hide(), movie_width = parseFloat(s("width", pp_images[set_position])) ? s("width", pp_images[set_position]) : settings.default_width.toString(), movie_height = parseFloat(s("height", pp_images[set_position])) ? s("height", pp_images[set_position]) : settings.default_height.toString(), C = !1, -1 != movie_height.indexOf("%") && (movie_height = parseFloat(t(window).height() * parseFloat(movie_height) / 100 - 150), C = !0), -1 != movie_width.indexOf("%") && (movie_width = parseFloat(t(window).width() * parseFloat(movie_width) / 100 - 150), C = !0), $pp_pic_holder.fadeIn(function() {
                    switch ($ppt.html(settings.show_title && "" != pp_titles[set_position] && "undefined" != typeof pp_titles[set_position] ? unescape(pp_titles[set_position]) : "Â "), imgPreloader = "", skipInjection = !1, h(pp_images[set_position])) {
                        case "image":
                            imgPreloader = new Image, nextImage = new Image, isSet && set_position < t(pp_images).size() - 1 && (nextImage.src = pp_images[set_position + 1]), prevImage = new Image, isSet && pp_images[set_position - 1] && (prevImage.src = pp_images[set_position - 1]), $pp_pic_holder.find("#pp_full_res")[0].innerHTML = settings.image_markup.replace(/{path}/g, pp_images[set_position]), imgPreloader.onload = function() {
                                v = d(imgPreloader.width, imgPreloader.height), o()
                            }, imgPreloader.onerror = function() {
                                alert("Image cannot be loaded. Make sure the path is correct and image exist."), t.prettyPhoto.close()
                            }, imgPreloader.src = pp_images[set_position];
                            break;
                        case "youtube":
                            v = d(movie_width, movie_height), movie_id = s("v", pp_images[set_position]), "" == movie_id && (movie_id = pp_images[set_position].split("youtu.be/"), movie_id = movie_id[1], movie_id.indexOf("?") > 0 && (movie_id = movie_id.substr(0, movie_id.indexOf("?"))), movie_id.indexOf("&") > 0 && (movie_id = movie_id.substr(0, movie_id.indexOf("&")))), movie = "http://www.youtube.com/embed/" + movie_id, movie += s("rel", pp_images[set_position]) ? "?rel=" + s("rel", pp_images[set_position]) : "?rel=1", settings.autoplay && (movie += "&autoplay=1"), toInject = settings.iframe_markup.replace(/{width}/g, v.width).replace(/{height}/g, v.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g, movie);
                            break;
                        case "vimeo":
                            v = d(movie_width, movie_height), movie_id = pp_images[set_position];
                            var e = /http(s?):\/\/(www\.)?vimeo.com\/(\d+)/,
                                i = movie_id.match(e);
                            movie = "http://player.vimeo.com/video/" + i[3] + "?title=0&byline=0&portrait=0", settings.autoplay && (movie += "&autoplay=1;"), vimeo_width = v.width + "/embed/?moog_width=" + v.width, toInject = settings.iframe_markup.replace(/{width}/g, vimeo_width).replace(/{height}/g, v.height).replace(/{path}/g, movie);
                            break;
                        case "quicktime":
                            v = d(movie_width, movie_height), v.height += 15, v.contentHeight += 15, v.containerHeight += 15, toInject = settings.quicktime_markup.replace(/{width}/g, v.width).replace(/{height}/g, v.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g, pp_images[set_position]).replace(/{autoplay}/g, settings.autoplay);
                            break;
                        case "flash":
                            v = d(movie_width, movie_height), flash_vars = pp_images[set_position], flash_vars = flash_vars.substring(pp_images[set_position].indexOf("flashvars") + 10, pp_images[set_position].length), filename = pp_images[set_position], filename = filename.substring(0, filename.indexOf("?")), toInject = settings.flash_markup.replace(/{width}/g, v.width).replace(/{height}/g, v.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g, filename + "?" + flash_vars);
                            break;
                        case "iframe":
                            v = d(movie_width, movie_height), frame_url = pp_images[set_position], frame_url = frame_url.substr(0, frame_url.indexOf("iframe") - 1), toInject = settings.iframe_markup.replace(/{width}/g, v.width).replace(/{height}/g, v.height).replace(/{path}/g, frame_url);
                            break;
                        case "ajax":
                            doresize = !1, v = d(movie_width, movie_height), doresize = !0, skipInjection = !0, t.get(pp_images[set_position], function(t) {
                                toInject = settings.inline_markup.replace(/{content}/g, t), $pp_pic_holder.find("#pp_full_res")[0].innerHTML = toInject, o()
                            });
                            break;
                        case "custom":
                            v = d(movie_width, movie_height), toInject = settings.custom_markup;
                            break;
                        case "inline":
                            myClone = t(pp_images[set_position]).clone().append('<br clear="all" />').css({
                                width: settings.default_width
                            }).wrapInner('<div id="pp_full_res"><div class="pp_inline"></div></div>').appendTo(t("body")).show(), doresize = !1, v = d(t(myClone).width(), t(myClone).height()), doresize = !0, t(myClone).remove(), toInject = settings.inline_markup.replace(/{content}/g, t(pp_images[set_position]).html())
                    }
                    imgPreloader || skipInjection || ($pp_pic_holder.find("#pp_full_res")[0].innerHTML = toInject, o())
                }), !1
            }, t.prettyPhoto.changePage = function(e) {
                currentGalleryPage = 0, "previous" == e ? (set_position--, 0 > set_position && (set_position = t(pp_images).size() - 1)) : "next" == e ? (set_position++, set_position > t(pp_images).size() - 1 && (set_position = 0)) : set_position = e, rel_index = set_position, doresize || (doresize = !0), settings.allow_expand && t(".pp_contract").removeClass("pp_contract").addClass("pp_expand"), r(function() {
                    t.prettyPhoto.open()
                })
            }, t.prettyPhoto.changeGalleryPage = function(t) {
                "next" == t ? (currentGalleryPage++, currentGalleryPage > totalPage && (currentGalleryPage = 0)) : "previous" == t ? (currentGalleryPage--, 0 > currentGalleryPage && (currentGalleryPage = totalPage)) : currentGalleryPage = t, slide_speed = "next" == t || "previous" == t ? settings.animation_speed : 0, slide_to = currentGalleryPage * itemsPerPage * itemWidth, $pp_gallery.find("ul").animate({
                    left: -slide_to
                }, slide_speed)
            }, t.prettyPhoto.startSlideshow = function() {
                "undefined" == typeof x ? ($pp_pic_holder.find(".pp_play").unbind("click").removeClass("pp_play").addClass("pp_pause").click(function() {
                    return t.prettyPhoto.stopSlideshow(), !1
                }), x = setInterval(t.prettyPhoto.startSlideshow, settings.slideshow)) : t.prettyPhoto.changePage("next")
            }, t.prettyPhoto.stopSlideshow = function() {
                $pp_pic_holder.find(".pp_pause").unbind("click").removeClass("pp_pause").addClass("pp_play").click(function() {
                    return t.prettyPhoto.startSlideshow(), !1
                }), clearInterval(x), x = void 0
            }, t.prettyPhoto.close = function() {
                $pp_overlay.is(":animated") || (t.prettyPhoto.stopSlideshow(), $pp_pic_holder.stop().find("object,embed").css("visibility", "hidden"), t("div.pp_pic_holder,div.ppt,.pp_fade").fadeOut(settings.animation_speed, function() {
                    t(this).remove()
                }), $pp_overlay.fadeOut(settings.animation_speed, function() {
                    settings.hideflash && t("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility", "visible"), t(this).remove(), t(window).unbind("scroll.prettyphoto"), n(), settings.callback(), doresize = !0, _ = !1, delete settings
                }))
            }, !pp_alreadyInitialized && e() && (pp_alreadyInitialized = !0, hashIndex = e(), hashRel = hashIndex, hashIndex = hashIndex.substring(hashIndex.indexOf("/") + 1, hashIndex.length - 1), hashRel = hashRel.substring(0, hashRel.indexOf("/")), setTimeout(function() {
                t("a[" + a.hook + "^='" + hashRel + "']:eq(" + hashIndex + ")").trigger("click")
            }, 50)), this.unbind("click.prettyphoto").bind("click.prettyphoto", t.prettyPhoto.initialize)
        }
    }(jQuery);
var pp_alreadyInitialized = !1;
(function() {
    var t, e, i = function(t, e) {
        return function() {
            return t.apply(e, arguments)
        }
    };
    t = function() {
        function t() {}
        return t.prototype.extend = function(t, e) {
            var i, n;
            for (i in t) n = t[i], null != n && (e[i] = n);
            return e
        }, t.prototype.isMobile = function(t) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(t)
        }, t
    }(), e = this.WeakMap || (e = function() {
        function t() {
            this.keys = [], this.values = []
        }
        return t.prototype.get = function(t) {
            var e, i, n, s, a;
            for (a = this.keys, e = n = 0, s = a.length; s > n; e = ++n)
                if (i = a[e], i === t) return this.values[e]
        }, t.prototype.set = function(t, e) {
            var i, n, s, a, o;
            for (o = this.keys, i = s = 0, a = o.length; a > s; i = ++s)
                if (n = o[i], n === t) return void(this.values[i] = e);
            return this.keys.push(t), this.values.push(e)
        }, t
    }()), this.WOW = function() {
        function n(t) {
            null == t && (t = {}), this.scrollCallback = i(this.scrollCallback, this), this.scrollHandler = i(this.scrollHandler, this), this.start = i(this.start, this), this.scrolled = !0, this.config = this.util().extend(t, this.defaults), this.animationNameCache = new e
        }
        return n.prototype.defaults = {
            boxClass: "wow",
            animateClass: "animated",
            offset: 0,
            mobile: !0
        }, n.prototype.init = function() {
            var t;
            return this.element = window.document.documentElement, "interactive" === (t = document.readyState) || "complete" === t ? this.start() : document.addEventListener("DOMContentLoaded", this.start)
        }, n.prototype.start = function() {
            var t, e, i, n;
            if (this.boxes = this.element.getElementsByClassName(this.config.boxClass), this.boxes.length) {
                if (this.disabled()) return this.resetStyle();
                for (n = this.boxes, e = 0, i = n.length; i > e; e++) t = n[e], this.applyStyle(t, !0);
                return window.addEventListener("scroll", this.scrollHandler, !1), window.addEventListener("resize", this.scrollHandler, !1), this.interval = setInterval(this.scrollCallback, 50)
            }
        }, n.prototype.stop = function() {
            return window.removeEventListener("scroll", this.scrollHandler, !1), window.removeEventListener("resize", this.scrollHandler, !1), null != this.interval ? clearInterval(this.interval) : void 0
        }, n.prototype.show = function(t) {
            return this.applyStyle(t), t.className = "" + t.className + " " + this.config.animateClass
        }, n.prototype.applyStyle = function(t, e) {
            var i, n, s;
            return n = t.getAttribute("data-wow-duration"), i = t.getAttribute("data-wow-delay"), s = t.getAttribute("data-wow-iteration"), this.animate(function(a) {
                return function() {
                    return a.customStyle(t, e, n, i, s)
                }
            }(this))
        }, n.prototype.animate = function() {
            return "requestAnimationFrame" in window ? function(t) {
                return window.requestAnimationFrame(t)
            } : function(t) {
                return t()
            }
        }(), n.prototype.resetStyle = function() {
            var t, e, i, n, s;
            for (n = this.boxes, s = [], e = 0, i = n.length; i > e; e++) t = n[e], s.push(t.setAttribute("style", "visibility: visible;"));
            return s
        }, n.prototype.customStyle = function(t, e, i, n, s) {
            return e && this.cacheAnimationName(t), t.style.visibility = e ? "hidden" : "visible", i && this.vendorSet(t.style, {
                animationDuration: i
            }), n && this.vendorSet(t.style, {
                animationDelay: n
            }), s && this.vendorSet(t.style, {
                animationIterationCount: s
            }), this.vendorSet(t.style, {
                animationName: e ? "none" : this.cachedAnimationName(t)
            }), t
        }, n.prototype.vendors = ["moz", "webkit"], n.prototype.vendorSet = function(t, e) {
            var i, n, s, a;
            a = [];
            for (i in e) n = e[i], t["" + i] = n, a.push(function() {
                var e, a, o, r;
                for (o = this.vendors, r = [], e = 0, a = o.length; a > e; e++) s = o[e], r.push(t["" + s + i.charAt(0).toUpperCase() + i.substr(1)] = n);
                return r
            }.call(this));
            return a
        }, n.prototype.vendorCSS = function(t, e) {
            var i, n, s, a, o, r;
            for (n = window.getComputedStyle(t), i = n.getPropertyCSSValue(e), r = this.vendors, a = 0, o = r.length; o > a; a++) s = r[a], i = i || n.getPropertyCSSValue("-" + s + "-" + e);
            return i
        }, n.prototype.animationName = function(t) {
            var e;
            try {
                e = this.vendorCSS(t, "animation-name").cssText
            } catch (i) {
                e = window.getComputedStyle(t).getPropertyValue("animation-name")
            }
            return "none" === e ? "" : e
        }, n.prototype.cacheAnimationName = function(t) {
            return this.animationNameCache.set(t, this.animationName(t))
        }, n.prototype.cachedAnimationName = function(t) {
            return this.animationNameCache.get(t)
        }, n.prototype.scrollHandler = function() {
            return this.scrolled = !0
        }, n.prototype.scrollCallback = function() {
            var t;
            return this.scrolled && (this.scrolled = !1, this.boxes = function() {
                var e, i, n, s;
                for (n = this.boxes, s = [], e = 0, i = n.length; i > e; e++) t = n[e], t && (this.isVisible(t) ? this.show(t) : s.push(t));
                return s
            }.call(this), !this.boxes.length) ? this.stop() : void 0
        }, n.prototype.offsetTop = function(t) {
            for (var e; void 0 === t.offsetTop;) t = t.parentNode;
            for (e = t.offsetTop; t = t.offsetParent;) e += t.offsetTop;
            return e
        }, n.prototype.isVisible = function(t) {
            var e, i, n, s, a;
            return i = t.getAttribute("data-wow-offset") || this.config.offset, a = window.pageYOffset, s = a + this.element.clientHeight - i, n = this.offsetTop(t), e = n + t.clientHeight, s >= n && e >= a
        }, n.prototype.util = function() {
            return this._util || (this._util = new t)
        }, n.prototype.disabled = function() {
            return !this.config.mobile && this.util().isMobile(navigator.userAgent)
        }, n
    }()
}).call(this);
var htmlMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;",
    "/": "&#x2F;"
};
$(window).load(function() {
    $(".page-preloader .anim").fadeOut(), $(".page-preloader").fadeOut(), $("body").delay(350).queue(function() {
        $(this).removeClass("preload")
    })
}), $().ready(function() {
    function t() {
        e = $(".nav-top").height() + $(".main-header").height();
        var t = "fixed";
        $(window).width() > 767 && void 0 == window.dontToggle && (window.scrollY > e ? i.addClass(t) : i.removeClass(t))
    }
    var e = $(".nav-top").height() + $(".main-header").height(),
        i = $(".nav-bottom");
    t(), $(window).scroll(function() {
        t()
    }), $(window).resize(function() {
        t()
    }), $("a[data-gal^='prettyPhoto']").prettyPhoto({
        hook: "data-gal",
        overlay_gallery: !1,
        social_tools: !1
    }), $(".format-code").each(function() {
        var t = escapeHtml($(this).html());
        $(this).html(t)
    }), $(".hl-code").each(function(t, e) {
        hljs.highlightBlock(e)
    }), $(".ul-toggle li").click(function() {
        $(this).toggleClass("active").find("ul").toggle("slow")
    }), $("[data-keep-open=true]").click(function(t) {
        t.stopPropagation()
    }), $("[data-call=bs-modal]").each(function() {
        var t = $(this).attr("data-options");
        if (t) {
            var e = jsonify(t);
            $(this).modal(e)
        }
    })
}), $().ready(function() {
    var t = "switcher.code";
    $.ajax({
        crossOrigin: !0,
        url: t,
        dataType: "html",
        success: function(t) {
            $("body").append(t)
        },
        error: function(t) {
            console.log(t.statusText)
        }
    })
});