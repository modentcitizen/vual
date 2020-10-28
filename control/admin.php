<!doctype html>
<html class="no-js fixed-layout">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>

<body>

    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <strong>VUAL</strong> <small>后台管理</small>
        </div>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">

                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <li><a href= "/list.php" class="tpl-header-list-link"><span class="am-icon-edit tpl-header-list-ico-out-size"></span>返回主页<span class=\"am-badge tpl-badge-success am-round\"></span></a></li>
                </li>

                <li class="am-dropdown" data-am-dropdown>
                    <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                        <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="#"><span class="am-icon-user"></span> 资料</a></li>
                        <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                        <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
                    </ul>
                </li>
                <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
            </ul>
        </div>
    </header>

    <div class="tpl-content-wrapper">
    <div class="am-cf admin-main">
        <!-- sidebar start -->
        <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
            <div class="am-offcanvas-bar admin-offcanvas-bar">
                <ul class="am-list admin-sidebar-list">
                    <li><a href="admin-index.html"><span class="am-icon-home"></span> 首页</a></li>
                    <li class="admin-parent">
                        <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 用户管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
                        <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
                        </ul>
                    </li>
                    <li><a href="admin-table.html"><span class="am-icon-table"></span> 题库管理</a></li>
                    <li><a href="admin-form.html"><span class="am-icon-pencil-square-o"></span> 模式调节</a></li>
                    <li><a href="#"><span class="am-icon-sign-out"></span> 注销</a></li>
                </ul>

                <div class="am-panel am-panel-default admin-sidebar-panel">
                    <div class="am-panel-bd">
                        <p><span class="am-icon-bookmark"></span> 公告</p>
                        <p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>
                    </div>
                </div>

                <div class="am-panel am-panel-default admin-sidebar-panel">
                    <div class="am-panel-bd">
                        <p><span class="am-icon-tag"></span> wiki</p>
                        <p>Welcome to the Amaze UI wiki!</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar end -->

        <!-- content start -->
        <div class="admin-content">
            <div class="admin-content-body">
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>用户管理</small></div>
                </div>

            
                    <div class="am-u-sm-12">
                        <table class="am-table am-table-bd am-table-striped admin-content-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>姓名</th>
                                    <th>密码</th>
                                    <th>权限值</th>
                                    <th>邮箱</th>
                                    <th>成绩</th>
                                    <th>提交次数</th>
                                    <th>最后登出时间</th>
                                </tr>
                            </thead>

                    </div>

                    <tbody id="tbody">
                    </tbody>


                    <footer class="admin-content-footer">
                        <hr>
                        <p class="am-padding-left"></p>
                    </footer>
             
                <!-- content end -->



        <tfoot>
            <tr>
                <td colspan="2" class="text-right">
                <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                <button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary am-icon-pencil-square-o" onclick="change(this)">修改</button>
                <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only" onclick="change(this)">
                <span class="am-icon-copy"></span> 复制</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                <span class="am-icon-trash-o"></span> 删除</button>
                </div>
                </div>
                </td>
            </tr>
        </tfoot>
    </table>

</div>

</div>







            </div>

            <a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>




            <script src="/assets/js/jquery.min.js"></script>
            <script src="/assets/js/amazeui.min.js"></script>
            <script src="/assets/js/app.js"></script>
</body>

</html>
<script type="application/javascript">
    $(function() {
        $.ajax({
            url: "/control/admincore.php",
            type: "post",
            dataType: "json",
            data: {},
            success: function(res) {
                $("#tbody").empty();
                $.each(res, function(i, val) {
                    $("#tbody").append('<tr><td >' + val.user_id + '</td><td class="edit">' + val.username + '</td><td class="edit">' + val.nickname + '</td><td class="edit">' + val.password + '</td><td class="edit">' + val.credit + '</td><td class="edit">' + val.email + '</td><td class="edit">' + val.score + '</td><td class="edit">' + val.submit_times + '</td><td class="edit">' + val.last_logout + '</td><td> </td></tr>');
                })
            },
            error: function() {
                alert("接口请求异常");
            }

        });
    })

    function change(obj) {
        var xg = $(obj).html();
        if (xg == '修改') {
            $('.edit').each(function() {
                var old = $(this).html();
                $(this).html("<input type='text' name='editname' value=" + old + " >");
                
            })
            $(obj).html('保存');
        } else if (xg == '保存') {
            $('input[name=editname]').each(function() {
                var old = $(this).html();
                var newfont = $(this).parent('td').parent('tr').children().find('input').val();
                $(this).parent('td').html(newfont);
            })
            $(obj).html('修改');
        }
    }
</script>
<?php




?>