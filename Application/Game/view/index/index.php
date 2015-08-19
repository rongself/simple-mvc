<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>帮帮牛郎</title>
    <script type="text/javascript" src="bower_components/headjs/dist/1.0.0/head.min.js"></script>
    <script type="text/javascript" >
        head.load(
            'http://res.wx.qq.com/open/js/jweixin-1.0.0.js',
            'bower_components/zepto/zepto.min.js',
            'bower_components/zeptotouch/zepto-touch.min.js'
        );
    </script>
    <link rel="stylesheet" href="bower_components/reset-css/reset.css"/>
    <link rel="stylesheet" href="styles/default.css"/>
</head>
<body class="bg">
<div class="main">
    <?php if ($this->isSuccess) :?>
        <div class="title"><img src="images/success.png" alt="" width="88.1%;"/></div>
        <div class="info"><?php echo $this->user['nickname'];?>已成功帮助牛郎，获得skype国际通话卡</div>
        <div class="btn" style="text-align: center"><img src="images/to_help.png" alt="" width="78%"/></div>
    <?php else: ?>
        <div class="title"><img src="images/top.png" alt="" width="82.9%;"/></div>
        <div class="description">牛郎的礼物离织女<span style="color: #ffffff"><?php echo Application\Game\Model\HelpModel::TOTAL_DISTANCE; ?></span>光年</div>
        <div class="rainbow" style="position: relative">
            <img src="images/ch_05.png" width="88.6%;" alt=""/>
            <img src="images/present.png" width="16.6%;" alt="" style="position: absolute;left: 3rem;bottom: 1rem;"/>
            <img src="images/girl-angry.png" width="22.5%;" alt="" style="position: absolute;right: 2rem;bottom: 1rem;"/>
        </div>
        <div class="info"><?php echo $this->user['nickname'];?>接受了任务，表示一定准时完成</div>
        <div class="btn" style="text-align: center"><img id="shareBtn" src="images/btn1.png" alt="" width="78%"/></div>
        <div class="info">已有<?php echo $this->helpedTimes;?>人帮助，距离完成还有<?php echo $this->leftDistance;?>光年</div>
        <div style="text-align: left;width: 78%;margin-left: auto;margin-right: auto;margin-top: 9%">
            <div style="font-size: xx-small;font-weight: bold;line-height: 1.2em">
                <p>游戏规则：</p>
                <p>1.游戏发起人邀请好友帮助牛郎传递礼物，当礼物到达织女
                    即为游戏成功；</p>
                <p>2.每个好友可以帮助游戏发起人一次；</p>
                <p>3.游戏成功后游戏发起人可以获得skype国际通话软件60分
                    钟国际长途兑换码。</p>
            </div>
        </div>
    <?php endif; ?>

    <div style="text-align: center;margin-top: 6%;color: #ffffff;   ">本活动物流赞助商：宇宙领先的递四方速递有限公司</div>
</div>
<div class="layer-1">
    <div class="row-1" style="text-align: center;margin-top: 6.25%">
        <img src="images/f_09.png" width="82%" alt=""/>
    </div>
    <div class="row-2" style="text-align: center;margin-top: 4.7%;">
        <img src="images/f_21.png" width="59%" alt=""/>
    </div>
    <div class="row-3" style="text-align: center;margin-top: 3.7%">
        <a href="javascript:void(0);" id="closeBtn"><img src="images/f_34.png" width="78%" alt=""/></a>
    </div>
</div>
<div class="layer-2" style="text-align: center;display: none;">
    <img src="images/p1_05.png" width="72.2%" alt="" style="margin-top: 9.2%;"/>
</div>
<?php $apiList = array('onMenuShareQQ', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQZone');?>
<script type="text/javascript" charset="utf-8">
    head.ready(function(){
        var title = '帮帮牛郎';
        var imgUrl = 'http://4px.ronccc.com/images/icon.png';
        var link = 'http://4px.ronccc.com/?module=game&controller=index&action=help&uid=<?php echo $this->user['id'];?>';
        var desc = '小手一抖，skype国际通话卡到手。<?php echo $this->user['nickname'];?>帮牛郎送的礼物只剩<?php echo $this->leftDistance;?>光年，快来帮忙！';

        wx.config(<?php echo $this->js->config($apiList, true, true) ?>);
        wx.ready(function(){
            wx.checkJsApi({
                jsApiList: <?php echo json_encode($apiList);?>, // 需要检测的JS接口列表，所有JS接口列表见附录2,
                success: function(res) {
                    // 以键值对的形式返回，可用的api值true，不可用为false
                    // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
                    if (res.checkResult.onMenuShareQQ){
                        wx.onMenuShareQQ({
                            title: title, // 分享标题
                            desc: desc, // 分享描述
                            link: link, // 分享链接
                            imgUrl: imgUrl
                        });
                    }
                    if (res.checkResult.onMenuShareTimeline){
                        wx.onMenuShareTimeline({
                            title: title, // 分享标题
                            link: link, // 分享链接
                            imgUrl: imgUrl // 分享图标
                        });
                    }

                    if (res.checkResult.onMenuShareAppMessage){
                        wx.onMenuShareAppMessage({
                            title: title, // 分享标题
                            desc: desc, // 分享描述
                            link: link, // 分享链接
                            imgUrl: imgUrl, // 分享图标
                            type: 'link', // 分享类型,music、video或link，不填默认为link
                            dataUrl: '' // 如果type是music或video，则要提供数据链接，默认为空
                        });
                    }

                    if (res.checkResult.onMenuShareWeibo){
                        wx.onMenuShareWeibo({
                            title: title, // 分享标题
                            desc: desc, // 分享描述
                            link: link, // 分享链接
                            imgUrl: imgUrl // 分享图标
                        });
                    }

                    if (res.checkResult.onMenuShareQZone){
                        wx.onMenuShareQZone({
                            title: title, // 分享标题
                            desc: desc, // 分享描述
                            link: link, // 分享链接
                            imgUrl: imgUrl // 分享图标
                        });
                    }
                }
            });
        });
        $('#closeBtn').on('tap',function(){
            $('.layer-1').remove();
        });

        $('#shareBtn').on('tap',function(){
            $('.layer-2').show();
        });

        $('.layer-2').on('tap',function(){
            $(this).hide();
        });
    });
</script>
</body>
</html>