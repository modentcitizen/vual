$(function() {

        var $fullText = $('.admin-fullText');
        $('#admin-fullscreen').on('click', function() {
            $.AMUI.fullscreen.toggle();
        });

        $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function() {
            $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
        });


        var dataType = $('body').attr('data-type');
        for (key in pageData) {
            if (key == dataType) {
                pageData[key]();
            }
        }

        $('.tpl-switch').find('.tpl-switch-btn-view').on('click', function() {
            $(this).prev('.tpl-switch-btn').prop("checked", function() {
                    if ($(this).is(':checked')) {
                        return false
                    } else {
                        return true
                    }
                })
                // console.log('123123123')

        })
    })
    // ==========================
    // 侧边导航下拉列表
    // ==========================

var arr1 = [],
    arr2 = [],
    arr3 = [],
    arr4 = [];

var arruser = [],
    arrscore = [],
    arrsubmit = [],
    arrlast = [],
    arravg = [];

function arrTest() {
    //这个功能块的作用就是读取json数据。
    $.ajax({
        type: "post", //请求服务器载入数据
        async: false, //异步属性
        url: "/control/Ranking.php",
        data: {},
        dataType: "json",
        success: function(result) {
            if (result) {
                for (var i = 0; i < result.length; i++) {
                    arr1.push(result[i].username);
                    arr2.push(result[i].score);
                    arr3.push(result[i].submit_times);
                    arr4.push(result[i].score_avg);

                }
            }
        }
    })
    return arr1, arr2, arr3, arr4;
}

function arrrecord() {
    //这个功能块的作用就是读取json数据。
    $.ajax({
        type: "post", //请求服务器载入数据
        async: false, //异步属性
        url: "/control/record.php",
        data: {},
        dataType: "json",
        success: function(result) {
            if (result) {
                for (var i = 0; i < result.length; i++) {
                    arruser.push(result[i].username);
                    arrscore.push(result[i].oldscore);
                    arrsubmit.push(result[i].old_submit);
                    arrlast.push(result[i].last_logout);
                    arravg.push(result[i].score_avg);

                }
            }
        }
    })
    return arruser, arrscore, arrsubmit, arrlast;
}


arrTest();
arrrecord();






$('.tpl-left-nav-link-list').on('click', function() {
        $(this).siblings('.tpl-left-nav-sub-menu').slideToggle(80)
            .end()
            .find('.tpl-left-nav-more-ico').toggleClass('tpl-left-nav-more-ico-rotate');
    })
    // ==========================
    // 头部导航隐藏菜单
    // ==========================

$('.tpl-header-nav-hover-ico').on('click', function() {
    $('.tpl-left-nav').toggle();
    $('.tpl-content-wrapper').toggleClass('tpl-content-wrapper-hover');
})


