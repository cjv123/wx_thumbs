<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style></style>

<title>精准营销-管理平台</title>
<link rel="stylesheet" type="text/css" href="/css/styles.css">
<script src="/js/jquery-1.6.4.min.js" type="text/javascript"></script> 
</head>
<body id="login">
    <div id="wrapper">
        <div id="content">
            <div id="header">
                <h1 style="margin-top:13px; color:#FF0000">
                   
                </h1>
            </div>
            <div id="darkbanner">
                <h2>登陆 管理系统</h2>
            </div>
            <div id="darkbannerwrap" class="png"></div>
            <fieldset>
            <form method="post" name="login" id="loginform" target="hiddenaction"  action="/admin/login_check">
            	<p>
            		<label class="loginlabel">用户名:</label>
            		<input class="logininput" name="login_name" id="username" type="text">
                </p>
                <p>
                    <label class="loginlabel">密　码:</label>
                    <span>
                        <input class="logininput" name="passwd" id="userpass" type="password">
					</span>
                </p>
                <input name="submit" value="登陆"  tabindex="3" type="submit" class="positive" />
              </form>
            </fieldset>
        </div>
        <div id="wrapperbottom_branding">
        <div id="wrapperbottom_branding_text"></div>
        </div>
    </div>
    <iframe style="display:none" name="hiddenaction"></iframe>
    <script type="text/javascript">
    
    </script>

</body></html>