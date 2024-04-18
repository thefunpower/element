<?php 
namespace element;

class filter{

	public static function create($arr = []){
		global $vue;
		$per_page = $arr['per_page']?:10;unset($arr['per_page']);
		$is_page = $arr['is_page'];unset($arr['is_page']);
		$url = $arr['url'];unset($arr['url']);
		$ele = $arr['data'];unset($arr['data']);
		$method = 'load_filter_'.$ele;
		$where  = 'filter_'.$ele;
		$total  = 'filter_total_'.$ele;
		foreach($arr as &$vv){
			$change = "change";
			if($vv['type'] == 'input'){
				$change = "input";
			}
			$vv['attr_element']['@'.$change] = $method."()";
		} 
		form::$model = $where;
		array_unshift($arr,['type'=>'open',":inline"=>true ]);  
		$arr[] = ['type'=>'close']; 
		$str = '';
		if($is_page){
			$str = "app.".$total." = res.total;";
		}
		$vue->data($total,0);
		$vue->data($where,"{per_page:".$per_page.",page:1}");
		$vue->method($method,"
			ajax('".$url."',this.".$where.",function(res){
				app.".$ele." = res.data;
				".$str."
			});
		");
		return form::create($arr); 
	}

}