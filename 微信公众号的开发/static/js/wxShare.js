/**
 * Created by CPS on 2017/8/10.
 */
var url =  window.location.href;
$.ajax({
    type: 'get',
    url: "http://test.cypow.com/c/index.html/wechat/index/getAccess.html",
    jsonp: "jsoncallback",
    data:{url:url},
    success: function (res) {
        var ret5 = JSON.parse(res);
        wx.config({debug: false, appId: ret5.appId,timestamp: ret5.timestamp, nonceStr: ret5.nonceStr, signature: ret5.signature,jsApiList: ret5.jsApiList});
    }
});
wx.ready(function () {
    wx.checkJsApi({jsApiList: ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage'] });
    wx.onMenuShareTimeline({title: '魅力中国城 - 网络投票实时分析系统',link: 'http://m.mmcity.cn/web/index.html',imgUrl: 'http://m.mmcity.cn/web/shareImg1.png'});
    wx.onMenuShareAppMessage({title: '魅力中国城 - 网络投票实时分析系统',desc: '魅力中国城-最爱我茂名',link: 'http://m.mmcity.cn/web/index.html',imgUrl: 'http://m.mmcity.cn/web/shareImg1.png'})
});