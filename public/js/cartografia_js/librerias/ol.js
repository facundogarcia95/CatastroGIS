! function(t, e) { "object" == typeof exports ? module.exports = e() : "function" == typeof define && define.amd ? define([], e) : t.ol = e() }(this, (function() {
    var t, e = {},
        o = o || {},
        i = this;

    function r(t) { return void 0 !== t }

    function n(t, e, o) { t = t.split("."), o = o || i, t[0] in o || !o.execScript || o.execScript("var " + t[0]); for (var n; t.length && (n = t.shift());) !t.length && r(e) ? o[n] = e : o = o[n] ? o[n] : o[n] = {} }

    function s() {}

    function p(t) { t.Pa = function() { return t.sg ? t.sg : t.sg = new t } }

    function a(t) { var e = typeof t; if ("object" == e) { if (!t) return "null"; if (t instanceof Array) return "array"; if (t instanceof Object) return e; var o = Object.prototype.toString.call(t); if ("[object Window]" == o) return "object"; if ("[object Array]" == o || "number" == typeof t.length && void 0 !== t.splice && void 0 !== t.propertyIsEnumerable && !t.propertyIsEnumerable("splice")) return "array"; if ("[object Function]" == o || void 0 !== t.call && void 0 !== t.propertyIsEnumerable && !t.propertyIsEnumerable("call")) return "function" } else if ("function" == e && void 0 === t.call) return "object"; return e }

    function h(t) { return null === t }

    function l(t) { return "array" == a(t) }

    function u(t) { var e = a(t); return "array" == e || "object" == e && "number" == typeof t.length }

    function c(t) { return "string" == typeof t }

    function y(t) { return "number" == typeof t }

    function f(t) { return "function" == a(t) }

    function g(t) { var e = typeof t; return "object" == e && null != t || "function" == e }

    function d(t) { return t[v] || (t[v] = ++b) }
    var v = "closure_uid_" + (1e9 * Math.random() >>> 0),
        b = 0;

    function m(t, e, o) { return t.call.apply(t.bind, arguments) }

    function w(t, e, o) { if (!t) throw Error(); if (2 < arguments.length) { var i = Array.prototype.slice.call(arguments, 2); return function() { var o = Array.prototype.slice.call(arguments); return Array.prototype.unshift.apply(o, i), t.apply(e, o) } } return function() { return t.apply(e, arguments) } }

    function S(t, e, o) { return (S = Function.prototype.bind && -1 != Function.prototype.bind.toString().indexOf("native code") ? m : w).apply(null, arguments) }

    function x(t, e) { var o = Array.prototype.slice.call(arguments, 1); return function() { var e = o.slice(); return e.push.apply(e, arguments), t.apply(this, e) } }
    var M, P, T, j = Date.now || function() { return +new Date };

    function A(t, e) {
        function o() {}
        o.prototype = e.prototype, t.$ = e.prototype, t.prototype = new o, t.prototype.constructor = t, t.Jo = function(t, o, i) { for (var r = Array(arguments.length - 2), n = 2; n < arguments.length; n++) r[n - 2] = arguments[n]; return e.prototype[o].apply(t, r) }
    }

    function C(t) {
        if (Error.captureStackTrace) Error.captureStackTrace(this, C);
        else {
            var e = Error().stack;
            e && (this.stack = e)
        }
        t && (this.message = String(t))
    }

    function R(t, e) { var o = t.length - e.length; return 0 <= o && t.indexOf(e, o) == o }
    A(C, Error), C.prototype.name = "CustomError";
    var L = String.prototype.trim ? function(t) { return t.trim() } : function(t) { return t.replace(/^[\s\xa0]+|[\s\xa0]+$/g, "") };

    function E(t) { return B.test(t) ? (-1 != t.indexOf("&") && (t = t.replace(I, "&amp;")), -1 != t.indexOf("<") && (t = t.replace(k, "&lt;")), -1 != t.indexOf(">") && (t = t.replace(N, "&gt;")), -1 != t.indexOf('"') && (t = t.replace(F, "&quot;")), -1 != t.indexOf("'") && (t = t.replace(D, "&#39;")), -1 != t.indexOf("\0") && (t = t.replace(O, "&#0;")), t) : t }
    var I = /&/g,
        k = /</g,
        N = />/g,
        F = /"/g,
        D = /'/g,
        O = /\x00/g,
        B = /[\x00&<>"']/;

    function G(t) { var e = (t = r(void 0) ? t.toFixed(void 0) : String(t)).indexOf("."); return -1 == e && (e = t.length), e = Math.max(0, 2 - e), Array(e + 1).join("0") + t }

    function U(t, e) {
        for (var o = 0, i = L(String(t)).split("."), r = L(String(e)).split("."), n = Math.max(i.length, r.length), s = 0; 0 == o && s < n; s++) {
            var p = i[s] || "",
                a = r[s] || "",
                h = RegExp("(\\d*)(\\D*)", "g"),
                l = RegExp("(\\d*)(\\D*)", "g");
            do {
                var u = h.exec(p) || ["", "", ""],
                    c = l.exec(a) || ["", "", ""];
                if (0 == u[0].length && 0 == c[0].length) break;
                o = X(0 == u[1].length ? 0 : parseInt(u[1], 10), 0 == c[1].length ? 0 : parseInt(c[1], 10)) || X(0 == u[2].length, 0 == c[2].length) || X(u[2], c[2])
            } while (0 == o)
        }
        return o
    }

    function X(t, e) { return t < e ? -1 : t > e ? 1 : 0 }
    var K, Y = Array.prototype;

    function V(t, e) { return Y.indexOf.call(t, e, void 0) }

    function H(t, e, o) { Y.forEach.call(t, e, o) }

    function W(t, e) { return Y.filter.call(t, e, void 0) }

    function z(t, e, o) { return Y.map.call(t, e, o) }

    function Z(t, e) { var o = J(t, e, void 0); return 0 > o ? null : c(t) ? t.charAt(o) : t[o] }

    function J(t, e, o) {
        for (var i = t.length, r = c(t) ? t.split("") : t, n = 0; n < i; n++)
            if (n in r && e.call(o, r[n], n, t)) return n;
        return -1
    }

    function q(t, e) { return 0 <= V(t, e) }

    function $(t, e) { var o, i = V(t, e); return (o = 0 <= i) && Y.splice.call(t, i, 1), o }

    function _(t) { return Y.concat.apply(Y, arguments) }

    function Q(t) { var e = t.length; if (0 < e) { for (var o = Array(e), i = 0; i < e; i++) o[i] = t[i]; return o } return [] }

    function tt(t, e) {
        for (var o = 1; o < arguments.length; o++) {
            var i = arguments[o];
            if (u(i)) {
                var r = t.length || 0,
                    n = i.length || 0;
                t.length = r + n;
                for (var s = 0; s < n; s++) t[r + s] = i[s]
            } else t.push(i)
        }
    }

    function et(t, e, o) { return 2 >= arguments.length ? Y.slice.call(t, e) : Y.slice.call(t, e, o) }

    function ot(t, e) { t.sort(e || rt) }

    function it(t, e) {
        if (!u(t) || !u(e) || t.length != e.length) return !1;
        for (var o = t.length, i = nt, r = 0; r < o; r++)
            if (!i(t[r], e[r])) return !1;
        return !0
    }

    function rt(t, e) { return t > e ? 1 : t < e ? -1 : 0 }

    function nt(t, e) { return t === e }

    function st(t) {
        for (var e = [], o = 0; o < arguments.length; o++) {
            var i = arguments[o];
            if (l(i))
                for (var r = 0; r < i.length; r += 8192)
                    for (var n = st.apply(null, et(i, r, r + 8192)), s = 0; s < n.length; s++) e.push(n[s]);
            else e.push(i)
        }
        return e
    }
    t: {
        var pt = i.navigator;
        if (pt) { var at = pt.userAgent; if (at) { K = at; break t } }
        K = ""
    }

    function ht(t) { return -1 != K.indexOf(t) }

    function lt(t, e, o) { for (var i in t) e.call(o, t[i], i, t) }

    function ut(t) { var e, o = 0; for (e in t) o++; return o }

    function ct(t) {
        var e, o = [],
            i = 0;
        for (e in t) o[i++] = t[e];
        return o
    }

    function yt(t) {
        var e, o = [],
            i = 0;
        for (e in t) o[i++] = e;
        return o
    }

    function ft(t, e) { return e in t }

    function gt(t, e) {
        for (var o in t)
            if (t[o] == e) return !0;
        return !1
    }

    function dt(t, e) {
        for (var o in t)
            if (e.call(void 0, t[o], o, t)) return o
    }

    function vt(t) { for (var e in t) return !1; return !0 }

    function bt(t) { for (var e in t) delete t[e] }

    function mt(t, e) { e in t && delete t[e] }

    function wt(t, e, o) { return e in t ? t[e] : o }

    function St(t, e) { return e in t ? t[e] : t[e] = [] }

    function xt(t) { var e, o = {}; for (e in t) o[e] = t[e]; return o }
    var Mt = "constructor hasOwnProperty isPrototypeOf propertyIsEnumerable toLocaleString toString valueOf".split(" ");

    function Pt(t, e) { for (var o, i, r = 1; r < arguments.length; r++) { for (o in i = arguments[r]) t[o] = i[o]; for (var n = 0; n < Mt.length; n++) o = Mt[n], Object.prototype.hasOwnProperty.call(i, o) && (t[o] = i[o]) } }
    var Tt = ht("Opera") || ht("OPR"),
        jt = ht("Trident") || ht("MSIE"),
        At = ht("Gecko") && -1 == K.toLowerCase().indexOf("webkit") && !(ht("Trident") || ht("MSIE")),
        Ct = -1 != K.toLowerCase().indexOf("webkit"),
        Rt = ht("Macintosh"),
        Lt = ht("Windows"),
        Et = ht("Linux") || ht("CrOS");

    function It() { var t = i.document; return t ? t.documentMode : void 0 }
    var kt, Nt, Ft = (Nt = "", Tt && i.opera ? f(Nt = i.opera.version) ? Nt() : Nt : (At ? kt = /rv\:([^\);]+)(\)|;)/ : jt ? kt = /\b(?:MSIE|rv)[: ]([^\);]+)(\)|;)/ : Ct && (kt = /WebKit\/(\S+)/), kt && (Nt = (Nt = kt.exec(K)) ? Nt[1] : ""), jt && (kt = It()) > parseFloat(Nt) ? String(kt) : Nt)),
        Dt = {};

    function Ot(t) { return Dt[t] || (Dt[t] = 0 <= U(Ft, t)) }
    var Bt = i.document,
        Gt = Bt && jt ? It() || ("CSS1Compat" == Bt.compatMode ? parseInt(Ft, 10) : 5) : void 0,
        Ut = jt && !Ot("9.0") && "" !== Ft;

    function Xt(t, e, o) { return Math.min(Math.max(t, e), o) }

    function Kt(t, e) { var o = t % e; return 0 > o * e ? o + e : o }

    function Yt(t, e, o) { return t + o * (e - t) }

    function Vt(t) { return t * Math.PI / 180 }

    function Ht(t) { return t }

    function Wt(t, e, o) {
        var i = t.length;
        if (t[0] <= e) return 0;
        if (!(e <= t[i - 1]))
            if (0 < o) {
                for (o = 1; o < i; ++o)
                    if (t[o] < e) return o - 1
            } else if (0 > o) {
            for (o = 1; o < i; ++o)
                if (t[o] <= e) return o
        } else
            for (o = 1; o < i; ++o) { if (t[o] == e) return o; if (t[o] < e) return t[o - 1] - e < e - t[o] ? o - 1 : o }
        return i - 1
    }

    function zt(t) { if (r(t)) return 0 }

    function Zt(t, e) { if (r(t)) return t + e }

    function Jt(t, e, o) { this.center = t, this.resolution = e, this.rotation = o }
    var qt = !jt || jt && 9 <= Gt,
        $t = !jt || jt && 9 <= Gt,
        _t = jt && !Ot("9");

    function Qt() { 0 != te && (ee[d(this)] = this), this.ea = this.ea, this.ca = this.ca }!Ct || Ot("528"), At && Ot("1.9b") || jt && Ot("8") || Tt && Ot("9.5") || Ct && Ot("528"), At && !Ot("8") || jt && Ot("9");
    var te = 0,
        ee = {};

    function oe(t, e) {
        var o = x(ie, e);
        t.ea ? o.call(void 0) : (t.ca || (t.ca = []), t.ca.push(r(void 0) ? S(o, void 0) : o))
    }

    function ie(t) { t && "function" == typeof t.dd && t.dd() }

    function re(t, e) { this.type = t, this.c = this.target = e, this.i = !1, this.sh = !0 }

    function ne(t) { t.nb() }

    function se(t) { t.preventDefault() }
    Qt.prototype.ea = !1, Qt.prototype.dd = function() {
        if (!this.ea && (this.ea = !0, this.W(), 0 != te)) {
            var t = d(this);
            delete ee[t]
        }
    }, Qt.prototype.W = function() {
        if (this.ca)
            for (; this.ca.length;) this.ca.shift()()
    }, re.prototype.nb = function() { this.i = !0 }, re.prototype.preventDefault = function() { this.sh = !1 };
    var pe = jt ? "focusout" : "DOMFocusOut";

    function ae(t) { return ae[" "](t), t }

    function he(t, e) { re.call(this, t ? t.type : ""), this.relatedTarget = this.c = this.target = null, this.B = this.g = this.button = this.screenY = this.screenX = this.clientY = this.clientX = this.offsetY = this.offsetX = 0, this.v = this.f = this.b = this.l = !1, this.state = null, this.j = !1, this.a = null, t && ue(this, t, e) }
    ae[" "] = s, A(he, re);
    var le = [1, 4, 2];

    function ue(t, e, o) {
        t.a = e;
        var i = t.type = e.type;
        if (t.target = e.target || e.srcElement, t.c = o, o = e.relatedTarget) {
            if (At) {
                var r;
                t: {
                    try { ae(o.nodeName), r = !0; break t } catch (t) {}
                    r = !1
                }
                r || (o = null)
            }
        } else "mouseover" == i ? o = e.fromElement : "mouseout" == i && (o = e.toElement);
        t.relatedTarget = o, Object.defineProperties ? Object.defineProperties(t, { offsetX: { configurable: !0, enumerable: !0, get: t.hg, set: t.Zn }, offsetY: { configurable: !0, enumerable: !0, get: t.ig, set: t.$n } }) : (t.offsetX = t.hg(), t.offsetY = t.ig()), t.clientX = void 0 !== e.clientX ? e.clientX : e.pageX, t.clientY = void 0 !== e.clientY ? e.clientY : e.pageY, t.screenX = e.screenX || 0, t.screenY = e.screenY || 0, t.button = e.button, t.g = e.keyCode || 0, t.B = e.charCode || ("keypress" == i ? e.keyCode : 0), t.l = e.ctrlKey, t.b = e.altKey, t.f = e.shiftKey, t.v = e.metaKey, t.j = Rt ? e.metaKey : e.ctrlKey, t.state = e.state, e.defaultPrevented && t.preventDefault()
    }

    function ce(t) { return !((qt ? 0 != t.a.button : "click" != t.type && !(t.a.button & le[0])) || Ct && Rt && t.l) }(t = he.prototype).nb = function() { he.$.nb.call(this), this.a.stopPropagation ? this.a.stopPropagation() : this.a.cancelBubble = !0 }, t.preventDefault = function() {
        he.$.preventDefault.call(this);
        var t = this.a;
        if (t.preventDefault) t.preventDefault();
        else if (t.returnValue = !1, _t) try {
            (t.ctrlKey || 112 <= t.keyCode && 123 >= t.keyCode) && (t.keyCode = -1)
        } catch (t) {}
    }, t.Ui = function() { return this.a }, t.hg = function() { return Ct || void 0 !== this.a.offsetX ? this.a.offsetX : this.a.layerX }, t.Zn = function(t) { Object.defineProperties(this, { offsetX: { writable: !0, enumerable: !0, configurable: !0, value: t } }) }, t.ig = function() { return Ct || void 0 !== this.a.offsetY ? this.a.offsetY : this.a.layerY }, t.$n = function(t) { Object.defineProperties(this, { offsetY: { writable: !0, enumerable: !0, configurable: !0, value: t } }) };
    var ye = "closure_listenable_" + (1e6 * Math.random() | 0);

    function fe(t) { return !(!t || !t[ye]) }
    var ge = 0;

    function de(t, e, o, i, r) { this.listener = t, this.a = null, this.src = e, this.type = o, this.Wc = !!i, this.Xd = r, this.key = ++ge, this.Oc = this.Dd = !1 }

    function ve(t) { t.Oc = !0, t.listener = null, t.a = null, t.src = null, t.Xd = null }

    function be(t) { this.src = t, this.a = {}, this.b = 0 }

    function me(t, e) { var o = e.type; if (!(o in t.a)) return !1; var i = $(t.a[o], e); return i && (ve(e), 0 == t.a[o].length && (delete t.a[o], t.b--)), i }

    function we(t, e, o, i, r) { return t = t.a[e.toString()], e = -1, t && (e = xe(t, o, i, r)), -1 < e ? t[e] : null }

    function Se(t, e, o) {
        var i = r(e),
            n = i ? e.toString() : "",
            s = r(o);
        return function(t, e) {
            for (var o in t)
                if (e.call(void 0, t[o], o, t)) return !0;
            return !1
        }(t.a, (function(t) {
            for (var e = 0; e < t.length; ++e)
                if (!(i && t[e].type != n || s && t[e].Wc != o)) return !0;
            return !1
        }))
    }

    function xe(t, e, o, i) { for (var r = 0; r < t.length; ++r) { var n = t[r]; if (!n.Oc && n.listener == e && n.Wc == !!o && n.Xd == i) return r } return -1 }
    be.prototype.add = function(t, e, o, i, r) {
        var n = t.toString();
        (t = this.a[n]) || (t = this.a[n] = [], this.b++);
        var s = xe(t, e, i, r);
        return -1 < s ? (e = t[s], o || (e.Dd = !1)) : ((e = new de(e, this.src, n, !!i, r)).Dd = o, t.push(e)), e
    }, be.prototype.remove = function(t, e, o, i) { if (!((t = t.toString()) in this.a)) return !1; var r = this.a[t]; return -1 < (e = xe(r, e, o, i)) && (ve(r[e]), Y.splice.call(r, e, 1), 0 == r.length && (delete this.a[t], this.b--), !0) };
    var Me = "closure_lm_" + (1e6 * Math.random() | 0),
        Pe = {};

    function Te(t, e, o, i, r) { if (l(e)) { for (var n = 0; n < e.length; n++) Te(t, e[n], o, i, r); return null } return o = De(o), fe(t) ? t.Ra(e, o, i, r) : je(t, e, o, !1, i, r) }

    function je(t, e, o, i, r, n) {
        if (!e) throw Error("Invalid event type");
        var s = !!r,
            p = Ne(t);
        return p || (t[Me] = p = new be(t)), (o = p.add(e, o, i, r, n)).a || (i = function() {
            var t = ke,
                e = $t ? function(o) { return t.call(e.src, e.listener, o) } : function(o) { if (!(o = t.call(e.src, e.listener, o))) return o };
            return e
        }(), o.a = i, i.src = t, i.listener = o, t.addEventListener ? t.addEventListener(e.toString(), i, s) : t.attachEvent(Le(e.toString()), i)), o
    }

    function Ae(t, e, o, i, r) { if (l(e)) { for (var n = 0; n < e.length; n++) Ae(t, e[n], o, i, r); return null } return o = De(o), fe(t) ? t.jb.add(String(e), o, !0, i, r) : je(t, e, o, !0, i, r) }

    function Ce(t, e, o, i, r) {
        if (l(e))
            for (var n = 0; n < e.length; n++) Ce(t, e[n], o, i, r);
        else o = De(o), fe(t) ? t.Cf(e, o, i, r) : t && (t = Ne(t)) && (e = we(t, e, o, !!i, r)) && Re(e)
    }

    function Re(t) {
        if (y(t) || !t || t.Oc) return !1;
        var e = t.src;
        if (fe(e)) return me(e.jb, t);
        var o = t.type,
            i = t.a;
        return e.removeEventListener ? e.removeEventListener(o, i, t.Wc) : e.detachEvent && e.detachEvent(Le(o), i), (o = Ne(e)) ? (me(o, t), 0 == o.b && (o.src = null, e[Me] = null)) : ve(t), !0
    }

    function Le(t) { return t in Pe ? Pe[t] : Pe[t] = "on" + t }

    function Ee(t, e, o, i) {
        var r = !0;
        if ((t = Ne(t)) && (e = t.a[e.toString()]))
            for (e = e.concat(), t = 0; t < e.length; t++) {
                var n = e[t];
                n && n.Wc == o && !n.Oc && (n = Ie(n, i), r = r && !1 !== n)
            }
        return r
    }

    function Ie(t, e) {
        var o = t.listener,
            i = t.Xd || t.src;
        return t.Dd && Re(t), o.call(i, e)
    }

    function ke(t, e) {
        if (t.Oc) return !0;
        if (!$t) {
            var o;
            if (!(o = e)) t: {
                o = ["window", "event"];
                for (var r, n = i; r = o.shift();) {
                    if (null == n[r]) { o = null; break t }
                    n = n[r]
                }
                o = n
            }
            if (o = new he(r = o, this), n = !0, !(0 > r.keyCode || null != r.returnValue)) {
                t: { var s = !1; if (0 == r.keyCode) try { r.keyCode = -1; break t } catch (t) { s = !0 }(s || null == r.returnValue) && (r.returnValue = !0) }
                for (r = [], s = o.c; s; s = s.parentNode) r.push(s);s = t.type;
                for (var p = r.length - 1; !o.i && 0 <= p; p--) {
                    o.c = r[p];
                    var a = Ee(r[p], s, !0, o);
                    n = n && a
                }
                for (p = 0; !o.i && p < r.length; p++) o.c = r[p],
                a = Ee(r[p], s, !1, o),
                n = n && a
            }
            return n
        }
        return Ie(t, new he(e, this))
    }

    function Ne(t) { return (t = t[Me]) instanceof be ? t : null }
    var Fe = "__closure_events_fn_" + (1e9 * Math.random() >>> 0);

    function De(t) { return f(t) ? t : (t[Fe] || (t[Fe] = function(e) { return t.handleEvent(e) }), t[Fe]) }

    function Oe() { Qt.call(this), this.jb = new be(this), this.Bd = this, this.Ma = null }

    function Be(t, e) {
        var o;
        if (r = t.Ma)
            for (o = []; r; r = r.Ma) o.push(r);
        var i, r = t.Bd,
            n = (s = e).type || s;
        if (c(s)) s = new re(s, r);
        else if (s instanceof re) s.target = s.target || r;
        else {
            var s, p = s;
            Pt(s = new re(n, r), p)
        }
        if (p = !0, o)
            for (var a = o.length - 1; !s.i && 0 <= a; a--) p = Ge(i = s.c = o[a], n, !0, s) && p;
        if (s.i || (p = Ge(i = s.c = r, n, !0, s) && p, s.i || (p = Ge(i, n, !1, s) && p)), o)
            for (a = 0; !s.i && a < o.length; a++) p = Ge(i = s.c = o[a], n, !1, s) && p;
        return p
    }

    function Ge(t, e, o, i) {
        if (!(e = t.jb.a[String(e)])) return !0;
        e = e.concat();
        for (var r = !0, n = 0; n < e.length; ++n) {
            var s = e[n];
            if (s && !s.Oc && s.Wc == o) {
                var p = s.listener,
                    a = s.Xd || s.src;
                s.Dd && me(t.jb, s), r = !1 !== p.call(a, i) && r
            }
        }
        return r && 0 != i.sh
    }

    function Ue(t, e, o) { return Se(t.jb, r(e) ? String(e) : void 0, o) }

    function Xe() { Oe.call(this), this.a = 0 }

    function Ke(t) { Re(t) }

    function Ye(t, e, o) { re.call(this, t), this.key = e, this.oldValue = o }

    function Ve(t) { Xe.call(this), d(this), this.B = {}, r(t) && this.I(t) }
    A(Oe, Qt), Oe.prototype[ye] = !0, (t = Oe.prototype).addEventListener = function(t, e, o, i) { Te(this, t, e, o, i) }, t.removeEventListener = function(t, e, o, i) { Ce(this, t, e, o, i) }, t.W = function() {
        if (Oe.$.W.call(this), this.jb) {
            var t, e = this.jb;
            for (t in e.a) {
                for (var o = e.a[t], i = 0; i < o.length; i++) ve(o[i]);
                delete e.a[t], e.b--
            }
        }
        this.Ma = null
    }, t.Ra = function(t, e, o, i) { return this.jb.add(String(t), e, !1, o, i) }, t.Cf = function(t, e, o, i) { return this.jb.remove(String(t), e, o, i) }, A(Xe, Oe), (t = Xe.prototype).s = function() {++this.a, Be(this, "change") }, t.K = function() { return this.a }, t.G = function(t, e, o) { return Te(this, t, e, !1, o) }, t.L = function(t, e, o) { return Ae(this, t, e, !1, o) }, t.J = function(t, e, o) { Ce(this, t, e, !1, o) }, t.M = Ke, A(Ye, re), A(Ve, Xe);
    var He = {};

    function We(t) { return He.hasOwnProperty(t) ? He[t] : He[t] = "change:" + t }

    function ze(t, e, o) { Be(t, new Ye(We(e), e, o)), Be(t, new Ye("propertychange", e, o)) }

    function Ze(t, e, o) { return r(o) || (o = [0, 0]), o[0] = t[0] + 2 * e, o[1] = t[1] + 2 * e, o }

    function Je(t, e, o) { return r(o) || (o = [0, 0]), o[0] = t[0] * e + .5 | 0, o[1] = t[1] * e + .5 | 0, o }

    function qe(t, e) { return l(t) ? t : (r(e) ? (e[0] = t, e[1] = t) : e = [t, t], e) }

    function $e(t, e) { return t[0] += e[0], t[1] += e[1], t }

    function _e(t, e) {
        var o = t[0],
            i = t[1],
            r = e[0],
            n = e[1],
            s = r[0],
            p = (r = r[1], n[0]),
            a = p - s,
            h = (n = n[1]) - r;
        return 0 >= (o = 0 === a && 0 === h ? 0 : (a * (o - s) + h * (i - r)) / (a * a + h * h || 0)) || (1 <= o ? (s = p, r = n) : (s += o * a, r += o * h)), [s, r]
    }

    function Qe(t, e) {
        var o = Kt(t + 180, 360) - 180,
            i = Math.abs(Math.round(3600 * o));
        return Math.floor(i / 3600) + "° " + G(Math.floor(i / 60 % 60)) + "′ " + G(Math.floor(i % 60)) + "″ " + e.charAt(0 > o ? 1 : 0)
    }

    function to(t, e, o) { return r(t) ? e.replace("{x}", t[0].toFixed(o)).replace("{y}", t[1].toFixed(o)) : "" }

    function eo(t, e) {
        for (var o = !0, i = t.length - 1; 0 <= i; --i)
            if (t[i] != e[i]) { o = !1; break }
        return o
    }

    function oo(t, e) {
        var o = Math.cos(e),
            i = Math.sin(e),
            r = t[1] * o + t[0] * i;
        return t[0] = t[0] * o - t[1] * i, t[1] = r, t
    }

    function io(t, e) {
        var o = t[0] - e[0],
            i = t[1] - e[1];
        return o * o + i * i
    }

    function ro(t, e) { return io(t, _e(t, e)) }

    function no(t, e) { return to(t, "{x}, {y}", e) }

    function so(t) { this.length = t.length || t; for (var e = 0; e < this.length; e++) this[e] = t[e] || 0 }

    function po(t) { this.length = t.length || t; for (var e = 0; e < this.length; e++) this[e] = t[e] || 0 }
    if ((t = Ve.prototype).get = function(t) { var e; return this.B.hasOwnProperty(t) && (e = this.B[t]), e }, t.O = function() { return yt(this.B) }, t.P = function() { var t, e = {}; for (t in this.B) e[t] = this.B[t]; return e }, t.set = function(t, e) {
            var o = this.B[t];
            this.B[t] = e, ze(this, t, o)
        }, t.I = function(t) { for (var e in t) this.set(e, t[e]) }, t.S = function(t) {
            if (t in this.B) {
                var e = this.B[t];
                delete this.B[t], ze(this, t, e)
            }
        }, so.prototype.a = 4, so.prototype.set = function(t, e) { e = e || 0; for (var o = 0; o < t.length && e + o < this.length; o++) this[e + o] = t[o] }, so.prototype.toString = Array.prototype.join, "undefined" == typeof Float32Array && (so.BYTES_PER_ELEMENT = 4, so.prototype.BYTES_PER_ELEMENT = so.prototype.a, so.prototype.set = so.prototype.set, so.prototype.toString = so.prototype.toString, n("Float32Array", so, void 0)), po.prototype.a = 8, po.prototype.set = function(t, e) { e = e || 0; for (var o = 0; o < t.length && e + o < this.length; o++) this[e + o] = t[o] }, po.prototype.toString = Array.prototype.join, "undefined" == typeof Float64Array) {
        try { po.BYTES_PER_ELEMENT = 8 } catch (t) {}
        po.prototype.BYTES_PER_ELEMENT = po.prototype.a, po.prototype.set = po.prototype.set, po.prototype.toString = po.prototype.toString, n("Float64Array", po, void 0)
    }

    function ao(t, e, o, i, r) { t[0] = e, t[1] = o, t[2] = i, t[3] = r }

    function ho() { var t = Array(16); return uo(t, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), t }

    function lo() { var t = Array(16); return uo(t, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1), t }

    function uo(t, e, o, i, r, n, s, p, a, h, l, u, c, y, f, g, d) { t[0] = e, t[1] = o, t[2] = i, t[3] = r, t[4] = n, t[5] = s, t[6] = p, t[7] = a, t[8] = h, t[9] = l, t[10] = u, t[11] = c, t[12] = y, t[13] = f, t[14] = g, t[15] = d }

    function co(t, e) { t[0] = e[0], t[1] = e[1], t[2] = e[2], t[3] = e[3], t[4] = e[4], t[5] = e[5], t[6] = e[6], t[7] = e[7], t[8] = e[8], t[9] = e[9], t[10] = e[10], t[11] = e[11], t[12] = e[12], t[13] = e[13], t[14] = e[14], t[15] = e[15] }

    function yo(t) { t[0] = 1, t[1] = 0, t[2] = 0, t[3] = 0, t[4] = 0, t[5] = 1, t[6] = 0, t[7] = 0, t[8] = 0, t[9] = 0, t[10] = 1, t[11] = 0, t[12] = 0, t[13] = 0, t[14] = 0, t[15] = 1 }

    function fo(t, e, o) {
        var i = t[0],
            r = t[1],
            n = t[2],
            s = t[3],
            p = t[4],
            a = t[5],
            h = t[6],
            l = t[7],
            u = t[8],
            c = t[9],
            y = t[10],
            f = t[11],
            g = t[12],
            d = t[13],
            v = t[14];
        t = t[15];
        var b = e[0],
            m = e[1],
            w = e[2],
            S = e[3],
            x = e[4],
            M = e[5],
            P = e[6],
            T = e[7],
            j = e[8],
            A = e[9],
            C = e[10],
            R = e[11],
            L = e[12],
            E = e[13],
            I = e[14];
        e = e[15], o[0] = i * b + p * m + u * w + g * S, o[1] = r * b + a * m + c * w + d * S, o[2] = n * b + h * m + y * w + v * S, o[3] = s * b + l * m + f * w + t * S, o[4] = i * x + p * M + u * P + g * T, o[5] = r * x + a * M + c * P + d * T, o[6] = n * x + h * M + y * P + v * T, o[7] = s * x + l * M + f * P + t * T, o[8] = i * j + p * A + u * C + g * R, o[9] = r * j + a * A + c * C + d * R, o[10] = n * j + h * A + y * C + v * R, o[11] = s * j + l * A + f * C + t * R, o[12] = i * L + p * E + u * I + g * e, o[13] = r * L + a * E + c * I + d * e, o[14] = n * L + h * E + y * I + v * e, o[15] = s * L + l * E + f * I + t * e
    }

    function go(t, e) {
        var o = t[0],
            i = t[1],
            r = t[2],
            n = t[3],
            s = t[4],
            p = t[5],
            a = t[6],
            h = t[7],
            l = t[8],
            u = t[9],
            c = t[10],
            y = t[11],
            f = t[12],
            g = t[13],
            d = t[14],
            v = t[15],
            b = o * p - i * s,
            m = o * a - r * s,
            w = o * h - n * s,
            S = i * a - r * p,
            x = i * h - n * p,
            M = r * h - n * a,
            P = l * g - u * f,
            T = l * d - c * f,
            j = l * v - y * f,
            A = u * d - c * g,
            C = u * v - y * g,
            R = c * v - y * d,
            L = b * R - m * C + w * A + S * j - x * T + M * P;
        0 != L && (L = 1 / L, e[0] = (p * R - a * C + h * A) * L, e[1] = (-i * R + r * C - n * A) * L, e[2] = (g * M - d * x + v * S) * L, e[3] = (-u * M + c * x - y * S) * L, e[4] = (-s * R + a * j - h * T) * L, e[5] = (o * R - r * j + n * T) * L, e[6] = (-f * M + d * w - v * m) * L, e[7] = (l * M - c * w + y * m) * L, e[8] = (s * C - p * j + h * P) * L, e[9] = (-o * C + i * j - n * P) * L, e[10] = (f * x - g * w + v * b) * L, e[11] = (-l * x + u * w - y * b) * L, e[12] = (-s * A + p * T - a * P) * L, e[13] = (o * A - i * T + r * P) * L, e[14] = (-f * S + g * m - d * b) * L, e[15] = (l * S - u * m + c * b) * L)
    }

    function vo(t, e, o) {
        var i = t[1] * e + t[5] * o + 0 * t[9] + t[13],
            r = t[2] * e + t[6] * o + 0 * t[10] + t[14],
            n = t[3] * e + t[7] * o + 0 * t[11] + t[15];
        t[12] = t[0] * e + t[4] * o + 0 * t[8] + t[12], t[13] = i, t[14] = r, t[15] = n
    }

    function bo(t, e, o) { uo(t, t[0] * e, t[1] * e, t[2] * e, t[3] * e, t[4] * o, t[5] * o, t[6] * o, t[7] * o, 1 * t[8], 1 * t[9], 1 * t[10], 1 * t[11], t[12], t[13], t[14], t[15]) }

    function mo(t, e) {
        var o = t[0],
            i = t[1],
            r = t[2],
            n = t[3],
            s = t[4],
            p = t[5],
            a = t[6],
            h = t[7],
            l = Math.cos(e),
            u = Math.sin(e);
        t[0] = o * l + s * u, t[1] = i * l + p * u, t[2] = r * l + a * u, t[3] = n * l + h * u, t[4] = o * -u + s * l, t[5] = i * -u + p * l, t[6] = r * -u + a * l, t[7] = n * -u + h * l
    }

    function wo(t) { for (var e = [1 / 0, 1 / 0, -1 / 0, -1 / 0], o = 0, i = t.length; o < i; ++o) ko(e, t[o]); return e }

    function So(t, e, o) { return Ro(Math.min.apply(null, t), Math.min.apply(null, e), t = Math.max.apply(null, t), e = Math.max.apply(null, e), o) }

    function xo(t, e, o) { return r(o) ? (o[0] = t[0] - e, o[1] = t[1] - e, o[2] = t[2] + e, o[3] = t[3] + e, o) : [t[0] - e, t[1] - e, t[2] + e, t[3] + e] }

    function Mo(t, e) { return r(e) ? (e[0] = t[0], e[1] = t[1], e[2] = t[2], e[3] = t[3], e) : t.slice() }

    function Po(t, e, o) { return (e = e < t[0] ? t[0] - e : t[2] < e ? e - t[2] : 0) * e + (t = o < t[1] ? t[1] - o : t[3] < o ? o - t[3] : 0) * t }

    function To(t, e) { return Ao(t, e[0], e[1]) }

    function jo(t, e) { return t[0] <= e[0] && e[2] <= t[2] && t[1] <= e[1] && e[3] <= t[3] }

    function Ao(t, e, o) { return t[0] <= e && e <= t[2] && t[1] <= o && o <= t[3] }

    function Co(t, e) {
        var o = t[1],
            i = t[2],
            r = t[3],
            n = e[0],
            s = e[1],
            p = 0;
        return n < t[0] ? p |= 16 : n > i && (p |= 4), s < o ? p |= 8 : s > r && (p |= 2), 0 === p && (p = 1), p
    }

    function Ro(t, e, o, i, n) { return r(n) ? (n[0] = t, n[1] = e, n[2] = o, n[3] = i, n) : [t, e, o, i] }

    function Lo(t, e) {
        var o = t[0],
            i = t[1];
        return Ro(o, i, o, i, e)
    }

    function Eo(t, e) { return t[0] == e[0] && t[2] == e[2] && t[1] == e[1] && t[3] == e[3] }

    function Io(t, e) { return e[0] < t[0] && (t[0] = e[0]), e[2] > t[2] && (t[2] = e[2]), e[1] < t[1] && (t[1] = e[1]), e[3] > t[3] && (t[3] = e[3]), t }

    function ko(t, e) { e[0] < t[0] && (t[0] = e[0]), e[0] > t[2] && (t[2] = e[0]), e[1] < t[1] && (t[1] = e[1]), e[1] > t[3] && (t[3] = e[1]) }

    function No(t, e, o, i, r) {
        for (; o < i; o += r) {
            var n = t,
                s = e[o],
                p = e[o + 1];
            n[0] = Math.min(n[0], s), n[1] = Math.min(n[1], p), n[2] = Math.max(n[2], s), n[3] = Math.max(n[3], p)
        }
        return t
    }

    function Fo(t, e, o) { var i; return ((i = e.call(o, Do(t))) || (i = e.call(o, Oo(t))) || (i = e.call(o, Yo(t))) || !!(i = e.call(o, Ko(t)))) && i }

    function Do(t) { return [t[0], t[1]] }

    function Oo(t) { return [t[2], t[1]] }

    function Bo(t) { return [(t[0] + t[2]) / 2, (t[1] + t[3]) / 2] }

    function Go(t, e, o, i) { var r, n, s, p = e * i[0] / 2; for (i = e * i[1] / 2, e = Math.cos(o), o = Math.sin(o), p = [-p, -p, p, p], i = [-i, i, -i, i], r = 0; 4 > r; ++r) n = p[r], s = i[r], p[r] = t[0] + n * e - s * o, i[r] = t[1] + n * o + s * e; return So(p, i, void 0) }

    function Uo(t) { return t[3] - t[1] }

    function Xo(t, e, o) { return o = r(o) ? o : [1 / 0, 1 / 0, -1 / 0, -1 / 0], Ho(t, e) && (o[0] = t[0] > e[0] ? t[0] : e[0], o[1] = t[1] > e[1] ? t[1] : e[1], o[2] = t[2] < e[2] ? t[2] : e[2], o[3] = t[3] < e[3] ? t[3] : e[3]), o }

    function Ko(t) { return [t[0], t[3]] }

    function Yo(t) { return [t[2], t[3]] }

    function Vo(t) { return t[2] - t[0] }

    function Ho(t, e) { return t[0] <= e[2] && t[2] >= e[0] && t[1] <= e[3] && t[3] >= e[1] }

    function Wo(t) { return t[2] < t[0] || t[3] < t[1] }

    function zo(t, e) {
        var o = (t[2] - t[0]) / 2 * (e - 1),
            i = (t[3] - t[1]) / 2 * (e - 1);
        t[0] -= o, t[2] += o, t[1] -= i, t[3] += i
    }

    function Zo(t, e, o) { return e(t = [t[0], t[1], t[0], t[3], t[2], t[1], t[2], t[3]], t, 2), So([t[0], t[2], t[4], t[6]], [t[1], t[3], t[5], t[7]], o) }

    function Jo(t) { return function() { return t } }
    new Float64Array(3), new Float64Array(3), new Float64Array(4), new Float64Array(4), new Float64Array(4), new Float64Array(16);
    var qo = Jo(!1),
        $o = Jo(!0),
        _o = Jo(null);

    function Qo(t) { return t }

    function ti(t) {
        var e = arguments,
            o = e.length;
        return function() { for (var t, i = 0; i < o; i++) t = e[i].apply(this, arguments); return t }
    }

    function ei(t) {
        var e = arguments,
            o = e.length;
        return function() {
            for (var t = 0; t < o; t++)
                if (!e[t].apply(this, arguments)) return !1;
            return !0
        }
    }

    function oi(t) { this.radius = t }
    oi.prototype.b = function(t) {
        for (var e = 0, o = t.length, i = t[o - 1][0], r = t[o - 1][1], n = 0; n < o; n++) {
            var s = t[n][0],
                p = t[n][1];
            e += Vt(s - i) * (2 + Math.sin(Vt(r)) + Math.sin(Vt(p))), i = s, r = p
        }
        return e * this.radius * this.radius / 2
    }, oi.prototype.a = function(t, e) {
        var o = Vt(t[1]),
            i = Vt(e[1]),
            r = (i - o) / 2,
            n = Vt(e[0] - t[0]) / 2;
        return o = Math.sin(r) * Math.sin(r) + Math.sin(n) * Math.sin(n) * Math.cos(o) * Math.cos(i), 2 * this.radius * Math.atan2(Math.sqrt(o), Math.sqrt(1 - o))
    }, oi.prototype.offset = function(t, e, o) {
        var i = Vt(t[1]);
        e /= this.radius;
        var r = Math.asin(Math.sin(i) * Math.cos(e) + Math.cos(i) * Math.sin(e) * Math.cos(o));
        return [180 * (Vt(t[0]) + Math.atan2(Math.sin(o) * Math.sin(e) * Math.cos(i), Math.cos(e) - Math.sin(i) * Math.sin(r))) / Math.PI, 180 * r / Math.PI]
    };
    var ii = new oi(6370997),
        ri = {};

    function ni(t) {
        if (this.a = t.code, this.b = t.units, this.i = r(t.extent) ? t.extent : null, this.j = r(t.worldExtent) ? t.worldExtent : null, this.f = r(t.axisOrientation) ? t.axisOrientation : "enu", this.g = (this.c = !!r(t.global) && t.global) && null !== this.i, this.B = r(t.getPointResolution) ? t.getPointResolution : this.uj, this.l = null, "function" == typeof proj4) {
            var e, o, i = t.code,
                n = proj4.defs(i);
            if (r(n))
                for (e in r(n.axis) && !r(t.axisOrientation) && (this.f = n.axis), r(t.units) || (!r(t = n.units) && r(n.to_meter) && (t = n.to_meter.toString(), ri[t] = n.to_meter), this.b = t), t = pi) r(o = proj4.defs(e)) && (t = gi(e), o === n ? hi([t, this]) : yi(t, this, (o = proj4(e, i)).forward, o.inverse))
        }
    }

    function si(t) { return t.f }
    ri.degrees = 2 * Math.PI * ii.radius / 360, ri.ft = .3048, ri.m = 1, ri["us-ft"] = 1200 / 3937, (t = ni.prototype).Vi = function() { return this.a }, t.R = function() { return this.i }, t.Jl = function() { return this.b }, t.Nd = function() { return ri[this.b] }, t.Fj = function() { return this.j }, t.tk = function() { return this.c }, t.Vn = function(t) { this.g = (this.c = t) && null !== this.i }, t.Kl = function(t) { this.i = t, this.g = this.c && null !== t }, t.io = function(t) { this.j = t }, t.Un = function(t) { this.B = t }, t.uj = function(t, e) {
        if ("degrees" == this.b) return t;
        var o = (i = bi(this, gi("EPSG:4326")))(o = [e[0] - t / 2, e[1], e[0] + t / 2, e[1], e[0], e[1] - t / 2, e[0], e[1] + t / 2], o, 2),
            i = (ii.a(o.slice(0, 2), o.slice(2, 4)) + ii.a(o.slice(4, 6), o.slice(6, 8))) / 2;
        return r(o = this.Nd()) && (i /= o), i
    }, t.getPointResolution = function(t, e) { return this.B(t, e) };
    var pi = {},
        ai = {};

    function hi(t) {
        ! function(t) {
            var e = [];
            H(t, (function(t) { e.push(li(t)) }))
        }(t), H(t, (function(e) { H(t, (function(t) { e !== t && ci(e, t, wi) })) }))
    }

    function li(t) { pi[t.a] = t, ci(t, t, wi) }

    function ui(t) { return null != t ? c(t) ? gi(t) : t : gi("EPSG:3857") }

    function ci(t, e, o) { t = t.a, e = e.a, t in ai || (ai[t] = {}), ai[t][e] = o }

    function yi(t, e, o, i) { ci(t = gi(t), e = gi(e), fi(o)), ci(e, t, fi(i)) }

    function fi(t) {
        return function(e, o, i) {
            var n, s, p = e.length;
            for (i = r(i) ? i : 2, o = r(o) ? o : Array(p), s = 0; s < p; s += i)
                for (n = t([e[s], e[s + 1]]), o[s] = n[0], o[s + 1] = n[1], n = i - 1; 2 <= n; --n) o[s + n] = e[s + n];
            return o
        }
    }

    function gi(t) { var e; return t instanceof ni ? e = t : c(t) ? !r(e = pi[t]) && "function" == typeof proj4 && r(proj4.defs(t)) && li(e = new ni({ code: t })) : e = null, e }

    function di(t, e) { return t === e || t.a === e.a || t.b == e.b && bi(t, e) === wi }

    function vi(t, e) { return bi(gi(t), gi(e)) }

    function bi(t, e) {
        var o, i = t.a,
            n = e.a;
        return i in ai && n in ai[i] && (o = ai[i][n]), r(o) || (o = mi), o
    }

    function mi(t, e) {
        if (r(e) && t !== e) {
            for (var o = 0, i = t.length; o < i; ++o) e[o] = t[o];
            t = e
        }
        return t
    }

    function wi(t, e) {
        var o;
        if (r(e)) {
            o = 0;
            for (var i = t.length; o < i; ++o) e[o] = t[o];
            o = e
        } else o = t.slice();
        return o
    }

    function Si(t, e, o) { return vi(e, o)(t, void 0, t.length) }

    function xi(t, e, o) { return Zo(t, e = vi(e, o)) }

    function Mi() { Ve.call(this), this.v = [1 / 0, 1 / 0, -1 / 0, -1 / 0], this.u = -1, this.g = {}, this.l = this.i = 0 }

    function Pi(t, e, o, i, n, s) {
        var p = n[0],
            a = n[1],
            h = n[4],
            l = n[5],
            u = n[12];
        n = n[13];
        for (var c = r(s) ? s : [], y = 0; e < o; e += i) {
            var f = t[e],
                g = t[e + 1];
            c[y++] = p * f + h * g + u, c[y++] = a * f + l * g + n
        }
        return r(s) && c.length != y && (c.length = y), c
    }

    function Ti() { Mi.call(this), this.b = "XY", this.H = 2, this.o = null }

    function ji(t) { return "XY" == t ? 2 : "XYZ" == t || "XYM" == t ? 3 : "XYZM" == t ? 4 : void 0 }

    function Ai(t, e, o) { t.H = ji(e), t.b = e, t.o = o }

    function Ci(t, e, o, i) {
        if (r(e)) o = ji(e);
        else {
            for (e = 0; e < i; ++e) {
                if (0 === o.length) return t.b = "XY", void(t.H = 2);
                o = o[0]
            }
            e = 2 == (o = o.length) ? "XY" : 3 == o ? "XYZ" : 4 == o ? "XYZM" : void 0
        }
        t.b = e, t.H = o
    }

    function Ri(t, e, o, i) {
        for (var r = 0, n = t[o - i], s = t[o - i + 1]; e < o; e += i) {
            var p = t[e],
                a = t[e + 1];
            r += s * p - n * a, n = p, s = a
        }
        return r / 2
    }

    function Li(t, e, o, i) {
        var r, n, s = 0;
        for (r = 0, n = o.length; r < n; ++r) {
            var p = o[r];
            s += Ri(t, e, p, i), e = p
        }
        return s
    }

    function Ei(t, e, o, i, r, n) {
        var s = r - o,
            p = n - i;
        if (0 !== s || 0 !== p) {
            var a = ((t - o) * s + (e - i) * p) / (s * s + p * p);
            1 < a ? (o = r, i = n) : 0 < a && (o += s * a, i += p * a)
        }
        return Ii(t, e, o, i)
    }

    function Ii(t, e, o, i) { return (t = o - t) * t + (e = i - e) * e }

    function ki(t, e, o, i, r, n, s) {
        var p = t[e],
            a = t[e + 1],
            h = t[o] - p,
            l = t[o + 1] - a;
        if (0 !== h || 0 !== l)
            if (1 < (n = ((r - p) * h + (n - a) * l) / (h * h + l * l))) e = o;
            else if (0 < n) { for (r = 0; r < i; ++r) s[r] = Yt(t[e + r], t[o + r], n); return void(s.length = i) }
        for (r = 0; r < i; ++r) s[r] = t[e + r];
        s.length = i
    }

    function Ni(t, e, o, i, r) {
        var n = t[e],
            s = t[e + 1];
        for (e += i; e < o; e += i) {
            var p = t[e],
                a = t[e + 1];
            (n = Ii(n, s, p, a)) > r && (r = n), n = p, s = a
        }
        return r
    }

    function Fi(t, e, o, i, r) {
        var n, s;
        for (n = 0, s = o.length; n < s; ++n) {
            var p = o[n];
            r = Ni(t, e, p, i, r), e = p
        }
        return r
    }

    function Di(t, e, o, i, n, s, p, a, h, l, u) {
        if (e == o) return l;
        var c;
        if (0 === n) { if ((c = Ii(p, a, t[e], t[e + 1])) < l) { for (u = 0; u < i; ++u) h[u] = t[e + u]; return h.length = i, c } return l }
        for (var y = r(u) ? u : [NaN, NaN], f = e + i; f < o;)
            if (ki(t, f - i, f, i, p, a, y), (c = Ii(p, a, y[0], y[1])) < l) {
                for (l = c, u = 0; u < i; ++u) h[u] = y[u];
                h.length = i, f += i
            } else f += i * Math.max((Math.sqrt(c) - Math.sqrt(l)) / n | 0, 1);
        if (s && (ki(t, o - i, e, i, p, a, y), (c = Ii(p, a, y[0], y[1])) < l)) {
            for (l = c, u = 0; u < i; ++u) h[u] = y[u];
            h.length = i
        }
        return l
    }

    function Oi(t, e, o, i, n, s, p, a, h, l, u) {
        var c, y;
        for (u = r(u) ? u : [NaN, NaN], c = 0, y = o.length; c < y; ++c) {
            var f = o[c];
            l = Di(t, e, f, i, n, s, p, a, h, l, u), e = f
        }
        return l
    }

    function Bi(t, e) { var o, i, r = 0; for (o = 0, i = e.length; o < i; ++o) t[r++] = e[o]; return r }

    function Gi(t, e, o, i) { var r, n; for (r = 0, n = o.length; r < n; ++r) { var s, p = o[r]; for (s = 0; s < i; ++s) t[e++] = p[s] } return e }

    function Ui(t, e, o, i, n) { n = r(n) ? n : []; var s, p, a = 0; for (s = 0, p = o.length; s < p; ++s) e = Gi(t, e, o[s], i), n[a++] = e; return n.length = a, n }

    function Xi(t, e, o, i, n) { n = r(n) ? n : []; for (var s = 0; e < o; e += i) n[s++] = t.slice(e, e + i); return n.length = s, n }

    function Ki(t, e, o, i, n) {
        n = r(n) ? n : [];
        var s, p, a = 0;
        for (s = 0, p = o.length; s < p; ++s) {
            var h = o[s];
            n[a++] = Xi(t, e, h, i, n[a]), e = h
        }
        return n.length = a, n
    }

    function Yi(t, e, o, i, r, n, s) {
        var p = (o - e) / i;
        if (3 > p) { for (; e < o; e += i) n[s++] = t[e], n[s++] = t[e + 1]; return s }
        var a = Array(p);
        a[0] = 1, a[p - 1] = 1, o = [e, o - i];
        for (var h, l = 0; 0 < o.length;) {
            var u = o.pop(),
                c = o.pop(),
                y = 0,
                f = t[c],
                g = t[c + 1],
                d = t[u],
                v = t[u + 1];
            for (h = c + i; h < u; h += i) {
                var b = Ei(t[h], t[h + 1], f, g, d, v);
                b > y && (l = h, y = b)
            }
            y > r && (a[(l - e) / i] = 1, c + i < l && o.push(c, l), l + i < u && o.push(l, u))
        }
        for (h = 0; h < p; ++h) a[h] && (n[s++] = t[e + h * i], n[s++] = t[e + h * i + 1]);
        return s
    }

    function Vi(t, e, o, i, r, n, s, p) {
        var a, h;
        for (a = 0, h = o.length; a < h; ++a) {
            var l = o[a];
            t: {
                var u = t,
                    c = l,
                    y = i,
                    f = r,
                    g = n;
                if (e != c) {
                    var d = f * Math.round(u[e] / f),
                        v = f * Math.round(u[e + 1] / f);
                    e += y, g[s++] = d, g[s++] = v;
                    var b = void 0,
                        m = void 0;
                    do { if (b = f * Math.round(u[e] / f), m = f * Math.round(u[e + 1] / f), (e += y) == c) { g[s++] = b, g[s++] = m; break t } } while (b == d && m == v);
                    for (; e < c;) {
                        var w, S;
                        if (w = f * Math.round(u[e] / f), S = f * Math.round(u[e + 1] / f), e += y, w != b || S != m) {
                            var x = b - d,
                                M = m - v,
                                P = w - d,
                                T = S - v;
                            x * T == M * P && (0 > x && P < x || x == P || 0 < x && P > x) && (0 > M && T < M || M == T || 0 < M && T > M) || (g[s++] = b, g[s++] = m, d = b, v = m), b = w, m = S
                        }
                    }
                    g[s++] = b, g[s++] = m
                }
            }
            p.push(s), e = l
        }
        return s
    }

    function Hi(t, e) { Ti.call(this), this.c = this.j = -1, this.ja(t, e) }

    function Wi(t, e, o) { Ai(t, e, o), t.s() }

    function zi(t, e) { Ti.call(this), this.ja(t, e) }

    function Zi(t, e, o) { Ai(t, e, o), t.s() }

    function Ji(t, e, o, i, r) { return !Fo(r, (function(r) { return !qi(t, e, o, i, r[0], r[1]) })) }

    function qi(t, e, o, i, r, n) {
        for (var s = !1, p = t[o - i], a = t[o - i + 1]; e < o; e += i) {
            var h = t[e],
                l = t[e + 1];
            a > n != l > n && r < (h - p) * (n - a) / (l - a) + p && (s = !s), p = h, a = l
        }
        return s
    }

    function $i(t, e, o, i, r, n) {
        if (0 === o.length || !qi(t, e, o[0], i, r, n)) return !1;
        var s;
        for (e = 1, s = o.length; e < s; ++e)
            if (qi(t, o[e - 1], o[e], i, r, n)) return !1;
        return !0
    }

    function _i(t, e, o, i, n, s, p) {
        var a, h, l, u, c, y = n[s + 1],
            f = [],
            g = o[0];
        for (l = t[g - i], c = t[g - i + 1], a = e; a < g; a += i) u = t[a], h = t[a + 1], (y <= c && h <= y || c <= y && y <= h) && (l = (y - c) / (h - c) * (u - l) + l, f.push(l)), l = u, c = h;
        for (g = NaN, c = -1 / 0, f.sort(), l = f[0], a = 1, h = f.length; a < h; ++a) {
            u = f[a];
            var d = Math.abs(u - l);
            d > c && $i(t, e, o, i, l = (l + u) / 2, y) && (g = l, c = d), l = u
        }
        return isNaN(g) && (g = n[s]), r(p) ? (p.push(g, y), p) : [g, y]
    }

    function Qi(t, e, o, i, r, n) {
        for (var s, p = [t[e], t[e + 1]], a = []; e + i < o; e += i) {
            if (a[0] = t[e + i], a[1] = t[e + i + 1], s = r.call(n, p, a)) return s;
            p[0] = a[0], p[1] = a[1]
        }
        return !1
    }

    function tr(t, e, o, i, r) {
        var n = No([1 / 0, 1 / 0, -1 / 0, -1 / 0], t, e, o, i);
        return !!Ho(r, n) && (!!(jo(r, n) || n[0] >= r[0] && n[2] <= r[2] || n[1] >= r[1] && n[3] <= r[3]) || Qi(t, e, o, i, (function(t, e) {
            var o = !1,
                i = Co(r, t),
                n = Co(r, e);
            if (1 === i || 1 === n) o = !0;
            else {
                var s = r[0],
                    p = r[1],
                    a = r[2],
                    h = r[3],
                    l = e[0],
                    u = e[1],
                    c = (u - t[1]) / (l - t[0]);
                2 & n && !(2 & i) && (o = (o = l - (u - h) / c) >= s && o <= a), o || !(4 & n) || 4 & i || (o = (o = u - (l - a) * c) >= p && o <= h), o || !(8 & n) || 8 & i || (o = (o = l - (u - p) / c) >= s && o <= a), o || !(16 & n) || 16 & i || (o = (o = u - (l - s) * c) >= p && o <= h)
            }
            return o
        })))
    }

    function er(t, e, o, i, r) {
        var n = o[0];
        if (!(tr(t, e, n, i, r) || qi(t, e, n, i, r[0], r[1]) || qi(t, e, n, i, r[0], r[3]) || qi(t, e, n, i, r[2], r[1]) || qi(t, e, n, i, r[2], r[3]))) return !1;
        if (1 === o.length) return !0;
        for (e = 1, n = o.length; e < n; ++e)
            if (Ji(t, o[e - 1], o[e], i, r)) return !1;
        return !0
    }

    function or(t, e, o, i) {
        for (var r = 0, n = t[o - i], s = t[o - i + 1]; e < o; e += i) {
            var p = t[e],
                a = t[e + 1];
            r += (p - n) * (a + s), n = p, s = a
        }
        return 0 < r
    }

    function ir(t, e, o, i) {
        var n, s, p = 0;
        for (i = !!r(i) && i, n = 0, s = e.length; n < s; ++n) {
            var a = e[n];
            if (p = or(t, p, a, o), 0 === n) { if (i && p || !i && !p) return !1 } else if (i && !p || !i && p) return !1;
            p = a
        }
        return !0
    }

    function rr(t, e, o, i, n) {
        var s, p;
        for (n = !!r(n) && n, s = 0, p = o.length; s < p; ++s) {
            var a = o[s],
                h = or(t, e, a, i);
            if (0 === s ? n && h || !n && !h : n && !h || !n && h) {
                h = t;
                for (var l = a, u = i; e < l - u;) {
                    var c;
                    for (c = 0; c < u; ++c) {
                        var y = h[e + c];
                        h[e + c] = h[l - u + c], h[l - u + c] = y
                    }
                    e += u, l -= u
                }
            }
            e = a
        }
        return e
    }

    function nr(t, e, o, i) { var r, n, s = 0; for (r = 0, n = e.length; r < n; ++r) s = rr(t, s, e[r], o, i); return s }

    function sr(t, e) { Ti.call(this), this.c = [], this.A = -1, this.D = null, this.T = this.C = this.N = -1, this.j = null, this.ja(t, e) }

    function pr(t) {
        if (t.A != t.a) {
            var e = Bo(t.R());
            t.D = _i(ar(t), 0, t.c, t.H, e, 0), t.A = t.a
        }
        return t.D
    }

    function ar(t) {
        if (t.T != t.a) {
            var e = t.o;
            ir(e, t.c, t.H) ? t.j = e : (t.j = e.slice(), t.j.length = rr(t.j, 0, t.c, t.H)), t.T = t.a
        }
        return t.j
    }

    function hr(t, e, o, i) { Ai(t, e, o), t.c = i, t.s() }

    function lr(t, e, o, i) { var n, s = r(i) ? i : 32; for (i = [], n = 0; n < s; ++n) tt(i, t.offset(e, o, 2 * Math.PI * n / s)); return i.push(i[0], i[1]), hr(t = new sr(null), "XY", i, [i.length]), t }

    function ur(t) {
        var e = t[0],
            o = t[1],
            i = t[2];
        return e = [e, o, e, t = t[3], i, t, i, o, e, o], hr(o = new sr(null), "XY", e, [e.length]), o
    }

    function cr(t, e, o) { for (var i = r(e) ? e : 32, n = t.H, s = new sr(null, e = t.b), p = (i = n * (i + 1), n = [], 0); p < i; p++) n[p] = 0; return hr(s, e, n, [n.length]), yr(s, t.ld(), t.lf(), o), s }

    function yr(t, e, o, i) {
        var n = t.o,
            s = t.b,
            p = t.H,
            a = t.c,
            h = n.length / p - 1;
        i = r(i) ? i : 0;
        for (var l, u, c = 0; c <= h; ++c) u = c * p, l = i + 2 * Kt(c, h) * Math.PI / h, n[u] = e[0] + o * Math.cos(l), n[u + 1] = e[1] + o * Math.sin(l);
        hr(t, s, n, a)
    }

    function fr(t) {
        Ve.call(this), t = r(t) ? t : {}, this.c = [0, 0];
        var e = {};
        e.center = r(t.center) ? t.center : null, this.g = ui(t.projection);
        var o, i, n, s = r(t.minZoom) ? t.minZoom : 0;
        o = r(t.maxZoom) ? t.maxZoom : 28;
        var p = r(t.zoomFactor) ? t.zoomFactor : 2;
        if (r(t.resolutions)) i = (o = t.resolutions)[0], n = o[o.length - 1], o = function(t) { return function(e, o, i) { if (r(e)) return e = Xt((e = Wt(t, e, i)) + o, 0, t.length - 1), t[e] } }(o);
        else {
            var a = (null === (n = (i = ui(t.projection)).R()) ? 360 * ri.degrees / ri[i.b] : Math.max(Vo(n), Uo(n))) / 256 / Math.pow(2, 0),
                h = a / Math.pow(2, 28);
            r(i = t.maxResolution) ? s = 0 : i = a / Math.pow(p, s), r(n = t.minResolution) || (n = r(t.maxZoom) ? r(t.maxResolution) ? i / Math.pow(p, o) : a / Math.pow(p, o) : h), o = s + Math.floor(Math.log(i / n) / Math.log(p)), n = i / Math.pow(p, o - s), o = function(t, e, o) { return function(i, n, s) { if (r(i)) return s = 0 < s ? 0 : 0 > s ? 1 : .5, i = Math.floor(Math.log(e / i) / Math.log(t) + s), n = Math.max(i + n, 0), r(o) && (n = Math.min(n, o)), e / Math.pow(t, n) } }(p, i, o - s)
        }
        this.b = i, this.j = n, this.f = s, s = r(t.extent) ? function(t) { return function(e) { if (r(e)) return [Xt(e[0], t[0], t[2]), Xt(e[1], t[1], t[3])] } }(t.extent) : Ht, i = !r(t.enableRotation) || t.enableRotation ? r(i = t.constrainRotation) && !0 !== i ? !1 === i ? Zt : y(i) ? function(t) { var e = 2 * Math.PI / t; return function(t, o) { if (r(t)) return t = Math.floor((t + o) / e + .5) * e } }(i) : Zt : function() { var t = Vt(5); return function(e, o) { if (r(e)) return Math.abs(e + o) <= t ? 0 : e + o } }() : zt, this.i = new Jt(s, o, i), r(t.resolution) ? e.resolution = t.resolution : r(t.zoom) && (e.resolution = this.constrainResolution(this.b, t.zoom - this.f)), e.rotation = r(t.rotation) ? t.rotation : 0, this.I(e)
    }

    function gr(t) {
        var e = t.Ka(),
            o = t.g,
            i = t.Da();
        return t = t.Ea(), { center: [Math.round(e[0] / i) * i, Math.round(e[1] / i) * i], projection: r(o) ? o : null, resolution: i, rotation: t }
    }

    function dr(t) { return null != t.Ka() && r(t.Da()) }

    function vr(t, e) { t.c[1] += e }

    function br(t) { return 1 - Math.pow(1 - t, 3) }

    function mr(t) { return 3 * t * t - 2 * t * t * t }

    function wr(t) { return t }

    function Sr(t) { return .5 > t ? mr(2 * t) : 1 - mr(2 * (t - .5)) }

    function xr(t) {
        var e = t.source,
            o = r(t.start) ? t.start : j(),
            i = e[0],
            n = e[1],
            s = r(t.duration) ? t.duration : 1e3,
            p = r(t.easing) ? t.easing : mr;
        return function(t, e) {
            if (e.time < o) return e.animate = !0, e.viewHints[0] += 1, !0;
            if (e.time < o + s) {
                var r = 1 - p((e.time - o) / s),
                    a = i - e.viewState.center[0],
                    h = n - e.viewState.center[1];
                return e.animate = !0, e.viewState.center[0] += r * a, e.viewState.center[1] += r * h, e.viewHints[0] += 1, !0
            }
            return !1
        }
    }

    function Mr(t) {
        var e = r(t.rotation) ? t.rotation : 0,
            o = r(t.start) ? t.start : j(),
            i = r(t.duration) ? t.duration : 1e3,
            n = r(t.easing) ? t.easing : mr,
            s = r(t.anchor) ? t.anchor : null;
        return function(t, r) {
            if (r.time < o) return r.animate = !0, r.viewHints[0] += 1, !0;
            if (r.time < o + i) {
                var p = 1 - n((r.time - o) / i);
                if (p = (e - r.viewState.rotation) * p, r.animate = !0, r.viewState.rotation += p, null !== s) {
                    var a = r.viewState.center;
                    a[0] -= s[0], a[1] -= s[1], oo(a, p), $e(a, s)
                }
                return r.viewHints[0] += 1, !0
            }
            return !1
        }
    }

    function Pr(t) {
        var e = t.resolution,
            o = r(t.start) ? t.start : j(),
            i = r(t.duration) ? t.duration : 1e3,
            n = r(t.easing) ? t.easing : mr;
        return function(t, r) {
            if (r.time < o) return r.animate = !0, r.viewHints[0] += 1, !0;
            if (r.time < o + i) {
                var s = 1 - n((r.time - o) / i),
                    p = e - r.viewState.resolution;
                return r.animate = !0, r.viewState.resolution += s * p, r.viewHints[0] += 1, !0
            }
            return !1
        }
    }

    function Tr(t, e, o, i) { return r(i) ? (i[0] = t, i[1] = e, i[2] = o, i) : [t, e, o] }

    function jr(t, e, o) { return t + "/" + e + "/" + o }

    function Ar(t) { return jr(t[0], t[1], t[2]) }

    function Cr(t, e, o) {
        var i = t[0],
            r = os(e, t);
        return To(o = as(o), r) ? t : (t = Vo(o), o = Math.ceil((o[0] - r[0]) / t), r[0] += t * o, e.Rd(r, i))
    }

    function Rr(t, e) {
        var o = t[0],
            i = t[1],
            r = t[2];
        if (e.minZoom > o || o > e.maxZoom) return !1;
        var n = e.R();
        return null === (o = null === n ? null === e.b ? null : e.b[o] : es(e, n, o)) || Er(o, i, r)
    }

    function Lr(t, e, o, i) { this.a = t, this.f = e, this.b = o, this.c = i }

    function Er(t, e, o) { return t.a <= e && e <= t.f && t.b <= o && o <= t.c }

    function Ir(t) { return t.f - t.a + 1 }

    function kr(t, e) { return t.a <= e.f && t.f >= e.a && t.b <= e.c && t.c >= e.b }

    function Nr(t) { this.b = t.html, this.a = r(t.tileRanges) ? t.tileRanges : null }

    function Fr(t, e, o) { re.call(this, t, o), this.element = e }

    function Dr(t) { Ve.call(this), this.b = r(t) ? t : [], Or(this) }

    function Or(t) { t.set("length", t.b.length) }
    A(Mi, Ve), (t = Mi.prototype).$a = function(t, e) { var o = r(e) ? e : [NaN, NaN]; return this.Ya(t[0], t[1], o, 1 / 0), o }, t.Ne = function(t) { return this.gc(t[0], t[1]) }, t.gc = qo, t.R = function(t) { this.u != this.a && (this.v = this.Ed(this.v), this.u = this.a); var e = this.v; return r(t) ? (t[0] = e[0], t[1] = e[1], t[2] = e[2], t[3] = e[3]) : t = e, t }, t.transform = function(t, e) { return this.va(vi(t, e)), this }, A(Ti, Mi), (t = Ti.prototype).gc = qo, t.Ed = function(t) {
        var e = this.o,
            o = this.o.length,
            i = this.H;
        return No(t = Ro(1 / 0, 1 / 0, -1 / 0, -1 / 0, t), e, 0, o, i)
    }, t.Ab = function() { return this.o.slice(0, this.H) }, t.Bb = function() { return this.o.slice(this.o.length - this.H) }, t.Cb = function() { return this.b }, t.$e = function(t) { if (this.l != this.a && (bt(this.g), this.i = 0, this.l = this.a), 0 > t || 0 !== this.i && t <= this.i) return this; var e = t.toString(); if (this.g.hasOwnProperty(e)) return this.g[e]; var o = this.Cc(t); return o.o.length < this.o.length ? this.g[e] = o : (this.i = t, this) }, t.Cc = function() { return this }, t.va = function(t) { null !== this.o && (t(this.o, this.o, this.H), this.s()) }, t.Ua = function(t, e) {
        var o = this.o;
        if (null !== o) {
            var i, n, s = o.length,
                p = this.H,
                a = r(o) ? o : [],
                h = 0;
            for (i = 0; i < s; i += p)
                for (a[h++] = o[i] + t, a[h++] = o[i + 1] + e, n = i + 2; n < i + p; ++n) a[h++] = o[n];
            r(o) && a.length != h && (a.length = h), this.s()
        }
    }, A(Hi, Ti), (t = Hi.prototype).clone = function() { var t = new Hi(null); return Wi(t, this.b, this.o.slice()), t }, t.Ya = function(t, e, o, i) { return i < Po(this.R(), t, e) ? i : (this.c != this.a && (this.j = Math.sqrt(Ni(this.o, 0, this.o.length, this.H, 0)), this.c = this.a), Di(this.o, 0, this.o.length, this.H, this.j, !0, t, e, o, i)) }, t.pl = function() { return Ri(this.o, 0, this.o.length, this.H) }, t.V = function() { return Xi(this.o, 0, this.o.length, this.H) }, t.Cc = function(t) { var e = []; return e.length = Yi(this.o, 0, this.o.length, this.H, t, e, 0), Wi(t = new Hi(null), "XY", e), t }, t.U = function() { return "LinearRing" }, t.ja = function(t, e) { null === t ? Wi(this, "XY", null) : (Ci(this, e, t, 1), null === this.o && (this.o = []), this.o.length = Gi(this.o, 0, t, this.H), this.s()) }, A(zi, Ti), (t = zi.prototype).clone = function() { var t = new zi(null); return Zi(t, this.b, this.o.slice()), t }, t.Ya = function(t, e, o, i) { var r = this.o; if ((t = Ii(t, e, r[0], r[1])) < i) { for (i = this.H, e = 0; e < i; ++e) o[e] = r[e]; return o.length = i, t } return i }, t.V = function() { return null === this.o ? [] : this.o.slice() }, t.Ed = function(t) { return Lo(this.o, t) }, t.U = function() { return "Point" }, t.sa = function(t) { return Ao(t, this.o[0], this.o[1]) }, t.ja = function(t, e) { null === t ? Zi(this, "XY", null) : (Ci(this, e, t, 0), null === this.o && (this.o = []), this.o.length = Bi(this.o, t), this.s()) }, A(sr, Ti), (t = sr.prototype).Ai = function(t) { null === this.o ? this.o = t.o.slice() : tt(this.o, t.o), this.c.push(this.o.length), this.s() }, t.clone = function() { var t = new sr(null); return hr(t, this.b, this.o.slice(), this.c.slice()), t }, t.Ya = function(t, e, o, i) { return i < Po(this.R(), t, e) ? i : (this.C != this.a && (this.N = Math.sqrt(Fi(this.o, 0, this.c, this.H, 0)), this.C = this.a), Oi(this.o, 0, this.c, this.H, this.N, !0, t, e, o, i)) }, t.gc = function(t, e) { return $i(ar(this), 0, this.c, this.H, t, e) }, t.sl = function() { return Li(ar(this), 0, this.c, this.H) }, t.V = function(t) { var e; return r(t) ? rr(e = ar(this).slice(), 0, this.c, this.H, t) : e = this.o, Ki(e, 0, this.c, this.H) }, t.gj = function() { return new zi(pr(this)) }, t.lj = function() { return this.c.length }, t.dg = function(t) { if (0 > t || this.c.length <= t) return null; var e = new Hi(null); return Wi(e, this.b, this.o.slice(0 === t ? 0 : this.c[t - 1], this.c[t])), e }, t.Md = function() {
        var t, e, o = this.b,
            i = this.o,
            r = this.c,
            n = [],
            s = 0;
        for (t = 0, e = r.length; t < e; ++t) {
            var p = r[t],
                a = new Hi(null);
            Wi(a, o, i.slice(s, p)), n.push(a), s = p
        }
        return n
    }, t.Cc = function(t) {
        var e = [],
            o = [];
        return e.length = Vi(this.o, 0, this.c, this.H, Math.sqrt(t), e, 0, o), hr(t = new sr(null), "XY", e, o), t
    }, t.U = function() { return "Polygon" }, t.sa = function(t) { return er(ar(this), 0, this.c, this.H, t) }, t.ja = function(t, e) {
        if (null === t) hr(this, "XY", null, this.c);
        else {
            Ci(this, e, t, 2), null === this.o && (this.o = []);
            var o = Ui(this.o, 0, t, this.H, this.c);
            this.o.length = 0 === o.length ? 0 : o[o.length - 1], this.s()
        }
    }, A(fr, Ve), (t = fr.prototype).Fd = function(t) { return this.i.center(t) }, t.constrainResolution = function(t, e, o) { return this.i.resolution(t, e || 0, o || 0) }, t.constrainRotation = function(t, e) { return this.i.rotation(t, e || 0) }, t.Ka = function() { return this.get("center") }, t.Vc = function(t) { return Go(this.Ka(), this.Da(), this.Ea(), t) }, t.$k = function() { return this.g }, t.Da = function() { return this.get("resolution") }, t.Ea = function() { return this.get("rotation") }, t.Hj = function() {
        var t, e = this.Da();
        if (r(e)) {
            var o, i = 0;
            do { if ((o = this.constrainResolution(this.b, i)) == e) { t = i; break }++i } while (o > this.j)
        }
        return r(t) ? this.f + t : t
    }, t.Qe = function(t, e, o) {
        t instanceof Ti || (t = ur(t));
        var i = r(o) ? o : {};
        o = r(i.padding) ? i.padding : [0, 0, 0, 0];
        var n, s = !r(i.constrainResolution) || i.constrainResolution,
            p = !!r(i.nearest) && i.nearest;
        n = r(i.minResolution) ? i.minResolution : r(i.maxZoom) ? this.constrainResolution(this.b, i.maxZoom - this.f, 0) : 0;
        var a = t.o,
            h = this.Ea(),
            l = (i = Math.cos(-h), h = Math.sin(-h), 1 / 0),
            u = 1 / 0,
            c = -1 / 0,
            y = -1 / 0;
        t = t.H;
        for (var f = 0, g = a.length; f < g; f += t) {
            var d = a[f] * i - a[f + 1] * h,
                v = a[f] * h + a[f + 1] * i;
            l = Math.min(l, d), u = Math.min(u, v), c = Math.max(c, d), y = Math.max(y, v)
        }
        a = [l, u, c, y], e = [e[0] - o[1] - o[3], e[1] - o[0] - o[2]], e = Math.max(Vo(a) / e[0], Uo(a) / e[1]), e = isNaN(e) ? n : Math.max(e, n), s && (n = this.constrainResolution(e, 0, 0), !p && n < e && (n = this.constrainResolution(n, -1, 0)), e = n), this.Xb(e), h = -h, p = (l + c) / 2 + (o[1] - o[3]) / 2 * e, o = (u + y) / 2 + (o[0] - o[2]) / 2 * e, this.eb([p * i - o * h, o * i + p * h])
    }, t.Gi = function(t, e, o) {
        var i = this.Ea(),
            r = Math.cos(-i),
            n = (i = Math.sin(-i), t[0] * r - t[1] * i);
        t = t[1] * r + t[0] * i;
        var s = this.Da();
        n += (e[0] / 2 - o[0]) * s, t += (o[1] - e[1] / 2) * s, i = -i, this.eb([n * r - t * i, t * r + n * i])
    }, t.rotate = function(t, e) {
        if (r(e)) {
            var o, i = this.Ka();
            r(i) && (oo(o = [i[0] - e[0], i[1] - e[1]], t - this.Ea()), $e(o, e)), this.eb(o)
        }
        this.fe(t)
    }, t.eb = function(t) { this.set("center", t) }, t.Xb = function(t) { this.set("resolution", t) }, t.fe = function(t) { this.set("rotation", t) }, t.ko = function(t) { t = this.constrainResolution(this.b, t - this.f, 0), this.Xb(t) }, Lr.prototype.contains = function(t) { return Er(this, t[1], t[2]) }, Nr.prototype.c = function() { return this.b }, A(Fr, re), A(Dr, Ve), (t = Dr.prototype).clear = function() { for (; 0 < this.Qb();) this.pop() }, t.ff = function(t) { var e, o; for (e = 0, o = t.length; e < o; ++e) this.push(t[e]); return this }, t.forEach = function(t, e) { H(this.b, t, e) }, t.Jk = function() { return this.b }, t.item = function(t) { return this.b[t] }, t.Qb = function() { return this.get("length") }, t.Yd = function(t, e) {! function(t, e, o, i) { Y.splice.apply(t, et(arguments, 1)) }(this.b, t, 0, e), Or(this), Be(this, new Fr("add", e, this)) }, t.pop = function() { return this.zf(this.Qb() - 1) }, t.push = function(t) { var e = this.b.length; return this.Yd(e, t), e }, t.remove = function(t) {
        var e, o, i = this.b;
        for (e = 0, o = i.length; e < o; ++e)
            if (i[e] === t) return this.zf(e)
    }, t.zf = function(t) { var e = this.b[t]; return Y.splice.call(this.b, t, 1), Or(this), Be(this, new Fr("remove", e, this)), e }, t.Rn = function(t, e) {
        var o = this.Qb();
        if (t < o) o = this.b[t], this.b[t] = e, Be(this, new Fr("remove", o, this)), Be(this, new Fr("add", e, this));
        else {
            for (; o < t; ++o) this.Yd(o, void 0);
            this.Yd(t, e)
        }
    };
    var Br = /^#(?:[0-9a-f]{3}){1,2}$/i,
        Gr = /^(?:rgb)?\((0|[1-9]\d{0,2}),\s?(0|[1-9]\d{0,2}),\s?(0|[1-9]\d{0,2})\)$/i,
        Ur = /^(?:rgba)?\((0|[1-9]\d{0,2}),\s?(0|[1-9]\d{0,2}),\s?(0|[1-9]\d{0,2}),\s?(0|1|0\.\d{0,10})\)$/i;

    function Xr(t) { return l(t) ? t : Yr(t) }

    function Kr(t) {
        if (!c(t)) {
            var e = t[0];
            e != (0 | e) && (e = e + .5 | 0);
            var o = t[1];
            o != (0 | o) && (o = o + .5 | 0);
            var i = t[2];
            i != (0 | i) && (i = i + .5 | 0), t = "rgba(" + e + "," + o + "," + i + "," + t[3] + ")"
        }
        return t
    }
    var Yr = function() {
        var t = {},
            e = 0;
        return function(o) {
            var i;
            if (t.hasOwnProperty(o)) i = t[o];
            else {
                if (1024 <= e)
                    for (var r in i = 0, t) 0 == (3 & i++) && (delete t[r], --e);
                var n, s;
                Br.exec(o) ? (s = 3 == o.length - 1 ? 1 : 2, i = parseInt(o.substr(1 + 0 * s, s), 16), r = parseInt(o.substr(1 + 1 * s, s), 16), n = parseInt(o.substr(1 + 2 * s, s), 16), 1 == s && (i = (i << 4) + i, r = (r << 4) + r, n = (n << 4) + n), i = [i, r, n, 1]) : i = (s = Ur.exec(o)) ? Vr(i = [i = Number(s[1]), r = Number(s[2]), n = Number(s[3]), s = Number(s[4])], i) : (s = Gr.exec(o)) ? Vr(i = [i = Number(s[1]), r = Number(s[2]), n = Number(s[3]), 1], i) : void 0, t[o] = i, ++e
            }
            return i
        }
    }();

    function Vr(t, e) { var o = r(e) ? e : []; return o[0] = Xt(t[0] + .5 | 0, 0, 255), o[1] = Xt(t[1] + .5 | 0, 0, 255), o[2] = Xt(t[2] + .5 | 0, 0, 255), o[3] = Xt(t[3], 0, 1), o }

    function Hr() { this.j = ho(), this.b = void 0, this.a = ho(), this.f = void 0, this.c = ho(), this.i = void 0, this.g = ho(), this.B = void 0, this.l = ho() }

    function Wr(t, e, o, i, n) {
        var s = !1;
        if (r(e) && e !== t.b && (yo(s = t.a), s[12] = e, s[13] = e, s[14] = e, s[15] = 1, t.b = e, s = !0), r(o) && o !== t.f) {
            yo(s = t.c), s[0] = o, s[5] = o, s[10] = o, s[15] = 1;
            var p = -.5 * o + .5;
            s[12] = p, s[13] = p, s[14] = p, s[15] = 1, t.f = o, s = !0
        }
        return r(i) && i !== t.i && (s = Math.cos(i), p = Math.sin(i), uo(t.g, .213 + .787 * s - .213 * p, .213 - .213 * s + .143 * p, .213 - .213 * s - .787 * p, 0, .715 - .715 * s - .715 * p, .715 + .285 * s + .14 * p, .715 - .715 * s + .715 * p, 0, .072 - .072 * s + .928 * p, .072 - .072 * s - .283 * p, .072 + .928 * s + .072 * p, 0, 0, 0, 0, 1), t.i = i, s = !0), r(n) && n !== t.B && (uo(t.l, .213 + .787 * n, .213 - .213 * n, .213 - .213 * n, 0, .715 - .715 * n, .715 + .285 * n, .715 - .715 * n, 0, .072 - .072 * n, .072 - .072 * n, .072 + .928 * n, 0, 0, 0, 0, 1), t.B = n, s = !0), s && (yo(s = t.j), r(o) && fo(s, t.c, s), r(e) && fo(s, t.a, s), r(n) && fo(s, t.l, s), r(i) && fo(s, t.g, s)), t.j
    }
    var zr = !jt || jt && 9 <= Gt;

    function Zr(t, e) { this.x = r(t) ? t : 0, this.y = r(e) ? e : 0 }

    function Jr(t, e) {

        this.width = t, this.height = e
    }

    function qr(t) { return t ? new fn(cn(t)) : T || (T = new fn) }

    function $r(t) { var e = document; return c(t) ? e.getElementById(t) : t }

    function _r(t, e) { lt(e, (function(e, o) { "style" == o ? t.style.cssText = e : "class" == o ? t.className = e : "for" == o ? t.htmlFor = e : o in Qr ? t.setAttribute(Qr[o], e) : 0 == o.lastIndexOf("aria-", 0) || 0 == o.lastIndexOf("data-", 0) ? t.setAttribute(o, e) : t[o] = e })) }!At && !jt || jt && jt && 9 <= Gt || At && Ot("1.9.1"), jt && Ot("9"),
        function t(e) { var o = arguments.length; if (1 == o && l(arguments[0])) return t.apply(null, arguments[0]); for (var i = {}, r = 0; r < o; r++) i[arguments[r]] = !0; return i }("area base br col command embed hr img input keygen link meta param source track wbr".split(" ")), (t = Zr.prototype).clone = function() { return new Zr(this.x, this.y) }, t.ceil = function() { return this.x = Math.ceil(this.x), this.y = Math.ceil(this.y), this }, t.floor = function() { return this.x = Math.floor(this.x), this.y = Math.floor(this.y), this }, t.round = function() { return this.x = Math.round(this.x), this.y = Math.round(this.y), this }, t.scale = function(t, e) { var o = y(e) ? e : t; return this.x *= t, this.y *= o, this }, (t = Jr.prototype).clone = function() { return new Jr(this.width, this.height) }, t.wa = function() { return !(this.width * this.height) }, t.ceil = function() { return this.width = Math.ceil(this.width), this.height = Math.ceil(this.height), this }, t.floor = function() { return this.width = Math.floor(this.width), this.height = Math.floor(this.height), this }, t.round = function() { return this.width = Math.round(this.width), this.height = Math.round(this.height), this }, t.scale = function(t, e) { var o = y(e) ? e : t; return this.width *= t, this.height *= o, this };
    var Qr = { cellpadding: "cellPadding", cellspacing: "cellSpacing", colspan: "colSpan", frameborder: "frameBorder", height: "height", maxlength: "maxLength", role: "role", rowspan: "rowSpan", type: "type", usemap: "useMap", valign: "vAlign", width: "width" };

    function tn(t) { return new Jr((t = t.document.documentElement).clientWidth, t.clientHeight) }

    function en(t, e, o) {
        var i = arguments,
            r = document,
            n = i[0],
            s = i[1];
        if (!zr && s && (s.name || s.type)) {
            if (n = ["<", n], s.name && n.push(' name="', E(s.name), '"'), s.type) {
                n.push(' type="', E(s.type), '"');
                var p = {};
                Pt(p, s), delete p.type, s = p
            }
            n.push(">"), n = n.join("")
        }
        return n = r.createElement(n), s && (c(s) ? n.className = s : l(s) ? n.className = s.join(" ") : _r(n, s)), 2 < i.length && on(r, n, i, 2), n
    }

    function on(t, e, o, i) {
        function r(o) { o && e.appendChild(c(o) ? t.createTextNode(o) : o) }
        for (; i < o.length; i++) { var n = o[i];!u(n) || g(n) && 0 < n.nodeType ? r(n) : H(yn(n) ? Q(n) : n, r) }
    }

    function rn(t) { return document.createElement(t) }

    function nn(t, e) { on(cn(t), t, arguments, 1) }

    function sn(t) { for (var e; e = t.firstChild;) t.removeChild(e) }

    function pn(t, e, o) { t.insertBefore(e, t.childNodes[o] || null) }

    function an(t) { t && t.parentNode && t.parentNode.removeChild(t) }

    function hn(t, e) {
        var o = e.parentNode;
        o && o.replaceChild(t, e)
    }

    function ln(t) {
        if (null != t.firstElementChild) t = t.firstElementChild;
        else
            for (t = t.firstChild; t && 1 != t.nodeType;) t = t.nextSibling;
        return t
    }

    function un(t, e) { if (t.contains && 1 == e.nodeType) return t == e || t.contains(e); if (void 0 !== t.compareDocumentPosition) return t == e || Boolean(16 & t.compareDocumentPosition(e)); for (; e && t != e;) e = e.parentNode; return e == t }

    function cn(t) { return 9 == t.nodeType ? t : t.ownerDocument || t.document }

    function yn(t) { if (t && "number" == typeof t.length) { if (g(t)) return "function" == typeof t.item || "string" == typeof t.item; if (f(t)) return "function" == typeof t.item } return !1 }

    function fn(t) { this.a = t || i.document || document }

    function gn(t) { var e = t.a; return t = Ct && e.body || e.documentElement, e = e.parentWindow || e.defaultView, jt && Ot("10") && e.pageYOffset != t.scrollTop ? new Zr(t.scrollLeft, t.scrollTop) : new Zr(e.pageXOffset || t.scrollLeft, e.pageYOffset || t.scrollTop) }

    function dn(t) { return t.classList ? t.classList : c(t = t.className) && t.match(/\S+/g) || [] }

    function vn(t, e) { return t.classList ? t.classList.contains(e) : q(dn(t), e) }

    function bn(t, e) { t.classList ? t.classList.add(e) : vn(t, e) || (t.className += 0 < t.className.length ? " " + e : e) }

    function mn(t, e) { t.classList ? t.classList.remove(e) : vn(t, e) && (t.className = W(dn(t), (function(t) { return t != e })).join(" ")) }

    function wn(t, e) { vn(t, e) ? mn(t, e) : bn(t, e) }

    function Sn(t, e, o, i) { this.top = t, this.right = e, this.bottom = o, this.left = i }

    function xn(t, e, o, i) { this.left = t, this.top = e, this.width = o, this.height = i }

    function Mn(t, e) { var o = cn(t); return o.defaultView && o.defaultView.getComputedStyle && (o = o.defaultView.getComputedStyle(t, null)) && (o[e] || o.getPropertyValue(e)) || "" }

    function Pn(t, e) { return Mn(t, e) || (t.currentStyle ? t.currentStyle[e] : null) || t.style && t.style[e] }

    function Tn(t, e, o) {
        var i;
        e instanceof Zr ? (i = e.x, e = e.y) : (i = e, e = o), t.style.left = Cn(i), t.style.top = Cn(e)
    }

    function jn(t) { var e; try { e = t.getBoundingClientRect() } catch (t) { return { left: 0, top: 0, right: 0, bottom: 0 } } return jt && t.ownerDocument.body && (t = t.ownerDocument, e.left -= t.documentElement.clientLeft + t.body.clientLeft, e.top -= t.documentElement.clientTop + t.body.clientTop), e }

    function An(t) {
        if (1 == t.nodeType) return new Zr((t = jn(t)).left, t.top);
        var e = f(t.Ui),
            o = t;
        return t.targetTouches && t.targetTouches.length ? o = t.targetTouches[0] : e && t.a.targetTouches && t.a.targetTouches.length && (o = t.a.targetTouches[0]), new Zr(o.clientX, o.clientY)
    }

    function Cn(t) { return "number" == typeof t && (t += "px"), t }

    function Rn(t) {
        var e = Ln;
        if ("none" != Pn(t, "display")) return e(t);
        var o = t.style,
            i = o.display,
            r = o.visibility,
            n = o.position;
        return o.visibility = "hidden", o.position = "absolute", o.display = "inline", t = e(t), o.display = i, o.position = n, o.visibility = r, t
    }

    function Ln(t) {
        var e = t.offsetWidth,
            o = t.offsetHeight,
            i = Ct && !e && !o;
        return r(e) && !i || !t.getBoundingClientRect ? new Jr(e, o) : new Jr((t = jn(t)).right - t.left, t.bottom - t.top)
    }

    function En(t, e) { t.style.display = e ? "" : "none" }

    function In(t, e, o, i) {
        if (/^\d+px?$/.test(e)) return parseInt(e, 10);
        var r = t.style[o],
            n = t.runtimeStyle[o];
        return t.runtimeStyle[o] = t.currentStyle[o], t.style[o] = e, e = t.style[i], t.style[o] = r, t.runtimeStyle[o] = n, e
    }

    function kn(t, e) { var o = t.currentStyle ? t.currentStyle[e] : null; return o ? In(t, o, "left", "pixelLeft") : 0 }

    function Nn(t, e) {
        if (jt) {
            var o = kn(t, e + "Left"),
                i = kn(t, e + "Right"),
                r = kn(t, e + "Top"),
                n = kn(t, e + "Bottom");
            return new Sn(r, i, n, o)
        }
        return o = Mn(t, e + "Left"), i = Mn(t, e + "Right"), r = Mn(t, e + "Top"), n = Mn(t, e + "Bottom"), new Sn(parseFloat(r), parseFloat(i), parseFloat(n), parseFloat(o))
    }
    fn.prototype.appendChild = function(t, e) { t.appendChild(e) }, fn.prototype.contains = un, (t = Sn.prototype).clone = function() { return new Sn(this.top, this.right, this.bottom, this.left) }, t.contains = function(t) { return !(!this || !t) && (t instanceof Sn ? t.left >= this.left && t.right <= this.right && t.top >= this.top && t.bottom <= this.bottom : t.x >= this.left && t.x <= this.right && t.y >= this.top && t.y <= this.bottom) }, t.ceil = function() { return this.top = Math.ceil(this.top), this.right = Math.ceil(this.right), this.bottom = Math.ceil(this.bottom), this.left = Math.ceil(this.left), this }, t.floor = function() { return this.top = Math.floor(this.top), this.right = Math.floor(this.right), this.bottom = Math.floor(this.bottom), this.left = Math.floor(this.left), this }, t.round = function() { return this.top = Math.round(this.top), this.right = Math.round(this.right), this.bottom = Math.round(this.bottom), this.left = Math.round(this.left), this }, t.scale = function(t, e) { var o = y(e) ? e : t; return this.left *= t, this.right *= t, this.top *= o, this.bottom *= o, this }, (t = xn.prototype).clone = function() { return new xn(this.left, this.top, this.width, this.height) }, t.contains = function(t) { return t instanceof xn ? this.left <= t.left && this.left + this.width >= t.left + t.width && this.top <= t.top && this.top + this.height >= t.top + t.height : t.x >= this.left && t.x <= this.left + this.width && t.y >= this.top && t.y <= this.top + this.height }, t.distance = function(t) {
        return Math.sqrt(function(t, e) {
            var o = e.x < t.left ? t.left - e.x : Math.max(e.x - (t.left + t.width), 0),
                i = e.y < t.top ? t.top - e.y : Math.max(e.y - (t.top + t.height), 0);
            return o * o + i * i
        }(this, t))
    }, t.ceil = function() { return this.left = Math.ceil(this.left), this.top = Math.ceil(this.top), this.width = Math.ceil(this.width), this.height = Math.ceil(this.height), this }, t.floor = function() { return this.left = Math.floor(this.left), this.top = Math.floor(this.top), this.width = Math.floor(this.width), this.height = Math.floor(this.height), this }, t.round = function() { return this.left = Math.round(this.left), this.top = Math.round(this.top), this.width = Math.round(this.width), this.height = Math.round(this.height), this }, t.scale = function(t, e) { var o = y(e) ? e : t; return this.left *= t, this.width *= t, this.top *= o, this.height *= o, this };
    var Fn = { thin: 2, medium: 4, thick: 6 };

    function Dn(t, e) { if ("none" == (t.currentStyle ? t.currentStyle[e + "Style"] : null)) return 0; var o = t.currentStyle ? t.currentStyle[e + "Width"] : null; return o in Fn ? Fn[o] : In(t, o, "left", "pixelLeft") }

    function On(t) {
        if (jt && !(jt && 9 <= Gt)) {
            var e = Dn(t, "borderLeft"),
                o = Dn(t, "borderRight"),
                i = Dn(t, "borderTop");
            return new Sn(i, o, t = Dn(t, "borderBottom"), e)
        }
        return e = Mn(t, "borderLeftWidth"), o = Mn(t, "borderRightWidth"), i = Mn(t, "borderTopWidth"), t = Mn(t, "borderBottomWidth"), new Sn(parseFloat(i), parseFloat(o), parseFloat(t), parseFloat(e))
    }

    function Bn(t, e, o) { re.call(this, t), this.map = e, this.frameState = r(o) ? o : null }

    function Gn(t) { Ve.call(this), this.element = r(t.element) ? t.element : null, this.b = this.T = null, this.v = [], this.render = r(t.render) ? t.render : s, r(t.target) && this.c(t.target) }

    function Un(t) { Te(t, ["mouseout", pe], (function() { this.blur() }), !1) }

    function Xn() { this.c = 0, this.f = {}, this.b = this.a = null }

    function Kn(t, e) { return t.f.hasOwnProperty(e) }

    function Yn(t) { Xn.call(this), this.g = r(t) ? t : 2048 }

    function Vn(t) { return t.$b() > t.g }

    function Hn(t, e) { Oe.call(this), this.a = t, this.state = e }

    function Wn(t) { Be(t, "change") }

    function zn(t) { Ve.call(this), this.j = gi(t.projection), this.g = r(t.attributions) ? t.attributions : null, this.ba = t.logo, this.A = r(t.state) ? t.state : "ready", this.D = !!r(t.wrapX) && t.wrapX }

    function Zn(t) { return t.D }

    function Jn(t, e) { t.A = e, t.s() }

    function qn(t) {
        this.minZoom = r(t.minZoom) ? t.minZoom : 0, this.a = t.resolutions, this.maxZoom = this.a.length - 1, this.c = r(t.origin) ? t.origin : null, this.g = null, r(t.origins) && (this.g = t.origins);
        var e = t.extent;
        r(e) && null === this.c && null === this.g && (this.c = Ko(e)), this.i = null, r(t.tileSizes) && (this.i = t.tileSizes), this.l = r(t.tileSize) ? t.tileSize : null === this.i ? 256 : null, this.v = r(e) ? e : null, this.b = null, r(t.sizes) ? this.b = z(t.sizes, (function(t) { return new Lr(Math.min(0, t[0]), Math.max(t[0] - 1, -1), Math.min(0, t[1]), Math.max(t[1] - 1, -1)) }), this) : null != e && function(t, e) {
            for (var o = t.a.length, i = Array(o), r = t.minZoom; r < o; ++r) i[r] = es(t, e, r);
            t.b = i
        }(this, e), this.f = [0, 0]
    }
    A(Bn, re), A(Gn, Ve), Gn.prototype.W = function() { an(this.element), Gn.$.W.call(this) }, Gn.prototype.g = function() { return this.b }, Gn.prototype.setMap = function(t) { null === this.b || an(this.element), 0 != this.v.length && (H(this.v, Re), this.v.length = 0), this.b = t, null !== this.b && ((null === this.T ? t.D : this.T).appendChild(this.element), this.render !== s && this.v.push(Te(t, "postrender", this.render, !1, this)), t.render()) }, Gn.prototype.c = function(t) { this.T = $r(t) }, (t = Xn.prototype).clear = function() { this.c = 0, this.f = {}, this.b = this.a = null }, t.forEach = function(t, e) { for (var o = this.a; null !== o;) t.call(e, o.wc, o.ae, this), o = o.cb }, t.get = function(t) { return (t = this.f[t]) === this.b || (t === this.a ? (this.a = this.a.cb, this.a.Tb = null) : (t.cb.Tb = t.Tb, t.Tb.cb = t.cb), t.cb = null, t.Tb = this.b, this.b = this.b.cb = t), t.wc }, t.$b = function() { return this.c }, t.O = function() {
        var t, e = Array(this.c),
            o = 0;
        for (t = this.b; null !== t; t = t.Tb) e[o++] = t.ae;
        return e
    }, t.lb = function() {
        var t, e = Array(this.c),
            o = 0;
        for (t = this.b; null !== t; t = t.Tb) e[o++] = t.wc;
        return e
    }, t.pop = function() { var t = this.a; return delete this.f[t.ae], null !== t.cb && (t.cb.Tb = null), this.a = t.cb, null === this.a && (this.b = null), --this.c, t.wc }, t.set = function(t, e) {
        var o = { ae: t, cb: null, Tb: this.b, wc: e };
        null === this.b ? this.a = o : this.b.cb = o, this.b = o, this.f[t] = o, ++this.c
    }, A(Yn, Xn), A(Hn, Oe), Hn.prototype.ob = function() { return d(this).toString() }, Hn.prototype.i = function() { return this.a }, A(zn, Ve), (t = zn.prototype).ke = s, t.la = function() { return this.g }, t.ka = function() { return this.ba }, t.ma = function() { return this.j }, t.na = function() { return this.A };
    var $n = [0, 0, 0];

    function _n(t, e, o, i, r) { for (r = is(t, e, r), e = e[0] - 1; e >= t.minZoom;) { if (o.call(null, e, es(t, r, e, i))) return !0;--e } return !1 }

    function Qn(t, e, o, i) { return e[0] < t.maxZoom ? es(t, i = is(t, e, i), e[0] + 1, o) : null }

    function ts(t, e, o, i) {
        rs(t, e[0], e[1], o, !1, $n);
        var n = $n[1],
            s = $n[2];
        return rs(t, e[2], e[3], o, !0, $n), t = $n[1], e = $n[2], r(i) ? (i.a = n, i.f = t, i.b = s, i.c = e) : i = new Lr(n, t, s, e), i
    }

    function es(t, e, o, i) { return ts(t, e, t.ua(o), i) }

    function os(t, e) {
        var o = t.Kc(e[0]),
            i = t.ua(e[0]),
            r = qe(t.Ja(e[0]), t.f);
        return [o[0] + (e[1] + .5) * r[0] * i, o[1] + (e[2] + .5) * r[1] * i]
    }

    function is(t, e, o) {
        var i = t.Kc(e[0]),
            r = t.ua(e[0]);
        t = qe(t.Ja(e[0]), t.f);
        var n = i[0] + e[1] * t[0] * r;
        return Ro(n, e = i[1] + e[2] * t[1] * r, n + t[0] * r, e + t[1] * r, o)
    }

    function rs(t, e, o, i, r, n) {
        var s = ns(t, i),
            p = i / t.ua(s),
            a = t.Kc(s);
        return t = qe(t.Ja(s), t.f), e = p * Math.floor((e - a[0]) / i + (r ? .5 : 0)) / t[0], o = p * Math.floor((o - a[1]) / i + (r ? 0 : .5)) / t[1], r ? (e = Math.ceil(e) - 1, o = Math.ceil(o) - 1) : (e = Math.floor(e), o = Math.floor(o)), Tr(s, e, o, n)
    }

    function ns(t, e) { return Xt(Wt(t.a, e, 0), t.minZoom, t.maxZoom) }

    function ss(t) { var e = {}; return Pt(e, r(t) ? t : {}), r(e.extent) || (e.extent = gi("EPSG:3857").R()), e.resolutions = ps(e.extent, e.maxZoom, e.tileSize), delete e.maxZoom, new qn(e) }

    function ps(t, e, o) { e = r(e) ? e : 42; var i = Uo(t); for (t = Vo(t), o = qe(r(o) ? o : 256), o = Math.max(t / o[0], i / o[1]), e += 1, i = Array(e), t = 0; t < e; ++t) i[t] = o / Math.pow(2, t); return i }

    function as(t) { var e = (t = gi(t)).R(); return null === e && (e = Ro(-(t = 180 * ri.degrees / t.Nd()), -t, t, t)), e }

    function hs(t) { zn.call(this, { attributions: t.attributions, extent: t.extent, logo: t.logo, projection: t.projection, state: t.state, wrapX: t.wrapX }), this.aa = !!r(t.opaque) && t.opaque, this.fa = r(t.tilePixelRatio) ? t.tilePixelRatio : 1, this.tileGrid = r(t.tileGrid) ? t.tileGrid : null, this.b = new Yn, this.c = [0, 0] }

    function ls(t, e, o, i) {
        for (var r, n, s = !0, p = o.a; p <= o.f; ++p)
            for (var a = o.b; a <= o.c; ++a) r = t.kb(e, p, a), n = !1, Kn(t.b, r) && (n = 2 === (r = t.b.get(r)).state) && (n = !1 !== i(r)), n || (s = !1);
        return s
    }

    function us(t, e) {
        var o;
        if (null === t.tileGrid) {
            if (null === (i = e.l)) {
                var i = as(e),
                    n = r(void 0) ? void 0 : "top-left",
                    s = ps(i, void 0, void 0);
                "bottom-left" === n ? o = Do(i) : "bottom-right" === n ? o = Oo(i) : "top-left" === n ? o = Ko(i) : "top-right" === n && (o = Yo(i)), i = new qn({ extent: i, origin: o, resolutions: s, tileSize: void 0 }), e.l = i
            }
            o = i
        } else o = t.tileGrid;
        return o
    }

    function cs(t, e, o) { var i = us(t, o = r(o) ? o : t.j); return t.D && o.c && (e = Cr(e, i, o)), Rr(e, i) ? e : null }

    function ys(t, e) { re.call(this, t), this.tile = e }

    function fs(t) {
        t = r(t) ? t : {}, this.D = rn("UL"), this.u = rn("LI"), this.D.appendChild(this.u), En(this.u, !1), this.f = !r(t.collapsed) || t.collapsed, this.j = !r(t.collapsible) || t.collapsible, this.j || (this.f = !1);
        var e = r(t.className) ? t.className : "ol-attribution",
            o = r(t.tipLabel) ? t.tipLabel : "Attributions",
            i = r(t.collapseLabel) ? t.collapseLabel : "»";
        this.C = c(i) ? en("SPAN", {}, i) : i, i = r(t.label) ? t.label : "i", this.N = c(i) ? en("SPAN", {}, i) : i, Te(o = en("BUTTON", { type: "button", title: o }, this.j && !this.f ? this.C : this.N), "click", this.cl, !1, this),
            Te(o, ["mouseout", pe], (function() { this.blur() }), !1),
            e = en("DIV", e + " ol-unselectable ol-control" + (this.f && this.j ? " ol-collapsed" : "") + (this.j ? "" : " ol-uncollapsible"), this.D, o), Gn.call(this, { element: e, render: r(t.render) ? t.render : gs, target: t.target }), this.A = !0, this.l = {}, this.i = {}, this.ba = {}
    }

    function gs(t) {
        if (null === (t = t.frameState)) this.A && (En(this.element, !1), this.A = !1);
        else {
            var e, o, i, n, s, p, a, h, l, u, c, y, f = t.layerStatesArray,
                g = xt(t.attributions),
                v = {},
                b = t.viewState.projection;
            for (o = 0, e = f.length; o < e; o++)
                if (null !== (p = f[o].layer.da()) && (u = d(p).toString(), null !== (l = p.g)))
                    for (i = 0, n = l.length; i < n; i++)
                        if (!((h = d(a = l[i]).toString()) in g)) {
                            if (r(s = t.usedTiles[u])) {
                                var m = us(p, b);
                                t: {
                                    var w = b;
                                    if (null === (c = a).a) c = !0;
                                    else {
                                        var S = void 0,
                                            x = void 0,
                                            M = void 0,
                                            P = void 0;
                                        for (P in s)
                                            if (P in c.a) {
                                                var T;
                                                for (M = s[P], S = 0, x = c.a[P].length; S < x; ++S) {
                                                    if (kr(T = c.a[P][S], M)) { c = !0; break t }
                                                    var j = es(m, w.R(), parseInt(P, 10)),
                                                        A = Ir(j);
                                                    if ((M.a < j.a || M.f > j.f) && (kr(T, new Lr(Kt(M.a, A), Kt(M.f, A), M.b, M.c)) || Ir(M) > A && kr(T, j))) { c = !0; break t }
                                                }
                                            }
                                        c = !1
                                    }
                                }
                            } else c = !1;
                            c ? (h in v && delete v[h], g[h] = a) : v[h] = a
                        }
            for (var C in o = (e = [g, v])[0], e = e[1], this.l) C in o ? (this.i[C] || (En(this.l[C], !0), this.i[C] = !0), delete o[C]) : C in e ? (this.i[C] && (En(this.l[C], !1), delete this.i[C]), delete e[C]) : (an(this.l[C]), delete this.l[C], delete this.i[C]);
            for (C in o)(i = rn("LI")).innerHTML = o[C].b, this.D.appendChild(i), this.l[C] = i, this.i[C] = !0;
            for (C in e)(i = rn("LI")).innerHTML = e[C].b, En(i, !1), this.D.appendChild(i), this.l[C] = i;
            for (y in C = !vt(this.i) || !vt(t.logos), this.A != C && (En(this.element, C), this.A = C), C && vt(this.i) ? bn(this.element, "ol-logo-only") : mn(this.element, "ol-logo-only"), t = t.logos, C = this.ba) y in t || (an(C[y]), delete C[y]);
            for (var R in t) R in C || ((y = new Image).src = R, "" === (o = t[R]) ? o = y : (o = en("A", { href: o })).appendChild(y), this.u.appendChild(o), C[R] = o);
            En(this.u, !vt(t))
        }
    }

    function ds(t) { wn(t.element, "ol-collapsed"), t.f ? hn(t.C, t.N) : hn(t.N, t.C), t.f = !t.f }

    function vs(t) {
        t = r(t) ? t : {};
        var e = r(t.className) ? t.className : "ol-rotate",
            o = r(t.label) ? t.label : "⇧";
        this.f = null, c(o) ? this.f = en("SPAN", "ol-compass", o) : (this.f = o, bn(this.f, "ol-compass")), Te(o = en("BUTTON", { class: e + "-reset", type: "button", title: r(t.tipLabel) ? t.tipLabel : "Reset rotation" }, this.f), "click", vs.prototype.u, !1, this), Un(o), e = en("DIV", e + " ol-unselectable ol-control", o), Gn.call(this, { element: e, render: r(t.render) ? t.render : bs, target: t.target }), this.j = r(t.duration) ? t.duration : 250, this.i = !r(t.autoHide) || t.autoHide, this.l = void 0, this.i && bn(this.element, "ol-hidden")
    }

    function bs(t) {
        if (null !== (t = t.frameState)) {
            if ((t = t.viewState.rotation) != this.l) {
                var e = "rotate(" + 180 * t / Math.PI + "deg)";
                if (this.i) {
                    var o = this.element;
                    0 === t ? bn(o, "ol-hidden") : mn(o, "ol-hidden")
                }
                this.f.style.msTransform = e, this.f.style.webkitTransform = e, this.f.style.transform = e
            }
            this.l = t
        }
    }

    function ms(t) {
        t = r(t) ? t : {};
        var e = r(t.className) ? t.className : "ol-zoom",
            o = r(t.delta) ? t.delta : 1,
            i = r(t.zoomOutLabel) ? t.zoomOutLabel : "−",
            n = r(t.zoomOutTipLabel) ? t.zoomOutTipLabel : "Zoom out",
            s = en("BUTTON", { class: e + "-in", type: "button", title: r(t.zoomInTipLabel) ? t.zoomInTipLabel : "Zoom in" }, r(t.zoomInLabel) ? t.zoomInLabel : "+");
        Te(s, "click", x(ms.prototype.i, o), !1, this), Un(s), Te(i = en("BUTTON", { class: e + "-out", type: "button", title: n }, i), "click", x(ms.prototype.i, -o), !1, this), Te(i, ["mouseout", pe], (function() { this.blur() }), !1), e = en("DIV", e + " ol-unselectable ol-control", s, i), Gn.call(this, { element: e, target: t.target }), this.f = r(t.duration) ? t.duration : 250
    }

    function ws(t) { t = r(t) ? t : {}; var e = new Dr; return (!r(t.zoom) || t.zoom) && e.push(new ms(t.zoomOptions)), (!r(t.rotate) || t.rotate) && e.push(new vs(t.rotateOptions)), (!r(t.attribution) || t.attribution) && e.push(new fs(t.attributionOptions)), e }(t = qn.prototype).R = function() { return this.v }, t.eg = function() { return this.maxZoom }, t.fg = function() { return this.minZoom }, t.Kc = function(t) { return null === this.c ? this.g[t] : this.c }, t.ua = function(t) { return this.a[t] }, t.Xg = function() { return this.a }, t.jd = function(t, e, o) { return rs(this, t[0], t[1], e, !1, o) }, t.Rd = function(t, e, o) { return rs(this, t[0], t[1], this.ua(e), !1, o) }, t.Ja = function(t) { return null === this.l ? this.i[t] : this.l }, A(hs, zn), (t = hs.prototype).Kd = function() { return 0 }, t.kb = jr, t.za = function() { return this.tileGrid }, t.cc = function(t, e, o) { return Je(qe(us(this, o).Ja(t), this.c), this.fa, this.c) }, t.Ef = s, A(ys, re), A(fs, Gn), (t = fs.prototype).cl = function(t) { t.preventDefault(), ds(this) }, t.bl = function() { return this.j }, t.el = function(t) { this.j !== t && (this.j = t, wn(this.element, "ol-uncollapsible"), !t && this.f && ds(this)) }, t.dl = function(t) { this.j && this.f !== t && ds(this) }, t.al = function() { return this.f }, A(vs, Gn), vs.prototype.u = function(t) {
        t.preventDefault();
        var e = (t = this.b).X();
        if (null !== e) {
            for (var o = e.Ea(); o < -Math.PI;) o += 2 * Math.PI;
            for (; o > Math.PI;) o -= 2 * Math.PI;
            r(o) && (0 < this.j && t.Oa(Mr({ rotation: o, duration: this.j, easing: br })), e.fe(0))
        }
    }, A(ms, Gn), ms.prototype.i = function(t, e) {
        e.preventDefault();
        var o = this.b,
            i = o.X();
        if (null !== i) {
            var n = i.Da();
            r(n) && (0 < this.f && o.Oa(Pr({ resolution: n, duration: this.f, easing: br })), o = i.constrainResolution(n, t), i.Xb(o))
        }
    };
    var Ss, xs = Ct ? "webkitfullscreenchange" : At ? "mozfullscreenchange" : jt ? "MSFullscreenChange" : "fullscreenchange";

    function Ms() {
        var t = qr().a,
            e = t.body;
        return !!(e.webkitRequestFullscreen || e.mozRequestFullScreen && t.mozFullScreenEnabled || e.msRequestFullscreen && t.msFullscreenEnabled || e.requestFullscreen && t.fullscreenEnabled)
    }

    function Ps(t) { t.webkitRequestFullscreen ? t.webkitRequestFullscreen() : t.mozRequestFullScreen ? t.mozRequestFullScreen() : t.msRequestFullscreen ? t.msRequestFullscreen() : t.requestFullscreen && t.requestFullscreen() }

    function Ts() { var t = qr().a; return !!(t.webkitIsFullScreen || t.mozFullScreen || t.msFullscreenElement || t.fullscreenElement) }

    function js(t) {
        t = r(t) ? t : {}, this.f = r(t.className) ? t.className : "ol-full-screen";
        var e = r(t.label) ? t.label : "↔";
        this.i = c(e) ? document.createTextNode(String(e)) : e, e = r(t.labelActive) ? t.labelActive : "×", this.j = c(e) ? document.createTextNode(String(e)) : e, e = r(t.tipLabel) ? t.tipLabel : "Toggle full-screen", Te(e = en("BUTTON", { class: this.f + "-" + Ts(), type: "button", title: e }, this.i), "click", this.A, !1, this), Un(e), Te(i.document, xs, this.l, !1, this), e = en("DIV", this.f + " ol-unselectable ol-control " + (Ms() ? "" : "ol-unsupported"), e), Gn.call(this, { element: e, target: t.target }), this.u = !!r(t.keys) && t.keys
    }

    function As(t) {
        t = r(t) ? t : {};
        var e = en("DIV", r(t.className) ? t.className : "ol-mouse-position");
        Gn.call(this, { element: e, render: r(t.render) ? t.render : Cs, target: t.target }), Te(this, We("projection"), this.fl, !1, this), r(t.coordinateFormat) && this.vh(t.coordinateFormat), r(t.projection) && this.Eg(gi(t.projection)), this.u = r(t.undefinedHTML) ? t.undefinedHTML : "", this.l = e.innerHTML, this.j = this.i = this.f = null
    }

    function Cs(t) { null === (t = t.frameState) ? this.f = null : this.f != t.viewState.projection && (this.f = t.viewState.projection, this.i = null), Rs(this, this.j) }

    function Rs(t, e) {
        var o = t.u;
        if (null !== e && null !== t.f) {
            if (null === t.i) {
                var i = t.Dg();
                t.i = r(i) ? bi(t.f, i) : mi
            }
            null !== (i = t.b.ta(e)) && (t.i(i, i), o = r(o = t.$f()) ? o(i) : i.toString())
        }
        r(t.l) && o == t.l || (t.element.innerHTML = o, t.l = o)
    }

    function Ls(t, e, o) { Qt.call(this), this.f = t, this.c = o, this.a = e || window, this.b = S(this.Vf, this) }

    function Es(t) {
        if (null != t.ha) {
            var e = Is(t),
                o = ks(t);
            e && !o && t.a.mozRequestAnimationFrame ? Re(t.ha) : e && o ? o.call(t.a, t.ha) : t.a.clearTimeout(t.ha)
        }
        t.ha = null
    }

    function Is(t) { return (t = t.a).requestAnimationFrame || t.webkitRequestAnimationFrame || t.mozRequestAnimationFrame || t.oRequestAnimationFrame || t.msRequestAnimationFrame || null }

    function ks(t) { return (t = t.a).cancelAnimationFrame || t.cancelRequestAnimationFrame || t.webkitCancelRequestAnimationFrame || t.mozCancelRequestAnimationFrame || t.oCancelRequestAnimationFrame || t.msCancelRequestAnimationFrame || null }

    function Ns(t) { i.setTimeout((function() { throw t }), 0) }

    function Fs(t, e) {
        var o = t;
        e && (o = S(t, e)), o = Ds(o), !f(i.setImmediate) || i.Window && i.Window.prototype.setImmediate == i.setImmediate ? (Ss || (Ss = function() {
            var t = i.MessageChannel;
            if (void 0 === t && "undefined" != typeof window && window.postMessage && window.addEventListener && (t = function() {
                    (i = document.createElement("iframe")).style.display = "none", i.src = "", document.documentElement.appendChild(i);
                    var t = i.contentWindow;
                    (i = t.document).open(), i.write(""), i.close();
                    var e = "callImmediate" + Math.random(),
                        o = "file:" == t.location.protocol ? "*" : t.location.protocol + "//" + t.location.host,
                        i = S((function(t) { "*" != o && t.origin != o || t.data != e || this.port1.onmessage() }), this);
                    t.addEventListener("message", i, !1), this.port1 = {}, this.port2 = { postMessage: function() { t.postMessage(e, o) } }
                }), void 0 !== t && !ht("Trident") && !ht("MSIE")) {
                var e = new t,
                    o = {},
                    n = o;
                return e.port1.onmessage = function() {
                        if (r(o.next)) {
                            var t = (o = o.next).Rf;
                            o.Rf = null, t()
                        }
                    },
                    function(t) { n.next = { Rf: t }, n = n.next, e.port2.postMessage(0) }
            }
            return "undefined" != typeof document && "onreadystatechange" in document.createElement("script") ? function(t) {
                var e = document.createElement("script");
                e.onreadystatechange = function() { e.onreadystatechange = null, e.parentNode.removeChild(e), e = null, t(), t = null }, document.documentElement.appendChild(e)
            } : function(t) { i.setTimeout(t, 0) }
        }()), Ss(o)) : i.setImmediate(o)
    }
    A(js, Gn), js.prototype.A = function(t) { t.preventDefault(), Ms() && null !== (t = this.b) && (Ts() ? (t = qr().a).webkitCancelFullScreen ? t.webkitCancelFullScreen() : t.mozCancelFullScreen ? t.mozCancelFullScreen() : t.msExitFullscreen ? t.msExitFullscreen() : t.exitFullscreen && t.exitFullscreen() : (t = $r(t = t.jf()), this.u ? t.mozRequestFullScreenWithKeys ? t.mozRequestFullScreenWithKeys() : t.webkitRequestFullscreen ? t.webkitRequestFullscreen() : Ps(t) : Ps(t))) }, js.prototype.l = function() {
        var t = this.f + "-true",
            e = this.f + "-false",
            o = ln(this.element),
            i = this.b;
        Ts() ? (vn(o, e) && (mn(o, e), bn(o, t)), hn(this.j, this.i)) : (vn(o, t) && (mn(o, t), bn(o, e)), hn(this.i, this.j)), null === i || i.Rc()
    }, A(As, Gn), (t = As.prototype).fl = function() { this.i = null }, t.$f = function() { return this.get("coordinateFormat") }, t.Dg = function() { return this.get("projection") }, t.ak = function(t) { this.j = this.b.Jd(t.a), Rs(this, this.j) }, t.bk = function() { Rs(this, null), this.j = null }, t.setMap = function(t) { As.$.setMap.call(this, t), null !== t && (t = t.b, this.v.push(Te(t, "mousemove", this.ak, !1, this), Te(t, "mouseout", this.bk, !1, this))) }, t.vh = function(t) { this.set("coordinateFormat", t) }, t.Eg = function(t) { this.set("projection", t) }, A(Ls, Qt), (t = Ls.prototype).ha = null, t.Ff = !1, t.start = function() {
        Es(this), this.Ff = !1;
        var t = Is(this),
            e = ks(this);
        t && !e && this.a.mozRequestAnimationFrame ? (this.ha = Te(this.a, "MozBeforePaint", this.b), this.a.mozRequestAnimationFrame(null), this.Ff = !0) : this.ha = t && e ? t.call(this.a, this.b) : this.a.setTimeout(function(t) {
            var e;
            return e = e || 0,
                function() { return t.apply(this, Array.prototype.slice.call(arguments, 0, e)) }
        }(this.b), 20)
    }, t.Vf = function() { this.Ff && this.ha && Re(this.ha), this.ha = null, this.f.call(this.c, j()) }, t.W = function() { Es(this), Ls.$.W.call(this) };
    var Ds = Qo;

    function Os(t, e) { this.b = {}, this.a = [], this.c = 0; var o = arguments.length; if (1 < o) { if (o % 2) throw Error("Uneven number of arguments"); for (var i = 0; i < o; i += 2) this.set(arguments[i], arguments[i + 1]) } else if (t) { t instanceof Os ? (o = t.O(), i = t.lb()) : (o = yt(t), i = ct(t)); for (var r = 0; r < o.length; r++) this.set(o[r], i[r]) } }

    function Bs(t) {
        if (t.c != t.a.length) {
            for (var e = 0, o = 0; e < t.a.length;) {
                var i = t.a[e];
                Gs(t.b, i) && (t.a[o++] = i), e++
            }
            t.a.length = o
        }
        if (t.c != t.a.length) {
            var r = {};
            for (o = e = 0; e < t.a.length;) Gs(r, i = t.a[e]) || (t.a[o++] = i, r[i] = 1), e++;
            t.a.length = o
        }
    }

    function Gs(t, e) { return Object.prototype.hasOwnProperty.call(t, e) }

    function Us() { this.a = j() }

    function Xs(t) { Oe.call(this), this.wd = t || window, this.Sd = Te(this.wd, "resize", this.jk, !1, this), this.Td = tn(this.wd || window) }

    function Ks(t) {
        if (48 <= t && 57 >= t || 96 <= t && 106 >= t || 65 <= t && 90 >= t || Ct && 0 == t) return !0;
        switch (t) {
            case 32:
            case 63:
            case 107:
            case 109:
            case 110:
            case 111:
            case 186:
            case 59:
            case 189:
            case 187:
            case 61:
            case 188:
            case 190:
            case 191:
            case 192:
            case 222:
            case 219:
            case 220:
            case 221:
                return !0;
            default:
                return !1
        }
    }

    function Ys(t) {
        if (At) t = function(t) {
            switch (t) {
                case 61:
                    return 187;
                case 59:
                    return 186;
                case 173:
                    return 189;
                case 224:
                    return 91;
                case 0:
                    return 224;
                default:
                    return t
            }
        }(t);
        else if (Rt && Ct) t: switch (t) {
            case 93:
                t = 91;
                break t
        }
        return t
    }

    function Vs(t, e) { Oe.call(this), t && Js(this, t, e) }(t = Os.prototype).$b = function() { return this.c }, t.lb = function() { Bs(this); for (var t = [], e = 0; e < this.a.length; e++) t.push(this.b[this.a[e]]); return t }, t.O = function() { return Bs(this), this.a.concat() }, t.wa = function() { return 0 == this.c }, t.clear = function() { this.b = {}, this.c = this.a.length = 0 }, t.remove = function(t) { return !!Gs(this.b, t) && (delete this.b[t], this.c--, this.a.length > 2 * this.c && Bs(this), !0) }, t.get = function(t, e) { return Gs(this.b, t) ? this.b[t] : e }, t.set = function(t, e) { Gs(this.b, t) || (this.c++, this.a.push(t)), this.b[t] = e }, t.forEach = function(t, e) {
        for (var o = this.O(), i = 0; i < o.length; i++) {
            var r = o[i],
                n = this.get(r);
            t.call(e, n, r, this)
        }
    }, t.clone = function() { return new Os(this) }, new Us, Us.prototype.set = function(t) { this.a = t }, Us.prototype.get = function() { return this.a }, A(Xs, Oe), (t = Xs.prototype).Sd = null, t.wd = null, t.Td = null, t.W = function() { Xs.$.W.call(this), this.Sd && (Re(this.Sd), this.Sd = null), this.Td = this.wd = null }, t.jk = function() {
        var t = tn(this.wd || window),
            e = this.Td;
        t == e || t && e && t.width == e.width && t.height == e.height || (this.Td = t, Be(this, "resize"))
    }, A(Vs, Oe), (t = Vs.prototype).kd = null, t.Zd = null, t.cf = null, t.$d = null, t.Qa = -1, t.Ob = -1, t.Je = !1;
    var Hs = { 3: 13, 12: 144, 63232: 38, 63233: 40, 63234: 37, 63235: 39, 63236: 112, 63237: 113, 63238: 114, 63239: 115, 63240: 116, 63241: 117, 63242: 118, 63243: 119, 63244: 120, 63245: 121, 63246: 122, 63247: 123, 63248: 44, 63272: 46, 63273: 36, 63275: 35, 63276: 33, 63277: 34, 63289: 144, 63302: 45 },
        Ws = { Up: 38, Down: 40, Left: 37, Right: 39, Enter: 13, F1: 112, F2: 113, F3: 114, F4: 115, F5: 116, F6: 117, F7: 118, F8: 119, F9: 120, F10: 121, F11: 122, F12: 123, "U+007F": 46, Home: 36, End: 35, PageUp: 33, PageDown: 34, Insert: 45 },
        zs = jt || Ct && Ot("525"),
        Zs = Rt && At;

    function Js(t, e, o) { t.$d && qs(t), t.kd = e, t.Zd = Te(t.kd, "keypress", t, o), t.cf = Te(t.kd, "keydown", t.a, o, t), t.$d = Te(t.kd, "keyup", t.b, o, t) }

    function qs(t) { t.Zd && (Re(t.Zd), Re(t.cf), Re(t.$d), t.Zd = null, t.cf = null, t.$d = null), t.kd = null, t.Qa = -1, t.Ob = -1 }

    function $s(t, e, o, i) { he.call(this, i), this.type = "key", this.g = t, this.B = e }

    function _s(t, e) {
        Oe.call(this);
        var o = this.a = t;
        (o = g(o) && 1 == o.nodeType ? this.a : this.a ? this.a.body : null) && Pn(o, "direction"), this.b = Te(this.a, At ? "DOMMouseScroll" : "mousewheel", this, e)
    }

    function Qs(t, e) { return Ct && (Rt || Et) && 0 != t % e ? t : t / e }

    function tp(t, e, o, i) { he.call(this, e), this.type = "mousewheel", this.detail = t, this.u = i }

    function ep(t, e, o) {
        re.call(this, t), this.a = e, t = r(o) ? o : {}, this.buttons = function(t) {
            if (t.buttons || op) t = t.buttons;
            else switch (t.which) {
                case 1:
                    t = 1;
                    break;
                case 2:
                    t = 4;
                    break;
                case 3:
                    t = 2;
                    break;
                default:
                    t = 0
            }
            return t
        }(t), this.pressure = function(t, e) { return t.pressure ? t.pressure : e ? .5 : 0 }(t, this.buttons), this.bubbles = wt(t, "bubbles", !1), this.cancelable = wt(t, "cancelable", !1), this.view = wt(t, "view", null), this.detail = wt(t, "detail", null), this.screenX = wt(t, "screenX", 0), this.screenY = wt(t, "screenY", 0), this.clientX = wt(t, "clientX", 0), this.clientY = wt(t, "clientY", 0), this.button = wt(t, "button", 0), this.relatedTarget = wt(t, "relatedTarget", null), this.pointerId = wt(t, "pointerId", 0), this.width = wt(t, "width", 0), this.height = wt(t, "height", 0), this.pointerType = wt(t, "pointerType", ""), this.isPrimary = wt(t, "isPrimary", !1), e.preventDefault && (this.preventDefault = function() { e.preventDefault() })
    }
    Vs.prototype.a = function(t) {
        Ct && (17 == this.Qa && !t.l || 18 == this.Qa && !t.b || Rt && 91 == this.Qa && !t.v) && (this.Ob = this.Qa = -1), -1 == this.Qa && (t.l && 17 != t.g ? this.Qa = 17 : t.b && 18 != t.g ? this.Qa = 18 : t.v && 91 != t.g && (this.Qa = 91)), zs && ! function(t, e, o, i, r) {
            if (!(jt || Ct && Ot("525"))) return !0;
            if (Rt && r) return Ks(t);
            if (r && !i) return !1;
            if (y(e) && (e = Ys(e)), !o && (17 == e || 18 == e || Rt && 91 == e)) return !1;
            if (Ct && i && o) switch (t) {
                case 220:
                case 219:
                case 221:
                case 192:
                case 186:
                case 189:
                case 187:
                case 188:
                case 190:
                case 191:
                case 192:
                case 222:
                    return !1
            }
            if (jt && i && e == t) return !1;
            switch (t) {
                case 13:
                    return !0;
                case 27:
                    return !Ct
            }
            return Ks(t)
        }(t.g, this.Qa, t.f, t.l, t.b) ? this.handleEvent(t) : (this.Ob = Ys(t.g), Zs && (this.Je = t.b))
    }, Vs.prototype.b = function(t) { this.Ob = this.Qa = -1, this.Je = t.b }, Vs.prototype.handleEvent = function(t) {
        var e, o, i = t.a,
            r = i.altKey;
        jt && "keypress" == t.type ? o = 13 != (e = this.Ob) && 27 != e ? i.keyCode : 0 : Ct && "keypress" == t.type ? (e = this.Ob, o = 0 <= i.charCode && 63232 > i.charCode && Ks(e) ? i.charCode : 0) : Tt ? o = Ks(e = this.Ob) ? i.keyCode : 0 : (e = i.keyCode || this.Ob, o = i.charCode || 0, Zs && (r = this.Je), Rt && 63 == o && 224 == e && (e = 191));
        var n = e = Ys(e),
            s = i.keyIdentifier;
        e ? 63232 <= e && e in Hs ? n = Hs[e] : 25 == e && t.f && (n = 9) : s && s in Ws && (n = Ws[s]), this.Qa = n, (t = new $s(n, o, 0, i)).b = r, Be(this, t)
    }, Vs.prototype.W = function() { Vs.$.W.call(this), qs(this) }, A($s, he), A(_s, Oe), _s.prototype.handleEvent = function(t) {
        var e = 0,
            o = 0,
            i = 0;
        "mousewheel" == (t = t.a).type ? (o = 1, (jt || Ct && (Lt || Ot("532.0"))) && (o = 40), i = Qs(-t.wheelDelta, o), r(t.wheelDeltaX) ? (e = Qs(-t.wheelDeltaX, o), o = Qs(-t.wheelDeltaY, o)) : o = i) : (100 < (i = t.detail) ? i = 3 : -100 > i && (i = -3), r(t.axis) && t.axis === t.HORIZONTAL_AXIS ? e = i : o = i), y(this.c) && Xt(e, -this.c, this.c), y(this.f) && (o = Xt(o, -this.f, this.f)), Be(this, e = new tp(i, t, 0, o))
    }, _s.prototype.W = function() { _s.$.W.call(this), Re(this.b), this.b = null }, A(tp, he), A(ep, re);
    var op = !1;
    try { op = 1 === new MouseEvent("click", { buttons: 1 }).buttons } catch (t) {}

    function ip(t, e) { var o = rn("CANVAS"); return r(t) && (o.width = t), r(e) && (o.height = e), o.getContext("2d") }
    var rp = function() {
            var t;
            return function() {
                if (!r(t))
                    if (i.getComputedStyle) {
                        var e, o = rn("P"),
                            n = { webkitTransform: "-webkit-transform", OTransform: "-o-transform", msTransform: "-ms-transform", MozTransform: "-moz-transform", transform: "transform" };
                        for (var s in document.body.appendChild(o), n) s in o.style && (o.style[s] = "translate(1px,1px)", e = i.getComputedStyle(o).getPropertyValue(n[s]));
                        an(o), t = e && "none" !== e
                    } else t = !1;
                return t
            }
        }(),
        np = function() {
            var t;
            return function() {
                if (!r(t))
                    if (i.getComputedStyle) {
                        var e, o = rn("P"),
                            n = { webkitTransform: "-webkit-transform", OTransform: "-o-transform", msTransform: "-ms-transform", MozTransform: "-moz-transform", transform: "transform" };
                        for (var s in document.body.appendChild(o), n) s in o.style && (o.style[s] = "translate3d(1px,1px,1px)", e = i.getComputedStyle(o).getPropertyValue(n[s]));
                        an(o), t = e && "none" !== e
                    } else t = !1;
                return t
            }
        }();

    function sp(t, e) {
        var o = t.style;
        o.WebkitTransform = e, o.MozTransform = e, o.a = e, o.msTransform = e, o.transform = e, jt && !Ut && (t.style.transformOrigin = "0 0")
    }

    function pp(t, e) {
        var o;
        if (np()) {
            if (r(6)) {
                var i = Array(16);
                for (o = 0; 16 > o; ++o) i[o] = e[o].toFixed(6);
                o = i.join(",")
            } else o = e.join(",");
            sp(t, "matrix3d(" + o + ")")
        } else if (rp()) {
            if (i = [e[0], e[1], e[4], e[5], e[12], e[13]], r(6)) {
                var n = Array(6);
                for (o = 0; 6 > o; ++o) n[o] = i[o].toFixed(6);
                o = n.join(",")
            } else o = i.join(",");
            sp(t, "matrix(" + o + ")")
        } else t.style.left = Math.round(e[12]) + "px", t.style.top = Math.round(e[13]) + "px"
    }
    var ap = ["experimental-webgl", "webgl", "webkit-3d", "moz-webgl"];

    function hp(t, e) {
        var o, i, r = ap.length;
        for (i = 0; i < r; ++i) try { if (null !== (o = t.getContext(ap[i], e))) return o } catch (t) {}
        return null
    }
    var lp, up, cp = i.devicePixelRatio || 1,
        yp = !1,
        fp = function() { if (!("HTMLCanvasElement" in i)) return !1; try { var t = ip(); return null !== t && (r(t.setLineDash) && (yp = !0), !0) } catch (t) { return !1 } }(),
        gp = "DeviceOrientationEvent" in i,
        dp = "geolocation" in i.navigator,
        vp = "ontouchstart" in i,
        bp = "PointerEvent" in i,
        mp = !!i.navigator.msPointerEnabled,
        wp = !1,
        Sp = [];
    if ("WebGLRenderingContext" in i) try {
        var xp = hp(rn("CANVAS"), { failIfMajorPerformanceCaveat: !0 });
        null !== xp && (wp = !0, up = xp.getParameter(xp.MAX_TEXTURE_SIZE), Sp = xp.getSupportedExtensions())
    } catch (t) {}

    function Mp(t, e) { this.a = t, this.g = e }

    function Pp(t) { Mp.call(this, t, { mousedown: this.vk, mousemove: this.wk, mouseup: this.zk, mouseover: this.yk, mouseout: this.xk }), this.b = t.b, this.c = [] }

    function Tp(t, e) { for (var o, i = t.c, r = e.clientX, n = e.clientY, s = 0, p = i.length; s < p && (o = i[s]); s++) { var a = Math.abs(n - o[1]); if (25 >= Math.abs(r - o[0]) && 25 >= a) return !0 } return !1 }

    function jp(t) {
        var e = Bp(t, t.a),
            o = e.preventDefault;
        return e.preventDefault = function() { t.preventDefault(), o() }, e.pointerId = 1, e.isPrimary = !0, e.pointerType = "mouse", e
    }

    function Ap(t) { Mp.call(this, t, { MSPointerDown: this.Ek, MSPointerMove: this.Fk, MSPointerUp: this.Ik, MSPointerOut: this.Gk, MSPointerOver: this.Hk, MSPointerCancel: this.Dk, MSGotPointerCapture: this.Bk, MSLostPointerCapture: this.Ck }), this.b = t.b, this.c = ["", "unavailable", "touch", "pen", "mouse"] }

    function Cp(t, e) { var o = e; return y(e.a.pointerType) && ((o = Bp(e, e.a)).pointerType = t.c[e.a.pointerType]), o }

    function Rp(t) { Mp.call(this, t, { pointerdown: this.kn, pointermove: this.ln, pointerup: this.pn, pointerout: this.mn, pointerover: this.nn, pointercancel: this.jn, gotpointercapture: this.Ij, lostpointercapture: this.uk }) }

    function Lp(t, e) { Mp.call(this, t, { touchstart: this.po, touchmove: this.oo, touchend: this.no, touchcancel: this.mo }), this.b = t.b, this.j = e, this.c = void 0, this.i = 0, this.f = void 0 }

    function Ep(t, e, o) { return (e = Bp(e, o)).pointerId = o.identifier + 2, e.bubbles = !0, e.cancelable = !0, e.detail = t.i, e.button = 0, e.buttons = 1, e.width = o.webkitRadiusX || o.radiusX || 0, e.height = o.webkitRadiusY || o.radiusY || 0, e.pressure = o.webkitForce || o.force || .5, e.isPrimary = t.c === o.identifier, e.pointerType = "touch", e.clientX = o.clientX, e.clientY = o.clientY, e.screenX = o.screenX, e.screenY = o.screenY, e }

    function Ip(t, e, o) {
        function i() { e.preventDefault() }
        var r, n, s = Array.prototype.slice.call(e.a.changedTouches),
            p = s.length;
        for (r = 0; r < p; ++r)(n = Ep(t, e, s[r])).preventDefault = i, o.call(t, e, n)
    }

    function kp(t, e) {
        var o = t.j.c,
            r = e.a.changedTouches[0];
        if (t.c === r.identifier) {
            var n = [r.clientX, r.clientY];
            o.push(n), i.setTimeout((function() { $(o, n) }), 2500)
        }
    }

    function Np(t) { Oe.call(this), this.f = t, this.b = {}, this.c = {}, this.a = [], bp ? Fp(this, new Rp(this)) : mp ? Fp(this, new Ap(this)) : (Fp(this, t = new Pp(this)), vp && Fp(this, new Lp(this, t))), t = this.a.length; for (var e = 0; e < t; e++) Dp(this, yt(this.a[e].g)) }

    function Fp(t, e) {
        var o = yt(e.g);
        o && (H(o, (function(t) {
            var o = e.g[t];
            o && (this.c[t] = S(o, e))
        }), t), t.a.push(e))
    }

    function Dp(t, e) { H(e, (function(t) { Te(this.f, t, this.g, !1, this) }), t) }

    function Op(t, e) { H(e, (function(t) { Ce(this.f, t, this.g, !1, this) }), t) }

    function Bp(t, e) { for (var o, i = {}, r = 0, n = $p.length; r < n; r++) i[o = $p[r][0]] = t[o] || e[o] || $p[r][1]; return i }

    function Gp(t, e, o) {
        t.kc(e, o);
        var i = e.relatedTarget;
        null !== i && un(e.target, i) || (e.bubbles = !1, Xp(t, Jp, e, o))
    }

    function Up(t, e, o) {
        e.bubbles = !0, Xp(t, Wp, e, o);
        var i = e.relatedTarget;
        null !== i && un(e.target, i) || (e.bubbles = !1, Xp(t, Zp, e, o))
    }

    function Xp(t, e, o, i) { Be(t, new ep(e, i, o)) }

    function Kp(t, e) { Be(t, new ep(e.type, e, e.a)) }
    lp = wp, P = Sp, M = up, A(Pp, Mp), (t = Pp.prototype).vk = function(t) {
        if (!Tp(this, t)) {
            1..toString() in this.b && this.cancel(t);
            var e = jp(t);
            this.b[1..toString()] = t, Xp(this.a, Vp, e, t)
        }
    }, t.wk = function(t) {
        if (!Tp(this, t)) {
            var e = jp(t);
            Xp(this.a, Yp, e, t)
        }
    }, t.zk = function(t) {
        if (!Tp(this, t)) {
            var e = this.b[1..toString()];
            e && e.button === t.button && (e = jp(t), Xp(this.a, Hp, e, t), mt(this.b, 1..toString()))
        }
    }, t.yk = function(t) {
        if (!Tp(this, t)) {
            var e = jp(t);
            Up(this.a, e, t)
        }
    }, t.xk = function(t) {
        if (!Tp(this, t)) {
            var e = jp(t);
            Gp(this.a, e, t)
        }
    }, t.cancel = function(t) {
        var e = jp(t);
        this.a.cancel(e, t), mt(this.b, 1..toString())
    }, A(Ap, Mp), (t = Ap.prototype).Ek = function(t) {
        this.b[t.a.pointerId] = t;
        var e = Cp(this, t);
        Xp(this.a, Vp, e, t)
    }, t.Fk = function(t) {
        var e = Cp(this, t);
        Xp(this.a, Yp, e, t)
    }, t.Ik = function(t) {
        var e = Cp(this, t);
        Xp(this.a, Hp, e, t), mt(this.b, t.a.pointerId)
    }, t.Gk = function(t) {
        var e = Cp(this, t);
        Gp(this.a, e, t)
    }, t.Hk = function(t) {
        var e = Cp(this, t);
        Up(this.a, e, t)
    }, t.Dk = function(t) {
        var e = Cp(this, t);
        this.a.cancel(e, t), mt(this.b, t.a.pointerId)
    }, t.Ck = function(t) { Be(this.a, new ep("lostpointercapture", t, t.a)) }, t.Bk = function(t) { Be(this.a, new ep("gotpointercapture", t, t.a)) }, A(Rp, Mp), (t = Rp.prototype).kn = function(t) { Kp(this.a, t) }, t.ln = function(t) { Kp(this.a, t) }, t.pn = function(t) { Kp(this.a, t) }, t.mn = function(t) { Kp(this.a, t) }, t.nn = function(t) { Kp(this.a, t) }, t.jn = function(t) { Kp(this.a, t) }, t.uk = function(t) { Kp(this.a, t) }, t.Ij = function(t) { Kp(this.a, t) }, A(Lp, Mp), (t = Lp.prototype).rh = function() { this.i = 0, this.f = void 0 }, t.po = function(t) {
        var e = t.a.touches,
            o = yt(this.b),
            n = o.length;
        if (n >= e.length) {
            var s, p, a, h = [];
            for (s = 0; s < n; ++s) {
                var l;
                if (p = o[s], a = this.b[p], !(l = 1 == p)) t: {
                    l = e.length;
                    for (var u = 0; u < l; u++)
                        if (e[u].identifier === p - 2) { l = !0; break t }
                    l = !1
                }
                l || h.push(a.kc)
            }
            for (s = 0; s < h.length; ++s) this.Ke(t, h[s])
        }(0 === (e = ut(this.b)) || 1 === e && 1..toString() in this.b) && (this.c = t.a.changedTouches[0].identifier, r(this.f) && i.clearTimeout(this.f)), kp(this, t), this.i++, Ip(this, t, this.en)
    }, t.en = function(t, e) {
        this.b[e.pointerId] = { target: e.target, kc: e, ah: e.target };
        var o = this.a;
        e.bubbles = !0, Xp(o, Wp, e, t), o = this.a, e.bubbles = !1, Xp(o, Zp, e, t), Xp(this.a, Vp, e, t)
    }, t.oo = function(t) { t.preventDefault(), Ip(this, t, this.Ak) }, t.Ak = function(t, e) {
        var o = this.b[e.pointerId];
        if (o) {
            var i = o.kc,
                r = o.ah;
            Xp(this.a, Yp, e, t), i && r !== e.target && (i.relatedTarget = e.target, e.relatedTarget = r, i.target = r, e.target ? (Gp(this.a, i, t), Up(this.a, e, t)) : (e.target = r, e.relatedTarget = null, this.Ke(t, e))), o.kc = e, o.ah = e.target
        }
    }, t.no = function(t) { kp(this, t), Ip(this, t, this.qo) }, t.qo = function(t, e) {
        Xp(this.a, Hp, e, t), this.a.kc(e, t);
        var o = this.a;
        e.bubbles = !1, Xp(o, Jp, e, t), mt(this.b, e.pointerId), e.isPrimary && (this.c = void 0, this.f = i.setTimeout(S(this.rh, this), 200))
    }, t.mo = function(t) { Ip(this, t, this.Ke) }, t.Ke = function(t, e) {
        this.a.cancel(e, t), this.a.kc(e, t);
        var o = this.a;
        e.bubbles = !1, Xp(o, Jp, e, t), mt(this.b, e.pointerId), e.isPrimary && (this.c = void 0, this.f = i.setTimeout(S(this.rh, this), 200))
    }, A(Np, Oe), Np.prototype.g = function(t) {
        var e = this.c[t.type];
        e && e(t)
    }, Np.prototype.kc = function(t, e) { t.bubbles = !0, Xp(this, zp, t, e) }, Np.prototype.cancel = function(t, e) { Xp(this, qp, t, e) }, Np.prototype.W = function() {
        for (var t = this.a.length, e = 0; e < t; e++) Op(this, yt(this.a[e].g));
        Np.$.W.call(this)
    };
    var Yp = "pointermove",
        Vp = "pointerdown",
        Hp = "pointerup",
        Wp = "pointerover",
        zp = "pointerout",
        Zp = "pointerenter",
        Jp = "pointerleave",
        qp = "pointercancel",
        $p = [
            ["bubbles", !1],
            ["cancelable", !1],
            ["view", null],
            ["detail", null],
            ["screenX", 0],
            ["screenY", 0],
            ["clientX", 0],
            ["clientY", 0],
            ["ctrlKey", !1],
            ["altKey", !1],
            ["shiftKey", !1],
            ["metaKey", !1],
            ["button", 0],
            ["relatedTarget", null],
            ["buttons", 0],
            ["pointerId", 0],
            ["width", 0],
            ["height", 0],
            ["pressure", 0],
            ["tiltX", 0],
            ["tiltY", 0],
            ["pointerType", ""],
            ["hwTimestamp", 0],
            ["isPrimary", !1],
            ["type", ""],
            ["target", null],
            ["currentTarget", null],
            ["which", 0]
        ];

    function _p(t, e, o, i, n) { Bn.call(this, t, e, n), this.a = o, this.originalEvent = o.a, this.pixel = e.Jd(this.originalEvent), this.coordinate = e.ta(this.pixel), this.dragging = !!r(i) && i }

    function Qp(t, e, o, i, r) { _p.call(this, t, e, o.a, i, r), this.b = o }

    function ta(t) { Oe.call(this), this.c = t, this.i = 0, this.j = !1, this.b = this.l = this.f = null, t = this.c.b, this.u = 0, this.v = {}, this.g = new Np(t), this.a = null, this.l = Te(this.g, Vp, this.ek, !1, this), this.B = Te(this.g, Yp, this.Hn, !1, this) }

    function ea(t, e) { e.type == aa || e.type == ha ? delete t.v[e.pointerId] : e.type == pa && (t.v[e.pointerId] = !0), t.u = ut(t.v) }
    A(_p, Bn), _p.prototype.preventDefault = function() { _p.$.preventDefault.call(this), this.a.preventDefault() }, _p.prototype.nb = function() { _p.$.nb.call(this), this.a.nb() }, A(Qp, _p), A(ta, Oe), (t = ta.prototype).og = function(t) { ea(this, t), Be(this, new Qp(aa, this.c, t)), !this.j && 0 === t.button && function(t, e) { Be(t, new Qp(ia, t.c, e)), 0 !== t.i ? (i.clearTimeout(t.i), t.i = 0, Be(t, new Qp(ra, t.c, e))) : t.i = i.setTimeout(S((function() { this.i = 0, Be(this, new Qp(oa, this.c, e)) }), t), 250) }(this, this.b), 0 === this.u && (H(this.f, Re), this.f = null, this.j = !1, this.b = null, ie(this.a), this.a = null) }, t.ek = function(t) { ea(this, t), Be(this, new Qp(pa, this.c, t)), this.b = t, null === this.f && (this.a = new Np(document), this.f = [Te(this.a, sa, this.Wk, !1, this), Te(this.a, aa, this.og, !1, this), Te(this.g, ha, this.og, !1, this)]) }, t.Wk = function(t) { t.clientX == this.b.clientX && t.clientY == this.b.clientY || (this.j = !0, Be(this, new Qp(na, this.c, t, this.j))), t.preventDefault() }, t.Hn = function(t) { Be(this, new Qp(t.type, this.c, t, null !== this.b && (t.clientX != this.b.clientX || t.clientY != this.b.clientY))) }, t.W = function() { null !== this.B && (Re(this.B), this.B = null), null !== this.l && (Re(this.l), this.l = null), null !== this.f && (H(this.f, Re), this.f = null), null !== this.a && (ie(this.a), this.a = null), null !== this.g && (ie(this.g), this.g = null), ta.$.W.call(this) };
    var oa = "singleclick",
        ia = "click",
        ra = "dblclick",
        na = "pointerdrag",
        sa = "pointermove",
        pa = "pointerdown",
        aa = "pointerup",
        ha = "pointercancel",
        la = { Ho: oa, wo: ia, xo: ra, Ao: na, Do: sa, zo: pa, Go: aa, Fo: "pointerover", Eo: "pointerout", Bo: "pointerenter", Co: "pointerleave", yo: ha };

    function ua(t) {
        Ve.call(this);
        var e = xt(t);
        e.brightness = r(t.brightness) ? t.brightness : 0, e.contrast = r(t.contrast) ? t.contrast : 1, e.hue = r(t.hue) ? t.hue : 0, e.opacity = r(t.opacity) ? t.opacity : 1, e.saturation = r(t.saturation) ? t.saturation : 1, e.visible = !r(t.visible) || t.visible, e.maxResolution = r(t.maxResolution) ? t.maxResolution : 1 / 0, e.minResolution = r(t.minResolution) ? t.minResolution : 0, this.I(e)
    }

    function ca(t) {
        var e = t.Ib(),
            o = t.Jb(),
            i = t.Kb(),
            r = t.Rb(),
            n = t.Nb(),
            s = t.af(),
            p = t.mb(),
            a = t.R(),
            h = t.Lb(),
            l = t.Mb();
        return { layer: t, brightness: Xt(e, -1, 1), contrast: Math.max(o, 0), hue: i, opacity: Xt(r, 0, 1), saturation: Math.max(n, 0), l: s, visible: p, Pb: !0, extent: a, maxResolution: h, minResolution: Math.max(l, 0) }
    }

    function ya() {}

    function fa(t, e, o, i, r, n) { re.call(this, t, e), this.vectorContext = o, this.frameState = i, this.context = r, this.glContext = n }

    function ga(t) {
        var e = xt(t);
        delete e.source, ua.call(this, e), this.i = this.N = this.C = null, r(t.map) && this.setMap(t.map), Te(this, We("source"), this.lk, !1, this), this.Qc(r(t.source) ? t.source : null)
    }

    function da(t, e) { return t.visible && e >= t.minResolution && e < t.maxResolution }

    function va(t, e, o, i, r) { Oe.call(this), this.i = r, this.extent = t, this.g = o, this.resolution = e, this.state = i }

    function ba(t, e, o, i, r, n, s, p) { return yo(t), 0 === e && 0 === o || vo(t, e, o), 1 == i && 1 == r || bo(t, i, r), 0 !== n && mo(t, n), 0 === s && 0 === p || vo(t, s, p), t }

    function ma(t, e) { return t[0] == e[0] && t[1] == e[1] && t[4] == e[4] && t[5] == e[5] && t[12] == e[12] && t[13] == e[13] }

    function wa(t, e, o) {
        var i = t[1],
            r = t[5],
            n = t[13],
            s = e[0];
        return e = e[1], o[0] = t[0] * s + t[4] * e + t[12], o[1] = i * s + r * e + n, o
    }

    function Sa(t) { Xe.call(this), this.b = t }

    function xa(t, e) { var o = e.state; return 2 != o && 3 != o && Te(e, "change", t.Ll, !1, t), 0 == o && (e.load(), o = e.state), 2 == o }

    function Ma(t) {
        var e = t.b;
        e.mb() && "ready" == e.af() && t.s()
    }

    function Pa(t, e) { Vn(e.b) && t.postRenderFunctions.push(x((function(t, e, o) { e = d(t).toString(), t = t.b, o = o.usedTiles[e]; for (var i; Vn(t) && (!((i = (e = t.a.wc).a[0].toString()) in o) || !o[i].contains(e.a));) t.pop().dd() }), e)) }

    function Ta(t, e) {
        var o, i, r;
        if (null != e)
            for (i = 0, r = e.length; i < r; ++i) t[d(o = e[i]).toString()] = o
    }

    function ja(t, e) {
        var o = e.ba;
        r(o) && (c(o) ? t.logos[o] = "" : g(o) && (t.logos[o.src] = o.href))
    }

    function Aa(t, e, o, i) { e = d(e).toString(), o = o.toString(), e in t ? o in t[e] ? (t = t[e][o], i.a < t.a && (t.a = i.a), i.f > t.f && (t.f = i.f), i.b < t.b && (t.b = i.b), i.c > t.c && (t.c = i.c)) : t[e][o] = i : (t[e] = {}, t[e][o] = i) }

    function Ca(t, e, o) { return [e * (Math.round(t[0] / e) + o[0] % 2 / 2), e * (Math.round(t[1] / e) + o[1] % 2 / 2)] }

    function Ra(t, e, o, i, n, s, p, a, h, l) {
        var u = d(e).toString();
        u in t.wantedTiles || (t.wantedTiles[u] = {});
        var c = t.wantedTiles[u];
        t = t.tileQueue;
        var y, f, g, v, b, m, w = o.minZoom;
        for (m = p; m >= w; --m)
            for (f = es(o, s, m, f), g = o.ua(m), v = f.a; v <= f.f; ++v)
                for (b = f.b; b <= f.c; ++b) p - m <= a ? (0 == (y = e.bc(m, v, b, i, n)).state && (c[Ar(y.a)] = !0, y.ob() in t.c || Xa(t, [y, u, os(o, y.a), g])), r(h) && h.call(l, y)) : e.Ef(m, v, b)
    }

    function La(t) { this.A = t.opacity, this.D = t.rotateWithView, this.B = t.rotation, this.v = t.scale, this.ea = t.snapToPixel }

    function Ea(t) {
        t = r(t) ? t : {}, this.g = r(t.anchor) ? t.anchor : [.5, .5], this.f = null, this.b = r(t.anchorOrigin) ? t.anchorOrigin : "top-left", this.j = r(t.anchorXUnits) ? t.anchorXUnits : "fraction", this.l = r(t.anchorYUnits) ? t.anchorYUnits : "fraction";
        var e = r(t.crossOrigin) ? t.crossOrigin : null,
            o = r(t.img) ? t.img : null,
            i = r(t.imgSize) ? t.imgSize : null,
            n = t.src;
        r(n) && 0 !== n.length || null === o || (n = o.src);
        var s = r(t.src) ? 0 : 2,
            p = ka.Pa(),
            a = p.get(n, e);
        null === a && (a = new Ia(o, n, i, e, s), p.set(n, e, a)), this.a = a, this.ca = r(t.offset) ? t.offset : [0, 0], this.c = r(t.offsetOrigin) ? t.offsetOrigin : "top-left", this.i = null, this.u = r(t.size) ? t.size : null, La.call(this, { opacity: r(t.opacity) ? t.opacity : 1, rotation: r(t.rotation) ? t.rotation : 0, scale: r(t.scale) ? t.scale : 1, snapToPixel: !r(t.snapToPixel) || t.snapToPixel, rotateWithView: !!r(t.rotateWithView) && t.rotateWithView })
    }

    function Ia(t, e, o, i, r) { Oe.call(this), this.g = null, this.a = null === t ? new Image : t, null !== i && (this.a.crossOrigin = i), this.f = null, this.c = r, this.b = o, this.i = e, this.l = !1 }

    function ka() { this.a = {}, this.b = 0 }

    function Na(t, e) { Qt.call(this), this.i = e, this.f = {}, this.v = {} }

    function Fa(t) {
        var e = t.viewState,
            o = t.coordinateToPixelMatrix;
        ba(o, t.size[0] / 2, t.size[1] / 2, 1 / e.resolution, -1 / e.resolution, -e.rotation, -e.center[0], -e.center[1]), go(o, t.pixelToCoordinateMatrix)
    }

    function Da() {
        var t = ka.Pa();
        if (32 < t.b) {
            var e, o, i = 0;
            for (e in t.a) {
                var r;
                o = t.a[e], (r = 0 == (3 & i++)) && (r = !(o = fe(o) ? Ue(o, void 0, void 0) : !!(o = Ne(o)) && Se(o, void 0, void 0))), r && (delete t.a[e], --t.b)
            }
        }
    }

    function Oa(t, e) { var o = d(e).toString(); if (o in t.f) return t.f[o]; var i = t.Oe(e); return t.f[o] = i, t.v[o] = Te(i, "change", t.Uj, !1, t), i }

    function Ba(t, e) {
        for (var o in t.f)
            if (!(o in e.layerStates)) { e.postRenderFunctions.push(S(t.Mn, t)); break }
    }

    function Ga(t, e) { this.j = t, this.g = e, this.a = [], this.b = [], this.c = {} }

    function Ua(t) {
        var e = t.a,
            o = t.b,
            i = e[0];
        return 1 == e.length ? (e.length = 0, o.length = 0) : (e[0] = e.pop(), o[0] = o.pop(), Ka(t, 0)), e = t.g(i), delete t.c[e], i
    }

    function Xa(t, e) {
        var o = t.j(e);
        1 / 0 != o && (t.a.push(e), t.b.push(o), t.c[t.g(e)] = !0, Ya(t, 0, t.a.length - 1))
    }

    function Ka(t, e) {
        for (var o = t.a, i = t.b, r = o.length, n = o[e], s = i[e], p = e; e < r >> 1;) {
            var a = 2 * e + 1,
                h = 2 * e + 2;
            a = h < r && i[h] < i[a] ? h : a, o[e] = o[a], i[e] = i[a], e = a
        }
        o[e] = n, i[e] = s, Ya(t, p, e)
    }

    function Ya(t, e, o) {
        var i = t.a;
        t = t.b;
        for (var r = i[o], n = t[o]; o > e;) {
            var s = o - 1 >> 1;
            if (!(t[s] > n)) break;
            i[o] = i[s], t[o] = t[s], o = s
        }
        i[o] = r, t[o] = n
    }

    function Va(t) {
        var e, o, i, r = t.j,
            n = t.a,
            s = t.b,
            p = 0,
            a = n.length;
        for (o = 0; o < a; ++o) 1 / 0 == (i = r(e = n[o])) ? delete t.c[t.g(e)] : (s[p] = i, n[p++] = e);
        for (n.length = p, s.length = p, r = (t.a.length >> 1) - 1; 0 <= r; r--) Ka(t, r)
    }

    function Ha(t, e) { Ga.call(this, (function(e) { return t.apply(null, e) }), (function(t) { return t[0].ob() })), this.l = e, this.f = 0 }

    function Wa(t, e, o) { this.f = t, this.c = e, this.i = o, this.a = [], this.b = this.g = 0 }

    function za(t) { Ve.call(this), this.v = null, this.f(!0), this.handleEvent = t.handleEvent }

    function Za(t, e, o, i, n) {
        if (null != o) {
            var s = e.Ea(),
                p = e.Ka();
            r(s) && r(p) && r(n) && 0 < n && (t.Oa(Mr({ rotation: s, duration: n, easing: br })), r(i) && t.Oa(xr({ source: p, duration: n, easing: br }))), e.rotate(o, i)
        }
    }

    function Ja(t, e, o, i, r) {
        var n = e.Da();
        o = e.constrainResolution(n, o, 0), qa(t, e, o, i, r)
    }

    function qa(t, e, o, i, n) {
        if (null != o) {
            var s, p = e.Da(),
                a = e.Ka();
            r(p) && r(a) && r(n) && 0 < n && (t.Oa(Pr({ resolution: p, duration: n, easing: br })), r(i) && t.Oa(xr({ source: a, duration: n, easing: br }))), null != i && (t = e.Ka(), n = e.Da(), r(t) && r(n) && (s = [i[0] - o * (i[0] - t[0]) / n, i[1] - o * (i[1] - t[1]) / n]), e.eb(s)), e.Xb(o)
        }
    }

    function $a(t) { t = r(t) ? t : {}, this.c = r(t.delta) ? t.delta : 1, za.call(this, { handleEvent: _a }), this.g = r(t.duration) ? t.duration : 250 }

    function _a(t) {
        var e = !1,
            o = t.a;
        if (t.type == ra) {
            e = t.map;
            var i = t.coordinate,
                r = (o = o.f ? -this.c : this.c, e.X());
            Ja(e, r, o, i, this.g), t.preventDefault(), e = !0
        }
        return !e
    }

    function Qa(t) { return (t = t.a).b && !t.j && t.f }

    function th(t) { return "pointermove" == t.type }

    function eh(t) { return t.type == oa }

    function oh(t) { return !(t = t.a).b && !t.j && !t.f }

    function ih(t) { return !(t = t.a).b && !t.j && t.f }

    function rh(t) { return "INPUT" !== (t = t.a.target.tagName) && "SELECT" !== t && "TEXTAREA" !== t }

    function nh(t) { return 1 == t.b.pointerId }

    function sh(t) { t = r(t) ? t : {}, za.call(this, { handleEvent: r(t.handleEvent) ? t.handleEvent : ah }), this.Uc = r(t.handleDownEvent) ? t.handleDownEvent : qo, this.He = r(t.handleDragEvent) ? t.handleDragEvent : s, this.mi = r(t.handleMoveEvent) ? t.handleMoveEvent : s, this.Vh = r(t.handleUpEvent) ? t.handleUpEvent : qo, this.u = !1, this.ba = {}, this.i = [] }

    function ph(t) { for (var e = t.length, o = 0, i = 0, r = 0; r < e; r++) o += t[r].clientX, i += t[r].clientY; return [o / e, i / e] }

    function ah(t) {
        if (!(t instanceof Qp)) return !0;
        var e = !1,
            o = t.type;
        return o !== pa && o !== na && o !== aa || (o = t.b, t.type == aa ? delete this.ba[o.pointerId] : (t.type == pa || o.pointerId in this.ba) && (this.ba[o.pointerId] = o), this.i = ct(this.ba)), this.u && (t.type == na ? this.He(t) : t.type == aa && (this.u = this.Vh(t))), t.type == pa ? (this.u = t = this.Uc(t), e = this.tc(t)) : t.type == sa && this.mi(t), !e
    }

    function hh(t) { sh.call(this, { handleDownEvent: ch, handleDragEvent: lh, handleUpEvent: uh }), t = r(t) ? t : {}, this.c = t.kinetic, this.g = this.j = null, this.A = r(t.condition) ? t.condition : oh, this.l = !1 }

    function lh(t) {
        var e = ph(this.i);
        if (this.c && this.c.update(e[0], e[1]), null !== this.g) {
            var o = this.g[0] - e[0],
                i = e[1] - this.g[1],
                r = (t = t.map).X(),
                n = gr(r),
                s = (i = o = [o, i], n.resolution);
            i[0] *= s, i[1] *= s, oo(o, n.rotation), $e(o, n.center), o = r.Fd(o), t.render(), r.eb(o)
        }
        this.g = e
    }

    function uh(t) {
        var e = (t = t.map).X();
        if (0 === this.i.length) {
            var o;
            if (o = !this.l && this.c)
                if (6 > (o = this.c).a.length) o = !1;
                else {
                    var i = j() - o.i,
                        r = o.a.length - 3;
                    if (o.a[r + 2] < i) o = !1;
                    else {
                        for (var n = r - 3; 0 < n && o.a[n + 2] > i;) n -= 3;
                        i = o.a[r + 2] - o.a[n + 2];
                        var s = o.a[r] - o.a[n];
                        r = o.a[r + 1] - o.a[n + 1], o.g = Math.atan2(r, s), o.b = Math.sqrt(s * s + r * r) / i, o = o.b > o.c
                    }
                }
            return o && (o = ((o = this.c).c - o.b) / o.f, r = this.c.g, n = e.Ka(), this.j = function(t, e) {
                var o = t.f,
                    i = t.b,
                    r = t.c - i,
                    n = function(t) { return Math.log(t.c / t.b) / t.f }(t);
                return xr({ source: e, duration: n, easing: function(t) { return i * (Math.exp(o * t * n) - 1) / r } })
            }(this.c, n), t.Oa(this.j), n = t.ya(n), o = t.ta([n[0] - o * Math.cos(r), n[1] - o * Math.sin(r)]), o = e.Fd(o), e.eb(o)), vr(e, -1), t.render(), !1
        }
        return this.g = null, !0
    }

    function ch(t) {
        if (0 < this.i.length && this.A(t)) {
            var e = t.map,
                o = e.X();
            return this.g = null, this.u || vr(o, 1), e.render(), null !== this.j && $(e.C, this.j) && (o.eb(t.frameState.viewState.center), this.j = null), this.c && ((t = this.c).a.length = 0, t.g = 0, t.b = 0), this.l = 1 < this.i.length, !0
        }
        return !1
    }

    function yh(t) { t = r(t) ? t : {}, sh.call(this, { handleDownEvent: dh, handleDragEvent: fh, handleUpEvent: gh }), this.g = r(t.condition) ? t.condition : Qa, this.c = void 0, this.j = r(t.duration) ? t.duration : 250 }

    function fh(t) {
        if (nh(t)) {
            var e = t.map,
                o = e.Ca();
            if (t = t.pixel, o = Math.atan2(o[1] / 2 - t[1], t[0] - o[0] / 2), r(this.c)) {
                t = o - this.c;
                var i = e.X(),
                    n = i.Ea();
                e.render(), Za(e, i, n - t)
            }
            this.c = o
        }
    }

    function gh(t) {
        if (!nh(t)) return !0;
        var e = (t = t.map).X();
        vr(e, -1);
        var o = e.Ea(),
            i = this.j;
        return o = e.constrainRotation(o, 0), Za(t, e, o, void 0, i), !1
    }

    function dh(t) { return !!(nh(t) && ce(t.a) && this.g(t)) && (vr((t = t.map).X(), 1), t.render(), this.c = void 0, !0) }

    function vh(t) { this.c = this.b = this.f = this.g = this.a = null, this.j = t }

    function bh(t) {
        var e = t.f,
            o = t.b;
        return (t = z([e, [e[0], o[1]], o, [o[0], e[1]]], t.a.ta, t.a))[4] = t[0].slice(), new sr([t])
    }

    function mh(t) { null === t.a || null === t.f || null === t.b || t.a.render() }

    function wh(t, e) { re.call(this, t), this.coordinate = e }

    function Sh(t) { sh.call(this, { handleDownEvent: Ph, handleDragEvent: xh, handleUpEvent: Mh }), t = r(t) ? t : {}, this.g = new vh(r(t.style) ? t.style : null), this.c = null, this.l = r(t.condition) ? t.condition : $o }

    function xh(t) {
        if (nh(t)) {
            var e = this.g;
            t = t.pixel, e.f = this.c, e.b = t, e.c = bh(e), mh(e)
        }
    }

    function Mh(t) {
        if (!nh(t)) return !0;
        this.g.setMap(null);
        var e = t.pixel[0] - this.c[0],
            o = t.pixel[1] - this.c[1];
        return 64 <= e * e + o * o && (this.j(t), Be(this, new wh("boxend", t.coordinate))), !1
    }

    function Ph(t) {
        if (nh(t) && ce(t.a) && this.l(t)) {
            this.c = t.pixel, this.g.setMap(t.map);
            var e = this.g,
                o = this.c;
            return e.f = this.c, e.b = o, e.c = bh(e), mh(e), Be(this, new wh("boxstart", t.coordinate)), !0
        }
        return !1
    }

    function Th() { this.b = -1, this.b = 64, this.a = Array(4), this.g = Array(this.b), this.f = this.c = 0, this.a[0] = 1732584193, this.a[1] = 4023233417, this.a[2] = 2562383102, this.a[3] = 271733878, this.f = this.c = 0 }

    function jh(t, e, o) {
        o || (o = 0);
        var i = Array(16);
        if (c(e))
            for (var r = 0; 16 > r; ++r) i[r] = e.charCodeAt(o++) | e.charCodeAt(o++) << 8 | e.charCodeAt(o++) << 16 | e.charCodeAt(o++) << 24;
        else
            for (r = 0; 16 > r; ++r) i[r] = e[o++] | e[o++] << 8 | e[o++] << 16 | e[o++] << 24;
        e = t.a[0], o = t.a[1], r = t.a[2];
        var n = t.a[3],
            s = 0;
        s = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = (o = (r = (n = (e = o + ((s = e + (n ^ o & (r ^ n)) + i[0] + 3614090360 & 4294967295) << 7 & 4294967295 | s >>> 25)) + ((s = n + (r ^ e & (o ^ r)) + i[1] + 3905402710 & 4294967295) << 12 & 4294967295 | s >>> 20)) + ((s = r + (o ^ n & (e ^ o)) + i[2] + 606105819 & 4294967295) << 17 & 4294967295 | s >>> 15)) + ((s = o + (e ^ r & (n ^ e)) + i[3] + 3250441966 & 4294967295) << 22 & 4294967295 | s >>> 10)) + ((s = e + (n ^ o & (r ^ n)) + i[4] + 4118548399 & 4294967295) << 7 & 4294967295 | s >>> 25)) + ((s = n + (r ^ e & (o ^ r)) + i[5] + 1200080426 & 4294967295) << 12 & 4294967295 | s >>> 20)) + ((s = r + (o ^ n & (e ^ o)) + i[6] + 2821735955 & 4294967295) << 17 & 4294967295 | s >>> 15)) + ((s = o + (e ^ r & (n ^ e)) + i[7] + 4249261313 & 4294967295) << 22 & 4294967295 | s >>> 10)) + ((s = e + (n ^ o & (r ^ n)) + i[8] + 1770035416 & 4294967295) << 7 & 4294967295 | s >>> 25)) + ((s = n + (r ^ e & (o ^ r)) + i[9] + 2336552879 & 4294967295) << 12 & 4294967295 | s >>> 20)) + ((s = r + (o ^ n & (e ^ o)) + i[10] + 4294925233 & 4294967295) << 17 & 4294967295 | s >>> 15)) + ((s = o + (e ^ r & (n ^ e)) + i[11] + 2304563134 & 4294967295) << 22 & 4294967295 | s >>> 10)) + ((s = e + (n ^ o & (r ^ n)) + i[12] + 1804603682 & 4294967295) << 7 & 4294967295 | s >>> 25)) + ((s = n + (r ^ e & (o ^ r)) + i[13] + 4254626195 & 4294967295) << 12 & 4294967295 | s >>> 20)) + ((s = r + (o ^ n & (e ^ o)) + i[14] + 2792965006 & 4294967295) << 17 & 4294967295 | s >>> 15)) + ((s = o + (e ^ r & (n ^ e)) + i[15] + 1236535329 & 4294967295) << 22 & 4294967295 | s >>> 10)) + ((s = e + (r ^ n & (o ^ r)) + i[1] + 4129170786 & 4294967295) << 5 & 4294967295 | s >>> 27)) + ((s = n + (o ^ r & (e ^ o)) + i[6] + 3225465664 & 4294967295) << 9 & 4294967295 | s >>> 23)) + ((s = r + (e ^ o & (n ^ e)) + i[11] + 643717713 & 4294967295) << 14 & 4294967295 | s >>> 18)) + ((s = o + (n ^ e & (r ^ n)) + i[0] + 3921069994 & 4294967295) << 20 & 4294967295 | s >>> 12)) + ((s = e + (r ^ n & (o ^ r)) + i[5] + 3593408605 & 4294967295) << 5 & 4294967295 | s >>> 27)) + ((s = n + (o ^ r & (e ^ o)) + i[10] + 38016083 & 4294967295) << 9 & 4294967295 | s >>> 23)) + ((s = r + (e ^ o & (n ^ e)) + i[15] + 3634488961 & 4294967295) << 14 & 4294967295 | s >>> 18)) + ((s = o + (n ^ e & (r ^ n)) + i[4] + 3889429448 & 4294967295) << 20 & 4294967295 | s >>> 12)) + ((s = e + (r ^ n & (o ^ r)) + i[9] + 568446438 & 4294967295) << 5 & 4294967295 | s >>> 27)) + ((s = n + (o ^ r & (e ^ o)) + i[14] + 3275163606 & 4294967295) << 9 & 4294967295 | s >>> 23)) + ((s = r + (e ^ o & (n ^ e)) + i[3] + 4107603335 & 4294967295) << 14 & 4294967295 | s >>> 18)) + ((s = o + (n ^ e & (r ^ n)) + i[8] + 1163531501 & 4294967295) << 20 & 4294967295 | s >>> 12)) + ((s = e + (r ^ n & (o ^ r)) + i[13] + 2850285829 & 4294967295) << 5 & 4294967295 | s >>> 27)) + ((s = n + (o ^ r & (e ^ o)) + i[2] + 4243563512 & 4294967295) << 9 & 4294967295 | s >>> 23)) + ((s = r + (e ^ o & (n ^ e)) + i[7] + 1735328473 & 4294967295) << 14 & 4294967295 | s >>> 18)) + ((s = o + (n ^ e & (r ^ n)) + i[12] + 2368359562 & 4294967295) << 20 & 4294967295 | s >>> 12)) + ((s = e + (o ^ r ^ n) + i[5] + 4294588738 & 4294967295) << 4 & 4294967295 | s >>> 28)) + ((s = n + (e ^ o ^ r) + i[8] + 2272392833 & 4294967295) << 11 & 4294967295 | s >>> 21)) + ((s = r + (n ^ e ^ o) + i[11] + 1839030562 & 4294967295) << 16 & 4294967295 | s >>> 16)) + ((s = o + (r ^ n ^ e) + i[14] + 4259657740 & 4294967295) << 23 & 4294967295 | s >>> 9)) + ((s = e + (o ^ r ^ n) + i[1] + 2763975236 & 4294967295) << 4 & 4294967295 | s >>> 28)) + ((s = n + (e ^ o ^ r) + i[4] + 1272893353 & 4294967295) << 11 & 4294967295 | s >>> 21)) + ((s = r + (n ^ e ^ o) + i[7] + 4139469664 & 4294967295) << 16 & 4294967295 | s >>> 16)) + ((s = o + (r ^ n ^ e) + i[10] + 3200236656 & 4294967295) << 23 & 4294967295 | s >>> 9)) + ((s = e + (o ^ r ^ n) + i[13] + 681279174 & 4294967295) << 4 & 4294967295 | s >>> 28)) + ((s = n + (e ^ o ^ r) + i[0] + 3936430074 & 4294967295) << 11 & 4294967295 | s >>> 21)) + ((s = r + (n ^ e ^ o) + i[3] + 3572445317 & 4294967295) << 16 & 4294967295 | s >>> 16)) + ((s = o + (r ^ n ^ e) + i[6] + 76029189 & 4294967295) << 23 & 4294967295 | s >>> 9)) + ((s = e + (o ^ r ^ n) + i[9] + 3654602809 & 4294967295) << 4 & 4294967295 | s >>> 28)) + ((s = n + (e ^ o ^ r) + i[12] + 3873151461 & 4294967295) << 11 & 4294967295 | s >>> 21)) + ((s = r + (n ^ e ^ o) + i[15] + 530742520 & 4294967295) << 16 & 4294967295 | s >>> 16)) + ((s = o + (r ^ n ^ e) + i[2] + 3299628645 & 4294967295) << 23 & 4294967295 | s >>> 9)) + ((s = e + (r ^ (o | ~n)) + i[0] + 4096336452 & 4294967295) << 6 & 4294967295 | s >>> 26)) + ((s = n + (o ^ (e | ~r)) + i[7] + 1126891415 & 4294967295) << 10 & 4294967295 | s >>> 22)) + ((s = r + (e ^ (n | ~o)) + i[14] + 2878612391 & 4294967295) << 15 & 4294967295 | s >>> 17)) + ((s = o + (n ^ (r | ~e)) + i[5] + 4237533241 & 4294967295) << 21 & 4294967295 | s >>> 11)) + ((s = e + (r ^ (o | ~n)) + i[12] + 1700485571 & 4294967295) << 6 & 4294967295 | s >>> 26)) + ((s = n + (o ^ (e | ~r)) + i[3] + 2399980690 & 4294967295) << 10 & 4294967295 | s >>> 22)) + ((s = r + (e ^ (n | ~o)) + i[10] + 4293915773 & 4294967295) << 15 & 4294967295 | s >>> 17)) + ((s = o + (n ^ (r | ~e)) + i[1] + 2240044497 & 4294967295) << 21 & 4294967295 | s >>> 11)) + ((s = e + (r ^ (o | ~n)) + i[8] + 1873313359 & 4294967295) << 6 & 4294967295 | s >>> 26)) + ((s = n + (o ^ (e | ~r)) + i[15] + 4264355552 & 4294967295) << 10 & 4294967295 | s >>> 22)) + ((s = r + (e ^ (n | ~o)) + i[6] + 2734768916 & 4294967295) << 15 & 4294967295 | s >>> 17)) + ((s = o + (n ^ (r | ~e)) + i[13] + 1309151649 & 4294967295) << 21 & 4294967295 | s >>> 11)) + ((n = (e = o + ((s = e + (r ^ (o | ~n)) + i[4] + 4149444226 & 4294967295) << 6 & 4294967295 | s >>> 26)) + ((s = n + (o ^ (e | ~r)) + i[11] + 3174756917 & 4294967295) << 10 & 4294967295 | s >>> 22)) ^ ((r = n + ((s = r + (e ^ (n | ~o)) + i[2] + 718787259 & 4294967295) << 15 & 4294967295 | s >>> 17)) | ~e)) + i[9] + 3951481745 & 4294967295, t.a[0] = t.a[0] + e & 4294967295, t.a[1] = t.a[1] + (r + (s << 21 & 4294967295 | s >>> 11)) & 4294967295, t.a[2] = t.a[2] + r & 4294967295, t.a[3] = t.a[3] + n & 4294967295
    }

    function Ah(t) { t = r(t) ? t : {}, this.a = r(t.color) ? t.color : null, this.f = t.lineCap, this.c = r(t.lineDash) ? t.lineDash : null, this.g = t.lineJoin, this.i = t.miterLimit, this.b = t.width, this.j = void 0 }
    A(ua, Ve), (t = ua.prototype).Ib = function() { return this.get("brightness") }, t.Jb = function() { return this.get("contrast") }, t.Kb = function() { return this.get("hue") }, t.R = function() { return this.get("extent") }, t.Lb = function() { return this.get("maxResolution") }, t.Mb = function() { return this.get("minResolution") }, t.Rb = function() { return this.get("opacity") }, t.Nb = function() { return this.get("saturation") }, t.mb = function() { return this.get("visible") }, t.mc = function(t) { this.set("brightness", t) }, t.nc = function(t) { this.set("contrast", t) }, t.oc = function(t) { this.set("hue", t) }, t.hc = function(t) { this.set("extent", t) }, t.pc = function(t) { this.set("maxResolution", t) }, t.qc = function(t) { this.set("minResolution", t) }, t.ic = function(t) { this.set("opacity", t) }, t.rc = function(t) { this.set("saturation", t) }, t.sc = function(t) { this.set("visible", t) }, A(fa, re), A(ga, ua), (t = ga.prototype).Ze = function(t) { return (t = r(t) ? t : []).push(ca(this)), t }, t.da = function() { var t = this.get("source"); return r(t) ? t : null }, t.af = function() { var t = this.da(); return null === t ? "undefined" : t.A }, t.Il = function() { this.s() }, t.lk = function() {
        null !== this.i && (Re(this.i), this.i = null);
        var t = this.da();
        null !== t && (this.i = Te(t, "change", this.Il, !1, this)), this.s()
    }, t.setMap = function(t) {
        Re(this.C), this.s(), Re(this.N), null !== t && (this.C = Te(t, "precompose", (function(t) {
            var e = ca(this);
            e.Pb = !1, t.frameState.layerStatesArray.push(e), t.frameState.layerStates[d(this)] = e
        }), !1, this), this.N = Te(this, "change", t.render, !1, t))
    }, t.Qc = function(t) { this.set("source", t) }, A(va, Oe), va.prototype.R = function() { return this.extent }, A(Sa, Xe), (t = Sa.prototype).Va = s, t.jc = function(t, e, o, i) { if (t = t.slice(), wa(e.pixelToCoordinateMatrix, t, t), this.Va(t, e, $o, this)) return o.call(i, this.b) }, t.ie = qo, t.Gd = function(t, e) { return function(o, i) { return ls(t, o, i, (function(t) { e[o] || (e[o] = {}), e[o][t.a.toString()] = t })) } }, t.Ll = function(t) { 2 === t.target.state && Ma(this) }, (t = La.prototype).me = function() { return this.A }, t.Pd = function() { return this.D }, t.ne = function() { return this.B }, t.oe = function() { return this.v }, t.Qd = function() { return this.ea }, t.pe = function(t) { this.B = t }, t.qe = function(t) { this.v = t }, A(Ea, La), (t = Ea.prototype).yb = function() {
        if (null !== this.f) return this.f;
        var t = this.g,
            e = this.fb();
        if ("fraction" == this.j || "fraction" == this.l) {
            if (null === e) return null;
            t = this.g.slice(), "fraction" == this.j && (t[0] *= e[0]), "fraction" == this.l && (t[1] *= e[1])
        }
        if ("top-left" != this.b) {
            if (null === e) return null;
            t === this.g && (t = this.g.slice()), "top-right" != this.b && "bottom-right" != this.b || (t[0] = -t[0] + e[0]), "bottom-left" != this.b && "bottom-right" != this.b || (t[1] = -t[1] + e[1])
        }
        return this.f = t
    }, t.Sb = function() { return this.a.a }, t.Ld = function() { return this.a.b }, t.qd = function() { return this.a.c }, t.le = function() {
        var t = this.a;
        if (null === t.g)
            if (t.l) {
                var e = t.b[0],
                    o = t.b[1],
                    i = ip(e, o);
                i.fillRect(0, 0, e, o), t.g = i.canvas
            } else t.g = t.a;
        return t.g
    }, t.Db = function() {
        if (null !== this.i) return this.i;
        var t = this.ca;
        if ("top-left" != this.c) {
            var e = this.fb(),
                o = this.a.b;
            if (null === e || null === o) return null;
            t = t.slice(), "top-right" != this.c && "bottom-right" != this.c || (t[0] = o[0] - e[0] - t[0]), "bottom-left" != this.c && "bottom-right" != this.c || (t[1] = o[1] - e[1] - t[1])
        }
        return this.i = t
    }, t.ym = function() { return this.a.i }, t.fb = function() { return null === this.u ? this.a.b : this.u }, t.ef = function(t, e) { return Te(this.a, "change", t, !1, e) }, t.load = function() { this.a.load() }, t.Df = function(t, e) { Ce(this.a, "change", t, !1, e) }, A(Ia, Oe), Ia.prototype.j = function() { this.c = 3, H(this.f, Re), this.f = null, Be(this, "change") }, Ia.prototype.B = function() {
        this.c = 2, this.b = [this.a.width, this.a.height], H(this.f, Re), this.f = null;
        var t = ip(1, 1);
        t.drawImage(this.a, 0, 0);
        try { t.getImageData(0, 0, 1, 1) } catch (t) { this.l = !0 }
        Be(this, "change")
    }, Ia.prototype.load = function() { if (0 == this.c) { this.c = 1, this.f = [Ae(this.a, "error", this.j, !1, this), Ae(this.a, "load", this.B, !1, this)]; try { this.a.src = this.i } catch (t) { this.j() } } }, p(ka), ka.prototype.clear = function() { this.a = {}, this.b = 0 }, ka.prototype.get = function(t, e) { var o = e + ":" + t; return o in this.a ? this.a[o] : null }, ka.prototype.set = function(t, e, o) { this.a[e + ":" + t] = o, ++this.b }, A(Na, Qt), (t = Na.prototype).W = function() { lt(this.f, ie), Na.$.W.call(this) }, t.mf = function(t, e, o, i, r, n) {
        var s, p = (h = e.viewState).resolution,
            a = h.projection,
            h = t;
        if (a.g) {
            a = Vo(s = a.R());
            var l = t[0];
            (l < s[0] || l > s[2]) && (h = [l + a * (h = Math.ceil((s[0] - l) / a)), t[1]])
        }
        for (l = (a = e.layerStatesArray).length - 1; 0 <= l; --l) { var u = (s = a[l]).layer; if ((!s.Pb || da(s, p) && r.call(n, u)) && (s = Oa(this, u).Va(Zn(u.da()) ? h : t, e, o, i))) return s }
    }, t.Mg = function(t, e, o, i, r, n) {
        var s, p, a = e.viewState.resolution,
            h = e.layerStatesArray;
        for (p = h.length - 1; 0 <= p; --p) { var l = (s = h[p]).layer; if (da(s, a) && r.call(n, l) && (s = Oa(this, l).jc(t, e, o, i))) return s }
    }, t.Ng = function(t, e, o, i) { return r(t = this.mf(t, e, $o, this, o, i)) }, t.Uj = function() { this.i.render() }, t.xe = s, t.Mn = function(t, e) {
        for (var o in this.f)
            if (null === e || !(o in e.layerStates)) {
                var i = o,
                    r = this.f[i];
                delete this.f[i], Re(this.v[i]), delete this.v[i], ie(r)
            }
    }, Ga.prototype.clear = function() { this.a.length = 0, this.b.length = 0, bt(this.c) }, Ga.prototype.$b = function() { return this.a.length }, Ga.prototype.wa = function() { return 0 === this.a.length }, A(Ha, Ga), Ha.prototype.i = function(t) {
        var e = (t = t.target).state;
        2 !== e && 3 !== e && 4 !== e || (Ce(t, "change", this.i, !1, this), --this.f, this.l())
    }, Wa.prototype.update = function(t, e) { this.a.push(t, e, j()) }, A(za, Ve), za.prototype.b = function() { return this.get("active") }, za.prototype.f = function(t) { this.set("active", t) }, za.prototype.setMap = function(t) { this.v = t }, A($a, za), A(sh, za), sh.prototype.tc = Qo, A(hh, sh), hh.prototype.tc = qo, A(yh, sh), yh.prototype.tc = qo, A(vh, Qt), vh.prototype.W = function() { this.setMap(null) }, vh.prototype.i = function(t) {
        var e = this.c,
            o = this.j;
        t.vectorContext.yc(1 / 0, (function(t) { t.Ha(o.f, o.c), t.Ia(o.b), t.Yb(e, null) }))
    }, vh.prototype.Y = function() { return this.c }, vh.prototype.setMap = function(t) { null !== this.g && (Re(this.g), this.g = null, this.a.render(), this.a = null), this.a = t, null !== this.a && (this.g = Te(t, "postcompose", this.i, !1, this), mh(this)) }, A(wh, re), A(Sh, sh), Sh.prototype.Y = function() { return this.g.Y() }, Sh.prototype.j = s, A(Th, (function() { this.b = -1 })), Th.prototype.update = function(t, e) {
        r(e) || (e = t.length);
        for (var o = e - this.b, i = this.g, n = this.c, s = 0; s < e;) {
            if (0 == n)
                for (; s <= o;) jh(this, t, s), s += this.b;
            if (c(t)) {
                for (; s < e;)
                    if (i[n++] = t.charCodeAt(s++), n == this.b) { jh(this, i), n = 0; break }
            } else
                for (; s < e;)
                    if (i[n++] = t[s++], n == this.b) { jh(this, i), n = 0; break }
        }
        this.c = n, this.f += e
    }, (t = Ah.prototype).Em = function() { return this.a }, t.ij = function() { return this.f }, t.Fm = function() { return this.c }, t.jj = function() { return this.g }, t.oj = function() { return this.i }, t.Gm = function() { return this.b }, t.Hm = function(t) { this.a = t, this.j = void 0 }, t.Wn = function(t) { this.f = t, this.j = void 0 }, t.Im = function(t) { this.c = t, this.j = void 0 }, t.Xn = function(t) { this.g = t, this.j = void 0 }, t.Yn = function(t) { this.i = t, this.j = void 0 }, t.ho = function(t) { this.b = t, this.j = void 0 }, t.zb = function() {
        if (!r(this.j)) {
            var t = "s" + (null === this.a ? "-" : Kr(this.a)) + "," + (r(this.f) ? this.f.toString() : "-") + "," + (null === this.c ? "-" : this.c.toString()) + "," + (r(this.g) ? this.g : "-") + "," + (r(this.i) ? this.i.toString() : "-") + "," + (r(this.b) ? this.b.toString() : "-"),
                e = new Th;
            e.update(t);
            var o = Array((56 > e.c ? e.b : 2 * e.b) - e.c);
            for (o[0] = 128, t = 1; t < o.length - 8; ++t) o[t] = 0;
            var i = 8 * e.f;
            for (t = o.length - 8; t < o.length; ++t) o[t] = 255 & i, i /= 256;
            for (e.update(o), o = Array(16), t = i = 0; 4 > t; ++t)
                for (var n = 0; 32 > n; n += 8) o[i++] = e.a[t] >>> n & 255;
            if (8192 > o.length) e = String.fromCharCode.apply(null, o);
            else
                for (e = "", t = 0; t < o.length; t += 8192) e += String.fromCharCode.apply(null, et(o, t, t + 8192));
            this.j = e
        }
        return this.j
    };
    var Ch = [0, 0, 0, 1],
        Rh = [],
        Lh = [0, 0, 0, 1];

    function Eh(t) { t = r(t) ? t : {}, this.a = r(t.color) ? t.color : null, this.b = void 0 }

    function Ih(t) {
        t = r(t) ? t : {}, this.i = this.a = this.g = null, this.f = r(t.fill) ? t.fill : null, this.b = r(t.stroke) ? t.stroke : null, this.c = t.radius, this.u = [0, 0], this.l = this.ca = this.j = null;
        var e, o, i = t.atlasManager,
            n = null,
            s = 0;
        null !== this.b && (o = Kr(this.b.a), r(s = this.b.b) || (s = 1), n = this.b.c, yp || (n = null));
        var p = 2 * (this.c + s) + 1;
        o = { strokeStyle: o, ud: s, size: p, lineDash: n }, r(i) ? (p = Math.round(p), (n = null === this.f) && (e = S(this.Sg, this, o)), s = this.zb(), o = i.add(s, p, p, S(this.Tg, this, o), e), this.a = o.image, this.u = [o.offsetX, o.offsetY], e = o.image.width, this.i = n ? o.rg : this.a) : (this.a = rn("CANVAS"), this.a.height = p, this.a.width = p, e = p = this.a.width, i = this.a.getContext("2d"), this.Tg(o, i, 0, 0), null === this.f ? ((i = this.i = rn("CANVAS")).height = o.size, i.width = o.size, i = i.getContext("2d"), this.Sg(o, i, 0, 0)) : this.i = this.a), this.j = [p / 2, p / 2], this.ca = [p, p], this.l = [e, e], La.call(this, { opacity: 1, rotateWithView: !1, rotation: 0, scale: 1, snapToPixel: !r(t.snapToPixel) || t.snapToPixel })
    }

    function kh(t) { t = r(t) ? t : {}, this.j = null, this.g = Oh, r(t.geometry) && this.Wg(t.geometry), this.f = r(t.fill) ? t.fill : null, this.i = r(t.image) ? t.image : null, this.c = r(t.stroke) ? t.stroke : null, this.b = r(t.text) ? t.text : null, this.a = t.zIndex }

    function Nh(t) { return f(t) || (t = Jo(t = l(t) ? t : [t])), t }

    function Fh() {
        var t = new Eh({ color: "rgba(255,255,255,0.4)" }),
            e = new Ah({ color: "#3399CC", width: 1.25 }),
            o = [new kh({ image: new Ih({ fill: t, stroke: e, radius: 5 }), fill: t, stroke: e })];
        return Fh = function() { return o }, o
    }

    function Dh() {
        var t = {},
            e = [255, 255, 255, 1],
            o = [0, 153, 255, 1];
        return t.Polygon = [new kh({ fill: new Eh({ color: [255, 255, 255, .5] }) })], t.MultiPolygon = t.Polygon, t.LineString = [new kh({ stroke: new Ah({ color: e, width: 5 }) }), new kh({ stroke: new Ah({ color: o, width: 3 }) })], t.MultiLineString = t.LineString, t.Circle = t.Polygon.concat(t.LineString), t.Point = [new kh({ image: new Ih({ radius: 6, fill: new Eh({ color: o }), stroke: new Ah({ color: e, width: 1.5 }) }), zIndex: 1 / 0 })], t.MultiPoint = t.Point, t.GeometryCollection = t.Polygon.concat(t.Point), t
    }

    function Oh(t) { return t.Y() }

    function Bh(t) {
        var e = r(t) ? t : {};
        t = r(e.condition) ? e.condition : ih, this.A = r(e.duration) ? e.duration : 200, e = r(e.style) ? e.style : new kh({ stroke: new Ah({ color: [0, 0, 255, 1] }) }), Sh.call(this, { condition: t, style: e })
    }

    function Gh(t) { za.call(this, { handleEvent: Uh }), t = r(t) ? t : {}, this.c = r(t.condition) ? t.condition : ei(oh, rh), this.g = r(t.duration) ? t.duration : 100, this.i = r(t.pixelDelta) ? t.pixelDelta : 128 }

    function Uh(t) {
        var e = !1;
        if ("key" == t.type) {
            var o = t.a.g;
            if (this.c(t) && (40 == o || 37 == o || 39 == o || 38 == o)) {
                var i = t.map,
                    n = gr(e = i.X()),
                    s = n.resolution * this.i,
                    p = 0,
                    a = 0;
                40 == o ? a = -s : 37 == o ? p = -s : 39 == o ? p = s : a = s, oo(o = [p, a], n.rotation), n = this.g, r(s = e.Ka()) && (r(n) && 0 < n && i.Oa(xr({ source: s, duration: n, easing: wr })), i = e.Fd([s[0] + o[0], s[1] + o[1]]), e.eb(i)), t.preventDefault(), e = !0
            }
        }
        return !e
    }

    function Xh(t) { za.call(this, { handleEvent: Kh }), t = r(t) ? t : {}, this.g = r(t.condition) ? t.condition : rh, this.c = r(t.delta) ? t.delta : 1, this.i = r(t.duration) ? t.duration : 100 }

    function Kh(t) {
        var e = !1;
        if ("key" == t.type) {
            var o = t.a.B;
            if (this.g(t) && (43 == o || 45 == o)) {
                e = t.map, o = 43 == o ? this.c : -this.c, e.render();
                var i = e.X();
                Ja(e, i, o, void 0, this.i), t.preventDefault(), e = !0
            }
        }
        return !e
    }

    function Yh(t) { za.call(this, { handleEvent: Vh }), t = r(t) ? t : {}, this.c = 0, this.u = r(t.duration) ? t.duration : 250, this.i = null, this.j = this.g = void 0 }

    function Vh(t) {
        var e = !1;
        if ("mousewheel" == t.type) {
            e = t.map;
            var o = t.a;
            this.i = t.coordinate, this.c += o.u, r(this.g) || (this.g = j()), o = Math.max(80 - (j() - this.g), 0), i.clearTimeout(this.j), this.j = i.setTimeout(S(this.l, this, e), o), t.preventDefault(), e = !0
        }
        return !e
    }

    function Hh(t) { sh.call(this, { handleDownEvent: Zh, handleDragEvent: Wh, handleUpEvent: zh }), t = r(t) ? t : {}, this.g = null, this.j = void 0, this.c = !1, this.l = 0, this.D = r(t.threshold) ? t.threshold : .3, this.A = r(t.duration) ? t.duration : 250 }

    function Wh(t) {
        var e = 0,
            o = this.i[0],
            i = this.i[1];
        o = Math.atan2(i.clientY - o.clientY, i.clientX - o.clientX), r(this.j) && (e = o - this.j, this.l += e, !this.c && Math.abs(this.l) > this.D && (this.c = !0)), this.j = o, o = An((t = t.map).b), (i = ph(this.i))[0] -= o.x, i[1] -= o.y, this.g = t.ta(i), this.c && (i = (o = t.X()).Ea(), t.render(), Za(t, o, i + e, this.g))
    }

    function zh(t) {
        if (2 > this.i.length) {
            var e = (t = t.map).X();
            if (vr(e, -1), this.c) {
                var o = e.Ea(),
                    i = this.g,
                    r = this.A;
                o = e.constrainRotation(o, 0), Za(t, e, o, i, r)
            }
            return !1
        }
        return !0
    }

    function Zh(t) { return 2 <= this.i.length && (t = t.map, this.g = null, this.j = void 0, this.c = !1, this.l = 0, this.u || vr(t.X(), 1), t.render(), !0) }

    function Jh(t) { sh.call(this, { handleDownEvent: _h, handleDragEvent: qh, handleUpEvent: $h }), t = r(t) ? t : {}, this.g = null, this.l = r(t.duration) ? t.duration : 400, this.c = void 0, this.j = 1 }

    function qh(t) {
        var e = 1,
            o = this.i[0],
            i = this.i[1],
            n = o.clientX - i.clientX;
        o = o.clientY - i.clientY, n = Math.sqrt(n * n + o * o), r(this.c) && (e = this.c / n), this.c = n, 1 != e && (this.j = e), o = (n = (t = t.map).X()).Da(), i = An(t.b);
        var s = ph(this.i);
        s[0] -= i.x, s[1] -= i.y, this.g = t.ta(s), t.render(), qa(t, n, o * e, this.g)
    }

    function $h(t) {
        if (2 > this.i.length) {
            var e = (t = t.map).X();
            vr(e, -1);
            var o = e.Da(),
                i = this.g,
                r = this.l;
            return o = e.constrainResolution(o, 0, this.j - 1), qa(t, e, o, i, r), !1
        }
        return !0
    }

    function _h(t) { return 2 <= this.i.length && (t = t.map, this.g = null, this.c = void 0, this.j = 1, this.u || vr(t.X(), 1), t.render(), !0) }

    function Qh(t) {
        t = r(t) ? t : {};
        var e = new Dr,
            o = new Wa(-.005, .05, 100);
        return (!r(t.altShiftDragRotate) || t.altShiftDragRotate) && e.push(new yh), (!r(t.doubleClickZoom) || t.doubleClickZoom) && e.push(new $a({ delta: t.zoomDelta, duration: t.zoomDuration })), (!r(t.dragPan) || t.dragPan) && e.push(new hh({ kinetic: o })), (!r(t.pinchRotate) || t.pinchRotate) && e.push(new Hh), (!r(t.pinchZoom) || t.pinchZoom) && e.push(new Jh({ duration: t.zoomDuration })), r(t.keyboard) && !t.keyboard || (e.push(new Gh), e.push(new Xh({ delta: t.zoomDelta, duration: t.zoomDuration }))), (!r(t.mouseWheelZoom) || t.mouseWheelZoom) && e.push(new Yh({ duration: t.zoomDuration })), (!r(t.shiftDragZoom) || t.shiftDragZoom) && e.push(new Bh), e
    }

    function tl(t) {
        var e = r(t) ? t : {};
        delete(t = xt(e)).layers, e = e.layers, ua.call(this, t), this.c = [], this.b = {}, Te(this, We("layers"), this.Wj, !1, this), null != e ? l(e) && (e = new Dr(e.slice())) : e = new Dr, this.Ah(e)
    }

    function el(t) { ni.call(this, { code: t, units: "m", extent: il, global: !0, worldExtent: rl }) }
    Eh.prototype.c = function() { return this.a }, Eh.prototype.f = function(t) { this.a = t, this.b = void 0 }, Eh.prototype.zb = function() { return r(this.b) || (this.b = "f" + (null === this.a ? "-" : Kr(this.a))), this.b }, A(Ih, La), (t = Ih.prototype).yb = function() { return this.j }, t.vm = function() { return this.f }, t.le = function() { return this.i }, t.Sb = function() { return this.a }, t.qd = function() { return 2 }, t.Ld = function() { return this.l }, t.Db = function() { return this.u }, t.wm = function() { return this.c }, t.fb = function() { return this.ca }, t.xm = function() { return this.b }, t.ef = s, t.load = s, t.Df = s, t.Tg = function(t, e, o, i) { e.setTransform(1, 0, 0, 1, 0, 0), e.translate(o, i), e.beginPath(), e.arc(t.size / 2, t.size / 2, this.c, 0, 2 * Math.PI, !0), null !== this.f && (e.fillStyle = Kr(this.f.a), e.fill()), null !== this.b && (e.strokeStyle = t.strokeStyle, e.lineWidth = t.ud, null === t.lineDash || e.setLineDash(t.lineDash), e.stroke()), e.closePath() }, t.Sg = function(t, e, o, i) { e.setTransform(1, 0, 0, 1, 0, 0), e.translate(o, i), e.beginPath(), e.arc(t.size / 2, t.size / 2, this.c, 0, 2 * Math.PI, !0), e.fillStyle = Ch, e.fill(), null !== this.b && (e.strokeStyle = t.strokeStyle, e.lineWidth = t.ud, null === t.lineDash || e.setLineDash(t.lineDash), e.stroke()), e.closePath() }, t.zb = function() {
        var t = null === this.b ? "-" : this.b.zb(),
            e = null === this.f ? "-" : this.f.zb();
        return null !== this.g && t == this.g[1] && e == this.g[2] && this.c == this.g[3] || (this.g = ["c" + t + e + (r(this.c) ? this.c.toString() : "-"), t, e, this.c]), this.g[0]
    }, (t = kh.prototype).Y = function() { return this.j }, t.cj = function() { return this.g }, t.Jm = function() { return this.f }, t.Km = function() { return this.i }, t.Lm = function() { return this.c }, t.Mm = function() { return this.b }, t.Gj = function() { return this.a }, t.Wg = function(t) { f(t) ? this.g = t : c(t) ? this.g = function(e) { return e.get(t) } : null === t ? this.g = Oh : r(t) && (this.g = function() { return t }), this.j = t }, t.jo = function(t) { this.a = t }, A(Bh, Sh), Bh.prototype.j = function() {
        var t = this.v,
            e = t.X(),
            o = Bo(r = this.Y().R()),
            i = t.Ca(),
            r = Math.max(Vo(r) / i[0], Uo(r) / i[1]);
        i = this.A, r = e.constrainResolution(r, 0, void 0), qa(t, e, r, o, i)
    }, A(Gh, za), A(Xh, za), A(Yh, za), Yh.prototype.l = function(t) {
        var e = Xt(this.c, -1, 1),
            o = t.X();
        t.render(), Ja(t, o, -e, this.i, this.u), this.c = 0, this.i = null, this.j = this.g = void 0
    }, A(Hh, sh), Hh.prototype.tc = qo, A(Jh, sh), Jh.prototype.tc = qo, A(tl, ua), (t = tl.prototype).Vd = function() { this.mb() && this.s() }, t.Wj = function() {
        H(this.c, Re), this.c.length = 0;
        var t, e, o, i = this.Gc();
        for (this.c.push(Te(i, "add", this.Vj, !1, this), Te(i, "remove", this.Xj, !1, this)), lt(this.b, (function(t) { H(t, Re) })), bt(this.b), t = 0, e = (i = i.b).length; t < e; t++) o = i[t], this.b[d(o).toString()] = [Te(o, "propertychange", this.Vd, !1, this), Te(o, "change", this.Vd, !1, this)];
        this.s()
    }, t.Vj = function(t) {
        var e = d(t = t.element).toString();
        this.b[e] = [Te(t, "propertychange", this.Vd, !1, this), Te(t, "change", this.Vd, !1, this)], this.s()
    }, t.Xj = function(t) { t = d(t.element).toString(), H(this.b[t], Re), delete this.b[t], this.s() }, t.Gc = function() { return this.get("layers") }, t.Ah = function(t) { this.set("layers", t) }, t.Ze = function(t) {
        var e, o, i = r(t) ? t : [],
            n = i.length;
        for (this.Gc().forEach((function(t) { t.Ze(i) })), t = ca(this), e = i.length; n < e; n++)(o = i[n]).brightness = Xt(o.brightness + t.brightness, -1, 1), o.contrast *= t.contrast, o.hue += t.hue, o.opacity *= t.opacity, o.saturation *= t.saturation, o.visible = o.visible && t.visible, o.maxResolution = Math.min(o.maxResolution, t.maxResolution), o.minResolution = Math.max(o.minResolution, t.minResolution), r(t.extent) && (o.extent = r(o.extent) ? Xo(o.extent, t.extent) : t.extent);
        return i
    }, t.af = function() { return "ready" }, A(el, ni), el.prototype.getPointResolution = function(t, e) { var o = e[1] / 6378137; return t / ((Math.exp(o) + Math.exp(-o)) / 2) };
    var ol = 6378137 * Math.PI,
        il = [-ol, -ol, ol, ol],
        rl = [-180, -85, 180, 85],
        nl = z("EPSG:3857 EPSG:102100 EPSG:102113 EPSG:900913 urn:ogc:def:crs:EPSG:6.18:3:3857 urn:ogc:def:crs:EPSG::3857 http://www.opengis.net/gml/srs/epsg.xml#3857".split(" "), (function(t) { return new el(t) }));

    function sl(t, e, o) {
        var i = t.length;
        o = 1 < o ? o : 2, r(e) || (e = 2 < o ? t.slice() : Array(i));
        for (var n = 0; n < i; n += o) e[n] = 6378137 * Math.PI * t[n] / 180, e[n + 1] = 6378137 * Math.log(Math.tan(Math.PI * (t[n + 1] + 90) / 360));
        return e
    }

    function pl(t, e, o) {
        var i = t.length;
        o = 1 < o ? o : 2, r(e) || (e = 2 < o ? t.slice() : Array(i));
        for (var n = 0; n < i; n += o) e[n] = 180 * t[n] / (6378137 * Math.PI), e[n + 1] = 360 * Math.atan(Math.exp(t[n + 1] / 6378137)) / Math.PI - 90;
        return e
    }

    function al(t, e) { ni.call(this, { code: t, units: "degrees", extent: hl, axisOrientation: e, global: !0, worldExtent: hl }) }
    A(al, ni), al.prototype.getPointResolution = function(t) { return t };
    var hl = [-180, -90, 180, 90],
        ll = [new al("CRS:84"), new al("EPSG:4326", "neu"), new al("urn:ogc:def:crs:EPSG::4326", "neu"), new al("urn:ogc:def:crs:EPSG:6.6:4326", "neu"), new al("urn:ogc:def:crs:OGC:1.3:CRS84"), new al("urn:ogc:def:crs:OGC:2:84"), new al("http://www.opengis.net/gml/srs/epsg.xml#4326", "neu"), new al("urn:x-ogc:def:crs:EPSG:4326", "neu")];

    function ul() {
        hi(nl), hi(ll),
            function() {
                var t = nl,
                    e = sl,
                    o = pl;
                H(ll, (function(i) { H(t, (function(t) { ci(i, t, e), ci(t, i, o) })) }))
            }()
    }

    function cl(t) { ga.call(this, r(t) ? t : {}) }

    function yl(t) {
        var e = xt(t = r(t) ? t : {});
        delete e.preload, delete e.useInterimTilesOnError, ga.call(this, e), this.f(r(t.preload) ? t.preload : 0), this.g(!r(t.useInterimTilesOnError) || t.useInterimTilesOnError)
    }

    function fl(t) {
        var e = xt(t = r(t) ? t : {});
        delete e.style, delete e.renderBuffer, delete e.updateWhileAnimating, delete e.updateWhileInteracting, ga.call(this, e), this.c = r(t.renderBuffer) ? t.renderBuffer : 100, this.j = null, this.b = void 0, this.g(t.style), this.u = !!r(t.updateWhileAnimating) && t.updateWhileAnimating, this.A = !!r(t.updateWhileInteracting) && t.updateWhileInteracting
    }

    function gl(t, e, o, i, r) { this.A = {}, this.c = t, this.ea = e, this.g = o, this.C = i, this.Uc = r, this.i = this.a = this.b = this.Ma = this.ra = this.fa = null, this.Na = this.xa = this.u = this.ba = this.T = this.N = 0, this.Xa = !1, this.j = this.qb = 0, this.rb = !1, this.Z = 0, this.f = "", this.B = this.ca = this.tb = this.sb = 0, this.aa = this.v = this.l = null, this.D = [], this.Bd = ho() }

    function dl(t, e, o) {
        if (null !== t.i) {
            e = Pi(e, 0, o, 2, t.C, t.D), o = t.c;
            var i = t.Bd,
                r = o.globalAlpha;
            1 != t.u && (o.globalAlpha = r * t.u);
            var n, s, p = t.qb;
            for (t.Xa && (p += t.Uc), n = 0, s = e.length; n < s; n += 2) {
                var a = e[n] - t.N,
                    h = e[n + 1] - t.T;
                if (t.rb && (a = a + .5 | 0, h = h + .5 | 0), 0 !== p || 1 != t.j) {
                    var l = a + t.N,
                        u = h + t.T;
                    ba(i, l, u, t.j, t.j, p, -l, -u), o.setTransform(i[0], i[1], i[4], i[5], i[12], i[13])
                }
                o.drawImage(t.i, t.xa, t.Na, t.Z, t.ba, a, h, t.Z, t.ba)
            }
            0 === p && 1 == t.j || o.setTransform(1, 0, 0, 1, 0, 0), 1 != t.u && (o.globalAlpha = r)
        }
    }

    function vl(t, e, o, i) {
        var r = 0;
        if (null !== t.aa && "" !== t.f) {
            null === t.l || Sl(t, t.l), null === t.v || xl(t, t.v);
            var n = t.aa,
                s = t.c,
                p = t.Ma;
            for (null === p ? (s.font = n.font, s.textAlign = n.textAlign, s.textBaseline = n.textBaseline, t.Ma = { font: n.font, textAlign: n.textAlign, textBaseline: n.textBaseline }) : (p.font != n.font && (p.font = s.font = n.font), p.textAlign != n.textAlign && (p.textAlign = s.textAlign = n.textAlign), p.textBaseline != n.textBaseline && (p.textBaseline = s.textBaseline = n.textBaseline)), e = Pi(e, r, o, i, t.C, t.D), n = t.c; r < o; r += i) {
                if (s = e[r] + t.sb, p = e[r + 1] + t.tb, 0 !== t.ca || 1 != t.B) {
                    var a = ba(t.Bd, s, p, t.B, t.B, t.ca, -s, -p);
                    n.setTransform(a[0], a[1], a[4], a[5], a[12], a[13])
                }
                null === t.v || n.strokeText(t.f, s, p), null === t.l || n.fillText(t.f, s, p)
            }
            0 === t.ca && 1 == t.B || n.setTransform(1, 0, 0, 1, 0, 0)
        }
    }

    function bl(t, e, o, i, r, n) { var s = t.c; for (t = Pi(e, o, i, r, t.C, t.D), s.moveTo(t[0], t[1]), e = 2; e < t.length; e += 2) s.lineTo(t[e], t[e + 1]); return n && s.lineTo(t[0], t[1]), i }

    function ml(t, e, o, i, r) { var n, s, p = t.c; for (n = 0, s = i.length; n < s; ++n) o = bl(t, e, o, i[n], r, !0), p.closePath(); return o }

    function wl(t) {
        var e, o, i, r, n, s = z(yt(t.A), Number);
        for (ot(s), e = 0, o = s.length; e < o; ++e)
            for (r = 0, n = (i = t.A[s[e].toString()]).length; r < n; ++r) i[r](t)
    }

    function Sl(t, e) {
        var o = t.c,
            i = t.fa;
        null === i ? (o.fillStyle = e.fillStyle, t.fa = { fillStyle: e.fillStyle }) : i.fillStyle != e.fillStyle && (i.fillStyle = o.fillStyle = e.fillStyle)
    }

    function xl(t, e) {
        var o = t.c,
            i = t.ra;
        null === i ? (o.lineCap = e.lineCap, yp && o.setLineDash(e.lineDash), o.lineJoin = e.lineJoin, o.lineWidth = e.lineWidth, o.miterLimit = e.miterLimit, o.strokeStyle = e.strokeStyle, t.ra = { lineCap: e.lineCap, lineDash: e.lineDash, lineJoin: e.lineJoin, lineWidth: e.lineWidth, miterLimit: e.miterLimit, strokeStyle: e.strokeStyle }) : (i.lineCap != e.lineCap && (i.lineCap = o.lineCap = e.lineCap), yp && !it(i.lineDash, e.lineDash) && o.setLineDash(i.lineDash = e.lineDash), i.lineJoin != e.lineJoin && (i.lineJoin = o.lineJoin = e.lineJoin), i.lineWidth != e.lineWidth && (i.lineWidth = o.lineWidth = e.lineWidth), i.miterLimit != e.miterLimit && (i.miterLimit = o.miterLimit = e.miterLimit), i.strokeStyle != e.strokeStyle && (i.strokeStyle = o.strokeStyle = e.strokeStyle))
    }
    A(cl, ga), A(yl, ga), yl.prototype.b = function() { return this.get("preload") }, yl.prototype.f = function(t) { this.set("preload", t) }, yl.prototype.c = function() { return this.get("useInterimTilesOnError") }, yl.prototype.g = function(t) { this.set("useInterimTilesOnError", t) }, A(fl, ga), fl.prototype.T = function() { return this.j }, fl.prototype.ba = function() { return this.b }, fl.prototype.g = function(t) { this.j = r(t) ? t : Fh, this.b = null === t ? void 0 : Nh(this.j), this.s() }, (t = gl.prototype).yc = function(t, e) {
        var o = t.toString(),
            i = this.A[o];
        r(i) ? i.push(e) : this.A[o] = [e]
    }, t.zc = function(t) {
        if (Ho(this.g, t.R())) {
            if (null !== this.b || null !== this.a) {
                var e;
                null === this.b || Sl(this, this.b), null === this.a || xl(this, this.a);
                var o = (e = null === (e = t.o) ? null : Pi(e, 0, e.length, t.H, this.C, this.D))[2] - e[0],
                    i = e[3] - e[1];
                o = Math.sqrt(o * o + i * i), (i = this.c).beginPath(), i.arc(e[0], e[1], o, 0, 2 * Math.PI), null === this.b || i.fill(), null === this.a || i.stroke()
            }
            "" !== this.f && vl(this, t.ld(), 2, 2)
        }
    }, t.Pe = function(t, e) {
        var o = (0, e.g)(t);
        if (null != o && Ho(this.g, o.R())) {
            var i = e.a;
            r(i) || (i = 0), this.yc(i, (function(t) { t.Ha(e.f, e.c), t.hb(e.i), t.Ia(e.b), Ml[o.U()].call(t, o, null) }))
        }
    }, t.Hd = function(t, e) {
        var o, i, r = t.f;
        for (o = 0, i = r.length; o < i; ++o) {
            var n = r[o];
            Ml[n.U()].call(this, n, e)
        }
    }, t.wb = function(t) {
        var e = t.o;
        t = t.H, null === this.i || dl(this, e, e.length), "" !== this.f && vl(this, e, e.length, t)
    }, t.vb = function(t) {
        var e = t.o;
        t = t.H, null === this.i || dl(this, e, e.length), "" !== this.f && vl(this, e, e.length, t)
    }, t.Gb = function(t) {
        if (Ho(this.g, t.R())) {
            if (null !== this.a) {
                xl(this, this.a);
                var e = this.c,
                    o = t.o;
                e.beginPath(), bl(this, o, 0, o.length, t.H, !1), e.stroke()
            }
            "" !== this.f && vl(this, t = ru(t), 2, 2)
        }
    }, t.Ac = function(t) {
        var e = t.R();
        if (Ho(this.g, e)) {
            if (null !== this.a) {
                xl(this, this.a), e = this.c;
                var o, i, r = t.o,
                    n = 0,
                    s = t.c,
                    p = t.H;
                for (e.beginPath(), o = 0, i = s.length; o < i; ++o) n = bl(this, r, n, s[o], p, !1);
                e.stroke()
            }
            "" !== this.f && vl(this, t = pu(t), t.length, 2)
        }
    }, t.Yb = function(t) {
        if (Ho(this.g, t.R())) {
            if (null !== this.a || null !== this.b) {
                null === this.b || Sl(this, this.b), null === this.a || xl(this, this.a);
                var e = this.c;
                e.beginPath(), ml(this, ar(t), 0, t.c, t.H), null === this.b || e.fill(), null === this.a || e.stroke()
            }
            "" !== this.f && vl(this, t = pr(t), 2, 2)
        }
    }, t.Bc = function(t) {
        if (Ho(this.g, t.R())) {
            if (null !== this.a || null !== this.b) {
                null === this.b || Sl(this, this.b), null === this.a || xl(this, this.a);
                var e, o, i = this.c,
                    r = yu(t),
                    n = 0,
                    s = t.c,
                    p = t.H;
                for (e = 0, o = s.length; e < o; ++e) {
                    var a = s[e];
                    i.beginPath(), n = ml(this, r, n, a, p), null === this.b || i.fill(), null === this.a || i.stroke()
                }
            }
            "" !== this.f && vl(this, t = cu(t), t.length, 2)
        }
    }, t.Ha = function(t, e) {
        if (null === t) this.b = null;
        else {
            var o = t.a;
            this.b = { fillStyle: Kr(null === o ? Ch : o) }
        }
        if (null === e) this.a = null;
        else {
            o = e.a;
            var i = e.f,
                n = e.c,
                s = e.g,
                p = e.b,
                a = e.i;
            this.a = { lineCap: r(i) ? i : "round", lineDash: null != n ? n : Rh, lineJoin: r(s) ? s : "round", lineWidth: this.ea * (r(p) ? p : 1), miterLimit: r(a) ? a : 10, strokeStyle: Kr(null === o ? Lh : o) }
        }
    }, t.hb = function(t) {
        if (null === t) this.i = null;
        else {
            var e = t.yb(),
                o = t.Sb(1),
                i = t.Db(),
                r = t.fb();
            this.N = e[0], this.T = e[1], this.ba = r[1], this.i = o, this.u = t.A, this.xa = i[0], this.Na = i[1], this.Xa = t.D, this.qb = t.B, this.j = t.v, this.rb = t.ea, this.Z = r[0]
        }
    }, t.Ia = function(t) {
        if (null === t) this.f = "";
        else {
            if (null === (e = t.a) ? this.l = null : (e = e.a, this.l = { fillStyle: Kr(null === e ? Ch : e) }), null === (p = t.i)) this.v = null;
            else {
                var e = p.a,
                    o = p.f,
                    i = p.c,
                    n = p.g,
                    s = p.b,
                    p = p.i;
                this.v = { lineCap: r(o) ? o : "round", lineDash: null != i ? i : Rh, lineJoin: r(n) ? n : "round", lineWidth: r(s) ? s : 1, miterLimit: r(p) ? p : 10, strokeStyle: Kr(null === e ? Lh : e) }
            }
            e = t.f, o = t.B, i = t.v, n = t.g, s = t.b, p = t.c;
            var a = t.j;
            t = t.l, this.aa = { font: r(e) ? e : "10px sans-serif", textAlign: r(a) ? a : "center", textBaseline: r(t) ? t : "middle" }, this.f = r(p) ? p : "", this.sb = r(o) ? this.ea * o : 0, this.tb = r(i) ? this.ea * i : 0, this.ca = r(n) ? n : 0, this.B = this.ea * (r(s) ? s : 1)
        }
    };
    var Ml = { Point: gl.prototype.wb, LineString: gl.prototype.Gb, Polygon: gl.prototype.Yb, MultiPoint: gl.prototype.vb, MultiLineString: gl.prototype.Ac, MultiPolygon: gl.prototype.Bc, GeometryCollection: gl.prototype.Hd, Circle: gl.prototype.zc };

    function Pl(t) { Sa.call(this, t), this.N = ho() }

    function Tl(t, e, o, i, n) {
        var s = t.b;
        Ue(s, e) && (t = r(n) ? n : jl(t, i, 0), Be(s, new fa(e, s, t = new gl(o, i.pixelRatio, i.extent, t, i.viewState.rotation), i, o, null)), wl(t))
    }

    function jl(t, e, o) {
        var i = e.viewState,
            r = e.pixelRatio;
        return ba(t.N, r * e.size[0] / 2, r * e.size[1] / 2, r / i.resolution, -r / i.resolution, -i.rotation, -i.center[0] + o, -i.center[1])
    }

    function Al(t, e) { var o = [0, 0]; return wa(e, t, o), o }
    A(Pl, Sa), Pl.prototype.u = function(t, e, o) {
        Tl(this, "precompose", o, t, void 0);
        var i = this.je();
        if (null !== i) {
            var n = r(l = e.extent);
            if (n) {
                var s = t.pixelRatio,
                    p = Ko(l),
                    a = Yo(l),
                    h = Oo(l),
                    l = Do(l);
                wa(t.coordinateToPixelMatrix, p, p), wa(t.coordinateToPixelMatrix, a, a), wa(t.coordinateToPixelMatrix, h, h), wa(t.coordinateToPixelMatrix, l, l), o.save(), o.beginPath(), o.moveTo(p[0] * s, p[1] * s), o.lineTo(a[0] * s, a[1] * s), o.lineTo(h[0] * s, h[1] * s), o.lineTo(l[0] * s, l[1] * s), o.clip()
            }
            s = this.cg(), p = o.globalAlpha, o.globalAlpha = e.opacity, 0 === t.viewState.rotation ? (e = s[13], a = i.width * s[0], h = i.height * s[5], o.drawImage(i, 0, 0, +i.width, +i.height, Math.round(s[12]), Math.round(e), Math.round(a), Math.round(h))) : (o.setTransform(s[0], s[1], s[4], s[5], s[12], s[13]), o.drawImage(i, 0, 0), o.setTransform(1, 0, 0, 1, 0, 0)), o.globalAlpha = p, n && o.restore()
        }
        Tl(this, "postcompose", o, t, void 0)
    };
    var Cl = function() {
            var t = null,
                e = null;
            return function(o) {
                null === t && (t = ip(1, 1), (i = (e = t.createImageData(1, 1)).data)[0] = 42, i[1] = 84, i[2] = 126, i[3] = 255);
                var i = t.canvas,
                    r = o[0] <= i.width && o[1] <= i.height;
                return r || (i.width = o[0], i.height = o[1], i = o[0] - 1, o = o[1] - 1, t.putImageData(e, i, o), o = t.getImageData(i, o, 1, 1), r = it(e.data, o.data)), r
            }
        }(),
        Rl = ["Polygon", "LineString", "Image", "Text"];

    function Ll(t, e, o) { this.Ma = t, this.Z = e, this.f = null, this.g = 0, this.resolution = o, this.T = this.N = null, this.b = [], this.coordinates = [], this.fa = ho(), this.a = [], this.aa = [], this.ra = ho() }

    function El(t, e, o, i, r, n) {
        var s, p, a, h = t.coordinates.length,
            l = t.Te(),
            u = [e[o], e[o + 1]],
            c = [NaN, NaN],
            y = !0;
        for (s = o + r; s < i; s += r) c[0] = e[s], c[1] = e[s + 1], (a = Co(l, c)) !== p ? (y && (t.coordinates[h++] = u[0], t.coordinates[h++] = u[1]), t.coordinates[h++] = c[0], t.coordinates[h++] = c[1], y = !1) : 1 === a ? (t.coordinates[h++] = c[0], t.coordinates[h++] = c[1], y = !1) : y = !0, u[0] = c[0], u[1] = c[1], p = a;
        return s === o + r && (t.coordinates[h++] = u[0], t.coordinates[h++] = u[1]), n && (t.coordinates[h++] = e[o], t.coordinates[h++] = e[o + 1]), h
    }

    function Il(t, e) { t.N = [0, e, 0], t.b.push(t.N), t.T = [0, e, 0], t.a.push(t.T) }

    function kl(t, e, o, i, n, s, p, a, h) {
        var l;
        ma(i, t.fa) ? l = t.aa : (l = Pi(t.coordinates, 0, t.coordinates.length, 2, i, t.aa), co(t.fa, i)), i = 0;
        var u, c = p.length,
            y = 0;
        for (t = t.ra; i < c;) {
            var f, g, v, b, m = p[i];
            switch (m[0]) {
                case 0:
                    r(s[u = d(y = m[1]).toString()]) || r(h) && !Ho(h, y.Y().R()) ? i = m[2] : ++i;
                    break;
                case 1:
                    e.beginPath(), ++i;
                    break;
                case 2:
                    u = l[y = m[1]];
                    var w = l[y + 1],
                        S = l[y + 2] - u;
                    y = l[y + 3] - w, e.arc(u, w, Math.sqrt(S * S + y * y), 0, 2 * Math.PI, !0), ++i;
                    break;
                case 3:
                    e.closePath(), ++i;
                    break;
                case 4:
                    y = m[1], u = m[2], f = m[3], v = m[4] * o;
                    var x = m[5] * o,
                        M = m[6];
                    g = m[7];
                    var P = m[8],
                        T = m[9],
                        j = (w = m[11], S = m[12], m[13]),
                        A = m[14];
                    for (m[10] && (w += n); y < u; y += 2) {
                        if (m = l[y] - v, b = l[y + 1] - x, j && (m = m + .5 | 0, b = b + .5 | 0), 1 != S || 0 !== w) {
                            var C = m + v,
                                R = b + x;
                            ba(t, C, R, S, S, w, -C, -R), e.setTransform(t[0], t[1], t[4], t[5], t[12], t[13])
                        }
                        C = e.globalAlpha, 1 != g && (e.globalAlpha = C * g), e.drawImage(f, P, T, A, M, m, b, A * o, M * o), 1 != g && (e.globalAlpha = C), 1 == S && 0 === w || e.setTransform(1, 0, 0, 1, 0, 0)
                    }++i;
                    break;
                case 5:
                    for (y = m[1], u = m[2], v = m[3], x = m[4] * o, M = m[5] * o, w = m[6], S = m[7] * o, f = m[8], g = m[9]; y < u; y += 2) m = l[y] + x, b = l[y + 1] + M, 1 == S && 0 === w || (ba(t, m, b, S, S, w, -m, -b), e.setTransform(t[0], t[1], t[4], t[5], t[12], t[13])), g && e.strokeText(v, m, b), f && e.fillText(v, m, b), 1 == S && 0 === w || e.setTransform(1, 0, 0, 1, 0, 0);
                    ++i;
                    break;
                case 6:
                    if (r(a) && (y = a(y = m[1]))) return y;
                    ++i;
                    break;
                case 7:
                    e.fill(), ++i;
                    break;
                case 8:
                    for (y = m[1], u = m[2], e.moveTo(l[y], l[y + 1]), y += 2; y < u; y += 2) e.lineTo(l[y], l[y + 1]);
                    ++i;
                    break;
                case 9:
                    e.fillStyle = m[1], ++i;
                    break;
                case 10:
                    y = !r(m[7]) || m[7], u = m[2], e.strokeStyle = m[1], e.lineWidth = y ? u * o : u, e.lineCap = m[3], e.lineJoin = m[4], e.miterLimit = m[5], yp && e.setLineDash(m[6]), ++i;
                    break;
                case 11:
                    e.font = m[1], e.textAlign = m[2], e.textBaseline = m[3], ++i;
                    break;
                case 12:
                    e.stroke(), ++i;
                    break;
                default:
                    ++i
            }
        }
    }

    function Nl(t) {
        var e = t.a;
        e.reverse();
        var o, i, r, n = e.length,
            s = -1;
        for (o = 0; o < n; ++o)
            if (6 == (r = (i = e[o])[0])) s = o;
            else if (0 == r) {
            for (i[2] = o, i = t.a, r = o; s < r;) {
                var p = i[s];
                i[s] = i[r], i[r] = p, ++s, --r
            }
            s = -1
        }
    }

    function Fl(t, e) {
        t.N[2] = t.b.length, t.N = null, t.T[2] = t.a.length, t.T = null;
        var o = [6, e];
        t.b.push(o), t.a.push(o)
    }

    function Dl(t, e, o) { Ll.call(this, t, e, o), this.l = this.ba = null, this.C = this.ca = this.ea = this.D = this.A = this.u = this.v = this.B = this.j = this.i = this.c = void 0 }

    function Ol(t, e, o) { Ll.call(this, t, e, o), this.c = { cd: void 0, Yc: void 0, Zc: null, $c: void 0, ad: void 0, bd: void 0, df: 0, strokeStyle: void 0, lineCap: void 0, lineDash: null, lineJoin: void 0, lineWidth: void 0, miterLimit: void 0 } }

    function Bl(t, e, o, i, r) { var n = t.coordinates.length; return n = [8, n, e = El(t, e, o, i, r, !1)], t.b.push(n), t.a.push(n), i }

    function Gl(t) {
        var e = t.c,
            o = e.strokeStyle,
            i = e.lineCap,
            r = e.lineDash,
            n = e.lineJoin,
            s = e.lineWidth,
            p = e.miterLimit;
        e.cd == o && e.Yc == i && it(e.Zc, r) && e.$c == n && e.ad == s && e.bd == p || (e.df != t.coordinates.length && (t.b.push([12]), e.df = t.coordinates.length), t.b.push([10, o, s, i, n, p, r], [1]), e.cd = o, e.Yc = i, e.Zc = r, e.$c = n, e.ad = s, e.bd = p)
    }

    function Ul(t, e, o) { Ll.call(this, t, e, o), this.c = { Sf: void 0, cd: void 0, Yc: void 0, Zc: null, $c: void 0, ad: void 0, bd: void 0, fillStyle: void 0, strokeStyle: void 0, lineCap: void 0, lineDash: null, lineJoin: void 0, lineWidth: void 0, miterLimit: void 0 } }

    function Xl(t, e, o, i, n) {
        var s, p = t.c,
            a = [1];
        for (t.b.push(a), t.a.push(a), a = 0, s = i.length; a < s; ++a) {
            var h = i[a],
                l = t.coordinates.length;
            o = [8, l, o = El(t, e, o, h, n, !0)], l = [3], t.b.push(o, l), t.a.push(o, l), o = h
        }
        return e = [7], t.a.push(e), r(p.fillStyle) && t.b.push(e), r(p.strokeStyle) && (p = [12], t.b.push(p), t.a.push(p)), o
    }

    function Kl(t) {
        var e = t.c,
            o = e.fillStyle,
            i = e.strokeStyle,
            n = e.lineCap,
            s = e.lineDash,
            p = e.lineJoin,
            a = e.lineWidth,
            h = e.miterLimit;
        r(o) && e.Sf != o && (t.b.push([9, o]), e.Sf = e.fillStyle), !r(i) || e.cd == i && e.Yc == n && e.Zc == s && e.$c == p && e.ad == a && e.bd == h || (t.b.push([10, i, a, n, p, h, s]), e.cd = i, e.Yc = n, e.Zc = s, e.$c = p, e.ad = a, e.bd = h)
    }

    function Yl(t, e, o) { Ll.call(this, t, e, o), this.ca = this.ea = this.D = null, this.l = "", this.A = this.u = this.v = this.B = 0, this.j = this.i = this.c = null }

    function Vl(t, e, o, i) { this.l = t, this.c = e, this.j = o, this.f = i, this.b = {}, this.g = ip(1, 1), this.i = ho() }

    function Hl(t) { for (var e in t.b) { var o, i = t.b[e]; for (o in i) i[o].he() } }

    function Wl(t, e, o, i, n, s) {
        var p = t.i;
        ba(p, .5, .5, 1 / o, -1 / o, -i, -e[0], -e[1]);
        var a, h = t.g;
        return h.clearRect(0, 0, 1, 1), r(t.f) && (ko(a = [1 / 0, 1 / 0, -1 / 0, -1 / 0], e), xo(a, o * t.f, a)),
            function(t, e, o, i, n, s, p) {
                var a, h, l, u, c, y = z(yt(t.b), Number);
                for (ot(y, (function(t, e) { return e - t })), a = 0, h = y.length; a < h; ++a)
                    for (u = t.b[y[a].toString()], l = Rl.length - 1; 0 <= l; --l)
                        if (r(c = u[Rl[l]]) && (c = kl(c, e, 1, o, i, n, c.a, s, p))) return c
            }(t, h, p, i, n, (function(t) {
                if (0 < h.getImageData(0, 0, 1, 1).data[3]) {
                    if (t = s(t)) return t;
                    h.clearRect(0, 0, 1, 1)
                }
            }), a)
    }

    function zl(t, e, o, i, n, s) {
        var p = z(yt(t.b), Number);
        ot(p);
        var a, h, l, u = (a = t.c)[0],
            c = a[1],
            y = a[2];
        for (Pi(u = [u, c, u, a = a[3], y, a, y, c], 0, 8, 2, i, u), e.save(), e.beginPath(), e.moveTo(u[0], u[1]), e.lineTo(u[2], u[3]), e.lineTo(u[4], u[5]), e.lineTo(u[6], u[7]), e.closePath(), e.clip(), u = 0, c = p.length; u < c; ++u)
            for (h = t.b[p[u].toString()], y = 0, a = Rl.length; y < a; ++y) r(l = h[Rl[y]]) && kl(l, e, o, i, n, s, l.b, void 0);
        e.restore()
    }
    A(Ll, ya), Ll.prototype.he = s, Ll.prototype.Te = function() { return this.Z }, A(Dl, Ll), Dl.prototype.wb = function(t, e) {
        if (null !== this.l) {
            Il(this, e);
            var o = t.o,
                i = this.coordinates.length;
            o = El(this, o, 0, o.length, t.H, !1), this.b.push([4, i, o, this.l, this.c, this.i, this.j, this.B, this.v, this.u, this.A, this.D, this.ea, this.ca, this.C]), this.a.push([4, i, o, this.ba, this.c, this.i, this.j, this.B, this.v, this.u, this.A, this.D, this.ea, this.ca, this.C]), Fl(this, e)
        }
    }, Dl.prototype.vb = function(t, e) {
        if (null !== this.l) {
            Il(this, e);
            var o = t.o,
                i = this.coordinates.length;
            o = El(this, o, 0, o.length, t.H, !1), this.b.push([4, i, o, this.l, this.c, this.i, this.j, this.B, this.v, this.u, this.A, this.D, this.ea, this.ca, this.C]), this.a.push([4, i, o, this.ba, this.c, this.i, this.j, this.B, this.v, this.u, this.A, this.D, this.ea, this.ca, this.C]), Fl(this, e)
        }
    }, Dl.prototype.he = function() { Nl(this), this.i = this.c = void 0, this.l = this.ba = null, this.C = this.ca = this.D = this.A = this.u = this.v = this.B = this.ea = this.j = void 0 }, Dl.prototype.hb = function(t) {
        var e = t.yb(),
            o = t.fb(),
            i = t.le(1),
            r = t.Sb(1),
            n = t.Db();
        this.c = e[0], this.i = e[1], this.ba = i, this.l = r, this.j = o[1], this.B = t.A, this.v = n[0], this.u = n[1], this.A = t.D, this.D = t.B, this.ea = t.v, this.ca = t.ea, this.C = o[0]
    }, A(Ol, Ll), (t = Ol.prototype).Te = function() { return null === this.f && (this.f = Mo(this.Z), 0 < this.g && xo(this.f, this.resolution * (this.g + 1) / 2, this.f)), this.f }, t.Gb = function(t, e) {
        var o = this.c,
            i = o.lineWidth;
        r(o.strokeStyle) && r(i) && (Gl(this), Il(this, e), this.a.push([10, o.strokeStyle, o.lineWidth, o.lineCap, o.lineJoin, o.miterLimit, o.lineDash], [1]), Bl(this, o = t.o, 0, o.length, t.H), this.a.push([12]), Fl(this, e))
    }, t.Ac = function(t, e) {
        var o = (s = this.c).lineWidth;
        if (r(s.strokeStyle) && r(o)) {
            Gl(this), Il(this, e), this.a.push([10, s.strokeStyle, s.lineWidth, s.lineCap, s.lineJoin, s.miterLimit, s.lineDash], [1]);
            var i, n, s = t.c,
                p = (o = t.o, t.H),
                a = 0;
            for (i = 0, n = s.length; i < n; ++i) a = Bl(this, o, a, s[i], p);
            this.a.push([12]), Fl(this, e)
        }
    }, t.he = function() { this.c.df != this.coordinates.length && this.b.push([12]), Nl(this), this.c = null }, t.Ha = function(t, e) {
        var o = e.a;
        this.c.strokeStyle = Kr(null === o ? Lh : o), o = e.f, this.c.lineCap = r(o) ? o : "round", o = e.c, this.c.lineDash = null === o ? Rh : o, o = e.g, this.c.lineJoin = r(o) ? o : "round", o = e.b, this.c.lineWidth = r(o) ? o : 1, o = e.i, this.c.miterLimit = r(o) ? o : 10, this.c.lineWidth > this.g && (this.g = this.c.lineWidth, this.f = null)
    }, A(Ul, Ll), (t = Ul.prototype).zc = function(t, e) {
        var o = this.c,
            i = o.strokeStyle;
        if (r(o.fillStyle) || r(i)) {
            Kl(this), Il(this, e), this.a.push([9, Kr(Ch)]), r(o.strokeStyle) && this.a.push([10, o.strokeStyle, o.lineWidth, o.lineCap, o.lineJoin, o.miterLimit, o.lineDash]);
            var n = t.o;
            i = this.coordinates.length, El(this, n, 0, n.length, t.H, !1), n = [1], i = [2, i], this.b.push(n, i), this.a.push(n, i), i = [7], this.a.push(i), r(o.fillStyle) && this.b.push(i), r(o.strokeStyle) && (o = [12], this.b.push(o), this.a.push(o)), Fl(this, e)
        }
    }, t.Yb = function(t, e) {
        var o = this.c,
            i = o.strokeStyle;
        (r(o.fillStyle) || r(i)) && (Kl(this), Il(this, e), this.a.push([9, Kr(Ch)]), r(o.strokeStyle) && this.a.push([10, o.strokeStyle, o.lineWidth, o.lineCap, o.lineJoin, o.miterLimit, o.lineDash]), o = t.c, Xl(this, i = ar(t), 0, o, t.H), Fl(this, e))
    }, t.Bc = function(t, e) {
        var o = (s = this.c).strokeStyle;
        if (r(s.fillStyle) || r(o)) {
            Kl(this), Il(this, e), this.a.push([9, Kr(Ch)]), r(s.strokeStyle) && this.a.push([10, s.strokeStyle, s.lineWidth, s.lineCap, s.lineJoin, s.miterLimit, s.lineDash]);
            var i, n, s = t.c,
                p = (o = yu(t), t.H),
                a = 0;
            for (i = 0, n = s.length; i < n; ++i) a = Xl(this, o, a, s[i], p);
            Fl(this, e)
        }
    }, t.he = function() { Nl(this), this.c = null; var t = this.Ma; if (0 !== t) { var e, o, i = this.coordinates; for (e = 0, o = i.length; e < o; ++e) i[e] = t * Math.round(i[e] / t) } }, t.Te = function() { return null === this.f && (this.f = Mo(this.Z), 0 < this.g && xo(this.f, this.resolution * (this.g + 1) / 2, this.f)), this.f }, t.Ha = function(t, e) {
        var o = this.c;
        if (null === t) o.fillStyle = void 0;
        else {
            var i = t.a;
            o.fillStyle = Kr(null === i ? Ch : i)
        }
        null === e ? (o.strokeStyle = void 0, o.lineCap = void 0, o.lineDash = null, o.lineJoin = void 0, o.lineWidth = void 0, o.miterLimit = void 0) : (i = e.a, o.strokeStyle = Kr(null === i ? Lh : i), i = e.f, o.lineCap = r(i) ? i : "round", i = e.c, o.lineDash = null === i ? Rh : i.slice(), i = e.g, o.lineJoin = r(i) ? i : "round", i = e.b, o.lineWidth = r(i) ? i : 1, i = e.i, o.miterLimit = r(i) ? i : 10, o.lineWidth > this.g && (this.g = o.lineWidth, this.f = null))
    }, A(Yl, Ll), Yl.prototype.xb = function(t, e, o, i, r, n) {
        if ("" !== this.l && null !== this.j && (null !== this.c || null !== this.i)) {
            if (null !== this.c) {
                r = this.c;
                var s = this.D;
                if (null === s || s.fillStyle != r.fillStyle) {
                    var p = [9, r.fillStyle];
                    this.b.push(p), this.a.push(p), null === s ? this.D = { fillStyle: r.fillStyle } : s.fillStyle = r.fillStyle
                }
            }
            null !== this.i && (r = this.i, null === (s = this.ea) || s.lineCap != r.lineCap || s.lineDash != r.lineDash || s.lineJoin != r.lineJoin || s.lineWidth != r.lineWidth || s.miterLimit != r.miterLimit || s.strokeStyle != r.strokeStyle) && (p = [10, r.strokeStyle, r.lineWidth, r.lineCap, r.lineJoin, r.miterLimit, r.lineDash, !1], this.b.push(p), this.a.push(p), null === s ? this.ea = { lineCap: r.lineCap, lineDash: r.lineDash, lineJoin: r.lineJoin, lineWidth: r.lineWidth, miterLimit: r.miterLimit, strokeStyle: r.strokeStyle } : (s.lineCap = r.lineCap, s.lineDash = r.lineDash, s.lineJoin = r.lineJoin, s.lineWidth = r.lineWidth, s.miterLimit = r.miterLimit, s.strokeStyle = r.strokeStyle)), r = this.j, null !== (s = this.ca) && s.font == r.font && s.textAlign == r.textAlign && s.textBaseline == r.textBaseline || (p = [11, r.font, r.textAlign, r.textBaseline], this.b.push(p), this.a.push(p), null === s ? this.ca = { font: r.font, textAlign: r.textAlign, textBaseline: r.textBaseline } : (s.font = r.font, s.textAlign = r.textAlign, s.textBaseline = r.textBaseline)), Il(this, n), t = [5, r = this.coordinates.length, t = El(this, t, e, o, i, !1), this.l, this.B, this.v, this.u, this.A, null !== this.c, null !== this.i], this.b.push(t), this.a.push(t), Fl(this, n)
        }
    }, Yl.prototype.Ia = function(t) {
        if (null === t) this.l = "";
        else {
            if (null === (e = t.a) ? this.c = null : (e = Kr(null === (e = e.a) ? Ch : e), null === this.c ? this.c = { fillStyle: e } : this.c.fillStyle = e), null === (p = t.i)) this.i = null;
            else {
                var e = p.a,
                    o = p.f,
                    i = p.c,
                    n = p.g,
                    s = p.b,
                    p = p.i;
                o = r(o) ? o : "round", i = null != i ? i.slice() : Rh, n = r(n) ? n : "round", s = r(s) ? s : 1, p = r(p) ? p : 10, e = Kr(null === e ? Lh : e), null === this.i ? this.i = { lineCap: o, lineDash: i, lineJoin: n, lineWidth: s, miterLimit: p, strokeStyle: e } : ((h = this.i).lineCap = o, h.lineDash = i, h.lineJoin = n, h.lineWidth = s, h.miterLimit = p, h.strokeStyle = e)
            }
            var a = t.f,
                h = (e = t.B, o = t.v, i = t.g, s = t.b, p = t.c, n = t.j, t.l);
            t = r(a) ? a : "10px sans-serif", n = r(n) ? n : "center", h = r(h) ? h : "middle", null === this.j ? this.j = { font: t, textAlign: n, textBaseline: h } : ((a = this.j).font = t, a.textAlign = n, a.textBaseline = h), this.l = r(p) ? p : "", this.B = r(e) ? e : 0, this.v = r(o) ? o : 0, this.u = r(i) ? i : 0, this.A = r(s) ? s : 1
        }
    }, Vl.prototype.a = function(t, e) {
        var o = r(t) ? t.toString() : "0",
            i = this.b[o];
        return r(i) || (i = {}, this.b[o] = i), r(o = i[e]) || (o = new Zl[e](this.l, this.c, this.j), i[e] = o), o
    }, Vl.prototype.wa = function() { return vt(this.b) };
    var Zl = { Image: Dl, LineString: Ol, Polygon: Ul, Text: Yl };

    function Jl(t, e, o) { Ti.call(this), this.Af(t, r(e) ? e : 0, o) }

    function ql(t) { var e = t.o[t.H] - t.o[0]; return e * e + (t = t.o[t.H + 1] - t.o[1]) * t }

    function $l(t) { Mi.call(this), this.f = r(t) ? t : null, tu(this) }

    function _l(t) { var e, o, i = []; for (e = 0, o = t.length; e < o; ++e) i.push(t[e].clone()); return i }

    function Ql(t) {
        var e, o;
        if (null !== t.f)
            for (e = 0, o = t.f.length; e < o; ++e) Ce(t.f[e], "change", t.s, !1, t)
    }

    function tu(t) {
        var e, o;
        if (null !== t.f)
            for (e = 0, o = t.f.length; e < o; ++e) Te(t.f[e], "change", t.s, !1, t)
    }

    function eu(t, e, o, i, r) {
        var n = NaN,
            s = NaN;
        if (0 != (h = (o - e) / i))
            if (1 == h) n = t[e], s = t[e + 1];
            else if (2 == h) n = .5 * t[e] + .5 * t[e + i], s = .5 * t[e + 1] + .5 * t[e + i + 1];
        else {
            s = t[e];
            var p, a, h = t[e + 1],
                l = 0;
            for (n = [0], p = e + i; p < o; p += i) {
                var u = t[p],
                    c = t[p + 1];
                l += Math.sqrt((u - s) * (u - s) + (c - h) * (c - h)), n.push(l), s = u, h = c
            }
            for (o = .5 * l, s = rt, h = 0, l = n.length; h < l;) 0 < (u = s(o, n[p = h + l >> 1])) ? h = p + 1 : (l = p, a = !u);
            0 > (a = a ? h : ~h) ? (o = (o - n[-a - 2]) / (n[-a - 1] - n[-a - 2]), n = Yt(t[e += (-a - 2) * i], t[e + i], o), s = Yt(t[e + 1], t[e + i + 1], o)) : (n = t[e + a * i], s = t[e + a * i + 1])
        }
        return null != r ? (r[0] = n, r[1] = s, r) : [n, s]
    }

    function ou(t, e, o, i, r, n) { if (o == e) return null; if (r < t[e + i - 1]) return n ? ((o = t.slice(e, e + i))[i - 1] = r, o) : null; if (t[o - 1] < r) return n ? ((o = t.slice(o - i, o))[i - 1] = r, o) : null; if (r == t[e + i - 1]) return t.slice(e, e + i); for (e /= i, o /= i; e < o;) r < t[(1 + (n = e + o >> 1)) * i - 1] ? o = n : e = n + 1; if (r == (o = t[e * i - 1])) return t.slice((e - 1) * i, (e - 1) * i + i); var s; for (n = (r - o) / (t[(e + 1) * i - 1] - o), o = [], s = 0; s < i - 1; ++s) o.push(Yt(t[(e - 1) * i + s], t[e * i + s], n)); return o.push(r), o }

    function iu(t, e) { Ti.call(this), this.c = null, this.A = this.D = this.j = -1, this.ja(t, e) }

    function ru(t) { return t.j != t.a && (t.c = eu(t.o, 0, t.o.length, t.H, t.c), t.j = t.a), t.c }

    function nu(t, e, o) { Ai(t, e, o), t.s() }

    function su(t, e) { Ti.call(this), this.c = [], this.j = this.A = -1, this.ja(t, e) }

    function pu(t) {
        var e, o, i = [],
            r = t.o,
            n = 0,
            s = t.c;
        for (t = t.H, e = 0, o = s.length; e < o; ++e) {
            var p = s[e];
            tt(i, n = eu(r, n, p, t)), n = p
        }
        return i
    }

    function au(t, e, o, i) { Ai(t, e, o), t.c = i, t.s() }

    function hu(t, e) {
        var o, i, r = "XY",
            n = [],
            s = [];
        for (o = 0, i = e.length; o < i; ++o) {
            var p = e[o];
            0 === o && (r = p.b), tt(n, p.o), s.push(n.length)
        }
        au(t, r, n, s)
    }

    function lu(t, e) { Ti.call(this), this.ja(t, e) }

    function uu(t, e) { Ti.call(this), this.c = [], this.A = -1, this.D = null, this.T = this.C = this.N = -1, this.j = null, this.ja(t, e) }

    function cu(t) {
        if (t.A != t.a) {
            var e, o, i = t.o,
                r = t.c,
                n = t.H,
                s = 0,
                p = [],
                a = [1 / 0, 1 / 0, -1 / 0, -1 / 0];
            for (e = 0, o = r.length; e < o; ++e) {
                var h = r[e];
                a = No(Ro(1 / 0, 1 / 0, -1 / 0, -1 / 0, void 0), i, s, h[0], n), p.push((a[0] + a[2]) / 2, (a[1] + a[3]) / 2), s = h[h.length - 1]
            }
            for (i = yu(t), r = t.c, n = t.H, s = 0, e = [], o = 0, a = r.length; o < a; ++o) e = _i(i, s, h = r[o], n, p, 2 * o, e), s = h[h.length - 1];
            t.D = e, t.A = t.a
        }
        return t.D
    }

    function yu(t) {
        if (t.T != t.a) {
            var e, o = t.o;
            t: {
                var i, r;
                for (i = 0, r = (e = t.c).length; i < r; ++i)
                    if (!ir(o, e[i], t.H, void 0)) { e = !1; break t }
                e = !0
            }
            e ? t.j = o : (t.j = o.slice(), t.j.length = nr(t.j, t.c, t.H)), t.T = t.a
        }
        return t.j
    }

    function fu(t, e, o, i) { Ai(t, e, o), t.c = i, t.s() }

    function gu(t, e) {
        var o, i, r, n = "XY",
            s = [],
            p = [];
        for (o = 0, i = e.length; o < i; ++o) {
            var a = e[o];
            0 === o && (n = a.b);
            var h, l, u = s.length;
            for (h = 0, l = (r = a.c).length; h < l; ++h) r[h] += u;
            tt(s, a.o), p.push(r)
        }
        fu(t, n, s, p)
    }

    function du(t, e) { return d(t) - d(e) }

    function vu(t, e) { var o = .5 * t / e; return o * o }

    function bu(t, e, o, i, r, n) { var s, p, a = !1; return null !== (s = o.i) && (2 == (p = s.qd()) || 3 == p ? s.Df(r, n) : (0 == p && s.load(), s.ef(r, n), a = !0)), null != (r = (0, o.g)(e)) && (i = r.$e(i), (0, mu[i.U()])(t, i, o, e)), a }
    A(Jl, Ti), (t = Jl.prototype).clone = function() { var t = new Jl(null); return Ai(t, this.b, this.o.slice()), t.s(), t }, t.Ya = function(t, e, o, i) {
        var r = this.o;
        t -= r[0];
        var n = e - r[1];
        if ((e = t * t + n * n) < i) {
            if (0 === e)
                for (i = 0; i < this.H; ++i) o[i] = r[i];
            else
                for (i = this.lf() / Math.sqrt(e), o[0] = r[0] + i * t, o[1] = r[1] + i * n, i = 2; i < this.H; ++i) o[i] = r[i];
            return o.length = this.H, e
        }
        return i
    }, t.gc = function(t, e) { var o, i = t - (o = this.o)[0]; return i * i + (o = e - o[1]) * o <= ql(this) }, t.ld = function() { return this.o.slice(0, this.H) }, t.Ed = function(t) {
        var e = this.o,
            o = e[this.H] - e[0];
        return Ro(e[0] - o, e[1] - o, e[0] + o, e[1] + o, t)
    }, t.lf = function() { return Math.sqrt(ql(this)) }, t.U = function() { return "Circle" }, t.sa = function(t) { var e = this.R(); return !!Ho(t, e) && (e = this.ld(), t[0] <= e[0] && t[2] >= e[0] || t[1] <= e[1] && t[3] >= e[1] || Fo(t, this.Ne, this)) }, t.ll = function(t) {
        var e, o = this.H,
            i = t.slice();
        for (i[o] = i[0] + (this.o[o] - this.o[0]), e = 1; e < o; ++e) i[o + e] = t[e];
        Ai(this, this.b, i), this.s()
    }, t.Af = function(t, e, o) {
        if (null === t) Ai(this, "XY", null);
        else {
            var i;
            for (Ci(this, o, t, 0), null === this.o && (this.o = []), t = Bi(o = this.o, t), o[t++] = o[0] + e, e = 1, i = this.H; e < i; ++e) o[t++] = o[e];
            o.length = t
        }
        this.s()
    }, t.ml = function(t) { this.o[this.H] = this.o[0] + t, this.s() }, A($l, Mi), (t = $l.prototype).clone = function() { var t = new $l(null); return t.xh(this.f), t }, t.Ya = function(t, e, o, i) { if (i < Po(this.R(), t, e)) return i; var r, n, s = this.f; for (r = 0, n = s.length; r < n; ++r) i = s[r].Ya(t, e, o, i); return i }, t.gc = function(t, e) {
        var o, i, r = this.f;
        for (o = 0, i = r.length; o < i; ++o)
            if (r[o].gc(t, e)) return !0;
        return !1
    }, t.Ed = function(t) { Ro(1 / 0, 1 / 0, -1 / 0, -1 / 0, t); for (var e = this.f, o = 0, i = e.length; o < i; ++o) Io(t, e[o].R()); return t }, t.ag = function() { return _l(this.f) }, t.$e = function(t) {
        if (this.l != this.a && (bt(this.g), this.i = 0, this.l = this.a), 0 > t || 0 !== this.i && t < this.i) return this;
        var e = t.toString();
        if (this.g.hasOwnProperty(e)) return this.g[e];
        var o, i, r = [],
            n = this.f,
            s = !1;
        for (o = 0, i = n.length; o < i; ++o) {
            var p = n[o],
                a = p.$e(t);
            r.push(a), a !== p && (s = !0)
        }
        return s ? (Ql(t = new $l(null)), t.f = r, tu(t), t.s(), this.g[e] = t) : (this.i = t, this)
    }, t.U = function() { return "GeometryCollection" }, t.sa = function(t) {
        var e, o, i = this.f;
        for (e = 0, o = i.length; e < o; ++e)
            if (i[e].sa(t)) return !0;
        return !1
    }, t.wa = function() { return 0 == this.f.length }, t.xh = function(t) { t = _l(t), Ql(this), this.f = t, tu(this), this.s() }, t.va = function(t) {
        var e, o, i = this.f;
        for (e = 0, o = i.length; e < o; ++e) i[e].va(t);
        this.s()
    }, t.Ua = function(t, e) {
        var o, i, r = this.f;
        for (o = 0, i = r.length; o < i; ++o) r[o].Ua(t, e);
        this.s()
    }, t.W = function() { Ql(this), $l.$.W.call(this) }, A(iu, Ti), (t = iu.prototype).yi = function(t) { null === this.o ? this.o = t.slice() : tt(this.o, t), this.s() }, t.clone = function() { var t = new iu(null); return nu(t, this.b, this.o.slice()), t }, t.Ya = function(t, e, o, i) { return i < Po(this.R(), t, e) ? i : (this.A != this.a && (this.D = Math.sqrt(Ni(this.o, 0, this.o.length, this.H, 0)), this.A = this.a), Di(this.o, 0, this.o.length, this.H, this.D, !1, t, e, o, i)) }, t.Ni = function(t, e) { return Qi(this.o, 0, this.o.length, this.H, t, e) }, t.nl = function(t, e) { return "XYM" != this.b && "XYZM" != this.b ? null : ou(this.o, 0, this.o.length, this.H, t, !!r(e) && e) }, t.V = function() { return Xi(this.o, 0, this.o.length, this.H) }, t.ol = function() {
        var t, e = this.o,
            o = this.H,
            i = e[0],
            r = e[1],
            n = 0;
        for (t = 0 + o; t < this.o.length; t += o) {
            var s = e[t],
                p = e[t + 1];
            n += Math.sqrt((s - i) * (s - i) + (p - r) * (p - r)), i = s, r = p
        }
        return n
    }, t.Cc = function(t) { var e = []; return e.length = Yi(this.o, 0, this.o.length, this.H, t, e, 0), nu(t = new iu(null), "XY", e), t }, t.U = function() { return "LineString" }, t.sa = function(t) { return tr(this.o, 0, this.o.length, this.H, t) }, t.ja = function(t, e) { null === t ? nu(this, "XY", null) : (Ci(this, e, t, 1), null === this.o && (this.o = []), this.o.length = Gi(this.o, 0, t, this.H), this.s()) }, A(su, Ti), (t = su.prototype).zi = function(t) { null === this.o ? this.o = t.o.slice() : tt(this.o, t.o.slice()), this.c.push(this.o.length), this.s() }, t.clone = function() { var t = new su(null); return au(t, this.b, this.o.slice(), this.c.slice()), t }, t.Ya = function(t, e, o, i) { return i < Po(this.R(), t, e) ? i : (this.j != this.a && (this.A = Math.sqrt(Fi(this.o, 0, this.c, this.H, 0)), this.j = this.a), Oi(this.o, 0, this.c, this.H, this.A, !1, t, e, o, i)) }, t.ql = function(t, e, o) {
        return "XYM" != this.b && "XYZM" != this.b || 0 === this.o.length ? null : function(t, e, o, i, r, n) {
            var s = 0;
            if (n) return ou(t, s, e[e.length - 1], o, i, r);
            if (i < t[o - 1]) return r ? ((t = t.slice(0, o))[o - 1] = i, t) : null;
            if (t[t.length - 1] < i) return r ? ((t = t.slice(t.length - o))[o - 1] = i, t) : null;
            for (r = 0, n = e.length; r < n; ++r) {
                var p = e[r];
                if (s != p) {
                    if (i < t[s + o - 1]) break;
                    if (i <= t[p - 1]) return ou(t, s, p, o, i, !1);
                    s = p
                }
            }
            return null
        }(this.o, this.c, this.H, t, !!r(e) && e, !!r(o) && o)
    }, t.V = function() { return Ki(this.o, 0, this.c, this.H) }, t.kj = function(t) { if (0 > t || this.c.length <= t) return null; var e = new iu(null); return nu(e, this.b, this.o.slice(0 === t ? 0 : this.c[t - 1], this.c[t])), e }, t.gd = function() {
        var t, e, o = this.o,
            i = this.c,
            r = this.b,
            n = [],
            s = 0;
        for (t = 0, e = i.length; t < e; ++t) {
            var p = i[t],
                a = new iu(null);
            nu(a, r, o.slice(s, p)), n.push(a), s = p
        }
        return n
    }, t.Cc = function(t) {
        var e, o, i = [],
            r = [],
            n = this.o,
            s = this.c,
            p = this.H,
            a = 0,
            h = 0;
        for (e = 0, o = s.length; e < o; ++e) {
            var l = s[e];
            h = Yi(n, a, l, p, t, i, h), r.push(h), a = l
        }
        return i.length = h, au(t = new su(null), "XY", i, r), t
    }, t.U = function() { return "MultiLineString" }, t.sa = function(t) {
        t: {
            var e, o, i = this.o,
                r = this.c,
                n = this.H,
                s = 0;
            for (e = 0, o = r.length; e < o; ++e) {
                if (tr(i, s, r[e], n, t)) { t = !0; break t }
                s = r[e]
            }
            t = !1
        }
        return t
    }, t.ja = function(t, e) {
        if (null === t) au(this, "XY", null, this.c);
        else {
            Ci(this, e, t, 2), null === this.o && (this.o = []);
            var o = Ui(this.o, 0, t, this.H, this.c);
            this.o.length = 0 === o.length ? 0 : o[o.length - 1], this.s()
        }
    }, A(lu, Ti), (t = lu.prototype).Bi = function(t) { null === this.o ? this.o = t.o.slice() : tt(this.o, t.o), this.s() }, t.clone = function() { var t = new lu(null); return Ai(t, this.b, this.o.slice()), t.s(), t }, t.Ya = function(t, e, o, i) {
        if (i < Po(this.R(), t, e)) return i;
        var r, n, s, p = this.o,
            a = this.H;
        for (r = 0, n = p.length; r < n; r += a)
            if ((s = Ii(t, e, p[r], p[r + 1])) < i) {
                for (i = s, s = 0; s < a; ++s) o[s] = p[r + s];
                o.length = a
            }
        return i
    }, t.V = function() { return Xi(this.o, 0, this.o.length, this.H) }, t.tj = function(t) { var e = null === this.o ? 0 : this.o.length / this.H; return 0 > t || e <= t ? null : (Zi(e = new zi(null), this.b, this.o.slice(t * this.H, (t + 1) * this.H)), e) }, t.ge = function() {
        var t, e, o = this.o,
            i = this.b,
            r = this.H,
            n = [];
        for (t = 0, e = o.length; t < e; t += r) {
            var s = new zi(null);
            Zi(s, i, o.slice(t, t + r)), n.push(s)
        }
        return n
    }, t.U = function() { return "MultiPoint" }, t.sa = function(t) {
        var e, o, i = this.o,
            r = this.H;
        for (e = 0, o = i.length; e < o; e += r)
            if (Ao(t, i[e], i[e + 1])) return !0;
        return !1
    }, t.ja = function(t, e) { null === t ? Ai(this, "XY", null) : (Ci(this, e, t, 1), null === this.o && (this.o = []), this.o.length = Gi(this.o, 0, t, this.H)), this.s() }, A(uu, Ti), (t = uu.prototype).Ci = function(t) {
        if (null === this.o) this.o = t.o.slice(), t = t.c.slice(), this.c.push();
        else { var e, o, i = this.o.length; for (tt(this.o, t.o), e = 0, o = (t = t.c.slice()).length; e < o; ++e) t[e] += i }
        this.c.push(t), this.s()
    }, t.clone = function() {
        var t = new uu(null),
            e = function t(e) { if ("object" == (i = a(e)) || "array" == i) { if (e.clone) return e.clone(); var o, i = "array" == i ? [] : {}; for (o in e) i[o] = t(e[o]); return i } return e }(this.c);
        return fu(t, this.b, this.o.slice(), e), t
    }, t.Ya = function(t, e, o, i) {
        if (i < Po(this.R(), t, e)) return i;
        if (this.C != this.a) {
            var n, s, p = this.c,
                a = 0,
                h = 0;
            for (n = 0, s = p.length; n < s; ++n) {
                var l = p[n];
                h = Fi(this.o, a, l, this.H, h), a = l[l.length - 1]
            }
            this.N = Math.sqrt(h), this.C = this.a
        }
        var u, c;
        for (p = yu(this), a = this.c, h = this.H, n = this.N, s = 0, l = r(void 0) ? void 0 : [NaN, NaN], u = 0, c = a.length; u < c; ++u) {
            var y = a[u];
            i = Oi(p, s, y, h, n, !0, t, e, o, i, l), s = y[y.length - 1]
        }
        return i
    }, t.gc = function(t, e) {
        var o;
        t: {
            o = yu(this);
            var i, r, n = this.c,
                s = 0;
            if (0 !== n.length)
                for (i = 0, r = n.length; i < r; ++i) {
                    var p = n[i];
                    if ($i(o, s, p, this.H, t, e)) { o = !0; break t }
                    s = p[p.length - 1]
                }
            o = !1
        }
        return o
    }, t.rl = function() {
        var t, e, o = yu(this),
            i = this.c,
            r = 0,
            n = 0;
        for (t = 0, e = i.length; t < e; ++t) {
            var s = i[t];
            n += Li(o, r, s, this.H), r = s[s.length - 1]
        }
        return n
    }, t.V = function(t) {
        var e;
        r(t) ? nr(e = yu(this).slice(), this.c, this.H, t) : e = this.o, t = e, e = this.c;
        var o, i, n = this.H,
            s = 0,
            p = r(void 0) ? void 0 : [],
            a = 0;
        for (o = 0, i = e.length; o < i; ++o) {
            var h = e[o];
            p[a++] = Ki(t, s, h, n, p[a]), s = h[h.length - 1]
        }
        return p.length = a, p
    }, t.hj = function() { var t = new lu(null); return Ai(t, "XY", cu(this).slice()), t.s(), t }, t.Cc = function(t) {
        var e = [],
            o = [],
            i = this.o,
            r = this.c,
            n = this.H;
        t = Math.sqrt(t);
        var s, p, a = 0,
            h = 0;
        for (s = 0, p = r.length; s < p; ++s) {
            var l = r[s],
                u = [];
            h = Vi(i, a, l, n, t, e, h, u), o.push(u), a = l[l.length - 1]
        }
        return e.length = h, fu(i = new uu(null), "XY", e, o), i
    }, t.vj = function(t) {
        if (0 > t || this.c.length <= t) return null;
        var e;
        e = 0 === t ? 0 : (e = this.c[t - 1])[e.length - 1];
        var o, i, r = (t = this.c[t].slice())[t.length - 1];
        if (0 !== e)
            for (o = 0, i = t.length; o < i; ++o) t[o] -= e;
        return hr(o = new sr(null), this.b, this.o.slice(e, r), t), o
    }, t.Od = function() {
        var t, e, o, i, r = this.b,
            n = this.o,
            s = this.c,
            p = [],
            a = 0;
        for (t = 0, e = s.length; t < e; ++t) {
            var h = s[t].slice(),
                l = h[h.length - 1];
            if (0 !== a)
                for (o = 0, i = h.length; o < i; ++o) h[o] -= a;
            hr(o = new sr(null), r, n.slice(a, l), h), p.push(o), a = l
        }
        return p
    }, t.U = function() { return "MultiPolygon" }, t.sa = function(t) {
        t: {
            var e, o, i = yu(this),
                r = this.c,
                n = this.H,
                s = 0;
            for (e = 0, o = r.length; e < o; ++e) {
                var p = r[e];
                if (er(i, s, p, n, t)) { t = !0; break t }
                s = p[p.length - 1]
            }
            t = !1
        }
        return t
    }, t.ja = function(t, e) {
        if (null === t) fu(this, "XY", null, this.c);
        else {
            Ci(this, e, t, 3), null === this.o && (this.o = []);
            var o, i, n = this.o,
                s = this.H,
                p = 0,
                a = r(a = this.c) ? a : [],
                h = 0;
            for (o = 0, i = t.length; o < i; ++o) p = Ui(n, p, t[o], s, a[h]), a[h++] = p, p = p[p.length - 1];
            a.length = h, 0 === a.length ? this.o.length = 0 : (n = a[a.length - 1], this.o.length = 0 === n.length ? 0 : n[n.length - 1]), this.s()
        }
    };
    var mu = {
        Point: function(t, e, o, i) {
            var r = o.i;
            if (null !== r) {
                if (2 != r.qd()) return;
                var n = t.a(o.a, "Image");
                n.hb(r), n.wb(e, i)
            }
            null !== (r = o.b) && ((t = t.a(o.a, "Text")).Ia(r), t.xb(e.V(), 0, 2, 2, e, i))
        },
        LineString: function(t, e, o, i) {
            var r = o.c;
            if (null !== r) {
                var n = t.a(o.a, "LineString");
                n.Ha(null, r), n.Gb(e, i)
            }
            null !== (r = o.b) && ((t = t.a(o.a, "Text")).Ia(r), t.xb(ru(e), 0, 2, 2, e, i))
        },
        Polygon: function(t, e, o, i) {
            var r = o.f,
                n = o.c;
            if (null !== r || null !== n) {
                var s = t.a(o.a, "Polygon");
                s.Ha(r, n), s.Yb(e, i)
            }
            null !== (r = o.b) && ((t = t.a(o.a, "Text")).Ia(r), t.xb(pr(e), 0, 2, 2, e, i))
        },
        MultiPoint: function(t, e, o, i) {
            var r = o.i;
            if (null !== r) {
                if (2 != r.qd()) return;
                var n = t.a(o.a, "Image");
                n.hb(r), n.vb(e, i)
            }
            null !== (r = o.b) && ((t = t.a(o.a, "Text")).Ia(r), o = e.o, t.xb(o, 0, o.length, e.H, e, i))
        },
        MultiLineString: function(t, e, o, i) {
            var r = o.c;
            if (null !== r) {
                var n = t.a(o.a, "LineString");
                n.Ha(null, r), n.Ac(e, i)
            }
            null !== (r = o.b) && ((t = t.a(o.a, "Text")).Ia(r), o = pu(e), t.xb(o, 0, o.length, 2, e, i))
        },
        MultiPolygon: function(t, e, o, i) {
            var r = o.f,
                n = o.c;
            if (null !== n || null !== r) {
                var s = t.a(o.a, "Polygon");
                s.Ha(r, n), s.Bc(e, i)
            }
            null !== (r = o.b) && ((t = t.a(o.a, "Text")).Ia(r), o = cu(e), t.xb(o, 0, o.length, 2, e, i))
        },
        GeometryCollection: function(t, e, o, i) { var r, n; for (r = 0, n = (e = e.f).length; r < n; ++r)(0, mu[e[r].U()])(t, e[r], o, i) },
        Circle: function(t, e, o, i) {
            var r = o.f,
                n = o.c;
            if (null !== r || null !== n) {
                var s = t.a(o.a, "Polygon");
                s.Ha(r, n), s.zc(e, i)
            }
            null !== (r = o.b) && ((t = t.a(o.a, "Text")).Ia(r), t.xb(e.ld(), 0, 2, 2, e, i))
        }
    };

    function wu(t, e, o, i, r) { va.call(this, t, e, o, 2, i), this.b = r }

    function Su(t) { zn.call(this, { attributions: t.attributions, extent: t.extent, logo: t.logo, projection: t.projection, state: t.state }), this.v = r(t.resolutions) ? t.resolutions : null }

    function xu(t, e) {
        if (null !== t.v) {
            var o = Wt(t.v, e, 0);
            e = t.v[o]
        }
        return e
    }

    function Mu(t, e) { t.a().src = e }

    function Pu(t, e) { re.call(this, t), this.image = e }
    A(wu, va), wu.prototype.a = function() { return this.b }, A(Su, zn), Su.prototype.l = function(t) {
        switch ((t = t.target).state) {
            case 1:
                Be(this, new Pu(ju, t));
                break;
            case 2:
                Be(this, new Pu(Au, t));
                break;
            case 3:
                Be(this, new Pu(Cu, t))
        }
    }, A(Pu, re);
    var Tu, ju = "imageloadstart",
        Au = "imageloadend",
        Cu = "imageloaderror";

    function Ru(t) { Su.call(this, { attributions: t.attributions, logo: t.logo, projection: t.projection, resolutions: t.resolutions, state: r(t.state) ? t.state : void 0 }), this.Z = t.canvasFunction, this.N = null, this.T = 0, this.aa = r(t.ratio) ? t.ratio : 1.5 }

    function Lu(t) { Ve.call(this), this.ha = void 0, this.b = "geometry", this.g = null, this.c = void 0, this.f = null, Te(this, We(this.b), this.Ud, !1, this), r(t) && (t instanceof Mi || null === t ? this.Sa(t) : this.I(t)) }

    function Eu(t) { t.prototype.then = t.prototype.then, t.prototype.$goog_Thenable = !0 }

    function Iu(t) { if (!t) return !1; try { return !!t.$goog_Thenable } catch (t) { return !1 } }

    function ku(t, e) {
        Tu || function() {
            if (i.Promise && i.Promise.resolve) {
                var t = i.Promise.resolve();
                Tu = function() { t.then(Du) }
            } else Tu = function() { Fs(Du) }
        }(), Nu || (Tu(), Nu = !0), Fu.push(new Ou(t, e))
    }
    A(Ru, Su), Ru.prototype.Hc = function(t, e, o, i) { e = xu(this, e); var r = this.N; return null !== r && this.T == this.a && r.resolution == e && r.g == o && jo(r.R(), t) || (zo(t = t.slice(), this.aa), null === (i = this.Z(t, e, o, [Vo(t) / e * o, Uo(t) / e * o], i)) || (r = new wu(t, e, o, this.g, i)), this.N = r, this.T = this.a), r }, A(Lu, Ve), (t = Lu.prototype).clone = function() {
        var t = new Lu(this.P());
        t.Pc(this.b);
        var e = this.Y();
        return null != e && t.Sa(e.clone()), null === (e = this.g) || t.hf(e), t
    }, t.Y = function() { return this.get(this.b) }, t.ej = function() { return this.ha }, t.dj = function() { return this.b }, t.Mk = function() { return this.g }, t.Nk = function() { return this.c }, t.Ok = function() { this.s() }, t.Ud = function() {
        null !== this.f && (Re(this.f), this.f = null);
        var t = this.Y();
        null != t && (this.f = Te(t, "change", this.Ok, !1, this)), this.s()
    }, t.Sa = function(t) { this.set(this.b, t) }, t.hf = function(t) { this.g = t, null === t ? t = void 0 : f(t) || (t = Jo(t = l(t) ? t : [t])), this.c = t, this.s() }, t.Wb = function(t) { this.ha = t, this.s() }, t.Pc = function(t) { Ce(this, We(this.b), this.Ud, !1, this), this.b = t, Te(this, We(this.b), this.Ud, !1, this), this.Ud() };
    var Nu = !1,
        Fu = [];

    function Du() {
        for (; Fu.length;) {
            var t = Fu;
            Fu = [];
            for (var e = 0; e < t.length; e++) { var o = t[e]; try { o.a.call(o.b) } catch (t) { Ns(t) } }
        }
        Nu = !1
    }

    function Ou(t, e) { this.a = t, this.b = e }

    function Bu(t, e) {
        this.b = Gu, this.i = void 0, this.a = this.c = null, this.f = this.g = !1;
        try {
            var o = this;
            t.call(e, (function(t) { Ku(o, Uu, t) }), (function(t) { Ku(o, Xu, t) }))
        } catch (t) { Ku(this, Xu, t) }
    }
    var Gu = 0,
        Uu = 2,
        Xu = 3;

    function Ku(t, e, o) {
        if (t.b == Gu) {
            if (t == o) e = Xu, o = new TypeError("Promise cannot resolve to itself");
            else {
                if (Iu(o)) return t.b = 1, void o.then(t.j, t.l, t);
                if (g(o)) try {
                    var i = o.then;
                    if (f(i)) return void

                    function(t, e, o) {
                        function i(e) { r || (r = !0, t.l(e)) }
                        t.b = 1;
                        var r = !1;
                        try { o.call(e, (function(e) { r || (r = !0, t.j(e)) }), i) } catch (t) { i(t) }
                    }(t, o, i)
                } catch (t) { e = Xu, o = t }
            }
            t.i = o, t.b = e, Yu(t), e != Xu || o instanceof Wu || function(t, e) { t.f = !0, ku((function() { t.f && Hu.call(null, e) })) }(t, o)
        }
    }

    function Yu(t) { t.g || (t.g = !0, ku(t.B, t)) }

    function Vu(t, e, o, i) {
        if (o == Uu) e.Yg(i);
        else {
            if (e.Xc)
                for (; t && t.f; t = t.c) t.f = !1;
            e.$g(i)
        }
    }
    Bu.prototype.then = function(t, e, o) {
        return function(t, e, o, i) {
            var n = { Xc: null, Yg: null, $g: null };
            return n.Xc = new Bu((function(t, s) {
                    n.Yg = e ? function(o) {
                        try {
                            var r = e.call(i, o);
                            t(r)
                        } catch (t) { s(t) }
                    } : t, n.$g = o ? function(e) { try { var n = o.call(i, e);!r(n) && e instanceof Wu ? s(e) : t(n) } catch (t) { s(t) } } : s
                })), n.Xc.c = t,
                function(t, e) { t.a && t.a.length || t.b != Uu && t.b != Xu || Yu(t), t.a || (t.a = []), t.a.push(e) }(t, n), n.Xc
        }(this, f(t) ? t : null, f(e) ? e : null, o)
    }, Eu(Bu), Bu.prototype.cancel = function(t) {
        this.b == Gu && ku((function() {
            ! function t(e, o) {
                if (e.b == Gu)
                    if (e.c) {
                        var i = e.c;
                        if (i.a) {
                            for (var r, n = 0, s = -1, p = 0;
                                (r = i.a[p]) && !((r = r.Xc) && (n++, r == e && (s = p), 0 <= s && 1 < n)); p++);
                            0 <= s && (i.b == Gu && 1 == n ? t(i, o) : (n = i.a.splice(s, 1)[0], Vu(i, n, Xu, o)))
                        }
                    } else Ku(e, Xu, o)
            }(this, new Wu(t))
        }), this)
    }, Bu.prototype.j = function(t) { this.b = Gu, Ku(this, Uu, t) }, Bu.prototype.l = function(t) { this.b = Gu, Ku(this, Xu, t) }, Bu.prototype.B = function() {
        for (; this.a && this.a.length;) {
            var t = this.a;
            this.a = [];
            for (var e = 0; e < t.length; e++) Vu(this, t[e], this.b, this.i)
        }
        this.g = !1
    };
    var Hu = Ns;

    function Wu(t) { C.call(this, t) }

    function zu(t, e, o) {
        if (f(t)) o && (t = S(t, o));
        else {
            if (!t || "function" != typeof t.handleEvent) throw Error("Invalid listener argument");
            t = S(t.handleEvent, t)
        }
        return 2147483647 < e ? -1 : i.setTimeout(t, e || 0)
    }
    A(Wu, C), Wu.prototype.name = "cancel";
    var Zu, Ju = i.JSON.parse,
        qu = i.JSON.stringify;

    function $u() {}

    function _u(t) { var e; return (e = t.a) || (e = {}, ec(t) && (e[0] = !0, e[1] = !0), e = t.a = e), e }

    function Qu() {}

    function tc(t) { return (t = ec(t)) ? new ActiveXObject(t) : new XMLHttpRequest }

    function ec(t) { if (!t.b && "undefined" == typeof XMLHttpRequest && "undefined" != typeof ActiveXObject) { for (var e = ["MSXML2.XMLHTTP.6.0", "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", "Microsoft.XMLHTTP"], o = 0; o < e.length; o++) { var i = e[o]; try { return new ActiveXObject(i), t.b = i } catch (t) {} } throw Error("Could not create ActiveXObject. ActiveX might be disabled, or MSXML might not be installed") } return t.b }
    $u.prototype.a = null, A(Qu, $u), Zu = new Qu;
    var oc = /^(?:([^:/?#.]+):)?(?:\/\/(?:([^/?#]*)@)?([^/#?]*?)(?::([0-9]+))?(?=[/#?]|$))?([^?#]+)?(?:\?([^#]*))?(?:#(.*))?$/;

    function ic(t) { if (rc) { rc = !1; var e = i.location; if (e) { var o = e.href; if (o && (o = (o = ic(o)[3] || null) ? decodeURI(o) : o) && o != e.hostname) throw rc = !0, Error() } } return t.match(oc) }
    var rc = Ct;

    function nc(t) {
        if (t[1]) {
            var e = t[0],
                o = e.indexOf("#");
            0 <= o && (t.push(e.substr(o)), t[0] = e = e.substr(0, o)), 0 > (o = e.indexOf("?")) ? t[1] = "?" : o == e.length - 1 && (t[1] = void 0)
        }
        return t.join("")
    }

    function sc(t, e, o) {
        if (l(e))
            for (var i = 0; i < e.length; i++) sc(t, String(e[i]), o);
        else null != e && o.push("&", t, "" === e ? "" : "=", encodeURIComponent(String(e)))
    }

    function pc(t, e) { for (var o in e) sc(o, e[o], t); return t }

    function ac(t) { Oe.call(this), this.C = new Os, this.l = t || null, this.a = !1, this.j = this.ga = null, this.g = this.u = "", this.b = this.v = this.f = this.B = !1, this.i = 0, this.c = null, this.A = lc, this.D = this.N = !1 }
    A(ac, Oe);
    var hc, lc = "",
        uc = /^https?$/i,
        cc = ["POST", "PUT"];

    function yc(t) { return "content-type" == t.toLowerCase() }

    function fc(t, e) { t.a = !1, t.ga && (t.b = !0, t.ga.abort(), t.b = !1), t.g = e, gc(t), vc(t) }

    function gc(t) { t.B || (t.B = !0, Be(t, "complete"), Be(t, "error")) }

    function dc(t) {
        if (t.a && void 0 !== o && (!t.j[1] || 4 != wc(t) || 2 != Sc(t)))
            if (t.f && 4 == wc(t)) zu(t.Zg, 0, t);
            else if (Be(t, "readystatechange"), 4 == wc(t)) {
            t.a = !1;
            try {
                if (mc(t)) Be(t, "complete"), Be(t, "success");
                else {
                    var e;
                    try { e = 2 < wc(t) ? t.ga.statusText : "" } catch (t) { e = "" }
                    t.g = e + " [" + Sc(t) + "]", gc(t)
                }
            } finally { vc(t) }
        }
    }

    function vc(t, e) {
        if (t.ga) {
            bc(t);
            var o = t.ga,
                i = t.j[0] ? s : null;
            t.ga = null, t.j = null, e || Be(t, "ready");
            try { o.onreadystatechange = i } catch (t) {}
        }
    }

    function bc(t) { t.ga && t.D && (t.ga.ontimeout = null), y(t.c) && (i.clearTimeout(t.c), t.c = null) }

    function mc(t) {
        var e, o = Sc(t);
        t: switch (o) {
            case 200:
            case 201:
            case 202:
            case 204:
            case 206:
            case 304:
            case 1223:
                e = !0;
                break t;
            default:
                e = !1
        }
        return e || ((o = 0 === o) && (!(t = ic(String(t.u))[1] || null) && self.location && (t = (t = self.location.protocol).substr(0, t.length - 1)), o = !uc.test(t ? t.toLowerCase() : "")), e = o), e
    }

    function wc(t) { return t.ga ? t.ga.readyState : 0 }

    function Sc(t) { try { return 2 < wc(t) ? t.ga.status : -1 } catch (t) { return -1 } }

    function xc(t) { try { return t.ga ? t.ga.responseText : "" } catch (t) { return "" } }

    function Mc(t) { if ("undefined" != typeof XMLSerializer) return (new XMLSerializer).serializeToString(t); if (t = t.xml) return t; throw Error("Your browser does not support serializing XML documents") }(t = ac.prototype).send = function(t, e, o, n) {
        if (this.ga) throw Error("[goog.net.XhrIo] Object is active with another request=" + this.u + "; newUri=" + t);
        e = e ? e.toUpperCase() : "GET", this.u = t, this.g = "", this.B = !1, this.a = !0, this.ga = this.l ? tc(this.l) : tc(Zu), this.j = this.l ? _u(this.l) : _u(Zu), this.ga.onreadystatechange = S(this.Zg, this);
        try { this.v = !0, this.ga.open(e, String(t), !0), this.v = !1 } catch (t) { return void fc(this, t) }
        t = o || "";
        var s = this.C.clone();
        n && function(t, e) {
            if ("function" == typeof t.forEach) t.forEach(e, void 0);
            else if (u(t) || c(t)) H(t, e, void 0);
            else {
                var o;
                if ("function" == typeof t.O) o = t.O();
                else if ("function" != typeof t.lb)
                    if (u(t) || c(t)) { o = []; for (var i = t.length, r = 0; r < i; r++) o.push(r) } else o = yt(t);
                else o = void 0;
                r = (i = function(t) { if ("function" == typeof t.lb) return t.lb(); if (c(t)) return t.split(""); if (u(t)) { for (var e = [], o = t.length, i = 0; i < o; i++) e.push(t[i]); return e } return ct(t) }(t)).length;
                for (var n = 0; n < r; n++) e.call(void 0, i[n], o && o[n], t)
            }
        }(n, (function(t, e) { s.set(e, t) })), n = Z(s.O(), yc), o = i.FormData && t instanceof i.FormData, !q(cc, e) || n || o || s.set("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"), s.forEach((function(t, e) { this.ga.setRequestHeader(e, t) }), this), this.A && (this.ga.responseType = this.A), "withCredentials" in this.ga && (this.ga.withCredentials = this.N);
        try { bc(this), 0 < this.i && ((this.D = function(t) { return jt && Ot(9) && y(t.timeout) && r(t.ontimeout) }(this.ga)) ? (this.ga.timeout = this.i, this.ga.ontimeout = S(this.uc, this)) : this.c = zu(this.uc, this.i, this)), this.f = !0, this.ga.send(t), this.f = !1 } catch (t) { fc(this, t) }
    }, t.uc = function() { void 0 !== o && this.ga && (this.g = "Timed out after " + this.i + "ms, aborting", Be(this, "timeout"), this.ga && this.a && (this.a = !1, this.b = !0, this.ga.abort(), this.b = !1, Be(this, "complete"), Be(this, "abort"), vc(this))) }, t.W = function() { this.ga && (this.a && (this.a = !1, this.b = !0, this.ga.abort(), this.b = !1), vc(this, !0)), ac.$.W.call(this) }, t.Zg = function() { this.ea || (this.v || this.f || this.b ? dc(this) : this.an()) }, t.an = function() { dc(this) };
    t: {
        if (!document.implementation || !document.implementation.createDocument) { if ("undefined" != typeof ActiveXObject) { var Pc = new ActiveXObject("MSXML2.DOMDocument"); if (Pc) { Pc.resolveExternals = !1, Pc.validateOnParse = !1; try { Pc.setProperty("ProhibitDTD", !0), Pc.setProperty("MaxXMLSize", 2048), Pc.setProperty("MaxElementDepth", 256) } catch (t) {} } if (Pc) { hc = Pc; break t } } throw Error("Your browser does not support creating new documents") }
        hc = document.implementation.createDocument("", "", null)
    }
    var Tc = hc,
        jc = document.implementation && document.implementation.createDocument ? function(t, e) { return Tc.createElementNS(t, e) } : function(t, e) { return null === t && (t = ""), Tc.createNode(1, e, t) };

    function Ac(t, e) {
        return function t(e, o, i) {
            if (4 == e.nodeType || 3 == e.nodeType) o ? i.push(String(e.nodeValue).replace(/(\r\n|\r|\n)/g, "")) : i.push(e.nodeValue);
            else
                for (e = e.firstChild; null !== e; e = e.nextSibling) t(e, o, i);
            return i
        }(t, e, []).join("")
    }
    var Cc = jt ? function(t) { var e = t.localName; return r(e) ? e : t.baseName } : function(t) { return t.localName },
        Rc = jt ? function(t) { return g(t) && 9 == t.nodeType } : function(t) { return t instanceof Document },
        Lc = jt ? function(t) { return g(t) && r(t.nodeType) } : function(t) { return t instanceof Node },
        Ec = document.implementation && document.implementation.createDocument ? function(t, e, o) { return t.getAttributeNS(e, o) || "" } : function(t, e, o) { var i = ""; return r(t = Ic(t, e, o)) && (i = t.nodeValue), i },
        Ic = document.implementation && document.implementation.createDocument ? function(t, e, o) { return t.getAttributeNodeNS(e, o) } : function(t, e, o) {
            for (var i, r = null, n = 0, s = (t = t.attributes).length; n < s; ++n)
                if ((i = t[n]).namespaceURI == e && (i.prefix ? i.prefix + ":" + o : o) == i.nodeName) { r = i; break }
            return r
        },
        kc = document.implementation && document.implementation.createDocument ? function(t, e, o, i) { t.setAttributeNS(e, o, i) } : function(t, e, o, i) { null === e ? t.setAttribute(o, i) : ((e = t.ownerDocument.createNode(2, o, e)).nodeValue = i, t.setAttributeNode(e)) };

    function Nc(t) { return (new DOMParser).parseFromString(t, "application/xml") }

    function Fc(t, e) {
        return function(o, i) {
            var n = t.call(e, o, i);
            r(n) && tt(i[i.length - 1], n)
        }
    }

    function Dc(t, e) {
        return function(o, i) {
            var n = t.call(r(e) ? e : this, o, i);
            r(n) && i[i.length - 1].push(n)
        }
    }

    function Oc(t, e) {
        return function(o, i) {
            var n = t.call(r(e) ? e : this, o, i);
            r(n) && (i[i.length - 1] = n)
        }
    }

    function Bc(t) {
        return function(e, o) {
            var i = t.call(r(void 0) ? void 0 : this, e, o);
            r(i) && St(o[o.length - 1], r(void 0) ? void 0 : e.localName).push(i)
        }
    }

    function Gc(t, e) {
        return function(o, i) {
            var n = t.call(r(void 0) ? void 0 : this, o, i);
            r(n) && (i[i.length - 1][r(e) ? e : o.localName] = n)
        }
    }

    function Uc(t, e, o) { return zc(t, e, o) }

    function Xc(t, e) { return function(o, i, n) { t.call(r(e) ? e : this, o, i, n), n[n.length - 1].node.appendChild(o) } }

    function Kc(t) {
        var e, o;
        return function(i, n, s) {
            if (!r(e)) {
                e = {};
                var p = {};
                p[i.localName] = t, e[i.namespaceURI] = p, o = Yc(i.localName)
            }
            qc(e, o, n, s)
        }
    }

    function Yc(t, e) { return function(o, i, n) { return o = i[i.length - 1].node, r(i = t) || (i = n), n = e, r(e) || (n = o.namespaceURI), jc(n, i) } }
    var Vc, Hc = Yc();

    function Wc(t, e) { for (var o = e.length, i = Array(o), r = 0; r < o; ++r) i[r] = t[e[r]]; return i }

    function zc(t, e, o) { var i, n; for (o = r(o) ? o : {}, i = 0, n = t.length; i < n; ++i) o[t[i]] = e; return o }

    function Zc(t, e, o, i) {
        for (e = e.firstElementChild; null !== e; e = e.nextElementSibling) {
            var n = t[e.namespaceURI];
            r(n) && r(n = n[e.localName]) && n.call(i, e, o)
        }
    }

    function Jc(t, e, o, i, r) { return i.push(t), Zc(e, o, i, r), i.pop() }

    function qc(t, e, o, i, n, s) { for (var p, a, h = (r(n) ? n : o).length, l = 0; l < h; ++l) r(p = o[l]) && (a = e.call(s, p, i, r(n) ? n[l] : void 0), r(a) && t[a.namespaceURI][a.localName].call(s, a, p, i)) }

    function $c(t, e, o, i, r, n, s) { r.push(t), qc(e, o, i, r, n, s), r.pop() }

    function _c(t, e, o) {
        return function(i, r, n) {
            (i = new ac).A = "text", Te(i, "complete", (function(t) {
                if (mc(t = t.target)) {
                    var i, r = e.U();
                    if ("json" == r) i = xc(t);
                    else if ("text" == r) i = xc(t);
                    else if ("xml" == r) {
                        if (!jt) try { i = t.ga ? t.ga.responseXML : null } catch (t) { i = null }
                        null != i || (i = Nc(xc(t)))
                    }
                    null != i && (i = e.qa(i, { featureProjection: n }), o.call(this, i))
                }
                ie(t)
            }), !1, this), i.send(t)
        }
    }

    function Qc(t, e) { return _c(t, e, (function(t) { this.xc(t) })) }

    function ty() {
        return [
            [-1 / 0, -1 / 0, 1 / 0, 1 / 0]
        ]
    }

    function ey(t) { this.b = Vc(t), this.a = {} }

    function oy(t) { return z(t = t.b.all(), (function(t) { return t[4] })) }

    function iy(t, e) { return z(t.b.search(e), (function(t) { return t[4] })) }

    function ry(t, e, o, i) { return ny(iy(t, e), o, i) }

    function ny(t, e, o) { for (var i, r = 0, n = t.length; r < n && !(i = e.call(o, t[r])); r++); return i }

    function sy(t) {
        t = r(t) ? t : {}, zn.call(this, { attributions: t.attributions, logo: t.logo, projection: void 0, state: "ready", wrapX: !r(t.wrapX) || t.wrapX }), this.T = s, r(t.loader) ? this.T = t.loader : r(t.url) && (this.T = Qc(t.url, t.format)), this.xa = r(t.strategy) ? t.strategy : ty;
        var e, o, i = !r(t.useSpatialIndex) || t.useSpatialIndex;
        this.b = i ? new ey : null, this.Z = new ey, this.f = {}, this.i = {}, this.l = {}, this.v = {}, this.c = null, t.features instanceof Dr ? o = (e = t.features).b : l(t.features) && (o = t.features), i || r(e) || (e = new Dr(o)), r(o) && hy(this, o), r(e) && function(t, e) {
            var o = !1;
            Te(t, "addfeature", (function(t) { o || (o = !0, e.push(t.feature), o = !1) })), Te(t, "removefeature", (function(t) { o || (o = !0, e.remove(t.feature), o = !1) })), Te(e, "add", (function(t) { o || (t = t.element, o = !0, this.pd(t), o = !1) }), !1, t), Te(e, "remove", (function(t) { o || (t = t.element, o = !0, this.Jc(t), o = !1) }), !1, t), t.c = e
        }(this, e)
    }

    function py(t, e, o) { t.v[e] = [Te(o, "change", t.mg, !1, t), Te(o, "propertychange", t.mg, !1, t)] }

    function ay(t, e, o) {
        var i = !0,
            n = o.ha;
        return r(n) ? n.toString() in t.i ? i = !1 : t.i[n.toString()] = o : t.l[e] = o, i
    }

    function hy(t, e) {
        var o, i, r, n, s = [],
            p = [],
            a = [];
        for (i = 0, r = e.length; i < r; i++) ay(t, o = d(n = e[i]).toString(), n) && p.push(n);
        for (i = 0, r = p.length; i < r; i++) {
            py(t, o = d(n = p[i]).toString(), n);
            var h = n.Y();
            null != h ? (o = h.R(), s.push(o), a.push(n)) : t.f[o] = n
        }
        for (null === t.b || t.b.load(s, a), i = 0, r = p.length; i < r; i++) Be(t, new uy("addfeature", p[i]))
    }

    function ly(t, e) {
        for (var o in t.i)
            if (t.i[o] === e) { delete t.i[o]; break }
    }

    function uy(t, e) { re.call(this, t), this.feature = e }

    function cy(t) { this.b = t.source, this.fa = ho(), this.c = ip(), this.f = [0, 0], this.u = null, Ru.call(this, { attributions: t.attributions, canvasFunction: S(this.Fi, this), logo: t.logo, projection: t.projection, ratio: t.ratio, resolutions: t.resolutions, state: this.b.A }), this.C = null, this.i = void 0, this.Pg(t.style), Te(this.b, "change", this.Yl, void 0, this) }

    function yy(t) { Pl.call(this, t), this.g = null, this.i = ho(), this.c = this.f = null }

    function fy(t) { Pl.call(this, t), this.c = this.i = null, this.B = !1, this.j = null, this.v = ho(), this.g = null, this.D = this.C = this.A = NaN, this.l = this.f = null, this.T = [0, 0] }

    function gy(t) { Pl.call(this, t), this.f = !1, this.B = -1, this.l = NaN, this.i = [1 / 0, 1 / 0, -1 / 0, -1 / 0], this.c = this.j = null, this.g = ip() }

    function dy(t, e) { Na.call(this, 0, e), this.c = ip(), this.a = this.c.canvas, this.a.className = "ol-unselectable", pn(t, this.a, 0), this.b = !0, this.g = ho() }

    function vy(t, e, o) {
        var i = t.i,
            r = t.c;
        if (Ue(i, e)) {
            var n = o.extent,
                s = o.pixelRatio,
                p = o.viewState.rotation,
                a = o.pixelRatio,
                h = o.viewState,
                l = h.resolution;
            Be(i, new fa(e, i, n = new gl(r, s, n, t = ba(t.g, t.a.width / 2, t.a.height / 2, a / l, -a / l, -h.rotation, -h.center[0], -h.center[1]), p), o, r, null)), wl(n)
        }
    }

    function by(t, e) { Sa.call(this, t), this.target = e }

    function my(t) {
        var e = rn("DIV");
        e.style.position = "absolute", by.call(this, t, e), this.c = null, this.f = lo()
    }

    function wy(t) {
        var e = rn("DIV");
        e.style.position = "absolute", by.call(this, t, e), this.f = !0, this.B = 1, this.j = 0, this.c = {}
    }

    function Sy(t, e) { this.target = rn("DIV"), this.target.style.position = "absolute", this.target.style.width = "100%", this.target.style.height = "100%", this.f = t, this.c = e, this.i = Ko(is(t, e)), this.j = t.ua(e[0]), this.b = {}, this.a = null, this.g = lo(), this.l = [0, 0] }

    function xy(t) {
        this.j = ip();
        var e = this.j.canvas;
        e.style.maxWidth = "none", e.style.position = "absolute", by.call(this, t, e), this.f = !1, this.A = -1, this.u = NaN, this.B = [1 / 0, 1 / 0, -1 / 0, -1 / 0], this.c = this.v = null, this.C = ho(), this.D = ho()
    }

    function My(t, e, o, i) {
        var r = t.j;
        Ue(t = t.b, e) && (Be(t, new fa(e, t, i = new gl(r, o.pixelRatio, o.extent, i, o.viewState.rotation), o, r, null)), wl(i))
    }

    function Py(t, e) {
        Na.call(this, 0, e), this.b = null, this.b = ip();
        var o = this.b.canvas;
        o.style.position = "absolute", o.style.width = "100%", o.style.height = "100%", o.className = "ol-unselectable", pn(t, o, 0), this.g = ho(), this.a = rn("DIV"), this.a.className = "ol-unselectable", (o = this.a.style).position = "absolute", o.width = "100%", o.height = "100%", Te(this.a, "touchstart", se), pn(t, this.a, 0), this.c = !0
    }

    function Ty(t, e, o) {
        var i = t.i;
        if (Ue(i, e)) {
            var r = o.extent,
                n = o.pixelRatio,
                s = o.viewState,
                p = s.rotation,
                a = t.b,
                h = a.canvas;
            ba(t.g, h.width / 2, h.height / 2, n / s.resolution, -n / s.resolution, -s.rotation, -s.center[0], -s.center[1]), Be(i, new fa(e, i, t = new gl(a, n, r, t.g, p), o, a, null)), wl(t)
        }
    }

    function jy(t) { this.a = t }

    function Ay(t) { this.a = t }

    function Cy(t) { this.a = t }

    function Ry() { this.a = "precision mediump float;varying vec2 a;varying float b;uniform mat4 k;uniform float l;uniform sampler2D m;void main(void){vec4 texColor=texture2D(m,a);float alpha=texColor.a*b*l;if(alpha==0.0){discard;}gl_FragColor.a=alpha;gl_FragColor.rgb=(k*vec4(texColor.rgb,1.)).rgb;}" }

    function Ly() { this.a = "varying vec2 a;varying float b;attribute vec2 c;attribute vec2 d;attribute vec2 e;attribute float f;attribute float g;uniform mat4 h;uniform mat4 i;uniform mat4 j;void main(void){mat4 offsetMatrix=i;if(g==1.0){offsetMatrix=i*j;}vec4 offsets=offsetMatrix*vec4(e,0.,0.);gl_Position=h*vec4(c,0.,1.)+offsets;a=d;b=f;}" }

    function Ey(t, e) { this.v = t.getUniformLocation(e, "k"), this.l = t.getUniformLocation(e, "j"), this.B = t.getUniformLocation(e, "i"), this.i = t.getUniformLocation(e, "l"), this.j = t.getUniformLocation(e, "h"), this.a = t.getAttribLocation(e, "e"), this.b = t.getAttribLocation(e, "f"), this.f = t.getAttribLocation(e, "c"), this.c = t.getAttribLocation(e, "g"), this.g = t.getAttribLocation(e, "d") }

    function Iy() { this.a = "precision mediump float;varying vec2 a;varying float b;uniform float k;uniform sampler2D l;void main(void){vec4 texColor=texture2D(l,a);gl_FragColor.rgb=texColor.rgb;float alpha=texColor.a*b*k;if(alpha==0.0){discard;}gl_FragColor.a=alpha;}" }

    function ky() { this.a = "varying vec2 a;varying float b;attribute vec2 c;attribute vec2 d;attribute vec2 e;attribute float f;attribute float g;uniform mat4 h;uniform mat4 i;uniform mat4 j;void main(void){mat4 offsetMatrix=i;if(g==1.0){offsetMatrix=i*j;}vec4 offsets=offsetMatrix*vec4(e,0.,0.);gl_Position=h*vec4(c,0.,1.)+offsets;a=d;b=f;}" }

    function Ny(t, e) { this.l = t.getUniformLocation(e, "j"), this.B = t.getUniformLocation(e, "i"), this.i = t.getUniformLocation(e, "k"), this.j = t.getUniformLocation(e, "h"), this.a = t.getAttribLocation(e, "e"), this.b = t.getAttribLocation(e, "f"), this.f = t.getAttribLocation(e, "c"), this.c = t.getAttribLocation(e, "g"), this.g = t.getAttribLocation(e, "d") }

    function Fy(t) { this.a = r(t) ? t : [], this.b = r(void 0) ? void 0 : 35044 }

    function Dy(t, e) { this.v = t, this.a = e, this.b = {}, this.i = {}, this.g = {}, this.l = this.B = this.f = this.j = null, (this.c = q(P, "OES_element_index_uint")) && e.getExtension("OES_element_index_uint"), Te(this.v, "webglcontextlost", this.Vm, !1, this), Te(this.v, "webglcontextrestored", this.Wm, !1, this) }

    function Oy(t, e, o) {
        var i = t.a,
            r = o.a,
            n = d(o);
        if (n in t.b) i.bindBuffer(e, t.b[n].buffer);
        else {
            var s, p = i.createBuffer();
            i.bindBuffer(e, p), 34962 == e ? s = new Float32Array(r) : 34963 == e && (s = t.c ? new Uint32Array(r) : new Uint16Array(r)), i.bufferData(e, s, o.b), t.b[n] = { c: o, buffer: p }
        }
    }

    function By(t, e) {
        var o = t.a,
            i = d(e),
            r = t.b[i];
        o.isContextLost() || o.deleteBuffer(r.buffer), delete t.b[i]
    }

    function Gy(t, e) {
        var o = d(e);
        if (o in t.i) return t.i[o];
        var i = t.a,
            r = i.createShader(e.U());
        return i.shaderSource(r, e.a), i.compileShader(r), t.i[o] = r
    }

    function Uy(t, e, o) {
        var i = d(e) + "/" + d(o);
        if (i in t.g) return t.g[i];
        var r = t.a,
            n = r.createProgram();
        return r.attachShader(n, Gy(t, e)), r.attachShader(n, Gy(t, o)), r.linkProgram(n), t.g[i] = n
    }

    function Xy(t, e, o) { var i = t.createTexture(); return t.bindTexture(t.TEXTURE_2D, i), t.texParameteri(t.TEXTURE_2D, t.TEXTURE_MAG_FILTER, t.LINEAR), t.texParameteri(t.TEXTURE_2D, t.TEXTURE_MIN_FILTER, t.LINEAR), r(e) && t.texParameteri(3553, 10242, e), r(o) && t.texParameteri(3553, 10243, o), i }

    function Ky(t, e, o) { var i = Xy(t, void 0, void 0); return t.texImage2D(t.TEXTURE_2D, 0, t.RGBA, e, o, 0, t.RGBA, t.UNSIGNED_BYTE, null), i }

    function Yy(t, e) { var o = Xy(t, 33071, 33071); return t.texImage2D(t.TEXTURE_2D, 0, t.RGBA, t.RGBA, t.UNSIGNED_BYTE, e), o }

    function Vy(t, e) { this.ea = this.D = void 0, this.sb = new Hr, this.B = Bo(e), this.A = [], this.i = [], this.N = void 0, this.g = [], this.f = [], this.ba = this.T = void 0, this.b = [], this.C = this.ca = this.l = null, this.Z = void 0, this.qb = lo(), this.rb = lo(), this.fa = this.aa = void 0, this.tb = lo(), this.xa = this.Ma = this.ra = void 0, this.Xa = [], this.j = [], this.a = [], this.u = null, this.c = [], this.v = [], this.Na = void 0 }

    function Hy(t, e) {
        var o = t.u,
            i = t.l,
            r = t.Xa,
            n = t.j,
            s = e.a;
        return function() {
            if (!s.isContextLost()) { var t, p; for (t = 0, p = r.length; t < p; ++t) s.deleteTexture(r[t]); for (t = 0, p = n.length; t < p; ++t) s.deleteTexture(n[t]) }
            By(e, o), By(e, i)
        }
    }

    function Wy(t, e, o, i) {
        var r, n, s, p, a, h, l = t.D,
            u = t.ea,
            c = t.N,
            y = t.T,
            f = t.ba,
            g = t.Z,
            d = t.aa,
            v = t.fa,
            b = t.ra ? 1 : 0,
            m = t.Ma,
            w = t.xa,
            S = t.Na,
            x = Math.cos(m),
            M = (m = Math.sin(m), t.b.length),
            P = t.a.length;
        for (r = 0; r < o; r += i) a = e[r] - t.B[0], h = e[r + 1] - t.B[1], n = P / 8, s = -w * l, p = -w * (c - u), t.a[P++] = a, t.a[P++] = h, t.a[P++] = s * x - p * m, t.a[P++] = s * m + p * x, t.a[P++] = d / f, t.a[P++] = (v + c) / y, t.a[P++] = g, t.a[P++] = b, s = w * (S - l), p = -w * (c - u), t.a[P++] = a, t.a[P++] = h, t.a[P++] = s * x - p * m, t.a[P++] = s * m + p * x, t.a[P++] = (d + S) / f, t.a[P++] = (v + c) / y, t.a[P++] = g, t.a[P++] = b, s = w * (S - l), p = w * u, t.a[P++] = a, t.a[P++] = h, t.a[P++] = s * x - p * m, t.a[P++] = s * m + p * x, t.a[P++] = (d + S) / f, t.a[P++] = v / y, t.a[P++] = g, t.a[P++] = b, s = -w * l, p = w * u, t.a[P++] = a, t.a[P++] = h, t.a[P++] = s * x - p * m, t.a[P++] = s * m + p * x, t.a[P++] = d / f, t.a[P++] = v / y, t.a[P++] = g, t.a[P++] = b, t.b[M++] = n, t.b[M++] = n + 1, t.b[M++] = n + 2, t.b[M++] = n, t.b[M++] = n + 2, t.b[M++] = n + 3
    }

    function zy(t, e) {
        var o = e.a;
        t.A.push(t.b.length), t.i.push(t.b.length), t.u = new Fy(t.a), Oy(e, 34962, t.u), t.l = new Fy(t.b), Oy(e, 34963, t.l);
        var i = {};
        Zy(t.Xa, t.g, i, o), Zy(t.j, t.f, i, o), t.D = void 0, t.ea = void 0, t.N = void 0, t.g = null, t.f = null, t.T = void 0, t.ba = void 0, t.b = null, t.Z = void 0, t.aa = void 0, t.fa = void 0, t.ra = void 0, t.Ma = void 0, t.xa = void 0, t.a = null, t.Na = void 0
    }

    function Zy(t, e, o, i) { var r, n, s, p = e.length; for (s = 0; s < p; ++s)(n = d(r = e[s]).toString()) in o ? r = o[n] : (r = Yy(i, r), o[n] = r), t[s] = r }

    function Jy(t, e, o, i, n, s, p, a, h, l, u, c, y, f, g) {
        var v = e.a;
        Oy(e, 34962, t.u), Oy(e, 34963, t.l);
        var b, m, w, S = a || 1 != h || l || 1 != u;
        if (S ? (b = Ry.Pa(), m = Ly.Pa()) : (b = Iy.Pa(), m = ky.Pa()), m = Uy(e, b, m), S ? null === t.ca ? (b = new Ey(v, m), t.ca = b) : b = t.ca : null === t.C ? (b = new Ny(v, m), t.C = b) : b = t.C, e.re(m), v.enableVertexAttribArray(b.f), v.vertexAttribPointer(b.f, 2, 5126, !1, 32, 0), v.enableVertexAttribArray(b.a), v.vertexAttribPointer(b.a, 2, 5126, !1, 32, 8), v.enableVertexAttribArray(b.g), v.vertexAttribPointer(b.g, 2, 5126, !1, 32, 16), v.enableVertexAttribArray(b.b), v.vertexAttribPointer(b.b, 1, 5126, !1, 32, 24), v.enableVertexAttribArray(b.c), v.vertexAttribPointer(b.c, 1, 5126, !1, 32, 28), ba(m = t.tb, 0, 0, 2 / (i * s[0]), 2 / (i * s[1]), -n, -(o[0] - t.B[0]), -(o[1] - t.B[1])), o = t.rb, i = 2 / s[0], s = 2 / s[1], yo(o), o[0] = i, o[5] = s, o[10] = 1, o[15] = 1, yo(s = t.qb), 0 !== n && mo(s, -n), v.uniformMatrix4fv(b.j, !1, m), v.uniformMatrix4fv(b.B, !1, o), v.uniformMatrix4fv(b.l, !1, s), v.uniform1f(b.i, p), S && v.uniformMatrix4fv(b.v, !1, Wr(t.sb, a, h, l, u)), r(y)) {
            if (f) t: {
                for (n = e.c ? 5125 : 5123, e = e.c ? 4 : 2, l = t.c.length - 1, p = t.j.length - 1; 0 <= p; --p)
                    for (v.bindTexture(3553, t.j[p]), a = 0 < p ? t.i[p - 1] : 0, u = t.i[p]; 0 <= l && t.c[l] >= a;) {
                        if (h = t.c[l], !r(c[S = d(f = t.v[l]).toString()]) && (!r(g) || Ho(g, f.Y().R())) && (v.clear(v.COLOR_BUFFER_BIT | v.DEPTH_BUFFER_BIT), v.drawElements(4, u - h, n, h * e), u = y(f))) { t = u; break t }
                        u = h, l--
                    }
                t = void 0
            }
            else v.clear(v.COLOR_BUFFER_BIT | v.DEPTH_BUFFER_BIT), qy(t, v, e, c, t.j, t.i), t = (t = y(null)) ? t : void 0;
            w = t
        } else qy(t, v, e, c, t.Xa, t.A);
        return v.disableVertexAttribArray(b.f), v.disableVertexAttribArray(b.a), v.disableVertexAttribArray(b.g), v.disableVertexAttribArray(b.b), v.disableVertexAttribArray(b.c), w
    }

    function qy(t, e, o, i, n, s) {
        var p, a, h = o.c ? 5125 : 5123;
        if (o = o.c ? 4 : 2, vt(i))
            for (t = 0, i = n.length, p = 0; t < i; ++t) {
                e.bindTexture(3553, n[t]);
                var l = s[t];
                e.drawElements(4, l - p, h, p * o), p = l
            } else
                for (p = 0, l = 0, a = n.length; l < a; ++l) {
                    e.bindTexture(3553, n[l]);
                    for (var u = 0 < l ? s[l - 1] : 0, c = s[l], y = u; p < t.c.length && t.c[p] <= c;) r(i[d(t.v[p]).toString()]) ? (y !== u && e.drawElements(4, u - y, h, y * o), u = y = p === t.c.length - 1 ? c : t.c[p + 1]) : u = p === t.c.length - 1 ? c : t.c[p + 1], p++;
                    y !== u && e.drawElements(4, u - y, h, y * o)
                }
    }

    function $y(t, e, o) { this.f = e, this.g = t, this.c = o, this.b = {} }

    function _y(t, e) { var o, i = []; for (o in t.b) i.push(Hy(t.b[o], e)); return ti.apply(null, i) }

    function Qy(t, e, o, i, n, s, p, a, h, l, u, c, y, f) {
        var g, d, v = ef;
        for (g = Rl.length - 1; 0 <= g; --g)
            if (r(d = t.b[Rl[g]]) && (d = Jy(d, e, o, i, n, v, s, p, a, h, l, u, c, y, f))) return d
    }! function() {
        var t = { Wf: {} };
        ! function() {
            function e(t, o) {
                if (!(this instanceof e)) return new e(t, o);
                this.Ie = Math.max(4, t || 9), this.Nf = Math.max(2, Math.ceil(.4 * this.Ie)), o && this.ti(o), this.clear()
            }

            function o(t, e) { t.bbox = i(t, 0, t.children.length, e) }

            function i(t, e, o, i) { for (var n, s = [1 / 0, 1 / 0, -1 / 0, -1 / 0]; e < o; e++) n = t.children[e], r(s, t.Ba ? i(n) : n.bbox); return s }

            function r(t, e) { t[0] = Math.min(t[0], e[0]), t[1] = Math.min(t[1], e[1]), t[2] = Math.max(t[2], e[2]), t[3] = Math.max(t[3], e[3]) }

            function n(t, e) { return t.bbox[0] - e.bbox[0] }

            function s(t, e) { return t.bbox[1] - e.bbox[1] }

            function p(t) { return (t[2] - t[0]) * (t[3] - t[1]) }

            function a(t) { return t[2] - t[0] + (t[3] - t[1]) }

            function h(t, e) { return t[0] <= e[0] && t[1] <= e[1] && e[2] <= t[2] && e[3] <= t[3] }

            function l(t, e) { return e[0] <= t[2] && e[1] <= t[3] && e[2] >= t[0] && e[3] >= t[1] }

            function u(t, e, o, i, r) { for (var n, s = [e, o]; s.length;)(o = s.pop()) - (e = s.pop()) <= i || (c(t, e, o, n = e + Math.ceil((o - e) / i / 2) * i, r), s.push(e, n, n, o)) }

            function c(t, e, o, i, r) {
                for (var n, s, p, a, h; o > e;) {
                    for (600 < o - e && (n = o - e + 1, s = i - e + 1, p = Math.log(n), a = .5 * Math.exp(2 * p / 3), h = .5 * Math.sqrt(p * a * (n - a) / n) * (0 > s - n / 2 ? -1 : 1), c(t, p = Math.max(e, Math.floor(i - s * a / n + h)), s = Math.min(o, Math.floor(i + (n - s) * a / n + h)), i, r)), n = t[i], s = e, a = o, y(t, e, i), 0 < r(t[o], n) && y(t, e, o); s < a;) { for (y(t, s, a), s++, a--; 0 > r(t[s], n);) s++; for (; 0 < r(t[a], n);) a-- }
                    0 === r(t[e], n) ? y(t, e, a) : y(t, ++a, o), a <= i && (e = a + 1), i <= a && (o = a - 1)
                }
            }

            function y(t, e, o) {
                var i = t[e];
                t[e] = t[o], t[o] = i
            }
            e.prototype = {
                all: function() { return this.Jf(this.data, []) },
                search: function(t) {
                    var e = this.data,
                        o = [],
                        i = this.La;
                    if (!l(t, e.bbox)) return o;
                    for (var r, n, s, p, a = []; e;) {
                        for (r = 0, n = e.children.length; r < n; r++) s = e.children[r], l(t, p = e.Ba ? i(s) : s.bbox) && (e.Ba ? o.push(s) : h(t, p) ? this.Jf(s, o) : a.push(s));
                        e = a.pop()
                    }
                    return o
                },
                load: function(t) { if (!t || !t.length) return this; if (t.length < this.Nf) { for (var e = 0, o = t.length; e < o; e++) this.oa(t[e]); return this } return t = this.Lf(t.slice(), 0, t.length - 1, 0), this.data.children.length ? this.data.height === t.height ? this.Of(this.data, t) : (this.data.height < t.height && (e = this.data, this.data = t, t = e), this.Mf(t, this.data.height - t.height - 1, !0)) : this.data = t, this },
                oa: function(t) { return t && this.Mf(t, this.data.height - 1), this },
                clear: function() { return this.data = { children: [], height: 1, bbox: [1 / 0, 1 / 0, -1 / 0, -1 / 0], Ba: !0 }, this },
                remove: function(t) {
                    if (!t) return this;
                    for (var e, o, i, r, n = this.data, s = this.La(t), p = [], a = []; n || p.length;) {
                        if (n || (n = p.pop(), o = p[p.length - 1], e = a.pop(), r = !0), n.Ba && -1 !== (i = n.children.indexOf(t))) { n.children.splice(i, 1), p.push(n), this.si(p); break }
                        r || n.Ba || !h(n.bbox, s) ? o ? (e++, n = o.children[e], r = !1) : n = null : (p.push(n), a.push(e), e = 0, o = n, n = n.children[0])
                    }
                    return this
                },
                La: function(t) { return t },
                Le: function(t, e) { return t[0] - e[0] },
                Me: function(t, e) { return t[1] - e[1] },
                toJSON: function() { return this.data },
                Jf: function(t, e) { for (var o = []; t;) t.Ba ? e.push.apply(e, t.children) : o.push.apply(o, t.children), t = o.pop(); return e },
                Lf: function(t, e, i, r) {
                    var n, s, p, a, h, l;
                    if ((s = i - e + 1) <= (p = this.Ie)) return o(n = { children: t.slice(e, i + 1), height: 1, bbox: null, Ba: !0 }, this.La), n;
                    for (r || (r = Math.ceil(Math.log(s) / Math.log(p)), p = Math.ceil(s / Math.pow(p, r - 1))), n = { children: [], height: r, bbox: null }, u(t, e, i, p = (s = Math.ceil(s / p)) * Math.ceil(Math.sqrt(p)), this.Le); e <= i; e += p)
                        for (u(t, e, h = Math.min(e + p - 1, i), s, this.Me), a = e; a <= h; a += s) l = Math.min(a + s - 1, h), n.children.push(this.Lf(t, a, l, r - 1));
                    return o(n, this.La), n
                },
                ri: function(t, e, o, i) {
                    for (var r, n, s, a, h, l, u, c; i.push(e), !e.Ba && i.length - 1 !== o;) {
                        for (u = c = 1 / 0, r = 0, n = e.children.length; r < n; r++) {
                            h = p((s = e.children[r]).bbox), l = t;
                            var y = s.bbox;
                            (l = (Math.max(y[2], l[2]) - Math.min(y[0], l[0])) * (Math.max(y[3], l[3]) - Math.min(y[1], l[1])) - h) < c ? (c = l, u = h < u ? h : u, a = s) : l === c && h < u && (u = h, a = s)
                        }
                        e = a
                    }
                    return e
                },
                Mf: function(t, e, o) {
                    var i = this.La;
                    o = o ? t.bbox : i(t), i = [];
                    var n = this.ri(o, this.data, e, i);
                    for (n.children.push(t), r(n.bbox, o); 0 <= e && i[e].children.length > this.Ie;) this.ui(i, e), e--;
                    this.ni(o, i, e)
                },
                ui: function(t, e) {
                    var i = t[e],
                        r = i.children.length,
                        n = this.Nf;
                    this.oi(i, n, r), r = { children: i.children.splice(this.pi(i, n, r)), height: i.height }, i.Ba && (r.Ba = !0), o(i, this.La), o(r, this.La), e ? t[e - 1].children.push(r) : this.Of(i, r)
                },
                Of: function(t, e) { this.data = { children: [t, e], height: t.height + 1 }, o(this.data, this.La) },
                pi: function(t, e, o) {
                    var r, n, s, a, h, l, u;
                    for (h = l = 1 / 0, r = e; r <= o - e; r++) {
                        var c = n = i(t, 0, r, this.La),
                            y = s = i(t, r, o, this.La);
                        a = Math.max(c[0], y[0]);
                        var f = Math.max(c[1], y[1]),
                            g = Math.min(c[2], y[2]);
                        c = Math.min(c[3], y[3]), a = Math.max(0, g - a) * Math.max(0, c - f), n = p(n) + p(s), a < h ? (h = a, u = r, l = n < l ? n : l) : a === h && n < l && (l = n, u = r)
                    }
                    return u
                },
                oi: function(t, e, o) {
                    var i = t.Ba ? this.Le : n,
                        r = t.Ba ? this.Me : s;
                    this.Kf(t, e, o, i) < (e = this.Kf(t, e, o, r)) && t.children.sort(i)
                },
                Kf: function(t, e, o, n) {
                    t.children.sort(n);
                    var s, p, h = i(t, 0, e, n = this.La),
                        l = i(t, o - e, o, n),
                        u = a(h) + a(l);
                    for (s = e; s < o - e; s++) p = t.children[s], r(h, t.Ba ? n(p) : p.bbox), u += a(h);
                    for (s = o - e - 1; s >= e; s--) p = t.children[s], r(l, t.Ba ? n(p) : p.bbox), u += a(l);
                    return u
                },
                ni: function(t, e, o) { for (; 0 <= o; o--) r(e[o].bbox, t) },
                si: function(t) { for (var e, i = t.length - 1; 0 <= i; i--) 0 === t[i].children.length ? 0 < i ? (e = t[i - 1].children).splice(e.indexOf(t[i]), 1) : this.clear() : o(t[i], this.La) },
                ti: function(t) {
                    var e = ["return a", " - b", ";"];
                    this.Le = new Function("a", "b", e.join(t[0])), this.Me = new Function("a", "b", e.join(t[1])), this.La = new Function("a", "return [a" + t.join(", a") + "];")
                }
            }, "function" == typeof define && define.Io ? define("rbush", (function() { return e })) : void 0 !== t ? t.Wf = e : "undefined" != typeof self ? self.a = e : window.a = e
        }(), Vc = t.Wf
    }(), (t = ey.prototype).oa = function(t, e) {
        var o = [t[0], t[1], t[2], t[3], e];
        this.b.oa(o), this.a[d(e)] = o
    }, t.load = function(t, e) {
        for (var o = Array(e.length), i = 0, r = e.length; i < r; i++) {
            var n = t[i],
                s = e[i];
            n = [n[0], n[1], n[2], n[3], s], o[i] = n, this.a[d(s)] = n
        }
        this.b.load(o)
    }, t.remove = function(t) { t = d(t); var e = this.a[t]; return mt(this.a, t), null !== this.b.remove(e) }, t.update = function(t, e) {
        var o = d(e);
        Eo(this.a[o].slice(0, 4), t) || (this.remove(e), this.oa(t, e))
    }, t.forEach = function(t, e) { return ny(oy(this), t, e) }, t.wa = function() { return vt(this.a) }, t.clear = function() { this.b.clear(), this.a = {} }, t.R = function() { return this.b.data.bbox }, A(sy, zn), (t = sy.prototype).pd = function(t) {
        var e = d(t).toString();
        if (ay(this, e, t)) {
            py(this, e, t);
            var o = t.Y();
            null != o ? (e = o.R(), null === this.b || this.b.oa(e, t)) : this.f[e] = t, Be(this, new uy("addfeature", t))
        }
        this.s()
    }, t.xc = function(t) { hy(this, t), this.s() }, t.clear = function(t) {
        if (t) {
            for (var e in this.v) H(this.v[e], Re);
            null === this.c && (this.v = {}, this.i = {}, this.l = {})
        } else t = this.qh, null !== this.b && (this.b.forEach(t, this), lt(this.f, t, this));
        null === this.c || this.c.clear(), null === this.b || this.b.clear(), this.Z.clear(), this.f = {}, Be(this, new uy("clear")), this.s()
    }, t.Xf = function(t, e) { return null !== this.b ? this.b.forEach(t, e) : null !== this.c ? this.c.forEach(t, e) : void 0 }, t.fd = function(t, e, o) { return null !== this.b ? ry(this.b, t, e, o) : null !== this.c ? this.c.forEach(e, o) : void 0 }, t.Hb = function(t, e, o, i) { return this.fd(t, o, i) }, t.Se = function(t, e, o) { return this.fd(t, (function(i) { if (i.Y().sa(t) && (i = e.call(o, i))) return i })) }, t.We = function() { return this.c }, t.Ic = function() { var t; return null !== this.c ? t = this.c.b : null !== this.b && (t = oy(this.b), vt(this.f) || tt(t, ct(this.f))), t }, t.Ve = function(t) { var e = []; return function(t, e, o) { t.fd([e[0], e[1], e[0], e[1]], (function(t) { if (t.Y().Ne(e)) return o.call(void 0, t) })) }(this, t, (function(t) { e.push(t) })), e }, t.Xe = function(t) { return iy(this.b, t) }, t.Zf = function(t) {
        var e = t[0],
            o = t[1],
            i = null,
            r = [NaN, NaN],
            n = 1 / 0,
            s = [-1 / 0, -1 / 0, 1 / 0, 1 / 0];
        return ry(this.b, s, (function(t) {
            var p = t.Y(),
                a = n;
            (n = p.Ya(e, o, r, n)) < a && (i = t, t = Math.sqrt(n), s[0] = e - t, s[1] = o - t, s[2] = e + t, s[3] = o + t)
        })), i
    }, t.R = function() { return this.b.R() }, t.Ue = function(t) { return r(t = this.i[t.toString()]) ? t : null }, t.mg = function(t) {
        var e = d(t = t.target).toString(),
            o = t.Y();
        null != o ? (o = o.R(), e in this.f ? (delete this.f[e], null === this.b || this.b.oa(o, t)) : null === this.b || this.b.update(o, t)) : e in this.f || (null === this.b || this.b.remove(t), this.f[e] = t), r(o = t.ha) ? (o = o.toString(), e in this.l ? (delete this.l[e], this.i[o] = t) : this.i[o] !== t && (ly(this, t), this.i[o] = t)) : e in this.l || (ly(this, t), this.l[e] = t), this.s(), Be(this, new uy("changefeature", t))
    }, t.wa = function() { return this.b.wa() && vt(this.f) }, t.fc = function(t, e, o) {
        var i, r, n = this.Z;
        for (i = 0, r = (t = this.xa(t, e)).length; i < r; ++i) {
            var s = t[i];
            ry(n, s, (function(t) { return jo(t.extent, s) })) || (this.T.call(this, s, e, o), n.oa(s, { extent: s.slice() }))
        }
    }, t.Jc = function(t) {
        var e = d(t).toString();
        e in this.f ? delete this.f[e] : null === this.b || this.b.remove(t), this.qh(t), this.s()
    }, t.qh = function(t) {
        var e = d(t).toString();
        H(this.v[e], Re), delete this.v[e];
        var o = t.ha;
        r(o) ? delete this.i[o.toString()] : delete this.l[e], Be(this, new uy("removefeature", t))
    }, A(uy, re), A(cy, Ru), (t = cy.prototype).Fi = function(t, e, o, i, n) {
        var s = new Vl(.5 * e / o, t, e);
        this.b.fc(t, e, n);
        var p = !1;
        return this.b.Hb(t, e, (function(t) {
            var i, n;
            if (!(i = p))
                if (r(t.c) ? n = t.c.call(t, e) : r(this.i) && (n = this.i(t, e)), null != n) {
                    var a, h = !1;
                    for (i = 0, a = n.length; i < a; ++i) h = bu(s, t, n[i], vu(e, o), this.Xl, this) || h;
                    i = h
                } else i = !1;
            p = i
        }), this), Hl(s), p ? null : (this.f[0] != i[0] || this.f[1] != i[1] ? (this.c.canvas.width = '', this.c.canvas.height = i[1], this.f[0] = i[0], this.f[1] = i[1]) : this.c.clearRect(0, 0, i[0], i[1]), t = function(t, e, o, i, r) { return ba(t.fa, r[0] / 2, r[1] / 2, i / o, -i / o, 0, -e[0], -e[1]) }(this, Bo(t), e, o, i), zl(s, this.c, o, t, 0, {}), this.u = s, this.c.canvas)
    }, t.ke = function(t, e, o, i, r) { if (null !== this.u) { var n = {}; return Wl(this.u, t, e, 0, i, (function(t) { var e = d(t).toString(); if (!(e in n)) return n[e] = !0, r(t) })) } }, t.Ul = function() { return this.b }, t.Vl = function() { return this.C }, t.Wl = function() { return this.i }, t.Xl = function() { this.s() }, t.Yl = function() { Jn(this, this.b.A) }, t.Pg = function(t) { this.C = r(t) ? t : Fh, this.i = null === t ? void 0 : Nh(this.C), this.s() }, A(yy, Pl), (t = yy.prototype).Va = function(t, e, o, i) { var r = this.b; return r.da().ke(t, e.viewState.resolution, e.viewState.rotation, e.skippedFeatureUids, (function(t) { return o.call(i, t, r) })) }, t.jc = function(t, e, o, i) {
        if (!h(this.je()))
            if (this.b.da() instanceof cy) { if (t = t.slice(), wa(e.pixelToCoordinateMatrix, t, t), this.Va(t, e, $o, this)) return o.call(i, this.b) } else if (null === this.f && (this.f = ho(), go(this.i, this.f)), e = Al(t, this.f), null === this.c && (this.c = ip(1, 1)), this.c.clearRect(0, 0, 1, 1), this.c.drawImage(this.je(), e[0], e[1], 1, 1, 0, 0, 1, 1), 0 < this.c.getImageData(0, 0, 1, 1).data[3]) return o.call(i, this.b)
    }, t.je = function() { return null === this.g ? null : this.g.a() }, t.cg = function() { return this.i }, t.nf = function(t, e) {
        var o, i = t.pixelRatio,
            n = (l = t.viewState).center,
            s = l.resolution,
            p = l.rotation,
            a = this.b.da(),
            h = t.viewHints;
        if (o = t.extent, r(e.extent) && (o = Xo(o, e.extent)), h[0] || h[1] || Wo(o) || (l = l.projection, null === (h = a.j) || (l = h), null !== (o = a.Hc(o, s, i, l)) && xa(this, o) && (this.g = o)), null !== this.g) {
            var l = (o = this.g).R(),
                u = (h = o.resolution, o.g);
            s = i * h / (s * u), ba(this.i, i * t.size[0] / 2, i * t.size[1] / 2, s, s, p, u * (l[0] - n[0]) / h, u * (n[1] - l[3]) / h), this.f = null, Ta(t.attributions, o.i), ja(t, a)
        }
        return !0
    }, A(fy, Pl), fy.prototype.je = function() { return this.i }, fy.prototype.cg = function() { return this.v }, fy.prototype.nf = function(t, e) {
        var o, i = t.pixelRatio,
            n = t.viewState,
            s = n.projection,
            p = this.b,
            a = p.da(),
            h = us(a, s),
            l = a.Kd(),
            u = ns(h, n.resolution),
            c = a.cc(u, t.pixelRatio, s),
            y = c[0] / qe(h.Ja(u), this.T)[0],
            f = h.ua(u),
            g = (y = f / y, n.center);
        if (o = f == n.resolution ? Go(g = Ca(g, f, t.size), f, n.rotation, t.size) : t.extent, r(e.extent) && (o = Xo(o, e.extent)), Wo(o)) return !1;
        var d, v, b, m, w = ts(h, o, f),
            S = c[0] * Ir(w),
            x = c[1] * (w.c - w.b + 1);
        null === this.i ? (v = ip(S, x), this.i = v.canvas, this.c = [S, x], this.j = v, this.B = !Cl(this.c)) : (d = this.i, v = this.j, this.c[0] < S || this.c[1] < x || this.C !== c[0] || this.D !== c[1] || this.B && (this.c[0] > S || this.c[1] > x) ? (d.width = S, d.height = x, this.c = [S, x], this.B = !Cl(this.c), this.f = null) : (S = this.c[0], x = this.c[1], (d = u != this.A) || (d = !((d = this.f).a <= w.a && w.f <= d.f && d.b <= w.b && w.c <= d.c)), d && (this.f = null))), null === this.f ? (S /= c[0], x /= c[1], b = w.a - Math.floor((S - Ir(w)) / 2), m = w.b - Math.floor((x - (w.c - w.b + 1)) / 2), this.A = u, this.C = c[0], this.D = c[1], this.f = new Lr(b, b + S - 1, m, m + x - 1), this.l = Array(S * x), x = this.f) : S = Ir(x = this.f), (d = {})[u] = {};
        var M, P, T, j = [],
            A = this.Gd(a, d),
            C = p.c(),
            R = [1 / 0, 1 / 0, -1 / 0, -1 / 0],
            L = new Lr(0, 0, 0, 0);
        for (m = w.a; m <= w.f; ++m)
            for (T = w.b; T <= w.c; ++T) 2 == (b = (P = a.bc(u, m, T, i, s)).state) || 4 == b || 3 == b && !C ? d[u][Ar(P.a)] = P : (M = _n(h, P.a, A, L, R)) || (j.push(P), null === (M = Qn(h, P.a, L, R)) || A(u + 1, M));
        for (A = 0, M = j.length; A < M; ++A) P = j[A], m = c[0] * (P.a[1] - x.a), T = c[1] * (x.c - P.a[2]), v.clearRect(m, T, c[0], c[1]);
        ot(j = z(yt(d), Number));
        var E, I, k, N, F, D, O = a.aa,
            B = Ko(is(h, [u, x.a, x.c], R));
        for (A = 0, M = j.length; A < M; ++A)
            if (E = j[A], c = a.cc(E, i, s), N = d[E], E == u)
                for (k in N) I = ((P = N[k]).a[2] - x.b) * S + (P.a[1] - x.a), this.l[I] != P && (m = c[0] * (P.a[1] - x.a), T = c[1] * (x.c - P.a[2]), 4 != (b = P.state) && (3 != b || C) && O || v.clearRect(m, T, c[0], c[1]), 2 == b && v.drawImage(P.Ta(), l, l, c[0], c[1], m, T, c[0], c[1]), this.l[I] = P);
            else
                for (k in E = h.ua(E) / f, N)
                    for (m = ((I = is(h, (P = N[k]).a, R))[0] - B[0]) / y, T = (B[1] - I[3]) / y, D = E * c[0], F = E * c[1], 4 != (b = P.state) && O || v.clearRect(m, T, D, F), 2 == b && v.drawImage(P.Ta(), l, l, c[0], c[1], m, T, D, F), P = es(h, I, u, L), b = Math.max(P.a, x.a), T = Math.min(P.f, x.f), m = Math.max(P.b, x.b), P = Math.min(P.c, x.c); b <= T; ++b)
                        for (F = m; F <= P; ++F) I = (F - x.b) * S + (b - x.a), this.l[I] = void 0;
        return Aa(t.usedTiles, a, u, w), Ra(t, a, h, i, s, o, u, p.b()), Pa(t, a), ja(t, a), ba(this.v, i * t.size[0] / 2, i * t.size[1] / 2, i * y / n.resolution, i * y / n.resolution, n.rotation, (B[0] - g[0]) / y, (g[1] - B[1]) / y), this.g = null, !0
    }, fy.prototype.jc = function(t, e, o, i) { if (null !== this.j && (null === this.g && (this.g = ho(), go(this.v, this.g)), t = Al(t, this.g), 0 < this.j.getImageData(t[0], t[1], 1, 1).data[3])) return o.call(i, this.b) }, A(gy, Pl), gy.prototype.u = function(t, e, o) {
        var i = t.extent,
            r = t.pixelRatio,
            n = e.Pb ? t.skippedFeatureUids : {},
            s = (p = t.viewState).projection,
            p = p.rotation,
            a = s.R(),
            h = this.b.da(),
            l = jl(this, t, 0);
        Tl(this, "precompose", o, t, l);
        var u = this.c;
        if (null !== u && !u.wa()) {
            var c;
            Ue(this.b, "render") ? (this.g.canvas.width = o.canvas.width, this.g.canvas.height = o.canvas.height, c = this.g) : c = o;
            var y = c.globalAlpha;
            if (c.globalAlpha = e.opacity, zl(u, c, r, l, p, n), h.D && s.g && !jo(a, i)) {
                for (e = i[0], s = Vo(a), h = 0; e < a[0];) zl(u, c, r, l = jl(this, t, l = s * --h), p, n), e += s;
                for (h = 0, e = i[2]; e > a[2];) zl(u, c, r, l = jl(this, t, l = s * ++h), p, n), e -= s;
                l = jl(this, t, 0)
            }
            c != o && (Tl(this, "render", c, t, l), o.drawImage(c.canvas, 0, 0)), c.globalAlpha = y
        }
        Tl(this, "postcompose", o, t, l)
    }, gy.prototype.Va = function(t, e, o, i) {
        if (null !== this.c) {
            var r = e.viewState.resolution,
                n = e.viewState.rotation,
                s = this.b,
                p = e.layerStates[d(s)],
                a = {};
            return Wl(this.c, t, r, n, p.Pb ? e.skippedFeatureUids : {}, (function(t) { var e = d(t).toString(); if (!(e in a)) return a[e] = !0, o.call(i, t, s) }))
        }
    }, gy.prototype.v = function() { Ma(this) }, gy.prototype.nf = function(t) {
        function e(t) {
            var e;
            if (r(t.c) ? e = t.c.call(t, l) : r(o.b) && (e = (0, o.b)(t, l)), null != e) {
                if (null != e) {
                    var i, n, s = !1;
                    for (i = 0, n = e.length; i < n; ++i) s = bu(y, t, e[i], vu(l, u), this.v, this) || s;
                    t = s
                } else t = !1;
                this.f = this.f || t
            }
        }
        var o = this.b,
            i = o.da();
        Ta(t.attributions, i.g), ja(t, i);
        var n = t.viewHints[0],
            s = t.viewHints[1],
            p = o.u,
            a = o.A;
        if (!this.f && !p && n || !a && s) return !0;
        var h = t.extent,
            l = (n = (a = t.viewState).projection, a.resolution),
            u = t.pixelRatio,
            c = (s = o.a, o.c);
        if (r(p = o.get("renderOrder")) || (p = du), h = xo(h, c * l), c = a.projection.R(), i.D && a.projection.g && !jo(c, t.extent) && (t = Math.max(Vo(h) / 2, Vo(c)), h[0] = c[0] - t, h[2] = c[2] + t), !this.f && this.l == l && this.B == s && this.j == p && jo(this.i, h)) return !0;
        ie(this.c), this.c = null, this.f = !1;
        var y = new Vl(.5 * l / u, h, l, o.c);
        if (i.fc(h, l, n), null === p) i.Hb(h, l, e, this);
        else {
            var f = [];
            i.Hb(h, l, (function(t) { f.push(t) }), this), ot(f, p), H(f, e, this)
        }
        return Hl(y), this.l = l, this.B = s, this.j = p, this.i = h, this.c = y, !0
    }, A(dy, Na), dy.prototype.Oe = function(t) { return t instanceof cl ? new yy(t) : t instanceof yl ? new fy(t) : t instanceof fl ? new gy(t) : null }, dy.prototype.U = function() { return "canvas" }, dy.prototype.xe = function(t) {
        if (null === t) this.b && (En(this.a, !1), this.b = !1);
        else {
            var e, o, i, r, n = this.c,
                s = t.size[0] * t.pixelRatio,
                p = t.size[1] * t.pixelRatio;
            for (this.a.width != s || this.a.height != p ? (this.a.width = s, this.a.height = p) : n.clearRect(0, 0, this.a.width, this.a.height), Fa(t), vy(this, "precompose", t), s = t.layerStatesArray, p = t.viewState.resolution, e = 0, o = s.length; e < o; ++e) i = Oa(this, i = (r = s[e]).layer), da(r, p) && "ready" == r.l && i.nf(t, r) && i.u(t, r, n);
            vy(this, "postcompose", t), this.b || (En(this.a, !0), this.b = !0), Ba(this, t), t.postRenderFunctions.push(Da)
        }
    }, A(by, Sa), by.prototype.g = s, by.prototype.l = s, A(my, by), my.prototype.Va = function(t, e, o, i) { var r = this.b; return r.da().ke(t, e.viewState.resolution, e.viewState.rotation, e.skippedFeatureUids, (function(t) { return o.call(i, t, r) })) }, my.prototype.g = function() { sn(this.target), this.c = null }, my.prototype.i = function(t, e) {
        var o = t.viewState,
            i = o.center,
            n = o.resolution,
            s = o.rotation,
            p = this.c,
            a = this.b.da(),
            h = t.viewHints,
            l = t.extent;
        return r(e.extent) && (l = Xo(l, e.extent)), h[0] || h[1] || Wo(l) || (o = o.projection, null === (h = a.j) || (o = h), null === (l = a.Hc(l, n, t.pixelRatio, o)) || xa(this, l) && (p = l)), null !== p && (o = p.R(), h = p.resolution, ba(l = ho(), t.size[0] / 2, t.size[1] / 2, h / n, h / n, s, (o[0] - i[0]) / h, (i[1] - o[3]) / h), p != this.c && ((i = p.a(this)).style.maxWidth = "none", i.style.position = "absolute", sn(this.target), this.target.appendChild(i), this.c = p), ma(l, this.f) || (pp(this.target, l), co(this.f, l)), Ta(t.attributions, p.i), ja(t, a)), !0
    }, A(wy, by), wy.prototype.g = function() { sn(this.target), this.j = 0 }, wy.prototype.i = function(t, e) {
        if (!e.visible) return this.f && (En(this.target, !1), this.f = !1), !0;
        var o, i = t.pixelRatio,
            n = t.viewState,
            s = n.projection,
            p = this.b,
            a = p.da(),
            h = us(a, s),
            l = a.Kd(),
            u = ns(h, n.resolution),
            c = h.ua(u),
            y = n.center;
        o = c == n.resolution ? Go(y = Ca(y, c, t.size), c, n.rotation, t.size) : t.extent, r(e.extent) && (o = Xo(o, e.extent)), c = ts(h, o, c);
        var f = {};
        f[u] = {};
        var g, d, v, b, m, w, S = this.Gd(a, f),
            x = p.c(),
            M = [1 / 0, 1 / 0, -1 / 0, -1 / 0],
            P = new Lr(0, 0, 0, 0);
        for (v = c.a; v <= c.f; ++v)
            for (b = c.b; b <= c.c; ++b) 2 == (d = (g = a.bc(u, v, b, i, s)).state) ? f[u][Ar(g.a)] = g : 4 == d || 3 == d && !x || (d = _n(h, g.a, S, P, M)) || null === (g = Qn(h, g.a, P, M)) || S(u + 1, g);
        if (this.j != a.a) {
            for (m in this.c) an((x = this.c[+m]).target);
            this.c = {}, this.j = a.a
        }
        for (ot(M = z(yt(f), Number)), S = {}, v = 0, b = M.length; v < b; ++v) {
            for (w in (m = M[v]) in this.c ? x = this.c[m] : (x = h.Rd(y, m), x = new Sy(h, x), S[m] = !0, this.c[m] = x), m = f[m]) {
                g = x;
                var T, j = l,
                    A = (T = (d = m[w]).a)[0],
                    C = T[1],
                    R = T[2];
                if (!((T = Ar(T)) in g.b)) {
                    A = qe(g.f.Ja(A), g.l);
                    var L = d.Ta(g),
                        E = L.style;
                    E.maxWidth = "none";
                    var I = void 0,
                        k = void 0;
                    0 < j ? ((k = (I = rn("DIV")).style).overflow = "hidden", k.width = A[0] + "px", k.height = A[1] + "px", E.position = "absolute", E.left = -j + "px", E.top = -j + "px", E.width = A[0] + 2 * j + "px", E.height = A[1] + 2 * j + "px", I.appendChild(L)) : (E.width = A[0] + "px", E.height = A[1] + "px", I = L, k = E), k.position = "absolute", k.left = (C - g.c[1]) * A[0] + "px", k.top = (g.c[2] - R) * A[1] + "px", null === g.a && (g.a = document.createDocumentFragment()), g.a.appendChild(I), g.b[T] = d
                }
            }
            null !== x.a && (x.target.appendChild(x.a), x.a = null)
        }
        for (ot(l = z(yt(this.c), Number)), v = ho(), w = 0, M = l.length; w < M; ++w)
            if (m = l[w], x = this.c[m], m in f) {
                if (g = x.j, b = x.i, ba(v, t.size[0] / 2, t.size[1] / 2, g / n.resolution, g / n.resolution, n.rotation, (b[0] - y[0]) / g, (y[1] - b[1]) / g), ma(g = v, (b = x).g) || (pp(b.target, g), co(b.g, g)), m in S) {
                    for (--m; 0 <= m; --m)
                        if (m in this.c) {
                            (b = this.c[m].target).parentNode && b.parentNode.insertBefore(x.target, b.nextSibling);
                            break
                        }
                    0 > m && pn(this.target, x.target, 0)
                } else if (!t.viewHints[0] && !t.viewHints[1]) { for (g in d = es(x.f, o, x.c[0], P), m = [], g = b = void 0, x.b) b = x.b[g], d.contains(b.a) || m.push(b); for (j = d = void 0, d = 0, j = m.length; d < j; ++d) g = Ar((b = m[d]).a), an(b.Ta(x)), delete x.b[g] }
            } else an(x.target), delete this.c[m];
        return e.opacity != this.B && (this.B = this.target.style.opacity = e.opacity), e.visible && !this.f && (En(this.target, !0), this.f = !0), Aa(t.usedTiles, a, u, c), Ra(t, a, h, i, s, o, u, p.b()), Pa(t, a), ja(t, a), !0
    }, A(xy, by), xy.prototype.l = function(t, e) {
        var o = (n = t.viewState).center,
            i = n.rotation,
            r = n.resolution,
            n = t.pixelRatio,
            s = t.size[0],
            p = t.size[1],
            a = s * n,
            h = p * n;
        o = ba(this.C, n * s / 2, n * p / 2, n / r, -n / r, -i, -o[0], -o[1]), (r = this.j).canvas.width = a, r.canvas.height = h, s = ba(this.D, 0, 0, 1 / n, 1 / n, 0, -(a - s) / 2 * n, -(h - p) / 2 * n), pp(r.canvas, s), My(this, "precompose", t, o), null === (s = this.c) || s.wa() || (r.globalAlpha = e.opacity, zl(s, r, n, o, i, e.Pb ? t.skippedFeatureUids : {}), My(this, "render", t, o)), My(this, "postcompose", t, o)
    }, xy.prototype.Va = function(t, e, o, i) {
        if (null !== this.c) {
            var r = e.viewState.resolution,
                n = e.viewState.rotation,
                s = this.b,
                p = e.layerStates[d(s)],
                a = {};
            return Wl(this.c, t, r, n, p.Pb ? e.skippedFeatureUids : {}, (function(t) { var e = d(t).toString(); if (!(e in a)) return a[e] = !0, o.call(i, t, s) }))
        }
    }, xy.prototype.N = function() { Ma(this) }, xy.prototype.i = function(t) {
        function e(t) {
            var e;
            if (r(t.c) ? e = t.c.call(t, h) : r(o.b) && (e = (0, o.b)(t, h)), null != e) {
                if (null != e) {
                    var i, n, s = !1;
                    for (i = 0, n = e.length; i < n; ++i) s = bu(u, t, e[i], vu(h, l), this.N, this) || s;
                    t = s
                } else t = !1;
                this.f = this.f || t
            }
        }
        var o = this.b,
            i = o.da();
        Ta(t.attributions, i.g), ja(t, i);
        var n = t.viewHints[0],
            s = t.viewHints[1],
            p = o.u,
            a = o.A;
        if (!this.f && !p && n || !a && s) return !0;
        s = t.extent, n = (p = t.viewState).projection;
        var h = p.resolution,
            l = t.pixelRatio;
        if (t = o.a, a = o.c, r(p = o.get("renderOrder")) || (p = du), s = xo(s, a * h), !this.f && this.u == h && this.A == t && this.v == p && jo(this.B, s)) return !0;
        ie(this.c), this.c = null, this.f = !1;
        var u = new Vl(.5 * h / l, s, h, o.c);
        if (i.fc(s, h, n), null === p) i.Hb(s, h, e, this);
        else {
            var c = [];
            i.Hb(s, h, (function(t) { c.push(t) }), this), ot(c, p), H(c, e, this)
        }
        return Hl(u), this.u = h, this.A = t, this.v = p, this.B = s, this.c = u, !0
    }, A(Py, Na), Py.prototype.W = function() { an(this.a), Py.$.W.call(this) }, Py.prototype.Oe = function(t) {
        if (t instanceof cl) t = new my(t);
        else if (t instanceof yl) t = new wy(t);
        else {
            if (!(t instanceof fl)) return null;
            t = new xy(t)
        }
        return t
    }, Py.prototype.U = function() { return "dom" }, Py.prototype.xe = function(t) {
        if (null === t) this.c && (En(this.a, !1), this.c = !1);
        else {
            var e, o, i, r, n;
            if (e = function(t, e) { pn(this.a, t, e) }, Ue(s = this.i, "precompose") || Ue(s, "postcompose")) {
                var s = this.b.canvas,
                    p = t.pixelRatio;
                s.width = t.size[0] * p, s.height = t.size[1] * p
            }
            for (Ty(this, "precompose", t), s = t.layerStatesArray, p = t.viewState.resolution, o = 0, i = s.length; o < i; ++o) r = Oa(this, r = (n = s[o]).layer), e.call(this, r.target, o), da(n, p) && "ready" == n.l ? r.i(t, n) && r.l(t, n) : r.g();
            for (var a in e = t.layerStates, this.f) a in e || an((r = this.f[a]).target);
            this.c || (En(this.a, !0), this.c = !0), Fa(t), Ba(this, t), t.postRenderFunctions.push(Da), Ty(this, "postcompose", t)
        }
    }, A(Ay, jy), Ay.prototype.U = function() { return 35632 }, A(Cy, jy), Cy.prototype.U = function() { return 35633 }, A(Ry, Ay), p(Ry), A(Ly, Cy), p(Ly), A(Iy, Ay), p(Iy), A(ky, Cy), p(ky), (t = Dy.prototype).W = function() {
        var t = this.a;
        t.isContextLost() || (lt(this.b, (function(e) { t.deleteBuffer(e.buffer) })), lt(this.g, (function(e) { t.deleteProgram(e) })), lt(this.i, (function(e) { t.deleteShader(e) })), t.deleteFramebuffer(this.f), t.deleteRenderbuffer(this.l), t.deleteTexture(this.B))
    }, t.Um = function() { return this.a }, t.Ye = function() {
        if (null === this.f) {
            var t = this.a,
                e = t.createFramebuffer();
            t.bindFramebuffer(t.FRAMEBUFFER, e);
            var o = Ky(t, 1, 1),
                i = t.createRenderbuffer();
            t.bindRenderbuffer(t.RENDERBUFFER, i), t.renderbufferStorage(t.RENDERBUFFER, t.DEPTH_COMPONENT16, 1, 1), t.framebufferTexture2D(t.FRAMEBUFFER, t.COLOR_ATTACHMENT0, t.TEXTURE_2D, o, 0), t.framebufferRenderbuffer(t.FRAMEBUFFER, t.DEPTH_ATTACHMENT, t.RENDERBUFFER, i), t.bindTexture(t.TEXTURE_2D, null), t.bindRenderbuffer(t.RENDERBUFFER, null), t.bindFramebuffer(t.FRAMEBUFFER, null), this.f = e, this.B = o, this.l = i
        }
        return this.f
    }, t.Vm = function() { bt(this.b), bt(this.i), bt(this.g), this.l = this.B = this.f = this.j = null }, t.Wm = function() {}, t.re = function(t) { return t != this.j && (this.a.useProgram(t), this.j = t, !0) }, A(Vy, ya), Vy.prototype.vb = function(t, e) {
        this.c.push(this.b.length), this.v.push(e);
        var o = t.o;
        Wy(this, o, o.length, t.H)
    }, Vy.prototype.wb = function(t, e) {
        this.c.push(this.b.length), this.v.push(e);
        var o = t.o;
        Wy(this, o, o.length, t.H)
    }, Vy.prototype.hb = function(t) {
        var e = t.yb(),
            o = t.Sb(1),
            i = t.Ld(),
            r = t.le(1),
            n = t.A,
            s = t.Db(),
            p = t.D,
            a = t.B,
            h = t.fb();
        t = t.v, 0 === this.g.length ? this.g.push(o) : d(this.g[this.g.length - 1]) != d(o) && (this.A.push(this.b.length), this.g.push(o)), 0 === this.f.length ? this.f.push(r) : d(this.f[this.f.length - 1]) != d(r) && (this.i.push(this.b.length), this.f.push(r)), this.D = e[0], this.ea = e[1], this.N = h[1], this.T = i[1], this.ba = i[0], this.Z = n, this.aa = s[0], this.fa = s[1], this.Ma = a, this.ra = p, this.xa = t, this.Na = h[0]
    }, $y.prototype.a = function(t, e) { var o = this.b[e]; return r(o) || (o = new tf[e](this.g, this.f), this.b[e] = o), o }, $y.prototype.wa = function() { return vt(this.b) };
    var tf = { Image: Vy },
        ef = [1, 1];

    function of(t, e, o, i, r, n) { this.b = t, this.g = e, this.f = n, this.l = r, this.j = i, this.i = o, this.c = null, this.a = {} }
    A(of, ya), (t = of.prototype).yc = function(t, e) {
        var o = t.toString(),
            i = this.a[o];
        r(i) ? i.push(e) : this.a[o] = [e]
    }, t.zc = function() {}, t.Pe = function(t, e) {
        var o = (0, e.g)(t);
        if (null != o && Ho(this.f, o.R())) {
            var i = e.a;
            r(i) || (i = 0), this.yc(i, (function(t) {
                t.Ha(e.f, e.c), t.hb(e.i), t.Ia(e.b);
                var i = rf[o.U()];
                i && i.call(t, o, null)
            }))
        }
    }, t.Hd = function(t, e) {
        var o, i, r = t.f;
        for (o = 0, i = r.length; o < i; ++o) {
            var n = r[o],
                s = rf[n.U()];
            s && s.call(this, n, e)
        }
    }, t.wb = function(t, e) {
        var o = this.b,
            i = new $y(1, this.f).a(0, "Image");
        i.hb(this.c), i.wb(t, e), zy(i, o), Jy(i, this.b, this.g, this.i, this.j, this.l, 1, 0, 1, 0, 1, {}, void 0, !1), Hy(i, o)()
    }, t.Gb = function() {}, t.Ac = function() {}, t.vb = function(t, e) {
        var o = this.b,
            i = new $y(1, this.f).a(0, "Image");
        i.hb(this.c), i.vb(t, e), zy(i, o), Jy(i, this.b, this.g, this.i, this.j, this.l, 1, 0, 1, 0, 1, {}, void 0, !1), Hy(i, o)()
    }, t.Bc = function() {}, t.Yb = function() {}, t.xb = function() {}, t.Ha = function() {}, t.hb = function(t) { this.c = t }, t.Ia = function() {};
    var rf = { Point: of.prototype.wb, MultiPoint: of.prototype.vb, GeometryCollection: of.prototype.Hd };

    function nf() { this.a = "precision mediump float;varying vec2 a;uniform mat4 f;uniform float g;uniform sampler2D h;void main(void){vec4 texColor=texture2D(h,a);gl_FragColor.rgb=(f*vec4(texColor.rgb,1.)).rgb;gl_FragColor.a=texColor.a*g;}" }

    function sf() { this.a = "varying vec2 a;attribute vec2 b;attribute vec2 c;uniform mat4 d;uniform mat4 e;void main(void){gl_Position=e*vec4(b,0.,1.);a=(d*vec4(c,0.,1.)).st;}" }

    function pf(t, e) { this.j = t.getUniformLocation(e, "f"), this.c = t.getUniformLocation(e, "g"), this.f = t.getUniformLocation(e, "e"), this.i = t.getUniformLocation(e, "d"), this.g = t.getUniformLocation(e, "h"), this.a = t.getAttribLocation(e, "b"), this.b = t.getAttribLocation(e, "c") }

    function af() { this.a = "precision mediump float;varying vec2 a;uniform float f;uniform sampler2D g;void main(void){vec4 texColor=texture2D(g,a);gl_FragColor.rgb=texColor.rgb;gl_FragColor.a=texColor.a*f;}" }

    function hf() { this.a = "varying vec2 a;attribute vec2 b;attribute vec2 c;uniform mat4 d;uniform mat4 e;void main(void){gl_Position=e*vec4(b,0.,1.);a=(d*vec4(c,0.,1.)).st;}" }

    function lf(t, e) { this.c = t.getUniformLocation(e, "f"), this.f = t.getUniformLocation(e, "e"), this.i = t.getUniformLocation(e, "d"), this.g = t.getUniformLocation(e, "g"), this.a = t.getAttribLocation(e, "b"), this.b = t.getAttribLocation(e, "c") }

    function uf(t, e) { Sa.call(this, e), this.c = t, this.ba = new Fy([-1, -1, 0, 0, 1, -1, 1, 0, -1, 1, 0, 1, 1, 1, 1, 1]), this.g = this.Wa = null, this.i = void 0, this.B = ho(), this.A = lo(), this.Z = new Hr, this.u = this.v = null }

    function cf(t, e, o, i) {
        if (Ue(t = t.b, e)) {
            var r = i.viewState;
            Be(t, new fa(e, t, new of(o, r.center, r.resolution, r.rotation, i.size, i.extent), i, null, o))
        }
    }

    function yf(t, e) { uf.call(this, t, e), this.l = this.j = this.f = null }

    function ff() { this.a = "precision mediump float;varying vec2 a;uniform sampler2D e;void main(void){gl_FragColor=texture2D(e,a);}" }

    function gf() { this.a = "varying vec2 a;attribute vec2 b;attribute vec2 c;uniform vec4 d;void main(void){gl_Position=vec4(b*d.xy+d.zw,0.,1.);a=c;}" }

    function df(t, e) { this.c = t.getUniformLocation(e, "e"), this.f = t.getUniformLocation(e, "d"), this.a = t.getAttribLocation(e, "b"), this.b = t.getAttribLocation(e, "c") }

    function vf(t, e) { uf.call(this, t, e), this.N = ff.Pa(), this.aa = gf.Pa(), this.f = null, this.C = new Fy([0, 0, 0, 1, 1, 0, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0]), this.D = this.j = null, this.l = -1, this.T = [0, 0] }

    function bf(t, e) { uf.call(this, t, e), this.l = !1, this.T = -1, this.N = NaN, this.D = [1 / 0, 1 / 0, -1 / 0, -1 / 0], this.j = this.f = this.C = null }

    function mf(t, e) {
        Na.call(this, 0, e), this.a = rn("CANVAS"), this.a.style.width = "100%", this.a.style.height = "100%", this.a.className = "ol-unselectable", pn(t, this.a, 0), this.A = this.D = 0, this.C = ip(), this.B = !0, this.c = hp(this.a, { antialias: !0, depth: !1, failIfMajorPerformanceCaveat: !0, preserveDrawingBuffer: !1, stencil: !0 }), this.g = new Dy(this.a, this.c), Te(this.a, "webglcontextlost", this.Ml, !1, this), Te(this.a, "webglcontextrestored", this.Nl, !1, this), this.b = new Xn, this.u = null, this.l = new Ga(S((function(t) {
            var e = t[1];
            t = t[2];
            var o = e[0] - this.u[0];
            return e = e[1] - this.u[1], 65536 * Math.log(t) + Math.sqrt(o * o + e * e) / t
        }), this), (function(t) { return t[0].ob() })), this.N = S((function() {
            if (!this.l.wa()) {
                Va(this.l);
                var t = Ua(this.l);
                wf(this, t[0], t[3], t[4])
            }
        }), this), this.j = 0, xf(this)
    }

    function wf(t, e, o, i) {
        var r = t.c,
            n = e.ob();
        if (Kn(t.b, n)) t = t.b.get(n), r.bindTexture(3553, t.Wa), 9729 != t.ug && (r.texParameteri(3553, 10240, 9729), t.ug = 9729), 9729 != t.vg && (r.texParameteri(3553, 10240, 9729), t.vg = 9729);
        else {
            var s = r.createTexture();
            if (r.bindTexture(3553, s), 0 < i) {
                var p = t.C.canvas,
                    a = t.C;
                t.D !== o[0] || t.A !== o[1] ? (p.width = o[0], p.height = o[1], t.D = o[0], t.A = o[1]) : a.clearRect(0, 0, o[0], o[1]), a.drawImage(e.Ta(), i, i, o[0], o[1], 0, 0, o[0], o[1]), r.texImage2D(3553, 0, 6408, 6408, 5121, p)
            } else r.texImage2D(3553, 0, 6408, 6408, 5121, e.Ta());
            r.texParameteri(3553, 10240, 9729), r.texParameteri(3553, 10241, 9729), r.texParameteri(3553, 10242, 33071), r.texParameteri(3553, 10243, 33071), t.b.set(n, { Wa: s, ug: 9729, vg: 9729 })
        }
    }

    function Sf(t, e, o) {
        var i = t.i;
        if (Ue(i, e)) {
            var r, n, s = t.g;
            for (Be(i, new fa(e, i, t = new of(s, (t = o.viewState).center, t.resolution, t.rotation, o.size, o.extent), o, null, s)), ot(e = z(yt(t.a), Number)), o = 0, i = e.length; o < i; ++o)
                for (r = 0, n = (s = t.a[e[o].toString()]).length; r < n; ++r) s[r](t)
        }
    }

    function xf(t) {
        (t = t.c).activeTexture(33984), t.blendFuncSeparate(770, 771, 1, 771), t.disable(2884), t.disable(2929), t.disable(3089), t.disable(2960)
    }
    A(nf, Ay), p(nf), A(sf, Cy), p(sf), A(af, Ay), p(af), A(hf, Cy), p(hf), A(uf, Sa), uf.prototype.Og = function(t, e, o) {
        cf(this, "precompose", o, t), Oy(o, 34962, this.ba);
        var i, r, n = o.a,
            s = e.brightness || 1 != e.contrast || e.hue || 1 != e.saturation;
        s ? (i = nf.Pa(), r = sf.Pa()) : (i = af.Pa(), r = hf.Pa()), i = Uy(o, i, r), s ? null === this.v ? this.v = r = new pf(n, i) : r = this.v : null === this.u ? this.u = r = new lf(n, i) : r = this.u, o.re(i) && (n.enableVertexAttribArray(r.a), n.vertexAttribPointer(r.a, 2, 5126, !1, 16, 0), n.enableVertexAttribArray(r.b), n.vertexAttribPointer(r.b, 2, 5126, !1, 16, 8), n.uniform1i(r.g, 0)), n.uniformMatrix4fv(r.i, !1, this.B), n.uniformMatrix4fv(r.f, !1, this.A), s && n.uniformMatrix4fv(r.j, !1, Wr(this.Z, e.brightness, e.contrast, e.hue, e.saturation)), n.uniform1f(r.c, e.opacity), n.bindTexture(3553, this.Wa), n.drawArrays(5, 0, 4), cf(this, "postcompose", o, t)
    }, uf.prototype.of = function() { this.g = this.Wa = null, this.i = void 0 }, A(yf, uf), yf.prototype.Va = function(t, e, o, i) { var r = this.b; return r.da().ke(t, e.viewState.resolution, e.viewState.rotation, e.skippedFeatureUids, (function(t) { return o.call(i, t, r) })) }, yf.prototype.pf = function(t, e) {
        var o = this.c.c,
            i = t.pixelRatio,
            n = t.viewState,
            s = n.center,
            p = n.resolution,
            a = n.rotation,
            h = this.f,
            l = this.Wa,
            u = this.b.da(),
            c = t.viewHints,
            y = t.extent;
        return r(e.extent) && (y = Xo(y, e.extent)), c[0] || c[1] || Wo(y) || (n = n.projection, null === (c = u.j) || (n = c), null !== (y = u.Hc(y, p, i, n)) && xa(this, y) && (h = y, l = function(t, e) { var o = e.a(); return Yy(t.c.c, o) }(this, y), null === this.Wa || t.postRenderFunctions.push(x((function(t, e) { t.isContextLost() || t.deleteTexture(e) }), o, this.Wa)))), null !== h && (function(t, e, o, i, r, n, s, p) { e *= n, o *= n, yo(t = t.A), bo(t, 2 * i / e, 2 * i / o), mo(t, -s), vo(t, p[0] - r[0], p[1] - r[1]), bo(t, (p[2] - p[0]) / 2, (p[3] - p[1]) / 2), vo(t, 1, 1) }(this, (o = this.c.g.v).width, o.height, i, s, p, a, h.R()), this.l = null, yo(i = this.B), bo(i, 1, -1), vo(i, 0, -1), this.f = h, this.Wa = l, Ta(t.attributions, h.i), ja(t, u)), !0
    }, yf.prototype.ie = function(t, e) { return r(this.Va(t, e, $o, this)) }, yf.prototype.jc = function(t, e, o, i) {
        if (null !== this.f && !h(this.f.a()))
            if (this.b.da() instanceof cy) { if (t = t.slice(), wa(e.pixelToCoordinateMatrix, t, t), this.Va(t, e, $o, this)) return o.call(i, this.b) } else {
                var r = [this.f.a().width, this.f.a().height];
                if (null === this.l) {
                    var n = e.size;
                    yo(e = ho()), vo(e, -1, -1), bo(e, 2 / n[0], 2 / n[1]), vo(e, 0, n[1]), bo(e, 1, -1), n = ho(), go(this.A, n);
                    var s = ho();
                    yo(s), vo(s, 0, r[1]), bo(s, 1, -1), bo(s, r[0] / 2, r[1] / 2), vo(s, 1, 1);
                    var p = ho();
                    fo(s, n, p), fo(p, e, p), this.l = p
                }
                if (e = [0, 0], wa(this.l, t, e), !(0 > e[0] || e[0] > r[0] || 0 > e[1] || e[1] > r[1]) && (null === this.j && (this.j = ip(1, 1)), this.j.clearRect(0, 0, 1, 1), this.j.drawImage(this.f.a(), e[0], e[1], 1, 1, 0, 0, 1, 1), 0 < this.j.getImageData(0, 0, 1, 1).data[3])) return o.call(i, this.b)
            }
    }, A(ff, Ay), p(ff), A(gf, Cy), p(gf), A(vf, uf), (t = vf.prototype).W = function() { By(this.c.g, this.C), vf.$.W.call(this) }, t.Gd = function(t, e) { var o = this.c; return function(i, r) { return ls(t, i, r, (function(t) { var r = Kn(o.b, t.ob()); return r && (e[i] || (e[i] = {}), e[i][t.a.toString()] = t), r })) } }, t.of = function() { vf.$.of.call(this), this.f = null }, t.pf = function(t, e, o) {
        var i, n = this.c,
            s = o.a,
            p = t.viewState,
            a = p.projection,
            h = this.b,
            l = h.da(),
            u = us(l, a),
            c = ns(u, p.resolution),
            y = u.ua(c),
            f = l.cc(c, t.pixelRatio, a),
            g = f[0] / qe(u.Ja(c), this.T)[0],
            d = y / g,
            v = l.Kd(),
            b = p.center;
        if (i = y == p.resolution ? Go(b = Ca(b, y, t.size), y, p.rotation, t.size) : t.extent, y = ts(u, i, y), null !== this.j && function(t, e) { return t.a == e.a && t.b == e.b && t.f == e.f && t.c == e.c }(this.j, y) && this.l == l.a) d = this.D;
        else {
            var m = [Ir(y), y.c - y.b + 1],
                w = (m = Math.max(m[0] * f[0], m[1] * f[1]), m = d * (R = Math.pow(2, Math.ceil(Math.log(m) / Math.LN2))), u.Kc(c));
            d = [L = w[0] + y.a * f[0] * d, d = w[1] + y.b * f[1] * d, L + m, d + m],
                function(t, e, o) {
                    var i = t.c.c;
                    if (r(t.i) && t.i == o) i.bindFramebuffer(36160, t.g);
                    else {
                        e.postRenderFunctions.push(x((function(t, e, o) { t.isContextLost() || (t.deleteFramebuffer(e), t.deleteTexture(o)) }), i, t.g, t.Wa)), e = Ky(i, o, o);
                        var n = i.createFramebuffer();
                        i.bindFramebuffer(36160, n), i.framebufferTexture2D(36160, 36064, 3553, e, 0), t.Wa = e, t.g = n, t.i = o
                    }
                }(this, t, R), s.viewport(0, 0, R, R), s.clearColor(0, 0, 0, 0), s.clear(16384), s.disable(3042), R = Uy(o, this.N, this.aa), o.re(R), null === this.f && (this.f = new df(s, R)), Oy(o, 34962, this.C), s.enableVertexAttribArray(this.f.a), s.vertexAttribPointer(this.f.a, 2, 5126, !1, 16, 0), s.enableVertexAttribArray(this.f.b), s.vertexAttribPointer(this.f.b, 2, 5126, !1, 16, 8), s.uniform1i(this.f.c, 0), (o = {})[c] = {};
            var S, M, P, T, j, A = this.Gd(l, o),
                C = h.c(),
                R = !0,
                L = [1 / 0, 1 / 0, -1 / 0, -1 / 0],
                E = new Lr(0, 0, 0, 0);
            for (M = y.a; M <= y.f; ++M)
                for (P = y.b; P <= y.c; ++P)
                    if (w = l.bc(c, M, P, g, a), !r(e.extent) || Ho(S = is(u, w.a, L), e.extent)) {
                        if (2 == (S = w.state)) { if (Kn(n.b, w.ob())) { o[c][Ar(w.a)] = w; continue } } else if (4 == S || 3 == S && !C) continue;
                        R = !1, (S = _n(u, w.a, A, E, L)) || null === (w = Qn(u, w.a, E, L)) || A(c + 1, w)
                    }
            for (ot(e = z(yt(o), Number)), A = new Float32Array(4), C = 0, E = e.length; C < E; ++C)
                for (T in j = o[e[C]]) w = j[T], ao(A, M = 2 * ((S = is(u, w.a, L))[2] - S[0]) / m, P = 2 * (S[3] - S[1]) / m, 2 * (S[0] - d[0]) / m - 1, S = 2 * (S[1] - d[1]) / m - 1), s.uniform4fv(this.f.f, A), wf(n, w, f, v * g), s.drawArrays(5, 0, 4);
            R ? (this.j = y, this.D = d, this.l = l.a) : (this.D = this.j = null, this.l = -1, t.animate = !0)
        }
        Aa(t.usedTiles, l, c, y);
        var I = n.l;
        return Ra(t, l, u, g, a, i, c, h.b(), (function(t) {
            var e;
            (e = 2 != t.state || Kn(n.b, t.ob())) || (e = t.ob() in I.c), e || Xa(I, [t, os(u, t.a), u.ua(t.a[0]), f, v * g])
        }), this), Pa(t, l), ja(t, l), yo(s = this.B), vo(s, (b[0] - d[0]) / (d[2] - d[0]), (b[1] - d[1]) / (d[3] - d[1])), 0 !== p.rotation && mo(s, p.rotation), bo(s, t.size[0] * p.resolution / (d[2] - d[0]), t.size[1] * p.resolution / (d[3] - d[1])), vo(s, -.5, -.5), !0
    }, t.jc = function(t, e, o, i) { if (null !== this.g) { var r = [0, 0]; if (wa(this.B, [t[0] / e.size[0], (e.size[1] - t[1]) / e.size[1]], r), t = [r[0] * this.i, r[1] * this.i], (e = this.c.g.a).bindFramebuffer(e.FRAMEBUFFER, this.g), r = new Uint8Array(4), e.readPixels(t[0], t[1], 1, 1, e.RGBA, e.UNSIGNED_BYTE, r), 0 < r[3]) return o.call(i, this.b) } }, A(bf, uf), (t = bf.prototype).Og = function(t, e, o) {
        this.j = e;
        var i = t.viewState,
            n = this.f;
        if (null !== n && !n.wa()) {
            var s, p, a = i.center,
                h = i.resolution,
                l = (i = i.rotation, t.size),
                u = e.opacity,
                c = e.brightness,
                y = e.contrast,
                f = e.hue,
                g = e.saturation;
            for (t = e.Pb ? t.skippedFeatureUids : {}, e = 0, s = Rl.length; e < s; ++e) r(p = n.b[Rl[e]]) && Jy(p, o, a, h, i, l, u, c, y, f, g, t, void 0, !1)
        }
    }, t.W = function() {
        var t = this.f;
        null !== t && (_y(t, this.c.g)(), this.f = null), bf.$.W.call(this)
    }, t.Va = function(t, e, o, i) {
        if (null !== this.f && null !== this.j) {
            var n = e.viewState,
                s = this.b,
                p = this.j,
                a = {};
            return function(t, e, o, i, n, s, p, a, h, l, u, c) { var y, f = o.a; return f.bindFramebuffer(f.FRAMEBUFFER, o.Ye()), r(t.c) && (y = xo(Lo(e), i * t.c)), Qy(t, o, e, i, n, s, p, a, h, l, u, (function(t) { var e = new Uint8Array(4); if (f.readPixels(0, 0, 1, 1, f.RGBA, f.UNSIGNED_BYTE, e), 0 < e[3] && (t = c(t))) return t }), !0, y) }(this.f, t, this.c.g, n.resolution, n.rotation, p.opacity, p.brightness, p.contrast, p.hue, p.saturation, p.Pb ? e.skippedFeatureUids : {}, (function(t) { var e = d(t).toString(); if (!(e in a)) return a[e] = !0, o.call(i, t, s) }))
        }
    }, t.ie = function(t, e) {
        if (null === this.f || null === this.j) return !1;
        var o = e.viewState,
            i = this.j;
        return function(t, e, o, i, n, s, p, a, h, l, u) { var c = o.a; return c.bindFramebuffer(c.FRAMEBUFFER, o.Ye()), r(t = Qy(t, o, e, i, n, s, p, a, h, l, u, (function() { var t = new Uint8Array(4); return c.readPixels(0, 0, 1, 1, c.RGBA, c.UNSIGNED_BYTE, t), 0 < t[3] }), !1)) }(this.f, t, this.c.g, o.resolution, o.rotation, i.opacity, i.brightness, i.contrast, i.hue, i.saturation, e.skippedFeatureUids)
    }, t.jc = function(t, e, o, i) { if (t = t.slice(), wa(e.pixelToCoordinateMatrix, t, t), this.ie(t, e)) return o.call(i, this.b) }, t.Ol = function() { Ma(this) }, t.pf = function(t, e, o) {
        function i(t) {
            var e;
            if (r(t.c) ? e = t.c.call(t, l) : r(n.b) && (e = (0, n.b)(t, l)), null != e) {
                if (null != e) {
                    var o, i, s = !1;
                    for (o = 0, i = e.length; o < i; ++o) s = bu(y, t, e[o], vu(l, u), this.Ol, this) || s;
                    t = s
                } else t = !1;
                this.l = this.l || t
            }
        }
        var n = this.b;
        e = n.da(), Ta(t.attributions, e.g), ja(t, e);
        var s = t.viewHints[0],
            p = t.viewHints[1],
            a = n.u,
            h = n.A;
        if (!this.l && !a && s || !h && p) return !0;
        p = t.extent, s = (a = t.viewState).projection;
        var l = a.resolution,
            u = t.pixelRatio,
            c = (a = n.a, n.c);
        if (r(h = n.get("renderOrder")) || (h = du), p = xo(p, c * l), !this.l && this.N == l && this.T == a && this.C == h && jo(this.D, p)) return !0;
        null === this.f || t.postRenderFunctions.push(_y(this.f, o)), this.l = !1;
        var y = new $y(.5 * l / u, p, n.c);
        if (e.fc(p, l, s), null === h) e.Hb(p, l, i, this);
        else {
            var f = [];
            e.Hb(p, l, (function(t) { f.push(t) }), this), ot(f, h), H(f, i, this)
        }
        return function(t, e) { for (var o in t.b) zy(t.b[o], e) }(y, o), this.N = l, this.T = a, this.C = h, this.D = p, this.f = y, !0
    }, A(mf, Na), (t = mf.prototype).Oe = function(t) { return t instanceof cl ? new yf(this, t) : t instanceof yl ? new vf(this, t) : t instanceof fl ? new bf(this, t) : null }, t.W = function() {
        var t = this.c;
        t.isContextLost() || this.b.forEach((function(e) { null === e || t.deleteTexture(e.Wa) })), ie(this.g), mf.$.W.call(this)
    }, t.Ii = function(t, e) {
        for (var o, i = this.c; 1024 < this.b.$b() - this.j;) {
            if (null === (o = this.b.a.wc)) { if (+this.b.a.ae == e.index) break;--this.j } else i.deleteTexture(o.Wa);
            this.b.pop()
        }
    }, t.U = function() { return "webgl" }, t.Ml = function(t) { t.preventDefault(), this.b.clear(), this.j = 0, lt(this.f, (function(t) { t.of() })) }, t.Nl = function() { xf(this), this.i.render() }, t.xe = function(t) {
        var e = this.g,
            o = this.c;
        if (o.isContextLost()) return !1;
        if (null === t) return this.B && (En(this.a, !1), this.B = !1), !1;
        this.u = t.focus, this.b.set((-t.index).toString(), null), ++this.j, Sf(this, "precompose", t);
        var i, r, n, s = [],
            p = t.layerStatesArray,
            a = t.viewState.resolution;
        for (i = 0, r = p.length; i < r; ++i) da(n = p[i], a) && "ready" == n.l && Oa(this, n.layer).pf(t, n, e) && s.push(n);
        for (p = t.size[0] * t.pixelRatio, a = t.size[1] * t.pixelRatio, this.a.width == p && this.a.height == a || (this.a.width = p, this.a.height = a), o.bindFramebuffer(36160, null), o.clearColor(0, 0, 0, 0), o.clear(16384), o.enable(3042), o.viewport(0, 0, this.a.width, this.a.height), i = 0, r = s.length; i < r; ++i) Oa(this, (n = s[i]).layer).Og(t, n, e);
        this.B || (En(this.a, !0), this.B = !0), Fa(t), 1024 < this.b.$b() - this.j && t.postRenderFunctions.push(S(this.Ii, this)), this.l.wa() || (t.postRenderFunctions.push(this.N), t.animate = !0), Sf(this, "postcompose", t), Ba(this, t), t.postRenderFunctions.push(Da)
    }, t.mf = function(t, e, o, i, r, n) {
        var s;
        if (this.c.isContextLost()) return !1;
        var p, a = e.viewState,
            h = e.layerStatesArray;
        for (p = h.length - 1; 0 <= p; --p) { var l = (s = h[p]).layer; if (da(s, a.resolution) && r.call(n, l) && (s = Oa(this, l).Va(t, e, o, i))) return s }
    }, t.Ng = function(t, e, o, i) {
        var r = !1;
        if (this.c.isContextLost()) return !1;
        var n, s = e.viewState,
            p = e.layerStatesArray;
        for (n = p.length - 1; 0 <= n; --n) {
            var a = p[n],
                h = a.layer;
            if (da(a, s.resolution) && o.call(i, h) && (r = Oa(this, h).ie(t, e))) return !0
        }
        return r
    }, t.Mg = function(t, e, o, i, r) {
        if (this.c.isContextLost()) return !1;
        var n, s, p = e.viewState,
            a = e.layerStatesArray;
        for (s = a.length - 1; 0 <= s; --s) { var h = (n = a[s]).layer; if (da(n, p.resolution) && r.call(i, h) && (n = Oa(this, h).jc(t, e, o, i))) return n }
    };
    var Mf = ["canvas", "webgl", "dom"];

    function Pf(t) {
        Ve.call(this);
        var e = function(t) {
            var e = null;
            r(t.keyboardEventTarget) && (e = c(t.keyboardEventTarget) ? document.getElementById(t.keyboardEventTarget) : t.keyboardEventTarget);
            var o = {},
                i = {};
            !r(t.logo) || "boolean" == typeof t.logo && t.logo ? i["data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAHGAAABxgEXwfpGAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAhNQTFRF////AP//AICAgP//AFVVQECA////K1VVSbbbYL/fJ05idsTYJFtbbcjbJllmZszWWMTOIFhoHlNiZszTa9DdUcHNHlNlV8XRIVdiasrUHlZjIVZjaMnVH1RlIFRkH1RkH1ZlasvYasvXVsPQH1VkacnVa8vWIVZjIFRjVMPQa8rXIVVkXsXRsNveIFVkIFZlIVVj3eDeh6GmbMvXH1ZkIFRka8rWbMvXIFVkIFVjIFVkbMvWH1VjbMvWIFVlbcvWIFVla8vVIFVkbMvWbMvVH1VkbMvWIFVlbcvWIFVkbcvVbMvWjNPbIFVkU8LPwMzNIFVkbczWIFVkbsvWbMvXIFVkRnB8bcvW2+TkW8XRIFVkIlZlJVloJlpoKlxrLl9tMmJwOWd0Omh1RXF8TneCT3iDUHiDU8LPVMLPVcLPVcPQVsPPVsPQV8PQWMTQWsTQW8TQXMXSXsXRX4SNX8bSYMfTYcfTYsfTY8jUZcfSZsnUaIqTacrVasrVa8jTa8rWbI2VbMvWbcvWdJObdcvUdszUd8vVeJaee87Yfc3WgJyjhqGnitDYjaarldPZnrK2oNbborW5o9bbo9fbpLa6q9ndrL3ArtndscDDutzfu8fJwN7gwt7gxc/QyuHhy+HizeHi0NfX0+Pj19zb1+Tj2uXk29/e3uLg3+Lh3+bl4uXj4ufl4+fl5Ofl5ufl5ujm5+jmySDnBAAAAFp0Uk5TAAECAgMEBAYHCA0NDg4UGRogIiMmKSssLzU7PkJJT1JTVFliY2hrdHZ3foSFhYeJjY2QkpugqbG1tre5w8zQ09XY3uXn6+zx8vT09vf4+Pj5+fr6/P39/f3+gz7SsAAAAVVJREFUOMtjYKA7EBDnwCPLrObS1BRiLoJLnte6CQy8FLHLCzs2QUG4FjZ5GbcmBDDjxJBXDWxCBrb8aM4zbkIDzpLYnAcE9VXlJSWlZRU13koIeW57mGx5XjoMZEUqwxWYQaQbSzLSkYGfKFSe0QMsX5WbjgY0YS4MBplemI4BdGBW+DQ11eZiymfqQuXZIjqwyadPNoSZ4L+0FVM6e+oGI6g8a9iKNT3o8kVzNkzRg5lgl7p4wyRUL9Yt2jAxVh6mQCogae6GmflI8p0r13VFWTHBQ0rWPW7ahgWVcPm+9cuLoyy4kCJDzCm6d8PSFoh0zvQNC5OjDJhQopPPJqph1doJBUD5tnkbZiUEqaCnB3bTqLTFG1bPn71kw4b+GFdpLElKIzRxxgYgWNYc5SCENVHKeUaltHdXx0dZ8uBI1hJ2UUDgq82CM2MwKeibqAvSO7MCABq0wXEPiqWEAAAAAElFTkSuQmCC"] = "http://openlayers.org/" : c(a = t.logo) ? i[a] = "" : g(a) && (i[a.src] = a.href), a = t.layers instanceof tl ? t.layers : new tl({ layers: t.layers }), o.layergroup = a, o.target = t.target, o.view = r(t.view) ? t.view : new fr;
            var n, s, p, a = Na;
            for (r(t.renderer) ? l(t.renderer) ? n = t.renderer : c(t.renderer) && (n = [t.renderer]) : n = Mf, s = 0, p = n.length; s < p; ++s) { var h = n[s]; if ("canvas" == h) { if (fp) { a = dy; break } } else { if ("dom" == h) { a = Py; break } if ("webgl" == h && lp) { a = mf; break } } }
            return { controls: r(t.controls) ? l(t.controls) ? new Dr(t.controls.slice()) : t.controls : ws(), interactions: r(t.interactions) ? l(t.interactions) ? new Dr(t.interactions.slice()) : t.interactions : Qh(), keyboardEventTarget: e, logos: i, overlays: t = r(t.overlays) ? l(t.overlays) ? new Dr(t.overlays.slice()) : t.overlays : new Dr, Pn: a, values: o }
        }(t);
        this.rb = !!r(t.loadTilesWhileAnimating) && t.loadTilesWhileAnimating, this.sb = !!r(t.loadTilesWhileInteracting) && t.loadTilesWhileInteracting, this.Uc = r(t.pixelRatio) ? t.pixelRatio : cp, this.tb = e.logos, this.u = new Ls(this.Nn, void 0, this), oe(this, this.u), this.Xa = ho(), this.He = ho(), this.qb = 0, this.c = null, this.ra = [1 / 0, 1 / 0, -1 / 0, -1 / 0], this.j = this.N = null, this.b = en("DIV", "ol-viewport"), this.b.style.position = "relative", this.b.style.overflow = "hidden", this.b.style.width = "100%", this.b.style.height = "100%", this.b.style.msTouchAction = "none", vp && bn(this.b, "ol-touch"), this.aa = en("DIV", "ol-overlaycontainer"), this.b.appendChild(this.aa), this.D = en("DIV", "ol-overlaycontainer-stopevent"), Te(this.D, ["click", "dblclick", "mousedown", "touchstart", "MSPointerDown", pa, At ? "DOMMouseScroll" : "mousewheel"], ne), this.b.appendChild(this.D), Te(t = new ta(this), ct(la), this.ng, !1, this), oe(this, t), this.Z = e.keyboardEventTarget, this.A = new Vs, Te(this.A, "key", this.lg, !1, this), oe(this, this.A), Te(t = new _s(this.b), "mousewheel", this.lg, !1, this), oe(this, t), this.g = e.controls, this.f = e.interactions, this.i = e.overlays, this.l = new e.Pn(this.b, this), oe(this, this.l), this.Na = new Xs, oe(this, this.Na), this.T = this.v = null, this.C = [], this.fa = [], this.xa = new Ha(S(this.Cj, this), S(this.Yk, this)), this.ba = {}, Te(this, We("layergroup"), this.Rj, !1, this), Te(this, We("view"), this.nk, !1, this), Te(this, We("size"), this.kk, !1, this), Te(this, We("target"), this.mk, !1, this), this.I(e.values), this.g.forEach((function(t) { t.setMap(this) }), this), Te(this.g, "add", (function(t) { t.element.setMap(this) }), !1, this), Te(this.g, "remove", (function(t) { t.element.setMap(null) }), !1, this), this.f.forEach((function(t) { t.setMap(this) }), this), Te(this.f, "add", (function(t) { t.element.setMap(this) }), !1, this), Te(this.f, "remove", (function(t) { t.element.setMap(null) }), !1, this), this.i.forEach((function(t) { t.setMap(this) }), this), Te(this.i, "add", (function(t) { t.element.setMap(this) }), !1, this), Te(this.i, "remove", (function(t) { t.element.setMap(null) }), !1, this)
    }

    function Tf(t) { Ve.call(this), this.l = !r(t.insertFirst) || t.insertFirst, this.v = !r(t.stopEvent) || t.stopEvent, this.c = en("DIV", { class: "ol-overlay-container" }), this.c.style.position = "absolute", this.j = !!r(t.autoPan) && t.autoPan, this.g = r(t.autoPanAnimation) ? t.autoPanAnimation : {}, this.i = r(t.autoPanMargin) ? t.autoPanMargin : 20, this.b = { Cd: "", be: "", ye: "", ze: "", visible: !0 }, this.f = null, Te(this, We("element"), this.Nj, !1, this), Te(this, We("map"), this.Zj, !1, this), Te(this, We("offset"), this.dk, !1, this), Te(this, We("position"), this.fk, !1, this), Te(this, We("positioning"), this.gk, !1, this), r(t.element) && this.wh(t.element), this.Bh(r(t.offset) ? t.offset : [0, 0]), this.Ch(r(t.positioning) ? t.positioning : "top-left"), r(t.position) && this.kf(t.position) }

    function jf(t, e) {
        var o = cn(t);
        Pn(t, "position");
        var i, r = new Zr(0, 0);
        return i = o ? cn(o) : document, t != (i = !jt || jt && 9 <= Gt || (qr(i), 1) ? i.documentElement : i.body) && (i = jn(t), o = gn(qr(o)), r.x = i.left + o.x, r.y = i.top + o.y), [r.x, r.y, r.x + e[0], r.y + e[1]]
    }

    function Af(t) {
        var e = t.ee(),
            o = t.Cg();
        if (r(e) && null !== e.c && r(o)) {
            o = e.ya(o);
            var i = e.Ca(),
                n = (e = t.c.style, t.gg()),
                s = t.jg(),
                p = n[0];
            n = n[1], "bottom-right" == s || "center-right" == s || "top-right" == s ? ("" !== t.b.be && (t.b.be = e.left = ""), p = Math.round(i[0] - o[0] - p) + "px", t.b.ye != p && (t.b.ye = e.right = p)) : ("" !== t.b.ye && (t.b.ye = e.right = ""), "bottom-center" != s && "center-center" != s && "top-center" != s || (p -= Rn(t.c).width / 2), p = Math.round(o[0] + p) + "px", t.b.be != p && (t.b.be = e.left = p)), "bottom-left" == s || "bottom-center" == s || "bottom-right" == s ? ("" !== t.b.ze && (t.b.ze = e.top = ""), o = Math.round(i[1] - o[1] - n) + "px", t.b.Cd != o && (t.b.Cd = e.bottom = o)) : ("" !== t.b.Cd && (t.b.Cd = e.bottom = ""), "center-left" != s && "center-center" != s && "center-right" != s || (n -= Rn(t.c).height / 2), o = Math.round(o[1] + n) + "px", t.b.ze != o && (t.b.ze = e.top = o)), t.b.visible || (En(t.c, !0), t.b.visible = !0)
        } else t.b.visible && (En(t.c, !1), t.b.visible = !1)
    }

    function Cf(t) {
        t = r(t) ? t : {}, this.i = !r(t.collapsed) || t.collapsed, this.j = !r(t.collapsible) || t.collapsible, this.j || (this.i = !1);
        var e = r(t.className) ? t.className : "ol-overviewmap",
            o = r(t.tipLabel) ? t.tipLabel : "Overview map",
            i = r(t.collapseLabel) ? t.collapseLabel : "«";
        this.u = c(i) ? en("SPAN", {}, i) : i, i = r(t.label) ? t.label : "»", this.A = c(i) ? en("SPAN", {}, i) : i, Te(o = en("BUTTON", { type: "button", title: o }, this.j && !this.i ? this.u : this.A), "click", this.il, !1, this), Un(o), i = en("DIV", "ol-overviewmap-map");
        var n = this.f = new Pf({ controls: new Dr, interactions: new Dr, target: i });
        r(t.layers) && t.layers.forEach((function(t) { n.Pf(t) }), this);
        var s = en("DIV", "ol-overviewmap-box");
        this.l = new Tf({ position: [0, 0], positioning: "bottom-left", element: s }), this.f.Qf(this.l), e = en("DIV", e + " ol-unselectable ol-control" + (this.i && this.j ? " ol-collapsed" : "") + (this.j ? "" : " ol-uncollapsible"), i, o), Gn.call(this, { element: e, render: r(t.render) ? t.render : Rf, target: t.target })
    }

    function Rf() {
        var t = this.b,
            e = this.f;
        if (null !== t.c && null !== e.c) {
            var o = t.Ca(),
                i = (t = t.X().Vc(o), e.Ca()),
                r = (o = e.X().Vc(i), e.ya(Ko(t)));
            e = e.ya(Oo(t)), e = new Jr(Math.abs(r[0] - e[0]), Math.abs(r[1] - e[1])), r = i[0], i = i[1], e.width < .1 * r || e.height < .1 * i || e.width > .75 * r || e.height > .75 * i ? Lf(this) : jo(o, t) || (t = this.f, o = this.b.X(), t.X().eb(o.Ka()))
        }
        Ef(this)
    }

    function Lf(t) {
        var e = t.b;
        t = t.f;
        var o = e.Ca();
        e = e.X().Vc(o), o = t.Ca(), t = t.X();
        var i = Math.log(7.5) / Math.LN2;
        zo(e, 1 / (.1 * Math.pow(2, i / 2))), t.Qe(e, o)
    }

    function Ef(t) {
        var e = t.b,
            o = t.f;
        if (null !== e.c && null !== o.c) {
            var i = e.Ca(),
                n = e.X(),
                s = o.X();
            o.Ca(), e = n.Ea();
            var p, a = t.l;
            o = t.l.de(), n = n.Vc(i), i = s.Da(), s = Do(n), n = Yo(n), r(t = t.b.X().Ka()) && (oo(p = [s[0] - t[0], s[1] - t[1]], e), $e(p, t)), a.kf(p), null != o && (p = new Jr(Math.abs((s[0] - n[0]) / i), Math.abs((n[1] - s[1]) / i)), qr(cn(o)), e = !0, !jt || Ot("10") || e && Ot("8") ? (o = o.style, At ? o.MozBoxSizing = "border-box" : Ct ? o.WebkitBoxSizing = "border-box" : o.boxSizing = "border-box", o.width = Math.max(p.width, 0) + "px", o.height = Math.max(p.height, 0) + "px") : (t = o.style, e ? (e = Nn(o, "padding"), o = On(o), t.pixelWidth = p.width - o.left - e.left - e.right - o.right, t.pixelHeight = p.height - o.top - e.top - e.bottom - o.bottom) : (t.pixelWidth = p.width, t.pixelHeight = p.height)))
        }
    }

    function If(t) {
        wn(t.element, "ol-collapsed"), t.i ? hn(t.u, t.A) : hn(t.A, t.u), t.i = !t.i;
        var e = t.f;
        t.i || null !== e.c || (e.Rc(), Lf(t), Ae(e, "postrender", (function() { Ef(this) }), !1, t))
    }

    function kf(t) {
        t = r(t) ? t : {};
        var e = r(t.className) ? t.className : "ol-scale-line";
        this.l = en("DIV", e + "-inner"), this.j = en("DIV", e + " ol-unselectable", this.l), this.A = null, this.u = r(t.minWidth) ? t.minWidth : 64, this.f = !1, this.N = void 0, this.D = "", this.i = null, Gn.call(this, { element: this.j, render: r(t.render) ? t.render : Ff, target: t.target }), Te(this, We("units"), this.Z, !1, this), this.ba(t.units || "metric")
    }
    A(Pf, Ve), (t = Pf.prototype).wi = function(t) { this.g.push(t) }, t.xi = function(t) { this.f.push(t) }, t.Pf = function(t) { this.ac().Gc().push(t) }, t.Qf = function(t) { this.i.push(t) }, t.Oa = function(t) { this.render(), Array.prototype.push.apply(this.C, arguments) }, t.W = function() { an(this.b), Pf.$.W.call(this) }, t.Re = function(t, e, o, i, n) { if (null !== this.c) return t = this.ta(t), this.l.mf(t, this.c, e, r(o) ? o : null, r(i) ? i : $o, r(n) ? n : null) }, t.Xk = function(t, e, o, i, n) { if (null !== this.c) return this.l.Mg(t, this.c, e, r(o) ? o : null, r(i) ? i : $o, r(n) ? n : null) }, t.pk = function(t, e, o) { return null !== this.c && (t = this.ta(t), this.l.Ng(t, this.c, r(e) ? e : $o, r(o) ? o : null)) }, t.Yi = function(t) { return this.ta(this.Jd(t)) }, t.Jd = function(t) { if (r(t.changedTouches)) { var e = t.changedTouches[0]; return t = An(this.b), [e.clientX - t.x, e.clientY - t.y] } return e = this.b, t = An(t), e = An(e), [(e = new Zr(t.x - e.x, t.y - e.y)).x, e.y] }, t.jf = function() { return this.get("target") }, t.hd = function() { var t = this.jf(); return r(t) ? $r(t) : null }, t.ta = function(t) { var e = this.c; return null === e ? null : (t = t.slice(), wa(e.pixelToCoordinateMatrix, t, t)) }, t.Wi = function() { return this.g }, t.rj = function() { return this.i }, t.fj = function() { return this.f }, t.ac = function() { return this.get("layergroup") }, t.Bg = function() { return this.ac().Gc() }, t.ya = function(t) { var e = this.c; return null === e ? null : (t = t.slice(0, 2), wa(e.coordinateToPixelMatrix, t, t)) }, t.Ca = function() { return this.get("size") }, t.X = function() { return this.get("view") }, t.Ej = function() { return this.b }, t.Cj = function(t, e, o, i) { var r = this.c; return null !== r && e in r.wantedTiles && r.wantedTiles[e][Ar(t.a)] ? (t = o[0] - r.focus[0], o = o[1] - r.focus[1], 65536 * Math.log(i) + Math.sqrt(t * t + o * o) / i) : 1 / 0 }, t.lg = function(t, e) {
        var o = new _p(e || t.type, this, t);
        this.ng(o)
    }, t.ng = function(t) {
        if (null !== this.c) {
            this.T = t.coordinate, t.frameState = this.c;
            var e, o = this.f.b;
            if (!1 !== Be(this, t))
                for (e = o.length - 1; 0 <= e; e--) { var i = o[e]; if (i.b() && !i.handleEvent(t)) break }
        }
    }, t.hk = function() {
        var t = this.c,
            e = this.xa;
        if (!e.wa()) {
            var o, i = 16,
                r = i,
                n = 0;
            if (null !== t && ((n = t.viewHints)[0] && (i = this.rb ? 8 : 0, r = 2), n[1] && (i = this.sb ? 8 : 0, r = 2), n = ut(t.wantedTiles)), i *= n, r *= n, e.f < i)
                for (Va(e), n = 0; e.f < i && n < r && 0 < e.$b();) 0 === (o = Ua(e)[0]).state && (Te(o, "change", e.i, !1, e), o.load(), ++e.f, ++n)
        }
        for (r = 0, i = (e = this.fa).length; r < i; ++r) e[r](this, t);
        e.length = 0
    }, t.kk = function() { this.render() }, t.mk = function() {
        var t = this.hd();
        qs(this.A), null === t ? (an(this.b), null !== this.v && (Re(this.v), this.v = null)) : (t.appendChild(this.b), Js(this.A, null === this.Z ? t : this.Z), null === this.v && (this.v = Te(this.Na, "resize", this.Rc, !1, this))), this.Rc()
    }, t.Yk = function() { this.render() }, t.ok = function() { this.render() }, t.nk = function() {
        null !== this.N && (Re(this.N), this.N = null);
        var t = this.X();
        null !== t && (this.N = Te(t, "propertychange", this.ok, !1, this)), this.render()
    }, t.Sj = function() { this.render() }, t.Tj = function() { this.render() }, t.Rj = function() {
        if (null !== this.j) {
            for (var t = this.j.length, e = 0; e < t; ++e) Re(this.j[e]);
            this.j = null
        }
        null != (t = this.ac()) && (this.j = [Te(t, "propertychange", this.Tj, !1, this), Te(t, "change", this.Sj, !1, this)]), this.render()
    }, t.On = function() {
        var t = this.u;
        Es(t), t.Vf()
    }, t.render = function() { null != this.u.ha || this.u.start() }, t.In = function(t) { if (r(this.g.remove(t))) return t }, t.Jn = function(t) { var e; return r(this.f.remove(t)) && (e = t), e }, t.Kn = function(t) { return this.ac().Gc().remove(t) }, t.Ln = function(t) { if (r(this.i.remove(t))) return t }, t.Nn = function(t) {
        var e, o, i, n = this.Ca(),
            s = this.X(),
            p = null;
        if (r(n) && 0 < n[0] && 0 < n[1] && null !== s && dr(s)) {
            p = s.c.slice();
            var a = this.ac().Ze(),
                h = {};
            for (e = 0, o = a.length; e < o; ++e) h[d(a[e].layer)] = a[e];
            i = gr(s), p = { animate: !1, attributions: {}, coordinateToPixelMatrix: this.Xa, extent: null, focus: null === this.T ? i.center : this.T, index: this.qb++, layerStates: h, layerStatesArray: a, logos: xt(this.tb), pixelRatio: this.Uc, pixelToCoordinateMatrix: this.He, postRenderFunctions: [], size: n, skippedFeatureUids: this.ba, tileQueue: this.xa, time: t, usedTiles: {}, viewState: i, viewHints: p, wantedTiles: {} }
        }
        if (null !== p) {
            for (e = n = 0, o = (t = this.C).length; e < o; ++e)(s = t[e])(this, p) && (t[n++] = s);
            t.length = n, p.extent = Go(i.center, i.resolution, i.rotation, p.size)
        }
        this.c = p, this.l.xe(p), null !== p && (p.animate && this.render(), Array.prototype.push.apply(this.fa, p.postRenderFunctions), 0 !== this.C.length || p.viewHints[0] || p.viewHints[1] || Eo(p.extent, this.ra) || (Be(this, new Bn("moveend", this, p)), Mo(p.extent, this.ra))), Be(this, new Bn("postrender", this, p)), Fs(this.hk, this)
    }, t.zh = function(t) { this.set("layergroup", t) }, t.Bf = function(t) { this.set("size", t) }, t.Zk = function(t) { this.set("target", t) }, t.fo = function(t) { this.set("view", t) }, t.Eh = function(t) { t = d(t).toString(), this.ba[t] = !0, this.render() }, t.Rc = function() {
        var t = this.hd();
        if (null === t) this.Bf(void 0);
        else {
            var e = cn(t),
                o = jt && t.currentStyle;
            o && (qr(e), 1) && "auto" != o.width && "auto" != o.height && !o.boxSizing ? t = new Jr(e = In(t, o.width, "width", "pixelWidth"), t = In(t, o.height, "height", "pixelHeight")) : (o = new Jr(t.offsetWidth, t.offsetHeight), e = Nn(t, "padding"), t = On(t), t = new Jr(o.width - t.left - e.left - e.right - t.right, o.height - t.top - e.top - e.bottom - t.bottom)), this.Bf([t.width, t.height])
        }
    }, t.Jh = function(t) { t = d(t).toString(), delete this.ba[t], this.render() }, ul(), A(Tf, Ve), (t = Tf.prototype).de = function() { return this.get("element") }, t.ee = function() { return this.get("map") }, t.gg = function() { return this.get("offset") }, t.Cg = function() { return this.get("position") }, t.jg = function() { return this.get("positioning") }, t.Nj = function() {
        sn(this.c);
        var t = this.de();
        null != t && nn(this.c, t)
    }, t.Zj = function() {
        null !== this.f && (an(this.c), Re(this.f), this.f = null);
        var t = this.ee();
        null != t && (this.f = Te(t, "postrender", this.render, !1, this), Af(this), t = this.v ? t.D : t.aa, this.l ? pn(t, this.c, 0) : nn(t, this.c))
    }, t.render = function() { Af(this) }, t.dk = function() { Af(this) }, t.fk = function() {
        if (Af(this), r(this.get("position")) && this.j) {
            var t = this.ee();
            if (r(t) && !h(t.hd())) {
                var e = jf(t.hd(), t.Ca()),
                    o = (p = this.de()).offsetWidth,
                    i = p.currentStyle || window.getComputedStyle(p),
                    n = (o += parseInt(i.marginLeft, 10) + parseInt(i.marginRight, 10), i = p.offsetHeight, p.currentStyle || window.getComputedStyle(p)),
                    s = jf(p, [o, i += parseInt(n.marginTop, 10) + parseInt(n.marginBottom, 10)]),
                    p = this.i;
                jo(e, s) || (o = s[0] - e[0], i = e[2] - s[2], n = s[1] - e[1], s = e[3] - s[3], e = [0, 0], 0 > o ? e[0] = o - p : 0 > i && (e[0] = Math.abs(i) + p), 0 > n ? e[1] = n - p : 0 > s && (e[1] = Math.abs(s) + p), 0 === e[0] && 0 === e[1]) || (p = t.X().Ka(), e = [(o = t.ya(p))[0] + e[0], o[1] + e[1]], null !== this.g && (this.g.source = p, t.Oa(xr(this.g))), t.X().eb(t.ta(e)))
            }
        }
    }, t.gk = function() { Af(this) }, t.wh = function(t) { this.set("element", t) }, t.setMap = function(t) { this.set("map", t) }, t.Bh = function(t) { this.set("offset", t) }, t.kf = function(t) { this.set("position", t) }, t.Ch = function(t) { this.set("positioning", t) }, A(Cf, Gn), (t = Cf.prototype).setMap = function(t) {
        var e = this.b;
        t !== e && (e && (e = e.X()) && Ce(e, We("rotation"), this.Wd, !1, this), Cf.$.setMap.call(this, t), t && (this.v.push(Te(t, "propertychange", this.$j, !1, this)), 0 === this.f.Bg().Qb() && this.f.zh(t.ac()), t = t.X())) && (Te(t, We("rotation"), this.Wd, !1, this), dr(t) && (this.f.Rc(), Lf(this)))
    }, t.$j = function(t) { "view" === t.key && ((t = t.oldValue) && Ce(t, We("rotation"), this.Wd, !1, this), Te(t = this.b.X(), We("rotation"), this.Wd, !1, this)) }, t.Wd = function() { this.f.X().fe(this.b.X().Ea()) }, t.il = function(t) { t.preventDefault(), If(this) }, t.hl = function() { return this.j }, t.kl = function(t) { this.j !== t && (this.j = t, wn(this.element, "ol-uncollapsible"), !t && this.i && If(this)) }, t.jl = function(t) { this.j && this.i !== t && If(this) }, t.gl = function() { return this.i }, A(kf, Gn);
    var Nf = [1, 2, 5];

    function Ff(t) { t = t.frameState, this.A = null === t ? null : t.viewState, Df(this) }

    function Df(t) {
        if (null === (i = t.A)) t.f && (En(t.j, !1), t.f = !1);
        else {
            var e = i.center,
                o = i.projection,
                i = o.getPointResolution(i.resolution, e),
                r = o.b,
                n = t.C();
            for ("degrees" != r || "metric" != n && "imperial" != n && "us" != n && "nautical" != n ? "degrees" != r && "degrees" == n ? (null === t.i && (t.i = bi(o, gi("EPSG:4326"))), e = Math.cos(Vt(t.i(e)[1])), o = ii.radius, o /= ri[r], i *= 180 / (Math.PI * e * o)) : t.i = null : (t.i = null, e = Math.cos(Vt(e[1])), i *= Math.PI * e * ii.radius / 180), e = t.u * i, r = "", "degrees" == n ? e < 1 / 60 ? (r = "″", i *= 3600) : 1 > e ? (r = "′", i *= 60) : r = "°" : "imperial" == n ? .9144 > e ? (r = "in", i /= .0254) : 1609.344 > e ? (r = "ft", i /= .3048) : (r = "mi", i /= 1609.344) : "nautical" == n ? (i /= 1852, r = "nm") : "metric" == n ? 1 > e ? (r = "mm", i *= 1e3) : 1e3 > e ? r = "m" : (r = "km", i /= 1e3) : "us" == n && (.9144 > e ? (r = "in", i *= 39.37) : 1609.344 > e ? (r = "ft", i /= .30480061) : (r = "mi", i /= 1609.3472)), e = 3 * Math.floor(Math.log(t.u * i) / Math.log(10));;) { if (o = Nf[e % 3] * Math.pow(10, Math.floor(e / 3)), n = Math.round(o / i), isNaN(n)) return En(t.j, !1), void(t.f = !1); if (n >= t.u) break;++e }
            i = o + " " + r, t.D != i && (t.l.innerHTML = i, t.D = i), t.N != n && (t.l.style.width = n + "px", t.N = n), t.f || (En(t.j, !0), t.f = !0)
        }
    }

    function Of(t) { Qt.call(this), this.b = t, this.a = {} }
    kf.prototype.C = function() { return this.get("units") }, kf.prototype.Z = function() { Df(this) }, kf.prototype.ba = function(t) { this.set("units", t) }, A(Of, Qt);
    var Bf = [];

    function Gf(t) { lt(t.a, Re), t.a = {} }

    function Uf(t, e, o) { Oe.call(this), this.target = t, this.handle = e || t, this.a = o || new xn(NaN, NaN, NaN, NaN), this.c = cn(t), this.b = new Of(this), oe(this, this.b), Te(this.handle, ["touchstart", "mousedown"], this.Fh, !1, this) }
    Of.prototype.Ra = function(t, e, o, i) {
        l(e) || (e && (Bf[0] = e.toString()), e = Bf);
        for (var r = 0; r < e.length; r++) {
            var n = Te(t, e[r], o || this.handleEvent, i || !1, this.b || this);
            if (!n) break;
            this.a[n.key] = n
        }
        return this
    }, Of.prototype.Cf = function(t, e, o, i, r) {
        if (l(e))
            for (var n = 0; n < e.length; n++) this.Cf(t, e[n], o, i, r);
        else o = o || this.handleEvent, r = r || this.b || this, o = De(o), i = !!i, (e = fe(t) ? we(t.jb, String(e), o, i, r) : t && (t = Ne(t)) ? we(t, e, o, i, r) : null) && (Re(e), delete this.a[e.key]);
        return this
    }, Of.prototype.W = function() { Of.$.W.call(this), Gf(this) }, Of.prototype.handleEvent = function() { throw Error("EventHandler.handleEvent not implemented") }, A(Uf, Oe);
    var Xf = jt || At && Ot("1.9.3");

    function Kf(t) { var e = t.type; "touchstart" == e || "touchmove" == e ? ue(t, t.a.targetTouches[0], t.c) : "touchend" != e && "touchcancel" != e || ue(t, t.a.changedTouches[0], t.c) }

    function Yf(t, e, o) { var i = gn(qr(t.c)); return e += i.x - t.f.x, o += i.y - t.f.y, t.f = i, t.Dc += e, t.Ec += o, new Zr(e = Hf(t, t.Dc), t = Wf(t, t.Ec)) }

    function Vf(t, e, o, i) { t.target.style.left = o + "px", t.target.style.top = i + "px", Be(t, new zf("drag", t, e.clientX, e.clientY, 0, o, i)) }

    function Hf(t, e) {
        var o = t.a,
            i = isNaN(o.left) ? null : o.left;
        return o = isNaN(o.width) ? 0 : o.width, Math.min(null != i ? i + o : 1 / 0, Math.max(null != i ? i : -1 / 0, e))
    }

    function Wf(t, e) {
        var o = t.a,
            i = isNaN(o.top) ? null : o.top;
        return o = isNaN(o.height) ? 0 : o.height, Math.min(null != i ? i + o : 1 / 0, Math.max(null != i ? i : -1 / 0, e))
    }

    function zf(t, e, o, i, n, s, p) { re.call(this, t), this.clientX = o, this.clientY = i, this.left = r(s) ? s : e.Dc, this.top = r(p) ? p : e.Ec }

    function Zf(t) {
        t = r(t) ? t : {}, this.i = void 0, this.j = Jf, this.l = null, this.A = !1, this.u = r(t.duration) ? t.duration : 200;
        var e = en("DIV", [(o = r(t.className) ? t.className : "ol-zoomslider") + "-thumb", "ol-unselectable"]),
            o = en("DIV", [o, "ol-unselectable", "ol-control"], e);
        this.f = new Uf(e), oe(this, this.f), Te(this.f, "start", this.Mj, !1, this), Te(this.f, "drag", this.Kj, !1, this), Te(this.f, "end", this.Lj, !1, this), Te(o, "click", this.Jj, !1, this), Te(e, "click", ne), Gn.call(this, { element: o, render: r(t.render) ? t.render : qf })
    }(t = Uf.prototype).clientX = 0, t.clientY = 0, t.screenX = 0, t.screenY = 0, t.Gh = 0, t.Hh = 0, t.Dc = 0, t.Ec = 0, t.ec = !1, t.W = function() { Uf.$.W.call(this), Ce(this.handle, ["touchstart", "mousedown"], this.Fh, !1, this), Gf(this.b), Xf && this.c.releaseCapture(), this.handle = this.target = null }, t.Fh = function(t) {
        var e = "mousedown" == t.type;
        if (this.ec || e && !ce(t)) Be(this, "earlycancel");
        else if (Kf(t), Be(this, new zf("start", this, t.clientX, t.clientY))) {
            this.ec = !0, t.preventDefault();
            var o = (e = this.c).documentElement,
                i = !Xf;
            this.b.Ra(e, ["touchmove", "mousemove"], this.ck, i), this.b.Ra(e, ["touchend", "mouseup"], this.Id, i), Xf ? (o.setCapture(!1), this.b.Ra(o, "losecapture", this.Id)) : this.b.Ra(e ? e.parentWindow || e.defaultView : window, "blur", this.Id), this.g && this.b.Ra(this.g, "scroll", this.bn, i), this.clientX = this.Gh = t.clientX, this.clientY = this.Hh = t.clientY, this.screenX = t.screenX, this.screenY = t.screenY, this.Dc = this.target.offsetLeft, this.Ec = this.target.offsetTop, this.f = gn(qr(this.c)), j()
        }
    }, t.Id = function(t) {
        if (Gf(this.b), Xf && this.c.releaseCapture(), this.ec) {
            Kf(t), this.ec = !1;
            var e = Hf(this, this.Dc),
                o = Wf(this, this.Ec);
            Be(this, new zf("end", this, t.clientX, t.clientY, 0, e, o))
        } else Be(this, "earlycancel")
    }, t.ck = function(t) {
        Kf(t);
        var e = 1 * (t.clientX - this.clientX),
            o = t.clientY - this.clientY;
        if (this.clientX = t.clientX, this.clientY = t.clientY, this.screenX = t.screenX, this.screenY = t.screenY, !this.ec) {
            var i = this.Gh - this.clientX,
                r = this.Hh - this.clientY;
            if (0 < i * i + r * r) {
                if (!Be(this, new zf("start", this, t.clientX, t.clientY))) return void(this.ea || this.Id(t));
                this.ec = !0
            }
        }
        e = (o = Yf(this, e, o)).x, o = o.y, this.ec && Be(this, new zf("beforedrag", this, t.clientX, t.clientY, 0, e, o)) && (Vf(this, t, e, o), t.preventDefault())
    }, t.bn = function(t) {
        var e = Yf(this, 0, 0);
        t.clientX = this.clientX, t.clientY = this.clientY, Vf(this, t, e.x, e.y)
    }, A(zf, re), A(Zf, Gn);
    var Jf = 0;

    function qf(t) {
        if (null !== t.frameState) {
            if (!this.A) {
                var e = Rn(o = this.element),
                    o = Nn(r = ln(o), "margin"),
                    i = new Jr(r.offsetWidth, r.offsetHeight),
                    r = i.width + o.right + o.left;
                o = i.height + o.top + o.bottom, this.l = [r, o], r = e.width - r, o = e.height - o, e.width > e.height ? (this.j = 1, e = new xn(0, 0, r, 0)) : (this.j = Jf, e = new xn(0, 0, 0, o)), this.f.a = e || new xn(NaN, NaN, NaN, NaN), this.A = !0
            }(t = t.frameState.viewState.resolution) !== this.i && (this.i = t, t = 1 - function(t) {
                var e = t.b,
                    o = Math.log(e / t.j) / Math.log(2);
                return function(t) { return Math.log(e / t) / Math.log(2) / o }
            }(this.b.X())(t), e = this.f, o = ln(this.element), 1 == this.j ? Tn(o, e.a.left + e.a.width * t) : Tn(o, e.a.left, e.a.top + e.a.height * t))
        }
    }

    function $f(t, e, o) { var i = t.f.a; return Xt(1 === t.j ? (e - i.left) / i.width : (o - i.top) / i.height, 0, 1) }

    function _f(t, e) {
        return function(t) {
            var e = t.b,
                o = Math.log(e / t.j) / Math.log(2);
            return function(t) { return e / Math.pow(2, t * o) }
        }(t.b.X())(1 - e)
    }

    function Qf(t) {
        t = r(t) ? t : {}, this.f = r(t.extent) ? t.extent : null;
        var e = r(t.className) ? t.className : "ol-zoom-extent",
            o = en("BUTTON", { type: "button", title: r(t.tipLabel) ? t.tipLabel : "Fit to extent" }, r(t.label) ? t.label : "E");
        Te(o, "click", this.i, !1, this), Un(o), e = en("DIV", e + " ol-unselectable ol-control", o), Gn.call(this, { element: e, target: t.target })
    }

    function tg(t) { Ve.call(this), t = r(t) ? t : {}, this.b = null, Te(this, We("tracking"), this.Lk, !1, this), this.gf(!!r(t.tracking) && t.tracking) }

    function eg() { this.defaultDataProjection = null }

    function og(t, e, o) { var i; return r(o) && (i = { dataProjection: r(o.dataProjection) ? o.dataProjection : t.Ga(e), featureProjection: o.featureProjection }), ig(t, i) }

    function ig(t, e) { var o; return r(e) && (o = { featureProjection: e.featureProjection, dataProjection: null != e.dataProjection ? e.dataProjection : t.defaultDataProjection, rightHanded: e.rightHanded }), o }

    function rg(t, e, o) { var i = r(o) ? gi(o.featureProjection) : null; return o = r(o) ? gi(o.dataProjection) : null, null === i || null === o || di(i, o) ? t : t instanceof Mi ? (e ? t.clone() : t).transform(e ? i : o, e ? o : i) : xi(e ? t.slice() : t, e ? i : o, e ? o : i) }

    function ng() { this.defaultDataProjection = null }

    function sg(t) { return g(t) || c(t) && r(t = Ju(t)) ? t : null }

    function pg(t) { t = r(t) ? t : {}, this.defaultDataProjection = null, this.a = t.geometryName }

    function ag(t, e) {
        if (null === t) return null;
        var o;
        if (y(t.x) && y(t.y)) o = "Point";
        else if (null != t.points) o = "MultiPoint";
        else if (null != t.paths) o = 1 === t.paths.length ? "LineString" : "MultiLineString";
        else if (null != t.rings) {
            var i, r, n = t.rings,
                s = hg(t),
                p = [];
            for (o = [], i = 0, r = n.length; i < r; ++i) {
                var a = st(n[i]);
                or(a, 0, a.length, s.length) ? p.push([n[i]]) : o.push(n[i])
            }
            for (; o.length;) {
                for (n = o.shift(), s = !1, i = p.length - 1; 0 <= i; i--)
                    if (jo(new Hi(p[i][0]).R(), new Hi(n).R())) { p[i].push(n), s = !0; break }
                s || p.push([n.reverse()])
            }
            t = xt(t), 1 === p.length ? (o = "Polygon", t.rings = p[0]) : (o = "MultiPolygon", t.rings = p)
        }
        return rg((0, ug[o])(t), !1, e)
    }

    function hg(t) { var e = "XY"; return !0 === t.hasZ && !0 === t.hasM ? e = "XYZM" : !0 === t.hasZ ? e = "XYZ" : !0 === t.hasM && (e = "XYM"), e }

    function lg(t) { return { hasZ: "XYZ" === (t = t.b) || "XYZM" === t, hasM: "XYM" === t || "XYZM" === t } }(t = Zf.prototype).setMap = function(t) { Zf.$.setMap.call(this, t), null === t || t.render() }, t.Jj = function(t) {
        var e = this.b,
            o = e.X(),
            i = o.Da();
        e.Oa(Pr({ resolution: i, duration: this.u, easing: br })), t = _f(this, t = $f(this, t.offsetX - this.l[0] / 2, t.offsetY - this.l[1] / 2)), o.Xb(o.constrainResolution(t))
    }, t.Mj = function() { vr(this.b.X(), 1) }, t.Kj = function(t) { t = $f(this, t.left, t.top), this.i = _f(this, t), this.b.X().Xb(this.i) }, t.Lj = function() {
        var t = this.b,
            e = t.X();
        vr(e, -1), t.Oa(Pr({ resolution: this.i, duration: this.u, easing: br })), t = e.constrainResolution(this.i), e.Xb(t)
    }, A(Qf, Gn), Qf.prototype.i = function(t) {
        t.preventDefault(), t = (o = this.b).X();
        var e = null === this.f ? t.g.R() : this.f,
            o = o.Ca();
        t.Qe(e, o)
    }, A(tg, Ve), (t = tg.prototype).W = function() { this.gf(!1), tg.$.W.call(this) }, t.cn = function(t) {
        if (null != (t = t.a).alpha) {
            var e = Vt(t.alpha);
            this.set("alpha", e), "boolean" == typeof t.absolute && t.absolute ? this.set("heading", e) : null != t.webkitCompassHeading && null != t.webkitCompassAccuracy && -1 != t.webkitCompassAccuracy && this.set("heading", Vt(t.webkitCompassHeading))
        }
        null != t.beta && this.set("beta", Vt(t.beta)), null != t.gamma && this.set("gamma", Vt(t.gamma)), this.s()
    }, t.Qi = function() { return this.get("alpha") }, t.Ti = function() { return this.get("beta") }, t.bj = function() { return this.get("gamma") }, t.Kk = function() { return this.get("heading") }, t.xg = function() { return this.get("tracking") }, t.Lk = function() {
        if (gp) {
            var t = this.xg();
            t && null === this.b ? this.b = Te(i, "deviceorientation", this.cn, !1, this) : t || null === this.b || (Re(this.b), this.b = null)
        }
    }, t.gf = function(t) { this.set("tracking", t) }, A(ng, eg), (t = ng.prototype).U = function() { return "json" }, t.Eb = function(t, e) { return this.Mc(sg(t), og(this, t, e)) }, t.qa = function(t, e) { return this.uf(sg(t), og(this, t, e)) }, t.Nc = function(t, e) { return this.ih(sg(t), og(this, t, e)) }, t.Ga = function(t) { return this.oh(sg(t)) }, t.xd = function(t, e) { return qu(this.Sc(t, e)) }, t.Fb = function(t, e) { return qu(this.Ce(t, e)) }, t.Tc = function(t, e) { return qu(this.Ee(t, e)) }, A(pg, ng);
    var ug = { Point: function(t) { return null != t.m && null != t.z ? new zi([t.x, t.y, t.z, t.m], "XYZM") : null != t.z ? new zi([t.x, t.y, t.z], "XYZ") : null != t.m ? new zi([t.x, t.y, t.m], "XYM") : new zi([t.x, t.y]) }, LineString: function(t) { return new iu(t.paths[0], hg(t)) }, Polygon: function(t) { return new sr(t.rings, hg(t)) }, MultiPoint: function(t) { return new lu(t.points, hg(t)) }, MultiLineString: function(t) { return new su(t.paths, hg(t)) }, MultiPolygon: function(t) { return new uu(t.rings, hg(t)) } },
        cg = {
            Point: function(t) { var e = t.V(); return "XYZ" === (t = t.b) ? { x: e[0], y: e[1], z: e[2] } : "XYM" === t ? { x: e[0], y: e[1], m: e[2] } : "XYZM" === t ? { x: e[0], y: e[1], z: e[2], m: e[3] } : "XY" === t ? { x: e[0], y: e[1] } : void 0 },
            LineString: function(t) { var e = lg(t); return { hasZ: e.hasZ, hasM: e.hasM, paths: [t.V()] } },
            Polygon: function(t) { var e = lg(t); return { hasZ: e.hasZ, hasM: e.hasM, rings: t.V(!1) } },
            MultiPoint: function(t) { var e = lg(t); return { hasZ: e.hasZ, hasM: e.hasM, points: t.V() } },
            MultiLineString: function(t) { var e = lg(t); return { hasZ: e.hasZ, hasM: e.hasM, paths: t.V() } },
            MultiPolygon: function(t) {
                var e = lg(t);
                t = t.V(!1);
                for (var o = [], i = 0; i < t.length; i++)
                    for (var r = t[i].length - 1; 0 <= r; r--) o.push(t[i][r]);
                return { hasZ: e.hasZ, hasM: e.hasM, rings: o }
            }
        };

    function yg(t, e) { return (0, cg[t.U()])(rg(t, !0, e), e) }

    function fg(t) { t = r(t) ? t : {}, this.defaultDataProjection = null, this.defaultDataProjection = gi(null != t.defaultDataProjection ? t.defaultDataProjection : "EPSG:4326"), this.a = t.geometryName }

    function gg(t, e) { return null === t ? null : rg((0, vg[t.type])(t), !1, e) }

    function dg(t, e) { return (0, bg[t.U()])(rg(t, !0, e), e) }(t = pg.prototype).Mc = function(t, e) {
        var o = ag(t.geometry, e),
            i = new Lu;
        return r(this.a) && i.Pc(this.a), i.Sa(o), r(e) && r(e.bf) && r(t.attributes[e.bf]) && i.Wb(t.attributes[e.bf]), r(t.attributes) && i.I(t.attributes), i
    }, t.uf = function(t, e) {
        var o = r(e) ? e : {};
        if (null != t.features) {
            var i, n, s = [],
                p = t.features;
            for (o.bf = t.objectIdFieldName, i = 0, n = p.length; i < n; ++i) s.push(this.Mc(p[i], o));
            return s
        }
        return [this.Mc(t, o)]
    }, t.ih = function(t, e) { return ag(t, e) }, t.oh = function(t) { return null != t.spatialReference && null != t.spatialReference.wkid ? gi("EPSG:" + t.spatialReference.wkid) : null }, t.Ee = function(t, e) { return yg(t, ig(this, e)) }, t.Sc = function(t, e) {
        e = ig(this, e);
        var o = {},
            i = t.Y();
        return null != i && (o.geometry = yg(i, e)), mt(i = t.P(), t.b), o.attributes = vt(i) ? {} : i, r(e) && r(e.featureProjection) && (o.spatialReference = { wkid: gi(e.featureProjection).a.split(":").pop() }), o
    }, t.Ce = function(t, e) { e = ig(this, e); var o, i, r = []; for (o = 0, i = t.length; o < i; ++o) r.push(this.Sc(t[o], e)); return { features: r } }, A(fg, ng);
    var vg = { Point: function(t) { return new zi(t.coordinates) }, LineString: function(t) { return new iu(t.coordinates) }, Polygon: function(t) { return new sr(t.coordinates) }, MultiPoint: function(t) { return new lu(t.coordinates) }, MultiLineString: function(t) { return new su(t.coordinates) }, MultiPolygon: function(t) { return new uu(t.coordinates) }, GeometryCollection: function(t, e) { return new $l(z(t.geometries, (function(t) { return gg(t, e) }))) } },
        bg = { Point: function(t) { return { type: "Point", coordinates: t.V() } }, LineString: function(t) { return { type: "LineString", coordinates: t.V() } }, Polygon: function(t, e) { var o; return r(e) && (o = e.rightHanded), { type: "Polygon", coordinates: t.V(o) } }, MultiPoint: function(t) { return { type: "MultiPoint", coordinates: t.V() } }, MultiLineString: function(t) { return { type: "MultiLineString", coordinates: t.V() } }, MultiPolygon: function(t, e) { var o; return r(e) && (o = e.rightHanded), { type: "MultiPolygon", coordinates: t.V(o) } }, GeometryCollection: function(t, e) { return { type: "GeometryCollection", geometries: z(t.f, (function(t) { return dg(t, e) })) } }, Circle: function() { return { type: "GeometryCollection", geometries: [] } } };

    function mg() { this.defaultDataProjection = null }

    function wg(t, e, o) { return 0 < (t = Sg(t, e, o)).length ? t[0] : null }

    function Sg(t, e, o) { var i = []; for (e = e.firstChild; null !== e; e = e.nextSibling) 1 == e.nodeType && tt(i, t.Ub(e, o)); return i }

    function xg(t) { t = r(t) ? t : {}, this.featureType = t.featureType, this.featureNS = t.featureNS, this.srsName = t.srsName, this.schemaLocation = "", this.a = {}, this.a["http://www.opengis.net/gml"] = { featureMember: Oc(xg.prototype.sd), featureMembers: Oc(xg.prototype.sd) }, this.defaultDataProjection = null }

    function Mg(t) { return Pg(t = Ac(t, !1)) }

    function Pg(t) { if (t = /^\s*(true|1)|(false|0)\s*$/.exec(t)) return r(t[1]) || !1 }

    function Tg(t) {
        if (t = Ac(t, !1), t = /^\s*(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})(Z|(?:([+\-])(\d{2})(?::(\d{2}))?))\s*$/.exec(t)) {
            var e = Date.UTC(parseInt(t[1], 10), parseInt(t[2], 10) - 1, parseInt(t[3], 10), parseInt(t[4], 10), parseInt(t[5], 10), parseInt(t[6], 10)) / 1e3;
            if ("Z" != t[7]) {
                var o = "-" == t[8] ? -1 : 1;
                e += 60 * o * parseInt(t[9], 10), r(t[10]) && (e += 3600 * o * parseInt(t[10], 10))
            }
            return e
        }
    }

    function jg(t) { return Ag(t = Ac(t, !1)) }

    function Ag(t) { if (t = /^\s*([+\-]?\d*\.?\d+(?:e[+\-]?\d+)?)\s*$/i.exec(t)) return parseFloat(t[1]) }

    function Cg(t) { return Rg(t = Ac(t, !1)) }

    function Rg(t) { if (t = /^\s*(\d+)\s*$/.exec(t)) return parseInt(t[1], 10) }

    function Lg(t) { return t = Ac(t, !1), L(t) }

    function Eg(t, e) { Ng(t, e ? "1" : "0") }

    function Ig(t, e) { t.appendChild(Tc.createTextNode(e.toPrecision())) }

    function kg(t, e) { t.appendChild(Tc.createTextNode(e.toString())) }

    function Ng(t, e) { t.appendChild(Tc.createTextNode(e)) }

    function Fg(t) { t = r(t) ? t : {}, xg.call(this, t), this.l = !!r(t.surface) && t.surface, this.g = !!r(t.curve) && t.curve, this.i = !r(t.multiCurve) || t.multiCurve, this.j = !r(t.multiSurface) || t.multiSurface, this.schemaLocation = r(t.schemaLocation) ? t.schemaLocation : "http://www.opengis.net/gml http://schemas.opengis.net/gml/3.1.1/profiles/gmlsfProfile/1.0.0/gmlsf.xsd" }

    function Dg(t, e, o) {
        o = o[o.length - 1].srsName;
        for (var i, r = (e = e.V()).length, n = Array(r), s = 0; s < r; ++s) {
            i = e[s];
            var p = s,
                a = "enu";
            null != o && (a = si(gi(o))), n[p] = "en" === a.substr(0, 2) ? i[0] + " " + i[1] : i[1] + " " + i[0]
        }
        Ng(t, n.join(" "))
    }(t = fg.prototype).Mc = function(t, e) {
        var o = gg(t.geometry, e),
            i = new Lu;
        return r(this.a) && i.Pc(this.a), i.Sa(o), r(t.id) && i.Wb(t.id), r(t.properties) && i.I(t.properties), i
    }, t.uf = function(t, e) {
        if ("Feature" == t.type) return [this.Mc(t, e)];
        if ("FeatureCollection" == t.type) {
            var o, i, r = [],
                n = t.features;
            for (o = 0, i = n.length; o < i; ++o) r.push(this.Mc(n[o], e));
            return r
        }
        return []
    }, t.ih = function(t, e) { return gg(t, e) }, t.oh = function(t) { return null != (t = t.crs) ? "name" == t.type ? gi(t.properties.name) : "EPSG" == t.type ? gi("EPSG:" + t.properties.code) : null : this.defaultDataProjection }, t.Sc = function(t, e) {
        e = ig(this, e);
        var o = { type: "Feature" },
            i = t.ha;
        return null != i && (o.id = i), i = t.Y(), o.geometry = null != i ? dg(i, e) : null, mt(i = t.P(), t.b), o.properties = vt(i) ? null : i, o
    }, t.Ce = function(t, e) { e = ig(this, e); var o, i, r = []; for (o = 0, i = t.length; o < i; ++o) r.push(this.Sc(t[o], e)); return { type: "FeatureCollection", features: r } }, t.Ee = function(t, e) { return dg(t, ig(this, e)) }, A(mg, eg), (t = mg.prototype).U = function() { return "xml" }, t.Eb = function(t, e) { return Rc(t) ? wg(this, t, e) : Lc(t) ? this.gh(t, e) : c(t) ? wg(this, Nc(t), e) : null }, t.qa = function(t, e) { return Rc(t) ? Sg(this, t, e) : Lc(t) ? this.Ub(t, e) : c(t) ? Sg(this, Nc(t), e) : [] }, t.Nc = function(t, e) { if (Rc(t)) return this.v(t, e); if (Lc(t)) { var o = this.te(t, [og(this, t, r(e) ? e : {})]); return r(o) ? o : null } return c(t) ? (o = Nc(t), this.v(o, e)) : null }, t.Ga = function(t) { return Rc(t) ? this.yf(t) : Lc(t) ? this.we(t) : c(t) ? (t = Nc(t), this.yf(t)) : null }, t.yf = function() { return this.defaultDataProjection }, t.we = function() { return this.defaultDataProjection }, t.xd = function(t, e) { return Mc(this.A(t, e)) }, t.Fb = function(t, e) { return Mc(this.b(t, e)) }, t.Tc = function(t, e) { return Mc(this.B(t, e)) }, A(xg, mg), (t = xg.prototype).sd = function(t, e) {
        var o, i = Cc(t);
        if ("FeatureCollection" == i) o = "http://www.opengis.net/wfs" === t.namespaceURI ? Jc([], this.a, t, e, this) : Jc(null, this.a, t, e, this);
        else if ("featureMembers" == i || "featureMember" == i) {
            var n, s, p = (f = e[0]).featureType;
            if (o = f.featureNS, !r(p) && null != t.childNodes) {
                for (p = [], o = {}, n = 0, s = t.childNodes.length; n < s; ++n) { var a = t.childNodes[n]; if (1 === a.nodeType) { var h, u = a.nodeName.split(":").pop(); - 1 === V(p, u) && (gt(o, a.namespaceURI) ? h = dt(o, (function(t) { return t === a.namespaceURI })) : o[h = "p" + ut(o)] = a.namespaceURI, p.push(h + ":" + u)) } }
                f.featureType = p, f.featureNS = o
            }
            c(o) && (n = o, (o = {}).p0 = n);
            var y, f = {};
            for (y in p = l(p) ? p : [p], o) {
                for (u = {}, n = 0, s = p.length; n < s; ++n)(-1 === p[n].indexOf(":") ? "p0" : p[n].split(":")[0]) === y && (u[p[n].split(":").pop()] = "featureMembers" == i ? Dc(this.tf, this) : Oc(this.tf, this));
                f[o[y]] = u
            }
            o = Jc([], f, t, e)
        }
        return r(o) || (o = []), o
    }, t.te = function(t, e) {
        var o = e[0];
        o.srsName = t.firstElementChild.getAttribute("srsName");
        var i = Jc(null, this.If, t, e, this);
        if (null != i) return rg(i, !1, o)
    }, t.tf = function(t, e) {
        var o, i, n = t.getAttribute("fid") || Ec(t, "http://www.opengis.net/gml", "id"),
            s = {};
        for (o = t.firstElementChild; null !== o; o = o.nextElementSibling) { var p = Cc(o); if (0 === o.childNodes.length || 1 === o.childNodes.length && (3 === o.firstChild.nodeType || 4 === o.firstChild.nodeType)) { var a = Ac(o, !1); /^[\s\xa0]*$/.test(a) && (a = void 0), s[p] = a } else "boundedBy" !== p && (i = p), s[p] = this.te(o, e) }
        return o = new Lu(s), r(i) && o.Pc(i), n && o.Wb(n), o
    }, t.nh = function(t, e) { var o = this.se(t, e); if (null != o) { var i = new zi(null); return Zi(i, "XYZ", o), i } }, t.lh = function(t, e) { var o = Jc([], this.ci, t, e, this); if (r(o)) return new lu(o) }, t.kh = function(t, e) { var o = Jc([], this.bi, t, e, this); if (r(o)) { var i = new su(null); return hu(i, o), i } }, t.mh = function(t, e) { var o = Jc([], this.di, t, e, this); if (r(o)) { var i = new uu(null); return gu(i, o), i } }, t.bh = function(t, e) { Zc(this.gi, t, e, this) }, t.tg = function(t, e) { Zc(this.$h, t, e, this) }, t.dh = function(t, e) { Zc(this.hi, t, e, this) }, t.ue = function(t, e) { var o = this.se(t, e); if (null != o) { var i = new iu(null); return nu(i, "XYZ", o), i } }, t.vn = function(t, e) { var o = Jc(null, this.zd, t, e, this); if (null != o) return o }, t.jh = function(t, e) { var o = this.se(t, e); if (r(o)) { var i = new Hi(null); return Wi(i, "XYZ", o), i } }, t.ve = function(t, e) {
        var o = Jc([null], this.Ge, t, e, this);
        if (r(o) && null !== o[0]) {
            var i, n, s = new sr(null),
                p = o[0],
                a = [p.length];
            for (i = 1, n = o.length; i < n; ++i) tt(p, o[i]), a.push(p.length);
            return hr(s, "XYZ", p, a), s
        }
    }, t.se = function(t, e) { return Jc(null, this.zd, t, e, this) }, t.ci = Object({ "http://www.opengis.net/gml": { pointMember: Dc(xg.prototype.bh), pointMembers: Dc(xg.prototype.bh) } }), t.bi = Object({ "http://www.opengis.net/gml": { lineStringMember: Dc(xg.prototype.tg), lineStringMembers: Dc(xg.prototype.tg) } }), t.di = Object({ "http://www.opengis.net/gml": { polygonMember: Dc(xg.prototype.dh), polygonMembers: Dc(xg.prototype.dh) } }), t.gi = Object({ "http://www.opengis.net/gml": { Point: Dc(xg.prototype.se) } }), t.$h = Object({ "http://www.opengis.net/gml": { LineString: Dc(xg.prototype.ue) } }), t.hi = Object({ "http://www.opengis.net/gml": { Polygon: Dc(xg.prototype.ve) } }), t.Ad = Object({ "http://www.opengis.net/gml": { LinearRing: Oc(xg.prototype.vn) } }), t.Ub = function(t, e) { var o = { featureType: this.featureType, featureNS: this.featureNS }; return r(e) && Pt(o, og(this, t, e)), this.sd(t, [o]) }, t.we = function(t) { return gi(r(this.u) ? this.u : t.firstElementChild.getAttribute("srsName")) }, A(Fg, xg), (t = Fg.prototype).yn = function(t, e) { var o = Jc([], this.ai, t, e, this); if (r(o)) { var i = new su(null); return hu(i, o), i } }, t.zn = function(t, e) { var o = Jc([], this.ei, t, e, this); if (r(o)) { var i = new uu(null); return gu(i, o), i } }, t.Tf = function(t, e) { Zc(this.Xh, t, e, this) }, t.Ih = function(t, e) { Zc(this.ki, t, e, this) }, t.Cn = function(t, e) { return Jc([null], this.fi, t, e, this) }, t.En = function(t, e) { return Jc([null], this.ji, t, e, this) }, t.Dn = function(t, e) { return Jc([null], this.Ge, t, e, this) }, t.xn = function(t, e) { return Jc([null], this.zd, t, e, this) }, t.sk = function(t, e) {
        var o = Jc(void 0, this.Ad, t, e, this);
        r(o) && e[e.length - 1].push(o)
    }, t.Ji = function(t, e) {
        var o = Jc(void 0, this.Ad, t, e, this);
        r(o) && (e[e.length - 1][0] = o)
    }, t.ph = function(t, e) {
        var o = Jc([null], this.li, t, e, this);
        if (r(o) && null !== o[0]) {
            var i, n, s = new sr(null),
                p = o[0],
                a = [p.length];
            for (i = 1, n = o.length; i < n; ++i) tt(p, o[i]), a.push(p.length);
            return hr(s, "XYZ", p, a), s
        }
    }, t.eh = function(t, e) { var o = Jc([null], this.Yh, t, e, this); if (r(o)) { var i = new iu(null); return nu(i, "XYZ", o), i } }, t.tn = function(t, e) { var o = Jc([null], this.Zh, t, e, this); return Ro(o[1][0], o[1][1], o[2][0], o[2][1]) }, t.wn = function(t, e) {
        for (var o, i = Ac(t, !1), r = /^\s*([+\-]?\d*\.?\d+(?:[eE][+\-]?\d+)?)\s*/, n = []; o = r.exec(i);) n.push(parseFloat(o[1])), i = i.substr(o[0].length);
        if ("" === i) {
            if (r = "enu", null === (i = e[0].srsName) || (r = si(gi(i))), "neu" === r)
                for (i = 0, r = n.length; i < r; i += 3) o = n[i], n[i] = n[i + 1], n[i + 1] = o;
            return 2 == (i = n.length) && n.push(0), 0 === i ? void 0 : n
        }
    }, t.wf = function(t, e) {
        var o = Ac(t, !1).replace(/^\s*|\s*$/g, ""),
            i = e[0].srsName,
            r = t.parentNode.getAttribute("srsDimension"),
            n = "enu";
        null === i || (n = si(gi(i))), o = o.split(/\s+/), i = 2, h(t.getAttribute("srsDimension")) ? h(t.getAttribute("dimension")) ? null === r || (i = Rg(r)) : i = Rg(t.getAttribute("dimension")) : i = Rg(t.getAttribute("srsDimension"));
        for (var s, p, a = [], l = 0, u = o.length; l < u; l += i) r = parseFloat(o[l]), s = parseFloat(o[l + 1]), p = 3 === i ? parseFloat(o[l + 2]) : 0, "en" === n.substr(0, 2) ? a.push(r, s, p) : a.push(s, r, p);
        return a
    }, t.zd = Object({ "http://www.opengis.net/gml": { pos: Oc(Fg.prototype.wn), posList: Oc(Fg.prototype.wf) } }), t.Ge = Object({ "http://www.opengis.net/gml": { interior: Fg.prototype.sk, exterior: Fg.prototype.Ji } }), t.If = Object({ "http://www.opengis.net/gml": { Point: Oc(xg.prototype.nh), MultiPoint: Oc(xg.prototype.lh), LineString: Oc(xg.prototype.ue), MultiLineString: Oc(xg.prototype.kh), LinearRing: Oc(xg.prototype.jh), Polygon: Oc(xg.prototype.ve), MultiPolygon: Oc(xg.prototype.mh), Surface: Oc(Fg.prototype.ph), MultiSurface: Oc(Fg.prototype.zn), Curve: Oc(Fg.prototype.eh), MultiCurve: Oc(Fg.prototype.yn), Envelope: Oc(Fg.prototype.tn) } }), t.ai = Object({ "http://www.opengis.net/gml": { curveMember: Dc(Fg.prototype.Tf), curveMembers: Dc(Fg.prototype.Tf) } }), t.ei = Object({ "http://www.opengis.net/gml": { surfaceMember: Dc(Fg.prototype.Ih), surfaceMembers: Dc(Fg.prototype.Ih) } }), t.Xh = Object({ "http://www.opengis.net/gml": { LineString: Dc(xg.prototype.ue), Curve: Dc(Fg.prototype.eh) } }), t.ki = Object({ "http://www.opengis.net/gml": { Polygon: Dc(xg.prototype.ve), Surface: Dc(Fg.prototype.ph) } }), t.li = Object({ "http://www.opengis.net/gml": { patches: Oc(Fg.prototype.Cn) } }), t.Yh = Object({ "http://www.opengis.net/gml": { segments: Oc(Fg.prototype.En) } }), t.Zh = Object({ "http://www.opengis.net/gml": { lowerCorner: Dc(Fg.prototype.wf), upperCorner: Dc(Fg.prototype.wf) } }), t.fi = Object({ "http://www.opengis.net/gml": { PolygonPatch: Oc(Fg.prototype.Dn) } }), t.ji = Object({ "http://www.opengis.net/gml": { LineStringSegment: Oc(Fg.prototype.xn) } }), t.Sh = function(t, e, o) {
        var i = o[o.length - 1].srsName;
        null != i && t.setAttribute("srsName", i), i = jc(t.namespaceURI, "pos"), t.appendChild(i), t = "enu", null != (o = o[o.length - 1].srsName) && (t = si(gi(o))), e = e.V(), Ng(i, "en" === t.substr(0, 2) ? e[0] + " " + e[1] : e[1] + " " + e[0])
    };
    var Og = { "http://www.opengis.net/gml": { lowerCorner: Xc(Ng), upperCorner: Xc(Ng) } };
    (t = Fg.prototype).to = function(t, e, o) {
        var i = o[o.length - 1].srsName;
        r(i) && t.setAttribute("srsName", i), $c({ node: t }, Og, Hc, [e[0] + " " + e[1], e[2] + " " + e[3]], o, ["lowerCorner", "upperCorner"], this)
    }, t.Ph = function(t, e, o) {
        var i = o[o.length - 1].srsName;
        null != i && t.setAttribute("srsName", i), i = jc(t.namespaceURI, "posList"), t.appendChild(i), Dg(i, e, o)
    }, t.ii = function(t, e) {
        var o = e[e.length - 1],
            i = o.node,
            n = o.exteriorWritten;
        return r(n) || (o.exteriorWritten = !0), jc(i.namespaceURI, r(n) ? "interior" : "exterior")
    }, t.Fe = function(t, e, o) { var i = o[o.length - 1].srsName; "PolygonPatch" !== t.nodeName && null != i && t.setAttribute("srsName", i), "Polygon" === t.nodeName || "PolygonPatch" === t.nodeName ? (e = e.Md(), $c({ node: t, srsName: i }, Xg, this.ii, e, o, void 0, this)) : "Surface" === t.nodeName && (i = jc(t.namespaceURI, "patches"), t.appendChild(i), t = jc(i.namespaceURI, "PolygonPatch"), i.appendChild(t), this.Fe(t, e, o)) }, t.Ae = function(t, e, o) { var i = o[o.length - 1].srsName; "LineStringSegment" !== t.nodeName && null != i && t.setAttribute("srsName", i), "LineString" === t.nodeName || "LineStringSegment" === t.nodeName ? (i = jc(t.namespaceURI, "posList"), t.appendChild(i), Dg(i, e, o)) : "Curve" === t.nodeName && (i = jc(t.namespaceURI, "segments"), t.appendChild(i), t = jc(i.namespaceURI, "LineStringSegment"), i.appendChild(t), this.Ae(t, e, o)) }, t.Rh = function(t, e, o) {
        var i = (r = o[o.length - 1]).srsName,
            r = r.surface;
        null != i && t.setAttribute("srsName", i), e = e.Od(), $c({ node: t, srsName: i, surface: r }, Bg, this.f, e, o, void 0, this)
    }, t.uo = function(t, e, o) {
        var i = o[o.length - 1].srsName;
        null != i && t.setAttribute("srsName", i), e = e.ge(), $c({ node: t, srsName: i }, Gg, Yc("pointMember"), e, o, void 0, this)
    }, t.Qh = function(t, e, o) {
        var i = (r = o[o.length - 1]).srsName,
            r = r.curve;
        null != i && t.setAttribute("srsName", i), e = e.gd(), $c({ node: t, srsName: i, curve: r }, Ug, this.f, e, o, void 0, this)
    }, t.Th = function(t, e, o) {
        var i = jc(t.namespaceURI, "LinearRing");
        t.appendChild(i), this.Ph(i, e, o)
    }, t.Uh = function(t, e, o) {
        var i = this.c(e, o);
        r(i) && (t.appendChild(i), this.Fe(i, e, o))
    }, t.vo = function(t, e, o) {
        var i = jc(t.namespaceURI, "Point");
        t.appendChild(i), this.Sh(i, e, o)
    }, t.Oh = function(t, e, o) {
        var i = this.c(e, o);
        r(i) && (t.appendChild(i), this.Ae(i, e, o))
    }, t.De = function(t, e, o) {
        var i, n = o[o.length - 1],
            s = xt(n);
        s.node = t, i = l(e) ? r(n.dataProjection) ? xi(e, n.featureProjection, n.dataProjection) : e : rg(e, !0, n), $c(s, Kg, this.c, [i], o, void 0, this)
    }, t.Mh = function(t, e, o) {
        r(i = e.ha) && t.setAttribute("fid", i);
        var i, n = (i = o[o.length - 1]).featureNS,
            s = e.b;
        r(i.lc) || (i.lc = {}, i.lc[n] = {});
        var p = e.P();
        e = [];
        var a, h = [];
        for (a in p) {
            var l = p[a];
            null !== l && (e.push(a), h.push(l), a == s ? a in i.lc[n] || (i.lc[n][a] = Xc(this.De, this)) : a in i.lc[n] || (i.lc[n][a] = Xc(Ng)))
        }(a = xt(i)).node = t, $c(a, i.lc, Yc(void 0, n), h, o, e)
    };
    var Bg = { "http://www.opengis.net/gml": { surfaceMember: Xc(Fg.prototype.Uh), polygonMember: Xc(Fg.prototype.Uh) } },
        Gg = { "http://www.opengis.net/gml": { pointMember: Xc(Fg.prototype.vo) } },
        Ug = { "http://www.opengis.net/gml": { lineStringMember: Xc(Fg.prototype.Oh), curveMember: Xc(Fg.prototype.Oh) } },
        Xg = { "http://www.opengis.net/gml": { exterior: Xc(Fg.prototype.Th), interior: Xc(Fg.prototype.Th) } },
        Kg = { "http://www.opengis.net/gml": { Curve: Xc(Fg.prototype.Ae), MultiCurve: Xc(Fg.prototype.Qh), Point: Xc(Fg.prototype.Sh), MultiPoint: Xc(Fg.prototype.uo), LineString: Xc(Fg.prototype.Ae), MultiLineString: Xc(Fg.prototype.Qh), LinearRing: Xc(Fg.prototype.Ph), Polygon: Xc(Fg.prototype.Fe), MultiPolygon: Xc(Fg.prototype.Rh), Surface: Xc(Fg.prototype.Fe), MultiSurface: Xc(Fg.prototype.Rh), Envelope: Xc(Fg.prototype.to) } },
        Yg = { MultiLineString: "lineStringMember", MultiCurve: "curveMember", MultiPolygon: "polygonMember", MultiSurface: "surfaceMember" };

    function Vg(t) { t = r(t) ? t : {}, xg.call(this, t), this.a["http://www.opengis.net/gml"].featureMember = Dc(xg.prototype.sd), this.schemaLocation = r(t.schemaLocation) ? t.schemaLocation : "http://www.opengis.net/gml http://schemas.opengis.net/gml/2.1.2/feature.xsd" }

    function Hg(t) { t = r(t) ? t : {}, this.defaultDataProjection = null, this.defaultDataProjection = gi("EPSG:4326"), this.a = t.readExtensions }
    Fg.prototype.f = function(t, e) { return jc("http://www.opengis.net/gml", Yg[e[e.length - 1].node.nodeName]) }, Fg.prototype.c = function(t, e) {
        var o, i = (s = e[e.length - 1]).multiSurface,
            r = s.surface,
            n = s.curve,
            s = s.multiCurve;
        return l(t) ? o = "Envelope" : "MultiPolygon" === (o = t.U()) && !0 === i ? o = "MultiSurface" : "Polygon" === o && !0 === r ? o = "Surface" : "LineString" === o && !0 === n ? o = "Curve" : "MultiLineString" === o && !0 === s && (o = "MultiCurve"), jc("http://www.opengis.net/gml", o)
    }, Fg.prototype.B = function(t, e) {
        e = ig(this, e);
        var o = jc("http://www.opengis.net/gml", "geom"),
            i = { node: o, srsName: this.srsName, curve: this.g, surface: this.l, multiSurface: this.j, multiCurve: this.i };
        return r(e) && Pt(i, e), this.De(o, t, [i]), o
    }, Fg.prototype.b = function(t, e) {
        e = ig(this, e);
        var o = jc("http://www.opengis.net/gml", "featureMembers");
        kc(o, "http://www.w3.org/2001/XMLSchema-instance", "xsi:schemaLocation", this.schemaLocation);
        var i = { srsName: this.srsName, curve: this.g, surface: this.l, multiSurface: this.j, multiCurve: this.i, featureNS: this.featureNS, featureType: this.featureType };
        r(e) && Pt(i, e);
        var n = (i = [i])[i.length - 1],
            s = n.featureType,
            p = n.featureNS,
            a = {};
        return a[p] = {}, a[p][s] = Xc(this.Mh, this), (n = xt(n)).node = o, $c(n, a, Yc(s, p), t, i), o
    }, A(Vg, xg), (t = Vg.prototype).hh = function(t, e) {
        var o = Ac(t, !1).replace(/^\s*|\s*$/g, ""),
            i = e[0].srsName,
            r = t.parentNode.getAttribute("srsDimension"),
            n = "enu";
        null === i || (n = si(gi(i))), o = o.split(/[\s,]+/), i = 2, h(t.getAttribute("srsDimension")) ? h(t.getAttribute("dimension")) ? null === r || (i = Rg(r)) : i = Rg(t.getAttribute("dimension")) : i = Rg(t.getAttribute("srsDimension"));
        for (var s, p, a = [], l = 0, u = o.length; l < u; l += i) r = parseFloat(o[l]), s = parseFloat(o[l + 1]), p = 3 === i ? parseFloat(o[l + 2]) : 0, "en" === n.substr(0, 2) ? a.push(r, s, p) : a.push(s, r, p);
        return a
    }, t.sn = function(t, e) { var o = Jc([null], this.Wh, t, e, this); return Ro(o[1][0], o[1][1], o[1][3], o[1][4]) }, t.qk = function(t, e) {
        var o = Jc(void 0, this.Ad, t, e, this);
        r(o) && e[e.length - 1].push(o)
    }, t.dn = function(t, e) {
        var o = Jc(void 0, this.Ad, t, e, this);
        r(o) && (e[e.length - 1][0] = o)
    }, t.zd = Object({ "http://www.opengis.net/gml": { coordinates: Oc(Vg.prototype.hh) } }), t.Ge = Object({ "http://www.opengis.net/gml": { innerBoundaryIs: Vg.prototype.qk, outerBoundaryIs: Vg.prototype.dn } }), t.Wh = Object({ "http://www.opengis.net/gml": { coordinates: Dc(Vg.prototype.hh) } }), t.If = Object({ "http://www.opengis.net/gml": { Point: Oc(xg.prototype.nh), MultiPoint: Oc(xg.prototype.lh), LineString: Oc(xg.prototype.ue), MultiLineString: Oc(xg.prototype.kh), LinearRing: Oc(xg.prototype.jh), Polygon: Oc(xg.prototype.ve), MultiPolygon: Oc(xg.prototype.mh), Box: Oc(Vg.prototype.sn) } }), A(Hg, mg);
    var Wg = [null, "http://www.topografix.com/GPX/1/0", "http://www.topografix.com/GPX/1/1"];

    function zg(t, e, o) { return t.push(parseFloat(e.getAttribute("lon")), parseFloat(e.getAttribute("lat"))), "ele" in o ? (t.push(o.ele), mt(o, "ele")) : t.push(0), "time" in o ? (t.push(o.time), mt(o, "time")) : t.push(0), t }

    function Zg(t, e) {
        var o = e[e.length - 1],
            i = t.getAttribute("href");
        null === i || (o.link = i), Zc(ed, t, e)
    }

    function Jg(t, e) { e[e.length - 1].extensionsNode_ = t }

    function qg(t, e) {
        var o = e[0],
            i = Jc({ flatCoordinates: [] }, od, t, e);
        if (r(i)) {
            var n = i.flatCoordinates;
            mt(i, "flatCoordinates");
            var s = new iu(null);
            return nu(s, "XYZM", n), rg(s, !1, o), (o = new Lu(s)).I(i), o
        }
    }

    function $g(t, e) {
        var o = e[0],
            i = Jc({ flatCoordinates: [], ends: [] }, rd, t, e);
        if (r(i)) {
            var n = i.flatCoordinates;
            mt(i, "flatCoordinates");
            var s = i.ends;
            mt(i, "ends");
            var p = new su(null);
            return au(p, "XYZM", n, s), rg(p, !1, o), (o = new Lu(p)).I(i), o
        }
    }

    function _g(t, e) {
        var o, i = e[0],
            n = Jc({}, pd, t, e);
        if (r(n)) return rg(o = new zi(o = zg([], t, n), "XYZM"), !1, i), (i = new Lu(o)).I(n), i
    }
    var Qg = { rte: qg, trk: $g, wpt: _g },
        td = Uc(Wg, { rte: Dc(qg), trk: Dc($g), wpt: Dc(_g) }),
        ed = Uc(Wg, { text: Gc(Lg, "linkText"), type: Gc(Lg, "linkType") }),
        od = Uc(Wg, {
            name: Gc(Lg),
            cmt: Gc(Lg),
            desc: Gc(Lg),
            src: Gc(Lg),
            link: Zg,
            number: Gc(Cg),
            extensions: Jg,
            type: Gc(Lg),
            rtept: function(t, e) {
                var o = Jc({}, id, t, e);
                r(o) && zg(e[e.length - 1].flatCoordinates, t, o)
            }
        }),
        id = Uc(Wg, { ele: Gc(jg), time: Gc(Tg) }),
        rd = Uc(Wg, {
            name: Gc(Lg),
            cmt: Gc(Lg),
            desc: Gc(Lg),
            src: Gc(Lg),
            link: Zg,
            number: Gc(Cg),
            type: Gc(Lg),
            extensions: Jg,
            trkseg: function(t, e) {
                var o = e[e.length - 1];
                Zc(nd, t, e), o.ends.push(o.flatCoordinates.length)
            }
        }),
        nd = Uc(Wg, {
            trkpt: function(t, e) {
                var o = Jc({}, sd, t, e);
                r(o) && zg(e[e.length - 1].flatCoordinates, t, o)
            }
        }),
        sd = Uc(Wg, { ele: Gc(jg), time: Gc(Tg) }),
        pd = Uc(Wg, { ele: Gc(jg), time: Gc(Tg), magvar: Gc(jg), geoidheight: Gc(jg), name: Gc(Lg), cmt: Gc(Lg), desc: Gc(Lg), src: Gc(Lg), link: Zg, sym: Gc(Lg), type: Gc(Lg), fix: Gc(Lg), sat: Gc(Cg), hdop: Gc(jg), vdop: Gc(jg), pdop: Gc(jg), ageofdgpsdata: Gc(jg), dgpsid: Gc(Cg), extensions: Jg });

    function ad(t, e) {
        null === e && (e = []);
        for (var o = 0, i = e.length; o < i; ++o) {
            var n = e[o];
            if (r(t.a)) {
                var s = n.get("extensionsNode_") || null;
                t.a(n, s)
            }
            n.set("extensionsNode_", void 0)
        }
    }

    function hd(t, e, o) { t.setAttribute("href", e), e = o[o.length - 1].properties, $c({ node: t }, cd, Hc, [e.linkText, e.linkType], o, ud) }

    function ld(t, e, o) {
        var i = o[o.length - 1],
            r = i.node.namespaceURI,
            n = i.properties;
        switch (kc(t, null, "lat", e[1]), kc(t, null, "lon", e[0]), i.geometryLayout) {
            case "XYZM":
                0 !== e[3] && (n.time = e[3]);
            case "XYZ":
                0 !== e[2] && (n.ele = e[2]);
                break;
            case "XYM":
                0 !== e[2] && (n.time = e[2])
        }
        i = Wc(n, e = md[r]), $c({ node: t, properties: n }, wd, Hc, i, o, e)
    }
    Hg.prototype.gh = function(t, e) { if (!q(Wg, t.namespaceURI)) return null; var o = Qg[t.localName]; return r(o) && r(o = o(t, [og(this, t, e)])) ? (ad(this, [o]), o) : null }, Hg.prototype.Ub = function(t, e) { if (!q(Wg, t.namespaceURI)) return []; if ("gpx" == t.localName) { var o = Jc([], td, t, [og(this, t, e)]); if (r(o)) return ad(this, o), o } return [] };
    var ud = ["text", "type"],
        cd = zc(Wg, { text: Xc(Ng), type: Xc(Ng) }),
        yd = zc(Wg, "name cmt desc src link number type rtept".split(" ")),
        fd = zc(Wg, { name: Xc(Ng), cmt: Xc(Ng), desc: Xc(Ng), src: Xc(Ng), link: Xc(hd), number: Xc(kg), type: Xc(Ng), rtept: Kc(Xc(ld)) }),
        gd = zc(Wg, "name cmt desc src link number type trkseg".split(" ")),
        dd = zc(Wg, { name: Xc(Ng), cmt: Xc(Ng), desc: Xc(Ng), src: Xc(Ng), link: Xc(hd), number: Xc(kg), type: Xc(Ng), trkseg: Kc(Xc((function(t, e, o) { $c({ node: t, geometryLayout: e.b, properties: {} }, bd, vd, e.V(), o) }))) }),
        vd = Yc("trkpt"),
        bd = zc(Wg, { trkpt: Xc(ld) }),
        md = zc(Wg, "ele time magvar geoidheight name cmt desc src link sym type fix sat hdop vdop pdop ageofdgpsdata dgpsid".split(" ")),
        wd = zc(Wg, {
            ele: Xc(Ig),
            time: Xc((function(t, e) {
                var o = (o = new Date(1e3 * e)).getUTCFullYear() + "-" + G(o.getUTCMonth() + 1) + "-" + G(o.getUTCDate()) + "T" + G(o.getUTCHours()) + ":" + G(o.getUTCMinutes()) + ":" + G(o.getUTCSeconds()) + "Z";
                t.appendChild(Tc.createTextNode(o))
            })),
            magvar: Xc(Ig),
            geoidheight: Xc(Ig),
            name: Xc(Ng),
            cmt: Xc(Ng),
            desc: Xc(Ng),
            src: Xc(Ng),
            link: Xc(hd),
            sym: Xc(Ng),
            type: Xc(Ng),
            fix: Xc(Ng),
            sat: Xc(kg),
            hdop: Xc(Ig),
            vdop: Xc(Ig),
            pdop: Xc(Ig),
            ageofdgpsdata: Xc(Ig),
            dgpsid: Xc(kg)
        }),
        Sd = { Point: "wpt", LineString: "rte", MultiLineString: "trk" };

    function xd(t, e) { var o = t.Y(); if (r(o)) return jc(e[e.length - 1].node.namespaceURI, Sd[o.U()]) }
    var Md = zc(Wg, {
        rte: Xc((function(t, e, o) {
            var i = o[0],
                n = e.P();
            t = { node: t, properties: n }, r(e = e.Y()) && (e = rg(e, !0, i), t.geometryLayout = e.b, n.rtept = e.V()), n = Wc(n, i = yd[o[o.length - 1].node.namespaceURI]), $c(t, fd, Hc, n, o, i)
        })),
        trk: Xc((function(t, e, o) {
            var i = o[0],
                n = e.P();
            t = { node: t, properties: n }, r(e = e.Y()) && (e = rg(e, !0, i), n.trkseg = e.gd()), n = Wc(n, i = gd[o[o.length - 1].node.namespaceURI]), $c(t, dd, Hc, n, o, i)
        })),
        wpt: Xc((function(t, e, o) {
            var i = o[0],
                n = o[o.length - 1];
            n.properties = e.P(), r(e = e.Y()) && (e = rg(e, !0, i), n.geometryLayout = e.b, ld(t, e.V(), o))
        }))
    });

    function Pd(t, e, o) { this.c = t, this.b = e, this.a = o }

    function Td() { this.defaultDataProjection = null }

    function jd(t) { t = r(t) ? t : {}, this.defaultDataProjection = null, this.defaultDataProjection = gi("EPSG:4326"), this.a = r(t.altitudeMode) ? t.altitudeMode : "none" }
    Hg.prototype.b = function(t, e) { e = ig(this, e); var o = jc("http://www.topografix.com/GPX/1/1", "gpx"); return $c({ node: o }, Md, xd, t, [e]), o }, A(Td, eg), (t = Td.prototype).U = function() { return "text" }, t.Eb = function(t, e) { return this.rd(c(t) ? t : "", ig(this, e)) }, t.qa = function(t, e) { return this.vf(c(t) ? t : "", ig(this, e)) }, t.Nc = function(t, e) { return this.td(c(t) ? t : "", ig(this, e)) }, t.Ga = function() { return this.defaultDataProjection }, t.xd = function(t, e) { return this.Be(t, ig(this, e)) }, t.Fb = function(t, e) { return this.Nh(t, ig(this, e)) }, t.Tc = function(t, e) { return this.yd(t, ig(this, e)) }, A(jd, Td);
    var Ad = /^B(\d{2})(\d{2})(\d{2})(\d{2})(\d{5})([NS])(\d{3})(\d{5})([EW])([AV])(\d{5})(\d{5})/,
        Cd = /^H.([A-Z]{3}).*?:(.*)/,
        Rd = /^HFDTE(\d{2})(\d{2})(\d{2})/;

    function Ld(t, e) {
        var o;
        t instanceof Ld ? (this.dc = r(e) ? e : t.dc, Ed(this, t.Vb), this.vc = t.vc, this.ub = t.ub, Id(this, t.Lc), this.pb = t.pb, kd(this, t.a.clone()), this.Zb = t.Zb) : t && (o = ic(String(t))) ? (this.dc = !!e, Ed(this, o[1] || "", !0), this.vc = Dd(o[2] || ""), this.ub = Dd(o[3] || "", !0), Id(this, o[4]), this.pb = Dd(o[5] || "", !0), kd(this, o[6] || "", !0), this.Zb = Dd(o[7] || "")) : (this.dc = !!e, this.a = new Vd(null, 0, this.dc))
    }

    function Ed(t, e, o) { t.Vb = o ? Dd(e, !0) : e, t.Vb && (t.Vb = t.Vb.replace(/:$/, "")) }

    function Id(t, e) {
        if (e) {
            if (e = Number(e), isNaN(e) || 0 > e) throw Error("Bad port number " + e);
            t.Lc = e
        } else t.Lc = null
    }

    function kd(t, e, o) {
        e instanceof Vd ? (t.a = e, function(t, e) {
            e && !t.b && (Hd(t), t.a = null, t.pa.forEach((function(t, e) {
                var o = e.toLowerCase();
                e != o && (this.remove(e), zd(this, o, t))
            }), t)), t.b = e
        }(t.a, t.dc)) : (o || (e = Od(e, Kd)), t.a = new Vd(e, 0, t.dc))
    }

    function Nd(t) { return t instanceof Ld ? t.clone() : new Ld(t, void 0) }

    function Fd(t, e) {
        t instanceof Ld || (t = Nd(t)), e instanceof Ld || (e = Nd(e));
        var o = e,
            i = (s = t).clone(),
            r = !!o.Vb;
        r ? Ed(i, o.Vb) : r = !!o.vc, r ? i.vc = o.vc : r = !!o.ub, r ? i.ub = o.ub : r = null != o.Lc;
        var n = o.pb;
        if (r) Id(i, o.Lc);
        else if (r = !!o.pb)
            if ("/" != n.charAt(0) && (s.ub && !s.pb ? n = "/" + n : -1 != (s = i.pb.lastIndexOf("/")) && (n = i.pb.substr(0, s + 1) + n)), ".." == (s = n) || "." == s) n = "";
            else if (-1 != s.indexOf("./") || -1 != s.indexOf("/.")) {
            n = 0 == s.lastIndexOf("/", 0);
            for (var s = s.split("/"), p = [], a = 0; a < s.length;) { var h = s[a++]; "." == h ? n && a == s.length && p.push("") : ".." == h ? ((1 < p.length || 1 == p.length && "" != p[0]) && p.pop(), n && a == s.length && p.push("")) : (p.push(h), n = !0) }
            n = p.join("/")
        } else n = s;
        return r ? i.pb = n : r = "" !== o.a.toString(), r ? kd(i, Dd(o.a.toString())) : r = !!o.Zb, r && (i.Zb = o.Zb), i
    }

    function Dd(t, e) { return t ? e ? decodeURI(t) : decodeURIComponent(t) : "" }

    function Od(t, e, o) { return c(t) ? (t = encodeURI(t).replace(e, Bd), o && (t = t.replace(/%25([0-9a-fA-F]{2})/g, "%$1")), t) : null }

    function Bd(t) { return "%" + ((t = t.charCodeAt(0)) >> 4 & 15).toString(16) + (15 & t).toString(16) }
    jd.prototype.rd = function(t, e) {
        var o, i, r = this.a,
            n = function(t) { return z(t = function(t) { for (var e, o = RegExp("\r\n|\r|\n", "g"), i = 0, r = []; e = o.exec(t);) i = new Pd(t, i, e.index), r.push(i), i = o.lastIndex; return i < t.length && (i = new Pd(t, i, t.length), r.push(i)), r }(t), (function(t) { return t.c.substring(t.b, t.a) })) }(t),
            s = {},
            p = [],
            a = 2e3,
            h = 0,
            l = 1;
        for (o = 0, i = n.length; o < i; ++o) {
            var u;
            if ("B" == (c = n[o]).charAt(0)) {
                if (u = Ad.exec(c)) {
                    var c = parseInt(u[1], 10),
                        y = parseInt(u[2], 10),
                        f = parseInt(u[3], 10),
                        g = parseInt(u[4], 10) + parseInt(u[5], 10) / 6e4;
                    "S" == u[6] && (g = -g);
                    var d = parseInt(u[7], 10) + parseInt(u[8], 10) / 6e4;
                    "W" == u[9] && (d = -d), p.push(d, g), "none" != r && p.push("gps" == r ? parseInt(u[11], 10) : "barometric" == r ? parseInt(u[12], 10) : 0), p.push(Date.UTC(a, h, l, c, y, f) / 1e3)
                }
            } else "H" == c.charAt(0) && ((u = Rd.exec(c)) ? (l = parseInt(u[1], 10), h = parseInt(u[2], 10) - 1, a = 2e3 + parseInt(u[3], 10)) : (u = Cd.exec(c)) && (s[u[1]] = L(u[2]), Rd.exec(c)))
        }
        return 0 === p.length ? null : (nu(n = new iu(null), "none" == r ? "XYM" : "XYZM", p), (r = new Lu(rg(n, !1, e))).I(s), r)
    }, jd.prototype.vf = function(t, e) { var o = this.rd(t, e); return null === o ? [] : [o] }, (t = Ld.prototype).Vb = "", t.vc = "", t.ub = "", t.Lc = null, t.pb = "", t.Zb = "", t.dc = !1, t.toString = function() {
        var t = [],
            e = this.Vb;
        if (e && t.push(Od(e, Gd, !0), ":"), e = this.ub) {
            t.push("//");
            var o = this.vc;
            o && t.push(Od(o, Gd, !0), "@"), t.push(encodeURIComponent(String(e)).replace(/%25([0-9a-fA-F]{2})/g, "%$1")), null != (e = this.Lc) && t.push(":", String(e))
        }
        return (e = this.pb) && (this.ub && "/" != e.charAt(0) && t.push("/"), t.push(Od(e, "/" == e.charAt(0) ? Xd : Ud, !0))), (e = this.a.toString()) && t.push("?", e), (e = this.Zb) && t.push("#", Od(e, Yd)), t.join("")
    }, t.clone = function() { return new Ld(this) };
    var Gd = /[#\/\?@]/g,
        Ud = /[\#\?:]/g,
        Xd = /[\#\?]/g,
        Kd = /[\#\?@]/g,
        Yd = /#/g;

    function Vd(t, e, o) { this.a = t || null, this.b = !!o }

    function Hd(t) {
        t.pa || (t.pa = new Os, t.Aa = 0, t.a && function(t, e) {
            for (var o = t.split("&"), i = 0; i < o.length; i++) {
                var r = o[i].indexOf("="),
                    n = null,
                    s = null;
                0 <= r ? (n = o[i].substring(0, r), s = o[i].substring(r + 1)) : n = o[i], e(n, s ? decodeURIComponent(s.replace(/\+/g, " ")) : "")
            }
        }(t.a, (function(e, o) { t.add(decodeURIComponent(e.replace(/\+/g, " ")), o) })))
    }

    function Wd(t, e) { return Hd(t), e = Zd(t, e), Gs(t.pa.b, e) }

    function zd(t, e, o) { t.remove(e), 0 < o.length && (t.a = null, t.pa.set(Zd(t, e), Q(o)), t.Aa += o.length) }

    function Zd(t, e) { var o = String(e); return t.b && (o = o.toLowerCase()), o }

    function Jd(t) { t = r(t) ? t : {}, this.f = t.font, this.g = t.rotation, this.b = t.scale, this.c = t.text, this.j = t.textAlign, this.l = t.textBaseline, this.a = r(t.fill) ? t.fill : null, this.i = r(t.stroke) ? t.stroke : null, this.B = r(t.offsetX) ? t.offsetX : 0, this.v = r(t.offsetY) ? t.offsetY : 0 }

    function qd(t) {
        t = r(t) ? t : {}, this.defaultDataProjection = null, this.defaultDataProjection = gi("EPSG:4326");
        var e = r(t.defaultStyle) ? t.defaultStyle : sv,
            o = {};
        this.c = !r(t.extractStyles) || t.extractStyles, this.a = o, this.f = function() { var t = this.get("Style"); return r(t) ? t : r(t = this.get("styleUrl")) ? function t(i) { return l(i) ? i : c(i) ? (!(i in o) && "#" + i in o && (i = "#" + i), t(o[i])) : e }(t) : e }
    }(t = Vd.prototype).pa = null, t.Aa = null, t.$b = function() { return Hd(this), this.Aa }, t.add = function(t, e) { Hd(this), this.a = null, t = Zd(this, t); var o = this.pa.get(t); return o || this.pa.set(t, o = []), o.push(e), this.Aa++, this }, t.remove = function(t) { return Hd(this), t = Zd(this, t), !!Gs(this.pa.b, t) && (this.a = null, this.Aa -= this.pa.get(t).length, this.pa.remove(t)) }, t.clear = function() { this.pa = this.a = null, this.Aa = 0 }, t.wa = function() { return Hd(this), 0 == this.Aa }, t.O = function() {
        Hd(this);
        for (var t = this.pa.lb(), e = this.pa.O(), o = [], i = 0; i < e.length; i++)
            for (var r = t[i], n = 0; n < r.length; n++) o.push(e[i]);
        return o
    }, t.lb = function(t) {
        Hd(this);
        var e = [];
        if (c(t)) Wd(this, t) && (e = _(e, this.pa.get(Zd(this, t))));
        else { t = this.pa.lb(); for (var o = 0; o < t.length; o++) e = _(e, t[o]) }
        return e
    }, t.set = function(t, e) { return Hd(this), this.a = null, Wd(this, t = Zd(this, t)) && (this.Aa -= this.pa.get(t).length), this.pa.set(t, [e]), this.Aa++, this }, t.get = function(t, e) { var o = t ? this.lb(t) : []; return 0 < o.length ? String(o[0]) : e }, t.toString = function() {
        if (this.a) return this.a;
        if (!this.pa) return "";
        for (var t = [], e = this.pa.O(), o = 0; o < e.length; o++)
            for (var i = e[o], r = encodeURIComponent(String(i)), n = (i = this.lb(i), 0); n < i.length; n++) { var s = r; "" !== i[n] && (s += "=" + encodeURIComponent(String(i[n]))), t.push(s) }
        return this.a = t.join("&")
    }, t.clone = function() { var t = new Vd; return t.a = this.a, this.pa && (t.pa = this.pa.clone(), t.Aa = this.Aa), t }, (t = Jd.prototype).$i = function() { return this.f }, t.pj = function() { return this.B }, t.qj = function() { return this.v }, t.Nm = function() { return this.a }, t.Om = function() { return this.g }, t.Pm = function() { return this.b }, t.Qm = function() { return this.i }, t.Rm = function() { return this.c }, t.Aj = function() { return this.j }, t.Bj = function() { return this.l }, t.Tn = function(t) { this.f = t }, t.Sn = function(t) { this.a = t }, t.Sm = function(t) { this.g = t }, t.Tm = function(t) { this.b = t }, t.ao = function(t) { this.i = t }, t.bo = function(t) { this.c = t }, t.co = function(t) { this.j = t }, t.eo = function(t) { this.l = t }, A(qd, mg);
    var $d = ["http://www.google.com/kml/ext/2.2"],
        _d = [null, "http://earth.google.com/kml/2.0", "http://earth.google.com/kml/2.1", "http://earth.google.com/kml/2.2", "http://www.opengis.net/kml/2.2"],
        Qd = [255, 255, 255, 1],
        tv = new Eh({ color: Qd }),
        ev = [20, 2],
        ov = [64, 64],
        iv = new Ea({ anchor: ev, anchorOrigin: "bottom-left", anchorXUnits: "pixels", anchorYUnits: "pixels", crossOrigin: "anonymous", rotation: 0, scale: .5, size: ov, src: "https://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png" }),
        rv = new Ah({ color: Qd, width: 1 }),
        nv = new Jd({ font: "normal 16px Helvetica", fill: tv, stroke: rv, scale: 1 }),
        sv = [new kh({ fill: tv, image: iv, text: nv, stroke: rv, zIndex: 0 })],
        pv = { fraction: "fraction", pixels: "pixels" };

    function av(t) { if (t = Ac(t, !1), t = /^\s*#?\s*([0-9A-Fa-f]{8})\s*$/.exec(t)) return t = t[1], [parseInt(t.substr(6, 2), 16), parseInt(t.substr(4, 2), 16), parseInt(t.substr(2, 2), 16), parseInt(t.substr(0, 2), 16) / 255] }

    function hv(t) { t = Ac(t, !1); for (var e, o = [], i = /^\s*([+\-]?\d*\.?\d+(?:e[+\-]?\d+)?)\s*,\s*([+\-]?\d*\.?\d+(?:e[+\-]?\d+)?)(?:\s*,\s*([+\-]?\d*\.?\d+(?:e[+\-]?\d+)?))?\s*/i; e = i.exec(t);) o.push(parseFloat(e[1]), parseFloat(e[2]), e[3] ? parseFloat(e[3]) : 0), t = t.substr(e[0].length); return "" !== t ? void 0 : o }

    function lv(t) { var e = Ac(t, !1); return null != t.baseURI ? Fd(t.baseURI, L(e)).toString() : L(e) }

    function uv(t) { if (r(t = jg(t))) return Math.sqrt(t) }

    function cv(t, e) { return Jc(null, Tv, t, e) }

    function yv(t, e) {
        if (r(s = Jc({ o: [], Lh: [] }, Av, t, e))) {
            var o, i, n = s.o,
                s = s.Lh;
            for (o = 0, i = Math.min(n.length, s.length); o < i; ++o) n[4 * o + 3] = s[o];
            return nu(s = new iu(null), "XYZM", n), s
        }
    }

    function fv(t, e) {
        var o = Jc({}, Pv, t, e),
            i = Jc(null, Cv, t, e);
        if (r(i)) { var n = new iu(null); return nu(n, "XYZ", i), n.I(o), n }
    }

    function gv(t, e) {
        var o = Jc({}, Pv, t, e),
            i = Jc(null, Cv, t, e);
        if (r(i)) { var n = new sr(null); return hr(n, "XYZ", i, [i.length]), n.I(o), n }
    }

    function dv(t, e) {
        var o = Jc([], Nv, t, e);
        if (!r(o)) return null;
        if (0 === o.length) return new $l(o);
        var i, n, s, p = !0,
            a = o[0].U();
        for (n = 1, s = o.length; n < s; ++n)
            if ((i = o[n]).U() != a) { p = !1; break }
        if (p) { if ("Point" == a) { for (p = (i = o[0]).b, a = i.o, n = 1, s = o.length; n < s; ++n) tt(a, (i = o[n]).o); return Ai(i = new lu(null), p, a), i.s(), wv(i, o), i } return "LineString" == a ? (hu(i = new su(null), o), wv(i, o), i) : "Polygon" == a ? (gu(i = new uu(null), o), wv(i, o), i) : "GeometryCollection" == a ? new $l(o) : null }
        return new $l(o)
    }

    function vv(t, e) {
        var o = Jc({}, Pv, t, e),
            i = Jc(null, Cv, t, e);
        if (null != i) { var r = new zi(null); return Zi(r, "XYZ", i), r.I(o), r }
    }

    function bv(t, e) {
        var o = Jc({}, Pv, t, e),
            i = Jc([null], jv, t, e);
        if (null != i && null !== i[0]) {
            var r, n, s = new sr(null),
                p = i[0],
                a = [p.length];
            for (r = 1, n = i.length; r < n; ++r) tt(p, i[r]), a.push(p.length);
            return hr(s, "XYZ", p, a), s.I(o), s
        }
    }

    function mv(t, e) {
        if (!r(i = Jc({}, Yv, t, e))) return null;
        var o = wt(i, "fillStyle", tv);
        r(n = i.fill) && !n && (o = null);
        var i, n = wt(i, "imageStyle", iv),
            s = wt(i, "textStyle", nv),
            p = wt(i, "strokeStyle", rv);
        return r(i = i.outline) && !i && (p = null), [new kh({ fill: o, image: n, stroke: p, text: s, zIndex: void 0 })]
    }

    function wv(t, e) {
        var o, i, n, s, p = e.length,
            a = Array(e.length),
            h = Array(e.length);
        for (n = s = !1, i = 0; i < p; ++i) o = e[i], a[i] = o.get("extrude"), h[i] = o.get("altitudeMode"), n = n || r(a[i]), s = s || r(h[i]);
        n && t.set("extrude", a), s && t.set("altitudeMode", h)
    }

    function Sv(t, e) { Zc(Mv, t, e) }
    var xv = Uc(_d, { value: Oc(Lg) }),
        Mv = Uc(_d, {
            Data: function(t, e) {
                var o = t.getAttribute("name");
                if (null !== o) {
                    var i = Jc(void 0, xv, t, e);
                    r(i) && (e[e.length - 1][o] = i)
                }
            },
            SchemaData: function(t, e) { Zc(Kv, t, e) }
        }),
        Pv = Uc(_d, { extrude: Gc(Mg), altitudeMode: Gc(Lg) }),
        Tv = Uc(_d, { coordinates: Oc(hv) }),
        jv = Uc(_d, {
            innerBoundaryIs: function(t, e) {
                var o = Jc(void 0, Ev, t, e);
                r(o) && e[e.length - 1].push(o)
            },
            outerBoundaryIs: function(t, e) {
                var o = Jc(void 0, Bv, t, e);
                r(o) && (e[e.length - 1][0] = o)
            }
        }),
        Av = Uc(_d, {
            when: function(t, e) {
                var o = e[e.length - 1].Lh,
                    i = Ac(t, !1);
                if (i = /^\s*(\d{4})($|-(\d{2})($|-(\d{2})($|T(\d{2}):(\d{2}):(\d{2})(Z|(?:([+\-])(\d{2})(?::(\d{2}))?)))))\s*$/.exec(i)) {
                    var n = Date.UTC(parseInt(i[1], 10), r(i[3]) ? parseInt(i[3], 10) - 1 : 0, r(i[5]) ? parseInt(i[5], 10) : 1, r(i[7]) ? parseInt(i[7], 10) : 0, r(i[8]) ? parseInt(i[8], 10) : 0, r(i[9]) ? parseInt(i[9], 10) : 0);
                    if (r(i[10]) && "Z" != i[10]) {
                        var s = "-" == i[11] ? -1 : 1;
                        n += 60 * s * parseInt(i[12], 10), r(i[13]) && (n += 3600 * s * parseInt(i[13], 10))
                    }
                    o.push(n)
                } else o.push(0)
            }
        }, Uc($d, {
            coord: function(t, e) {
                var o = e[e.length - 1].o,
                    i = Ac(t, !1);
                (i = /^\s*([+\-]?\d+(?:\.\d*)?(?:e[+\-]?\d*)?)\s+([+\-]?\d+(?:\.\d*)?(?:e[+\-]?\d*)?)\s+([+\-]?\d+(?:\.\d*)?(?:e[+\-]?\d*)?)\s*$/i.exec(i)) ? o.push(parseFloat(i[1]), parseFloat(i[2]), parseFloat(i[3]), 0): o.push(0, 0, 0, 0)
            }
        })),
        Cv = Uc(_d, { coordinates: Oc(hv) }),
        Rv = Uc(_d, { href: Gc(lv) }, Uc($d, { x: Gc(jg), y: Gc(jg), w: Gc(jg), h: Gc(jg) })),
        Lv = Uc(_d, {
            Icon: Gc((function(t, e) { var o = Jc({}, Rv, t, e); return r(o) ? o : null })),
            heading: Gc(jg),
            hotSpot: Gc((function(t) {
                var e = t.getAttribute("xunits"),
                    o = t.getAttribute("yunits");
                return { x: parseFloat(t.getAttribute("x")), Gf: pv[e], y: parseFloat(t.getAttribute("y")), Hf: pv[o] }
            })),
            scale: Gc(uv)
        }),
        Ev = Uc(_d, { LinearRing: Oc(cv) }),
        Iv = Uc(_d, { color: Gc(av), scale: Gc(uv) }),
        kv = Uc(_d, { color: Gc(av), width: Gc(jg) }),
        Nv = Uc(_d, { LineString: Dc(fv), LinearRing: Dc(gv), MultiGeometry: Dc(dv), Point: Dc(vv), Polygon: Dc(bv) }),
        Fv = Uc($d, { Track: Dc(yv) }),
        Dv = Uc(_d, { ExtendedData: Sv, Link: function(t, e) { Zc(Ov, t, e) }, address: Gc(Lg), description: Gc(Lg), name: Gc(Lg), open: Gc(Mg), phoneNumber: Gc(Lg), visibility: Gc(Mg) }),
        Ov = Uc(_d, { href: Gc(lv) }),
        Bv = Uc(_d, { LinearRing: Oc(cv) }),
        Gv = Uc(_d, { Style: Gc(mv), key: Gc(Lg), styleUrl: Gc((function(t) { var e = L(Ac(t, !1)); return null != t.baseURI ? Fd(t.baseURI, e).toString() : e })) }),
        Uv = Uc(_d, {
            ExtendedData: Sv,
            MultiGeometry: Gc(dv, "geometry"),
            LineString: Gc(fv, "geometry"),
            LinearRing: Gc(gv, "geometry"),
            Point: Gc(vv, "geometry"),
            Polygon: Gc(bv, "geometry"),
            Style: Gc(mv),
            StyleMap: function(t, e) {
                var o = Jc(void 0, Vv, t, e);
                if (r(o)) {
                    var i = e[e.length - 1];
                    l(o) ? i.Style = o : c(o) && (i.styleUrl = o)
                }
            },
            address: Gc(Lg),
            description: Gc(Lg),
            name: Gc(Lg),
            open: Gc(Mg),
            phoneNumber: Gc(Lg),
            styleUrl: Gc(lv),
            visibility: Gc(Mg)
        }, Uc($d, { MultiTrack: Gc((function(t, e) { var o = Jc([], Fv, t, e); if (r(o)) { var i = new su(null); return hu(i, o), i } }), "geometry"), Track: Gc(yv, "geometry") })),
        Xv = Uc(_d, { color: Gc(av), fill: Gc(Mg), outline: Gc(Mg) }),
        Kv = Uc(_d, {
            SimpleData: function(t, e) {
                var o = t.getAttribute("name");
                if (null !== o) {
                    var i = Lg(t);
                    e[e.length - 1][o] = i
                }
            }
        }),
        Yv = Uc(_d, {
            IconStyle: function(t, e) {
                var o = Jc({}, Lv, t, e);
                if (r(o)) {
                    var i, n, s, p, a = e[e.length - 1];
                    i = r(i = (f = wt(o, "Icon", {})).href) ? i : "https://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png", r(l = o.hotSpot) ? (n = [l.x, l.y], s = l.Gf, p = l.Hf) : "https://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png" === i ? (n = ev, p = s = "pixels") : /^http:\/\/maps\.(?:google|gstatic)\.com\//.test(i) && (n = [.5, 0], p = s = "fraction");
                    var h, l = f.x,
                        u = f.y;
                    r(l) && r(u) && (h = [l, u]), l = f.w;
                    var c, y, f = f.h;
                    r(l) && r(f) && (c = [l, f]), r(f = o.heading) && (y = Vt(f)), o = o.scale, "https://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png" == i && (c = ov), n = new Ea({ anchor: n, anchorOrigin: "bottom-left", anchorXUnits: s, anchorYUnits: p, crossOrigin: "anonymous", offset: h, offsetOrigin: "bottom-left", rotation: y, scale: o, size: c, src: i }), a.imageStyle = n
                }
            },
            LabelStyle: function(t, e) {
                var o = Jc({}, Iv, t, e);
                r(o) && (e[e.length - 1].textStyle = new Jd({ fill: new Eh({ color: wt(o, "color", Qd) }), scale: o.scale }))
            },
            LineStyle: function(t, e) {
                var o = Jc({}, kv, t, e);
                r(o) && (e[e.length - 1].strokeStyle = new Ah({ color: wt(o, "color", Qd), width: wt(o, "width", 1) }))
            },
            PolyStyle: function(t, e) {
                var o = Jc({}, Xv, t, e);
                if (r(o)) {
                    var i = e[e.length - 1];
                    i.fillStyle = new Eh({ color: wt(o, "color", Qd) });
                    var n = o.fill;
                    r(n) && (i.fill = n), r(o = o.outline) && (i.outline = o)
                }
            }
        }),
        Vv = Uc(_d, {
            Pair: function(t, e) {
                var o = Jc({}, Gv, t, e);
                if (r(o)) {
                    var i = o.key;
                    r(i) && "normal" == i && (r(i = o.styleUrl) && (e[e.length - 1] = i), r(o = o.Style) && (e[e.length - 1] = o))
                }
            }
        });

    function Hv(t, e) {
        var o;
        for (o = e.firstChild; null !== o; o = o.nextSibling)
            if (1 == o.nodeType) { var i = Wv(t, o); if (r(i)) return i }
    }

    function Wv(t, e) {
        var o;
        for (o = e.firstElementChild; null !== o; o = o.nextElementSibling)
            if (q(_d, o.namespaceURI) && "name" == o.localName) return Lg(o);
        for (o = e.firstElementChild; null !== o; o = o.nextElementSibling) { var i = Cc(o); if (q(_d, o.namespaceURI) && ("Document" == i || "Folder" == i || "Placemark" == i || "kml" == i) && r(i = Wv(t, o))) return i }
    }

    function zv(t, e) { var o, i = []; for (o = e.firstChild; null !== o; o = o.nextSibling) 1 == o.nodeType && tt(i, Zv(t, o)); return i }

    function Zv(t, e) {
        var o, i = [];
        for (o = e.firstElementChild; null !== o; o = o.nextElementSibling)
            if (q(_d, o.namespaceURI) && "NetworkLink" == o.localName) {
                var r = Jc({}, Dv, o, []);
                i.push(r)
            }
        for (o = e.firstElementChild; null !== o; o = o.nextElementSibling) r = Cc(o), !q(_d, o.namespaceURI) || "Document" != r && "Folder" != r && "kml" != r || tt(i, Zv(t, o));
        return i
    }

    function Jv(t, e) {
        var o, i = [255 * (4 == (i = Xr(e)).length ? i[3] : 1), i[2], i[1], i[0]];
        for (o = 0; 4 > o; ++o) {
            var r = parseInt(i[o], 10).toString(16);
            i[o] = 1 == r.length ? "0" + r : r
        }
        Ng(t, i.join(""))
    }

    function qv(t, e, o) { $c({ node: t }, yb, Lb, [e], o) }

    function $v(t, e, o) {
        var i = { node: t };
        null != e.ha && t.setAttribute("id", e.ha), t = e.P();
        var n = e.c;
        r(n) && null !== (n = n.call(e, 0)) && 0 < n.length && (t.Style = n[0], null === (n = n[0].b) || (t.name = n.c)), t = Wc(t, n = gb[o[o.length - 1].node.namespaceURI]), $c(i, db, Hc, t, o, n), t = o[0], null != (e = e.Y()) && (e = rg(e, !0, t)), $c(i, db, Pb, [e], o)
    }

    function _v(t, e, o) {
        var i = e.o;
        (t = { node: t }).layout = e.b, t.stride = e.H, $c(t, vb, jb, [i], o)
    }

    function Qv(t, e, o) {
        var i = (e = e.Md()).shift();
        $c(t = { node: t }, bb, Ab, e, o), $c(t, bb, Ib, [i], o)
    }

    function tb(t, e) { Ig(t, e * e) }(t = qd.prototype).fh = function(t, e) { var o; if (Cc(t), r(o = Jc([], o = Uc(_d, { Folder: Fc(this.fh, this), Placemark: Dc(this.xf, this), Style: S(this.Gn, this), StyleMap: S(this.Fn, this) }), t, e, this))) return o }, t.xf = function(t, e) {
        var o = Jc({ geometry: null }, Uv, t, e);
        if (r(o)) {
            var i = new Lu,
                n = t.getAttribute("id");
            return null === n || i.Wb(n), n = e[0], null != o.geometry && rg(o.geometry, !1, n), i.I(o), this.c && i.hf(this.f), i
        }
    }, t.Gn = function(t, e) {
        var o = t.getAttribute("id");
        if (null !== o) {
            var i = mv(t, e);
            r(i) && (o = null != t.baseURI ? Fd(t.baseURI, "#" + o).toString() : "#" + o, this.a[o] = i)
        }
    }, t.Fn = function(t, e) {
        var o = t.getAttribute("id");
        if (null !== o) {
            var i = Jc(void 0, Vv, t, e);
            r(i) && (o = null != t.baseURI ? Fd(t.baseURI, "#" + o).toString() : "#" + o, this.a[o] = i)
        }
    }, t.gh = function(t, e) { if (!q(_d, t.namespaceURI)) return null; var o = this.xf(t, [og(this, t, e)]); return r(o) ? o : null }, t.Ub = function(t, e) {
        if (!q(_d, t.namespaceURI)) return [];
        var o;
        if ("Document" == (o = Cc(t)) || "Folder" == o) return r(o = this.fh(t, [og(this, t, e)])) ? o : [];
        if ("Placemark" == o) return r(o = this.xf(t, [og(this, t, e)])) ? [o] : [];
        if ("kml" == o) {
            var i;
            for (o = [], i = t.firstElementChild; null !== i; i = i.nextElementSibling) {
                var n = this.Ub(i, e);
                r(n) && tt(o, n)
            }
            return o
        }
        return []
    }, t.An = function(t) { return Rc(t) ? Hv(this, t) : Lc(t) ? Wv(this, t) : c(t) ? Hv(this, t = Nc(t)) : void 0 }, t.Bn = function(t) { var e = []; return Rc(t) ? tt(e, zv(this, t)) : Lc(t) ? tt(e, Zv(this, t)) : c(t) && tt(e, zv(this, t = Nc(t))), e };
    var eb = zc(_d, ["Document", "Placemark"]),
        ob = zc(_d, { Document: Xc((function(t, e, o) { $c({ node: t }, ib, Mb, e, o) })), Placemark: Xc($v) }),
        ib = zc(_d, { Placemark: Xc($v) }),
        rb = { Point: "Point", LineString: "LineString", LinearRing: "LinearRing", Polygon: "Polygon", MultiPoint: "MultiGeometry", MultiLineString: "MultiGeometry", MultiPolygon: "MultiGeometry" },
        nb = zc(_d, ["href"], zc($d, ["x", "y", "w", "h"])),
        sb = zc(_d, { href: Xc(Ng) }, zc($d, { x: Xc(Ig), y: Xc(Ig), w: Xc(Ig), h: Xc(Ig) })),
        pb = zc(_d, ["scale", "heading", "Icon", "hotSpot"]),
        ab = zc(_d, {
            Icon: Xc((function(t, e, o) {
                t = { node: t };
                var i = nb[o[o.length - 1].node.namespaceURI],
                    r = Wc(e, i);
                $c(t, sb, Hc, r, o, i), r = Wc(e, i = nb[$d[0]]), $c(t, sb, xb, r, o, i)
            })),
            heading: Xc(Ig),
            hotSpot: Xc((function(t, e) { t.setAttribute("x", e.x), t.setAttribute("y", e.y), t.setAttribute("xunits", e.Gf), t.setAttribute("yunits", e.Hf) })),
            scale: Xc(tb)
        }),
        hb = zc(_d, ["color", "scale"]),
        lb = zc(_d, { color: Xc(Jv), scale: Xc(tb) }),
        ub = zc(_d, ["color", "width"]),
        cb = zc(_d, { color: Xc(Jv), width: Xc(Ig) }),
        yb = zc(_d, { LinearRing: Xc(_v) }),
        fb = zc(_d, { LineString: Xc(_v), Point: Xc(_v), Polygon: Xc(Qv) }),
        gb = zc(_d, "name open visibility address phoneNumber description styleUrl Style".split(" ")),
        db = zc(_d, {
            MultiGeometry: Xc((function(t, e, o) { t = { node: t }; var i, r, n = e.U(); "MultiPoint" == n ? (i = e.ge(), r = Cb) : "MultiLineString" == n ? (i = e.gd(), r = Rb) : "MultiPolygon" == n && (i = e.Od(), r = Eb), $c(t, fb, r, i, o) })),
            LineString: Xc(_v),
            LinearRing: Xc(_v),
            Point: Xc(_v),
            Polygon: Xc(Qv),
            Style: Xc((function(t, e, o) {
                t = { node: t };
                var i = {},
                    r = e.f,
                    n = e.c,
                    s = e.i;
                e = e.b, null === s || (i.IconStyle = s), null === e || (i.LabelStyle = e), null === n || (i.LineStyle = n), null === r || (i.PolyStyle = r), i = Wc(i, e = wb[o[o.length - 1].node.namespaceURI]), $c(t, Sb, Hc, i, o, e)
            })),
            address: Xc(Ng),
            description: Xc(Ng),
            name: Xc(Ng),
            open: Xc(Eg),
            phoneNumber: Xc(Ng),
            styleUrl: Xc(Ng),
            visibility: Xc(Eg)
        }),
        vb = zc(_d, {
            coordinates: Xc((function(t, e, o) {
                var i, r = (o = o[o.length - 1]).layout;
                o = o.stride, "XY" == r || "XYM" == r ? i = 2 : ("XYZ" == r || "XYZM" == r) && (i = 3);
                var n, s = e.length,
                    p = "";
                if (0 < s) {
                    for (p += e[0], r = 1; r < i; ++r) p += "," + e[r];
                    for (n = o; n < s; n += o)
                        for (p += " " + e[n], r = 1; r < i; ++r) p += "," + e[n + r]
                }
                Ng(t, p)
            }))
        }),
        bb = zc(_d, { outerBoundaryIs: Xc(qv), innerBoundaryIs: Xc(qv) }),
        mb = zc(_d, { color: Xc(Jv) }),
        wb = zc(_d, ["IconStyle", "LabelStyle", "LineStyle", "PolyStyle"]),
        Sb = zc(_d, {
            IconStyle: Xc((function(t, e, o) {
                t = { node: t };
                var i = {},
                    r = e.fb(),
                    n = e.Ld(),
                    s = { href: e.a.i };
                if (null !== r) {
                    s.w = r[0], s.h = r[1];
                    var p = e.yb(),
                        a = e.Db();
                    null !== a && null !== n && 0 !== a[0] && a[1] !== r[1] && (s.x = a[0], s.y = n[1] - (a[1] + r[1])), null === p || 0 === p[0] || p[1] === r[1] || (i.hotSpot = { x: p[0], Gf: "pixels", y: r[1] - p[1], Hf: "pixels" })
                }
                i.Icon = s, 1 !== (r = e.v) && (i.scale = r), 0 !== (e = e.B) && (i.heading = e), i = Wc(i, e = pb[o[o.length - 1].node.namespaceURI]), $c(t, ab, Hc, i, o, e)
            })),
            LabelStyle: Xc((function(t, e, o) {
                t = { node: t };
                var i = {},
                    n = e.a;
                null === n || (i.color = n.a), r(e = e.b) && 1 !== e && (i.scale = e), i = Wc(i, e = hb[o[o.length - 1].node.namespaceURI]), $c(t, lb, Hc, i, o, e)
            })),
            LineStyle: Xc((function(t, e, o) {
                t = { node: t };
                var i = ub[o[o.length - 1].node.namespaceURI];
                e = Wc({ color: e.a, width: e.b }, i), $c(t, cb, Hc, e, o, i)
            })),
            PolyStyle: Xc((function(t, e, o) { $c({ node: t }, mb, Tb, [e.a], o) }))
        });

    function xb(t, e, o) { return jc($d[0], "gx:" + o) }

    function Mb(t, e) { return jc(e[e.length - 1].node.namespaceURI, "Placemark") }

    function Pb(t, e) { if (null != t) return jc(e[e.length - 1].node.namespaceURI, rb[t.U()]) }
    var Tb = Yc("color"),
        jb = Yc("coordinates"),
        Ab = Yc("innerBoundaryIs"),
        Cb = Yc("Point"),
        Rb = Yc("LineString"),
        Lb = Yc("LinearRing"),
        Eb = Yc("Polygon"),
        Ib = Yc("outerBoundaryIs");

    function kb() { this.defaultDataProjection = null, this.defaultDataProjection = gi("EPSG:4326") }

    function Nb(t, e) { e[e.length - 1].vd[t.getAttribute("k")] = t.getAttribute("v") }
    qd.prototype.b = function(t, e) {
        e = ig(this, e);
        var o = jc(_d[4], "kml");
        kc(o, "http://www.w3.org/2000/xmlns/", "xmlns:gx", $d[0]), kc(o, "http://www.w3.org/2000/xmlns/", "xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance"), kc(o, "http://www.w3.org/2001/XMLSchema-instance", "xsi:schemaLocation", "http://www.opengis.net/kml/2.2 https://developers.google.com/kml/schema/kml22gx.xsd");
        var i = { node: o },
            r = {};
        1 < t.length ? r.Document = t : 1 == t.length && (r.Placemark = t[0]);
        var n = eb[o.namespaceURI];
        return r = Wc(r, n), $c(i, ob, Hc, r, [e], n), o
    }, A(kb, mg);
    var Fb = [null],
        Db = Uc(Fb, { nd: function(t, e) { e[e.length - 1].Fc.push(t.getAttribute("ref")) }, tag: Nb }),
        Ob = Uc(Fb, {
            node: function(t, e) {
                var o = e[0],
                    i = e[e.length - 1],
                    r = t.getAttribute("id"),
                    n = [parseFloat(t.getAttribute("lon")), parseFloat(t.getAttribute("lat"))];
                i.wg[r] = n;
                var s = Jc({ vd: {} }, Bb, t, e);
                vt(s.vd) || (rg(n = new zi(n), !1, o), (o = new Lu(n)).Wb(r), o.I(s.vd), i.features.push(o))
            },
            way: function(t, e) {
                for (var o = e[0], i = t.getAttribute("id"), r = Jc({ Fc: [], vd: {} }, Db, t, e), n = e[e.length - 1], s = [], p = 0, a = r.Fc.length; p < a; p++) tt(s, n.wg[r.Fc[p]]);
                r.Fc[0] == r.Fc[r.Fc.length - 1] ? hr(p = new sr(null), "XY", s, [s.length]) : nu(p = new iu(null), "XY", s), rg(p, !1, o), (o = new Lu(p)).Wb(i), o.I(r.vd), n.features.push(o)
            }
        }),
        Bb = Uc(Fb, { tag: Nb });

    function Gb(t) { return t.getAttributeNS("http://www.w3.org/1999/xlink", "href") }

    function Ub() {}

    function Xb() {}
    kb.prototype.Ub = function(t, e) { var o = og(this, t, e); return "osm" == t.localName && r((o = Jc({ wg: {}, features: [] }, Ob, t, [o])).features) ? o.features : [] }, Ub.prototype.c = function(t) { return Rc(t) ? this.b(t) : Lc(t) ? this.a(t) : c(t) ? (t = Nc(t), this.b(t)) : null }, A(Xb, Ub), Xb.prototype.b = function(t) {
        for (t = t.firstChild; null !== t; t = t.nextSibling)
            if (1 == t.nodeType) return this.a(t);
        return null
    }, Xb.prototype.a = function(t) { return r(t = Jc({}, Yb, t, [])) ? t : null };
    var Kb = [null, "http://www.opengis.net/ows/1.1"],
        Yb = Uc(Kb, { ServiceIdentification: Gc((function(t, e) { return Jc({}, em, t, e) })), ServiceProvider: Gc((function(t, e) { return Jc({}, om, t, e) })), OperationsMetadata: Gc((function(t, e) { return Jc({}, $b, t, e) })) }),
        Vb = Uc(Kb, { DeliveryPoint: Gc(Lg), City: Gc(Lg), AdministrativeArea: Gc(Lg), PostalCode: Gc(Lg), Country: Gc(Lg), ElectronicMailAddress: Gc(Lg) }),
        Hb = Uc(Kb, { Value: Bc((function(t) { return Lg(t) })) }),
        Wb = Uc(Kb, { AllowedValues: Gc((function(t, e) { return Jc({}, Hb, t, e) })) }),
        zb = Uc(Kb, { Phone: Gc((function(t, e) { return Jc({}, _b, t, e) })), Address: Gc((function(t, e) { return Jc({}, Vb, t, e) })) }),
        Zb = Uc(Kb, { HTTP: Gc((function(t, e) { return Jc({}, Jb, t, e) })) }),
        Jb = Uc(Kb, { Get: Bc((function(t, e) { var o = Gb(t); return r(o) ? Jc({ href: o }, Qb, t, e) : void 0 })), Post: void 0 }),
        qb = Uc(Kb, { DCP: Gc((function(t, e) { return Jc({}, Zb, t, e) })) }),
        $b = Uc(Kb, {
            Operation: function(t, e) {
                var o = t.getAttribute("name"),
                    i = Jc({}, qb, t, e);
                r(i) && (e[e.length - 1][o] = i)
            }
        }),
        _b = Uc(Kb, { Voice: Gc(Lg), Facsimile: Gc(Lg) }),
        Qb = Uc(Kb, { Constraint: Bc((function(t, e) { var o = t.getAttribute("name"); return r(o) ? Jc({ name: o }, Wb, t, e) : void 0 })) }),
        tm = Uc(Kb, { IndividualName: Gc(Lg), PositionName: Gc(Lg), ContactInfo: Gc((function(t, e) { return Jc({}, zb, t, e) })) }),
        em = Uc(Kb, { Title: Gc(Lg), ServiceTypeVersion: Gc(Lg), ServiceType: Gc(Lg) }),
        om = Uc(Kb, { ProviderName: Gc(Lg), ProviderSite: Gc(Gb), ServiceContact: Gc((function(t, e) { return Jc({}, tm, t, e) })) });

    function im(t, e, o, i) {
        var n, s, p;
        for (r(i) ? n = r(void 0) ? void 0 : 0 : (i = [], n = 0), s = 0; s < e;)
            for (p = t[s++], i[n++] = t[s++], i[n++] = p, p = 2; p < o; ++p) i[n++] = t[s++];
        i.length = n
    }

    function rm(t) { t = r(t) ? t : {}, this.defaultDataProjection = null, this.defaultDataProjection = gi("EPSG:4326"), this.a = r(t.factor) ? t.factor : 1e5, this.b = r(t.geometryLayout) ? t.geometryLayout : "XY" }

    function nm(t, e, o) {
        o = r(o) ? o : 1e5;
        var i, n, s, p = Array(e);
        for (i = 0; i < e; ++i) p[i] = 0;
        for (n = 0, s = t.length; n < s;)
            for (i = 0; i < e; ++i, ++n) {
                var a = t[n],
                    h = a - p[i];
                p[i] = a, t[n] = h
            }
        return pm(t, o)
    }

    function sm(t, e, o) {
        var i, n = r(o) ? o : 1e5,
            s = Array(e);
        for (o = 0; o < e; ++o) s[o] = 0;
        for (t = am(t, n), n = 0, i = t.length; n < i;)
            for (o = 0; o < e; ++o, ++n) s[o] += t[n], t[n] = s[o];
        return t
    }

    function pm(t, e) {
        var o, i, n = r(e) ? e : 1e5;
        for (o = 0, i = t.length; o < i; ++o) t[o] = Math.round(t[o] * n);
        for (n = 0, o = t.length; n < o; ++n) i = t[n], t[n] = 0 > i ? ~(i << 1) : i << 1;
        for (n = "", o = 0, i = t.length; o < i; ++o) {
            for (var s = t[o], p = void 0, a = ""; 32 <= s;) p = 63 + (32 | 31 & s), a += String.fromCharCode(p), s >>= 5;
            p = s + 63, n += a += String.fromCharCode(p)
        }
        return n
    }

    function am(t, e) {
        var o, i, n = r(e) ? e : 1e5,
            s = [],
            p = 0,
            a = 0;
        for (o = 0, i = t.length; o < i; ++o) {
            var h = t.charCodeAt(o) - 63;
            p |= (31 & h) << a, 32 > h ? (s.push(p), a = p = 0) : a += 5
        }
        for (p = 0, a = s.length; p < a; ++p) o = s[p], s[p] = 1 & o ? ~(o >> 1) : o >> 1;
        for (p = 0, a = s.length; p < a; ++p) s[p] /= n;
        return s
    }

    function hm(t) { t = r(t) ? t : {}, this.defaultDataProjection = null, this.defaultDataProjection = gi(null != t.defaultDataProjection ? t.defaultDataProjection : "EPSG:4326") }

    function lm(t, e) { var o, i, r, n, s = []; for (r = 0, n = t.length; r < n; ++r) o = t[r], 0 < r && s.pop(), i = 0 <= o ? e[o] : e[~o].slice().reverse(), s.push.apply(s, i); for (o = 0, i = s.length; o < i; ++o) s[o] = s[o].slice(); return s }

    function um(t, e, o, i, r) { var n, s, p = []; for (n = 0, s = (t = t.geometries).length; n < s; ++n) p[n] = cm(t[n], e, o, i, r); return p }

    function cm(t, e, o, i, n) {
        var s = t.type,
            p = fm[s];
        return e = "Point" === s || "MultiPoint" === s ? p(t, o, i) : p(t, e), (o = new Lu).Sa(rg(e, !1, n)), r(t.id) && o.Wb(t.id), r(t.properties) && o.I(t.properties), o
    }

    function ym(t, e, o) { t[0] = t[0] * e[0] + o[0], t[1] = t[1] * e[1] + o[1] }
    A(rm, Td), (t = rm.prototype).rd = function(t, e) { return new Lu(this.td(t, e)) }, t.vf = function(t, e) { return [this.rd(t, e)] }, t.td = function(t, e) {
        var o = ji(this.b),
            i = sm(t, o, this.a);
        return im(i, i.length, o, i), rg(new iu(o = Xi(i, 0, i.length, o), this.b), !1, ig(this, e))
    }, t.Be = function(t, e) { var o = t.Y(); return null != o ? this.yd(o, e) : "" }, t.Nh = function(t, e) { return this.Be(t[0], e) }, t.yd = function(t, e) {
        var o = (t = rg(t, !0, ig(this, e))).o,
            i = t.H;
        return im(o, o.length, i, o), nm(o, i, this.a)
    }, A(hm, ng), hm.prototype.uf = function(t, e) {
        if ("Topology" == t.type) {
            var o, i = null,
                n = null;
            r(t.transform) && (i = (o = t.transform).scale, n = o.translate);
            var s = t.arcs;
            if (r(o)) {
                o = i;
                var p, a, h = n;
                for (p = 0, a = s.length; p < a; ++p)
                    for (var l = s[p], u = o, c = h, y = 0, f = 0, g = void 0, d = void 0, v = (d = 0, l.length); d < v; ++d) y += (g = l[d])[0], f += g[1], g[0] = y, g[1] = f, ym(g, u, c)
            }
            for (o = [], p = 0, a = (h = ct(t.objects)).length; p < a; ++p) "GeometryCollection" === h[p].type ? (l = h[p], o.push.apply(o, um(l, s, i, n, e))) : (l = h[p], o.push(cm(l, s, i, n, e)));
            return o
        }
        return []
    }, hm.prototype.Ga = function() { return this.defaultDataProjection };
    var fm = {
        Point: function(t, e, o) { return t = t.coordinates, null === e || null === o || ym(t, e, o), new zi(t) },
        LineString: function(t, e) { return new iu(lm(t.arcs, e)) },
        Polygon: function(t, e) { var o, i, r = []; for (o = 0, i = t.arcs.length; o < i; ++o) r[o] = lm(t.arcs[o], e); return new sr(r) },
        MultiPoint: function(t, e, o) {
            var i, r;
            if (t = t.coordinates, null !== e && null !== o)
                for (i = 0, r = t.length; i < r; ++i) ym(t[i], e, o);
            return new lu(t)
        },
        MultiLineString: function(t, e) { var o, i, r = []; for (o = 0, i = t.arcs.length; o < i; ++o) r[o] = lm(t.arcs[o], e); return new su(r) },
        MultiPolygon: function(t, e) {
            var o, i, r, n, s, p, a = [];
            for (s = 0, p = t.arcs.length; s < p; ++s) {
                for (i = [], r = 0, n = (o = t.arcs[s]).length; r < n; ++r) i[r] = lm(o[r], e);
                a[s] = i
            }
            return new uu(a)
        }
    };

    function gm(t) { t = r(t) ? t : {}, this.g = t.featureType, this.c = t.featureNS, this.a = r(t.gmlFormat) ? t.gmlFormat : new Fg, this.f = r(t.schemaLocation) ? t.schemaLocation : "http://www.opengis.net/wfs http://schemas.opengis.net/wfs/1.1.0/wfs.xsd", this.defaultDataProjection = null }

    function dm(t, e) {
        for (var o = e.firstChild; null !== o; o = o.nextSibling)
            if (1 == o.nodeType) return bm(t, o)
    }
    A(gm, mg), gm.prototype.Ub = function(t, e) { var o = { featureType: this.g, featureNS: this.c }; return Pt(o, og(this, t, r(e) ? e : {})), o = [o], this.a.a["http://www.opengis.net/gml"].featureMember = Dc(xg.prototype.sd), r(o = Jc([], this.a.a, t, o, this.a)) || (o = []), o }, gm.prototype.j = function(t) { return Rc(t) ? Mm(t) : Lc(t) ? Jc({}, xm, t, []) : c(t) ? Mm(t = Nc(t)) : void 0 }, gm.prototype.i = function(t) { return Rc(t) ? dm(this, t) : Lc(t) ? bm(this, t) : c(t) ? dm(this, t = Nc(t)) : void 0 };
    var vm = { "http://www.opengis.net/gml": { boundedBy: Gc(xg.prototype.te, "bounds") } };

    function bm(t, e) {
        var o = {},
            i = Rg(e.getAttribute("numberOfFeatures"));
        return o.numberOfFeatures = i, Jc(o, vm, e, [], t.a)
    }
    var mm = { "http://www.opengis.net/wfs": { totalInserted: Gc(Cg), totalUpdated: Gc(Cg), totalDeleted: Gc(Cg) } },
        wm = { "http://www.opengis.net/ogc": { FeatureId: Dc((function(t) { return t.getAttribute("fid") })) } },
        Sm = { "http://www.opengis.net/wfs": { Feature: function(t, e) { Zc(wm, t, e) } } },
        xm = { "http://www.opengis.net/wfs": { TransactionSummary: Gc((function(t, e) { return Jc({}, mm, t, e) }), "transactionSummary"), InsertResults: Gc((function(t, e) { return Jc([], Sm, t, e) }), "insertIds") } };

    function Mm(t) {
        for (t = t.firstChild; null !== t; t = t.nextSibling)
            if (1 == t.nodeType) return Jc({}, xm, t, [])
    }
    var Pm = { "http://www.opengis.net/wfs": { PropertyName: Xc(Ng) } };

    function Tm(t, e) {
        var o = jc("http://www.opengis.net/ogc", "Filter"),
            i = jc("http://www.opengis.net/ogc", "FeatureId");
        o.appendChild(i), i.setAttribute("fid", e), t.appendChild(o)
    }
    var jm = {
            "http://www.opengis.net/wfs": {
                Insert: Xc((function(t, e, o) {
                    var i = o[o.length - 1];
                    i = jc(i.featureNS, i.featureType), t.appendChild(i), Fg.prototype.Mh(i, e, o)
                })),
                Update: Xc((function(t, e, o) {
                    var i = o[o.length - 1],
                        n = i.featureType,
                        s = r(s = i.featurePrefix) ? s : "feature",
                        p = i.featureNS;
                    if (t.setAttribute("typeName", s + ":" + n), kc(t, "http://www.w3.org/2000/xmlns/", "xmlns:" + s, p), r(n = e.ha)) {
                        p = [];
                        for (var a = 0, h = (s = e.O()).length; a < h; a++) {
                            var l = e.get(s[a]);
                            r(l) && p.push({ name: s[a], value: l })
                        }
                        $c({ node: t, srsName: i.srsName }, jm, Yc("Property"), p, o), Tm(t, n)
                    }
                })),
                Delete: Xc((function(t, e, o) {
                    o = (n = o[o.length - 1]).featureType;
                    var i = r(i = n.featurePrefix) ? i : "feature",
                        n = n.featureNS;
                    t.setAttribute("typeName", i + ":" + o), kc(t, "http://www.w3.org/2000/xmlns/", "xmlns:" + i, n), r(e = e.ha) && Tm(t, e)
                })),
                Property: Xc((function(t, e, o) {
                    var i = jc("http://www.opengis.net/wfs", "Name");
                    t.appendChild(i), Ng(i, e.name), null != e.value && (i = jc("http://www.opengis.net/wfs", "Value"), t.appendChild(i), e.value instanceof Mi ? Fg.prototype.De(i, e.value, o) : Ng(i, e.value))
                })),
                Native: Xc((function(t, e) { r(e.so) && t.setAttribute("vendorId", e.so), r(e.Qn) && t.setAttribute("safeToIgnore", e.Qn), r(e.value) && Ng(t, e.value) }))
            }
        },
        Am = {
            "http://www.opengis.net/wfs": {
                Query: Xc((function(t, e, o) {
                    var i = o[o.length - 1],
                        n = i.featurePrefix,
                        s = i.featureNS,
                        p = i.propertyNames,
                        a = i.srsName;
                    t.setAttribute("typeName", (r(n) ? n + ":" : "") + e), r(a) && t.setAttribute("srsName", a), r(s) && kc(t, "http://www.w3.org/2000/xmlns/", "xmlns:" + n, s), (e = xt(i)).node = t, $c(e, Pm, Yc("PropertyName"), p, o), r(i = i.bbox) && (p = jc("http://www.opengis.net/ogc", "Filter"), e = o[o.length - 1].geometryName, n = jc("http://www.opengis.net/ogc", "BBOX"), p.appendChild(n), Ng(s = jc("http://www.opengis.net/ogc", "PropertyName"), e), n.appendChild(s), Fg.prototype.De(n, i, o), t.appendChild(p))
                }))
            }
        };

    function Cm(t) { t = r(t) ? t : {}, this.defaultDataProjection = null, this.a = !!r(t.splitCollection) && t.splitCollection }

    function Rm(t) { return 0 == (t = t.V()).length ? "" : t[0] + " " + t[1] }

    function Lm(t) { for (var e = [], o = 0, i = (t = t.V()).length; o < i; ++o) e.push(t[o][0] + " " + t[o][1]); return e.join(",") }

    function Em(t) { for (var e = [], o = 0, i = (t = t.Md()).length; o < i; ++o) e.push("(" + Lm(t[o]) + ")"); return e.join(",") }

    function Im(t) { var e = t.U(); return t = (0, km[e])(t), e = e.toUpperCase(), 0 === t.length ? e + " EMPTY" : e + "(" + t + ")" }
    gm.prototype.l = function(t) {
        var e = jc("http://www.opengis.net/wfs", "GetFeature");
        e.setAttribute("service", "WFS"), e.setAttribute("version", "1.1.0"), r(t) && (r(t.handle) && e.setAttribute("handle", t.handle), r(t.outputFormat) && e.setAttribute("outputFormat", t.outputFormat), r(t.maxFeatures) && e.setAttribute("maxFeatures", t.maxFeatures), r(t.resultType) && e.setAttribute("resultType", t.resultType), r(t.lo) && e.setAttribute("startIndex", t.lo), r(t.count) && e.setAttribute("count", t.count)), kc(e, "http://www.w3.org/2001/XMLSchema-instance", "xsi:schemaLocation", this.f);
        var o = t.featureTypes,
            i = xt((t = [{ node: e, srsName: t.srsName, featureNS: r(t.featureNS) ? t.featureNS : this.c, featurePrefix: t.featurePrefix, geometryName: t.geometryName, bbox: t.bbox, propertyNames: r(t.propertyNames) ? t.propertyNames : [] }])[t.length - 1]);
        return i.node = e, $c(i, Am, Yc("Query"), o, t), e
    }, gm.prototype.u = function(t, e, o, i) {
        var n, s, p = [],
            a = jc("http://www.opengis.net/wfs", "Transaction");
        return a.setAttribute("service", "WFS"), a.setAttribute("version", "1.1.0"), r(i) && (n = r(i.gmlOptions) ? i.gmlOptions : {}, r(i.handle) && a.setAttribute("handle", i.handle)), kc(a, "http://www.w3.org/2001/XMLSchema-instance", "xsi:schemaLocation", this.f), null != t && (Pt(s = { node: a, featureNS: i.featureNS, featureType: i.featureType, featurePrefix: i.featurePrefix }, n), $c(s, jm, Yc("Insert"), t, p)), null != e && (Pt(s = { node: a, featureNS: i.featureNS, featureType: i.featureType, featurePrefix: i.featurePrefix }, n), $c(s, jm, Yc("Update"), e, p)), null != o && $c({ node: a, featureNS: i.featureNS, featureType: i.featureType, featurePrefix: i.featurePrefix }, jm, Yc("Delete"), o, p), r(i.nativeElements) && $c({ node: a, featureNS: i.featureNS, featureType: i.featureType, featurePrefix: i.featurePrefix }, jm, Yc("Native"), i.nativeElements, p), a
    }, gm.prototype.yf = function(t) {
        for (t = t.firstChild; null !== t; t = t.nextSibling)
            if (1 == t.nodeType) return this.we(t);
        return null
    }, gm.prototype.we = function(t) {
        if (null != t.firstElementChild && null != t.firstElementChild.firstElementChild)
            for (t = (t = t.firstElementChild.firstElementChild).firstElementChild; null !== t; t = t.nextElementSibling)
                if (0 !== t.childNodes.length && (1 !== t.childNodes.length || 3 !== t.firstChild.nodeType)) { var e = [{}]; return this.a.te(t, e), gi(e.pop().srsName) }
        return null
    }, A(Cm, Td);
    var km = { Point: Rm, LineString: Lm, Polygon: Em, MultiPoint: function(t) { for (var e = [], o = 0, i = (t = t.ge()).length; o < i; ++o) e.push("(" + Rm(t[o]) + ")"); return e.join(",") }, MultiLineString: function(t) { for (var e = [], o = 0, i = (t = t.gd()).length; o < i; ++o) e.push("(" + Lm(t[o]) + ")"); return e.join(",") }, MultiPolygon: function(t) { for (var e = [], o = 0, i = (t = t.Od()).length; o < i; ++o) e.push("(" + Em(t[o]) + ")"); return e.join(",") }, GeometryCollection: function(t) { for (var e = [], o = 0, i = (t = t.ag()).length; o < i; ++o) e.push(Im(t[o])); return e.join(",") } };

    function Nm(t) { this.b = t, this.a = -1 }

    function Fm(t, e) { var o = !!r(e) && e; return "0" <= t && "9" >= t || "." == t && !o }

    function Dm(t) {
        var e = t.b.charAt(++t.a),
            o = { position: t.a, value: e };
        if ("(" == e) o.type = 2;
        else if ("," == e) o.type = 5;
        else if (")" == e) o.type = 3;
        else if (Fm(e) || "-" == e) {
            o.type = 4, e = t.a;
            var i, r = !1,
                n = !1;
            do { "." == i ? r = !0 : "e" != i && "E" != i || (n = !0), i = t.b.charAt(++t.a) } while (Fm(i, r) || !n && ("e" == i || "E" == i) || n && ("-" == i || "+" == i));
            t = parseFloat(t.b.substring(e, t.a--)), o.value = t
        } else if ("a" <= e && "z" >= e || "A" <= e && "Z" >= e) {
            o.type = 1, e = t.a;
            do { i = t.b.charAt(++t.a) } while ("a" <= i && "z" >= i || "A" <= i && "Z" >= i);
            t = t.b.substring(e, t.a--).toUpperCase(), o.value = t
        } else {
            if (" " == e || "\t" == e || "\r" == e || "\n" == e) return Dm(t);
            if ("" !== e) throw Error("Unexpected character: " + e);
            o.type = 6
        }
        return o
    }

    function Om(t) { this.b = t }

    function Bm(t) {
        for (var e = [], o = 0; 2 > o; ++o) {
            var i = t.a;
            if (!t.match(4)) break;
            e.push(i.value)
        }
        if (2 == e.length) return e;
        throw Error(Km(t))
    }

    function Gm(t) { for (var e = [Bm(t)]; t.match(5);) e.push(Bm(t)); return e }

    function Um(t) { for (var e = [t.qf()]; t.match(5);) e.push(t.qf()); return e }

    function Xm(t) { var e = 1 == t.a.type && "EMPTY" == t.a.value; return e && (t.a = Dm(t.b)), e }

    function Km(t) { return "Unexpected `" + t.a.value + "` at position " + t.a.position + " in `" + t.b.b + "`" }(t = Cm.prototype).rd = function(t, e) { var o = this.td(t, e); if (r(o)) { var i = new Lu; return i.Sa(o), i } return null }, t.vf = function(t, e) { for (var o, i = this.td(t, e), r = [], n = 0, s = (o = this.a && "GeometryCollection" == i.U() ? i.f : [i]).length; n < s; ++n)(i = new Lu).Sa(o[n]), r.push(i); return r }, t.td = function(t, e) {
        var o;
        return (o = new Om(new Nm(t))).a = Dm(o.b), o = function t(e) {
            var o = e.a;
            if (e.match(1)) {
                var i = o.value;
                if ("GEOMETRYCOLLECTION" == i) {
                    t: {
                        if (e.match(2)) {
                            o = [];
                            do { o.push(t(e)) } while (e.match(5));
                            if (e.match(3)) { e = o; break t }
                        } else if (Xm(e)) { e = []; break t }
                        throw Error(Km(e))
                    }
                    return new $l(e)
                }
                var n = Vm[i];
                if (o = Ym[i], !r(n) || !r(o)) throw Error("Invalid geometry type: " + i);
                return new o(e = n.call(e))
            }
            throw Error(Km(e))
        }(o), r(o) ? rg(o, !1, e) : null
    }, t.Be = function(t, e) { var o = t.Y(); return r(o) ? this.yd(o, e) : "" }, t.Nh = function(t, e) { if (1 == t.length) return this.Be(t[0], e); for (var o = [], i = 0, r = t.length; i < r; ++i) o.push(t[i].Y()); return o = new $l(o), this.yd(o, e) }, t.yd = function(t, e) { return Im(rg(t, !0, e)) }, (t = Om.prototype).match = function(t) { return (t = this.a.type == t) && (this.a = Dm(this.b)), t }, t.rf = function() { if (this.match(2)) { var t = Bm(this); if (this.match(3)) return t } else if (Xm(this)) return null; throw Error(Km(this)) }, t.qf = function() { if (this.match(2)) { var t = Gm(this); if (this.match(3)) return t } else if (Xm(this)) return []; throw Error(Km(this)) }, t.sf = function() { if (this.match(2)) { var t = Um(this); if (this.match(3)) return t } else if (Xm(this)) return []; throw Error(Km(this)) }, t.gn = function() {
        if (this.match(2)) {
            var t;
            if (2 == this.a.type)
                for (t = [this.rf()]; this.match(5);) t.push(this.rf());
            else t = Gm(this);
            if (this.match(3)) return t
        } else if (Xm(this)) return [];
        throw Error(Km(this))
    }, t.fn = function() { if (this.match(2)) { var t = Um(this); if (this.match(3)) return t } else if (Xm(this)) return []; throw Error(Km(this)) }, t.hn = function() { if (this.match(2)) { for (var t = [this.sf()]; this.match(5);) t.push(this.sf()); if (this.match(3)) return t } else if (Xm(this)) return []; throw Error(Km(this)) };
    var Ym = { POINT: zi, LINESTRING: iu, POLYGON: sr, MULTIPOINT: lu, MULTILINESTRING: su, MULTIPOLYGON: uu },
        Vm = { POINT: Om.prototype.rf, LINESTRING: Om.prototype.qf, POLYGON: Om.prototype.sf, MULTIPOINT: Om.prototype.gn, MULTILINESTRING: Om.prototype.fn, MULTIPOLYGON: Om.prototype.hn };

    function Hm() { this.version = void 0 }

    function Wm(t, e) { return Jc({}, cw, t, e) }

    function zm(t, e) { return Jc({}, aw, t, e) }

    function Zm(t, e) { var o = Wm(t, e); if (r(o)) { var i = [Rg(t.getAttribute("width")), Rg(t.getAttribute("height"))]; return o.size = i, o } }

    function Jm(t, e) { return Jc([], yw, t, e) }
    A(Hm, Ub), Hm.prototype.b = function(t) {
        for (t = t.firstChild; null !== t; t = t.nextSibling)
            if (1 == t.nodeType) return this.a(t);
        return null
    }, Hm.prototype.a = function(t) { return this.version = L(t.getAttribute("version")), r(t = Jc({ version: this.version }, $m, t, [])) ? t : null };
    var qm = [null, "http://www.opengis.net/wms"],
        $m = Uc(qm, { Service: Gc((function(t, e) { return Jc({}, Qm, t, e) })), Capability: Gc((function(t, e) { return Jc({}, _m, t, e) })) }),
        _m = Uc(qm, { Request: Gc((function(t, e) { return Jc({}, pw, t, e) })), Exception: Gc((function(t, e) { return Jc([], iw, t, e) })), Layer: Gc((function(t, e) { return Jc({}, rw, t, e) })) }),
        Qm = Uc(qm, { Name: Gc(Lg), Title: Gc(Lg), Abstract: Gc(Lg), KeywordList: Gc(Jm), OnlineResource: Gc(Gb), ContactInformation: Gc((function(t, e) { return Jc({}, tw, t, e) })), Fees: Gc(Lg), AccessConstraints: Gc(Lg), LayerLimit: Gc(Cg), MaxWidth: Gc(Cg), MaxHeight: Gc(Cg) }),
        tw = Uc(qm, { ContactPersonPrimary: Gc((function(t, e) { return Jc({}, ew, t, e) })), ContactPosition: Gc(Lg), ContactAddress: Gc((function(t, e) { return Jc({}, ow, t, e) })), ContactVoiceTelephone: Gc(Lg), ContactFacsimileTelephone: Gc(Lg), ContactElectronicMailAddress: Gc(Lg) }),
        ew = Uc(qm, { ContactPerson: Gc(Lg), ContactOrganization: Gc(Lg) }),
        ow = Uc(qm, { AddressType: Gc(Lg), Address: Gc(Lg), City: Gc(Lg), StateOrProvince: Gc(Lg), PostCode: Gc(Lg), Country: Gc(Lg) }),
        iw = Uc(qm, { Format: Dc(Lg) }),
        rw = Uc(qm, {
            Name: Gc(Lg),
            Title: Gc(Lg),
            Abstract: Gc(Lg),
            KeywordList: Gc(Jm),
            CRS: Bc(Lg),
            EX_GeographicBoundingBox: Gc((function(t, e) {
                if (r(s = Jc({}, sw, t, e))) {
                    var o = s.westBoundLongitude,
                        i = s.southBoundLatitude,
                        n = s.eastBoundLongitude,
                        s = s.northBoundLatitude;
                    return r(o) && r(i) && r(n) && r(s) ? [o, i, n, s] : void 0
                }
            })),
            BoundingBox: Bc((function(t) {
                var e = [Ag(t.getAttribute("minx")), Ag(t.getAttribute("miny")), Ag(t.getAttribute("maxx")), Ag(t.getAttribute("maxy"))],
                    o = [Ag(t.getAttribute("resx")), Ag(t.getAttribute("resy"))];
                return { crs: t.getAttribute("CRS"), extent: e, res: o }
            })),
            Dimension: Bc((function(t) { return { name: t.getAttribute("name"), units: t.getAttribute("units"), unitSymbol: t.getAttribute("unitSymbol"), default: t.getAttribute("default"), multipleValues: Pg(t.getAttribute("multipleValues")), nearestValue: Pg(t.getAttribute("nearestValue")), current: Pg(t.getAttribute("current")), values: Lg(t) } })),
            Attribution: Gc((function(t, e) { return Jc({}, nw, t, e) })),
            AuthorityURL: Bc((function(t, e) { var o = Wm(t, e); if (r(o)) return o.name = t.getAttribute("name"), o })),
            Identifier: Bc(Lg),
            MetadataURL: Bc((function(t, e) { var o = Wm(t, e); if (r(o)) return o.type = t.getAttribute("type"), o })),
            DataURL: Bc(Wm),
            FeatureListURL: Bc(Wm),
            Style: Bc((function(t, e) { return Jc({}, uw, t, e) })),
            MinScaleDenominator: Gc(jg),
            MaxScaleDenominator: Gc(jg),
            Layer: Bc((function(t, e) {
                var o = e[e.length - 1],
                    i = Jc({}, rw, t, e);
                if (r(i)) {
                    var n = Pg(t.getAttribute("queryable"));
                    return r(n) || (n = o.queryable), i.queryable = !!r(n) && n, r(n = Rg(t.getAttribute("cascaded"))) || (n = o.cascaded), i.cascaded = n, r(n = Pg(t.getAttribute("opaque"))) || (n = o.opaque), i.opaque = !!r(n) && n, r(n = Pg(t.getAttribute("noSubsets"))) || (n = o.noSubsets), i.noSubsets = !!r(n) && n, r(n = Ag(t.getAttribute("fixedWidth"))) || (n = o.fixedWidth), i.fixedWidth = n, r(n = Ag(t.getAttribute("fixedHeight"))) || (n = o.fixedHeight), i.fixedHeight = n, H(["Style", "CRS", "AuthorityURL"], (function(t) {
                        var e = o[t];
                        if (r(e)) {
                            var n = (n = St(i, t)).concat(e);
                            i[t] = n
                        }
                    })), H("EX_GeographicBoundingBox BoundingBox Dimension Attribution MinScaleDenominator MaxScaleDenominator".split(" "), (function(t) { r(i[t]) || (i[t] = o[t]) })), i
                }
            }))
        }),
        nw = Uc(qm, { Title: Gc(Lg), OnlineResource: Gc(Gb), LogoURL: Gc(Zm) }),
        sw = Uc(qm, { westBoundLongitude: Gc(jg), eastBoundLongitude: Gc(jg), southBoundLatitude: Gc(jg), northBoundLatitude: Gc(jg) }),
        pw = Uc(qm, { GetCapabilities: Gc(zm), GetMap: Gc(zm), GetFeatureInfo: Gc(zm) }),
        aw = Uc(qm, { Format: Bc(Lg), DCPType: Bc((function(t, e) { return Jc({}, hw, t, e) })) }),
        hw = Uc(qm, { HTTP: Gc((function(t, e) { return Jc({}, lw, t, e) })) }),
        lw = Uc(qm, { Get: Gc(Wm), Post: Gc(Wm) }),
        uw = Uc(qm, { Name: Gc(Lg), Title: Gc(Lg), Abstract: Gc(Lg), LegendURL: Bc(Zm), StyleSheetURL: Gc(Wm), StyleURL: Gc(Wm) }),
        cw = Uc(qm, { Format: Gc(Lg), OnlineResource: Gc(Gb) }),
        yw = Uc(qm, { Keyword: Dc(Lg) });

    function fw() { this.c = "http://mapserver.gis.umn.edu/mapserver", this.a = new Vg, this.defaultDataProjection = null }

    function gw() { this.f = new Xb }

    function dw(t) { var e = Lg(t).split(" "); if (r(e) && 2 == e.length) return t = +e[0], e = +e[1], isNaN(t) || isNaN(e) ? void 0 : [t, e] }
    A(fw, mg), fw.prototype.Ub = function(t, e) {
        var o = { featureType: this.featureType, featureNS: this.featureNS };
        return r(e) && Pt(o, og(this, t, e)),
            function(t, e, o) {
                e.namespaceURI = t.c;
                var i = Cc(e),
                    n = [];
                return 0 === e.childNodes.length || ("msGMLOutput" == i && H(e.childNodes, (function(t) {
                    if (1 === t.nodeType) {
                        var e = o[0],
                            i = t.localName,
                            s = RegExp;
                        s = new s("_layer".replace(/([-()\[\]{}+?*.$\^|,:#<!\\])/g, "\\$1").replace(/\x08/g, "\\x08"), ""), i = i.replace(s, "") + "_feature", e.featureType = i, e.featureNS = this.c, (s = {})[i] = Dc(this.a.tf, this.a), e = Uc([e.featureNS, null], s), t.namespaceURI = this.c, r(t = Jc([], e, t, o, this.a)) && tt(n, t)
                    }
                }), t), "FeatureCollection" == i && r(t = Jc([], t.a.a, e, [{}], t.a)) && (n = t)), n
            }(this, t, [o])
    }, A(gw, Ub), gw.prototype.b = function(t) {
        for (t = t.firstChild; null !== t; t = t.nextSibling)
            if (1 == t.nodeType) return this.a(t);
        return null
    }, gw.prototype.a = function(t) { this.version = L(t.getAttribute("version")); var e = this.f.a(t); return r(e) ? (e.version = this.version, r(e = Jc(e, mw, t, [])) ? e : null) : null };
    var vw = [null, "http://www.opengis.net/wmts/1.0"],
        bw = [null, "http://www.opengis.net/ows/1.1"],
        mw = Uc(vw, { Contents: Gc((function(t, e) { return Jc({}, ww, t, e) })) }),
        ww = Uc(vw, { Layer: Bc((function(t, e) { return Jc({}, Sw, t, e) })), TileMatrixSet: Bc((function(t, e) { return Jc({}, Tw, t, e) })) }),
        Sw = Uc(vw, {
            Style: Bc((function(t, e) { var o = Jc({}, xw, t, e); if (r(o)) { var i = "true" === t.getAttribute("isDefault"); return o.isDefault = i, o } })),
            Format: Bc(Lg),
            TileMatrixSetLink: Bc((function(t, e) { return Jc({}, Mw, t, e) })),
            ResourceURL: Bc((function(t) {
                var e = t.getAttribute("format"),
                    o = t.getAttribute("template");
                t = t.getAttribute("resourceType");
                var i = {};
                return r(e) && (i.format = e), r(o) && (i.template = o), r(t) && (i.resourceType = t), i
            }))
        }, Uc(bw, { Title: Gc(Lg), Abstract: Gc(Lg), WGS84BoundingBox: Gc((function(t, e) { var o = Jc([], Pw, t, e); return 2 != o.length ? void 0 : wo(o) })), Identifier: Gc(Lg) })),
        xw = Uc(vw, { LegendURL: Bc((function(t) { var e = {}; return e.format = t.getAttribute("format"), e.href = Gb(t), e })) }, Uc(bw, { Title: Gc(Lg), Identifier: Gc(Lg) })),
        Mw = Uc(vw, { TileMatrixSet: Gc(Lg) }),
        Pw = Uc(bw, { LowerCorner: Dc(dw), UpperCorner: Dc(dw) }),
        Tw = Uc(vw, { WellKnownScaleSet: Gc(Lg), TileMatrix: Bc((function(t, e) { return Jc({}, jw, t, e) })) }, Uc(bw, { SupportedCRS: Gc(Lg), Identifier: Gc(Lg) })),
        jw = Uc(vw, { TopLeftCorner: Gc(dw), ScaleDenominator: Gc(jg), TileWidth: Gc(Cg), TileHeight: Gc(Cg), MatrixWidth: Gc(Cg), MatrixHeight: Gc(Cg) }, Uc(bw, { Identifier: Gc(Lg) })),
        Aw = new oi(6378137);

    function Cw(t) { Ve.call(this), t = r(t) ? t : {}, this.b = null, this.f = mi, this.c = void 0, Te(this, We("projection"), this.Rk, !1, this), Te(this, We("tracking"), this.Sk, !1, this), r(t.projection) && this.Ag(gi(t.projection)), r(t.trackingOptions) && this.Dh(t.trackingOptions), this.ce(!!r(t.tracking) && t.tracking) }

    function Rw(t, e, o) { for (var i, r, n, s, p, a = [], h = t(0), l = t(1), u = e(h), c = e(l), y = [l, h], f = [c, u], g = [1, 0], d = {}, v = 1e5; 0 < --v && 0 < g.length;) n = g.pop(), h = y.pop(), u = f.pop(), (l = n.toString()) in d || (a.push(u[0], u[1]), d[l] = !0), s = g.pop(), l = y.pop(), c = f.pop(), Ei((r = e(i = t(p = (n + s) / 2)))[0], r[1], u[0], u[1], c[0], c[1]) < o ? (a.push(c[0], c[1]), d[l = s.toString()] = !0) : (g.push(s, p, p, n), f.push(c, r, r, u), y.push(l, i, i, h)); return a }

    function Lw(t) { t = r(t) ? t : {}, this.l = this.j = null, this.f = this.c = 1 / 0, this.i = this.g = -1 / 0, this.ea = r(t.targetSize) ? t.targetSize : 100, this.A = r(t.maxLines) ? t.maxLines : 100, this.a = [], this.b = [], this.D = r(t.strokeStyle) ? t.strokeStyle : Ew, this.u = this.B = void 0, this.v = null, this.setMap(r(t.map) ? t.map : null) }
    A(Cw, Ve), (t = Cw.prototype).W = function() { this.ce(!1), Cw.$.W.call(this) }, t.Rk = function() {
        var t = this.yg();
        null != t && (this.f = bi(gi("EPSG:4326"), t), null === this.b || this.set("position", this.f(this.b)))
    }, t.Sk = function() {
        if (dp) {
            var t = this.zg();
            t && !r(this.c) ? this.c = i.navigator.geolocation.watchPosition(S(this.qn, this), S(this.rn, this), this.kg()) : !t && r(this.c) && (i.navigator.geolocation.clearWatch(this.c), this.c = void 0)
        }
    }, t.qn = function(t) {
        t = t.coords, this.set("accuracy", t.accuracy), this.set("altitude", null === t.altitude ? void 0 : t.altitude), this.set("altitudeAccuracy", null === t.altitudeAccuracy ? void 0 : t.altitudeAccuracy), this.set("heading", null === t.heading ? void 0 : Vt(t.heading)), null === this.b ? this.b = [t.longitude, t.latitude] : (this.b[0] = t.longitude, this.b[1] = t.latitude);
        var e = this.f(this.b);
        this.set("position", e), this.set("speed", null === t.speed ? void 0 : t.speed), (t = lr(Aw, this.b, t.accuracy)).va(this.f), this.set("accuracyGeometry", t), this.s()
    }, t.rn = function(t) { t.type = "error", this.ce(!1), Be(this, t) }, t.Oi = function() { return this.get("accuracy") }, t.Pi = function() { return this.get("accuracyGeometry") || null }, t.Ri = function() { return this.get("altitude") }, t.Si = function() { return this.get("altitudeAccuracy") }, t.Pk = function() { return this.get("heading") }, t.Qk = function() { return this.get("position") }, t.yg = function() { return this.get("projection") }, t.yj = function() { return this.get("speed") }, t.zg = function() { return this.get("tracking") }, t.kg = function() { return this.get("trackingOptions") }, t.Ag = function(t) { this.set("projection", t) }, t.ce = function(t) { this.set("tracking", t) }, t.Dh = function(t) { this.set("trackingOptions", t) };
    var Ew = new Ah({ color: "rgba(0,0,0,0.2)" }),
        Iw = [90, 45, 30, 20, 10, 5, 2, 1, .5, .2, .1, .05, .01, .005, .002, .001];

    function kw(t, e, o, i, n) { var s = n; return e = function(t, e, o, i, r) { return Rw((function(i) { return [t, e + (o - e) * i] }), vi(gi("EPSG:4326"), i), r) }(e, t.g, t.c, t.l, o), nu(s = r(t.a[s]) ? t.a[s] : new iu(null), "XY", e), Ho(s.R(), i) && (t.a[n++] = s), n }

    function Nw(t, e, o, i, n) { var s = n; return e = function(t, e, o, i, r) { return Rw((function(i) { return [e + (o - e) * i, t] }), vi(gi("EPSG:4326"), i), r) }(e, t.i, t.f, t.l, o), nu(s = r(t.b[s]) ? t.b[s] : new iu(null), "XY", e), Ho(s.R(), i) && (t.b[n++] = s), n }

    function Fw(t, e, o, i, r, n, s) { va.call(this, t, e, o, 0, i), this.l = r, this.b = new Image, null !== n && (this.b.crossOrigin = n), this.f = {}, this.c = null, this.state = 0, this.j = s }

    function Dw(t, e, o, i, r) { Hn.call(this, t, e), this.j = o, this.b = new Image, null !== i && (this.b.crossOrigin = i), this.c = {}, this.g = null, this.l = r }

    function Ow(t) { H(t.g, Re), t.g = null }

    function Bw() {}

    function Gw(t, e) {
        Oe.call(this), this.a = new Of(this);
        var o = t;
        e && (o = cn(t)), this.a.Ra(o, "dragenter", this.Xm), o != t && this.a.Ra(o, "dragover", this.Ym), this.a.Ra(t, "dragover", this.Zm), this.a.Ra(t, "drop", this.$m)
    }

    function Uw(t, e) { this.g = [], this.A = t, this.u = e || null, this.f = this.a = !1, this.c = void 0, this.B = this.D = this.j = !1, this.i = 0, this.b = null, this.l = 0 }

    function Xw(t, e, o) { t.a = !0, t.c = o, t.f = !e, Hw(t) }

    function Kw(t) {
        if (t.a) {
            if (!t.B) throw new Ww;
            t.B = !1
        }
    }

    function Yw(t, e, o, i) { t.g.push([e, o, i]), t.a && Hw(t) }

    function Vw(t) { return function(t, e) { return Y.some.call(t, (function(t) { return f(t[1]) }), void 0) }(t.g) }

    function Hw(t) {
        if (t.i && t.a && Vw(t)) {
            var e = t.i,
                o = Jw[e];
            o && (i.clearTimeout(o.ha), delete Jw[e]), t.i = 0
        }
        t.b && (t.b.l--, delete t.b), e = t.c;
        for (var n = o = !1; t.g.length && !t.j;) {
            var s = (a = t.g.shift())[0],
                p = a[1],
                a = a[2];
            if (s = t.f ? p : s) try {
                var h = s.call(a || t.u, e);
                r(h) && (t.f = t.f && (h == e || h instanceof Error), t.c = e = h), Iu(e) && (n = !0, t.j = !0)
            } catch (i) { e = i, t.f = !0, Vw(t) || (o = !0) }
        }
        t.c = e, n && (h = S(t.v, t, !0), n = S(t.v, t, !1), e instanceof Uw ? (Yw(e, h, n), e.D = !0) : e.then(h, n)), o && (e = new Zw(e), Jw[e.ha] = e, t.i = e.ha)
    }

    function Ww() { C.call(this) }

    function zw() { C.call(this) }

    function Zw(t) { this.ha = i.setTimeout(S(this.b, this), 0), this.a = t }(t = Lw.prototype).Tk = function() { return this.j }, t.nj = function() { return this.a }, t.sj = function() { return this.b }, t.pg = function(t) {
        var e = t.vectorContext;
        t = (r = t.frameState).extent;
        var o = (c = r.viewState).center,
            i = c.projection,
            r = (c = c.resolution) * c / (4 * (r = r.pixelRatio) * r);
        if (null === this.l || !di(this.l, i)) {
            var n = i.R(),
                s = (l = i.j)[2],
                p = l[1],
                a = l[0];
            this.c = l[3], this.f = s, this.g = p, this.i = a, l = gi("EPSG:4326"), this.B = vi(l, i), this.u = vi(i, l), this.v = this.u(Bo(n)), this.l = i
        }
        i = this.v[0], n = this.v[1];
        var h, l = -1,
            u = (p = Math.pow(this.ea * c, 2), a = [], []),
            c = 0;
        for (s = Iw.length; c < s && (h = Iw[c] / 2, a[0] = i - h, a[1] = n - h, u[0] = i + h, u[1] = n + h, this.B(a, a), this.B(u, u), !((h = Math.pow(u[0] - a[0], 2) + Math.pow(u[1] - a[1], 2)) <= p)); ++c) l = Iw[c];
        if (-1 == (c = l)) this.a.length = this.b.length = 0;
        else {
            for (o = (i = this.u(o))[0], i = i[1], n = this.A, s = kw(this, p = Xt(o = Math.floor(o / c) * c, this.i, this.f), r, t, 0), l = 0; p != this.i && l++ < n;) s = kw(this, p = Math.max(p - c, this.i), r, t, s);
            for (p = Xt(o, this.i, this.f), l = 0; p != this.f && l++ < n;) s = kw(this, p = Math.min(p + c, this.f), r, t, s);
            for (this.a.length = s, s = Nw(this, o = Xt(i = Math.floor(i / c) * c, this.g, this.c), r, t, 0), l = 0; o != this.g && l++ < n;) s = Nw(this, o = Math.max(o - c, this.g), r, t, s);
            for (o = Xt(i, this.g, this.c), l = 0; o != this.c && l++ < n;) s = Nw(this, o = Math.min(o + c, this.c), r, t, s);
            this.b.length = s
        }
        for (e.Ha(null, this.D), t = 0, r = this.a.length; t < r; ++t) o = this.a[t], e.Gb(o, null);
        for (t = 0, r = this.b.length; t < r; ++t) o = this.b[t], e.Gb(o, null)
    }, t.setMap = function(t) { null !== this.j && (this.j.J("postcompose", this.pg, this), this.j.render()), null !== t && (t.G("postcompose", this.pg, this), t.render()), this.j = t }, A(Fw, va), Fw.prototype.a = function(t) { if (r(t)) { var e = d(t); return e in this.f ? this.f[e] : (t = vt(this.f) ? this.b : this.b.cloneNode(!1), this.f[e] = t) } return this.b }, Fw.prototype.B = function() { this.state = 3, H(this.c, Re), this.c = null, Be(this, "change") }, Fw.prototype.v = function() { r(this.resolution) || (this.resolution = Uo(this.extent) / this.b.height), this.state = 2, H(this.c, Re), this.c = null, Be(this, "change") }, Fw.prototype.load = function() { 0 == this.state && (this.state = 1, Be(this, "change"), this.c = [Ae(this.b, "error", this.B, !1, this), Ae(this.b, "load", this.v, !1, this)], this.j(this, this.l)) }, A(Dw, Hn), (t = Dw.prototype).W = function() { 1 == this.state && Ow(this), Dw.$.W.call(this) }, t.Ta = function(t) { if (r(t)) { var e = d(t); return e in this.c ? this.c[e] : (t = vt(this.c) ? this.b : this.b.cloneNode(!1), this.c[e] = t) } return this.b }, t.ob = function() { return this.j }, t.Uk = function() { this.state = 3, Ow(this), Wn(this) }, t.Vk = function() { this.state = this.b.naturalWidth && this.b.naturalHeight ? 2 : 4, Ow(this), Wn(this) }, t.load = function() { 0 == this.state && (this.state = 1, Wn(this), this.g = [Ae(this.b, "error", this.Uk, !1, this), Ae(this.b, "load", this.Vk, !1, this)], this.l(this, this.j)) }, A(Gw, Oe), (t = Gw.prototype).ed = !1, t.W = function() { Gw.$.W.call(this), this.a.dd() }, t.Xm = function(t) {
        var e = t.a.dataTransfer;
        (this.ed = !(!e || !(e.types && (q(e.types, "Files") || q(e.types, "public.file-url")) || e.files && 0 < e.files.length))) && t.preventDefault()
    }, t.Ym = function(t) { this.ed && (t.preventDefault(), t.a.dataTransfer.dropEffect = "none") }, t.Zm = function(t) { this.ed && (t.preventDefault(), t.nb(), (t = t.a.dataTransfer).effectAllowed = "all", t.dropEffect = "copy") }, t.$m = function(t) { this.ed && (t.preventDefault(), t.nb(), (t = new he(t.a)).type = "drop", Be(this, t)) }, Uw.prototype.cancel = function(t) {
        if (this.a) this.c instanceof Uw && this.c.cancel();
        else {
            if (this.b) {
                var e = this.b;
                delete this.b, t ? e.cancel(t) : (e.l--, 0 >= e.l && e.cancel())
            }
            this.A ? this.A.call(this.u, this) : this.B = !0, this.a || (t = new zw, Kw(this), Xw(this, !1, t))
        }
    }, Uw.prototype.v = function(t, e) { this.j = !1, Xw(this, t, e) }, Uw.prototype.then = function(t, e, o) { var i, r, n = new Bu((function(t, e) { i = t, r = e })); return Yw(this, i, (function(t) { t instanceof zw ? n.cancel() : r(t) })), n.then(t, e, o) }, Eu(Uw), A(Ww, C), Ww.prototype.message = "Deferred has already fired", Ww.prototype.name = "AlreadyCalledError", A(zw, C), zw.prototype.message = "Deferred was canceled", zw.prototype.name = "CanceledError", Zw.prototype.b = function() { throw delete Jw[this.ha], this.a };
    var Jw = {};

    function qw(t, e) { r(t.name) ? (this.name = t.name, this.code = $w[t.name]) : (this.code = t.code, this.name = function(t) { var e = dt($w, (function(e) { return t == e })); if (!r(e)) throw Error("Invalid code: " + t); return e }(t.code)), C.call(this, function(t, e) { for (var o = t.split("%s"), i = "", r = Array.prototype.slice.call(arguments, 1); r.length && 1 < o.length;) i += o.shift() + r.shift(); return i + o.join("%s") }("%s %s", this.name, e)) }
    A(qw, C);
    var $w = { AbortError: 3, EncodingError: 5, InvalidModificationError: 9, InvalidStateError: 7, NotFoundError: 1, NotReadableError: 4, NoModificationAllowedError: 6, PathExistsError: 12, QuotaExceededError: 10, SecurityError: 2, SyntaxError: 8, TypeMismatchError: 11 };

    function _w(t, e) { re.call(this, t.type, e) }

    function Qw() { Oe.call(this), this.gb = new FileReader, this.gb.onloadstart = S(this.a, this), this.gb.onprogress = S(this.a, this), this.gb.onload = S(this.a, this), this.gb.onabort = S(this.a, this), this.gb.onerror = S(this.a, this), this.gb.onloadend = S(this.a, this) }

    function tS(t) {
        var e = new Uw;
        return t.Ra("loadend", x((function(t, e) {
            var o = e.gb.result,
                i = e.getError();
            null == o || i ? (Kw(t), Xw(t, !1, i)) : (Kw(t), Xw(t, !0, o)), e.dd()
        }), e, t)), e
    }

    function eS(t) { t = r(t) ? t : {}, za.call(this, { handleEvent: $o }), this.i = r(t.formatConstructors) ? t.formatConstructors : [], this.u = r(t.projection) ? gi(t.projection) : null, this.g = null, this.c = void 0 }
    A(_w, re), A(Qw, Oe), Qw.prototype.getError = function() { return this.gb.error && new qw(this.gb.error, "reading file") }, Qw.prototype.a = function(t) { Be(this, new _w(t, this)) }, Qw.prototype.W = function() { Qw.$.W.call(this), delete this.gb }, A(eS, za), eS.prototype.W = function() { r(this.c) && Re(this.c), eS.$.W.call(this) }, eS.prototype.j = function(t) {
        var e, o, i;
        for (e = 0, o = (t = t.a.dataTransfer.files).length; e < o; ++e) {
            var r = i = t[e],
                n = new Qw,
                s = tS(n);
            n.gb.readAsText(r, ""), Yw(s, x(this.l, i), null, this)
        }
    }, eS.prototype.l = function(t, e) {
        var o = this.v,
            i = this.u;
        null === i && (i = o.X().g);
        var r, n, s = [];
        for (r = 0, n = (o = this.i).length; r < n; ++r) {
            var p, a, h, l = new o[r];
            try { p = l.qa(e) } catch (t) { p = null }
            if (null !== p)
                for (l = vi(l = l.Ga(e), i), a = 0, h = p.length; a < h; ++a) {
                    var u = p[a],
                        c = u.Y();
                    null != c && c.va(l), s.push(u)
                }
        }
        Be(this, new iS(oS, this, t, s, i))
    }, eS.prototype.setMap = function(t) { r(this.c) && (Re(this.c), this.c = void 0), null !== this.g && (ie(this.g), this.g = null), eS.$.setMap.call(this, t), null !== t && (this.g = new Gw(t.b), this.c = Te(this.g, "drop", this.j, !1, this)) };
    var oS = "addfeatures";

    function iS(t, e, o, i, r) { re.call(this, t, e), this.features = i, this.file = o, this.projection = r }

    function rS(t, e) { this.x = t, this.y = e }

    function nS(t) { t = r(t) ? t : {}, sh.call(this, { handleDownEvent: aS, handleDragEvent: sS, handleUpEvent: pS }), this.l = r(t.condition) ? t.condition : ih, this.c = this.g = void 0, this.j = 0, this.A = r(t.duration) ? t.duration : 400 }

    function sS(t) {
        if (nh(t)) {
            var e = t.map,
                o = e.Ca();
            t = new rS((t = t.pixel)[0] - o[0] / 2, o[1] / 2 - t[1]), o = Math.atan2(t.y, t.x), t = Math.sqrt(t.x * t.x + t.y * t.y);
            var i = e.X(),
                n = gr(i);
            e.render(), r(this.g) && Za(e, i, n.rotation - (o - this.g)), this.g = o, r(this.c) && qa(e, i, n.resolution / t * this.c), r(this.c) && (this.j = this.c / t), this.c = t
        }
    }

    function pS(t) {
        if (!nh(t)) return !0;
        var e = (t = t.map).X();
        vr(e, -1);
        var o = gr(e),
            i = this.j - 1,
            r = o.rotation;
        return r = e.constrainRotation(r, 0), Za(t, e, r, void 0, void 0), o = o.resolution, r = this.A, o = e.constrainResolution(o, 0, i), qa(t, e, o, void 0, r), this.j = 0, !1
    }

    function aS(t) { return !(!nh(t) || !this.l(t) || (vr(t.map.X(), 1), this.c = this.g = void 0, 0)) }

    function hS(t, e) { re.call(this, t), this.feature = e }

    function lS(t) {
        if (sh.call(this, { handleDownEvent: yS, handleEvent: cS, handleUpEvent: fS }), this.aa = null, this.T = !1, this.sb = r(t.source) ? t.source : null, this.qb = r(t.features) ? t.features : null, this.Di = r(t.snapTolerance) ? t.snapTolerance : 12, this.Z = t.type, this.c = function(t) { var e; return "Point" === t || "MultiPoint" === t ? e = SS : "LineString" === t || "MultiLineString" === t ? e = xS : "Polygon" === t || "MultiPolygon" === t ? e = MS : "Circle" === t && (e = PS), e }(this.Z), this.Xa = r(t.minPoints) ? t.minPoints : this.c === MS ? 3 : 2, this.Na = r(t.maxPoints) ? t.maxPoints : 1 / 0, !r(o = t.geometryFunction))
            if ("Circle" === this.Z) o = function(t, e) { var o = r(e) ? e : new Jl([NaN, NaN]); return o.Af(t[0], Math.sqrt(io(t[0], t[1]))), o };
            else {
                var e, o;
                (o = this.c) === SS ? e = zi : o === xS ? e = iu : o === MS && (e = sr), o = function(t, o) { var i = o; return r(i) ? i.ja(t) : i = new e(t), i }
            }
        this.C = o, this.N = this.A = this.g = this.D = this.l = this.j = null, this.Ei = r(t.clickTolerance) ? t.clickTolerance * t.clickTolerance : 36, this.ra = new fl({ source: new sy({ useSpatialIndex: !1, wrapX: !!r(t.wrapX) && t.wrapX }), style: r(t.style) ? t.style : uS() }), this.rb = t.geometryName, this.vi = r(t.condition) ? t.condition : oh, this.xa = r(t.freehandCondition) ? t.freehandCondition : ih, Te(this, We("active"), this.tb, !1, this)
    }

    function uS() { var t = Dh(); return function(e) { return t[e.Y().U()] } }

    function cS(t) { var e = !this.T; return this.T && t.type === na ? (bS(this, t), e = !1) : t.type === sa ? e = gS(this, t) : t.type === ra && (e = !1), ah.call(this, t) && e }

    function yS(t) { return this.vi(t) ? (this.aa = t.pixel, !0) : !(this.c !== xS && this.c !== MS || !this.xa(t) || (this.aa = t.pixel, this.T = !0, null === this.j && vS(this, t), 0)) }

    function fS(t) {
        this.T = !1;
        var e = this.aa,
            o = t.pixel,
            i = e[0] - o[0];
        return e = e[1] - o[1], o = !0, i * i + e * e <= this.Ei && (gS(this, t), null === this.j ? vS(this, t) : (this.c === SS || this.c === PS) && null !== this.j || dS(this, t) ? this.fa() : bS(this, t), o = !1), o
    }

    function gS(t, e) {
        if (t.c === SS && null === t.j) vS(t, e);
        else if (null === t.j) {
            var o = e.coordinate.slice();
            null === t.D ? (t.D = new Lu(new zi(o)), wS(t)) : t.D.Y().ja(o)
        } else {
            o = e.coordinate;
            var i, r = t.l.Y();
            t.c === SS ? i = t.g : t.c === MS ? (i = (i = t.g[0])[i.length - 1], dS(t, e) && (o = t.j.slice())) : i = (i = t.g)[i.length - 1], i[0] = o[0], i[1] = o[1], t.C(t.g, r), null === t.D || t.D.Y().ja(o), r instanceof sr && t.c !== MS ? (null === t.A && (t.A = new Lu(new iu(null))), r = r.dg(0), nu(o = t.A.Y(), r.b, r.o)) : null !== t.N && (o = t.A.Y()).ja(t.N), wS(t)
        }
        return !0
    }

    function dS(t, e) {
        var o = !1;
        if (null !== t.l) {
            var i = !1,
                r = [t.j];
            if (t.c === xS ? i = t.g.length > t.Xa : t.c === MS && (i = t.g[0].length > t.Xa, r = [t.g[0][0], t.g[0][t.g[0].length - 2]]), i) {
                i = e.map;
                for (var n = 0, s = r.length; n < s; n++) {
                    var p = r[n],
                        a = i.ya(p),
                        h = (o = (h = e.pixel)[0] - a[0], a = h[1] - a[1], t.T && t.xa(e) ? 1 : t.Di);
                    if (o = Math.sqrt(o * o + a * a) <= h) { t.j = p; break }
                }
            }
        }
        return o
    }

    function vS(t, e) {
        var o = e.coordinate;
        t.j = o, t.c === SS ? t.g = o.slice() : t.c === MS ? (t.g = [
            [o.slice(), o.slice()]
        ], t.N = t.g[0]) : (t.g = [o.slice(), o.slice()], t.c === PS && (t.N = t.g)), null !== t.N && (t.A = new Lu(new iu(t.N))), o = t.C(t.g), t.l = new Lu, r(t.rb) && t.l.Pc(t.rb), t.l.Sa(o), wS(t), Be(t, new hS("drawstart", t.l))
    }

    function bS(t, e) {
        var o, i, r = e.coordinate,
            n = t.l.Y();
        t.c === xS ? (t.j = r.slice(), (i = t.g).push(r.slice()), o = i.length > t.Na, t.C(i, n)) : t.c === MS && ((i = t.g[0]).push(r.slice()), (o = i.length > t.Na) && (t.j = i[0]), t.C(t.g, n)), wS(t), o && t.fa()
    }

    function mS(t) { t.j = null; var e = t.l; return null !== e && (t.l = null, t.D = null, t.A = null, t.ra.da().clear(!0)), e }

    function wS(t) {
        var e = [];
        null === t.l || e.push(t.l), null === t.A || e.push(t.A), null === t.D || e.push(t.D), (t = t.ra.da()).clear(!0), t.xc(e)
    }
    A(iS, re), A(rS, Zr), rS.prototype.clone = function() { return new rS(this.x, this.y) }, rS.prototype.scale = Zr.prototype.scale, rS.prototype.add = function(t) { return this.x += t.x, this.y += t.y, this }, rS.prototype.rotate = function(t) {
        var e = Math.cos(t);
        t = Math.sin(t);
        var o = this.y * e + this.x * t;
        return this.x = this.x * e - this.y * t, this.y = o, this
    }, A(nS, sh), A(hS, re), A(lS, sh), lS.prototype.setMap = function(t) { lS.$.setMap.call(this, t), this.tb() }, lS.prototype.fa = function() {
        var t = mS(this),
            e = this.g,
            o = t.Y();
        this.c === xS ? (e.pop(), this.C(e, o)) : this.c === MS && (e[0].pop(), e[0].push(e[0][0]), this.C(e, o)), "MultiPoint" === this.Z ? t.Sa(new lu([e])) : "MultiLineString" === this.Z ? t.Sa(new su([e])) : "MultiPolygon" === this.Z && t.Sa(new uu([e])), Be(this, new hS("drawend", t)), null === this.qb || this.qb.push(t), null === this.sb || this.sb.pd(t)
    }, lS.prototype.tc = qo, lS.prototype.tb = function() {
        var t = this.v,
            e = this.b();
        null !== t && e || mS(this), this.ra.setMap(e ? t : null)
    };
    var SS = "Point",
        xS = "LineString",
        MS = "Polygon",
        PS = "Circle";

    function TS(t, e, o) { re.call(this, t), this.features = e, this.mapBrowserPointerEvent = o }

    function jS(t) { sh.call(this, { handleDownEvent: RS, handleDragEvent: LS, handleEvent: IS, handleUpEvent: ES }), this.fa = r(t.deleteCondition) ? t.deleteCondition : ei(oh, eh), this.aa = this.g = null, this.D = [0, 0], this.N = [NaN, NaN], this.c = new ey, this.A = r(t.pixelTolerance) ? t.pixelTolerance : 10, this.Z = !1, this.j = null, this.C = new fl({ source: new sy({ useSpatialIndex: !1, wrapX: !!r(t.wrapX) && t.wrapX }), style: r(t.style) ? t.style : FS(), updateWhileAnimating: !0, updateWhileInteracting: !0 }), this.T = { Point: this.zl, LineString: this.Gg, LinearRing: this.Gg, Polygon: this.Al, MultiPoint: this.xl, MultiLineString: this.wl, MultiPolygon: this.yl, GeometryCollection: this.vl }, this.l = t.features, this.l.forEach(this.Fg, this), Te(this.l, "add", this.tl, !1, this), Te(this.l, "remove", this.ul, !1, this) }

    function AS(t, e) {
        var o = t.g;
        null === o ? (o = new Lu(new zi(e)), t.g = o, t.C.da().pd(o)) : o.Y().ja(e)
    }

    function CS(t, e) { return t.index - e.index }

    function RS(t) {
        if (kS(this, t.pixel, t.map), this.j = [], null !== (e = this.g)) {
            var e, o = [],
                i = wo([e = e.Y().V()]),
                r = {};
            (i = iy(this.c, i)).sort(CS);
            for (var n = 0, s = i.length; n < s; ++n) {
                var p = i[n],
                    a = p.ia,
                    h = d(p.feature),
                    l = p.depth;
                l && (h += "-" + l.join("-")), r[h] || (r[h] = Array(2)), eo(a[0], e) && !r[h][0] ? (this.j.push([p, 0]), r[h][0] = p) : eo(a[1], e) && !r[h][1] ? ("LineString" !== p.geometry.U() && "MultiLineString" !== p.geometry.U() || !r[h][0] || 0 !== r[h][0].index) && (this.j.push([p, 1]), r[h][1] = p) : d(a) in this.aa && !r[h][0] && !r[h][1] && o.push([p, e])
            }
            for (n = o.length - 1; 0 <= n; --n) this.rk.apply(this, o[n]);
            Be(this, new TS("modifystart", this.l, t))
        }
        return null !== this.g
    }

    function LS(t) {
        t = t.coordinate;
        for (var e = 0, o = this.j.length; e < o; ++e) {
            for (var i = (a = this.j[e])[0], r = i.depth, n = i.geometry, s = n.V(), p = i.ia, a = a[1]; t.length < n.H;) t.push(0);
            switch (n.U()) {
                case "Point":
                    s = t, p[0] = p[1] = t;
                    break;
                case "MultiPoint":
                    s[i.index] = t, p[0] = p[1] = t;
                    break;
                case "LineString":
                    s[i.index + a] = t, p[a] = t;
                    break;
                case "MultiLineString":
                    s[r[0]][i.index + a] = t, p[a] = t;
                    break;
                case "Polygon":
                    s[r[0]][i.index + a] = t, p[a] = t;
                    break;
                case "MultiPolygon":
                    s[r[1]][r[0]][i.index + a] = t, p[a] = t
            }
            n.ja(s)
        }
        AS(this, t)
    }

    function ES(t) { for (var e, o = this.j.length - 1; 0 <= o; --o) e = this.j[o][0], this.c.update(wo(e.ia), e); return Be(this, new TS("modifyend", this.l, t)), !1 }

    function IS(t) {
        var e;
        if (t.map.X().c.slice()[1] || t.type != sa || this.u || (this.D = t.pixel, kS(this, t.pixel, t.map)), null !== this.g && this.fa(t))
            if (this.N[0] !== this.D[0] || this.N[1] !== this.D[1]) {
                this.g.Y();
                var o, i, n, s, p, a, h, l, u, c = {};
                for (p = (e = this.j).length - 1; 0 <= p; --p)
                    if (i = (s = (l = (n = e[p])[0]).geometry).V(), u = d(l.feature), l.depth && (u += "-" + l.depth.join("-")), o = h = a = void 0, 0 === n[1] ? (h = l, a = l.index) : 1 == n[1] && (o = l, a = l.index + 1), u in c || (c[u] = [o, h, a]), n = c[u], r(o) && (n[0] = o), r(h) && (n[1] = h), r(n[0]) && r(n[1])) {
                        switch (o = i, u = !1, h = a - 1, s.U()) {
                            case "MultiLineString":
                                i[l.depth[0]].splice(a, 1), u = !0;
                                break;
                            case "LineString":
                                i.splice(a, 1), u = !0;
                                break;
                            case "MultiPolygon":
                                o = o[l.depth[1]];
                            case "Polygon":
                                4 < (o = o[l.depth[0]]).length && (a == o.length - 1 && (a = 0), o.splice(a, 1), u = !0, 0 === a && (o.pop(), o.push(o[0]), h = o.length - 1))
                        }
                        u && (this.c.remove(n[0]), this.c.remove(n[1]), s.ja(i), i = { depth: l.depth, feature: l.feature, geometry: l.geometry, index: h, ia: [n[0].ia[0], n[1].ia[1]] }, this.c.oa(wo(i.ia), i), NS(this, s, a, l.depth, -1), this.C.da().Jc(this.g), this.g = null)
                    }
                e = !0
            } else e = !0;
        return ah.call(this, t) && !e
    }

    function kS(t, e, o) {
        var i = o.ta(e),
            r = wo([r = o.ta([e[0] - t.A, e[1] + t.A]), n = o.ta([e[0] + t.A, e[1] - t.A])]);
        if (0 < (r = iy(t.c, r)).length) {
            r.sort((function(t, e) { return ro(i, t.ia) - ro(i, e.ia) }));
            var n = r[0].ia,
                s = _e(i, n),
                p = o.ya(s);
            if (Math.sqrt(io(e, p)) <= t.A) { for (e = o.ya(n[0]), o = o.ya(n[1]), e = io(p, e), o = io(p, o), t.Z = Math.sqrt(Math.min(e, o)) <= t.A, t.Z && (s = e > o ? n[1] : n[0]), AS(t, s), (o = {})[d(n)] = !0, e = 1, p = r.length; e < p && (s = r[e].ia, eo(n[0], s[0]) && eo(n[1], s[1]) || eo(n[0], s[1]) && eo(n[1], s[0])); ++e) o[d(s)] = !0; return void(t.aa = o) }
        }
        null !== t.g && (t.C.da().Jc(t.g), t.g = null)
    }

    function NS(t, e, o, i, n) { ry(t.c, e.R(), (function(t) { t.geometry === e && (!r(i) || it(t.depth, i)) && t.index > o && (t.index += n) })) }

    function FS() { var t = Dh(); return function() { return t.Point } }

    function DS(t, e, o, i) { re.call(this, t), this.selected = e, this.deselected = o, this.mapBrowserEvent = i }

    function OS(t) {
        var e;
        if (za.call(this, { handleEvent: BS }), t = r(t) ? t : {}, this.u = r(t.condition) ? t.condition : eh, this.j = r(t.addCondition) ? t.addCondition : qo, this.C = r(t.removeCondition) ? t.removeCondition : qo, this.T = r(t.toggleCondition) ? t.toggleCondition : ih, this.l = !!r(t.multi) && t.multi, this.g = r(t.filter) ? t.filter : $o, r(t.layers))
            if (f(t.layers)) e = t.layers;
            else {
                var o = t.layers;
                e = function(t) { return q(o, t) }
            }
        else e = $o;
        this.i = e, this.c = new fl({ source: new sy({ useSpatialIndex: !1, wrapX: t.wrapX }), style: r(t.style) ? t.style : GS(), updateWhileAnimating: !0, updateWhileInteracting: !0 }), Te(t = this.c.da().c, "add", this.A, !1, this), Te(t, "remove", this.N, !1, this)
    }

    function BS(t) {
        if (!this.u(t)) return !0;
        var e = this.j(t),
            o = this.C(t),
            i = this.T(t),
            r = !e && !o && !i,
            n = t.map,
            s = this.c.da().c,
            p = [],
            a = [],
            h = !1;
        if (r) n.Re(t.pixel, (function(t, e) { if (this.g(t, e)) return a.push(t), !this.l }), this, this.i), 0 < a.length && 1 == s.Qb() && s.item(0) == a[0] || (h = !0, 0 !== s.Qb() && (p = Array.prototype.concat(s.b), s.clear()), s.ff(a));
        else {
            for (n.Re(t.pixel, (function(t, r) {-1 == V(s.b, t) ? (e || i) && this.g(t, r) && a.push(t) : (o || i) && p.push(t) }), this, this.i), r = p.length - 1; 0 <= r; --r) s.remove(p[r]);
            s.ff(a), (0 < a.length || 0 < p.length) && (h = !0)
        }
        return h && Be(this, new DS("select", a, p, t)), th(t)
    }

    function GS() {
        var t = Dh();
        return tt(t.Polygon, t.LineString), tt(t.GeometryCollection, t.LineString),
            function(e) { return t[e.Y().U()] }
    }

    function US(t) { sh.call(this, { handleEvent: XS, handleDownEvent: $o, handleUpEvent: KS }), t = r(t) ? t : {}, this.l = r(t.source) ? t.source : null, this.j = r(t.features) ? t.features : null, this.aa = [], this.D = {}, this.C = {}, this.T = {}, this.A = {}, this.N = null, this.g = r(t.pixelTolerance) ? t.pixelTolerance : 10, this.fa = S(YS, this), this.c = new ey, this.Z = { Point: this.Gl, LineString: this.Jg, LinearRing: this.Jg, Polygon: this.Hl, MultiPoint: this.El, MultiLineString: this.Dl, MultiPolygon: this.Fl, GeometryCollection: this.Cl } }

    function XS(t) {
        var e, o, i = t.pixel,
            r = t.coordinate,
            n = wo([n = (e = t.map).ta([i[0] - this.g, i[1] + this.g]), o = e.ta([i[0] + this.g, i[1] - this.g])]),
            s = iy(this.c, n),
            p = (n = !1, null);
        return o = null, 0 < s.length && (this.N = r, s.sort(this.fa), p = _e(r, s = s[0].ia), o = e.ya(p), Math.sqrt(io(i, o)) <= this.g && (n = !0, i = e.ya(s[0]), r = e.ya(s[1]), i = io(o, i), r = io(o, r), Math.sqrt(Math.min(i, r)) <= this.g)) && (p = i > r ? s[1] : s[0], o = e.ya(p), o = [Math.round(o[0]), Math.round(o[1])]), e = p, n && (t.coordinate = e.slice(0, 2), t.pixel = o), ah.call(this, t)
    }

    function KS() { var t = ct(this.A); return t.length && (H(t, this.Kh, this), this.A = {}), !1 }

    function YS(t, e) { return ro(this.N, t.ia) - ro(this.N, e.ia) }

    function VS(t) {
        var e = xt(t = r(t) ? t : {});
        delete e.gradient, delete e.radius, delete e.blur, delete e.shadow, delete e.weight, fl.call(this, e), this.f = null, this.Z = r(t.shadow) ? t.shadow : 250, this.D = void 0, this.v = null, Te(this, We("gradient"), this.Qj, !1, this), this.yh(r(t.gradient) ? t.gradient : HS), this.uh(r(t.blur) ? t.blur : 15), this.Lg(r(t.radius) ? t.radius : 8), Te(this, [We("blur"), We("radius")], this.qg, !1, this), this.qg();
        var o, i = r(t.weight) ? t.weight : "weight";
        o = c(i) ? function(t) { return t.get(i) } : i, this.g(S((function(t) {
            var e = 255 * (t = r(t = o(t)) ? Xt(t, 0, 1) : 1) | 0,
                i = this.v[e];
            return r(i) || (i = [new kh({ image: new Ea({ opacity: t, src: this.D }) })], this.v[e] = i), i
        }), this)), this.set("renderOrder", null), Te(this, "render", this.ik, !1, this)
    }
    A(TS, re), A(jS, sh), (t = jS.prototype).Fg = function(t) {
        var e = t.Y();
        r(this.T[e.U()]) && this.T[e.U()].call(this, t, e), null === (t = this.v) || kS(this, this.D, t)
    }, t.setMap = function(t) { this.C.setMap(t), jS.$.setMap.call(this, t) }, t.tl = function(t) { this.Fg(t.element) }, t.ul = function(t) {
        var e = t.element;
        t = this.c;
        var o, i = [];
        for (ry(t, e.Y().R(), (function(t) { e === t.feature && i.push(t) })), o = i.length - 1; 0 <= o; --o) t.remove(i[o]);
        null !== this.g && 0 === this.l.Qb() && (this.C.da().Jc(this.g), this.g = null)
    }, t.zl = function(t, e) {
        var o = e.V();
        o = { feature: t, geometry: e, ia: [o, o] }, this.c.oa(e.R(), o)
    }, t.xl = function(t, e) { var o, i, r, n = e.V(); for (i = 0, r = n.length; i < r; ++i) o = { feature: t, geometry: e, depth: [i], index: i, ia: [o = n[i], o] }, this.c.oa(e.R(), o) }, t.Gg = function(t, e) { var o, i, r, n, s = e.V(); for (o = 0, i = s.length - 1; o < i; ++o) n = { feature: t, geometry: e, index: o, ia: r = s.slice(o, o + 2) }, this.c.oa(wo(r), n) }, t.wl = function(t, e) {
        var o, i, r, n, s, p, a, h = e.V();
        for (n = 0, s = h.length; n < s; ++n)
            for (i = 0, r = (o = h[n]).length - 1; i < r; ++i) a = { feature: t, geometry: e, depth: [n], index: i, ia: p = o.slice(i, i + 2) }, this.c.oa(wo(p), a)
    }, t.Al = function(t, e) {
        var o, i, r, n, s, p, a, h = e.V();
        for (n = 0, s = h.length; n < s; ++n)
            for (i = 0, r = (o = h[n]).length - 1; i < r; ++i) a = { feature: t, geometry: e, depth: [n], index: i, ia: p = o.slice(i, i + 2) }, this.c.oa(wo(p), a)
    }, t.yl = function(t, e) {
        var o, i, r, n, s, p, a, h, l, u, c = e.V();
        for (p = 0, a = c.length; p < a; ++p)
            for (n = 0, s = (h = c[p]).length; n < s; ++n)
                for (i = 0, r = (o = h[n]).length - 1; i < r; ++i) u = { feature: t, geometry: e, depth: [n, p], index: i, ia: l = o.slice(i, i + 2) }, this.c.oa(wo(l), u)
    }, t.vl = function(t, e) { var o, i = e.f; for (o = 0; o < i.length; ++o) this.T[i[o].U()].call(this, t, i[o]) }, t.rk = function(t, e) {
        for (var o, i = t.ia, r = t.feature, n = t.geometry, s = t.depth, p = t.index; e.length < n.H;) e.push(0);
        switch (n.U()) {
            case "MultiLineString":
                (o = n.V())[s[0]].splice(p + 1, 0, e);
                break;
            case "Polygon":
                (o = n.V())[s[0]].splice(p + 1, 0, e);
                break;
            case "MultiPolygon":
                (o = n.V())[s[1]][s[0]].splice(p + 1, 0, e);
                break;
            case "LineString":
                (o = n.V()).splice(p + 1, 0, e);
                break;
            default:
                return
        }
        n.ja(o), (o = this.c).remove(t), NS(this, n, p, s, 1);
        var a = { ia: [i[0], e], feature: r, geometry: n, depth: s, index: p };
        o.oa(wo(a.ia), a), this.j.push([a, 1]), i = { ia: [e, i[1]], feature: r, geometry: n, depth: s, index: p + 1 }, o.oa(wo(i.ia), i), this.j.push([i, 0]), this.N = this.D
    }, A(DS, re), A(OS, za), OS.prototype.D = function() { return this.c.da().c }, OS.prototype.setMap = function(t) {
        var e = this.v,
            o = this.c.da().c;
        null === e || o.forEach(e.Jh, e), OS.$.setMap.call(this, t), this.c.setMap(t), null === t || o.forEach(t.Eh, t)
    }, OS.prototype.A = function(t) {
        t = t.element;
        var e = this.v;
        null === e || e.Eh(t)
    }, OS.prototype.N = function(t) {
        t = t.element;
        var e = this.v;
        null === e || e.Jh(t)
    }, A(US, sh), (t = US.prototype).md = function(t, e) {
        var o = !r(e) || e,
            i = t.Y(),
            n = this.Z[i.U()];
        if (r(n)) {
            var s = d(t);
            this.T[s] = i.R([1 / 0, 1 / 0, -1 / 0, -1 / 0]), n.call(this, t, i), o && (this.C[s] = i.G("change", S(this.Pj, this, t), this), this.D[s] = t.G(We(t.b), this.Bl, this))
        }
    }, t.Li = function(t) { this.md(t) }, t.Mi = function(t) { this.od(t) }, t.Hg = function(t) {
        var e;
        t instanceof uy ? e = t.feature : t instanceof Fr && (e = t.element), this.md(e)
    }, t.Ig = function(t) {
        var e;
        t instanceof uy ? e = t.feature : t instanceof Fr && (e = t.element), this.od(e)
    }, t.Bl = function(t) { t = t.c, this.od(t, !0), this.md(t, !0) }, t.Pj = function(t) {
        if (this.u) {
            var e = d(t);
            e in this.A || (this.A[e] = t)
        } else this.Kh(t)
    }, t.od = function(t, e) {
        var o = !r(e) || e,
            i = d(t),
            n = this.T[i];
        if (n) {
            var s = this.c,
                p = [];
            for (ry(s, n, (function(e) { t === e.feature && p.push(e) })), n = p.length - 1; 0 <= n; --n) s.remove(p[n]);
            o && (Re(this.C[i]), delete this.C[i], Re(this.D[i]), delete this.D[i])
        }
    }, t.setMap = function(t) {
        var e, o = this.v,
            i = this.aa;
        null === this.j ? null === this.l || (e = this.l.Ic()) : e = this.j, o && (H(i, Ke), i.length = 0, e.forEach(this.Mi, this)), US.$.setMap.call(this, t), t && (null !== this.j ? (i.push(this.j.G("add", this.Hg, this)), i.push(this.j.G("remove", this.Ig, this))) : null !== this.l && (i.push(this.l.G("addfeature", this.Hg, this)), i.push(this.l.G("removefeature", this.Ig, this))), e.forEach(this.Li, this))
    }, t.tc = qo, t.Kh = function(t) { this.od(t, !1), this.md(t, !1) }, t.Cl = function(t, e) { var o, i = e.f; for (o = 0; o < i.length; ++o) this.Z[i[o].U()].call(this, t, i[o]) }, t.Jg = function(t, e) { var o, i, r, n, s = e.V(); for (o = 0, i = s.length - 1; o < i; ++o) n = { feature: t, ia: r = s.slice(o, o + 2) }, this.c.oa(wo(r), n) }, t.Dl = function(t, e) {
        var o, i, r, n, s, p, a, h = e.V();
        for (n = 0, s = h.length; n < s; ++n)
            for (i = 0, r = (o = h[n]).length - 1; i < r; ++i) a = { feature: t, ia: p = o.slice(i, i + 2) }, this.c.oa(wo(p), a)
    }, t.El = function(t, e) { var o, i, r, n = e.V(); for (i = 0, r = n.length; i < r; ++i) o = { feature: t, ia: [o = n[i], o] }, this.c.oa(e.R(), o) }, t.Fl = function(t, e) {
        var o, i, r, n, s, p, a, h, l, u, c = e.V();
        for (p = 0, a = c.length; p < a; ++p)
            for (n = 0, s = (h = c[p]).length; n < s; ++n)
                for (i = 0, r = (o = h[n]).length - 1; i < r; ++i) u = { feature: t, ia: l = o.slice(i, i + 2) }, this.c.oa(wo(l), u)
    }, t.Gl = function(t, e) {
        var o = { feature: t, ia: [o = e.V(), o] };
        this.c.oa(e.R(), o)
    }, t.Hl = function(t, e) {
        var o, i, r, n, s, p, a, h = e.V();
        for (n = 0, s = h.length; n < s; ++n)
            for (i = 0, r = (o = h[n]).length - 1; i < r; ++i) a = { feature: t, ia: p = o.slice(i, i + 2) }, this.c.oa(wo(p), a)
    }, A(VS, fl);
    var HS = ["#00f", "#0ff", "#0f0", "#ff0", "#f00"];

    function WS() {
        if (this && this.th) {
            var t = this.th;
            t && "SCRIPT" == t.tagName && zS(t, !0, this.uc)
        }
    }

    function zS(t, e, o) { null != o && i.clearTimeout(o), t.onload = s, t.onerror = s, t.onreadystatechange = s, e && window.setTimeout((function() { an(t) }), 0) }

    function ZS(t, e) {
        var o = "Jsloader error (code #" + t + ")";
        e && (o += ": " + e), C.call(this, o), this.code = t
    }

    function JS(t, e) { this.b = new Ld(t), this.a = e || "callback", this.uc = 5e3 }(t = VS.prototype).Yf = function() { return this.get("blur") }, t.bg = function() { return this.get("gradient") }, t.Kg = function() { return this.get("radius") }, t.Qj = function() {
        for (var t = this.bg(), e = ip(1, 256), o = e.createLinearGradient(0, 0, 1, 256), i = 1 / (t.length - 1), r = 0, n = t.length; r < n; ++r) o.addColorStop(r * i, t[r]);
        e.fillStyle = o, e.fillRect(0, 0, 1, 256), this.f = e.getImageData(0, 0, 1, 256).data
    }, t.qg = function() {
        var t, e = this.Kg(),
            o = this.Yf(),
            i = e + o + 1;
        (t = ip(t = 2 * i, t)).shadowOffsetX = t.shadowOffsetY = this.Z, t.shadowBlur = o, t.shadowColor = "#000", t.beginPath(), o = i - this.Z, t.arc(o, o, e, 0, 2 * Math.PI, !0), t.fill(), this.D = t.canvas.toDataURL(), this.v = Array(256), this.s()
    }, t.ik = function(t) {
        var e, o, i, r = (t = t.context).canvas,
            n = (r = t.getImageData(0, 0, r.width, r.height)).data;
        for (e = 0, o = n.length; e < o; e += 4)(i = 4 * n[e + 3]) && (n[e] = this.f[i], n[e + 1] = this.f[i + 1], n[e + 2] = this.f[i + 2]);
        t.putImageData(r, 0, 0)
    }, t.uh = function(t) { this.set("blur", t) }, t.yh = function(t) { this.set("gradient", t) }, t.Lg = function(t) { this.set("radius", t) }, A(ZS, C);
    var qS = 0;

    function $S(t, e) { i._callbacks_[t] && (e ? delete i._callbacks_[t] : i._callbacks_[t] = s) }

    function _S(t) {
        var e = /\{z\}/g,
            o = /\{x\}/g,
            i = /\{y\}/g,
            r = /\{-y\}/g;
        return function(n) { return null === n ? void 0 : t.replace(e, n[0].toString()).replace(o, n[1].toString()).replace(i, (function() { return (-n[2] - 1).toString() })).replace(r, (function() { return ((1 << n[0]) + n[2]).toString() })) }
    }

    function QS(t) { return tx(z(t, _S)) }

    function tx(t) { return 1 === t.length ? t[0] : function(e, o, i) { return null === e ? void 0 : t[Kt((e[1] << e[0]) + e[2], t.length)](e, o, i) } }

    function ex() {}

    function ox(t) {
        var e = [],
            o = /\{(\d)-(\d)\}/.exec(t) || /\{([a-z])-([a-z])\}/.exec(t);
        if (o) { var i, r = o[2].charCodeAt(0); for (i = o[1].charCodeAt(0); i <= r; ++i) e.push(t.replace(o[0], String.fromCharCode(i))) } else e.push(t);
        return e
    }

    function ix(t) { hs.call(this, { attributions: t.attributions, extent: t.extent, logo: t.logo, opaque: t.opaque, projection: t.projection, state: r(t.state) ? t.state : void 0, tileGrid: t.tileGrid, tilePixelRatio: t.tilePixelRatio, wrapX: t.wrapX }), this.tileUrlFunction = r(t.tileUrlFunction) ? t.tileUrlFunction : ex, this.crossOrigin = r(t.crossOrigin) ? t.crossOrigin : null, this.tileLoadFunction = r(t.tileLoadFunction) ? t.tileLoadFunction : rx, this.tileClass = r(t.tileClass) ? t.tileClass : Dw }

    function rx(t, e) { t.Ta().src = e }

    function nx(t) { ix.call(this, { crossOrigin: "anonymous", opaque: !0, projection: gi("EPSG:3857"), state: "loading", tileLoadFunction: t.tileLoadFunction, wrapX: !r(t.wrapX) || t.wrapX }), this.i = r(t.culture) ? t.culture : "en-us", this.f = r(t.maxZoom) ? t.maxZoom : -1, new JS(new Ld("https://dev.virtualearth.net/REST/v1/Imagery/Metadata/" + t.imagerySet), "jsonp").send({ include: "ImageryProviders", uriScheme: "https", key: t.key }, S(this.l, this)) }
    JS.prototype.send = function(t, e, o, r) {
        t = t || null, r = r || "_" + (qS++).toString(36) + j().toString(36), i._callbacks_ || (i._callbacks_ = {});
        var n = this.b.clone();
        if (t)
            for (var s in t)
                if (!t.hasOwnProperty || t.hasOwnProperty(s)) {
                    var p = n,
                        a = s,
                        h = t[s];
                    l(h) || (h = [String(h)]), zd(p.a, a, h)
                }
        return e && (i._callbacks_[r] = function(t, e) { return function(o) { $S(t, !0), e.apply(void 0, arguments) } }(r, e), e = this.a, l(s = "_callbacks_." + r) || (s = [String(s)]), zd(n.a, e, s)), Yw(e = function(t, e) {
            var o = e || {},
                i = o.document || document,
                r = rn("SCRIPT"),
                n = { th: r, uc: void 0 },
                s = new Uw(WS, n),
                p = null,
                a = null != o.timeout ? o.timeout : 5e3;
            return 0 < a && (p = window.setTimeout((function() {
                    zS(r, !0);
                    var e = new ZS(1, "Timeout reached for loading script " + t);
                    Kw(s), Xw(s, !1, e)
                }), a), n.uc = p), r.onload = r.onreadystatechange = function() { r.readyState && "loaded" != r.readyState && "complete" != r.readyState || (zS(r, o.Hi || !1, p), Kw(s), Xw(s, !0, null)) }, r.onerror = function() {
                    zS(r, !0, p);
                    var e = new ZS(0, "Error while loading script " + t);
                    Kw(s), Xw(s, !1, e)
                }, _r(r, { type: "text/javascript", charset: "UTF-8", src: t }),
                function(t) { var e = t.getElementsByTagName("HEAD"); return e && 0 != e.length ? e[0] : t.documentElement }(i).appendChild(r), s
        }(n.toString(), { timeout: this.uc, Hi: !0 }), null, function(t, e, o) { return function() { $S(t, !1), o && o(e) } }(r, t, o), void 0), { ha: r, Uf: e }
    }, JS.prototype.cancel = function(t) { t && (t.Uf && t.Uf.cancel(), t.ha && $S(t.ha, !1)) }, A(ix, hs), (t = ix.prototype).bc = function(t, e, o, i, n) { var s = this.kb(t, e, o); return Kn(this.b, s) ? this.b.get(s) : (i = null === (e = cs(this, t = [t, e, o], n)) ? void 0 : this.tileUrlFunction(e, i, n), Te(i = new this.tileClass(t, r(i) ? 0 : 4, r(i) ? i : "", this.crossOrigin, this.tileLoadFunction), "change", this.km, !1, this), this.b.set(s, i), i) }, t.ab = function() { return this.tileLoadFunction }, t.bb = function() { return this.tileUrlFunction }, t.km = function(t) {
        switch ((t = t.target).state) {
            case 1:
                Be(this, new ys("tileloadstart", t));
                break;
            case 2:
                Be(this, new ys("tileloadend", t));
                break;
            case 3:
                Be(this, new ys("tileloaderror", t))
        }
    }, t.ib = function(t) { this.b.clear(), this.tileLoadFunction = t, this.s() }, t.Fa = function(t) { this.b.clear(), this.tileUrlFunction = t, this.s() }, t.Ef = function(t, e, o) { t = this.kb(t, e, o), Kn(this.b, t) && this.b.get(t) }, A(nx, ix);
    var sx = new Nr({ html: '<a class="ol-attribution-bing-tos" href="http://www.microsoft.com/maps/product/terms.html">Terms of Use</a>' });

    function px(t) { sy.call(this, { attributions: t.attributions, extent: t.extent, logo: t.logo, projection: t.projection }), this.N = void 0, this.aa = r(t.distance) ? t.distance : 20, this.C = [], this.u = t.source, this.u.G("change", px.prototype.ra, this) }

    function ax(t) {
        if (r(t.N)) {
            t.C.length = 0;
            for (var e = [1 / 0, 1 / 0, -1 / 0, -1 / 0], o = t.aa * t.N, i = t.u.Ic(), n = {}, s = 0, p = i.length; s < p; s++) {
                var a = i[s];
                ft(n, d(a).toString()) || (Lo(a = a.Y().V(), e), xo(e, o, e), a = W(a = t.u.Xe(e), (function(t) { return !((t = d(t).toString()) in n) && (n[t] = !0) })), t.C.push(hx(a)))
            }
        }
    }

    function hx(t) { for (var e = t.length, o = [0, 0], i = 0; i < e; i++) $e(o, t[i].Y().V()); return e = 1 / e, o[0] *= e, o[1] *= e, (o = new Lu(new zi(o))).set("features", t), o }

    function lx(t) {
        var e;
        Su.call(this, { projection: t.projection, resolutions: t.resolutions }), this.Z = r(t.crossOrigin) ? t.crossOrigin : null, this.i = r(t.displayDpi) ? t.displayDpi : 96, this.f = r(t.params) ? t.params : {}, e = r(t.url) ? function(t, e, o) { return function(i, r, n) { return o(t, e, i, r, n) } }(t.url, this.f, S(this.Rl, this)) : Bw, this.N = e, this.b = r(t.imageLoadFunction) ? t.imageLoadFunction : Mu, this.aa = !r(t.hidpi) || t.hidpi, this.T = r(t.metersPerUnit) ? t.metersPerUnit : 1, this.u = r(t.ratio) ? t.ratio : 1, this.fa = !!r(t.useOverlay) && t.useOverlay, this.c = null, this.C = 0
    }

    function ux(t) {
        var e, o, i = r(t.attributions) ? t.attributions : null,
            n = t.imageExtent;
        r(t.imageSize) && (o = [e = Uo(n) / t.imageSize[1]]);
        var s = r(t.crossOrigin) ? t.crossOrigin : null,
            p = r(t.imageLoadFunction) ? t.imageLoadFunction : Mu;
        Su.call(this, { attributions: i, logo: t.logo, projection: gi(t.projection), resolutions: o }), this.b = new Fw(n, e, 1, i, t.url, s, p), Te(this.b, "change", this.l, !1, this)
    }

    function cx(t) { t = r(t) ? t : {}, Su.call(this, { attributions: t.attributions, logo: t.logo, projection: t.projection, resolutions: t.resolutions }), this.aa = r(t.crossOrigin) ? t.crossOrigin : null, this.f = t.url, this.u = r(t.imageLoadFunction) ? t.imageLoadFunction : Mu, this.c = t.params, this.i = !0, gx(this), this.Z = t.serverType, this.fa = !r(t.hidpi) || t.hidpi, this.b = null, this.C = [0, 0], this.T = 0, this.N = r(t.ratio) ? t.ratio : 1.5 }
    nx.prototype.l = function(t) {
        if (200 != t.statusCode || "OK" != t.statusDescription || "ValidCredentials" != t.authenticationResultCode || 1 != t.resourceSets.length || 1 != t.resourceSets[0].resources.length) Jn(this, "error");
        else {
            var e = t.brandLogoUri; - 1 == e.indexOf("https") && (e = e.replace("http", "https"));
            var o = t.resourceSets[0].resources[0],
                i = -1 == this.f ? o.zoomMax : this.f,
                r = ss({ extent: t = as(this.j), minZoom: o.zoomMin, maxZoom: i, tileSize: o.imageWidth == o.imageHeight ? o.imageWidth : [o.imageWidth, o.imageHeight] });
            this.tileGrid = r;
            var n = this.i;
            if (this.tileUrlFunction = tx(z(o.imageUrlSubdomains, (function(t) {
                    var e = [0, 0, 0],
                        i = o.imageUrl.replace("{subdomain}", t).replace("{culture}", n);
                    return function(t) {
                        if (null !== t) return Tr(t[0], t[1], -t[2] - 1, e), i.replace("{quadkey}", function(t) {
                            var e, o, i = t[0],
                                r = Array(i),
                                n = 1 << i - 1;
                            for (e = 0; e < i; ++e) o = 48, t[1] & n && (o += 1), t[2] & n && (o += 2), r[e] = String.fromCharCode(o), n >>= 1;
                            return r.join("")
                        }(e))
                    }
                }))), o.imageryProviders) {
                var s = bi(gi("EPSG:4326"), this.j);
                (t = z(o.imageryProviders, (function(t) {
                    var e = t.attribution,
                        o = {};
                    return H(t.coverageAreas, (function(t) {
                        var e, n, p = t.zoomMin,
                            a = Math.min(t.zoomMax, i);
                        for (t = Zo([(t = t.bbox)[1], t[0], t[3], t[2]], s), e = p; e <= a; ++e) n = e.toString(), p = es(r, t, e), n in o ? o[n].push(p) : o[n] = [p]
                    })), new Nr({ html: e, tileRanges: o })
                }))).push(sx), this.g = t
            }
            this.ba = e, Jn(this, "ready")
        }
    }, A(px, sy), px.prototype.fa = function() { return this.u }, px.prototype.fc = function(t, e, o) { e !== this.N && (this.clear(), this.N = e, this.u.fc(t, e, o), ax(this), this.xc(this.C)) }, px.prototype.ra = function() { this.clear(), ax(this), this.xc(this.C), this.s() }, A(lx, Su), (t = lx.prototype).Ql = function() { return this.f }, t.Hc = function(t, e, o, i) { e = xu(this, e), o = this.aa ? o : 1; var n = this.c; return null !== n && this.C == this.a && n.resolution == e && n.g == o && jo(n.R(), t) || (1 != this.u && zo(t = t.slice(), this.u), r(i = this.N(t, [Vo(t) / e * o, Uo(t) / e * o], i)) ? Te(n = new Fw(t, e, o, this.g, i, this.Z, this.b), "change", this.l, !1, this) : n = null, this.c = n, this.C = this.a), n }, t.Pl = function() { return this.b }, t.Tl = function(t) { Pt(this.f, t), this.s() }, t.Rl = function(t, e, o, i) {
        var r;
        r = this.T;
        var n = Vo(o),
            s = Uo(o),
            p = i[0],
            a = i[1],
            h = .0254 / this.i;
        return r = a * n > p * s ? n * r / (p * h) : s * r / (a * h), o = Bo(o), Pt(i = { OPERATION: this.fa ? "GETDYNAMICMAPOVERLAYIMAGE" : "GETMAPIMAGE", VERSION: "2.0.0", LOCALE: "en", CLIENTAGENT: "ol.source.ImageMapGuide source", CLIP: "1", SETDISPLAYDPI: this.i, SETDISPLAYWIDTH: Math.round(i[0]), SETDISPLAYHEIGHT: Math.round(i[1]), SETVIEWSCALE: r, SETVIEWCENTERX: o[0], SETVIEWCENTERY: o[1] }, e), nc(pc([t], i))
    }, t.Sl = function(t) { this.c = null, this.b = t, this.s() }, A(ux, Su), ux.prototype.Hc = function(t) { return Ho(t, this.b.R()) ? this.b : null }, A(cx, Su);
    var yx = [101, 101];

    function fx(t, e, o, i, n, s) {
        if (s[t.i ? "CRS" : "SRS"] = n.a, "STYLES" in t.c || (s.STYLES = new String("")), 1 != i) switch (t.Z) {
            case "geoserver":
                i = 90 * i + .5 | 0, s.FORMAT_OPTIONS = r(s.FORMAT_OPTIONS) ? s.FORMAT_OPTIONS + ";dpi:" + i : "dpi:" + i;
                break;
            case "mapserver":
                s.MAP_RESOLUTION = 90 * i;
                break;
            case "carmentaserver":
            case "qgis":
                s.DPI = 90 * i
        }
        var p;
        return s.WIDTH = o[0], s.HEIGHT = o[1], o = n.f, p = t.i && "ne" == o.substr(0, 2) ? [e[1], e[0], e[3], e[2]] : e, s.BBOX = p.join(","), nc(pc([t.f], s))
    }

    function gx(t) { t.i = 0 <= U(wt(t.c, "VERSION", "1.3.0"), "1.3") }

    function dx(t) {
        var e = r(t.projection) ? t.projection : "EPSG:3857",
            o = r(t.tileGrid) ? t.tileGrid : ss({ extent: as(e), maxZoom: t.maxZoom, tileSize: t.tileSize });
        ix.call(this, { attributions: t.attributions, crossOrigin: t.crossOrigin, logo: t.logo, projection: e, tileGrid: o, tileLoadFunction: t.tileLoadFunction, tilePixelRatio: t.tilePixelRatio, tileUrlFunction: ex, wrapX: !r(t.wrapX) || t.wrapX }), r(t.tileUrlFunction) ? this.Fa(t.tileUrlFunction) : r(t.urls) ? this.Fa(QS(t.urls)) : r(t.url) && this.f(t.url)
    }

    function vx(t) {
        var e;
        t = r(t) ? t : {}, e = r(t.attributions) ? t.attributions : [bx], dx.call(this, { attributions: e, crossOrigin: r(t.crossOrigin) ? t.crossOrigin : "anonymous", opaque: !0, maxZoom: r(t.maxZoom) ? t.maxZoom : 19, tileLoadFunction: t.tileLoadFunction, url: r(t.url) ? t.url : "https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png", wrapX: t.wrapX })
    }(t = cx.prototype).Zl = function(t, e, o, i) {
        if (r(this.f)) {
            var n = Go(t, e, 0, yx),
                s = { SERVICE: "WMS", VERSION: "1.3.0", REQUEST: "GetFeatureInfo", FORMAT: "image/png", TRANSPARENT: !0, QUERY_LAYERS: this.c.LAYERS };
            return Pt(s, this.c, i), i = Math.floor((n[3] - t[1]) / e), s[this.i ? "I" : "X"] = Math.floor((t[0] - n[0]) / e), s[this.i ? "J" : "Y"] = i, fx(this, n, yx, 1, gi(o), s)
        }
    }, t.am = function() { return this.c }, t.Hc = function(t, e, o, i) {
        if (!r(this.f)) return null;
        e = xu(this, e), 1 == o || this.fa && r(this.Z) || (o = 1);
        var n = this.b;
        if (null !== n && this.T == this.a && n.resolution == e && n.g == o && jo(n.R(), t)) return n;
        Pt(n = { SERVICE: "WMS", VERSION: "1.3.0", REQUEST: "GetMap", FORMAT: "image/png", TRANSPARENT: !0 }, this.c);
        var s = ((t = t.slice())[0] + t[2]) / 2,
            p = (t[1] + t[3]) / 2;
        if (1 != this.N) {
            var a = this.N * Vo(t) / 2,
                h = this.N * Uo(t) / 2;
            t[0] = s - a, t[1] = p - h, t[2] = s + a, t[3] = p + h
        }
        a = e / o, h = Math.ceil(Vo(t) / a);
        var l = Math.ceil(Uo(t) / a);
        return t[0] = s - a * h / 2, t[2] = s + a * h / 2, t[1] = p - a * l / 2, t[3] = p + a * l / 2, this.C[0] = h, this.C[1] = l, i = fx(this, t, this.C, o, i, n), this.b = new Fw(t, e, o, this.g, i, this.aa, this.u), this.T = this.a, Te(this.b, "change", this.l, !1, this), this.b
    }, t.$l = function() { return this.u }, t.bm = function() { return this.f }, t.cm = function(t) { this.b = null, this.u = t, this.s() }, t.dm = function(t) { t != this.f && (this.f = t, this.b = null, this.s()) }, t.em = function(t) { Pt(this.c, t), gx(this), this.b = null, this.s() }, A(dx, ix), dx.prototype.f = function(t) { this.Fa(QS(ox(t))) }, A(vx, dx);
    var bx = new Nr({ html: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors.' });

    function mx(t) {
        t = r(t) ? t : {};
        var e = Sx[t.layer];
        this.i = t.layer, dx.call(this, { attributions: e.attributions, crossOrigin: "anonymous", logo: "https://developer.mapquest.com/content/osm/mq_logo.png", maxZoom: e.maxZoom, opaque: !0, tileLoadFunction: t.tileLoadFunction, url: r(t.url) ? t.url : "https://otile{1-4}-s.mqcdn.com/tiles/1.0.0/" + this.i + "/{z}/{x}/{y}.jpg" })
    }
    A(mx, dx);
    var wx = new Nr({ html: 'Tiles Courtesy of <a href="http://www.mapquest.com/">MapQuest</a>' }),
        Sx = { osm: { maxZoom: 19, attributions: [wx, bx] }, sat: { maxZoom: 18, attributions: [wx, new Nr({ html: "Portions Courtesy NASA/JPL-Caltech and U.S. Depart. of Agriculture, Farm Service Agency" })] }, hyb: { maxZoom: 18, attributions: [wx, bx] } };
    mx.prototype.l = function() { return this.i };
    var xx = { terrain: { Za: "jpg", opaque: !0 }, "terrain-background": { Za: "jpg", opaque: !0 }, "terrain-labels": { Za: "png", opaque: !1 }, "terrain-lines": { Za: "png", opaque: !1 }, "toner-background": { Za: "png", opaque: !0 }, toner: { Za: "png", opaque: !0 }, "toner-hybrid": { Za: "png", opaque: !1 }, "toner-labels": { Za: "png", opaque: !1 }, "toner-lines": { Za: "png", opaque: !1 }, "toner-lite": { Za: "png", opaque: !0 }, watercolor: { Za: "jpg", opaque: !0 } },
        Mx = { terrain: { minZoom: 4, maxZoom: 18 }, toner: { minZoom: 0, maxZoom: 20 }, watercolor: { minZoom: 3, maxZoom: 16 } };

    function Px(t) {
        var e = t.layer.indexOf("-"),
            o = xx[t.layer];
        dx.call(this, { attributions: Tx, crossOrigin: "anonymous", maxZoom: Mx[-1 == e ? t.layer : t.layer.slice(0, e)].maxZoom, opaque: o.opaque, tileLoadFunction: t.tileLoadFunction, url: r(t.url) ? t.url : "https://stamen-tiles-{a-d}.a.ssl.fastly.net/" + t.layer + "/{z}/{x}/{y}." + o.Za })
    }
    A(Px, dx);
    var Tx = [new Nr({ html: 'Map tiles by <a href="http://stamen.com/">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0/">CC BY 3.0</a>.' }), bx];

    function jx(t) {
        t = r(t) ? t : {};
        var e = r(t.params) ? t.params : {};
        ix.call(this, { attributions: t.attributions, crossOrigin: t.crossOrigin, logo: t.logo, projection: t.projection, tileGrid: t.tileGrid, tileLoadFunction: t.tileLoadFunction, tileUrlFunction: S(this.im, this), wrapX: !r(t.wrapX) || t.wrapX });
        var o = t.urls;
        !r(o) && r(t.url) && (o = ox(t.url)), this.i = null != o ? o : [], this.f = e, this.l = [1 / 0, 1 / 0, -1 / 0, -1 / 0]
    }

    function Ax(t, e, o) { Hn.call(this, t, 2), this.f = e, this.c = o, this.b = {} }

    function Cx(t) { hs.call(this, { opaque: !1, projection: t.projection, tileGrid: t.tileGrid, wrapX: !r(t.wrapX) || t.wrapX }) }

    function Rx(t) { ix.call(this, { attributions: t.attributions, crossOrigin: t.crossOrigin, projection: gi("EPSG:3857"), state: "loading", tileLoadFunction: t.tileLoadFunction, wrapX: !r(t.wrapX) || t.wrapX }), new JS(t.url).send(void 0, S(this.f, this)) }

    function Lx(t) { hs.call(this, { projection: gi("EPSG:3857"), state: "loading" }), this.l = !r(t.preemptive) || t.preemptive, this.f = ex, this.i = void 0, new JS(t.url).send(void 0, S(this.lm, this)) }

    function Ex(t, e, o, i, r) { Hn.call(this, t, e), this.j = o, this.b = i, this.l = r, this.f = this.g = this.c = null }

    function Ix(t, e) { if (null === t.c || null === t.g || null == t.f) return null; var o = t.c[Math.floor((1 - (e[1] - t.b[1]) / (t.b[3] - t.b[1])) * t.c.length)]; return c(o) ? (93 <= (o = o.charCodeAt(Math.floor((e[0] - t.b[0]) / (t.b[2] - t.b[0]) * o.length))) && o--, 35 <= o && o--, null != (o = t.g[o - 32]) ? t.f[o] : null) : null }

    function kx(t) { 0 == t.state && (t.state = 1, new JS(t.j).send(void 0, S(t.Yj, t), S(t.Oj, t))) }

    function Nx(t) { sy.call(this, { attributions: t.attributions, logo: t.logo, projection: void 0, state: "ready", wrapX: t.wrapX }), this.fa = r(t.format) ? t.format : null, this.C = t.tileGrid, this.N = ex, this.aa = r(t.tileLoadFunction) ? t.tileLoadFunction : null, this.u = {}, r(t.tileUrlFunction) ? (this.N = t.tileUrlFunction, this.s()) : r(t.urls) ? (this.N = QS(t.urls), this.s()) : r(t.url) && (this.N = QS(ox(t.url)), this.s()) }

    function Fx(t, e, o) { var i = t.C; return t.D && o.c && (e = Cr(e, i, o)), Rr(e, i) ? e : null }

    function Dx(t) {
        t = r(t) ? t : {};
        var e = r(t.params) ? t.params : {};
        ix.call(this, { attributions: t.attributions, crossOrigin: t.crossOrigin, logo: t.logo, opaque: !wt(e, "TRANSPARENT", !0), projection: t.projection, tileGrid: t.tileGrid, tileLoadFunction: t.tileLoadFunction, tileUrlFunction: S(this.qm, this), wrapX: !r(t.wrapX) || t.wrapX });
        var o = t.urls;
        !r(o) && r(t.url) && (o = ox(t.url)), this.i = null != o ? o : [], this.v = r(t.gutter) ? t.gutter : 0, this.f = e, this.l = !0, this.u = t.serverType, this.N = !r(t.hidpi) || t.hidpi, this.C = "", Bx(this), this.T = [1 / 0, 1 / 0, -1 / 0, -1 / 0], Gx(this)
    }

    function Ox(t, e, o, i, n, s, p) {
        var a = t.i;
        if (0 != a.length) {
            if (p.WIDTH = o[0], p.HEIGHT = o[1], p[t.l ? "CRS" : "SRS"] = s.a, "STYLES" in t.f || (p.STYLES = new String("")), 1 != n) switch (t.u) {
                case "geoserver":
                    o = 90 * n + .5 | 0, p.FORMAT_OPTIONS = r(p.FORMAT_OPTIONS) ? p.FORMAT_OPTIONS + ";dpi:" + o : "dpi:" + o;
                    break;
                case "mapserver":
                    p.MAP_RESOLUTION = 90 * n;
                    break;
                case "carmentaserver":
                case "qgis":
                    p.DPI = 90 * n
            }
            return s = s.f, t.l && "ne" == s.substr(0, 2) && (t = i[0], i[0] = i[1], i[1] = t, t = i[2], i[2] = i[3], i[3] = t), p.BBOX = i.join(","), nc(pc([1 == a.length ? a[0] : a[Kt((e[1] << e[0]) + e[2], a.length)]], p))
        }
    }

    function Bx(t) {
        var e, o, i = 0,
            r = [];
        for (e = 0, o = t.i.length; e < o; ++e) r[i++] = t.i[e];
        for (var n in t.f) r[i++] = n + "-" + t.f[n];
        t.C = r.join("#")
    }

    function Gx(t) { t.l = 0 <= U(wt(t.f, "VERSION", "1.3.0"), "1.3") }

    function Ux(t) { this.j = t.matrixIds, qn.call(this, { extent: t.extent, origin: t.origin, origins: t.origins, resolutions: t.resolutions, tileSize: t.tileSize, tileSizes: t.tileSizes, sizes: t.sizes }) }

    function Xx(t, e) {
        var o, i = [],
            r = [],
            n = [],
            s = [],
            p = [],
            a = (o = gi(t.SupportedCRS.replace(/urn:ogc:def:crs:(\w+):(.*:)?(\w+)$/, "$1:$3"))).Nd(),
            h = "ne" == o.f.substr(0, 2);
        return ot(t.TileMatrix, (function(t, e) { return e.ScaleDenominator - t.ScaleDenominator })), H(t.TileMatrix, (function(t) {
            r.push(t.Identifier);
            var e = 28e-5 * t.ScaleDenominator / a,
                o = t.TileWidth,
                l = t.TileHeight;
            h ? n.push([t.TopLeftCorner[1], t.TopLeftCorner[0]]) : n.push(t.TopLeftCorner), i.push(e), s.push(o == l ? o : [o, l]), p.push([t.MatrixWidth, -t.MatrixHeight])
        })), new Ux({ extent: e, origins: n, resolutions: i, matrixIds: r, tileSizes: s, sizes: p })
    }

    function Kx(t) {
        this.T = r(t.version) ? t.version : "1.0.0", this.u = r(t.format) ? t.format : "image/jpeg", this.f = r(t.dimensions) ? t.dimensions : {}, this.v = "", Yx(this), this.C = t.layer, this.l = t.matrixSet, this.N = t.style, !r(s = t.urls) && r(t.url) && (s = ox(t.url)), this.i = null != s ? s : [];
        var e = this.Z = r(t.requestEncoding) ? t.requestEncoding : "KVP",
            o = t.tileGrid,
            i = { layer: this.C, style: this.N, tilematrixset: this.l };
        "KVP" == e && Pt(i, { Service: "WMTS", Request: "GetTile", Version: this.T, Format: this.u });
        var n = this.f,
            s = 0 < this.i.length ? tx(z(this.i, (function(t) {
                return t = "KVP" == e ? nc(pc([t], i)) : t.replace(/\{(\w+?)\}/g, (function(t, e) { return e.toLowerCase() in i ? i[e.toLowerCase()] : t })),
                    function(i) { if (null !== i) { var r = { TileMatrix: o.j[i[0]], TileCol: i[1], TileRow: -i[2] - 1 }; return Pt(r, n), i = t, i = "KVP" == e ? nc(pc([i], r)) : i.replace(/\{(\w+?)\}/g, (function(t, e) { return r[e] })) } }
            }))) : ex;
        ix.call(this, { attributions: t.attributions, crossOrigin: t.crossOrigin, logo: t.logo, projection: t.projection, tileClass: t.tileClass, tileGrid: o, tileLoadFunction: t.tileLoadFunction, tilePixelRatio: t.tilePixelRatio, tileUrlFunction: s, wrapX: !!r(t.wrapX) && t.wrapX })
    }

    function Yx(t) {
        var e, o = 0,
            i = [];
        for (e in t.f) i[o++] = e + "-" + t.f[e];
        t.v = i.join("/")
    }

    function Vx(t) {
        var e = (p = (t = r(t) ? t : {}).size)[0],
            o = p[1],
            i = [],
            n = 256;
        switch (r(t.tierSizeCalculation) ? t.tierSizeCalculation : "default") {
            case "default":
                for (; e > n || o > n;) i.push([Math.ceil(e / n), Math.ceil(o / n)]), n += n;
                break;
            case "truncated":
                for (; e > n || o > n;) i.push([Math.ceil(e / n), Math.ceil(o / n)]), e >>= 1, o >>= 1
        }
        i.push([1, 1]), i.reverse(), n = [1];
        var s = [0];
        for (o = 1, e = i.length; o < e; o++) n.push(1 << o), s.push(i[o - 1][0] * i[o - 1][1] + s[o - 1]);
        n.reverse();
        var p = new qn({ extent: p = [0, -p[1], p[0], 0], origin: Ko(p), resolutions: n }),
            a = t.url;
        ix.call(this, {
            attributions: t.attributions,
            crossOrigin: t.crossOrigin,
            logo: t.logo,
            tileClass: Hx,
            tileGrid: p,
            tileUrlFunction: function(t) {
                if (null !== t) {
                    var e = t[0],
                        o = t[1];
                    return t = -t[2] - 1, a + "TileGroup" + ((o + t * i[e][0] + s[e]) / 256 | 0) + "/" + e + "-" + o + "-" + t + ".jpg"
                }
            }
        })
    }

    function Hx(t, e, o, i, r) { Dw.call(this, t, e, o, i, r), this.f = {} }

    function Wx(t) { t = r(t) ? t : {}, this.b = r(t.initialSize) ? t.initialSize : 256, this.c = r(t.maxSize) ? t.maxSize : r(M) ? M : 2048, this.a = r(t.space) ? t.space : 1, this.g = [new Zx(this.b, this.a)], this.f = this.b, this.i = [new Zx(this.f, this.a)] }

    function zx(t, e, o, i, r, n, s) {
        var p, a, h, l = e ? t.i : t.g;
        for (a = 0, h = l.length; a < h; ++a) {
            if (null !== (p = (p = l[a]).add(o, i, r, n, s))) return p;
            null === p && a === h - 1 && (e ? (p = Math.min(2 * t.f, t.c), t.f = p) : (p = Math.min(2 * t.b, t.c), t.b = p), p = new Zx(p, t.a), l.push(p), ++h)
        }
    }

    function Zx(t, e) { this.a = e, this.b = [{ x: 0, y: 0, width: t, height: t }], this.f = {}, this.c = rn("CANVAS"), this.c.width = t, this.c.height = t, this.g = this.c.getContext("2d") }

    function Jx(t, e, o, i) { e = [e, 1], 0 < o.width && 0 < o.height && e.push(o), 0 < i.width && 0 < i.height && e.push(i), t.b.splice.apply(t.b, e) }

    function qx(t) {
        this.u = this.f = this.g = null, this.l = r(t.fill) ? t.fill : null, this.N = [0, 0], this.a = t.points, this.c = r(t.radius) ? t.radius : t.radius1, this.i = r(t.radius2) ? t.radius2 : this.c, this.j = r(t.angle) ? t.angle : 0, this.b = r(t.stroke) ? t.stroke : null, this.C = this.T = this.ca = null;
        var e, o = t.atlasManager,
            i = "",
            n = "",
            s = 0,
            p = null,
            a = 0;
        if (null !== this.b && (e = Kr(this.b.a), r(a = this.b.b) || (a = 1), p = this.b.c, yp || (p = null), r(n = this.b.g) || (n = "round"), r(i = this.b.f) || (i = "round"), r(s = this.b.i) || (s = 10)), i = { strokeStyle: e, ud: a, size: l = 2 * (this.c + a) + 1, lineCap: i, lineDash: p, lineJoin: n, miterLimit: s }, r(o)) {
            var h, l = Math.round(l);
            (n = null === this.l) && (h = S(this.Ug, this, i)), s = this.zb(), h = o.add(s, l, l, S(this.Vg, this, i), h), this.f = h.image, this.N = [h.offsetX, h.offsetY], o = h.image.width, this.u = n ? h.rg : this.f
        } else this.f = rn("CANVAS"), this.f.height = l, this.f.width = l, o = l = this.f.width, h = this.f.getContext("2d"), this.Vg(i, h, 0, 0), null === this.l ? ((h = this.u = rn("CANVAS")).height = i.size, h.width = i.size, h = h.getContext("2d"), this.Ug(i, h, 0, 0)) : this.u = this.f;
        this.ca = [l / 2, l / 2], this.T = [l, l], this.C = [o, o], La.call(this, { opacity: 1, rotateWithView: !1, rotation: r(t.rotation) ? t.rotation : 0, scale: 1, snapToPixel: !r(t.snapToPixel) || t.snapToPixel })
    }
    return A(jx, ix), (t = jx.prototype).fm = function() { return this.f }, t.cc = function(t, e, o) { return t = jx.$.cc.call(this, t, e, o), 1 == e ? t : Je(t, e, this.c) }, t.gm = function() { return this.i }, t.hm = function(t) { t = r(t) ? ox(t) : null, this.Qg(t) }, t.Qg = function(t) { this.i = null != t ? t : [], this.s() }, t.im = function(t, e, o) {
        var i = this.tileGrid;
        if (null === i && (i = us(this, o)), !(i.a.length <= t[0])) {
            var r = is(i, t, this.l),
                n = qe(i.Ja(t[0]), this.c);
            1 != e && (n = Je(n, e, this.c)), Pt(i = { F: "image", FORMAT: "PNG32", TRANSPARENT: !0 }, this.f);
            var s = this.i;
            return 0 == s.length ? t = void 0 : (o = o.a.split(":").pop(), i.SIZE = n[0] + "," + n[1], i.BBOX = r.join(","), i.BBOXSR = o, i.IMAGESR = o, i.DPI = Math.round(90 * e), R(t = 1 == s.length ? s[0] : s[Kt((t[1] << t[0]) + t[2], s.length)], "/") || (t += "/"), R(t, "MapServer/") ? t += "export" : R(t, "ImageServer/") && (t += "exportImage"), t = nc(pc([t], i))), t
        }
    }, t.jm = function(t) { Pt(this.f, t), this.s() }, A(Ax, Hn), Ax.prototype.Ta = function(t) {
        if ((t = r(t) ? d(t) : -1) in this.b) return this.b[t];
        var e = this.f,
            o = ip(e[0], e[1]);
        return o.strokeStyle = "black", o.strokeRect(.5, .5, e[0] + .5, e[1] + .5), o.fillStyle = "black", o.textAlign = "center", o.textBaseline = "middle", o.font = "24px sans-serif", o.fillText(this.c, e[0] / 2, e[1] / 2), this.b[t] = o.canvas
    }, A(Cx, hs), Cx.prototype.bc = function(t, e, o) { var i = this.kb(t, e, o); if (Kn(this.b, i)) return this.b.get(i); var r = qe(this.tileGrid.Ja(t)); return r = new Ax(t = [t, e, o], r, e = null === (e = cs(this, t)) ? "" : Ar(cs(this, e))), this.b.set(i, r), r }, A(Rx, ix), Rx.prototype.f = function(t) {
        var e, o = gi("EPSG:4326"),
            i = this.j;
        r(t.bounds) && (e = Zo(t.bounds, bi(o, i)));
        var n = t.minzoom || 0,
            s = t.maxzoom || 22;
        if (this.tileGrid = i = ss({ extent: as(i), maxZoom: s, minZoom: n }), this.tileUrlFunction = QS(t.tiles), r(t.attribution) && null === this.g) {
            for (o = r(e) ? e : o.R(), e = {}; n <= s; ++n) e[n.toString()] = [es(i, o, n)];
            this.g = [new Nr({ html: t.attribution, tileRanges: e })]
        }
        Jn(this, "ready")
    }, A(Lx, hs), (t = Lx.prototype).zj = function() { return this.i }, t.Ki = function(t, e, o, i, r) { null === this.tileGrid ? !0 === r ? Fs((function() { o.call(i, null) })) : o.call(i, null) : (e = this.tileGrid.jd(t, e), function(t, e, o, i, r) { 0 == t.state && !0 === r ? (Ae(t, "change", (function() { o.call(i, Ix(this, e)) }), !1, t), kx(t)) : !0 === r ? Fs((function() { o.call(i, Ix(this, e)) }), t) : o.call(i, Ix(t, e)) }(this.bc(e[0], e[1], e[2], 1, this.j), t, o, i, r)) }, t.lm = function(t) {
        var e, o = gi("EPSG:4326"),
            i = this.j;
        r(t.bounds) && (e = Zo(t.bounds, bi(o, i)));
        var n = t.minzoom || 0,
            s = t.maxzoom || 22;
        this.tileGrid = i = ss({ extent: as(i), maxZoom: s, minZoom: n }), this.i = t.template;
        var p = t.grids;
        if (null != p) {
            if (this.f = QS(p), r(t.attribution)) {
                for (o = r(e) ? e : o.R(), e = {}; n <= s; ++n) e[p = n.toString()] = [es(i, o, n)];
                this.g = [new Nr({ html: t.attribution, tileRanges: e })]
            }
            Jn(this, "ready")
        } else Jn(this, "error")
    }, t.bc = function(t, e, o, i, n) { var s = this.kb(t, e, o); return Kn(this.b, s) ? this.b.get(s) : (e = cs(this, t = [t, e, o], n), i = new Ex(t, r(i = this.f(e, i, n)) ? 0 : 4, r(i) ? i : "", is(this.tileGrid, t), this.l), this.b.set(s, i), i) }, t.Ef = function(t, e, o) { t = this.kb(t, e, o), Kn(this.b, t) && this.b.get(t) }, A(Ex, Hn), (t = Ex.prototype).Ta = function() { return null }, t.ob = function() { return this.j }, t.Oj = function() { this.state = 3, Wn(this) }, t.Yj = function(t) { this.c = t.grid, this.g = t.keys, this.f = t.data, this.state = 4, Wn(this) }, t.load = function() { this.l && kx(this) }, A(Nx, sy), (t = Nx.prototype).clear = function() { bt(this.u) }, t.Hb = function(t, e, o, i) {
        var n, s = this.C,
            p = this.u;
        for (s = (t = es(s, t, e = ns(s, e))).a; s <= t.f; ++s)
            for (n = t.b; n <= t.c; ++n) {
                var a, h, l = p[e + "/" + s + "/" + n];
                if (r(l))
                    for (a = 0, h = l.length; a < h; ++a) { var u = o.call(i, l[a]); if (u) return u }
            }
    }, t.Ic = function() {
        var t, e = this.u,
            o = [];
        for (t in e) tt(o, e[t]);
        return o
    }, t.Zi = function(t, e) {
        var o = [];
        return function(t, e, o, i) {
            var n = t.u;
            if (r(n = n[(t = t.C.jd(e, o))[0] + "/" + t[1] + "/" + t[2]]))
                for (t = 0, o = n.length; t < o; ++t) { var s = n[t]; if (s.Y().Ne(e) && i.call(void 0, s)) break }
        }(this, t, e, (function(t) { o.push(t) })), o
    }, t.fc = function(t, e, o) {
        function i(t, e) { h[t] = e, this.s() }
        var n, s, p = this.C,
            a = this.N,
            h = this.u,
            l = ns(p, e),
            u = [l, 0, 0];
        for (n = (p = es(p, t, l)).a; n <= p.f; ++n)
            for (s = p.b; s <= p.c; ++s) {
                var c, y = l + "/" + n + "/" + s;
                y in h || (u[1] = n, u[2] = s, r(c = null === (c = Fx(this, u, o)) ? void 0 : a(c, 1, o)) && (h[y] = [], y = x(i, y), null === this.aa ? _c(c, this.fa, y).call(this, t, e, o) : this.aa(c, S(y, this))))
            }
    }, A(Dx, ix), (t = Dx.prototype).mm = function(t, e, o, i) {
        if (o = gi(o), null === (s = this.tileGrid) && (s = us(this, o)), e = s.jd(t, e), !(s.a.length <= e[0])) {
            var r = s.ua(e[0]),
                n = is(s, e, this.T),
                s = qe(s.Ja(e[0]), this.c),
                p = this.v;
            return 0 !== p && (s = Ze(s, p, this.c), n = xo(n, r * p, n)), Pt(p = { SERVICE: "WMS", VERSION: "1.3.0", REQUEST: "GetFeatureInfo", FORMAT: "image/png", TRANSPARENT: !0, QUERY_LAYERS: this.f.LAYERS }, this.f, i), i = Math.floor((n[3] - t[1]) / r), p[this.l ? "I" : "X"] = Math.floor((t[0] - n[0]) / r), p[this.l ? "J" : "Y"] = i, Ox(this, e, s, n, 1, o, p)
        }
    }, t.Kd = function() { return this.v }, t.kb = function(t, e, o) { return this.C + Dx.$.kb.call(this, t, e, o) }, t.nm = function() { return this.f }, t.cc = function(t, e, o) { return t = Dx.$.cc.call(this, t, e, o), 1 != e && this.N && r(this.u) ? Je(t, e, this.c) : t }, t.om = function() { return this.i }, t.pm = function(t) { t = r(t) ? ox(t) : null, this.Rg(t) }, t.Rg = function(t) { this.i = null != t ? t : [], Bx(this), this.s() }, t.qm = function(t, e, o) {
        if (null === (s = this.tileGrid) && (s = us(this, o)), !(s.a.length <= t[0])) {
            1 == e || this.N && r(this.u) || (e = 1);
            var i = s.ua(t[0]),
                n = is(s, t, this.T),
                s = qe(s.Ja(t[0]), this.c),
                p = this.v;
            return 0 !== p && (s = Ze(s, p, this.c), n = xo(n, i * p, n)), 1 != e && (s = Je(s, e, this.c)), Pt(i = { SERVICE: "WMS", VERSION: "1.3.0", REQUEST: "GetMap", FORMAT: "image/png", TRANSPARENT: !0 }, this.f), Ox(this, t, s, n, e, o, i)
        }
    }, t.rm = function(t) { Pt(this.f, t), Bx(this), Gx(this), this.s() }, A(Ux, qn), Ux.prototype.B = function() { return this.j }, A(Kx, ix), (t = Kx.prototype).Xi = function() { return this.f }, t.aj = function() { return this.u }, t.kb = function(t, e, o) { return this.v + Kx.$.kb.call(this, t, e, o) }, t.sm = function() { return this.C }, t.mj = function() { return this.l }, t.xj = function() { return this.Z }, t.tm = function() { return this.N }, t.um = function() { return this.i }, t.Dj = function() { return this.T }, t.ro = function(t) { Pt(this.f, t), Yx(this), this.s() }, A(Vx, ix), A(Hx, Dw), Hx.prototype.Ta = function(t) { var e = r(t) ? d(t).toString() : ""; if (e in this.f) return this.f[e]; if (t = Hx.$.Ta.call(this, t), 2 == this.state) { if (256 == t.width && 256 == t.height) return this.f[e] = t; var o = ip(256, 256); return o.drawImage(t, 0, 0), this.f[e] = o.canvas } return t }, Wx.prototype.add = function(t, e, o, i, n, s) { return e + this.a > this.c || o + this.a > this.c || null === (i = zx(this, !1, t, e, o, i, s)) ? null : (t = zx(this, !0, t, e, o, r(n) ? n : _o, s), { offsetX: i.offsetX, offsetY: i.offsetY, image: i.image, rg: t.image }) }, Zx.prototype.get = function(t) { return wt(this.f, t, null) }, Zx.prototype.add = function(t, e, o, i, r) {
        var n, s, p;
        for (s = 0, p = this.b.length; s < p; ++s)
            if ((n = this.b[s]).width >= e + this.a && n.height >= o + this.a) return p = { offsetX: n.x + this.a, offsetY: n.y + this.a, image: this.c }, this.f[t] = p, i.call(r, this.g, n.x + this.a, n.y + this.a), t = s, e += this.a, o += this.a, r = i = void 0, n.width - e > n.height - o ? Jx(this, t, i = { x: n.x + e, y: n.y, width: n.width - e, height: n.height }, r = { x: n.x, y: n.y + o, width: e, height: n.height - o }) : Jx(this, t, i = { x: n.x + e, y: n.y, width: n.width - e, height: o }, r = { x: n.x, y: n.y + o, width: n.width, height: n.height - o }), p;
        return null
    }, A(qx, La), (t = qx.prototype).yb = function() { return this.ca }, t.zm = function() { return this.j }, t.Am = function() { return this.l }, t.le = function() { return this.u }, t.Sb = function() { return this.f }, t.Ld = function() { return this.C }, t.qd = function() { return 2 }, t.Db = function() { return this.N }, t.Bm = function() { return this.a }, t.Cm = function() { return this.c }, t.wj = function() { return this.i }, t.fb = function() { return this.T }, t.Dm = function() { return this.b }, t.ef = s, t.load = s, t.Df = s, t.Vg = function(t, e, o, i) {
        var r;
        for (e.setTransform(1, 0, 0, 1, 0, 0), e.translate(o, i), e.beginPath(), this.i !== this.c && (this.a *= 2), o = 0; o <= this.a; o++) i = 2 * o * Math.PI / this.a - Math.PI / 2 + this.j, r = 0 == o % 2 ? this.c : this.i, e.lineTo(t.size / 2 + r * Math.cos(i), t.size / 2 + r * Math.sin(i));
        null !== this.l && (e.fillStyle = Kr(this.l.a), e.fill()), null !== this.b && (e.strokeStyle = t.strokeStyle, e.lineWidth = t.ud, null === t.lineDash || e.setLineDash(t.lineDash), e.lineCap = t.lineCap, e.lineJoin = t.lineJoin, e.miterLimit = t.miterLimit, e.stroke()), e.closePath()
    }, t.Ug = function(t, e, o, i) {
        var r;
        for (e.setTransform(1, 0, 0, 1, 0, 0), e.translate(o, i), e.beginPath(), this.i !== this.c && (this.a *= 2), o = 0; o <= this.a; o++) r = 2 * o * Math.PI / this.a - Math.PI / 2 + this.j, i = 0 == o % 2 ? this.c : this.i, e.lineTo(t.size / 2 + i * Math.cos(r), t.size / 2 + i * Math.sin(r));
        e.fillStyle = Ch, e.fill(), null !== this.b && (e.strokeStyle = t.strokeStyle, e.lineWidth = t.ud, null === t.lineDash || e.setLineDash(t.lineDash), e.stroke()), e.closePath()
    }, t.zb = function() {
        var t = null === this.b ? "-" : this.b.zb(),
            e = null === this.l ? "-" : this.l.zb();
        return null !== this.g && t == this.g[1] && e == this.g[2] && this.c == this.g[3] && this.i == this.g[4] && this.j == this.g[5] && this.a == this.g[6] || (this.g = ["r" + t + e + (r(this.c) ? this.c.toString() : "-") + (r(this.i) ? this.i.toString() : "-") + (r(this.j) ? this.j.toString() : "-") + (r(this.a) ? this.a.toString() : "-"), t, e, this.c, this.i, this.j, this.a]), this.g[0]
    }, n("ol.animation.bounce", (function(t) {
        var e = t.resolution,
            o = r(t.start) ? t.start : j(),
            i = r(t.duration) ? t.duration : 1e3,
            n = r(t.easing) ? t.easing : Sr;
        return function(t, r) {
            if (r.time < o) return r.animate = !0, r.viewHints[0] += 1, !0;
            if (r.time < o + i) {
                var s = n((r.time - o) / i),
                    p = e - r.viewState.resolution;
                return r.animate = !0, r.viewState.resolution += s * p, r.viewHints[0] += 1, !0
            }
            return !1
        }
    }), e), n("ol.animation.pan", xr, e), n("ol.animation.rotate", Mr, e), n("ol.animation.zoom", Pr, e), n("ol.Attribution", Nr, e), Nr.prototype.getHTML = Nr.prototype.c, Fr.prototype.element = Fr.prototype.element, n("ol.Collection", Dr, e), Dr.prototype.clear = Dr.prototype.clear, Dr.prototype.extend = Dr.prototype.ff, Dr.prototype.forEach = Dr.prototype.forEach, Dr.prototype.getArray = Dr.prototype.Jk, Dr.prototype.item = Dr.prototype.item, Dr.prototype.getLength = Dr.prototype.Qb, Dr.prototype.insertAt = Dr.prototype.Yd, Dr.prototype.pop = Dr.prototype.pop, Dr.prototype.push = Dr.prototype.push, Dr.prototype.remove = Dr.prototype.remove, Dr.prototype.removeAt = Dr.prototype.zf, Dr.prototype.setAt = Dr.prototype.Rn, n("ol.coordinate.add", $e, e), n("ol.coordinate.createStringXY", (function(t) { return function(e) { return no(e, t) } }), e), n("ol.coordinate.format", to, e), n("ol.coordinate.rotate", oo, e), n("ol.coordinate.toStringHDMS", (function(t) { return r(t) ? Qe(t[1], "NS") + " " + Qe(t[0], "EW") : "" }), e), n("ol.coordinate.toStringXY", no, e), n("ol.DeviceOrientation", tg, e), tg.prototype.getAlpha = tg.prototype.Qi, tg.prototype.getBeta = tg.prototype.Ti, tg.prototype.getGamma = tg.prototype.bj, tg.prototype.getHeading = tg.prototype.Kk, tg.prototype.getTracking = tg.prototype.xg, tg.prototype.setTracking = tg.prototype.gf, n("ol.easing.easeIn", (function(t) { return Math.pow(t, 3) }), e), n("ol.easing.easeOut", br, e), n("ol.easing.inAndOut", mr, e), n("ol.easing.linear", wr, e), n("ol.easing.upAndDown", Sr, e), n("ol.extent.boundingExtent", wo, e), n("ol.extent.buffer", xo, e), n("ol.extent.containsCoordinate", To, e), n("ol.extent.containsExtent", jo, e), n("ol.extent.containsXY", Ao, e), n("ol.extent.createEmpty", (function() { return [1 / 0, 1 / 0, -1 / 0, -1 / 0] }), e), n("ol.extent.equals", Eo, e), n("ol.extent.extend", Io, e), n("ol.extent.getBottomLeft", Do, e), n("ol.extent.getBottomRight", Oo, e), n("ol.extent.getCenter", Bo, e), n("ol.extent.getHeight", Uo, e), n("ol.extent.getIntersection", Xo, e), n("ol.extent.getSize", (function(t) { return [t[2] - t[0], t[3] - t[1]] }), e), n("ol.extent.getTopLeft", Ko, e), n("ol.extent.getTopRight", Yo, e), n("ol.extent.getWidth", Vo, e), n("ol.extent.intersects", Ho, e), n("ol.extent.isEmpty", Wo, e), n("ol.extent.applyTransform", Zo, e), n("ol.Feature", Lu, e), Lu.prototype.clone = Lu.prototype.clone, Lu.prototype.getGeometry = Lu.prototype.Y, Lu.prototype.getId = Lu.prototype.ej, Lu.prototype.getGeometryName = Lu.prototype.dj, Lu.prototype.getStyle = Lu.prototype.Mk, Lu.prototype.getStyleFunction = Lu.prototype.Nk, Lu.prototype.setGeometry = Lu.prototype.Sa, Lu.prototype.setStyle = Lu.prototype.hf, Lu.prototype.setId = Lu.prototype.Wb, Lu.prototype.setGeometryName = Lu.prototype.Pc, n("ol.featureloader.xhr", Qc, e), n("ol.Geolocation", Cw, e), Cw.prototype.getAccuracy = Cw.prototype.Oi, Cw.prototype.getAccuracyGeometry = Cw.prototype.Pi, Cw.prototype.getAltitude = Cw.prototype.Ri, Cw.prototype.getAltitudeAccuracy = Cw.prototype.Si, Cw.prototype.getHeading = Cw.prototype.Pk, Cw.prototype.getPosition = Cw.prototype.Qk, Cw.prototype.getProjection = Cw.prototype.yg, Cw.prototype.getSpeed = Cw.prototype.yj, Cw.prototype.getTracking = Cw.prototype.zg, Cw.prototype.getTrackingOptions = Cw.prototype.kg, Cw.prototype.setProjection = Cw.prototype.Ag, Cw.prototype.setTracking = Cw.prototype.ce, Cw.prototype.setTrackingOptions = Cw.prototype.Dh, n("ol.Graticule", Lw, e), Lw.prototype.getMap = Lw.prototype.Tk, Lw.prototype.getMeridians = Lw.prototype.nj, Lw.prototype.getParallels = Lw.prototype.sj, Lw.prototype.setMap = Lw.prototype.setMap, n("ol.has.DEVICE_PIXEL_RATIO", cp, e), n("ol.has.CANVAS", fp, e), n("ol.has.DEVICE_ORIENTATION", gp, e), n("ol.has.GEOLOCATION", dp, e), n("ol.has.TOUCH", vp, e), n("ol.has.WEBGL", lp, e), Fw.prototype.getImage = Fw.prototype.a, Dw.prototype.getImage = Dw.prototype.Ta, n("ol.Kinetic", Wa, e), n("ol.loadingstrategy.all", ty, e), n("ol.loadingstrategy.bbox", (function(t) { return [t] }), e), n("ol.loadingstrategy.tile", (function(t) {
        return function(e, o) {
            var i = ns(t, o),
                r = es(t, e, i),
                n = [];
            for ((i = [i, 0, 0])[1] = r.a; i[1] <= r.f; ++i[1])
                for (i[2] = r.b; i[2] <= r.c; ++i[2]) n.push(is(t, i));
            return n
        }
    }), e), n("ol.Map", Pf, e), Pf.prototype.addControl = Pf.prototype.wi, Pf.prototype.addInteraction = Pf.prototype.xi, Pf.prototype.addLayer = Pf.prototype.Pf, Pf.prototype.addOverlay = Pf.prototype.Qf, Pf.prototype.beforeRender = Pf.prototype.Oa, Pf.prototype.forEachFeatureAtPixel = Pf.prototype.Re, Pf.prototype.forEachLayerAtPixel = Pf.prototype.Xk, Pf.prototype.hasFeatureAtPixel = Pf.prototype.pk, Pf.prototype.getEventCoordinate = Pf.prototype.Yi, Pf.prototype.getEventPixel = Pf.prototype.Jd, Pf.prototype.getTarget = Pf.prototype.jf, Pf.prototype.getTargetElement = Pf.prototype.hd, Pf.prototype.getCoordinateFromPixel = Pf.prototype.ta, Pf.prototype.getControls = Pf.prototype.Wi, Pf.prototype.getOverlays = Pf.prototype.rj, Pf.prototype.getInteractions = Pf.prototype.fj, Pf.prototype.getLayerGroup = Pf.prototype.ac, Pf.prototype.getLayers = Pf.prototype.Bg, Pf.prototype.getPixelFromCoordinate = Pf.prototype.ya, Pf.prototype.getSize = Pf.prototype.Ca, Pf.prototype.getView = Pf.prototype.X, Pf.prototype.getViewport = Pf.prototype.Ej, Pf.prototype.renderSync = Pf.prototype.On, Pf.prototype.render = Pf.prototype.render, Pf.prototype.removeControl = Pf.prototype.In, Pf.prototype.removeInteraction = Pf.prototype.Jn, Pf.prototype.removeLayer = Pf.prototype.Kn, Pf.prototype.removeOverlay = Pf.prototype.Ln, Pf.prototype.setLayerGroup = Pf.prototype.zh, Pf.prototype.setSize = Pf.prototype.Bf, Pf.prototype.setTarget = Pf.prototype.Zk, Pf.prototype.setView = Pf.prototype.fo, Pf.prototype.updateSize = Pf.prototype.Rc, _p.prototype.originalEvent = _p.prototype.originalEvent, _p.prototype.pixel = _p.prototype.pixel, _p.prototype.coordinate = _p.prototype.coordinate, _p.prototype.dragging = _p.prototype.dragging, _p.prototype.preventDefault = _p.prototype.preventDefault, _p.prototype.stopPropagation = _p.prototype.nb, Bn.prototype.map = Bn.prototype.map, Bn.prototype.frameState = Bn.prototype.frameState, Ye.prototype.key = Ye.prototype.key, Ye.prototype.oldValue = Ye.prototype.oldValue, n("ol.Object", Ve, e), Ve.prototype.get = Ve.prototype.get, Ve.prototype.getKeys = Ve.prototype.O, Ve.prototype.getProperties = Ve.prototype.P, Ve.prototype.set = Ve.prototype.set, Ve.prototype.setProperties = Ve.prototype.I, Ve.prototype.unset = Ve.prototype.S, n("ol.Observable", Xe, e), n("ol.Observable.unByKey", Ke, e), Xe.prototype.changed = Xe.prototype.s, Xe.prototype.getRevision = Xe.prototype.K, Xe.prototype.on = Xe.prototype.G, Xe.prototype.once = Xe.prototype.L, Xe.prototype.un = Xe.prototype.J, Xe.prototype.unByKey = Xe.prototype.M, n("ol.inherits", A, e), n("ol.Overlay", Tf, e), Tf.prototype.getElement = Tf.prototype.de, Tf.prototype.getMap = Tf.prototype.ee, Tf.prototype.getOffset = Tf.prototype.gg, Tf.prototype.getPosition = Tf.prototype.Cg, Tf.prototype.getPositioning = Tf.prototype.jg, Tf.prototype.setElement = Tf.prototype.wh, Tf.prototype.setMap = Tf.prototype.setMap, Tf.prototype.setOffset = Tf.prototype.Bh, Tf.prototype.setPosition = Tf.prototype.kf, Tf.prototype.setPositioning = Tf.prototype.Ch, n("ol.size.toSize", qe, e), Hn.prototype.getTileCoord = Hn.prototype.i, n("ol.View", fr, e), fr.prototype.constrainCenter = fr.prototype.Fd, fr.prototype.constrainResolution = fr.prototype.constrainResolution, fr.prototype.constrainRotation = fr.prototype.constrainRotation, fr.prototype.getCenter = fr.prototype.Ka, fr.prototype.calculateExtent = fr.prototype.Vc, fr.prototype.getProjection = fr.prototype.$k, fr.prototype.getResolution = fr.prototype.Da, fr.prototype.getRotation = fr.prototype.Ea, fr.prototype.getZoom = fr.prototype.Hj, fr.prototype.fit = fr.prototype.Qe, fr.prototype.centerOn = fr.prototype.Gi, fr.prototype.rotate = fr.prototype.rotate, fr.prototype.setCenter = fr.prototype.eb, fr.prototype.setResolution = fr.prototype.Xb, fr.prototype.setRotation = fr.prototype.fe, fr.prototype.setZoom = fr.prototype.ko, n("ol.xml.getAllTextContent", Ac, e), n("ol.xml.parse", Nc, e), n("ol.webgl.Context", Dy, e), Dy.prototype.getGL = Dy.prototype.Um, Dy.prototype.getHitDetectionFramebuffer = Dy.prototype.Ye, Dy.prototype.useProgram = Dy.prototype.re, n("ol.tilegrid.TileGrid", qn, e), qn.prototype.getMaxZoom = qn.prototype.eg, qn.prototype.getMinZoom = qn.prototype.fg, qn.prototype.getOrigin = qn.prototype.Kc, qn.prototype.getResolution = qn.prototype.ua, qn.prototype.getResolutions = qn.prototype.Xg, qn.prototype.getTileCoordForCoordAndResolution = qn.prototype.jd, qn.prototype.getTileCoordForCoordAndZ = qn.prototype.Rd, qn.prototype.getTileSize = qn.prototype.Ja, n("ol.tilegrid.createXYZ", ss, e), n("ol.tilegrid.WMTS", Ux, e), Ux.prototype.getMatrixIds = Ux.prototype.B, n("ol.tilegrid.WMTS.createFromCapabilitiesMatrixSet", Xx, e), n("ol.style.AtlasManager", Wx, e), n("ol.style.Circle", Ih, e), Ih.prototype.getAnchor = Ih.prototype.yb, Ih.prototype.getFill = Ih.prototype.vm, Ih.prototype.getImage = Ih.prototype.Sb, Ih.prototype.getOrigin = Ih.prototype.Db, Ih.prototype.getRadius = Ih.prototype.wm, Ih.prototype.getSize = Ih.prototype.fb, Ih.prototype.getStroke = Ih.prototype.xm, n("ol.style.Fill", Eh, e), Eh.prototype.getColor = Eh.prototype.c, Eh.prototype.setColor = Eh.prototype.f, n("ol.style.Icon", Ea, e), Ea.prototype.getAnchor = Ea.prototype.yb, Ea.prototype.getImage = Ea.prototype.Sb, Ea.prototype.getOrigin = Ea.prototype.Db, Ea.prototype.getSrc = Ea.prototype.ym, Ea.prototype.getSize = Ea.prototype.fb, n("ol.style.Image", La, e), La.prototype.getOpacity = La.prototype.me, La.prototype.getRotateWithView = La.prototype.Pd, La.prototype.getRotation = La.prototype.ne, La.prototype.getScale = La.prototype.oe, La.prototype.getSnapToPixel = La.prototype.Qd, La.prototype.setRotation = La.prototype.pe, La.prototype.setScale = La.prototype.qe, n("ol.style.RegularShape", qx, e), qx.prototype.getAnchor = qx.prototype.yb, qx.prototype.getAngle = qx.prototype.zm, qx.prototype.getFill = qx.prototype.Am, qx.prototype.getImage = qx.prototype.Sb, qx.prototype.getOrigin = qx.prototype.Db, qx.prototype.getPoints = qx.prototype.Bm, qx.prototype.getRadius = qx.prototype.Cm, qx.prototype.getRadius2 = qx.prototype.wj, qx.prototype.getSize = qx.prototype.fb, qx.prototype.getStroke = qx.prototype.Dm, n("ol.style.Stroke", Ah, e), Ah.prototype.getColor = Ah.prototype.Em, Ah.prototype.getLineCap = Ah.prototype.ij, Ah.prototype.getLineDash = Ah.prototype.Fm, Ah.prototype.getLineJoin = Ah.prototype.jj, Ah.prototype.getMiterLimit = Ah.prototype.oj, Ah.prototype.getWidth = Ah.prototype.Gm, Ah.prototype.setColor = Ah.prototype.Hm, Ah.prototype.setLineCap = Ah.prototype.Wn, Ah.prototype.setLineDash = Ah.prototype.Im, Ah.prototype.setLineJoin = Ah.prototype.Xn, Ah.prototype.setMiterLimit = Ah.prototype.Yn, Ah.prototype.setWidth = Ah.prototype.ho, n("ol.style.Style", kh, e), kh.prototype.getGeometry = kh.prototype.Y, kh.prototype.getGeometryFunction = kh.prototype.cj, kh.prototype.getFill = kh.prototype.Jm, kh.prototype.getImage = kh.prototype.Km, kh.prototype.getStroke = kh.prototype.Lm, kh.prototype.getText = kh.prototype.Mm, kh.prototype.getZIndex = kh.prototype.Gj, kh.prototype.setGeometry = kh.prototype.Wg, kh.prototype.setZIndex = kh.prototype.jo, n("ol.style.Text", Jd, e), Jd.prototype.getFont = Jd.prototype.$i, Jd.prototype.getOffsetX = Jd.prototype.pj, Jd.prototype.getOffsetY = Jd.prototype.qj, Jd.prototype.getFill = Jd.prototype.Nm, Jd.prototype.getRotation = Jd.prototype.Om, Jd.prototype.getScale = Jd.prototype.Pm, Jd.prototype.getStroke = Jd.prototype.Qm, Jd.prototype.getText = Jd.prototype.Rm, Jd.prototype.getTextAlign = Jd.prototype.Aj, Jd.prototype.getTextBaseline = Jd.prototype.Bj, Jd.prototype.setFont = Jd.prototype.Tn, Jd.prototype.setFill = Jd.prototype.Sn, Jd.prototype.setRotation = Jd.prototype.Sm, Jd.prototype.setScale = Jd.prototype.Tm, Jd.prototype.setStroke = Jd.prototype.ao, Jd.prototype.setText = Jd.prototype.bo, Jd.prototype.setTextAlign = Jd.prototype.co, Jd.prototype.setTextBaseline = Jd.prototype.eo, n("ol.Sphere", oi, e), oi.prototype.geodesicArea = oi.prototype.b, oi.prototype.haversineDistance = oi.prototype.a, n("ol.source.BingMaps", nx, e), n("ol.source.BingMaps.TOS_ATTRIBUTION", sx, e), n("ol.source.Cluster", px, e), px.prototype.getSource = px.prototype.fa, n("ol.source.ImageCanvas", Ru, e), n("ol.source.ImageMapGuide", lx, e), lx.prototype.getParams = lx.prototype.Ql, lx.prototype.getImageLoadFunction = lx.prototype.Pl, lx.prototype.updateParams = lx.prototype.Tl, lx.prototype.setImageLoadFunction = lx.prototype.Sl, n("ol.source.Image", Su, e), Pu.prototype.image = Pu.prototype.image, n("ol.source.ImageStatic", ux, e), n("ol.source.ImageVector", cy, e), cy.prototype.getSource = cy.prototype.Ul, cy.prototype.getStyle = cy.prototype.Vl, cy.prototype.getStyleFunction = cy.prototype.Wl, cy.prototype.setStyle = cy.prototype.Pg, n("ol.source.ImageWMS", cx, e), cx.prototype.getGetFeatureInfoUrl = cx.prototype.Zl, cx.prototype.getParams = cx.prototype.am, cx.prototype.getImageLoadFunction = cx.prototype.$l, cx.prototype.getUrl = cx.prototype.bm, cx.prototype.setImageLoadFunction = cx.prototype.cm, cx.prototype.setUrl = cx.prototype.dm, cx.prototype.updateParams = cx.prototype.em, n("ol.source.MapQuest", mx, e), mx.prototype.getLayer = mx.prototype.l, n("ol.source.OSM", vx, e), n("ol.source.OSM.ATTRIBUTION", bx, e), n("ol.source.Source", zn, e), zn.prototype.getAttributions = zn.prototype.la, zn.prototype.getLogo = zn.prototype.ka, zn.prototype.getProjection = zn.prototype.ma, zn.prototype.getState = zn.prototype.na, n("ol.source.Stamen", Px, e), n("ol.source.TileArcGISRest", jx, e), jx.prototype.getParams = jx.prototype.fm, jx.prototype.getUrls = jx.prototype.gm, jx.prototype.setUrl = jx.prototype.hm, jx.prototype.setUrls = jx.prototype.Qg, jx.prototype.updateParams = jx.prototype.jm, n("ol.source.TileDebug", Cx, e), n("ol.source.TileImage", ix, e), ix.prototype.getTileLoadFunction = ix.prototype.ab, ix.prototype.getTileUrlFunction = ix.prototype.bb, ix.prototype.setTileLoadFunction = ix.prototype.ib, ix.prototype.setTileUrlFunction = ix.prototype.Fa, n("ol.source.TileJSON", Rx, e), n("ol.source.Tile", hs, e), hs.prototype.getTileGrid = hs.prototype.za, ys.prototype.tile = ys.prototype.tile, n("ol.source.TileUTFGrid", Lx, e), Lx.prototype.getTemplate = Lx.prototype.zj, Lx.prototype.forDataAtCoordinateAndResolution = Lx.prototype.Ki, n("ol.source.TileVector", Nx, e), Nx.prototype.getFeatures = Nx.prototype.Ic, Nx.prototype.getFeaturesAtCoordinateAndResolution = Nx.prototype.Zi, n("ol.source.TileWMS", Dx, e), Dx.prototype.getGetFeatureInfoUrl = Dx.prototype.mm, Dx.prototype.getParams = Dx.prototype.nm, Dx.prototype.getUrls = Dx.prototype.om, Dx.prototype.setUrl = Dx.prototype.pm, Dx.prototype.setUrls = Dx.prototype.Rg, Dx.prototype.updateParams = Dx.prototype.rm, n("ol.source.Vector", sy, e), sy.prototype.addFeature = sy.prototype.pd, sy.prototype.addFeatures = sy.prototype.xc, sy.prototype.clear = sy.prototype.clear, sy.prototype.forEachFeature = sy.prototype.Xf, sy.prototype.forEachFeatureInExtent = sy.prototype.fd, sy.prototype.forEachFeatureIntersectingExtent = sy.prototype.Se, sy.prototype.getFeaturesCollection = sy.prototype.We, sy.prototype.getFeatures = sy.prototype.Ic, sy.prototype.getFeaturesAtCoordinate = sy.prototype.Ve, sy.prototype.getFeaturesInExtent = sy.prototype.Xe, sy.prototype.getClosestFeatureToCoordinate = sy.prototype.Zf, sy.prototype.getExtent = sy.prototype.R, sy.prototype.getFeatureById = sy.prototype.Ue, sy.prototype.removeFeature = sy.prototype.Jc, uy.prototype.feature = uy.prototype.feature, n("ol.source.WMTS", Kx, e), Kx.prototype.getDimensions = Kx.prototype.Xi, Kx.prototype.getFormat = Kx.prototype.aj, Kx.prototype.getLayer = Kx.prototype.sm, Kx.prototype.getMatrixSet = Kx.prototype.mj, Kx.prototype.getRequestEncoding = Kx.prototype.xj, Kx.prototype.getStyle = Kx.prototype.tm, Kx.prototype.getUrls = Kx.prototype.um, Kx.prototype.getVersion = Kx.prototype.Dj, Kx.prototype.updateDimensions = Kx.prototype.ro, n("ol.source.WMTS.optionsFromCapabilities", (function(t, e) {
        var o, i;
        0 > (o = 1 < (c = Z(t.Contents.Layer, (function(t) { return t.Identifier == e.layer }))).TileMatrixSetLink.length ? J(c.TileMatrixSetLink, (function(t) { return t.TileMatrixSet == e.matrixSet })) : r(e.projection) ? J(c.TileMatrixSetLink, (function(t) { return t.TileMatrixSet.SupportedCRS.replace(/urn:ogc:def:crs:(\w+):(.*:)?(\w+)$/, "$1:$3") == e.projection })) : 0) && (o = 0), i = c.TileMatrixSetLink[o].TileMatrixSet;
        var n = c.Format[0];
        r(e.format) && (n = e.format), 0 > (o = J(c.Style, (function(t) { return r(e.style) ? t.Title == e.style : t.isDefault }))) && (o = 0), o = c.Style[o].Identifier;
        var s = {};
        r(c.Dimension) && H(c.Dimension, (function(t) {
            var e = t.Identifier,
                o = t.default;
            r(o) || (o = t.values[0]), s[e] = o
        }));
        var p, a, h, l = Z(t.Contents.TileMatrixSet, (function(t) { return t.Identifier == i }));
        p = r(e.projection) ? gi(e.projection) : gi(l.SupportedCRS.replace(/urn:ogc:def:crs:(\w+):(.*:)?(\w+)$/, "$1:$3")), r(y = c.WGS84BoundingBox) && (h = gi("EPSG:4326").R(), h = y[0] == h[0] && y[2] == h[2], a = xi(y, "EPSG:4326", p), null === (y = p.R()) || jo(y, a) || (a = void 0)), l = Xx(l, a);
        var u = [];
        if (a = r(a = e.requestEncoding) ? a : "", t.hasOwnProperty("OperationsMetadata") && t.OperationsMetadata.hasOwnProperty("GetTile") && 0 != a.lastIndexOf("REST", 0))
            for (var c, y = 0, f = (c = t.OperationsMetadata.GetTile.DCP.HTTP.Get).length; y < f; ++y) {
                var g = Z(c[y].Constraint, (function(t) { return "GetEncoding" == t.name })).AllowedValues.Value;
                0 < g.length && q(g, "KVP") && (a = "KVP", u.push(c[y].href))
            } else a = "REST", H(c.ResourceURL, (function(t) { "tile" == t.resourceType && (n = t.format, u.push(t.template)) }));
        return { urls: u, layer: e.layer, matrixSet: i, format: n, projection: p, requestEncoding: a, tileGrid: l, style: o, dimensions: s, wrapX: h }
    }), e), n("ol.source.XYZ", dx, e), dx.prototype.setUrl = dx.prototype.f, n("ol.source.Zoomify", Vx, e), fa.prototype.vectorContext = fa.prototype.vectorContext, fa.prototype.frameState = fa.prototype.frameState, fa.prototype.context = fa.prototype.context, fa.prototype.glContext = fa.prototype.glContext, n("ol.render.VectorContext", ya, e), of.prototype.drawAsync = of.prototype.yc, of.prototype.drawCircleGeometry = of.prototype.zc, of.prototype.drawFeature = of.prototype.Pe, of.prototype.drawGeometryCollectionGeometry = of.prototype.Hd, of.prototype.drawPointGeometry = of.prototype.wb, of.prototype.drawLineStringGeometry = of.prototype.Gb, of.prototype.drawMultiLineStringGeometry = of.prototype.Ac, of.prototype.drawMultiPointGeometry = of.prototype.vb, of.prototype.drawMultiPolygonGeometry = of.prototype.Bc, of.prototype.drawPolygonGeometry = of.prototype.Yb, of.prototype.drawText = of.prototype.xb, of.prototype.setFillStrokeStyle = of.prototype.Ha, of.prototype.setImageStyle = of.prototype.hb, of.prototype.setTextStyle = of.prototype.Ia, gl.prototype.drawAsync = gl.prototype.yc, gl.prototype.drawCircleGeometry = gl.prototype.zc, gl.prototype.drawFeature = gl.prototype.Pe, gl.prototype.drawPointGeometry = gl.prototype.wb, gl.prototype.drawMultiPointGeometry = gl.prototype.vb, gl.prototype.drawLineStringGeometry = gl.prototype.Gb, gl.prototype.drawMultiLineStringGeometry = gl.prototype.Ac, gl.prototype.drawPolygonGeometry = gl.prototype.Yb, gl.prototype.drawMultiPolygonGeometry = gl.prototype.Bc, gl.prototype.setFillStrokeStyle = gl.prototype.Ha, gl.prototype.setImageStyle = gl.prototype.hb, gl.prototype.setTextStyle = gl.prototype.Ia, n("ol.proj.common.add", ul, e), n("ol.proj.METERS_PER_UNIT", ri, e), n("ol.proj.Projection", ni, e), ni.prototype.getCode = ni.prototype.Vi, ni.prototype.getExtent = ni.prototype.R, ni.prototype.getUnits = ni.prototype.Jl, ni.prototype.getMetersPerUnit = ni.prototype.Nd, ni.prototype.getWorldExtent = ni.prototype.Fj, ni.prototype.isGlobal = ni.prototype.tk, ni.prototype.setGlobal = ni.prototype.Vn, ni.prototype.setExtent = ni.prototype.Kl, ni.prototype.setWorldExtent = ni.prototype.io, ni.prototype.setGetPointResolution = ni.prototype.Un, ni.prototype.getPointResolution = ni.prototype.getPointResolution, n("ol.proj.addEquivalentProjections", hi, e), n("ol.proj.addProjection", li, e), n("ol.proj.addCoordinateTransforms", yi, e), n("ol.proj.fromLonLat", (function(t, e) { return Si(t, "EPSG:4326", r(e) ? e : "EPSG:3857") }), e), n("ol.proj.toLonLat", (function(t, e) { return Si(t, r(e) ? e : "EPSG:3857", "EPSG:4326") }), e), n("ol.proj.get", gi, e), n("ol.proj.getTransform", vi, e), n("ol.proj.transform", Si, e), n("ol.proj.transformExtent", xi, e), n("ol.layer.Heatmap", VS, e), VS.prototype.getBlur = VS.prototype.Yf, VS.prototype.getGradient = VS.prototype.bg, VS.prototype.getRadius = VS.prototype.Kg, VS.prototype.setBlur = VS.prototype.uh, VS.prototype.setGradient = VS.prototype.yh, VS.prototype.setRadius = VS.prototype.Lg, n("ol.layer.Image", cl, e), cl.prototype.getSource = cl.prototype.da, n("ol.layer.Layer", ga, e), ga.prototype.getSource = ga.prototype.da, ga.prototype.setMap = ga.prototype.setMap, ga.prototype.setSource = ga.prototype.Qc, n("ol.layer.Base", ua, e), ua.prototype.getBrightness = ua.prototype.Ib, ua.prototype.getContrast = ua.prototype.Jb, ua.prototype.getHue = ua.prototype.Kb, ua.prototype.getExtent = ua.prototype.R, ua.prototype.getMaxResolution = ua.prototype.Lb, ua.prototype.getMinResolution = ua.prototype.Mb, ua.prototype.getOpacity = ua.prototype.Rb, ua.prototype.getSaturation = ua.prototype.Nb, ua.prototype.getVisible = ua.prototype.mb, ua.prototype.setBrightness = ua.prototype.mc, ua.prototype.setContrast = ua.prototype.nc, ua.prototype.setHue = ua.prototype.oc, ua.prototype.setExtent = ua.prototype.hc, ua.prototype.setMaxResolution = ua.prototype.pc, ua.prototype.setMinResolution = ua.prototype.qc, ua.prototype.setOpacity = ua.prototype.ic, ua.prototype.setSaturation = ua.prototype.rc, ua.prototype.setVisible = ua.prototype.sc, n("ol.layer.Group", tl, e), tl.prototype.getLayers = tl.prototype.Gc, tl.prototype.setLayers = tl.prototype.Ah, n("ol.layer.Tile", yl, e), yl.prototype.getPreload = yl.prototype.b, yl.prototype.getSource = yl.prototype.da, yl.prototype.setPreload = yl.prototype.f, yl.prototype.getUseInterimTilesOnError = yl.prototype.c, yl.prototype.setUseInterimTilesOnError = yl.prototype.g, n("ol.layer.Vector", fl, e), fl.prototype.getSource = fl.prototype.da, fl.prototype.getStyle = fl.prototype.T, fl.prototype.getStyleFunction = fl.prototype.ba, fl.prototype.setStyle = fl.prototype.g, n("ol.interaction.DoubleClickZoom", $a, e), n("ol.interaction.DoubleClickZoom.handleEvent", _a, e), n("ol.interaction.DragAndDrop", eS, e), n("ol.interaction.DragAndDrop.handleEvent", $o, e), iS.prototype.features = iS.prototype.features, iS.prototype.file = iS.prototype.file, iS.prototype.projection = iS.prototype.projection, wh.prototype.coordinate = wh.prototype.coordinate, n("ol.interaction.DragBox", Sh, e), Sh.prototype.getGeometry = Sh.prototype.Y, n("ol.interaction.DragPan", hh, e), n("ol.interaction.DragRotateAndZoom", nS, e), n("ol.interaction.DragRotate", yh, e), n("ol.interaction.DragZoom", Bh, e), hS.prototype.feature = hS.prototype.feature, n("ol.interaction.Draw", lS, e), n("ol.interaction.Draw.handleEvent", cS, e), lS.prototype.finishDrawing = lS.prototype.fa, n("ol.interaction.Draw.createRegularPolygon", (function(t, e) {
        return function(o, i) {
            var n = o[0],
                s = o[1],
                p = Math.sqrt(io(n, s)),
                a = r(i) ? i : cr(new Jl(n), t);
            return yr(a, n, p, r(e) ? e : Math.atan((s[1] - n[1]) / (s[0] - n[0]))), a
        }
    }), e), n("ol.interaction.Interaction", za, e), za.prototype.getActive = za.prototype.b, za.prototype.setActive = za.prototype.f, n("ol.interaction.defaults", Qh, e), n("ol.interaction.KeyboardPan", Gh, e), n("ol.interaction.KeyboardPan.handleEvent", Uh, e), n("ol.interaction.KeyboardZoom", Xh, e), n("ol.interaction.KeyboardZoom.handleEvent", Kh, e), TS.prototype.features = TS.prototype.features, TS.prototype.mapBrowserPointerEvent = TS.prototype.mapBrowserPointerEvent, n("ol.interaction.Modify", jS, e), n("ol.interaction.Modify.handleEvent", IS, e), n("ol.interaction.MouseWheelZoom", Yh, e), n("ol.interaction.MouseWheelZoom.handleEvent", Vh, e), n("ol.interaction.PinchRotate", Hh, e), n("ol.interaction.PinchZoom", Jh, e), n("ol.interaction.Pointer", sh, e), n("ol.interaction.Pointer.handleEvent", ah, e), DS.prototype.selected = DS.prototype.selected, DS.prototype.deselected = DS.prototype.deselected, DS.prototype.mapBrowserEvent = DS.prototype.mapBrowserEvent, n("ol.interaction.Select", OS, e), OS.prototype.getFeatures = OS.prototype.D, n("ol.interaction.Select.handleEvent", BS, e), OS.prototype.setMap = OS.prototype.setMap, n("ol.interaction.Snap", US, e), US.prototype.addFeature = US.prototype.md, US.prototype.removeFeature = US.prototype.od, n("ol.geom.Circle", Jl, e), Jl.prototype.clone = Jl.prototype.clone, Jl.prototype.getCenter = Jl.prototype.ld, Jl.prototype.getRadius = Jl.prototype.lf, Jl.prototype.getType = Jl.prototype.U, Jl.prototype.intersectsExtent = Jl.prototype.sa, Jl.prototype.setCenter = Jl.prototype.ll, Jl.prototype.setCenterAndRadius = Jl.prototype.Af, Jl.prototype.setRadius = Jl.prototype.ml, Jl.prototype.transform = Jl.prototype.transform, n("ol.geom.Geometry", Mi, e), Mi.prototype.getClosestPoint = Mi.prototype.$a, Mi.prototype.getExtent = Mi.prototype.R, Mi.prototype.transform = Mi.prototype.transform, n("ol.geom.GeometryCollection", $l, e), $l.prototype.clone = $l.prototype.clone, $l.prototype.getGeometries = $l.prototype.ag, $l.prototype.getType = $l.prototype.U, $l.prototype.intersectsExtent = $l.prototype.sa, $l.prototype.setGeometries = $l.prototype.xh, $l.prototype.applyTransform = $l.prototype.va, $l.prototype.translate = $l.prototype.Ua, n("ol.geom.LinearRing", Hi, e), Hi.prototype.clone = Hi.prototype.clone, Hi.prototype.getArea = Hi.prototype.pl, Hi.prototype.getCoordinates = Hi.prototype.V, Hi.prototype.getType = Hi.prototype.U, Hi.prototype.setCoordinates = Hi.prototype.ja, n("ol.geom.LineString", iu, e), iu.prototype.appendCoordinate = iu.prototype.yi, iu.prototype.clone = iu.prototype.clone, iu.prototype.forEachSegment = iu.prototype.Ni, iu.prototype.getCoordinateAtM = iu.prototype.nl, iu.prototype.getCoordinates = iu.prototype.V, iu.prototype.getLength = iu.prototype.ol, iu.prototype.getType = iu.prototype.U, iu.prototype.intersectsExtent = iu.prototype.sa, iu.prototype.setCoordinates = iu.prototype.ja, n("ol.geom.MultiLineString", su, e), su.prototype.appendLineString = su.prototype.zi, su.prototype.clone = su.prototype.clone, su.prototype.getCoordinateAtM = su.prototype.ql, su.prototype.getCoordinates = su.prototype.V, su.prototype.getLineString = su.prototype.kj, su.prototype.getLineStrings = su.prototype.gd, su.prototype.getType = su.prototype.U, su.prototype.intersectsExtent = su.prototype.sa, su.prototype.setCoordinates = su.prototype.ja, n("ol.geom.MultiPoint", lu, e), lu.prototype.appendPoint = lu.prototype.Bi, lu.prototype.clone = lu.prototype.clone, lu.prototype.getCoordinates = lu.prototype.V, lu.prototype.getPoint = lu.prototype.tj, lu.prototype.getPoints = lu.prototype.ge, lu.prototype.getType = lu.prototype.U, lu.prototype.intersectsExtent = lu.prototype.sa, lu.prototype.setCoordinates = lu.prototype.ja, n("ol.geom.MultiPolygon", uu, e), uu.prototype.appendPolygon = uu.prototype.Ci, uu.prototype.clone = uu.prototype.clone, uu.prototype.getArea = uu.prototype.rl, uu.prototype.getCoordinates = uu.prototype.V, uu.prototype.getInteriorPoints = uu.prototype.hj, uu.prototype.getPolygon = uu.prototype.vj, uu.prototype.getPolygons = uu.prototype.Od, uu.prototype.getType = uu.prototype.U, uu.prototype.intersectsExtent = uu.prototype.sa, uu.prototype.setCoordinates = uu.prototype.ja, n("ol.geom.Point", zi, e), zi.prototype.clone = zi.prototype.clone, zi.prototype.getCoordinates = zi.prototype.V, zi.prototype.getType = zi.prototype.U, zi.prototype.intersectsExtent = zi.prototype.sa, zi.prototype.setCoordinates = zi.prototype.ja, n("ol.geom.Polygon", sr, e), sr.prototype.appendLinearRing = sr.prototype.Ai, sr.prototype.clone = sr.prototype.clone, sr.prototype.getArea = sr.prototype.sl, sr.prototype.getCoordinates = sr.prototype.V, sr.prototype.getInteriorPoint = sr.prototype.gj, sr.prototype.getLinearRingCount = sr.prototype.lj, sr.prototype.getLinearRing = sr.prototype.dg, sr.prototype.getLinearRings = sr.prototype.Md, sr.prototype.getType = sr.prototype.U, sr.prototype.intersectsExtent = sr.prototype.sa, sr.prototype.setCoordinates = sr.prototype.ja, n("ol.geom.Polygon.circular", lr, e), n("ol.geom.Polygon.fromExtent", ur, e), n("ol.geom.Polygon.fromCircle", cr, e), n("ol.geom.SimpleGeometry", Ti, e), Ti.prototype.getFirstCoordinate = Ti.prototype.Ab, Ti.prototype.getLastCoordinate = Ti.prototype.Bb, Ti.prototype.getLayout = Ti.prototype.Cb, Ti.prototype.applyTransform = Ti.prototype.va, Ti.prototype.translate = Ti.prototype.Ua, n("ol.format.EsriJSON", pg, e), pg.prototype.readFeature = pg.prototype.Eb, pg.prototype.readFeatures = pg.prototype.qa, pg.prototype.readGeometry = pg.prototype.Nc, pg.prototype.readProjection = pg.prototype.Ga, pg.prototype.writeGeometry = pg.prototype.Tc, pg.prototype.writeGeometryObject = pg.prototype.Ee, pg.prototype.writeFeature = pg.prototype.xd, pg.prototype.writeFeatureObject = pg.prototype.Sc, pg.prototype.writeFeatures = pg.prototype.Fb, pg.prototype.writeFeaturesObject = pg.prototype.Ce, n("ol.format.Feature", eg, e), n("ol.format.GeoJSON", fg, e), fg.prototype.readFeature = fg.prototype.Eb, fg.prototype.readFeatures = fg.prototype.qa, fg.prototype.readGeometry = fg.prototype.Nc, fg.prototype.readProjection = fg.prototype.Ga, fg.prototype.writeFeature = fg.prototype.xd, fg.prototype.writeFeatureObject = fg.prototype.Sc, fg.prototype.writeFeatures = fg.prototype.Fb, fg.prototype.writeFeaturesObject = fg.prototype.Ce, fg.prototype.writeGeometry = fg.prototype.Tc, fg.prototype.writeGeometryObject = fg.prototype.Ee, n("ol.format.GPX", Hg, e), Hg.prototype.readFeature = Hg.prototype.Eb, Hg.prototype.readFeatures = Hg.prototype.qa, Hg.prototype.readProjection = Hg.prototype.Ga, Hg.prototype.writeFeatures = Hg.prototype.Fb, Hg.prototype.writeFeaturesNode = Hg.prototype.b, n("ol.format.IGC", jd, e), jd.prototype.readFeature = jd.prototype.Eb, jd.prototype.readFeatures = jd.prototype.qa, jd.prototype.readProjection = jd.prototype.Ga, n("ol.format.KML", qd, e), qd.prototype.readFeature = qd.prototype.Eb, qd.prototype.readFeatures = qd.prototype.qa, qd.prototype.readName = qd.prototype.An, qd.prototype.readNetworkLinks = qd.prototype.Bn, qd.prototype.readProjection = qd.prototype.Ga, qd.prototype.writeFeatures = qd.prototype.Fb, qd.prototype.writeFeaturesNode = qd.prototype.b, n("ol.format.OSMXML", kb, e), kb.prototype.readFeatures = kb.prototype.qa, kb.prototype.readProjection = kb.prototype.Ga, n("ol.format.Polyline", rm, e), n("ol.format.Polyline.encodeDeltas", nm, e), n("ol.format.Polyline.decodeDeltas", sm, e), n("ol.format.Polyline.encodeFloats", pm, e), n("ol.format.Polyline.decodeFloats", am, e), rm.prototype.readFeature = rm.prototype.Eb, rm.prototype.readFeatures = rm.prototype.qa, rm.prototype.readGeometry = rm.prototype.Nc, rm.prototype.readProjection = rm.prototype.Ga, rm.prototype.writeGeometry = rm.prototype.Tc, n("ol.format.TopoJSON", hm, e), hm.prototype.readFeatures = hm.prototype.qa, hm.prototype.readProjection = hm.prototype.Ga, n("ol.format.WFS", gm, e), gm.prototype.readFeatures = gm.prototype.qa, gm.prototype.readTransactionResponse = gm.prototype.j, gm.prototype.readFeatureCollectionMetadata = gm.prototype.i, gm.prototype.writeGetFeature = gm.prototype.l, gm.prototype.writeTransaction = gm.prototype.u, gm.prototype.readProjection = gm.prototype.Ga, n("ol.format.WKT", Cm, e), Cm.prototype.readFeature = Cm.prototype.Eb, Cm.prototype.readFeatures = Cm.prototype.qa, Cm.prototype.readGeometry = Cm.prototype.Nc, Cm.prototype.writeFeature = Cm.prototype.xd, Cm.prototype.writeFeatures = Cm.prototype.Fb, Cm.prototype.writeGeometry = Cm.prototype.Tc, n("ol.format.WMSCapabilities", Hm, e), Hm.prototype.read = Hm.prototype.c, n("ol.format.WMSGetFeatureInfo", fw, e), fw.prototype.readFeatures = fw.prototype.qa, n("ol.format.WMTSCapabilities", gw, e), gw.prototype.read = gw.prototype.c, n("ol.format.GML2", Vg, e), n("ol.format.GML3", Fg, e), Fg.prototype.writeGeometryNode = Fg.prototype.B, Fg.prototype.writeFeatures = Fg.prototype.Fb, Fg.prototype.writeFeaturesNode = Fg.prototype.b, n("ol.format.GML", Fg, e), Fg.prototype.writeFeatures = Fg.prototype.Fb, Fg.prototype.writeFeaturesNode = Fg.prototype.b, xg.prototype.readFeatures = xg.prototype.qa, n("ol.events.condition.altKeyOnly", (function(t) { return (t = t.a).b && !t.j && !t.f }), e), n("ol.events.condition.altShiftKeysOnly", Qa, e), n("ol.events.condition.always", $o, e), n("ol.events.condition.click", (function(t) { return t.type == ia }), e), n("ol.events.condition.never", qo, e), n("ol.events.condition.pointerMove", th, e), n("ol.events.condition.singleClick", eh, e), n("ol.events.condition.noModifierKeys", oh, e), n("ol.events.condition.platformModifierKeyOnly", (function(t) { return !(t = t.a).b && t.j && !t.f }), e), n("ol.events.condition.shiftKeyOnly", ih, e), n("ol.events.condition.targetNotEditable", rh, e), n("ol.events.condition.mouseOnly", nh, e), n("ol.control.Attribution", fs, e), n("ol.control.Attribution.render", gs, e), fs.prototype.getCollapsible = fs.prototype.bl, fs.prototype.setCollapsible = fs.prototype.el, fs.prototype.setCollapsed = fs.prototype.dl, fs.prototype.getCollapsed = fs.prototype.al, n("ol.control.Control", Gn, e), Gn.prototype.getMap = Gn.prototype.g, Gn.prototype.setMap = Gn.prototype.setMap, Gn.prototype.setTarget = Gn.prototype.c, n("ol.control.defaults", ws, e), n("ol.control.FullScreen", js, e), n("ol.control.MousePosition", As, e), n("ol.control.MousePosition.render", Cs, e), As.prototype.getCoordinateFormat = As.prototype.$f, As.prototype.getProjection = As.prototype.Dg, As.prototype.setMap = As.prototype.setMap, As.prototype.setCoordinateFormat = As.prototype.vh, As.prototype.setProjection = As.prototype.Eg, n("ol.control.OverviewMap", Cf, e), Cf.prototype.setMap = Cf.prototype.setMap, n("ol.control.OverviewMap.render", Rf, e), Cf.prototype.getCollapsible = Cf.prototype.hl, Cf.prototype.setCollapsible = Cf.prototype.kl, Cf.prototype.setCollapsed = Cf.prototype.jl, Cf.prototype.getCollapsed = Cf.prototype.gl, n("ol.control.Rotate", vs, e), n("ol.control.Rotate.render", bs, e), n("ol.control.ScaleLine", kf, e), kf.prototype.getUnits = kf.prototype.C, n("ol.control.ScaleLine.render", Ff, e), kf.prototype.setUnits = kf.prototype.ba, n("ol.control.Zoom", ms, e), n("ol.control.ZoomSlider", Zf, e), n("ol.control.ZoomSlider.render", qf, e), n("ol.control.ZoomToExtent", Qf, e), n("ol.color.asArray", Xr, e), n("ol.color.asString", Kr, e), Ve.prototype.changed = Ve.prototype.s, Ve.prototype.getRevision = Ve.prototype.K, Ve.prototype.on = Ve.prototype.G, Ve.prototype.once = Ve.prototype.L, Ve.prototype.un = Ve.prototype.J, Ve.prototype.unByKey = Ve.prototype.M, Dr.prototype.get = Dr.prototype.get, Dr.prototype.getKeys = Dr.prototype.O, Dr.prototype.getProperties = Dr.prototype.P, Dr.prototype.set = Dr.prototype.set, Dr.prototype.setProperties = Dr.prototype.I, Dr.prototype.unset = Dr.prototype.S, Dr.prototype.changed = Dr.prototype.s, Dr.prototype.getRevision = Dr.prototype.K, Dr.prototype.on = Dr.prototype.G, Dr.prototype.once = Dr.prototype.L, Dr.prototype.un = Dr.prototype.J, Dr.prototype.unByKey = Dr.prototype.M, tg.prototype.get = tg.prototype.get, tg.prototype.getKeys = tg.prototype.O, tg.prototype.getProperties = tg.prototype.P, tg.prototype.set = tg.prototype.set, tg.prototype.setProperties = tg.prototype.I, tg.prototype.unset = tg.prototype.S, tg.prototype.changed = tg.prototype.s, tg.prototype.getRevision = tg.prototype.K, tg.prototype.on = tg.prototype.G, tg.prototype.once = tg.prototype.L, tg.prototype.un = tg.prototype.J, tg.prototype.unByKey = tg.prototype.M, Lu.prototype.get = Lu.prototype.get, Lu.prototype.getKeys = Lu.prototype.O, Lu.prototype.getProperties = Lu.prototype.P, Lu.prototype.set = Lu.prototype.set, Lu.prototype.setProperties = Lu.prototype.I, Lu.prototype.unset = Lu.prototype.S, Lu.prototype.changed = Lu.prototype.s, Lu.prototype.getRevision = Lu.prototype.K, Lu.prototype.on = Lu.prototype.G, Lu.prototype.once = Lu.prototype.L, Lu.prototype.un = Lu.prototype.J, Lu.prototype.unByKey = Lu.prototype.M, Cw.prototype.get = Cw.prototype.get, Cw.prototype.getKeys = Cw.prototype.O, Cw.prototype.getProperties = Cw.prototype.P, Cw.prototype.set = Cw.prototype.set, Cw.prototype.setProperties = Cw.prototype.I, Cw.prototype.unset = Cw.prototype.S, Cw.prototype.changed = Cw.prototype.s, Cw.prototype.getRevision = Cw.prototype.K, Cw.prototype.on = Cw.prototype.G, Cw.prototype.once = Cw.prototype.L, Cw.prototype.un = Cw.prototype.J, Cw.prototype.unByKey = Cw.prototype.M, Dw.prototype.getTileCoord = Dw.prototype.i, Pf.prototype.get = Pf.prototype.get, Pf.prototype.getKeys = Pf.prototype.O, Pf.prototype.getProperties = Pf.prototype.P, Pf.prototype.set = Pf.prototype.set, Pf.prototype.setProperties = Pf.prototype.I, Pf.prototype.unset = Pf.prototype.S, Pf.prototype.changed = Pf.prototype.s, Pf.prototype.getRevision = Pf.prototype.K, Pf.prototype.on = Pf.prototype.G, Pf.prototype.once = Pf.prototype.L, Pf.prototype.un = Pf.prototype.J, Pf.prototype.unByKey = Pf.prototype.M, _p.prototype.map = _p.prototype.map, _p.prototype.frameState = _p.prototype.frameState, Qp.prototype.originalEvent = Qp.prototype.originalEvent, Qp.prototype.pixel = Qp.prototype.pixel, Qp.prototype.coordinate = Qp.prototype.coordinate, Qp.prototype.dragging = Qp.prototype.dragging, Qp.prototype.preventDefault = Qp.prototype.preventDefault, Qp.prototype.stopPropagation = Qp.prototype.nb, Qp.prototype.map = Qp.prototype.map, Qp.prototype.frameState = Qp.prototype.frameState, Tf.prototype.get = Tf.prototype.get, Tf.prototype.getKeys = Tf.prototype.O, Tf.prototype.getProperties = Tf.prototype.P, Tf.prototype.set = Tf.prototype.set, Tf.prototype.setProperties = Tf.prototype.I, Tf.prototype.unset = Tf.prototype.S, Tf.prototype.changed = Tf.prototype.s, Tf.prototype.getRevision = Tf.prototype.K, Tf.prototype.on = Tf.prototype.G, Tf.prototype.once = Tf.prototype.L, Tf.prototype.un = Tf.prototype.J, Tf.prototype.unByKey = Tf.prototype.M, fr.prototype.get = fr.prototype.get, fr.prototype.getKeys = fr.prototype.O, fr.prototype.getProperties = fr.prototype.P, fr.prototype.set = fr.prototype.set, fr.prototype.setProperties = fr.prototype.I, fr.prototype.unset = fr.prototype.S, fr.prototype.changed = fr.prototype.s, fr.prototype.getRevision = fr.prototype.K, fr.prototype.on = fr.prototype.G, fr.prototype.once = fr.prototype.L, fr.prototype.un = fr.prototype.J, fr.prototype.unByKey = fr.prototype.M, Ux.prototype.getMaxZoom = Ux.prototype.eg, Ux.prototype.getMinZoom = Ux.prototype.fg, Ux.prototype.getOrigin = Ux.prototype.Kc, Ux.prototype.getResolution = Ux.prototype.ua, Ux.prototype.getResolutions = Ux.prototype.Xg, Ux.prototype.getTileCoordForCoordAndResolution = Ux.prototype.jd, Ux.prototype.getTileCoordForCoordAndZ = Ux.prototype.Rd, Ux.prototype.getTileSize = Ux.prototype.Ja, Ih.prototype.getOpacity = Ih.prototype.me, Ih.prototype.getRotateWithView = Ih.prototype.Pd, Ih.prototype.getRotation = Ih.prototype.ne, Ih.prototype.getScale = Ih.prototype.oe, Ih.prototype.getSnapToPixel = Ih.prototype.Qd, Ih.prototype.setRotation = Ih.prototype.pe, Ih.prototype.setScale = Ih.prototype.qe, Ea.prototype.getOpacity = Ea.prototype.me, Ea.prototype.getRotateWithView = Ea.prototype.Pd, Ea.prototype.getRotation = Ea.prototype.ne, Ea.prototype.getScale = Ea.prototype.oe, Ea.prototype.getSnapToPixel = Ea.prototype.Qd, Ea.prototype.setRotation = Ea.prototype.pe, Ea.prototype.setScale = Ea.prototype.qe, qx.prototype.getOpacity = qx.prototype.me, qx.prototype.getRotateWithView = qx.prototype.Pd, qx.prototype.getRotation = qx.prototype.ne, qx.prototype.getScale = qx.prototype.oe, qx.prototype.getSnapToPixel = qx.prototype.Qd, qx.prototype.setRotation = qx.prototype.pe, qx.prototype.setScale = qx.prototype.qe, zn.prototype.get = zn.prototype.get, zn.prototype.getKeys = zn.prototype.O, zn.prototype.getProperties = zn.prototype.P, zn.prototype.set = zn.prototype.set, zn.prototype.setProperties = zn.prototype.I, zn.prototype.unset = zn.prototype.S, zn.prototype.changed = zn.prototype.s, zn.prototype.getRevision = zn.prototype.K, zn.prototype.on = zn.prototype.G, zn.prototype.once = zn.prototype.L, zn.prototype.un = zn.prototype.J, zn.prototype.unByKey = zn.prototype.M, hs.prototype.getAttributions = hs.prototype.la, hs.prototype.getLogo = hs.prototype.ka, hs.prototype.getProjection = hs.prototype.ma, hs.prototype.getState = hs.prototype.na, hs.prototype.get = hs.prototype.get, hs.prototype.getKeys = hs.prototype.O, hs.prototype.getProperties = hs.prototype.P, hs.prototype.set = hs.prototype.set, hs.prototype.setProperties = hs.prototype.I, hs.prototype.unset = hs.prototype.S, hs.prototype.changed = hs.prototype.s, hs.prototype.getRevision = hs.prototype.K, hs.prototype.on = hs.prototype.G, hs.prototype.once = hs.prototype.L, hs.prototype.un = hs.prototype.J, hs.prototype.unByKey = hs.prototype.M, ix.prototype.getTileGrid = ix.prototype.za, ix.prototype.getAttributions = ix.prototype.la, ix.prototype.getLogo = ix.prototype.ka, ix.prototype.getProjection = ix.prototype.ma, ix.prototype.getState = ix.prototype.na, ix.prototype.get = ix.prototype.get, ix.prototype.getKeys = ix.prototype.O, ix.prototype.getProperties = ix.prototype.P, ix.prototype.set = ix.prototype.set, ix.prototype.setProperties = ix.prototype.I, ix.prototype.unset = ix.prototype.S, ix.prototype.changed = ix.prototype.s, ix.prototype.getRevision = ix.prototype.K, ix.prototype.on = ix.prototype.G, ix.prototype.once = ix.prototype.L, ix.prototype.un = ix.prototype.J, ix.prototype.unByKey = ix.prototype.M, nx.prototype.getTileLoadFunction = nx.prototype.ab, nx.prototype.getTileUrlFunction = nx.prototype.bb, nx.prototype.setTileLoadFunction = nx.prototype.ib, nx.prototype.setTileUrlFunction = nx.prototype.Fa, nx.prototype.getTileGrid = nx.prototype.za, nx.prototype.getAttributions = nx.prototype.la, nx.prototype.getLogo = nx.prototype.ka, nx.prototype.getProjection = nx.prototype.ma, nx.prototype.getState = nx.prototype.na, nx.prototype.get = nx.prototype.get, nx.prototype.getKeys = nx.prototype.O, nx.prototype.getProperties = nx.prototype.P, nx.prototype.set = nx.prototype.set, nx.prototype.setProperties = nx.prototype.I, nx.prototype.unset = nx.prototype.S, nx.prototype.changed = nx.prototype.s, nx.prototype.getRevision = nx.prototype.K, nx.prototype.on = nx.prototype.G, nx.prototype.once = nx.prototype.L, nx.prototype.un = nx.prototype.J, nx.prototype.unByKey = nx.prototype.M, sy.prototype.getAttributions = sy.prototype.la, sy.prototype.getLogo = sy.prototype.ka, sy.prototype.getProjection = sy.prototype.ma, sy.prototype.getState = sy.prototype.na, sy.prototype.get = sy.prototype.get, sy.prototype.getKeys = sy.prototype.O, sy.prototype.getProperties = sy.prototype.P, sy.prototype.set = sy.prototype.set, sy.prototype.setProperties = sy.prototype.I, sy.prototype.unset = sy.prototype.S, sy.prototype.changed = sy.prototype.s, sy.prototype.getRevision = sy.prototype.K, sy.prototype.on = sy.prototype.G, sy.prototype.once = sy.prototype.L, sy.prototype.un = sy.prototype.J, sy.prototype.unByKey = sy.prototype.M, px.prototype.addFeature = px.prototype.pd, px.prototype.addFeatures = px.prototype.xc, px.prototype.clear = px.prototype.clear, px.prototype.forEachFeature = px.prototype.Xf, px.prototype.forEachFeatureInExtent = px.prototype.fd, px.prototype.forEachFeatureIntersectingExtent = px.prototype.Se, px.prototype.getFeaturesCollection = px.prototype.We, px.prototype.getFeatures = px.prototype.Ic, px.prototype.getFeaturesAtCoordinate = px.prototype.Ve, px.prototype.getFeaturesInExtent = px.prototype.Xe, px.prototype.getClosestFeatureToCoordinate = px.prototype.Zf, px.prototype.getExtent = px.prototype.R, px.prototype.getFeatureById = px.prototype.Ue, px.prototype.removeFeature = px.prototype.Jc, px.prototype.getAttributions = px.prototype.la, px.prototype.getLogo = px.prototype.ka, px.prototype.getProjection = px.prototype.ma, px.prototype.getState = px.prototype.na, px.prototype.get = px.prototype.get, px.prototype.getKeys = px.prototype.O, px.prototype.getProperties = px.prototype.P, px.prototype.set = px.prototype.set, px.prototype.setProperties = px.prototype.I, px.prototype.unset = px.prototype.S, px.prototype.changed = px.prototype.s, px.prototype.getRevision = px.prototype.K, px.prototype.on = px.prototype.G, px.prototype.once = px.prototype.L, px.prototype.un = px.prototype.J, px.prototype.unByKey = px.prototype.M, Su.prototype.getAttributions = Su.prototype.la, Su.prototype.getLogo = Su.prototype.ka, Su.prototype.getProjection = Su.prototype.ma, Su.prototype.getState = Su.prototype.na, Su.prototype.get = Su.prototype.get, Su.prototype.getKeys = Su.prototype.O, Su.prototype.getProperties = Su.prototype.P, Su.prototype.set = Su.prototype.set, Su.prototype.setProperties = Su.prototype.I, Su.prototype.unset = Su.prototype.S, Su.prototype.changed = Su.prototype.s, Su.prototype.getRevision = Su.prototype.K, Su.prototype.on = Su.prototype.G, Su.prototype.once = Su.prototype.L, Su.prototype.un = Su.prototype.J, Su.prototype.unByKey = Su.prototype.M, Ru.prototype.getAttributions = Ru.prototype.la, Ru.prototype.getLogo = Ru.prototype.ka, Ru.prototype.getProjection = Ru.prototype.ma, Ru.prototype.getState = Ru.prototype.na, Ru.prototype.get = Ru.prototype.get, Ru.prototype.getKeys = Ru.prototype.O, Ru.prototype.getProperties = Ru.prototype.P, Ru.prototype.set = Ru.prototype.set, Ru.prototype.setProperties = Ru.prototype.I, Ru.prototype.unset = Ru.prototype.S, Ru.prototype.changed = Ru.prototype.s, Ru.prototype.getRevision = Ru.prototype.K, Ru.prototype.on = Ru.prototype.G, Ru.prototype.once = Ru.prototype.L, Ru.prototype.un = Ru.prototype.J, Ru.prototype.unByKey = Ru.prototype.M, lx.prototype.getAttributions = lx.prototype.la, lx.prototype.getLogo = lx.prototype.ka, lx.prototype.getProjection = lx.prototype.ma, lx.prototype.getState = lx.prototype.na, lx.prototype.get = lx.prototype.get, lx.prototype.getKeys = lx.prototype.O, lx.prototype.getProperties = lx.prototype.P, lx.prototype.set = lx.prototype.set, lx.prototype.setProperties = lx.prototype.I, lx.prototype.unset = lx.prototype.S, lx.prototype.changed = lx.prototype.s, lx.prototype.getRevision = lx.prototype.K, lx.prototype.on = lx.prototype.G, lx.prototype.once = lx.prototype.L, lx.prototype.un = lx.prototype.J, lx.prototype.unByKey = lx.prototype.M, ux.prototype.getAttributions = ux.prototype.la, ux.prototype.getLogo = ux.prototype.ka, ux.prototype.getProjection = ux.prototype.ma, ux.prototype.getState = ux.prototype.na, ux.prototype.get = ux.prototype.get, ux.prototype.getKeys = ux.prototype.O, ux.prototype.getProperties = ux.prototype.P, ux.prototype.set = ux.prototype.set, ux.prototype.setProperties = ux.prototype.I, ux.prototype.unset = ux.prototype.S, ux.prototype.changed = ux.prototype.s, ux.prototype.getRevision = ux.prototype.K, ux.prototype.on = ux.prototype.G, ux.prototype.once = ux.prototype.L, ux.prototype.un = ux.prototype.J, ux.prototype.unByKey = ux.prototype.M, cy.prototype.getAttributions = cy.prototype.la, cy.prototype.getLogo = cy.prototype.ka, cy.prototype.getProjection = cy.prototype.ma, cy.prototype.getState = cy.prototype.na, cy.prototype.get = cy.prototype.get, cy.prototype.getKeys = cy.prototype.O, cy.prototype.getProperties = cy.prototype.P, cy.prototype.set = cy.prototype.set, cy.prototype.setProperties = cy.prototype.I, cy.prototype.unset = cy.prototype.S, cy.prototype.changed = cy.prototype.s, cy.prototype.getRevision = cy.prototype.K, cy.prototype.on = cy.prototype.G, cy.prototype.once = cy.prototype.L, cy.prototype.un = cy.prototype.J, cy.prototype.unByKey = cy.prototype.M, cx.prototype.getAttributions = cx.prototype.la, cx.prototype.getLogo = cx.prototype.ka, cx.prototype.getProjection = cx.prototype.ma, cx.prototype.getState = cx.prototype.na, cx.prototype.get = cx.prototype.get, cx.prototype.getKeys = cx.prototype.O, cx.prototype.getProperties = cx.prototype.P, cx.prototype.set = cx.prototype.set, cx.prototype.setProperties = cx.prototype.I, cx.prototype.unset = cx.prototype.S, cx.prototype.changed = cx.prototype.s, cx.prototype.getRevision = cx.prototype.K, cx.prototype.on = cx.prototype.G, cx.prototype.once = cx.prototype.L, cx.prototype.un = cx.prototype.J, cx.prototype.unByKey = cx.prototype.M, dx.prototype.getTileLoadFunction = dx.prototype.ab, dx.prototype.getTileUrlFunction = dx.prototype.bb, dx.prototype.setTileLoadFunction = dx.prototype.ib, dx.prototype.setTileUrlFunction = dx.prototype.Fa, dx.prototype.getTileGrid = dx.prototype.za, dx.prototype.getAttributions = dx.prototype.la, dx.prototype.getLogo = dx.prototype.ka, dx.prototype.getProjection = dx.prototype.ma, dx.prototype.getState = dx.prototype.na, dx.prototype.get = dx.prototype.get, dx.prototype.getKeys = dx.prototype.O, dx.prototype.getProperties = dx.prototype.P, dx.prototype.set = dx.prototype.set, dx.prototype.setProperties = dx.prototype.I, dx.prototype.unset = dx.prototype.S, dx.prototype.changed = dx.prototype.s, dx.prototype.getRevision = dx.prototype.K, dx.prototype.on = dx.prototype.G, dx.prototype.once = dx.prototype.L, dx.prototype.un = dx.prototype.J, dx.prototype.unByKey = dx.prototype.M, mx.prototype.setUrl = mx.prototype.f, mx.prototype.getTileLoadFunction = mx.prototype.ab, mx.prototype.getTileUrlFunction = mx.prototype.bb, mx.prototype.setTileLoadFunction = mx.prototype.ib, mx.prototype.setTileUrlFunction = mx.prototype.Fa, mx.prototype.getTileGrid = mx.prototype.za, mx.prototype.getAttributions = mx.prototype.la, mx.prototype.getLogo = mx.prototype.ka, mx.prototype.getProjection = mx.prototype.ma, mx.prototype.getState = mx.prototype.na, mx.prototype.get = mx.prototype.get, mx.prototype.getKeys = mx.prototype.O, mx.prototype.getProperties = mx.prototype.P, mx.prototype.set = mx.prototype.set, mx.prototype.setProperties = mx.prototype.I, mx.prototype.unset = mx.prototype.S, mx.prototype.changed = mx.prototype.s, mx.prototype.getRevision = mx.prototype.K, mx.prototype.on = mx.prototype.G, mx.prototype.once = mx.prototype.L, mx.prototype.un = mx.prototype.J, mx.prototype.unByKey = mx.prototype.M, vx.prototype.setUrl = vx.prototype.f, vx.prototype.getTileLoadFunction = vx.prototype.ab, vx.prototype.getTileUrlFunction = vx.prototype.bb, vx.prototype.setTileLoadFunction = vx.prototype.ib, vx.prototype.setTileUrlFunction = vx.prototype.Fa, vx.prototype.getTileGrid = vx.prototype.za, vx.prototype.getAttributions = vx.prototype.la, vx.prototype.getLogo = vx.prototype.ka, vx.prototype.getProjection = vx.prototype.ma, vx.prototype.getState = vx.prototype.na, vx.prototype.get = vx.prototype.get, vx.prototype.getKeys = vx.prototype.O, vx.prototype.getProperties = vx.prototype.P, vx.prototype.set = vx.prototype.set, vx.prototype.setProperties = vx.prototype.I, vx.prototype.unset = vx.prototype.S, vx.prototype.changed = vx.prototype.s, vx.prototype.getRevision = vx.prototype.K, vx.prototype.on = vx.prototype.G, vx.prototype.once = vx.prototype.L, vx.prototype.un = vx.prototype.J, vx.prototype.unByKey = vx.prototype.M, Px.prototype.setUrl = Px.prototype.f, Px.prototype.getTileLoadFunction = Px.prototype.ab, Px.prototype.getTileUrlFunction = Px.prototype.bb, Px.prototype.setTileLoadFunction = Px.prototype.ib, Px.prototype.setTileUrlFunction = Px.prototype.Fa, Px.prototype.getTileGrid = Px.prototype.za, Px.prototype.getAttributions = Px.prototype.la, Px.prototype.getLogo = Px.prototype.ka, Px.prototype.getProjection = Px.prototype.ma, Px.prototype.getState = Px.prototype.na, Px.prototype.get = Px.prototype.get, Px.prototype.getKeys = Px.prototype.O, Px.prototype.getProperties = Px.prototype.P, Px.prototype.set = Px.prototype.set, Px.prototype.setProperties = Px.prototype.I, Px.prototype.unset = Px.prototype.S, Px.prototype.changed = Px.prototype.s, Px.prototype.getRevision = Px.prototype.K, Px.prototype.on = Px.prototype.G, Px.prototype.once = Px.prototype.L, Px.prototype.un = Px.prototype.J, Px.prototype.unByKey = Px.prototype.M, jx.prototype.getTileLoadFunction = jx.prototype.ab, jx.prototype.getTileUrlFunction = jx.prototype.bb, jx.prototype.setTileLoadFunction = jx.prototype.ib, jx.prototype.setTileUrlFunction = jx.prototype.Fa, jx.prototype.getTileGrid = jx.prototype.za, jx.prototype.getAttributions = jx.prototype.la, jx.prototype.getLogo = jx.prototype.ka, jx.prototype.getProjection = jx.prototype.ma, jx.prototype.getState = jx.prototype.na, jx.prototype.get = jx.prototype.get, jx.prototype.getKeys = jx.prototype.O, jx.prototype.getProperties = jx.prototype.P, jx.prototype.set = jx.prototype.set, jx.prototype.setProperties = jx.prototype.I, jx.prototype.unset = jx.prototype.S, jx.prototype.changed = jx.prototype.s, jx.prototype.getRevision = jx.prototype.K, jx.prototype.on = jx.prototype.G, jx.prototype.once = jx.prototype.L, jx.prototype.un = jx.prototype.J, jx.prototype.unByKey = jx.prototype.M, Cx.prototype.getTileGrid = Cx.prototype.za, Cx.prototype.getAttributions = Cx.prototype.la, Cx.prototype.getLogo = Cx.prototype.ka, Cx.prototype.getProjection = Cx.prototype.ma, Cx.prototype.getState = Cx.prototype.na, Cx.prototype.get = Cx.prototype.get, Cx.prototype.getKeys = Cx.prototype.O, Cx.prototype.getProperties = Cx.prototype.P, Cx.prototype.set = Cx.prototype.set, Cx.prototype.setProperties = Cx.prototype.I, Cx.prototype.unset = Cx.prototype.S, Cx.prototype.changed = Cx.prototype.s, Cx.prototype.getRevision = Cx.prototype.K, Cx.prototype.on = Cx.prototype.G, Cx.prototype.once = Cx.prototype.L, Cx.prototype.un = Cx.prototype.J, Cx.prototype.unByKey = Cx.prototype.M, Rx.prototype.getTileLoadFunction = Rx.prototype.ab, Rx.prototype.getTileUrlFunction = Rx.prototype.bb, Rx.prototype.setTileLoadFunction = Rx.prototype.ib, Rx.prototype.setTileUrlFunction = Rx.prototype.Fa, Rx.prototype.getTileGrid = Rx.prototype.za, Rx.prototype.getAttributions = Rx.prototype.la, Rx.prototype.getLogo = Rx.prototype.ka, Rx.prototype.getProjection = Rx.prototype.ma, Rx.prototype.getState = Rx.prototype.na, Rx.prototype.get = Rx.prototype.get, Rx.prototype.getKeys = Rx.prototype.O, Rx.prototype.getProperties = Rx.prototype.P, Rx.prototype.set = Rx.prototype.set, Rx.prototype.setProperties = Rx.prototype.I, Rx.prototype.unset = Rx.prototype.S, Rx.prototype.changed = Rx.prototype.s, Rx.prototype.getRevision = Rx.prototype.K, Rx.prototype.on = Rx.prototype.G, Rx.prototype.once = Rx.prototype.L, Rx.prototype.un = Rx.prototype.J, Rx.prototype.unByKey = Rx.prototype.M, Lx.prototype.getTileGrid = Lx.prototype.za, Lx.prototype.getAttributions = Lx.prototype.la, Lx.prototype.getLogo = Lx.prototype.ka, Lx.prototype.getProjection = Lx.prototype.ma, Lx.prototype.getState = Lx.prototype.na, Lx.prototype.get = Lx.prototype.get, Lx.prototype.getKeys = Lx.prototype.O, Lx.prototype.getProperties = Lx.prototype.P, Lx.prototype.set = Lx.prototype.set, Lx.prototype.setProperties = Lx.prototype.I, Lx.prototype.unset = Lx.prototype.S, Lx.prototype.changed = Lx.prototype.s, Lx.prototype.getRevision = Lx.prototype.K, Lx.prototype.on = Lx.prototype.G, Lx.prototype.once = Lx.prototype.L, Lx.prototype.un = Lx.prototype.J, Lx.prototype.unByKey = Lx.prototype.M, Nx.prototype.forEachFeatureIntersectingExtent = Nx.prototype.Se, Nx.prototype.getFeaturesCollection = Nx.prototype.We, Nx.prototype.getFeaturesAtCoordinate = Nx.prototype.Ve, Nx.prototype.getFeatureById = Nx.prototype.Ue, Nx.prototype.getAttributions = Nx.prototype.la, Nx.prototype.getLogo = Nx.prototype.ka, Nx.prototype.getProjection = Nx.prototype.ma, Nx.prototype.getState = Nx.prototype.na, Nx.prototype.get = Nx.prototype.get, Nx.prototype.getKeys = Nx.prototype.O, Nx.prototype.getProperties = Nx.prototype.P, Nx.prototype.set = Nx.prototype.set, Nx.prototype.setProperties = Nx.prototype.I, Nx.prototype.unset = Nx.prototype.S, Nx.prototype.changed = Nx.prototype.s, Nx.prototype.getRevision = Nx.prototype.K, Nx.prototype.on = Nx.prototype.G, Nx.prototype.once = Nx.prototype.L, Nx.prototype.un = Nx.prototype.J, Nx.prototype.unByKey = Nx.prototype.M, Dx.prototype.getTileLoadFunction = Dx.prototype.ab, Dx.prototype.getTileUrlFunction = Dx.prototype.bb, Dx.prototype.setTileLoadFunction = Dx.prototype.ib, Dx.prototype.setTileUrlFunction = Dx.prototype.Fa, Dx.prototype.getTileGrid = Dx.prototype.za, Dx.prototype.getAttributions = Dx.prototype.la, Dx.prototype.getLogo = Dx.prototype.ka, Dx.prototype.getProjection = Dx.prototype.ma, Dx.prototype.getState = Dx.prototype.na, Dx.prototype.get = Dx.prototype.get, Dx.prototype.getKeys = Dx.prototype.O, Dx.prototype.getProperties = Dx.prototype.P, Dx.prototype.set = Dx.prototype.set, Dx.prototype.setProperties = Dx.prototype.I, Dx.prototype.unset = Dx.prototype.S, Dx.prototype.changed = Dx.prototype.s, Dx.prototype.getRevision = Dx.prototype.K, Dx.prototype.on = Dx.prototype.G, Dx.prototype.once = Dx.prototype.L, Dx.prototype.un = Dx.prototype.J, Dx.prototype.unByKey = Dx.prototype.M, Kx.prototype.getTileLoadFunction = Kx.prototype.ab, Kx.prototype.getTileUrlFunction = Kx.prototype.bb, Kx.prototype.setTileLoadFunction = Kx.prototype.ib, Kx.prototype.setTileUrlFunction = Kx.prototype.Fa, Kx.prototype.getTileGrid = Kx.prototype.za, Kx.prototype.getAttributions = Kx.prototype.la, Kx.prototype.getLogo = Kx.prototype.ka, Kx.prototype.getProjection = Kx.prototype.ma, Kx.prototype.getState = Kx.prototype.na, Kx.prototype.get = Kx.prototype.get, Kx.prototype.getKeys = Kx.prototype.O, Kx.prototype.getProperties = Kx.prototype.P, Kx.prototype.set = Kx.prototype.set, Kx.prototype.setProperties = Kx.prototype.I, Kx.prototype.unset = Kx.prototype.S, Kx.prototype.changed = Kx.prototype.s, Kx.prototype.getRevision = Kx.prototype.K, Kx.prototype.on = Kx.prototype.G, Kx.prototype.once = Kx.prototype.L, Kx.prototype.un = Kx.prototype.J, Kx.prototype.unByKey = Kx.prototype.M, Vx.prototype.getTileLoadFunction = Vx.prototype.ab, Vx.prototype.getTileUrlFunction = Vx.prototype.bb, Vx.prototype.setTileLoadFunction = Vx.prototype.ib, Vx.prototype.setTileUrlFunction = Vx.prototype.Fa, Vx.prototype.getTileGrid = Vx.prototype.za, Vx.prototype.getAttributions = Vx.prototype.la, Vx.prototype.getLogo = Vx.prototype.ka, Vx.prototype.getProjection = Vx.prototype.ma, Vx.prototype.getState = Vx.prototype.na, Vx.prototype.get = Vx.prototype.get, Vx.prototype.getKeys = Vx.prototype.O, Vx.prototype.getProperties = Vx.prototype.P, Vx.prototype.set = Vx.prototype.set, Vx.prototype.setProperties = Vx.prototype.I, Vx.prototype.unset = Vx.prototype.S, Vx.prototype.changed = Vx.prototype.s, Vx.prototype.getRevision = Vx.prototype.K, Vx.prototype.on = Vx.prototype.G, Vx.prototype.once = Vx.prototype.L, Vx.prototype.un = Vx.prototype.J, Vx.prototype.unByKey = Vx.prototype.M, Sa.prototype.changed = Sa.prototype.s, Sa.prototype.getRevision = Sa.prototype.K, Sa.prototype.on = Sa.prototype.G, Sa.prototype.once = Sa.prototype.L, Sa.prototype.un = Sa.prototype.J, Sa.prototype.unByKey = Sa.prototype.M, uf.prototype.changed = uf.prototype.s, uf.prototype.getRevision = uf.prototype.K, uf.prototype.on = uf.prototype.G, uf.prototype.once = uf.prototype.L, uf.prototype.un = uf.prototype.J, uf.prototype.unByKey = uf.prototype.M, yf.prototype.changed = yf.prototype.s, yf.prototype.getRevision = yf.prototype.K, yf.prototype.on = yf.prototype.G, yf.prototype.once = yf.prototype.L, yf.prototype.un = yf.prototype.J, yf.prototype.unByKey = yf.prototype.M, vf.prototype.changed = vf.prototype.s, vf.prototype.getRevision = vf.prototype.K, vf.prototype.on = vf.prototype.G, vf.prototype.once = vf.prototype.L, vf.prototype.un = vf.prototype.J, vf.prototype.unByKey = vf.prototype.M, bf.prototype.changed = bf.prototype.s, bf.prototype.getRevision = bf.prototype.K, bf.prototype.on = bf.prototype.G, bf.prototype.once = bf.prototype.L, bf.prototype.un = bf.prototype.J, bf.prototype.unByKey = bf.prototype.M, by.prototype.changed = by.prototype.s, by.prototype.getRevision = by.prototype.K, by.prototype.on = by.prototype.G, by.prototype.once = by.prototype.L, by.prototype.un = by.prototype.J, by.prototype.unByKey = by.prototype.M, my.prototype.changed = my.prototype.s, my.prototype.getRevision = my.prototype.K, my.prototype.on = my.prototype.G, my.prototype.once = my.prototype.L, my.prototype.un = my.prototype.J, my.prototype.unByKey = my.prototype.M, wy.prototype.changed = wy.prototype.s, wy.prototype.getRevision = wy.prototype.K, wy.prototype.on = wy.prototype.G, wy.prototype.once = wy.prototype.L, wy.prototype.un = wy.prototype.J, wy.prototype.unByKey = wy.prototype.M, xy.prototype.changed = xy.prototype.s, xy.prototype.getRevision = xy.prototype.K, xy.prototype.on = xy.prototype.G, xy.prototype.once = xy.prototype.L, xy.prototype.un = xy.prototype.J, xy.prototype.unByKey = xy.prototype.M, Pl.prototype.changed = Pl.prototype.s, Pl.prototype.getRevision = Pl.prototype.K, Pl.prototype.on = Pl.prototype.G, Pl.prototype.once = Pl.prototype.L, Pl.prototype.un = Pl.prototype.J, Pl.prototype.unByKey = Pl.prototype.M, yy.prototype.changed = yy.prototype.s, yy.prototype.getRevision = yy.prototype.K, yy.prototype.on = yy.prototype.G, yy.prototype.once = yy.prototype.L, yy.prototype.un = yy.prototype.J, yy.prototype.unByKey = yy.prototype.M, fy.prototype.changed = fy.prototype.s, fy.prototype.getRevision = fy.prototype.K, fy.prototype.on = fy.prototype.G, fy.prototype.once = fy.prototype.L, fy.prototype.un = fy.prototype.J, fy.prototype.unByKey = fy.prototype.M, gy.prototype.changed = gy.prototype.s, gy.prototype.getRevision = gy.prototype.K, gy.prototype.on = gy.prototype.G, gy.prototype.once = gy.prototype.L, gy.prototype.un = gy.prototype.J, gy.prototype.unByKey = gy.prototype.M, ua.prototype.get = ua.prototype.get, ua.prototype.getKeys = ua.prototype.O, ua.prototype.getProperties = ua.prototype.P, ua.prototype.set = ua.prototype.set, ua.prototype.setProperties = ua.prototype.I, ua.prototype.unset = ua.prototype.S, ua.prototype.changed = ua.prototype.s, ua.prototype.getRevision = ua.prototype.K, ua.prototype.on = ua.prototype.G, ua.prototype.once = ua.prototype.L, ua.prototype.un = ua.prototype.J, ua.prototype.unByKey = ua.prototype.M, ga.prototype.getBrightness = ga.prototype.Ib, ga.prototype.getContrast = ga.prototype.Jb, ga.prototype.getHue = ga.prototype.Kb, ga.prototype.getExtent = ga.prototype.R, ga.prototype.getMaxResolution = ga.prototype.Lb, ga.prototype.getMinResolution = ga.prototype.Mb, ga.prototype.getOpacity = ga.prototype.Rb, ga.prototype.getSaturation = ga.prototype.Nb, ga.prototype.getVisible = ga.prototype.mb, ga.prototype.setBrightness = ga.prototype.mc, ga.prototype.setContrast = ga.prototype.nc, ga.prototype.setHue = ga.prototype.oc, ga.prototype.setExtent = ga.prototype.hc, ga.prototype.setMaxResolution = ga.prototype.pc, ga.prototype.setMinResolution = ga.prototype.qc, ga.prototype.setOpacity = ga.prototype.ic, ga.prototype.setSaturation = ga.prototype.rc, ga.prototype.setVisible = ga.prototype.sc, ga.prototype.get = ga.prototype.get, ga.prototype.getKeys = ga.prototype.O, ga.prototype.getProperties = ga.prototype.P, ga.prototype.set = ga.prototype.set, ga.prototype.setProperties = ga.prototype.I, ga.prototype.unset = ga.prototype.S, ga.prototype.changed = ga.prototype.s, ga.prototype.getRevision = ga.prototype.K, ga.prototype.on = ga.prototype.G, ga.prototype.once = ga.prototype.L, ga.prototype.un = ga.prototype.J, ga.prototype.unByKey = ga.prototype.M, fl.prototype.setMap = fl.prototype.setMap, fl.prototype.setSource = fl.prototype.Qc, fl.prototype.getBrightness = fl.prototype.Ib, fl.prototype.getContrast = fl.prototype.Jb, fl.prototype.getHue = fl.prototype.Kb, fl.prototype.getExtent = fl.prototype.R, fl.prototype.getMaxResolution = fl.prototype.Lb, fl.prototype.getMinResolution = fl.prototype.Mb, fl.prototype.getOpacity = fl.prototype.Rb, fl.prototype.getSaturation = fl.prototype.Nb, fl.prototype.getVisible = fl.prototype.mb, fl.prototype.setBrightness = fl.prototype.mc, fl.prototype.setContrast = fl.prototype.nc, fl.prototype.setHue = fl.prototype.oc, fl.prototype.setExtent = fl.prototype.hc, fl.prototype.setMaxResolution = fl.prototype.pc, fl.prototype.setMinResolution = fl.prototype.qc, fl.prototype.setOpacity = fl.prototype.ic, fl.prototype.setSaturation = fl.prototype.rc, fl.prototype.setVisible = fl.prototype.sc, fl.prototype.get = fl.prototype.get, fl.prototype.getKeys = fl.prototype.O, fl.prototype.getProperties = fl.prototype.P, fl.prototype.set = fl.prototype.set, fl.prototype.setProperties = fl.prototype.I, fl.prototype.unset = fl.prototype.S, fl.prototype.changed = fl.prototype.s, fl.prototype.getRevision = fl.prototype.K, fl.prototype.on = fl.prototype.G, fl.prototype.once = fl.prototype.L, fl.prototype.un = fl.prototype.J, fl.prototype.unByKey = fl.prototype.M, VS.prototype.getSource = VS.prototype.da, VS.prototype.getStyle = VS.prototype.T, VS.prototype.getStyleFunction = VS.prototype.ba, VS.prototype.setStyle = VS.prototype.g, VS.prototype.setMap = VS.prototype.setMap, VS.prototype.setSource = VS.prototype.Qc, VS.prototype.getBrightness = VS.prototype.Ib, VS.prototype.getContrast = VS.prototype.Jb, VS.prototype.getHue = VS.prototype.Kb, VS.prototype.getExtent = VS.prototype.R, VS.prototype.getMaxResolution = VS.prototype.Lb, VS.prototype.getMinResolution = VS.prototype.Mb, VS.prototype.getOpacity = VS.prototype.Rb, VS.prototype.getSaturation = VS.prototype.Nb, VS.prototype.getVisible = VS.prototype.mb, VS.prototype.setBrightness = VS.prototype.mc, VS.prototype.setContrast = VS.prototype.nc, VS.prototype.setHue = VS.prototype.oc, VS.prototype.setExtent = VS.prototype.hc, VS.prototype.setMaxResolution = VS.prototype.pc, VS.prototype.setMinResolution = VS.prototype.qc, VS.prototype.setOpacity = VS.prototype.ic, VS.prototype.setSaturation = VS.prototype.rc, VS.prototype.setVisible = VS.prototype.sc, VS.prototype.get = VS.prototype.get, VS.prototype.getKeys = VS.prototype.O, VS.prototype.getProperties = VS.prototype.P, VS.prototype.set = VS.prototype.set, VS.prototype.setProperties = VS.prototype.I, VS.prototype.unset = VS.prototype.S, VS.prototype.changed = VS.prototype.s, VS.prototype.getRevision = VS.prototype.K, VS.prototype.on = VS.prototype.G, VS.prototype.once = VS.prototype.L, VS.prototype.un = VS.prototype.J, VS.prototype.unByKey = VS.prototype.M, cl.prototype.setMap = cl.prototype.setMap, cl.prototype.setSource = cl.prototype.Qc, cl.prototype.getBrightness = cl.prototype.Ib, cl.prototype.getContrast = cl.prototype.Jb, cl.prototype.getHue = cl.prototype.Kb, cl.prototype.getExtent = cl.prototype.R, cl.prototype.getMaxResolution = cl.prototype.Lb, cl.prototype.getMinResolution = cl.prototype.Mb, cl.prototype.getOpacity = cl.prototype.Rb, cl.prototype.getSaturation = cl.prototype.Nb, cl.prototype.getVisible = cl.prototype.mb, cl.prototype.setBrightness = cl.prototype.mc, cl.prototype.setContrast = cl.prototype.nc, cl.prototype.setHue = cl.prototype.oc, cl.prototype.setExtent = cl.prototype.hc, cl.prototype.setMaxResolution = cl.prototype.pc, cl.prototype.setMinResolution = cl.prototype.qc, cl.prototype.setOpacity = cl.prototype.ic, cl.prototype.setSaturation = cl.prototype.rc, cl.prototype.setVisible = cl.prototype.sc, cl.prototype.get = cl.prototype.get, cl.prototype.getKeys = cl.prototype.O, cl.prototype.getProperties = cl.prototype.P, cl.prototype.set = cl.prototype.set, cl.prototype.setProperties = cl.prototype.I, cl.prototype.unset = cl.prototype.S, cl.prototype.changed = cl.prototype.s, cl.prototype.getRevision = cl.prototype.K, cl.prototype.on = cl.prototype.G, cl.prototype.once = cl.prototype.L, cl.prototype.un = cl.prototype.J, cl.prototype.unByKey = cl.prototype.M, tl.prototype.getBrightness = tl.prototype.Ib, tl.prototype.getContrast = tl.prototype.Jb, tl.prototype.getHue = tl.prototype.Kb, tl.prototype.getExtent = tl.prototype.R, tl.prototype.getMaxResolution = tl.prototype.Lb, tl.prototype.getMinResolution = tl.prototype.Mb, tl.prototype.getOpacity = tl.prototype.Rb, tl.prototype.getSaturation = tl.prototype.Nb, tl.prototype.getVisible = tl.prototype.mb, tl.prototype.setBrightness = tl.prototype.mc, tl.prototype.setContrast = tl.prototype.nc, tl.prototype.setHue = tl.prototype.oc, tl.prototype.setExtent = tl.prototype.hc, tl.prototype.setMaxResolution = tl.prototype.pc, tl.prototype.setMinResolution = tl.prototype.qc, tl.prototype.setOpacity = tl.prototype.ic, tl.prototype.setSaturation = tl.prototype.rc, tl.prototype.setVisible = tl.prototype.sc, tl.prototype.get = tl.prototype.get, tl.prototype.getKeys = tl.prototype.O, tl.prototype.getProperties = tl.prototype.P, tl.prototype.set = tl.prototype.set, tl.prototype.setProperties = tl.prototype.I, tl.prototype.unset = tl.prototype.S, tl.prototype.changed = tl.prototype.s, tl.prototype.getRevision = tl.prototype.K, tl.prototype.on = tl.prototype.G, tl.prototype.once = tl.prototype.L, tl.prototype.un = tl.prototype.J, tl.prototype.unByKey = tl.prototype.M, yl.prototype.setMap = yl.prototype.setMap, yl.prototype.setSource = yl.prototype.Qc, yl.prototype.getBrightness = yl.prototype.Ib, yl.prototype.getContrast = yl.prototype.Jb, yl.prototype.getHue = yl.prototype.Kb, yl.prototype.getExtent = yl.prototype.R, yl.prototype.getMaxResolution = yl.prototype.Lb, yl.prototype.getMinResolution = yl.prototype.Mb, yl.prototype.getOpacity = yl.prototype.Rb, yl.prototype.getSaturation = yl.prototype.Nb, yl.prototype.getVisible = yl.prototype.mb, yl.prototype.setBrightness = yl.prototype.mc, yl.prototype.setContrast = yl.prototype.nc, yl.prototype.setHue = yl.prototype.oc, yl.prototype.setExtent = yl.prototype.hc, yl.prototype.setMaxResolution = yl.prototype.pc, yl.prototype.setMinResolution = yl.prototype.qc, yl.prototype.setOpacity = yl.prototype.ic, yl.prototype.setSaturation = yl.prototype.rc, yl.prototype.setVisible = yl.prototype.sc, yl.prototype.get = yl.prototype.get, yl.prototype.getKeys = yl.prototype.O, yl.prototype.getProperties = yl.prototype.P, yl.prototype.set = yl.prototype.set, yl.prototype.setProperties = yl.prototype.I, yl.prototype.unset = yl.prototype.S, yl.prototype.changed = yl.prototype.s, yl.prototype.getRevision = yl.prototype.K, yl.prototype.on = yl.prototype.G, yl.prototype.once = yl.prototype.L, yl.prototype.un = yl.prototype.J, yl.prototype.unByKey = yl.prototype.M, za.prototype.get = za.prototype.get, za.prototype.getKeys = za.prototype.O, za.prototype.getProperties = za.prototype.P, za.prototype.set = za.prototype.set, za.prototype.setProperties = za.prototype.I, za.prototype.unset = za.prototype.S, za.prototype.changed = za.prototype.s, za.prototype.getRevision = za.prototype.K, za.prototype.on = za.prototype.G, za.prototype.once = za.prototype.L, za.prototype.un = za.prototype.J, za.prototype.unByKey = za.prototype.M, $a.prototype.getActive = $a.prototype.b, $a.prototype.setActive = $a.prototype.f, $a.prototype.get = $a.prototype.get, $a.prototype.getKeys = $a.prototype.O, $a.prototype.getProperties = $a.prototype.P, $a.prototype.set = $a.prototype.set, $a.prototype.setProperties = $a.prototype.I, $a.prototype.unset = $a.prototype.S, $a.prototype.changed = $a.prototype.s, $a.prototype.getRevision = $a.prototype.K, $a.prototype.on = $a.prototype.G, $a.prototype.once = $a.prototype.L, $a.prototype.un = $a.prototype.J, $a.prototype.unByKey = $a.prototype.M, eS.prototype.getActive = eS.prototype.b, eS.prototype.setActive = eS.prototype.f, eS.prototype.get = eS.prototype.get, eS.prototype.getKeys = eS.prototype.O, eS.prototype.getProperties = eS.prototype.P, eS.prototype.set = eS.prototype.set, eS.prototype.setProperties = eS.prototype.I, eS.prototype.unset = eS.prototype.S, eS.prototype.changed = eS.prototype.s, eS.prototype.getRevision = eS.prototype.K, eS.prototype.on = eS.prototype.G, eS.prototype.once = eS.prototype.L, eS.prototype.un = eS.prototype.J, eS.prototype.unByKey = eS.prototype.M, sh.prototype.getActive = sh.prototype.b, sh.prototype.setActive = sh.prototype.f, sh.prototype.get = sh.prototype.get, sh.prototype.getKeys = sh.prototype.O, sh.prototype.getProperties = sh.prototype.P, sh.prototype.set = sh.prototype.set, sh.prototype.setProperties = sh.prototype.I, sh.prototype.unset = sh.prototype.S, sh.prototype.changed = sh.prototype.s, sh.prototype.getRevision = sh.prototype.K, sh.prototype.on = sh.prototype.G, sh.prototype.once = sh.prototype.L, sh.prototype.un = sh.prototype.J, sh.prototype.unByKey = sh.prototype.M, Sh.prototype.getActive = Sh.prototype.b, Sh.prototype.setActive = Sh.prototype.f, Sh.prototype.get = Sh.prototype.get, Sh.prototype.getKeys = Sh.prototype.O, Sh.prototype.getProperties = Sh.prototype.P, Sh.prototype.set = Sh.prototype.set, Sh.prototype.setProperties = Sh.prototype.I, Sh.prototype.unset = Sh.prototype.S, Sh.prototype.changed = Sh.prototype.s, Sh.prototype.getRevision = Sh.prototype.K, Sh.prototype.on = Sh.prototype.G, Sh.prototype.once = Sh.prototype.L, Sh.prototype.un = Sh.prototype.J, Sh.prototype.unByKey = Sh.prototype.M, hh.prototype.getActive = hh.prototype.b, hh.prototype.setActive = hh.prototype.f, hh.prototype.get = hh.prototype.get, hh.prototype.getKeys = hh.prototype.O, hh.prototype.getProperties = hh.prototype.P, hh.prototype.set = hh.prototype.set, hh.prototype.setProperties = hh.prototype.I, hh.prototype.unset = hh.prototype.S, hh.prototype.changed = hh.prototype.s, hh.prototype.getRevision = hh.prototype.K, hh.prototype.on = hh.prototype.G, hh.prototype.once = hh.prototype.L, hh.prototype.un = hh.prototype.J, hh.prototype.unByKey = hh.prototype.M, nS.prototype.getActive = nS.prototype.b, nS.prototype.setActive = nS.prototype.f, nS.prototype.get = nS.prototype.get, nS.prototype.getKeys = nS.prototype.O, nS.prototype.getProperties = nS.prototype.P, nS.prototype.set = nS.prototype.set, nS.prototype.setProperties = nS.prototype.I, nS.prototype.unset = nS.prototype.S, nS.prototype.changed = nS.prototype.s, nS.prototype.getRevision = nS.prototype.K, nS.prototype.on = nS.prototype.G, nS.prototype.once = nS.prototype.L, nS.prototype.un = nS.prototype.J, nS.prototype.unByKey = nS.prototype.M, yh.prototype.getActive = yh.prototype.b, yh.prototype.setActive = yh.prototype.f, yh.prototype.get = yh.prototype.get, yh.prototype.getKeys = yh.prototype.O, yh.prototype.getProperties = yh.prototype.P, yh.prototype.set = yh.prototype.set, yh.prototype.setProperties = yh.prototype.I, yh.prototype.unset = yh.prototype.S, yh.prototype.changed = yh.prototype.s, yh.prototype.getRevision = yh.prototype.K, yh.prototype.on = yh.prototype.G, yh.prototype.once = yh.prototype.L, yh.prototype.un = yh.prototype.J, yh.prototype.unByKey = yh.prototype.M, Bh.prototype.getGeometry = Bh.prototype.Y, Bh.prototype.getActive = Bh.prototype.b, Bh.prototype.setActive = Bh.prototype.f, Bh.prototype.get = Bh.prototype.get, Bh.prototype.getKeys = Bh.prototype.O, Bh.prototype.getProperties = Bh.prototype.P, Bh.prototype.set = Bh.prototype.set, Bh.prototype.setProperties = Bh.prototype.I, Bh.prototype.unset = Bh.prototype.S, Bh.prototype.changed = Bh.prototype.s, Bh.prototype.getRevision = Bh.prototype.K, Bh.prototype.on = Bh.prototype.G, Bh.prototype.once = Bh.prototype.L, Bh.prototype.un = Bh.prototype.J, Bh.prototype.unByKey = Bh.prototype.M, lS.prototype.getActive = lS.prototype.b, lS.prototype.setActive = lS.prototype.f, lS.prototype.get = lS.prototype.get, lS.prototype.getKeys = lS.prototype.O, lS.prototype.getProperties = lS.prototype.P, lS.prototype.set = lS.prototype.set, lS.prototype.setProperties = lS.prototype.I, lS.prototype.unset = lS.prototype.S, lS.prototype.changed = lS.prototype.s, lS.prototype.getRevision = lS.prototype.K, lS.prototype.on = lS.prototype.G, lS.prototype.once = lS.prototype.L, lS.prototype.un = lS.prototype.J, lS.prototype.unByKey = lS.prototype.M, Gh.prototype.getActive = Gh.prototype.b, Gh.prototype.setActive = Gh.prototype.f, Gh.prototype.get = Gh.prototype.get, Gh.prototype.getKeys = Gh.prototype.O, Gh.prototype.getProperties = Gh.prototype.P, Gh.prototype.set = Gh.prototype.set, Gh.prototype.setProperties = Gh.prototype.I, Gh.prototype.unset = Gh.prototype.S, Gh.prototype.changed = Gh.prototype.s, Gh.prototype.getRevision = Gh.prototype.K, Gh.prototype.on = Gh.prototype.G, Gh.prototype.once = Gh.prototype.L, Gh.prototype.un = Gh.prototype.J, Gh.prototype.unByKey = Gh.prototype.M, Xh.prototype.getActive = Xh.prototype.b, Xh.prototype.setActive = Xh.prototype.f, Xh.prototype.get = Xh.prototype.get, Xh.prototype.getKeys = Xh.prototype.O, Xh.prototype.getProperties = Xh.prototype.P, Xh.prototype.set = Xh.prototype.set, Xh.prototype.setProperties = Xh.prototype.I, Xh.prototype.unset = Xh.prototype.S, Xh.prototype.changed = Xh.prototype.s, Xh.prototype.getRevision = Xh.prototype.K, Xh.prototype.on = Xh.prototype.G, Xh.prototype.once = Xh.prototype.L, Xh.prototype.un = Xh.prototype.J, Xh.prototype.unByKey = Xh.prototype.M, jS.prototype.getActive = jS.prototype.b, jS.prototype.setActive = jS.prototype.f, jS.prototype.get = jS.prototype.get, jS.prototype.getKeys = jS.prototype.O, jS.prototype.getProperties = jS.prototype.P, jS.prototype.set = jS.prototype.set, jS.prototype.setProperties = jS.prototype.I, jS.prototype.unset = jS.prototype.S, jS.prototype.changed = jS.prototype.s, jS.prototype.getRevision = jS.prototype.K, jS.prototype.on = jS.prototype.G, jS.prototype.once = jS.prototype.L, jS.prototype.un = jS.prototype.J, jS.prototype.unByKey = jS.prototype.M, Yh.prototype.getActive = Yh.prototype.b, Yh.prototype.setActive = Yh.prototype.f, Yh.prototype.get = Yh.prototype.get, Yh.prototype.getKeys = Yh.prototype.O, Yh.prototype.getProperties = Yh.prototype.P, Yh.prototype.set = Yh.prototype.set, Yh.prototype.setProperties = Yh.prototype.I, Yh.prototype.unset = Yh.prototype.S, Yh.prototype.changed = Yh.prototype.s, Yh.prototype.getRevision = Yh.prototype.K, Yh.prototype.on = Yh.prototype.G, Yh.prototype.once = Yh.prototype.L, Yh.prototype.un = Yh.prototype.J, Yh.prototype.unByKey = Yh.prototype.M, Hh.prototype.getActive = Hh.prototype.b, Hh.prototype.setActive = Hh.prototype.f, Hh.prototype.get = Hh.prototype.get, Hh.prototype.getKeys = Hh.prototype.O, Hh.prototype.getProperties = Hh.prototype.P, Hh.prototype.set = Hh.prototype.set, Hh.prototype.setProperties = Hh.prototype.I, Hh.prototype.unset = Hh.prototype.S, Hh.prototype.changed = Hh.prototype.s, Hh.prototype.getRevision = Hh.prototype.K, Hh.prototype.on = Hh.prototype.G, Hh.prototype.once = Hh.prototype.L, Hh.prototype.un = Hh.prototype.J, Hh.prototype.unByKey = Hh.prototype.M, Jh.prototype.getActive = Jh.prototype.b, Jh.prototype.setActive = Jh.prototype.f, Jh.prototype.get = Jh.prototype.get, Jh.prototype.getKeys = Jh.prototype.O, Jh.prototype.getProperties = Jh.prototype.P, Jh.prototype.set = Jh.prototype.set, Jh.prototype.setProperties = Jh.prototype.I, Jh.prototype.unset = Jh.prototype.S, Jh.prototype.changed = Jh.prototype.s, Jh.prototype.getRevision = Jh.prototype.K, Jh.prototype.on = Jh.prototype.G, Jh.prototype.once = Jh.prototype.L, Jh.prototype.un = Jh.prototype.J, Jh.prototype.unByKey = Jh.prototype.M, OS.prototype.getActive = OS.prototype.b, OS.prototype.setActive = OS.prototype.f, OS.prototype.get = OS.prototype.get, OS.prototype.getKeys = OS.prototype.O, OS.prototype.getProperties = OS.prototype.P, OS.prototype.set = OS.prototype.set, OS.prototype.setProperties = OS.prototype.I, OS.prototype.unset = OS.prototype.S, OS.prototype.changed = OS.prototype.s, OS.prototype.getRevision = OS.prototype.K, OS.prototype.on = OS.prototype.G, OS.prototype.once = OS.prototype.L, OS.prototype.un = OS.prototype.J, OS.prototype.unByKey = OS.prototype.M, US.prototype.getActive = US.prototype.b, US.prototype.setActive = US.prototype.f, US.prototype.get = US.prototype.get, US.prototype.getKeys = US.prototype.O, US.prototype.getProperties = US.prototype.P, US.prototype.set = US.prototype.set, US.prototype.setProperties = US.prototype.I, US.prototype.unset = US.prototype.S, US.prototype.changed = US.prototype.s, US.prototype.getRevision = US.prototype.K, US.prototype.on = US.prototype.G, US.prototype.once = US.prototype.L, US.prototype.un = US.prototype.J, US.prototype.unByKey = US.prototype.M, Mi.prototype.get = Mi.prototype.get, Mi.prototype.getKeys = Mi.prototype.O, Mi.prototype.getProperties = Mi.prototype.P, Mi.prototype.set = Mi.prototype.set, Mi.prototype.setProperties = Mi.prototype.I, Mi.prototype.unset = Mi.prototype.S, Mi.prototype.changed = Mi.prototype.s, Mi.prototype.getRevision = Mi.prototype.K, Mi.prototype.on = Mi.prototype.G, Mi.prototype.once = Mi.prototype.L, Mi.prototype.un = Mi.prototype.J, Mi.prototype.unByKey = Mi.prototype.M, Ti.prototype.getClosestPoint = Ti.prototype.$a, Ti.prototype.getExtent = Ti.prototype.R, Ti.prototype.transform = Ti.prototype.transform, Ti.prototype.get = Ti.prototype.get, Ti.prototype.getKeys = Ti.prototype.O, Ti.prototype.getProperties = Ti.prototype.P, Ti.prototype.set = Ti.prototype.set, Ti.prototype.setProperties = Ti.prototype.I, Ti.prototype.unset = Ti.prototype.S, Ti.prototype.changed = Ti.prototype.s, Ti.prototype.getRevision = Ti.prototype.K, Ti.prototype.on = Ti.prototype.G, Ti.prototype.once = Ti.prototype.L, Ti.prototype.un = Ti.prototype.J, Ti.prototype.unByKey = Ti.prototype.M, Jl.prototype.getFirstCoordinate = Jl.prototype.Ab, Jl.prototype.getLastCoordinate = Jl.prototype.Bb, Jl.prototype.getLayout = Jl.prototype.Cb, Jl.prototype.applyTransform = Jl.prototype.va, Jl.prototype.translate = Jl.prototype.Ua, Jl.prototype.getClosestPoint = Jl.prototype.$a, Jl.prototype.getExtent = Jl.prototype.R, Jl.prototype.get = Jl.prototype.get, Jl.prototype.getKeys = Jl.prototype.O, Jl.prototype.getProperties = Jl.prototype.P, Jl.prototype.set = Jl.prototype.set, Jl.prototype.setProperties = Jl.prototype.I, Jl.prototype.unset = Jl.prototype.S, Jl.prototype.changed = Jl.prototype.s, Jl.prototype.getRevision = Jl.prototype.K, Jl.prototype.on = Jl.prototype.G, Jl.prototype.once = Jl.prototype.L, Jl.prototype.un = Jl.prototype.J, Jl.prototype.unByKey = Jl.prototype.M, $l.prototype.getClosestPoint = $l.prototype.$a, $l.prototype.getExtent = $l.prototype.R, $l.prototype.transform = $l.prototype.transform, $l.prototype.get = $l.prototype.get, $l.prototype.getKeys = $l.prototype.O, $l.prototype.getProperties = $l.prototype.P, $l.prototype.set = $l.prototype.set, $l.prototype.setProperties = $l.prototype.I, $l.prototype.unset = $l.prototype.S, $l.prototype.changed = $l.prototype.s, $l.prototype.getRevision = $l.prototype.K, $l.prototype.on = $l.prototype.G, $l.prototype.once = $l.prototype.L, $l.prototype.un = $l.prototype.J, $l.prototype.unByKey = $l.prototype.M, Hi.prototype.getFirstCoordinate = Hi.prototype.Ab, Hi.prototype.getLastCoordinate = Hi.prototype.Bb, Hi.prototype.getLayout = Hi.prototype.Cb, Hi.prototype.applyTransform = Hi.prototype.va, Hi.prototype.translate = Hi.prototype.Ua, Hi.prototype.getClosestPoint = Hi.prototype.$a, Hi.prototype.getExtent = Hi.prototype.R, Hi.prototype.transform = Hi.prototype.transform, Hi.prototype.get = Hi.prototype.get, Hi.prototype.getKeys = Hi.prototype.O, Hi.prototype.getProperties = Hi.prototype.P, Hi.prototype.set = Hi.prototype.set, Hi.prototype.setProperties = Hi.prototype.I, Hi.prototype.unset = Hi.prototype.S, Hi.prototype.changed = Hi.prototype.s, Hi.prototype.getRevision = Hi.prototype.K, Hi.prototype.on = Hi.prototype.G, Hi.prototype.once = Hi.prototype.L, Hi.prototype.un = Hi.prototype.J, Hi.prototype.unByKey = Hi.prototype.M, iu.prototype.getFirstCoordinate = iu.prototype.Ab, iu.prototype.getLastCoordinate = iu.prototype.Bb, iu.prototype.getLayout = iu.prototype.Cb, iu.prototype.applyTransform = iu.prototype.va, iu.prototype.translate = iu.prototype.Ua, iu.prototype.getClosestPoint = iu.prototype.$a, iu.prototype.getExtent = iu.prototype.R, iu.prototype.transform = iu.prototype.transform, iu.prototype.get = iu.prototype.get, iu.prototype.getKeys = iu.prototype.O, iu.prototype.getProperties = iu.prototype.P, iu.prototype.set = iu.prototype.set, iu.prototype.setProperties = iu.prototype.I, iu.prototype.unset = iu.prototype.S, iu.prototype.changed = iu.prototype.s, iu.prototype.getRevision = iu.prototype.K, iu.prototype.on = iu.prototype.G, iu.prototype.once = iu.prototype.L, iu.prototype.un = iu.prototype.J, iu.prototype.unByKey = iu.prototype.M, su.prototype.getFirstCoordinate = su.prototype.Ab, su.prototype.getLastCoordinate = su.prototype.Bb, su.prototype.getLayout = su.prototype.Cb, su.prototype.applyTransform = su.prototype.va, su.prototype.translate = su.prototype.Ua, su.prototype.getClosestPoint = su.prototype.$a, su.prototype.getExtent = su.prototype.R, su.prototype.transform = su.prototype.transform, su.prototype.get = su.prototype.get, su.prototype.getKeys = su.prototype.O, su.prototype.getProperties = su.prototype.P, su.prototype.set = su.prototype.set, su.prototype.setProperties = su.prototype.I, su.prototype.unset = su.prototype.S, su.prototype.changed = su.prototype.s, su.prototype.getRevision = su.prototype.K, su.prototype.on = su.prototype.G, su.prototype.once = su.prototype.L, su.prototype.un = su.prototype.J, su.prototype.unByKey = su.prototype.M, lu.prototype.getFirstCoordinate = lu.prototype.Ab, lu.prototype.getLastCoordinate = lu.prototype.Bb, lu.prototype.getLayout = lu.prototype.Cb, lu.prototype.applyTransform = lu.prototype.va, lu.prototype.translate = lu.prototype.Ua, lu.prototype.getClosestPoint = lu.prototype.$a, lu.prototype.getExtent = lu.prototype.R, lu.prototype.transform = lu.prototype.transform, lu.prototype.get = lu.prototype.get, lu.prototype.getKeys = lu.prototype.O, lu.prototype.getProperties = lu.prototype.P, lu.prototype.set = lu.prototype.set, lu.prototype.setProperties = lu.prototype.I, lu.prototype.unset = lu.prototype.S, lu.prototype.changed = lu.prototype.s, lu.prototype.getRevision = lu.prototype.K, lu.prototype.on = lu.prototype.G, lu.prototype.once = lu.prototype.L, lu.prototype.un = lu.prototype.J, lu.prototype.unByKey = lu.prototype.M, uu.prototype.getFirstCoordinate = uu.prototype.Ab, uu.prototype.getLastCoordinate = uu.prototype.Bb, uu.prototype.getLayout = uu.prototype.Cb, uu.prototype.applyTransform = uu.prototype.va, uu.prototype.translate = uu.prototype.Ua, uu.prototype.getClosestPoint = uu.prototype.$a, uu.prototype.getExtent = uu.prototype.R, uu.prototype.transform = uu.prototype.transform, uu.prototype.get = uu.prototype.get, uu.prototype.getKeys = uu.prototype.O, uu.prototype.getProperties = uu.prototype.P, uu.prototype.set = uu.prototype.set, uu.prototype.setProperties = uu.prototype.I, uu.prototype.unset = uu.prototype.S, uu.prototype.changed = uu.prototype.s, uu.prototype.getRevision = uu.prototype.K, uu.prototype.on = uu.prototype.G, uu.prototype.once = uu.prototype.L, uu.prototype.un = uu.prototype.J, uu.prototype.unByKey = uu.prototype.M, zi.prototype.getFirstCoordinate = zi.prototype.Ab, zi.prototype.getLastCoordinate = zi.prototype.Bb, zi.prototype.getLayout = zi.prototype.Cb, zi.prototype.applyTransform = zi.prototype.va, zi.prototype.translate = zi.prototype.Ua, zi.prototype.getClosestPoint = zi.prototype.$a, zi.prototype.getExtent = zi.prototype.R, zi.prototype.transform = zi.prototype.transform, zi.prototype.get = zi.prototype.get, zi.prototype.getKeys = zi.prototype.O, zi.prototype.getProperties = zi.prototype.P, zi.prototype.set = zi.prototype.set, zi.prototype.setProperties = zi.prototype.I, zi.prototype.unset = zi.prototype.S, zi.prototype.changed = zi.prototype.s, zi.prototype.getRevision = zi.prototype.K, zi.prototype.on = zi.prototype.G, zi.prototype.once = zi.prototype.L, zi.prototype.un = zi.prototype.J, zi.prototype.unByKey = zi.prototype.M, sr.prototype.getFirstCoordinate = sr.prototype.Ab, sr.prototype.getLastCoordinate = sr.prototype.Bb, sr.prototype.getLayout = sr.prototype.Cb, sr.prototype.applyTransform = sr.prototype.va, sr.prototype.translate = sr.prototype.Ua, sr.prototype.getClosestPoint = sr.prototype.$a, sr.prototype.getExtent = sr.prototype.R, sr.prototype.transform = sr.prototype.transform, sr.prototype.get = sr.prototype.get, sr.prototype.getKeys = sr.prototype.O, sr.prototype.getProperties = sr.prototype.P, sr.prototype.set = sr.prototype.set, sr.prototype.setProperties = sr.prototype.I, sr.prototype.unset = sr.prototype.S, sr.prototype.changed = sr.prototype.s, sr.prototype.getRevision = sr.prototype.K, sr.prototype.on = sr.prototype.G, sr.prototype.once = sr.prototype.L, sr.prototype.un = sr.prototype.J, sr.prototype.unByKey = sr.prototype.M, Vg.prototype.readFeatures = Vg.prototype.qa, Fg.prototype.readFeatures = Fg.prototype.qa, Fg.prototype.readFeatures = Fg.prototype.qa, Gn.prototype.get = Gn.prototype.get, Gn.prototype.getKeys = Gn.prototype.O, Gn.prototype.getProperties = Gn.prototype.P, Gn.prototype.set = Gn.prototype.set, Gn.prototype.setProperties = Gn.prototype.I, Gn.prototype.unset = Gn.prototype.S, Gn.prototype.changed = Gn.prototype.s, Gn.prototype.getRevision = Gn.prototype.K, Gn.prototype.on = Gn.prototype.G, Gn.prototype.once = Gn.prototype.L, Gn.prototype.un = Gn.prototype.J, Gn.prototype.unByKey = Gn.prototype.M, fs.prototype.getMap = fs.prototype.g, fs.prototype.setMap = fs.prototype.setMap, fs.prototype.setTarget = fs.prototype.c, fs.prototype.get = fs.prototype.get, fs.prototype.getKeys = fs.prototype.O, fs.prototype.getProperties = fs.prototype.P, fs.prototype.set = fs.prototype.set, fs.prototype.setProperties = fs.prototype.I, fs.prototype.unset = fs.prototype.S, fs.prototype.changed = fs.prototype.s, fs.prototype.getRevision = fs.prototype.K, fs.prototype.on = fs.prototype.G, fs.prototype.once = fs.prototype.L, fs.prototype.un = fs.prototype.J, fs.prototype.unByKey = fs.prototype.M, js.prototype.getMap = js.prototype.g, js.prototype.setMap = js.prototype.setMap, js.prototype.setTarget = js.prototype.c, js.prototype.get = js.prototype.get, js.prototype.getKeys = js.prototype.O, js.prototype.getProperties = js.prototype.P, js.prototype.set = js.prototype.set, js.prototype.setProperties = js.prototype.I, js.prototype.unset = js.prototype.S, js.prototype.changed = js.prototype.s, js.prototype.getRevision = js.prototype.K, js.prototype.on = js.prototype.G, js.prototype.once = js.prototype.L, js.prototype.un = js.prototype.J, js.prototype.unByKey = js.prototype.M, As.prototype.getMap = As.prototype.g, As.prototype.setTarget = As.prototype.c, As.prototype.get = As.prototype.get, As.prototype.getKeys = As.prototype.O, As.prototype.getProperties = As.prototype.P, As.prototype.set = As.prototype.set, As.prototype.setProperties = As.prototype.I, As.prototype.unset = As.prototype.S, As.prototype.changed = As.prototype.s, As.prototype.getRevision = As.prototype.K, As.prototype.on = As.prototype.G, As.prototype.once = As.prototype.L, As.prototype.un = As.prototype.J, As.prototype.unByKey = As.prototype.M, Cf.prototype.getMap = Cf.prototype.g, Cf.prototype.setTarget = Cf.prototype.c, Cf.prototype.get = Cf.prototype.get, Cf.prototype.getKeys = Cf.prototype.O, Cf.prototype.getProperties = Cf.prototype.P, Cf.prototype.set = Cf.prototype.set, Cf.prototype.setProperties = Cf.prototype.I, Cf.prototype.unset = Cf.prototype.S, Cf.prototype.changed = Cf.prototype.s, Cf.prototype.getRevision = Cf.prototype.K, Cf.prototype.on = Cf.prototype.G, Cf.prototype.once = Cf.prototype.L, Cf.prototype.un = Cf.prototype.J, Cf.prototype.unByKey = Cf.prototype.M, vs.prototype.getMap = vs.prototype.g, vs.prototype.setMap = vs.prototype.setMap, vs.prototype.setTarget = vs.prototype.c, vs.prototype.get = vs.prototype.get, vs.prototype.getKeys = vs.prototype.O, vs.prototype.getProperties = vs.prototype.P, vs.prototype.set = vs.prototype.set, vs.prototype.setProperties = vs.prototype.I, vs.prototype.unset = vs.prototype.S, vs.prototype.changed = vs.prototype.s, vs.prototype.getRevision = vs.prototype.K, vs.prototype.on = vs.prototype.G, vs.prototype.once = vs.prototype.L, vs.prototype.un = vs.prototype.J, vs.prototype.unByKey = vs.prototype.M, kf.prototype.getMap = kf.prototype.g, kf.prototype.setMap = kf.prototype.setMap, kf.prototype.setTarget = kf.prototype.c, kf.prototype.get = kf.prototype.get, kf.prototype.getKeys = kf.prototype.O, kf.prototype.getProperties = kf.prototype.P, kf.prototype.set = kf.prototype.set, kf.prototype.setProperties = kf.prototype.I, kf.prototype.unset = kf.prototype.S, kf.prototype.changed = kf.prototype.s, kf.prototype.getRevision = kf.prototype.K, kf.prototype.on = kf.prototype.G, kf.prototype.once = kf.prototype.L, kf.prototype.un = kf.prototype.J, kf.prototype.unByKey = kf.prototype.M, ms.prototype.getMap = ms.prototype.g, ms.prototype.setMap = ms.prototype.setMap, ms.prototype.setTarget = ms.prototype.c, ms.prototype.get = ms.prototype.get, ms.prototype.getKeys = ms.prototype.O, ms.prototype.getProperties = ms.prototype.P, ms.prototype.set = ms.prototype.set, ms.prototype.setProperties = ms.prototype.I, ms.prototype.unset = ms.prototype.S, ms.prototype.changed = ms.prototype.s, ms.prototype.getRevision = ms.prototype.K, ms.prototype.on = ms.prototype.G, ms.prototype.once = ms.prototype.L, ms.prototype.un = ms.prototype.J, ms.prototype.unByKey = ms.prototype.M, Zf.prototype.getMap = Zf.prototype.g, Zf.prototype.setTarget = Zf.prototype.c, Zf.prototype.get = Zf.prototype.get, Zf.prototype.getKeys = Zf.prototype.O, Zf.prototype.getProperties = Zf.prototype.P, Zf.prototype.set = Zf.prototype.set, Zf.prototype.setProperties = Zf.prototype.I, Zf.prototype.unset = Zf.prototype.S, Zf.prototype.changed = Zf.prototype.s, Zf.prototype.getRevision = Zf.prototype.K, Zf.prototype.on = Zf.prototype.G, Zf.prototype.once = Zf.prototype.L, Zf.prototype.un = Zf.prototype.J, Zf.prototype.unByKey = Zf.prototype.M, Qf.prototype.getMap = Qf.prototype.g, Qf.prototype.setMap = Qf.prototype.setMap, Qf.prototype.setTarget = Qf.prototype.c, Qf.prototype.get = Qf.prototype.get, Qf.prototype.getKeys = Qf.prototype.O, Qf.prototype.getProperties = Qf.prototype.P, Qf.prototype.set = Qf.prototype.set, Qf.prototype.setProperties = Qf.prototype.I, Qf.prototype.unset = Qf.prototype.S, Qf.prototype.changed = Qf.prototype.s, Qf.prototype.getRevision = Qf.prototype.K, Qf.prototype.on = Qf.prototype.G, Qf.prototype.once = Qf.prototype.L, Qf.prototype.un = Qf.prototype.J, Qf.prototype.unByKey = Qf.prototype.M, e.ol
}));