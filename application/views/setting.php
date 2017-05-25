<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <title>管理后台</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
  <script src="/js/jquery-1.6.4.min.js" type="text/javascript"></script>
  <script src="/js/Chart.min.js" type="text/javascript"></script>
</head>

<body>
  <!--顶部开始-->
  <div class="header">
    <div class="logo">
    </div>
    <div class="toolbar">
      <ul>
        <li><a href="/admin/staff_list">员工</a></li>
        <li><a href="/admin/shop_list">分店</a></li>
        <li class="active" ><a href="/admin/setting">设置</a></li>
        <li>
          <a href="#"></a>
        </li>
      </ul>
    </div>
    <div class="toolbar" style="float:right">
      <ul>
        <li><a href="/admin/logout">安全退出</a></li>
      </ul>
    </div>
  </div>
  <div class="mainpage">
    <div class="contant">
      <!--左侧开始-->
      <div class="layout-sidebar">
        <div class="box">
          <ul class="ui-list leftclick">
            <li class="active"><a href="/admin/shop_list">设置</a></li>
            <li><a href="/admin/admin_update">管理员密码</a></li>
          </ul>
        </div>

        <!--<div class="box">
<h3>帮助</h3>
<ul class="ui-list">
<li><a href="#">客服热线：</a></li>
</ul>
</div>-->
      </div>
      <!--右侧开始-->
      <div class="layout-main">

        <div class="box">
          <h3>设置</h3>
          <div class="ui-table-row">
            <form id="set_form" action="/admin/setting_save" target="action_frame" method="post" enctype="multipart/form-data">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="t1">
                  <td width="70"><span class="title">欢迎字符</span></td>
                  <td width="650">
                    <input name="welcome" id="welcome" type="text" class="input text2" value="<?=$welcome?>" placeholder="最多50个汉字" maxlength="100">
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu"></span></td>
                </tr>
                <tr class="t1">
                  <td width="80"><span class="title">点赞次数限制</span></td>
                  <td width="650">
                    <input name="thumb_limit" id="thumb_limit" type="text" class="input text2" value="<?=$thumb_limit?>" placeholder="只能填写数字" maxlength="10">
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu"></span></td>
                </tr>
                <tr class="t1">
                  <td width="70"><span class="title">点赞页背景</span></td>
                  <td>
                    <input type="file" name="thumb_bg" id="thumb_bg" />  
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu">建议图片分辨率:640*1136</span></td>
                </tr>
                <tr class="t1" id="bg_img">
                  <td width="70"><span class="title">背景预览</span></td>
                  <td width="650">
                      <?php if($thumb_bg){?>
                      <img src="/header/<?=$thumb_bg?>" alt="" width="320" height="568">
                      <input type="button" value="删除背景" onclick="del()" />
                      <?php }?>
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu"></span></td>
                </tr>
                      <input type="hidden" name="del_bg" value="0" id="del_bg_id" />
              </table>
            </form>
            <div class="submit-box">
              <iframe src="" width="0" height="0" frameborder="0" name="action_frame"></iframe>
              <input name="submit" id="submit" value="确定保存" tabindex="3" onclick="onSubmit(this)" type="submit" class="ufi-button" />
              <span style="display:none" id="loading"><img width="20" height="20" src="/images/loading.gif" alt=""></span>
              <span id="alert"><span>
            </div>
          </div>

        </div>
      </div>
      <!--右侧结束-->
    </div>
  </div>

  <!--底部开始-->
  <div class="footer">
    <p></p>
  </div>

  <div class="jq_tsc"></div>

  <script type="text/javascript">
    function onSubmit(button) {
      $(button).attr('disabled', "true");
      $("#loading").show();
      $("#alert").html("");
      $("#set_form").submit();
    }

    function del(){
      $("#del_bg_id").val("1");
      $("#bg_img").remove();
    }
  </script>

</body>


</html>