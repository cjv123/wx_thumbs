<?php
/**
 * Page - 分页类
 *
 *  利用dz分页函数，为了更好更方便的结合数据库调用，写了个分页类
 * @author cjv123@qq.com
 * @version  Views.php,v0.1 2008/11/23
 */


class Page_cjv{


  /**
   *pagesize - 每页记录数
  * @var int
  * @access private
  */
	private $pagesize;

  /**
  * sql - sql语句
  * @var string
  * @access private
  */
	private $sql;

  /**
  * getpage $_get的页数
  * @var int
  * @access private
  */
	private $getpage;


  /**
  * numRows - 记录总数
  * @var int
  * @access private
  */
    private $numRows;

    public $url;




    /**
    * 构造函数
     * @param string $sql
     * @param int $pagesize
     * @param object $db
     * @access public
     */
    function __construct($params) {
		//$this->url      = $url;
	    $this->pagesize = $params['per_page'];
		$this->total      = $params['total'];
		$this->getpage  = $params['page'];

		if(!$this->getpage) {
			$this->getpage=1;
		}
    }



   /**
    *getCount 取记录总数
   *@access public
   *@return void
   */
   public function getCount() {
          // $result= $this->db->query($this->sql);
         return $this->total;
    }


	 /**
     *pageSql 格式化sql语句
     * @access public
     * @return string
     */
 	public function pageSql() {
		$nowpage    = $this->getpage;
		$limitNumber= $this->pagesize;
		if($nowpage<1) {
			$nowpage=1;
		}
		return $this->sql." limit ".($nowpage-1)*$limitNumber.",".$limitNumber;
	}

     /**
     *getUrl 取当前地址url
     * @param string $urlmode 分为router(路由模式)和rewrite模式
     * @access public
     * @return string
     */
    public function getUrl($urlmode="router") {

        return $this->url;
    }

	/**
     *show 输出分页链接
     * @param string $urlmode
     * @access public
     * @return string
     */
     public function show($page = 10,$offset = 2){
		$mpurl     = $this->getUrl();
		$curr_page = $this->getpage;
		$perpage   = $this->pagesize;
		$num=$this->getCount();//总记录数
        $multipage = "";
        if ($num > $perpage){
            $pages = ceil($num / $perpage);
            $from = $curr_page - $offset;
            $to = $curr_page + $page - $offset - 1;
            if ($page > $pages){
                $from = 1;
                $to = $pages;
            }else{
                if ($from < 1){
                     $to = $curr_page + 1-$from;
                     $from = 1;
                     if (($to - $from) < $page && ($to - $from) < $pages){
                         $to = $page;
                     }
                }elseif ($to > $pages){
                     $from = $curr_page - $pages + $to;
                     $to = $pages;
                     if (($to - $from) < $page && ($to - $from) < $pages){
                           $from = $pages - $page + 1;
                     }
                }
            }
		    $multipage .="
		<script language=\"javascript\">
		function gotoPage(value)
		{
			value = parseInt(value);
			if(isNaN(value))
			value = 0;
			if(value<1)
			value = 1;
			if(value>".$pages.")
			value = ".$pages.";
			window.location.href = \"".$mpurl."\"+value;
		}
		</script>";
            $multipage .= "<div class=\"p_bar\">";
            $multipage .= "<a class=\"p_total\">&nbsp;".$num."&nbsp;</a>\n";
          //  $multipage .= "<a class=\"p_pages\">&nbsp;".$curr_page."/".$pages."&nbsp;</a>\n";
            if ($curr_page - $offset > 1 && $pages>$page){
                 $multipage .= "<a class=\"p_redirect\" href=\"".$mpurl."1\" title='首页'>1...</a>";
            }
            if($curr_page>1) {
                  $multipage .= "<a class=\"p_redirect\" href=\"".$mpurl."".($curr_page-1)."\" title='上一页'>&laquo;</a>\n";
            }
            for ($i = $from; $i <= $to; $i++){
                if ($i != $curr_page){
                     $multipage .= "<a class=\"p_num\" href=\"".$mpurl."".$i."\" title='第".$i."页'>".$i."</a>\n";
                }else{
                     $multipage .= "<a class=\"p_curpage\">".$i."</a>\n";
                }
            }
            if($curr_page<$pages) {
                  $multipage .= "<a class=\"p_redirect\" href=\"".$mpurl.($curr_page+1)."\" title='下一页'>&raquo;</a>\n";
            }
            if ($curr_page + $offset < $pages && $pages>$page){
                  $multipage .= "<a class=\"p_redirect\" href=\"".$mpurl."$pages\" title='尾页'>...".$pages."</a>\n";
            }

            //$multipage .= "<a class=\"p_total\">".$perpage."条/页</a>\n";
		   // $multipage .= "<div id='pagecount' style='display:none;'>{$pages}</div><div id='mpurl' style='display:none;'>{$mpurl}</div></div>";
            $multipage .= "<input class=\"p_input\" title=\"按ENTER跳转\" name=\"pageGo\" id=\"pageGo\" onKeydown=\"if(event.keyCode == 13) {gotoPage(this.value);return false;}\">\n<input  class=\"p_input\" title=\"输入页数后点击跳转\" style=\"width:30px;top:0x\" type=\"button\" value=\"GO\" onclick=\"gotoPage(document.getElementById('pageGo').value);\" />\n";
        }
         return $multipage;
    }
}


