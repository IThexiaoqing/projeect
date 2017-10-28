<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META HTTP-EQUIV="pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <META HTTP-EQUIV="expires" CONTENT="0">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <link rel="stylesheet" href="static/css/weui.min.css">
    <!--weiUI微信开发CSS库-->
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_8xnfn4p0o9c9dx6r.css">
    <title>魅力中国城-投票分析系统-内测版</title>
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
//        $time = time() - $times;
//        //5s内只能访问一次
//        if($time<5){
//            exit("<body style='background:#ffffff;;'><div class=\"copyright\" style=\"margin: 0 auto;margin-top: 60px;text-align: center;\">
//        <img src=\"http://mmcity.cn/static/img/mmcity1.870d795.png\" alt=\"茂名城\" style='width: 80%'>
//        <p style=\"margin-top:60px;font-size: 30px;font-weight: bold;\">502:Sorry,刷新太频繁了</p>
//        <p style=\"margin-top:10px;font-size: 30px;font-weight: bold;\">请5S后再尝试刷新</p>
//        <p style=\"margin-top: 15px;font-size: 20px\">Copyright ©2017 <a href=\"href://www.mmcity.cn\">mmcity.cn</a></p>
//    </div></body>");
//        }else{
//            $_SESSION['webviewtime']= time();
//        }
//    }
//    $_SESSION['webviewcount'] = $count+1;
//}else{
//    $_SESSION['webviewtime']= time();
//    $_SESSION['webviewcount']= 1;
//}


?>
<!--微信分享LOGO-->
<div style="display: none">
    <img src="timg.jpg" alt="">
</div>

<!--首页头部-->
<header class="weui-flex" style="padding: 0;border-bottom: 3px solid #ffffff">
    <img src="design/logo4.jpg" alt="" style="width: 100%;">
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
            <p style="line-height: 140%" id="lead1">领先百分比</p>
            <p style="font-size: 28px;line-height: 140%" id="gap_percent">0</p>
        </div>
        <div class="weui-grid" style="background-color: #e0ebf2;">
            <p style="font-weight: bold;font-size: 14px;color: #000000;"><a href="http://mp.weixin.qq.com/s/hdCxLpfaf2SYNXMm5eamXw">投票规则</a></p>
        </div>
        <div class="weui-grid" style="background-color: #e0ebf2;">
            <p style="font-weight: bold;font-size: 14px;color: #000000"><a href="compete.php">对手动态</a></p>
        </div>
        <div class="weui-grid" style="background-color: #e0ebf2;">
            <p style="font-weight: bold;font-size: 14px;color: #000000"><a href="">爱茂名城</a></p>
        </div>
        <div class="weui-grid" style="background-color: #e0ebf2;">
            <p style="font-weight: bold;font-size: 14px;color: #000000"><a href="http://weixin.qq.com/r/QztRSaXEwfi_reEq925R">进入投票</a></p>
        </div>
    </div>
</section>

<!--首页跑马灯-->
<section class="indexMarquee weui-flex" style="text-align: center">
    <div id="ann_box" class="ann" style="overflow:hidden;height:34px;text-align: center;width: 100%" >
        <div><nobr><a href="" target="_blank">【团结】 - 全名齐助力茂名城</a></nobr></div>
        <div><nobr><a href="" target="_blank">【美丽】 - 欣赏我们的茂名城</a></nobr></div>
        <div><nobr><a href="" target="_blank">【正能】 - 我们可爱的茂名城</a></nobr></div>
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

<footer class="weui-footer">
    <a class="weui-footer__text" href="https://h5.dingtalk.com/home/index.html?_dt_no_comment=1&token=cb5fe8bcab0becec5550999058303bb9&corpId=dingd9d2e1d26cc65ae035c2f4657eb6378f&from=singlemessage&isappinstalled=1#/home">Copyright © 2017 茂名市城市动力科技有限公司</a>
    <p class="weui-footer__links">
        <a style="font-size: 12px" href="javascript:;" class="weui-footer__link">粤ICP备17050362号-4</a>
    </p>
</footer>

<!-- body 最后 -->
<script src="static/js/jquery-3.2.1.js"></script>
<script src="static/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="static/js/echarts.min.js"></script>
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



