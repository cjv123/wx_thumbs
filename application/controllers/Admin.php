<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
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
        $this->load->model("staffmodel");
        $this->load->model("shopmodel");
        $data["list"] =$this->staffmodel->staff_list($page,$per_page,$search_name,$search_shop_id);
        $data["total"]=$total=$this->staffmodel->staff_list_count($search_name,$search_shop_id);
        $params=array('total'=>$total,'per_page'=>$per_page,'page'=>$page);
        $this->load->library('Page_cjv',$params);
        
        $this->page_cjv->url="/admin/shop_list/";
        $data["pager"]=$this->page_cjv->show();
        $data["page"]=$page;
        $data["search_name"]=$search_name;
        $data["search_shop_id"]=$search_shop_id;
        $data["shop_list"]=$this->shopmodel->shop_list();
        
        $this->load->view("staff_list",$data);
    }
    
    public function staff_add()
    {
        $this->load->model("shopmodel");
        $shop_list=$this->shopmodel->shop_list(1,100);
        $data["shop_list"]=$shop_list;
        $this->load->view("staff_add",$data);
    }
    
    public function staff_edit($id)
    {
        if (!$id)
        {
            return;
        }
        $this->load->model("staffmodel");
        $this->load->model("shopmodel");
        $data = $this->staffmodel->staff_info($id);
        $data["shop_list"] = $this->shopmodel->shop_list(1,100);
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
        
        $this->load->model("staffmodel");
        
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
            $this->load->model("staffmodel");
            $ret = $this->staffmodel->staff_add($name,$des,$job,$shopId);
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
        
        $this->load->model("staffmodel");
        
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
            $this->load->model("staffmodel");
            $ret = $this->staffmodel->staff_update($staff_id,$name,$des,$job,$shopId);
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
        $url = "http://".$_SERVER['SERVER_NAME']."/staff/thumb/".$id;
        
        require_once ("phpqrcode.php");
        $value=$url;
        $errorCorrectionLevel = "L";
        $matrixPointSize = "10";
        QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
    }
    
    public function shop_add()
    {
        $this->load->view("shop_add");
    }
    
    public function shop_edit($id)
    {
        if (!$id)
            return;
        
        $this->load->model("shopmodel");
        $data = $this->shopmodel->shop_info($id);
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
            $this->load->model("shopmodel");
            $ret = $this->shopmodel->shop_add($name,$des);
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
            $this->load->model("shopmodel");
            $ret = $this->shopmodel->shop_update($id,$name,$des);
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
        
        $this->load->model("shopmodel");
        $data["list"] =$this->shopmodel->shop_list($page,$per_page,$search_name);
        $data["total"]=$total=$this->shopmodel->shop_count($search_name);
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
        $this->load->model("shopmodel");
        $ret = $this->shopmodel->shop_del($id);
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
        $this->load->model("staffmodel");
        $ret = $this->staffmodel->staff_del($id);
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
        
        $this->load->model("commentmodel");
        $per_page = 10;
        $data["total"]=$total=$this->commentmodel->comment_count($staff_id);
        $params=array('total'=>$total,'per_page'=>$per_page,'page'=>$page);
        $this->load->library('Page_cjv',$params);
        $this->page_cjv->url="/admin/comment_list/";
        $data["pager"]=$this->page_cjv->show();
        $comment_list=$this->commentmodel->comment_list($staff_id,$page,$per_page);
        $data["list"]=$comment_list;
        $this->load->view("comment_list",$data);
    }
    
    public function comment_del_req($comment_id)
    {
        $this->load->model("commentmodel");
        $ret = $this->commentmodel->comment_del($comment_id);
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
            $this->load->model("commentmodel");
            $ret = $this->commentmodel->comment_admin_add($comment_id,$comment_admin,$admin_id);
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
        $this->load->model("adminmodel");
        
        $out=array(
        "ret"=>0,
        "msg"=>"保存成功",
        );
        
        if ($passwd && $passwd2 && $passwd==$passwd2)
        {
            $ret = $this->adminmodel->admin_update(0,$passwd);
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
        $login_name=$this->input->post("login_name");
        $passwd = $this->input->post("passwd");

        $this->load->model("adminmodel");
        $admin_info = $this->adminmodel->admin_info($login_name);
        $input_admin = md5($passwd);
        if ($input_admin == $admin_info["passwd"])
        {
            echo "<script>parent.location='/admin/staff_list'</script>";
        }
        else
        {
            echo "<script>alert('密码或账户错误！')</script>";
        }
    }
}