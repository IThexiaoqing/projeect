/**
 * Created by CPS on 2017/8/10.
 */
// 时间戳处理函数
function getLocalTime(nS) {
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/, ' ');
}
// 十堰动态数据
function getMsg() {
    $.ajax({
        type: 'GET',
        url: 'http://w.mmcity.cn/public/index.html/msg',
        jsonp: "jsoncallback",
        data: {AccessKey: 'cpuohkzb3ytrc5jsce4ei1ff2cgp34555'},
        success: function (res) {
            var msg = JSON.parse(res);
            // console.log(msg)
            var tTime = [];
//                $(".dynamic_contents").html("");
            for (var i = 0; i < msg.data.length; i++) {

                // tTime.push((new Date(parseInt(msg.data[i].time) * 1000)).getMonth() + "月" + (new Date(parseInt(msg.data[i].time) * 1000)).getDay() + '日' + (new Date(parseInt(msg.data[i].time) * 1000)).getHours() + "时" + (new Date(parseInt(msg.data[i].time) * 1000)).getMinutes() + '分' + (new Date(parseInt(msg.data[i].time) * 1000)).getSeconds() + '秒')

                tTime.push(getLocalTime(msg.data[i].time));
                $("<li><nobr><a style='color: #000000' href='"+msg.data[i].url +"'>"+ msg.data[i].title +"</a><nobr/></li>").appendTo($(".dynamic_contents"));
                // $("<li><a href='" + msg.data[i].url + "'><nobr><span>来源：" + msg.data[i].nick_name + "</span><span>时间：" + tTime[i] + "</span><span>●&nbsp;&nbsp;&nbsp;" + msg.data[i].title + "</span><nobr/></a><li/>").appendTo($(".dynamic_contents"));
            }
            $('.dynamic img').hide();
        },
        error: function () {
            console.log('动态数据获取失败');
        }
    });
}