<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <title>管理后台</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
  <link rel="stylesheet" type="text/css" href="/css/page.css">
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
        <li><a href="/admin/admin_update">后台管理员</a></li>
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
                  <li><a href="/admin/staff_add">添加员工</a></li>
                  <li class="active"><a href="/admin/qrcode_download">下载二维码</a></li>
                </ul>
              </div>

          </div>
          
          <!--右侧开始-->
          <div class="layout-main">
            <div class="box">
                  <div class="ui-table-row">
                      <table id="tbbg" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="t1"><td>下载包，点击下载</td></tr>
                            <tbody>
                              <?php  foreach ($list as $index=>$item){?>
                              <tr class="t2">
                                <td><a href="/download/<?=$item?>"><?=$item?></a></td>
                              </tr>
                              <?php }?>
                              <?php if(count($list)==0){?>
                                <tr class="t1"><td><b>还没有生成下载包</b></td></tr>
                              <?php }?>
                            </tbody>
                    </table>
                    <div class="condition">
                        <input type="submit" value="生成下载包" class="dia_btn">
                    </div>
                    <div class="clear"></div>        
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
   
  </script>

</body>


</html>