<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0034)http://my.jingzhunapp.com/?a=index -->
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
                  <li class="active"><a href="/admin/staff_list">员工列表</a></li>
                  <li><a href="/admin/staff_add">添加员工</a></li>
                </ul>
              </div>

          </div>
          
          <!--右侧开始-->
          <div class="layout-main">
            <div class="box">
                <div class="search">
                    <form name="cpform" method="get" id="search" action="/admin/staff_list/<?=$page?>">
                        <div class="condition">
                        姓名：
                        <input name="name" class="required" value="<?=$search_name?>">&nbsp; &nbsp; &nbsp;   
                        分店：
                        <select name="shop" id="">
                          <option value="">所有</option>
                          <?php foreach($shop_list as $row){?>
                          <option value="<?=$row['id']?>" <?=($row["id"]==$search_shop_id)?"selected":""?>><?=$row["name"]?></option>
                          <?php }?>
                        </select>
                        </div>
                        <div class="condition">
                        <input type="submit" value="查询" class="dia_btn">
                        </div>
                    </form>
                </div>
            
                  <div class="ui-table-row">
                      <table id="tbbg" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr class="trhover">
                                <td><span class="gray">姓名</span></td>
                                <td><span class="gray">所在分店</span></td>
                                <td><span class="gray">平均评分</span></td>
                                <td width="19%"><span class="gray">操作</span></td>
                              </tr>

                              <?php  foreach ($list as $index=>$item){?>
                              <tr class="<?=($index%2==0)?'t1':'t2'?>">
                                <td title="姓名"><?=$item["name"]?><i class="pcm_pc"></i></td>
                                <td title="所在分店"><?=$item["shop_name"]?><i class="pcm_pc"></i></td>
                                <td title="评分"><?=$item["star_avg"]?><i class="pcm_pc"></i></td>
                                <td>                  
                                  <span class="ed" onclick="edit(<?=$item["id"]?>);">编辑</span>
                                  <span class="ed" onclick="del(<?=$item["id"]?>);">删除</span>
                                </td>
                              </tr>
                              <?php }?>

                              <?php if(count($list)==0){?>
                                <tr class="t1"><td><b>没有相关记录!</b></td></tr>
                              <?php }?>

                            </tbody>
                    </table>

                    <div><?=$pager?></div><div class="clear"></div>        
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
    var loading=false;
    function del(id)
    {
      if (loading==true)
      {
        return; 
      }
      
      if(confirm('你确定要删除分店,删除后店里的员工将设置为无分店归属')){
        loading=true;
        $.get("/admin/staff_del_req/"+id,function(data){
          if (data!="0")
          {
            alert("删除失败，数据库异常");
            loading=false;
          }
          else
          {
            location.reload();
          }
        });
      }
    }

    function edit(id)
    {
      if (loading==true)
      {
        return;
      }
      
      location="/admin/staff_edit/"+id;
    }

  </script>

</body>


</html>