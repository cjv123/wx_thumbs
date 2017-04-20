<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $ctrname=$this->uri->segment(2);
        if ($ctrname==null || $ctrname=="index" || $ctrname=="" || $ctrname=="login_check")
            return;
        
        if (!isset($_SESSION["admin_id"]))
        {
            header("Location:/admin");
        }
    }
    
    public function index()
    {
        $this->load->view("login");
    }
    
    public function admin_home()
    {
    }
    
    public function staff_list($page=1)
    {
        $search_name = $this->input->get("name");
        $search_shop_id = $this->input->get("shop");
        $per_page=10;
        $this->load->model("StaffModel");
        $this->load->model("ShopModel");
        $data["list"] =$this->StaffModel->staff_list($page,$per_page,$search_name,$search_shop_id);
        $data["total"]=$total=$this->StaffModel->staff_list_count($search_name,$search_shop_id);
        $params=array('total'=>$total,'per_page'=>$per_page,'page'=>$page);
        $this->load->library('Page_cjv',$params);
        
        $this->page_cjv->url="/admin/shop_list/";
        $data["pager"]=$this->page_cjv->show();
        $data["page"]=$page;
        $data["search_name"]=$search_name;
        $data["search_shop_id"]=$search_shop_id;
        $data["shop_list"]=$this->ShopModel->shop_list();
        
        $this->load->view("staff_list",$data);
    }
    
    public function staff_add()
    {
        $this->load->model("ShopModel");
        $shop_list=$this->ShopModel->shop_list(1,100);
        $data["shop_list"]=$shop_list;
        $this->load->view("staff_add",$data);
    }
    
    public function staff_edit($id)
    {
        if (!$id)
        {
            return;
        }
        $this->load->model("StaffModel");
        $this->load->model("ShopModel");
        $data = $this->StaffModel->staff_info($id);
        $data["shop_list"] = $this->ShopModel->shop_list(1,100);
        $data["staff_id"]=$id;
        $this->load->view("staff_edit",$data);
    }
    
    public function staff_add_req()
    {
        $name=$this->input->post("name");
        $name=trim($name);
        $des="";
        $job="";
        $shopId=$this->input->post("shop");
        
        $this->load->model("StaffModel");
        
        $out=array(
        "ret"=>0,
        "msg"=>"添加成功",
        );
        
        if ($shopId=="")
        {
            $out["ret"]=2;
            $out["msg"]="请先添加分店!";
        }
        elseif ($name=="")
        {
            $out["ret"]=2;
            $out["msg"]="请输入姓名!";
        }
        else
        {
            $this->load->model("StaffModel");
            $ret = $this->StaffModel->staff_add($name,$des,$job,$shopId);
            if (!$ret)
            {
                $out["ret"]=1;
                $out["msg"]="数据写入失败";
            }
        }
        
        echo json_encode($out);
    }
    
    public function staff_edit_req($staff_id)
    {
        if(!$staff_id)
        return;
        
        $name=$this->input->post("name");
        $name=trim($name);
        $des="";
        $job="";
        $shopId=$this->input->post("shop");
        
        $this->load->model("StaffModel");
        
        $out=array(
        "ret"=>0,
        "msg"=>"保存成功",
        );
        
        if ($shopId=="")
        {
            $out["ret"]=2;
            $out["msg"]="请先添加分店!";
        }
        elseif ($name=="")
        {
            $out["ret"]=2;
            $out["msg"]="请输入姓名!";
        }
        else
        {
            $this->load->model("StaffModel");
            $ret = $this->StaffModel->staff_update($staff_id,$name,$des,$job,$shopId);
            if (!$ret)
            {
                $out["ret"]=1;
                $out["msg"]="数据写入失败";
            }
        }
        
        echo json_encode($out);
    }
    
    
    public function staff_view_qrcode($id)
    {
        $url = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/staff/qrcode2Page/".$id;
        
        require_once ("phpqrcode.php");
        $value=$url;
        $errorCorrectionLevel = "L";
        $matrixPointSize = "7";
        QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
    }
    
    private function _addFileToZip($path,$zip){
        $handler=opendir($path); //打开当前文件夹由$path指定。
        while(($filename=readdir($handler))!==false){
            if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作
                if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
                    _addFileToZip($path."/".$filename, $zip);
                }else{ //将文件加入zip对象
                    $zip->addFile($path."/".$filename);
                }
            }
        }
        @closedir($path);
    }
    
    
    public function make_all_qrcode($shop_id="")
    {
        require_once ("phpqrcode.php");
        $this->load->model("StaffModel"); 
        $list = $this->StaffModel->staff_list(1,1000,"",$shop_id);
        foreach($list as $row)        
        {
            $url = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/staff/thumb/".$row["id"];
            $value=$url;
            $errorCorrectionLevel = "L";
            $matrixPointSize = "7";
            QRcode::png($value, "qrcode/".$row["name"].".png", $errorCorrectionLevel, $matrixPointSize);
        }
        
        @unlink('qrcode/code_'.$shop_id.'.zip');
        $zip=new ZipArchive();
        if($zip->open('download/code_'.$shop_id.'.zip', ZipArchive::CREATE)=== TRUE){
            $this->_addFileToZip('qrcode', $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
            $zip->close(); //关闭处理的zip文件
        }
    }
    
    public function qrcode_download()
    {
        $files = array();
        $dir = scandir("download");
        foreach($dir as $filename)
        {
            if(end(@explode('.', $filename))=="zip")
            {
                array_push($files,$filename);
            }
        }

        $data["list"]=$files;

        $this->load->view("qrcode_download",$data);
    }
    
    public function shop_add()
    {
        $this->load->view("shop_add");
    }
    
    public function shop_edit($id)
    {
        if (!$id)
            return;
        
        $this->load->model("ShopModel");
        $data = $this->ShopModel->shop_info($id);
        $this->load->view("shop_edit",$data);
    }
    
    public function shop_add_seq()
    {
        $name=$this->input->post("name");
        $name=trim($name);
        $des="";
        
        $out=array(
        "ret"=>0,
        "msg"=>"添加成功",
        );
        
        if ($name=="")
        {
            $out["ret"]=2;
            $out["msg"]="请输入店名!";
        }
        else
        {
            $this->load->model("ShopModel");
            $ret = $this->ShopModel->shop_add($name,$des);
            if (!$ret)
            {
                $out["ret"]=1;
                $out["msg"]="数据写入失败";
            }
        }
        
        echo json_encode($out);
    }
    
    public function shop_edit_req($id)
    {
        if(!$id)
        return;
        
        $name=$this->input->post("name");
        $name=trim($name);
        $des="";
        
        $out=array(
        "ret"=>0,
        "msg"=>"保存成功",
        );
        
        if ($name=="")
        {
            $out["ret"]=2;
            $out["msg"]="请输入店名!";
        }
        else
        {
            $this->load->model("ShopModel");
            $ret = $this->ShopModel->shop_update($id,$name,$des);
            if (!$ret)
            {
                $out["ret"]=1;
                $out["msg"]="数据写入失败";
            }
        }
        
        echo json_encode($out);
    }
    
    public function shop_list($page=1)
    {
        $search_name = $this->input->get("name");
        $per_page=10;
        
        $this->load->model("ShopModel");
        $data["list"] =$this->ShopModel->shop_list($page,$per_page,$search_name);
        $data["total"]=$total=$this->ShopModel->shop_count($search_name);
        $params=array('total'=>$total,'per_page'=>$per_page,'page'=>$page);
        $this->load->library('Page_cjv',$params);
        
        $this->page_cjv->url="/admin/shop_list/";
        $data["pager"]=$this->page_cjv->show();
        $data["page"]=$page;
        $data["search_name"]=$search_name;
        
        $this->load->view("shop_list",$data);
    }
    
    public function shop_del_req($id)
    {
        $this->load->model("ShopModel");
        $ret = $this->ShopModel->shop_del($id);
        if ($ret)
        {
            echo "0";
        }
        else
        {
            echo "1";
        }
    }
    
    public function staff_del_req($id)
    {
        $this->load->model("StaffModel");
        $ret = $this->StaffModel->staff_del($id);
        if ($ret)
        {
            echo "0";
        }
        else
        {
            echo "1";
        }
    }
    
    
    public function comment_list($staff_id,$page=1)
    {
        if (!$staff_id)
        {
            return;
        }
        
        $this->load->model("CommentModel");
        $per_page = 10;
        $data["total"]=$total=$this->CommentModel->comment_count($staff_id);
        $params=array('total'=>$total,'per_page'=>$per_page,'page'=>$page);
        $this->load->library('Page_cjv',$params);
        $this->page_cjv->url="/admin/comment_list/";
        $data["pager"]=$this->page_cjv->show();
        $comment_list=$this->CommentModel->comment_list($staff_id,$page,$per_page);
        $data["list"]=$comment_list;
        $this->load->view("comment_list",$data);
    }
    
    public function comment_del_req($comment_id)
    {
        $this->load->model("CommentModel");
        $ret = $this->CommentModel->comment_del($comment_id);
        if($ret)
        {
            echo "0";
        }
        else
        {
            echo "1";
        }
    }
    
    public function comment_admin_replay($comment_id)
    {
        if(!$comment_id)
        {
            return;
        }
        
        $data["comment_id"]=$comment_id;
        
        $this->load->view("comment_admin_replay",$data);
    }
    
    public function commment_admin_req($comment_id)
    {
        $admin_id = 0;
        if (isset($_SESSION["admin_id"]))
        {
            $admin_id=$_SESSION["admin_id"];
        }
        
        $comment_admin = $this->input->post("comment");
        
        $out=array(
        "ret"=>0,
        "msg"=>"提交成功",
        );
        
        if ($comment_admin=="")
        {
            $out["ret"]=2;
            $out["msg"]="请输入店名!";
        }
        else
        {
            $this->load->model("CommentModel");
            $ret = $this->CommentModel->comment_admin_add($comment_id,$comment_admin,$admin_id);
            if (!$ret)
            {
                $out["ret"]=1;
                $out["msg"]="数据写入失败";
            }
        }
        
        echo json_encode($out);
    }
    
    
    public function admin_update()
    {
        $this->load->view("admin_update");
    }
    
    public function admin_update_req()
    {
        $passwd = $this->input->post("passwd");
        $passwd2 = $this->input->post("passwd2");
        $this->load->model("AdminModel");
        
        $out=array(
        "ret"=>0,
        "msg"=>"保存成功",
        );
        
        if ($passwd && $passwd2 && $passwd==$passwd2)
        {
            $ret = $this->AdminModel->admin_update(0,$passwd);
            if (!$ret)
            {
                $out["msg"]="数据库写入失败";
                $out["ret"]=1;
            }
        }
        else
        {
            $out["msg"]="两次输入密码不一致";
            $out["ret"]=1;
        }
        
        echo json_encode($out);
    }
    
    public function login_check()
    {
        $login_name="admin";
        $passwd = $this->input->post("passwd");
        
        $this->load->model("AdminModel");
        $admin_info = $this->AdminModel->admin_info($login_name);
        $input_admin = md5($passwd);
        if ($input_admin == $admin_info["passwd"])
        {
            $_SESSION["admin_id"]=$admin_info["id"];
            $_SESSION["admin_login_name"]=$admin_info["login_name"];
            echo "<script>parent.location='/admin/staff_list'</script>";
        }
        else
        {
            echo "<script>alert('密码错误！')</script>";
        }
    }
    
    public function logout()
    {
        session_destroy();
        header("Location:/admin");
    }
}