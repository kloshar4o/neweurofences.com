


!function (e, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function (e) {
        if (!e.document) throw new Error("jQuery requires a window with a document");
        return t(e)
    } : t(e)
}("undefined" != typeof window ? window : this, function (e, t) {
    "use strict";

    function i(e, t, i) {
        t = t || re;
        var n, s = t.createElement("script");
        if (s.text = e, i) for (n in be) i[n] && (s[n] = i[n]);
        t.head.appendChild(s).parentNode.removeChild(s)
    }

    function n(e) {
        return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? he[pe.call(e)] || "object" : typeof e
    }

    function s(e) {
        var t = !!e && "length" in e && e.length, i = n(e);
        return !ye(e) && !xe(e) && ("array" === i || 0 === t || "number" == typeof t && t > 0 && t - 1 in e)
    }

    function o(e, t) {
        return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
    }

    function r(e, t, i) {
        return ye(t) ? _e.grep(e, function (e, n) {
            return !!t.call(e, n, e) !== i
        }) : t.nodeType ? _e.grep(e, function (e) {
            return e === t !== i
        }) : "string" != typeof t ? _e.grep(e, function (e) {
            return de.call(t, e) > -1 !== i
        }) : _e.filter(t, e, i)
    }

    function a(e, t) {
        for (; (e = e[t]) && 1 !== e.nodeType;) ;
        return e
    }

    function l(e) {
        var t = {};
        return _e.each(e.match(De) || [], function (e, i) {
            t[i] = !0
        }), t
    }

    function c(e) {
        return e
    }

    function u(e) {
        throw e
    }

    function d(e, t, i, n) {
        var s;
        try {
            e && ye(s = e.promise) ? s.call(e).done(t).fail(i) : e && ye(s = e.then) ? s.call(e, t, i) : t.apply(void 0, [e].slice(n))
        } catch (e) {
            i.apply(void 0, [e])
        }
    }

    function h() {
        re.removeEventListener("DOMContentLoaded", h), e.removeEventListener("load", h), _e.ready()
    }

    function p(e, t) {
        return t.toUpperCase()
    }

    function f(e) {
        return e.replace(Re, "ms-").replace(je, p)
    }

    function g() {
        this.expando = _e.expando + g.uid++
    }

    function m(e) {
        return "true" === e || "false" !== e && ("null" === e ? null : e === +e + "" ? +e : ze.test(e) ? JSON.parse(e) : e)
    }

    function v(e, t, i) {
        var n;
        if (void 0 === i && 1 === e.nodeType) if (n = "data-" + t.replace(Xe, "-$&").toLowerCase(), "string" == typeof(i = e.getAttribute(n))) {
            try {
                i = m(i)
            } catch (e) {
            }
            Ne.set(e, t, i)
        } else i = void 0;
        return i
    }

    function y(e, t, i, n) {
        var s, o, r = 20, a = n ? function () {
                return n.cur()
            } : function () {
                return _e.css(e, t, "")
            }, l = a(), c = i && i[3] || (_e.cssNumber[t] ? "" : "px"),
            u = (_e.cssNumber[t] || "px" !== c && +l) && Ye.exec(_e.css(e, t));
        if (u && u[3] !== c) {
            for (l /= 2, c = c || u[3], u = +l || 1; r--;) _e.style(e, t, u + c), (1 - o) * (1 - (o = a() / l || .5)) <= 0 && (r = 0), u /= o;
            u *= 2, _e.style(e, t, u + c), i = i || []
        }
        return i && (u = +u || +l || 0, s = i[1] ? u + (i[1] + 1) * i[2] : +i[2], n && (n.unit = c, n.start = u, n.end = s)), s
    }

    function x(e) {
        var t, i = e.ownerDocument, n = e.nodeName, s = Ve[n];
        return s || (t = i.body.appendChild(i.createElement(n)), s = _e.css(t, "display"), t.parentNode.removeChild(t), "none" === s && (s = "block"), Ve[n] = s, s)
    }

    function b(e, t) {
        for (var i, n, s = [], o = 0, r = e.length; o < r; o++) n = e[o], n.style && (i = n.style.display, t ? ("none" === i && (s[o] = He.get(n, "display") || null, s[o] || (n.style.display = "")), "" === n.style.display && We(n) && (s[o] = x(n))) : "none" !== i && (s[o] = "none", He.set(n, "display", i)));
        for (o = 0; o < r; o++) null != s[o] && (e[o].style.display = s[o]);
        return e
    }

    function _(e, t) {
        var i;
        return i = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && o(e, t) ? _e.merge([e], i) : i
    }

    function w(e, t) {
        for (var i = 0, n = e.length; i < n; i++) He.set(e[i], "globalEval", !t || He.get(t[i], "globalEval"))
    }

    function T(e, t, i, s, o) {
        for (var r, a, l, c, u, d, h = t.createDocumentFragment(), p = [], f = 0, g = e.length; f < g; f++) if ((r = e[f]) || 0 === r) if ("object" === n(r)) _e.merge(p, r.nodeType ? [r] : r); else if (Je.test(r)) {
            for (a = a || h.appendChild(t.createElement("div")), l = (Ze.exec(r) || ["", ""])[1].toLowerCase(), c = Ke[l] || Ke._default, a.innerHTML = c[1] + _e.htmlPrefilter(r) + c[2], d = c[0]; d--;) a = a.lastChild;
            _e.merge(p, a.childNodes), a = h.firstChild, a.textContent = ""
        } else p.push(t.createTextNode(r));
        for (h.textContent = "", f = 0; r = p[f++];) if (s && _e.inArray(r, s) > -1) o && o.push(r); else if (u = _e.contains(r.ownerDocument, r), a = _(h.appendChild(r), "script"), u && w(a), i) for (d = 0; r = a[d++];) Qe.test(r.type || "") && i.push(r);
        return h
    }

    function k() {
        return !0
    }

    function $() {
        return !1
    }

    function S() {
        try {
            return re.activeElement
        } catch (e) {
        }
    }

    function C(e, t, i, n, s, o) {
        var r, a;
        if ("object" == typeof t) {
            "string" != typeof i && (n = n || i, i = void 0);
            for (a in t) C(e, a, i, n, t[a], o);
            return e
        }
        if (null == n && null == s ? (s = i, n = i = void 0) : null == s && ("string" == typeof i ? (s = n, n = void 0) : (s = n, n = i, i = void 0)), !1 === s) s = $; else if (!s) return e;
        return 1 === o && (r = s, s = function (e) {
            return _e().off(e), r.apply(this, arguments)
        }, s.guid = r.guid || (r.guid = _e.guid++)), e.each(function () {
            _e.event.add(this, t, s, n, i)
        })
    }

    function P(e, t) {
        return o(e, "table") && o(11 !== t.nodeType ? t : t.firstChild, "tr") ? _e(e).children("tbody")[0] || e : e
    }

    function O(e) {
        return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
    }

    function A(e) {
        return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), e
    }

    function L(e, t) {
        var i, n, s, o, r, a, l, c;
        if (1 === t.nodeType) {
            if (He.hasData(e) && (o = He.access(e), r = He.set(t, o), c = o.events)) {
                delete r.handle, r.events = {};
                for (s in c) for (i = 0, n = c[s].length; i < n; i++) _e.event.add(t, s, c[s][i])
            }
            Ne.hasData(e) && (a = Ne.access(e), l = _e.extend({}, a), Ne.set(t, l))
        }
    }

    function D(e, t) {
        var i = t.nodeName.toLowerCase();
        "input" === i && Ge.test(e.type) ? t.checked = e.checked : "input" !== i && "textarea" !== i || (t.defaultValue = e.defaultValue)
    }

    function M(e, t, n, s) {
        t = ce.apply([], t);
        var o, r, a, l, c, u, d = 0, h = e.length, p = h - 1, f = t[0], g = ye(f);
        if (g || h > 1 && "string" == typeof f && !ve.checkClone && rt.test(f)) return e.each(function (i) {
            var o = e.eq(i);
            g && (t[0] = f.call(this, i, o.html())), M(o, t, n, s)
        });
        if (h && (o = T(t, e[0].ownerDocument, !1, e, s), r = o.firstChild, 1 === o.childNodes.length && (o = r), r || s)) {
            for (a = _e.map(_(o, "script"), O), l = a.length; d < h; d++) c = o, d !== p && (c = _e.clone(c, !0, !0), l && _e.merge(a, _(c, "script"))), n.call(e[d], c, d);
            if (l) for (u = a[a.length - 1].ownerDocument, _e.map(a, A), d = 0; d < l; d++) c = a[d], Qe.test(c.type || "") && !He.access(c, "globalEval") && _e.contains(u, c) && (c.src && "module" !== (c.type || "").toLowerCase() ? _e._evalUrl && _e._evalUrl(c.src) : i(c.textContent.replace(at, ""), u, c))
        }
        return e
    }

    function E(e, t, i) {
        for (var n, s = t ? _e.filter(t, e) : e, o = 0; null != (n = s[o]); o++) i || 1 !== n.nodeType || _e.cleanData(_(n)), n.parentNode && (i && _e.contains(n.ownerDocument, n) && w(_(n, "script")), n.parentNode.removeChild(n));
        return e
    }

    function F(e, t, i) {
        var n, s, o, r, a = e.style;
        return i = i || ct(e), i && (r = i.getPropertyValue(t) || i[t], "" !== r || _e.contains(e.ownerDocument, e) || (r = _e.style(e, t)), !ve.pixelBoxStyles() && lt.test(r) && ut.test(t) && (n = a.width, s = a.minWidth, o = a.maxWidth, a.minWidth = a.maxWidth = a.width = r, r = i.width, a.width = n, a.minWidth = s, a.maxWidth = o)), void 0 !== r ? r + "" : r
    }

    function R(e, t) {
        return {
            get: function () {
                return e() ? void delete this.get : (this.get = t).apply(this, arguments)
            }
        }
    }

    function j(e) {
        if (e in mt) return e;
        for (var t = e[0].toUpperCase() + e.slice(1), i = gt.length; i--;) if ((e = gt[i] + t) in mt) return e
    }

    function I(e) {
        var t = _e.cssProps[e];
        return t || (t = _e.cssProps[e] = j(e) || e), t
    }

    function H(e, t, i) {
        var n = Ye.exec(t);
        return n ? Math.max(0, n[2] - (i || 0)) + (n[3] || "px") : t
    }

    function N(e, t, i, n, s, o) {
        var r = "width" === t ? 1 : 0, a = 0, l = 0;
        if (i === (n ? "border" : "content")) return 0;
        for (; r < 4; r += 2) "margin" === i && (l += _e.css(e, i + Be[r], !0, s)), n ? ("content" === i && (l -= _e.css(e, "padding" + Be[r], !0, s)), "margin" !== i && (l -= _e.css(e, "border" + Be[r] + "Width", !0, s))) : (l += _e.css(e, "padding" + Be[r], !0, s), "padding" !== i ? l += _e.css(e, "border" + Be[r] + "Width", !0, s) : a += _e.css(e, "border" + Be[r] + "Width", !0, s));
        return !n && o >= 0 && (l += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - o - l - a - .5))), l
    }

    function z(e, t, i) {
        var n = ct(e), s = F(e, t, n), o = "border-box" === _e.css(e, "boxSizing", !1, n), r = o;
        if (lt.test(s)) {
            if (!i) return s;
            s = "auto"
        }
        return r = r && (ve.boxSizingReliable() || s === e.style[t]), ("auto" === s || !parseFloat(s) && "inline" === _e.css(e, "display", !1, n)) && (s = e["offset" + t[0].toUpperCase() + t.slice(1)], r = !0), (s = parseFloat(s) || 0) + N(e, t, i || (o ? "border" : "content"), r, n, s) + "px"
    }

    function X(e, t, i, n, s) {
        return new X.prototype.init(e, t, i, n, s)
    }

    function q() {
        yt && (!1 === re.hidden && e.requestAnimationFrame ? e.requestAnimationFrame(q) : e.setTimeout(q, _e.fx.interval), _e.fx.tick())
    }

    function Y() {
        return e.setTimeout(function () {
            vt = void 0
        }), vt = Date.now()
    }

    function B(e, t) {
        var i, n = 0, s = {height: e};
        for (t = t ? 1 : 0; n < 4; n += 2 - t) i = Be[n], s["margin" + i] = s["padding" + i] = e;
        return t && (s.opacity = s.width = e), s
    }

    function W(e, t, i) {
        for (var n, s = (G.tweeners[t] || []).concat(G.tweeners["*"]), o = 0, r = s.length; o < r; o++) if (n = s[o].call(i, t, e)) return n
    }

    function U(e, t, i) {
        var n, s, o, r, a, l, c, u, d = "width" in t || "height" in t, h = this, p = {}, f = e.style,
            g = e.nodeType && We(e), m = He.get(e, "fxshow");
        i.queue || (r = _e._queueHooks(e, "fx"), null == r.unqueued && (r.unqueued = 0, a = r.empty.fire, r.empty.fire = function () {
            r.unqueued || a()
        }), r.unqueued++, h.always(function () {
            h.always(function () {
                r.unqueued--, _e.queue(e, "fx").length || r.empty.fire()
            })
        }));
        for (n in t) if (s = t[n], xt.test(s)) {
            if (delete t[n], o = o || "toggle" === s, s === (g ? "hide" : "show")) {
                if ("show" !== s || !m || void 0 === m[n]) continue;
                g = !0
            }
            p[n] = m && m[n] || _e.style(e, n)
        }
        if ((l = !_e.isEmptyObject(t)) || !_e.isEmptyObject(p)) {
            d && 1 === e.nodeType && (i.overflow = [f.overflow, f.overflowX, f.overflowY], c = m && m.display, null == c && (c = He.get(e, "display")), u = _e.css(e, "display"), "none" === u && (c ? u = c : (b([e], !0), c = e.style.display || c, u = _e.css(e, "display"), b([e]))), ("inline" === u || "inline-block" === u && null != c) && "none" === _e.css(e, "float") && (l || (h.done(function () {
                f.display = c
            }), null == c && (u = f.display, c = "none" === u ? "" : u)), f.display = "inline-block")), i.overflow && (f.overflow = "hidden", h.always(function () {
                f.overflow = i.overflow[0], f.overflowX = i.overflow[1], f.overflowY = i.overflow[2]
            })), l = !1;
            for (n in p) l || (m ? "hidden" in m && (g = m.hidden) : m = He.access(e, "fxshow", {display: c}), o && (m.hidden = !g), g && b([e], !0), h.done(function () {
                g || b([e]), He.remove(e, "fxshow");
                for (n in p) _e.style(e, n, p[n])
            })), l = W(g ? m[n] : 0, n, h), n in m || (m[n] = l.start, g && (l.end = l.start, l.start = 0))
        }
    }

    function V(e, t) {
        var i, n, s, o, r;
        for (i in e) if (n = f(i), s = t[n], o = e[i], Array.isArray(o) && (s = o[1], o = e[i] = o[0]), i !== n && (e[n] = o, delete e[i]), (r = _e.cssHooks[n]) && "expand" in r) {
            o = r.expand(o), delete e[n];
            for (i in o) i in e || (e[i] = o[i], t[i] = s)
        } else t[n] = s
    }

    function G(e, t, i) {
        var n, s, o = 0, r = G.prefilters.length, a = _e.Deferred().always(function () {
            delete l.elem
        }), l = function () {
            if (s) return !1;
            for (var t = vt || Y(), i = Math.max(0, c.startTime + c.duration - t), n = i / c.duration || 0, o = 1 - n, r = 0, l = c.tweens.length; r < l; r++) c.tweens[r].run(o);
            return a.notifyWith(e, [c, o, i]), o < 1 && l ? i : (l || a.notifyWith(e, [c, 1, 0]), a.resolveWith(e, [c]), !1)
        }, c = a.promise({
            elem: e,
            props: _e.extend({}, t),
            opts: _e.extend(!0, {specialEasing: {}, easing: _e.easing._default}, i),
            originalProperties: t,
            originalOptions: i,
            startTime: vt || Y(),
            duration: i.duration,
            tweens: [],
            createTween: function (t, i) {
                var n = _e.Tween(e, c.opts, t, i, c.opts.specialEasing[t] || c.opts.easing);
                return c.tweens.push(n), n
            },
            stop: function (t) {
                var i = 0, n = t ? c.tweens.length : 0;
                if (s) return this;
                for (s = !0; i < n; i++) c.tweens[i].run(1);
                return t ? (a.notifyWith(e, [c, 1, 0]), a.resolveWith(e, [c, t])) : a.rejectWith(e, [c, t]), this
            }
        }), u = c.props;
        for (V(u, c.opts.specialEasing); o < r; o++) if (n = G.prefilters[o].call(c, e, u, c.opts)) return ye(n.stop) && (_e._queueHooks(c.elem, c.opts.queue).stop = n.stop.bind(n)), n;
        return _e.map(u, W, c), ye(c.opts.start) && c.opts.start.call(e, c), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always), _e.fx.timer(_e.extend(l, {
            elem: e,
            anim: c,
            queue: c.opts.queue
        })), c
    }

    function Z(e) {
        return (e.match(De) || []).join(" ")
    }

    function Q(e) {
        return e.getAttribute && e.getAttribute("class") || ""
    }

    function K(e) {
        return Array.isArray(e) ? e : "string" == typeof e ? e.match(De) || [] : []
    }

    function J(e, t, i, s) {
        var o;
        if (Array.isArray(t)) _e.each(t, function (t, n) {
            i || Lt.test(e) ? s(e, n) : J(e + "[" + ("object" == typeof n && null != n ? t : "") + "]", n, i, s)
        }); else if (i || "object" !== n(t)) s(e, t); else for (o in t) J(e + "[" + o + "]", t[o], i, s)
    }

    function ee(e) {
        return function (t, i) {
            "string" != typeof t && (i = t, t = "*");
            var n, s = 0, o = t.toLowerCase().match(De) || [];
            if (ye(i)) for (; n = o[s++];) "+" === n[0] ? (n = n.slice(1) || "*", (e[n] = e[n] || []).unshift(i)) : (e[n] = e[n] || []).push(i)
        }
    }

    function te(e, t, i, n) {
        function s(a) {
            var l;
            return o[a] = !0, _e.each(e[a] || [], function (e, a) {
                var c = a(t, i, n);
                return "string" != typeof c || r || o[c] ? r ? !(l = c) : void 0 : (t.dataTypes.unshift(c), s(c), !1)
            }), l
        }

        var o = {}, r = e === qt;
        return s(t.dataTypes[0]) || !o["*"] && s("*")
    }

    function ie(e, t) {
        var i, n, s = _e.ajaxSettings.flatOptions || {};
        for (i in t) void 0 !== t[i] && ((s[i] ? e : n || (n = {}))[i] = t[i]);
        return n && _e.extend(!0, e, n), e
    }

    function ne(e, t, i) {
        for (var n, s, o, r, a = e.contents, l = e.dataTypes; "*" === l[0];) l.shift(), void 0 === n && (n = e.mimeType || t.getResponseHeader("Content-Type"));
        if (n) for (s in a) if (a[s] && a[s].test(n)) {
            l.unshift(s);
            break
        }
        if (l[0] in i) o = l[0]; else {
            for (s in i) {
                if (!l[0] || e.converters[s + " " + l[0]]) {
                    o = s;
                    break
                }
                r || (r = s)
            }
            o = o || r
        }
        if (o) return o !== l[0] && l.unshift(o), i[o]
    }

    function se(e, t, i, n) {
        var s, o, r, a, l, c = {}, u = e.dataTypes.slice();
        if (u[1]) for (r in e.converters) c[r.toLowerCase()] = e.converters[r];
        for (o = u.shift(); o;) if (e.responseFields[o] && (i[e.responseFields[o]] = t), !l && n && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = o, o = u.shift()) if ("*" === o) o = l; else if ("*" !== l && l !== o) {
            if (!(r = c[l + " " + o] || c["* " + o])) for (s in c) if (a = s.split(" "), a[1] === o && (r = c[l + " " + a[0]] || c["* " + a[0]])) {
                !0 === r ? r = c[s] : !0 !== c[s] && (o = a[0], u.unshift(a[1]));
                break
            }
            if (!0 !== r) if (r && e.throws) t = r(t); else try {
                t = r(t)
            } catch (e) {
                return {state: "parsererror", error: r ? e : "No conversion from " + l + " to " + o}
            }
        }
        return {state: "success", data: t}
    }

    var oe = [], re = e.document, ae = Object.getPrototypeOf, le = oe.slice, ce = oe.concat, ue = oe.push,
        de = oe.indexOf, he = {}, pe = he.toString, fe = he.hasOwnProperty, ge = fe.toString,
        me = ge.call(Object), ve = {}, ye = function (e) {
            return "function" == typeof e && "number" != typeof e.nodeType
        }, xe = function (e) {
            return null != e && e === e.window
        }, be = {type: !0, src: !0, noModule: !0}, _e = function (e, t) {
            return new _e.fn.init(e, t)
        }, we = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
    _e.fn = _e.prototype = {
        jquery: "3.3.1", constructor: _e, length: 0, toArray: function () {
            return le.call(this)
        }, get: function (e) {
            return null == e ? le.call(this) : e < 0 ? this[e + this.length] : this[e]
        }, pushStack: function (e) {
            var t = _e.merge(this.constructor(), e);
            return t.prevObject = this, t
        }, each: function (e) {
            return _e.each(this, e)
        }, map: function (e) {
            return this.pushStack(_e.map(this, function (t, i) {
                return e.call(t, i, t)
            }))
        }, slice: function () {
            return this.pushStack(le.apply(this, arguments))
        }, first: function () {
            return this.eq(0)
        }, last: function () {
            return this.eq(-1)
        }, eq: function (e) {
            var t = this.length, i = +e + (e < 0 ? t : 0);
            return this.pushStack(i >= 0 && i < t ? [this[i]] : [])
        }, end: function () {
            return this.prevObject || this.constructor()
        }, push: ue, sort: oe.sort, splice: oe.splice
    }, _e.extend = _e.fn.extend = function () {
        var e, t, i, n, s, o, r = arguments[0] || {}, a = 1, l = arguments.length, c = !1;
        for ("boolean" == typeof r && (c = r, r = arguments[a] || {}, a++), "object" == typeof r || ye(r) || (r = {}), a === l && (r = this, a--); a < l; a++) if (null != (e = arguments[a])) for (t in e) i = r[t], n = e[t], r !== n && (c && n && (_e.isPlainObject(n) || (s = Array.isArray(n))) ? (s ? (s = !1, o = i && Array.isArray(i) ? i : []) : o = i && _e.isPlainObject(i) ? i : {}, r[t] = _e.extend(c, o, n)) : void 0 !== n && (r[t] = n));
        return r
    }, _e.extend({
        expando: "jQuery" + ("3.3.1" + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (e) {
            throw new Error(e)
        }, noop: function () {
        }, isPlainObject: function (e) {
            var t, i;
            return !(!e || "[object Object]" !== pe.call(e)) && (!(t = ae(e)) || "function" == typeof(i = fe.call(t, "constructor") && t.constructor) && ge.call(i) === me)
        }, isEmptyObject: function (e) {
            var t;
            for (t in e) return !1;
            return !0
        }, globalEval: function (e) {
            i(e)
        }, each: function (e, t) {
            var i, n = 0;
            if (s(e)) for (i = e.length; n < i && !1 !== t.call(e[n], n, e[n]); n++) ; else for (n in e) if (!1 === t.call(e[n], n, e[n])) break;
            return e
        }, trim: function (e) {
            return null == e ? "" : (e + "").replace(we, "")
        }, makeArray: function (e, t) {
            var i = t || [];
            return null != e && (s(Object(e)) ? _e.merge(i, "string" == typeof e ? [e] : e) : ue.call(i, e)), i
        }, inArray: function (e, t, i) {
            return null == t ? -1 : de.call(t, e, i)
        }, merge: function (e, t) {
            for (var i = +t.length, n = 0, s = e.length; n < i; n++) e[s++] = t[n];
            return e.length = s, e
        }, grep: function (e, t, i) {
            for (var n = [], s = 0, o = e.length, r = !i; s < o; s++) !t(e[s], s) !== r && n.push(e[s]);
            return n
        }, map: function (e, t, i) {
            var n, o, r = 0, a = [];
            if (s(e)) for (n = e.length; r < n; r++) null != (o = t(e[r], r, i)) && a.push(o); else for (r in e) null != (o = t(e[r], r, i)) && a.push(o);
            return ce.apply([], a)
        }, guid: 1, support: ve
    }), "function" == typeof Symbol && (_e.fn[Symbol.iterator] = oe[Symbol.iterator]), _e.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
        he["[object " + t + "]"] = t.toLowerCase()
    });
    var Te = function (e) {
        function t(e, t, i, n) {
            var s, o, r, a, l, u, h, p = t && t.ownerDocument, f = t ? t.nodeType : 9;
            if (i = i || [], "string" != typeof e || !e || 1 !== f && 9 !== f && 11 !== f) return i;
            if (!n && ((t ? t.ownerDocument || t : H) !== L && A(t), t = t || L, M)) {
                if (11 !== f && (l = ge.exec(e))) if (s = l[1]) {
                    if (9 === f) {
                        if (!(r = t.getElementById(s))) return i;
                        if (r.id === s) return i.push(r), i
                    } else if (p && (r = p.getElementById(s)) && j(t, r) && r.id === s) return i.push(r), i
                } else {
                    if (l[2]) return Z.apply(i, t.getElementsByTagName(e)), i;
                    if ((s = l[3]) && b.getElementsByClassName && t.getElementsByClassName) return Z.apply(i, t.getElementsByClassName(s)), i
                }
                if (b.qsa && !Y[e + " "] && (!E || !E.test(e))) {
                    if (1 !== f) p = t, h = e; else if ("object" !== t.nodeName.toLowerCase()) {
                        for ((a = t.getAttribute("id")) ? a = a.replace(xe, be) : t.setAttribute("id", a = I), u = k(e), o = u.length; o--;) u[o] = "#" + a + " " + d(u[o]);
                        h = u.join(","), p = me.test(e) && c(t.parentNode) || t
                    }
                    if (h) try {
                        return Z.apply(i, p.querySelectorAll(h)), i
                    } catch (e) {
                    } finally {
                        a === I && t.removeAttribute("id")
                    }
                }
            }
            return S(e.replace(oe, "$1"), t, i, n)
        }

        function i() {
            function e(i, n) {
                return t.push(i + " ") > _.cacheLength && delete e[t.shift()], e[i + " "] = n
            }

            var t = [];
            return e
        }

        function n(e) {
            return e[I] = !0, e
        }

        function s(e) {
            var t = L.createElement("fieldset");
            try {
                return !!e(t)
            } catch (e) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function o(e, t) {
            for (var i = e.split("|"), n = i.length; n--;) _.attrHandle[i[n]] = t
        }

        function r(e, t) {
            var i = t && e, n = i && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
            if (n) return n;
            if (i) for (; i = i.nextSibling;) if (i === t) return -1;
            return e ? 1 : -1
        }

        function a(e) {
            return function (t) {
                return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && we(t) === e : t.disabled === e : "label" in t && t.disabled === e
            }
        }

        function l(e) {
            return n(function (t) {
                return t = +t, n(function (i, n) {
                    for (var s, o = e([], i.length, t), r = o.length; r--;) i[s = o[r]] && (i[s] = !(n[s] = i[s]))
                })
            })
        }

        function c(e) {
            return e && void 0 !== e.getElementsByTagName && e
        }

        function u() {
        }

        function d(e) {
            for (var t = 0, i = e.length, n = ""; t < i; t++) n += e[t].value;
            return n
        }

        function h(e, t, i) {
            var n = t.dir, s = t.next, o = s || n, r = i && "parentNode" === o, a = z++;
            return t.first ? function (t, i, s) {
                for (; t = t[n];) if (1 === t.nodeType || r) return e(t, i, s);
                return !1
            } : function (t, i, l) {
                var c, u, d, h = [N, a];
                if (l) {
                    for (; t = t[n];) if ((1 === t.nodeType || r) && e(t, i, l)) return !0
                } else for (; t = t[n];) if (1 === t.nodeType || r) if (d = t[I] || (t[I] = {}), u = d[t.uniqueID] || (d[t.uniqueID] = {}), s && s === t.nodeName.toLowerCase()) t = t[n] || t; else {
                    if ((c = u[o]) && c[0] === N && c[1] === a) return h[2] = c[2];
                    if (u[o] = h, h[2] = e(t, i, l)) return !0
                }
                return !1
            }
        }

        function p(e) {
            return e.length > 1 ? function (t, i, n) {
                for (var s = e.length; s--;) if (!e[s](t, i, n)) return !1;
                return !0
            } : e[0]
        }

        function f(e, i, n) {
            for (var s = 0, o = i.length; s < o; s++) t(e, i[s], n);
            return n
        }

        function g(e, t, i, n, s) {
            for (var o, r = [], a = 0, l = e.length, c = null != t; a < l; a++) (o = e[a]) && (i && !i(o, n, s) || (r.push(o), c && t.push(a)));
            return r
        }

        function m(e, t, i, s, o, r) {
            return s && !s[I] && (s = m(s)), o && !o[I] && (o = m(o, r)), n(function (n, r, a, l) {
                var c, u, d, h = [], p = [], m = r.length, v = n || f(t || "*", a.nodeType ? [a] : a, []),
                    y = !e || !n && t ? v : g(v, h, e, a, l), x = i ? o || (n ? e : m || s) ? [] : r : y;
                if (i && i(y, x, a, l), s) for (c = g(x, p), s(c, [], a, l), u = c.length; u--;) (d = c[u]) && (x[p[u]] = !(y[p[u]] = d));
                if (n) {
                    if (o || e) {
                        if (o) {
                            for (c = [], u = x.length; u--;) (d = x[u]) && c.push(y[u] = d);
                            o(null, x = [], c, l)
                        }
                        for (u = x.length; u--;) (d = x[u]) && (c = o ? K(n, d) : h[u]) > -1 && (n[c] = !(r[c] = d))
                    }
                } else x = g(x === r ? x.splice(m, x.length) : x), o ? o(null, r, x, l) : Z.apply(r, x)
            })
        }

        function v(e) {
            for (var t, i, n, s = e.length, o = _.relative[e[0].type], r = o || _.relative[" "], a = o ? 1 : 0, l = h(function (e) {
                return e === t
            }, r, !0), c = h(function (e) {
                return K(t, e) > -1
            }, r, !0), u = [function (e, i, n) {
                var s = !o && (n || i !== C) || ((t = i).nodeType ? l(e, i, n) : c(e, i, n));
                return t = null, s
            }]; a < s; a++) if (i = _.relative[e[a].type]) u = [h(p(u), i)]; else {
                if (i = _.filter[e[a].type].apply(null, e[a].matches), i[I]) {
                    for (n = ++a; n < s && !_.relative[e[n].type]; n++) ;
                    return m(a > 1 && p(u), a > 1 && d(e.slice(0, a - 1).concat({value: " " === e[a - 2].type ? "*" : ""})).replace(oe, "$1"), i, a < n && v(e.slice(a, n)), n < s && v(e = e.slice(n)), n < s && d(e))
                }
                u.push(i)
            }
            return p(u)
        }

        function y(e, i) {
            var s = i.length > 0, o = e.length > 0, r = function (n, r, a, l, c) {
                var u, d, h, p = 0, f = "0", m = n && [], v = [], y = C, x = n || o && _.find.TAG("*", c),
                    b = N += null == y ? 1 : Math.random() || .1, w = x.length;
                for (c && (C = r === L || r || c); f !== w && null != (u = x[f]); f++) {
                    if (o && u) {
                        for (d = 0, r || u.ownerDocument === L || (A(u), a = !M); h = e[d++];) if (h(u, r || L, a)) {
                            l.push(u);
                            break
                        }
                        c && (N = b)
                    }
                    s && ((u = !h && u) && p--, n && m.push(u))
                }
                if (p += f, s && f !== p) {
                    for (d = 0; h = i[d++];) h(m, v, r, a);
                    if (n) {
                        if (p > 0) for (; f--;) m[f] || v[f] || (v[f] = V.call(l));
                        v = g(v)
                    }
                    Z.apply(l, v), c && !n && v.length > 0 && p + i.length > 1 && t.uniqueSort(l)
                }
                return c && (N = b, C = y), m
            };
            return s ? n(r) : r
        }

        var x, b, _, w, T, k, $, S, C, P, O, A, L, D, M, E, F, R, j, I = "sizzle" + 1 * new Date, H = e.document, N = 0,
            z = 0, X = i(), q = i(), Y = i(), B = function (e, t) {
                return e === t && (O = !0), 0
            }, W = {}.hasOwnProperty, U = [], V = U.pop, G = U.push, Z = U.push, Q = U.slice, K = function (e, t) {
                for (var i = 0, n = e.length; i < n; i++) if (e[i] === t) return i;
                return -1
            },
            J = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            ee = "[\\x20\\t\\r\\n\\f]",
            te = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
            ie = "\\[" + ee + "*(" + te + ")(?:" + ee + "*([*^$|!~]?=)" + ee + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + te + "))|)" + ee + "*\\]",
            ne = ":(" + te + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + ie + ")*)|.*)\\)|)",
            se = new RegExp(ee + "+", "g"),
            oe = new RegExp("^" + ee + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ee + "+$", "g"),
            re = new RegExp("^" + ee + "*," + ee + "*"), ae = new RegExp("^" + ee + "*([>+~]|" + ee + ")" + ee + "*"),
            le = new RegExp("=" + ee + "*([^\\]'\"]*?)" + ee + "*\\]", "g"), ce = new RegExp(ne),
            ue = new RegExp("^" + te + "$"), de = {
                ID: new RegExp("^#(" + te + ")"),
                CLASS: new RegExp("^\\.(" + te + ")"),
                TAG: new RegExp("^(" + te + "|[*])"),
                ATTR: new RegExp("^" + ie),
                PSEUDO: new RegExp("^" + ne),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ee + "*(even|odd|(([+-]|)(\\d*)n|)" + ee + "*(?:([+-]|)" + ee + "*(\\d+)|))" + ee + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + J + ")$", "i"),
                needsContext: new RegExp("^" + ee + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ee + "*((?:-\\d)?\\d*)" + ee + "*\\)|)(?=[^-]|$)", "i")
            }, he = /^(?:input|select|textarea|button)$/i, pe = /^h\d$/i, fe = /^[^{]+\{\s*\[native \w/,
            ge = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, me = /[+~]/,
            ve = new RegExp("\\\\([\\da-f]{1,6}" + ee + "?|(" + ee + ")|.)", "ig"), ye = function (e, t, i) {
                var n = "0x" + t - 65536;
                return n !== n || i ? t : n < 0 ? String.fromCharCode(n + 65536) : String.fromCharCode(n >> 10 | 55296, 1023 & n | 56320)
            }, xe = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g, be = function (e, t) {
                return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
            }, _e = function () {
                A()
            }, we = h(function (e) {
                return !0 === e.disabled && ("form" in e || "label" in e)
            }, {dir: "parentNode", next: "legend"});
        try {
            Z.apply(U = Q.call(H.childNodes), H.childNodes), U[H.childNodes.length].nodeType
        } catch (e) {
            Z = {
                apply: U.length ? function (e, t) {
                    G.apply(e, Q.call(t))
                } : function (e, t) {
                    for (var i = e.length, n = 0; e[i++] = t[n++];) ;
                    e.length = i - 1
                }
            }
        }
        b = t.support = {}, T = t.isXML = function (e) {
            var t = e && (e.ownerDocument || e).documentElement;
            return !!t && "HTML" !== t.nodeName
        }, A = t.setDocument = function (e) {
            var t, i, n = e ? e.ownerDocument || e : H;
            return n !== L && 9 === n.nodeType && n.documentElement ? (L = n, D = L.documentElement, M = !T(L), H !== L && (i = L.defaultView) && i.top !== i && (i.addEventListener ? i.addEventListener("unload", _e, !1) : i.attachEvent && i.attachEvent("onunload", _e)), b.attributes = s(function (e) {
                return e.className = "i", !e.getAttribute("className")
            }), b.getElementsByTagName = s(function (e) {
                return e.appendChild(L.createComment("")), !e.getElementsByTagName("*").length
            }), b.getElementsByClassName = fe.test(L.getElementsByClassName), b.getById = s(function (e) {
                return D.appendChild(e).id = I, !L.getElementsByName || !L.getElementsByName(I).length
            }), b.getById ? (_.filter.ID = function (e) {
                var t = e.replace(ve, ye);
                return function (e) {
                    return e.getAttribute("id") === t
                }
            }, _.find.ID = function (e, t) {
                if (void 0 !== t.getElementById && M) {
                    var i = t.getElementById(e);
                    return i ? [i] : []
                }
            }) : (_.filter.ID = function (e) {
                var t = e.replace(ve, ye);
                return function (e) {
                    var i = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                    return i && i.value === t
                }
            }, _.find.ID = function (e, t) {
                if (void 0 !== t.getElementById && M) {
                    var i, n, s, o = t.getElementById(e);
                    if (o) {
                        if ((i = o.getAttributeNode("id")) && i.value === e) return [o];
                        for (s = t.getElementsByName(e), n = 0; o = s[n++];) if ((i = o.getAttributeNode("id")) && i.value === e) return [o]
                    }
                    return []
                }
            }), _.find.TAG = b.getElementsByTagName ? function (e, t) {
                return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : b.qsa ? t.querySelectorAll(e) : void 0
            } : function (e, t) {
                var i, n = [], s = 0, o = t.getElementsByTagName(e);
                if ("*" === e) {
                    for (; i = o[s++];) 1 === i.nodeType && n.push(i);
                    return n
                }
                return o
            }, _.find.CLASS = b.getElementsByClassName && function (e, t) {
                if (void 0 !== t.getElementsByClassName && M) return t.getElementsByClassName(e)
            }, F = [], E = [], (b.qsa = fe.test(L.querySelectorAll)) && (s(function (e) {
                D.appendChild(e).innerHTML = "<a id='" + I + "'></a><select id='" + I + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && E.push("[*^$]=" + ee + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || E.push("\\[" + ee + "*(?:value|" + J + ")"), e.querySelectorAll("[id~=" + I + "-]").length || E.push("~="), e.querySelectorAll(":checked").length || E.push(":checked"), e.querySelectorAll("a#" + I + "+*").length || E.push(".#.+[+~]")
            }), s(function (e) {
                e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                var t = L.createElement("input");
                t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && E.push("name" + ee + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && E.push(":enabled", ":disabled"), D.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && E.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), E.push(",.*:")
            })), (b.matchesSelector = fe.test(R = D.matches || D.webkitMatchesSelector || D.mozMatchesSelector || D.oMatchesSelector || D.msMatchesSelector)) && s(function (e) {
                b.disconnectedMatch = R.call(e, "*"), R.call(e, "[s!='']:x"), F.push("!=", ne)
            }), E = E.length && new RegExp(E.join("|")), F = F.length && new RegExp(F.join("|")), t = fe.test(D.compareDocumentPosition), j = t || fe.test(D.contains) ? function (e, t) {
                var i = 9 === e.nodeType ? e.documentElement : e, n = t && t.parentNode;
                return e === n || !(!n || 1 !== n.nodeType || !(i.contains ? i.contains(n) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(n)))
            } : function (e, t) {
                if (t) for (; t = t.parentNode;) if (t === e) return !0;
                return !1
            }, B = t ? function (e, t) {
                if (e === t) return O = !0, 0;
                var i = !e.compareDocumentPosition - !t.compareDocumentPosition;
                return i || (i = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 & i || !b.sortDetached && t.compareDocumentPosition(e) === i ? e === L || e.ownerDocument === H && j(H, e) ? -1 : t === L || t.ownerDocument === H && j(H, t) ? 1 : P ? K(P, e) - K(P, t) : 0 : 4 & i ? -1 : 1)
            } : function (e, t) {
                if (e === t) return O = !0, 0;
                var i, n = 0, s = e.parentNode, o = t.parentNode, a = [e], l = [t];
                if (!s || !o) return e === L ? -1 : t === L ? 1 : s ? -1 : o ? 1 : P ? K(P, e) - K(P, t) : 0;
                if (s === o) return r(e, t);
                for (i = e; i = i.parentNode;) a.unshift(i);
                for (i = t; i = i.parentNode;) l.unshift(i);
                for (; a[n] === l[n];) n++;
                return n ? r(a[n], l[n]) : a[n] === H ? -1 : l[n] === H ? 1 : 0
            }, L) : L
        }, t.matches = function (e, i) {
            return t(e, null, null, i)
        }, t.matchesSelector = function (e, i) {
            if ((e.ownerDocument || e) !== L && A(e), i = i.replace(le, "='$1']"), b.matchesSelector && M && !Y[i + " "] && (!F || !F.test(i)) && (!E || !E.test(i))) try {
                var n = R.call(e, i);
                if (n || b.disconnectedMatch || e.document && 11 !== e.document.nodeType) return n
            } catch (e) {
            }
            return t(i, L, null, [e]).length > 0
        }, t.contains = function (e, t) {
            return (e.ownerDocument || e) !== L && A(e), j(e, t)
        }, t.attr = function (e, t) {
            (e.ownerDocument || e) !== L && A(e);
            var i = _.attrHandle[t.toLowerCase()],
                n = i && W.call(_.attrHandle, t.toLowerCase()) ? i(e, t, !M) : void 0;
            return void 0 !== n ? n : b.attributes || !M ? e.getAttribute(t) : (n = e.getAttributeNode(t)) && n.specified ? n.value : null
        }, t.escape = function (e) {
            return (e + "").replace(xe, be)
        }, t.error = function (e) {
            throw new Error("Syntax error, unrecognized expression: " + e)
        }, t.uniqueSort = function (e) {
            var t, i = [], n = 0, s = 0;
            if (O = !b.detectDuplicates, P = !b.sortStable && e.slice(0), e.sort(B), O) {
                for (; t = e[s++];) t === e[s] && (n = i.push(s));
                for (; n--;) e.splice(i[n], 1)
            }
            return P = null, e
        }, w = t.getText = function (e) {
            var t, i = "", n = 0, s = e.nodeType;
            if (s) {
                if (1 === s || 9 === s || 11 === s) {
                    if ("string" == typeof e.textContent) return e.textContent;
                    for (e = e.firstChild; e; e = e.nextSibling) i += w(e)
                } else if (3 === s || 4 === s) return e.nodeValue
            } else for (; t = e[n++];) i += w(t);
            return i
        }, _ = t.selectors = {
            cacheLength: 50,
            createPseudo: n,
            match: de,
            attrHandle: {},
            find: {},
            relative: {
                ">": {dir: "parentNode", first: !0},
                " ": {dir: "parentNode"},
                "+": {dir: "previousSibling", first: !0},
                "~": {dir: "previousSibling"}
            },
            preFilter: {
                ATTR: function (e) {
                    return e[1] = e[1].replace(ve, ye), e[3] = (e[3] || e[4] || e[5] || "").replace(ve, ye), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                }, CHILD: function (e) {
                    return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t.error(e[0]), e
                }, PSEUDO: function (e) {
                    var t, i = !e[6] && e[2];
                    return de.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : i && ce.test(i) && (t = k(i, !0)) && (t = i.indexOf(")", i.length - t) - i.length) && (e[0] = e[0].slice(0, t), e[2] = i.slice(0, t)), e.slice(0, 3))
                }
            },
            filter: {
                TAG: function (e) {
                    var t = e.replace(ve, ye).toLowerCase();
                    return "*" === e ? function () {
                        return !0
                    } : function (e) {
                        return e.nodeName && e.nodeName.toLowerCase() === t
                    }
                }, CLASS: function (e) {
                    var t = X[e + " "];
                    return t || (t = new RegExp("(^|" + ee + ")" + e + "(" + ee + "|$)")) && X(e, function (e) {
                        return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                    })
                }, ATTR: function (e, i, n) {
                    return function (s) {
                        var o = t.attr(s, e);
                        return null == o ? "!=" === i : !i || (o += "", "=" === i ? o === n : "!=" === i ? o !== n : "^=" === i ? n && 0 === o.indexOf(n) : "*=" === i ? n && o.indexOf(n) > -1 : "$=" === i ? n && o.slice(-n.length) === n : "~=" === i ? (" " + o.replace(se, " ") + " ").indexOf(n) > -1 : "|=" === i && (o === n || o.slice(0, n.length + 1) === n + "-"))
                    }
                }, CHILD: function (e, t, i, n, s) {
                    var o = "nth" !== e.slice(0, 3), r = "last" !== e.slice(-4), a = "of-type" === t;
                    return 1 === n && 0 === s ? function (e) {
                        return !!e.parentNode
                    } : function (t, i, l) {
                        var c, u, d, h, p, f, g = o !== r ? "nextSibling" : "previousSibling", m = t.parentNode,
                            v = a && t.nodeName.toLowerCase(), y = !l && !a, x = !1;
                        if (m) {
                            if (o) {
                                for (; g;) {
                                    for (h = t; h = h[g];) if (a ? h.nodeName.toLowerCase() === v : 1 === h.nodeType) return !1;
                                    f = g = "only" === e && !f && "nextSibling"
                                }
                                return !0
                            }
                            if (f = [r ? m.firstChild : m.lastChild], r && y) {
                                for (h = m, d = h[I] || (h[I] = {}), u = d[h.uniqueID] || (d[h.uniqueID] = {}), c = u[e] || [], p = c[0] === N && c[1], x = p && c[2], h = p && m.childNodes[p]; h = ++p && h && h[g] || (x = p = 0) || f.pop();) if (1 === h.nodeType && ++x && h === t) {
                                    u[e] = [N, p, x];
                                    break
                                }
                            } else if (y && (h = t, d = h[I] || (h[I] = {}), u = d[h.uniqueID] || (d[h.uniqueID] = {}), c = u[e] || [], p = c[0] === N && c[1], x = p), !1 === x) for (; (h = ++p && h && h[g] || (x = p = 0) || f.pop()) && ((a ? h.nodeName.toLowerCase() !== v : 1 !== h.nodeType) || !++x || (y && (d = h[I] || (h[I] = {}), u = d[h.uniqueID] || (d[h.uniqueID] = {}), u[e] = [N, x]), h !== t));) ;
                            return (x -= s) === n || x % n == 0 && x / n >= 0
                        }
                    }
                }, PSEUDO: function (e, i) {
                    var s, o = _.pseudos[e] || _.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
                    return o[I] ? o(i) : o.length > 1 ? (s = [e, e, "", i], _.setFilters.hasOwnProperty(e.toLowerCase()) ? n(function (e, t) {
                        for (var n, s = o(e, i), r = s.length; r--;) n = K(e, s[r]), e[n] = !(t[n] = s[r])
                    }) : function (e) {
                        return o(e, 0, s)
                    }) : o
                }
            },
            pseudos: {
                not: n(function (e) {
                    var t = [], i = [], s = $(e.replace(oe, "$1"));
                    return s[I] ? n(function (e, t, i, n) {
                        for (var o, r = s(e, null, n, []), a = e.length; a--;) (o = r[a]) && (e[a] = !(t[a] = o))
                    }) : function (e, n, o) {
                        return t[0] = e, s(t, null, o, i), t[0] = null, !i.pop()
                    }
                }), has: n(function (e) {
                    return function (i) {
                        return t(e, i).length > 0
                    }
                }), contains: n(function (e) {
                    return e = e.replace(ve, ye), function (t) {
                        return (t.textContent || t.innerText || w(t)).indexOf(e) > -1
                    }
                }), lang: n(function (e) {
                    return ue.test(e || "") || t.error("unsupported lang: " + e), e = e.replace(ve, ye).toLowerCase(), function (t) {
                        var i;
                        do {
                            if (i = M ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return (i = i.toLowerCase()) === e || 0 === i.indexOf(e + "-")
                        } while ((t = t.parentNode) && 1 === t.nodeType);
                        return !1
                    }
                }), target: function (t) {
                    var i = e.location && e.location.hash;
                    return i && i.slice(1) === t.id
                }, root: function (e) {
                    return e === D
                }, focus: function (e) {
                    return e === L.activeElement && (!L.hasFocus || L.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                }, enabled: a(!1), disabled: a(!0), checked: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && !!e.checked || "option" === t && !!e.selected
                }, selected: function (e) {
                    return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
                },
                empty: function (e) {
                    for (e = e.firstChild; e; e = e.nextSibling) if (e.nodeType < 6) return !1;
                    return !0
                }, parent: function (e) {
                    return !_.pseudos.empty(e)
                }, header: function (e) {
                    return pe.test(e.nodeName)
                }, input: function (e) {
                    return he.test(e.nodeName)
                }, button: function (e) {
                    var t = e.nodeName.toLowerCase();
                    return "input" === t && "button" === e.type || "button" === t
                }, text: function (e) {
                    var t;
                    return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                }, first: l(function () {
                    return [0]
                }), last: l(function (e, t) {
                    return [t - 1]
                }), eq: l(function (e, t, i) {
                    return [i < 0 ? i + t : i]
                }), even: l(function (e, t) {
                    for (var i = 0; i < t; i += 2) e.push(i);
                    return e
                }), odd: l(function (e, t) {
                    for (var i = 1; i < t; i += 2) e.push(i);
                    return e
                }), lt: l(function (e, t, i) {
                    for (var n = i < 0 ? i + t : i; --n >= 0;) e.push(n);
                    return e
                }), gt: l(function (e, t, i) {
                    for (var n = i < 0 ? i + t : i; ++n < t;) e.push(n);
                    return e
                })
            }
        }, _.pseudos.nth = _.pseudos.eq;
        for (x in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0}) _.pseudos[x] = function (e) {
            return function (t) {
                return "input" === t.nodeName.toLowerCase() && t.type === e
            }
        }(x);
        for (x in{submit: !0, reset: !0}) _.pseudos[x] = function (e) {
            return function (t) {
                var i = t.nodeName.toLowerCase();
                return ("input" === i || "button" === i) && t.type === e
            }
        }(x);
        return u.prototype = _.filters = _.pseudos, _.setFilters = new u, k = t.tokenize = function (e, i) {
            var n, s, o, r, a, l, c, u = q[e + " "];
            if (u) return i ? 0 : u.slice(0);
            for (a = e, l = [], c = _.preFilter; a;) {
                n && !(s = re.exec(a)) || (s && (a = a.slice(s[0].length) || a), l.push(o = [])), n = !1, (s = ae.exec(a)) && (n = s.shift(), o.push({
                    value: n,
                    type: s[0].replace(oe, " ")
                }), a = a.slice(n.length));
                for (r in _.filter) !(s = de[r].exec(a)) || c[r] && !(s = c[r](s)) || (n = s.shift(), o.push({
                    value: n,
                    type: r,
                    matches: s
                }), a = a.slice(n.length));
                if (!n) break
            }
            return i ? a.length : a ? t.error(e) : q(e, l).slice(0)
        }, $ = t.compile = function (e, t) {
            var i, n = [], s = [], o = Y[e + " "];
            if (!o) {
                for (t || (t = k(e)), i = t.length; i--;) o = v(t[i]), o[I] ? n.push(o) : s.push(o);
                o = Y(e, y(s, n)), o.selector = e
            }
            return o
        }, S = t.select = function (e, t, i, n) {
            var s, o, r, a, l, u = "function" == typeof e && e, h = !n && k(e = u.selector || e);
            if (i = i || [], 1 === h.length) {
                if (o = h[0] = h[0].slice(0), o.length > 2 && "ID" === (r = o[0]).type && 9 === t.nodeType && M && _.relative[o[1].type]) {
                    if (!(t = (_.find.ID(r.matches[0].replace(ve, ye), t) || [])[0])) return i;
                    u && (t = t.parentNode), e = e.slice(o.shift().value.length)
                }
                for (s = de.needsContext.test(e) ? 0 : o.length; s-- && (r = o[s], !_.relative[a = r.type]);) if ((l = _.find[a]) && (n = l(r.matches[0].replace(ve, ye), me.test(o[0].type) && c(t.parentNode) || t))) {
                    if (o.splice(s, 1), !(e = n.length && d(o))) return Z.apply(i, n), i;
                    break
                }
            }
            return (u || $(e, h))(n, t, !M, i, !t || me.test(e) && c(t.parentNode) || t), i
        }, b.sortStable = I.split("").sort(B).join("") === I, b.detectDuplicates = !!O, A(), b.sortDetached = s(function (e) {
            return 1 & e.compareDocumentPosition(L.createElement("fieldset"))
        }), s(function (e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || o("type|href|height|width", function (e, t, i) {
            if (!i) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), b.attributes && s(function (e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || o("value", function (e, t, i) {
            if (!i && "input" === e.nodeName.toLowerCase()) return e.defaultValue
        }), s(function (e) {
            return null == e.getAttribute("disabled")
        }) || o(J, function (e, t, i) {
            var n;
            if (!i) return !0 === e[t] ? t.toLowerCase() : (n = e.getAttributeNode(t)) && n.specified ? n.value : null
        }), t
    }(e);
    _e.find = Te, _e.expr = Te.selectors, _e.expr[":"] = _e.expr.pseudos, _e.uniqueSort = _e.unique = Te.uniqueSort, _e.text = Te.getText, _e.isXMLDoc = Te.isXML, _e.contains = Te.contains, _e.escapeSelector = Te.escape;
    var ke = function (e, t, i) {
        for (var n = [], s = void 0 !== i; (e = e[t]) && 9 !== e.nodeType;) if (1 === e.nodeType) {
            if (s && _e(e).is(i)) break;
            n.push(e)
        }
        return n
    }, $e = function (e, t) {
        for (var i = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && i.push(e);
        return i
    }, Se = _e.expr.match.needsContext, Ce = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;
    _e.filter = function (e, t, i) {
        var n = t[0];
        return i && (e = ":not(" + e + ")"), 1 === t.length && 1 === n.nodeType ? _e.find.matchesSelector(n, e) ? [n] : [] : _e.find.matches(e, _e.grep(t, function (e) {
            return 1 === e.nodeType
        }))
    }, _e.fn.extend({
        find: function (e) {
            var t, i, n = this.length, s = this;
            if ("string" != typeof e) return this.pushStack(_e(e).filter(function () {
                for (t = 0; t < n; t++) if (_e.contains(s[t], this)) return !0
            }));
            for (i = this.pushStack([]), t = 0; t < n; t++) _e.find(e, s[t], i);
            return n > 1 ? _e.uniqueSort(i) : i
        }, filter: function (e) {
            return this.pushStack(r(this, e || [], !1))
        }, not: function (e) {
            return this.pushStack(r(this, e || [], !0))
        }, is: function (e) {
            return !!r(this, "string" == typeof e && Se.test(e) ? _e(e) : e || [], !1).length
        }
    });
    var Pe, Oe = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
    (_e.fn.init = function (e, t, i) {
        var n, s;
        if (!e) return this;
        if (i = i || Pe, "string" == typeof e) {
            if (!(n = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : Oe.exec(e)) || !n[1] && t) return !t || t.jquery ? (t || i).find(e) : this.constructor(t).find(e);
            if (n[1]) {
                if (t = t instanceof _e ? t[0] : t, _e.merge(this, _e.parseHTML(n[1], t && t.nodeType ? t.ownerDocument || t : re, !0)), Ce.test(n[1]) && _e.isPlainObject(t)) for (n in t) ye(this[n]) ? this[n](t[n]) : this.attr(n, t[n]);
                return this
            }
            return s = re.getElementById(n[2]), s && (this[0] = s, this.length = 1), this
        }
        return e.nodeType ? (this[0] = e, this.length = 1, this) : ye(e) ? void 0 !== i.ready ? i.ready(e) : e(_e) : _e.makeArray(e, this)
    }).prototype = _e.fn, Pe = _e(re);
    var Ae = /^(?:parents|prev(?:Until|All))/, Le = {children: !0, contents: !0, next: !0, prev: !0};
    _e.fn.extend({
        has: function (e) {
            var t = _e(e, this), i = t.length;
            return this.filter(function () {
                for (var e = 0; e < i; e++) if (_e.contains(this, t[e])) return !0
            })
        }, closest: function (e, t) {
            var i, n = 0, s = this.length, o = [], r = "string" != typeof e && _e(e);
            if (!Se.test(e)) for (; n < s; n++) for (i = this[n]; i && i !== t; i = i.parentNode) if (i.nodeType < 11 && (r ? r.index(i) > -1 : 1 === i.nodeType && _e.find.matchesSelector(i, e))) {
                o.push(i);
                break
            }
            return this.pushStack(o.length > 1 ? _e.uniqueSort(o) : o)
        }, index: function (e) {
            return e ? "string" == typeof e ? de.call(_e(e), this[0]) : de.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        }, add: function (e, t) {
            return this.pushStack(_e.uniqueSort(_e.merge(this.get(), _e(e, t))))
        }, addBack: function (e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), _e.each({
        parent: function (e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        }, parents: function (e) {
            return ke(e, "parentNode")
        }, parentsUntil: function (e, t, i) {
            return ke(e, "parentNode", i)
        }, next: function (e) {
            return a(e, "nextSibling")
        }, prev: function (e) {
            return a(e, "previousSibling")
        }, nextAll: function (e) {
            return ke(e, "nextSibling")
        }, prevAll: function (e) {
            return ke(e, "previousSibling")
        }, nextUntil: function (e, t, i) {
            return ke(e, "nextSibling", i)
        }, prevUntil: function (e, t, i) {
            return ke(e, "previousSibling", i)
        }, siblings: function (e) {
            return $e((e.parentNode || {}).firstChild, e)
        }, children: function (e) {
            return $e(e.firstChild)
        }, contents: function (e) {
            return o(e, "iframe") ? e.contentDocument : (o(e, "template") && (e = e.content || e), _e.merge([], e.childNodes))
        }
    }, function (e, t) {
        _e.fn[e] = function (i, n) {
            var s = _e.map(this, t, i);
            return "Until" !== e.slice(-5) && (n = i), n && "string" == typeof n && (s = _e.filter(n, s)), this.length > 1 && (Le[e] || _e.uniqueSort(s), Ae.test(e) && s.reverse()), this.pushStack(s)
        }
    });
    var De = /[^\x20\t\r\n\f]+/g;
    _e.Callbacks = function (e) {
        e = "string" == typeof e ? l(e) : _e.extend({}, e);
        var t, i, s, o, r = [], a = [], c = -1, u = function () {
            for (o = o || e.once, s = t = !0; a.length; c = -1) for (i = a.shift(); ++c < r.length;) !1 === r[c].apply(i[0], i[1]) && e.stopOnFalse && (c = r.length, i = !1);
            e.memory || (i = !1), t = !1, o && (r = i ? [] : "")
        }, d = {
            add: function () {
                return r && (i && !t && (c = r.length - 1, a.push(i)), function t(i) {
                    _e.each(i, function (i, s) {
                        ye(s) ? e.unique && d.has(s) || r.push(s) : s && s.length && "string" !== n(s) && t(s)
                    })
                }(arguments), i && !t && u()), this
            }, remove: function () {
                return _e.each(arguments, function (e, t) {
                    for (var i; (i = _e.inArray(t, r, i)) > -1;) r.splice(i, 1), i <= c && c--
                }), this
            }, has: function (e) {
                return e ? _e.inArray(e, r) > -1 : r.length > 0
            }, empty: function () {
                return r && (r = []), this
            }, disable: function () {
                return o = a = [], r = i = "", this
            }, disabled: function () {
                return !r
            }, lock: function () {
                return o = a = [], i || t || (r = i = ""), this
            }, locked: function () {
                return !!o
            }, fireWith: function (e, i) {
                return o || (i = i || [], i = [e, i.slice ? i.slice() : i], a.push(i), t || u()), this
            }, fire: function () {
                return d.fireWith(this, arguments), this
            }, fired: function () {
                return !!s
            }
        };
        return d
    }, _e.extend({
        Deferred: function (t) {
            var i = [["notify", "progress", _e.Callbacks("memory"), _e.Callbacks("memory"), 2], ["resolve", "done", _e.Callbacks("once memory"), _e.Callbacks("once memory"), 0, "resolved"], ["reject", "fail", _e.Callbacks("once memory"), _e.Callbacks("once memory"), 1, "rejected"]],
                n = "pending", s = {
                    state: function () {
                        return n
                    }, always: function () {
                        return o.done(arguments).fail(arguments), this
                    }, catch: function (e) {
                        return s.then(null, e)
                    }, pipe: function () {
                        var e = arguments;
                        return _e.Deferred(function (t) {
                            _e.each(i, function (i, n) {
                                var s = ye(e[n[4]]) && e[n[4]];
                                o[n[1]](function () {
                                    var e = s && s.apply(this, arguments);
                                    e && ye(e.promise) ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[n[0] + "With"](this, s ? [e] : arguments)
                                })
                            }), e = null
                        }).promise()
                    }, then: function (t, n, s) {
                        function o(t, i, n, s) {
                            return function () {
                                var a = this, l = arguments, d = function () {
                                    var e, d;
                                    if (!(t < r)) {
                                        if ((e = n.apply(a, l)) === i.promise()) throw new TypeError("Thenable self-resolution");
                                        d = e && ("object" == typeof e || "function" == typeof e) && e.then, ye(d) ? s ? d.call(e, o(r, i, c, s), o(r, i, u, s)) : (r++, d.call(e, o(r, i, c, s), o(r, i, u, s), o(r, i, c, i.notifyWith))) : (n !== c && (a = void 0, l = [e]), (s || i.resolveWith)(a, l))
                                    }
                                }, h = s ? d : function () {
                                    try {
                                        d()
                                    } catch (e) {
                                        _e.Deferred.exceptionHook && _e.Deferred.exceptionHook(e, h.stackTrace), t + 1 >= r && (n !== u && (a = void 0, l = [e]), i.rejectWith(a, l))
                                    }
                                };
                                t ? h() : (_e.Deferred.getStackHook && (h.stackTrace = _e.Deferred.getStackHook()), e.setTimeout(h))
                            }
                        }

                        var r = 0;
                        return _e.Deferred(function (e) {
                            i[0][3].add(o(0, e, ye(s) ? s : c, e.notifyWith)), i[1][3].add(o(0, e, ye(t) ? t : c)), i[2][3].add(o(0, e, ye(n) ? n : u))
                        }).promise()
                    }, promise: function (e) {
                        return null != e ? _e.extend(e, s) : s
                    }
                }, o = {};
            return _e.each(i, function (e, t) {
                var r = t[2], a = t[5];
                s[t[1]] = r.add, a && r.add(function () {
                    n = a
                }, i[3 - e][2].disable, i[3 - e][3].disable, i[0][2].lock, i[0][3].lock), r.add(t[3].fire), o[t[0]] = function () {
                    return o[t[0] + "With"](this === o ? void 0 : this, arguments), this
                }, o[t[0] + "With"] = r.fireWith
            }), s.promise(o), t && t.call(o, o), o
        }, when: function (e) {
            var t = arguments.length, i = t, n = Array(i), s = le.call(arguments), o = _e.Deferred(), r = function (e) {
                return function (i) {
                    n[e] = this, s[e] = arguments.length > 1 ? le.call(arguments) : i, --t || o.resolveWith(n, s)
                }
            };
            if (t <= 1 && (d(e, o.done(r(i)).resolve, o.reject, !t), "pending" === o.state() || ye(s[i] && s[i].then))) return o.then();
            for (; i--;) d(s[i], r(i), o.reject);
            return o.promise()
        }
    });
    var Me = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    _e.Deferred.exceptionHook = function (t, i) {
        e.console && e.console.warn && t && Me.test(t.name) && e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, i)
    }, _e.readyException = function (t) {
        e.setTimeout(function () {
            throw t
        })
    };
    var Ee = _e.Deferred();
    _e.fn.ready = function (e) {
        return Ee.then(e).catch(function (e) {
            _e.readyException(e)
        }), this
    }, _e.extend({
        isReady: !1, readyWait: 1, ready: function (e) {
            (!0 === e ? --_e.readyWait : _e.isReady) || (_e.isReady = !0, !0 !== e && --_e.readyWait > 0 || Ee.resolveWith(re, [_e]))
        }
    }), _e.ready.then = Ee.then, "complete" === re.readyState || "loading" !== re.readyState && !re.documentElement.doScroll ? e.setTimeout(_e.ready) : (re.addEventListener("DOMContentLoaded", h), e.addEventListener("load", h));
    var Fe = function (e, t, i, s, o, r, a) {
        var l = 0, c = e.length, u = null == i;
        if ("object" === n(i)) {
            o = !0;
            for (l in i) Fe(e, t, l, i[l], !0, r, a)
        } else if (void 0 !== s && (o = !0, ye(s) || (a = !0), u && (a ? (t.call(e, s), t = null) : (u = t, t = function (e, t, i) {
                return u.call(_e(e), i)
            })), t)) for (; l < c; l++) t(e[l], i, a ? s : s.call(e[l], l, t(e[l], i)));
        return o ? e : u ? t.call(e) : c ? t(e[0], i) : r
    }, Re = /^-ms-/, je = /-([a-z])/g, Ie = function (e) {
        return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
    };
    g.uid = 1, g.prototype = {
        cache: function (e) {
            var t = e[this.expando];
            return t || (t = {}, Ie(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                value: t,
                configurable: !0
            }))), t
        }, set: function (e, t, i) {
            var n, s = this.cache(e);
            if ("string" == typeof t) s[f(t)] = i; else for (n in t) s[f(n)] = t[n];
            return s
        }, get: function (e, t) {
            return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][f(t)]
        }, access: function (e, t, i) {
            return void 0 === t || t && "string" == typeof t && void 0 === i ? this.get(e, t) : (this.set(e, t, i), void 0 !== i ? i : t)
        }, remove: function (e, t) {
            var i, n = e[this.expando];
            if (void 0 !== n) {
                if (void 0 !== t) {
                    Array.isArray(t) ? t = t.map(f) : (t = f(t), t = t in n ? [t] : t.match(De) || []), i = t.length;
                    for (; i--;) delete n[t[i]]
                }
                (void 0 === t || _e.isEmptyObject(n)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
            }
        }, hasData: function (e) {
            var t = e[this.expando];
            return void 0 !== t && !_e.isEmptyObject(t)
        }
    };
    var He = new g, Ne = new g, ze = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, Xe = /[A-Z]/g;
    _e.extend({
        hasData: function (e) {
            return Ne.hasData(e) || He.hasData(e)
        }, data: function (e, t, i) {
            return Ne.access(e, t, i)
        }, removeData: function (e, t) {
            Ne.remove(e, t)
        }, _data: function (e, t, i) {
            return He.access(e, t, i)
        }, _removeData: function (e, t) {
            He.remove(e, t)
        }
    }), _e.fn.extend({
        data: function (e, t) {
            var i, n, s, o = this[0], r = o && o.attributes;
            if (void 0 === e) {
                if (this.length && (s = Ne.get(o), 1 === o.nodeType && !He.get(o, "hasDataAttrs"))) {
                    for (i = r.length; i--;) r[i] && (n = r[i].name, 0 === n.indexOf("data-") && (n = f(n.slice(5)), v(o, n, s[n])));
                    He.set(o, "hasDataAttrs", !0)
                }
                return s
            }
            return "object" == typeof e ? this.each(function () {
                Ne.set(this, e)
            }) : Fe(this, function (t) {
                var i;
                if (o && void 0 === t) {
                    if (void 0 !== (i = Ne.get(o, e))) return i;
                    if (void 0 !== (i = v(o, e))) return i
                } else this.each(function () {
                    Ne.set(this, e, t)
                })
            }, null, t, arguments.length > 1, null, !0)
        }, removeData: function (e) {
            return this.each(function () {
                Ne.remove(this, e)
            })
        }
    }), _e.extend({
        queue: function (e, t, i) {
            var n;
            if (e) return t = (t || "fx") + "queue", n = He.get(e, t), i && (!n || Array.isArray(i) ? n = He.access(e, t, _e.makeArray(i)) : n.push(i)), n || []
        }, dequeue: function (e, t) {
            t = t || "fx";
            var i = _e.queue(e, t), n = i.length, s = i.shift(), o = _e._queueHooks(e, t), r = function () {
                _e.dequeue(e, t)
            };
            "inprogress" === s && (s = i.shift(), n--), s && ("fx" === t && i.unshift("inprogress"), delete o.stop, s.call(e, r, o)), !n && o && o.empty.fire()
        }, _queueHooks: function (e, t) {
            var i = t + "queueHooks";
            return He.get(e, i) || He.access(e, i, {
                empty: _e.Callbacks("once memory").add(function () {
                    He.remove(e, [t + "queue", i])
                })
            })
        }
    }), _e.fn.extend({
        queue: function (e, t) {
            var i = 2;
            return "string" != typeof e && (t = e, e = "fx", i--), arguments.length < i ? _e.queue(this[0], e) : void 0 === t ? this : this.each(function () {
                var i = _e.queue(this, e, t);
                _e._queueHooks(this, e), "fx" === e && "inprogress" !== i[0] && _e.dequeue(this, e)
            })
        }, dequeue: function (e) {
            return this.each(function () {
                _e.dequeue(this, e)
            })
        }, clearQueue: function (e) {
            return this.queue(e || "fx", [])
        }, promise: function (e, t) {
            var i, n = 1, s = _e.Deferred(), o = this, r = this.length, a = function () {
                --n || s.resolveWith(o, [o])
            };
            for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; r--;) (i = He.get(o[r], e + "queueHooks")) && i.empty && (n++, i.empty.add(a));
            return a(), s.promise(t)
        }
    });
    var qe = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, Ye = new RegExp("^(?:([+-])=|)(" + qe + ")([a-z%]*)$", "i"),
        Be = ["Top", "Right", "Bottom", "Left"], We = function (e, t) {
            return e = t || e, "none" === e.style.display || "" === e.style.display && _e.contains(e.ownerDocument, e) && "none" === _e.css(e, "display")
        }, Ue = function (e, t, i, n) {
            var s, o, r = {};
            for (o in t) r[o] = e.style[o], e.style[o] = t[o];
            s = i.apply(e, n || []);
            for (o in t) e.style[o] = r[o];
            return s
        }, Ve = {};
    _e.fn.extend({
        show: function () {
            return b(this, !0)
        }, hide: function () {
            return b(this)
        }, toggle: function (e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
                We(this) ? _e(this).show() : _e(this).hide()
            })
        }
    });
    var Ge = /^(?:checkbox|radio)$/i, Ze = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i, Qe = /^$|^module$|\/(?:java|ecma)script/i,
        Ke = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };
    Ke.optgroup = Ke.option, Ke.tbody = Ke.tfoot = Ke.colgroup = Ke.caption = Ke.thead, Ke.th = Ke.td;
    var Je = /<|&#?\w+;/;
    !function () {
        var e = re.createDocumentFragment(), t = e.appendChild(re.createElement("div")), i = re.createElement("input");
        i.setAttribute("type", "radio"), i.setAttribute("checked", "checked"), i.setAttribute("name", "t"), t.appendChild(i), ve.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, t.innerHTML = "<textarea>x</textarea>", ve.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue
    }();
    var et = re.documentElement, tt = /^key/, it = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        nt = /^([^.]*)(?:\.(.+)|)/;
    _e.event = {
        global: {}, add: function (e, t, i, n, s) {
            var o, r, a, l, c, u, d, h, p, f, g, m = He.get(e);
            if (m) for (i.handler && (o = i, i = o.handler, s = o.selector), s && _e.find.matchesSelector(et, s), i.guid || (i.guid = _e.guid++), (l = m.events) || (l = m.events = {}), (r = m.handle) || (r = m.handle = function (t) {
                return void 0 !== _e && _e.event.triggered !== t.type ? _e.event.dispatch.apply(e, arguments) : void 0
            }), t = (t || "").match(De) || [""], c = t.length; c--;) a = nt.exec(t[c]) || [], p = g = a[1], f = (a[2] || "").split(".").sort(), p && (d = _e.event.special[p] || {}, p = (s ? d.delegateType : d.bindType) || p, d = _e.event.special[p] || {}, u = _e.extend({
                type: p,
                origType: g,
                data: n,
                handler: i,
                guid: i.guid,
                selector: s,
                needsContext: s && _e.expr.match.needsContext.test(s),
                namespace: f.join(".")
            }, o), (h = l[p]) || (h = l[p] = [], h.delegateCount = 0, d.setup && !1 !== d.setup.call(e, n, f, r) || e.addEventListener && e.addEventListener(p, r)), d.add && (d.add.call(e, u), u.handler.guid || (u.handler.guid = i.guid)), s ? h.splice(h.delegateCount++, 0, u) : h.push(u), _e.event.global[p] = !0)
        }, remove: function (e, t, i, n, s) {
            var o, r, a, l, c, u, d, h, p, f, g, m = He.hasData(e) && He.get(e);
            if (m && (l = m.events)) {
                for (t = (t || "").match(De) || [""], c = t.length; c--;) if (a = nt.exec(t[c]) || [], p = g = a[1], f = (a[2] || "").split(".").sort(), p) {
                    for (d = _e.event.special[p] || {}, p = (n ? d.delegateType : d.bindType) || p, h = l[p] || [], a = a[2] && new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)"), r = o = h.length; o--;) u = h[o], !s && g !== u.origType || i && i.guid !== u.guid || a && !a.test(u.namespace) || n && n !== u.selector && ("**" !== n || !u.selector) || (h.splice(o, 1), u.selector && h.delegateCount--, d.remove && d.remove.call(e, u));
                    r && !h.length && (d.teardown && !1 !== d.teardown.call(e, f, m.handle) || _e.removeEvent(e, p, m.handle), delete l[p])
                } else for (p in l) _e.event.remove(e, p + t[c], i, n, !0);
                _e.isEmptyObject(l) && He.remove(e, "handle events")
            }
        }, dispatch: function (e) {
            var t, i, n, s, o, r, a = _e.event.fix(e), l = new Array(arguments.length),
                c = (He.get(this, "events") || {})[a.type] || [], u = _e.event.special[a.type] || {};
            for (l[0] = a, t = 1; t < arguments.length; t++) l[t] = arguments[t];
            if (a.delegateTarget = this, !u.preDispatch || !1 !== u.preDispatch.call(this, a)) {
                for (r = _e.event.handlers.call(this, a, c), t = 0; (s = r[t++]) && !a.isPropagationStopped();) for (a.currentTarget = s.elem, i = 0; (o = s.handlers[i++]) && !a.isImmediatePropagationStopped();) a.rnamespace && !a.rnamespace.test(o.namespace) || (a.handleObj = o, a.data = o.data, void 0 !== (n = ((_e.event.special[o.origType] || {}).handle || o.handler).apply(s.elem, l)) && !1 === (a.result = n) && (a.preventDefault(), a.stopPropagation()));
                return u.postDispatch && u.postDispatch.call(this, a), a.result
            }
        }, handlers: function (e, t) {
            var i, n, s, o, r, a = [], l = t.delegateCount, c = e.target;
            if (l && c.nodeType && !("click" === e.type && e.button >= 1)) for (; c !== this; c = c.parentNode || this) if (1 === c.nodeType && ("click" !== e.type || !0 !== c.disabled)) {
                for (o = [], r = {}, i = 0; i < l; i++) n = t[i], s = n.selector + " ", void 0 === r[s] && (r[s] = n.needsContext ? _e(s, this).index(c) > -1 : _e.find(s, this, null, [c]).length), r[s] && o.push(n);
                o.length && a.push({elem: c, handlers: o})
            }
            return c = this, l < t.length && a.push({elem: c, handlers: t.slice(l)}), a
        }, addProp: function (e, t) {
            Object.defineProperty(_e.Event.prototype, e, {
                enumerable: !0, configurable: !0, get: ye(t) ? function () {
                    if (this.originalEvent) return t(this.originalEvent)
                } : function () {
                    if (this.originalEvent) return this.originalEvent[e]
                }, set: function (t) {
                    Object.defineProperty(this, e, {enumerable: !0, configurable: !0, writable: !0, value: t})
                }
            })
        }, fix: function (e) {
            return e[_e.expando] ? e : new _e.Event(e)
        }, special: {
            load: {noBubble: !0}, focus: {
                trigger: function () {
                    if (this !== S() && this.focus) return this.focus(), !1
                }, delegateType: "focusin"
            }, blur: {
                trigger: function () {
                    if (this === S() && this.blur) return this.blur(), !1
                }, delegateType: "focusout"
            }, click: {
                trigger: function () {
                    if ("checkbox" === this.type && this.click && o(this, "input")) return this.click(), !1
                }, _default: function (e) {
                    return o(e.target, "a")
                }
            }, beforeunload: {
                postDispatch: function (e) {
                    void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                }
            }
        }
    }, _e.removeEvent = function (e, t, i) {
        e.removeEventListener && e.removeEventListener(t, i)
    }, _e.Event = function (e, t) {
        if (!(this instanceof _e.Event)) return new _e.Event(e, t);
        e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? k : $, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && _e.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[_e.expando] = !0
    }, _e.Event.prototype = {
        constructor: _e.Event,
        isDefaultPrevented: $,
        isPropagationStopped: $,
        isImmediatePropagationStopped: $,
        isSimulated: !1,
        preventDefault: function () {
            var e = this.originalEvent;
            this.isDefaultPrevented = k, e && !this.isSimulated && e.preventDefault()
        },
        stopPropagation: function () {
            var e = this.originalEvent;
            this.isPropagationStopped = k, e && !this.isSimulated && e.stopPropagation()
        },
        stopImmediatePropagation: function () {
            var e = this.originalEvent;
            this.isImmediatePropagationStopped = k, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
        }
    }, _e.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function (e) {
            var t = e.button;
            return null == e.which && tt.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && it.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
        }
    }, _e.event.addProp), _e.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (e, t) {
        _e.event.special[e] = {
            delegateType: t, bindType: t, handle: function (e) {
                var i, n = this, s = e.relatedTarget, o = e.handleObj;
                return s && (s === n || _e.contains(n, s)) || (e.type = o.origType, i = o.handler.apply(this, arguments), e.type = t), i
            }
        }
    }), _e.fn.extend({
        on: function (e, t, i, n) {
            return C(this, e, t, i, n)
        }, one: function (e, t, i, n) {
            return C(this, e, t, i, n, 1)
        }, off: function (e, t, i) {
            var n, s;
            if (e && e.preventDefault && e.handleObj) return n = e.handleObj, _e(e.delegateTarget).off(n.namespace ? n.origType + "." + n.namespace : n.origType, n.selector, n.handler), this;
            if ("object" == typeof e) {
                for (s in e) this.off(s, t, e[s]);
                return this
            }
            return !1 !== t && "function" != typeof t || (i = t, t = void 0), !1 === i && (i = $), this.each(function () {
                _e.event.remove(this, e, i, t)
            })
        }
    });
    var st = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
        ot = /<script|<style|<link/i, rt = /checked\s*(?:[^=]|=\s*.checked.)/i,
        at = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
    _e.extend({
        htmlPrefilter: function (e) {
            return e.replace(st, "<$1></$2>")
        }, clone: function (e, t, i) {
            var n, s, o, r, a = e.cloneNode(!0), l = _e.contains(e.ownerDocument, e);
            if (!(ve.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || _e.isXMLDoc(e))) for (r = _(a), o = _(e), n = 0, s = o.length; n < s; n++) D(o[n], r[n]);
            if (t) if (i) for (o = o || _(e), r = r || _(a), n = 0, s = o.length; n < s; n++) L(o[n], r[n]); else L(e, a);
            return r = _(a, "script"), r.length > 0 && w(r, !l && _(e, "script")), a
        }, cleanData: function (e) {
            for (var t, i, n, s = _e.event.special, o = 0; void 0 !== (i = e[o]); o++) if (Ie(i)) {
                if (t = i[He.expando]) {
                    if (t.events) for (n in t.events) s[n] ? _e.event.remove(i, n) : _e.removeEvent(i, n, t.handle);
                    i[He.expando] = void 0
                }
                i[Ne.expando] && (i[Ne.expando] = void 0)
            }
        }
    }), _e.fn.extend({
        detach: function (e) {
            return E(this, e, !0)
        }, remove: function (e) {
            return E(this, e)
        }, text: function (e) {
            return Fe(this, function (e) {
                return void 0 === e ? _e.text(this) : this.empty().each(function () {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
                })
            }, null, e, arguments.length)
        }, append: function () {
            return M(this, arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    P(this, e).appendChild(e)
                }
            })
        }, prepend: function () {
            return M(this, arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = P(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        }, before: function () {
            return M(this, arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        }, after: function () {
            return M(this, arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        }, empty: function () {
            for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (_e.cleanData(_(e, !1)), e.textContent = "");
            return this
        }, clone: function (e, t) {
            return e = null != e && e, t = null == t ? e : t, this.map(function () {
                return _e.clone(this, e, t)
            })
        }, html: function (e) {
            return Fe(this, function (e) {
                var t = this[0] || {}, i = 0, n = this.length;
                if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
                if ("string" == typeof e && !ot.test(e) && !Ke[(Ze.exec(e) || ["", ""])[1].toLowerCase()]) {
                    e = _e.htmlPrefilter(e);
                    try {
                        for (; i < n; i++) t = this[i] || {}, 1 === t.nodeType && (_e.cleanData(_(t, !1)), t.innerHTML = e);
                        t = 0
                    } catch (e) {
                    }
                }
                t && this.empty().append(e)
            }, null, e, arguments.length)
        }, replaceWith: function () {
            var e = [];
            return M(this, arguments, function (t) {
                var i = this.parentNode;
                _e.inArray(this, e) < 0 && (_e.cleanData(_(this)), i && i.replaceChild(t, this))
            }, e)
        }
    }), _e.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (e, t) {
        _e.fn[e] = function (e) {
            for (var i, n = [], s = _e(e), o = s.length - 1, r = 0; r <= o; r++) i = r === o ? this : this.clone(!0), _e(s[r])[t](i), ue.apply(n, i.get());
            return this.pushStack(n)
        }
    });
    var lt = new RegExp("^(" + qe + ")(?!px)[a-z%]+$", "i"), ct = function (t) {
        var i = t.ownerDocument.defaultView;
        return i && i.opener || (i = e), i.getComputedStyle(t)
    }, ut = new RegExp(Be.join("|"), "i");
    !function () {
        function t() {
            if (c) {
                l.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", c.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", et.appendChild(l).appendChild(c);
                var t = e.getComputedStyle(c);
                n = "1%" !== t.top, a = 12 === i(t.marginLeft), c.style.right = "60%", r = 36 === i(t.right), s = 36 === i(t.width), c.style.position = "absolute", o = 36 === c.offsetWidth || "absolute", et.removeChild(l), c = null
            }
        }

        function i(e) {
            return Math.round(parseFloat(e))
        }

        var n, s, o, r, a, l = re.createElement("div"), c = re.createElement("div");
        c.style && (c.style.backgroundClip = "content-box", c.cloneNode(!0).style.backgroundClip = "", ve.clearCloneStyle = "content-box" === c.style.backgroundClip, _e.extend(ve, {
            boxSizingReliable: function () {
                return t(), s
            }, pixelBoxStyles: function () {
                return t(), r
            }, pixelPosition: function () {
                return t(), n
            }, reliableMarginLeft: function () {
                return t(), a
            }, scrollboxSize: function () {
                return t(), o
            }
        }))
    }();
    var dt = /^(none|table(?!-c[ea]).+)/, ht = /^--/,
        pt = {position: "absolute", visibility: "hidden", display: "block"},
        ft = {letterSpacing: "0", fontWeight: "400"}, gt = ["Webkit", "Moz", "ms"],
        mt = re.createElement("div").style;
    _e.extend({
        cssHooks: {
            opacity: {
                get: function (e, t) {
                    if (t) {
                        var i = F(e, "opacity");
                        return "" === i ? "1" : i
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {},
        style: function (e, t, i, n) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var s, o, r, a = f(t), l = ht.test(t), c = e.style;
                if (l || (t = I(a)), r = _e.cssHooks[t] || _e.cssHooks[a], void 0 === i) return r && "get" in r && void 0 !== (s = r.get(e, !1, n)) ? s : c[t];
                o = typeof i, "string" === o && (s = Ye.exec(i)) && s[1] && (i = y(e, t, s), o = "number"), null != i && i === i && ("number" === o && (i += s && s[3] || (_e.cssNumber[a] ? "" : "px")), ve.clearCloneStyle || "" !== i || 0 !== t.indexOf("background") || (c[t] = "inherit"), r && "set" in r && void 0 === (i = r.set(e, i, n)) || (l ? c.setProperty(t, i) : c[t] = i))
            }
        },
        css: function (e, t, i, n) {
            var s, o, r, a = f(t);
            return ht.test(t) || (t = I(a)), r = _e.cssHooks[t] || _e.cssHooks[a], r && "get" in r && (s = r.get(e, !0, i)), void 0 === s && (s = F(e, t, n)), "normal" === s && t in ft && (s = ft[t]), "" === i || i ? (o = parseFloat(s), !0 === i || isFinite(o) ? o || 0 : s) : s
        }
    }), _e.each(["height", "width"], function (e, t) {
        _e.cssHooks[t] = {
            get: function (e, i, n) {
                if (i) return !dt.test(_e.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? z(e, t, n) : Ue(e, pt, function () {
                    return z(e, t, n)
                })
            }, set: function (e, i, n) {
                var s, o = ct(e), r = "border-box" === _e.css(e, "boxSizing", !1, o), a = n && N(e, t, n, r, o);
                return r && ve.scrollboxSize() === o.position && (a -= Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - parseFloat(o[t]) - N(e, t, "border", !1, o) - .5)), a && (s = Ye.exec(i)) && "px" !== (s[3] || "px") && (e.style[t] = i, i = _e.css(e, t)), H(e, i, a)
            }
        }
    }), _e.cssHooks.marginLeft = R(ve.reliableMarginLeft, function (e, t) {
        if (t) return (parseFloat(F(e, "marginLeft")) || e.getBoundingClientRect().left - Ue(e, {marginLeft: 0}, function () {
            return e.getBoundingClientRect().left
        })) + "px"
    }), _e.each({margin: "", padding: "", border: "Width"}, function (e, t) {
        _e.cssHooks[e + t] = {
            expand: function (i) {
                for (var n = 0, s = {}, o = "string" == typeof i ? i.split(" ") : [i]; n < 4; n++) s[e + Be[n] + t] = o[n] || o[n - 2] || o[0];
                return s
            }
        }, "margin" !== e && (_e.cssHooks[e + t].set = H)
    }), _e.fn.extend({
        css: function (e, t) {
            return Fe(this, function (e, t, i) {
                var n, s, o = {}, r = 0;
                if (Array.isArray(t)) {
                    for (n = ct(e), s = t.length; r < s; r++) o[t[r]] = _e.css(e, t[r], !1, n);
                    return o
                }
                return void 0 !== i ? _e.style(e, t, i) : _e.css(e, t)
            }, e, t, arguments.length > 1)
        }
    }), _e.Tween = X, X.prototype = {
        constructor: X, init: function (e, t, i, n, s, o) {
            this.elem = e, this.prop = i, this.easing = s || _e.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = n, this.unit = o || (_e.cssNumber[i] ? "" : "px")
        }, cur: function () {
            var e = X.propHooks[this.prop];
            return e && e.get ? e.get(this) : X.propHooks._default.get(this)
        }, run: function (e) {
            var t, i = X.propHooks[this.prop];
            return this.options.duration ? this.pos = t = _e.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), i && i.set ? i.set(this) : X.propHooks._default.set(this), this
        }
    }, X.prototype.init.prototype = X.prototype, X.propHooks = {
        _default: {
            get: function (e) {
                var t;
                return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = _e.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0)
            }, set: function (e) {
                _e.fx.step[e.prop] ? _e.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[_e.cssProps[e.prop]] && !_e.cssHooks[e.prop] ? e.elem[e.prop] = e.now : _e.style(e.elem, e.prop, e.now + e.unit)
            }
        }
    }, X.propHooks.scrollTop = X.propHooks.scrollLeft = {
        set: function (e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, _e.easing = {
        linear: function (e) {
            return e
        }, swing: function (e) {
            return .5 - Math.cos(e * Math.PI) / 2
        }, _default: "swing"
    }, _e.fx = X.prototype.init, _e.fx.step = {};
    var vt, yt, xt = /^(?:toggle|show|hide)$/, bt = /queueHooks$/;
    _e.Animation = _e.extend(G, {
        tweeners: {
            "*": [function (e, t) {
                var i = this.createTween(e, t);
                return y(i.elem, e, Ye.exec(t), i), i
            }]
        }, tweener: function (e, t) {
            ye(e) ? (t = e, e = ["*"]) : e = e.match(De);
            for (var i, n = 0, s = e.length; n < s; n++) i = e[n], G.tweeners[i] = G.tweeners[i] || [], G.tweeners[i].unshift(t)
        }, prefilters: [U], prefilter: function (e, t) {
            t ? G.prefilters.unshift(e) : G.prefilters.push(e)
        }
    }), _e.speed = function (e, t, i) {
        var n = e && "object" == typeof e ? _e.extend({}, e) : {
            complete: i || !i && t || ye(e) && e,
            duration: e,
            easing: i && t || t && !ye(t) && t
        };
        return _e.fx.off ? n.duration = 0 : "number" != typeof n.duration && (n.duration in _e.fx.speeds ? n.duration = _e.fx.speeds[n.duration] : n.duration = _e.fx.speeds._default), null != n.queue && !0 !== n.queue || (n.queue = "fx"), n.old = n.complete, n.complete = function () {
            ye(n.old) && n.old.call(this), n.queue && _e.dequeue(this, n.queue)
        }, n
    }, _e.fn.extend({
        fadeTo: function (e, t, i, n) {
            return this.filter(We).css("opacity", 0).show().end().animate({opacity: t}, e, i, n)
        }, animate: function (e, t, i, n) {
            var s = _e.isEmptyObject(e), o = _e.speed(t, i, n), r = function () {
                var t = G(this, _e.extend({}, e), o);
                (s || He.get(this, "finish")) && t.stop(!0)
            };
            return r.finish = r, s || !1 === o.queue ? this.each(r) : this.queue(o.queue, r)
        }, stop: function (e, t, i) {
            var n = function (e) {
                var t = e.stop;
                delete e.stop, t(i)
            };
            return "string" != typeof e && (i = t, t = e, e = void 0), t && !1 !== e && this.queue(e || "fx", []), this.each(function () {
                var t = !0, s = null != e && e + "queueHooks", o = _e.timers, r = He.get(this);
                if (s) r[s] && r[s].stop && n(r[s]); else for (s in r) r[s] && r[s].stop && bt.test(s) && n(r[s]);
                for (s = o.length; s--;) o[s].elem !== this || null != e && o[s].queue !== e || (o[s].anim.stop(i), t = !1, o.splice(s, 1));
                !t && i || _e.dequeue(this, e)
            })
        }, finish: function (e) {
            return !1 !== e && (e = e || "fx"), this.each(function () {
                var t, i = He.get(this), n = i[e + "queue"], s = i[e + "queueHooks"], o = _e.timers,
                    r = n ? n.length : 0;
                for (i.finish = !0, _e.queue(this, e, []), s && s.stop && s.stop.call(this, !0), t = o.length; t--;) o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1));
                for (t = 0; t < r; t++) n[t] && n[t].finish && n[t].finish.call(this);
                delete i.finish
            })
        }
    }), _e.each(["toggle", "show", "hide"], function (e, t) {
        var i = _e.fn[t];
        _e.fn[t] = function (e, n, s) {
            return null == e || "boolean" == typeof e ? i.apply(this, arguments) : this.animate(B(t, !0), e, n, s)
        }
    }), _e.each({
        slideDown: B("show"),
        slideUp: B("hide"),
        slideToggle: B("toggle"),
        fadeIn: {opacity: "show"},
        fadeOut: {opacity: "hide"},
        fadeToggle: {opacity: "toggle"}
    }, function (e, t) {
        _e.fn[e] = function (e, i, n) {
            return this.animate(t, e, i, n)
        }
    }), _e.timers = [], _e.fx.tick = function () {
        var e, t = 0, i = _e.timers;
        for (vt = Date.now(); t < i.length; t++) (e = i[t])() || i[t] !== e || i.splice(t--, 1);
        i.length || _e.fx.stop(), vt = void 0
    }, _e.fx.timer = function (e) {
        _e.timers.push(e), _e.fx.start()
    }, _e.fx.interval = 13, _e.fx.start = function () {
        yt || (yt = !0, q())
    }, _e.fx.stop = function () {
        yt = null
    }, _e.fx.speeds = {slow: 600, fast: 200, _default: 400}, _e.fn.delay = function (t, i) {
        return t = _e.fx ? _e.fx.speeds[t] || t : t, i = i || "fx", this.queue(i, function (i, n) {
            var s = e.setTimeout(i, t);
            n.stop = function () {
                e.clearTimeout(s)
            }
        })
    }, function () {
        var e = re.createElement("input"), t = re.createElement("select"),
            i = t.appendChild(re.createElement("option"));
        e.type = "checkbox", ve.checkOn = "" !== e.value, ve.optSelected = i.selected, e = re.createElement("input"), e.value = "t", e.type = "radio", ve.radioValue = "t" === e.value
    }();
    var _t, wt = _e.expr.attrHandle;
    _e.fn.extend({
        attr: function (e, t) {
            return Fe(this, _e.attr, e, t, arguments.length > 1)
        }, removeAttr: function (e) {
            return this.each(function () {
                _e.removeAttr(this, e)
            })
        }
    }), _e.extend({
        attr: function (e, t, i) {
            var n, s, o = e.nodeType;
            if (3 !== o && 8 !== o && 2 !== o) return void 0 === e.getAttribute ? _e.prop(e, t, i) : (1 === o && _e.isXMLDoc(e) || (s = _e.attrHooks[t.toLowerCase()] || (_e.expr.match.bool.test(t) ? _t : void 0)), void 0 !== i ? null === i ? void _e.removeAttr(e, t) : s && "set" in s && void 0 !== (n = s.set(e, i, t)) ? n : (e.setAttribute(t, i + ""), i) : s && "get" in s && null !== (n = s.get(e, t)) ? n : (n = _e.find.attr(e, t), null == n ? void 0 : n))
        }, attrHooks: {
            type: {
                set: function (e, t) {
                    if (!ve.radioValue && "radio" === t && o(e, "input")) {
                        var i = e.value;
                        return e.setAttribute("type", t), i && (e.value = i), t
                    }
                }
            }
        }, removeAttr: function (e, t) {
            var i, n = 0, s = t && t.match(De);
            if (s && 1 === e.nodeType) for (; i = s[n++];) e.removeAttribute(i)
        }
    }), _t = {
        set: function (e, t, i) {
            return !1 === t ? _e.removeAttr(e, i) : e.setAttribute(i, i), i
        }
    }, _e.each(_e.expr.match.bool.source.match(/\w+/g), function (e, t) {
        var i = wt[t] || _e.find.attr;
        wt[t] = function (e, t, n) {
            var s, o, r = t.toLowerCase();
            return n || (o = wt[r], wt[r] = s, s = null != i(e, t, n) ? r : null, wt[r] = o), s
        }
    });
    var Tt = /^(?:input|select|textarea|button)$/i, kt = /^(?:a|area)$/i;
    _e.fn.extend({
        prop: function (e, t) {
            return Fe(this, _e.prop, e, t, arguments.length > 1)
        }, removeProp: function (e) {
            return this.each(function () {
                delete this[_e.propFix[e] || e]
            })
        }
    }), _e.extend({
        prop: function (e, t, i) {
            var n, s, o = e.nodeType;
            if (3 !== o && 8 !== o && 2 !== o) return 1 === o && _e.isXMLDoc(e) || (t = _e.propFix[t] || t, s = _e.propHooks[t]), void 0 !== i ? s && "set" in s && void 0 !== (n = s.set(e, i, t)) ? n : e[t] = i : s && "get" in s && null !== (n = s.get(e, t)) ? n : e[t]
        }, propHooks: {
            tabIndex: {
                get: function (e) {
                    var t = _e.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : Tt.test(e.nodeName) || kt.test(e.nodeName) && e.href ? 0 : -1
                }
            }
        }, propFix: {for: "htmlFor", class: "className"}
    }), ve.optSelected || (_e.propHooks.selected = {
        get: function (e) {
            var t = e.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null
        }, set: function (e) {
            var t = e.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
        }
    }), _e.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        _e.propFix[this.toLowerCase()] = this
    }), _e.fn.extend({
        addClass: function (e) {
            var t, i, n, s, o, r, a, l = 0;
            if (ye(e)) return this.each(function (t) {
                _e(this).addClass(e.call(this, t, Q(this)))
            });
            if (t = K(e), t.length) for (; i = this[l++];) if (s = Q(i), n = 1 === i.nodeType && " " + Z(s) + " ") {
                for (r = 0; o = t[r++];) n.indexOf(" " + o + " ") < 0 && (n += o + " ");
                a = Z(n), s !== a && i.setAttribute("class", a)
            }
            return this
        }, removeClass: function (e) {
            var t, i, n, s, o, r, a, l = 0;
            if (ye(e)) return this.each(function (t) {
                _e(this).removeClass(e.call(this, t, Q(this)))
            });
            if (!arguments.length) return this.attr("class", "");
            if (t = K(e), t.length) for (; i = this[l++];) if (s = Q(i), n = 1 === i.nodeType && " " + Z(s) + " ") {
                for (r = 0; o = t[r++];) for (; n.indexOf(" " + o + " ") > -1;) n = n.replace(" " + o + " ", " ");
                a = Z(n), s !== a && i.setAttribute("class", a)
            }
            return this
        }, toggleClass: function (e, t) {
            var i = typeof e, n = "string" === i || Array.isArray(e);
            return "boolean" == typeof t && n ? t ? this.addClass(e) : this.removeClass(e) : ye(e) ? this.each(function (i) {
                _e(this).toggleClass(e.call(this, i, Q(this), t), t)
            }) : this.each(function () {
                var t, s, o, r;
                if (n) for (s = 0, o = _e(this), r = K(e); t = r[s++];) o.hasClass(t) ? o.removeClass(t) : o.addClass(t); else void 0 !== e && "boolean" !== i || (t = Q(this), t && He.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === e ? "" : He.get(this, "__className__") || ""))
            })
        }, hasClass: function (e) {
            var t, i, n = 0;
            for (t = " " + e + " "; i = this[n++];) if (1 === i.nodeType && (" " + Z(Q(i)) + " ").indexOf(t) > -1) return !0;
            return !1
        }
    });
    var $t = /\r/g;
    _e.fn.extend({
        val: function (e) {
            var t, i, n, s = this[0];
            {
                if (arguments.length) return n = ye(e), this.each(function (i) {
                    var s;
                    1 === this.nodeType && (s = n ? e.call(this, i, _e(this).val()) : e, null == s ? s = "" : "number" == typeof s ? s += "" : Array.isArray(s) && (s = _e.map(s, function (e) {
                        return null == e ? "" : e + ""
                    })), (t = _e.valHooks[this.type] || _e.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, s, "value") || (this.value = s))
                });
                if (s) return (t = _e.valHooks[s.type] || _e.valHooks[s.nodeName.toLowerCase()]) && "get" in t && void 0 !== (i = t.get(s, "value")) ? i : (i = s.value, "string" == typeof i ? i.replace($t, "") : null == i ? "" : i)
            }
        }
    }), _e.extend({
        valHooks: {
            option: {
                get: function (e) {
                    var t = _e.find.attr(e, "value");
                    return null != t ? t : Z(_e.text(e))
                }
            }, select: {
                get: function (e) {
                    var t, i, n, s = e.options, r = e.selectedIndex, a = "select-one" === e.type, l = a ? null : [],
                        c = a ? r + 1 : s.length;
                    for (n = r < 0 ? c : a ? r : 0; n < c; n++) if (i = s[n], (i.selected || n === r) && !i.disabled && (!i.parentNode.disabled || !o(i.parentNode, "optgroup"))) {
                        if (t = _e(i).val(), a) return t;
                        l.push(t)
                    }
                    return l
                }, set: function (e, t) {
                    for (var i, n, s = e.options, o = _e.makeArray(t), r = s.length; r--;) n = s[r], (n.selected = _e.inArray(_e.valHooks.option.get(n), o) > -1) && (i = !0);
                    return i || (e.selectedIndex = -1), o
                }
            }
        }
    }), _e.each(["radio", "checkbox"], function () {
        _e.valHooks[this] = {
            set: function (e, t) {
                if (Array.isArray(t)) return e.checked = _e.inArray(_e(e).val(), t) > -1
            }
        }, ve.checkOn || (_e.valHooks[this].get = function (e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    }), ve.focusin = "onfocusin" in e;
    var St = /^(?:focusinfocus|focusoutblur)$/, Ct = function (e) {
        e.stopPropagation()
    };
    _e.extend(_e.event, {
        trigger: function (t, i, n, s) {
            var o, r, a, l, c, u, d, h, p = [n || re], f = fe.call(t, "type") ? t.type : t,
                g = fe.call(t, "namespace") ? t.namespace.split(".") : [];
            if (r = h = a = n = n || re, 3 !== n.nodeType && 8 !== n.nodeType && !St.test(f + _e.event.triggered) && (f.indexOf(".") > -1 && (g = f.split("."), f = g.shift(), g.sort()), c = f.indexOf(":") < 0 && "on" + f, t = t[_e.expando] ? t : new _e.Event(f, "object" == typeof t && t), t.isTrigger = s ? 2 : 3, t.namespace = g.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + g.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = n), i = null == i ? [t] : _e.makeArray(i, [t]), d = _e.event.special[f] || {}, s || !d.trigger || !1 !== d.trigger.apply(n, i))) {
                if (!s && !d.noBubble && !xe(n)) {
                    for (l = d.delegateType || f, St.test(l + f) || (r = r.parentNode); r; r = r.parentNode) p.push(r), a = r;
                    a === (n.ownerDocument || re) && p.push(a.defaultView || a.parentWindow || e)
                }
                for (o = 0; (r = p[o++]) && !t.isPropagationStopped();) h = r, t.type = o > 1 ? l : d.bindType || f, u = (He.get(r, "events") || {})[t.type] && He.get(r, "handle"), u && u.apply(r, i), (u = c && r[c]) && u.apply && Ie(r) && (t.result = u.apply(r, i), !1 === t.result && t.preventDefault());
                return t.type = f, s || t.isDefaultPrevented() || d._default && !1 !== d._default.apply(p.pop(), i) || !Ie(n) || c && ye(n[f]) && !xe(n) && (a = n[c], a && (n[c] = null), _e.event.triggered = f, t.isPropagationStopped() && h.addEventListener(f, Ct), n[f](), t.isPropagationStopped() && h.removeEventListener(f, Ct), _e.event.triggered = void 0, a && (n[c] = a)), t.result
            }
        }, simulate: function (e, t, i) {
            var n = _e.extend(new _e.Event, i, {type: e, isSimulated: !0});
            _e.event.trigger(n, null, t)
        }
    }), _e.fn.extend({
        trigger: function (e, t) {
            return this.each(function () {
                _e.event.trigger(e, t, this)
            })
        }, triggerHandler: function (e, t) {
            var i = this[0];
            if (i) return _e.event.trigger(e, t, i, !0)
        }
    }), ve.focusin || _e.each({focus: "focusin", blur: "focusout"}, function (e, t) {
        var i = function (e) {
            _e.event.simulate(t, e.target, _e.event.fix(e))
        };
        _e.event.special[t] = {
            setup: function () {
                var n = this.ownerDocument || this, s = He.access(n, t);
                s || n.addEventListener(e, i, !0), He.access(n, t, (s || 0) + 1)
            }, teardown: function () {
                var n = this.ownerDocument || this, s = He.access(n, t) - 1;
                s ? He.access(n, t, s) : (n.removeEventListener(e, i, !0), He.remove(n, t))
            }
        }
    });
    var Pt = e.location, Ot = Date.now(), At = /\?/;
    _e.parseXML = function (t) {
        var i;
        if (!t || "string" != typeof t) return null;
        try {
            i = (new e.DOMParser).parseFromString(t, "text/xml")
        } catch (e) {
            i = void 0
        }
        return i && !i.getElementsByTagName("parsererror").length || _e.error("Invalid XML: " + t), i
    };
    var Lt = /\[\]$/, Dt = /\r?\n/g, Mt = /^(?:submit|button|image|reset|file)$/i,
        Et = /^(?:input|select|textarea|keygen)/i;
    _e.param = function (e, t) {
        var i, n = [], s = function (e, t) {
            var i = ye(t) ? t() : t;
            n[n.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == i ? "" : i)
        };
        if (Array.isArray(e) || e.jquery && !_e.isPlainObject(e)) _e.each(e, function () {
            s(this.name, this.value)
        }); else for (i in e) J(i, e[i], t, s);
        return n.join("&")
    }, _e.fn.extend({
        serialize: function () {
            return _e.param(this.serializeArray())
        }, serializeArray: function () {
            return this.map(function () {
                var e = _e.prop(this, "elements");
                return e ? _e.makeArray(e) : this
            }).filter(function () {
                var e = this.type;
                return this.name && !_e(this).is(":disabled") && Et.test(this.nodeName) && !Mt.test(e) && (this.checked || !Ge.test(e))
            }).map(function (e, t) {
                var i = _e(this).val();
                return null == i ? null : Array.isArray(i) ? _e.map(i, function (e) {
                    return {name: t.name, value: e.replace(Dt, "\r\n")}
                }) : {name: t.name, value: i.replace(Dt, "\r\n")}
            }).get()
        }
    });
    var Ft = /%20/g, Rt = /#.*$/, jt = /([?&])_=[^&]*/, It = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        Ht = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, Nt = /^(?:GET|HEAD)$/, zt = /^\/\//,
        Xt = {}, qt = {}, Yt = "*/".concat("*"), Bt = re.createElement("a");
    Bt.href = Pt.href, _e.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Pt.href,
            type: "GET",
            isLocal: Ht.test(Pt.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Yt,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/},
            responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
            converters: {"* text": String, "text html": !0, "text json": JSON.parse, "text xml": _e.parseXML},
            flatOptions: {url: !0, context: !0}
        },
        ajaxSetup: function (e, t) {
            return t ? ie(ie(e, _e.ajaxSettings), t) : ie(_e.ajaxSettings, e)
        },
        ajaxPrefilter: ee(Xt),
        ajaxTransport: ee(qt),
        ajax: function (t, i) {
            function n(t, i, n, a) {
                var c, h, p, b, _, w = i;
                u || (u = !0, l && e.clearTimeout(l), s = void 0, r = a || "", T.readyState = t > 0 ? 4 : 0, c = t >= 200 && t < 300 || 304 === t, n && (b = ne(f, T, n)), b = se(f, b, T, c), c ? (f.ifModified && (_ = T.getResponseHeader("Last-Modified"), _ && (_e.lastModified[o] = _), (_ = T.getResponseHeader("etag")) && (_e.etag[o] = _)), 204 === t || "HEAD" === f.type ? w = "nocontent" : 304 === t ? w = "notmodified" : (w = b.state, h = b.data, p = b.error, c = !p)) : (p = w, !t && w || (w = "error", t < 0 && (t = 0))), T.status = t, T.statusText = (i || w) + "", c ? v.resolveWith(g, [h, w, T]) : v.rejectWith(g, [T, w, p]), T.statusCode(x), x = void 0, d && m.trigger(c ? "ajaxSuccess" : "ajaxError", [T, f, c ? h : p]), y.fireWith(g, [T, w]), d && (m.trigger("ajaxComplete", [T, f]), --_e.active || _e.event.trigger("ajaxStop")))
            }

            "object" == typeof t && (i = t, t = void 0), i = i || {};
            var s, o, r, a, l, c, u, d, h, p, f = _e.ajaxSetup({}, i), g = f.context || f,
                m = f.context && (g.nodeType || g.jquery) ? _e(g) : _e.event, v = _e.Deferred(),
                y = _e.Callbacks("once memory"), x = f.statusCode || {}, b = {}, _ = {}, w = "canceled", T = {
                    readyState: 0, getResponseHeader: function (e) {
                        var t;
                        if (u) {
                            if (!a) for (a = {}; t = It.exec(r);) a[t[1].toLowerCase()] = t[2];
                            t = a[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    }, getAllResponseHeaders: function () {
                        return u ? r : null
                    }, setRequestHeader: function (e, t) {
                        return null == u && (e = _[e.toLowerCase()] = _[e.toLowerCase()] || e, b[e] = t), this
                    }, overrideMimeType: function (e) {
                        return null == u && (f.mimeType = e), this
                    }, statusCode: function (e) {
                        var t;
                        if (e) if (u) T.always(e[T.status]); else for (t in e) x[t] = [x[t], e[t]];
                        return this
                    }, abort: function (e) {
                        var t = e || w;
                        return s && s.abort(t), n(0, t), this
                    }
                };
            if (v.promise(T), f.url = ((t || f.url || Pt.href) + "").replace(zt, Pt.protocol + "//"), f.type = i.method || i.type || f.method || f.type, f.dataTypes = (f.dataType || "*").toLowerCase().match(De) || [""], null == f.crossDomain) {
                c = re.createElement("a");
                try {
                    c.href = f.url, c.href = c.href, f.crossDomain = Bt.protocol + "//" + Bt.host != c.protocol + "//" + c.host
                } catch (e) {
                    f.crossDomain = !0
                }
            }
            if (f.data && f.processData && "string" != typeof f.data && (f.data = _e.param(f.data, f.traditional)), te(Xt, f, i, T), u) return T;
            d = _e.event && f.global, d && 0 == _e.active++ && _e.event.trigger("ajaxStart"), f.type = f.type.toUpperCase(), f.hasContent = !Nt.test(f.type), o = f.url.replace(Rt, ""), f.hasContent ? f.data && f.processData && 0 === (f.contentType || "").indexOf("application/x-www-form-urlencoded") && (f.data = f.data.replace(Ft, "+")) : (p = f.url.slice(o.length), f.data && (f.processData || "string" == typeof f.data) && (o += (At.test(o) ? "&" : "?") + f.data, delete f.data), !1 === f.cache && (o = o.replace(jt, "$1"), p = (At.test(o) ? "&" : "?") + "_=" + Ot++ + p), f.url = o + p), f.ifModified && (_e.lastModified[o] && T.setRequestHeader("If-Modified-Since", _e.lastModified[o]), _e.etag[o] && T.setRequestHeader("If-None-Match", _e.etag[o])), (f.data && f.hasContent && !1 !== f.contentType || i.contentType) && T.setRequestHeader("Content-Type", f.contentType), T.setRequestHeader("Accept", f.dataTypes[0] && f.accepts[f.dataTypes[0]] ? f.accepts[f.dataTypes[0]] + ("*" !== f.dataTypes[0] ? ", " + Yt + "; q=0.01" : "") : f.accepts["*"]);
            for (h in f.headers) T.setRequestHeader(h, f.headers[h]);
            if (f.beforeSend && (!1 === f.beforeSend.call(g, T, f) || u)) return T.abort();
            if (w = "abort", y.add(f.complete), T.done(f.success), T.fail(f.error), s = te(qt, f, i, T)) {
                if (T.readyState = 1, d && m.trigger("ajaxSend", [T, f]), u) return T;
                f.async && f.timeout > 0 && (l = e.setTimeout(function () {
                    T.abort("timeout")
                }, f.timeout));
                try {
                    u = !1, s.send(b, n)
                } catch (e) {
                    if (u) throw e;
                    n(-1, e)
                }
            } else n(-1, "No Transport");
            return T
        },
        getJSON: function (e, t, i) {
            return _e.get(e, t, i, "json")
        },
        getScript: function (e, t) {
            return _e.get(e, void 0, t, "script")
        }
    }), _e.each(["get", "post"], function (e, t) {
        _e[t] = function (e, i, n, s) {
            return ye(i) && (s = s || n, n = i, i = void 0), _e.ajax(_e.extend({
                url: e,
                type: t,
                dataType: s,
                data: i,
                success: n
            }, _e.isPlainObject(e) && e))
        }
    }), _e._evalUrl = function (e) {
        return _e.ajax({url: e, type: "GET", dataType: "script", cache: !0, async: !1, global: !1, throws: !0})
    }, _e.fn.extend({
        wrapAll: function (e) {
            var t;
            return this[0] && (ye(e) && (e = e.call(this[0])), t = _e(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                for (var e = this; e.firstElementChild;) e = e.firstElementChild;
                return e
            }).append(this)), this
        }, wrapInner: function (e) {
            return ye(e) ? this.each(function (t) {
                _e(this).wrapInner(e.call(this, t))
            }) : this.each(function () {
                var t = _e(this), i = t.contents();
                i.length ? i.wrapAll(e) : t.append(e)
            })
        }, wrap: function (e) {
            var t = ye(e);
            return this.each(function (i) {
                _e(this).wrapAll(t ? e.call(this, i) : e)
            })
        }, unwrap: function (e) {
            return this.parent(e).not("body").each(function () {
                _e(this).replaceWith(this.childNodes)
            }), this
        }
    }), _e.expr.pseudos.hidden = function (e) {
        return !_e.expr.pseudos.visible(e)
    }, _e.expr.pseudos.visible = function (e) {
        return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
    }, _e.ajaxSettings.xhr = function () {
        try {
            return new e.XMLHttpRequest
        } catch (e) {
        }
    };
    var Wt = {0: 200, 1223: 204}, Ut = _e.ajaxSettings.xhr();
    ve.cors = !!Ut && "withCredentials" in Ut, ve.ajax = Ut = !!Ut, _e.ajaxTransport(function (t) {
        var i, n;
        if (ve.cors || Ut && !t.crossDomain) return {
            send: function (s, o) {
                var r, a = t.xhr();
                if (a.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields) for (r in t.xhrFields) a[r] = t.xhrFields[r];
                t.mimeType && a.overrideMimeType && a.overrideMimeType(t.mimeType), t.crossDomain || s["X-Requested-With"] || (s["X-Requested-With"] = "XMLHttpRequest");
                for (r in s) a.setRequestHeader(r, s[r]);
                i = function (e) {
                    return function () {
                        i && (i = n = a.onload = a.onerror = a.onabort = a.ontimeout = a.onreadystatechange = null, "abort" === e ? a.abort() : "error" === e ? "number" != typeof a.status ? o(0, "error") : o(a.status, a.statusText) : o(Wt[a.status] || a.status, a.statusText, "text" !== (a.responseType || "text") || "string" != typeof a.responseText ? {binary: a.response} : {text: a.responseText}, a.getAllResponseHeaders()))
                    }
                }, a.onload = i(), n = a.onerror = a.ontimeout = i("error"), void 0 !== a.onabort ? a.onabort = n : a.onreadystatechange = function () {
                    4 === a.readyState && e.setTimeout(function () {
                        i && n()
                    })
                }, i = i("abort");
                try {
                    a.send(t.hasContent && t.data || null)
                } catch (e) {
                    if (i) throw e
                }
            }, abort: function () {
                i && i()
            }
        }
    }), _e.ajaxPrefilter(function (e) {
        e.crossDomain && (e.contents.script = !1)
    }), _e.ajaxSetup({
        accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
        contents: {script: /\b(?:java|ecma)script\b/},
        converters: {
            "text script": function (e) {
                return _e.globalEval(e), e
            }
        }
    }), _e.ajaxPrefilter("script", function (e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
    }), _e.ajaxTransport("script", function (e) {
        if (e.crossDomain) {
            var t, i;
            return {
                send: function (n, s) {
                    t = _e("<script>").prop({charset: e.scriptCharset, src: e.url}).on("load error", i = function (e) {
                        t.remove(), i = null, e && s("error" === e.type ? 404 : 200, e.type)
                    }), re.head.appendChild(t[0])
                }, abort: function () {
                    i && i()
                }
            }
        }
    });
    var Vt = [], Gt = /(=)\?(?=&|$)|\?\?/;
    _e.ajaxSetup({
        jsonp: "callback", jsonpCallback: function () {
            var e = Vt.pop() || _e.expando + "_" + Ot++;
            return this[e] = !0, e
        }
    }), _e.ajaxPrefilter("json jsonp", function (t, i, n) {
        var s, o, r,
            a = !1 !== t.jsonp && (Gt.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && Gt.test(t.data) && "data");
        if (a || "jsonp" === t.dataTypes[0]) return s = t.jsonpCallback = ye(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, a ? t[a] = t[a].replace(Gt, "$1" + s) : !1 !== t.jsonp && (t.url += (At.test(t.url) ? "&" : "?") + t.jsonp + "=" + s), t.converters["script json"] = function () {
            return r || _e.error(s + " was not called"), r[0]
        }, t.dataTypes[0] = "json", o = e[s], e[s] = function () {
            r = arguments
        }, n.always(function () {
            void 0 === o ? _e(e).removeProp(s) : e[s] = o, t[s] && (t.jsonpCallback = i.jsonpCallback, Vt.push(s)), r && ye(o) && o(r[0]), r = o = void 0
        }), "script"
    }), ve.createHTMLDocument = function () {
        var e = re.implementation.createHTMLDocument("").body;
        return e.innerHTML = "<form></form><form></form>", 2 === e.childNodes.length
    }(), _e.parseHTML = function (e, t, i) {
        if ("string" != typeof e) return [];
        "boolean" == typeof t && (i = t, t = !1);
        var n, s, o;
        return t || (ve.createHTMLDocument ? (t = re.implementation.createHTMLDocument(""), n = t.createElement("base"), n.href = re.location.href, t.head.appendChild(n)) : t = re), s = Ce.exec(e), o = !i && [], s ? [t.createElement(s[1])] : (s = T([e], t, o), o && o.length && _e(o).remove(), _e.merge([], s.childNodes))
    }, _e.fn.load = function (e, t, i) {
        var n, s, o, r = this, a = e.indexOf(" ");
        return a > -1 && (n = Z(e.slice(a)), e = e.slice(0, a)), ye(t) ? (i = t, t = void 0) : t && "object" == typeof t && (s = "POST"), r.length > 0 && _e.ajax({
            url: e,
            type: s || "GET",
            dataType: "html",
            data: t
        }).done(function (e) {
            o = arguments, r.html(n ? _e("<div>").append(_e.parseHTML(e)).find(n) : e)
        }).always(i && function (e, t) {
            r.each(function () {
                i.apply(this, o || [e.responseText, t, e])
            })
        }), this
    }, _e.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
        _e.fn[t] = function (e) {
            return this.on(t, e)
        }
    }), _e.expr.pseudos.animated = function (e) {
        return _e.grep(_e.timers, function (t) {
            return e === t.elem
        }).length
    }, _e.offset = {
        setOffset: function (e, t, i) {
            var n, s, o, r, a, l, c, u = _e.css(e, "position"), d = _e(e), h = {};
            "static" === u && (e.style.position = "relative"), a = d.offset(), o = _e.css(e, "top"), l = _e.css(e, "left"), c = ("absolute" === u || "fixed" === u) && (o + l).indexOf("auto") > -1, c ? (n = d.position(), r = n.top, s = n.left) : (r = parseFloat(o) || 0, s = parseFloat(l) || 0), ye(t) && (t = t.call(e, i, _e.extend({}, a))), null != t.top && (h.top = t.top - a.top + r), null != t.left && (h.left = t.left - a.left + s), "using" in t ? t.using.call(e, h) : d.css(h)
        }
    }, _e.fn.extend({
        offset: function (e) {
            if (arguments.length) return void 0 === e ? this : this.each(function (t) {
                _e.offset.setOffset(this, e, t)
            });
            var t, i, n = this[0];
            if (n) return n.getClientRects().length ? (t = n.getBoundingClientRect(), i = n.ownerDocument.defaultView, {
                top: t.top + i.pageYOffset,
                left: t.left + i.pageXOffset
            }) : {top: 0, left: 0}
        }, position: function () {
            if (this[0]) {
                var e, t, i, n = this[0], s = {top: 0, left: 0};
                if ("fixed" === _e.css(n, "position")) t = n.getBoundingClientRect(); else {
                    for (t = this.offset(), i = n.ownerDocument, e = n.offsetParent || i.documentElement; e && (e === i.body || e === i.documentElement) && "static" === _e.css(e, "position");) e = e.parentNode;
                    e && e !== n && 1 === e.nodeType && (s = _e(e).offset(), s.top += _e.css(e, "borderTopWidth", !0), s.left += _e.css(e, "borderLeftWidth", !0))
                }
                return {
                    top: t.top - s.top - _e.css(n, "marginTop", !0),
                    left: t.left - s.left - _e.css(n, "marginLeft", !0)
                }
            }
        }, offsetParent: function () {
            return this.map(function () {
                for (var e = this.offsetParent; e && "static" === _e.css(e, "position");) e = e.offsetParent;
                return e || et
            })
        }
    }), _e.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, t) {
        var i = "pageYOffset" === t;
        _e.fn[e] = function (n) {
            return Fe(this, function (e, n, s) {
                var o;
                if (xe(e) ? o = e : 9 === e.nodeType && (o = e.defaultView), void 0 === s) return o ? o[t] : e[n];
                o ? o.scrollTo(i ? o.pageXOffset : s, i ? s : o.pageYOffset) : e[n] = s
            }, e, n, arguments.length)
        }
    }), _e.each(["top", "left"], function (e, t) {
        _e.cssHooks[t] = R(ve.pixelPosition, function (e, i) {
            if (i) return i = F(e, t), lt.test(i) ? _e(e).position()[t] + "px" : i
        })
    }), _e.each({Height: "height", Width: "width"}, function (e, t) {
        _e.each({padding: "inner" + e, content: t, "": "outer" + e}, function (i, n) {
            _e.fn[n] = function (s, o) {
                var r = arguments.length && (i || "boolean" != typeof s),
                    a = i || (!0 === s || !0 === o ? "margin" : "border");
                return Fe(this, function (t, i, s) {
                    var o;
                    return xe(t) ? 0 === n.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (o = t.documentElement, Math.max(t.body["scroll" + e], o["scroll" + e], t.body["offset" + e], o["offset" + e], o["client" + e])) : void 0 === s ? _e.css(t, i, a) : _e.style(t, i, s, a)
                }, t, r ? s : void 0, r)
            }
        })
    }), _e.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (e, t) {
        _e.fn[t] = function (e, i) {
            return arguments.length > 0 ? this.on(t, null, e, i) : this.trigger(t)
        }
    }), _e.fn.extend({
        hover: function (e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        }
    }), _e.fn.extend({
        bind: function (e, t, i) {
            return this.on(e, null, t, i)
        }, unbind: function (e, t) {
            return this.off(e, null, t)
        }, delegate: function (e, t, i, n) {
            return this.on(t, e, i, n)
        }, undelegate: function (e, t, i) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", i)
        }
    }), _e.proxy = function (e, t) {
        var i, n, s;
        if ("string" == typeof t && (i = e[t], t = e, e = i), ye(e)) return n = le.call(arguments, 2), s = function () {
            return e.apply(t || this, n.concat(le.call(arguments)))
        }, s.guid = e.guid = e.guid || _e.guid++, s
    }, _e.holdReady = function (e) {
        e ? _e.readyWait++ : _e.ready(!0)
    }, _e.isArray = Array.isArray, _e.parseJSON = JSON.parse, _e.nodeName = o, _e.isFunction = ye, _e.isWindow = xe, _e.camelCase = f, _e.type = n, _e.now = Date.now, _e.isNumeric = function (e) {
        var t = _e.type(e);
        return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
    }, "function" == typeof define && define.amd && define("jquery", [], function () {
        return _e
    });
    var Zt = e.jQuery, Qt = e.$;
    return _e.noConflict = function (t) {
        return e.$ === _e && (e.$ = Qt), t && e.jQuery === _e && (e.jQuery = Zt), _e
    }, t || (e.jQuery = e.$ = _e), _e
}), function (e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof module && module.exports ? module.exports = function (t, i) {
        return void 0 === i && (i = "undefined" != typeof window ? require("jquery") : require("jquery")(t)), e(i), i
    } : e(jQuery)
}(function (e) {
    function t(e) {
        return 9 === e ? -1 !== navigator.appVersion.indexOf("MSIE 9.") : (userAgent = navigator.userAgent, userAgent.indexOf("MSIE ") > -1 || userAgent.indexOf("Trident/") > -1)
    }

    function i(e) {
        var t = /%|px|em|cm|vh|vw/;
        return parseInt(String(e).split(t)[0])
    }

    var n = e(window), s = e(document), o = "iziModal",
        r = {CLOSING: "closing", CLOSED: "closed", OPENING: "opening", OPENED: "opened", DESTROYED: "destroyed"},
        a = function () {
            var e, t = document.createElement("fakeelement"), i = {
                animation: "animationend",
                OAnimation: "oAnimationEnd",
                MozAnimation: "animationend",
                WebkitAnimation: "webkitAnimationEnd"
            };
            for (e in i) if (void 0 !== t.style[e]) return i[e]
        }(), l = !!/Mobi/.test(navigator.userAgent);
    window.$iziModal = {}, window.$iziModal.autoOpen = 0, window.$iziModal.history = !1;
    var c = function (e, t) {
        this.init(e, t)
    };
    return c.prototype = {
        constructor: c, init: function (t, i) {
            var n = this;
            this.$element = e(t), void 0 !== this.$element[0].id && "" !== this.$element[0].id ? this.id = this.$element[0].id : (this.id = o + Math.floor(1e7 * Math.random() + 1), this.$element.attr("id", this.id)), this.classes = void 0 !== this.$element.attr("class") ? this.$element.attr("class") : "", this.content = this.$element.html(), this.state = r.CLOSED, this.options = i, this.width = 0, this.timer = null, this.timerTimeout = null, this.progressBar = null, this.isPaused = !1, this.isFullscreen = !1, this.headerHeight = 0, this.modalHeight = 0, this.$overlay = e('<div class="' + o + '-overlay" style="background-color:' + i.overlayColor + '"></div>'), this.$navigate = e('<div class="' + o + '-navigate"><div class="' + o + '-navigate-caption">Use</div><button class="' + o + '-navigate-prev"></button><button class="' + o + '-navigate-next"></button></div>'), this.group = {
                name: this.$element.attr("data-" + o + "-group"),
                index: null,
                ids: []
            }, this.$element.attr("aria-hidden", "true"), this.$element.attr("aria-labelledby", this.id), this.$element.attr("role", "dialog"), this.$element.hasClass("iziModal") || this.$element.addClass("iziModal"), void 0 === this.group.name && "" !== i.group && (this.group.name = i.group, this.$element.attr("data-" + o + "-group", i.group)), !0 === this.options.loop && this.$element.attr("data-" + o + "-loop", !0), e.each(this.options, function (e, t) {
                var s = n.$element.attr("data-" + o + "-" + e);
                try {
                    void 0 !== s && (i[e] = "" === s || "true" == s || "false" != s && ("function" == typeof t ? new Function(s) : s))
                } catch (e) {
                }
            }), !1 !== i.appendTo && this.$element.appendTo(i.appendTo), !0 === i.iframe ? (this.$element.html('<div class="' + o + '-wrap"><div class="' + o + '-content"><iframe class="' + o + '-iframe"></iframe>' + this.content + "</div></div>"), null !== i.iframeHeight && this.$element.find("." + o + "-iframe").css("height", i.iframeHeight)) : this.$element.html('<div class="' + o + '-wrap"><div class="' + o + '-content">' + this.content + "</div></div>"), null !== this.options.background && this.$element.css("background", this.options.background), this.$wrap = this.$element.find("." + o + "-wrap"), null === i.zindex || isNaN(parseInt(i.zindex)) || (this.$element.css("z-index", i.zindex), this.$navigate.css("z-index", i.zindex - 1), this.$overlay.css("z-index", i.zindex - 2)), "" !== i.radius && this.$element.css("border-radius", i.radius), "" !== i.padding && this.$element.find("." + o + "-content").css("padding", i.padding), "" !== i.theme && ("light" === i.theme ? this.$element.addClass(o + "-light") : this.$element.addClass(i.theme)), !0 === i.rtl && this.$element.addClass(o + "-rtl"), !0 === i.openFullscreen && (this.isFullscreen = !0, this.$element.addClass("isFullscreen")), this.createHeader(), this.recalcWidth(), this.recalcVerticalPos(), !n.options.afterRender || "function" != typeof n.options.afterRender && "object" != typeof n.options.afterRender || n.options.afterRender(n)
        }, createHeader: function () {
            this.$header = e('<div class="' + o + '-header"><h2 class="' + o + '-header-title">' + this.options.title + '</h2><p class="' + o + '-header-subtitle">' + this.options.subtitle + '</p><div class="' + o + '-header-buttons"></div></div>'), !0 === this.options.closeButton && this.$header.find("." + o + "-header-buttons").append('<a href="javascript:void(0)" class="' + o + "-button " + o + '-button-close" data-' + o + "-close></a>"), !0 === this.options.fullscreen && this.$header.find("." + o + "-header-buttons").append('<a href="javascript:void(0)" class="' + o + "-button " + o + '-button-fullscreen" data-' + o + "-fullscreen></a>"), !0 !== this.options.timeoutProgressbar || isNaN(parseInt(this.options.timeout)) || !1 === this.options.timeout || 0 === this.options.timeout || this.$header.prepend('<div class="' + o + '-progressbar"><div style="background-color:' + this.options.timeoutProgressbarColor + '"></div></div>'), "" === this.options.subtitle && this.$header.addClass(o + "-noSubtitle"), "" !== this.options.title && (null !== this.options.headerColor && (!0 === this.options.borderBottom && this.$element.css("border-bottom", "3px solid " + this.options.headerColor), this.$header.css("background", this.options.headerColor)), null === this.options.icon && null === this.options.iconText || (this.$header.prepend('<i class="' + o + '-header-icon"></i>'), null !== this.options.icon && this.$header.find("." + o + "-header-icon").addClass(this.options.icon).css("color", this.options.iconColor), null !== this.options.iconText && this.$header.find("." + o + "-header-icon").html(this.options.iconText)), this.$element.css("overflow", "hidden").prepend(this.$header))
        }, setGroup: function (t) {
            var i = this, n = this.group.name || t;
            if (this.group.ids = [], void 0 !== t && t !== this.group.name && (n = t, this.group.name = n, this.$element.attr("data-" + o + "-group", n)), void 0 !== n && "" !== n) {
                var s = 0;
                e.each(e("." + o + "[data-" + o + "-group=" + n + "]"), function (t, n) {
                    i.group.ids.push(e(this)[0].id), i.id == e(this)[0].id && (i.group.index = s), s++
                })
            }
        }, toggle: function () {
            this.state == r.OPENED && this.close(), this.state == r.CLOSED && this.open()
        }, open: function (t) {
            function i() {
                n.state = r.OPENED, n.$element.trigger(r.OPENED), !n.options.onOpened || "function" != typeof n.options.onOpened && "object" != typeof n.options.onOpened || n.options.onOpened(n)
            }

            var n = this;
            if (e.each(e("." + o), function (t, i) {
                    if (void 0 !== e(i).data().iziModal) {
                        var n = e(i).iziModal("getState");
                        "opened" != n && "opening" != n || e(i).iziModal("close")
                    }
                }), function () {
                    if (n.options.history) {
                        var e = document.title;
                        document.title = e + " - " + n.options.title, document.location.hash = n.id, document.title = e, window.$iziModal.history = !0
                    } else window.$iziModal.history = !1
                }(), this.state == r.CLOSED) {
                if (function () {
                        n.$element.off("click", "[data-" + o + "-close]").on("click", "[data-" + o + "-close]", function (t) {
                            t.preventDefault();
                            var i = e(t.currentTarget).attr("data-" + o + "-transitionOut");
                            void 0 !== i ? n.close({transition: i}) : n.close()
                        }), n.$element.off("click", "[data-" + o + "-fullscreen]").on("click", "[data-" + o + "-fullscreen]", function (e) {
                            e.preventDefault(), !0 === n.isFullscreen ? (n.isFullscreen = !1, n.$element.removeClass("isFullscreen")) : (n.isFullscreen = !0, n.$element.addClass("isFullscreen")), n.options.onFullscreen && "function" == typeof n.options.onFullscreen && n.options.onFullscreen(n), n.$element.trigger("fullscreen", n)
                        }), n.$navigate.off("click", "." + o + "-navigate-next").on("click", "." + o + "-navigate-next", function (e) {
                            n.next(e)
                        }), n.$element.off("click", "[data-" + o + "-next]").on("click", "[data-" + o + "-next]", function (e) {
                            n.next(e)
                        }), n.$navigate.off("click", "." + o + "-navigate-prev").on("click", "." + o + "-navigate-prev", function (e) {
                            n.prev(e)
                        }), n.$element.off("click", "[data-" + o + "-prev]").on("click", "[data-" + o + "-prev]", function (e) {
                            n.prev(e)
                        })
                    }(), this.setGroup(), this.state = r.OPENING, this.$element.trigger(r.OPENING), this.$element.attr("aria-hidden", "false"), !0 === this.options.iframe) {
                    this.$element.find("." + o + "-content").addClass(o + "-content-loader"), this.$element.find("." + o + "-iframe").on("load", function () {
                        e(this).parent().removeClass(o + "-content-loader")
                    });
                    var c = null;
                    try {
                        c = "" !== e(t.currentTarget).attr("href") ? e(t.currentTarget).attr("href") : null
                    } catch (e) {
                    }
                    if (null === this.options.iframeURL || null !== c && void 0 !== c || (c = this.options.iframeURL), null === c || void 0 === c) throw new Error("Failed to find iframe URL");
                    this.$element.find("." + o + "-iframe").attr("src", c)
                }
                (this.options.bodyOverflow || l) && (e("html").addClass(o + "-isOverflow"), l && e("body").css("overflow", "hidden")), this.options.onOpening && "function" == typeof this.options.onOpening && this.options.onOpening(this), function () {
                    if (n.group.ids.length > 1) {
                        n.$navigate.appendTo("body"), n.$navigate.addClass("fadeIn"), !0 === n.options.navigateCaption && n.$navigate.find("." + o + "-navigate-caption").show();
                        var s = n.$element.outerWidth();
                        !1 !== n.options.navigateArrows ? "closeScreenEdge" === n.options.navigateArrows ? (n.$navigate.find("." + o + "-navigate-prev").css("left", 0).show(), n.$navigate.find("." + o + "-navigate-next").css("right", 0).show()) : (n.$navigate.find("." + o + "-navigate-prev").css("margin-left", -(s / 2 + 84)).show(),
                            n.$navigate.find("." + o + "-navigate-next").css("margin-right", -(s / 2 + 84)).show()) : (n.$navigate.find("." + o + "-navigate-prev").hide(), n.$navigate.find("." + o + "-navigate-next").hide());
                        0 === n.group.index && 0 === e("." + o + "[data-" + o + '-group="' + n.group.name + '"][data-' + o + "-loop]").length && !1 === n.options.loop && n.$navigate.find("." + o + "-navigate-prev").hide(), n.group.index + 1 === n.group.ids.length && 0 === e("." + o + "[data-" + o + '-group="' + n.group.name + '"][data-' + o + "-loop]").length && !1 === n.options.loop && n.$navigate.find("." + o + "-navigate-next").hide()
                    }
                    !0 === n.options.overlay && (!1 === n.options.appendToOverlay ? n.$overlay.appendTo("body") : n.$overlay.appendTo(n.options.appendToOverlay)), n.options.transitionInOverlay && n.$overlay.addClass(n.options.transitionInOverlay);
                    var r = n.options.transitionIn;
                    "object" == typeof t && (void 0 === t.transition && void 0 === t.transitionIn || (r = t.transition || t.transitionIn)), "" !== r && void 0 !== a ? (n.$element.addClass("transitionIn " + r).show(), n.$wrap.one(a, function () {
                        n.$element.removeClass(r + " transitionIn"), n.$overlay.removeClass(n.options.transitionInOverlay), n.$navigate.removeClass("fadeIn"), i()
                    })) : (n.$element.show(), i()), !0 !== n.options.pauseOnHover || !0 !== n.options.pauseOnHover || !1 === n.options.timeout || isNaN(parseInt(n.options.timeout)) || !1 === n.options.timeout || 0 === n.options.timeout || (n.$element.off("mouseenter").on("mouseenter", function (e) {
                        e.preventDefault(), n.isPaused = !0
                    }), n.$element.off("mouseleave").on("mouseleave", function (e) {
                        e.preventDefault(), n.isPaused = !1
                    }))
                }(), !1 === this.options.timeout || isNaN(parseInt(this.options.timeout)) || !1 === this.options.timeout || 0 === this.options.timeout || (!0 === this.options.timeoutProgressbar ? (this.progressBar = {
                    hideEta: null,
                    maxHideTime: null,
                    currentTime: (new Date).getTime(),
                    el: this.$element.find("." + o + "-progressbar > div"),
                    updateProgress: function () {
                        if (!n.isPaused) {
                            n.progressBar.currentTime = n.progressBar.currentTime + 10;
                            var e = (n.progressBar.hideEta - n.progressBar.currentTime) / n.progressBar.maxHideTime * 100;
                            n.progressBar.el.width(e + "%"), e < 0 && n.close()
                        }
                    }
                }, this.options.timeout > 0 && (this.progressBar.maxHideTime = parseFloat(this.options.timeout), this.progressBar.hideEta = (new Date).getTime() + this.progressBar.maxHideTime, this.timerTimeout = setInterval(this.progressBar.updateProgress, 10))) : this.timerTimeout = setTimeout(function () {
                    n.close()
                }, n.options.timeout)), this.options.overlayClose && !this.$element.hasClass(this.options.transitionOut) && this.$overlay.click(function () {
                    n.close()
                }), this.options.focusInput && this.$element.find(":input:not(button):enabled:visible:first").focus(), function e() {
                    n.recalcLayout(), n.timer = setTimeout(e, 300)
                }(), s.on("keydown." + o, function (e) {
                    n.options.closeOnEscape && 27 === e.keyCode && n.close()
                })
            }
        }, close: function (t) {
            function i() {
                n.state = r.CLOSED, n.$element.trigger(r.CLOSED), !0 === n.options.iframe && n.$element.find("." + o + "-iframe").attr("src", ""), (n.options.bodyOverflow || l) && (e("html").removeClass(o + "-isOverflow"), l && e("body").css("overflow", "auto")), n.options.onClosed && "function" == typeof n.options.onClosed && n.options.onClosed(n), !0 === n.options.restoreDefaultContent && n.$element.find("." + o + "-content").html(n.content), 0 === e("." + o + ":visible").length && e("html").removeClass(o + "-isAttached")
            }

            var n = this;
            if (this.state == r.OPENED || this.state == r.OPENING) {
                s.off("keydown." + o), this.state = r.CLOSING, this.$element.trigger(r.CLOSING), this.$element.attr("aria-hidden", "true"), clearTimeout(this.timer), clearTimeout(this.timerTimeout), n.options.onClosing && "function" == typeof n.options.onClosing && n.options.onClosing(this);
                var c = this.options.transitionOut;
                "object" == typeof t && (void 0 === t.transition && void 0 === t.transitionOut || (c = t.transition || t.transitionOut)), !1 === c || "" === c || void 0 === a ? (this.$element.hide(), this.$overlay.remove(), this.$navigate.remove(), i()) : (this.$element.attr("class", [this.classes, o, c, "light" == this.options.theme ? o + "-light" : this.options.theme, !0 === this.isFullscreen ? "isFullscreen" : "", this.options.rtl ? o + "-rtl" : ""].join(" ")), this.$overlay.attr("class", o + "-overlay " + this.options.transitionOutOverlay), !1 !== n.options.navigateArrows && this.$navigate.attr("class", o + "-navigate fadeOut"), this.$element.one(a, function () {
                    n.$element.hasClass(c) && n.$element.removeClass(c + " transitionOut").hide(), n.$overlay.removeClass(n.options.transitionOutOverlay).remove(), n.$navigate.removeClass("fadeOut").remove(), i()
                }))
            }
        }, next: function (t) {
            var i = this, n = "fadeInRight", s = "fadeOutLeft", r = e("." + o + ":visible"), a = {};
            a.out = this, void 0 !== t && "object" != typeof t ? (t.preventDefault(), r = e(t.currentTarget), n = r.attr("data-" + o + "-transitionIn"), s = r.attr("data-" + o + "-transitionOut")) : void 0 !== t && (void 0 !== t.transitionIn && (n = t.transitionIn), void 0 !== t.transitionOut && (s = t.transitionOut)), this.close({transition: s}), setTimeout(function () {
                for (var t = e("." + o + "[data-" + o + '-group="' + i.group.name + '"][data-' + o + "-loop]").length, s = i.group.index + 1; s <= i.group.ids.length; s++) {
                    try {
                        a.in = e("#" + i.group.ids[s]).data().iziModal
                    } catch (e) {
                    }
                    if (void 0 !== a.in) {
                        e("#" + i.group.ids[s]).iziModal("open", {transition: n});
                        break
                    }
                    if (s == i.group.ids.length && t > 0 || !0 === i.options.loop) for (var r = 0; r <= i.group.ids.length; r++) if (a.in = e("#" + i.group.ids[r]).data().iziModal, void 0 !== a.in) {
                        e("#" + i.group.ids[r]).iziModal("open", {transition: n});
                        break
                    }
                }
            }, 200), e(document).trigger(o + "-group-change", a)
        }, prev: function (t) {
            var i = this, n = "fadeInLeft", s = "fadeOutRight", r = e("." + o + ":visible"), a = {};
            a.out = this, void 0 !== t && "object" != typeof t ? (t.preventDefault(), r = e(t.currentTarget), n = r.attr("data-" + o + "-transitionIn"), s = r.attr("data-" + o + "-transitionOut")) : void 0 !== t && (void 0 !== t.transitionIn && (n = t.transitionIn), void 0 !== t.transitionOut && (s = t.transitionOut)), this.close({transition: s}), setTimeout(function () {
                for (var t = e("." + o + "[data-" + o + '-group="' + i.group.name + '"][data-' + o + "-loop]").length, s = i.group.index; s >= 0; s--) {
                    try {
                        a.in = e("#" + i.group.ids[s - 1]).data().iziModal
                    } catch (e) {
                    }
                    if (void 0 !== a.in) {
                        e("#" + i.group.ids[s - 1]).iziModal("open", {transition: n});
                        break
                    }
                    if (0 === s && t > 0 || !0 === i.options.loop) for (var r = i.group.ids.length - 1; r >= 0; r--) if (a.in = e("#" + i.group.ids[r]).data().iziModal, void 0 !== a.in) {
                        e("#" + i.group.ids[r]).iziModal("open", {transition: n});
                        break
                    }
                }
            }, 200), e(document).trigger(o + "-group-change", a)
        }, destroy: function () {
            var t = e.Event("destroy");
            this.$element.trigger(t), s.off("keydown." + o), clearTimeout(this.timer), clearTimeout(this.timerTimeout), !0 === this.options.iframe && this.$element.find("." + o + "-iframe").remove(), this.$element.html(this.$element.find("." + o + "-content").html()), this.$element.off("click", "[data-" + o + "-close]"), this.$element.off("click", "[data-" + o + "-fullscreen]"), this.$element.off("." + o).removeData(o).attr("style", ""), this.$overlay.remove(), this.$navigate.remove(), this.$element.trigger(r.DESTROYED), this.$element = null
        }, getState: function () {
            return this.state
        }, getGroup: function () {
            return this.group
        }, setWidth: function (e) {
            this.options.width = e, this.recalcWidth();
            var t = this.$element.outerWidth();
            !0 !== this.options.navigateArrows && "closeToModal" != this.options.navigateArrows || (this.$navigate.find("." + o + "-navigate-prev").css("margin-left", -(t / 2 + 84)).show(), this.$navigate.find("." + o + "-navigate-next").css("margin-right", -(t / 2 + 84)).show())
        }, setTop: function (e) {
            this.options.top = e, this.recalcVerticalPos(!1)
        }, setBottom: function (e) {
            this.options.bottom = e, this.recalcVerticalPos(!1)
        }, setHeader: function (e) {
            e ? this.$element.find("." + o + "-header").show() : (this.headerHeight = 0, this.$element.find("." + o + "-header").hide())
        }, setTitle: function (e) {
            this.options.title = e, 0 === this.headerHeight && this.createHeader(), 0 === this.$header.find("." + o + "-header-title").length && this.$header.append('<h2 class="' + o + '-header-title"></h2>'), this.$header.find("." + o + "-header-title").html(e)
        }, setSubtitle: function (e) {
            "" === e ? (this.$header.find("." + o + "-header-subtitle").remove(), this.$header.addClass(o + "-noSubtitle")) : (0 === this.$header.find("." + o + "-header-subtitle").length && this.$header.append('<p class="' + o + '-header-subtitle"></p>'), this.$header.removeClass(o + "-noSubtitle")), this.$header.find("." + o + "-header-subtitle").html(e), this.options.subtitle = e
        }, setIcon: function (e) {
            0 === this.$header.find("." + o + "-header-icon").length && this.$header.prepend('<i class="' + o + '-header-icon"></i>'), this.$header.find("." + o + "-header-icon").attr("class", o + "-header-icon " + e), this.options.icon = e
        }, setIconText: function (e) {
            this.$header.find("." + o + "-header-icon").html(e), this.options.iconText = e
        }, setHeaderColor: function (e) {
            !0 === this.options.borderBottom && this.$element.css("border-bottom", "3px solid " + e), this.$header.css("background", e), this.options.headerColor = e
        }, setBackground: function (e) {
            !1 === e ? (this.options.background = null, this.$element.css("background", "")) : (this.$element.css("background", e), this.options.background = e)
        }, setZindex: function (e) {
            isNaN(parseInt(this.options.zindex)) || (this.options.zindex = e, this.$element.css("z-index", e), this.$navigate.css("z-index", e - 1), this.$overlay.css("z-index", e - 2))
        }, setFullscreen: function (e) {
            e ? (this.isFullscreen = !0, this.$element.addClass("isFullscreen")) : (this.isFullscreen = !1, this.$element.removeClass("isFullscreen"))
        }, setContent: function (e) {
            if ("object" == typeof e) {
                !0 === (e.default || !1) && (this.content = e.content), e = e.content
            }
            !1 === this.options.iframe && this.$element.find("." + o + "-content").html(e)
        }, setTransitionIn: function (e) {
            this.options.transitionIn = e
        }, setTransitionOut: function (e) {
            this.options.transitionOut = e
        }, resetContent: function () {
            this.$element.find("." + o + "-content").html(this.content)
        }, startLoading: function () {
            this.$element.find("." + o + "-loader").length || this.$element.append('<div class="' + o + '-loader fadeIn"></div>'), this.$element.find("." + o + "-loader").css({
                top: this.headerHeight,
                borderRadius: this.options.radius
            })
        }, stopLoading: function () {
            var e = this.$element.find("." + o + "-loader");
            e.length || (this.$element.prepend('<div class="' + o + '-loader fadeIn"></div>'), e = this.$element.find("." + o + "-loader").css("border-radius", this.options.radius)), e.removeClass("fadeIn").addClass("fadeOut"), setTimeout(function () {
                e.remove()
            }, 600)
        }, recalcWidth: function () {
            var e = this;
            if (this.$element.css("max-width", this.options.width), t()) {
                var i = e.options.width;
                i.toString().split("%").length > 1 && (i = e.$element.outerWidth()), e.$element.css({
                    left: "50%",
                    marginLeft: -i / 2
                })
            }
        }, recalcVerticalPos: function (e) {
            null !== this.options.top && !1 !== this.options.top ? (this.$element.css("margin-top", this.options.top), 0 === this.options.top && this.$element.css({
                borderTopRightRadius: 0,
                borderTopLeftRadius: 0
            })) : !1 === e && this.$element.css({
                marginTop: "",
                borderRadius: this.options.radius
            }), null !== this.options.bottom && !1 !== this.options.bottom ? (this.$element.css("margin-bottom", this.options.bottom), 0 === this.options.bottom && this.$element.css({
                borderBottomRightRadius: 0,
                borderBottomLeftRadius: 0
            })) : !1 === e && this.$element.css({marginBottom: "", borderRadius: this.options.radius})
        }, recalcLayout: function () {
            var s = this, a = n.height(), l = this.$element.outerHeight(), c = this.$element.outerWidth(),
                u = this.$element.find("." + o + "-content")[0].scrollHeight, d = u + this.headerHeight,
                h = this.$element.innerHeight() - this.headerHeight,
                p = (parseInt(-(this.$element.innerHeight() + 1) / 2), this.$wrap.scrollTop()), f = 0;
            t() && (c >= n.width() || !0 === this.isFullscreen ? this.$element.css({
                left: "0",
                marginLeft: ""
            }) : this.$element.css({
                left: "50%",
                marginLeft: -c / 2
            })), !0 === this.options.borderBottom && "" !== this.options.title && (f = 3), this.$element.find("." + o + "-header").length && this.$element.find("." + o + "-header").is(":visible") ? (this.headerHeight = parseInt(this.$element.find("." + o + "-header").innerHeight()), this.$element.css("overflow", "hidden")) : (this.headerHeight = 0, this.$element.css("overflow", "")), this.$element.find("." + o + "-loader").length && this.$element.find("." + o + "-loader").css("top", this.headerHeight), l !== this.modalHeight && (this.modalHeight = l, this.options.onResize && "function" == typeof this.options.onResize && this.options.onResize(this)), this.state != r.OPENED && this.state != r.OPENING || (!0 === this.options.iframe && (a < this.options.iframeHeight + this.headerHeight + f || !0 === this.isFullscreen ? this.$element.find("." + o + "-iframe").css("height", a - (this.headerHeight + f)) : this.$element.find("." + o + "-iframe").css("height", this.options.iframeHeight)), l == a ? this.$element.addClass("isAttached") : this.$element.removeClass("isAttached"), !1 === this.isFullscreen && this.$element.width() >= n.width() ? this.$element.find("." + o + "-button-fullscreen").hide() : this.$element.find("." + o + "-button-fullscreen").show(), this.recalcButtons(), !1 === this.isFullscreen && (a = a - (i(this.options.top) || 0) - (i(this.options.bottom) || 0)), d > a ? (this.options.top > 0 && null === this.options.bottom && u < n.height() && this.$element.addClass("isAttachedBottom"), this.options.bottom > 0 && null === this.options.top && u < n.height() && this.$element.addClass("isAttachedTop"), e("html").addClass(o + "-isAttached"), this.$element.css("height", a)) : (this.$element.css("height", u + (this.headerHeight + f)), this.$element.removeClass("isAttachedTop isAttachedBottom"), e("html").removeClass(o + "-isAttached")), function () {
                u > h && d > a ? (s.$element.addClass("hasScroll"), s.$wrap.css("height", l - (s.headerHeight + f))) : (s.$element.removeClass("hasScroll"), s.$wrap.css("height", "auto"))
            }(), function () {
                h + p < u - 30 ? s.$element.addClass("hasShadow") : s.$element.removeClass("hasShadow")
            }())
        }, recalcButtons: function () {
            var e = this.$header.find("." + o + "-header-buttons").innerWidth() + 10;
            !0 === this.options.rtl ? this.$header.css("padding-left", e) : this.$header.css("padding-right", e)
        }
    }, n.off("load." + o).on("load." + o, function (t) {
        var i = document.location.hash;
        if (0 === window.$iziModal.autoOpen && !e("." + o).is(":visible")) try {
            var n = e(i).data();
            void 0 !== n && !1 !== n.iziModal.options.autoOpen && e(i).iziModal("open")
        } catch (e) {
        }
    }), n.off("hashchange." + o).on("hashchange." + o, function (t) {
        var i = document.location.hash, n = e(i).data();
        if ("" !== i) try {
            void 0 !== n && "opening" !== e(i).iziModal("getState") && setTimeout(function () {
                e(i).iziModal("open")
            }, 200)
        } catch (e) {
        } else window.$iziModal.history && e.each(e("." + o), function (t, i) {
            if (void 0 !== e(i).data().iziModal) {
                var n = e(i).iziModal("getState");
                "opened" != n && "opening" != n || e(i).iziModal("close")
            }
        })
    }), s.off("click", "[data-" + o + "-open]").on("click", "[data-" + o + "-open]", function (t) {
        t.preventDefault();
        var i = e("." + o + ":visible"), n = e(t.currentTarget).attr("data-" + o + "-open"),
            s = e(t.currentTarget).attr("data-" + o + "-transitionIn"),
            r = e(t.currentTarget).attr("data-" + o + "-transitionOut");
        void 0 !== r ? i.iziModal("close", {transition: r}) : i.iziModal("close"), setTimeout(function () {
            void 0 !== s ? e(n).iziModal("open", {transition: s}) : e(n).iziModal("open")
        }, 200)
    }), s.off("keyup." + o).on("keyup." + o, function (t) {
        if (e("." + o + ":visible").length) {
            var i = e("." + o + ":visible")[0].id, n = e("#" + i).iziModal("getGroup"), s = t || window.event,
                r = s.target || s.srcElement;
            void 0 === i || void 0 === n.name || s.ctrlKey || s.metaKey || s.altKey || "INPUT" === r.tagName.toUpperCase() || "TEXTAREA" == r.tagName.toUpperCase() || (37 === s.keyCode ? e("#" + i).iziModal("prev", s) : 39 === s.keyCode && e("#" + i).iziModal("next", s))
        }
    }), e.fn[o] = function (t, i) {
        if (!e(this).length && "object" == typeof t) {
            var n = {$el: document.createElement("div"), id: this.selector.split("#"), class: this.selector.split(".")};
            if (n.id.length > 1) {
                try {
                    n.$el = document.createElement(id[0])
                } catch (e) {
                }
                n.$el.id = this.selector.split("#")[1].trim()
            } else if (n.class.length > 1) {
                try {
                    n.$el = document.createElement(n.class[0])
                } catch (e) {
                }
                for (var s = 1; s < n.class.length; s++) n.$el.classList.add(n.class[s].trim())
            }
            document.body.appendChild(n.$el), this.push(e(this.selector))
        }
        for (var r = this, a = 0; a < r.length; a++) {
            var l = e(r[a]), u = l.data(o), d = e.extend({}, e.fn[o].defaults, l.data(), "object" == typeof t && t);
            if (u || t && "object" != typeof t) {
                if ("string" == typeof t && void 0 !== u) return u[t].apply(u, [].concat(i))
            } else l.data(o, u = new c(l, d));
            d.autoOpen && (isNaN(parseInt(d.autoOpen)) ? !0 === d.autoOpen && u.open() : setTimeout(function () {
                u.open()
            }, d.autoOpen), window.$iziModal.autoOpen++)
        }
        return this
    }, e.fn[o].defaults = {
        title: "",
        subtitle: "",
        headerColor: "#88A0B9",
        background: null,
        theme: "",
        icon: null,
        iconText: null,
        iconColor: "",
        rtl: !1,
        width: 600,
        top: null,
        bottom: null,
        borderBottom: !0,
        padding: 0,
        radius: 3,
        zindex: 999,
        iframe: !1,
        iframeHeight: 400,
        iframeURL: null,
        focusInput: !0,
        group: "",
        loop: !1,
        navigateCaption: !0,
        navigateArrows: !0,
        history: !1,
        restoreDefaultContent: !1,
        autoOpen: 0,
        bodyOverflow: !1,
        fullscreen: !1,
        openFullscreen: !1,
        closeOnEscape: !0,
        closeButton: !0,
        appendTo: "body",
        appendToOverlay: "body",
        overlay: !0,
        overlayClose: !0,
        overlayColor: "rgba(0, 0, 0, 0.4)",
        timeout: !1,
        timeoutProgressbar: !1,
        pauseOnHover: !1,
        timeoutProgressbarColor: "rgba(255,255,255,0.5)",
        transitionIn: "comingIn",
        transitionOut: "comingOut",
        transitionInOverlay: "fadeIn",
        transitionOutOverlay: "fadeOut",
        onFullscreen: function () {
        },
        onResize: function () {
        },
        onOpening: function () {
        },
        onOpened: function () {
        },
        onClosing: function () {
        },
        onClosed: function () {
        },
        afterRender: function () {
        }
    }, e.fn[o].Constructor = c, e.fn.iziModal
}), function (e, t) {
    "function" == typeof define && define.amd ? define([], function () {
        return e.svg4everybody = t()
    }) : "object" == typeof module && module.exports ? module.exports = t() : e.svg4everybody = t()
}(this, function () {
    function e(e, t, i) {
        if (i) {
            var n = document.createDocumentFragment(), s = !t.hasAttribute("viewBox") && i.getAttribute("viewBox");
            s && t.setAttribute("viewBox", s);
            for (var o = i.cloneNode(!0); o.childNodes.length;) n.appendChild(o.firstChild);
            e.appendChild(n)
        }
    }

    function t(t) {
        t.onreadystatechange = function () {
            if (4 === t.readyState) {
                var i = t._cachedDocument;
                i || (i = t._cachedDocument = document.implementation.createHTMLDocument(""), i.body.innerHTML = t.responseText, t._cachedTarget = {}), t._embeds.splice(0).map(function (n) {
                    var s = t._cachedTarget[n.id];
                    s || (s = t._cachedTarget[n.id] = i.getElementById(n.id)), e(n.parent, n.svg, s)
                })
            }
        }, t.onreadystatechange()
    }

    function i(i) {
        function s() {
            for (var i = 0; i < f.length;) {
                var a = f[i], l = a.parentNode, c = n(l), u = a.getAttribute("xlink:href") || a.getAttribute("href");
                if (!u && r.attributeName && (u = a.getAttribute(r.attributeName)), c && u) {
                    if (o) if (!r.validate || r.validate(u, c, a)) {
                        l.removeChild(a);
                        var d = u.split("#"), m = d.shift(), v = d.join("#");
                        if (m.length) {
                            var y = h[m];
                            y || (y = h[m] = new XMLHttpRequest, y.open("GET", m), y.send(), y._embeds = []), y._embeds.push({
                                parent: l,
                                svg: c,
                                id: v
                            }), t(y)
                        } else e(l, c, document.getElementById(v))
                    } else ++i, ++g
                } else ++i
            }
            (!f.length || f.length - g > 0) && p(s, 67)
        }

        var o, r = Object(i), a = /\bTrident\/[567]\b|\bMSIE (?:9|10)\.0\b/, l = /\bAppleWebKit\/(\d+)\b/,
            c = /\bEdge\/12\.(\d+)\b/, u = /\bEdge\/.(\d+)\b/, d = window.top !== window.self;
        o = "polyfill" in r ? r.polyfill : a.test(navigator.userAgent) || (navigator.userAgent.match(c) || [])[1] < 10547 || (navigator.userAgent.match(l) || [])[1] < 537 || u.test(navigator.userAgent) && d;
        var h = {}, p = window.requestAnimationFrame || setTimeout, f = document.getElementsByTagName("use"), g = 0;
        o && s()
    }

    function n(e) {
        for (var t = e; "svg" !== t.nodeName.toLowerCase() && (t = t.parentNode);) ;
        return t
    }

    return i
}), function (e, t, i, n) {
    "use strict";

    function s(e, t) {
        var n, s, o = [], r = 0;
        e && e.isDefaultPrevented() || (e.preventDefault(), t = e && e.data ? e.data.options : t || {}, n = t.$target || i(e.currentTarget), s = n.attr("data-fancybox") || "", s ? (o = t.selector ? i(t.selector) : e.data ? e.data.items : [], o = o.length ? o.filter('[data-fancybox="' + s + '"]') : i('[data-fancybox="' + s + '"]'), (r = o.index(n)) < 0 && (r = 0)) : o = [n], i.fancybox.open(o, t, r))
    }

    if (e.console = e.console || {
            info: function (e) {
            }
        }, i) {
        if (i.fn.fancybox) return void console.info("fancyBox already initialized");
        var o = {
            loop: !1,
            gutter: 50,
            keyboard: !0,
            arrows: !0,
            infobar: !0,
            smallBtn: "auto",
            toolbar: "auto",
            buttons: ["zoom", "thumbs", "close"],
            idleTime: 3,
            protect: !1,
            modal: !1,
            image: {preload: !1},
            ajax: {settings: {data: {fancybox: !0}}},
            iframe: {
                tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen allowtransparency="true" src=""></iframe>',
                preload: !0,
                css: {},
                attr: {scrolling: "auto"}
            },
            defaultType: "image",
            animationEffect: "zoom",
            animationDuration: 366,
            zoomOpacity: "auto",
            transitionEffect: "fade",
            transitionDuration: 366,
            slideClass: "",
            baseClass: "",
            baseTpl: '<div class="fancybox-container" role="dialog" tabindex="-1"><div class="fancybox-bg"></div><div class="fancybox-inner"><div class="fancybox-infobar"><span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span></div><div class="fancybox-toolbar">{{buttons}}</div><div class="fancybox-navigation">{{arrows}}</div><div class="fancybox-stage"></div><div class="fancybox-caption"></div></div></div>',
            spinnerTpl: '<div class="fancybox-loading"></div>',
            errorTpl: '<div class="fancybox-error"><p>{{ERROR}}</p></div>',
            btnTpl: {
                download: '<a download data-fancybox-download class="fancybox-button fancybox-button--download" title="{{DOWNLOAD}}" href="javascript:;"><svg viewBox="0 0 40 40"><path d="M13,16 L20,23 L27,16 M20,7 L20,23 M10,24 L10,28 L30,28 L30,24" /></svg></a>',
                zoom: '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}"><svg viewBox="0 0 40 40"><path d="M18,17 m-8,0 a8,8 0 1,0 16,0 a8,8 0 1,0 -16,0 M24,22 L31,29" /></svg></button>',
                close: '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}"><svg viewBox="0 0 40 40"><path d="M10,10 L30,30 M30,10 L10,30" /></svg></button>',
                smallBtn: '<button data-fancybox-close class="fancybox-close-small" title="{{CLOSE}}"><svg viewBox="0 0 32 32"><path d="M10,10 L22,22 M22,10 L10,22"></path></svg></button>',
                arrowLeft: '<a data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}" href="javascript:;"><svg viewBox="0 0 40 40"><path d="M18,12 L10,20 L18,28 M10,20 L30,20"></path></svg></a>',
                arrowRight: '<a data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}" href="javascript:;"><svg viewBox="0 0 40 40"><path d="M10,20 L30,20 M22,12 L30,20 L22,28"></path></svg></a>'
            },
            parentEl: "body",
            autoFocus: !1,
            backFocus: !0,
            trapFocus: !0,
            fullScreen: {autoStart: !1},
            touch: {vertical: !0, momentum: !0},
            hash: null,
            media: {},
            slideShow: {autoStart: !1, speed: 4e3},
            thumbs: {autoStart: !1, hideOnClose: !0, parentEl: ".fancybox-container", axis: "y"},
            wheel: "auto",
            onInit: i.noop,
            beforeLoad: i.noop,
            afterLoad: i.noop,
            beforeShow: i.noop,
            afterShow: i.noop,
            beforeClose: i.noop,
            afterClose: i.noop,
            onActivate: i.noop,
            onDeactivate: i.noop,
            clickContent: function (e, t) {
                return "image" === e.type && "zoom"
            },
            clickSlide: "close",
            clickOutside: "close",
            dblclickContent: !1,
            dblclickSlide: !1,
            dblclickOutside: !1,
            mobile: {
                idleTime: !1, clickContent: function (e, t) {
                    return "image" === e.type && "toggleControls"
                }, clickSlide: function (e, t) {
                    return "image" === e.type ? "toggleControls" : "close"
                }, dblclickContent: function (e, t) {
                    return "image" === e.type && "zoom"
                }, dblclickSlide: function (e, t) {
                    return "image" === e.type && "zoom"
                }
            },
            lang: "en",
            i18n: {
                en: {
                    CLOSE: "Close",
                    NEXT: "Next",
                    PREV: "Previous",
                    ERROR: "The requested content cannot be loaded. <br/> Please try again later.",
                    PLAY_START: "Start slideshow",
                    PLAY_STOP: "Pause slideshow",
                    FULL_SCREEN: "Full screen",
                    THUMBS: "Thumbnails",
                    DOWNLOAD: "Download",
                    SHARE: "Share",
                    ZOOM: "Zoom"
                },
                de: {
                    CLOSE: "Schliessen",
                    NEXT: "Weiter",
                    PREV: "Zurück",
                    ERROR: "Die angeforderten Daten konnten nicht geladen werden. <br/> Bitte versuchen Sie es später nochmal.",
                    PLAY_START: "Diaschau starten",
                    PLAY_STOP: "Diaschau beenden",
                    FULL_SCREEN: "Vollbild",
                    THUMBS: "Vorschaubilder",
                    DOWNLOAD: "Herunterladen",
                    SHARE: "Teilen",
                    ZOOM: "Maßstab"
                }
            }
        }, r = i(e), a = i(t), l = 0, c = function (e) {
            return e && e.hasOwnProperty && e instanceof i
        }, u = function () {
            return e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || e.oRequestAnimationFrame || function (t) {
                return e.setTimeout(t, 1e3 / 60)
            }
        }(), d = function () {
            var e, i = t.createElement("fakeelement"), n = {
                transition: "transitionend",
                OTransition: "oTransitionEnd",
                MozTransition: "transitionend",
                WebkitTransition: "webkitTransitionEnd"
            };
            for (e in n) if (void 0 !== i.style[e]) return n[e];
            return "transitionend"
        }(), h = function (e) {
            return e && e.length && e[0].offsetHeight
        }, p = function (e, t) {
            var n = i.extend(!0, {}, e, t);
            return i.each(t, function (e, t) {
                i.isArray(t) && (n[e] = t)
            }), n
        }, f = function (e, n, s) {
            var o = this;
            o.opts = p({index: s}, i.fancybox.defaults), i.isPlainObject(n) && (o.opts = p(o.opts, n)), i.fancybox.isMobile && (o.opts = p(o.opts, o.opts.mobile)), o.id = o.opts.id || ++l, o.currIndex = parseInt(o.opts.index, 10) || 0, o.prevIndex = null, o.prevPos = null, o.currPos = 0, o.firstRun = !0, o.group = [], o.slides = {}, o.addContent(e), o.group.length && (o.$lastFocus = i(t.activeElement).trigger("blur"), o.init())
        };
        i.extend(f.prototype, {
            init: function () {
                var n, s, o, r = this, a = r.group[r.currIndex], l = a.opts, c = i.fancybox.scrollbarWidth;
                i.fancybox.getInstance() || !1 === l.hideScrollbar || (i("body").addClass("fancybox-active"), !i.fancybox.isMobile && t.body.scrollHeight > e.innerHeight && (void 0 === c && (n = i('<div style="width:100px;height:100px;overflow:scroll;" />').appendTo("body"), c = i.fancybox.scrollbarWidth = n[0].offsetWidth - n[0].clientWidth, n.remove()), i("head").append('<style id="fancybox-style-noscroll" type="text/css">.compensate-for-scrollbar { margin-right: ' + c + "px; }</style>"), i("body").addClass("compensate-for-scrollbar"))), o = "", i.each(l.buttons, function (e, t) {
                    o += l.btnTpl[t] || ""
                }), s = i(r.translate(r, l.baseTpl.replace("{{buttons}}", o).replace("{{arrows}}", l.btnTpl.arrowLeft + l.btnTpl.arrowRight))).attr("id", "fancybox-container-" + r.id).addClass("fancybox-is-hidden").addClass(l.baseClass).data("FancyBox", r).appendTo(l.parentEl), r.$refs = {container: s}, ["bg", "inner", "infobar", "toolbar", "stage", "caption", "navigation"].forEach(function (e) {
                    r.$refs[e] = s.find(".fancybox-" + e)
                }), r.trigger("onInit"), r.activate(), r.jumpTo(r.currIndex)
            }, translate: function (e, t) {
                var i = e.opts.i18n[e.opts.lang];
                return t.replace(/\{\{(\w+)\}\}/g, function (e, t) {
                    var n = i[t];
                    return void 0 === n ? e : n
                })
            }, addContent: function (e) {
                var t, n = this, s = i.makeArray(e);
                i.each(s, function (e, t) {
                    var s, o, r, a, l, c = {}, u = {};
                    i.isPlainObject(t) ? (c = t, u = t.opts || t) : "object" === i.type(t) && i(t).length ? (s = i(t), u = s.data() || {}, u = i.extend(!0, {}, u, u.options), u.$orig = s, c.src = n.opts.src || u.src || s.attr("href"), c.type || c.src || (c.type = "inline", c.src = t)) : c = {
                        type: "html",
                        src: t + ""
                    }, c.opts = i.extend(!0, {}, n.opts, u), i.isArray(u.buttons) && (c.opts.buttons = u.buttons), o = c.type || c.opts.type, a = c.src || "", !o && a && ((r = a.match(/\.(mp4|mov|ogv)((\?|#).*)?$/i)) ? (o = "video", c.opts.videoFormat || (c.opts.videoFormat = "video/" + ("ogv" === r[1] ? "ogg" : r[1]))) : a.match(/(^data:image\/[a-z0-9+\/=]*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg|ico)((\?|#).*)?$)/i) ? o = "image" : a.match(/\.(pdf)((\?|#).*)?$/i) ? o = "iframe" : "#" === a.charAt(0) && (o = "inline")), o ? c.type = o : n.trigger("objectNeedsType", c), c.contentType || (c.contentType = i.inArray(c.type, ["html", "inline", "ajax"]) > -1 ? "html" : c.type), c.index = n.group.length, "auto" == c.opts.smallBtn && (c.opts.smallBtn = i.inArray(c.type, ["html", "inline", "ajax"]) > -1), "auto" === c.opts.toolbar && (c.opts.toolbar = !c.opts.smallBtn), c.opts.$trigger && c.index === n.opts.index && (c.opts.$thumb = c.opts.$trigger.find("img:first")), c.opts.$thumb && c.opts.$thumb.length || !c.opts.$orig || (c.opts.$thumb = c.opts.$orig.find("img:first")), "function" === i.type(c.opts.caption) && (c.opts.caption = c.opts.caption.apply(t, [n, c])), "function" === i.type(n.opts.caption) && (c.opts.caption = n.opts.caption.apply(t, [n, c])), c.opts.caption instanceof i || (c.opts.caption = void 0 === c.opts.caption ? "" : c.opts.caption + ""), "ajax" === c.type && (l = a.split(/\s+/, 2), l.length > 1 && (c.src = l.shift(), c.opts.filter = l.shift())), c.opts.modal && (c.opts = i.extend(!0, c.opts, {
                        infobar: 0,
                        toolbar: 0,
                        smallBtn: 0,
                        keyboard: 0,
                        slideShow: 0,
                        fullScreen: 0,
                        thumbs: 0,
                        touch: 0,
                        clickContent: !1,
                        clickSlide: !1,
                        clickOutside: !1,
                        dblclickContent: !1,
                        dblclickSlide: !1,
                        dblclickOutside: !1
                    })), n.group.push(c)
                }), Object.keys(n.slides).length && (n.updateControls(), (t = n.Thumbs) && t.isActive && (t.create(), t.focus()))
            }, addEvents: function () {
                var n = this;
                n.removeEvents(), n.$refs.container.on("click.fb-close", "[data-fancybox-close]", function (e) {
                    e.stopPropagation(), e.preventDefault(), n.close(e)
                }).on("touchstart.fb-prev click.fb-prev", "[data-fancybox-prev]", function (e) {
                    e.stopPropagation(), e.preventDefault(), n.previous()
                }).on("touchstart.fb-next click.fb-next", "[data-fancybox-next]", function (e) {
                    e.stopPropagation(), e.preventDefault(), n.next()
                }).on("click.fb", "[data-fancybox-zoom]", function (e) {
                    n[n.isScaledDown() ? "scaleToActual" : "scaleToFit"]()
                }), r.on("orientationchange.fb resize.fb", function (e) {
                    e && e.originalEvent && "resize" === e.originalEvent.type ? u(function () {
                        n.update()
                    }) : (n.$refs.stage.hide(), setTimeout(function () {
                        n.$refs.stage.show(), n.update()
                    }, i.fancybox.isMobile ? 600 : 250))
                }), a.on("focusin.fb", function (e) {
                    var n = i.fancybox ? i.fancybox.getInstance() : null;
                    n.isClosing || !n.current || !n.current.opts.trapFocus || i(e.target).hasClass("fancybox-container") || i(e.target).is(t) || n && "fixed" !== i(e.target).css("position") && !n.$refs.container.has(e.target).length && (e.stopPropagation(), n.focus())
                }), a.on("keydown.fb", function (e) {
                    var t = n.current, s = e.keyCode || e.which;
                    if (t && t.opts.keyboard && !(e.ctrlKey || e.altKey || e.shiftKey || i(e.target).is("input") || i(e.target).is("textarea"))) return 8 === s || 27 === s ? (e.preventDefault(), void n.close(e)) : 37 === s || 38 === s ? (e.preventDefault(), void n.previous()) : 39 === s || 40 === s ? (e.preventDefault(), void n.next()) : void n.trigger("afterKeydown", e, s)
                }), n.group[n.currIndex].opts.idleTime && (n.idleSecondsCounter = 0, a.on("mousemove.fb-idle mouseleave.fb-idle mousedown.fb-idle touchstart.fb-idle touchmove.fb-idle scroll.fb-idle keydown.fb-idle", function (e) {
                    n.idleSecondsCounter = 0, n.isIdle && n.showControls(), n.isIdle = !1
                }), n.idleInterval = e.setInterval(function () {
                    ++n.idleSecondsCounter >= n.group[n.currIndex].opts.idleTime && !n.isDragging && (n.isIdle = !0, n.idleSecondsCounter = 0, n.hideControls())
                }, 1e3))
            }, removeEvents: function () {
                var t = this;
                r.off("orientationchange.fb resize.fb"), a.off("focusin.fb keydown.fb .fb-idle"), this.$refs.container.off(".fb-close .fb-prev .fb-next"), t.idleInterval && (e.clearInterval(t.idleInterval), t.idleInterval = null)
            }, previous: function (e) {
                return this.jumpTo(this.currPos - 1, e)
            }, next: function (e) {
                return this.jumpTo(this.currPos + 1, e)
            }, jumpTo: function (e, t) {
                var n, s, o, r, a, l, c, u = this, d = u.group.length;
                if (!(u.isDragging || u.isClosing || u.isAnimating && u.firstRun)) {
                    if (e = parseInt(e, 10), !(s = u.current ? u.current.opts.loop : u.opts.loop) && (e < 0 || e >= d)) return !1;
                    if (n = u.firstRun = !Object.keys(u.slides).length, !(d < 2 && !n && u.isDragging)) {
                        if (r = u.current, u.prevIndex = u.currIndex, u.prevPos = u.currPos, o = u.createSlide(e), d > 1 && ((s || o.index > 0) && u.createSlide(e - 1), (s || o.index < d - 1) && u.createSlide(e + 1)), u.current = o, u.currIndex = o.index, u.currPos = o.pos, u.trigger("beforeShow", n), u.updateControls(), l = i.fancybox.getTranslate(o.$slide), o.isMoved = (0 !== l.left || 0 !== l.top) && !o.$slide.hasClass("fancybox-animated"), o.forcedDuration = void 0, i.isNumeric(t) ? o.forcedDuration = t : t = o.opts[n ? "animationDuration" : "transitionDuration"], t = parseInt(t, 10), n) return o.opts.animationEffect && t && u.$refs.container.css("transition-duration", t + "ms"), u.$refs.container.removeClass("fancybox-is-hidden"), h(u.$refs.container), u.$refs.container.addClass("fancybox-is-open"), h(u.$refs.container), o.$slide.addClass("fancybox-slide--previous"), u.loadSlide(o), o.$slide.removeClass("fancybox-slide--previous").addClass("fancybox-slide--current"), void u.preload("image");
                        i.each(u.slides, function (e, t) {
                            i.fancybox.stop(t.$slide)
                        }), o.$slide.removeClass("fancybox-slide--next fancybox-slide--previous").addClass("fancybox-slide--current"), o.isMoved ? (a = Math.round(o.$slide.width()), i.each(u.slides, function (e, n) {
                            var s = n.pos - o.pos;
                            i.fancybox.animate(n.$slide, {top: 0, left: s * a + s * n.opts.gutter}, t, function () {
                                n.$slide.removeAttr("style").removeClass("fancybox-slide--next fancybox-slide--previous"), n.pos === u.currPos && (o.isMoved = !1, u.complete())
                            })
                        })) : u.$refs.stage.children().removeAttr("style"), o.isLoaded ? u.revealContent(o) : u.loadSlide(o), u.preload("image"), r.pos !== o.pos && (c = "fancybox-slide--" + (r.pos > o.pos ? "next" : "previous"), r.$slide.removeClass("fancybox-slide--complete fancybox-slide--current fancybox-slide--next fancybox-slide--previous"), r.isComplete = !1, t && (o.isMoved || o.opts.transitionEffect) && (o.isMoved ? r.$slide.addClass(c) : (c = "fancybox-animated " + c + " fancybox-fx-" + o.opts.transitionEffect, i.fancybox.animate(r.$slide, c, t, function () {
                            r.$slide.removeClass(c).removeAttr("style")
                        }))))
                    }
                }
            }, createSlide: function (e) {
                var t, n, s = this;
                return n = e % s.group.length, n = n < 0 ? s.group.length + n : n, !s.slides[e] && s.group[n] && (t = i('<div class="fancybox-slide"></div>').appendTo(s.$refs.stage), s.slides[e] = i.extend(!0, {}, s.group[n], {
                    pos: e,
                    $slide: t,
                    isLoaded: !1
                }), s.updateSlide(s.slides[e])), s.slides[e]
            }, scaleToActual: function (e, t, n) {
                var s, o, r, a, l, c = this, u = c.current, d = u.$content, h = i.fancybox.getTranslate(u.$slide).width,
                    p = i.fancybox.getTranslate(u.$slide).height, f = u.width, g = u.height
                ;!c.isAnimating && d && "image" == u.type && u.isLoaded && !u.hasError && (i.fancybox.stop(d), c.isAnimating = !0, e = void 0 === e ? .5 * h : e, t = void 0 === t ? .5 * p : t, s = i.fancybox.getTranslate(d), s.top -= i.fancybox.getTranslate(u.$slide).top, s.left -= i.fancybox.getTranslate(u.$slide).left, a = f / s.width, l = g / s.height, o = .5 * h - .5 * f, r = .5 * p - .5 * g, f > h && (o = s.left * a - (e * a - e), o > 0 && (o = 0), o < h - f && (o = h - f)), g > p && (r = s.top * l - (t * l - t), r > 0 && (r = 0), r < p - g && (r = p - g)), c.updateCursor(f, g), i.fancybox.animate(d, {
                    top: r,
                    left: o,
                    scaleX: a,
                    scaleY: l
                }, n || 330, function () {
                    c.isAnimating = !1
                }), c.SlideShow && c.SlideShow.isActive && c.SlideShow.stop())
            }, scaleToFit: function (e) {
                var t, n = this, s = n.current, o = s.$content;
                !n.isAnimating && o && "image" == s.type && s.isLoaded && !s.hasError && (i.fancybox.stop(o), n.isAnimating = !0, t = n.getFitPos(s), n.updateCursor(t.width, t.height), i.fancybox.animate(o, {
                    top: t.top,
                    left: t.left,
                    scaleX: t.width / o.width(),
                    scaleY: t.height / o.height()
                }, e || 330, function () {
                    n.isAnimating = !1
                }))
            }, getFitPos: function (e) {
                var t, i, n, s, o, r = this, a = e.$content, l = e.width || e.opts.width, c = e.height || e.opts.height,
                    u = {};
                return !!(e.isLoaded && a && a.length) && (s = {
                    top: parseInt(e.$slide.css("paddingTop"), 10),
                    right: parseInt(e.$slide.css("paddingRight"), 10),
                    bottom: parseInt(e.$slide.css("paddingBottom"), 10),
                    left: parseInt(e.$slide.css("paddingLeft"), 10)
                }, t = parseInt(r.$refs.stage.width(), 10) - (s.left + s.right), i = parseInt(r.$refs.stage.height(), 10) - (s.top + s.bottom), l && c || (l = t, c = i), n = Math.min(1, t / l, i / c), l = Math.floor(n * l), c = Math.floor(n * c), "image" === e.type ? (u.top = Math.floor(.5 * (i - c)) + s.top, u.left = Math.floor(.5 * (t - l)) + s.left) : "video" === e.contentType && (o = e.opts.width && e.opts.height ? l / c : e.opts.ratio || 16 / 9, c > l / o ? c = l / o : l > c * o && (l = c * o)), u.width = l, u.height = c, u)
            }, update: function () {
                var e = this;
                i.each(e.slides, function (t, i) {
                    e.updateSlide(i)
                })
            }, updateSlide: function (e, t) {
                var n = this, s = e && e.$content, o = e.width || e.opts.width, r = e.height || e.opts.height;
                s && (o || r || "video" === e.contentType) && !e.hasError && (i.fancybox.stop(s), i.fancybox.setTranslate(s, n.getFitPos(e)), e.pos === n.currPos && (n.isAnimating = !1, n.updateCursor())), e.$slide.trigger("refresh"), n.$refs.toolbar.toggleClass("compensate-for-scrollbar", e.$slide.get(0).scrollHeight > e.$slide.get(0).clientHeight), n.trigger("onUpdate", e)
            }, centerSlide: function (e, t) {
                var n, s, o = this;
                o.current && (n = Math.round(e.$slide.width()), s = e.pos - o.current.pos, i.fancybox.animate(e.$slide, {
                    top: 0,
                    left: s * n + s * e.opts.gutter,
                    opacity: 1
                }, void 0 === t ? 0 : t, null, !1))
            }, updateCursor: function (e, t) {
                var n, s = this, o = s.current,
                    r = s.$refs.container.removeClass("fancybox-is-zoomable fancybox-can-zoomIn fancybox-can-drag fancybox-can-zoomOut");
                o && !s.isClosing && (n = s.isZoomable(), r.toggleClass("fancybox-is-zoomable", n), i("[data-fancybox-zoom]").prop("disabled", !n), n && ("zoom" === o.opts.clickContent || i.isFunction(o.opts.clickContent) && "zoom" === o.opts.clickContent(o)) ? s.isScaledDown(e, t) ? r.addClass("fancybox-can-zoomIn") : o.opts.touch ? r.addClass("fancybox-can-drag") : r.addClass("fancybox-can-zoomOut") : o.opts.touch && "video" !== o.contentType && r.addClass("fancybox-can-drag"))
            }, isZoomable: function () {
                var e, t = this, i = t.current;
                if (i && !t.isClosing && "image" === i.type && !i.hasError) {
                    if (!i.isLoaded) return !0;
                    if (e = t.getFitPos(i), i.width > e.width || i.height > e.height) return !0
                }
                return !1
            }, isScaledDown: function (e, t) {
                var n = this, s = !1, o = n.current, r = o.$content;
                return void 0 !== e && void 0 !== t ? s = e < o.width && t < o.height : r && (s = i.fancybox.getTranslate(r), s = s.width < o.width && s.height < o.height), s
            }, canPan: function () {
                var e, t = this, i = !1, n = t.current;
                return "image" === n.type && (e = n.$content) && !n.hasError && (i = t.getFitPos(n), i = Math.abs(e.width() - i.width) > 1 || Math.abs(e.height() - i.height) > 1), i
            }, loadSlide: function (e) {
                var t, n, s, o = this;
                if (!e.isLoading && !e.isLoaded) {
                    switch (e.isLoading = !0, o.trigger("beforeLoad", e), t = e.type, n = e.$slide, n.off("refresh").trigger("onReset").addClass(e.opts.slideClass), t) {
                        case"image":
                            o.setImage(e);
                            break;
                        case"iframe":
                            o.setIframe(e);
                            break;
                        case"html":
                            o.setContent(e, e.src || e.content);
                            break;
                        case"video":
                            o.setContent(e, '<video class="fancybox-video" controls controlsList="nodownload"><source src="' + e.src + '" type="' + e.opts.videoFormat + "\">Your browser doesn't support HTML5 video</video");
                            break;
                        case"inline":
                            i(e.src).length ? o.setContent(e, i(e.src)) : o.setError(e);
                            break;
                        case"ajax":
                            o.showLoading(e), s = i.ajax(i.extend({}, e.opts.ajax.settings, {
                                url: e.src, success: function (t, i) {
                                    "success" === i && o.setContent(e, t)
                                }, error: function (t, i) {
                                    t && "abort" !== i && o.setError(e)
                                }
                            })), n.one("onReset", function () {
                                s.abort()
                            });
                            break;
                        default:
                            o.setError(e)
                    }
                    return !0
                }
            }, setImage: function (t) {
                var n, s, o, r, a, l = this, c = t.opts.srcset || t.opts.image.srcset;
                if (t.timouts = setTimeout(function () {
                        var e = t.$image;
                        !t.isLoading || e && e[0].complete || t.hasError || l.showLoading(t)
                    }, 350), c) {
                    r = e.devicePixelRatio || 1, a = e.innerWidth * r, o = c.split(",").map(function (e) {
                        var t = {};
                        return e.trim().split(/\s+/).forEach(function (e, i) {
                            var n = parseInt(e.substring(0, e.length - 1), 10);
                            if (0 === i) return t.url = e;
                            n && (t.value = n, t.postfix = e[e.length - 1])
                        }), t
                    }), o.sort(function (e, t) {
                        return e.value - t.value
                    });
                    for (var u = 0; u < o.length; u++) {
                        var d = o[u];
                        if ("w" === d.postfix && d.value >= a || "x" === d.postfix && d.value >= r) {
                            s = d;
                            break
                        }
                    }
                    !s && o.length && (s = o[o.length - 1]), s && (t.src = s.url, t.width && t.height && "w" == s.postfix && (t.height = t.width / t.height * s.value, t.width = s.value), t.opts.srcset = c)
                }
                t.$content = i('<div class="fancybox-content"></div>').addClass("fancybox-is-hidden").appendTo(t.$slide.addClass("fancybox-slide--image")), n = t.opts.thumb || !(!t.opts.$thumb || !t.opts.$thumb.length) && t.opts.$thumb.attr("src"), !1 !== t.opts.preload && t.opts.width && t.opts.height && n && (t.width = t.opts.width, t.height = t.opts.height, t.$ghost = i("<img />").one("error", function () {
                    i(this).remove(), t.$ghost = null
                }).one("load", function () {
                    l.afterLoad(t)
                }).addClass("fancybox-image").appendTo(t.$content).attr("src", n)), l.setBigImage(t)
            }, setBigImage: function (e) {
                var t = this, n = i("<img />");
                e.$image = n.one("error", function () {
                    t.setError(e)
                }).one("load", function () {
                    var i;
                    e.$ghost || (t.resolveImageSlideSize(e, this.naturalWidth, this.naturalHeight), t.afterLoad(e)), e.timouts && (clearTimeout(e.timouts), e.timouts = null), t.isClosing || (e.opts.srcset && (i = e.opts.sizes, i && "auto" !== i || (i = (e.width / e.height > 1 && r.width() / r.height() > 1 ? "100" : Math.round(e.width / e.height * 100)) + "vw"), n.attr("sizes", i).attr("srcset", e.opts.srcset)), e.$ghost && setTimeout(function () {
                        e.$ghost && !t.isClosing && e.$ghost.hide()
                    }, Math.min(300, Math.max(1e3, e.height / 1600))), t.hideLoading(e))
                }).addClass("fancybox-image").attr("src", e.src).appendTo(e.$content), (n[0].complete || "complete" == n[0].readyState) && n[0].naturalWidth && n[0].naturalHeight ? n.trigger("load") : n[0].error && n.trigger("error")
            }, resolveImageSlideSize: function (e, t, i) {
                var n = parseInt(e.opts.width, 10), s = parseInt(e.opts.height, 10);
                e.width = t, e.height = i, n > 0 && (e.width = n, e.height = Math.floor(n * i / t)), s > 0 && (e.width = Math.floor(s * t / i), e.height = s)
            }, setIframe: function (e) {
                var t, n = this, s = e.opts.iframe, o = e.$slide;
                e.$content = i('<div class="fancybox-content' + (s.preload ? " fancybox-is-hidden" : "") + '"></div>').css(s.css).appendTo(o), o.addClass("fancybox-slide--" + e.contentType), e.$iframe = t = i(s.tpl.replace(/\{rnd\}/g, (new Date).getTime())).attr(s.attr).appendTo(e.$content), s.preload ? (n.showLoading(e), t.on("load.fb error.fb", function (t) {
                    this.isReady = 1, e.$slide.trigger("refresh"), n.afterLoad(e)
                }), o.on("refresh.fb", function () {
                    var i, n, o = e.$content, r = s.css.width, a = s.css.height;
                    if (1 === t[0].isReady) {
                        try {
                            i = t.contents(), n = i.find("body")
                        } catch (e) {
                        }
                        n && n.length && n.children().length && (o.css({
                            width: "",
                            height: ""
                        }), void 0 === r && (r = Math.ceil(Math.max(n[0].clientWidth, n.outerWidth(!0)))), r && o.width(r), void 0 === a && (a = Math.ceil(Math.max(n[0].clientHeight, n.outerHeight(!0)))), a && o.height(a)), o.removeClass("fancybox-is-hidden")
                    }
                })) : this.afterLoad(e), t.attr("src", e.src), o.one("onReset", function () {
                    try {
                        i(this).find("iframe").hide().unbind().attr("src", "//about:blank")
                    } catch (e) {
                    }
                    i(this).off("refresh.fb").empty(), e.isLoaded = !1
                })
            }, setContent: function (e, t) {
                var n = this;
                n.isClosing || (n.hideLoading(e), e.$content && i.fancybox.stop(e.$content), e.$slide.empty(), c(t) && t.parent().length ? (t.parent().parent(".fancybox-slide--inline").trigger("onReset"), e.$placeholder = i("<div>").hide().insertAfter(t), t.css("display", "inline-block")) : e.hasError || ("string" === i.type(t) && (t = i("<div>").append(i.trim(t)).contents(), 3 === t[0].nodeType && (t = i("<div>").html(t))), e.opts.filter && (t = i("<div>").html(t).find(e.opts.filter))), e.$slide.one("onReset", function () {
                    i(this).find("video,audio").trigger("pause"), e.$placeholder && (e.$placeholder.after(t.hide()).remove(), e.$placeholder = null), e.$smallBtn && (e.$smallBtn.remove(), e.$smallBtn = null), e.hasError || (i(this).empty(), e.isLoaded = !1)
                }), i(t).appendTo(e.$slide), i(t).is("video,audio") && (i(t).addClass("fancybox-video"), i(t).wrap("<div></div>"), e.contentType = "video", e.opts.width = e.opts.width || i(t).attr("width"), e.opts.height = e.opts.height || i(t).attr("height")), e.$content = e.$slide.children().filter("div,form,main,video,audio").first().addClass("fancybox-content"), e.$slide.addClass("fancybox-slide--" + e.contentType), this.afterLoad(e))
            }, setError: function (e) {
                e.hasError = !0, e.$slide.trigger("onReset").removeClass("fancybox-slide--" + e.contentType).addClass("fancybox-slide--error"), e.contentType = "html", this.setContent(e, this.translate(e, e.opts.errorTpl)), e.pos === this.currPos && (this.isAnimating = !1)
            }, showLoading: function (e) {
                var t = this;
                (e = e || t.current) && !e.$spinner && (e.$spinner = i(t.translate(t, t.opts.spinnerTpl)).appendTo(e.$slide))
            }, hideLoading: function (e) {
                var t = this;
                (e = e || t.current) && e.$spinner && (e.$spinner.remove(), delete e.$spinner)
            }, afterLoad: function (e) {
                var t = this;
                t.isClosing || (e.isLoading = !1, e.isLoaded = !0, t.trigger("afterLoad", e), t.hideLoading(e), e.pos === t.currPos && t.updateCursor(), !e.opts.smallBtn || e.$smallBtn && e.$smallBtn.length || (e.$smallBtn = i(t.translate(e, e.opts.btnTpl.smallBtn)).prependTo(e.$content)), e.opts.protect && e.$content && !e.hasError && (e.$content.on("contextmenu.fb", function (e) {
                    return 2 == e.button && e.preventDefault(), !0
                }), "image" === e.type && i('<div class="fancybox-spaceball"></div>').appendTo(e.$content)), t.revealContent(e))
            }, revealContent: function (e) {
                var t, n, s, o, r = this, a = e.$slide, l = !1, c = !1;
                return t = e.opts[r.firstRun ? "animationEffect" : "transitionEffect"], s = e.opts[r.firstRun ? "animationDuration" : "transitionDuration"], s = parseInt(void 0 === e.forcedDuration ? s : e.forcedDuration, 10), e.pos === r.currPos && (e.isComplete ? t = !1 : r.isAnimating = !0), !e.isMoved && e.pos === r.currPos && s || (t = !1), "zoom" === t && (e.pos === r.currPos && s && "image" === e.type && !e.hasError && (c = r.getThumbPos(e)) ? l = r.getFitPos(e) : t = "fade"), "zoom" === t ? (l.scaleX = l.width / c.width, l.scaleY = l.height / c.height, o = e.opts.zoomOpacity, "auto" == o && (o = Math.abs(e.width / e.height - c.width / c.height) > .1), o && (c.opacity = .1, l.opacity = 1), i.fancybox.setTranslate(e.$content.removeClass("fancybox-is-hidden"), c), h(e.$content), void i.fancybox.animate(e.$content, l, s, function () {
                    r.isAnimating = !1, r.complete()
                })) : (r.updateSlide(e), t ? (i.fancybox.stop(a), n = "fancybox-animated fancybox-slide--" + (e.pos >= r.prevPos ? "next" : "previous") + " fancybox-fx-" + t, a.removeAttr("style").removeClass("fancybox-slide--current fancybox-slide--next fancybox-slide--previous").addClass(n), e.$content.removeClass("fancybox-is-hidden"), h(a), void i.fancybox.animate(a, "fancybox-slide--current", s, function (t) {
                    a.removeClass(n).removeAttr("style"), e.pos === r.currPos && r.complete()
                }, !0)) : (h(a), e.$content.removeClass("fancybox-is-hidden"), void(e.pos === r.currPos && r.complete())))
            }, getThumbPos: function (n) {
                var s, o = this, r = !1, a = n.opts.$thumb,
                    l = a && a.length && a[0].ownerDocument === t ? a.offset() : 0;
                return l && function (t) {
                    for (var n = t[0], s = n.getBoundingClientRect(), o = []; null !== n.parentElement;) "hidden" !== i(n.parentElement).css("overflow") && "auto" !== i(n.parentElement).css("overflow") || o.push(n.parentElement.getBoundingClientRect()), n = n.parentElement;
                    return o.every(function (e) {
                        var t = Math.min(s.right, e.right) - Math.max(s.left, e.left),
                            i = Math.min(s.bottom, e.bottom) - Math.max(s.top, e.top);
                        return t > 0 && i > 0
                    }) && s.bottom > 0 && s.right > 0 && s.left < i(e).width() && s.top < i(e).height()
                }(a) && (s = o.$refs.stage.offset(), r = {
                    top: l.top - s.top + parseFloat(a.css("border-top-width") || 0),
                    left: l.left - s.left + parseFloat(a.css("border-left-width") || 0),
                    width: a.width(),
                    height: a.height(),
                    scaleX: 1,
                    scaleY: 1
                }), r
            }, complete: function () {
                var e = this, n = e.current, s = {};
                !n.isMoved && n.isLoaded && (n.isComplete || (n.isComplete = !0, n.$slide.siblings().trigger("onReset"), e.preload("inline"), h(n.$slide), n.$slide.addClass("fancybox-slide--complete"), i.each(e.slides, function (t, n) {
                    n.pos >= e.currPos - 1 && n.pos <= e.currPos + 1 ? s[n.pos] = n : n && (i.fancybox.stop(n.$slide), n.$slide.off().remove())
                }), e.slides = s), e.isAnimating = !1, e.updateCursor(), e.trigger("afterShow"), n.$slide.find("video,audio").filter(":visible:first").trigger("play"), (i(t.activeElement).is("[disabled]") || n.opts.autoFocus && "image" != n.type && "iframe" !== n.type) && e.focus())
            }, preload: function (e) {
                var t = this, i = t.slides[t.currPos + 1], n = t.slides[t.currPos - 1];
                i && i.type === e && t.loadSlide(i), n && n.type === e && t.loadSlide(n)
            }, focus: function () {
                var e, t = this.current;
                this.isClosing || t && t.isComplete && t.$content && (e = t.$content.find("input[autofocus]:enabled:visible:first"), e.length || (e = t.$content.find("button,:input,[tabindex],a").filter(":enabled:visible:first")), e = e && e.length ? e : t.$content, e.trigger("focus"))
            }, activate: function () {
                var e = this;
                i(".fancybox-container").each(function () {
                    var t = i(this).data("FancyBox");
                    t && t.id !== e.id && !t.isClosing && (t.trigger("onDeactivate"), t.removeEvents(), t.isVisible = !1)
                }), e.isVisible = !0, (e.current || e.isIdle) && (e.update(), e.updateControls()), e.trigger("onActivate"), e.addEvents()
            }, close: function (e, t) {
                var n, s, o, r, a, l, c, p = this, f = p.current, g = function () {
                    p.cleanUp(e)
                };
                return !p.isClosing && (p.isClosing = !0, !1 === p.trigger("beforeClose", e) ? (p.isClosing = !1, u(function () {
                    p.update()
                }), !1) : (p.removeEvents(), f.timouts && clearTimeout(f.timouts), o = f.$content, n = f.opts.animationEffect, s = i.isNumeric(t) ? t : n ? f.opts.animationDuration : 0, f.$slide.off(d).removeClass("fancybox-slide--complete fancybox-slide--next fancybox-slide--previous fancybox-animated"), f.$slide.siblings().trigger("onReset").remove(), s && p.$refs.container.removeClass("fancybox-is-open").addClass("fancybox-is-closing"), p.hideLoading(f), p.hideControls(), p.updateCursor(), "zoom" !== n || !0 !== e && o && s && "image" === f.type && !f.hasError && (c = p.getThumbPos(f)) || (n = "fade"), "zoom" === n ? (i.fancybox.stop(o), r = i.fancybox.getTranslate(o), l = {
                    top: r.top,
                    left: r.left,
                    scaleX: r.width / c.width,
                    scaleY: r.height / c.height,
                    width: c.width,
                    height: c.height
                }, a = f.opts.zoomOpacity, "auto" == a && (a = Math.abs(f.width / f.height - c.width / c.height) > .1), a && (c.opacity = 0), i.fancybox.setTranslate(o, l), h(o), i.fancybox.animate(o, c, s, g), !0) : (n && s ? !0 === e ? setTimeout(g, s) : i.fancybox.animate(f.$slide.removeClass("fancybox-slide--current"), "fancybox-animated fancybox-slide--previous fancybox-fx-" + n, s, g) : g(), !0)))
            }, cleanUp: function (e) {
                var t, n = this, s = i("body");
                n.current.$slide.trigger("onReset"), n.$refs.container.empty().remove(), n.trigger("afterClose", e), n.$lastFocus && n.current.opts.backFocus && n.$lastFocus.trigger("focus"), n.current = null, t = i.fancybox.getInstance(), t ? t.activate() : (s.removeClass("fancybox-active compensate-for-scrollbar"), i("#fancybox-style-noscroll").remove())
            }, trigger: function (e, t) {
                var n, s = Array.prototype.slice.call(arguments, 1), o = this, r = t && t.opts ? t : o.current;
                if (r ? s.unshift(r) : r = o, s.unshift(o), i.isFunction(r.opts[e]) && (n = r.opts[e].apply(r, s)), !1 === n) return n;
                "afterClose" !== e && o.$refs ? o.$refs.container.trigger(e + ".fb", s) : a.trigger(e + ".fb", s)
            }, updateControls: function (e) {
                var t = this, i = t.current, n = i.index, s = i.opts.caption, o = t.$refs.container,
                    r = t.$refs.caption;
                i.$slide.trigger("refresh"), t.$caption = s && s.length ? r.html(s) : null, t.isHiddenControls || t.isIdle || t.showControls(), o.find("[data-fancybox-count]").html(t.group.length), o.find("[data-fancybox-index]").html(n + 1), o.find("[data-fancybox-prev]").toggleClass("disabled", !i.opts.loop && n <= 0), o.find("[data-fancybox-next]").toggleClass("disabled", !i.opts.loop && n >= t.group.length - 1), "image" === i.type ? o.find("[data-fancybox-zoom]").show().end().find("[data-fancybox-download]").attr("href", i.opts.image.src || i.src).show() : i.opts.toolbar && o.find("[data-fancybox-download],[data-fancybox-zoom]").hide()
            }, hideControls: function () {
                this.isHiddenControls = !0, this.$refs.container.removeClass("fancybox-show-infobar fancybox-show-toolbar fancybox-show-caption fancybox-show-nav")
            }, showControls: function () {
                var e = this, t = e.current ? e.current.opts : e.opts, i = e.$refs.container;
                e.isHiddenControls = !1, e.idleSecondsCounter = 0, i.toggleClass("fancybox-show-toolbar", !(!t.toolbar || !t.buttons)).toggleClass("fancybox-show-infobar", !!(t.infobar && e.group.length > 1)).toggleClass("fancybox-show-nav", !!(t.arrows && e.group.length > 1)).toggleClass("fancybox-is-modal", !!t.modal), e.$caption ? i.addClass("fancybox-show-caption ") : i.removeClass("fancybox-show-caption")
            }, toggleControls: function () {
                this.isHiddenControls ? this.showControls() : this.hideControls()
            }
        }), i.fancybox = {
            version: "3.3.5",
            defaults: o,
            getInstance: function (e) {
                var t = i('.fancybox-container:not(".fancybox-is-closing"):last').data("FancyBox"),
                    n = Array.prototype.slice.call(arguments, 1);
                return t instanceof f && ("string" === i.type(e) ? t[e].apply(t, n) : "function" === i.type(e) && e.apply(t, n), t)
            },
            open: function (e, t, i) {
                return new f(e, t, i)
            },
            close: function (e) {
                var t = this.getInstance();
                t && (t.close(), !0 === e && this.close())
            },
            destroy: function () {
                this.close(!0), a.add("body").off("click.fb-start", "**")
            },
            isMobile: void 0 !== t.createTouch && /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
            use3d: function () {
                var i = t.createElement("div");
                return e.getComputedStyle && e.getComputedStyle(i) && e.getComputedStyle(i).getPropertyValue("transform") && !(t.documentMode && t.documentMode < 11)
            }(),
            getTranslate: function (e) {
                var t;
                return !(!e || !e.length) && (t = e[0].getBoundingClientRect(), {
                    top: t.top || 0,
                    left: t.left || 0,
                    width: t.width,
                    height: t.height,
                    opacity: parseFloat(e.css("opacity"))
                })
            },
            setTranslate: function (e, t) {
                var i = "", n = {};
                if (e && t) return void 0 === t.left && void 0 === t.top || (i = (void 0 === t.left ? e.position().left : t.left) + "px, " + (void 0 === t.top ? e.position().top : t.top) + "px", i = this.use3d ? "translate3d(" + i + ", 0px)" : "translate(" + i + ")"), void 0 !== t.scaleX && void 0 !== t.scaleY && (i = (i.length ? i + " " : "") + "scale(" + t.scaleX + ", " + t.scaleY + ")"), i.length && (n.transform = i), void 0 !== t.opacity && (n.opacity = t.opacity), void 0 !== t.width && (n.width = t.width), void 0 !== t.height && (n.height = t.height), e.css(n)
            },
            animate: function (e, t, n, s, o) {
                var r = !1;
                i.isFunction(n) && (s = n, n = null), i.isPlainObject(t) || e.removeAttr("style"), i.fancybox.stop(e), e.on(d, function (n) {
                    (!n || !n.originalEvent || e.is(n.originalEvent.target) && "z-index" != n.originalEvent.propertyName) && (i.fancybox.stop(e), r && i.fancybox.setTranslate(e, r), i.isPlainObject(t) ? !1 === o && e.removeAttr("style") : !0 !== o && e.removeClass(t), i.isFunction(s) && s(n))
                }), i.isNumeric(n) && e.css("transition-duration", n + "ms"), i.isPlainObject(t) ? (void 0 !== t.scaleX && void 0 !== t.scaleY && (r = i.extend({}, t, {
                    width: e.width() * t.scaleX,
                    height: e.height() * t.scaleY,
                    scaleX: 1,
                    scaleY: 1
                }), delete t.width, delete t.height, e.parent().hasClass("fancybox-slide--image") && e.parent().addClass("fancybox-is-scaling")), i.fancybox.setTranslate(e, t)) : e.addClass(t), e.data("timer", setTimeout(function () {
                    e.trigger("transitionend")
                }, n + 16))
            },
            stop: function (e) {
                e && e.length && (clearTimeout(e.data("timer")), e.off("transitionend").css("transition-duration", ""), e.parent().removeClass("fancybox-is-scaling"))
            }
        }, i.fn.fancybox = function (e) {
            var t;
            return e = e || {}, t = e.selector || !1, t ? i("body").off("click.fb-start", t).on("click.fb-start", t, {options: e}, s) : this.off("click.fb-start").on("click.fb-start", {
                items: this,
                options: e
            }, s), this
        }, a.on("click.fb-start", "[data-fancybox]", s), a.on("click.fb-start", "[data-trigger]", function (e) {
            s(e, {
                $target: i('[data-fancybox="' + i(e.currentTarget).attr("data-trigger") + '"]').eq(i(e.currentTarget).attr("data-index") || 0),
                $trigger: i(this)
            })
        })
    }
}(window, document, window.jQuery || jQuery), function (e) {
    "use strict";
    var t = function (t, i, n) {
        if (t) return n = n || "", "object" === e.type(n) && (n = e.param(n, !0)), e.each(i, function (e, i) {
            t = t.replace("$" + e, i || "")
        }), n.length && (t += (t.indexOf("?") > 0 ? "&" : "?") + n), t
    }, i = {
        youtube: {
            matcher: /(youtube\.com|youtu\.be|youtube\-nocookie\.com)\/(watch\?(.*&)?v=|v\/|u\/|embed\/?)?(videoseries\?list=(.*)|[\w-]{11}|\?listType=(.*)&list=(.*))(.*)/i,
            params: {autoplay: 1, autohide: 1, fs: 1, rel: 0, hd: 1, wmode: "transparent", enablejsapi: 1, html5: 1},
            paramPlace: 8,
            type: "iframe",
            url: "//www.youtube.com/embed/$4",
            thumb: "//img.youtube.com/vi/$4/hqdefault.jpg"
        },
        vimeo: {
            matcher: /^.+vimeo.com\/(.*\/)?([\d]+)(.*)?/,
            params: {autoplay: 1, hd: 1, show_title: 1, show_byline: 1, show_portrait: 0, fullscreen: 1, api: 1},
            paramPlace: 3,
            type: "iframe",
            url: "//player.vimeo.com/video/$2"
        },
        instagram: {
            matcher: /(instagr\.am|instagram\.com)\/p\/([a-zA-Z0-9_\-]+)\/?/i,
            type: "image",
            url: "//$1/p/$2/media/?size=l"
        },
        gmap_place: {
            matcher: /(maps\.)?google\.([a-z]{2,3}(\.[a-z]{2})?)\/(((maps\/(place\/(.*)\/)?\@(.*),(\d+.?\d+?)z))|(\?ll=))(.*)?/i,
            type: "iframe",
            url: function (e) {
                return "//maps.google." + e[2] + "/?ll=" + (e[9] ? e[9] + "&z=" + Math.floor(e[10]) + (e[12] ? e[12].replace(/^\//, "&") : "") : e[12] + "").replace(/\?/, "&") + "&output=" + (e[12] && e[12].indexOf("layer=c") > 0 ? "svembed" : "embed")
            }
        },
        gmap_search: {
            matcher: /(maps\.)?google\.([a-z]{2,3}(\.[a-z]{2})?)\/(maps\/search\/)(.*)/i,
            type: "iframe",
            url: function (e) {
                return "//maps.google." + e[2] + "/maps?q=" + e[5].replace("query=", "q=").replace("api=1", "") + "&output=embed"
            }
        }
    };
    e(document).on("objectNeedsType.fb", function (n, s, o) {
        var r, a, l, c, u, d, h, p = o.src || "", f = !1;
        r = e.extend(!0, {}, i, o.opts.media), e.each(r, function (i, n) {
            if (l = p.match(n.matcher)) {
                if (f = n.type, h = i, d = {}, n.paramPlace && l[n.paramPlace]) {
                    u = l[n.paramPlace], "?" == u[0] && (u = u.substring(1)), u = u.split("&");
                    for (var s = 0; s < u.length; ++s) {
                        var r = u[s].split("=", 2);
                        2 == r.length && (d[r[0]] = decodeURIComponent(r[1].replace(/\+/g, " ")))
                    }
                }
                return c = e.extend(!0, {}, n.params, o.opts[i], d), p = "function" === e.type(n.url) ? n.url.call(this, l, c, o) : t(n.url, l, c), a = "function" === e.type(n.thumb) ? n.thumb.call(this, l, c, o) : t(n.thumb, l), "youtube" === i ? p = p.replace(/&t=((\d+)m)?(\d+)s/, function (e, t, i, n) {
                    return "&start=" + ((i ? 60 * parseInt(i, 10) : 0) + parseInt(n, 10))
                }) : "vimeo" === i && (p = p.replace("&%23", "#")), !1
            }
        }), f ? (o.opts.thumb || o.opts.$thumb && o.opts.$thumb.length || (o.opts.thumb = a), "iframe" === f && (o.opts = e.extend(!0, o.opts, {
            iframe: {
                preload: !1,
                attr: {scrolling: "no"}
            }
        })), e.extend(o, {
            type: f,
            src: p,
            origSrc: o.src,
            contentSource: h,
            contentType: "image" === f ? "image" : "gmap_place" == h || "gmap_search" == h ? "map" : "video"
        })) : p && (o.type = o.opts.defaultType)
    })
}(window.jQuery || jQuery), function (e, t, i) {
    "use strict";
    var n = function () {
        return e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || e.oRequestAnimationFrame || function (t) {
            return e.setTimeout(t, 1e3 / 60)
        }
    }(), s = function () {
        return e.cancelAnimationFrame || e.webkitCancelAnimationFrame || e.mozCancelAnimationFrame || e.oCancelAnimationFrame || function (t) {
            e.clearTimeout(t)
        }
    }(), o = function (t) {
        var i = [];
        t = t.originalEvent || t || e.e, t = t.touches && t.touches.length ? t.touches : t.changedTouches && t.changedTouches.length ? t.changedTouches : [t];
        for (var n in t) t[n].pageX ? i.push({x: t[n].pageX, y: t[n].pageY}) : t[n].clientX && i.push({
            x: t[n].clientX,
            y: t[n].clientY
        });
        return i
    }, r = function (e, t, i) {
        return t && e ? "x" === i ? e.x - t.x : "y" === i ? e.y - t.y : Math.sqrt(Math.pow(e.x - t.x, 2) + Math.pow(e.y - t.y, 2)) : 0
    }, a = function (e) {
        if (e.is('a,area,button,[role="button"],input,label,select,summary,textarea,video,audio') || i.isFunction(e.get(0).onclick) || e.data("selectable")) return !0;
        for (var t = 0, n = e[0].attributes, s = n.length; t < s; t++) if ("data-fancybox-" === n[t].nodeName.substr(0, 14)) return !0;
        return !1
    }, l = function (t) {
        var i = e.getComputedStyle(t)["overflow-y"], n = e.getComputedStyle(t)["overflow-x"],
            s = ("scroll" === i || "auto" === i) && t.scrollHeight > t.clientHeight,
            o = ("scroll" === n || "auto" === n) && t.scrollWidth > t.clientWidth;
        return s || o
    }, c = function (e) {
        for (var t = !1; ;) {
            if (t = l(e.get(0))) break;
            if (e = e.parent(), !e.length || e.hasClass("fancybox-stage") || e.is("body")) break
        }
        return t
    }, u = function (e) {
        var t = this;
        t.instance = e, t.$bg = e.$refs.bg, t.$stage = e.$refs.stage, t.$container = e.$refs.container, t.destroy(), t.$container.on("touchstart.fb.touch mousedown.fb.touch", i.proxy(t, "ontouchstart"))
    };
    u.prototype.destroy = function () {
        this.$container.off(".fb.touch")
    }, u.prototype.ontouchstart = function (n) {
        var s = this, l = i(n.target), u = s.instance, d = u.current, h = d.$content, p = "touchstart" == n.type;
        if (p && s.$container.off("mousedown.fb.touch"), (!n.originalEvent || 2 != n.originalEvent.button) && l.length && !a(l) && !a(l.parent()) && (l.is("img") || !(n.originalEvent.clientX > l[0].clientWidth + l.offset().left))) {
            if (!d || u.isAnimating || u.isClosing) return n.stopPropagation(), void n.preventDefault();
            if (s.realPoints = s.startPoints = o(n), s.startPoints.length) {
                if (n.stopPropagation(), s.startEvent = n, s.canTap = !0, s.$target = l, s.$content = h, s.opts = d.opts.touch, s.isPanning = !1, s.isSwiping = !1, s.isZooming = !1, s.isScrolling = !1, s.startTime = (new Date).getTime(), s.distanceX = s.distanceY = s.distance = 0, s.canvasWidth = Math.round(d.$slide[0].clientWidth), s.canvasHeight = Math.round(d.$slide[0].clientHeight), s.contentLastPos = null, s.contentStartPos = i.fancybox.getTranslate(s.$content) || {
                        top: 0,
                        left: 0
                    }, s.sliderStartPos = s.sliderLastPos || i.fancybox.getTranslate(d.$slide), s.stagePos = i.fancybox.getTranslate(u.$refs.stage), s.sliderStartPos.top -= s.stagePos.top, s.sliderStartPos.left -= s.stagePos.left, s.contentStartPos.top -= s.stagePos.top, s.contentStartPos.left -= s.stagePos.left, i(t).off(".fb.touch").on(p ? "touchend.fb.touch touchcancel.fb.touch" : "mouseup.fb.touch mouseleave.fb.touch", i.proxy(s, "ontouchend")).on(p ? "touchmove.fb.touch" : "mousemove.fb.touch", i.proxy(s, "ontouchmove")), i.fancybox.isMobile && t.addEventListener("scroll", s.onscroll, !0), !s.opts && !u.canPan() || !l.is(s.$stage) && !s.$stage.find(l).length) return void(l.is(".fancybox-image") && n.preventDefault());
                i.fancybox.isMobile && (c(l) || c(l.parent())) || n.preventDefault(), (1 === s.startPoints.length || d.hasError) && (s.instance.canPan() ? (i.fancybox.stop(s.$content), s.$content.css("transition-duration", ""), s.isPanning = !0) : s.isSwiping = !0, s.$container.addClass("fancybox-controls--isGrabbing")), 2 === s.startPoints.length && "image" === d.type && (d.isLoaded || d.$ghost) && (s.canTap = !1, s.isSwiping = !1, s.isPanning = !1, s.isZooming = !0, i.fancybox.stop(s.$content), s.$content.css("transition-duration", ""), s.centerPointStartX = .5 * (s.startPoints[0].x + s.startPoints[1].x) - i(e).scrollLeft(), s.centerPointStartY = .5 * (s.startPoints[0].y + s.startPoints[1].y) - i(e).scrollTop(), s.percentageOfImageAtPinchPointX = (s.centerPointStartX - s.contentStartPos.left) / s.contentStartPos.width, s.percentageOfImageAtPinchPointY = (s.centerPointStartY - s.contentStartPos.top) / s.contentStartPos.height, s.startDistanceBetweenFingers = r(s.startPoints[0], s.startPoints[1]))
            }
        }
    }, u.prototype.onscroll = function (e) {
        var i = this;
        i.isScrolling = !0, t.removeEventListener("scroll", i.onscroll, !0)
    }, u.prototype.ontouchmove = function (e) {
        var t = this, n = i(e.target);
        return void 0 !== e.originalEvent.buttons && 0 === e.originalEvent.buttons ? void t.ontouchend(e) : t.isScrolling || !n.is(t.$stage) && !t.$stage.find(n).length ? void(t.canTap = !1) : (t.newPoints = o(e), void((t.opts || t.instance.canPan()) && t.newPoints.length && t.newPoints.length && (t.isSwiping && !0 === t.isSwiping || e.preventDefault(), t.distanceX = r(t.newPoints[0], t.startPoints[0], "x"), t.distanceY = r(t.newPoints[0], t.startPoints[0], "y"), t.distance = r(t.newPoints[0], t.startPoints[0]), t.distance > 0 && (t.isSwiping ? t.onSwipe(e) : t.isPanning ? t.onPan() : t.isZooming && t.onZoom()))))
    }, u.prototype.onSwipe = function (t) {
        var o, r = this, a = r.isSwiping, l = r.sliderStartPos.left || 0;
        if (!0 !== a) "x" == a && (r.distanceX > 0 && (r.instance.group.length < 2 || 0 === r.instance.current.index && !r.instance.current.opts.loop) ? l += Math.pow(r.distanceX, .8) : r.distanceX < 0 && (r.instance.group.length < 2 || r.instance.current.index === r.instance.group.length - 1 && !r.instance.current.opts.loop) ? l -= Math.pow(-r.distanceX, .8) : l += r.distanceX), r.sliderLastPos = {
            top: "x" == a ? 0 : r.sliderStartPos.top + r.distanceY,
            left: l
        }, r.requestId && (s(r.requestId), r.requestId = null), r.requestId = n(function () {
            r.sliderLastPos && (i.each(r.instance.slides, function (e, t) {
                var n = t.pos - r.instance.currPos;
                i.fancybox.setTranslate(t.$slide, {
                    top: r.sliderLastPos.top,
                    left: r.sliderLastPos.left + n * r.canvasWidth + n * t.opts.gutter
                })
            }), r.$container.addClass("fancybox-is-sliding"))
        }); else if (Math.abs(r.distance) > 10) {
            if (r.canTap = !1, r.instance.group.length < 2 && r.opts.vertical ? r.isSwiping = "y" : r.instance.isDragging || !1 === r.opts.vertical || "auto" === r.opts.vertical && i(e).width() > 800 ? r.isSwiping = "x" : (o = Math.abs(180 * Math.atan2(r.distanceY, r.distanceX) / Math.PI), r.isSwiping = o > 45 && o < 135 ? "y" : "x"), r.canTap = !1, "y" === r.isSwiping && i.fancybox.isMobile && (c(r.$target) || c(r.$target.parent()))) return void(r.isScrolling = !0);
            r.instance.isDragging = r.isSwiping, r.startPoints = r.newPoints, i.each(r.instance.slides, function (e, t) {
                i.fancybox.stop(t.$slide), t.$slide.css("transition-duration", ""), t.inTransition = !1, t.pos === r.instance.current.pos && (r.sliderStartPos.left = i.fancybox.getTranslate(t.$slide).left - i.fancybox.getTranslate(r.instance.$refs.stage).left)
            }), r.instance.SlideShow && r.instance.SlideShow.isActive && r.instance.SlideShow.stop()
        }
    }, u.prototype.onPan = function () {
        var e = this;
        if (r(e.newPoints[0], e.realPoints[0]) < (i.fancybox.isMobile ? 10 : 5)) return void(e.startPoints = e.newPoints);
        e.canTap = !1, e.contentLastPos = e.limitMovement(), e.requestId && (s(e.requestId), e.requestId = null), e.requestId = n(function () {
            i.fancybox.setTranslate(e.$content, e.contentLastPos)
        })
    }, u.prototype.limitMovement = function () {
        var e, t, i, n, s, o, r = this, a = r.canvasWidth, l = r.canvasHeight, c = r.distanceX, u = r.distanceY,
            d = r.contentStartPos, h = d.left, p = d.top, f = d.width, g = d.height;
        return s = f > a ? h + c : h, o = p + u, e = Math.max(0, .5 * a - .5 * f), t = Math.max(0, .5 * l - .5 * g), i = Math.min(a - f, .5 * a - .5 * f), n = Math.min(l - g, .5 * l - .5 * g), c > 0 && s > e && (s = e - 1 + Math.pow(-e + h + c, .8) || 0), c < 0 && s < i && (s = i + 1 - Math.pow(i - h - c, .8) || 0), u > 0 && o > t && (o = t - 1 + Math.pow(-t + p + u, .8) || 0), u < 0 && o < n && (o = n + 1 - Math.pow(n - p - u, .8) || 0), {
            top: o,
            left: s
        }
    }, u.prototype.limitPosition = function (e, t, i, n) {
        var s = this, o = s.canvasWidth, r = s.canvasHeight;
        return i > o ? (e = e > 0 ? 0 : e, e = e < o - i ? o - i : e) : e = Math.max(0, o / 2 - i / 2), n > r ? (t = t > 0 ? 0 : t, t = t < r - n ? r - n : t) : t = Math.max(0, r / 2 - n / 2), {
            top: t,
            left: e
        }
    }, u.prototype.onZoom = function () {
        var t = this, o = t.contentStartPos, a = o.width, l = o.height, c = o.left, u = o.top,
            d = r(t.newPoints[0], t.newPoints[1]), h = d / t.startDistanceBetweenFingers, p = Math.floor(a * h),
            f = Math.floor(l * h), g = (a - p) * t.percentageOfImageAtPinchPointX,
            m = (l - f) * t.percentageOfImageAtPinchPointY,
            v = (t.newPoints[0].x + t.newPoints[1].x) / 2 - i(e).scrollLeft(),
            y = (t.newPoints[0].y + t.newPoints[1].y) / 2 - i(e).scrollTop(), x = v - t.centerPointStartX,
            b = y - t.centerPointStartY, _ = c + (g + x), w = u + (m + b),
            T = {top: w, left: _, scaleX: h, scaleY: h};
        t.canTap = !1, t.newWidth = p, t.newHeight = f, t.contentLastPos = T, t.requestId && (s(t.requestId), t.requestId = null), t.requestId = n(function () {
            i.fancybox.setTranslate(t.$content, t.contentLastPos)
        })
    }, u.prototype.ontouchend = function (e) {
        var n = this, r = Math.max((new Date).getTime() - n.startTime, 1), a = n.isSwiping, l = n.isPanning,
            c = n.isZooming, u = n.isScrolling;
        if (n.endPoints = o(e), n.$container.removeClass("fancybox-controls--isGrabbing"), i(t).off(".fb.touch"), t.removeEventListener("scroll", n.onscroll, !0), n.requestId && (s(n.requestId), n.requestId = null), n.isSwiping = !1, n.isPanning = !1, n.isZooming = !1, n.isScrolling = !1, n.instance.isDragging = !1, n.canTap) return n.onTap(e);
        n.speed = 366, n.velocityX = n.distanceX / r * .5, n.velocityY = n.distanceY / r * .5, n.speedX = Math.max(.5 * n.speed, Math.min(1.5 * n.speed, 1 / Math.abs(n.velocityX) * n.speed)), l ? n.endPanning() : c ? n.endZooming() : n.endSwiping(a, u)
    }, u.prototype.endSwiping = function (e, t) {
        var n = this, s = !1, o = n.instance.group.length;
        n.sliderLastPos = null, "y" == e && !t && Math.abs(n.distanceY) > 50 ? (i.fancybox.animate(n.instance.current.$slide, {
            top: n.sliderStartPos.top + n.distanceY + 150 * n.velocityY,
            opacity: 0
        }, 200), s = n.instance.close(!0, 200)) : "x" == e && n.distanceX > 50 && o > 1 ? s = n.instance.previous(n.speedX) : "x" == e && n.distanceX < -50 && o > 1 && (s = n.instance.next(n.speedX)), !1 !== s || "x" != e && "y" != e || (t || o < 2 ? n.instance.centerSlide(n.instance.current, 150) : n.instance.jumpTo(n.instance.current.index)), n.$container.removeClass("fancybox-is-sliding")
    }, u.prototype.endPanning = function () {
        var e, t, n, s = this;
        s.contentLastPos && (!1 === s.opts.momentum ? (e = s.contentLastPos.left, t = s.contentLastPos.top) : (e = s.contentLastPos.left + s.velocityX * s.speed, t = s.contentLastPos.top + s.velocityY * s.speed),
            n = s.limitPosition(e, t, s.contentStartPos.width, s.contentStartPos.height), n.width = s.contentStartPos.width, n.height = s.contentStartPos.height, i.fancybox.animate(s.$content, n, 330))
    }, u.prototype.endZooming = function () {
        var e, t, n, s, o = this, r = o.instance.current, a = o.newWidth, l = o.newHeight;
        o.contentLastPos && (e = o.contentLastPos.left, t = o.contentLastPos.top, s = {
            top: t,
            left: e,
            width: a,
            height: l,
            scaleX: 1,
            scaleY: 1
        }, i.fancybox.setTranslate(o.$content, s), a < o.canvasWidth && l < o.canvasHeight ? o.instance.scaleToFit(150) : a > r.width || l > r.height ? o.instance.scaleToActual(o.centerPointStartX, o.centerPointStartY, 150) : (n = o.limitPosition(e, t, a, l), i.fancybox.setTranslate(o.$content, i.fancybox.getTranslate(o.$content)), i.fancybox.animate(o.$content, n, 150)))
    }, u.prototype.onTap = function (t) {
        var n, s = this, r = i(t.target), a = s.instance, l = a.current, c = t && o(t) || s.startPoints,
            u = c[0] ? c[0].x - i(e).scrollLeft() - s.stagePos.left : 0,
            d = c[0] ? c[0].y - i(e).scrollTop() - s.stagePos.top : 0, h = function (e) {
                var n = l.opts[e];
                if (i.isFunction(n) && (n = n.apply(a, [l, t])), n) switch (n) {
                    case"close":
                        a.close(s.startEvent);
                        break;
                    case"toggleControls":
                        a.toggleControls(!0);
                        break;
                    case"next":
                        a.next();
                        break;
                    case"nextOrClose":
                        a.group.length > 1 ? a.next() : a.close(s.startEvent);
                        break;
                    case"zoom":
                        "image" == l.type && (l.isLoaded || l.$ghost) && (a.canPan() ? a.scaleToFit() : a.isScaledDown() ? a.scaleToActual(u, d) : a.group.length < 2 && a.close(s.startEvent))
                }
            };
        if ((!t.originalEvent || 2 != t.originalEvent.button) && (r.is("img") || !(u > r[0].clientWidth + r.offset().left))) {
            if (r.is(".fancybox-bg,.fancybox-inner,.fancybox-outer,.fancybox-container")) n = "Outside"; else if (r.is(".fancybox-slide")) n = "Slide"; else {
                if (!a.current.$content || !a.current.$content.find(r).addBack().filter(r).length) return;
                n = "Content"
            }
            if (s.tapped) {
                if (clearTimeout(s.tapped), s.tapped = null, Math.abs(u - s.tapX) > 50 || Math.abs(d - s.tapY) > 50) return this;
                h("dblclick" + n)
            } else s.tapX = u, s.tapY = d, l.opts["dblclick" + n] && l.opts["dblclick" + n] !== l.opts["click" + n] ? s.tapped = setTimeout(function () {
                s.tapped = null, h("click" + n)
            }, 500) : h("click" + n);
            return this
        }
    }, i(t).on("onActivate.fb", function (e, t) {
        t && !t.Guestures && (t.Guestures = new u(t))
    })
}(window, document, window.jQuery || jQuery), function (e, t) {
    "use strict";
    t.extend(!0, t.fancybox.defaults, {
        btnTpl: {slideShow: '<button data-fancybox-play class="fancybox-button fancybox-button--play" title="{{PLAY_START}}"><svg viewBox="0 0 40 40"><path d="M13,12 L27,20 L13,27 Z" /><path d="M15,10 v19 M23,10 v19" /></svg></button>'},
        slideShow: {autoStart: !1, speed: 3e3}
    });
    var i = function (e) {
        this.instance = e, this.init()
    };
    t.extend(i.prototype, {
        timer: null, isActive: !1, $button: null, init: function () {
            var e = this;
            e.$button = e.instance.$refs.toolbar.find("[data-fancybox-play]").on("click", function () {
                e.toggle()
            }), (e.instance.group.length < 2 || !e.instance.group[e.instance.currIndex].opts.slideShow) && e.$button.hide()
        }, set: function (e) {
            var t = this;
            t.instance && t.instance.current && (!0 === e || t.instance.current.opts.loop || t.instance.currIndex < t.instance.group.length - 1) ? t.timer = setTimeout(function () {
                t.isActive && t.instance.jumpTo((t.instance.currIndex + 1) % t.instance.group.length)
            }, t.instance.current.opts.slideShow.speed) : (t.stop(), t.instance.idleSecondsCounter = 0, t.instance.showControls())
        }, clear: function () {
            var e = this;
            clearTimeout(e.timer), e.timer = null
        }, start: function () {
            var e = this, t = e.instance.current;
            t && (e.isActive = !0, e.$button.attr("title", t.opts.i18n[t.opts.lang].PLAY_STOP).removeClass("fancybox-button--play").addClass("fancybox-button--pause"), e.set(!0))
        }, stop: function () {
            var e = this, t = e.instance.current;
            e.clear(), e.$button.attr("title", t.opts.i18n[t.opts.lang].PLAY_START).removeClass("fancybox-button--pause").addClass("fancybox-button--play"), e.isActive = !1
        }, toggle: function () {
            var e = this;
            e.isActive ? e.stop() : e.start()
        }
    }), t(e).on({
        "onInit.fb": function (e, t) {
            t && !t.SlideShow && (t.SlideShow = new i(t))
        }, "beforeShow.fb": function (e, t, i, n) {
            var s = t && t.SlideShow;
            n ? s && i.opts.slideShow.autoStart && s.start() : s && s.isActive && s.clear()
        }, "afterShow.fb": function (e, t, i) {
            var n = t && t.SlideShow;
            n && n.isActive && n.set()
        }, "afterKeydown.fb": function (i, n, s, o, r) {
            var a = n && n.SlideShow;
            !a || !s.opts.slideShow || 80 !== r && 32 !== r || t(e.activeElement).is("button,a,input") || (o.preventDefault(), a.toggle())
        }, "beforeClose.fb onDeactivate.fb": function (e, t) {
            var i = t && t.SlideShow;
            i && i.stop()
        }
    }), t(e).on("visibilitychange", function () {
        var i = t.fancybox.getInstance(), n = i && i.SlideShow;
        n && n.isActive && (e.hidden ? n.clear() : n.set())
    })
}(document, window.jQuery || jQuery), function (e, t) {
    "use strict";
    var i = function () {
        for (var t = [["requestFullscreen", "exitFullscreen", "fullscreenElement", "fullscreenEnabled", "fullscreenchange", "fullscreenerror"], ["webkitRequestFullscreen", "webkitExitFullscreen", "webkitFullscreenElement", "webkitFullscreenEnabled", "webkitfullscreenchange", "webkitfullscreenerror"], ["webkitRequestFullScreen", "webkitCancelFullScreen", "webkitCurrentFullScreenElement", "webkitCancelFullScreen", "webkitfullscreenchange", "webkitfullscreenerror"], ["mozRequestFullScreen", "mozCancelFullScreen", "mozFullScreenElement", "mozFullScreenEnabled", "mozfullscreenchange", "mozfullscreenerror"], ["msRequestFullscreen", "msExitFullscreen", "msFullscreenElement", "msFullscreenEnabled", "MSFullscreenChange", "MSFullscreenError"]], i = {}, n = 0; n < t.length; n++) {
            var s = t[n];
            if (s && s[1] in e) {
                for (var o = 0; o < s.length; o++) i[t[0][o]] = s[o];
                return i
            }
        }
        return !1
    }();
    if (!i) return void(t && t.fancybox && (t.fancybox.defaults.btnTpl.fullScreen = !1));
    var n = {
        request: function (t) {
            t = t || e.documentElement, t[i.requestFullscreen](t.ALLOW_KEYBOARD_INPUT)
        }, exit: function () {
            e[i.exitFullscreen]()
        }, toggle: function (t) {
            t = t || e.documentElement, this.isFullscreen() ? this.exit() : this.request(t)
        }, isFullscreen: function () {
            return Boolean(e[i.fullscreenElement])
        }, enabled: function () {
            return Boolean(e[i.fullscreenEnabled])
        }
    };
    t.extend(!0, t.fancybox.defaults, {
        btnTpl: {fullScreen: '<button data-fancybox-fullscreen class="fancybox-button fancybox-button--fullscreen" title="{{FULL_SCREEN}}"><svg viewBox="0 0 40 40"><path d="M9,12 v16 h22 v-16 h-22 v8" /></svg></button>'},
        fullScreen: {autoStart: !1}
    }), t(e).on({
        "onInit.fb": function (e, t) {
            var i;
            t && t.group[t.currIndex].opts.fullScreen ? (i = t.$refs.container, i.on("click.fb-fullscreen", "[data-fancybox-fullscreen]", function (e) {
                e.stopPropagation(), e.preventDefault(), n.toggle()
            }), t.opts.fullScreen && !0 === t.opts.fullScreen.autoStart && n.request(), t.FullScreen = n) : t && t.$refs.toolbar.find("[data-fancybox-fullscreen]").hide()
        }, "afterKeydown.fb": function (e, t, i, n, s) {
            t && t.FullScreen && 70 === s && (n.preventDefault(), t.FullScreen.toggle())
        }, "beforeClose.fb": function (e, t) {
            t && t.FullScreen && t.$refs.container.hasClass("fancybox-is-fullscreen") && n.exit()
        }
    }), t(e).on(i.fullscreenchange, function () {
        var e = n.isFullscreen(), i = t.fancybox.getInstance();
        i && (i.current && "image" === i.current.type && i.isAnimating && (i.current.$content.css("transition", "none"), i.isAnimating = !1, i.update(!0, !0, 0)), i.trigger("onFullscreenChange", e), i.$refs.container.toggleClass("fancybox-is-fullscreen", e))
    })
}(document, window.jQuery || jQuery), function (e, t) {
    "use strict";
    var i = "fancybox-thumbs";
    t.fancybox.defaults = t.extend(!0, {
        btnTpl: {thumbs: '<button data-fancybox-thumbs class="fancybox-button fancybox-button--thumbs" title="{{THUMBS}}"><svg viewBox="0 0 120 120"><path d="M30,30 h14 v14 h-14 Z M50,30 h14 v14 h-14 Z M70,30 h14 v14 h-14 Z M30,50 h14 v14 h-14 Z M50,50 h14 v14 h-14 Z M70,50 h14 v14 h-14 Z M30,70 h14 v14 h-14 Z M50,70 h14 v14 h-14 Z M70,70 h14 v14 h-14 Z" /></svg></button>'},
        thumbs: {autoStart: !1, hideOnClose: !0, parentEl: ".fancybox-container", axis: "y"}
    }, t.fancybox.defaults);
    var n = function (e) {
        this.init(e)
    };
    t.extend(n.prototype, {
        $button: null, $grid: null, $list: null, isVisible: !1, isActive: !1, init: function (e) {
            var t, i, n = this;
            n.instance = e, e.Thumbs = n, n.opts = e.group[e.currIndex].opts.thumbs, t = e.group[0], t = t.opts.thumb || !(!t.opts.$thumb || !t.opts.$thumb.length) && t.opts.$thumb.attr("src"), e.group.length > 1 && (i = e.group[1], i = i.opts.thumb || !(!i.opts.$thumb || !i.opts.$thumb.length) && i.opts.$thumb.attr("src")), n.$button = e.$refs.toolbar.find("[data-fancybox-thumbs]"), n.opts && t && i && t && i ? (n.$button.show().on("click", function () {
                n.toggle()
            }), n.isActive = !0) : n.$button.hide()
        }, create: function () {
            var e, n = this, s = n.instance, o = n.opts.parentEl, r = [];
            n.$grid || (n.$grid = t('<div class="' + i + " " + i + "-" + n.opts.axis + '"></div>').appendTo(s.$refs.container.find(o).addBack().filter(o)), n.$grid.on("click", "li", function () {
                s.jumpTo(t(this).attr("data-index"))
            })), n.$list || (n.$list = t("<ul>").appendTo(n.$grid)), t.each(s.group, function (t, i) {
                e = i.opts.thumb || (i.opts.$thumb ? i.opts.$thumb.attr("src") : null), e || "image" !== i.type || (e = i.src), r.push('<li data-index="' + t + '" tabindex="0" class="fancybox-thumbs-loading"' + (e && e.length ? ' style="background-image:url(' + e + ')" />' : "") + "></li>")
            }), n.$list[0].innerHTML = r.join(""), "x" === n.opts.axis && n.$list.width(parseInt(n.$grid.css("padding-right"), 10) + s.group.length * n.$list.children().eq(0).outerWidth(!0))
        }, focus: function (e) {
            var t, i, n = this, s = n.$list, o = n.$grid;
            n.instance.current && (t = s.children().removeClass("fancybox-thumbs-active").filter('[data-index="' + n.instance.current.index + '"]').addClass("fancybox-thumbs-active"), i = t.position(), "y" === n.opts.axis && (i.top < 0 || i.top > s.height() - t.outerHeight()) ? s.stop().animate({scrollTop: s.scrollTop() + i.top}, e) : "x" === n.opts.axis && (i.left < o.scrollLeft() || i.left > o.scrollLeft() + (o.width() - t.outerWidth())) && s.parent().stop().animate({scrollLeft: i.left}, e))
        }, update: function () {
            var e = this;
            e.instance.$refs.container.toggleClass("fancybox-show-thumbs", this.isVisible), e.isVisible ? (e.$grid || e.create(), e.instance.trigger("onThumbsShow"), e.focus(0)) : e.$grid && e.instance.trigger("onThumbsHide"), e.instance.update()
        }, hide: function () {
            this.isVisible = !1, this.update()
        }, show: function () {
            this.isVisible = !0, this.update()
        }, toggle: function () {
            this.isVisible = !this.isVisible, this.update()
        }
    }), t(e).on({
        "onInit.fb": function (e, t) {
            var i;
            t && !t.Thumbs && (i = new n(t), i.isActive && !0 === i.opts.autoStart && i.show())
        }, "beforeShow.fb": function (e, t, i, n) {
            var s = t && t.Thumbs;
            s && s.isVisible && s.focus(n ? 0 : 250)
        }, "afterKeydown.fb": function (e, t, i, n, s) {
            var o = t && t.Thumbs;
            o && o.isActive && 71 === s && (n.preventDefault(), o.toggle())
        }, "beforeClose.fb": function (e, t) {
            var i = t && t.Thumbs;
            i && i.isVisible && !1 !== i.opts.hideOnClose && i.$grid.hide()
        }
    })
}(document, window.jQuery || jQuery), function (e, t) {
    "use strict";

    function i(e) {
        var t = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': "&quot;",
            "'": "&#39;",
            "/": "&#x2F;",
            "`": "&#x60;",
            "=": "&#x3D;"
        };
        return String(e).replace(/[&<>"'`=\/]/g, function (e) {
            return t[e]
        })
    }

    t.extend(!0, t.fancybox.defaults, {
        btnTpl: {share: '<button data-fancybox-share class="fancybox-button fancybox-button--share" title="{{SHARE}}"><svg viewBox="0 0 40 40"><path d="M6,30 C8,18 19,16 23,16 L23,16 L23,10 L33,20 L23,29 L23,24 C19,24 8,27 6,30 Z"></svg></button>'},
        share: {
            url: function (e, t) {
                return !e.currentHash && "inline" !== t.type && "html" !== t.type && (t.origSrc || t.src) || window.location
            },
            tpl: '<div class="fancybox-share"><h1>{{SHARE}}</h1><p><a class="fancybox-share__button fancybox-share__button--fb" href="https://www.facebook.com/sharer/sharer.php?u={{url}}"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m287 456v-299c0-21 6-35 35-35h38v-63c-7-1-29-3-55-3-54 0-91 33-91 94v306m143-254h-205v72h196" /></svg><span>Facebook</span></a><a class="fancybox-share__button fancybox-share__button--tw" href="https://twitter.com/intent/tweet?url={{url}}&text={{descr}}"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m456 133c-14 7-31 11-47 13 17-10 30-27 37-46-15 10-34 16-52 20-61-62-157-7-141 75-68-3-129-35-169-85-22 37-11 86 26 109-13 0-26-4-37-9 0 39 28 72 65 80-12 3-25 4-37 2 10 33 41 57 77 57-42 30-77 38-122 34 170 111 378-32 359-208 16-11 30-25 41-42z" /></svg><span>Twitter</span></a><a class="fancybox-share__button fancybox-share__button--pt" href="https://www.pinterest.com/pin/create/button/?url={{url}}&description={{descr}}&media={{media}}"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m265 56c-109 0-164 78-164 144 0 39 15 74 47 87 5 2 10 0 12-5l4-19c2-6 1-8-3-13-9-11-15-25-15-45 0-58 43-110 113-110 62 0 96 38 96 88 0 67-30 122-73 122-24 0-42-19-36-44 6-29 20-60 20-81 0-19-10-35-31-35-25 0-44 26-44 60 0 21 7 36 7 36l-30 125c-8 37-1 83 0 87 0 3 4 4 5 2 2-3 32-39 42-75l16-64c8 16 31 29 56 29 74 0 124-67 124-157 0-69-58-132-146-132z" fill="#fff"/></svg><span>Pinterest</span></a></p><p><input class="fancybox-share__input" type="text" value="{{url_raw}}" /></p></div>'
        }
    }), t(e).on("click", "[data-fancybox-share]", function () {
        var e, n, s = t.fancybox.getInstance(), o = s.current || null;
        o && ("function" === t.type(o.opts.share.url) && (e = o.opts.share.url.apply(o, [s, o])), n = o.opts.share.tpl.replace(/\{\{media\}\}/g, "image" === o.type ? encodeURIComponent(o.src) : "").replace(/\{\{url\}\}/g, encodeURIComponent(e)).replace(/\{\{url_raw\}\}/g, i(e)).replace(/\{\{descr\}\}/g, s.$caption ? encodeURIComponent(s.$caption.text()) : ""), t.fancybox.open({
            src: s.translate(s, n),
            type: "html",
            opts: {
                animationEffect: !1, afterLoad: function (e, t) {
                    s.$refs.container.one("beforeClose.fb", function () {
                        e.close(null, 0)
                    }), t.$content.find(".fancybox-share__links a").click(function () {
                        return window.open(this.href, "Share", "width=550, height=450"), !1
                    })
                }
            }
        }))
    })
}(document, window.jQuery || jQuery), function (e, t, i) {
    "use strict";

    function n() {
        var e = t.location.hash.substr(1), i = e.split("-"),
            n = i.length > 1 && /^\+?\d+$/.test(i[i.length - 1]) ? parseInt(i.pop(-1), 10) || 1 : 1, s = i.join("-");
        return {hash: e, index: n < 1 ? 1 : n, gallery: s}
    }

    function s(e) {
        "" !== e.gallery && i("[data-fancybox='" + i.escapeSelector(e.gallery) + "']").eq(e.index - 1).trigger("click.fb-start")
    }

    function o(e) {
        var t, i;
        return !!e && (t = e.current ? e.current.opts : e.opts, "" !== (i = t.hash || (t.$orig ? t.$orig.data("fancybox") : "")) && i)
    }

    i.escapeSelector || (i.escapeSelector = function (e) {
        return (e + "").replace(/([\0-\x1f\x7f]|^-?\d)|^-$|[^\x80-\uFFFF\w-]/g, function (e, t) {
            return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
        })
    }), i(function () {
        !1 !== i.fancybox.defaults.hash && (i(e).on({
            "onInit.fb": function (e, t) {
                var i, s;
                !1 !== t.group[t.currIndex].opts.hash && (i = n(), (s = o(t)) && i.gallery && s == i.gallery && (t.currIndex = i.index - 1))
            }, "beforeShow.fb": function (i, n, s, r) {
                var a;
                s && !1 !== s.opts.hash && (a = o(n)) && (n.currentHash = a + (n.group.length > 1 ? "-" + (s.index + 1) : ""), t.location.hash !== "#" + n.currentHash && (n.origHash || (n.origHash = t.location.hash), n.hashTimer && clearTimeout(n.hashTimer), n.hashTimer = setTimeout(function () {
                    "replaceState" in t.history ? (t.history[r ? "pushState" : "replaceState"]({}, e.title, t.location.pathname + t.location.search + "#" + n.currentHash), r && (n.hasCreatedHistory = !0)) : t.location.hash = n.currentHash, n.hashTimer = null
                }, 300)))
            }, "beforeClose.fb": function (i, n, s) {
                !1 !== s.opts.hash && (o(n), n.currentHash && n.hasCreatedHistory ? t.history.back() : n.currentHash && ("replaceState" in t.history ? t.history.replaceState({}, e.title, t.location.pathname + t.location.search + (n.origHash || "")) : t.location.hash = n.origHash), n.currentHash = null, clearTimeout(n.hashTimer))
            }
        }), i(t).on("hashchange.fb", function () {
            var e, t = n();
            i.each(i(".fancybox-container").get().reverse(), function (t, n) {
                var s = i(n).data("FancyBox");
                if (s.currentHash) return e = s, !1
            }), e ? !e.currentHash || e.currentHash === t.gallery + "-" + t.index || 1 === t.index && e.currentHash == t.gallery || (e.currentHash = null, e.close()) : "" !== t.gallery && s(t)
        }), setTimeout(function () {
            i.fancybox.getInstance() || s(n())
        }, 50))
    })
}(document, window, window.jQuery || jQuery), function (e, t) {
    "use strict";
    var i = (new Date).getTime();
    t(e).on({
        "onInit.fb": function (e, t, n) {
            t.$refs.stage.on("mousewheel DOMMouseScroll wheel MozMousePixelScroll", function (e) {
                var n = t.current, s = (new Date).getTime();
                t.group.length < 2 || !1 === n.opts.wheel || "auto" === n.opts.wheel && "image" !== n.type || (e.preventDefault(), e.stopPropagation(), n.$slide.hasClass("fancybox-animated") || (e = e.originalEvent || e, s - i < 250 || (i = s, t[(-e.deltaY || -e.deltaX || e.wheelDelta || -e.detail) < 0 ? "next" : "previous"]())))
            })
        }
    })
}(document, window.jQuery || jQuery), function (e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : "undefined" != typeof exports ? module.exports = e(require("jquery")) : e(jQuery)
}(function (e) {
    "use strict";
    var t = window.Slick || {};
    t = function () {
        function t(t, n) {
            var s, o = this;
            o.defaults = {
                accessibility: !0,
                adaptiveHeight: !1,
                appendArrows: e(t),
                appendDots: e(t),
                arrows: !0,
                asNavFor: null,
                prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
                nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
                autoplay: !1,
                autoplaySpeed: 3e3,
                centerMode: !1,
                centerPadding: "50px",
                cssEase: "ease",
                customPaging: function (t, i) {
                    return e('<button type="button" />').text(i + 1)
                },
                dots: !1,
                dotsClass: "slick-dots",
                draggable: !0,
                easing: "linear",
                edgeFriction: .35,
                fade: !1,
                focusOnSelect: !1,
                focusOnChange: !1,
                infinite: !0,
                initialSlide: 0,
                lazyLoad: "ondemand",
                mobileFirst: !1,
                pauseOnHover: !0,
                pauseOnFocus: !0,
                pauseOnDotsHover: !1,
                respondTo: "window",
                responsive: null,
                rows: 1,
                rtl: !1,
                slide: "",
                slidesPerRow: 1,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                swipe: !0,
                swipeToSlide: !1,
                touchMove: !0,
                touchThreshold: 5,
                useCSS: !0,
                useTransform: !0,
                variableWidth: !1,
                vertical: !1,
                verticalSwiping: !1,
                waitForAnimate: !0,
                zIndex: 1e3
            }, o.initials = {
                animating: !1,
                dragging: !1,
                autoPlayTimer: null,
                currentDirection: 0,
                currentLeft: null,
                currentSlide: 0,
                direction: 1,
                $dots: null,
                listWidth: null,
                listHeight: null,
                loadIndex: 0,
                $nextArrow: null,
                $prevArrow: null,
                scrolling: !1,
                slideCount: null,
                slideWidth: null,
                $slideTrack: null,
                $slides: null,
                sliding: !1,
                slideOffset: 0,
                swipeLeft: null,
                swiping: !1,
                $list: null,
                touchObject: {},
                transformsEnabled: !1,
                unslicked: !1
            }, e.extend(o, o.initials), o.activeBreakpoint = null, o.animType = null, o.animProp = null, o.breakpoints = [], o.breakpointSettings = [], o.cssTransitions = !1, o.focussed = !1, o.interrupted = !1, o.hidden = "hidden", o.paused = !0, o.positionProp = null, o.respondTo = null, o.rowCount = 1, o.shouldClick = !0, o.$slider = e(t), o.$slidesCache = null, o.transformType = null, o.transitionType = null, o.visibilityChange = "visibilitychange", o.windowWidth = 0, o.windowTimer = null, s = e(t).data("slick") || {}, o.options = e.extend({}, o.defaults, n, s), o.currentSlide = o.options.initialSlide, o.originalSettings = o.options, void 0 !== document.mozHidden ? (o.hidden = "mozHidden", o.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (o.hidden = "webkitHidden", o.visibilityChange = "webkitvisibilitychange"), o.autoPlay = e.proxy(o.autoPlay, o), o.autoPlayClear = e.proxy(o.autoPlayClear, o), o.autoPlayIterator = e.proxy(o.autoPlayIterator, o), o.changeSlide = e.proxy(o.changeSlide, o), o.clickHandler = e.proxy(o.clickHandler, o), o.selectHandler = e.proxy(o.selectHandler, o), o.setPosition = e.proxy(o.setPosition, o), o.swipeHandler = e.proxy(o.swipeHandler, o), o.dragHandler = e.proxy(o.dragHandler, o), o.keyHandler = e.proxy(o.keyHandler, o), o.instanceUid = i++, o.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, o.registerBreakpoints(), o.init(!0)
        }

        var i = 0;
        return t
    }(), t.prototype.activateADA = function () {
        this.$slideTrack.find(".slick-active").attr({"aria-hidden": "false"}).find("a, input, button, select").attr({tabindex: "0"})
    }, t.prototype.addSlide = t.prototype.slickAdd = function (t, i, n) {
        var s = this;
        if ("boolean" == typeof i) n = i, i = null; else if (i < 0 || i >= s.slideCount) return !1;
        s.unload(), "number" == typeof i ? 0 === i && 0 === s.$slides.length ? e(t).appendTo(s.$slideTrack) : n ? e(t).insertBefore(s.$slides.eq(i)) : e(t).insertAfter(s.$slides.eq(i)) : !0 === n ? e(t).prependTo(s.$slideTrack) : e(t).appendTo(s.$slideTrack), s.$slides = s.$slideTrack.children(this.options.slide), s.$slideTrack.children(this.options.slide).detach(), s.$slideTrack.append(s.$slides), s.$slides.each(function (t, i) {
            e(i).attr("data-slick-index", t)
        }), s.$slidesCache = s.$slides, s.reinit()
    }, t.prototype.animateHeight = function () {
        var e = this;
        if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
            var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
            e.$list.animate({height: t}, e.options.speed)
        }
    }, t.prototype.animateSlide = function (t, i) {
        var n = {}, s = this;
        s.animateHeight(), !0 === s.options.rtl && !1 === s.options.vertical && (t = -t), !1 === s.transformsEnabled ? !1 === s.options.vertical ? s.$slideTrack.animate({left: t}, s.options.speed, s.options.easing, i) : s.$slideTrack.animate({top: t}, s.options.speed, s.options.easing, i) : !1 === s.cssTransitions ? (!0 === s.options.rtl && (s.currentLeft = -s.currentLeft), e({animStart: s.currentLeft}).animate({animStart: t}, {
            duration: s.options.speed,
            easing: s.options.easing,
            step: function (e) {
                e = Math.ceil(e), !1 === s.options.vertical ? (n[s.animType] = "translate(" + e + "px, 0px)", s.$slideTrack.css(n)) : (n[s.animType] = "translate(0px," + e + "px)", s.$slideTrack.css(n))
            },
            complete: function () {
                i && i.call()
            }
        })) : (s.applyTransition(), t = Math.ceil(t), !1 === s.options.vertical ? n[s.animType] = "translate3d(" + t + "px, 0px, 0px)" : n[s.animType] = "translate3d(0px," + t + "px, 0px)", s.$slideTrack.css(n), i && setTimeout(function () {
            s.disableTransition(), i.call()
        }, s.options.speed))
    }, t.prototype.getNavTarget = function () {
        var t = this, i = t.options.asNavFor;
        return i && null !== i && (i = e(i).not(t.$slider)), i
    }, t.prototype.asNavFor = function (t) {
        var i = this, n = i.getNavTarget();
        null !== n && "object" == typeof n && n.each(function () {
            var i = e(this).slick("getSlick");
            i.unslicked || i.slideHandler(t, !0)
        })
    }, t.prototype.applyTransition = function (e) {
        var t = this, i = {};
        !1 === t.options.fade ? i[t.transitionType] = t.transformType + " " + t.options.speed + "ms " + t.options.cssEase : i[t.transitionType] = "opacity " + t.options.speed + "ms " + t.options.cssEase, !1 === t.options.fade ? t.$slideTrack.css(i) : t.$slides.eq(e).css(i)
    }, t.prototype.autoPlay = function () {
        var e = this;
        e.autoPlayClear(), e.slideCount > e.options.slidesToShow && (e.autoPlayTimer = setInterval(e.autoPlayIterator, e.options.autoplaySpeed))
    }, t.prototype.autoPlayClear = function () {
        var e = this;
        e.autoPlayTimer && clearInterval(e.autoPlayTimer)
    }, t.prototype.autoPlayIterator = function () {
        var e = this, t = e.currentSlide + e.options.slidesToScroll;
        e.paused || e.interrupted || e.focussed || (!1 === e.options.infinite && (1 === e.direction && e.currentSlide + 1 === e.slideCount - 1 ? e.direction = 0 : 0 === e.direction && (t = e.currentSlide - e.options.slidesToScroll, e.currentSlide - 1 == 0 && (e.direction = 1))), e.slideHandler(t))
    }, t.prototype.buildArrows = function () {
        var t = this;
        !0 === t.options.arrows && (t.$prevArrow = e(t.options.prevArrow).addClass("slick-arrow"), t.$nextArrow = e(t.options.nextArrow).addClass("slick-arrow"), t.slideCount > t.options.slidesToShow ? (t.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), t.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.prependTo(t.options.appendArrows), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.appendTo(t.options.appendArrows), !0 !== t.options.infinite && t.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : t.$prevArrow.add(t.$nextArrow).addClass("slick-hidden").attr({
            "aria-disabled": "true",
            tabindex: "-1"
        }))
    }, t.prototype.buildDots = function () {
        var t, i, n = this;
        if (!0 === n.options.dots) {
            for (n.$slider.addClass("slick-dotted"), i = e("<ul />").addClass(n.options.dotsClass), t = 0; t <= n.getDotCount(); t += 1) i.append(e("<li />").append(n.options.customPaging.call(this, n, t)));
            n.$dots = i.appendTo(n.options.appendDots), n.$dots.find("li").first().addClass("slick-active")
        }
    }, t.prototype.buildOut = function () {
        var t = this;
        t.$slides = t.$slider.children(t.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), t.slideCount = t.$slides.length, t.$slides.each(function (t, i) {
            e(i).attr("data-slick-index", t).data("originalStyling", e(i).attr("style") || "")
        }), t.$slider.addClass("slick-slider"), t.$slideTrack = 0 === t.slideCount ? e('<div class="slick-track"/>').appendTo(t.$slider) : t.$slides.wrapAll('<div class="slick-track"/>').parent(), t.$list = t.$slideTrack.wrap('<div class="slick-list"/>').parent(), t.$slideTrack.css("opacity", 0), !0 !== t.options.centerMode && !0 !== t.options.swipeToSlide || (t.options.slidesToScroll = 1), e("img[data-lazy]", t.$slider).not("[src]").addClass("slick-loading"), t.setupInfinite(), t.buildArrows(), t.buildDots(), t.updateDots(), t.setSlideClasses("number" == typeof t.currentSlide ? t.currentSlide : 0), !0 === t.options.draggable && t.$list.addClass("draggable")
    }, t.prototype.buildRows = function () {
        var e, t, i, n, s, o, r, a = this;
        if (n = document.createDocumentFragment(), o = a.$slider.children(), a.options.rows > 1) {
            for (r = a.options.slidesPerRow * a.options.rows, s = Math.ceil(o.length / r), e = 0; e < s; e++) {
                var l = document.createElement("div");
                for (t = 0; t < a.options.rows; t++) {
                    var c = document.createElement("div");
                    for (i = 0; i < a.options.slidesPerRow; i++) {
                        var u = e * r + (t * a.options.slidesPerRow + i);
                        o.get(u) && c.appendChild(o.get(u))
                    }
                    l.appendChild(c)
                }
                n.appendChild(l)
            }
            a.$slider.empty().append(n), a.$slider.children().children().children().css({
                width: 100 / a.options.slidesPerRow + "%",
                display: "inline-block"
            })
        }
    }, t.prototype.checkResponsive = function (t, i) {
        var n, s, o, r = this, a = !1, l = r.$slider.width(), c = window.innerWidth || e(window).width();
        if ("window" === r.respondTo ? o = c : "slider" === r.respondTo ? o = l : "min" === r.respondTo && (o = Math.min(c, l)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
            s = null;
            for (n in r.breakpoints) r.breakpoints.hasOwnProperty(n) && (!1 === r.originalSettings.mobileFirst ? o < r.breakpoints[n] && (s = r.breakpoints[n]) : o > r.breakpoints[n] && (s = r.breakpoints[n]));
            null !== s ? null !== r.activeBreakpoint ? (s !== r.activeBreakpoint || i) && (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = e.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t)), a = s) : (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = e.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t)), a = s) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t), a = s), t || !1 === a || r.$slider.trigger("breakpoint", [r, a])
        }
    }, t.prototype.changeSlide = function (t, i) {
        var n, s, o, r = this, a = e(t.currentTarget);
        switch (a.is("a") && t.preventDefault(), a.is("li") || (a = a.closest("li")), o = r.slideCount % r.options.slidesToScroll != 0, n = o ? 0 : (r.slideCount - r.currentSlide) % r.options.slidesToScroll, t.data.message) {
            case"previous":
                s = 0 === n ? r.options.slidesToScroll : r.options.slidesToShow - n, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide - s, !1, i);
                break;
            case"next":
                s = 0 === n ? r.options.slidesToScroll : n, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide + s, !1, i);
                break;
            case"index":
                var l = 0 === t.data.index ? 0 : t.data.index || a.index() * r.options.slidesToScroll;
                r.slideHandler(r.checkNavigable(l), !1, i), a.children().trigger("focus");
                break;
            default:
                return
        }
    }, t.prototype.checkNavigable = function (e) {
        var t, i, n = this;
        if (t = n.getNavigableIndexes(), i = 0, e > t[t.length - 1]) e = t[t.length - 1]; else for (var s in t) {
            if (e < t[s]) {
                e = i;
                break
            }
            i = t[s]
        }
        return e
    }, t.prototype.cleanUpEvents = function () {
        var t = this;
        t.options.dots && null !== t.$dots && (e("li", t.$dots).off("click.slick", t.changeSlide).off("mouseenter.slick", e.proxy(t.interrupt, t, !0)).off("mouseleave.slick", e.proxy(t.interrupt, t, !1)), !0 === t.options.accessibility && t.$dots.off("keydown.slick", t.keyHandler)), t.$slider.off("focus.slick blur.slick"), !0 === t.options.arrows && t.slideCount > t.options.slidesToShow && (t.$prevArrow && t.$prevArrow.off("click.slick", t.changeSlide), t.$nextArrow && t.$nextArrow.off("click.slick", t.changeSlide), !0 === t.options.accessibility && (t.$prevArrow && t.$prevArrow.off("keydown.slick", t.keyHandler), t.$nextArrow && t.$nextArrow.off("keydown.slick", t.keyHandler))), t.$list.off("touchstart.slick mousedown.slick", t.swipeHandler), t.$list.off("touchmove.slick mousemove.slick", t.swipeHandler), t.$list.off("touchend.slick mouseup.slick", t.swipeHandler), t.$list.off("touchcancel.slick mouseleave.slick", t.swipeHandler), t.$list.off("click.slick", t.clickHandler), e(document).off(t.visibilityChange, t.visibility), t.cleanUpSlideEvents(), !0 === t.options.accessibility && t.$list.off("keydown.slick", t.keyHandler), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().off("click.slick", t.selectHandler), e(window).off("orientationchange.slick.slick-" + t.instanceUid, t.orientationChange), e(window).off("resize.slick.slick-" + t.instanceUid, t.resize), e("[draggable!=true]", t.$slideTrack).off("dragstart", t.preventDefault), e(window).off("load.slick.slick-" + t.instanceUid, t.setPosition)
    }, t.prototype.cleanUpSlideEvents = function () {
        var t = this;
        t.$list.off("mouseenter.slick", e.proxy(t.interrupt, t, !0)), t.$list.off("mouseleave.slick", e.proxy(t.interrupt, t, !1))
    }, t.prototype.cleanUpRows = function () {
        var e, t = this;
        t.options.rows > 1 && (e = t.$slides.children().children(), e.removeAttr("style"), t.$slider.empty().append(e))
    }, t.prototype.clickHandler = function (e) {
        !1 === this.shouldClick && (e.stopImmediatePropagation(), e.stopPropagation(), e.preventDefault())
    }, t.prototype.destroy = function (t) {
        var i = this;
        i.autoPlayClear(), i.touchObject = {}, i.cleanUpEvents(), e(".slick-cloned", i.$slider).detach(), i.$dots && i.$dots.remove(), i.$prevArrow && i.$prevArrow.length && (i.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.prevArrow) && i.$prevArrow.remove()), i.$nextArrow && i.$nextArrow.length && (i.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.nextArrow) && i.$nextArrow.remove()), i.$slides && (i.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function () {
            e(this).attr("style", e(this).data("originalStyling"))
        }), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.detach(), i.$list.detach(), i.$slider.append(i.$slides)), i.cleanUpRows(), i.$slider.removeClass("slick-slider"), i.$slider.removeClass("slick-initialized"), i.$slider.removeClass("slick-dotted"), i.unslicked = !0, t || i.$slider.trigger("destroy", [i])
    }, t.prototype.disableTransition = function (e) {
        var t = this, i = {};
        i[t.transitionType] = "", !1 === t.options.fade ? t.$slideTrack.css(i) : t.$slides.eq(e).css(i)
    }, t.prototype.fadeSlide = function (e, t) {
        var i = this;
        !1 === i.cssTransitions ? (i.$slides.eq(e).css({zIndex: i.options.zIndex}), i.$slides.eq(e).animate({opacity: 1}, i.options.speed, i.options.easing, t)) : (i.applyTransition(e), i.$slides.eq(e).css({
            opacity: 1,
            zIndex: i.options.zIndex
        }), t && setTimeout(function () {
            i.disableTransition(e), t.call()
        }, i.options.speed))
    }, t.prototype.fadeSlideOut = function (e) {
        var t = this;
        !1 === t.cssTransitions ? t.$slides.eq(e).animate({
            opacity: 0,
            zIndex: t.options.zIndex - 2
        }, t.options.speed, t.options.easing) : (t.applyTransition(e), t.$slides.eq(e).css({
            opacity: 0,
            zIndex: t.options.zIndex - 2
        }))
    }, t.prototype.filterSlides = t.prototype.slickFilter = function (e) {
        var t = this;
        null !== e && (t.$slidesCache = t.$slides, t.unload(), t.$slideTrack.children(this.options.slide).detach(), t.$slidesCache.filter(e).appendTo(t.$slideTrack), t.reinit())
    }, t.prototype.focusHandler = function () {
        var t = this;
        t.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function (i) {
            i.stopImmediatePropagation();
            var n = e(this);
            setTimeout(function () {
                t.options.pauseOnFocus && (t.focussed = n.is(":focus"), t.autoPlay())
            }, 0)
        })
    }, t.prototype.getCurrent = t.prototype.slickCurrentSlide = function () {
        return this.currentSlide
    }, t.prototype.getDotCount = function () {
        var e = this, t = 0, i = 0, n = 0;
        if (!0 === e.options.infinite) if (e.slideCount <= e.options.slidesToShow) ++n; else for (; t < e.slideCount;) ++n, t = i + e.options.slidesToScroll, i += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow; else if (!0 === e.options.centerMode) n = e.slideCount; else if (e.options.asNavFor) for (; t < e.slideCount;) ++n, t = i + e.options.slidesToScroll, i += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow; else n = 1 + Math.ceil((e.slideCount - e.options.slidesToShow) / e.options.slidesToScroll);
        return n - 1
    }, t.prototype.getLeft = function (e) {
        var t, i, n, s, o = this, r = 0;
        return o.slideOffset = 0, i = o.$slides.first().outerHeight(!0), !0 === o.options.infinite ? (o.slideCount > o.options.slidesToShow && (o.slideOffset = o.slideWidth * o.options.slidesToShow * -1, s = -1, !0 === o.options.vertical && !0 === o.options.centerMode && (2 === o.options.slidesToShow ? s = -1.5 : 1 === o.options.slidesToShow && (s = -2)), r = i * o.options.slidesToShow * s),
        o.slideCount % o.options.slidesToScroll != 0 && e + o.options.slidesToScroll > o.slideCount && o.slideCount > o.options.slidesToShow && (e > o.slideCount ? (o.slideOffset = (o.options.slidesToShow - (e - o.slideCount)) * o.slideWidth * -1, r = (o.options.slidesToShow - (e - o.slideCount)) * i * -1) : (o.slideOffset = o.slideCount % o.options.slidesToScroll * o.slideWidth * -1, r = o.slideCount % o.options.slidesToScroll * i * -1))) : e + o.options.slidesToShow > o.slideCount && (o.slideOffset = (e + o.options.slidesToShow - o.slideCount) * o.slideWidth, r = (e + o.options.slidesToShow - o.slideCount) * i), o.slideCount <= o.options.slidesToShow && (o.slideOffset = 0, r = 0), !0 === o.options.centerMode && o.slideCount <= o.options.slidesToShow ? o.slideOffset = o.slideWidth * Math.floor(o.options.slidesToShow) / 2 - o.slideWidth * o.slideCount / 2 : !0 === o.options.centerMode && !0 === o.options.infinite ? o.slideOffset += o.slideWidth * Math.floor(o.options.slidesToShow / 2) - o.slideWidth : !0 === o.options.centerMode && (o.slideOffset = 0, o.slideOffset += o.slideWidth * Math.floor(o.options.slidesToShow / 2)), t = !1 === o.options.vertical ? e * o.slideWidth * -1 + o.slideOffset : e * i * -1 + r, !0 === o.options.variableWidth && (n = o.slideCount <= o.options.slidesToShow || !1 === o.options.infinite ? o.$slideTrack.children(".slick-slide").eq(e) : o.$slideTrack.children(".slick-slide").eq(e + o.options.slidesToShow), t = !0 === o.options.rtl ? n[0] ? -1 * (o.$slideTrack.width() - n[0].offsetLeft - n.width()) : 0 : n[0] ? -1 * n[0].offsetLeft : 0, !0 === o.options.centerMode && (n = o.slideCount <= o.options.slidesToShow || !1 === o.options.infinite ? o.$slideTrack.children(".slick-slide").eq(e) : o.$slideTrack.children(".slick-slide").eq(e + o.options.slidesToShow + 1), t = !0 === o.options.rtl ? n[0] ? -1 * (o.$slideTrack.width() - n[0].offsetLeft - n.width()) : 0 : n[0] ? -1 * n[0].offsetLeft : 0, t += (o.$list.width() - n.outerWidth()) / 2)), t
    }, t.prototype.getOption = t.prototype.slickGetOption = function (e) {
        return this.options[e]
    }, t.prototype.getNavigableIndexes = function () {
        var e, t = this, i = 0, n = 0, s = [];
        for (!1 === t.options.infinite ? e = t.slideCount : (i = -1 * t.options.slidesToScroll, n = -1 * t.options.slidesToScroll, e = 2 * t.slideCount); i < e;) s.push(i), i = n + t.options.slidesToScroll, n += t.options.slidesToScroll <= t.options.slidesToShow ? t.options.slidesToScroll : t.options.slidesToShow;
        return s
    }, t.prototype.getSlick = function () {
        return this
    }, t.prototype.getSlideCount = function () {
        var t, i, n = this;
        return i = !0 === n.options.centerMode ? n.slideWidth * Math.floor(n.options.slidesToShow / 2) : 0, !0 === n.options.swipeToSlide ? (n.$slideTrack.find(".slick-slide").each(function (s, o) {
            if (o.offsetLeft - i + e(o).outerWidth() / 2 > -1 * n.swipeLeft) return t = o, !1
        }), Math.abs(e(t).attr("data-slick-index") - n.currentSlide) || 1) : n.options.slidesToScroll
    }, t.prototype.goTo = t.prototype.slickGoTo = function (e, t) {
        this.changeSlide({data: {message: "index", index: parseInt(e)}}, t)
    }, t.prototype.init = function (t) {
        var i = this;
        e(i.$slider).hasClass("slick-initialized") || (e(i.$slider).addClass("slick-initialized"), i.buildRows(), i.buildOut(), i.setProps(), i.startLoad(), i.loadSlider(), i.initializeEvents(), i.updateArrows(), i.updateDots(), i.checkResponsive(!0), i.focusHandler()), t && i.$slider.trigger("init", [i]), !0 === i.options.accessibility && i.initADA(), i.options.autoplay && (i.paused = !1, i.autoPlay())
    }, t.prototype.initADA = function () {
        var t = this, i = Math.ceil(t.slideCount / t.options.slidesToShow),
            n = t.getNavigableIndexes().filter(function (e) {
                return e >= 0 && e < t.slideCount
            });
        t.$slides.add(t.$slideTrack.find(".slick-cloned")).attr({
            "aria-hidden": "true",
            tabindex: "-1"
        }).find("a, input, button, select").attr({tabindex: "-1"}), null !== t.$dots && (t.$slides.not(t.$slideTrack.find(".slick-cloned")).each(function (i) {
            var s = n.indexOf(i);
            e(this).attr({
                role: "tabpanel",
                id: "slick-slide" + t.instanceUid + i,
                tabindex: -1
            }), -1 !== s && e(this).attr({"aria-describedby": "slick-slide-control" + t.instanceUid + s})
        }), t.$dots.attr("role", "tablist").find("li").each(function (s) {
            var o = n[s];
            e(this).attr({role: "presentation"}), e(this).find("button").first().attr({
                role: "tab",
                id: "slick-slide-control" + t.instanceUid + s,
                "aria-controls": "slick-slide" + t.instanceUid + o,
                "aria-label": s + 1 + " of " + i,
                "aria-selected": null,
                tabindex: "-1"
            })
        }).eq(t.currentSlide).find("button").attr({"aria-selected": "true", tabindex: "0"}).end());
        for (var s = t.currentSlide, o = s + t.options.slidesToShow; s < o; s++) t.$slides.eq(s).attr("tabindex", 0);
        t.activateADA()
    }, t.prototype.initArrowEvents = function () {
        var e = this;
        !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.off("click.slick").on("click.slick", {message: "previous"}, e.changeSlide), e.$nextArrow.off("click.slick").on("click.slick", {message: "next"}, e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow.on("keydown.slick", e.keyHandler), e.$nextArrow.on("keydown.slick", e.keyHandler)))
    }, t.prototype.initDotEvents = function () {
        var t = this;
        !0 === t.options.dots && (e("li", t.$dots).on("click.slick", {message: "index"}, t.changeSlide), !0 === t.options.accessibility && t.$dots.on("keydown.slick", t.keyHandler)), !0 === t.options.dots && !0 === t.options.pauseOnDotsHover && e("li", t.$dots).on("mouseenter.slick", e.proxy(t.interrupt, t, !0)).on("mouseleave.slick", e.proxy(t.interrupt, t, !1))
    }, t.prototype.initSlideEvents = function () {
        var t = this;
        t.options.pauseOnHover && (t.$list.on("mouseenter.slick", e.proxy(t.interrupt, t, !0)), t.$list.on("mouseleave.slick", e.proxy(t.interrupt, t, !1)))
    }, t.prototype.initializeEvents = function () {
        var t = this;
        t.initArrowEvents(), t.initDotEvents(), t.initSlideEvents(), t.$list.on("touchstart.slick mousedown.slick", {action: "start"}, t.swipeHandler), t.$list.on("touchmove.slick mousemove.slick", {action: "move"}, t.swipeHandler), t.$list.on("touchend.slick mouseup.slick", {action: "end"}, t.swipeHandler), t.$list.on("touchcancel.slick mouseleave.slick", {action: "end"}, t.swipeHandler), t.$list.on("click.slick", t.clickHandler), e(document).on(t.visibilityChange, e.proxy(t.visibility, t)), !0 === t.options.accessibility && t.$list.on("keydown.slick", t.keyHandler), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().on("click.slick", t.selectHandler), e(window).on("orientationchange.slick.slick-" + t.instanceUid, e.proxy(t.orientationChange, t)), e(window).on("resize.slick.slick-" + t.instanceUid, e.proxy(t.resize, t)), e("[draggable!=true]", t.$slideTrack).on("dragstart", t.preventDefault), e(window).on("load.slick.slick-" + t.instanceUid, t.setPosition), e(t.setPosition)
    }, t.prototype.initUI = function () {
        var e = this;
        !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.show(), e.$nextArrow.show()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.show()
    }, t.prototype.keyHandler = function (e) {
        var t = this;
        e.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === e.keyCode && !0 === t.options.accessibility ? t.changeSlide({data: {message: !0 === t.options.rtl ? "next" : "previous"}}) : 39 === e.keyCode && !0 === t.options.accessibility && t.changeSlide({data: {message: !0 === t.options.rtl ? "previous" : "next"}}))
    }, t.prototype.lazyLoad = function () {
        function t(t) {
            e("img[data-lazy]", t).each(function () {
                var t = e(this), i = e(this).attr("data-lazy"), n = e(this).attr("data-srcset"),
                    s = e(this).attr("data-sizes") || r.$slider.attr("data-sizes"), o = document.createElement("img");
                o.onload = function () {
                    t.animate({opacity: 0}, 100, function () {
                        n && (t.attr("srcset", n), s && t.attr("sizes", s)), t.attr("src", i).animate({opacity: 1}, 200, function () {
                            t.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
                        }), r.$slider.trigger("lazyLoaded", [r, t, i])
                    })
                }, o.onerror = function () {
                    t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), r.$slider.trigger("lazyLoadError", [r, t, i])
                }, o.src = i
            })
        }

        var i, n, s, o, r = this;
        if (!0 === r.options.centerMode ? !0 === r.options.infinite ? (s = r.currentSlide + (r.options.slidesToShow / 2 + 1), o = s + r.options.slidesToShow + 2) : (s = Math.max(0, r.currentSlide - (r.options.slidesToShow / 2 + 1)), o = r.options.slidesToShow / 2 + 1 + 2 + r.currentSlide) : (s = r.options.infinite ? r.options.slidesToShow + r.currentSlide : r.currentSlide, o = Math.ceil(s + r.options.slidesToShow), !0 === r.options.fade && (s > 0 && s--, o <= r.slideCount && o++)), i = r.$slider.find(".slick-slide").slice(s, o), "anticipated" === r.options.lazyLoad) for (var a = s - 1, l = o, c = r.$slider.find(".slick-slide"), u = 0; u < r.options.slidesToScroll; u++) a < 0 && (a = r.slideCount - 1), i = i.add(c.eq(a)), i = i.add(c.eq(l)), a--, l++;
        t(i), r.slideCount <= r.options.slidesToShow ? (n = r.$slider.find(".slick-slide"), t(n)) : r.currentSlide >= r.slideCount - r.options.slidesToShow ? (n = r.$slider.find(".slick-cloned").slice(0, r.options.slidesToShow), t(n)) : 0 === r.currentSlide && (n = r.$slider.find(".slick-cloned").slice(-1 * r.options.slidesToShow), t(n))
    }, t.prototype.loadSlider = function () {
        var e = this;
        e.setPosition(), e.$slideTrack.css({opacity: 1}), e.$slider.removeClass("slick-loading"), e.initUI(), "progressive" === e.options.lazyLoad && e.progressiveLazyLoad()
    }, t.prototype.next = t.prototype.slickNext = function () {
        this.changeSlide({data: {message: "next"}})
    }, t.prototype.orientationChange = function () {
        var e = this;
        e.checkResponsive(), e.setPosition()
    }, t.prototype.pause = t.prototype.slickPause = function () {
        var e = this;
        e.autoPlayClear(), e.paused = !0
    }, t.prototype.play = t.prototype.slickPlay = function () {
        var e = this;
        e.autoPlay(), e.options.autoplay = !0, e.paused = !1, e.focussed = !1, e.interrupted = !1
    }, t.prototype.postSlide = function (t) {
        var i = this;
        if (!i.unslicked && (i.$slider.trigger("afterChange", [i, t]), i.animating = !1, i.slideCount > i.options.slidesToShow && i.setPosition(), i.swipeLeft = null, i.options.autoplay && i.autoPlay(), !0 === i.options.accessibility && (i.initADA(), i.options.focusOnChange))) {
            e(i.$slides.get(i.currentSlide)).attr("tabindex", 0).focus()
        }
    }, t.prototype.prev = t.prototype.slickPrev = function () {
        this.changeSlide({data: {message: "previous"}})
    }, t.prototype.preventDefault = function (e) {
        e.preventDefault()
    }, t.prototype.progressiveLazyLoad = function (t) {
        t = t || 1;
        var i, n, s, o, r, a = this, l = e("img[data-lazy]", a.$slider);
        l.length ? (i = l.first(), n = i.attr("data-lazy"), s = i.attr("data-srcset"), o = i.attr("data-sizes") || a.$slider.attr("data-sizes"), r = document.createElement("img"), r.onload = function () {
            s && (i.attr("srcset", s), o && i.attr("sizes", o)), i.attr("src", n).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === a.options.adaptiveHeight && a.setPosition(), a.$slider.trigger("lazyLoaded", [a, i, n]), a.progressiveLazyLoad()
        }, r.onerror = function () {
            t < 3 ? setTimeout(function () {
                a.progressiveLazyLoad(t + 1)
            }, 500) : (i.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), a.$slider.trigger("lazyLoadError", [a, i, n]), a.progressiveLazyLoad())
        }, r.src = n) : a.$slider.trigger("allImagesLoaded", [a])
    }, t.prototype.refresh = function (t) {
        var i, n, s = this;
        n = s.slideCount - s.options.slidesToShow, !s.options.infinite && s.currentSlide > n && (s.currentSlide = n), s.slideCount <= s.options.slidesToShow && (s.currentSlide = 0), i = s.currentSlide, s.destroy(!0), e.extend(s, s.initials, {currentSlide: i}), s.init(), t || s.changeSlide({
            data: {
                message: "index",
                index: i
            }
        }, !1)
    }, t.prototype.registerBreakpoints = function () {
        var t, i, n, s = this, o = s.options.responsive || null;
        if ("array" === e.type(o) && o.length) {
            s.respondTo = s.options.respondTo || "window";
            for (t in o) if (n = s.breakpoints.length - 1, o.hasOwnProperty(t)) {
                for (i = o[t].breakpoint; n >= 0;) s.breakpoints[n] && s.breakpoints[n] === i && s.breakpoints.splice(n, 1), n--;
                s.breakpoints.push(i), s.breakpointSettings[i] = o[t].settings
            }
            s.breakpoints.sort(function (e, t) {
                return s.options.mobileFirst ? e - t : t - e
            })
        }
    }, t.prototype.reinit = function () {
        var t = this;
        t.$slides = t.$slideTrack.children(t.options.slide).addClass("slick-slide"), t.slideCount = t.$slides.length, t.currentSlide >= t.slideCount && 0 !== t.currentSlide && (t.currentSlide = t.currentSlide - t.options.slidesToScroll), t.slideCount <= t.options.slidesToShow && (t.currentSlide = 0), t.registerBreakpoints(), t.setProps(), t.setupInfinite(), t.buildArrows(), t.updateArrows(), t.initArrowEvents(), t.buildDots(), t.updateDots(), t.initDotEvents(), t.cleanUpSlideEvents(), t.initSlideEvents(), t.checkResponsive(!1, !0), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().on("click.slick", t.selectHandler), t.setSlideClasses("number" == typeof t.currentSlide ? t.currentSlide : 0), t.setPosition(), t.focusHandler(), t.paused = !t.options.autoplay, t.autoPlay(), t.$slider.trigger("reInit", [t])
    }, t.prototype.resize = function () {
        var t = this;
        e(window).width() !== t.windowWidth && (clearTimeout(t.windowDelay), t.windowDelay = window.setTimeout(function () {
            t.windowWidth = e(window).width(), t.checkResponsive(), t.unslicked || t.setPosition()
        }, 50))
    }, t.prototype.removeSlide = t.prototype.slickRemove = function (e, t, i) {
        var n = this;
        if ("boolean" == typeof e ? (t = e, e = !0 === t ? 0 : n.slideCount - 1) : e = !0 === t ? --e : e, n.slideCount < 1 || e < 0 || e > n.slideCount - 1) return !1;
        n.unload(), !0 === i ? n.$slideTrack.children().remove() : n.$slideTrack.children(this.options.slide).eq(e).remove(), n.$slides = n.$slideTrack.children(this.options.slide), n.$slideTrack.children(this.options.slide).detach(), n.$slideTrack.append(n.$slides), n.$slidesCache = n.$slides, n.reinit()
    }, t.prototype.setCSS = function (e) {
        var t, i, n = this, s = {};
        !0 === n.options.rtl && (e = -e), t = "left" == n.positionProp ? Math.ceil(e) + "px" : "0px", i = "top" == n.positionProp ? Math.ceil(e) + "px" : "0px", s[n.positionProp] = e, !1 === n.transformsEnabled ? n.$slideTrack.css(s) : (s = {}, !1 === n.cssTransitions ? (s[n.animType] = "translate(" + t + ", " + i + ")", n.$slideTrack.css(s)) : (s[n.animType] = "translate3d(" + t + ", " + i + ", 0px)", n.$slideTrack.css(s)))
    }, t.prototype.setDimensions = function () {
        var e = this;
        !1 === e.options.vertical ? !0 === e.options.centerMode && e.$list.css({padding: "0px " + e.options.centerPadding}) : (e.$list.height(e.$slides.first().outerHeight(!0) * e.options.slidesToShow), !0 === e.options.centerMode && e.$list.css({padding: e.options.centerPadding + " 0px"})), e.listWidth = e.$list.width(), e.listHeight = e.$list.height(), !1 === e.options.vertical && !1 === e.options.variableWidth ? (e.slideWidth = Math.ceil(e.listWidth / e.options.slidesToShow), e.$slideTrack.width(Math.ceil(e.slideWidth * e.$slideTrack.children(".slick-slide").length))) : !0 === e.options.variableWidth ? e.$slideTrack.width(5e3 * e.slideCount) : (e.slideWidth = Math.ceil(e.listWidth), e.$slideTrack.height(Math.ceil(e.$slides.first().outerHeight(!0) * e.$slideTrack.children(".slick-slide").length)));
        var t = e.$slides.first().outerWidth(!0) - e.$slides.first().width();
        !1 === e.options.variableWidth && e.$slideTrack.children(".slick-slide").width(e.slideWidth - t)
    }, t.prototype.setFade = function () {
        var t, i = this;
        i.$slides.each(function (n, s) {
            t = i.slideWidth * n * -1, !0 === i.options.rtl ? e(s).css({
                position: "relative",
                right: t,
                top: 0,
                zIndex: i.options.zIndex - 2,
                opacity: 0
            }) : e(s).css({
                position: "relative",
                left: t,
                top: 0,
                zIndex: i.options.zIndex - 2,
                opacity: 0
            })
        }), i.$slides.eq(i.currentSlide).css({zIndex: i.options.zIndex - 1, opacity: 1})
    }, t.prototype.setHeight = function () {
        var e = this;
        if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
            var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
            e.$list.css("height", t)
        }
    }, t.prototype.setOption = t.prototype.slickSetOption = function () {
        var t, i, n, s, o, r = this, a = !1;
        if ("object" === e.type(arguments[0]) ? (n = arguments[0], a = arguments[1], o = "multiple") : "string" === e.type(arguments[0]) && (n = arguments[0], s = arguments[1], a = arguments[2], "responsive" === arguments[0] && "array" === e.type(arguments[1]) ? o = "responsive" : void 0 !== arguments[1] && (o = "single")), "single" === o) r.options[n] = s; else if ("multiple" === o) e.each(n, function (e, t) {
            r.options[e] = t
        }); else if ("responsive" === o) for (i in s) if ("array" !== e.type(r.options.responsive)) r.options.responsive = [s[i]]; else {
            for (t = r.options.responsive.length - 1; t >= 0;) r.options.responsive[t].breakpoint === s[i].breakpoint && r.options.responsive.splice(t, 1), t--;
            r.options.responsive.push(s[i])
        }
        a && (r.unload(), r.reinit())
    }, t.prototype.setPosition = function () {
        var e = this;
        e.setDimensions(), e.setHeight(), !1 === e.options.fade ? e.setCSS(e.getLeft(e.currentSlide)) : e.setFade(), e.$slider.trigger("setPosition", [e])
    }, t.prototype.setProps = function () {
        var e = this, t = document.body.style;
        e.positionProp = !0 === e.options.vertical ? "top" : "left", "top" === e.positionProp ? e.$slider.addClass("slick-vertical") : e.$slider.removeClass("slick-vertical"), void 0 === t.WebkitTransition && void 0 === t.MozTransition && void 0 === t.msTransition || !0 === e.options.useCSS && (e.cssTransitions = !0), e.options.fade && ("number" == typeof e.options.zIndex ? e.options.zIndex < 3 && (e.options.zIndex = 3) : e.options.zIndex = e.defaults.zIndex), void 0 !== t.OTransform && (e.animType = "OTransform", e.transformType = "-o-transform", e.transitionType = "OTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.MozTransform && (e.animType = "MozTransform", e.transformType = "-moz-transform", e.transitionType = "MozTransition", void 0 === t.perspectiveProperty && void 0 === t.MozPerspective && (e.animType = !1)), void 0 !== t.webkitTransform && (e.animType = "webkitTransform", e.transformType = "-webkit-transform", e.transitionType = "webkitTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.msTransform && (e.animType = "msTransform", e.transformType = "-ms-transform", e.transitionType = "msTransition", void 0 === t.msTransform && (e.animType = !1)), void 0 !== t.transform && !1 !== e.animType && (e.animType = "transform", e.transformType = "transform", e.transitionType = "transition"), e.transformsEnabled = e.options.useTransform && null !== e.animType && !1 !== e.animType
    }, t.prototype.setSlideClasses = function (e) {
        var t, i, n, s, o = this;
        if (i = o.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), o.$slides.eq(e).addClass("slick-current"), !0 === o.options.centerMode) {
            var r = o.options.slidesToShow % 2 == 0 ? 1 : 0;
            t = Math.floor(o.options.slidesToShow / 2), !0 === o.options.infinite && (e >= t && e <= o.slideCount - 1 - t ? o.$slides.slice(e - t + r, e + t + 1).addClass("slick-active").attr("aria-hidden", "false") : (n = o.options.slidesToShow + e, i.slice(n - t + 1 + r, n + t + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === e ? i.eq(i.length - 1 - o.options.slidesToShow).addClass("slick-center") : e === o.slideCount - 1 && i.eq(o.options.slidesToShow).addClass("slick-center")), o.$slides.eq(e).addClass("slick-center")
        } else e >= 0 && e <= o.slideCount - o.options.slidesToShow ? o.$slides.slice(e, e + o.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : i.length <= o.options.slidesToShow ? i.addClass("slick-active").attr("aria-hidden", "false") : (s = o.slideCount % o.options.slidesToShow, n = !0 === o.options.infinite ? o.options.slidesToShow + e : e, o.options.slidesToShow == o.options.slidesToScroll && o.slideCount - e < o.options.slidesToShow ? i.slice(n - (o.options.slidesToShow - s), n + s).addClass("slick-active").attr("aria-hidden", "false") : i.slice(n, n + o.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
        "ondemand" !== o.options.lazyLoad && "anticipated" !== o.options.lazyLoad || o.lazyLoad()
    }, t.prototype.setupInfinite = function () {
        var t, i, n, s = this;
        if (!0 === s.options.fade && (s.options.centerMode = !1), !0 === s.options.infinite && !1 === s.options.fade && (i = null, s.slideCount > s.options.slidesToShow)) {
            for (n = !0 === s.options.centerMode ? s.options.slidesToShow + 1 : s.options.slidesToShow, t = s.slideCount; t > s.slideCount - n; t -= 1) i = t - 1, e(s.$slides[i]).clone(!0).attr("id", "").attr("data-slick-index", i - s.slideCount).prependTo(s.$slideTrack).addClass("slick-cloned");
            for (t = 0; t < n + s.slideCount; t += 1) i = t, e(s.$slides[i]).clone(!0).attr("id", "").attr("data-slick-index", i + s.slideCount).appendTo(s.$slideTrack).addClass("slick-cloned");
            s.$slideTrack.find(".slick-cloned").find("[id]").each(function () {
                e(this).attr("id", "")
            })
        }
    }, t.prototype.interrupt = function (e) {
        var t = this;
        e || t.autoPlay(), t.interrupted = e
    }, t.prototype.selectHandler = function (t) {
        var i = this, n = e(t.target).is(".slick-slide") ? e(t.target) : e(t.target).parents(".slick-slide"),
            s = parseInt(n.attr("data-slick-index"));
        if (s || (s = 0), i.slideCount <= i.options.slidesToShow) return void i.slideHandler(s, !1, !0);
        i.slideHandler(s)
    }, t.prototype.slideHandler = function (e, t, i) {
        var n, s, o, r, a, l = null, c = this;
        if (t = t || !1, !(!0 === c.animating && !0 === c.options.waitForAnimate || !0 === c.options.fade && c.currentSlide === e)) {
            if (!1 === t && c.asNavFor(e), n = e, l = c.getLeft(n), r = c.getLeft(c.currentSlide), c.currentLeft = null === c.swipeLeft ? r : c.swipeLeft, !1 === c.options.infinite && !1 === c.options.centerMode && (e < 0 || e > c.getDotCount() * c.options.slidesToScroll)) return void(!1 === c.options.fade && (n = c.currentSlide, !0 !== i ? c.animateSlide(r, function () {
                c.postSlide(n)
            }) : c.postSlide(n)));
            if (!1 === c.options.infinite && !0 === c.options.centerMode && (e < 0 || e > c.slideCount - c.options.slidesToScroll)) return void(!1 === c.options.fade && (n = c.currentSlide, !0 !== i ? c.animateSlide(r, function () {
                c.postSlide(n)
            }) : c.postSlide(n)));
            if (c.options.autoplay && clearInterval(c.autoPlayTimer), s = n < 0 ? c.slideCount % c.options.slidesToScroll != 0 ? c.slideCount - c.slideCount % c.options.slidesToScroll : c.slideCount + n : n >= c.slideCount ? c.slideCount % c.options.slidesToScroll != 0 ? 0 : n - c.slideCount : n, c.animating = !0, c.$slider.trigger("beforeChange", [c, c.currentSlide, s]), o = c.currentSlide, c.currentSlide = s, c.setSlideClasses(c.currentSlide), c.options.asNavFor && (a = c.getNavTarget(), a = a.slick("getSlick"), a.slideCount <= a.options.slidesToShow && a.setSlideClasses(c.currentSlide)), c.updateDots(), c.updateArrows(), !0 === c.options.fade) return !0 !== i ? (c.fadeSlideOut(o), c.fadeSlide(s, function () {
                c.postSlide(s)
            })) : c.postSlide(s), void c.animateHeight();
            !0 !== i ? c.animateSlide(l, function () {
                c.postSlide(s)
            }) : c.postSlide(s)
        }
    }, t.prototype.startLoad = function () {
        var e = this;
        !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.hide(), e.$nextArrow.hide()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.hide(), e.$slider.addClass("slick-loading")
    }, t.prototype.swipeDirection = function () {
        var e, t, i, n, s = this;
        return e = s.touchObject.startX - s.touchObject.curX, t = s.touchObject.startY - s.touchObject.curY, i = Math.atan2(t, e), n = Math.round(180 * i / Math.PI), n < 0 && (n = 360 - Math.abs(n)), n <= 45 && n >= 0 ? !1 === s.options.rtl ? "left" : "right" : n <= 360 && n >= 315 ? !1 === s.options.rtl ? "left" : "right" : n >= 135 && n <= 225 ? !1 === s.options.rtl ? "right" : "left" : !0 === s.options.verticalSwiping ? n >= 35 && n <= 135 ? "down" : "up" : "vertical"
    }, t.prototype.swipeEnd = function (e) {
        var t, i, n = this;
        if (n.dragging = !1, n.swiping = !1, n.scrolling) return n.scrolling = !1, !1;
        if (n.interrupted = !1, n.shouldClick = !(n.touchObject.swipeLength > 10), void 0 === n.touchObject.curX) return !1;
        if (!0 === n.touchObject.edgeHit && n.$slider.trigger("edge", [n, n.swipeDirection()]), n.touchObject.swipeLength >= n.touchObject.minSwipe) {
            switch (i = n.swipeDirection()) {
                case"left":
                case"down":
                    t = n.options.swipeToSlide ? n.checkNavigable(n.currentSlide + n.getSlideCount()) : n.currentSlide + n.getSlideCount(), n.currentDirection = 0;
                    break;
                case"right":
                case"up":
                    t = n.options.swipeToSlide ? n.checkNavigable(n.currentSlide - n.getSlideCount()) : n.currentSlide - n.getSlideCount(), n.currentDirection = 1
            }
            "vertical" != i && (n.slideHandler(t), n.touchObject = {}, n.$slider.trigger("swipe", [n, i]))
        } else n.touchObject.startX !== n.touchObject.curX && (n.slideHandler(n.currentSlide), n.touchObject = {})
    }, t.prototype.swipeHandler = function (e) {
        var t = this;
        if (!(!1 === t.options.swipe || "ontouchend" in document && !1 === t.options.swipe || !1 === t.options.draggable && -1 !== e.type.indexOf("mouse"))) switch (t.touchObject.fingerCount = e.originalEvent && void 0 !== e.originalEvent.touches ? e.originalEvent.touches.length : 1, t.touchObject.minSwipe = t.listWidth / t.options.touchThreshold, !0 === t.options.verticalSwiping && (t.touchObject.minSwipe = t.listHeight / t.options.touchThreshold), e.data.action) {
            case"start":
                t.swipeStart(e);
                break;
            case"move":
                t.swipeMove(e);
                break;
            case"end":
                t.swipeEnd(e)
        }
    }, t.prototype.swipeMove = function (e) {
        var t, i, n, s, o, r, a = this;
        return o = void 0 !== e.originalEvent ? e.originalEvent.touches : null, !(!a.dragging || a.scrolling || o && 1 !== o.length) && (t = a.getLeft(a.currentSlide), a.touchObject.curX = void 0 !== o ? o[0].pageX : e.clientX, a.touchObject.curY = void 0 !== o ? o[0].pageY : e.clientY, a.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(a.touchObject.curX - a.touchObject.startX, 2))), r = Math.round(Math.sqrt(Math.pow(a.touchObject.curY - a.touchObject.startY, 2))), !a.options.verticalSwiping && !a.swiping && r > 4 ? (a.scrolling = !0, !1) : (!0 === a.options.verticalSwiping && (a.touchObject.swipeLength = r), i = a.swipeDirection(), void 0 !== e.originalEvent && a.touchObject.swipeLength > 4 && (a.swiping = !0, e.preventDefault()), s = (!1 === a.options.rtl ? 1 : -1) * (a.touchObject.curX > a.touchObject.startX ? 1 : -1), !0 === a.options.verticalSwiping && (s = a.touchObject.curY > a.touchObject.startY ? 1 : -1), n = a.touchObject.swipeLength, a.touchObject.edgeHit = !1, !1 === a.options.infinite && (0 === a.currentSlide && "right" === i || a.currentSlide >= a.getDotCount() && "left" === i) && (n = a.touchObject.swipeLength * a.options.edgeFriction, a.touchObject.edgeHit = !0), !1 === a.options.vertical ? a.swipeLeft = t + n * s : a.swipeLeft = t + n * (a.$list.height() / a.listWidth) * s, !0 === a.options.verticalSwiping && (a.swipeLeft = t + n * s), !0 !== a.options.fade && !1 !== a.options.touchMove && (!0 === a.animating ? (a.swipeLeft = null, !1) : void a.setCSS(a.swipeLeft))))
    }, t.prototype.swipeStart = function (e) {
        var t, i = this;
        if (i.interrupted = !0, 1 !== i.touchObject.fingerCount || i.slideCount <= i.options.slidesToShow) return i.touchObject = {}, !1;
        void 0 !== e.originalEvent && void 0 !== e.originalEvent.touches && (t = e.originalEvent.touches[0]), i.touchObject.startX = i.touchObject.curX = void 0 !== t ? t.pageX : e.clientX, i.touchObject.startY = i.touchObject.curY = void 0 !== t ? t.pageY : e.clientY, i.dragging = !0
    }, t.prototype.unfilterSlides = t.prototype.slickUnfilter = function () {
        var e = this;
        null !== e.$slidesCache && (e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.appendTo(e.$slideTrack), e.reinit())
    }, t.prototype.unload = function () {
        var t = this;
        e(".slick-cloned", t.$slider).remove(), t.$dots && t.$dots.remove(), t.$prevArrow && t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove(), t.$nextArrow && t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove(), t.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
    }, t.prototype.unslick = function (e) {
        var t = this;
        t.$slider.trigger("unslick", [t, e]), t.destroy()
    }, t.prototype.updateArrows = function () {
        var e = this;
        Math.floor(e.options.slidesToShow / 2), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && !e.options.infinite && (e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === e.currentSlide ? (e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - e.options.slidesToShow && !1 === e.options.centerMode ? (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - 1 && !0 === e.options.centerMode && (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
    }, t.prototype.updateDots = function () {
        var e = this;
        null !== e.$dots && (e.$dots.find("li").removeClass("slick-active").end(), e.$dots.find("li").eq(Math.floor(e.currentSlide / e.options.slidesToScroll)).addClass("slick-active"))
    }, t.prototype.visibility = function () {
        var e = this;
        e.options.autoplay && (document[e.hidden] ? e.interrupted = !0 : e.interrupted = !1)
    }, e.fn.slick = function () {
        var e, i, n = this, s = arguments[0], o = Array.prototype.slice.call(arguments, 1), r = n.length;
        for (e = 0; e < r; e++) if ("object" == typeof s || void 0 === s ? n[e].slick = new t(n[e], s) : i = n[e].slick[s].apply(n[e].slick, o), void 0 !== i) return i;
        return n
    }
}), function (e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e($ || require("jquery")) : e(jQuery)
}(function (e) {
    "use strict";

    function t(t, i) {
        this.element = t, this.options = e.extend({}, s, i);
        var n = this.options.locale;
        void 0 !== this.options.locales[n] && e.extend(this.options, this.options.locales[n]), this.init()
    }

    function i(t) {
        if (!e(t.target).parents().hasClass("jq-selectbox") && "OPTION" != t.target.nodeName && e("div.jq-selectbox.opened").length) {
            var i = e("div.jq-selectbox.opened"), s = e("div.jq-selectbox__search input", i),
                o = e("div.jq-selectbox__dropdown", i);
            i.find("select").data("_" + n).options.onSelectClosed.call(i), s.length && s.val("").keyup(), o.hide().find("li.sel").addClass("selected"), i.removeClass("focused opened dropup dropdown")
        }
    }

    var n = "styler", s = {
        idSuffix: "-styler",
        filePlaceholder: "Файл не выбран",
        fileBrowse: "Обзор...",
        fileNumber: "Выбрано файлов: %s",
        selectPlaceholder: "Выберите...",
        selectSearch: !1,
        selectSearchLimit: 10,
        selectSearchNotFound: "Совпадений не найдено",
        selectSearchPlaceholder: "Поиск...",
        selectVisibleOptions: 0,
        selectSmartPositioning: !0,
        locale: "ru",
        locales: {
            en: {
                filePlaceholder: "No file selected",
                fileBrowse: "Browse...",
                fileNumber: "Selected files: %s",
                selectPlaceholder: "Select...",
                selectSearchNotFound: "No matches found",
                selectSearchPlaceholder: "Search..."
            }
        },
        onSelectOpened: function () {
        },
        onSelectClosed: function () {
        },
        onFormStyled: function () {
        }
    };
    t.prototype = {
        init: function () {
            function t() {
                void 0 !== n.attr("id") && "" !== n.attr("id") && (this.id = n.attr("id") + s.idSuffix), this.title = n.attr("title"), this.classes = n.attr("class"), this.data = n.data()
            }

            var n = e(this.element), s = this.options,
                o = !(!navigator.userAgent.match(/(iPad|iPhone|iPod)/i) || navigator.userAgent.match(/(Windows\sPhone)/i)),
                r = !(!navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/(Windows\sPhone)/i));
            if (n.is(":checkbox")) {
                var a = function () {
                    var i = new t, s = e('<div class="jq-checkbox"><div class="jq-checkbox__div"></div></div>').attr({
                        id: i.id,
                        title: i.title
                    }).addClass(i.classes).data(i.data);
                    n.after(s).prependTo(s), n.is(":checked") && s.addClass("checked"), n.is(":disabled") && s.addClass("disabled"), s.click(function (e) {
                        e.preventDefault(), n.triggerHandler("click"), s.is(".disabled") || (n.is(":checked") ? (n.prop("checked", !1), s.removeClass("checked")) : (n.prop("checked", !0), s.addClass("checked")), n.focus().change())
                    }), n.closest("label").add('label[for="' + n.attr("id") + '"]').on("click.styler", function (t) {
                        e(t.target).is("a") || e(t.target).closest(s).length || (s.triggerHandler("click"), t.preventDefault())
                    }), n.on("change.styler", function () {
                        n.is(":checked") ? s.addClass("checked") : s.removeClass("checked")
                    }).on("keydown.styler", function (e) {
                        32 == e.which && s.click()
                    }).on("focus.styler", function () {
                        s.is(".disabled") || s.addClass("focused")
                    }).on("blur.styler", function () {
                        s.removeClass("focused")
                    })
                };
                a(), n.on("refresh", function () {
                    n.closest("label").add('label[for="' + n.attr("id") + '"]').off(".styler"), n.off(".styler").parent().before(n).remove(), a()
                })
            } else if (n.is(":radio")) {
                var l = function () {
                    var i = new t, s = e('<div class="jq-radio"><div class="jq-radio__div"></div></div>').attr({
                        id: i.id,
                        title: i.title
                    }).addClass(i.classes).data(i.data);
                    n.after(s).prependTo(s), n.is(":checked") && s.addClass("checked"), n.is(":disabled") && s.addClass("disabled"), e.fn.commonParents = function () {
                        var t = this;
                        return t.first().parents().filter(function () {
                            return e(this).find(t).length === t.length
                        })
                    }, e.fn.commonParent = function () {
                        return e(this).commonParents().first()
                    }, s.click(function (t) {
                        if (t.preventDefault(), n.triggerHandler("click"), !s.is(".disabled")) {
                            var i = e('input[name="' + n.attr("name") + '"]');
                            i.commonParent().find(i).prop("checked", !1).parent().removeClass("checked"), n.prop("checked", !0).parent().addClass("checked"), n.focus().change()
                        }
                    }), n.closest("label").add('label[for="' + n.attr("id") + '"]').on("click.styler", function (t) {
                        e(t.target).is("a") || e(t.target).closest(s).length || (s.triggerHandler("click"), t.preventDefault())
                    }), n.on("change.styler", function () {
                        n.parent().addClass("checked")
                    }).on("focus.styler", function () {
                        s.is(".disabled") || s.addClass("focused")
                    }).on("blur.styler", function () {
                        s.removeClass("focused")
                    })
                };
                l(), n.on("refresh", function () {
                    n.closest("label").add('label[for="' + n.attr("id") + '"]').off(".styler"), n.off(".styler").parent().before(n).remove(), l()
                })
            } else if (n.is(":file")) {
                var c = function () {
                    var i = new t, o = n.data("placeholder");
                    void 0 === o && (o = s.filePlaceholder);
                    var r = n.data("browse");
                    void 0 !== r && "" !== r || (r = s.fileBrowse);
                    var a = e('<div class="jq-file"><div class="jq-file__name">' + o + '</div><div class="jq-file__browse">' + r + "</div></div>").attr({
                        id: i.id,
                        title: i.title
                    }).addClass(i.classes).data(i.data);
                    n.after(a).appendTo(a), n.is(":disabled") && a.addClass("disabled");
                    var l = n.val(), c = e("div.jq-file__name", a);
                    l && c.text(l.replace(/.+[\\\/]/, "")), n.on("change.styler", function () {
                        var e = n.val();
                        if (n.is("[multiple]")) {
                            e = "";
                            var t = n[0].files.length;
                            if (t > 0) {
                                var i = n.data("number");
                                void 0 === i && (i = s.fileNumber), i = i.replace("%s", t), e = i
                            }
                        }
                        c.text(e.replace(/.+[\\\/]/, "")), "" === e ? (c.text(o), a.removeClass("changed")) : a.addClass("changed")
                    }).on("focus.styler", function () {
                        a.addClass("focused")
                    }).on("blur.styler", function () {
                        a.removeClass("focused")
                    }).on("click.styler", function () {
                        a.removeClass("focused")
                    })
                };
                c(), n.on("refresh", function () {
                    n.off(".styler").parent().before(n).remove(), c()
                })
            } else if (n.is('input[type="number"]')) {
                var u = function () {
                    var i = new t,
                        s = e('<div class="jq-number"><div class="jq-number__spin minus"></div><div class="jq-number__spin plus"></div></div>').attr({
                            id: i.id,
                            title: i.title
                        }).addClass(i.classes).data(i.data);
                    n.after(s).prependTo(s).wrap('<div class="jq-number__field"></div>'), n.is(":disabled") && s.addClass("disabled");
                    var o, r, a, l = null, c = null;
                    void 0 !== n.attr("min") && (o = n.attr("min")), void 0 !== n.attr("max") && (r = n.attr("max")), a = void 0 !== n.attr("step") && e.isNumeric(n.attr("step")) ? Number(n.attr("step")) : Number(1);
                    var u = function (t) {
                        var i, s = n.val();
                        e.isNumeric(s) || (s = 0, n.val("0")), t.is(".minus") ? i = Number(s) - a : t.is(".plus") && (i = Number(s) + a);
                        var l = (a.toString().split(".")[1] || []).length;
                        if (l > 0) {
                            for (var c = "1"; c.length <= l;) c += "0";
                            i = Math.round(i * c) / c
                        }
                        e.isNumeric(o) && e.isNumeric(r) ? i >= o && i <= r && n.val(i) : e.isNumeric(o) && !e.isNumeric(r) ? i >= o && n.val(i) : !e.isNumeric(o) && e.isNumeric(r) ? i <= r && n.val(i) : n.val(i)
                    };
                    s.is(".disabled") || (s.on("mousedown", "div.jq-number__spin", function () {
                        var t = e(this);
                        u(t), l = setTimeout(function () {
                            c = setInterval(function () {
                                u(t)
                            }, 40)
                        }, 350)
                    }).on("mouseup mouseout", "div.jq-number__spin", function () {
                        clearTimeout(l), clearInterval(c)
                    }).on("mouseup", "div.jq-number__spin", function () {
                        n.change().trigger("input")
                    }), n.on("focus.styler", function () {
                        s.addClass("focused")
                    }).on("blur.styler", function () {
                        s.removeClass("focused")
                    }))
                };
                u(), n.on("refresh", function () {
                    n.off(".styler").closest(".jq-number").before(n).remove(), u()
                })
            } else if (n.is("select")) {
                var d = function () {
                    function a(e) {
                        var t = e.prop("scrollHeight") - e.outerHeight(), i = null, n = null;
                        e.off("mousewheel DOMMouseScroll").on("mousewheel DOMMouseScroll", function (s) {
                            i = s.originalEvent.detail < 0 || s.originalEvent.wheelDelta > 0 ? 1 : -1, ((n = e.scrollTop()) >= t && i < 0 || n <= 0 && i > 0) && (s.stopPropagation(), s.preventDefault())
                        })
                    }

                    function l() {
                        for (var e = 0; e < c.length; e++) {
                            var t = c.eq(e), i = "", n = "", o = "", r = "", a = "", l = "", d = "", h = "", p = "";
                            t.prop("selected") && (n = "selected sel"), t.is(":disabled") && (n = "disabled"), t.is(":selected:disabled") && (n = "selected sel disabled"), void 0 !== t.attr("id") && "" !== t.attr("id") && (r = ' id="' + t.attr("id") + s.idSuffix + '"'), void 0 !== t.attr("title") && "" !== c.attr("title") && (a = ' title="' + t.attr("title") + '"'), void 0 !== t.attr("class") && (d = " " + t.attr("class"), p = ' data-jqfs-class="' + t.attr("class") + '"');
                            var f = t.data();
                            for (var g in f) "" !== f[g] && (l += " data-" + g + '="' + f[g] + '"');
                            n + d !== "" && (o = ' class="' + n + d + '"'), i = "<li" + p + l + o + a + r + ">" + t.html() + "</li>", t.parent().is("optgroup") && (void 0 !== t.parent().attr("class") && (h = " " + t.parent().attr("class")), i = "<li" + p + l + ' class="' + n + d + " option" + h + '"' + a + r + ">" + t.html() + "</li>", t.is(":first-child") && (i = '<li class="optgroup' + h + '">' + t.parent().attr("label") + "</li>" + i)), u += i
                        }
                    }

                    var c = e("option", n), u = "";
                    if (n.is("[multiple]")) {
                        if (r || o) return;
                        !function () {
                            var i = new t, s = e('<div class="jq-select-multiple jqselect"></div>').attr({
                                id: i.id,
                                title: i.title
                            }).addClass(i.classes).data(i.data);
                            n.after(s), l(), s.append("<ul>" + u + "</ul>");
                            var o = e("ul", s), r = e("li", s), d = n.attr("size"), h = o.outerHeight(),
                                p = r.outerHeight();
                            void 0 !== d && d > 0 ? o.css({height: p * d}) : o.css({height: 4 * p}), h > s.height() && (o.css("overflowY", "scroll"), a(o), r.filter(".selected").length && o.scrollTop(o.scrollTop() + r.filter(".selected").position().top)), n.prependTo(s), n.is(":disabled") ? (s.addClass("disabled"), c.each(function () {
                                e(this).is(":selected") && r.eq(e(this).index()).addClass("selected")
                            })) : (r.filter(":not(.disabled):not(.optgroup)").click(function (t) {
                                n.focus();
                                var i = e(this);
                                if (t.ctrlKey || t.metaKey || i.addClass("selected"), t.shiftKey || i.addClass("first"), t.ctrlKey || t.metaKey || t.shiftKey || i.siblings().removeClass("selected first"), (t.ctrlKey || t.metaKey) && (i.is(".selected") ? i.removeClass("selected first") : i.addClass("selected first"), i.siblings().removeClass("first")), t.shiftKey) {
                                    var s = !1, o = !1;
                                    i.siblings().removeClass("selected").siblings(".first").addClass("selected"), i.prevAll().each(function () {
                                        e(this).is(".first") && (s = !0)
                                    }), i.nextAll().each(function () {
                                        e(this).is(".first") && (o = !0)
                                    }), s && i.prevAll().each(function () {
                                        if (e(this).is(".selected")) return !1;
                                        e(this).not(".disabled, .optgroup").addClass("selected")
                                    }), o && i.nextAll().each(function () {
                                        if (e(this).is(".selected")) return !1;
                                        e(this).not(".disabled, .optgroup").addClass("selected")
                                    }), 1 == r.filter(".selected").length && i.addClass("first")
                                }
                                c.prop("selected", !1), r.filter(".selected").each(function () {
                                    var t = e(this), i = t.index();
                                    t.is(".option") && (i -= t.prevAll(".optgroup").length), c.eq(i).prop("selected", !0)
                                }), n.change()
                            }), c.each(function (t) {
                                e(this).data("optionIndex", t)
                            }), n.on("change.styler", function () {
                                r.removeClass("selected");
                                var t = [];
                                c.filter(":selected").each(function () {
                                    t.push(e(this).data("optionIndex"))
                                }), r.not(".optgroup").filter(function (i) {
                                    return e.inArray(i, t) > -1
                                }).addClass("selected")
                            }).on("focus.styler", function () {
                                s.addClass("focused")
                            }).on("blur.styler", function () {
                                s.removeClass("focused")
                            }), h > s.height() && n.on("keydown.styler", function (e) {
                                38 != e.which && 37 != e.which && 33 != e.which || o.scrollTop(o.scrollTop() + r.filter(".selected").position().top - p), 40 != e.which && 39 != e.which && 34 != e.which || o.scrollTop(o.scrollTop() + r.filter(".selected:last").position().top - o.innerHeight() + 2 * p)
                            }))
                        }()
                    } else !function () {
                        var r = new t, d = "", h = n.data("placeholder"), p = n.data("search"),
                            f = n.data("search-limit"), g = n.data("search-not-found"),
                            m = n.data("search-placeholder"),
                            v = n.data("smart-positioning");
                        void 0 === h && (h = s.selectPlaceholder), void 0 !== p && "" !== p || (p = s.selectSearch), void 0 !== f && "" !== f || (f = s.selectSearchLimit), void 0 !== g && "" !== g || (g = s.selectSearchNotFound), void 0 === m && (m = s.selectSearchPlaceholder), void 0 !== v && "" !== v || (v = s.selectSmartPositioning);
                        var y = e('<div class="jq-selectbox jqselect"><div class="jq-selectbox__select"><div class="jq-selectbox__select-text"></div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div></div>').attr({
                            id: r.id,
                            title: r.title
                        }).addClass(r.classes).data(r.data);
                        n.after(y).prependTo(y);
                        var x = y.css("z-index");
                        x = x > 0 ? x : 1;
                        var b = e("div.jq-selectbox__select", y), _ = e("div.jq-selectbox__select-text", y),
                            w = c.filter(":selected");
                        l(), p && (d = '<div class="jq-selectbox__search"><input type="search" autocomplete="off" placeholder="' + m + '"></div><div class="jq-selectbox__not-found">' + g + "</div>");
                        var T = e('<div class="jq-selectbox__dropdown">' + d + "<ul>" + u + "</ul></div>");
                        y.append(T);
                        var k = e("ul", T), $ = e("li", T), S = e("input", T),
                            C = e("div.jq-selectbox__not-found", T).hide();
                        $.length < f && S.parent().hide(), "" === c.first().text() && c.first().is(":selected") && !1 !== h ? _.text(h).addClass("placeholder") : _.text(w.text());
                        var P = 0, O = 0;
                        if ($.css({display: "inline-block"}), $.each(function () {
                                var t = e(this);
                                t.innerWidth() > P && (P = t.innerWidth(), O = t.width())
                            }), $.css({display: ""}), _.is(".placeholder") && _.width() > P) _.width(_.width()); else {
                            var A = y.clone().appendTo("body").width("auto"), L = A.outerWidth();
                            A.remove(), L == y.outerWidth() && _.width(O)
                        }
                        P > y.width() && T.width(P), "" === c.first().text() && "" !== n.data("placeholder") && $.first().hide();
                        var D = y.outerHeight(!0), M = S.parent().outerHeight(!0) || 0, E = k.css("max-height"),
                            F = $.filter(".selected");
                        if (F.length < 1 && $.first().addClass("selected sel"), void 0 === $.data("li-height")) {
                            var R = $.outerHeight();
                            !1 !== h && (R = $.eq(1).outerHeight()), $.data("li-height", R)
                        }
                        var j = T.css("top");
                        if ("auto" == T.css("left") && T.css({left: 0}), "auto" == T.css("top") && (T.css({top: D}), j = D), T.hide(), F.length && (c.first().text() != w.text() && y.addClass("changed"), y.data("jqfs-class", F.data("jqfs-class")), y.addClass(F.data("jqfs-class"))), n.is(":disabled")) return y.addClass("disabled"), !1;
                        b.click(function () {
                            if (e("div.jq-selectbox").filter(".opened").length && s.onSelectClosed.call(e("div.jq-selectbox").filter(".opened")), n.focus(), !o) {
                                var t = e(window), i = $.data("li-height"), r = y.offset().top,
                                    l = t.height() - D - (r - t.scrollTop()), u = n.data("visible-options");
                                void 0 !== u && "" !== u || (u = s.selectVisibleOptions);
                                var d = 5 * i, h = i * u;
                                u > 0 && u < 6 && (d = h), 0 === u && (h = "auto");
                                var p = function () {
                                    T.height("auto").css({bottom: "auto", top: j});
                                    var e = function () {
                                        k.css("max-height", Math.floor((l - 20 - M) / i) * i)
                                    };
                                    e(), k.css("max-height", h), "none" != E && k.css("max-height", E), l < T.outerHeight() + 20 && e()
                                };
                                !0 === v || 1 === v ? l > d + M + 20 ? (p(), y.removeClass("dropup").addClass("dropdown")) : (function () {
                                    T.height("auto").css({top: "auto", bottom: j});
                                    var e = function () {
                                        k.css("max-height", Math.floor((r - t.scrollTop() - 20 - M) / i) * i)
                                    };
                                    e(), k.css("max-height", h), "none" != E && k.css("max-height", E), r - t.scrollTop() - 20 < T.outerHeight() + 20 && e()
                                }(), y.removeClass("dropdown").addClass("dropup")) : !1 === v || 0 === v ? l > d + M + 20 && (p(), y.removeClass("dropup").addClass("dropdown")) : (T.height("auto").css({
                                    bottom: "auto",
                                    top: j
                                }), k.css("max-height", h), "none" != E && k.css("max-height", E)), y.offset().left + T.outerWidth() > t.width() && T.css({
                                    left: "auto",
                                    right: 0
                                }), e("div.jqselect").css({zIndex: x - 1}).removeClass("opened"), y.css({zIndex: x}), T.is(":hidden") ? (e("div.jq-selectbox__dropdown:visible").hide(), T.show(), y.addClass("opened focused"), s.onSelectOpened.call(y)) : (T.hide(), y.removeClass("opened dropup dropdown"), e("div.jq-selectbox").filter(".opened").length && s.onSelectClosed.call(y)), S.length && (S.val("").keyup(), C.hide(), S.keyup(function () {
                                    var t = e(this).val();
                                    $.each(function () {
                                        e(this).html().match(new RegExp(".*?" + t + ".*?", "i")) ? e(this).show() : e(this).hide()
                                    }), "" === c.first().text() && "" !== n.data("placeholder") && $.first().hide(), $.filter(":visible").length < 1 ? C.show() : C.hide()
                                })), $.filter(".selected").length && ("" === n.val() ? k.scrollTop(0) : (k.innerHeight() / i % 2 != 0 && (i /= 2), k.scrollTop(k.scrollTop() + $.filter(".selected").position().top - k.innerHeight() / 2 + i))), a(k)
                            }
                        }), $.hover(function () {
                            e(this).siblings().removeClass("selected")
                        });
                        var I = $.filter(".selected").text();
                        $.filter(":not(.disabled):not(.optgroup)").click(function () {
                            n.focus();
                            var t = e(this), i = t.text();
                            if (!t.is(".selected")) {
                                var o = t.index();
                                o -= t.prevAll(".optgroup").length, t.addClass("selected sel").siblings().removeClass("selected sel"), c.prop("selected", !1).eq(o).prop("selected", !0), I = i, _.text(i), y.data("jqfs-class") && y.removeClass(y.data("jqfs-class")), y.data("jqfs-class", t.data("jqfs-class")), y.addClass(t.data("jqfs-class")), n.change()
                            }
                            T.hide(), y.removeClass("opened dropup dropdown"), s.onSelectClosed.call(y)
                        }), T.mouseout(function () {
                            e("li.sel", T).addClass("selected")
                        }), n.on("change.styler", function () {
                            _.text(c.filter(":selected").text()).removeClass("placeholder"), $.removeClass("selected sel").not(".optgroup").eq(n[0].selectedIndex).addClass("selected sel"), c.first().text() != $.filter(".selected").text() ? y.addClass("changed") : y.removeClass("changed")
                        }).on("focus.styler", function () {
                            y.addClass("focused"), e("div.jqselect").not(".focused").removeClass("opened dropup dropdown").find("div.jq-selectbox__dropdown").hide()
                        }).on("blur.styler", function () {
                            y.removeClass("focused")
                        }).on("keydown.styler keyup.styler", function (e) {
                            var t = $.data("li-height");
                            "" === n.val() ? _.text(h).addClass("placeholder") : _.text(c.filter(":selected").text()), $.removeClass("selected sel").not(".optgroup").eq(n[0].selectedIndex).addClass("selected sel"), 38 != e.which && 37 != e.which && 33 != e.which && 36 != e.which || ("" === n.val() ? k.scrollTop(0) : k.scrollTop(k.scrollTop() + $.filter(".selected").position().top)), 40 != e.which && 39 != e.which && 34 != e.which && 35 != e.which || k.scrollTop(k.scrollTop() + $.filter(".selected").position().top - k.innerHeight() + t), 13 == e.which && (e.preventDefault(), T.hide(), y.removeClass("opened dropup dropdown"), s.onSelectClosed.call(y))
                        }).on("keydown.styler", function (e) {
                            32 == e.which && (e.preventDefault(), b.click())
                        }), i.registered || (e(document).on("click", i), i.registered = !0)
                    }()
                };
                d(), n.on("refresh", function () {
                    n.off(".styler").parent().before(n).remove(), d()
                })
            } else n.is(":reset") && n.on("click", function () {
                setTimeout(function () {
                    n.closest("form").find("input, select").trigger("refresh")
                }, 1)
            })
        }, destroy: function () {
            var t = e(this.element);
            t.is(":checkbox") || t.is(":radio") ? (t.removeData("_" + n).off(".styler refresh").removeAttr("style").parent().before(t).remove(), t.closest("label").add('label[for="' + t.attr("id") + '"]').off(".styler")) : t.is('input[type="number"]') ? t.removeData("_" + n).off(".styler refresh").closest(".jq-number").before(t).remove() : (t.is(":file") || t.is("select")) && t.removeData("_" + n).off(".styler refresh").removeAttr("style").parent().before(t).remove()
        }
    }, e.fn[n] = function (i) {
        var s = arguments;
        if (void 0 === i || "object" == typeof i) return this.each(function () {
            e.data(this, "_" + n) || e.data(this, "_" + n, new t(this, i))
        }).promise().done(function () {
            var t = e(this[0]).data("_" + n);
            t && t.options.onFormStyled.call()
        }), this;
        if ("string" == typeof i && "_" !== i[0] && "init" !== i) {
            var o;
            return this.each(function () {
                var r = e.data(this, "_" + n);
                r instanceof t && "function" == typeof r[i] && (o = r[i].apply(r, Array.prototype.slice.call(s, 1)))
            }), void 0 !== o ? o : this
        }
    }, i.registered = !1
}), function ($, window, undefined) {
    "use strict";
    $.fn.tabslet = function (options) {
        var defaults = {
            mouseevent: "click",
            activeclass: "active",
            attribute: "href",
            animation: !1,
            autorotate: !1,
            deeplinking: !1,
            pauseonhover: !0,
            delay: 2e3,
            active: 1,
            container: !1,
            controls: {prev: ".prev", next: ".next"}
        }, options = $.extend(defaults, options);
        return this.each(function () {
            function deep_link() {
                var e = [];
                elements.find("a").each(function () {
                    e.push($(this).attr($this.opts.attribute))
                });
                var t = $.inArray(location.hash, e);
                return t > -1 ? t + 1 : $this.data("active") || options.active
            }

            var $this = $(this), _cache_li = [], _cache_div = [],
                _container = options.container ? $(options.container) : $this, _tabs = _container.find("> div");
            _tabs.each(function () {
                _cache_div.push($(this).css("display"))
            });
            var elements = $this.find("> ul > li"), i = options.active - 1;
            if (!$this.data("tabslet-init")) {
                $this.data("tabslet-init", !0), $this.opts = [], $.map(["mouseevent", "activeclass", "attribute", "animation", "autorotate", "deeplinking", "pauseonhover", "delay", "container"], function (e, t) {
                    $this.opts[e] = $this.data(e) || options[e]
                }), $this.opts.active = $this.opts.deeplinking ? deep_link() : $this.data("active") || options.active, _tabs.hide(), $this.opts.active && (_tabs.eq($this.opts.active - 1).show(), elements.eq($this.opts.active - 1).addClass(options.activeclass));
                var fn = eval(function (e, t) {
                    var n = t ? elements.find("a[" + $this.opts.attribute + '="' + t + '"]').parent() : $(this);
                    n.trigger("_before"), elements.removeClass(options.activeclass), n.addClass(options.activeclass), _tabs.hide(), i = elements.index(n);
                    var s = t || n.find("a").attr($this.opts.attribute);
                    return $this.opts.deeplinking && (location.hash = s), $this.opts.animation ? _container.find(s).animate({opacity: "show"}, "slow", function () {
                        n.trigger("_after")
                    }) : (_container.find(s).show(), n.trigger("_after")), !1
                }), init = eval("elements." + $this.opts.mouseevent + "(fn)"), t, forward = function () {
                    i = ++i % elements.length, "hover" == $this.opts.mouseevent ? elements.eq(i).trigger("mouseover") : elements.eq(i).click(), $this.opts.autorotate && (clearTimeout(t), t = setTimeout(forward, $this.opts.delay), $this.mouseover(function () {
                        $this.opts.pauseonhover && clearTimeout(t)
                    }))
                };
                $this.opts.autorotate && (t = setTimeout(forward, $this.opts.delay), $this.hover(function () {
                    $this.opts.pauseonhover && clearTimeout(t)
                }, function () {
                    t = setTimeout(forward, $this.opts.delay)
                }), $this.opts.pauseonhover && $this.on("mouseleave", function () {
                    clearTimeout(t), t = setTimeout(forward, $this.opts.delay)
                }));
                var move = function (e) {
                    "forward" == e && (i = ++i % elements.length), "backward" == e && (i = --i % elements.length), elements.eq(i).click()
                };
                $this.find(options.controls.next).click(function () {
                    move("forward")
                }), $this.find(options.controls.prev).click(function () {
                    move("backward")
                }), $this.on("show", function (e, t) {
                    fn(e, t)
                }), $this.on("next", function () {
                    move("forward")
                }), $this.on("prev", function () {
                    move("backward")
                }), $this.on("destroy", function () {
                    $(this).removeData().find("> ul li").each(function (e) {
                        $(this).removeClass(options.activeclass)
                    }), _tabs.each(function (e) {
                        $(this).removeAttr("style").css("display", _cache_div[e])
                    })
                })
            }
        })
    }, $(document).ready(function () {
        $('[data-toggle="tabslet"]').tabslet()
    })
}(jQuery);
var _gsScope = "undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window;
(_gsScope._gsQueue || (_gsScope._gsQueue = [])).push(function () {
    "use strict";
    _gsScope._gsDefine("TweenMax", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function (e, t, i) {
        var n = function (e) {
            var t, i = [], n = e.length;
            for (t = 0; t !== n; i.push(e[t++])) ;
            return i
        }, s = function (e, t, i) {
            var n, s, o = e.cycle;
            for (n in o) s = o[n], e[n] = "function" == typeof s ? s(i, t[i]) : s[i % s.length];
            delete e.cycle
        }, o = function (e, t, n) {
            i.call(this, e, t, n), this._cycle = 0, this._yoyo = !0 === this.vars.yoyo || !!this.vars.yoyoEase, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._repeat && this._uncache(!0), this.render = o.prototype.render
        }, r = i._internals, a = r.isSelector, l = r.isArray, c = o.prototype = i.to({}, .1, {}), u = [];
        o.version = "1.20.3", c.constructor = o, c.kill()._gc = !1, o.killTweensOf = o.killDelayedCallsTo = i.killTweensOf, o.getTweensOf = i.getTweensOf, o.lagSmoothing = i.lagSmoothing, o.ticker = i.ticker, o.render = i.render, c.invalidate = function () {
            return this._yoyo = !0 === this.vars.yoyo || !!this.vars.yoyoEase, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._yoyoEase = null, this._uncache(!0), i.prototype.invalidate.call(this)
        }, c.updateTo = function (e, t) {
            var n, s = this.ratio, o = this.vars.immediateRender || e.immediateRender;
            t && this._startTime < this._timeline._time && (this._startTime = this._timeline._time, this._uncache(!1), this._gc ? this._enabled(!0, !1) : this._timeline.insert(this, this._startTime - this._delay));
            for (n in e) this.vars[n] = e[n];
            if (this._initted || o) if (t) this._initted = !1, o && this.render(0, !0, !0); else if (this._gc && this._enabled(!0, !1), this._notifyPluginsOfEnabled && this._firstPT && i._onPluginEvent("_onDisable", this), this._time / this._duration > .998) {
                var r = this._totalTime;
                this.render(0, !0, !1), this._initted = !1, this.render(r, !0, !1)
            } else if (this._initted = !1, this._init(), this._time > 0 || o) for (var a, l = 1 / (1 - s), c = this._firstPT; c;) a = c.s + c.c, c.c *= l, c.s = a - c.c, c = c._next;
            return this
        }, c.render = function (e, t, n) {
            this._initted || 0 === this._duration && this.vars.repeat && this.invalidate();
            var s, o, a, l, c, u, d, h, p, f = this._dirty ? this.totalDuration() : this._totalDuration, g = this._time,
                m = this._totalTime, v = this._cycle, y = this._duration,
                x = this._rawPrevTime;
            if (e >= f - 1e-7 && e >= 0 ? (this._totalTime = f, this._cycle = this._repeat, this._yoyo && 0 != (1 & this._cycle) ? (this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0) : (this._time = y, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1), this._reversed || (s = !0, o = "onComplete", n = n || this._timeline.autoRemoveChildren), 0 === y && (this._initted || !this.vars.lazy || n) && (this._startTime === this._timeline._duration && (e = 0), (x < 0 || e <= 0 && e >= -1e-7 || 1e-10 === x && "isPause" !== this.data) && x !== e && (n = !0, x > 1e-10 && (o = "onReverseComplete")), this._rawPrevTime = h = !t || e || x === e ? e : 1e-10)) : e < 1e-7 ? (this._totalTime = this._time = this._cycle = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== m || 0 === y && x > 0) && (o = "onReverseComplete", s = this._reversed), e < 0 && (this._active = !1, 0 === y && (this._initted || !this.vars.lazy || n) && (x >= 0 && (n = !0), this._rawPrevTime = h = !t || e || x === e ? e : 1e-10)), this._initted || (n = !0)) : (this._totalTime = this._time = e, 0 !== this._repeat && (l = y + this._repeatDelay, this._cycle = this._totalTime / l >> 0, 0 !== this._cycle && this._cycle === this._totalTime / l && m <= e && this._cycle--, this._time = this._totalTime - this._cycle * l, this._yoyo && 0 != (1 & this._cycle) && (this._time = y - this._time, (p = this._yoyoEase || this.vars.yoyoEase) && (this._yoyoEase || (!0 !== p || this._initted ? this._yoyoEase = p = !0 === p ? this._ease : p instanceof Ease ? p : Ease.map[p] : (p = this.vars.ease, this._yoyoEase = p = p ? p instanceof Ease ? p : "function" == typeof p ? new Ease(p, this.vars.easeParams) : Ease.map[p] || i.defaultEase : i.defaultEase)), this.ratio = p ? 1 - p.getRatio((y - this._time) / y) : 0)), this._time > y ? this._time = y : this._time < 0 && (this._time = 0)), this._easeType && !p ? (c = this._time / y, u = this._easeType, d = this._easePower, (1 === u || 3 === u && c >= .5) && (c = 1 - c), 3 === u && (c *= 2), 1 === d ? c *= c : 2 === d ? c *= c * c : 3 === d ? c *= c * c * c : 4 === d && (c *= c * c * c * c), 1 === u ? this.ratio = 1 - c : 2 === u ? this.ratio = c : this._time / y < .5 ? this.ratio = c / 2 : this.ratio = 1 - c / 2) : p || (this.ratio = this._ease.getRatio(this._time / y))), g === this._time && !n && v === this._cycle) return void(m !== this._totalTime && this._onUpdate && (t || this._callback("onUpdate")));
            if (!this._initted) {
                if (this._init(), !this._initted || this._gc) return;
                if (!n && this._firstPT && (!1 !== this.vars.lazy && this._duration || this.vars.lazy && !this._duration)) return this._time = g, this._totalTime = m, this._rawPrevTime = x, this._cycle = v, r.lazyTweens.push(this), void(this._lazy = [e, t]);
                !this._time || s || p ? s && this._ease._calcEnd && !p && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1)) : this.ratio = this._ease.getRatio(this._time / y)
            }
            for (!1 !== this._lazy && (this._lazy = !1), this._active || !this._paused && this._time !== g && e >= 0 && (this._active = !0), 0 === m && (2 === this._initted && e > 0 && this._init(), this._startAt && (e >= 0 ? this._startAt.render(e, !0, n) : o || (o = "_dummyGS")), this.vars.onStart && (0 === this._totalTime && 0 !== y || t || this._callback("onStart"))), a = this._firstPT; a;) a.f ? a.t[a.p](a.c * this.ratio + a.s) : a.t[a.p] = a.c * this.ratio + a.s, a = a._next;
            this._onUpdate && (e < 0 && this._startAt && this._startTime && this._startAt.render(e, !0, n), t || (this._totalTime !== m || o) && this._callback("onUpdate")), this._cycle !== v && (t || this._gc || this.vars.onRepeat && this._callback("onRepeat")), o && (this._gc && !n || (e < 0 && this._startAt && !this._onUpdate && this._startTime && this._startAt.render(e, !0, n), s && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !t && this.vars[o] && this._callback(o), 0 === y && 1e-10 === this._rawPrevTime && 1e-10 !== h && (this._rawPrevTime = 0)))
        }, o.to = function (e, t, i) {
            return new o(e, t, i)
        }, o.from = function (e, t, i) {
            return i.runBackwards = !0, i.immediateRender = 0 != i.immediateRender, new o(e, t, i)
        }, o.fromTo = function (e, t, i, n) {
            return n.startAt = i, n.immediateRender = 0 != n.immediateRender && 0 != i.immediateRender, new o(e, t, n)
        }, o.staggerTo = o.allTo = function (e, t, r, c, d, h, p) {
            c = c || 0;
            var f, g, m, v, y = 0, x = [], b = function () {
                r.onComplete && r.onComplete.apply(r.onCompleteScope || this, arguments), d.apply(p || r.callbackScope || this, h || u)
            }, _ = r.cycle, w = r.startAt && r.startAt.cycle;
            for (l(e) || ("string" == typeof e && (e = i.selector(e) || e), a(e) && (e = n(e))), e = e || [], c < 0 && (e = n(e), e.reverse(), c *= -1), f = e.length - 1, m = 0; m <= f; m++) {
                g = {};
                for (v in r) g[v] = r[v];
                if (_ && (s(g, e, m), null != g.duration && (t = g.duration, delete g.duration)), w) {
                    w = g.startAt = {};
                    for (v in r.startAt) w[v] = r.startAt[v];
                    s(g.startAt, e, m)
                }
                g.delay = y + (g.delay || 0), m === f && d && (g.onComplete = b), x[m] = new o(e[m], t, g), y += c
            }
            return x
        }, o.staggerFrom = o.allFrom = function (e, t, i, n, s, r, a) {
            return i.runBackwards = !0, i.immediateRender = 0 != i.immediateRender, o.staggerTo(e, t, i, n, s, r, a)
        }, o.staggerFromTo = o.allFromTo = function (e, t, i, n, s, r, a, l) {
            return n.startAt = i, n.immediateRender = 0 != n.immediateRender && 0 != i.immediateRender, o.staggerTo(e, t, n, s, r, a, l)
        }, o.delayedCall = function (e, t, i, n, s) {
            return new o(t, 0, {
                delay: e,
                onComplete: t,
                onCompleteParams: i,
                callbackScope: n,
                onReverseComplete: t,
                onReverseCompleteParams: i,
                immediateRender: !1,
                useFrames: s,
                overwrite: 0
            })
        }, o.set = function (e, t) {
            return new o(e, 0, t)
        }, o.isTweening = function (e) {
            return i.getTweensOf(e, !0).length > 0
        };
        var d = function (e, t) {
            for (var n = [], s = 0, o = e._first; o;) o instanceof i ? n[s++] = o : (t && (n[s++] = o), n = n.concat(d(o, t)), s = n.length), o = o._next;
            return n
        }, h = o.getAllTweens = function (t) {
            return d(e._rootTimeline, t).concat(d(e._rootFramesTimeline, t))
        };
        o.killAll = function (e, i, n, s) {
            null == i && (i = !0), null == n && (n = !0);
            var o, r, a, l = h(0 != s), c = l.length, u = i && n && s;
            for (a = 0; a < c; a++) r = l[a], (u || r instanceof t || (o = r.target === r.vars.onComplete) && n || i && !o) && (e ? r.totalTime(r._reversed ? 0 : r.totalDuration()) : r._enabled(!1, !1))
        }, o.killChildTweensOf = function (e, t) {
            if (null != e) {
                var s, c, u, d, h, p = r.tweenLookup;
                if ("string" == typeof e && (e = i.selector(e) || e), a(e) && (e = n(e)), l(e)) for (d = e.length; --d > -1;) o.killChildTweensOf(e[d], t); else {
                    s = [];
                    for (u in p) for (c = p[u].target.parentNode; c;) c === e && (s = s.concat(p[u].tweens)), c = c.parentNode;
                    for (h = s.length, d = 0; d < h; d++) t && s[d].totalTime(s[d].totalDuration()), s[d]._enabled(!1, !1)
                }
            }
        };
        var p = function (e, i, n, s) {
            i = !1 !== i, n = !1 !== n, s = !1 !== s;
            for (var o, r, a = h(s), l = i && n && s, c = a.length; --c > -1;) r = a[c], (l || r instanceof t || (o = r.target === r.vars.onComplete) && n || i && !o) && r.paused(e)
        };
        return o.pauseAll = function (e, t, i) {
            p(!0, e, t, i)
        }, o.resumeAll = function (e, t, i) {
            p(!1, e, t, i)
        }, o.globalTimeScale = function (t) {
            var n = e._rootTimeline, s = i.ticker.time;
            return arguments.length ? (t = t || 1e-10, n._startTime = s - (s - n._startTime) * n._timeScale / t, n = e._rootFramesTimeline, s = i.ticker.frame, n._startTime = s - (s - n._startTime) * n._timeScale / t, n._timeScale = e._rootTimeline._timeScale = t, t) : n._timeScale
        }, c.progress = function (e, t) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 != (1 & this._cycle) ? 1 - e : e) + this._cycle * (this._duration + this._repeatDelay), t) : this._time / this.duration()
        }, c.totalProgress = function (e, t) {
            return arguments.length ? this.totalTime(this.totalDuration() * e, t) : this._totalTime / this.totalDuration()
        }, c.time = function (e, t) {
            return arguments.length ? (this._dirty && this.totalDuration(), e > this._duration && (e = this._duration), this._yoyo && 0 != (1 & this._cycle) ? e = this._duration - e + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (e += this._cycle * (this._duration + this._repeatDelay)), this.totalTime(e, t)) : this._time
        }, c.duration = function (t) {
            return arguments.length ? e.prototype.duration.call(this, t) : this._duration
        }, c.totalDuration = function (e) {
            return arguments.length ? -1 === this._repeat ? this : this.duration((e - this._repeat * this._repeatDelay) / (this._repeat + 1)) : (this._dirty && (this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat, this._dirty = !1), this._totalDuration)
        }, c.repeat = function (e) {
            return arguments.length ? (this._repeat = e, this._uncache(!0)) : this._repeat
        }, c.repeatDelay = function (e) {
            return arguments.length ? (this._repeatDelay = e, this._uncache(!0)) : this._repeatDelay
        }, c.yoyo = function (e) {
            return arguments.length ? (this._yoyo = e, this) : this._yoyo
        }, o
    }, !0), _gsScope._gsDefine("TimelineLite", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function (e, t, i) {
        var n = function (e) {
                t.call(this, e), this._labels = {}, this.autoRemoveChildren = !0 === this.vars.autoRemoveChildren, this.smoothChildTiming = !0 === this.vars.smoothChildTiming, this._sortChildren = !0, this._onUpdate = this.vars.onUpdate;
                var i, n, s = this.vars;
                for (n in s) i = s[n], a(i) && -1 !== i.join("").indexOf("{self}") && (s[n] = this._swapSelfInParams(i));
                a(s.tweens) && this.add(s.tweens, 0, s.align, s.stagger)
            }, s = i._internals, o = n._internals = {}, r = s.isSelector, a = s.isArray, l = s.lazyTweens, c = s.lazyRender,
            u = _gsScope._gsDefine.globals, d = function (e) {
                var t, i = {};
                for (t in e) i[t] = e[t];
                return i
            }, h = function (e, t, i) {
                var n, s, o = e.cycle;
                for (n in o) s = o[n], e[n] = "function" == typeof s ? s(i, t[i]) : s[i % s.length];
                delete e.cycle
            }, p = o.pauseCallback = function () {
            }, f = function (e) {
                var t, i = [], n = e.length;
                for (t = 0; t !== n; i.push(e[t++])) ;
                return i
            }, g = n.prototype = new t;
        return n.version = "1.20.3", g.constructor = n, g.kill()._gc = g._forcingPlayhead = g._hasPause = !1, g.to = function (e, t, n, s) {
            var o = n.repeat && u.TweenMax || i;
            return t ? this.add(new o(e, t, n), s) : this.set(e, n, s)
        }, g.from = function (e, t, n, s) {
            return this.add((n.repeat && u.TweenMax || i).from(e, t, n), s)
        }, g.fromTo = function (e, t, n, s, o) {
            var r = s.repeat && u.TweenMax || i;
            return t ? this.add(r.fromTo(e, t, n, s), o) : this.set(e, s, o)
        }, g.staggerTo = function (e, t, s, o, a, l, c, u) {
            var p, g, m = new n({
                onComplete: l,
                onCompleteParams: c,
                callbackScope: u,
                smoothChildTiming: this.smoothChildTiming
            }), v = s.cycle;
            for ("string" == typeof e && (e = i.selector(e) || e), e = e || [], r(e) && (e = f(e)), o = o || 0, o < 0 && (e = f(e), e.reverse(), o *= -1), g = 0; g < e.length; g++) p = d(s), p.startAt && (p.startAt = d(p.startAt), p.startAt.cycle && h(p.startAt, e, g)), v && (h(p, e, g), null != p.duration && (t = p.duration, delete p.duration)), m.to(e[g], t, p, g * o);
            return this.add(m, a)
        }, g.staggerFrom = function (e, t, i, n, s, o, r, a) {
            return i.immediateRender = 0 != i.immediateRender, i.runBackwards = !0, this.staggerTo(e, t, i, n, s, o, r, a)
        }, g.staggerFromTo = function (e, t, i, n, s, o, r, a, l) {
            return n.startAt = i, n.immediateRender = 0 != n.immediateRender && 0 != i.immediateRender, this.staggerTo(e, t, n, s, o, r, a, l)
        }, g.call = function (e, t, n, s) {
            return this.add(i.delayedCall(0, e, t, n), s)
        }, g.set = function (e, t, n) {
            return n = this._parseTimeOrLabel(n, 0, !0), null == t.immediateRender && (t.immediateRender = n === this._time && !this._paused), this.add(new i(e, 0, t), n)
        }, n.exportRoot = function (e, t) {
            e = e || {}, null == e.smoothChildTiming && (e.smoothChildTiming = !0);
            var s, o, r, a, l = new n(e), c = l._timeline;
            for (null == t && (t = !0), c._remove(l, !0), l._startTime = 0, l._rawPrevTime = l._time = l._totalTime = c._time, r = c._first; r;) a = r._next, t && r instanceof i && r.target === r.vars.onComplete || (o = r._startTime - r._delay, o < 0 && (s = 1), l.add(r, o)), r = a;
            return c.add(l, 0), s && l.totalDuration(), l
        }, g.add = function (s, o, r, l) {
            var c, u, d, h, p, f;
            if ("number" != typeof o && (o = this._parseTimeOrLabel(o, 0, !0, s)), !(s instanceof e)) {
                if (s instanceof Array || s && s.push && a(s)) {
                    for (r = r || "normal", l = l || 0, c = o, u = s.length, d = 0; d < u; d++) a(h = s[d]) && (h = new n({tweens: h})), this.add(h, c), "string" != typeof h && "function" != typeof h && ("sequence" === r ? c = h._startTime + h.totalDuration() / h._timeScale : "start" === r && (h._startTime -= h.delay())), c += l;
                    return this._uncache(!0)
                }
                if ("string" == typeof s) return this.addLabel(s, o);
                if ("function" != typeof s) throw"Cannot add " + s + " into the timeline; it is not a tween, timeline, function, or string.";
                s = i.delayedCall(0, s)
            }
            if (t.prototype.add.call(this, s, o), s._time && s.render((this.rawTime() - s._startTime) * s._timeScale, !1, !1), (this._gc || this._time === this._duration) && !this._paused && this._duration < this.duration()) for (p = this, f = p.rawTime() > s._startTime; p._timeline;) f && p._timeline.smoothChildTiming ? p.totalTime(p._totalTime, !0) : p._gc && p._enabled(!0, !1), p = p._timeline;
            return this
        }, g.remove = function (t) {
            if (t instanceof e) {
                this._remove(t, !1);
                var i = t._timeline = t.vars.useFrames ? e._rootFramesTimeline : e._rootTimeline;
                return t._startTime = (t._paused ? t._pauseTime : i._time) - (t._reversed ? t.totalDuration() - t._totalTime : t._totalTime) / t._timeScale, this
            }
            if (t instanceof Array || t && t.push && a(t)) {
                for (var n = t.length; --n > -1;) this.remove(t[n]);
                return this
            }
            return "string" == typeof t ? this.removeLabel(t) : this.kill(null, t)
        }, g._remove = function (e, i) {
            return t.prototype._remove.call(this, e, i), this._last ? this._time > this.duration() && (this._time = this._duration, this._totalTime = this._totalDuration) : this._time = this._totalTime = this._duration = this._totalDuration = 0, this
        }, g.append = function (e, t) {
            return this.add(e, this._parseTimeOrLabel(null, t, !0, e))
        }, g.insert = g.insertMultiple = function (e, t, i, n) {
            return this.add(e, t || 0, i, n)
        }, g.appendMultiple = function (e, t, i, n) {
            return this.add(e, this._parseTimeOrLabel(null, t, !0, e), i, n)
        }, g.addLabel = function (e, t) {
            return this._labels[e] = this._parseTimeOrLabel(t), this
        }, g.addPause = function (e, t, n, s) {
            var o = i.delayedCall(0, p, n, s || this);
            return o.vars.onComplete = o.vars.onReverseComplete = t, o.data = "isPause", this._hasPause = !0, this.add(o, e)
        }, g.removeLabel = function (e) {
            return delete this._labels[e], this
        }, g.getLabelTime = function (e) {
            return null != this._labels[e] ? this._labels[e] : -1
        }, g._parseTimeOrLabel = function (t, i, n, s) {
            var o, r;
            if (s instanceof e && s.timeline === this) this.remove(s); else if (s && (s instanceof Array || s.push && a(s))) for (r = s.length; --r > -1;) s[r] instanceof e && s[r].timeline === this && this.remove(s[r]);
            if (o = "number" != typeof t || i ? this.duration() > 99999999999 ? this.recent().endTime(!1) : this._duration : 0, "string" == typeof i) return this._parseTimeOrLabel(i, n && "number" == typeof t && null == this._labels[i] ? t - o : 0, n);
            if (i = i || 0, "string" != typeof t || !isNaN(t) && null == this._labels[t]) null == t && (t = o); else {
                if (-1 === (r = t.indexOf("="))) return null == this._labels[t] ? n ? this._labels[t] = o + i : i : this._labels[t] + i;
                i = parseInt(t.charAt(r - 1) + "1", 10) * Number(t.substr(r + 1)), t = r > 1 ? this._parseTimeOrLabel(t.substr(0, r - 1), 0, n) : o
            }
            return Number(t) + i
        }, g.seek = function (e, t) {
            return this.totalTime("number" == typeof e ? e : this._parseTimeOrLabel(e), !1 !== t)
        }, g.stop = function () {
            return this.paused(!0)
        }, g.gotoAndPlay = function (e, t) {
            return this.play(e, t)
        }, g.gotoAndStop = function (e, t) {
            return this.pause(e, t)
        }, g.render = function (e, t, i) {
            this._gc && this._enabled(!0, !1);
            var n, s, o, r, a, u, d, h = this._time, p = this._dirty ? this.totalDuration() : this._totalDuration,
                f = this._startTime, g = this._timeScale, m = this._paused;
            if (h !== this._time && (e += this._time - h), e >= p - 1e-7 && e >= 0) this._totalTime = this._time = p, this._reversed || this._hasPausedChild() || (s = !0, r = "onComplete", a = !!this._timeline.autoRemoveChildren,
            0 === this._duration && (e <= 0 && e >= -1e-7 || this._rawPrevTime < 0 || 1e-10 === this._rawPrevTime) && this._rawPrevTime !== e && this._first && (a = !0, this._rawPrevTime > 1e-10 && (r = "onReverseComplete"))), this._rawPrevTime = this._duration || !t || e || this._rawPrevTime === e ? e : 1e-10, e = p + 1e-4; else if (e < 1e-7) if (this._totalTime = this._time = 0, (0 !== h || 0 === this._duration && 1e-10 !== this._rawPrevTime && (this._rawPrevTime > 0 || e < 0 && this._rawPrevTime >= 0)) && (r = "onReverseComplete", s = this._reversed), e < 0) this._active = !1, this._timeline.autoRemoveChildren && this._reversed ? (a = s = !0, r = "onReverseComplete") : this._rawPrevTime >= 0 && this._first && (a = !0), this._rawPrevTime = e; else {
                if (this._rawPrevTime = this._duration || !t || e || this._rawPrevTime === e ? e : 1e-10, 0 === e && s) for (n = this._first; n && 0 === n._startTime;) n._duration || (s = !1), n = n._next;
                e = 0, this._initted || (a = !0)
            } else {
                if (this._hasPause && !this._forcingPlayhead && !t) {
                    if (e >= h) for (n = this._first; n && n._startTime <= e && !u;) n._duration || "isPause" !== n.data || n.ratio || 0 === n._startTime && 0 === this._rawPrevTime || (u = n), n = n._next; else for (n = this._last; n && n._startTime >= e && !u;) n._duration || "isPause" === n.data && n._rawPrevTime > 0 && (u = n), n = n._prev;
                    u && (this._time = e = u._startTime, this._totalTime = e + this._cycle * (this._totalDuration + this._repeatDelay))
                }
                this._totalTime = this._time = this._rawPrevTime = e
            }
            if (this._time !== h && this._first || i || a || u) {
                if (this._initted || (this._initted = !0), this._active || !this._paused && this._time !== h && e > 0 && (this._active = !0), 0 === h && this.vars.onStart && (0 === this._time && this._duration || t || this._callback("onStart")), (d = this._time) >= h) for (n = this._first; n && (o = n._next, d === this._time && (!this._paused || m));) (n._active || n._startTime <= d && !n._paused && !n._gc) && (u === n && this.pause(), n._reversed ? n.render((n._dirty ? n.totalDuration() : n._totalDuration) - (e - n._startTime) * n._timeScale, t, i) : n.render((e - n._startTime) * n._timeScale, t, i)), n = o; else for (n = this._last; n && (o = n._prev, d === this._time && (!this._paused || m));) {
                    if (n._active || n._startTime <= h && !n._paused && !n._gc) {
                        if (u === n) {
                            for (u = n._prev; u && u.endTime() > this._time;) u.render(u._reversed ? u.totalDuration() - (e - u._startTime) * u._timeScale : (e - u._startTime) * u._timeScale, t, i), u = u._prev;
                            u = null, this.pause()
                        }
                        n._reversed ? n.render((n._dirty ? n.totalDuration() : n._totalDuration) - (e - n._startTime) * n._timeScale, t, i) : n.render((e - n._startTime) * n._timeScale, t, i)
                    }
                    n = o
                }
                this._onUpdate && (t || (l.length && c(), this._callback("onUpdate"))), r && (this._gc || f !== this._startTime && g === this._timeScale || (0 === this._time || p >= this.totalDuration()) && (s && (l.length && c(), this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !t && this.vars[r] && this._callback(r)))
            }
        }, g._hasPausedChild = function () {
            for (var e = this._first; e;) {
                if (e._paused || e instanceof n && e._hasPausedChild()) return !0;
                e = e._next
            }
            return !1
        }, g.getChildren = function (e, t, n, s) {
            s = s || -9999999999;
            for (var o = [], r = this._first, a = 0; r;) r._startTime < s || (r instanceof i ? !1 !== t && (o[a++] = r) : (!1 !== n && (o[a++] = r), !1 !== e && (o = o.concat(r.getChildren(!0, t, n)), a = o.length))), r = r._next;
            return o
        }, g.getTweensOf = function (e, t) {
            var n, s, o = this._gc, r = [], a = 0;
            for (o && this._enabled(!0, !0), n = i.getTweensOf(e), s = n.length; --s > -1;) (n[s].timeline === this || t && this._contains(n[s])) && (r[a++] = n[s]);
            return o && this._enabled(!1, !0), r
        }, g.recent = function () {
            return this._recent
        }, g._contains = function (e) {
            for (var t = e.timeline; t;) {
                if (t === this) return !0;
                t = t.timeline
            }
            return !1
        }, g.shiftChildren = function (e, t, i) {
            i = i || 0;
            for (var n, s = this._first, o = this._labels; s;) s._startTime >= i && (s._startTime += e), s = s._next;
            if (t) for (n in o) o[n] >= i && (o[n] += e);
            return this._uncache(!0)
        }, g._kill = function (e, t) {
            if (!e && !t) return this._enabled(!1, !1);
            for (var i = t ? this.getTweensOf(t) : this.getChildren(!0, !0, !1), n = i.length, s = !1; --n > -1;) i[n]._kill(e, t) && (s = !0);
            return s
        }, g.clear = function (e) {
            var t = this.getChildren(!1, !0, !0), i = t.length;
            for (this._time = this._totalTime = 0; --i > -1;) t[i]._enabled(!1, !1);
            return !1 !== e && (this._labels = {}), this._uncache(!0)
        }, g.invalidate = function () {
            for (var t = this._first; t;) t.invalidate(), t = t._next;
            return e.prototype.invalidate.call(this)
        }, g._enabled = function (e, i) {
            if (e === this._gc) for (var n = this._first; n;) n._enabled(e, !0), n = n._next;
            return t.prototype._enabled.call(this, e, i)
        }, g.totalTime = function (t, i, n) {
            this._forcingPlayhead = !0;
            var s = e.prototype.totalTime.apply(this, arguments);
            return this._forcingPlayhead = !1, s
        }, g.duration = function (e) {
            return arguments.length ? (0 !== this.duration() && 0 !== e && this.timeScale(this._duration / e), this) : (this._dirty && this.totalDuration(), this._duration)
        }, g.totalDuration = function (e) {
            if (!arguments.length) {
                if (this._dirty) {
                    for (var t, i, n = 0, s = this._last, o = 999999999999; s;) t = s._prev, s._dirty && s.totalDuration(), s._startTime > o && this._sortChildren && !s._paused && !this._calculatingDuration ? (this._calculatingDuration = 1, this.add(s, s._startTime - s._delay), this._calculatingDuration = 0) : o = s._startTime, s._startTime < 0 && !s._paused && (n -= s._startTime, this._timeline.smoothChildTiming && (this._startTime += s._startTime / this._timeScale, this._time -= s._startTime, this._totalTime -= s._startTime, this._rawPrevTime -= s._startTime), this.shiftChildren(-s._startTime, !1, -9999999999), o = 0), i = s._startTime + s._totalDuration / s._timeScale, i > n && (n = i), s = t;
                    this._duration = this._totalDuration = n, this._dirty = !1
                }
                return this._totalDuration
            }
            return e && this.totalDuration() ? this.timeScale(this._totalDuration / e) : this
        }, g.paused = function (t) {
            if (!t) for (var i = this._first, n = this._time; i;) i._startTime === n && "isPause" === i.data && (i._rawPrevTime = 0), i = i._next;
            return e.prototype.paused.apply(this, arguments)
        }, g.usesFrames = function () {
            for (var t = this._timeline; t._timeline;) t = t._timeline;
            return t === e._rootFramesTimeline
        }, g.rawTime = function (e) {
            return e && (this._paused || this._repeat && this.time() > 0 && this.totalProgress() < 1) ? this._totalTime % (this._duration + this._repeatDelay) : this._paused ? this._totalTime : (this._timeline.rawTime(e) - this._startTime) * this._timeScale
        }, n
    }, !0), _gsScope._gsDefine("TimelineMax", ["TimelineLite", "TweenLite", "easing.Ease"], function (e, t, i) {
        var n = function (t) {
                e.call(this, t), this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._cycle = 0, this._yoyo = !0 === this.vars.yoyo, this._dirty = !0
            }, s = t._internals, o = s.lazyTweens, r = s.lazyRender, a = _gsScope._gsDefine.globals,
            l = new i(null, null, 1, 0), c = n.prototype = new e;
        return c.constructor = n, c.kill()._gc = !1, n.version = "1.20.3", c.invalidate = function () {
            return this._yoyo = !0 === this.vars.yoyo, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), e.prototype.invalidate.call(this)
        }, c.addCallback = function (e, i, n, s) {
            return this.add(t.delayedCall(0, e, n, s), i)
        }, c.removeCallback = function (e, t) {
            if (e) if (null == t) this._kill(null, e); else for (var i = this.getTweensOf(e, !1), n = i.length, s = this._parseTimeOrLabel(t); --n > -1;) i[n]._startTime === s && i[n]._enabled(!1, !1);
            return this
        }, c.removePause = function (t) {
            return this.removeCallback(e._internals.pauseCallback, t)
        }, c.tweenTo = function (e, i) {
            i = i || {};
            var n, s, o, r = {ease: l, useFrames: this.usesFrames(), immediateRender: !1},
                c = i.repeat && a.TweenMax || t;
            for (s in i) r[s] = i[s];
            return r.time = this._parseTimeOrLabel(e), n = Math.abs(Number(r.time) - this._time) / this._timeScale || .001, o = new c(this, n, r), r.onStart = function () {
                o.target.paused(!0), o.vars.time !== o.target.time() && n === o.duration() && o.duration(Math.abs(o.vars.time - o.target.time()) / o.target._timeScale), i.onStart && i.onStart.apply(i.onStartScope || i.callbackScope || o, i.onStartParams || [])
            }, o
        }, c.tweenFromTo = function (e, t, i) {
            i = i || {}, e = this._parseTimeOrLabel(e), i.startAt = {
                onComplete: this.seek,
                onCompleteParams: [e],
                callbackScope: this
            }, i.immediateRender = !1 !== i.immediateRender;
            var n = this.tweenTo(t, i);
            return n.duration(Math.abs(n.vars.time - e) / this._timeScale || .001)
        }, c.render = function (e, t, i) {
            this._gc && this._enabled(!0, !1);
            var n, s, a, l, c, u, d, h, p = this._time, f = this._dirty ? this.totalDuration() : this._totalDuration,
                g = this._duration, m = this._totalTime, v = this._startTime, y = this._timeScale,
                x = this._rawPrevTime, b = this._paused, _ = this._cycle;
            if (p !== this._time && (e += this._time - p), e >= f - 1e-7 && e >= 0) this._locked || (this._totalTime = f, this._cycle = this._repeat), this._reversed || this._hasPausedChild() || (s = !0, l = "onComplete", c = !!this._timeline.autoRemoveChildren, 0 === this._duration && (e <= 0 && e >= -1e-7 || x < 0 || 1e-10 === x) && x !== e && this._first && (c = !0, x > 1e-10 && (l = "onReverseComplete"))), this._rawPrevTime = this._duration || !t || e || this._rawPrevTime === e ? e : 1e-10, this._yoyo && 0 != (1 & this._cycle) ? this._time = e = 0 : (this._time = g, e = g + 1e-4); else if (e < 1e-7) if (this._locked || (this._totalTime = this._cycle = 0), this._time = 0, (0 !== p || 0 === g && 1e-10 !== x && (x > 0 || e < 0 && x >= 0) && !this._locked) && (l = "onReverseComplete", s = this._reversed), e < 0) this._active = !1, this._timeline.autoRemoveChildren && this._reversed ? (c = s = !0, l = "onReverseComplete") : x >= 0 && this._first && (c = !0), this._rawPrevTime = e; else {
                if (this._rawPrevTime = g || !t || e || this._rawPrevTime === e ? e : 1e-10, 0 === e && s) for (n = this._first; n && 0 === n._startTime;) n._duration || (s = !1), n = n._next;
                e = 0, this._initted || (c = !0)
            } else if (0 === g && x < 0 && (c = !0), this._time = this._rawPrevTime = e, this._locked || (this._totalTime = e, 0 !== this._repeat && (u = g + this._repeatDelay, this._cycle = this._totalTime / u >> 0, 0 !== this._cycle && this._cycle === this._totalTime / u && m <= e && this._cycle--, this._time = this._totalTime - this._cycle * u, this._yoyo && 0 != (1 & this._cycle) && (this._time = g - this._time), this._time > g ? (this._time = g, e = g + 1e-4) : this._time < 0 ? this._time = e = 0 : e = this._time)), this._hasPause && !this._forcingPlayhead && !t) {
                if ((e = this._time) >= p || this._repeat && _ !== this._cycle) for (n = this._first; n && n._startTime <= e && !d;) n._duration || "isPause" !== n.data || n.ratio || 0 === n._startTime && 0 === this._rawPrevTime || (d = n), n = n._next; else for (n = this._last; n && n._startTime >= e && !d;) n._duration || "isPause" === n.data && n._rawPrevTime > 0 && (d = n), n = n._prev;
                d && d._startTime < g && (this._time = e = d._startTime, this._totalTime = e + this._cycle * (this._totalDuration + this._repeatDelay))
            }
            if (this._cycle !== _ && !this._locked) {
                var w = this._yoyo && 0 != (1 & _), T = w === (this._yoyo && 0 != (1 & this._cycle)),
                    k = this._totalTime, $ = this._cycle, S = this._rawPrevTime, C = this._time;
                if (this._totalTime = _ * g, this._cycle < _ ? w = !w : this._totalTime += g, this._time = p, this._rawPrevTime = 0 === g ? x - 1e-4 : x, this._cycle = _, this._locked = !0, p = w ? 0 : g, this.render(p, t, 0 === g), t || this._gc || this.vars.onRepeat && (this._cycle = $, this._locked = !1, this._callback("onRepeat")), p !== this._time) return;
                if (T && (this._cycle = _, this._locked = !0, p = w ? g + 1e-4 : -1e-4, this.render(p, !0, !1)), this._locked = !1, this._paused && !b) return;
                this._time = C, this._totalTime = k, this._cycle = $, this._rawPrevTime = S
            }
            if (!(this._time !== p && this._first || i || c || d)) return void(m !== this._totalTime && this._onUpdate && (t || this._callback("onUpdate")));
            if (this._initted || (this._initted = !0), this._active || !this._paused && this._totalTime !== m && e > 0 && (this._active = !0), 0 === m && this.vars.onStart && (0 === this._totalTime && this._totalDuration || t || this._callback("onStart")), (h = this._time) >= p) for (n = this._first; n && (a = n._next, h === this._time && (!this._paused || b));) (n._active || n._startTime <= this._time && !n._paused && !n._gc) && (d === n && this.pause(), n._reversed ? n.render((n._dirty ? n.totalDuration() : n._totalDuration) - (e - n._startTime) * n._timeScale, t, i) : n.render((e - n._startTime) * n._timeScale, t, i)), n = a; else for (n = this._last; n && (a = n._prev, h === this._time && (!this._paused || b));) {
                if (n._active || n._startTime <= p && !n._paused && !n._gc) {
                    if (d === n) {
                        for (d = n._prev; d && d.endTime() > this._time;) d.render(d._reversed ? d.totalDuration() - (e - d._startTime) * d._timeScale : (e - d._startTime) * d._timeScale, t, i), d = d._prev;
                        d = null, this.pause()
                    }
                    n._reversed ? n.render((n._dirty ? n.totalDuration() : n._totalDuration) - (e - n._startTime) * n._timeScale, t, i) : n.render((e - n._startTime) * n._timeScale, t, i)
                }
                n = a
            }
            this._onUpdate && (t || (o.length && r(), this._callback("onUpdate"))), l && (this._locked || this._gc || v !== this._startTime && y === this._timeScale || (0 === this._time || f >= this.totalDuration()) && (s && (o.length && r(), this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !t && this.vars[l] && this._callback(l)))
        }, c.getActive = function (e, t, i) {
            null == e && (e = !0), null == t && (t = !0), null == i && (i = !1);
            var n, s, o = [], r = this.getChildren(e, t, i), a = 0, l = r.length;
            for (n = 0; n < l; n++) s = r[n], s.isActive() && (o[a++] = s);
            return o
        }, c.getLabelAfter = function (e) {
            e || 0 !== e && (e = this._time);
            var t, i = this.getLabelsArray(), n = i.length;
            for (t = 0; t < n; t++) if (i[t].time > e) return i[t].name;
            return null
        }, c.getLabelBefore = function (e) {
            null == e && (e = this._time);
            for (var t = this.getLabelsArray(), i = t.length; --i > -1;) if (t[i].time < e) return t[i].name;
            return null
        }, c.getLabelsArray = function () {
            var e, t = [], i = 0;
            for (e in this._labels) t[i++] = {time: this._labels[e], name: e};
            return t.sort(function (e, t) {
                return e.time - t.time
            }), t
        }, c.invalidate = function () {
            return this._locked = !1, e.prototype.invalidate.call(this)
        }, c.progress = function (e, t) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 != (1 & this._cycle) ? 1 - e : e) + this._cycle * (this._duration + this._repeatDelay), t) : this._time / this.duration() || 0
        }, c.totalProgress = function (e, t) {
            return arguments.length ? this.totalTime(this.totalDuration() * e, t) : this._totalTime / this.totalDuration() || 0
        }, c.totalDuration = function (t) {
            return arguments.length ? -1 !== this._repeat && t ? this.timeScale(this.totalDuration() / t) : this : (this._dirty && (e.prototype.totalDuration.call(this), this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat), this._totalDuration)
        }, c.time = function (e, t) {
            return arguments.length ? (this._dirty && this.totalDuration(), e > this._duration && (e = this._duration), this._yoyo && 0 != (1 & this._cycle) ? e = this._duration - e + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (e += this._cycle * (this._duration + this._repeatDelay)), this.totalTime(e, t)) : this._time
        }, c.repeat = function (e) {
            return arguments.length ? (this._repeat = e, this._uncache(!0)) : this._repeat
        }, c.repeatDelay = function (e) {
            return arguments.length ? (this._repeatDelay = e, this._uncache(!0)) : this._repeatDelay
        }, c.yoyo = function (e) {
            return arguments.length ? (this._yoyo = e, this) : this._yoyo
        }, c.currentLabel = function (e) {
            return arguments.length ? this.seek(e, !0) : this.getLabelBefore(this._time + 1e-8)
        }, n
    }, !0), function () {
        var e = 180 / Math.PI, t = [], i = [], n = [], s = {}, o = _gsScope._gsDefine.globals,
            r = function (e, t, i, n) {
                i === n && (i = n - (n - t) / 1e6), e === t && (t = e + (i - e) / 1e6), this.a = e, this.b = t, this.c = i, this.d = n, this.da = n - e, this.ca = i - e, this.ba = t - e
            }, a = function (e, t, i, n) {
                var s = {a: e}, o = {}, r = {}, a = {c: n}, l = (e + t) / 2, c = (t + i) / 2, u = (i + n) / 2,
                    d = (l + c) / 2, h = (c + u) / 2, p = (h - d) / 8;
                return s.b = l + (e - l) / 4, o.b = d + p, s.c = o.a = (s.b + o.b) / 2, o.c = r.a = (d + h) / 2, r.b = h - p, a.b = u + (n - u) / 4, r.c = a.a = (r.b + a.b) / 2, [s, o, r, a]
            }, l = function (e, s, o, r, l) {
                var c, u, d, h, p, f, g, m, v, y, x, b, _, w = e.length - 1, T = 0, k = e[0].a;
                for (c = 0; c < w; c++) p = e[T], u = p.a, d = p.d, h = e[T + 1].d, l ? (x = t[c], b = i[c], _ = (b + x) * s * .25 / (r ? .5 : n[c] || .5), f = d - (d - u) * (r ? .5 * s : 0 !== x ? _ / x : 0), g = d + (h - d) * (r ? .5 * s : 0 !== b ? _ / b : 0), m = d - (f + ((g - f) * (3 * x / (x + b) + .5) / 4 || 0))) : (f = d - (d - u) * s * .5, g = d + (h - d) * s * .5, m = d - (f + g) / 2), f += m, g += m, p.c = v = f, p.b = 0 !== c ? k : k = p.a + .6 * (p.c - p.a), p.da = d - u, p.ca = v - u, p.ba = k - u, o ? (y = a(u, k, v, d), e.splice(T, 1, y[0], y[1], y[2], y[3]), T += 4) : T++, k = g;
                p = e[T], p.b = k, p.c = k + .4 * (p.d - k), p.da = p.d - p.a, p.ca = p.c - p.a, p.ba = k - p.a, o && (y = a(p.a, k, p.c, p.d), e.splice(T, 1, y[0], y[1], y[2], y[3]))
            }, c = function (e, n, s, o) {
                var a, l, c, u, d, h, p = [];
                if (o) for (e = [o].concat(e), l = e.length; --l > -1;) "string" == typeof(h = e[l][n]) && "=" === h.charAt(1) && (e[l][n] = o[n] + Number(h.charAt(0) + h.substr(2)));
                if ((a = e.length - 2) < 0) return p[0] = new r(e[0][n], 0, 0, e[0][n]), p;
                for (l = 0; l < a; l++) c = e[l][n], u = e[l + 1][n], p[l] = new r(c, 0, 0, u), s && (d = e[l + 2][n], t[l] = (t[l] || 0) + (u - c) * (u - c), i[l] = (i[l] || 0) + (d - u) * (d - u));
                return p[l] = new r(e[l][n], 0, 0, e[l + 1][n]), p
            }, u = function (e, o, r, a, u, d) {
                var h, p, f, g, m, v, y, x, b = {}, _ = [], w = d || e[0];
                u = "string" == typeof u ? "," + u + "," : ",x,y,z,left,top,right,bottom,marginTop,marginLeft,marginRight,marginBottom,paddingLeft,paddingTop,paddingRight,paddingBottom,backgroundPosition,backgroundPosition_y,", null == o && (o = 1);
                for (p in e[0]) _.push(p);
                if (e.length > 1) {
                    for (x = e[e.length - 1], y = !0, h = _.length; --h > -1;) if (p = _[h], Math.abs(w[p] - x[p]) > .05) {
                        y = !1;
                        break
                    }
                    y && (e = e.concat(), d && e.unshift(d), e.push(e[1]), d = e[e.length - 3])
                }
                for (t.length = i.length = n.length = 0, h = _.length; --h > -1;) p = _[h], s[p] = -1 !== u.indexOf("," + p + ","), b[p] = c(e, p, s[p], d);
                for (h = t.length; --h > -1;) t[h] = Math.sqrt(t[h]), i[h] = Math.sqrt(i[h]);
                if (!a) {
                    for (h = _.length; --h > -1;) if (s[p]) for (f = b[_[h]], v = f.length - 1, g = 0; g < v; g++) m = f[g + 1].da / i[g] + f[g].da / t[g] || 0, n[g] = (n[g] || 0) + m * m;
                    for (h = n.length; --h > -1;) n[h] = Math.sqrt(n[h])
                }
                for (h = _.length, g = r ? 4 : 1; --h > -1;) p = _[h], f = b[p], l(f, o, r, a, s[p]), y && (f.splice(0, g), f.splice(f.length - g, g));
                return b
            }, d = function (e, t, i) {
                t = t || "soft";
                var n, s, o, a, l, c, u, d, h, p, f, g = {}, m = "cubic" === t ? 3 : 2, v = "soft" === t, y = [];
                if (v && i && (e = [i].concat(e)), null == e || e.length < m + 1) throw"invalid Bezier data";
                for (h in e[0]) y.push(h);
                for (c = y.length; --c > -1;) {
                    for (h = y[c], g[h] = l = [], p = 0, d = e.length, u = 0; u < d; u++) n = null == i ? e[u][h] : "string" == typeof(f = e[u][h]) && "=" === f.charAt(1) ? i[h] + Number(f.charAt(0) + f.substr(2)) : Number(f), v && u > 1 && u < d - 1 && (l[p++] = (n + l[p - 2]) / 2), l[p++] = n;
                    for (d = p - m + 1, p = 0, u = 0; u < d; u += m) n = l[u], s = l[u + 1], o = l[u + 2], a = 2 === m ? 0 : l[u + 3], l[p++] = f = 3 === m ? new r(n, s, o, a) : new r(n, (2 * s + n) / 3, (2 * s + o) / 3, o);
                    l.length = p
                }
                return g
            }, h = function (e, t, i) {
                for (var n, s, o, r, a, l, c, u, d, h, p, f = 1 / i, g = e.length; --g > -1;) for (h = e[g], o = h.a, r = h.d - o, a = h.c - o, l = h.b - o, n = s = 0, u = 1; u <= i; u++) c = f * u, d = 1 - c, n = s - (s = (c * c * r + 3 * d * (c * a + d * l)) * c), p = g * i + u - 1, t[p] = (t[p] || 0) + n * n
            }, p = function (e, t) {
                t = t >> 0 || 6;
                var i, n, s, o, r = [], a = [], l = 0, c = 0, u = t - 1, d = [], p = [];
                for (i in e) h(e[i], r, t);
                for (s = r.length, n = 0; n < s; n++) l += Math.sqrt(r[n]), o = n % t, p[o] = l, o === u && (c += l, o = n / t >> 0, d[o] = p, a[o] = c, l = 0, p = []);
                return {length: c, lengths: a, segments: d}
            }, f = _gsScope._gsDefine.plugin({
                propName: "bezier", priority: -1, version: "1.3.8", API: 2, global: !0, init: function (e, t, i) {
                    this._target = e, t instanceof Array && (t = {values: t}), this._func = {}, this._mod = {}, this._props = [], this._timeRes = null == t.timeResolution ? 6 : parseInt(t.timeResolution, 10);
                    var n, s, o, r, a, l = t.values || [], c = {}, h = l[0], f = t.autoRotate || i.vars.orientToBezier;
                    this._autoRotate = f ? f instanceof Array ? f : [["x", "y", "rotation", !0 === f ? 0 : Number(f) || 0]] : null;
                    for (n in h) this._props.push(n);
                    for (o = this._props.length; --o > -1;) n = this._props[o], this._overwriteProps.push(n), s = this._func[n] = "function" == typeof e[n], c[n] = s ? e[n.indexOf("set") || "function" != typeof e["get" + n.substr(3)] ? n : "get" + n.substr(3)]() : parseFloat(e[n]), a || c[n] !== l[0][n] && (a = c);
                    if (this._beziers = "cubic" !== t.type && "quadratic" !== t.type && "soft" !== t.type ? u(l, isNaN(t.curviness) ? 1 : t.curviness, !1, "thruBasic" === t.type, t.correlate, a) : d(l, t.type, c), this._segCount = this._beziers[n].length, this._timeRes) {
                        var g = p(this._beziers, this._timeRes);
                        this._length = g.length, this._lengths = g.lengths, this._segments = g.segments, this._l1 = this._li = this._s1 = this._si = 0, this._l2 = this._lengths[0], this._curSeg = this._segments[0], this._s2 = this._curSeg[0], this._prec = 1 / this._curSeg.length
                    }
                    if (f = this._autoRotate) for (this._initialRotations = [], f[0] instanceof Array || (this._autoRotate = f = [f]), o = f.length; --o > -1;) {
                        for (r = 0; r < 3; r++) n = f[o][r], this._func[n] = "function" == typeof e[n] && e[n.indexOf("set") || "function" != typeof e["get" + n.substr(3)] ? n : "get" + n.substr(3)];
                        n = f[o][2], this._initialRotations[o] = (this._func[n] ? this._func[n].call(this._target) : this._target[n]) || 0, this._overwriteProps.push(n)
                    }
                    return this._startRatio = i.vars.runBackwards ? 1 : 0, !0
                }, set: function (t) {
                    var i, n, s, o, r, a, l, c, u, d, h = this._segCount, p = this._func, f = this._target,
                        g = t !== this._startRatio;
                    if (this._timeRes) {
                        if (u = this._lengths, d = this._curSeg, t *= this._length, s = this._li, t > this._l2 && s < h - 1) {
                            for (c = h - 1; s < c && (this._l2 = u[++s]) <= t;) ;
                            this._l1 = u[s - 1], this._li = s, this._curSeg = d = this._segments[s], this._s2 = d[this._s1 = this._si = 0]
                        } else if (t < this._l1 && s > 0) {
                            for (; s > 0 && (this._l1 = u[--s]) >= t;) ;
                            0 === s && t < this._l1 ? this._l1 = 0 : s++, this._l2 = u[s], this._li = s, this._curSeg = d = this._segments[s], this._s1 = d[(this._si = d.length - 1) - 1] || 0, this._s2 = d[this._si]
                        }
                        if (i = s, t -= this._l1, s = this._si, t > this._s2 && s < d.length - 1) {
                            for (c = d.length - 1; s < c && (this._s2 = d[++s]) <= t;) ;
                            this._s1 = d[s - 1], this._si = s
                        } else if (t < this._s1 && s > 0) {
                            for (; s > 0 && (this._s1 = d[--s]) >= t;) ;
                            0 === s && t < this._s1 ? this._s1 = 0 : s++, this._s2 = d[s], this._si = s
                        }
                        a = (s + (t - this._s1) / (this._s2 - this._s1)) * this._prec || 0
                    } else i = t < 0 ? 0 : t >= 1 ? h - 1 : h * t >> 0, a = (t - i * (1 / h)) * h;
                    for (n = 1 - a, s = this._props.length; --s > -1;) o = this._props[s], r = this._beziers[o][i], l = (a * a * r.da + 3 * n * (a * r.ca + n * r.ba)) * a + r.a, this._mod[o] && (l = this._mod[o](l, f)), p[o] ? f[o](l) : f[o] = l;
                    if (this._autoRotate) {
                        var m, v, y, x, b, _, w, T = this._autoRotate;
                        for (s = T.length; --s > -1;) o = T[s][2], _ = T[s][3] || 0, w = !0 === T[s][4] ? 1 : e, r = this._beziers[T[s][0]], m = this._beziers[T[s][1]], r && m && (r = r[i], m = m[i], v = r.a + (r.b - r.a) * a, x = r.b + (r.c - r.b) * a, v += (x - v) * a, x += (r.c + (r.d - r.c) * a - x) * a, y = m.a + (m.b - m.a) * a, b = m.b + (m.c - m.b) * a, y += (b - y) * a, b += (m.c + (m.d - m.c) * a - b) * a, l = g ? Math.atan2(b - y, x - v) * w + _ : this._initialRotations[s], this._mod[o] && (l = this._mod[o](l, f)), p[o] ? f[o](l) : f[o] = l)
                    }
                }
            }), g = f.prototype;
        f.bezierThrough = u, f.cubicToQuadratic = a, f._autoCSS = !0, f.quadraticToCubic = function (e, t, i) {
            return new r(e, (2 * t + e) / 3, (2 * t + i) / 3, i)
        }, f._cssRegister = function () {
            var e = o.CSSPlugin;
            if (e) {
                var t = e._internals, i = t._parseToProxy, n = t._setPluginRatio, s = t.CSSPropTween;
                t._registerComplexSpecialProp("bezier", {
                    parser: function (e, t, o, r, a, l) {
                        t instanceof Array && (t = {values: t}), l = new f;
                        var c, u, d, h = t.values, p = h.length - 1, g = [], m = {};
                        if (p < 0) return a;
                        for (c = 0; c <= p; c++) d = i(e, h[c], r, a, l, p !== c), g[c] = d.end;
                        for (u in t) m[u] = t[u];
                        return m.values = g, a = new s(e, "bezier", 0, 0, d.pt, 2), a.data = d, a.plugin = l, a.setRatio = n, 0 === m.autoRotate && (m.autoRotate = !0), !m.autoRotate || m.autoRotate instanceof Array || (c = !0 === m.autoRotate ? 0 : Number(m.autoRotate), m.autoRotate = null != d.end.left ? [["left", "top", "rotation", c, !1]] : null != d.end.x && [["x", "y", "rotation", c, !1]]), m.autoRotate && (r._transform || r._enableTransforms(!1), d.autoRotate = r._target._gsTransform, d.proxy.rotation = d.autoRotate.rotation || 0, r._overwriteProps.push("rotation")), l._onInitTween(d.proxy, m, r._tween), a
                    }
                })
            }
        }, g._mod = function (e) {
            for (var t, i = this._overwriteProps, n = i.length; --n > -1;) (t = e[i[n]]) && "function" == typeof t && (this._mod[i[n]] = t)
        }, g._kill = function (e) {
            var t, i, n = this._props;
            for (t in this._beziers) if (t in e) for (delete this._beziers[t], delete this._func[t], i = n.length; --i > -1;) n[i] === t && n.splice(i, 1);
            if (n = this._autoRotate) for (i = n.length; --i > -1;) e[n[i][2]] && n.splice(i, 1);
            return this._super._kill.call(this, e)
        }
    }(), _gsScope._gsDefine("plugins.CSSPlugin", ["plugins.TweenPlugin", "TweenLite"], function (e, t) {
        var i, n, s, o, r = function () {
            e.call(this, "css"), this._overwriteProps.length = 0, this.setRatio = r.prototype.setRatio
        }, a = _gsScope._gsDefine.globals, l = {}, c = r.prototype = new e("css");
        c.constructor = r, r.version = "1.20.3", r.API = 2, r.defaultTransformPerspective = 0, r.defaultSkewType = "compensated", r.defaultSmoothOrigin = !0, c = "px", r.suffixMap = {
            top: c,
            right: c,
            bottom: c,
            left: c,
            width: c,
            height: c,
            fontSize: c,
            padding: c,
            margin: c,
            perspective: c,
            lineHeight: ""
        };
        var u, d, h, p, f, g, m, v, y = /(?:\-|\.|\b)(\d|\.|e\-)+/g,
            x = /(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g,
            b = /(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi,
            _ = /(?![+-]?\d*\.?\d+|[+-]|e[+-]\d+)[^0-9]/g, w = /(?:\d|\-|\+|=|#|\.)*/g, T = /opacity *= *([^)]*)/i,
            k = /opacity:([^;]*)/i, $ = /alpha\(opacity *=.+?\)/i, S = /^(rgb|hsl)/,
            C = /([A-Z])/g, P = /-([a-z])/gi, O = /(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi, A = function (e, t) {
                return t.toUpperCase()
            }, L = /(?:Left|Right|Width)/i, D = /(M11|M12|M21|M22)=[\d\-\.e]+/gi,
            M = /progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i, E = /,(?=[^\)]*(?:\(|$))/gi, F = /[\s,\(]/i,
            R = Math.PI / 180,
            j = 180 / Math.PI, I = {}, H = {style: {}}, N = _gsScope.document || {
                createElement: function () {
                    return H
                }
            }, z = function (e, t) {
                return N.createElementNS ? N.createElementNS(t || "http://www.w3.org/1999/xhtml", e) : N.createElement(e)
            }, X = z("div"), q = z("img"), Y = r._internals = {_specialProps: l},
            B = (_gsScope.navigator || {}).userAgent || "", W = function () {
                var e = B.indexOf("Android"), t = z("a");
                return h = -1 !== B.indexOf("Safari") && -1 === B.indexOf("Chrome") && (-1 === e || parseFloat(B.substr(e + 8, 2)) > 3), f = h && parseFloat(B.substr(B.indexOf("Version/") + 8, 2)) < 6, p = -1 !== B.indexOf("Firefox"), (/MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(B) || /Trident\/.*rv:([0-9]{1,}[\.0-9]{0,})/.exec(B)) && (g = parseFloat(RegExp.$1)), !!t && (t.style.cssText = "top:1px;opacity:.55;", /^0.55/.test(t.style.opacity))
            }(), U = function (e) {
                return T.test("string" == typeof e ? e : (e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? parseFloat(RegExp.$1) / 100 : 1
            }, V = function (e) {
                _gsScope.console && console.log(e)
            }, G = "", Z = "", Q = function (e, t) {
                t = t || X;
                var i, n, s = t.style;
                if (void 0 !== s[e]) return e;
                for (e = e.charAt(0).toUpperCase() + e.substr(1), i = ["O", "Moz", "ms", "Ms", "Webkit"], n = 5; --n > -1 && void 0 === s[i[n] + e];) ;
                return n >= 0 ? (Z = 3 === n ? "ms" : i[n], G = "-" + Z.toLowerCase() + "-", Z + e) : null
            }, K = N.defaultView ? N.defaultView.getComputedStyle : function () {
            }, J = r.getStyle = function (e, t, i, n, s) {
                var o;
                return W || "opacity" !== t ? (!n && e.style[t] ? o = e.style[t] : (i = i || K(e)) ? o = i[t] || i.getPropertyValue(t) || i.getPropertyValue(t.replace(C, "-$1").toLowerCase()) : e.currentStyle && (o = e.currentStyle[t]), null == s || o && "none" !== o && "auto" !== o && "auto auto" !== o ? o : s) : U(e)
            }, ee = Y.convertToPixels = function (e, i, n, s, o) {
                if ("px" === s || !s && "lineHeight" !== i) return n;
                if ("auto" === s || !n) return 0;
                var a, l, c, u = L.test(i), d = e, h = X.style, p = n < 0, f = 1 === n;
                if (p && (n = -n), f && (n *= 100), "lineHeight" !== i || s) if ("%" === s && -1 !== i.indexOf("border")) a = n / 100 * (u ? e.clientWidth : e.clientHeight); else {
                    if (h.cssText = "border:0 solid red;position:" + J(e, "position") + ";line-height:0;", "%" !== s && d.appendChild && "v" !== s.charAt(0) && "rem" !== s) h[u ? "borderLeftWidth" : "borderTopWidth"] = n + s; else {
                        if (d = e.parentNode || N.body, -1 !== J(d, "display").indexOf("flex") && (h.position = "absolute"), l = d._gsCache, c = t.ticker.frame, l && u && l.time === c) return l.width * n / 100;
                        h[u ? "width" : "height"] = n + s
                    }
                    d.appendChild(X), a = parseFloat(X[u ? "offsetWidth" : "offsetHeight"]), d.removeChild(X), u && "%" === s && !1 !== r.cacheWidths && (l = d._gsCache = d._gsCache || {}, l.time = c, l.width = a / n * 100), 0 !== a || o || (a = ee(e, i, n, s, !0))
                } else l = K(e).lineHeight, e.style.lineHeight = n, a = parseFloat(K(e).lineHeight), e.style.lineHeight = l;
                return f && (a /= 100), p ? -a : a
            }, te = Y.calculateOffset = function (e, t, i) {
                if ("absolute" !== J(e, "position", i)) return 0;
                var n = "left" === t ? "Left" : "Top", s = J(e, "margin" + n, i);
                return e["offset" + n] - (ee(e, t, parseFloat(s), s.replace(w, "")) || 0)
            }, ie = function (e, t) {
                var i, n, s, o = {};
                if (t = t || K(e, null)) if (i = t.length) for (; --i > -1;) s = t[i], -1 !== s.indexOf("-transform") && Oe !== s || (o[s.replace(P, A)] = t.getPropertyValue(s)); else for (i in t) -1 !== i.indexOf("Transform") && Pe !== i || (o[i] = t[i]); else if (t = e.currentStyle || e.style) for (i in t) "string" == typeof i && void 0 === o[i] && (o[i.replace(P, A)] = t[i]);
                return W || (o.opacity = U(e)), n = qe(e, t, !1), o.rotation = n.rotation, o.skewX = n.skewX, o.scaleX = n.scaleX, o.scaleY = n.scaleY, o.x = n.x, o.y = n.y, Le && (o.z = n.z, o.rotationX = n.rotationX, o.rotationY = n.rotationY, o.scaleZ = n.scaleZ), o.filters && delete o.filters, o
            }, ne = function (e, t, i, n, s) {
                var o, r, a, l = {}, c = e.style;
                for (r in i) "cssText" !== r && "length" !== r && isNaN(r) && (t[r] !== (o = i[r]) || s && s[r]) && -1 === r.indexOf("Origin") && ("number" != typeof o && "string" != typeof o || (l[r] = "auto" !== o || "left" !== r && "top" !== r ? "" !== o && "auto" !== o && "none" !== o || "string" != typeof t[r] || "" === t[r].replace(_, "") ? o : 0 : te(e, r), void 0 !== c[r] && (a = new ye(c, r, c[r], a))));
                if (n) for (r in n) "className" !== r && (l[r] = n[r]);
                return {difs: l, firstMPT: a}
            }, se = {width: ["Left", "Right"], height: ["Top", "Bottom"]},
            oe = ["marginLeft", "marginRight", "marginTop", "marginBottom"], re = function (e, t, i) {
                if ("svg" === (e.nodeName + "").toLowerCase()) return (i || K(e))[t] || 0;
                if (e.getCTM && Ne(e)) return e.getBBox()[t] || 0;
                var n = parseFloat("width" === t ? e.offsetWidth : e.offsetHeight), s = se[t], o = s.length;
                for (i = i || K(e, null); --o > -1;) n -= parseFloat(J(e, "padding" + s[o], i, !0)) || 0, n -= parseFloat(J(e, "border" + s[o] + "Width", i, !0)) || 0;
                return n
            }, ae = function (e, t) {
                if ("contain" === e || "auto" === e || "auto auto" === e) return e + " ";
                null != e && "" !== e || (e = "0 0");
                var i, n = e.split(" "), s = -1 !== e.indexOf("left") ? "0%" : -1 !== e.indexOf("right") ? "100%" : n[0],
                    o = -1 !== e.indexOf("top") ? "0%" : -1 !== e.indexOf("bottom") ? "100%" : n[1];
                if (n.length > 3 && !t) {
                    for (n = e.split(", ").join(",").split(","), e = [], i = 0; i < n.length; i++) e.push(ae(n[i]));
                    return e.join(",")
                }
                return null == o ? o = "center" === s ? "50%" : "0" : "center" === o && (o = "50%"), ("center" === s || isNaN(parseFloat(s)) && -1 === (s + "").indexOf("=")) && (s = "50%"), e = s + " " + o + (n.length > 2 ? " " + n[2] : ""), t && (t.oxp = -1 !== s.indexOf("%"), t.oyp = -1 !== o.indexOf("%"), t.oxr = "=" === s.charAt(1), t.oyr = "=" === o.charAt(1), t.ox = parseFloat(s.replace(_, "")), t.oy = parseFloat(o.replace(_, "")), t.v = e), t || e
            }, le = function (e, t) {
                return "function" == typeof e && (e = e(v, m)), "string" == typeof e && "=" === e.charAt(1) ? parseInt(e.charAt(0) + "1", 10) * parseFloat(e.substr(2)) : parseFloat(e) - parseFloat(t) || 0
            }, ce = function (e, t) {
                return "function" == typeof e && (e = e(v, m)), null == e ? t : "string" == typeof e && "=" === e.charAt(1) ? parseInt(e.charAt(0) + "1", 10) * parseFloat(e.substr(2)) + t : parseFloat(e) || 0
            }, ue = function (e, t, i, n) {
                var s, o, r, a, l;
                return "function" == typeof e && (e = e(v, m)), null == e ? a = t : "number" == typeof e ? a = e : (s = 360, o = e.split("_"), l = "=" === e.charAt(1), r = (l ? parseInt(e.charAt(0) + "1", 10) * parseFloat(o[0].substr(2)) : parseFloat(o[0])) * (-1 === e.indexOf("rad") ? 1 : j) - (l ? 0 : t), o.length && (n && (n[i] = t + r), -1 !== e.indexOf("short") && (r %= s) !== r % (s / 2) && (r = r < 0 ? r + s : r - s), -1 !== e.indexOf("_cw") && r < 0 ? r = (r + 9999999999 * s) % s - (r / s | 0) * s : -1 !== e.indexOf("ccw") && r > 0 && (r = (r - 9999999999 * s) % s - (r / s | 0) * s)), a = t + r), a < 1e-6 && a > -1e-6 && (a = 0), a
            }, de = {
                aqua: [0, 255, 255],
                lime: [0, 255, 0],
                silver: [192, 192, 192],
                black: [0, 0, 0],
                maroon: [128, 0, 0],
                teal: [0, 128, 128],
                blue: [0, 0, 255],
                navy: [0, 0, 128],
                white: [255, 255, 255],
                fuchsia: [255, 0, 255],
                olive: [128, 128, 0],
                yellow: [255, 255, 0],
                orange: [255, 165, 0],
                gray: [128, 128, 128],
                purple: [128, 0, 128],
                green: [0, 128, 0],
                red: [255, 0, 0],
                pink: [255, 192, 203],
                cyan: [0, 255, 255],
                transparent: [255, 255, 255, 0]
            }, he = function (e, t, i) {
                return e = e < 0 ? e + 1 : e > 1 ? e - 1 : e, 255 * (6 * e < 1 ? t + (i - t) * e * 6 : e < .5 ? i : 3 * e < 2 ? t + (i - t) * (2 / 3 - e) * 6 : t) + .5 | 0
            }, pe = r.parseColor = function (e, t) {
                var i, n, s, o, r, a, l, c, u, d, h;
                if (e) if ("number" == typeof e) i = [e >> 16, e >> 8 & 255, 255 & e]; else {
                    if ("," === e.charAt(e.length - 1) && (e = e.substr(0, e.length - 1)), de[e]) i = de[e]; else if ("#" === e.charAt(0)) 4 === e.length && (n = e.charAt(1), s = e.charAt(2), o = e.charAt(3), e = "#" + n + n + s + s + o + o), e = parseInt(e.substr(1), 16), i = [e >> 16, e >> 8 & 255, 255 & e]; else if ("hsl" === e.substr(0, 3)) if (i = h = e.match(y), t) {
                        if (-1 !== e.indexOf("=")) return e.match(x)
                    } else r = Number(i[0]) % 360 / 360, a = Number(i[1]) / 100, l = Number(i[2]) / 100, s = l <= .5 ? l * (a + 1) : l + a - l * a, n = 2 * l - s, i.length > 3 && (i[3] = Number(i[3])), i[0] = he(r + 1 / 3, n, s), i[1] = he(r, n, s), i[2] = he(r - 1 / 3, n, s); else i = e.match(y) || de.transparent;
                    i[0] = Number(i[0]), i[1] = Number(i[1]), i[2] = Number(i[2]), i.length > 3 && (i[3] = Number(i[3]))
                } else i = de.black;
                return t && !h && (n = i[0] / 255, s = i[1] / 255, o = i[2] / 255, c = Math.max(n, s, o), u = Math.min(n, s, o), l = (c + u) / 2, c === u ? r = a = 0 : (d = c - u, a = l > .5 ? d / (2 - c - u) : d / (c + u), r = c === n ? (s - o) / d + (s < o ? 6 : 0) : c === s ? (o - n) / d + 2 : (n - s) / d + 4, r *= 60), i[0] = r + .5 | 0, i[1] = 100 * a + .5 | 0, i[2] = 100 * l + .5 | 0), i
            }, fe = function (e, t) {
                var i, n, s, o = e.match(ge) || [], r = 0, a = "";
                if (!o.length) return e;
                for (i = 0; i < o.length; i++) n = o[i], s = e.substr(r, e.indexOf(n, r) - r), r += s.length + n.length, n = pe(n, t), 3 === n.length && n.push(1), a += s + (t ? "hsla(" + n[0] + "," + n[1] + "%," + n[2] + "%," + n[3] : "rgba(" + n.join(",")) + ")";
                return a + e.substr(r)
            }, ge = "(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#(?:[0-9a-f]{3}){1,2}\\b";
        for (c in de) ge += "|" + c + "\\b";
        ge = new RegExp(ge + ")", "gi"), r.colorStringFilter = function (e) {
            var t, i = e[0] + " " + e[1];
            ge.test(i) && (t = -1 !== i.indexOf("hsl(") || -1 !== i.indexOf("hsla("), e[0] = fe(e[0], t), e[1] = fe(e[1], t)), ge.lastIndex = 0
        }, t.defaultStringFilter || (t.defaultStringFilter = r.colorStringFilter);
        var me = function (e, t, i, n) {
            if (null == e) return function (e) {
                return e
            };
            var s, o = t ? (e.match(ge) || [""])[0] : "", r = e.split(o).join("").match(b) || [],
                a = e.substr(0, e.indexOf(r[0])), l = ")" === e.charAt(e.length - 1) ? ")" : "",
                c = -1 !== e.indexOf(" ") ? " " : ",", u = r.length, d = u > 0 ? r[0].replace(y, "") : "";
            return u ? s = t ? function (e) {
                var t, h, p, f;
                if ("number" == typeof e) e += d; else if (n && E.test(e)) {
                    for (f = e.replace(E, "|").split("|"), p = 0; p < f.length; p++) f[p] = s(f[p]);
                    return f.join(",")
                }
                if (t = (e.match(ge) || [o])[0], h = e.split(t).join("").match(b) || [], p = h.length, u > p--) for (; ++p < u;) h[p] = i ? h[(p - 1) / 2 | 0] : r[p];
                return a + h.join(c) + c + t + l + (-1 !== e.indexOf("inset") ? " inset" : "")
            } : function (e) {
                var t, o, h;
                if ("number" == typeof e) e += d; else if (n && E.test(e)) {
                    for (o = e.replace(E, "|").split("|"), h = 0; h < o.length; h++) o[h] = s(o[h]);
                    return o.join(",")
                }
                if (t = e.match(b) || [], h = t.length, u > h--) for (; ++h < u;) t[h] = i ? t[(h - 1) / 2 | 0] : r[h];
                return a + t.join(c) + l
            } : function (e) {
                return e
            }
        }, ve = function (e) {
            return e = e.split(","), function (t, i, n, s, o, r, a) {
                var l, c = (i + "").split(" ");
                for (a = {}, l = 0; l < 4; l++) a[e[l]] = c[l] = c[l] || c[(l - 1) / 2 >> 0];
                return s.parse(t, a, o, r)
            }
        }, ye = (Y._setPluginRatio = function (e) {
            this.plugin.setRatio(e);
            for (var t, i, n, s, o, r = this.data, a = r.proxy, l = r.firstMPT; l;) t = a[l.v], l.r ? t = Math.round(t) : t < 1e-6 && t > -1e-6 && (t = 0), l.t[l.p] = t, l = l._next
            ;
            if (r.autoRotate && (r.autoRotate.rotation = r.mod ? r.mod(a.rotation, this.t) : a.rotation), 1 === e || 0 === e) for (l = r.firstMPT, o = 1 === e ? "e" : "b"; l;) {
                if (i = l.t, i.type) {
                    if (1 === i.type) {
                        for (s = i.xs0 + i.s + i.xs1, n = 1; n < i.l; n++) s += i["xn" + n] + i["xs" + (n + 1)];
                        i[o] = s
                    }
                } else i[o] = i.s + i.xs0;
                l = l._next
            }
        }, function (e, t, i, n, s) {
            this.t = e, this.p = t, this.v = i, this.r = s, n && (n._prev = this, this._next = n)
        }), xe = (Y._parseToProxy = function (e, t, i, n, s, o) {
            var r, a, l, c, u, d = n, h = {}, p = {}, f = i._transform, g = I;
            for (i._transform = null, I = t, n = u = i.parse(e, t, n, s), I = g, o && (i._transform = f, d && (d._prev = null, d._prev && (d._prev._next = null))); n && n !== d;) {
                if (n.type <= 1 && (a = n.p, p[a] = n.s + n.c, h[a] = n.s, o || (c = new ye(n, "s", a, c, n.r), n.c = 0), 1 === n.type)) for (r = n.l; --r > 0;) l = "xn" + r, a = n.p + "_" + l, p[a] = n.data[l], h[a] = n[l], o || (c = new ye(n, l, a, c, n.rxp[l]));
                n = n._next
            }
            return {proxy: h, end: p, firstMPT: c, pt: u}
        }, Y.CSSPropTween = function (e, t, n, s, r, a, l, c, u, d, h) {
            this.t = e, this.p = t, this.s = n, this.c = s, this.n = l || t, e instanceof xe || o.push(this.n), this.r = c, this.type = a || 0, u && (this.pr = u, i = !0), this.b = void 0 === d ? n : d, this.e = void 0 === h ? n + s : h, r && (this._next = r, r._prev = this)
        }), be = function (e, t, i, n, s, o) {
            var r = new xe(e, t, i, n - i, s, -1, o);
            return r.b = i, r.e = r.xs0 = n, r
        }, _e = r.parseComplex = function (e, t, i, n, s, o, a, l, c, d) {
            i = i || o || "", "function" == typeof n && (n = n(v, m)), a = new xe(e, t, 0, 0, a, d ? 2 : 1, null, !1, l, i, n), n += "", s && ge.test(n + i) && (n = [i, n], r.colorStringFilter(n), i = n[0], n = n[1]);
            var h, p, f, g, b, _, w, T, k, $, S, C, P, O = i.split(", ").join(",").split(" "),
                A = n.split(", ").join(",").split(" "), L = O.length, D = !1 !== u;
            for (-1 === n.indexOf(",") && -1 === i.indexOf(",") || (-1 !== (n + i).indexOf("rgb") || -1 !== (n + i).indexOf("hsl") ? (O = O.join(" ").replace(E, ", ").split(" "), A = A.join(" ").replace(E, ", ").split(" ")) : (O = O.join(" ").split(",").join(", ").split(" "), A = A.join(" ").split(",").join(", ").split(" ")), L = O.length), L !== A.length && (O = (o || "").split(" "), L = O.length), a.plugin = c, a.setRatio = d, ge.lastIndex = 0, h = 0; h < L; h++) if (g = O[h], b = A[h], (T = parseFloat(g)) || 0 === T) a.appendXtra("", T, le(b, T), b.replace(x, ""), D && -1 !== b.indexOf("px"), !0); else if (s && ge.test(g)) C = b.indexOf(")") + 1, C = ")" + (C ? b.substr(C) : ""), P = -1 !== b.indexOf("hsl") && W, $ = b, g = pe(g, P), b = pe(b, P), k = g.length + b.length > 6, k && !W && 0 === b[3] ? (a["xs" + a.l] += a.l ? " transparent" : "transparent", a.e = a.e.split(A[h]).join("transparent")) : (W || (k = !1), P ? a.appendXtra($.substr(0, $.indexOf("hsl")) + (k ? "hsla(" : "hsl("), g[0], le(b[0], g[0]), ",", !1, !0).appendXtra("", g[1], le(b[1], g[1]), "%,", !1).appendXtra("", g[2], le(b[2], g[2]), k ? "%," : "%" + C, !1) : a.appendXtra($.substr(0, $.indexOf("rgb")) + (k ? "rgba(" : "rgb("), g[0], b[0] - g[0], ",", !0, !0).appendXtra("", g[1], b[1] - g[1], ",", !0).appendXtra("", g[2], b[2] - g[2], k ? "," : C, !0), k && (g = g.length < 4 ? 1 : g[3], a.appendXtra("", g, (b.length < 4 ? 1 : b[3]) - g, C, !1))), ge.lastIndex = 0; else if (_ = g.match(y)) {
                if (!(w = b.match(x)) || w.length !== _.length) return a;
                for (f = 0, p = 0; p < _.length; p++) S = _[p], $ = g.indexOf(S, f), a.appendXtra(g.substr(f, $ - f), Number(S), le(w[p], S), "", D && "px" === g.substr($ + S.length, 2), 0 === p), f = $ + S.length;
                a["xs" + a.l] += g.substr(f)
            } else a["xs" + a.l] += a.l || a["xs" + a.l] ? " " + b : b;
            if (-1 !== n.indexOf("=") && a.data) {
                for (C = a.xs0 + a.data.s, h = 1; h < a.l; h++) C += a["xs" + h] + a.data["xn" + h];
                a.e = C + a["xs" + h]
            }
            return a.l || (a.type = -1, a.xs0 = a.e), a.xfirst || a
        }, we = 9;
        for (c = xe.prototype, c.l = c.pr = 0; --we > 0;) c["xn" + we] = 0, c["xs" + we] = "";
        c.xs0 = "", c._next = c._prev = c.xfirst = c.data = c.plugin = c.setRatio = c.rxp = null, c.appendXtra = function (e, t, i, n, s, o) {
            var r = this, a = r.l;
            return r["xs" + a] += o && (a || r["xs" + a]) ? " " + e : e || "", i || 0 === a || r.plugin ? (r.l++, r.type = r.setRatio ? 2 : 1, r["xs" + r.l] = n || "", a > 0 ? (r.data["xn" + a] = t + i, r.rxp["xn" + a] = s, r["xn" + a] = t, r.plugin || (r.xfirst = new xe(r, "xn" + a, t, i, r.xfirst || r, 0, r.n, s, r.pr), r.xfirst.xs0 = 0), r) : (r.data = {s: t + i}, r.rxp = {}, r.s = t, r.c = i, r.r = s, r)) : (r["xs" + a] += t + (n || ""), r)
        };
        var Te = function (e, t) {
            t = t || {}, this.p = t.prefix ? Q(e) || e : e, l[e] = l[this.p] = this, this.format = t.formatter || me(t.defaultValue, t.color, t.collapsible, t.multi), t.parser && (this.parse = t.parser), this.clrs = t.color, this.multi = t.multi, this.keyword = t.keyword, this.dflt = t.defaultValue, this.pr = t.priority || 0
        }, ke = Y._registerComplexSpecialProp = function (e, t, i) {
            "object" != typeof t && (t = {parser: i});
            var n, s = e.split(","), o = t.defaultValue;
            for (i = i || [o], n = 0; n < s.length; n++) t.prefix = 0 === n && t.prefix, t.defaultValue = i[n] || o, new Te(s[n], t)
        }, $e = Y._registerPluginProp = function (e) {
            if (!l[e]) {
                var t = e.charAt(0).toUpperCase() + e.substr(1) + "Plugin";
                ke(e, {
                    parser: function (e, i, n, s, o, r, c) {
                        var u = a.com.greensock.plugins[t];
                        return u ? (u._cssRegister(), l[n].parse(e, i, n, s, o, r, c)) : (V("Error: " + t + " js file not loaded."), o)
                    }
                })
            }
        };
        c = Te.prototype, c.parseComplex = function (e, t, i, n, s, o) {
            var r, a, l, c, u, d, h = this.keyword;
            if (this.multi && (E.test(i) || E.test(t) ? (a = t.replace(E, "|").split("|"), l = i.replace(E, "|").split("|")) : h && (a = [t], l = [i])), l) {
                for (c = l.length > a.length ? l.length : a.length, r = 0; r < c; r++) t = a[r] = a[r] || this.dflt, i = l[r] = l[r] || this.dflt, h && (u = t.indexOf(h), d = i.indexOf(h), u !== d && (-1 === d ? a[r] = a[r].split(h).join("") : -1 === u && (a[r] += " " + h)));
                t = a.join(", "), i = l.join(", ")
            }
            return _e(e, this.p, t, i, this.clrs, this.dflt, n, this.pr, s, o)
        }, c.parse = function (e, t, i, n, o, r, a) {
            return this.parseComplex(e.style, this.format(J(e, this.p, s, !1, this.dflt)), this.format(t), o, r)
        }, r.registerSpecialProp = function (e, t, i) {
            ke(e, {
                parser: function (e, n, s, o, r, a, l) {
                    var c = new xe(e, s, 0, 0, r, 2, s, !1, i);
                    return c.plugin = a, c.setRatio = t(e, n, o._tween, s), c
                }, priority: i
            })
        }, r.useSVGTransformAttr = !0;
        var Se,
            Ce = "scaleX,scaleY,scaleZ,x,y,z,skewX,skewY,rotation,rotationX,rotationY,perspective,xPercent,yPercent".split(","),
            Pe = Q("transform"), Oe = G + "transform",
            Ae = Q("transformOrigin"), Le = null !== Q("perspective"), De = Y.Transform = function () {
                this.perspective = parseFloat(r.defaultTransformPerspective) || 0, this.force3D = !(!1 === r.defaultForce3D || !Le) && (r.defaultForce3D || "auto")
            }, Me = _gsScope.SVGElement, Ee = function (e, t, i) {
                var n, s = N.createElementNS("http://www.w3.org/2000/svg", e), o = /([a-z])([A-Z])/g;
                for (n in i) s.setAttributeNS(null, n.replace(o, "$1-$2").toLowerCase(), i[n]);
                return t.appendChild(s), s
            }, Fe = N.documentElement || {}, Re = function () {
                var e, t, i, n = g || /Android/i.test(B) && !_gsScope.chrome;
                return N.createElementNS && !n && (e = Ee("svg", Fe), t = Ee("rect", e, {
                    width: 100,
                    height: 50,
                    x: 100
                }), i = t.getBoundingClientRect().width, t.style[Ae] = "50% 50%", t.style[Pe] = "scaleX(0.5)", n = i === t.getBoundingClientRect().width && !(p && Le), Fe.removeChild(e)), n
            }(), je = function (e, t, i, n, s, o) {
                var a, l, c, u, d, h, p, f, g, m, v, y, x, b, _ = e._gsTransform, w = Xe(e, !0);
                _ && (x = _.xOrigin, b = _.yOrigin), (!n || (a = n.split(" ")).length < 2) && (p = e.getBBox(), 0 === p.x && 0 === p.y && p.width + p.height === 0 && (p = {
                    x: parseFloat(e.hasAttribute("x") ? e.getAttribute("x") : e.hasAttribute("cx") ? e.getAttribute("cx") : 0) || 0,
                    y: parseFloat(e.hasAttribute("y") ? e.getAttribute("y") : e.hasAttribute("cy") ? e.getAttribute("cy") : 0) || 0,
                    width: 0,
                    height: 0
                }), t = ae(t).split(" "), a = [(-1 !== t[0].indexOf("%") ? parseFloat(t[0]) / 100 * p.width : parseFloat(t[0])) + p.x, (-1 !== t[1].indexOf("%") ? parseFloat(t[1]) / 100 * p.height : parseFloat(t[1])) + p.y]), i.xOrigin = u = parseFloat(a[0]), i.yOrigin = d = parseFloat(a[1]), n && w !== ze && (h = w[0], p = w[1], f = w[2], g = w[3], m = w[4], v = w[5], (y = h * g - p * f) && (l = u * (g / y) + d * (-f / y) + (f * v - g * m) / y, c = u * (-p / y) + d * (h / y) - (h * v - p * m) / y, u = i.xOrigin = a[0] = l, d = i.yOrigin = a[1] = c)), _ && (o && (i.xOffset = _.xOffset, i.yOffset = _.yOffset, _ = i), s || !1 !== s && !1 !== r.defaultSmoothOrigin ? (l = u - x, c = d - b, _.xOffset += l * w[0] + c * w[2] - l, _.yOffset += l * w[1] + c * w[3] - c) : _.xOffset = _.yOffset = 0), o || e.setAttribute("data-svg-origin", a.join(" "))
            }, Ie = function (e) {
                var t,
                    i = z("svg", this.ownerSVGElement && this.ownerSVGElement.getAttribute("xmlns") || "http://www.w3.org/2000/svg"),
                    n = this.parentNode, s = this.nextSibling, o = this.style.cssText;
                if (Fe.appendChild(i), i.appendChild(this), this.style.display = "block", e) try {
                    t = this.getBBox(), this._originalGetBBox = this.getBBox, this.getBBox = Ie
                } catch (e) {
                } else this._originalGetBBox && (t = this._originalGetBBox());
                return s ? n.insertBefore(this, s) : n.appendChild(this), Fe.removeChild(i), this.style.cssText = o, t
            }, He = function (e) {
                try {
                    return e.getBBox()
                } catch (t) {
                    return Ie.call(e, !0)
                }
            }, Ne = function (e) {
                return !(!Me || !e.getCTM || e.parentNode && !e.ownerSVGElement || !He(e))
            }, ze = [1, 0, 0, 1, 0, 0], Xe = function (e, t) {
                var i, n, s, o, r, a, l = e._gsTransform || new De, c = e.style;
                if (Pe ? n = J(e, Oe, null, !0) : e.currentStyle && (n = e.currentStyle.filter.match(D), n = n && 4 === n.length ? [n[0].substr(4), Number(n[2].substr(4)), Number(n[1].substr(4)), n[3].substr(4), l.x || 0, l.y || 0].join(",") : ""), i = !n || "none" === n || "matrix(1, 0, 0, 1, 0, 0)" === n, !Pe || !(a = !K(e) || "none" === K(e).display) && e.parentNode || (a && (o = c.display, c.display = "block"), e.parentNode || (r = 1, Fe.appendChild(e)), n = J(e, Oe, null, !0), i = !n || "none" === n || "matrix(1, 0, 0, 1, 0, 0)" === n, o ? c.display = o : a && Ue(c, "display"), r && Fe.removeChild(e)), (l.svg || e.getCTM && Ne(e)) && (i && -1 !== (c[Pe] + "").indexOf("matrix") && (n = c[Pe], i = 0), s = e.getAttribute("transform"), i && s && (-1 !== s.indexOf("matrix") ? (n = s, i = 0) : -1 !== s.indexOf("translate") && (n = "matrix(1,0,0,1," + s.match(/(?:\-|\b)[\d\-\.e]+\b/gi).join(",") + ")", i = 0))), i) return ze;
                for (s = (n || "").match(y) || [], we = s.length; --we > -1;) o = Number(s[we]), s[we] = (r = o - (o |= 0)) ? (1e5 * r + (r < 0 ? -.5 : .5) | 0) / 1e5 + o : o;
                return t && s.length > 6 ? [s[0], s[1], s[4], s[5], s[12], s[13]] : s
            }, qe = Y.getTransform = function (e, i, n, s) {
                if (e._gsTransform && n && !s) return e._gsTransform;
                var o, a, l, c, u, d, h = n ? e._gsTransform || new De : new De, p = h.scaleX < 0,
                    f = Le ? parseFloat(J(e, Ae, i, !1, "0 0 0").split(" ")[2]) || h.zOrigin || 0 : 0,
                    g = parseFloat(r.defaultTransformPerspective) || 0;
                if (h.svg = !(!e.getCTM || !Ne(e)), h.svg && (je(e, J(e, Ae, i, !1, "50% 50%") + "", h, e.getAttribute("data-svg-origin")), Se = r.useSVGTransformAttr || Re), (o = Xe(e)) !== ze) {
                    if (16 === o.length) {
                        var m, v, y, x, b, _ = o[0], w = o[1], T = o[2], k = o[3], $ = o[4], S = o[5], C = o[6], P = o[7],
                            O = o[8], A = o[9], L = o[10], D = o[12], M = o[13], E = o[14], F = o[11],
                            R = Math.atan2(C, L);
                        h.zOrigin && (E = -h.zOrigin, D = O * E - o[12], M = A * E - o[13], E = L * E + h.zOrigin - o[14]), h.rotationX = R * j, R && (x = Math.cos(-R), b = Math.sin(-R), m = $ * x + O * b, v = S * x + A * b, y = C * x + L * b, O = $ * -b + O * x, A = S * -b + A * x, L = C * -b + L * x, F = P * -b + F * x, $ = m, S = v, C = y), R = Math.atan2(-T, L), h.rotationY = R * j, R && (x = Math.cos(-R), b = Math.sin(-R), m = _ * x - O * b, v = w * x - A * b, y = T * x - L * b, A = w * b + A * x, L = T * b + L * x, F = k * b + F * x, _ = m, w = v, T = y), R = Math.atan2(w, _), h.rotation = R * j, R && (x = Math.cos(R), b = Math.sin(R), m = _ * x + w * b, v = $ * x + S * b, y = O * x + A * b, w = w * x - _ * b, S = S * x - $ * b, A = A * x - O * b, _ = m, $ = v, O = y), h.rotationX && Math.abs(h.rotationX) + Math.abs(h.rotation) > 359.9 && (h.rotationX = h.rotation = 0, h.rotationY = 180 - h.rotationY), R = Math.atan2($, S), h.scaleX = (1e5 * Math.sqrt(_ * _ + w * w + T * T) + .5 | 0) / 1e5, h.scaleY = (1e5 * Math.sqrt(S * S + C * C) + .5 | 0) / 1e5, h.scaleZ = (1e5 * Math.sqrt(O * O + A * A + L * L) + .5 | 0) / 1e5, _ /= h.scaleX, $ /= h.scaleY, w /= h.scaleX, S /= h.scaleY, Math.abs(R) > 2e-5 ? (h.skewX = R * j, $ = 0, "simple" !== h.skewType && (h.scaleY *= 1 / Math.cos(R))) : h.skewX = 0, h.perspective = F ? 1 / (F < 0 ? -F : F) : 0, h.x = D, h.y = M, h.z = E, h.svg && (h.x -= h.xOrigin - (h.xOrigin * _ - h.yOrigin * $), h.y -= h.yOrigin - (h.yOrigin * w - h.xOrigin * S))
                    } else if (!Le || s || !o.length || h.x !== o[4] || h.y !== o[5] || !h.rotationX && !h.rotationY) {
                        var I = o.length >= 6, H = I ? o[0] : 1, N = o[1] || 0, z = o[2] || 0, X = I ? o[3] : 1;
                        h.x = o[4] || 0, h.y = o[5] || 0, l = Math.sqrt(H * H + N * N), c = Math.sqrt(X * X + z * z), u = H || N ? Math.atan2(N, H) * j : h.rotation || 0, d = z || X ? Math.atan2(z, X) * j + u : h.skewX || 0, h.scaleX = l, h.scaleY = c, h.rotation = u, h.skewX = d, Le && (h.rotationX = h.rotationY = h.z = 0, h.perspective = g, h.scaleZ = 1), h.svg && (h.x -= h.xOrigin - (h.xOrigin * H + h.yOrigin * z), h.y -= h.yOrigin - (h.xOrigin * N + h.yOrigin * X))
                    }
                    Math.abs(h.skewX) > 90 && Math.abs(h.skewX) < 270 && (p ? (h.scaleX *= -1, h.skewX += h.rotation <= 0 ? 180 : -180, h.rotation += h.rotation <= 0 ? 180 : -180) : (h.scaleY *= -1, h.skewX += h.skewX <= 0 ? 180 : -180)), h.zOrigin = f;
                    for (a in h) h[a] < 2e-5 && h[a] > -2e-5 && (h[a] = 0)
                }
                return n && (e._gsTransform = h, h.svg && (Se && e.style[Pe] ? t.delayedCall(.001, function () {
                    Ue(e.style, Pe)
                }) : !Se && e.getAttribute("transform") && t.delayedCall(.001, function () {
                    e.removeAttribute("transform")
                }))), h
            }, Ye = function (e) {
                var t, i, n = this.data, s = -n.rotation * R, o = s + n.skewX * R,
                    r = (Math.cos(s) * n.scaleX * 1e5 | 0) / 1e5, a = (Math.sin(s) * n.scaleX * 1e5 | 0) / 1e5,
                    l = (Math.sin(o) * -n.scaleY * 1e5 | 0) / 1e5, c = (Math.cos(o) * n.scaleY * 1e5 | 0) / 1e5,
                    u = this.t.style, d = this.t.currentStyle;
                if (d) {
                    i = a, a = -l, l = -i, t = d.filter, u.filter = "";
                    var h, p, f = this.t.offsetWidth, m = this.t.offsetHeight, v = "absolute" !== d.position,
                        y = "progid:DXImageTransform.Microsoft.Matrix(M11=" + r + ", M12=" + a + ", M21=" + l + ", M22=" + c,
                        x = n.x + f * n.xPercent / 100, b = n.y + m * n.yPercent / 100;
                    if (null != n.ox && (h = (n.oxp ? f * n.ox * .01 : n.ox) - f / 2, p = (n.oyp ? m * n.oy * .01 : n.oy) - m / 2, x += h - (h * r + p * a), b += p - (h * l + p * c)), v ? (h = f / 2, p = m / 2, y += ", Dx=" + (h - (h * r + p * a) + x) + ", Dy=" + (p - (h * l + p * c) + b) + ")") : y += ", sizingMethod='auto expand')", -1 !== t.indexOf("DXImageTransform.Microsoft.Matrix(") ? u.filter = t.replace(M, y) : u.filter = y + " " + t, 0 !== e && 1 !== e || 1 === r && 0 === a && 0 === l && 1 === c && (v && -1 === y.indexOf("Dx=0, Dy=0") || T.test(t) && 100 !== parseFloat(RegExp.$1) || -1 === t.indexOf(t.indexOf("Alpha")) && u.removeAttribute("filter")), !v) {
                        var _, k, $, S = g < 8 ? 1 : -1;
                        for (h = n.ieOffsetX || 0, p = n.ieOffsetY || 0, n.ieOffsetX = Math.round((f - ((r < 0 ? -r : r) * f + (a < 0 ? -a : a) * m)) / 2 + x), n.ieOffsetY = Math.round((m - ((c < 0 ? -c : c) * m + (l < 0 ? -l : l) * f)) / 2 + b), we = 0; we < 4; we++) k = oe[we], _ = d[k], i = -1 !== _.indexOf("px") ? parseFloat(_) : ee(this.t, k, parseFloat(_), _.replace(w, "")) || 0, $ = i !== n[k] ? we < 2 ? -n.ieOffsetX : -n.ieOffsetY : we < 2 ? h - n.ieOffsetX : p - n.ieOffsetY, u[k] = (n[k] = Math.round(i - $ * (0 === we || 2 === we ? 1 : S))) + "px"
                    }
                }
            }, Be = Y.set3DTransformRatio = Y.setTransformRatio = function (e) {
                var t, i, n, s, o, r, a, l, c, u, d, h, f, g, m, v, y, x, b, _, w, T, k, $ = this.data, S = this.t.style,
                    C = $.rotation, P = $.rotationX, O = $.rotationY, A = $.scaleX, L = $.scaleY,
                    D = $.scaleZ, M = $.x, E = $.y, F = $.z, j = $.svg, I = $.perspective, H = $.force3D, N = $.skewY,
                    z = $.skewX;
                if (N && (z += N, C += N), ((1 === e || 0 === e) && "auto" === H && (this.tween._totalTime === this.tween._totalDuration || !this.tween._totalTime) || !H) && !F && !I && !O && !P && 1 === D || Se && j || !Le) return void(C || z || j ? (C *= R, T = z * R, k = 1e5, i = Math.cos(C) * A, o = Math.sin(C) * A, n = Math.sin(C - T) * -L, r = Math.cos(C - T) * L, T && "simple" === $.skewType && (t = Math.tan(T - N * R), t = Math.sqrt(1 + t * t), n *= t, r *= t, N && (t = Math.tan(N * R), t = Math.sqrt(1 + t * t), i *= t, o *= t)), j && (M += $.xOrigin - ($.xOrigin * i + $.yOrigin * n) + $.xOffset, E += $.yOrigin - ($.xOrigin * o + $.yOrigin * r) + $.yOffset, Se && ($.xPercent || $.yPercent) && (m = this.t.getBBox(), M += .01 * $.xPercent * m.width, E += .01 * $.yPercent * m.height), m = 1e-6, M < m && M > -m && (M = 0), E < m && E > -m && (E = 0)), b = (i * k | 0) / k + "," + (o * k | 0) / k + "," + (n * k | 0) / k + "," + (r * k | 0) / k + "," + M + "," + E + ")", j && Se ? this.t.setAttribute("transform", "matrix(" + b) : S[Pe] = ($.xPercent || $.yPercent ? "translate(" + $.xPercent + "%," + $.yPercent + "%) matrix(" : "matrix(") + b) : S[Pe] = ($.xPercent || $.yPercent ? "translate(" + $.xPercent + "%," + $.yPercent + "%) matrix(" : "matrix(") + A + ",0,0," + L + "," + M + "," + E + ")");
                if (p && (m = 1e-4, A < m && A > -m && (A = D = 2e-5), L < m && L > -m && (L = D = 2e-5), !I || $.z || $.rotationX || $.rotationY || (I = 0)), C || z) C *= R, v = i = Math.cos(C), y = o = Math.sin(C), z && (C -= z * R, v = Math.cos(C), y = Math.sin(C), "simple" === $.skewType && (t = Math.tan((z - N) * R), t = Math.sqrt(1 + t * t), v *= t, y *= t, $.skewY && (t = Math.tan(N * R), t = Math.sqrt(1 + t * t), i *= t, o *= t))), n = -y, r = v; else {
                    if (!(O || P || 1 !== D || I || j)) return void(S[Pe] = ($.xPercent || $.yPercent ? "translate(" + $.xPercent + "%," + $.yPercent + "%) translate3d(" : "translate3d(") + M + "px," + E + "px," + F + "px)" + (1 !== A || 1 !== L ? " scale(" + A + "," + L + ")" : ""));
                    i = r = 1, n = o = 0
                }
                u = 1, s = a = l = c = d = h = 0, f = I ? -1 / I : 0, g = $.zOrigin, m = 1e-6, _ = ",", w = "0", C = O * R, C && (v = Math.cos(C), y = Math.sin(C), l = -y, d = f * -y, s = i * y, a = o * y, u = v, f *= v, i *= v, o *= v), C = P * R, C && (v = Math.cos(C), y = Math.sin(C), t = n * v + s * y, x = r * v + a * y, c = u * y, h = f * y, s = n * -y + s * v, a = r * -y + a * v, u *= v, f *= v, n = t, r = x), 1 !== D && (s *= D, a *= D, u *= D, f *= D), 1 !== L && (n *= L, r *= L, c *= L, h *= L), 1 !== A && (i *= A, o *= A, l *= A, d *= A), (g || j) && (g && (M += s * -g, E += a * -g, F += u * -g + g), j && (M += $.xOrigin - ($.xOrigin * i + $.yOrigin * n) + $.xOffset, E += $.yOrigin - ($.xOrigin * o + $.yOrigin * r) + $.yOffset), M < m && M > -m && (M = w), E < m && E > -m && (E = w), F < m && F > -m && (F = 0)), b = $.xPercent || $.yPercent ? "translate(" + $.xPercent + "%," + $.yPercent + "%) matrix3d(" : "matrix3d(", b += (i < m && i > -m ? w : i) + _ + (o < m && o > -m ? w : o) + _ + (l < m && l > -m ? w : l), b += _ + (d < m && d > -m ? w : d) + _ + (n < m && n > -m ? w : n) + _ + (r < m && r > -m ? w : r), P || O || 1 !== D ? (b += _ + (c < m && c > -m ? w : c) + _ + (h < m && h > -m ? w : h) + _ + (s < m && s > -m ? w : s), b += _ + (a < m && a > -m ? w : a) + _ + (u < m && u > -m ? w : u) + _ + (f < m && f > -m ? w : f) + _) : b += ",0,0,0,0,1,0,", b += M + _ + E + _ + F + _ + (I ? 1 + -F / I : 1) + ")", S[Pe] = b
            };
        c = De.prototype, c.x = c.y = c.z = c.skewX = c.skewY = c.rotation = c.rotationX = c.rotationY = c.zOrigin = c.xPercent = c.yPercent = c.xOffset = c.yOffset = 0, c.scaleX = c.scaleY = c.scaleZ = 1, ke("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,svgOrigin,transformPerspective,directionalRotation,parseTransform,force3D,skewType,xPercent,yPercent,smoothOrigin", {
            parser: function (e, t, i, n, o, a, l) {
                if (n._lastParsedTransform === l) return o;
                n._lastParsedTransform = l;
                var c, u = l.scale && "function" == typeof l.scale ? l.scale : 0;
                "function" == typeof l[i] && (c = l[i], l[i] = t), u && (l.scale = u(v, e));
                var d, h, p, f, g, y, x, b, _, w = e._gsTransform, T = e.style, k = Ce.length, $ = l, S = {},
                    C = qe(e, s, !0, $.parseTransform),
                    P = $.transform && ("function" == typeof $.transform ? $.transform(v, m) : $.transform);
                if (C.skewType = $.skewType || C.skewType || r.defaultSkewType, n._transform = C, P && "string" == typeof P && Pe) h = X.style, h[Pe] = P, h.display = "block", h.position = "absolute", N.body.appendChild(X), d = qe(X, null, !1), "simple" === C.skewType && (d.scaleY *= Math.cos(d.skewX * R)), C.svg && (y = C.xOrigin, x = C.yOrigin, d.x -= C.xOffset, d.y -= C.yOffset, ($.transformOrigin || $.svgOrigin) && (P = {}, je(e, ae($.transformOrigin), P, $.svgOrigin, $.smoothOrigin, !0), y = P.xOrigin, x = P.yOrigin, d.x -= P.xOffset - C.xOffset, d.y -= P.yOffset - C.yOffset), (y || x) && (b = Xe(X, !0), d.x -= y - (y * b[0] + x * b[2]), d.y -= x - (y * b[1] + x * b[3]))), N.body.removeChild(X), d.perspective || (d.perspective = C.perspective), null != $.xPercent && (d.xPercent = ce($.xPercent, C.xPercent)), null != $.yPercent && (d.yPercent = ce($.yPercent, C.yPercent)); else if ("object" == typeof $) {
                    if (d = {
                            scaleX: ce(null != $.scaleX ? $.scaleX : $.scale, C.scaleX),
                            scaleY: ce(null != $.scaleY ? $.scaleY : $.scale, C.scaleY),
                            scaleZ: ce($.scaleZ, C.scaleZ),
                            x: ce($.x, C.x),
                            y: ce($.y, C.y),
                            z: ce($.z, C.z),
                            xPercent: ce($.xPercent, C.xPercent),
                            yPercent: ce($.yPercent, C.yPercent),
                            perspective: ce($.transformPerspective, C.perspective)
                        }, null != (g = $.directionalRotation)) if ("object" == typeof g) for (h in g) $[h] = g[h]; else $.rotation = g;
                    "string" == typeof $.x && -1 !== $.x.indexOf("%") && (d.x = 0, d.xPercent = ce($.x, C.xPercent)), "string" == typeof $.y && -1 !== $.y.indexOf("%") && (d.y = 0, d.yPercent = ce($.y, C.yPercent)), d.rotation = ue("rotation" in $ ? $.rotation : "shortRotation" in $ ? $.shortRotation + "_short" : "rotationZ" in $ ? $.rotationZ : C.rotation, C.rotation, "rotation", S), Le && (d.rotationX = ue("rotationX" in $ ? $.rotationX : "shortRotationX" in $ ? $.shortRotationX + "_short" : C.rotationX || 0, C.rotationX, "rotationX", S), d.rotationY = ue("rotationY" in $ ? $.rotationY : "shortRotationY" in $ ? $.shortRotationY + "_short" : C.rotationY || 0, C.rotationY, "rotationY", S)), d.skewX = ue($.skewX, C.skewX), d.skewY = ue($.skewY, C.skewY)
                }
                for (Le && null != $.force3D && (C.force3D = $.force3D, f = !0), p = C.force3D || C.z || C.rotationX || C.rotationY || d.z || d.rotationX || d.rotationY || d.perspective, p || null == $.scale || (d.scaleZ = 1); --k > -1;) _ = Ce[k], ((P = d[_] - C[_]) > 1e-6 || P < -1e-6 || null != $[_] || null != I[_]) && (f = !0, o = new xe(C, _, C[_], P, o), _ in S && (o.e = S[_]), o.xs0 = 0, o.plugin = a, n._overwriteProps.push(o.n));
                return P = $.transformOrigin, C.svg && (P || $.svgOrigin) && (y = C.xOffset, x = C.yOffset, je(e, ae(P), d, $.svgOrigin, $.smoothOrigin), o = be(C, "xOrigin", (w ? C : d).xOrigin, d.xOrigin, o, "transformOrigin"), o = be(C, "yOrigin", (w ? C : d).yOrigin, d.yOrigin, o, "transformOrigin"), y === C.xOffset && x === C.yOffset || (o = be(C, "xOffset", w ? y : C.xOffset, C.xOffset, o, "transformOrigin"), o = be(C, "yOffset", w ? x : C.yOffset, C.yOffset, o, "transformOrigin")), P = "0px 0px"), (P || Le && p && C.zOrigin) && (Pe ? (f = !0, _ = Ae, P = (P || J(e, _, s, !1, "50% 50%")) + "", o = new xe(T, _, 0, 0, o, -1, "transformOrigin"), o.b = T[_], o.plugin = a, Le ? (h = C.zOrigin, P = P.split(" "), C.zOrigin = (P.length > 2 && (0 === h || "0px" !== P[2]) ? parseFloat(P[2]) : h) || 0, o.xs0 = o.e = P[0] + " " + (P[1] || "50%") + " 0px", o = new xe(C, "zOrigin", 0, 0, o, -1, o.n), o.b = h, o.xs0 = o.e = C.zOrigin) : o.xs0 = o.e = P) : ae(P + "", C)), f && (n._transformType = C.svg && Se || !p && 3 !== this._transformType ? 2 : 3), c && (l[i] = c), u && (l.scale = u), o
            }, prefix: !0
        }), ke("boxShadow", {
            defaultValue: "0px 0px 0px 0px #999",
            prefix: !0,
            color: !0,
            multi: !0,
            keyword: "inset"
        }), ke("borderRadius", {
            defaultValue: "0px", parser: function (e, t, i, o, r, a) {
                t = this.format(t);
                var l, c, u, d, h, p, f, g, m, v, y, x, b, _, w, T,
                    k = ["borderTopLeftRadius", "borderTopRightRadius", "borderBottomRightRadius", "borderBottomLeftRadius"],
                    $ = e.style;
                for (m = parseFloat(e.offsetWidth), v = parseFloat(e.offsetHeight), l = t.split(" "), c = 0; c < k.length; c++) this.p.indexOf("border") && (k[c] = Q(k[c])), h = d = J(e, k[c], s, !1, "0px"), -1 !== h.indexOf(" ") && (d = h.split(" "), h = d[0], d = d[1]), p = u = l[c], f = parseFloat(h), x = h.substr((f + "").length), b = "=" === p.charAt(1), b ? (g = parseInt(p.charAt(0) + "1", 10), p = p.substr(2), g *= parseFloat(p), y = p.substr((g + "").length - (g < 0 ? 1 : 0)) || "") : (g = parseFloat(p), y = p.substr((g + "").length)), "" === y && (y = n[i] || x), y !== x && (_ = ee(e, "borderLeft", f, x), w = ee(e, "borderTop", f, x), "%" === y ? (h = _ / m * 100 + "%", d = w / v * 100 + "%") : "em" === y ? (T = ee(e, "borderLeft", 1, "em"), h = _ / T + "em", d = w / T + "em") : (h = _ + "px", d = w + "px"), b && (p = parseFloat(h) + g + y, u = parseFloat(d) + g + y)), r = _e($, k[c], h + " " + d, p + " " + u, !1, "0px", r);
                return r
            }, prefix: !0, formatter: me("0px 0px 0px 0px", !1, !0)
        }), ke("borderBottomLeftRadius,borderBottomRightRadius,borderTopLeftRadius,borderTopRightRadius", {
            defaultValue: "0px", parser: function (e, t, i, n, o, r) {
                return _e(e.style, i, this.format(J(e, i, s, !1, "0px 0px")), this.format(t), !1, "0px", o)
            }, prefix: !0, formatter: me("0px 0px", !1, !0)
        }), ke("backgroundPosition", {
            defaultValue: "0 0", parser: function (e, t, i, n, o, r) {
                var a, l, c, u, d, h, p = "background-position", f = s || K(e, null),
                    m = this.format((f ? g ? f.getPropertyValue(p + "-x") + " " + f.getPropertyValue(p + "-y") : f.getPropertyValue(p) : e.currentStyle.backgroundPositionX + " " + e.currentStyle.backgroundPositionY) || "0 0"),
                    v = this.format(t);
                if (-1 !== m.indexOf("%") != (-1 !== v.indexOf("%")) && v.split(",").length < 2 && (h = J(e, "backgroundImage").replace(O, "")) && "none" !== h) {
                    for (a = m.split(" "), l = v.split(" "), q.setAttribute("src", h), c = 2; --c > -1;) m = a[c], (u = -1 !== m.indexOf("%")) !== (-1 !== l[c].indexOf("%")) && (d = 0 === c ? e.offsetWidth - q.width : e.offsetHeight - q.height, a[c] = u ? parseFloat(m) / 100 * d + "px" : parseFloat(m) / d * 100 + "%");
                    m = a.join(" ")
                }
                return this.parseComplex(e.style, m, v, o, r)
            }, formatter: ae
        }), ke("backgroundSize", {
            defaultValue: "0 0", formatter: function (e) {
                return e += "", ae(-1 === e.indexOf(" ") ? e + " " + e : e)
            }
        }), ke("perspective", {defaultValue: "0px", prefix: !0}), ke("perspectiveOrigin", {
            defaultValue: "50% 50%",
            prefix: !0
        }), ke("transformStyle", {prefix: !0}), ke("backfaceVisibility", {prefix: !0}), ke("userSelect", {prefix: !0}), ke("margin", {parser: ve("marginTop,marginRight,marginBottom,marginLeft")}), ke("padding", {parser: ve("paddingTop,paddingRight,paddingBottom,paddingLeft")}), ke("clip", {
            defaultValue: "rect(0px,0px,0px,0px)",
            parser: function (e, t, i, n, o, r) {
                var a, l, c;
                return g < 9 ? (l = e.currentStyle, c = g < 8 ? " " : ",", a = "rect(" + l.clipTop + c + l.clipRight + c + l.clipBottom + c + l.clipLeft + ")", t = this.format(t).split(",").join(c)) : (a = this.format(J(e, this.p, s, !1, this.dflt)), t = this.format(t)), this.parseComplex(e.style, a, t, o, r)
            }
        }), ke("textShadow", {defaultValue: "0px 0px 0px #999", color: !0, multi: !0}), ke("autoRound,strictUnits", {
            parser: function (e, t, i, n, s) {
                return s
            }
        }), ke("border", {
            defaultValue: "0px solid #000", parser: function (e, t, i, n, o, r) {
                var a = J(e, "borderTopWidth", s, !1, "0px"), l = this.format(t).split(" "), c = l[0].replace(w, "");
                return "px" !== c && (a = parseFloat(a) / ee(e, "borderTopWidth", 1, c) + c), this.parseComplex(e.style, this.format(a + " " + J(e, "borderTopStyle", s, !1, "solid") + " " + J(e, "borderTopColor", s, !1, "#000")), l.join(" "), o, r)
            }, color: !0, formatter: function (e) {
                var t = e.split(" ");
                return t[0] + " " + (t[1] || "solid") + " " + (e.match(ge) || ["#000"])[0]
            }
        }), ke("borderWidth", {parser: ve("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")}), ke("float,cssFloat,styleFloat", {
            parser: function (e, t, i, n, s, o) {
                var r = e.style, a = "cssFloat" in r ? "cssFloat" : "styleFloat";
                return new xe(r, a, 0, 0, s, -1, i, !1, 0, r[a], t)
            }
        });
        var We = function (e) {
            var t, i = this.t, n = i.filter || J(this.data, "filter") || "", s = this.s + this.c * e | 0;
            100 === s && (-1 === n.indexOf("atrix(") && -1 === n.indexOf("radient(") && -1 === n.indexOf("oader(") ? (i.removeAttribute("filter"), t = !J(this.data, "filter")) : (i.filter = n.replace($, ""), t = !0)), t || (this.xn1 && (i.filter = n = n || "alpha(opacity=" + s + ")"), -1 === n.indexOf("pacity") ? 0 === s && this.xn1 || (i.filter = n + " alpha(opacity=" + s + ")") : i.filter = n.replace(T, "opacity=" + s))
        };
        ke("opacity,alpha,autoAlpha", {
            defaultValue: "1", parser: function (e, t, i, n, o, r) {
                var a = parseFloat(J(e, "opacity", s, !1, "1")), l = e.style, c = "autoAlpha" === i;
                return "string" == typeof t && "=" === t.charAt(1) && (t = ("-" === t.charAt(0) ? -1 : 1) * parseFloat(t.substr(2)) + a), c && 1 === a && "hidden" === J(e, "visibility", s) && 0 !== t && (a = 0), W ? o = new xe(l, "opacity", a, t - a, o) : (o = new xe(l, "opacity", 100 * a, 100 * (t - a), o), o.xn1 = c ? 1 : 0, l.zoom = 1, o.type = 2, o.b = "alpha(opacity=" + o.s + ")", o.e = "alpha(opacity=" + (o.s + o.c) + ")", o.data = e, o.plugin = r, o.setRatio = We), c && (o = new xe(l, "visibility", 0, 0, o, -1, null, !1, 0, 0 !== a ? "inherit" : "hidden", 0 === t ? "hidden" : "inherit"), o.xs0 = "inherit", n._overwriteProps.push(o.n), n._overwriteProps.push(i)), o
            }
        });
        var Ue = function (e, t) {
            t && (e.removeProperty ? ("ms" !== t.substr(0, 2) && "webkit" !== t.substr(0, 6) || (t = "-" + t), e.removeProperty(t.replace(C, "-$1").toLowerCase())) : e.removeAttribute(t))
        }, Ve = function (e) {
            if (this.t._gsClassPT = this, 1 === e || 0 === e) {
                this.t.setAttribute("class", 0 === e ? this.b : this.e);
                for (var t = this.data, i = this.t.style; t;) t.v ? i[t.p] = t.v : Ue(i, t.p), t = t._next;
                1 === e && this.t._gsClassPT === this && (this.t._gsClassPT = null)
            } else this.t.getAttribute("class") !== this.e && this.t.setAttribute("class", this.e)
        };
        ke("className", {
            parser: function (e, t, n, o, r, a, l) {
                var c, u, d, h, p, f = e.getAttribute("class") || "", g = e.style.cssText;
                if (r = o._classNamePT = new xe(e, n, 0, 0, r, 2), r.setRatio = Ve, r.pr = -11, i = !0, r.b = f, u = ie(e, s), d = e._gsClassPT) {
                    for (h = {}, p = d.data; p;) h[p.p] = 1, p = p._next;
                    d.setRatio(1)
                }
                return e._gsClassPT = r, r.e = "=" !== t.charAt(1) ? t : f.replace(new RegExp("(?:\\s|^)" + t.substr(2) + "(?![\\w-])"), "") + ("+" === t.charAt(0) ? " " + t.substr(2) : ""), e.setAttribute("class", r.e), c = ne(e, u, ie(e), l, h), e.setAttribute("class", f), r.data = c.firstMPT, e.style.cssText = g, r = r.xfirst = o.parse(e, c.difs, r, a)
            }
        });
        var Ge = function (e) {
            if ((1 === e || 0 === e) && this.data._totalTime === this.data._totalDuration && "isFromStart" !== this.data.data) {
                var t, i, n, s, o, r = this.t.style, a = l.transform.parse;
                if ("all" === this.e) r.cssText = "", s = !0; else for (t = this.e.split(" ").join("").split(","), n = t.length; --n > -1;) i = t[n], l[i] && (l[i].parse === a ? s = !0 : i = "transformOrigin" === i ? Ae : l[i].p), Ue(r, i);
                s && (Ue(r, Pe), (o = this.t._gsTransform) && (o.svg && (this.t.removeAttribute("data-svg-origin"), this.t.removeAttribute("transform")), delete this.t._gsTransform))
            }
        };
        for (ke("clearProps", {
            parser: function (e, t, n, s, o) {
                return o = new xe(e, n, 0, 0, o, 2), o.setRatio = Ge, o.e = t, o.pr = -10, o.data = s._tween, i = !0, o
            }
        }), c = "bezier,throwProps,physicsProps,physics2D".split(","), we = c.length; we--;) $e(c[we]);
        c = r.prototype, c._firstPT = c._lastParsedTransform = c._transform = null, c._onInitTween = function (e, t, a, c) {
            if (!e.nodeType) return !1;
            this._target = m = e, this._tween = a, this._vars = t, v = c, u = t.autoRound, i = !1, n = t.suffixMap || r.suffixMap, s = K(e, ""), o = this._overwriteProps;
            var p, g, y, x, b, _, w, T, $, S = e.style;
            if (d && "" === S.zIndex && ("auto" !== (p = J(e, "zIndex", s)) && "" !== p || this._addLazySet(S, "zIndex", 0)), "string" == typeof t && (x = S.cssText, p = ie(e, s), S.cssText = x + ";" + t, p = ne(e, p, ie(e)).difs, !W && k.test(t) && (p.opacity = parseFloat(RegExp.$1)), t = p, S.cssText = x), t.className ? this._firstPT = g = l.className.parse(e, t.className, "className", this, null, null, t) : this._firstPT = g = this.parse(e, t, null), this._transformType) {
                for ($ = 3 === this._transformType, Pe ? h && (d = !0, "" === S.zIndex && ("auto" !== (w = J(e, "zIndex", s)) && "" !== w || this._addLazySet(S, "zIndex", 0)), f && this._addLazySet(S, "WebkitBackfaceVisibility", this._vars.WebkitBackfaceVisibility || ($ ? "visible" : "hidden"))) : S.zoom = 1, y = g; y && y._next;) y = y._next;
                T = new xe(e, "transform", 0, 0, null, 2), this._linkCSSP(T, null, y), T.setRatio = Pe ? Be : Ye, T.data = this._transform || qe(e, s, !0), T.tween = a, T.pr = -1, o.pop()
            }
            if (i) {
                for (; g;) {
                    for (_ = g._next, y = x; y && y.pr > g.pr;) y = y._next;
                    (g._prev = y ? y._prev : b) ? g._prev._next = g : x = g, (g._next = y) ? y._prev = g : b = g, g = _
                }
                this._firstPT = x
            }
            return !0
        }, c.parse = function (e, t, i, o) {
            var r, a, c, d, h, p, f, g, y, x, b = e.style;
            for (r in t) {
                if (p = t[r], "function" == typeof p && (p = p(v, m)), a = l[r]) i = a.parse(e, p, r, this, i, o, t); else {
                    if ("--" === r.substr(0, 2)) {
                        this._tween._propLookup[r] = this._addTween.call(this._tween, e.style, "setProperty", K(e).getPropertyValue(r) + "", p + "", r, !1, r);
                        continue
                    }
                    h = J(e, r, s) + "", y = "string" == typeof p, "color" === r || "fill" === r || "stroke" === r || -1 !== r.indexOf("Color") || y && S.test(p) ? (y || (p = pe(p), p = (p.length > 3 ? "rgba(" : "rgb(") + p.join(",") + ")"), i = _e(b, r, h, p, !0, "transparent", i, 0, o)) : y && F.test(p) ? i = _e(b, r, h, p, !0, null, i, 0, o) : (c = parseFloat(h), f = c || 0 === c ? h.substr((c + "").length) : "", "" !== h && "auto" !== h || ("width" === r || "height" === r ? (c = re(e, r, s), f = "px") : "left" === r || "top" === r ? (c = te(e, r, s), f = "px") : (c = "opacity" !== r ? 0 : 1, f = "")), x = y && "=" === p.charAt(1), x ? (d = parseInt(p.charAt(0) + "1", 10), p = p.substr(2), d *= parseFloat(p), g = p.replace(w, "")) : (d = parseFloat(p), g = y ? p.replace(w, "") : ""), "" === g && (g = r in n ? n[r] : f), p = d || 0 === d ? (x ? d + c : d) + g : t[r], f !== g && ("" === g && "lineHeight" !== r || (d || 0 === d) && c && (c = ee(e, r, c, f), "%" === g ? (c /= ee(e, r, 100, "%") / 100, !0 !== t.strictUnits && (h = c + "%")) : "em" === g || "rem" === g || "vw" === g || "vh" === g ? c /= ee(e, r, 1, g) : "px" !== g && (d = ee(e, r, d, g), g = "px"), x && (d || 0 === d) && (p = d + c + g))), x && (d += c), !c && 0 !== c || !d && 0 !== d ? void 0 !== b[r] && (p || p + "" != "NaN" && null != p) ? (i = new xe(b, r, d || c || 0, 0, i, -1, r, !1, 0, h, p), i.xs0 = "none" !== p || "display" !== r && -1 === r.indexOf("Style") ? p : h) : V("invalid " + r + " tween value: " + t[r]) : (i = new xe(b, r, c, d - c, i, 0, r, !1 !== u && ("px" === g || "zIndex" === r), 0, h, p), i.xs0 = g))
                }
                o && i && !i.plugin && (i.plugin = o)
            }
            return i
        }, c.setRatio = function (e) {
            var t, i, n, s = this._firstPT;
            if (1 !== e || this._tween._time !== this._tween._duration && 0 !== this._tween._time) if (e || this._tween._time !== this._tween._duration && 0 !== this._tween._time || -1e-6 === this._tween._rawPrevTime) for (; s;) {
                if (t = s.c * e + s.s, s.r ? t = Math.round(t) : t < 1e-6 && t > -1e-6 && (t = 0), s.type) if (1 === s.type) if (2 === (n = s.l)) s.t[s.p] = s.xs0 + t + s.xs1 + s.xn1 + s.xs2; else if (3 === n) s.t[s.p] = s.xs0 + t + s.xs1 + s.xn1 + s.xs2 + s.xn2 + s.xs3; else if (4 === n) s.t[s.p] = s.xs0 + t + s.xs1 + s.xn1 + s.xs2 + s.xn2 + s.xs3 + s.xn3 + s.xs4; else if (5 === n) s.t[s.p] = s.xs0 + t + s.xs1 + s.xn1 + s.xs2 + s.xn2 + s.xs3 + s.xn3 + s.xs4 + s.xn4 + s.xs5; else {
                    for (i = s.xs0 + t + s.xs1, n = 1; n < s.l; n++) i += s["xn" + n] + s["xs" + (n + 1)];
                    s.t[s.p] = i
                } else -1 === s.type ? s.t[s.p] = s.xs0 : s.setRatio && s.setRatio(e); else s.t[s.p] = t + s.xs0;
                s = s._next
            } else for (; s;) 2 !== s.type ? s.t[s.p] = s.b : s.setRatio(e), s = s._next; else for (; s;) {
                if (2 !== s.type) if (s.r && -1 !== s.type) if (t = Math.round(s.s + s.c), s.type) {
                    if (1 === s.type) {
                        for (n = s.l, i = s.xs0 + t + s.xs1, n = 1; n < s.l; n++) i += s["xn" + n] + s["xs" + (n + 1)];
                        s.t[s.p] = i
                    }
                } else s.t[s.p] = t + s.xs0; else s.t[s.p] = s.e; else s.setRatio(e);
                s = s._next
            }
        }, c._enableTransforms = function (e) {
            this._transform = this._transform || qe(this._target, s, !0), this._transformType = this._transform.svg && Se || !e && 3 !== this._transformType ? 2 : 3
        };
        var Ze = function (e) {
            this.t[this.p] = this.e, this.data._linkCSSP(this, this._next, null, !0)
        };
        c._addLazySet = function (e, t, i) {
            var n = this._firstPT = new xe(e, t, 0, 0, this._firstPT, 2);
            n.e = i, n.setRatio = Ze, n.data = this
        }, c._linkCSSP = function (e, t, i, n) {
            return e && (t && (t._prev = e), e._next && (e._next._prev = e._prev), e._prev ? e._prev._next = e._next : this._firstPT === e && (this._firstPT = e._next, n = !0), i ? i._next = e : n || null !== this._firstPT || (this._firstPT = e), e._next = t, e._prev = i), e
        }, c._mod = function (e) {
            for (var t = this._firstPT; t;) "function" == typeof e[t.p] && e[t.p] === Math.round && (t.r = 1), t = t._next
        }, c._kill = function (t) {
            var i, n, s, o = t;
            if (t.autoAlpha || t.alpha) {
                o = {};
                for (n in t) o[n] = t[n];
                o.opacity = 1, o.autoAlpha && (o.visibility = 1)
            }
            for (t.className && (i = this._classNamePT) && (s = i.xfirst, s && s._prev ? this._linkCSSP(s._prev, i._next, s._prev._prev) : s === this._firstPT && (this._firstPT = i._next), i._next && this._linkCSSP(i._next, i._next._next, s._prev), this._classNamePT = null), i = this._firstPT; i;) i.plugin && i.plugin !== n && i.plugin._kill && (i.plugin._kill(t), n = i.plugin), i = i._next;
            return e.prototype._kill.call(this, o)
        };
        var Qe = function (e, t, i) {
            var n, s, o, r;
            if (e.slice) for (s = e.length; --s > -1;) Qe(e[s], t, i); else for (n = e.childNodes, s = n.length; --s > -1;) o = n[s], r = o.type, o.style && (t.push(ie(o)), i && i.push(o)), 1 !== r && 9 !== r && 11 !== r || !o.childNodes.length || Qe(o, t, i)
        };
        return r.cascadeTo = function (e, i, n) {
            var s, o, r, a, l = t.to(e, i, n), c = [l], u = [], d = [], h = [], p = t._internals.reservedProps;
            for (e = l._targets || l.target, Qe(e, u, h), l.render(i, !0, !0), Qe(e, d), l.render(0, !0, !0), l._enabled(!0), s = h.length; --s > -1;) if (o = ne(h[s], u[s], d[s]), o.firstMPT) {
                o = o.difs;
                for (r in n) p[r] && (o[r] = n[r]);
                a = {};
                for (r in o) a[r] = u[s][r];
                c.push(t.fromTo(h[s], i, a, o))
            }
            return c
        }, e.activate([r]), r
    }, !0), function () {
        var e = _gsScope._gsDefine.plugin({
            propName: "roundProps", version: "1.6.0", priority: -1, API: 2, init: function (e, t, i) {
                return this._tween = i, !0
            }
        }), t = function (e) {
            for (; e;) e.f || e.blob || (e.m = Math.round), e = e._next
        }, i = e.prototype;
        i._onInitAllProps = function () {
            for (var e, i, n, s = this._tween, o = s.vars.roundProps.join ? s.vars.roundProps : s.vars.roundProps.split(","), r = o.length, a = {}, l = s._propLookup.roundProps; --r > -1;) a[o[r]] = Math.round;
            for (r = o.length; --r > -1;) for (e = o[r], i = s._firstPT; i;) n = i._next, i.pg ? i.t._mod(a) : i.n === e && (2 === i.f && i.t ? t(i.t._firstPT) : (this._add(i.t, e, i.s, i.c), n && (n._prev = i._prev), i._prev ? i._prev._next = n : s._firstPT === i && (s._firstPT = n), i._next = i._prev = null, s._propLookup[e] = l)), i = n;
            return !1
        }, i._add = function (e, t, i, n) {
            this._addTween(e, t, i, i + n, t, Math.round), this._overwriteProps.push(t)
        }
    }(), function () {
        _gsScope._gsDefine.plugin({
            propName: "attr", API: 2, version: "0.6.1", init: function (e, t, i, n) {
                var s, o;
                if ("function" != typeof e.setAttribute) return !1;
                for (s in t) o = t[s], "function" == typeof o && (o = o(n, e)), this._addTween(e, "setAttribute", e.getAttribute(s) + "", o + "", s, !1, s), this._overwriteProps.push(s);
                return !0
            }
        })
    }(), _gsScope._gsDefine.plugin({
        propName: "directionalRotation", version: "0.3.1", API: 2, init: function (e, t, i, n) {
            "object" != typeof t && (t = {rotation: t}), this.finals = {};
            var s, o, r, a, l, c, u = !0 === t.useRadians ? 2 * Math.PI : 360;
            for (s in t) "useRadians" !== s && (a = t[s], "function" == typeof a && (a = a(n, e)), c = (a + "").split("_"), o = c[0], r = parseFloat("function" != typeof e[s] ? e[s] : e[s.indexOf("set") || "function" != typeof e["get" + s.substr(3)] ? s : "get" + s.substr(3)]()), a = this.finals[s] = "string" == typeof o && "=" === o.charAt(1) ? r + parseInt(o.charAt(0) + "1", 10) * Number(o.substr(2)) : Number(o) || 0, l = a - r, c.length && (o = c.join("_"), -1 !== o.indexOf("short") && (l %= u) !== l % (u / 2) && (l = l < 0 ? l + u : l - u), -1 !== o.indexOf("_cw") && l < 0 ? l = (l + 9999999999 * u) % u - (l / u | 0) * u : -1 !== o.indexOf("ccw") && l > 0 && (l = (l - 9999999999 * u) % u - (l / u | 0) * u)), (l > 1e-6 || l < -1e-6) && (this._addTween(e, s, r, r + l, s), this._overwriteProps.push(s)));
            return !0
        }, set: function (e) {
            var t;
            if (1 !== e) this._super.setRatio.call(this, e); else for (t = this._firstPT; t;) t.f ? t.t[t.p](this.finals[t.p]) : t.t[t.p] = this.finals[t.p], t = t._next
        }
    })._autoCSS = !0, _gsScope._gsDefine("easing.Back", ["easing.Ease"], function (e) {
        var t, i, n, s = _gsScope.GreenSockGlobals || _gsScope, o = s.com.greensock, r = 2 * Math.PI, a = Math.PI / 2,
            l = o._class, c = function (t, i) {
                var n = l("easing." + t, function () {
                }, !0), s = n.prototype = new e;
                return s.constructor = n, s.getRatio = i, n
            }, u = e.register || function () {
            }, d = function (e, t, i, n, s) {
                var o = l("easing." + e, {easeOut: new t, easeIn: new i, easeInOut: new n}, !0);
                return u(o, e), o
            }, h = function (e, t, i) {
                this.t = e, this.v = t, i && (this.next = i, i.prev = this, this.c = i.v - t, this.gap = i.t - e)
            }, p = function (t, i) {
                var n = l("easing." + t, function (e) {
                    this._p1 = e || 0 === e ? e : 1.70158, this._p2 = 1.525 * this._p1
                }, !0), s = n.prototype = new e;
                return s.constructor = n, s.getRatio = i, s.config = function (e) {
                    return new n(e)
                }, n
            }, f = d("Back", p("BackOut", function (e) {
                return (e -= 1) * e * ((this._p1 + 1) * e + this._p1) + 1
            }), p("BackIn", function (e) {
                return e * e * ((this._p1 + 1) * e - this._p1)
            }), p("BackInOut", function (e) {
                return (e *= 2) < 1 ? .5 * e * e * ((this._p2 + 1) * e - this._p2) : .5 * ((e -= 2) * e * ((this._p2 + 1) * e + this._p2) + 2)
            })), g = l("easing.SlowMo", function (e, t, i) {
                t = t || 0 === t ? t : .7, null == e ? e = .7 : e > 1 && (e = 1), this._p = 1 !== e ? t : 0, this._p1 = (1 - e) / 2, this._p2 = e, this._p3 = this._p1 + this._p2, this._calcEnd = !0 === i
            }, !0), m = g.prototype = new e;
        return m.constructor = g, m.getRatio = function (e) {
            var t = e + (.5 - e) * this._p;
            return e < this._p1 ? this._calcEnd ? 1 - (e = 1 - e / this._p1) * e : t - (e = 1 - e / this._p1) * e * e * e * t : e > this._p3 ? this._calcEnd ? 1 === e ? 0 : 1 - (e = (e - this._p3) / this._p1) * e : t + (e - t) * (e = (e - this._p3) / this._p1) * e * e * e : this._calcEnd ? 1 : t
        }, g.ease = new g(.7, .7), m.config = g.config = function (e, t, i) {
            return new g(e, t, i)
        }, t = l("easing.SteppedEase", function (e, t) {
            e = e || 1, this._p1 = 1 / e, this._p2 = e + (t ? 0 : 1), this._p3 = t ? 1 : 0
        }, !0), m = t.prototype = new e, m.constructor = t, m.getRatio = function (e) {
            return e < 0 ? e = 0 : e >= 1 && (e = .999999999), ((this._p2 * e | 0) + this._p3) * this._p1
        }, m.config = t.config = function (e, i) {
            return new t(e, i)
        }, i = l("easing.RoughEase", function (t) {
            t = t || {};
            for (var i, n, s, o, r, a, l = t.taper || "none", c = [], u = 0, d = 0 | (t.points || 20), p = d, f = !1 !== t.randomize, g = !0 === t.clamp, m = t.template instanceof e ? t.template : null, v = "number" == typeof t.strength ? .4 * t.strength : .4; --p > -1;) i = f ? Math.random() : 1 / d * p, n = m ? m.getRatio(i) : i, "none" === l ? s = v : "out" === l ? (o = 1 - i, s = o * o * v) : "in" === l ? s = i * i * v : i < .5 ? (o = 2 * i, s = o * o * .5 * v) : (o = 2 * (1 - i), s = o * o * .5 * v), f ? n += Math.random() * s - .5 * s : p % 2 ? n += .5 * s : n -= .5 * s, g && (n > 1 ? n = 1 : n < 0 && (n = 0)), c[u++] = {
                x: i,
                y: n
            };
            for (c.sort(function (e, t) {
                return e.x - t.x
            }), a = new h(1, 1, null), p = d; --p > -1;) r = c[p], a = new h(r.x, r.y, a);
            this._prev = new h(0, 0, 0 !== a.t ? a : a.next)
        }, !0), m = i.prototype = new e, m.constructor = i, m.getRatio = function (e) {
            var t = this._prev;
            if (e > t.t) {
                for (; t.next && e >= t.t;) t = t.next;
                t = t.prev
            } else for (; t.prev && e <= t.t;) t = t.prev;
            return this._prev = t, t.v + (e - t.t) / t.gap * t.c
        }, m.config = function (e) {
            return new i(e)
        }, i.ease = new i, d("Bounce", c("BounceOut", function (e) {
            return e < 1 / 2.75 ? 7.5625 * e * e : e < 2 / 2.75 ? 7.5625 * (e -= 1.5 / 2.75) * e + .75 : e < 2.5 / 2.75 ? 7.5625 * (e -= 2.25 / 2.75) * e + .9375 : 7.5625 * (e -= 2.625 / 2.75) * e + .984375
        }), c("BounceIn", function (e) {
            return (e = 1 - e) < 1 / 2.75 ? 1 - 7.5625 * e * e : e < 2 / 2.75 ? 1 - (7.5625 * (e -= 1.5 / 2.75) * e + .75) : e < 2.5 / 2.75 ? 1 - (7.5625 * (e -= 2.25 / 2.75) * e + .9375) : 1 - (7.5625 * (e -= 2.625 / 2.75) * e + .984375)
        }), c("BounceInOut", function (e) {
            var t = e < .5;
            return e = t ? 1 - 2 * e : 2 * e - 1, e < 1 / 2.75 ? e *= 7.5625 * e : e = e < 2 / 2.75 ? 7.5625 * (e -= 1.5 / 2.75) * e + .75 : e < 2.5 / 2.75 ? 7.5625 * (e -= 2.25 / 2.75) * e + .9375 : 7.5625 * (e -= 2.625 / 2.75) * e + .984375, t ? .5 * (1 - e) : .5 * e + .5
        })), d("Circ", c("CircOut", function (e) {
            return Math.sqrt(1 - (e -= 1) * e)
        }), c("CircIn", function (e) {
            return -(Math.sqrt(1 - e * e) - 1)
        }), c("CircInOut", function (e) {
            return (e *= 2) < 1 ? -.5 * (Math.sqrt(1 - e * e) - 1) : .5 * (Math.sqrt(1 - (e -= 2) * e) + 1)
        })), n = function (t, i, n) {
            var s = l("easing." + t, function (e, t) {
                this._p1 = e >= 1 ? e : 1, this._p2 = (t || n) / (e < 1 ? e : 1), this._p3 = this._p2 / r * (Math.asin(1 / this._p1) || 0), this._p2 = r / this._p2
            }, !0), o = s.prototype = new e;
            return o.constructor = s, o.getRatio = i, o.config = function (e, t) {
                return new s(e, t)
            }, s
        }, d("Elastic", n("ElasticOut", function (e) {
            return this._p1 * Math.pow(2, -10 * e) * Math.sin((e - this._p3) * this._p2) + 1
        }, .3), n("ElasticIn", function (e) {
            return -this._p1 * Math.pow(2, 10 * (e -= 1)) * Math.sin((e - this._p3) * this._p2)
        }, .3), n("ElasticInOut", function (e) {
            return (e *= 2) < 1 ? this._p1 * Math.pow(2, 10 * (e -= 1)) * Math.sin((e - this._p3) * this._p2) * -.5 : this._p1 * Math.pow(2, -10 * (e -= 1)) * Math.sin((e - this._p3) * this._p2) * .5 + 1
        }, .45)), d("Expo", c("ExpoOut", function (e) {
            return 1 - Math.pow(2, -10 * e)
        }), c("ExpoIn", function (e) {
            return Math.pow(2, 10 * (e - 1)) - .001
        }), c("ExpoInOut", function (e) {
            return (e *= 2) < 1 ? .5 * Math.pow(2, 10 * (e - 1)) : .5 * (2 - Math.pow(2, -10 * (e - 1)))
        })), d("Sine", c("SineOut", function (e) {
            return Math.sin(e * a)
        }), c("SineIn", function (e) {
            return 1 - Math.cos(e * a)
        }), c("SineInOut", function (e) {
            return -.5 * (Math.cos(Math.PI * e) - 1)
        })), l("easing.EaseLookup", {
            find: function (t) {
                return e.map[t]
            }
        }, !0), u(s.SlowMo, "SlowMo", "ease,"), u(i, "RoughEase", "ease,"), u(t, "SteppedEase", "ease,"), f
    }, !0)
}), _gsScope._gsDefine && _gsScope._gsQueue.pop()(), function (e, t) {
    "use strict";
    var i = {}, n = e.document, s = e.GreenSockGlobals = e.GreenSockGlobals || e;
    if (!s.TweenLite) {
        var o, r, a, l, c, u = function (e) {
            var t, i = e.split("."), n = s;
            for (t = 0; t < i.length; t++) n[i[t]] = n = n[i[t]] || {};
            return n
        }, d = u("com.greensock"), h = function (e) {
            var t, i = [], n = e.length;
            for (t = 0; t !== n; i.push(e[t++])) ;
            return i
        }, p = function () {
        }, f = function () {
            var e = Object.prototype.toString, t = e.call([]);
            return function (i) {
                return null != i && (i instanceof Array || "object" == typeof i && !!i.push && e.call(i) === t)
            }
        }(), g = {}, m = function (t, n, o, r) {
            this.sc = g[t] ? g[t].sc : [], g[t] = this, this.gsClass = null, this.func = o;
            var a = [];
            this.check = function (l) {
                for (var c, d, h, p, f = n.length, v = f; --f > -1;) (c = g[n[f]] || new m(n[f], [])).gsClass ? (a[f] = c.gsClass, v--) : l && c.sc.push(this);
                if (0 === v && o) {
                    if (d = ("com.greensock." + t).split("."), h = d.pop(), p = u(d.join("."))[h] = this.gsClass = o.apply(o, a), r) if (s[h] = i[h] = p, "undefined" != typeof module && module.exports) if ("TweenMax" === t) {
                        module.exports = i.TweenMax = p;
                        for (f in i) p[f] = i[f]
                    } else i.TweenMax && (i.TweenMax[h] = p); else "function" == typeof define && define.amd && define((e.GreenSockAMDPath ? e.GreenSockAMDPath + "/" : "") + t.split(".").pop(), [], function () {
                        return p
                    });
                    for (f = 0; f < this.sc.length; f++) this.sc[f].check()
                }
            }, this.check(!0)
        }, v = e._gsDefine = function (e, t, i, n) {
            return new m(e, t, i, n)
        }, y = d._class = function (e, t, i) {
            return t = t || function () {
            }, v(e, [], function () {
                return t
            }, i), t
        };
        v.globals = s;
        var x = [0, 0, 1, 1], b = y("easing.Ease", function (e, t, i, n) {
            this._func = e, this._type = i || 0, this._power = n || 0, this._params = t ? x.concat(t) : x
        }, !0), _ = b.map = {}, w = b.register = function (e, t, i, n) {
            for (var s, o, r, a, l = t.split(","), c = l.length, u = (i || "easeIn,easeOut,easeInOut").split(","); --c > -1;) for (o = l[c], s = n ? y("easing." + o, null, !0) : d.easing[o] || {}, r = u.length; --r > -1;) a = u[r], _[o + "." + a] = _[a + o] = s[a] = e.getRatio ? e : e[a] || new e
        };
        for (a = b.prototype, a._calcEnd = !1, a.getRatio = function (e) {
            if (this._func) return this._params[0] = e, this._func.apply(null, this._params);
            var t = this._type, i = this._power, n = 1 === t ? 1 - e : 2 === t ? e : e < .5 ? 2 * e : 2 * (1 - e);
            return 1 === i ? n *= n : 2 === i ? n *= n * n : 3 === i ? n *= n * n * n : 4 === i && (n *= n * n * n * n), 1 === t ? 1 - n : 2 === t ? n : e < .5 ? n / 2 : 1 - n / 2
        }, o = ["Linear", "Quad", "Cubic", "Quart", "Quint,Strong"], r = o.length; --r > -1;) a = o[r] + ",Power" + r, w(new b(null, null, 1, r), a, "easeOut", !0), w(new b(null, null, 2, r), a, "easeIn" + (0 === r ? ",easeNone" : "")), w(new b(null, null, 3, r), a, "easeInOut");
        _.linear = d.easing.Linear.easeIn, _.swing = d.easing.Quad.easeInOut;
        var T = y("events.EventDispatcher", function (e) {
            this._listeners = {}, this._eventTarget = e || this
        });
        a = T.prototype, a.addEventListener = function (e, t, i, n, s) {
            s = s || 0;
            var o, r, a = this._listeners[e], u = 0;
            for (this !== l || c || l.wake(), null == a && (this._listeners[e] = a = []), r = a.length; --r > -1;) o = a[r], o.c === t && o.s === i ? a.splice(r, 1) : 0 === u && o.pr < s && (u = r + 1);
            a.splice(u, 0, {c: t, s: i, up: n, pr: s})
        }, a.removeEventListener = function (e, t) {
            var i, n = this._listeners[e];
            if (n) for (i = n.length; --i > -1;) if (n[i].c === t) return void n.splice(i, 1)
        }, a.dispatchEvent = function (e) {
            var t, i, n, s = this._listeners[e];
            if (s) for (t = s.length, t > 1 && (s = s.slice(0)), i = this._eventTarget; --t > -1;) (n = s[t]) && (n.up ? n.c.call(n.s || i, {
                type: e,
                target: i
            }) : n.c.call(n.s || i))
        };
        var k = e.requestAnimationFrame, $ = e.cancelAnimationFrame, S = Date.now || function () {
            return (new Date).getTime()
        }, C = S();
        for (o = ["ms", "moz", "webkit", "o"], r = o.length; --r > -1 && !k;) k = e[o[r] + "RequestAnimationFrame"], $ = e[o[r] + "CancelAnimationFrame"] || e[o[r] + "CancelRequestAnimationFrame"];
        y("Ticker", function (e, t) {
            var i, s, o, r, a, u = this, d = S(), h = !(!1 === t || !k) && "auto", f = 500, g = 33, m = function (e) {
                var t, n, l = S() - C;
                l > f && (d += l - g), C += l, u.time = (C - d) / 1e3, t = u.time - a, (!i || t > 0 || !0 === e) && (u.frame++, a += t + (t >= r ? .004 : r - t), n = !0), !0 !== e && (o = s(m)), n && u.dispatchEvent("tick")
            };
            T.call(u), u.time = u.frame = 0, u.tick = function () {
                m(!0)
            }, u.lagSmoothing = function (e, t) {
                if (!arguments.length) return f < 1e10;
                f = e || 1e10, g = Math.min(t, f, 0)
            }, u.sleep = function () {
                null != o && (h && $ ? $(o) : clearTimeout(o), s = p, o = null, u === l && (c = !1))
            }, u.wake = function (e) {
                null !== o ? u.sleep() : e ? d += -C + (C = S()) : u.frame > 10 && (C = S() - f + 5), s = 0 === i ? p : h && k ? k : function (e) {
                    return setTimeout(e, 1e3 * (a - u.time) + 1 | 0)
                }, u === l && (c = !0), m(2)
            }, u.fps = function (e) {
                if (!arguments.length) return i;
                i = e, r = 1 / (i || 60), a = this.time + r, u.wake()
            }, u.useRAF = function (e) {
                if (!arguments.length) return h;
                u.sleep(), h = e, u.fps(i)
            }, u.fps(e), setTimeout(function () {
                "auto" === h && u.frame < 5 && "hidden" !== n.visibilityState && u.useRAF(!1)
            }, 1500)
        }), a = d.Ticker.prototype = new d.events.EventDispatcher, a.constructor = d.Ticker;
        var P = y("core.Animation", function (e, t) {
            if (this.vars = t = t || {}, this._duration = this._totalDuration = e || 0, this._delay = Number(t.delay) || 0, this._timeScale = 1, this._active = !0 === t.immediateRender, this.data = t.data, this._reversed = !0 === t.reversed, V) {
                c || l.wake();
                var i = this.vars.useFrames ? U : V;
                i.add(this, i._time), this.vars.paused && this.paused(!0)
            }
        });
        l = P.ticker = new d.Ticker, a = P.prototype, a._dirty = a._gc = a._initted = a._paused = !1, a._totalTime = a._time = 0, a._rawPrevTime = -1, a._next = a._last = a._onUpdate = a._timeline = a.timeline = null, a._paused = !1;
        var O = function () {
            c && S() - C > 2e3 && ("hidden" !== n.visibilityState || !l.lagSmoothing()) && l.wake();
            var e = setTimeout(O, 2e3);
            e.unref && e.unref()
        };
        O(), a.play = function (e, t) {
            return null != e && this.seek(e, t), this.reversed(!1).paused(!1)
        }, a.pause = function (e, t) {
            return null != e && this.seek(e, t), this.paused(!0)
        }, a.resume = function (e, t) {
            return null != e && this.seek(e, t), this.paused(!1)
        }, a.seek = function (e, t) {
            return this.totalTime(Number(e), !1 !== t)
        }, a.restart = function (e, t) {
            return this.reversed(!1).paused(!1).totalTime(e ? -this._delay : 0, !1 !== t, !0)
        }, a.reverse = function (e, t) {
            return null != e && this.seek(e || this.totalDuration(), t), this.reversed(!0).paused(!1)
        }, a.render = function (e, t, i) {
        }, a.invalidate = function () {
            return this._time = this._totalTime = 0, this._initted = this._gc = !1, this._rawPrevTime = -1, !this._gc && this.timeline || this._enabled(!0), this
        }, a.isActive = function () {
            var e, t = this._timeline, i = this._startTime;
            return !t || !this._gc && !this._paused && t.isActive() && (e = t.rawTime(!0)) >= i && e < i + this.totalDuration() / this._timeScale - 1e-7
        }, a._enabled = function (e, t) {
            return c || l.wake(), this._gc = !e, this._active = this.isActive(), !0 !== t && (e && !this.timeline ? this._timeline.add(this, this._startTime - this._delay) : !e && this.timeline && this._timeline._remove(this, !0)), !1
        }, a._kill = function (e, t) {
            return this._enabled(!1, !1)
        }, a.kill = function (e, t) {
            return this._kill(e, t), this
        }, a._uncache = function (e) {
            for (var t = e ? this : this.timeline; t;) t._dirty = !0, t = t.timeline;
            return this
        }, a._swapSelfInParams = function (e) {
            for (var t = e.length, i = e.concat(); --t > -1;) "{self}" === e[t] && (i[t] = this);
            return i
        }, a._callback = function (e) {
            var t = this.vars, i = t[e], n = t[e + "Params"], s = t[e + "Scope"] || t.callbackScope || this;
            switch (n ? n.length : 0) {
                case 0:
                    i.call(s);
                    break;
                case 1:
                    i.call(s, n[0]);
                    break;
                case 2:
                    i.call(s, n[0], n[1]);
                    break;
                default:
                    i.apply(s, n)
            }
        }, a.eventCallback = function (e, t, i, n) {
            if ("on" === (e || "").substr(0, 2)) {
                var s = this.vars;
                if (1 === arguments.length) return s[e];
                null == t ? delete s[e] : (s[e] = t, s[e + "Params"] = f(i) && -1 !== i.join("").indexOf("{self}") ? this._swapSelfInParams(i) : i, s[e + "Scope"] = n), "onUpdate" === e && (this._onUpdate = t)
            }
            return this
        }, a.delay = function (e) {
            return arguments.length ? (this._timeline.smoothChildTiming && this.startTime(this._startTime + e - this._delay), this._delay = e, this) : this._delay
        }, a.duration = function (e) {
            return arguments.length ? (this._duration = this._totalDuration = e, this._uncache(!0), this._timeline.smoothChildTiming && this._time > 0 && this._time < this._duration && 0 !== e && this.totalTime(this._totalTime * (e / this._duration), !0), this) : (this._dirty = !1, this._duration)
        }, a.totalDuration = function (e) {
            return this._dirty = !1, arguments.length ? this.duration(e) : this._totalDuration
        }, a.time = function (e, t) {
            return arguments.length ? (this._dirty && this.totalDuration(), this.totalTime(e > this._duration ? this._duration : e, t)) : this._time
        }, a.totalTime = function (e, t, i) {
            if (c || l.wake(), !arguments.length) return this._totalTime;
            if (this._timeline) {
                if (e < 0 && !i && (e += this.totalDuration()), this._timeline.smoothChildTiming) {
                    this._dirty && this.totalDuration();
                    var n = this._totalDuration, s = this._timeline;
                    if (e > n && !i && (e = n), this._startTime = (this._paused ? this._pauseTime : s._time) - (this._reversed ? n - e : e) / this._timeScale, s._dirty || this._uncache(!1), s._timeline) for (; s._timeline;) s._timeline._time !== (s._startTime + s._totalTime) / s._timeScale && s.totalTime(s._totalTime, !0), s = s._timeline
                }
                this._gc && this._enabled(!0, !1), this._totalTime === e && 0 !== this._duration || (E.length && Z(), this.render(e, t, !1), E.length && Z())
            }
            return this
        }, a.progress = a.totalProgress = function (e, t) {
            var i = this.duration();
            return arguments.length ? this.totalTime(i * e, t) : i ? this._time / i : this.ratio
        }, a.startTime = function (e) {
            return arguments.length ? (e !== this._startTime && (this._startTime = e, this.timeline && this.timeline._sortChildren && this.timeline.add(this, e - this._delay)), this) : this._startTime
        }, a.endTime = function (e) {
            return this._startTime + (0 != e ? this.totalDuration() : this.duration()) / this._timeScale
        }, a.timeScale = function (e) {
            if (!arguments.length) return this._timeScale;
            var t, i;
            for (e = e || 1e-10, this._timeline && this._timeline.smoothChildTiming && (t = this._pauseTime, i = t || 0 === t ? t : this._timeline.totalTime(), this._startTime = i - (i - this._startTime) * this._timeScale / e), this._timeScale = e, i = this.timeline; i && i.timeline;) i._dirty = !0, i.totalDuration(), i = i.timeline;
            return this
        }, a.reversed = function (e) {
            return arguments.length ? (e != this._reversed && (this._reversed = e, this.totalTime(this._timeline && !this._timeline.smoothChildTiming ? this.totalDuration() - this._totalTime : this._totalTime, !0)), this) : this._reversed
        }, a.paused = function (e) {
            if (!arguments.length) return this._paused;
            var t, i, n = this._timeline;
            return e != this._paused && n && (c || e || l.wake(), t = n.rawTime(), i = t - this._pauseTime, !e && n.smoothChildTiming && (this._startTime += i, this._uncache(!1)), this._pauseTime = e ? t : null, this._paused = e, this._active = this.isActive(), !e && 0 !== i && this._initted && this.duration() && (t = n.smoothChildTiming ? this._totalTime : (t - this._startTime) / this._timeScale, this.render(t, t === this._totalTime, !0))), this._gc && !e && this._enabled(!0, !1), this
        };
        var A = y("core.SimpleTimeline", function (e) {
            P.call(this, 0, e), this.autoRemoveChildren = this.smoothChildTiming = !0
        });
        a = A.prototype = new P, a.constructor = A, a.kill()._gc = !1, a._first = a._last = a._recent = null, a._sortChildren = !1, a.add = a.insert = function (e, t, i, n) {
            var s, o;
            if (e._startTime = Number(t || 0) + e._delay, e._paused && this !== e._timeline && (e._pauseTime = e._startTime + (this.rawTime() - e._startTime) / e._timeScale), e.timeline && e.timeline._remove(e, !0), e.timeline = e._timeline = this, e._gc && e._enabled(!0, !0), s = this._last, this._sortChildren) for (o = e._startTime; s && s._startTime > o;) s = s._prev;
            return s ? (e._next = s._next, s._next = e) : (e._next = this._first, this._first = e), e._next ? e._next._prev = e : this._last = e, e._prev = s, this._recent = e, this._timeline && this._uncache(!0), this
        }, a._remove = function (e, t) {
            return e.timeline === this && (t || e._enabled(!1, !0), e._prev ? e._prev._next = e._next : this._first === e && (this._first = e._next), e._next ? e._next._prev = e._prev : this._last === e && (this._last = e._prev), e._next = e._prev = e.timeline = null, e === this._recent && (this._recent = this._last), this._timeline && this._uncache(!0)), this
        }, a.render = function (e, t, i) {
            var n, s = this._first;
            for (this._totalTime = this._time = this._rawPrevTime = e; s;) n = s._next, (s._active || e >= s._startTime && !s._paused && !s._gc) && (s._reversed ? s.render((s._dirty ? s.totalDuration() : s._totalDuration) - (e - s._startTime) * s._timeScale, t, i) : s.render((e - s._startTime) * s._timeScale, t, i)), s = n
        }, a.rawTime = function () {
            return c || l.wake(), this._totalTime
        };
        var L = y("TweenLite", function (t, i, n) {
            if (P.call(this, i, n), this.render = L.prototype.render, null == t) throw"Cannot tween a null target.";
            this.target = t = "string" != typeof t ? t : L.selector(t) || t;
            var s, o, r,
                a = t.jquery || t.length && t !== e && t[0] && (t[0] === e || t[0].nodeType && t[0].style && !t.nodeType),
                l = this.vars.overwrite;
            if (this._overwrite = l = null == l ? W[L.defaultOverwrite] : "number" == typeof l ? l >> 0 : W[l], (a || t instanceof Array || t.push && f(t)) && "number" != typeof t[0]) for (this._targets = r = h(t), this._propLookup = [], this._siblings = [], s = 0; s < r.length; s++) o = r[s], o ? "string" != typeof o ? o.length && o !== e && o[0] && (o[0] === e || o[0].nodeType && o[0].style && !o.nodeType) ? (r.splice(s--, 1), this._targets = r = r.concat(h(o))) : (this._siblings[s] = Q(o, this, !1), 1 === l && this._siblings[s].length > 1 && J(o, this, null, 1, this._siblings[s])) : "string" == typeof(o = r[s--] = L.selector(o)) && r.splice(s + 1, 1) : r.splice(s--, 1); else this._propLookup = {}, this._siblings = Q(t, this, !1), 1 === l && this._siblings.length > 1 && J(t, this, null, 1, this._siblings);
            (this.vars.immediateRender || 0 === i && 0 === this._delay && !1 !== this.vars.immediateRender) && (this._time = -1e-10, this.render(Math.min(0, -this._delay)))
        }, !0), D = function (t) {
            return t && t.length && t !== e && t[0] && (t[0] === e || t[0].nodeType && t[0].style && !t.nodeType)
        }, M = function (e, t) {
            var i, n = {};
            for (i in e) B[i] || i in t && "transform" !== i && "x" !== i && "y" !== i && "width" !== i && "height" !== i && "className" !== i && "border" !== i || !(!X[i] || X[i] && X[i]._autoCSS) || (n[i] = e[i], delete e[i]);
            e.css = n
        };
        a = L.prototype = new P, a.constructor = L, a.kill()._gc = !1, a.ratio = 0, a._firstPT = a._targets = a._overwrittenProps = a._startAt = null, a._notifyPluginsOfEnabled = a._lazy = !1, L.version = "1.20.3", L.defaultEase = a._ease = new b(null, null, 1, 1), L.defaultOverwrite = "auto", L.ticker = l, L.autoSleep = 120, L.lagSmoothing = function (e, t) {
            l.lagSmoothing(e, t)
        }, L.selector = e.$ || e.jQuery || function (t) {
            var i = e.$ || e.jQuery;
            return i ? (L.selector = i, i(t)) : void 0 === n ? t : n.querySelectorAll ? n.querySelectorAll(t) : n.getElementById("#" === t.charAt(0) ? t.substr(1) : t)
        };
        var E = [], F = {}, R = /(?:(-|-=|\+=)?\d*\.?\d*(?:e[\-+]?\d+)?)[0-9]/gi, j = /[\+-]=-?[\.\d]/,
            I = function (e) {
                for (var t, i = this._firstPT; i;) t = i.blob ? 1 === e && null != this.end ? this.end : e ? this.join("") : this.start : i.c * e + i.s, i.m ? t = i.m(t, this._target || i.t) : t < 1e-6 && t > -1e-6 && !i.blob && (t = 0), i.f ? i.fp ? i.t[i.p](i.fp, t) : i.t[i.p](t) : i.t[i.p] = t, i = i._next
            }, H = function (e, t, i, n) {
                var s, o, r, a, l, c, u, d = [], h = 0, p = "", f = 0;
                for (d.start = e, d.end = t, e = d[0] = e + "", t = d[1] = t + "", i && (i(d), e = d[0], t = d[1]), d.length = 0, s = e.match(R) || [], o = t.match(R) || [], n && (n._next = null, n.blob = 1, d._firstPT = d._applyPT = n), l = o.length, a = 0; a < l; a++) u = o[a], c = t.substr(h, t.indexOf(u, h) - h), p += c || !a ? c : ",", h += c.length, f ? f = (f + 1) % 5 : "rgba(" === c.substr(-5) && (f = 1), u === s[a] || s.length <= a ? p += u : (p && (d.push(p), p = ""), r = parseFloat(s[a]), d.push(r), d._firstPT = {
                    _next: d._firstPT,
                    t: d,
                    p: d.length - 1,
                    s: r,
                    c: ("=" === u.charAt(1) ? parseInt(u.charAt(0) + "1", 10) * parseFloat(u.substr(2)) : parseFloat(u) - r) || 0,
                    f: 0,
                    m: f && f < 4 ? Math.round : 0
                }), h += u.length;
                return p += t.substr(h), p && d.push(p), d.setRatio = I, j.test(t) && (d.end = null), d
            }, N = function (e, t, i, n, s, o, r, a, l) {
                "function" == typeof n && (n = n(l || 0, e));
                var c, u = typeof e[t],
                    d = "function" !== u ? "" : t.indexOf("set") || "function" != typeof e["get" + t.substr(3)] ? t : "get" + t.substr(3),
                    h = "get" !== i ? i : d ? r ? e[d](r) : e[d]() : e[t], p = "string" == typeof n && "=" === n.charAt(1),
                    f = {
                        t: e,
                        p: t,
                        s: h,
                        f: "function" === u,
                        pg: 0,
                        n: s || t,
                        m: o ? "function" == typeof o ? o : Math.round : 0,
                        pr: 0,
                        c: p ? parseInt(n.charAt(0) + "1", 10) * parseFloat(n.substr(2)) : parseFloat(n) - h || 0
                    };
                if (("number" != typeof h || "number" != typeof n && !p) && (r || isNaN(h) || !p && isNaN(n) || "boolean" == typeof h || "boolean" == typeof n ? (f.fp = r, c = H(h, p ? parseFloat(f.s) + f.c : n, a || L.defaultStringFilter, f), f = {
                        t: c,
                        p: "setRatio",
                        s: 0,
                        c: 1,
                        f: 2,
                        pg: 0,
                        n: s || t,
                        pr: 0,
                        m: 0
                    }) : (f.s = parseFloat(h), p || (f.c = parseFloat(n) - f.s || 0))), f.c) return (f._next = this._firstPT) && (f._next._prev = f), this._firstPT = f, f
            }, z = L._internals = {isArray: f, isSelector: D, lazyTweens: E, blobDif: H}, X = L._plugins = {},
            q = z.tweenLookup = {}, Y = 0, B = z.reservedProps = {
                ease: 1,
                delay: 1,
                overwrite: 1,
                onComplete: 1,
                onCompleteParams: 1,
                onCompleteScope: 1,
                useFrames: 1,
                runBackwards: 1,
                startAt: 1,
                onUpdate: 1,
                onUpdateParams: 1,
                onUpdateScope: 1,
                onStart: 1,
                onStartParams: 1,
                onStartScope: 1,
                onReverseComplete: 1,
                onReverseCompleteParams: 1,
                onReverseCompleteScope: 1,
                onRepeat: 1,
                onRepeatParams: 1,
                onRepeatScope: 1,
                easeParams: 1,
                yoyo: 1,
                immediateRender: 1,
                repeat: 1,
                repeatDelay: 1,
                data: 1,
                paused: 1,
                reversed: 1,
                autoCSS: 1,
                lazy: 1,
                onOverwrite: 1,
                callbackScope: 1,
                stringFilter: 1,
                id: 1,
                yoyoEase: 1
            }, W = {none: 0, all: 1, auto: 2, concurrent: 3, allOnStart: 4, preexisting: 5, true: 1, false: 0},
            U = P._rootFramesTimeline = new A, V = P._rootTimeline = new A, G = 30,
            Z = z.lazyRender = function () {
                var e, t = E.length;
                for (F = {}; --t > -1;) (e = E[t]) && !1 !== e._lazy && (e.render(e._lazy[0], e._lazy[1], !0), e._lazy = !1);
                E.length = 0
            };
        V._startTime = l.time, U._startTime = l.frame, V._active = U._active = !0, setTimeout(Z, 1), P._updateRoot = L.render = function () {
            var e, t, i;
            if (E.length && Z(), V.render((l.time - V._startTime) * V._timeScale, !1, !1), U.render((l.frame - U._startTime) * U._timeScale, !1, !1), E.length && Z(), l.frame >= G) {
                G = l.frame + (parseInt(L.autoSleep, 10) || 120);
                for (i in q) {
                    for (t = q[i].tweens, e = t.length; --e > -1;) t[e]._gc && t.splice(e, 1);
                    0 === t.length && delete q[i]
                }
                if ((!(i = V._first) || i._paused) && L.autoSleep && !U._first && 1 === l._listeners.tick.length) {
                    for (; i && i._paused;) i = i._next;
                    i || l.sleep()
                }
            }
        }, l.addEventListener("tick", P._updateRoot);
        var Q = function (e, t, i) {
            var n, s, o = e._gsTweenID;
            if (q[o || (e._gsTweenID = o = "t" + Y++)] || (q[o] = {
                    target: e,
                    tweens: []
                }), t && (n = q[o].tweens, n[s = n.length] = t, i)) for (; --s > -1;) n[s] === t && n.splice(s, 1);
            return q[o].tweens
        }, K = function (e, t, i, n) {
            var s, o, r = e.vars.onOverwrite;
            return r && (s = r(e, t, i, n)), r = L.onOverwrite, r && (o = r(e, t, i, n)), !1 !== s && !1 !== o
        }, J = function (e, t, i, n, s) {
            var o, r, a, l;
            if (1 === n || n >= 4) {
                for (l = s.length, o = 0; o < l; o++) if ((a = s[o]) !== t) a._gc || a._kill(null, e, t) && (r = !0); else if (5 === n) break;
                return r
            }
            var c, u = t._startTime + 1e-10, d = [], h = 0, p = 0 === t._duration;
            for (o = s.length; --o > -1;) (a = s[o]) === t || a._gc || a._paused || (a._timeline !== t._timeline ? (c = c || ee(t, 0, p), 0 === ee(a, c, p) && (d[h++] = a)) : a._startTime <= u && a._startTime + a.totalDuration() / a._timeScale > u && ((p || !a._initted) && u - a._startTime <= 2e-10 || (d[h++] = a)));
            for (o = h; --o > -1;) if (a = d[o], 2 === n && a._kill(i, e, t) && (r = !0), 2 !== n || !a._firstPT && a._initted) {
                if (2 !== n && !K(a, t)) continue;
                a._enabled(!1, !1) && (r = !0)
            }
            return r
        }, ee = function (e, t, i) {
            for (var n = e._timeline, s = n._timeScale, o = e._startTime; n._timeline;) {
                if (o += n._startTime, s *= n._timeScale, n._paused) return -100;
                n = n._timeline
            }
            return o /= s, o > t ? o - t : i && o === t || !e._initted && o - t < 2e-10 ? 1e-10 : (o += e.totalDuration() / e._timeScale / s) > t + 1e-10 ? 0 : o - t - 1e-10
        };
        a._init = function () {
            var e, t, i, n, s, o, r = this.vars, a = this._overwrittenProps, l = this._duration,
                c = !!r.immediateRender, u = r.ease;
            if (r.startAt) {
                this._startAt && (this._startAt.render(-1, !0), this._startAt.kill()), s = {};
                for (n in r.startAt) s[n] = r.startAt[n];
                if (s.data = "isStart", s.overwrite = !1, s.immediateRender = !0, s.lazy = c && !1 !== r.lazy, s.startAt = s.delay = null, s.onUpdate = r.onUpdate, s.onUpdateParams = r.onUpdateParams, s.onUpdateScope = r.onUpdateScope || r.callbackScope || this, this._startAt = L.to(this.target, 0, s), c) if (this._time > 0) this._startAt = null; else if (0 !== l) return
            } else if (r.runBackwards && 0 !== l) if (this._startAt) this._startAt.render(-1, !0), this._startAt.kill(), this._startAt = null; else {
                0 !== this._time && (c = !1), i = {};
                for (n in r) B[n] && "autoCSS" !== n || (i[n] = r[n]);
                if (i.overwrite = 0, i.data = "isFromStart", i.lazy = c && !1 !== r.lazy, i.immediateRender = c, this._startAt = L.to(this.target, 0, i), c) {
                    if (0 === this._time) return
                } else this._startAt._init(), this._startAt._enabled(!1), this.vars.immediateRender && (this._startAt = null)
            }
            if (this._ease = u = u ? u instanceof b ? u : "function" == typeof u ? new b(u, r.easeParams) : _[u] || L.defaultEase : L.defaultEase, r.easeParams instanceof Array && u.config && (this._ease = u.config.apply(u, r.easeParams)), this._easeType = this._ease._type, this._easePower = this._ease._power, this._firstPT = null, this._targets) for (o = this._targets.length, e = 0; e < o; e++) this._initProps(this._targets[e], this._propLookup[e] = {}, this._siblings[e], a ? a[e] : null, e) && (t = !0); else t = this._initProps(this.target, this._propLookup, this._siblings, a, 0);
            if (t && L._onPluginEvent("_onInitAllProps", this), a && (this._firstPT || "function" != typeof this.target && this._enabled(!1, !1)), r.runBackwards) for (i = this._firstPT; i;) i.s += i.c, i.c = -i.c, i = i._next;
            this._onUpdate = r.onUpdate, this._initted = !0
        }, a._initProps = function (t, i, n, s, o) {
            var r, a, l, c, u, d;
            if (null == t) return !1;
            F[t._gsTweenID] && Z(), this.vars.css || t.style && t !== e && t.nodeType && X.css && !1 !== this.vars.autoCSS && M(this.vars, t);
            for (r in this.vars) if (d = this.vars[r], B[r]) d && (d instanceof Array || d.push && f(d)) && -1 !== d.join("").indexOf("{self}") && (this.vars[r] = d = this._swapSelfInParams(d, this)); else if (X[r] && (c = new X[r])._onInitTween(t, this.vars[r], this, o)) {
                for (this._firstPT = u = {
                    _next: this._firstPT,
                    t: c,
                    p: "setRatio",
                    s: 0,
                    c: 1,
                    f: 1,
                    n: r,
                    pg: 1,
                    pr: c._priority,
                    m: 0
                }, a = c._overwriteProps.length; --a > -1;) i[c._overwriteProps[a]] = this._firstPT;
                (c._priority || c._onInitAllProps) && (l = !0), (c._onDisable || c._onEnable) && (this._notifyPluginsOfEnabled = !0), u._next && (u._next._prev = u)
            } else i[r] = N.call(this, t, r, "get", d, r, 0, null, this.vars.stringFilter, o);
            return s && this._kill(s, t) ? this._initProps(t, i, n, s, o) : this._overwrite > 1 && this._firstPT && n.length > 1 && J(t, this, i, this._overwrite, n) ? (this._kill(i, t), this._initProps(t, i, n, s, o)) : (this._firstPT && (!1 !== this.vars.lazy && this._duration || this.vars.lazy && !this._duration) && (F[t._gsTweenID] = !0), l)
        }, a.render = function (e, t, i) {
            var n, s, o, r, a = this._time, l = this._duration, c = this._rawPrevTime;
            if (e >= l - 1e-7 && e >= 0) this._totalTime = this._time = l, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1, this._reversed || (n = !0, s = "onComplete", i = i || this._timeline.autoRemoveChildren), 0 === l && (this._initted || !this.vars.lazy || i) && (this._startTime === this._timeline._duration && (e = 0), (c < 0 || e <= 0 && e >= -1e-7 || 1e-10 === c && "isPause" !== this.data) && c !== e && (i = !0, c > 1e-10 && (s = "onReverseComplete")), this._rawPrevTime = r = !t || e || c === e ? e : 1e-10); else if (e < 1e-7) this._totalTime = this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== a || 0 === l && c > 0) && (s = "onReverseComplete", n = this._reversed), e < 0 && (this._active = !1, 0 === l && (this._initted || !this.vars.lazy || i) && (c >= 0 && (1e-10 !== c || "isPause" !== this.data) && (i = !0), this._rawPrevTime = r = !t || e || c === e ? e : 1e-10)), (!this._initted || this._startAt && this._startAt.progress()) && (i = !0); else if (this._totalTime = this._time = e, this._easeType) {
                var u = e / l, d = this._easeType, h = this._easePower;
                (1 === d || 3 === d && u >= .5) && (u = 1 - u), 3 === d && (u *= 2), 1 === h ? u *= u : 2 === h ? u *= u * u : 3 === h ? u *= u * u * u : 4 === h && (u *= u * u * u * u), this.ratio = 1 === d ? 1 - u : 2 === d ? u : e / l < .5 ? u / 2 : 1 - u / 2
            } else this.ratio = this._ease.getRatio(e / l);
            if (this._time !== a || i) {
                if (!this._initted) {
                    if (this._init(), !this._initted || this._gc) return;
                    if (!i && this._firstPT && (!1 !== this.vars.lazy && this._duration || this.vars.lazy && !this._duration)) return this._time = this._totalTime = a, this._rawPrevTime = c, E.push(this), void(this._lazy = [e, t]);
                    this._time && !n ? this.ratio = this._ease.getRatio(this._time / l) : n && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1))
                }
                for (!1 !== this._lazy && (this._lazy = !1), this._active || !this._paused && this._time !== a && e >= 0 && (this._active = !0), 0 === a && (this._startAt && (e >= 0 ? this._startAt.render(e, !0, i) : s || (s = "_dummyGS")), this.vars.onStart && (0 === this._time && 0 !== l || t || this._callback("onStart"))), o = this._firstPT; o;) o.f ? o.t[o.p](o.c * this.ratio + o.s) : o.t[o.p] = o.c * this.ratio + o.s, o = o._next;
                this._onUpdate && (e < 0 && this._startAt && -1e-4 !== e && this._startAt.render(e, !0, i), t || (this._time !== a || n || i) && this._callback("onUpdate")), s && (this._gc && !i || (e < 0 && this._startAt && !this._onUpdate && -1e-4 !== e && this._startAt.render(e, !0, i), n && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !t && this.vars[s] && this._callback(s), 0 === l && 1e-10 === this._rawPrevTime && 1e-10 !== r && (this._rawPrevTime = 0)))
            }
        }, a._kill = function (e, t, i) {
            if ("all" === e && (e = null), null == e && (null == t || t === this.target)) return this._lazy = !1, this._enabled(!1, !1);
            t = "string" != typeof t ? t || this._targets || this.target : L.selector(t) || t;
            var n, s, o, r, a, l, c, u, d,
                h = i && this._time && i._startTime === this._startTime && this._timeline === i._timeline;
            if ((f(t) || D(t)) && "number" != typeof t[0]) for (n = t.length; --n > -1;) this._kill(e, t[n], i) && (l = !0); else {
                if (this._targets) {
                    for (n = this._targets.length; --n > -1;) if (t === this._targets[n]) {
                        a = this._propLookup[n] || {}, this._overwrittenProps = this._overwrittenProps || [], s = this._overwrittenProps[n] = e ? this._overwrittenProps[n] || {} : "all";
                        break
                    }
                } else {
                    if (t !== this.target) return !1;
                    a = this._propLookup, s = this._overwrittenProps = e ? this._overwrittenProps || {} : "all"
                }
                if (a) {
                    if (c = e || a, u = e !== s && "all" !== s && e !== a && ("object" != typeof e || !e._tempKill), i && (L.onOverwrite || this.vars.onOverwrite)) {
                        for (o in c) a[o] && (d || (d = []), d.push(o));
                        if ((d || !e) && !K(this, i, t, d)) return !1
                    }
                    for (o in c) (r = a[o]) && (h && (r.f ? r.t[r.p](r.s) : r.t[r.p] = r.s, l = !0), r.pg && r.t._kill(c) && (l = !0), r.pg && 0 !== r.t._overwriteProps.length || (r._prev ? r._prev._next = r._next : r === this._firstPT && (this._firstPT = r._next), r._next && (r._next._prev = r._prev), r._next = r._prev = null), delete a[o]), u && (s[o] = 1);
                    !this._firstPT && this._initted && this._enabled(!1, !1)
                }
            }
            return l
        }, a.invalidate = function () {
            return this._notifyPluginsOfEnabled && L._onPluginEvent("_onDisable", this), this._firstPT = this._overwrittenProps = this._startAt = this._onUpdate = null, this._notifyPluginsOfEnabled = this._active = this._lazy = !1, this._propLookup = this._targets ? {} : [], P.prototype.invalidate.call(this), this.vars.immediateRender && (this._time = -1e-10, this.render(Math.min(0, -this._delay))), this
        }, a._enabled = function (e, t) {
            if (c || l.wake(), e && this._gc) {
                var i, n = this._targets;
                if (n) for (i = n.length; --i > -1;) this._siblings[i] = Q(n[i], this, !0); else this._siblings = Q(this.target, this, !0)
            }
            return P.prototype._enabled.call(this, e, t), !(!this._notifyPluginsOfEnabled || !this._firstPT) && L._onPluginEvent(e ? "_onEnable" : "_onDisable", this)
        }, L.to = function (e, t, i) {
            return new L(e, t, i)
        }, L.from = function (e, t, i) {
            return i.runBackwards = !0, i.immediateRender = 0 != i.immediateRender, new L(e, t, i)
        }, L.fromTo = function (e, t, i, n) {
            return n.startAt = i, n.immediateRender = 0 != n.immediateRender && 0 != i.immediateRender, new L(e, t, n)
        }, L.delayedCall = function (e, t, i, n, s) {
            return new L(t, 0, {
                delay: e,
                onComplete: t,
                onCompleteParams: i,
                callbackScope: n,
                onReverseComplete: t,
                onReverseCompleteParams: i,
                immediateRender: !1,
                lazy: !1,
                useFrames: s,
                overwrite: 0
            })
        }, L.set = function (e, t) {
            return new L(e, 0, t)
        }, L.getTweensOf = function (e, t) {
            if (null == e) return [];
            e = "string" != typeof e ? e : L.selector(e) || e;
            var i, n, s, o;
            if ((f(e) || D(e)) && "number" != typeof e[0]) {
                for (i = e.length, n = []; --i > -1;) n = n.concat(L.getTweensOf(e[i], t));
                for (i = n.length; --i > -1;) for (o = n[i], s = i; --s > -1;) o === n[s] && n.splice(i, 1)
            } else if (e._gsTweenID) for (n = Q(e).concat(), i = n.length; --i > -1;) (n[i]._gc || t && !n[i].isActive()) && n.splice(i, 1);
            return n || []
        }, L.killTweensOf = L.killDelayedCallsTo = function (e, t, i) {
            "object" == typeof t && (i = t, t = !1);
            for (var n = L.getTweensOf(e, t), s = n.length; --s > -1;) n[s]._kill(i, e)
        };
        var te = y("plugins.TweenPlugin", function (e, t) {
            this._overwriteProps = (e || "").split(","), this._propName = this._overwriteProps[0], this._priority = t || 0, this._super = te.prototype
        }, !0);
        if (a = te.prototype, te.version = "1.19.0", te.API = 2, a._firstPT = null, a._addTween = N, a.setRatio = I, a._kill = function (e) {
                var t, i = this._overwriteProps, n = this._firstPT;
                if (null != e[this._propName]) this._overwriteProps = []; else for (t = i.length; --t > -1;) null != e[i[t]] && i.splice(t, 1);
                for (; n;) null != e[n.n] && (n._next && (n._next._prev = n._prev), n._prev ? (n._prev._next = n._next, n._prev = null) : this._firstPT === n && (this._firstPT = n._next)), n = n._next;
                return !1
            }, a._mod = a._roundProps = function (e) {
                for (var t, i = this._firstPT; i;) t = e[this._propName] || null != i.n && e[i.n.split(this._propName + "_").join("")], t && "function" == typeof t && (2 === i.f ? i.t._applyPT.m = t : i.m = t), i = i._next
            }, L._onPluginEvent = function (e, t) {
                var i, n, s, o, r, a = t._firstPT;
                if ("_onInitAllProps" === e) {
                    for (; a;) {
                        for (r = a._next, n = s; n && n.pr > a.pr;) n = n._next;
                        (a._prev = n ? n._prev : o) ? a._prev._next = a : s = a, (a._next = n) ? n._prev = a : o = a, a = r
                    }
                    a = t._firstPT = s
                }
                for (; a;) a.pg && "function" == typeof a.t[e] && a.t[e]() && (i = !0), a = a._next;
                return i
            }, te.activate = function (e) {
                for (var t = e.length; --t > -1;) e[t].API === te.API && (X[(new e[t])._propName] = e[t]);
                return !0
            }, v.plugin = function (e) {
                if (!(e && e.propName && e.init && e.API)) throw"illegal plugin definition.";
                var t, i = e.propName, n = e.priority || 0, s = e.overwriteProps, o = {
                        init: "_onInitTween",
                        set: "setRatio",
                        kill: "_kill",
                        round: "_mod",
                        mod: "_mod",
                        initAll: "_onInitAllProps"
                    },
                    r = y("plugins." + i.charAt(0).toUpperCase() + i.substr(1) + "Plugin", function () {
                        te.call(this, i, n), this._overwriteProps = s || []
                    }, !0 === e.global), a = r.prototype = new te(i);
                a.constructor = r, r.API = e.API;
                for (t in o) "function" == typeof e[t] && (a[o[t]] = e[t]);
                return r.version = e.version, te.activate([r]), r
            }, o = e._gsQueue) {
            for (r = 0; r < o.length; r++) o[r]();
            for (a in g) g[a].func || e.console.log("GSAP encountered missing dependency: " + a)
        }
        c = !1
    }
}("undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window), $(document).ready(function () {
    $(".changeGate li").on("click", function () {
        var e = $(this).data("order");
        $(".changeGate li").removeClass("active"), $(".animationBlock .gate").removeClass("show"), $(".changeGate li").each(function () {
            $(this).data("order") === e && $(this).addClass("active")
        }), $(".animationBlock .gate").each(function () {
            $(this).data("order") === e && $(this).addClass("show")
        })
    }), $(".nextGate").on("click", function () {
        var e = $(".changeGate li.active").data("order"), t = $("#tab-1 .changeGate li").length, i = e + 1,
            n = $("div").children('[data-order="1"]'),
            s = $(".changeGate").children('[data-order="1"]');
        i > t ? ($(".changeGate li.active").removeClass("active"), $(".animationBlock .gate.show").removeClass("show"), s.addClass("active"), n.addClass("show")) : ($(".changeGate li").each(function () {
            $(this).data("order") == i && $(this).addClass("active"), $(this).data("order") == e && $(this).removeClass("active")
        }), $(".animationBlock .gate").each(function () {
            $(this).data("order") == i && $(this).addClass("show"), $(this).data("order") == e && $(this).removeClass("show")
        }))
    }), $(".prevGate").on("click", function () {
        var e = $(".changeGate li.active").data("order"), t = e - 1, i = $("#tab-1 .changeGate li").length,
            n = $("div").children('[data-order="' + i + '"]'),
            s = $(".changeGate").children('[data-order="' + i + '"]');
        t < 1 ? ($(".changeGate li.active").removeClass("active"), $(".animationBlock .gate.show").removeClass("show"), s.addClass("active"), n.addClass("show")) : ($(".changeGate li").each(function () {
            $(this).data("order") == t && $(this).addClass("active"), $(this).data("order") == e && $(this).removeClass("active")
        }), $(".animationBlock .gate").each(function () {
            $(this).data("order") == t && $(this).addClass("show"), $(this).data("order") == e && $(this).removeClass("show")
        }))
    });
    var e = $("#gateBigFirst1 .image"), t = $("#gateMiniFirst1 .image"), i = $("#gateDoubleFirst1 .image.left"),
        n = $("#gateDoubleFirst1 .image.right"), s = $("#gateBigSecond1 .image"),
        o = $("#gateMiniSecond1 .image"), r = $("#gateDoubleSecond1 .image.left"),
        a = $("#gateDoubleSecond1 .image.right"), l = $("#gateBigThird1 .image"), c = $("#gateMiniThird1 .image"),
        u = $("#gateDoubleThird1 .image.left"), d = $("#gateDoubleThird1 .image.right"),
        h = $("#gateBigFourth1 .image"), p = $("#gateMiniFourth1 .image"), f = $("#gateDoubleFourth1 .image.left"),
        g = $("#gateDoubleFourth1 .image.right"), m = $("#gateBigFiveth1 .image"), v = $("#gateMiniFiveth1 .image"),
        y = $("#gateDoubleFiveth1 .image.left"), x = $("#gateDoubleFiveth1 .image.right");
    $("#gateHoverBigFirst1").mouseenter(function () {
        TweenLite.to(e, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(e, 4, {x: "0px"})
    }), $("#gateHoverMiniFirst1").mouseenter(function () {
        TweenLite.to(t, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(t, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFirst1").mouseenter(function () {
        TweenLite.to(i, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(n, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(i, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(n, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigSecond1").mouseenter(function () {
        TweenLite.to(s, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(s, 3, {x: "0px"})
    }), $("#gateHoverMiniSecond1").mouseenter(function () {
        TweenLite.to(o, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(o, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleSecond1").mouseenter(function () {
        TweenLite.to(r, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(a, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(r, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(a, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigThird1").mouseenter(function () {
        TweenLite.to(l, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(l, 3, {x: "0px"})
    }), $("#gateHoverMiniThird1").mouseenter(function () {
        TweenLite.to(c, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(c, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleThird1").mouseenter(function () {
        TweenLite.to(u, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(d, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(u, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(d, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFourth1").mouseenter(function () {
        TweenLite.to(h, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(h, 4, {x: "0px"})
    }), $("#gateHoverMiniFourth1").mouseenter(function () {
        TweenLite.to(p, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(p, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFourth1").mouseenter(function () {
        TweenLite.to(f, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(g, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(f, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(g, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFiveth1").mouseenter(function () {
        TweenLite.to(m, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(m, 4, {x: "0px"})
    }), $("#gateHoverMiniFiveth1").mouseenter(function () {
        TweenLite.to(v, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(v, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFiveth1").mouseenter(function () {
        TweenLite.to(y, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(x, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(y, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(x, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    });
    var b = $("#gateBigFirst2 .image"), _ = $("#gateMiniFirst2 .image"), w = $("#gateDoubleFirst2 .image.left"),
        T = $("#gateDoubleFirst2 .image.right"), k = $("#gateBigSecond2 .image"),
        S = $("#gateMiniSecond2 .image"), C = $("#gateDoubleSecond2 .image.left"),
        P = $("#gateDoubleSecond2 .image.right"), O = $("#gateBigThird2 .image"), A = $("#gateMiniThird2 .image"),
        L = $("#gateDoubleThird2 .image.left"), D = $("#gateDoubleThird2 .image.right"),
        M = $("#gateBigFourth2 .image"), E = $("#gateMiniFourth2 .image"), F = $("#gateDoubleFourth2 .image.left"),
        R = $("#gateDoubleFourth2 .image.right"), j = $("#gateBigFiveth2 .image"), I = $("#gateMiniFiveth2 .image"),
        H = $("#gateDoubleFiveth2 .image.left"), N = $("#gateDoubleFiveth2 .image.right");
    $("#gateHoverBigFirst2").mouseenter(function () {
        TweenLite.to(b, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(b, 4, {x: "0px"})
    }), $("#gateHoverMiniFirst2").mouseenter(function () {
        TweenLite.to(_, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(_, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFirst2").mouseenter(function () {
        TweenLite.to(w, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(T, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(w, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(T, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigSecond2").mouseenter(function () {
        TweenLite.to(k, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(k, 3, {x: "0px"})
    }), $("#gateHoverMiniSecond2").mouseenter(function () {
        TweenLite.to(S, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(S, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleSecond2").mouseenter(function () {
        TweenLite.to(C, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(P, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(C, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(P, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigThird2").mouseenter(function () {
        TweenLite.to(O, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(O, 3, {x: "0px"})
    }), $("#gateHoverMiniThird2").mouseenter(function () {
        TweenLite.to(A, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(A, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleThird2").mouseenter(function () {
        TweenLite.to(L, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(D, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(L, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(D, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFourth2").mouseenter(function () {
        TweenLite.to(M, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(M, 4, {x: "0px"})
    }), $("#gateHoverMiniFourth2").mouseenter(function () {
        TweenLite.to(E, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(E, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFourth2").mouseenter(function () {
        TweenLite.to(F, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(R, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(F, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(R, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFiveth2").mouseenter(function () {
        TweenLite.to(j, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(j, 4, {x: "0px"})
    }), $("#gateHoverMiniFiveth2").mouseenter(function () {
        TweenLite.to(I, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(I, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFiveth2").mouseenter(function () {
        TweenLite.to(H, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(N, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(H, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(N, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    });
    var z = $("#gateBigFirst3 .image"), X = $("#gateMiniFirst3 .image"), q = $("#gateDoubleFirst3 .image.left"),
        Y = $("#gateDoubleFirst3 .image.right"), B = $("#gateBigSecond3 .image"),
        W = $("#gateMiniSecond3 .image"), U = $("#gateDoubleSecond3 .image.left"),
        V = $("#gateDoubleSecond3 .image.right"), G = $("#gateBigThird3 .image"), Z = $("#gateMiniThird3 .image"),
        Q = $("#gateDoubleThird3 .image.left"), K = $("#gateDoubleThird3 .image.right"),
        J = $("#gateBigFourth3 .image"), ee = $("#gateMiniFourth3 .image"), te = $("#gateDoubleFourth3 .image.left"),
        ie = $("#gateDoubleFourth3 .image.right"), ne = $("#gateBigFiveth3 .image"), se = $("#gateMiniFiveth3 .image"),
        oe = $("#gateDoubleFiveth3 .image.left"),
        re = $("#gateDoubleFiveth3 .image.right");
    $("#gateHoverBigFirst3").mouseenter(function () {
        TweenLite.to(z, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(z, 4, {x: "0px"})
    }), $("#gateHoverMiniFirst3").mouseenter(function () {
        TweenLite.to(X, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(X, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFirst3").mouseenter(function () {
        TweenLite.to(q, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(Y, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(q, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(Y, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigSecond3").mouseenter(function () {
        TweenLite.to(B, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(B, 3, {x: "0px"})
    }), $("#gateHoverMiniSecond3").mouseenter(function () {
        TweenLite.to(W, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(W, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleSecond3").mouseenter(function () {
        TweenLite.to(U, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(V, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(U, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(V, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigThird3").mouseenter(function () {
        TweenLite.to(G, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(G, 3, {x: "0px"})
    }), $("#gateHoverMiniThird3").mouseenter(function () {
        TweenLite.to(Z, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(Z, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleThird3").mouseenter(function () {
        TweenLite.to(Q, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(K, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(Q, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(K, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFourth3").mouseenter(function () {
        TweenLite.to(J, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(J, 4, {x: "0px"})
    }), $("#gateHoverMiniFourth3").mouseenter(function () {
        TweenLite.to(ee, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(ee, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFourth3").mouseenter(function () {
        TweenLite.to(te, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(ie, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(te, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(ie, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFiveth3").mouseenter(function () {
        TweenLite.to(ne, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(ne, 4, {x: "0px"})
    }), $("#gateHoverMiniFiveth3").mouseenter(function () {
        TweenLite.to(se, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(se, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFiveth3").mouseenter(function () {
        TweenLite.to(oe, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(re, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(oe, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(re, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    });
    var ae = $("#gateBigFirst4 .image"), le = $("#gateMiniFirst4 .image"), ce = $("#gateDoubleFirst4 .image.left"),
        ue = $("#gateDoubleFirst4 .image.right"), de = $("#gateBigSecond4 .image"),
        he = $("#gateMiniSecond4 .image"), pe = $("#gateDoubleSecond4 .image.left"),
        fe = $("#gateDoubleSecond4 .image.right"), ge = $("#gateBigThird4 .image"), me = $("#gateMiniThird4 .image"),
        ve = $("#gateDoubleThird4 .image.left"), ye = $("#gateDoubleThird4 .image.right"),
        xe = $("#gateBigFourth4 .image"), be = $("#gateMiniFourth4 .image"),
        _e = $("#gateDoubleFourth4 .image.left"), we = $("#gateDoubleFourth4 .image.right"),
        Te = $("#gateBigFiveth4 .image"), ke = $("#gateMiniFiveth4 .image"),
        $e = $("#gateDoubleFiveth4 .image.left"), Se = $("#gateDoubleFiveth4 .image.right");
    $("#gateHoverBigFirst4").mouseenter(function () {
        TweenLite.to(ae, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(ae, 4, {x: "0px"})
    }), $("#gateHoverMiniFirst4").mouseenter(function () {
        TweenLite.to(le, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(le, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFirst4").mouseenter(function () {
        TweenLite.to(ce, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(ue, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(ce, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(ue, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigSecond4").mouseenter(function () {
        TweenLite.to(de, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(de, 3, {x: "0px"})
    }), $("#gateHoverMiniSecond4").mouseenter(function () {
        TweenLite.to(he, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(he, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleSecond4").mouseenter(function () {
        TweenLite.to(pe, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(fe, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(pe, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(fe, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigThird4").mouseenter(function () {
        TweenLite.to(ge, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(ge, 3, {x: "0px"})
    }), $("#gateHoverMiniThird4").mouseenter(function () {
        TweenLite.to(me, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(me, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleThird4").mouseenter(function () {
        TweenLite.to(ve, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(ye, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(ve, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(ye, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFourth4").mouseenter(function () {
        TweenLite.to(xe, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(xe, 4, {x: "0px"})
    }), $("#gateHoverMiniFourth4").mouseenter(function () {
        TweenLite.to(be, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(be, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFourth4").mouseenter(function () {
        TweenLite.to(_e, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(we, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(_e, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(we, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFiveth4").mouseenter(function () {
        TweenLite.to(Te, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(Te, 4, {x: "0px"})
    }), $("#gateHoverMiniFiveth4").mouseenter(function () {
        TweenLite.to(ke, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(ke, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFiveth4").mouseenter(function () {
        TweenLite.to($e, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(Se, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to($e, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(Se, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    });
    var Ce = $("#gateBigFirst5 .image"), Pe = $("#gateMiniFirst5 .image"), Oe = $("#gateDoubleFirst5 .image.left"),
        Ae = $("#gateDoubleFirst5 .image.right"), Le = $("#gateBigSecond5 .image"),
        De = $("#gateMiniSecond5 .image"), Me = $("#gateDoubleSecond5 .image.left"),
        Ee = $("#gateDoubleSecond5 .image.right"), Fe = $("#gateBigThird5 .image"), Re = $("#gateMiniThird5 .image"),
        je = $("#gateDoubleThird5 .image.left"), Ie = $("#gateDoubleThird5 .image.right"),
        He = $("#gateBigFourth5 .image"), Ne = $("#gateMiniFourth5 .image"),
        ze = $("#gateDoubleFourth5 .image.left"), Xe = $("#gateDoubleFourth5 .image.right"),
        qe = $("#gateBigFiveth5 .image"), Ye = $("#gateMiniFiveth5 .image"),
        Be = $("#gateDoubleFiveth5 .image.left"), We = $("#gateDoubleFiveth5 .image.right");
    $("#gateHoverBigFirst5").mouseenter(function () {
        TweenLite.to(Ce, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(Ce, 4, {x: "0px"})
    }), $("#gateHoverMiniFirst5").mouseenter(function () {
        TweenLite.to(Pe, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(Pe, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFirst5").mouseenter(function () {
        TweenLite.to(Oe, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(Ae, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(Oe, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(Ae, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigSecond5").mouseenter(function () {
        TweenLite.to(Le, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(Le, 3, {x: "0px"})
    }), $("#gateHoverMiniSecond5").mouseenter(function () {
        TweenLite.to(De, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(De, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleSecond5").mouseenter(function () {
        TweenLite.to(Me, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(Ee, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(Me, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(Ee, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigThird5").mouseenter(function () {
        TweenLite.to(Fe, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(Fe, 3, {x: "0px"})
    }), $("#gateHoverMiniThird5").mouseenter(function () {
        TweenLite.to(Re, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(Re, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleThird5").mouseenter(function () {
        TweenLite.to(je, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(Ie, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(je, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(Ie, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFourth5").mouseenter(function () {
        TweenLite.to(He, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(He, 4, {x: "0px"})
    }), $("#gateHoverMiniFourth5").mouseenter(function () {
        TweenLite.to(Ne, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(Ne, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFourth5").mouseenter(function () {
        TweenLite.to(ze, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(Xe, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(ze, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(Xe, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    }), $("#gateHoverBigFiveth5").mouseenter(function () {
        TweenLite.to(qe, 3, {x: "-450"})
    }).mouseleave(function () {
        TweenLite.to(qe, 4, {x: "0px"})
    }), $("#gateHoverMiniFiveth5").mouseenter(function () {
        TweenLite.to(Ye, 3, {scaleX: "0.2", transformOrigin: "-10% 0%", skewY: "-25px", x: "10px"})
    }).mouseleave(function () {
        TweenLite.to(Ye, 3, {scaleX: "1", skewY: "0px", x: "0px"})
    }), $("#gateDoubleFiveth5").mouseenter(function () {
        TweenLite.to(Be, 3, {
            scaleX: "0.2",
            transformOrigin: "-10% 0%",
            skewY: "-25px",
            x: "15px"
        }), TweenLite.to(We, 3, {scaleX: "0.5", transformOrigin: "100% 0%", skewY: "25px"})
    }).mouseleave(function () {
        TweenLite.to(Be, 3, {scaleX: "1", skewY: "0px", x: "0px"}), TweenLite.to(We, 3, {
            scaleX: "1",
            skewY: "0px",
            x: "0px"
        })
    })
})


