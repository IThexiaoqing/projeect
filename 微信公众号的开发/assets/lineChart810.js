/**
 * Created by CPS on 2017/8/10.
 */
// 折线图and柱状图
function lineChart() {
    $.ajax({
        type: 'get',
        url: "http://api.mmcity.cn/vote/public/hourdata",
        jsonp: "jsoncallback",
        data: {AccessKey: 'cpuohkzb3ytrc5jsce4ei1ff2cgp34'},
        success: function (res) {

            // 折线图数据处理与图表生成
            var line = JSON.parse(res);
            // console.log(line);
            var mmData = []; // 茂名投票数据
            var shiData = []; // 十堰投票数据
            var date = []; // 时间戳
            var barDate = []; // 柱状图时间戳
            // 将数据全部PUSH进不同的数组
            for (var i = 0; i < line.data.mmdata.length; i++) {
                shiData.push(line.data.shidata[i].voteCount);
                mmData.push(line.data.mmdata[i].voteCount);
                date.push(line.data.mmdata[i].time)
            }

            for (var j = 0; j < date.length - 3; j++) {
                barDate.push(date[j]);
//                    console.log(barDate[j])
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
                    title: {
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
                                + '<br/>' + '差距：' + ((params[0].value > params[1].value) ? params[0].value - params[1].value : params[1].value - params[0].value)
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
                media: []
            };
            //每次窗口大小改变的时候都会触发onresize事件，这个时候我们将echarts对象的尺寸赋值给窗口的大小这个属性，从而实现图表对象与窗口对象的尺寸一致的情况
            echart.setOption(option);
            $(window).resize(function () {
                echart.resize();
            });


            // 柱状图数据处理与图表生成

            var minusMmVote = []; //每个小时茂名投票数
            var minusSyVote = []; // 每个小时十堰投票数

            for (var m = 0; m < line.data.mmdata.length; m++) {
                if (m == line.data.mmdata.length - 3) {
                    break;
                }
                minusMmVote.push(line.data.mmdata[m + 1].voteCount - line.data.mmdata[m].voteCount)
                minusSyVote.push(line.data.shidata[m + 1].voteCount - line.data.shidata[m].voteCount)
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
                        data: barDate,
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
        },
        error: function () {
            console.log('折线图无法获取')
        }
    })
}