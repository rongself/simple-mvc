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
            'bower_components/zeptotouch/zepto-touch.min.js',
            'bower_components/json2/json2.js'
        );
    </script>
    <link rel="stylesheet" href="bower_components/reset-css/reset.css"/>
    <link rel="stylesheet" href="styles/default.css?v=1.0"/>
</head>
<body class="bg">
<div class="main">
    <?php if ($this->isSuccess) :?>
        <div class="title"><img src="images/success.png" alt="" width="88.1%;"/></div>
        <div class="info"><?php echo $this->user['nickname'];?>已成功帮助牛郎，获得skype国际通话卡</div>
        <div class="info">(注:进入公众号点击“领取skype通话卡”领取奖励)</div>
        <div class="btn join" style="text-align: center"><img src="images/to_help.png" alt="" width="78%"/></div>
    <?php else: ?>
        <div class="title"><img src="images/top.png" alt="" width="82.9%;"/></div>
        <div class="description" style="display: none;">在你的帮助下 <br/><br/>
            <?php echo $this->user['nickname'];?>帮牛郎送的礼物离织女又近了<span style="color: #ffffff">0</span>光年</div>
        <div class="rainbow" style="position: relative">
            <img src="images/ch_05.png" width="88.6%;" alt=""/>
            <img class="present" src="images/present.png" width="16.6%;" alt="" style="position: absolute;display: block;"/>
            <img class="girl" src="images/girl-angry.png" width="22.5%;" alt="" style="position: absolute;display: block;"/>
        </div>
        <div class="info"><?php echo $this->user['nickname'];?>已有<span class="num"><?php echo $this->helpedTimes;?></span>位好友帮助，距离完成还有<span class="left-distance" style="color: #ffffff"><?php echo $this->leftDistance;?></span>光年</div>
        <div class="btn" style="text-align: center;margin-top: 4rem"><img id="helpBtn" src="images/help_btn.png" alt="" width="78%"/></div>
        <div class="btn" style="text-align: center;margin-top: 2rem"><img id="joinBtn" src="images/to_help.png" alt="" width="78%"/></div>
    <?php endif; ?>

    <div class="footer">本活动最终解释权归递四方速递所有</div>
</div>
<div class="layer-1" style="display: none;">
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
    <div class="tip-box" style="position: relative">
        <h2 style="font-size: 3.2rem;padding-top: 1rem;">仅需2步</h2>
        <div style="font-size: 2.2rem;text-align: left;padding: 2rem;line-height: 2.5rem;">
        <p>1.关注递四方官方服务号
            （微信号：disifang）</p>
        <p>2.进入服务号后台回复关键字“帮帮牛郎”</p>
        <p>3.转发至朋友圈或微信群
            邀请好友一起帮忙</p>
        </div>
        <div style="text-align: center;width: 100%;position: absolute;bottom: -3rem;">
            <img class="close" src="images/close.png" alt=""/>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php $apiList = array('onMenuShareQQ', 'onMenuShareWeibo','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQZone');?>
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

        var step = [
            [[3,2],[4,3]],
            [[7,4],[6,4.2]],
            [[9,5],[8,5.2]],
            [[9,4],[8,5]],
            [[11,5],[9,5.5]]
        ];
        var totalDistance = <?php echo Application\Game\Model\HelpModel::TOTAL_DISTANCE ?: 100; ?>;
        var leftDistance = <?php echo $this->leftDistance ?: 100;?>;
        var move = function(leftDistance){
            var index = Math.floor(((totalDistance - leftDistance)/(totalDistance/4)));
            var position = step[index];
            if(position){
                $('.present').css({left:position[0][0]+'rem',bottom:position[0][1]+'rem'});
                $('.girl').css({right:position[1][0]+'rem',bottom:position[1][1]+'rem'});
            }
        };
        move(totalDistance);
        $('#helpBtn').on('tap',function(){
            var url = '/?module=game&controller=index&action=addHelp';
            $.post(url,<?php echo json_encode(array('uid'=>$this->user['id']))?>,function(ret){
                ret = JSON.parse(ret);
                if(ret.success) {
                    if(ret.leftDistance > 0) {
                        var num = parseInt($('.info').children('span.num').text());
                        $('.description').children('span').text(ret.distance);
                        $('.description').show();
                        $('.info').children('span.num').text(num+1);
                        $('.info').children('span.left-distance').text(ret.leftDistance);
                        move(ret.leftDistance);
                    }else{
                        location.href = '/?module=game&&uid=<?php echo $this->user['id'];?>';
                    }
                }else{
                    alert(ret.message);
                }
            });
        });
        $('.close').on('tap',function(){
            $('.layer-2').hide();
        });
        $('#joinBtn,.join').on('tap',function(){
            $('.layer-2').show();
        });
    });
</script>
</body>
</html>