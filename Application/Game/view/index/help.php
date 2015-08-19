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
            'bower_components/zepto-full/zepto.min.js',
            'bower_components/json2/json2.js'
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
        <div class="btn join" style="text-align: center"><img src="images/to_help.png" alt="" width="78%"/></div>
    <?php else: ?>
        <div class="title"><img src="images/top.png" alt="" width="82.9%;"/></div>
        <div class="description" style="display: none;">在你的帮助下 <br/><br/>
            <?php echo $this->user['nickname'];?>帮牛郎送的礼物离织女又近了<span style="color: #ffffff">10</span>光年</div>
        <div class="rainbow" style="position: relative">
            <img src="images/ch_05.png" width="88.6%;" alt=""/>
            <img class="present" src="images/present.png" width="16.6%;" alt="" style="position: absolute;left:3rem;bottom:1rem;display: block;"/>
            <img class="girl" src="images/girl-angry.png" width="22.5%;" alt="" style="position: absolute;right: 2rem;bottom: 1rem;display: block;"/>
        </div>
        <div class="info"><?php echo $this->user['nickname'];?>已有<span class="num"><?php echo $this->helpedTimes;?></span>位好友帮助，距离完成还有<span class="left-distance" style="color: #ffffff"><?php echo $this->leftDistance;?></span>光年</div>
        <div class="btn" style="text-align: center;margin-top: 4rem"><img id="helpBtn" src="images/help_btn.png" alt="" width="78%"/></div>
        <div class="btn" style="text-align: center;margin-top: 2rem"><img id="joinBtn" src="images/to_help.png" alt="" width="78%"/></div>
    <?php endif; ?>

    <div class="footer">本活动物流赞助商：宇宙领先的递四方速递有限公司</div>
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
        <p>2.点击左下角【帮帮牛郎】
            进入游戏</p>
        <p>3.转发至朋友圈或微信群
            邀请好友一起帮忙</p>
        </div>
        <div style="text-align: center;width: 100%;position: absolute;bottom: -3rem;">
            <img class="close" src="images/close.png" alt=""/>
        </div>
    </div>
</div>
<script type="text/javascript">
    var step = [
        [[3,1],[2,1]],
        [[3,2],[4,3]],
        [[7,4],[6,4.2]],
        [[9,5],[8,5.2]],
        [[11,5],[9,5.5]],
        [[12,5],[4,3]]
    ];
    var totalDistance = <?php echo Application\Game\Model\HelpModel::TOTAL_DISTANCE ?: 100; ?>;
    var leftDistance = <?php echo $this->leftDistance ?: 100;?>;
    var move = function(leftDistance){
        var index = Math.floor((totalDistance - leftDistance)/(totalDistance/6));
        var position = step[index];
        $('.present').css({left:position[0][0]+'rem',bottom:position[0][1]+'rem'});
        $('.girl').css({right:position[1][0]+'rem',bottom:position[1][1]+'rem'});
    };
    head.ready(function(){
        $('.close').on('tap',function(){
            $('.layer-2').hide();
        });
        $('#joinBtn,.join').on('tap',function(){
            $('.layer-2').show();
        });
        //move(leftDistance);
        $('#helpBtn').on('tap',function(){
            alert();
//            var url = '/wechatsdk/public/index.php?module=game&controller=index&action=addHelp';
//            $.post(url,<?php //echo json_encode(array('uid'=>$this->user['id']))?>//,function(ret){
//                ret = JSON.parse(ret);
//                if(ret.success) {
//                    if(ret.leftDistance > 0) {
//                        var num = parseInt($('.info').children('span.num').text());
//                        $('.description').children('span').text(ret.distance);
//                        $('.description').fadeIn(300);
//                        $('.info').children('span.num').text(num+1);
//                        $('.info').children('span.left-distance').text(ret.leftDistance);
//                        move(ret.leftDistance);
//                    }else{
//                        location.href = 'http://examples.ronccc.com/wechatsdk/public/index.php?module=game&&uid=<?php //echo $this->user['id'];?>//';
//                    }
//                }else{
//                    alert(ret.message);
//                }
//            });
        });
    });
</script>
</body>
</html>