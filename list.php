<?PHP
if(!defined("ROOTPATH")){
    $ROOT_DIR = $_SERVER['DOCUMENT_ROOT'];
    require_once $ROOT_DIR . "/common/directory.php";
}
require_once CONTROL . "/core.php";
$userInfoHtml = "<span class=\"tpl-header-list-user-nick\">" .(PAGE_ACT::VUALUserInfo()) . "</span><span class=\"tpl-header-list-user-ico\"> <img src=\"/assets/img/user01.png\"></span>";
$usercredit = PAGE_ACT::VUALUserCredit();
if($usercredit == "1000"){
    $backStageHtml1 = "<li><a href=\"/control/admin.php\"><span class=\"am-icon-edit\"></span> 进入后台</a></li>"; 
    $backStageHtml2 = " <li><a href=\"/control/admin.php\" class=\"tpl-header-list-link\"><span class=\"am-icon-edit tpl-header-list-ico-out-size\"></span>进入后台<span class=\"am-badge tpl-badge-success am-round\"></span></a></li>";
    $backStageHtml3 = " <li class=\"tpl-left-nav-item\"><a href=\"/control/backstage.php\" class=\"nav-link tpl-left-nav-link-list\"><i class=\"am-icon-edit\"></i><span>进入后台</span><i class=\" tpl-left-nav-more-ico am-fr am-margin-right\"></i></a>";
}





?>


<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Webug 靶场</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/css/app.css">

    <style type="text/css">
        a {
            color: #7c7c7c;
            transition: all 0.5s;
            -moz-transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
        }

        .oneBox {
            font-size: 16px;
            overflow: hidden;
            color: #7c7c7c;
            line-height: 46px;
            border-bottom: 1px solid #e0e7eb;
        }

        .type-title {
            width: 80px;
            color: #9aabb8;
            margin-right: 44px;
            text-align: left;
        }

        .all {
            width: 62px;
            margin-right: 28px;
        }

        .chooseBox div.oneBox div.choose {
            display: inline-block;
            margin-top: -8px;
        }

        .choose a {
            margin-right: 30px;
            margin-bottom: 7px;
            color: #7c7c7c;
            padding: 8px 15px;
        }

        .oneBox .active {
            background-color: #3498db;
            color: #fff !important;
        }

        .chooseBox .oneBox a {
            padding: 8px 15px;
        }
    </style>
</head>

<body data-type="generalComponents">




<header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <span style="color: green;">VUAL靶场</span>
        </div>
        <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

        </div>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
             
                <li>
                    <form id="myform"  action="/control/rank.html">
                        <button type="submit" name="ranking">
                        <a class="tpl-header-list-link" id="agree"  role="button" ><span class="am-icon-table tpl-header-list-ico-out-size"></span>
                        得分总览
                        <span class="am-badge tpl-badge-success am-round"></span>
                        </a>
                    
                    </form>
                </li>
           




                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
 
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-calendar"></span> 排行榜 <span class="am-badge tpl-badge-primary am-round">4</span></span>
                    </a>
                    <ul class="am-dropdown-content tpl-dropdown-content">
                        <li class="tpl-dropdown-content-external">
                            <h3>你当前排名是第 <span class="tpl-color-primary">4</span> 名</h3><a href="###">全部</a></li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">当前得分</span>
                                <span class="percent">45%</span>
                                </span>
                                <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-success" style="width:45%"></div></div>
                    </span>
  
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>

                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
				        <?PHP echo($userInfoHtml);?>
			            </div>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="#"><span class="am-icon-bell-o"></span> 资料</a></li>
                        <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                        <?php echo($backStageHtml1);?>
                        <li><a href="/control/loginout.php"><span class="am-icon-power-off"></span> 退出</a></li>
                    </ul>
                </li>
                <li><a href="/control/loginout.php" class="tpl-header-list-link"><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
            </ul>
        </div>
    </header>




