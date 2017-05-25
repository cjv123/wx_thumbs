<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0034)http://my.jingzhunapp.com/?a=index -->
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
        <li class="active"><a href="/admin/staff_list">员工</a></li>
        <li><a href="/admin/shop_list">分店</a></li>
        <li><a href="/admin/setting">设置</a></li>
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
            <li><a href="/admin/staff_list">员工列表</a></li>
            <li class="active"><a href="/admin/staff_add">添加员工</a></li>
            <li><a href="/admin/qrcode_download">下载二维码</a></li>
          </ul>
        </div>


      </div>
      <!--右侧开始-->
      <div class="layout-main">

        <div class="box">
          <h3>添加员工</h3>
          <div class="ui-table-row">
            <form action="/admin/staff_add_req" target="action_frame" id="staff_form" method="post" enctype="multipart/form-data">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="t1">
                  <td width="70"><span class="title">头像</span></td>
                  <td width="650">
                   <input type="file" name="head" id="file" />  
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu">建议100*100小于100k的图片文件</span></td>
                </tr>

                <tr class="t1">
                  <td width="70"><span class="title">姓名</span></td>
                  <td width="650">
                    <input name="name" id="name" type="text" class="input text2" value="" placeholder="最多20个汉字" maxlength="40">
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu">*</span></td>
                </tr>

                <tr class="t1">
                  <td width="70"><span class="title">性别</span></td>
                  <td width="650">
                    <input name="sex" type="radio" value="0" checked />男 &nbsp;
                    <input name="sex" type="radio" value="1" />女
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu">*</span></td>
                </tr>

                <tr class="t1">
                  <td width="70"><span class="title">职位</span></td>
                  <td width="650">
                    <input type="text" name="job" class="input text2" value="" placeholder="最多20个汉字" maxlength="40">
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu"></span></td>
                </tr>
                <tr class="t1">
                  <td width="70"><span class="title">所在分店</span></td>
                  <td width="650">
                    <select name="shop" id="">
                      <?php foreach($shop_list as $shop){?>
                      <option value="<?=$shop['id']?>">
                        <?=$shop["name"]?>
                      </option>
                      <?php }?>
                    </select>
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu"></span></td>
                </tr>
              </table>
            </form>
            <div class="submit-box">
              <iframe src="" width="0" height="0" frameborder="0" name="action_frame"></iframe>
              <input id="submit" name="submit" value="确定保存" tabindex="3" onclick="onSubmit(this)" type="submit" class="ufi-button" />
              <span style="display:none" id="loading"><img width="20" height="20" src="/images/loading.gif" alt=""></span>
              <span id="alert"><span>
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
      $("#staff_form").submit();
    }
    </script>

  </body>


  </html>