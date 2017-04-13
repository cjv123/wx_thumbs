<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0034)http://my.jingzhunapp.com/?a=index -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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
              <li><a href="#"></a></li>
            </ul>
        </div>
        <div class="toolbar" style="float:right">
            <ul>
            <li><a href="#">安全退出</a></li>
            </ul>
        </div>
    </div><div class="mainpage">
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
      </div><!--右侧开始--> 
<div class="layout-main">
    <div class="layout-block-header box ">
       <div class="info">
                
         <!--<h2 style="float:left;">账户概况</h2><span style="float:left; margin-left:10px;"></span>-->
       </div>
       <div class="overviewoptimizeadvice index_gk">
            <table width="100%" border="0">
            <tbody>
                <tr class="t2">
                <!--<td width="10%" class="t3">账户类型:<td>-->
                </tr>
            </tbody>
            </table>
            
       </div>
    </div>
    <div class="box">
        <h3>标题</h3>    
        <div class="ui-table-row">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="t5" >
                    <!-- <form name="form" method="post" action="/?a=index" >
                         <div class="search">
                            <span>单日访客：</span>
                            <input type="text" class="Wdate ipt" readonly name="canvas_day" value="2015-04-18" readonly="readonly" onclick="WdatePicker({minDate:'2015-03-20',maxDate:'%y-%M-%d'})"><input type="submit" value="查看" class="ufi-button bt" style="height:25px;"/>
                         </div>
                    </form> -->
                    </td>
                    <td class="lj t4" width="18%" style="text-align:center;text-indent:0px;"></td>
                 </tr>
            </table> 
                 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr><td class="t5"><div id="index_canvas" style="text-align:center"><canvas id="myChart" width="800" height="373"></canvas></div></td></tr>
          </table>
        </div>

    </div>
</div>
<!--右侧结束-->
</div>
</div>

<!--底部开始-->
<div class="footer"><p></p></div>

<div class="jq_tsc"></div>


</body></html>