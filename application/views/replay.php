<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <title>感谢提交</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="/assets/i/favicon.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="/assets/i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="/assets/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
  <!--
  <link rel="canonical" href="http://www.example.com/">
  -->

  <link rel="stylesheet" href="/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="/assets/css/app.css">

</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a
  href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->



<!-- 页面内容 开发时删除 -->
<div class="am-g am-g-fixed am-margin-top">
   <form class="am-form"  id="thumb_form">
    <fieldset>
        <div class="am-form-group">
          <label for="doc-ta-1">回复<?=$to_name?>(最多500字):</label>
          <textarea name="text" class="" rows="5" id="replay_text"></textarea>
          <input name="wx_name" id="wx_name" type="hidden" value="<?=$wx_name?>" />          
        </div>
    </filedset>
  </form>
    <p><button type="button" class="am-btn am-btn-default" onclick="onSubmit(this);">提交</button></p>
</div>



<footer class="am-margin-top">
  <hr/>
  <p class="am-text-center">
    <!--<small>by The AmazeUI Team.</small>-->
  </p>
</footer>
<!-- 以上页面内容 开发时删除 -->

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/assets/js/amazeui.min.js"></script>

<script type="text/javascript">
function onSubmit(button) {
    var replayText = $("#replay_text").val();
    if (replayText=="")
    {
        alert("没有输入回复内容！");
        return;
    }
    
    if (replayText.length>999)
    {
        alert("输入字数超出最大限制！");
        return;
    }

    $(button).attr('disabled', "true");
    $.post('/staff/replay_req/<?=$comment_id?>/<?=$staff_id?>', $("#thumb_form").serialize(), function(data) {
        $(button).removeAttr("disabled");
        location='/staff/thumb_res/'+data+"/<?=$staff_id?>";
    });
}
</script>

</body>
</html>
