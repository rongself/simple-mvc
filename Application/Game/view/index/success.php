<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>领取skype通话卡</title>
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
    <div class="title"><img src="images/success.png" alt="" width="88.1%;"/></div>
    <?php if($this->message):?>
        <div class="info"><?php echo $this->message;?></div>
    <?php else:?>
        <?php if($this->cardNumber):?>
            <div class="info">skype兑换码：</div>
            <div class="info"><?php echo $this->cardNumber['id'];?></div>
        <?php else:?>
            <div class="info">慢了一步，skype国际通话卡已经送完</div>
        <?php endif;?>
    <?php endif;?>
    <div style="text-align: center;margin-top: 2rem;">
        <a href="http://4px.ronccc.com/?module=game&controller=index&action=use">如何使用</a>
    </div>
    <div class="btn" style="text-align: center"><img id="shareBtn" src="images/success_share_btn.png" alt="" width="78%"/></div>
    <div style="text-align: center;margin-top: 6%;font-size: 1.0rem;color: #DADADA;">本活动最终解释权归递四方速递所有</div>
</div>
<div class="layer-2" style="text-align: center;display: none;">
    <img src="images/p1_05.png" width="72.2%" alt="" style="margin-top: 9.2%;"/>
</div>
<?php $apiList = array('onMenuShareQQ', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQZone');?>
<script type="text/javascript" charset="utf-8">
    head.ready(function(){
        var title = '小手一抖，skype国际通话卡到手。<?php echo $this->user['nickname'];?>帮牛郎送的礼物只剩<?php echo $this->leftDistance;?>光年，快来帮忙！';
        var imgUrl = 'http://4px.ronccc.com/images/icon.png';
        var link = 'http://4px.ronccc.com/?module=game&controller=index&action=help&uid=<?php echo $this->user['id'];?>';
        var desc = '小手一抖，skype国际通话卡到手。<?php echo $this->user['nickname'];?>帮牛郎送的礼物只剩<?php echo $this->leftDistance;?>光年，快来帮忙！';

        wx.config(<?php echo $this->js->config($apiList, false, true) ?>);
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