!function(n) {
    window.fp_parallaxExtension = function() {
        var e, t, o, i, a, l, r, s, f, c, d = this,
            p = n.fn.fullpage.getFullpageData(),
            u = p.options,
            v = p.internals,
            g = ".fullpage-wrapper",
            m = "active",
            x = "." + m,
            h = ".fp-section",
            S = h + x,
            y = "fp-slide",
            A = "." + y,
            b = A + x,
            w = "fp-notransition",
            M = ".fp-bg",
            R = "reveal",
            C = "cover",
            q = "fp-parallax-stylesheet",
            I = "fp-parallax-transitions",
            N = "#" + I,
            T = "fp-parallax-transition-class",
            z = "#" + T,
            O = !1,
            F = 0,
            B = !1,
            E = !1,
            k = !0,
            H = !0,
            L = !1,
            V = !1,
            G = !1,
            X = !1,
            Y = !1,
            j = !0 === u.parallax || "slides" === u.parallax,
            D = n(window);

        function P(n) {
            return {
                cover: {
                    offsetNormal: n ? 0 : t
                },
                reveal: {
                    offsetNormal: n ? -t : 0
                }
            }
        }

        function Q(n) {
            return {
                cover: {
                    offsetNormal: n ? 0 : o
                },
                reveal: {
                    offsetNormal: n ? -o : 0
                }
            }
        }

        function U(n) {
            return n * i / 100
        }

        function _(n) {
            return n * a / 100
        }

        function J() {
            r && xn(n(S).length ? n(S) : n(h).first(), 0)
        }

        function K() {
            var t = n(S).length ? n(S) : n(h).first(),
                o = e === R,
                i = o ? t.nextAll() : t.prevAll(),
                a = o ? t.prevAll() : t.nextAll();

            i.each(function() {
                xn(n(this), P(o)[e].offsetNormal, "silent")
            }),

            a.each(function() {
                xn(n(this), 0, "silent")
            }),

            j && n(h).each(function() {
                n(this).find(A).length && W(n(this).find(b).length ? n(this).find(b) : n(this).find(A).first())
            })
        }

        function W(t) {
            var o = e === R,
                i = o ? t.nextAll() : t.prevAll(),
                a = o ? t.prevAll() : t.nextAll();

            i.each(function() {
                hn(n(this), Q(o)[e].offsetNormal, "silent")
            }),

            a.each(function() {
                hn(n(this), 0, "silent")
            })
        }

        function Z(n, e) {
            a = D.width(), e && !u.scrollBar ? (fn(), cn()) : dn()
        }

        function $(n) {
            d.destroy(), L = !1
        }

        function nn() {
            var e = u.verticallyCentered ? ".fp-tableCell" : ".fp-scrollable";
            n(e).each(function() {
                n(this).find(M).prependTo(n(this).parent())
            })
        }

        function en(n, e) {
            e ? dn() : X = !0
        }

        function tn(e, t) {
            n(M).data("final-x", 0), n(M).data("final-y", 0), l = document.querySelectorAll(h), K()
        }

        function on(n, e) {
            Y = !0, xn(e, 0, "silent"), E = !0
        }

        function an(n, e) {
            d.afterSlideLoads(e.find(A).first()), Y = !1
        }

        function ln(e, t) {
            V = !0, W("left" === t.xMovement ? n(S).find(A).first() : n(S).find(A).last()), setTimeout(function() {
                d.applyHorizontal(t)
            })
        }

        function rn(n, e) {
            G = !0, K(), setTimeout(function() {
                d.apply(e)
            })
        }

        function sn() {
            !O && L && (u.scrollBar || !u.autoScrolling || v.usingExtension("dragAndMove")) && (requestAnimationFrame(gn), O = !0)
        }

        function fn() {
            var n = ".fp-bg{transition: transform " + u.scrollingSpeed + "ms " + u.easingcss3 + "}.fp-slide, .fp-section{transition: background-position " + u.scrollingSpeed + "ms " + u.easingcss3 + ";}";
            u.autoScrolling && !u.scrollBar && Sn(I, n)
        }

        function cn() {
            var n = ".fp-bg-animate{ transition: all " + u.scrollingSpeed + "ms " + u.easingcss3 + "}";
            Sn(T, n)
        }

        function dn() {
            n(N).remove()
        }

        function pn() {
            clearTimeout(c), c = setTimeout(un, 350)
        }

        function un() {
            i = D.height(), a = D.width(), t = U(u.parallaxOptions.percentage), o = _(u.parallaxOptions.percentage), J(), K(), vn()
        }

        function vn() {
            n(M).height(i)
        }

        function gn() {
            var o = v.usingExtension("dragAndMove") ? Math.abs(n.fn.fullpage.dragAndMove.getCurrentScroll()) : n(window).scrollTop(),
                a = F > o,
                r = n(S).index(h),
                s = i + o;
            F = o;
            for (var f = 0; f < l.length; ++f) {
                var c = l[f],
                    d = i + c.offsetTop;
                !a && c.offsetTop <= s ? r = f : a && d >= o && c.offsetTop < o && l.length > f + 1 && (r = f + 1)
            }
            var p = (i - (l[r].offsetTop - o)) * t / i;
            e !== R && (r -= 1);
            var u = e !== R ? p : -t + p;
            xn(n(h).eq(r), u), r - 1 >= 0 && xn(n(l[r - 1]), P(!1)[e].offsetNormal), void 0 !== l[r + 1] && xn(n(l[r + 1]), P(!0)[e].offsetNormal), O = !1
        }

        function mn(n) {
            return Math.round(2 * n) / 2
        }

        function xn(n, e, t) {
            var o = mn(e),
                i = n.find(A);
            if (i.length) {
                var a = i.filter(x);
                n = a.length ? a : i.first()
            }
            if (r) n.css({
                "background-position-y": o + "px"
            });
            else if (!n.hasClass(y) || n.hasClass(m) || void 0 !== t) {
                var l = n.find(M),
                    s = void 0 !== l.data("final-x") ? l.data("final-x") : 0;
                l.toggleClass(w, void 0 !== t).css({
                    transform: "translateX(" + s + "px) translateY(" + o + "px)"
                }).data("final-x", s).data("final-y", o)
            }
        }

        function hn(n, e, t) {
            var o = mn(e),
                i = r ? n : n.find(M);
            if (!u.scrollBar && u.autoScrolling || i.addClass("fp-bg-animate"), r) i.toggleClass(w, void 0 !== t).css("background-position-x", o + "px");
            else {
                var a = 0,
                    l = i.data("final-y");
                "none" !== l && void 0 !== l && (a = l), i.toggleClass(w, void 0 !== t || Y).css({
                    transform: "translateX(" + o + "px) translateY(" + a + "px)"
                }).data("final-x", o).data("final-y", a)
            }
        }

        function Sn(e, t) {
            n("#" + e).length || n('<style id="' + e + '">' + t + "</style>").appendTo("head")
        }

        f = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame,

        window.requestAnimationFrame = f,

        d.apply = function(t) {
            if (X && fn(), !t.localIsResizing && !u.scrollBar && u.autoScrolling)
                if (("up" !== t.yMovement && !t.sectionIndex || t.isMovementUp && !(t.leavingSection - 1)) && u.continuousVertical && !G) !1;
                else {
                    var o = P(B = "up" === t.yMovement)[e].offsetNormal;
                    xn(n(h).eq(t.sectionIndex), 0), xn(n(h).eq(t.leavingSection - 1), o), k = 1 === Math.abs(t.leavingSection - 1 - t.sectionIndex);
                    for (var i = Math.min(t.leavingSection - 1, t.sectionIndex) + 1; i < Math.max(t.leavingSection - 1, t.sectionIndex); i++) xn(n(h).eq(i), 0, "silent")
                }
        },

        d.applyHorizontal = function(n) {
            if (j && (!n.localIsResizing || Y) && "none" != n.xMovement)
                if ((s = void 0 !== n.direction && n.direction !== n.xMovement) && u.continuousHorizontal && !V) s = !1;
                else {
                    var t = Q(E = s ? "left" === n.direction : "left" === n.xMovement)[e].offsetNormal;
                    if (hn(n.section.find(A).eq(n.slideIndex), 0), hn(n.section.find(A).eq(n.prevSlideIndex), t), !(H = 1 === Math.abs(n.slideIndex - n.prevSlideIndex)) && !Y)
                        for (var o = Math.min(n.slideIndex, n.prevSlideIndex) + 1; o < Math.max(n.slideIndex, n.prevSlideIndex); o++) hn(n.section.find(A).eq(o), 0, "silent")
                }
        },

        d.init = function() {
            if (i = D.height(), a = D.width(), e = u.parallaxOptions.type, t = U(u.parallaxOptions.percentage), o = _(u.parallaxOptions.percentage), l = document.querySelectorAll(u.sectionSelector), r = "background" === u.parallaxOptions.property, vn(), n(g).on("setAutoScrolling", Z).on("destroy", $).on("onScroll", sn).on("afterResponsive", tn).on("onGrab", en).on("onContinuousVertical", rn).on("onResize", pn).on("afterRender", nn).on("afterRebuild", nn), j && n(g).on("onContinuosHorizontal", ln).on("onResetSliders", on).on("onEndResetSliders", an), !r) {
                Sn(q, ".fp-bg{left:0;top:0;bottom:0;width: 100%;position:absolute;z-index: -1;}.fp-section, .fp-slide, .fp-section.fp-table, .fp-slide.fp-table, .fp-section .fp-tableCell, .fp-slide .fp-tableCell {position:relative;overflow: hidden;}"), fn()
            }
            cn(), J(), K(), L = !0
        },

        d.destroy = function() {
            dn(), n(z).remove(), t = U(0), o = _(0), K(), n(M).height(""), clearTimeout(c), n(g).off("setAutoScrolling").off("destroy").off("onScroll").off("afterResponsive").off("onGrab").off("onContinuousVertical").off("onResize").off("afterRender").off("afterRebuild"), j && n(g).off("onContinuosHorizontal").off("onResetSliders").off("onEndResetSliders")
        },

        d.setOption = function(n, i) {
            "offset" === n ? (u.parallaxOptions.percentage = i, t = U(i), o = _(i)) : "type" === n && (u.parallaxOptions.type = i, e = i), K()
        },

        d.applyProperties = xn,

        d.afterSlideLoads = function(t) {
            var o = void 0 !== t ? t : n(S).find(b),
                i = o.closest(h);
            if ((r ? function(n) {
                    if (n.find(A).length) return n.find(A).length > 1 ? n.find(A) : [n.find(A)];
                    return [n]
                }(i) : i.find(M)).removeClass("fp-bg-animate"), (V || s) && (W(o), V = !1), !H) {
                var a = Q(E)[e].offsetNormal,
                    l = o,
                    f = E ? l.nextAll() : l.prevAll();
                (e === R && E || e === C && !E || Y) && f.each(function() {
                    hn(n(this), a, "silent")
                })
            }
        },

        d.afterLoad = function() {
            if ((!u.scrollBar || !u.autoScrolling || v.usingExtension("dragAndMove")) && ((G || s) && (K(), G = !1), !k)) {
                var t = P(B)[e].offsetNormal,
                    o = B ? n(S).nextAll() : n(S).prevAll();
                (e === R && B || e === C && !B) && o.each(function() {
                    xn(n(this), t, "silent")
                })
            }
        },

        d.c = v.c;

        var yn = d["common".charAt(0)];

        return "complete" === document.readyState && yn("parallax"),
            n(window).on("load", function() {
                yn("parallax")
            }),
            d
    }
}(jQuery);