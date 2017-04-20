<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <title>点赞</title>

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

  <style type="text/css">
  a,img{border:0;}
  img{vertical-align:middle;}
  #QuacorGrading input{background:url(/images/grading.png) no-repeat scroll right center;cursor:pointer;height:30px;width:30px;padding:0;border:0;}
  #QuacorGrading span{position: relative;top:5px;}
  #starimg{background:url(/images/grading.png) no-repeat scroll right center;
    cursor:pointer;height:30px;width:30px;padding:0;border:0;background-position:left center}
  </style>

</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a
  href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<!-- 页面内容 开发时删除 -->
<div class="am-g am-g-fixed am-margin-top">
  <div class="am-u-sm-12">
    <h1>您好,<?=$wx_name?></h1>
    <h2>欢迎您对我们的员工进行点赞!</h1>

    <h2>您正在评价是<font color="red"><b>“<?=$name?>”</b></font><h2>
  </div>

  <div id="QuacorGrading" class="am-u-sm-12">
    <h2>请打出您的分数：</h2>
    <input name="1" type="button" value="1" onclick="onclickstar(this)"/>
    <input name="2" type="button" value="2" onclick="onclickstar(this)"/>
    <input name="3" type="button" value="3" onclick="onclickstar(this)"/>
    <input name="4" type="button" value="4" onclick="onclickstar(this)"/>
    <input name="5" type="button" value="5" onclick="onclickstar(this)"/>

    <span id="QuacorGradingValue"><b><font size="5" color="#fd7d28">3</font></b>分</span>
    
  </div>
  
  <form method="post" class="am-form" action="/staff/thumb_req/<?=$staff_id?>" id="thumb_form">
    <fieldset>
        <div class="am-form-group">
          <label for="doc-ta-1">评论文字(最多500字,可不填写):</label>
          <textarea name="text" class="" rows="5" id="doc-ta-1"></textarea>
          <input name="star" id="thumb_value" type="hidden" value="3" />          
        </div>
    </filedset>
    <p><button type="submit" class="am-btn am-btn-default" onclick="">提交</button></p>
  </form>

  <hr>

  <ul class="am-comments-list">
    <?php foreach($list as $row){ ?>
    <li class="am-comment">
      <a href="#link-to-user-home">
      </a>
      <div class="am-comment-main">
        <header class="am-comment-hd">
          <div class="am-comment-meta">
            <a href="#link-to-user" class="am-comment-author"></a> 点赞 
            <time datetime="<?=date("Y-m-d H:i:s",$row['time'])?>" title="<?=date("Y-m-d H:i:s",$row['time'])?>"><?=date("Y-m-d H:i:s",$row['time'])?></time>
          </div>
        </header>
        <div class="am-comment-bd">
          <div>
            <?php 
            for($i=0;$i<5;$i++)
            { 
              if ($i<intval($row["star"]))
              {
                echo "<input id='starimg' type='button'/>";
              }
              else
              {
                echo "<input id='starimg' type='button' style='background-position:right center'  />";
              }
            }
            ?>
            
          </div>
          <p><?=$row['text']?></p>
          <?php if($row["comment_admin"]){?>
          <blockquote>店长回复:<?=$row["comment_admin"]?></blockquote>
          <?php }?>
        </div>
      </div>
    </li>
    <?php }?>
  </ul>
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
  var GradList = document.getElementById("QuacorGrading").getElementsByTagName("input");

  for(var di=0;di<parseInt(document.getElementById("QuacorGradingValue").getElementsByTagName("font")[0].innerHTML);di++){
    GradList[di].style.backgroundPosition = 'left center';
  }

  for(var i=0;i < GradList.length;i++){
    GradList[i].onmouseover = function(){
      for(var Qi=0;Qi<GradList.length;Qi++){
        GradList[Qi].style.backgroundPosition = 'right center';
      }
      for(var Qii=0;Qii<this.name;Qii++){
        GradList[Qii].style.backgroundPosition = 'left center';
      }
      document.getElementById("QuacorGradingValue").innerHTML = '<b><font size="5" color="#fd7d28">'+this.name+'</font></b>分';
    }
  }
  

  function onclickstar(button)
  {
    $("#thumb_value").val($(button).val());
  }
  
    
</script>

</body>
</html>
