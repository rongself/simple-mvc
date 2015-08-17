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
    <div class="title"><img src="images/success.png" alt="" width="88.1%;"/></div>
    <?php if($this->cardNumber):?>
        <div class="info">skype兑换码：<?php echo $this->cardNumber['id'];?></div>
    <?php else:?>
        <div class="info">慢了一步，skype国际通话卡已经送完</div>
    <?php endif;?>
    <div style="text-align: center;margin-top: 2rem;">
        <a href="http://examples.ronccc.com/wechatsdk/public/index.php?module=game&controller=index&action=use">如何使用</a>
    </div>
    <div class="btn" style="text-align: center"><img id="shareBtn" src="images/success_share_btn.png" alt="" width="78%"/></div>
    <div style="text-align: center;margin-top: 6%;color: #ffffff;   ">本活动物流赞助商：宇宙领先的递四方速递有限公司</div>
</div>
<div class="layer-2" style="text-align: center;display: none;">
    <img src="images/p1_05.png" width="72.2%" alt="" style="margin-top: 9.2%;"/>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<?php $apiList = array('onMenuShareQQ', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQZone');?>
<script type="text/javascript" charset="utf-8">
    var title = '帮帮牛郎';
    var imgUrl = 'http://examples.ronccc.com/wechatsdk/public/images/icon.png';
    var link = 'http://examples.ronccc.com/wechatsdk/public/index.php?module=game&uid=<?php echo $this->user['id'];?>';
    var desc = 'XXX';

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
    head.ready(function(){
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