<!--图表-->
<script type="text/javascript">

    // 折线图and柱状图
    function lineChart() {
        $.ajax({
            type: 'get',
            url: "http://api.mmcity.cn/vote/public/hourdata",
            jsonp: "jsoncallback",
            data:{AccessKey:'cpuohkzb3ytrc5jsce4ei1ff2cgp34'},
            success: function (res) {

                // 折线图数据处理与图表生成
                var line = JSON.parse(res);
//                console.log(line);
                var mmData = []; // 茂名投票数据
                var shiData = []; // 十堰投票数据
                var date = []; // 时间戳

                // 将数据全部PUSH进不同的数组
                for (var i = 0; i < line.data.mmdata.length; i++) {
                    shiData.push(line.data.shidata[i].voteCount);
                    mmData.push(line.data.mmdata[i].voteCount);
                    date.push(line.data.mmdata[i].time)
                }

                //  Y轴刻度最低值附带小数，将小数处理为整数，便于手机端显示
                var mVote;
                var minVote = Number(mmData[0]);
                var minVote1 = Number(shiData[0]);
                if (minVote < minVote1) {
                    mVote = minVote
                } else if (minVote > minVote1) {
                    mVote = minVote1
                } else {
                    mVote = minVote
                }
                mVote = parseInt(mVote / 10000);
                mVote = mVote * 10000;

                // 预测区域数据处理
                var s_x = line.data.s_x;
                var e_x = line.data.e_x;
                s_x = String(s_x);
                e_x = String(e_x);
                // 折线数据显示图表
                var echart = echarts.init(document.getElementById('main'));
                // 指定图表的配置项和数据
                var option = {
                    baseOption: {
                        title : {
                            text: '网络投票12小时图表',
                            x: 'right',
                            align: 'right',
                            textStyle: {
                                fontSize: 12,
                                fontWeight: 'normal'
                            }
                        },
                        // 分类
                        legend: {
                            data: ['茂名', '十堰'],
                            left: 0,
                            textStyle: {
                                fontSize: 16
                            }
                        },

                        // X轴
                        xAxis: {
                            type: 'category',
                            boundaryGap: false,
                            data: date,
                            axisLabel: {
                                formatter: function (params) {
                                    return (new Date(parseInt(params * 1000))).getHours()
                                }
                            }
                        },

                        // Y轴为数据范围
                        yAxis: {
                            type: 'value',
                            axisLabel: {
                                // Y轴做了格式化处理
                                formatter: function (value) {
                                    return value / 10000 + '万';
                                }
                            },
                            min: mVote
                        },

                        // 点击某个时刻显示所有分类数据量
                        tooltip: {
                            trigger: 'axis',
                            formatter: function (params) {
//                                return '<br/ >' + params[0].seriesName + ':' + params[0].value + '<br/>' + params[1].seriesName + ':' + params[1].value
                                return ((new Date(parseInt(params[0].name) * 1000)).getHours() + ':' + (new Date(parseInt(params[0].name) * 1000)).getMinutes() + ':' + (new Date(parseInt(params[0].name) * 1000)).getSeconds()
                                    + '<br/ >' + params[0].seriesName + ':' + params[0].value + '<br/>' + params[1].seriesName + ':' + params[1].value
                                    + '<br/>' + '差距：' + ((params[0].value > params[1].value)? params[0].value-params[1].value: params[1].value-params[0].value)
                                )
                            }
                        },

                        // 模拟数据，真实数据由此插入
                        series: [
                            {
                                name: '茂名',
                                type: 'line',
                                data: mmData,
                                // 预测区域显示
                                markArea: {
                                    itemStyle: {
                                        normal: {
                                            color: ['rgba(193, 210, 240, 0.3)', 'rgba(193, 210, 240, 1)']
                                        }
                                    },
                                    label: {
                                        normal: {
                                            textStyle: {
                                                color: ['#343434']
                                            },
                                            position: ['-35', '-20']
                                        }
                                    },
                                    data: [
                                        [
                                            {
                                                name: '预测票数',
                                                xAxis: s_x
                                            },
                                            {
                                                xAxis: e_x
                                            }
                                        ]
                                    ]
                                }
                            },
                            {
                                name: '十堰',
                                type: 'line',
                                data: shiData
                            }
                        ],

                        // 调整CANVAS的位置
                        grid: {
                            left: '0%',
                            right: '0%',
                            bottom: '3%',
                            containLabel: true
                        }
                    },
                    // 响应式处理
                    media: [

                    ]
                };
                //每次窗口大小改变的时候都会触发onresize事件，这个时候我们将echarts对象的尺寸赋值给窗口的大小这个属性，从而实现图表对象与窗口对象的尺寸一致的情况
                echart.setOption(option);
                $(window).resize(function () {
                    echart.resize();
                });


                // 柱状图数据处理与图表生成

                var minusMmVote = []; //每个小时茂名投票数
                var minusSyVote = []; // 每个小时十堰投票数

                for (var m = 0; m < line.data.mmdata.length; m++){
                    if (m == line.data.mmdata.length - 2){
                        break;
                    }
                    minusMmVote.push(line.data.mmdata[m+1].voteCount-line.data.mmdata[m].voteCount)
                    minusSyVote.push(line.data.shidata[m+1].voteCount-line.data.shidata[m].voteCount)
                }


                var right1_2 = echarts.init(document.getElementById('bar'));
                var option2 = {
                    title: {
                        text: '网络投票12小时图表',
                        textStyle: {
                            color: '#333333',
                            fontSize: 12,
                            fontWeight: 'normal'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        formatter: function (params) {
//                                return '<br/ >' + params[0].seriesName + ':' + params[0].value + '<br/>' + params[1].seriesName + ':' + params[1].value
                            return ((new Date(parseInt(params[0].name) * 1000)).getHours() + ':' + (new Date(parseInt(params[0].name) * 1000)).getMinutes() + ':' + (new Date(parseInt(params[0].name) * 1000)).getSeconds()
                                + '<br/ >' + params[0].seriesName + ':' + params[0].value + '<br/>' + params[1].seriesName + ':' + params[1].value
                            )
                        }
                    },
                    legend: {
                        data: ['茂名', '十堰'],
                        orient: 'vertical',
                        right: 'right',
                        itemHeight: 12,
                        itemGap: 6,
                        textStyle: {
                            color: '#000',
                            fontSize: 14
                        }
                    },
                    calculable: true,
                    grid: {
                        top: '25%',
                        bottom: '10%',
                        left: '3%',
                        right: '3%',
                        containLabel: true
                    },
                    xAxis: [
                        {
                            data: date,
                            type: 'category',
                            //  改变x轴颜色和
                            axisLine: {
                                lineStyle: {color: '#000'}
                            },
                            //  改变x轴字体颜色和大小
                            axisLabel: {
                                textStyle: {color: '#000'},
                                formatter: function (params) {
                                    return (new Date(parseInt(params * 1000))).getHours()
                                }
                            }
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            //  改变y轴颜色
                            axisLine: {
                                lineStyle: {color: '#000'}
                            },
                            //  改变y轴字体颜色
                            axisLabel: {
                                //        Y轴做了格式化处理
                                formatter: function (value) {
                                    return value / 10000 + '万';
                                },
                                textStyle: {color: '#000'}
                            }
                        }
                    ],
                    series: [
                        {
                            name: '茂名',
                            type: 'bar',
                            data: minusMmVote
                        },
                        {
                            name: '十堰',
                            type: 'bar',
                            data: minusSyVote
                        }
                    ],
                    color: ['#C23531', '#2F4554', '#00FF00', '#FFFF00']
                };
                window.onresize = right1_2.resize;
                right1_2.setOption(option2);
            }
        })
    }

    // 饼状图and数据列表
    function roundChart() {
        $.ajax({
                type: 'get',
                url: "http://api.mmcity.cn/vote/public/now",
                data:{AccessKey:'cpuohkzb3ytrc5jsce4ei1ff2cgp34'},
                jsonp: "jsoncallback",
                success: function (res) {
                    var round = JSON.parse(res);
//                    console.log(round)

                    var allNum = 0;
                    var otherNum = 0;
                    var qdnNum = 0;
                    // 数据列表茂名、十堰以及其他城市的总票数获取
                    for (var i = 0; i < round.data.length; i++) {
                        if (round.data[i].cityId == 17) {
                            $('#mmticket').html(round.data[i].voteCount)
                        }
                        if (round.data[i].cityId == 23) {
                            $('#syticket').html(round.data[i].voteCount)
                        }
                        if (round.data[i].cityId == 19){
                            qdnNum = round.data[i].voteCount;
                        }
                        allNum = allNum + parseInt(round.data[i].voteCount)
                    }
                    var mmNum = parseInt($('#mmticket').html());
                    var syNum = parseInt($('#syticket').html());
                    otherNum = allNum - mmNum - syNum - qdnNum;

                    // 领先百分比
//                    var mmPercent = parseFloat([Math.abs(mmNum)/(allNum)]*100);
//                    var syPercent = parseFloat([Math.abs(syNum)/(allNum)]*100);
                    var mmPercent = parseFloat([Math.abs(mmNum) / (syNum + mmNum)] * 100);
                    var syPercent = parseFloat([Math.abs(syNum) / (syNum + mmNum)] * 100);
                    var minusPercent;
                    if (mmNum > syNum) {
                        minusPercent = mmPercent - syPercent
                    } else if (mmNum <= syNum) {
                        minusPercent = syPercent - mmPercent
                    }
                    $('#gap_percent').html(minusPercent.toFixed(2) + '%')

                    // 茂名票数领先或落后时候的样式设置
                    if (mmNum > syNum) {
                        $('#gap').html(mmNum - syNum)
                    } else if (mmNum <= syNum) {
                        $('#lead').html("落后票数");
                        $('#gap').html(syNum - mmNum);
                        $('#lead1').html("落后百分比");
                        $('.sectionData').css({background: 'red'})
                    }


                    // 饼状图数据显示
                    var round = echarts.init(document.getElementById('round'));
                    var option1 = {
                        baseOption: {
                            title: {
                                text: '网络投票12小时图表',
                                textStyle: {
                                    color: '#333333',
                                    fontSize: 12,
                                    fontWeight: 'normal'
                                },
                                x: 'right',
                                align: 'right'
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            legend: {
                                orient: 'vertical',
                                left: 'left',
                                data: ['茂名', '十堰','黔东南', '其他']
                            },
                            series: [
                                {
                                    name: '百分比',
                                    type: 'pie',
                                    radius: '45%',
                                    center: ['50%', '60%'],
                                    data: [
                                        {value: mmNum, name: '茂名'},
                                        {value: syNum, name: '十堰'},
                                        {value: qdnNum, name:'黔东南'},
                                        {value: otherNum, name: '其他'}
                                    ],
                                    label: {
                                        normal: {
                                            formatter: '{b}\n{d}%'
                                        }
                                    }
                                }
                            ]
                        }

                    };
                    //每次窗口大小改变的时候都会触发onresize事件，这个时候我们将echarts对象的尺寸赋值给窗口的大小这个属性，从而实现图表对象与窗口对象的尺寸一致的情况
                    round.setOption(option1);
                    $(window).resize(function () {
                        round.resize();
                    });
                }
            }
        );
    }



    window.onload = function () {
        // onload的时候运行一次
        lineChart();
        roundChart();
        // 3秒获取一次数据列表和饼状图
        setInterval(function () {
            roundChart();
        }, 3000);
        // 60秒获取一次折线图和柱状图
        setInterval(function () {
            lineChart()
        },600000);
    };

</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script>
    var url =  window.location.href;
    $.ajax({
        type: 'get',
        url: "http://test.cypow.com/c/index.php/wechat/index/getAccess6.html",
        jsonp: "jsoncallback",
        data:{url:url},
        success: function (res) {
            var ret5 = JSON.parse(res);
            wx.config({debug: true, appId: ret5.appId,timestamp: ret5.timestamp, nonceStr: ret5.nonceStr, signature: ret5.signature,jsApiList: ret5.jsApiList});
        }
    })
    wx.ready(function () {
        wx.checkJsApi({jsApiList: ['checkJsApi','onMenuShareTimeline','onMenuShareAppMessage'] });
        wx.onMenuShareTimeline({title: '魅力中国城-投票分析系统1',link: 'http://m.mmcity.cn/web/index1.php',imgUrl: 'http://m.mmcity.cn/web/shareImg1.png'});
        wx.onMenuShareAppMessage({title: '魅力中国城-投票分析系统2',desc: '魅力中国城-最爱我茂名',link: 'http://m.mmcity.cn/web/index1.php',imgUrl: 'http://m.mmcity.cn/web/shareImg1.png'})
    })
</script>
<!--统计-->
<div style="display: none;">
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1263285454'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1263285454%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
</body>
</html>
