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
            <!--<li><a href="/admin/staff_add">添加员工</a></li>-->
          </ul>
        </div>

      </div>

      <!--右侧开始-->
      <div class="layout-main">
        <div class="box">
          <div class="ui-table-row">
            <table id="tbbg" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr class="trhover">
                  <!--<td><span class="gray">客人名称</span></td>-->
                  <td><span class="gray">评分</span></td>
                  <td><span class="gray">评论</span></td>
                  <td><span class="gray">管理员回复</span></td>
                  <td><span class="gray">时间</span></td>
                  <td width="19%"><span class="gray">操作</span></td>
                </tr>

                <?php  foreach ($list as $index=>$item){?>
                  <tr class="<?=($index%2==0)?'t1':'t2'?>">
                    <!--<td title="姓名"><i class="pcm_pc"></i></td>-->
                    <td title="评分">
                      <?=round($item["star"],1)?></td>
                    <td title="评论" width="30%">
                      <?=(""!=$item["text"])?$item["text"]:"无"?>
                    </td>
                    <td width="30%"><?=(""!=$item["comment_admin"])?$item["comment_admin"]:"无"?></td>
                    <td><?=date("Y-m-d H:i:s",$item["time"])?></td>
                    <td>
                      <span class="ed" onclick="reply(<?=$item["id"]?>);">回复</span>
                      <span class="ed" onclick="del(<?=$item["id"]?>);">删除</span>
                    </td>
                  </tr>
                  <?php }?>

                    <?php if(count($list)==0){?>
                      <tr class="t1">
                        <td><b>没有相关记录!</b></td>
                      </tr>
                      <?php }?>

              </tbody>
            </table>

            <div>
              <?=$pager?>
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

  <div class="onlines">
    <div class="text"><span class="online_k">回复点赞</span><span class="close_online" onclick="close_online()"></span></div>
    <div stype="padding-left:100px;">
      <form id="comment_form">
        <div id="link_text">
          <textarea style="width:500px;height:200px;" name="comment" id="comment"></textarea>
        </div>
      </form>
    </div>
    <div class="ajax"></div>

    <div class="submit-box">
      <input id="submit_id" type="hidden" />
      <input name="submit" value="提交" tabindex="3" onclick="onSubmit(this)" type="submit" class="ufi-button" />
      <span style="display:none" id="loading"><img width="20" height="20" src="/images/loading.gif" alt=""></span>
      <span id="alert"><span>
    </div>
</div>

<script type="text/javascript">
var loading=false;
function del(id)
{
    if (loading==true)
    {
        return;
    }
    
    if(confirm('你确定要删除？')){
        loading=true;
        $.get("/admin/comment_del_req/"+id,function(data){
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

function reply(id)
{
    if (loading==true)
    {
        return;
    }
    
    $("#submit_id").val(id);
    var top = $(document).scrollTop()+(($(window).height()-460)/2);
    $(".onlines").css({"top":top});
    $('.onlines').show();
}

function close_online()
{
    $(".onlines").hide();
}

function onSubmit(button) 
{
    if (loading==true)
    {
        return;
    }
    loading = true;
    
    var comment_id = $("#submit_id").val();
    
    $(button).attr('disabled', "true");
    $("#loading").show();
    $("#alert").html("");
    $.post('/admin/commment_admin_req/'+comment_id, $("#comment_form").serialize(), function(data) {
        $(button).removeAttr("disabled");
        $("#loading").hide();
        $("#alert").html(data.msg);
        $("#comment").val("");
        if (data.ret==0)
        {
            $("#alert").css('color','#00ff00');
            setTimeout(function() {
                $("#alert").html("");
                $(".onlines").hide();
                location.reload();
            }, 1000);
        }
        else
        {
            $("#alert").css('color','#ff0000');
            setTimeout(function() {
                $("#alert").html("");
            }, 1500);
        }
        
        loading=false;
    },'json');
}
</script>

</body>


</html>