// 页面数据
var pageData = {
    // ===============================================
    // 首页
    // ===============================================
    'index': function indexData() {


        var myScroll = new IScroll('#wrapper', {
            scrollbars: true,
            mouseWheel: true,
            interactiveScrollbars: true,
            shrinkScrollbars: 'scale',
            preventDefault: false,
            fadeScrollbars: true
        });

        var myScrollA = new IScroll('#wrapperA', {
            scrollbars: true,
            mouseWheel: true,
            interactiveScrollbars: true,
            shrinkScrollbars: 'scale',
            preventDefault: false,
            fadeScrollbars: true
        });

        var myScrollB = new IScroll('#wrapperB', {
            scrollbars: true,
            mouseWheel: true,
            interactiveScrollbars: true,
            shrinkScrollbars: 'scale',
            preventDefault: false,
            fadeScrollbars: true
        });



        // document.addEventListener('touchmove', function(e) { e.preventDefault(); }, false);


    },
    // ===============================================
    // 图表页
    // ===============================================





    'chart': function chartData() {
        // ==========================
        // 百度图表A http://echarts.baidu.com/
        // ==========================

        var echartsC = echarts.init(document.getElementById('tpl-echarts-C'));

        //var myChart = echarts.init(document.getElementById('bar'));

        optionC = {
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                top: '0',
                feature: {
                    dataView: { show: true, readOnly: false },
                    magicType: { show: true, type: ['line', 'bar'] },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
            },
            legend: {
                data: ['得分', '提交次数', '正确率']
            },
            xAxis: [{
                type: 'category',
                data: arr1
            }],
            yAxis: [{
                    type: 'value',
                    name: '得分',
                    min: 0,
                    interval: 10,
                    axisLabel: {
                        formatter: '{value}'
                    }
                },
                {
                    type: 'value',
                    name: '提交次数',
                    min: 0,
                    interval: 10,
                    axisLabel: {
                        formatter: '{value}'
                    }
                }
            ],
            series: [{
                    name: '得分',
                    type: 'bar',
                    data: arr2
                },
                {
                    name: '提交次数',
                    type: 'bar',
                    yAxisIndex: 1,
                    data: arr3
                },
                {
                    name: '正确率',
                    type: 'line',

                    data: arr4
                }
            ]
        };




        echartsC.setOption(optionC);

        var echartsB = echarts.init(document.getElementById('tpl-echarts-B'));
        optionB = {
            tooltip: {
                trigger: 'axis',

            },
            legend: {
                x: 'center',
                data: ['得分', '提交次数', '正确率']
            },
            radar: [{
                    indicator: (function() {
                        var res = [];
                        for (var i = 0; i <= arr1.length; i++) {
                            res.push({ text: arr1[i], max: 100 });
                        }
                        return res;
                    })(),
                    center: ['25%', '40%'],
                    radius: 100
                },
                {
                    indicator: (function() {
                        var res = [];
                        for (var i = 0; i <= arr1.length; i++) {
                            res.push({ text: arr1[i], max: 200 });
                        }
                        return res;
                    })(),
                    radius: 100,
                    center: ['50%', '60%'],
                },
                {
                    indicator: (function() {
                        var res = [];
                        for (var i = 0; i <= arr1.length; i++) {
                            res.push({ text: arr1[i], max: 100 });
                        }
                        return res;
                    })(),
                    center: ['75%', '40%'],
                    radius: 100
                }
            ],

            series: [{
                    type: 'radar',
                    tooltip: {
                        trigger: 'item'
                    },
                    itemStyle: { normal: { areaStyle: { type: 'default' } } },
                    data: [{
                        value: arr2,
                        name: '得分'
                    }]
                },
                {
                    type: 'radar',
                    radarIndex: 1,
                    tooltip: {
                        trigger: 'item'
                    },
                    itemStyle: { normal: { areaStyle: { type: 'default' } } },
                    data: [{
                            value: arr3,
                            name: '提交次数'
                        },
                        {
                            value: arr3,
                            name: '提交次数'
                        }
                    ]
                },
                {
                    type: 'radar',
                    radarIndex: 2,
                    itemStyle: { normal: { areaStyle: { type: 'default' } } },
                    tooltip: {
                        trigger: 'item'
                    },
                    data: [{
                            name: '正确率',
                            value: arr4,
                        },
                        {
                            name: '正确率',
                            value: arr4
                        }
                    ]
                }
            ]
        };
        echartsB.setOption(optionB);
        var echartsA = echarts.init(document.getElementById('tpl-echarts-A'));
        option = {

            tooltip: {
                trigger: 'axis',
            },
            legend: {
                data: ['得分', '正确率', '提交次数']
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                boundaryGap: true,
                data: arrlast
            }],

            yAxis: [{
                type: 'value',
                name: '得分/正确率/提交',
                axisLabel: {
                    formatter: '{value}'
                }
            }],
            series: [{
                    name: '得分',
                    type: 'line',
                    stack: '总量',
                    areaStyle: { normal: {} },
                    data: arrscore,
                    itemStyle: {
                        normal: {
                            color: '#59aea2'
                        },
                        emphasis: {

                        }
                    }
                },
                {
                    name: '正确率',
                    type: 'line',
                    stack: '总量',

                    areaStyle: { normal: {} },
                    data: arravg,
                    itemStyle: {
                        normal: {
                            color: '#e7505a'
                        }
                    }
                },
                {
                    name: '提交次数',
                    type: 'line',
                    stack: '总量',
                    areaStyle: { normal: {} },
                    data: arrsubmit,
                    itemStyle: {
                        normal: {
                            color: '#32c5d2'
                        }
                    }
                }
            ]
        };
        echartsA.setOption(option);
    }
}