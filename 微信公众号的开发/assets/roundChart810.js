/**
 * Created by CPS on 2017/8/10.
 */
// 饼状图and数据列表
function roundChart() {
    $.ajax({
            type: 'get',
            url: "http://119.23.174.25:9898/getalldata",
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
                var minusPercent;
                if (mmNum > syNum) {
                    minusPercent = (mmNum - syNum)/syNum * 100
                } else if (mmNum <= syNum) {
                    minusPercent = (-(mmNum - syNum))/syNum * 100
                }
                // $('#gap_percent').html(minusPercent.toFixed(2) + '%');

                // 茂名票数领先或落后时候的样式设置
                if (mmNum > syNum) {
                    $('#gap').html(mmNum - syNum)
                } else if (mmNum <= syNum) {
                    $('#lead').html("落后票数");
                    $('#gap').html(syNum - mmNum);
                    $('#lead1').html("落后百分比");
                    $('.sectionData .weui-grid p:last-child').css({color: 'red'})
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