<div class="tpl-page-container tpl-page-header-fixed">
    <div class="tpl-left-nav tpl-left-nav-hover">
        <div class="tpl-left-nav-title">
            靶场列表
        </div>
        <div class="tpl-left-nav-list">
            <ul class="tpl-left-nav-menu">
                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list ">
                        <i class="am-icon-table"></i>
                        <span>靶场</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu" style="display:block">
                        <li>
                            <a href="/control/env.php" class="active">
                                <i class="am-icon-angle-right"></i>
                                <span>web靶场</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="am-icon-angle-right"></i>
                                <span>cms靶场</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="/template/ctf.html">
                                <i class="am-icon-angle-right"></i>
                                <span>CTF</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-wpforms"></i>
                        <span>知识库</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu">
                        <li>
                            <a href="/template/knowledgeBase.html">
                                <i class="am-icon-angle-right"></i>
                                <span>乌云知识库</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-wpforms"></i>
                        <span>解码工具</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu">
                        <li>
                            <a href="/template/md5.html">
                                <i class="am-icon-angle-right"></i>
                                <span>md5</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="/template/job.html">
                                <i class="am-icon-angle-right"></i>
                                <span>常用工具</span>
                                <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
               


                </li>
            </ul>
        </div>
    </div>
    <div class="tpl-content-wrapper" style="padding-top: 0">
        <div class="tpl-portlet-components">
            <div class="portlet-title" style="margin-bottom: 0">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 列表
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    <div class="portlet-input input-small input-inline">
                        <div class="input-icon right">
                            <i class="am-icon-search"></i>
                            <input type="text" class="form-control form-control-solid" placeholder="搜索..."></div>
                    </div>
                </div>
            </div>
            <div class="tpl-block">
                <div class="chooseBox">
                    <div class="oneBox" id="levelBox">
                        <input type="text" hidden="hidden" id="level" value="9">
                        <span class="type-title">难易级别：</span>
                        <span class="all">
                            <a href="#" class="active" onclick="levelChange(this)" name="9">全部</a>
                        </span>
                        <div class="choose">
                            <a href="#" onclick="levelChange(this)" name="1">入门</a>
                            <a href="#" onclick="levelChange(this)" name="2">初级</a>
                            <a href="#" onclick="levelChange(this)" name="3">进阶</a>
                            <a href="#" onclick="levelChange(this)" name="4">高级</a>
                        </div>
                    </div>
                    <div class="oneBox" id="typeBox">
                        <input type="text" hidden="hidden" id="type" value="9">
                        <span class="type-title">漏洞类型：</span>
                        <span class="all">
                            <a href="#" class="active" onclick="typeChange(this)" name="9">全部</a>
                        </span>
                        <div class="choose">
                            <a href="#" onclick="typeChange(this)" name="1">注入</a>
                            <a href="#" onclick="typeChange(this)" name="2">XSS</a>
                            <a href="#" onclick="typeChange(this)" name="3">任意文件下载</a>
                            <a href="#" onclick="typeChange(this)" name="4">上传漏洞</a>
                            <a href="#" onclick="typeChange(this)" name="5">逻辑漏洞</a>
                            <a href="#" onclick="typeChange(this)" name="6">其他</a>
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-id">ID</th>
                                    <th class="table-title">标题</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">


                                </tbody>
                            </table>
                            <div class="am-modal am-modal-prompt my-prompt" tabindex="-1">
                                <div class="am-modal-dialog">
                                    <div class="am-modal-hd">输入flag</div>
                                    <div class="am-modal-bd">
                                        <input type="text" class="am-modal-prompt-input">
                                    </div>
                                    <div class="am-modal-footer">
                                        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                        <span class="am-modal-btn" data-am-modal-confirm>提交</span>
                                    </div>
                                </div>
                            </div>
                            <hr>

                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div>

</div>

<button class="am-btn am-btn-danger" data-am-modal="{target: '#my-popup'}">Popup</button>

<div class="am-popup" id="my-popup">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title">...</h4>
      <span data-am-modal-close
            class="am-close">&times;</span>
    </div>
    <div class="am-popup-bd">
      ...
    </div>
  </div>
</div>


