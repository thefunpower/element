<?php

namespace element;

/**
* 创建表格
*/
class table
{
    public static function create($arr = [])
    {
        $str = '';
        foreach($arr as $k => $v) {
            $name = $v['name'];
            $str .= self::$name($v);
        }
        return $str;
    }

    public static function open($arr = [])
    {
        $arr['type'] = $arr['type'] ?: 'small';
        return "<el-table " . element_to_str($arr)." border>\n";
    }
    /**
    * [
    * 'prop'=>'title',
    * 'width'=>'100',
    * 'label'=>'标题',
    * 'tpl'=>[
    * [
    * 'name'=>'button',
    * 'label'=>'编辑',
    * '@click'=>''
    * ]
    * ]
    * ]
    */
    public static function column($arr = [])
    {
        $tpl = $arr['tpl'];
        unset($arr['tpl']);
        $str = "<el-table-column " . element_to_str($arr).">\n";
        if($tpl) {
            $str .= "<template slot-scope='scope'>\n";
            foreach($tpl as $k => $v) {
                $str .= self::element($v);
            }
            $str .= "</template>\n";
        }
        $str .= "</el-table-column>\n";
        return $str;
    }

    public static function element($arr = [])
    {
        $name = $arr['name'];
        $label = $arr['label'];
        unset($arr['name'],$arr['label']);
        $arr['type'] = $arr['type'] ?: 'text';
        $arr['size'] = $arr['size'] ?: 'small';
        return '<el-'.$name.' '. element_to_str($arr).'>'.$label.'</el-'.$name.'>'."\n";
    }

    public static function span($arr = [])
    {
        $name = $arr['name'];
        $label = $arr['label'];
        unset($arr['name'],$arr['label']);
        if(strpos($label, 'scope.') !== false && strpos($label, '{') === false) {
            $label = "{{".$label."}}";
        }
        return '<span '. element_to_str($arr).'>'.$label.'</span>'."\n";
    }


    public static function close()
    {
        return "</el-table>";
    }
}
