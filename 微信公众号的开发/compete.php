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
    <link rel="stylesheet" href="//at.alicdn.com/t/font_8xnfn4p0o9c9dx6r.css">
    <!--百度统计-->
<!--    <script src="static/js/baidu.js"></script>-->
    <!--客户端检测函数，url重定向-->
    <script>
        if(navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)){}else{
            window.location.href="../pc/index.php";
        }
    </script>

    <title>魅力中国城 - 网络投票实时分析系统</title>

</head>
<body>
<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
//访问频率限制
session_start();
if(isset($_SESSION['web2viewtime']) && isset($_SESSION['web2viewcount'])){
    $times = $_SESSION['web2viewtime'];
    $count = $_SESSION['web2viewcount'];
    //刷新超过三次
    if($count > 10){
$time = time() - $times;
//5s内只能访问一次
if($time<3){
    exit("<body style='background:#ffffff;;'><div class=\"copyright\" style=\"margin: 0 auto;margin-top: 60px;text-align: center;\">
        <p style=\"margin-top:60px;font-size: 20px;font-weight: bold;\">抱歉,刷新太频繁！</p>
        <p style=\"margin-top:10px;font-size: 20px;font-weight: bold;\">请您稍后再试</p>
        <img style=\"margin-top:60px;width: 30%\" src=\"http://mmcity.cn/static/img/weixin.6276b26.png\" alt=\"茂名城\">
        <p style=\"margin-top:10px;font-size: 16px;\">欢迎关注茂名城公众号</p>
        <p style=\"margin-top: 60px;font-size: 16px\">Copyright ©2017 城市动力</p></div></body>");
}else{
$_SESSION['web2viewtime']= time();
}
}
$_SESSION['web2viewcount'] = $count+1;
}else{
$_SESSION['web2viewtime']= time();
$_SESSION['web2viewcount']= 1;
}

?>
<div class="share" style="display: none;">
    <img src="http://m.mmcity.cn/web/shareImg1.png" alt="分享图片">
</div>

<!--首页头部-->
<header class="weui-flex" style="padding: 0;position: relative;">
    <!--<img src="design/logo4.jpg" alt="" style="width: 100%;">-->
    <div class="swiper-container" style="width: 100%;background: #072446;height: 78%">
        <div class="swiper-wrapper" style="width: 100%">
            <div class="swiper-slide"><a style="display: inline-block;width: 100%;height: 100%" href="https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzIyOTU4NDc4OQ==&scene=124#wechat_redirect"><img src="design/logo4.jpg" alt="" style="width: 100%"></a></div>
            <div class="swiper-slide"><a style="display: inline-block;width: 100%;height: 100%" href="http://mp.weixin.qq.com/s/VcH_npsfK85vEpmb7ajnOA"><img src="design/haibao4.jpg" alt="" style="width: 100%"></a></div>
            <div class="swiper-slide"><a style="display: inline-block;width: 100%;height: 100%" href="http://mp.weixin.qq.com/s/VcH_npsfK85vEpmb7ajnOA"><img src="design/haibao3.jpg" alt="" style="width: 100%"></a></div>
        </div>
        <div class="swiper-pagination" style="width: 100%;position: absolute;bottom: 0;left: 2px"></div>
    </div>
</header>
<section class="ad weui-flex">
    <div style="width: 100%;position: relative;">
        <p style="width: 50%;height:23px;line-height: 22px;text-align: left;padding-left: 10px"><a style="color: orange;display: inline-block;line-height: 24px" href="http://mp.weixin.qq.com/s/VcH_npsfK85vEpmb7ajnOA">领取专属助力海报</a></p>
        <p style="width: 50%;height:23px;line-height: 25px;text-align: right;position: absolute;right: 10px;bottom: 0"><span id="countdown" style="font-size: 12px;font-family: Calibri">loading</span></p>
    </div>
