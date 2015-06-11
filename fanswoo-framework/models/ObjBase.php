<?php

class ObjBase extends CI_Model {

    public function get($arg)
    {
        $name_Str = $arg;
        return $this->$name_Str;
    }

    //本set方法提供設置屬性值之功能，並提供ClassMetaList、PicObjList、DateTimeObj等簡易物件建構之方法，但其它未提及之方法或有內定值之屬性，應另外撰寫set__x()之方法設置屬性
    public function set($arg1, $arg2, $arg3 = NULL)
    {
        $name_Str = $arg1;
        $value_Str = $arg2;
        if($arg3 === 'DateTimeObj')
        {
            //引入引數並將空值的變數給予空值
            reset_null_arr($arg2, ['datetime_Str', 'inputtime_date_Str', 'inputtime_time_Str']);
            foreach($arg2 as $key => $value) ${$key} = $arg2[$key];

            //建立DateTime物件
            $value_Str = new DateTimeObj();
            $value_Str->construct(array(
                'datetime_Str' => $datetime_Str,
                'inputtime_date_Str' => $inputtime_date_Str,
                'inputtime_time_Str' => $inputtime_time_Str
            ));
        }
        else if($arg3 === 'ClassMetaList')
        {
            //引入引數並將空值的變數給予空值
            reset_null_arr($arg2, ['classids_Str', 'classids_Arr']);
            foreach($arg2 as $key => $value) ${$key} = $arg2[$key];

            //建立ClassMetaList物件
            check_comma_array($classids_Str, $classids_Arr);
            $value_Str = new ObjList();
            $value_Str->construct_db(array(
                'db_where_or_Arr' => array(
                    'classid_Num' => $classids_Arr
                ),
                'model_name_Str' => 'ClassMeta',
                'limitstart_Num' => 0,
                'limitcount_Num' => 100
            ));
        }
        else if($arg3 === 'PicObjList')
        {
            //引入引數並將空值的變數給予空值
            reset_null_arr($arg2, ['picids_Str', 'picids_Arr']);
            foreach($arg2 as $key => $value) ${$key} = $arg2[$key];

            //建立PicObjList物件
            check_comma_array($picids_Str, $picids_Arr);
            $value_Str = new ObjList();
            $value_Str->construct_db(array(
                'db_where_or_Arr' => array(
                    'picid_Num' => $picids_Arr
                ),
                'model_name_Str' => 'PicObj',
                'limitstart_Num' => 0,
                'limitcount_Num' => 100
            ));
        }

        if($value_Str === NULL)
        {
            return FALSE;
        }
        else
        {
            $this->$name_Str = $value_Str;
            return $this->$name_Str;
        }
    }
	
}