<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/amazeui.min.js"></script>
<script src="/assets/js/app.js"></script>
<script type="application/javascript">

    function submitFlag(_this) {
        var id = _this.parentElement.parentElement.parentElement.parentElement.children[0].textContent;
        model(id);
    }

   

    function model(id) {
        $('.my-prompt').modal({
            relatedTarget: this,
            onConfirm: function (e) {
                $.ajax({
                    url: "/control/check_flag.php",
                    data: {'id': id, 'flag': e.data},
                    type: 'post',
                    dataType: 'json',
                    success: function (res) {
                        if (res.result == "success") {
                            alert("flag 正确")
                        } else {
                            alert("flag 错误")
                        }
                        location.reload(true);
                    }, error: function () {
                        alert("接口请求异常456");
                        location.reload(true);
                    }
                });
            },
            onCancel: function (e) {
            }
        });
    }

    function levelChange(_this) {
        $("#levelBox a").removeClass();
        _this.className = "active";
        $("#level").val(_this.name);
        var type = $("#type").val();
        var level = $("#level").val();
        $.ajax({
            url: "/control/env.php",
            type: "post",
            dataType: "json",
            data: {'type': type, 'level': level},
            success: function (res) {
                $("#tbody").empty();
                $.each(res, function (i, val) {
                    if (val.envFlag == 'check') {
                        $("#tbody").append('<tr><td>' + val.id + '</td><td style="width: 70%;">' + val.envName + '</td><td><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><a href="' + val.path + '" target="view_window" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 打开靶场</a> <button type="button" class="am-btn am-btn-default am-btn-xs am-hide-sm-only doc-prompt-toggle"  onclick="submitFlag(this)"><span class="am-icon-copy"></span> 提交FLAG</button> </div></div></td></tr>');
                    } else {
                        $("#tbody").append('<tr><td>' + val.id + '</td><td style="width: 70%;">' + val.envName + '</td><td><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><a href="' + val.path + '" target="view_window" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 打开靶场</a></div></div></td></tr>');
                    }
                })
            },
            error: function () {
                alert("接口请求异常");
            }

        });
    }

    function typeChange(_this) {
        $("#typeBox a").removeClass();
        _this.className = "active";
        $("#type").val(_this.name);
        var type = $("#type").val();
        var level = $("#level").val();
        $.ajax({
            url: "/control/env.php",
            type: "post",
            dataType: "json",
            data: {'type': type, 'level': level},
            success: function (res) {
                $("#tbody").empty();

                $.each(res, function (i, val) {
                    if (val.envFlag == 'check') {
                        $("#tbody").append('<tr><td>' + val.id + '</td><td style="width: 70%;">' + val.envName + '</td><td><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><a href="' + val.path + '" target="view_window" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 打开靶场</a> <button type="button" class="am-btn am-btn-default am-btn-xs am-hide-sm-only doc-prompt-toggle"  onclick="submitFlag(this)"><span class="am-icon-copy"></span> 提交FLAG</button> </div></div></td></tr>');
                    } else {
                        $("#tbody").append('<tr><td>' + val.id + '</td><td style="width: 70%;">' + val.envName + '</td><td><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><a href="' + val.path + '" target="view_window" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 打开靶场</a></div></div></td></tr>');
                    }
                })
            },
            error: function () {
                alert("接口请求异常");
            }

        });
    }

    $(function () {
        $.ajax({
            url: "/control/env.php",
            type: "post",
            dataType: "json",
            data: {'type': 9, 'level': 9},
            success: function (res) {
                $("#tbody").empty();
                $.each(res, function (i, val) {
                    if (val.envFlag == 'check') {
                        $("#tbody").append('<tr><td>' + val.id + '</td><td style="width: 70%;">' + val.envName + '</td><td><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><a href="' + val.path + '" target="view_window" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 打开靶场</a> <button type="button" class="am-btn am-btn-default am-btn-xs am-hide-sm-only doc-prompt-toggle"  onclick="submitFlag(this)"><span class="am-icon-copy"></span> 提交FLAG</button> </div></div></td></tr>');
                    } else {
                        $("#tbody").append('<tr><td>' + val.id + '</td><td style="width: 70%;">' + val.envName + '</td><td><div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><a href="' + val.path + '" target="view_window" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 打开靶场</a></div></div></td></tr>');
                    }
                })
            },
            error: function () {
                alert("接口请求异常");
            }

        });
    })

</script>
</body>

</html>

