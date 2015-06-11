<?php

class SettingList extends ObjList
{

    public function construct($arg)
    {
        $construct_Arr = !empty($arg['construct_Arr']) ? $arg['construct_Arr'] : array() ;

        parent::construct(array(
            'construct_Arr' => $arg['construct_Arr'],
            'model_name_Str' => 'Setting',
            'startcount_Num' => 0,
            'limitcount_Num' => 100
        ));
    }

    public function construct_db($arg)
    {
        $db_where_Arr = !empty($arg['db_where_Arr']) ? $arg['db_where_Arr'] : array() ;
        parent::construct_db(array(
            'db_where_Arr' => $arg['db_where_Arr'],
            'model_name_Str' => 'Setting',
            'startcount_Num' => 0,
            'limitcount_Num' => 100
        ));
    }

    public function get_array()
    {
        foreach($this->obj_Arr as $key => $value_Setting)
        {
            $keyword_Str = $value_Setting->keyword_Str;
            $setting_Arr[$keyword_Str] = $value_Setting->value_Str;
        }

        if(!empty($setting_Arr))
        {
            return $setting_Arr;
        }
        else
        {
            return array();
        }
    }

}