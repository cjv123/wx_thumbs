<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// echo "staff";
		echo urldecode("http%3A%2F%2Fcoder4game.com%3A8088%2Fstaff%2Fthumb%2F18");
	}

	public function qrcode2Page($staff_id)
	{
		$this->load->model("StaffModel");
		$wx_appid = $this->StaffModel->wx_appid;

		$back_url = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/staff/thumb/{$staff_id}";
		$back_url = urlencode($back_url);
		$url  = "https://open.weixin.qq.com/connect/oauth2/authorize?".
		"appid={$wx_appid}&".
		"redirect_uri={$back_url}&".
		"response_type=code&".
		"scope=snsapi_userinfo&".
		"state=STATE#wechat_redirect";
		// echo $url;
		// header($url);
		echo "<script>location='{$url}'</script>";
	}

	private function _get_wxname()
	{
		$wx_appid = $this->StaffModel->wx_appid;
		$wx_appsecret= $this->StaffModel->wx_appsecret;

		$code = $this->input->get("code");
		$state = $this->input->get("state");
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$wx_appid}&".
		"secret={$wx_appsecret}&".
		"code={$code}&".
		"grant_type=authorization_code";
		$res = $this->_http($url);
		// echo "res:".$res;
		$res_arr = @json_decode($res,true);
		$token = "";
		if (isset($res_arr["access_token"]))
		{
			$token = $res_arr["access_token"];
			$openid = $res_arr["openid"];
		}

		$wx_name="";
		if ($token)
		{
			$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}&lang=zh_CN";
			$res = $this->_http($url);
			// print_r($res);
			$res_arr = @json_decode($res,true);
			if (isset($res_arr["nickname"]))
			{
				$wx_name = $res_arr["nickname"];
			}
		}
		return $wx_name;
	}


	public function thumb($staff_id)
	{
		if ($staff_id=="")
		{
			return;
		}
		$this->load->model("StaffModel");
		$wx_name = $this->_get_wxname();
		// print_r($wx_name);

		$this->load->model("CommentModel");
		$info = $this->StaffModel->staff_info($staff_id);
		if (sizeof($info)==0)	
		{
			return;
		}
		$data=$info;
		$data["staff_id"]=$staff_id;
		$data["list"]=$this->CommentModel->comment_list($staff_id);
		$data["wx_name"]=$wx_name;
		// print_r($data);
		$this->load->view("thumb",$data);
	}
	
	public function thumb_req($staff_id)
	{
		if (!$staff_id)
		{
			return;
		}

		$star = $this->input->post("star");
		$text = $this->input->post("text");
		$wx_name = $this->input->post("wx_name");
		$this->load->model("CommentModel");
		$ret = $this->CommentModel->comment_add($star,$text,$staff_id,$wx_name);
		echo $ret;
		// header("Location:/staff/thumb_res/".$ret);
	}
	
	public function thumb_res($ret)
	{
		$data["ret"]=$ret;
		$this->load->view("thumb_res",$data);
	}


	public function staff_list($page=1)
	{
		$shop_id=$this->input->get("shop");
		$per_page=10;

		$this->load->model("StaffModel");
		$this->load->model("ShopModel");
	 	$data["staff_list"] = $this->StaffModel->staff_list($page,1000,"",$shop_id);
        $data["shop_list"] = $this->ShopModel->shop_list(1,100);
		$data["shop_id"]=$shop_id;
		$this->load->view("public_staff_list",$data);
	}

	private function _http($url, $data='', $method='GET')
	{   
		$curl = curl_init(); // 启动一个CURL会话  
		curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址  
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查  
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在  
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器  
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转  
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer  
		if($method=='POST'){  
			curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求  
			if ($data != ''){  
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包  
			}  
		}  
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环  
		curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回  
		$tmpInfo = curl_exec($curl); // 执行操作  
		curl_close($curl); // 关闭CURL会话  
		return $tmpInfo; // 返回数据  
	}  
}