</section>
<!--首页数据列表-->
<section class="sectionData">
    <div class="weui-grids">
        <div class="weui-grid">
            <p style="line-height: 140%;color: gray;">茂名 - 基础票数</p>
            <p id="mmticket" style="font-size: 28px;color: #cccccc;font-weight: normal">19324109</p>
        </div>
        <div class="weui-grid">
            <p style="line-height: 140%;color: gray">十堰 - 基础票数</p>
            <p style="font-size: 28px;color: #cccccc;font-weight: normal" id="syticket">18732056</p>
        </div>
        <div class="weui-grid">
            <p style="line-height: 140%">茂名 - 关键票数</p>
            <p id="mmClear" style="font-size: 28px;color: #cccccc;">...</p>
        </div>
        <div class="weui-grid">
            <p style="line-height: 140%">十堰 - 关键票数</p>
            <p id="syClear" style="font-size: 28px;color: #cccccc;">...</p>
        </div>
        <div class="weui-grid">
            <p style="line-height: 140%" id="lead">茂名 - 领先票数</p>
            <p style="font-size: 28px;color: #cccccc;" id="gap">...</p>
        </div>
        <div class="weui-grid">
            <p style="line-height: 140%" id="lead1">茂名 - 领先百分比</p>
            <p style="font-size: 28px;color: #cccccc;" id="gap_percent">...</p>
            <!--<p style="line-height: 140%" id="lead1">首播时间</p>-->
            <!--<p style="font-size: 14px;line-height: 140%" id="gap_percent" >CCTV-2<br />今晚 <span style="font-size: 16px">19:00</span></p>-->
        </div>

        <div class="weui-grid" style="background-color: #e0ebf2;padding:0.7em 0.5em;">
            <p style="font-weight: bold;font-size: 14px;color: #000000;"><a href="us.php">茂名实时动态</a></p>
        </div>
        <div class="weui-grid" style="background-color: #ffffff;padding:0.7em 0.5em;">
            <p style="font-weight: bold;font-size: 14px;color: #000000"><a href="compete.php">十堰实时动态</a></p>
        </div>
    </div>
</section>


<!--十堰拉票动态数据-->
<section class="weui-flex dynamic" style="flex-direction: column;position: relative;">
    <h3 class="weui-flex__item dynamic_title" style="text-align: right;color: #000000;">十堰拉票动态</h3>
    <ul class="weui-flex__item dynamic_contents" style="font-size: 14px;"></ul>
    <a href="index.html" class="weui-btn weui-btn_mini weui-btn_default" style="position: absolute;top: 15px;left: 15px;"><<&nbsp;实时分析</a>
    <img src="../web/design/loading.gif" alt="" style="position: absolute;bottom: 40%;left: 45%;width: 10%">
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
    <p style="font-size: 12px;text-align: center">本平台数据仅供参考，详细以官方为准</p>
    <br>
</footer>

<!-- body 最后 -->
<script src="static/js/jquery-3.2.0.min.js"></script>
<script src="static/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="static/js/echarts.min.js"></script>
<script src="static/js/swiper.min.js"></script>

<!--jquery特效-->
<script>
    //    倒计时
    function CountDown() {
        function checkTime(i)
        {
            if(i<10)
            {
                i="0"+i;
            }
            return i;
        }
        var time = setInterval(function () {
            showTime()
        },1000);
        function showTime()
        {
            var timedate= new Date("2017/8/16,19:00:00");                //自定义结束时间
            var now = new Date();                                         //获取当前时间
            var date = parseInt(timedate.getTime() - now.getTime())/1000; //得出的为秒数；
            if(date <= 0)
            {
                $("#countdown").html("0天0时0分0秒");
                clearInterval(time);
            }
            var day = parseInt(date/60/60/24);
            var hour = parseInt(date/60/60%24);
            var minute = parseInt(date/60%60);
            var second = parseInt(date%60);
            hour = checkTime(hour);
            minute = checkTime(minute);
            second = checkTime(second);
            var leftTime = "<strong style='font-size: 14px;color: #dddddd'>"+day+"</strong>"+"天"+"<strong style='font-size: 14px;color: #dddddd'>"+hour+"</strong>"+"时"+"<strong style='font-size: 14px;color: #dddddd'>"+minute+"</strong>"+"分"+"<strong style='font-size: 14px;color: #dddddd'>"+second+"</strong>"+"秒";
            $('#countdown').html(leftTime)
            time;
        }
    }
    CountDown();
