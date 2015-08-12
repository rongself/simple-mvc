<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/styles/default.css"/>
    <link rel="stylesheet" type="text/css" href="public/styles/default.css"/>
    <link rel="stylesheet" type="text/css" href="public/styles/default.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
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
<div class="main">
    <div class="title"></div>
    <div class="description">牛郎的礼物离织女<span style="color: #ffffff">100</span>光年</div>
    <div class="rainbow"></div>
    <div class="info">XXX接受了任务，表示一定准时完成</div>
    <div class="btn" style="text-align: center"><img src="images/btn1.png" alt="" width="78%"/></div>
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
<script type="text/javascript">
    head.ready(function(){
        $('#closeBtn').on('tap',function(){
            $('.layer-1').remove();
        });
    });
</script>
</body>
</html>