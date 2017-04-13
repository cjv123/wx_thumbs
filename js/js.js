//登录
function login(){
	var $username = $("#username").attr("value");
	var $userpass = $("#userpass").attr("value");
    if ($username==''){
		alert('用户名不能为空');
	}else if($userpass==''){
		alert('密码不能为空');
	}else{
	                          $('#logins').html('登录中...');
							  $.ajax({
                                    url : '/?a=login&m=action&d=true&action=login',
		                            data:{username:$username,userpass:$userpass},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									//cache:false,
									//timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    $('#logins').html('登录成功');
											location.href = "/?a=index";
										}else if (data.htm!=''){
											alert(''+data.htm+'');
											$('#logins').html('登录');
										}else{
										    alert('登录失败，请重新登录');
											$('#logins').html('登录');
										}
                                    },
									error:function(){
											alert('登录失败，请重新登录');
											$('#logins').html('登录');
									}
                              });		
	}
}
//封装提示层 刷新本页
function jq_tsc($text){
         var top = $(document).scrollTop()+(($(window).height()-45)/2);
         $(".jq_tsc").css({"top":top});
		 $('.jq_tsc').html($text);
		 $(".jq_tsc").fadeIn(300);
		 setTimeout(function (){$(".jq_tsc").fadeOut(300,function (){location.reload();});},1500);
}
//封装提示层 无刷新
function jq_tscn($text){
         var top = $(document).scrollTop()+(($(window).height()-45)/2);
         $(".jq_tsc").css({"top":top});
		 $('.jq_tsc').html($text);
		 $(".jq_tsc").fadeIn(300);
		 setTimeout(function (){$(".jq_tsc").fadeOut(300);},1500);
}
//封装提示层 跳转URL
function jq_tscu($text,$url){
         var top = $(document).scrollTop()+(($(window).height()-45)/2);
         $(".jq_tsc").css({"top":top});
		 $('.jq_tsc').html($text);
		 $(".jq_tsc").fadeIn(300);
		 setTimeout(function (){$(".jq_tsc").fadeOut(300,location.href = ''+$url+'');},1500);
}
//保存COOKIE
function _WWWSET_(c_name,value,expiredays) { 
var exdate=new Date();
exdate.setTime(exdate.getTime()+expiredays*1000);
document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString())+";path=/"; 
}
//读取COOKIE
function _WWWGET_(c_name) {  
if (document.cookie.length>0)  
{  
c_start=document.cookie.indexOf(c_name + "=");  
if (c_start!=-1)  
{   
c_start=c_start + c_name.length+1 ;  
c_end=document.cookie.indexOf(";",c_start); 
if (c_end==-1) c_end=document.cookie.length;  
return unescape(document.cookie.substring(c_start,c_end));  
}   
}  
return ""; 
}
//验证手机号码是否正确
function checkmobile(mobile){  
	         if(!(/^((13[0-9])|(14[0-9])|(18[0-9])|(15[0-3,5-9])|(17[0,6-8]))\d{8}$/.test(mobile))){
		         return false;
	         }else{
		         return true;
	         }   
}
//管理首页 个性设置
function index_set(){
	     var $set_page = $("#set_page  option:selected").val();
	     var $set_remind = $("#set_remind  option:selected").val();
		 _WWWSET_('jz_page',$set_page,'315360000');
		 _WWWSET_('jz_rem',$set_remind,'315360000');
		 jq_tsc('保存成功!');
}
//管理首页 密码修改
function index_pass(){
	     var $oldpass = $("#oldpass").attr("value");
		 var $newpass = $("#newpass").attr("value");
		 var $newpasst = $("#newpasst").attr("value");
		 if ($oldpass==''){
			 jq_tscn('旧密码不能为空!');
		 }else if ($newpass==''){
			 jq_tscn('新密码不能为空!');
		 }else if ($newpasst==''){
			 jq_tscn('确认密码不能为空!');
		 }else if ($newpasst!=$newpass){
			 jq_tscn('新密码与确认密码不同!');
		 }else{
			 $('#index_pass').html('密码修改中...');
			 $.ajax({
                                    url : '/?a=action&d=true&action=index_pass',
		                            data:{oldpass:$oldpass,newpass:$newpass},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('密码修改成功!');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#index_pass').html('确定保存');
										}else{
										    jq_tscn('密码修改失败!');
											$('#index_pass').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('密码修改失败!');
											$('#index_pass').html('确定保存');
									}
                              });
		 }
}
//关闭消息提示层
function close_message(){
	 $('#message').hide();
}
$(function(){
	// $('<audio id="chatAudio"><source src="/theme/message.mp3" type="audio/mpeg"></audio>').appendTo('body');
	// if (_WWWGET_('jz_rem')==''){
	// get_message();
	// }
});
function get_message(){ if (_WWWGET_('jz_remt')==''){				
			                $.ajax({
                                    url : '/?a=action&action=message',
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.N!='0'){
										    //$('#messageTitle').html(data.Title);
											//$('#messageIntro').html(data.Intro);
											//$('#messageMore').html(data.More);
											$('#messageN').html(data.N);
											$('#message').show();
											$('#chatAudio')[0].play();
											_WWWSET_('jz_remt','1','300');
											_WWWSET_('jz_remn',data.N,'300');
										}else{
											$('#message').hide();
										}
                                    }
                              });
                          }else if (_WWWGET_('jz_remn')!=''){
							  $('#messageN').html(_WWWGET_('jz_remn'));
							  $('#message').show();
						  }
							  // setTimeout("get_message()",10000);
}
//附件图片上传
KindEditor.ready(function(K) {
				editor = K.create('textarea[name="textarea_1"]', {
					emoticonsPath:'http://pic.jingzhunapp.com/kindeditor/plugins/emoticons/images/',
					allowImageRemote: false,						
					height: 200,
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
				'source','clearhtml','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link'],
					afterBlur: function () { this.sync(); }
				});
				editor = K.create('textarea[name="textarea_2"]', {
					emoticonsPath:'http://pic.jingzhunapp.com/kindeditor/plugins/emoticons/images/',
					allowImageRemote: false,						
					height: 200,
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
				'source','clearhtml','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link'],
					afterBlur: function () { this.sync(); }
				});
				editor = K.create('textarea[name="textarea_3"]', {
					emoticonsPath:'http://pic.jingzhunapp.com/kindeditor/plugins/emoticons/images/',
					allowImageRemote: false,						
					height: 200,
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
				'source','clearhtml','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link'],
					afterBlur: function () { this.sync(); }
				});
				editor = K.create('textarea[name="tuijian"]', {
					emoticonsPath:'http://pic.jingzhunapp.com/kindeditor/plugins/emoticons/images/',
					allowImageRemote: false,						
					height: 200,
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
				'source','clearhtml','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link'],
					afterBlur: function () { this.sync(); }
				});
											
				K('#shoplogo_but').click(function() {
					var editor = K.editor({
					   allowFileManager : true
				    });
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#shoplogo').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#shoplogo').val(url);
								editor.hideDialog();
							}
						});
					});
				});	
				
				K('#w_thum_but').click(function() {
					var editor = K.editor({
					   allowFileManager : true
				    });
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#w_thum').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#w_thum').val(url);
								editor.hideDialog();
							}
						});
					});
				});
				
				K('#w_top_but').click(function() {
					var editor = K.editor({
					   allowFileManager : true
				    });
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#w_top').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#w_top').val(url);
								editor.hideDialog();
							}
						});
					});
				});
				
				K('#w_bot_but').click(function() {
					var editor = K.editor({
					   allowFileManager : true
				    });
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#w_bot').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#w_bot').val(url);
								editor.hideDialog();
							}
						});
					});
				});
				
				K('#w_youhui_but').click(function() {
					var editor = K.editor({
					   allowFileManager : true
				    });
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#w_youhui').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#w_youhui').val(url);
								editor.hideDialog();
							}
						});
					});
				});
			
});
//KindEditor 封装
function K_editor($te){
		    	KindEditor.create('textarea[name="'+$te+'"]', {
				    emoticonsPath:'http://pic.jingzhunapp.com/kindeditor/plugins/emoticons/images/',
			        allowImageRemote: false,
					height: 300,
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
				'source','clearhtml','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image','multiimage', 'link'],
					afterBlur: function () { this.sync(); }
				});		
};
//商家中心 基本信息
function shop_set(){
	     var $shopname = $("#shopname").attr("value");
		 var $sms = $("#sms").attr("value");
		 var $shoplogo = $("#shoplogo").attr("value");
		 var $waphost = $("#waphost").attr("value");
		 var $boxname = $("#boxname").attr("value");
		 var $boxmobile = $("#boxmobile").attr("value");
		 var $opername = $("#opername").attr("value");
		 var $opermobile = $("#opermobile").attr("value");
		 var $operqq = $("#operqq").attr("value");
		 if ($shopname==''){
			 jq_tscn('商家名称不能为空!');
		 }else if ($shoplogo==''){
			 jq_tscn('商家LOGO不能为空!');
		 }else{
			 $('#shop_set').html('资料提交中...');
			 $.ajax({
                                    url : '/?a=action&d=true&action=shop_set',
		                            data:{shopname:$shopname,sms:$sms,shoplogo:$shoplogo,waphost:$waphost,boxname:$boxname,boxmobile:$boxmobile,opername:$opername,opermobile:$opermobile,operqq:$operqq},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('资料提交成功!');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#shop_set').html('确定保存');
										}else{

										    jq_tscn('资料提交失败!');
											$('#shop_set').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('资料提交失败!');
											$('#shop_set').html('确定保存');
									}
                              });
		 }
}
//商家中心 基本信息
function m_set(){
	         var $code = $("#code").attr("value");
			 var $state = $("#state option:selected").val();
			 $('#m_set').html('资料提交中...');
			 $.ajax({
                                    url : '/?a=action&d=true&action=m_set',
		                            data:{code:$code,state:$state},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('资料提交成功!');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#m_set').html('确定保存');
										}else{

										    jq_tscn('资料提交失败!');
											$('#m_set').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('资料提交失败!');
											$('#m_set').html('确定保存');
									}
                              });
}
//商家中心 部门管理
function shop_depedit($id){
	     var $depname = $("#depname").attr("value");
		 if ($depname==''){
			 jq_tscn('部门名称不能为空!');
		 }else{
			 $('#shop_depedit').html('资料提交中...');
			 $.ajax({
                                    url : '/?a=action&d=true&action=shop_depedit',
		                            data:{id:$id,depname:$depname},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tscu('资料提交成功!','/?a=shop&m=dep');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#shop_depedit').html('确定保存');
										}else{
										    jq_tscn('资料提交失败!');
											$('#shop_depedit').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('资料提交失败!');
											$('#shop_depedit').html('确定保存');
									}
                              });
		 }
}
//商家中心 员工管理
function shop_empedit($id){
	     var $depid = $("#depid option:selected").val();
		 var $state = $("#state option:selected").val();
		 var $mlink = $("#mlink option:selected").val();
		 var $empname = $("#empname").attr("value");
		 var $empcode = $("#empcode").attr("value");
		 var $empmobile = $("#empmobile").attr("value");
		 var $emppass = $("#emppass").attr("value");
		 if ($depid==''){
			 jq_tscn('请选择所在部门!');
		 }else if ($empname==''){
			 jq_tscn('员工姓名不能为空!');
		 }else if (!checkmobile($empmobile) && $empmobile!=''){
			 jq_tscn('请输入正确的手机号!');
		 }else{
			 $('#shop_empedit').html('资料提交中...');
			 $.ajax({
                                    url : '/?a=action&d=true&action=shop_empedit',
		                            data:{id:$id,depid:$depid,empname:$empname,empcode:$empcode,empmobile:$empmobile,emppass:$emppass,state:$state,mlink:$mlink},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tscu('资料提交成功!','/?a=shop&m=emp');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#shop_empedit').html('确定保存');
										}else{
										    jq_tscn('资料提交失败!');
											$('#shop_empedit').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('资料提交失败!');
											$('#shop_empedit').html('确定保存');
									}
                              });
		 }
}
//商家中心 员工管理 删除
function shop_empdel($id){
			 $.ajax({
                                    url : '/?a=action&d=true&action=shop_empdel',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('员工删除成功!');
										}else{
										    jq_tsc('员工删除失败!');
										}
                                    },
									error:function(){
											jq_tsc('员工删除失败!');
									}
                              });
}
//商家中心 部门管理 删除
function shop_depdel($id){
			                $.ajax({
                                    url : '/?a=action&d=true&action=shop_depdel',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('部门删除成功!');
										}else if (data.htm!=''){
											jq_tsc(data.htm);
										}else{
										    jq_tsc('部门删除失败!');
										}
                                    },
									error:function(){
											jq_tsc('部门删除失败!');
									}
                              });
}
//微信推广 导航设置 第一步
function weixin_nav($id){
	                  var $name = $("#name").attr("value");
					  var $beizhu = $("#beizhu").attr("value");
					  if ($name==''){
			              jq_tscn('请填写导航名称!');
		              }else{
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_nav',
		                            data:{id:$id,name:$name,beizhu:$beizhu},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
											jq_tscu('进入下一步!',data.htm);
										}else{
										    jq_tsc('保存失败!');
										}
                                    },
									error:function(){
											jq_tsc('保存失败!');
									}
                              });
					  }
}
//微信推广 导航设置 导航类型选择
function navedit_select($i,$n){
         var $id = $("#s_"+$i+"_"+$n+" option:selected").val();
                            $.ajax({
                                    url : '/?a=action&action=navedit_sl',
		                            data:{id:$id,i:$i,n:$n},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
											$('#link_'+data.i+'_'+data.n).html(data.htm);
										}
                                    }
                              });
}
//微信推广 导航设置 保存
function weixin_navsave($navid,$level,$paixu,$i){
	                  if ($level=='1'){ //一级导航
						  var $title=$("#t_"+$paixu+"_0").attr("value");
						  var $sorts=$("#s_"+$paixu+"_0 option:selected").val();
						  if ($sorts=='133'){ //指定事件
						      var $link=$("#k_"+$paixu+"_0 option:selected").val();
						  }else{
							  var $link=$("#k_"+$paixu+"_0").attr("value");  
						  }
					  }else{ //二级导航
						  var $title=$("#t_"+$i+"_"+$paixu).attr("value");
						  var $sorts=$("#s_"+$i+"_"+$paixu+" option:selected").val();
						  if ($sorts=='133'){ //指定事件
						      var $link=$("#k_"+$i+"_"+$paixu+" option:selected").val();
						  }else{
							  var $link=$("#k_"+$i+"_"+$paixu).attr("value");  
						  }
					  }
					  $('#weixin_navsave_'+$navid+'_'+$level+'_'+$paixu+'_'+$i).html('保存中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_navsave',
		                            data:{navid:$navid,level:$level,paixu:$paixu,title:$title,sorts:$sorts,links:$link,preid:$i},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('保存成功!');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#weixin_navsave_'+$navid+'_'+$level+'_'+$paixu+'_'+$i).html('保存');
										}else{
										    jq_tscn('保存失败!');
											$('#weixin_navsave_'+$navid+'_'+$level+'_'+$paixu+'_'+$i).html('保存');
										}
                                    },
									error:function(){
											jq_tscn('保存失败!');
											$('#weixin_navsave_'+$navid+'_'+$level+'_'+$paixu+'_'+$i).html('保存');
									}
                              });
}
//商家中心 微信推官 导航删除
function weixin_navdel($id){
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_navdel',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('删除成功!');
										}else{
										    jq_tsc('删除失败!');
										}
                                    },
									error:function(){
											jq_tsc('删除失败!');
									}
                              });
}
//微信推广 音乐编辑
function weixin_musicedit($id){
	                var $name=$("#name").attr("value");
					var $link=$("#shoplogo").attr("value");
					if ($name==''){
			              jq_tscn('音乐名称不能为空!');
		            }else if ($link==''){
			              jq_tscn('请上传音乐!');
		            }else{
						    $('#weixin_musicedit').html('保存中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_musicedit',
		                            data:{id:$id,name:$name,links:$link},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tscu('保存成功!','/?a=weixin&m=music');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#weixin_musicedit').html('确定保存');
										}else{
										    jq_tscn('保存失败!');
											$('#weixin_musicedit').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('保存失败!');
											$('#weixin_musicedit').html('确定保存');
									}
                              });
					}
}
//微信推广 自定义背景颜色
function weixin_tonaledit($id){
	                var $name=$("#name").attr("value");
					var $bg=$("#bg").attr("value");
					var $text=$("#text").attr("value");
					var $boxbg=$("#boxbg").attr("value");
					var $button_bg=$("#button_bg").attr("value");
					var $button_text=$("#button_text").attr("value");
					var $button_bg_tj=$("#button_bg_tj").attr("value");
					var $button_text_tj=$("#button_text_tj").attr("value");
					var $input_box=$("#input_box").attr("value");
					var $nav_bg1=$("#nav_bg1").attr("value");
					var $nav_bg2=$("#nav_bg2").attr("value");
					var $nav_text=$("#nav_text").attr("value");
					if ($name==''){
			              jq_tscn('模版颜色名称不能为空!');
		            }else{
						    $('#weixin_tonaledit').html('保存中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_tonaledit',
		                            data:{id:$id,name:$name,bg:$bg,text:$text,boxbg:$boxbg,button_bg:$button_bg,button_text:$button_text,button_bg_tj:$button_bg_tj,button_text_tj:$button_text_tj,input_box:$input_box,nav_bg1:$nav_bg1,nav_bg2:$nav_bg2,nav_text:$nav_text},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('保存成功!');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#weixin_tonaledit').html('确定保存');
										}else{
										    jq_tscn('保存失败!');
											$('#weixin_tonaledit').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('保存失败!');
											$('#weixin_tonaledit').html('确定保存');
									}
                              });
					}
}
//商家中心 微信推广 音乐删除
function weixin_musicdel($id){
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_musicdel',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('删除成功!');
										}else{
										    jq_tsc('删除失败!');
										}
                                    },
									error:function(){
											jq_tsc('删除失败!');
									}
                              });
}
//商家中心 微信推广 自定义颜色删除
function weixin_tonaldel($id){
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_tonaldel',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('删除成功!');
										}else{
										    jq_tsc('删除失败!');
										}
                                    },
									error:function(){
											jq_tsc('删除失败!');
									}
                              });
}
//商家中心 微信推广 页面添加 模版ID选择
function coupons_temp($textid,$mid){
	                       $("#mblist ul").each(function(){
							$("#"+$(this).attr('id')).removeClass("mbbid");
                           })
			               $("#mbid_"+$mid).addClass("mbbid");
						   $.ajax({
                                    url : '/?a=action&action=temp_content',
		                            data:{textid:$textid,mid:$mid},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
											$.getScript('/theme/kindeditor/kindeditor.js', function() {
						                        K_editor('textarea_1');K_editor('textarea_2');K_editor('textarea_3');
					                        });
											$('#temp_content').html(''+data.htm+'');
                                    },
									error:function(){
											jq_tsc('模版信息加载失败...');
									}
                              });
}
//手机端 模版ID选择
function coupons_m_temp($mid){
	                       $("#mblist ul").each(function(){
							$("#"+$(this).attr('id')).removeClass("mbbid");
                           })
			               $("#mbid_"+$mid).addClass("mbbid");
						   var $title=$("#w_title").attr("value");
						   var $title2=$("#w_title2").attr("value");
						   var $tuijian=$("#w_tuijian").attr("value");
						   $.ajax({
                                    url : '/?a=action&action=temp_m_content',
		                            data:{mid:$mid},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
											if (data.mid!=''){
												$("#w_mid").val(data.mid);
												$("#w_title").val(data.title);
												$("#w_title2").val(data.title2);
												editor.html('');
												editor.insertHtml(''+data.tuijian+'');
											}else{
											  jq_tsc('模版信息加载失败...');	
											}
											
                                    },
									error:function(){
											jq_tsc('模版信息加载失败...');
									}
                              });
}
// 微信推广 页面编辑保存
function coupons_edit($textid){
	     //选择推广模版
	     var $input_1 = $("#input_1").attr("value");
		 var $input_2 = $("#input_2").attr("value");
		 var $input_3 = $("#input_3").attr("value");
		 var $textarea_1 = $('#textarea_1').val();
		 var $textarea_2 = $('#textarea_2').val();
		 var $textarea_3 = $('#textarea_3').val();
		 var $tonal = $("#w_tonal  option:selected").val();
		 var $mid = $("#w_mid").attr("value");
		 //设置客户信息
		 var $name = $("#username").attr("value");
		 var $gender = $("#gender  option:selected").val();
		 var $mobile = $("#usermobile").attr("value");
		 //设置推广参数
		 var $title = $("#w_title").attr("value");
		 var $title2 = $("#w_title2").attr("value");
		 var $thum = $("#w_thum").attr("value");
		 var $top = $("#w_top").attr("value");
		 var $toptrig = $("#w_toptrig  option:selected").val();
		 var $toptrigvalue = $("#w_toptrigvalue").attr("value");if ($toptrigvalue==''){$toptrig='0';}
		 var $bot = $("#w_bot").attr("value");
		 var $bottrig = $("#w_bottrig  option:selected").val();
		 var $bottrigvalue = $("#w_bottrigvalue").attr("value");if ($bottrigvalue==''){$bottrig='0';}
		 var $tuijian = $('#tuijian').val();
		 var $youhui = $("#w_youhui").attr("value");
		 var $youhuinum = $("#w_youhuinum").attr("value");
		 var $nav = $("#w_nav option:selected").val();
		 var $music = $("#w_music option:selected").val();
		 var $emp=',';
		 $(".w_emp").each(function(){
			 $emp+=$("#"+$(this).attr('id')+" option:selected").val()+",";
         })	
		 var $p = $("#p").attr("value");
		 var $state = $("#w_state option:selected").val();
         if ($mid=='0' || $mid=='' || $mid==undefined){
			 jq_tscn('请选择推广模版!');
		 }else if ($title==''){
			 jq_tscn('请填写推广标题!');
		 }else if ($mobile!='' && !checkmobile($mobile)){
			 jq_tscn('请填写正确的客户手机!');
		 }else if ($name=='' && $mobile!=''){
			 jq_tscn('客户姓名不能为空!');
		 }else if ($name!='' && $mobile==''){
			 jq_tscn('客户手机不能为空!');
		 }else if ($title2==''){
			 jq_tscn('请填写推广描述!');
		 }else if ($thum==''){
			 jq_tscn('请上传缩略图!');
		 }else if ($youhui==''){
			 jq_tscn('请上传优惠卷图片!');
		 }else{
			 $('#coupons_edit').html('保存中...');
			          $.ajax({
                              url : '/?a=action&d=true&action=coupons_edit',
		                      data:{p:$p,
								    textid:$textid,
									input_1:$input_1,
									input_2:$input_2,
									input_3:$input_3,
									textarea_1:$textarea_1,
									textarea_2:$textarea_2,
									textarea_3:$textarea_3,
									tonal:$tonal,
									mid:$mid,
									name:$name,
									gender:$gender,
									mobile:$mobile,
									title:$title,
									title2:$title2,
									thum:$thum,
									top:$top,
									toptrig:$toptrig,
									toptrigvalue:$toptrigvalue,
									bot:$bot,
									bottrig:$bottrig,
									bottrigvalue:$bottrigvalue,
									tuijian:$tuijian,
									youhui:$youhui,
									youhuinum:$youhuinum,
									nav:$nav,
									music:$music,
									emp:$emp,
									state:$state
									},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tscu('保存成功!','/?a=weixin');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#coupons_edit').html('确定保存');
										}else{
										    jq_tscn('保存失败!');
											$('#coupons_edit').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('保存失败!');
											$('#coupons_edit').html('确定保存');
									}
                              });
		 }
}
// 微信推广 页面编辑保存
function coupons_m_edit($id){
	     //选择推广模版
	     var $name = $("#w_name").attr("value");
		 var $tonal = $("#w_color  option:selected").val();
		 var $mid = $("#w_mid").attr("value");
		 var $state = $("#w_state option:selected").val(); 
		 var $per = $("#w_per option:selected").val();
		 //设置推广参数
		 var $title = $("#w_title").attr("value");
		 var $title2 = $("#w_title2").attr("value");
		 var $top = $("#w_top").attr("value");
		 var $toptrig = $("#w_toptrig  option:selected").val();
		 var $toptrigvalue = $("#w_toptrigvalue").attr("value");if ($toptrigvalue==''){$toptrig='0';}
		 var $bot = $("#w_bot").attr("value");
		 var $bottrig = $("#w_bottrig  option:selected").val();
		 var $bottrigvalue = $("#w_bottrigvalue").attr("value");if ($bottrigvalue==''){$bottrig='0';}
		 var $tuijian = $('#tuijian').val();
		 var $youhui = $("#w_youhui").attr("value");
		 var $youhuinum = $("#w_youhuinum").attr("value");
		 var $nav = $("#w_nav option:selected").val(); 
		 var $p = $("#w_p").attr("value");
		 //jq_tscn($tuijian);
         if ($mid=='0' || $mid=='' || $mid==undefined){
			 jq_tscn('请选择模版样式!');
		 }else if ($name==''){
			 jq_tscn('请填写模版名称!');
		 }else if ($title==''){
			 jq_tscn('请填写推广标题!');
		 }else if ($title2==''){
			 jq_tscn('请填写推广描述!');
		 }else if ($youhui==''){
			 jq_tscn('请上传优惠卷图片!');
		 }else{
			 $('#coupons_m_edit').html('保存中...');
			          $.ajax({
                              url : '/?a=action&d=true&action=coupons_m_edit',
		                      data:{id:$id,
								    name:$name,
									tonal:$tonal,
									mid:$mid,
									state:$state,
									per:$per,
									title:$title,
									title2:$title2,
									top:$top,
									toptrig:$toptrig,
									toptrigvalue:$toptrigvalue,
									bot:$bot,
									bottrig:$bottrig,
									bottrigvalue:$bottrigvalue,
									tuijian:$tuijian,
									youhui:$youhui,
									youhuinum:$youhuinum,
									nav:$nav,
									p:$p
									},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tscu('保存成功!','/?a=m');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#coupons_m_edit').html('确定保存');
										}else{
										    jq_tscn('保存失败!');
											$('#coupons_m_edit').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('保存失败!');
											$('#coupons_m_edit').html('确定保存');
									}
                              });
		 }
}
// 微信推广 页面添加 步骤三 广告事件 
function weixin_toptrig(){
	     var $id = $("#w_toptrig option:selected").val();
		 if ($id=='0'){
		     $(".w_toptrigvalue").html('<input type="text" class="input text2_s2" name="w_toptrigvalue" id="w_toptrigvalue" placeholder="关闭广告" disabled>');
		 }else if ($id=='1'){
			 $(".w_toptrigvalue").html('<input type="text" class="input text2_s2" name="w_toptrigvalue" id="w_toptrigvalue" placeholder="请输入广告链接网址">');
		 }else if ($id=='2'){
			 $(".w_toptrigvalue").html('<input type="text" class="input text2_s2" name="w_toptrigvalue" id="w_toptrigvalue" value="javascript:sendyhm();" disabled>');
		 }else if ($id=='3'){
			 $(".w_toptrigvalue").html('<input type="text" class="input text2_s2" name="w_toptrigvalue" id="w_toptrigvalue" placeholder="请输入手机号或电话号">');
		 }else if ($id=='4'){
			 $(".w_toptrigvalue").html('<input type="text" class="input text2_s2" name="w_toptrigvalue" id="w_toptrigvalue" placeholder="请输入你的手机号">');
		 }
}
function weixin_bottrig(){
	     var $id = $("#w_bottrig option:selected").val();
		 if ($id=='0'){
		     $(".w_bottrigvalue").html('<input type="text" class="input text2_s2" name="w_bottrigvalue" id="w_bottrigvalue" placeholder="关闭广告" disabled>');
		 }else if ($id=='1'){
			 $(".w_bottrigvalue").html('<input type="text" class="input text2_s2" name="w_bottrigvalue" id="w_bottrigvalue" placeholder="请输入广告链接网址">');
		 }else if ($id=='2'){
			 $(".w_bottrigvalue").html('<input type="text" class="input text2_s2" name="w_bottrigvalue" id="w_bottrigvalue" value="javascript:sendyhm();" disabled>');
		 }else if ($id=='3'){
			 $(".w_bottrigvalue").html('<input type="text" class="input text2_s2" name="w_bottrigvalue" id="w_bottrigvalue" placeholder="请输入手机号或电话号">');
		 }else if ($id=='4'){
			 $(".w_bottrigvalue").html('<input type="text" class="input text2_s2" name="w_bottrigvalue" id="w_bottrigvalue" placeholder="请输入你的手机号">');
		 }
}
// 微信推广 页面编辑 背景音乐
function weixin_musics(){
						 var $id = $("#w_musics option:selected").val();
			                $.ajax({
                                    url : '/?a=action&action=weixin_musics',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
										    $('#w_musicin').html(data.htm);
										}else{
										    jq_tscn('音乐加载失败!');
										}
                                    },
									error:function(){
											jq_tscn('音乐加载失败!');
									}
                              });
}
// 微信推广 页面编辑 背景音乐 试听
function music_shiting(){
						 var $id = $("#w_music option:selected").val();
			                $.ajax({
                                    url : '/?a=action&action=music_shiting',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
										    $('#music_shiting').html(data.htm);
										}
                                    }
                              });
}
// 微信推广 获取推广链接
function go_link($textid){ 
                          var top = $(document).scrollTop()+(($(window).height()-460)/2);
                          $(".onlines").css({"top":top});
                          $('.onlines').show();
	                      $('.onlines .ajax').html('<div style="margin:150px 200px;"><img src="/theme/img/loading_max.gif" border="0"/></div>');
	                      $.ajax({
                                    url : '',
		                            data:{textid:$textid},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
											$('.onlines .ajax').html(data.htm);
										}
                                    }
                              });
}
// 微信推广 获取推广链接
function go_link_err($textid){ 
                          var top = $(document).scrollTop()+(($(window).height()-460)/2);
                          $(".onlines").css({"top":top});
                          $('.onlines').show();
	                      $('.onlines .ajax').html('<div style="margin:150px 200px;"><img src="/theme/img/loading_max.gif" border="0"/></div>');
	                      $.ajax({
                                    url : '/?a=action&action=go_link_err',
		                            data:{textid:$textid},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
											$('.onlines .ajax').html(data.htm);
										}
                                    }
                              });
}
function close_online(){
	 $('.onlines').hide();
}
// 微信推广 客户回访
function huifang($downid){ 
                          var top = $(document).scrollTop()+(($(window).height()-460)/2);
                          $(".onlines").css({"top":top});
                          $('.onlines').show();
	                      $('.onlines .ajax').html('<div style="margin:150px 200px;"><img src="/theme/img/loading_max.gif" border="0"/></div>');
	                      $.ajax({
                                    url : '/?a=action&action=huifang',
		                            data:{downid:$downid},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
											$('.onlines .ajax').html(data.htm);
										}
                                    }
                              });
}
// 微信推广 客户回访保存
function huifang_save($downid){ 
                 var $name = $("#return_name").attr("value");
				 var $grade = $("#return_grade  option:selected").val();
				 var $text = $("#return_text").attr("value");
				 $('#huifang_save').html('保存中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=huifang_save',
		                            data:{downid:$downid,name:$name,grade:$grade,text:$text},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.id!=''){
										    jq_tscn('保存成功!');
											$('.onlines').hide();
											$("#fid_"+data.id).css({"background":"#CCCCCC"});
										}else{
										    jq_tscn('保存失败!');
											$('#huifang_save').html('保存');
										}
                                    },
									error:function(){
											jq_tscn('保存失败!');
											$('#huifang_save').html('保存');
									}
                              });            
}
// 微信推广 优惠券验证
function val_search(){ 
                 var $code = $("#val").attr("value");
				 if ($code==''){
					 jq_tscn('请输入优惠券号!');
				 }else{
				 $('#val_search').html('搜索中...');
			                $.ajax({
                                    url : '/?a=action&action=val_search',
		                            data:{code:$code},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.code>0){
										    $('#val_in').html(data.htm);
											$('#val_search').html('搜索');
										}else if (data.htm!=''){
										    jq_tscn(data.htm);
											$('#val_search').html('搜索');
											$('#val_in').html('');
										}else{
										    jq_tscn('搜索失败!');
											$('#val_search').html('搜索');
											$('#val_in').html('');
										}
                                    },
									error:function(){
											jq_tscn('搜索失败!');
											$('#val_search').html('搜索');
											$('#val_in').html('');
									}
                              }); 
				 }
}
// 微信推广 优惠券验证 保存
function val_save($downid){ 
                 var $mobile = $("#val_mobile").attr("value");
				 var $name = $("#val_name").attr("value");
				 var $gender = $("#gender").attr("value");
				 if ($mobile==''){
					 jq_tscn('客户手机不能为空!');
				 }else if ($name==''){
					 jq_tscn('客户名称不能为空!');
				 }else{
				 $('#val_save_'+$downid).html('验证中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=val_save',
		                            data:{downid:$downid,mobile:$mobile,name:$name,gender:$gender},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.id!=''){
										    jq_tscn('验证成功');
											$('#val_save_'+data.id).html('确定验证');
											$("#val_save_"+data.id).hide();
										}else{
										    jq_tscn('验证失败!');
											$('#val_save_'+data.id).html('确定验证');
										}
                                    },
									error:function(){
											jq_tscn('验证失败!');
											$('#val_save_'+$downid).html('确定验证');
									}
                              }); 
				 }
}
// 微信推广 设置奖励方式
function coupons_reward_select(){ 
         var $id = $("#reward option:selected").val();
		 if ($id=='投票'){
			 $("#toupiao").css({"display":"block"}); 
		 }else{
			 $("#toupiao").css({"display":"none"});  
		 }		 
}
// 微信推广 保存奖励方式
function coupons_reward_save($id){ 
                 var $toupiao = $("#w_toupiao").attr("value");
				 var $reward = $("#reward  option:selected").val();
				 if ($reward=='投票' && $toupiao==''){
					 jq_tscn('投票内容不能为空!'); 
				 }else{  
				            $('#coupons_reward_save').html('保存中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=coupons_reward_save',
		                            data:{id:$id,reward:$reward,toupiao:$toupiao},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('保存成功!');
										}else{
										    jq_tscn('保存失败!');
											$('#coupons_reward_save').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('保存失败!');
											$('#coupons_reward_save').html('确定保存');
									}
                              });
				 }
}
// 手机端 保存奖励方式
function m_coupons_reward_save($id){ 
                 var $toupiao = $("#w_toupiao").attr("value");
				 var $reward = $("#reward  option:selected").val();
				 if ($reward=='投票' && $toupiao==''){
					 jq_tscn('投票内容不能为空!'); 
				 }else{  
				            $('#m_coupons_reward_save').html('保存中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=m_coupons_reward_save',
		                            data:{id:$id,reward:$reward,toupiao:$toupiao},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('保存成功!');
										}else{
										    jq_tscn('保存失败!');
											$('#m_coupons_reward_save').html('确定保存');
										}
                                    },
									error:function(){
											jq_tscn('保存失败!');
											$('#m_coupons_reward_save').html('确定保存');
									}
                              });
				 }
}
// 微信推广 添加奖励参数
function coupons_reward_add($textid){
	                     var $num = $("#w_num").attr("value");
					     var $reward = $("#w_reward").attr("value");
						 if ($num==''){
			                 jq_tscn('指定数目不能为空!');
		                 }else if($reward==''){
						     jq_tscn('奖励不能为空!');
						 }else{
						    $('#coupons_reward_add').html('添加中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=coupons_reward_add',
		                            data:{textid:$textid,num:$num,reward:$reward},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('添加成功!');
											$('#coupons_reward_add').html('添加');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#coupons_reward_add').html('添加');
										}else{
										    jq_tscn('添加失败!');
											$('#coupons_reward_add').html('添加');
										}
                                    },
									error:function(){
											jq_tscn('添加失败!');
											$('#coupons_reward_add').html('添加');
									}
                              });
						 }
}
// 手机端 添加奖励参数
function m_coupons_reward_add($tempid){
	                     var $num = $("#w_num").attr("value");
					     var $reward = $("#w_reward").attr("value");
						 if ($num==''){
			                 jq_tscn('指定数目不能为空!');
		                 }else if($reward==''){
						     jq_tscn('奖励不能为空!');
						 }else{
						    $('#m_coupons_reward_add').html('添加中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=m_coupons_reward_add',
		                            data:{tempid:$tempid,num:$num,reward:$reward},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('添加成功!');
											$('#m_coupons_reward_add').html('添加');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#m_coupons_reward_add').html('添加');
										}else{
										    jq_tscn('添加失败!');
											$('#m_coupons_reward_add').html('添加');
										}
                                    },
									error:function(){
											jq_tscn('添加失败!');
											$('#m_coupons_reward_add').html('添加');
									}
                              });
						 }
}
// 微信推广 编辑奖励参数
function coupons_reward_edit($id){
	                     var $num = $("#w_num_"+$id).attr("value");
					     var $reward = $("#w_reward_"+$id).attr("value");
						 if ($num==''){
			                 jq_tscn('指定数目不能为空!');
		                 }else if($reward==''){
						     jq_tscn('奖励不能为空!');
						 }else{
						    $('#coupons_reward_edit').html('保存中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=coupons_reward_edit',
		                            data:{id:$id,num:$num,reward:$reward},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('编辑成功!');
											$('#coupons_reward_edit').html('编辑');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#coupons_reward_edit').html('编辑');
										}else{
										    jq_tscn('编辑失败!');
											$('#coupons_reward_edit').html('编辑');
										}
                                    },
									error:function(){
											jq_tscn('编辑失败!');
											$('#coupons_reward_edit').html('编辑');
									}
                              });
						 }
}
// 手机端 编辑奖励参数
function m_coupons_reward_edit($id){
	                     var $num = $("#w_num_"+$id).attr("value");
					     var $reward = $("#w_reward_"+$id).attr("value");
						 if ($num==''){
			                 jq_tscn('指定数目不能为空!');
		                 }else if($reward==''){
						     jq_tscn('奖励不能为空!');
						 }else{
						    $('#m_coupons_reward_edit').html('保存中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=m_coupons_reward_edit',
		                            data:{id:$id,num:$num,reward:$reward},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('编辑成功!');
											$('#m_coupons_reward_edit').html('编辑');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#m_coupons_reward_edit').html('编辑');
										}else{
										    jq_tscn('编辑失败!');
											$('#m_coupons_reward_edit').html('编辑');
										}
                                    },
									error:function(){
											jq_tscn('编辑失败!');
											$('#m_coupons_reward_edit').html('编辑');
									}
                              });
						 }
}
// 微信推广 删除奖励参数
function coupons_reward_del($id){
						    $('#coupons_reward_del').html('删除中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=coupons_reward_del',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('删除成功!');
											$('#coupons_reward_del').html('删除');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#coupons_reward_del').html('删除');
										}else{
										    jq_tscn('删除失败!');
											$('#coupons_reward_del').html('删除');
										}
                                    },
									error:function(){
											jq_tscn('删除失败!');
											$('#coupons_reward_del').html('删除');
									}
                              });
}
// 手机端 删除奖励参数
function m_coupons_reward_del($id){
						    $('#m_coupons_reward_del').html('删除中...');
			                $.ajax({
                                    url : '/?a=action&d=true&action=m_coupons_reward_del',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('删除成功!');
											$('#m_coupons_reward_del').html('删除');
										}else if (data.htm!=''){
											jq_tscn(data.htm);
											$('#m_coupons_reward_del').html('删除');
										}else{
										    jq_tscn('删除失败!');
											$('#m_coupons_reward_del').html('删除');
										}
                                    },
									error:function(){
											jq_tscn('删除失败!');
											$('#m_coupons_reward_del').html('删除');
									}
                              });
}
// 微信推广 推广链接标记删除
function weixin_del($id){
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_del',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
										    jq_tsc(data.htm);
										}else{
										    jq_tscn('删除失败!');
										}
                                    },
									error:function(){
											jq_tscn('删除失败!');
									}
                              });
}
// 微信推广 推广链接物理删除
function weixin_del2($id){
			                $.ajax({
                                    url : '/?a=action&d=true&action=weixin_del2',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm=='1'){
										    jq_tsc('删除成功');
										}else if (data.htm!=''){
										    jq_tsc(data.htm);
										}else{
										    jq_tscn('删除失败!');
										}
                                    },
									error:function(){
											jq_tscn('删除失败!');
									}
                              });
}
// 手机端 模版删除
function m_temp_del($id){
			                $.ajax({
                                    url : '/?a=action&d=true&action=m_temp_del',
		                            data:{id:$id},
		                            type:'post',
                                    dataType : 'jsonp',  
                                    jsonp:"callback",
									cache:false,
									timeout:10000,
                                    success: function (data) {
										if (data.htm!=''){
										    jq_tsc(data.htm);
										}else{
										    jq_tscn('删除失败!');
										}
                                    },
									error:function(){
											jq_tscn('删除失败!');
									}
                              });
}