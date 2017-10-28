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
    <!--百度统计-->
    <script src="static/js/baidu.js"></script>
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
if(isset($_SESSION['webviewtime']) && isset($_SESSION['webviewcount'])){
    $times = $_SESSION['webviewtime'];
    $count = $_SESSION['webviewcount'];
    //刷新超过三次
    if($count > 3){
$time = time() - $times;
//5s内只能访问一次
if($time<5){
exit("<body style='background:#ffffff;;'><div class=\"copyright\" style=\"margin: 0 auto;margin-top: 60px;text-align: center;\">
<img src=\"http://mmcity.cn/static/img/mmcity1.870d795.png\" alt=\"茂名城\" style='width: 80%'>
<p style=\"margin-top:60px;font-size: 30px;font-weight: bold;\">502:Sorry,刷新太频繁了</p>
<p style=\"margin-top:10px;font-size: 30px;font-weight: bold;\">请5S后再尝试刷新</p>
<p style=\"margin-top: 15px;font-size: 20px\">Copyright ©2017 <a href=\"href://www.mmcity.cn\">mmcity.cn</a></p>
</div></body>");
}else{
$_SESSION['webviewtime']= time();
}
}
$_SESSION['webviewcount'] = $count+1;
}else{
$_SESSION['webviewtime']= time();
$_SESSION['webviewcount']= 1;
}

?>

<!--微信分享LOGO-->
<div class="share" style="display: none;">
    <img src="http://m.mmcity.cn/web/shareImg1.png" alt="分享图片">
</div>

<!--首页头部-->
<header class="weui-flex" style="padding: 0;border-bottom: 3px solid #ffffff">
    <img src="design/logo4.jpg" alt="" style="width: 100%;">
    <!--<div class="weui-flex__item swiper-container" style="width: 100%;background: #ffffff;">-->
    <!--<div class="swiper-wrapper">-->
    <!--<div class="swiper-slide "><img src="design/logo4.jpg" alt="" style="width: 100%;"></div>-->
    <!--<div class="swiper-slide "><img src="design/logo4.jpg" alt="" style="width: 100%;"></div>-->
    <!--<div class="swiper-slide "><img src="design/logo4.jpg" alt="" style="width: 100%;"></div>-->
    <!--</div>-->
    <!--</div>-->
</header>

<!--首页数据列表-->
<section class="sectionData">
    <div class="weui-grids">
        <div class="weui-grid">
            <p style="line-height: 140%">茂名-票数</p>
            <p id="mmticket" style="font-size: 28px;line-height: 140%">0</p>
        </div>
        <div class="weui-grid">
            <p style="line-height: 140%">十堰-票数</p>
            <p style="font-size: 28px;line-height: 140%" id="syticket">0</p>
        </div>
        <div class="weui-grid">
            <p style="line-height: 140%" id="lead">领先票数</p>
            <p style="font-size: 28px;line-height: 140%" id="gap">0</p>
        </div>
        <div class="weui-grid">
            <!--<p style="line-height: 140%" id="lead1">领先百分比</p>-->
            <!--<p style="font-size: 28px;line-height: 140%" id="gap_percent">0</p>-->
            <p style="line-height: 140%" id="lead1">首播时间</p>
            <p style="font-size: 14px;line-height: 140%" id="gap_percent" >CCTV-2<br />明天 <span style="font-size: 16px">19:00</span></p>
        </div>
        <!--<div class="weui-grid">-->
            <!--<p style="line-height: 140%">茂名-票数</p>-->
            <!--<p style="font-size: 28px;line-height: 140%">0</p>-->
        <!--</div>-->
        <!--<div class="weui-grid">-->
            <!--<p style="line-height: 140%">十堰-票数</p>-->
            <!--<p style="font-size: 28px;line-height: 140%">0</p>-->
        <!--</div>-->
        <div class="weui-grid" style="background-color: #e0ebf2;">
            <p style="font-weight: bold;font-size: 14px;color: #000000;"><a href="https://mp.weixin.qq.com/s?__biz=MzIyOTU4NDc4OQ==&mid=2247484330&idx=2&sn=81f3c973e65c1cf5967f0be0c471b9dc&chksm=e8413950df36b046906e3ec8fe88a2e5bb4f4e3f6d97c5fe7f56c81abb78d14e5a07c07904dc&mpshare=1&scene=1&srcid=0809W3WjLuDTba3t2oN2PkRK#rd">投票规则</a></p>
        </div>
        <div class="weui-grid" style="background-color: #e0ebf2;">
            <p style="font-weight: bold;font-size: 14px;color: #000000"><a href="compete.php">对手动态</a></p>
        </div>
        <div class="weui-grid" style="background-color: #e0ebf2;">
            <p style="font-weight: bold;font-size: 14px;color: #000000"><a href="http://mp.weixin.qq.com/s/cdb1t4IspyTKNgBSHc1GwA">全民助力</a></p>
        </div>
        <div class="weui-grid" style="background-color: #e0ebf2;">
            <p style="font-weight: bold;font-size: 14px;color: #000000"><a href="http://activity.yktour.com.cn/#/WildChain?channels=0">进入投票</a></p>
        </div>
    </div>
</section>

<!--首页跑马灯-->
<section class="indexMarquee weui-flex" style="text-align: center">
    <div id="ann_box" class="ann" style="overflow:hidden;height:34px;text-align: center;width: 100%" >
        <div><nobr><a href="https://mp.weixin.qq.com/s?__biz=MzIyOTU4NDc4OQ==&mid=2247484330&idx=3&sn=467eb48632333b2f55954b60303954e4&chksm=e8413950df36b0463a77772e43c053a5017c6fa2e825d92685611503cbe626cbaa3e0eca9809&mpshare=1&scene=1&srcid=0809FhFzFvfFS1ajouhUI22o#rd" target="_blank">【众志成城】协力同心，向茂名投出胜利的每一票</a></nobr></div>
        <div><nobr><a href="https://mp.weixin.qq.com/s?__biz=MzIyOTU4NDc4OQ==&mid=2247484330&idx=4&sn=5094646839bdedb8dd8590948e1baa0e&chksm=e8413950df36b046a76a48384c7f07b6a3460121982590f47ec95ad483d650ee199dadce83e5&mpshare=1&scene=1&srcid=0809wiFOaSq2GOTqKZRXb9xJ#rd" target="_blank">【魅力茂名】大美滨海，让茂名创造出更美的风景。</a></nobr></div>
        <div><nobr><a href="https://mp.weixin.qq.com/s?__biz=MzIyOTU4NDc4OQ==&mid=2247484330&idx=5&sn=31ab44e3191a4b6ebf67bc2221764121&chksm=e8413950df36b046548a492a88d258f36e4a13f4142c29884d175ff2fb89be656009dadfadbf&mpshare=1&scene=1&srcid=08093fTAzgsJklz7dmj1ujBK#rd" target="_blank">【感动茂名】好心文化，为茂名记录每一秒的感动。</a></nobr></div>
        <div><nobr><a href="https://mp.weixin.qq.com/s?__biz=MzIyOTU4NDc4OQ==&mid=2247483782&idx=1&sn=c17186bcd2b4774d32389c0e1a51cf0a&chksm=e8413b7cdf36b26ac4ca591e9c666e86fa7fbf0389c9683eae8f72f9d194bb72e2b55117e43f&mpshare=1&scene=1&srcid=0808uDXUPUIpDnO7nOxfWca3#rd" target="_blank">【生态公园】昔日伤疤，露天矿蜕变绝美生态公园</a></nobr></div>
        <div><nobr><a href="https://mp.weixin.qq.com/s?__biz=MzIyOTU4NDc4OQ==&mid=2247484191&idx=1&sn=ceec367e073c34630c388c75f942ea21&chksm=e84139e5df36b0f3ad1684bbba5c45ca1c295604b81aafd961a1e2619f1201865271ad8c5e53&mpshare=1&scene=1&srcid=0808EamhhPa2DX0Vbpu9kItZ#rd" target="_blank">【投票重点】投票重点，一定要紧记投票关键时间</a></nobr></div>
        <div><nobr><a href="https://mp.weixin.qq.com/s?__biz=MzIyOTU4NDc4OQ==&mid=2247484196&idx=1&sn=521b50b5b1106bda7e017c3de127a98b&chksm=e84139dedf36b0c829ab921bf599264dbd62ee00a3c9b298ca5c302e5228091bb36a0f3e0ddf&mpshare=1&scene=1&srcid=0808atK6pNXVIViuciZSqdrJ#rd" target="_blank">【我们拼了】茂名雄起，这一次全城都要拼到底了</a></nobr></div>
    </div>
</section>

<!--首页图表-->
<section style="border-bottom: 1px solid #eeeeee;" class="indexContent">
    <!-- 容器 -->
    <div class="weui-tab">
        <div class="weui-navbar">
            <a class="weui-navbar__item weui-bar__item--on" href="#tab1">
                趋势分析
            </a>
            <a class="weui-navbar__item" href="#tab2">
                百分比
            </a>
            <a class="weui-navbar__item" href="#tab3">
                时间段
            </a>
        </div>
    </div>
    <div class="charts" style="padding: 50px 1em 0 1em;height: 300px;overflow: hidden ">
        <div id="main" style="height: 300px;"><img src="design/loading.gif" alt="" style="width: 10%;margin-top: 120px"></div>
        <div id="round" style="height: 316px;"></div>
        <div id="bar" style="height: 300px;"></div>
    </div>
</section>

<!--页脚-->
<footer class="weui-footer">
    <a class="weui-footer__text" href="https://h5.dingtalk.com/home/index.html?_dt_no_comment=1&token=cb5fe8bcab0becec5550999058303bb9&corpId=dingd9d2e1d26cc65ae035c2f4657eb6378f&from=singlemessage&isappinstalled=1#/home">Copyright © 2017 茂名市城市动力科技有限公司</a>
    <p class="weui-footer__links">
        <a style="font-size: 12px" href="javascript:;" class="weui-footer__link">微信公众号：茂名城</a>
    </p>
</footer>

<!-- body 最后 -->
<script src="static/js/jquery-3.2.0.min.js"></script>
<script src="static/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="static/js/echarts.min.js"></script>
<script src="static/js/swiper.min.js"></script>

<!--jQuery特效-->
<script type="text/javascript">
    //    切换图表函数
    $(".indexContent .weui-tab .weui-navbar .weui-navbar__item").click(function () {
        var index = $(this).index();
        if (index == 0) {
            $("#main").css({marginTop: '0'})
        }
        else if (index == 1) {
            $("#main").css({marginTop: '-300px'})
        } else {
            $("#main").css({marginTop: '-610px'})
        }
    })

    //    跑马灯函数
    function slideLine(box,stf,delay,speed,h)
    {
        //取得id
        var slideBox = document.getElementById(box);
        //預設值 delay:幾毫秒滾動一次(1000毫秒=1秒)
        //       speed:數字越小越快，h:高度
        var delay = delay||1000,speed = speed||20,h = h||20;
        var tid = null,pause = false;
        //setInterval跟setTimeout的用法可以咕狗研究一下~
        var s = function(){tid=setInterval(slide, speed);}
        //主要動作的地方
        var slide = function(){
            //當滑鼠移到上面的時候就會暫停
            if(pause) return;
            //滾動條往下滾動 數字越大會越快但是看起來越不連貫，所以這邊用1
            slideBox.scrollTop += 1;
            //滾動到一個高度(h)的時候就停止
            if(slideBox.scrollTop%h == 0){
                //跟setInterval搭配使用的
                clearInterval(tid);
                //將剛剛滾動上去的前一項加回到整列的最後一項
                slideBox.appendChild(slideBox.getElementsByTagName(stf)[0]);
                //再重設滾動條到最上面
                slideBox.scrollTop = 0;
                //延遲多久再執行一次
                setTimeout(s, delay);
            }
        }
        //滑鼠移上去會暫停 移走會繼續動
        slideBox.onmouseover=function(){pause=true;}
        slideBox.onmouseout=function(){pause=false;}
        //起始的地方，沒有這個就不會動囉
        setTimeout(s, delay);
    }
    //網頁load完會執行一次
    //五個屬性各別是：外面div的id名稱、包在裡面的標籤類型
    //延遲毫秒數、速度、高度
    slideLine('ann_box','div',5000,30,34);

</script>

<!--图表和数据处理-->
<script src="assets/roundChart.js"></script>
<script src="assets/lineChart.js"></script>
<script type="text/javascript">
    window.onload = function () {
        roundChart();
        lineChart();
//         3秒获取一次数据列表和饼状图
        setInterval(function () {
            roundChart();
        }, 3000);
        // 60秒获取一次折线图和柱状图
        setInterval(function () {
            lineChart()
        },600000);
    };

</script>

<!--微信分享插件-->
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script src="static/js/wxShare.js"></script>

<!--cnzz统计-->
<div style="display: none;">
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1263285454'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1263285454%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</div>

<!--幻灯片JS-->
<script>
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: 5000
    });
</script>
</body>
</html>
