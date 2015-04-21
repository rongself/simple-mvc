<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <title>sdk test</title>
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
<body>
<!--<div class="wrapper">-->
<!--    <a class="touchBtn" id="touchBtn" href="javascript:void(0);">-->
<!--        Touch Me!-->
<!--    </a>-->
<!--</div>-->
<?php foreach($this->books as $book):?>
    <?php /**@var $book \WebSpider\KindleMiEbook */?>
    <p>
        <img src="<?php echo $book->getImage();?>" alt="" width="200"/><br/>
        <a href="<?php echo $book->getLink();?>"><?php echo $book->getName();?></a>
    </p><br/>
<?php endforeach; ?>
<script type="text/javascript">
    head.ready(function(){
        var localId;
        var isRecording = false;
        wx.config({
            debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?php echo $this->appId;?>', // 必填，公众号的唯一标识
            timestamp:'<?php echo $this->timestamp;?>' , // 必填，生成签名的时间戳
            nonceStr: '<?php echo $this->nonceStr;?>', // 必填，生成签名的随机串
            signature: '<?php echo $this->signature;?>',// 必填，签名，见附录1
            jsApiList: ['startRecord','stopRecord','playVoice'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });

        wx.ready(function(){
            $('#touchBtn').on({
                'tap':function(){
                    if(isRecording===false){
                        wx.startRecord();
                        isRecording = true;
                    }else{
                        wx.stopRecord({
                            success: function (res) {
                                localId = res.localId;
                                wx.playVoice({
                                    localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
                                });
                            }
                        });
                        isRecording = false;
                    }
                }
            });
        });

        wx.error(function(res){
            console.log(res);
        });
    });
</script>
</body>
</html>