</script>

<!--图表&实时数据&动态信息-->
<script>
    function roundChart() {
        $.ajax({
                type: 'get',
                url: 'http://data.mmcity.cn:5555/getdata?ran=' + Math.random(),
                data:{AccessKey:'cpuohkzb3ytrc5jsce4ei1ff2cgp34555'},
                jsonp: "jsoncallback",
                success: function (res) {
                    var round = JSON.parse(res);

                    var mmNum = parseInt($('#mmticket').html());
                    var syNum = parseInt($('#syticket').html());
                    var allNum = 0;
                    var otherNum = 0;
                    var qdnNum = 0;
                    // 数据列表茂名、十堰以及其他城市的总票数获取
                    for (var i = 0; i < round.data.length; i++) {
                        if (round.data[i].cityId == 17) {
                            $('#mmClear').html(round.data[i].voteCount - mmNum)
                        }
                        if (round.data[i].cityId == 23) {
                            $('#syClear').html(round.data[i].voteCount - syNum)
                        }
                        if (round.data[i].cityId == 19){
                            qdnNum = round.data[i].voteCount;
                        }
                        allNum = allNum + parseInt(round.data[i].voteCount)
                    }

                    otherNum = allNum - mmNum - syNum - qdnNum;

                    // 领先百分比
                    var mmClear = parseInt($('#mmClear').html());
                    var syClear = parseInt($('#syClear').html());
                    var minusPercent;

//                     $('#gap_percent').html(minusPercent.toFixed(2) + '%');

                    // 茂名票数领先或落后时候的样式设置
                    if (mmClear > syClear) {
                        minusPercent = (mmClear - syClear) / syClear * 100;
                        $('#gap').html(mmClear - syClear);
                        $('#mmClear').css({color: 'red'});
                        $('#syClear').css({color: 'red'});
                        $('#gap').css({color: 'red'});
                        $('#gap_percent').css({color: 'red'});
                        $('#gap_percent').css({color: 'red'});
                        $('#mmScore').css({color: '#072446'});
                        $('#syScore').css({color: '#072446'});
                    } else if (mmClear <= syClear) {
                        $('#lead').html("茂名 - 落后票数");
                        $('#lead1').html("茂名 - 落后百分比");
                        $('#mmClear').css({color: '#239e44'});
                        $('#syClear').css({color: '#239e44'});
                        $('#gap').css({color: '#239e44'});
                        $('#gap_percent').css({color: '#239e44'});
//                        $('#mmScore').css({color: '#085282'});
//                        $('#syScore').css({color: '#085282'});
                        $('#gap').html(syClear - mmClear)
                        minusPercent = (-(mmClear - syClear)) / syClear * 100;
                    }
                    $('#gap_percent').html(minusPercent.toFixed(2)+'%');

                    //茂名与十堰分数
                    var mScore = parseInt($('#mmClear').html());
                    var sScore = parseInt($('#syClear').html());

                    var mCompete = mScore / (mScore+sScore) * 500;
                    var sCompete = sScore / (mScore+sScore) * 500;
                    $('#mmScore').html(mCompete.toFixed(0));
                    $('#syScore').html(sCompete.toFixed(0));
                }
            }
        );
    }
</script>
<script src="assets/getMsg.js"></script>
<script type="text/javascript">
    window.onload = function () {
        // onload的时候运行一次
        roundChart();
        getMsg();
        // 3秒获取一次数据列表
        setInterval(function () {
            roundChart();
        }, 3000);
        setInterval(function () {
            getMsg();
        },600000)

    };
</script>

<!--微信分享-->
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
        wx.onMenuShareTimeline({title: '魅力中国城 - 网络投票实时分析',link: 'http://m.mmcity.cn/web/index.php',imgUrl: 'http://m.mmcity.cn/web/shareImg1.png'});
        wx.onMenuShareAppMessage({title: '魅力中国城 - 网络投票实时分析',desc: '进入系统实时查看票数',link: 'http://m.mmcity.cn/web/index.php',imgUrl: 'http://m.mmcity.cn/web/shareImg1.png'})
    })
</script>

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
