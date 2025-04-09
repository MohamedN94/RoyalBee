!function (w, d, t) {
    w.TiktokAnalyticsObject = t; var ttq = w[t] = w[t] || []; ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias", "group", "enableCookie", "disableCookie"], ttq.setAndDefer = function (t, e) { t[e] = function () { t.push([e].concat(Array.prototype.slice.call(arguments, 0))) } }; for (var i = 0; i < ttq.methods.length; i++)ttq.setAndDefer(ttq, ttq.methods[i]); ttq.instance = function (t) { for (var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++)ttq.setAndDefer(e, ttq.methods[n]); return e }, ttq.load = function (e, n) { var i = "../analytics.tiktok.com/i18n/pixel/events.js"; ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = i, ttq._t = ttq._t || {}, ttq._t[e] = +new Date, ttq._o = ttq._o || {}, ttq._o[e] = n || {}; var o = document.createElement("script"); o.type = "text/javascript", o.async = !0, o.src = i + "?sdkid=" + e + "&lib=" + t; var a = document.getElementsByTagName("script")[0]; a.parentNode.insertBefore(o, a) };

    ttq.load('CFK52M3C77U110MKH84G');
    ttq.page();
}(window, document, 'ttq');


window.dataLayer = window.dataLayer || [];
function gtag() { dataLayer.push(arguments); }
gtag('js', new Date());

gtag('config', 'G-LZG3PM42FH');

(function (e, t, n) {
    if (e.snaptr) return; var a = e.snaptr = function () { a.handleRequest ? a.handleRequest.apply(a, arguments) : a.queue.push(arguments) };
    a.queue = []; var s = 'script'; r = t.createElement(s); r.async = !0;
    r.src = n; var u = t.getElementsByTagName(s)[0];
    u.parentNode.insertBefore(r, u);
})(window, document,
    '/front/asset/js/scevent.min.js');

snaptr('init', '7f04d8fe-af14-4254-bcb5-c91a0759a9a6');
snaptr('track', 'PAGE_VIEW');


window.dataLayer = window.dataLayer || [];
function gtag() { dataLayer.push(arguments); }
gtag('js', new Date());
let trackingIds = ["659-373-5584"];
trackingIds.forEach(id => {
    gtag('config', id);
});
window.gtag = gtag;


let sliderId = "section-NUNU6wbiCopEnkVG",
direction = "vertical",
frequency = "10",
customHeight = null,
slideImages = document.querySelectorAll(isMobileView() ? '.desktop-image' : '.mobile-image');

window.addEventListener('resize', () => {
Array.from(slideImages).forEach(image => {
    if (isMobileView()) {
        image.classList.remove('desktop-image');
        image.classList.add('mobile-image');
    } else {
        image.classList.remove('mobile-image');
        image.classList.add('desktop-image');
    }
});
});

Array.from(slideImages).forEach(image => {
if (isMobileView()) {
    image.classList.add('hidden-desktop');
} else {
    image.classList.add('hidden-mobile');
}
});

if (!isMobileView() && customHeight !== null) {
document.getElementById(`${sliderId}`).style.height = `${customHeight}px`;
}

if (isMobileView()) {
Array.from(document.getElementsByClassName('null-img')).forEach(image => {
    image.remove();
});
}


// Document Ready
if (document.readyState !== 'loading') {
$(`#${sliderId}`).removeClass('show-first-image');
} else {
document.addEventListener("DOMContentLoaded", () => {
    $(`#${sliderId}`).removeClass('show-first-image');
});
}
