<?php 
namespace element;

class pager{

	public static function create($arr = []){
		global $vue;
		$per_page = $arr['per_page']?:10;unset($arr['per_page']);
		$is_page = $arr['is_page'];unset($arr['is_page']);
		$url = $arr['url'];unset($arr['url']);
		$ele = $arr['data'];unset($arr['data']);
		$method = 'load_filter_'.$ele;
		$where  = 'filter_'.$ele;
		$total  = 'filter_total_'.$ele;
	 	$vue->data($total,0);
		$vue->data($where,"{per_page:".$per_page.",page:1}");

		$size_change = $ele."_size_change";
		$current_change = $ele."_current_change";

		$vue->method($size_change."(e)", "
		    this.".$where.".per_page = e;
		    this.".$where.".page = 1;
		    this.".$method."();
		");
		$vue->method($current_change."(e)", " 
		    this.".$where.".page = e;
		    this.".$method."();
		");
                $str = "app.".$total." = res.total;";
		$vue->method($method,"
			ajax('".$url."',this.".$where.",function(res){
				app.".$ele." = res.data;
				".$str."
			});
		");
		return '<el-pagination class="mb5" background layout="total,prev, pager, next" :page-size="'.$where.'.per_page"
            :current-page="'.$where.'.page" @size-change="'.$size_change.'" @current-change="'.$current_change.'"
            :total="'.$total.'">
        </el-pagination>'; 
	}

}
