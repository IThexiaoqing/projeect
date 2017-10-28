<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <link rel="stylesheet" href="static/css/weui.min.css">
    <!--weiUI微信开发CSS库-->
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <link rel="stylesheet" href="./index.css">

    <style>
        .weui-grid:before {
            border-right: 1px solid #ffffff;
        }
    </style>

    <title>魅力中国城 - 祝贺茂名成功晋级</title>


</head>

<body>
<?php
//error_reporting(E_ALL^E_NOTICE^E_WARNING);
////访问频率限制
//session_start();
//if(isset($_SESSION['webviewtime']) && isset($_SESSION['webviewcount'])){
//    $times = $_SESSION['webviewtime'];
//    $count = $_SESSION['webviewcount'];
//    //刷新超过三次
//    if($count > 3){
//$time = time() - $times;
////5s内只能访问一次
//if($time<5){
//    exit("<body style='background:#ffffff;;'><div class=\"copyright\" style=\"margin: 0 auto;margin-top: 60px;text-align: center;\">
//        <p style=\"margin-top:60px;font-size: 20px;font-weight: bold;\">抱歉,刷新太频繁！</p>
//        <p style=\"margin-top:10px;font-size: 20px;font-weight: bold;\">请您稍后再试</p>
//        <img style=\"margin-top:60px;width: 30%\" src=\"http://mmcity.cn/static/img/weixin.6276b26.png\" alt=\"茂名城\">
//        <p style=\"margin-top:10px;font-size: 16px;\">欢迎关注茂名城公众号</p>
//        <p style=\"margin-top: 60px;font-size: 16px\">Copyright ©2017 城市动力</p></div></body>");
//}else{
//$_SESSION['webviewtime']= time();
//}
//}
//$_SESSION['webviewcount'] = $count+1;
//}else{
//$_SESSION['webviewtime']= time();
//$_SESSION['webviewcount']= 1;
//}
//
//?>

<!--微信分享LOGO-->
<div class="share" style="display: none;">
    <img src="http://m.mmcity.cn/web/shareImg1.png" alt="分享图片">
</div>

<!--首页头部-->
<header class="weui-flex" style="padding: 0;position: relative;">
    <!--<img src="design/logo4.jpg" alt="" style="width: 100%;">-->
    <div class="swiper-container" style="width: 100%;background: #072446;height: 78%">
        <div class="swiper-wrapper" style="width: 100%">
            <div class="swiper-slide"><a style="display: inline-block;width: 100%;height: 100%" href="http://m.mmcity.cn/poster"><img src="design/haibao7.jpg " alt="" style="width: 100%"></a></div>
            <div class="swiper-slide"><a style="display: inline-block;width: 100%;height: 100%" href="http://m.mmcity.cn/poster"><img src="design/haibao8.jpg " alt="" style="width: 100%"></a></div>
            <div class="swiper-slide"><a style="display: inline-block;width: 100%;height: 100%" href="http://m.mmcity.cn/poster"><img src="design/haibao6.jpg" alt="" style="width: 100%"></a></div>
        </div>
        <div class="swiper-pagination" style="width: 100%;position: absolute;bottom: 0;left: 2px"></div>
    </div>
</header>

<section class="ad weui-flex">
    <div style="width: 100%;position: relative;">
        <p style="width: 100%;height:23px;line-height: 22px;text-align: center;"><a style="color: orange;display: inline-block;line-height: 24px;text-align: center" href="http://m.mmcity.cn/poster">强大的对手才能成就强大的你，恭喜茂名</a></p>
<!--        <p style="width: 50%;height:23px;line-height: 25px;text-align: right;position: absolute;right: 10px;bottom: 0"><span id="countdown" style="font-size: 12px;font-family: Calibri">loading</span></p>-->
    </div>
</section>
<section>
    <div class="weui-grids" style="background: #E0EBF2;">
        <div class="weui-grid" style="width: 100%;text-align: center;padding: 0"><a href="index.html" style="display: inline-block;width:100%;padding: 0.3em 0;color: #532467;">返回首页</a></div>
        <!--        <div class="weui-grid" style="width: 50%;text-align: center;padding: 0"><a href="" style="display: inline-block;width:100%;padding: 0.3em 0;color: #532467;">更多资讯</a></div>-->
    </div>
