# vue element 

# 安装

在composer.json中添加

~~~
composer require thefunpower/element
~~~

# 使用

搜索 

~~~
<?php 
echo element("filter",[ 
    'data'=>'list',
    'url'=>'/video/group/get_pager',
    'is_page'=>true,
    'init'=>true,
    [
        'type'=>'input','name'=>'title',
        'attr_element'=>[
            'placeholder'=>'名称',
        ],
    ],
]); 
?>
~~~

表格

~~~
<?php 
echo element('table',[
    ['name'=>'open',':data'=>'list',':height'=>'height'],
    ['name'=>'column','prop'=>'title','label'=>'名称','width'=>''],
    ['name'=>'column','prop'=>'count','label'=>'成员数','width'=>''],
    ['name'=>'column','prop'=>'count','label'=>'操作','width'=>'100',
      'tpl'=>[
          ['name'=>'button','label'=>'成员','@click'=>'show_user(scope.row)'],
          ['name'=>'button','label'=>'编辑','@click'=>'edit(scope.row)','style'=>'margin-left: 20px;'],
       ]
    ],
    ['name'=>'close'],
]);
?> 
~~~

点击表格展开后显示表格或HTML

~~~
<?php 
echo element('table', [
    ['name' => 'open',':data' => 'load_list',':height' => 'height','default-expand-all'],
    ['name' => 'column','prop' => 'order_num','label' => '',
     'type' => 'expand',
     'tpl'=> [
       [ 
            "type"=>'html', 
            "html"=>element('table', [
                ['name' => 'open',':data' => 'scope.row.detail'],
                ['name' => 'column','prop' => 'sale_order_num','label' => '销售单号','width' => '200'],
                ['name' => 'column','prop' => 'customer_name','label' => '客户','width' => ''],
                ['name' => 'column','prop' => 'product_name','label' => '产品名称','width' => '200'],
                ['name' => 'column','prop' => 'product_num','label' => '产品编号','width' => '200', 
                    "tpl"=>[
                        [
                            'type'=>'html',
                            "html"=>"
                               <span :style='\"background:\"+scope.row.product_num_color'> {{scope.row.product_num}}</span>
                            "
                        ]
                    ]
                ],
                ['name' => 'column','prop' => 'product_ph','label' => '批号','width' => '200'],
                ['name' => 'column','prop' => 'product_unit','label' => '单位','width' => '80'], 
                ['name' => 'close'],
            ]) 
        ]
     ]
    ],
    ['name' => 'column','prop' => 'order_num','label' => '入库单号','width' => '200'],
    ['name' => 'column','prop' => 'num','label' => '数量','width' => ''],
    ['name' => 'close'],
]);
?>

~~~

其中`tpl`也支持直接写`type`

~~~
"tpl"=>[ 
    'type'=>'html',
    "html"=>"
       <span :style='\"background:\"+scope.row.product_num_color'> {{scope.row.product_num}}</span>
    " 
]
~~~

分页
~~~
<?php 
echo element("pager",[ 
    'data'=>'list',
    'url'=>'/video/group/get_pager', 
    'reload_data'=>[]
]); 
?> 
~~~

表单
~~~
echo element('form',[ 
    ['type'=>'open','model'=>'form','label-width'=>'180px'],
    [
        'type'=>'input','name'=>'title','label'=>'标题',
        'attr'=>['title'=>'演示标题'],
    ],
    [
        'type'=>'color','name'=>'aa31','label'=>'color', 
    ],
    [
        'type'=>'datetime','name'=>'aa32','label'=>'datetime', 
    ],
    [
        'type'=>'time','name'=>'aa33','label'=>'time', 
    ],
    [
        'type'=>'tag','name'=>'tag','label'=>'tag', 
    ],
    [
        'type'=>'sku','name'=>'sku','label'=>'sku',         
        'js'=>"app.add_media('upload_spec');"
    ],
    [
        'type'=>'checkbox','name'=>'checkbox','label'=>'多选',
        'value'=>[['label'=>'选项1','value'=>1],['label'=>'选项2','value'=>2],], 
    ],
    [
        'type'=>'radio','name'=>'radio','label'=>'radio',
        'value'=>[['label'=>'选项1','value'=>1],['label'=>'选项2','value'=>2],], 
    ],
    
    [
        'type'=>'text','name'=>'text','label'=>'text', 
        'attr'=>['required',],
        'attr_element'=>[':rows'=>10],
    ],

    [
        'type'=>'editor','name'=>'editor','label'=>'editor',  
    ],

    [
        'type'=>'attribute','name'=>'attribute','label'=>'attribute', 
        'value'=>[ ['label'=>'选项1','value'=>1],['label'=>'选项2','value'=>2],],  
    ],

    [
        'type'=>'select','name'=>'select1','label'=>'select单选', 
        'value'=>[ ['label'=>'选项1','value'=>1],['label'=>'选项2','value'=>2],],  
    ],
    [
        'type'=>'select','name'=>'select2','label'=>'select多选', 
        'value'=>[ ['label'=>'选项1','value'=>1],['label'=>'选项2','value'=>2],], 
        'attr_element'=>['multiple'],
    ],
    [
        'type'=>'date','name'=>'date1','label'=>'时间', 
        'attr'=>['title'=>''], 
        'attr_element'=>[':picker-options'=>'pickerOptions','align'=>"center"],
    ],
    [
        'type'=>'autocomplete','name'=>'aa','label'=>'autocomplete', 
        'url'=>'/video/group/autocomplete',  
    ],

    [
        'type'=>'cascader','name'=>'bb','label'=>'cascader', 
        //':props'="{ checkStrictly: true }",
        'url'=>'/video/group/cascader', 
        'attr_element'=>[':props'=>"{value:'id',label:'label'}"],
    ],

    [
        'type'=>'upload','name'=>'fiel','label'=>'上传', 
        'url'=>'/upload',
        'mime'=>'jpg',
        'multiple', 
    ],
    ['type'=>'close']
]);
~~~

ajax

~~~

public function cascader(){
    $d = \element\form::get_city(); 
    return json_success(['data'=>$d]);
}

public function autocomplete(){
    $arr[] = ['id'=>1,'value'=>'test'];
    $arr[] = ['id'=>2,'value'=>'test22'];
    return json($arr);
}
~~~

# 单独使用

## cascader 

~~~
<?php 
$url = '/form/city/index'; 
$name = 'address_top';
$model = 'form';
$attr_element = ":props={value:'id',label:'label'}";
include VEN_ELEMENT_FORM_PATH.'/cascader.php';
?> 
<el-input v-model="form.address" placeholder="详细地址"></el-input>
~~~

数据处理
~~~
$address_top = $res['address_top'];
$res['address_arr'] = [];
if($address_top){
    $res['address_arr'] = element\form::get_city_value($address_top);
} 
~~~



### 开源协议 

[Apache License 2.0](LICENSE)
