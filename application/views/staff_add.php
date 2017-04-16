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
        <li class="active"><a href="#">员工</a></li>
        <li><a href="#">分店</a></li>
        <li><a href="#">后台管理员</a></li>
        <li>
          <a href="#"></a>
        </li>
      </ul>
    </div>
    <div class="toolbar" style="float:right">
      <ul>
        <li><a href="#">安全退出</a></li>
      </ul>
    </div>
  </div>
  <div class="mainpage">
    <div class="contant">
      <!--左侧开始-->
      <div class="layout-sidebar">
        <div class="box">
          <ul class="ui-list leftclick">
            <li class="active"><a href="#">添加员工</a></li>
            <li><a href="#">员工列表</a></li>
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
          <h3>添加员工</h3>
          <div class="ui-table-row">
            <form action="" id="staff_form">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="t1">
                  <td width="70"><span class="title">姓名</span></td>
                  <td width="650">
                    <input name="name" type="text" class="input text2" value="" placeholder="最多20个汉字" maxlength="20">
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu"></span></td>
                </tr>
                <tr class="t1">
                  <td width="70"><span class="title">职位</span></td>
                  <td width="650">
                    <input type="text" name="job" class="input text2" value="" placeholder="最多20个汉字" maxlength="20">
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu"></span></td>
                </tr>
                <tr class="t1">
                  <td width="70"><span class="title">所在分店</span></td>
                  <td width="650">
                    <select name="" id="">
                      <option value=""></option>
                    </select>
                  </td>
                  <td style="vertical-align:inherit"><span class="zhu"></span></td>
                </tr>
              </table>
            </form>
            <div class="submit-box">
              <input name="submit" value="确定保存" tabindex="3" onclick="onSubmit(this)" type="submit" class="ufi-button" />
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
      $.post('/admin/staff_add_req', $("#staff_form").serialize(), function(data) {
        $(button).removeAttr("disabled");
        alert(data);
      });
    }
  </script>

</body>


</html>