</section>
<section>
    <p style="font-weight:bold;font-size: 20px;color: #ff5419;text-align: center;line-height: 130%;margin-top: 0.3em;margin-bottom: 0.3em">感谢有您</p>
    <p style="font-weight:bold;font-size: 20px;color: #ff5419;text-align: center;line-height: 130%;margin-top: 0.3em;margin-bottom: 0.3em">为茂名城喝彩</p>

    <div style="text-align: center">
        <img src="design/xuanchuan1.jpg" alt="" style="width: 50%;margin-bottom: 0.2em">
        <img src="design/xuanchuan2.jpg" alt="" style="width: 50%">
    </div>
</section>


<!--页脚-->
<footer class="weui-footer">
    <a class="weui-footer__text"
       href="https://h5.dingtalk.com/home/index.html?_dt_no_comment=1&token=cb5fe8bcab0becec5550999058303bb9&corpId=dingd9d2e1d26cc65ae035c2f4657eb6378f&from=singlemessage&isappinstalled=1#/home">Copyright
        © 2017 茂名市城市动力科技有限公司</a>
    <p class="weui-footer__links">
        <!--<a style="font-size: 12px" href="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIyOTU4NDc4OQ==&scene=123#wechat_redirect" class="weui-footer__link">微信公众号：茂名城 &nbsp;&nbsp;&nbsp;总访问量：<span id="pv">330000</span></a>-->
        <a style="font-size: 12px" href="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIyOTU4NDc4OQ==&scene=123#wechat_redirect" class="weui-footer__link">微信公众号：茂名城 &nbsp;&nbsp;&nbsp;联系QQ：839151</a>
    </p>
    <p style="font-size: 12px;text-align: center">本平台基于大数据超大规模计算开发</p>
    <br>
</footer>

<!-- body 最后 -->
<script src="static/js/jquery-3.2.0.min.js"></script>
<script src="static/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="static/js/echarts.min.js"></script>
<script src="static/js/swiper.min.js"></script>



<!--图表和数据处理-->
<script>

</script>
<script type="text/javascript">
//    window.onload = function () {
//        roundChart();
//        lineChart();
////         3秒获取一次数据列表和饼状图
//        setInterval(function () {
//            roundChart();
//        }, 3000);
//        // 60秒获取一次折线图和柱状图
//        setInterval(function () {
//            lineChart()
//        },600000);
//    };

</script>

<!--微信分享插件-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script>
    var url =  window.location.href;
    $.ajax({
        type: 'get',
        url: "http://wxapi.mmcity.cn/public/index.php/index/index/getAccess.html",
        jsonp: "jsoncallback",
        data:{url:url},
        success: function (res) {
            var ret5 = JSON.parse(res);
            wx.config({debug: false, appId: ret5.appId,timestamp: ret5.timestamp, nonceStr: ret5.nonceStr, signature: ret5.signature,jsApiList: ret5.jsApiList});
        }
    })
    wx.ready(function () {
        wx.checkJsApi({jsApiList: ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage'] });
        wx.onMenuShareTimeline({title: '魅力中国城 - 祝贺茂名成功晋级',link: 'http://m.mmcity.cn/web/index.php',imgUrl: 'http://m.mmcity.cn/web/shareImg1.png'});
        wx.onMenuShareAppMessage({title: '魅力中国城 - 祝贺茂名成功晋级',desc: '领取专属喝彩海报',link: 'http://m.mmcity.cn/web/index.php',imgUrl: 'http://m.mmcity.cn/web/shareImg1.png'})
    })
</script>
<!--cnzz统计-->
<div style="display: none;">
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1263285454'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1263285454%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</div>

<!--幻灯片JS-->
<script>
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        speed: 700,
        autoplay: 5000,
        pagination: '.swiper-pagination'
    });
    var swiperHeight = $('.swiper-container img');
    $('.swiper-container').css({height: swiperHeight[0].clientHeight+'px'});

    $(window).resize(function () {
        var swiperHeight = $('.swiper-container img');
        $('.swiper-container').css({height: swiperHeight[0].clientHeight - 5+'px'});
    })
</script>
</body>
</html>
