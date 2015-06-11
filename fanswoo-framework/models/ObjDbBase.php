<?php

class ObjDbBase extends ObjBase {

    public $db_name_Str = '';//填寫物件聯繫資料庫之名稱，例如'product_shop'
    public $db_name_Arr = array();//填寫物件聯繫資料庫之陣列，例如'array('note', 'note_field')'，若同時擁有db_name_Str和db_name_Arr兩個屬性，以db_name_Arr為優先
    public $db_uniqueid_Str = '';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
//        'productid' => 'productid_Num',
//        'uid' => 'uid_Num',
//        'title' => 'title_Str'
    );

    public function construct()
    {

    }
    
    protected function get_db_field()
    {
        
//      實作範例
        $db_field_to_this_Arr = $this->db_field_Arr;
        
        foreach($db_field_to_this_Arr as $key => $value)
        {
            if(is_array($value))
            {
                $db_field_Arr[$key] = $this->$value[0]->$value[1];
            }
            else
            {
                $db_field_Arr[$key] = $this->$value;
            }
        }
        
        return $db_field_Arr;
    }
    
	public function construct_db($arg)
    {
        $db_where_Arr = !empty($arg['db_where_Arr']) ? $arg['db_where_Arr'] : array();
        $db_where_deletenull_Bln = isset($arg['db_where_deletenull_Bln']) && $arg['db_where_deletenull_Bln'] !== TRUE ? FALSE : TRUE ;
        $db_name_Str = $this->db_name_Str;
        $db_name_Arr = $this->db_name_Arr;
        $db_uniqueid_Str = $this->db_uniqueid_Str;

        //若db_where_deletenull_Bln為真，則讓空值可通過db_where_Arr內為空值的搜尋條件
        if($db_where_deletenull_Bln)
        {
            foreach($db_where_Arr as $key => $value)
            {
                if(empty($value))
                {
                    unset($db_where_Arr[$key]);
                }
            }
        }
        else
        {
            $db_where_Arr2 = $db_where_Arr;
            foreach($db_where_Arr as $key => $value)
            {
                if(empty($value))
                {
                    $db_where_Arr2[$key] = '';
                }
            }
            $db_where_Arr = $db_where_Arr2;
        }
        if(empty($db_where_Arr))
        {
            $this->construct(array());
            return FALSE;
        }
        
        if(empty($db_where_Arr['status']))
        {
            $db_where_Arr['status'] = 1;
        }

        $db_where_Arr = typekey_to_nokey($db_where_Arr);

        if(!empty($db_name_Arr))
        {
            //如果沒有fs_usr_field_shop的話就創建一個資料庫
            $db_uniqueid_value_Num = $db_where_Arr[$db_name_Arr[0].'.'.$db_uniqueid_Str];
            foreach($db_name_Arr as $key => $value_Str)
            {
                $this->db->from($value_Str);
                $this->db->where($db_uniqueid_Str, $db_uniqueid_value_Num);
                $query = $this->db->get();
                    
                if($query->num_rows() == 0)
                {
                    $this->db->insert($value_Str, array($db_uniqueid_Str => $db_uniqueid_value_Num));
                }
            }
            foreach($db_name_Arr as $key => $value_Str)
            {
                if($key == 0)
                {
                    $this->db->from($value_Str);
                }
                else
                {
                    $this->db->join($value_Str, $db_name_Arr[0].'.'.$db_uniqueid_Str.' = '.$value_Str.'.'.$db_uniqueid_Str, 'left');
                }
            }
        }
        else
        {
            $this->db->from($db_name_Str);
        }
        
        if(!empty($db_where_Arr))
        {
            if(!empty($db_name_Arr))
            {
                $db_where_Arr2 = $db_where_Arr;
                $db_where_Arr = array();
                foreach($db_where_Arr2 as $key => $value)
                {
                    $db_where_Arr[$key] = $value;
                }
                $this->db->where($db_where_Arr);
            }
            else
            {
                $this->db->where($db_where_Arr);
            }
        }
		$query = $this->db->get();
		$construct_Arr = $query->row_array();
        
        $this->construct(nokey_to_typekey($construct_Arr));
    }
    
    //將物件資料更新至資料庫
	public function update($arg = [])
	{
        $db_update_Arr = !empty($arg['db_update_Arr']) ? $arg['db_update_Arr'] : array();
        
        if(!empty($db_update_Arr['status']))
        {
            unset($db_update_Arr['status']);
        }

        $db_uniqueid_Str = $this->db_uniqueid_Str;
        $db_name_Str = $this->db_name_Str;
        $db_name_Arr = $this->db_name_Arr;
        
        $db_field_Arr = $this->get_db_field();
        
        if(empty($db_field_Arr[$db_uniqueid_Str]))
        {
            if(!empty($db_name_Arr))
            {
                $db_uniqueid_Num = db_search_max(array(
                    'table_name' => $db_name_Arr[0],
                    'id_name' => $db_uniqueid_Str
                )) + 1;

                foreach($db_name_Arr as $key => $value_Str)
                {
                    $db_field_Arr2 = array();
                    foreach($db_field_Arr as $key2 => $value2_Str)
                    {
                        $key_string_Arr = explode('.', $key2);
                        if($key_string_Arr[0] == $value_Str)
                        {
                            $key_string = $key_string_Arr[1];
                            $db_field_Arr2[$key_string] = $db_field_Arr[$key2];
                        }
                    }
                    $db_field_Arr2[$db_uniqueid_Str] = $db_uniqueid_Num;
                    $this->$db_uniqueid_Str = $db_uniqueid_Num;
                    $this->db->insert($db_name_Arr[$key], $db_field_Arr2);
                }
            }
            else
            {
                $db_uniqueid_Num = db_search_max(array(
                    'table_name' => $db_name_Str,
                    'id_name' => $db_uniqueid_Str
                )) + 1;
                $db_field_Arr[$db_uniqueid_Str] = $db_uniqueid_Num;
                $db_uniqueid_Str = $db_uniqueid_Str.'_Num';
                $this->$db_uniqueid_Str = $db_uniqueid_Num;
                $this->db->insert($db_name_Str, $db_field_Arr);
            }
        }
        else
        {
            if(!empty($db_update_Arr))
            {
                foreach($db_field_Arr as $key => $value)
                {
                    if(!in_array($key, $db_update_Arr) && $key !== $db_uniqueid_Str)
                    {
                        unset($db_field_Arr[$key]);
                    }
                }
            }
            if(!empty($db_name_Arr))
            {
                foreach($db_name_Arr as $key => $value_Str)
                {
                    $db_field_Arr2 = array();
                    foreach($db_field_Arr as $key2 => $value2_Str)
                    {
                        $key_string_Arr = explode('.', $key2);
                        if($key_string_Arr[0] == $value_Str)
                        {
                            $key_string = $key_string_Arr[1];
                            $db_field_Arr2[$key_string] = $db_field_Arr[$key2];
                        }
                    }
                    $db_field_Arr2[$db_uniqueid_Str] = $db_field_Arr[$db_uniqueid_Str];
                    $this->db->where(array($db_uniqueid_Str => $db_field_Arr[$db_uniqueid_Str]));
                    $this->db->update($db_name_Arr[$key], $db_field_Arr2);
                }
            }
            else
            {
                $this->db->where(array($db_uniqueid_Str => $db_field_Arr[$db_uniqueid_Str]));
                $this->db->update($db_name_Str, $db_field_Arr);
            }
        }
    }
    
    //資料status_Num屬性為紀錄該筆物件之狀態
    //status=-1為刪除
    //status=0為建構中
    //status=1為正常啟用
    //status=2為隱藏

    //復原這筆資料，將資料狀態改為1
    public function recovery()
    {
        $db_uniqueid_Str = $this->db_uniqueid_Str;
        $db_name_Str = $this->db_name_Str;

        $db_uniqueid_Str_Num = $db_uniqueid_Str.'_Num';
        $db_uniqueid_Num = $this->$db_uniqueid_Str_Num;

        $this->db->where(array(
            $db_uniqueid_Str => $db_uniqueid_Num
        ));
        $this->db->update($db_name_Str, array('status' => 1) ); 
    }

    //隱藏這筆資料，將資料狀態改為2
    public function hidden()
    {
        $db_uniqueid_Str = $this->db_uniqueid_Str;
        $db_name_Str = $this->db_name_Str;

        $db_uniqueid_Str_Num = $db_uniqueid_Str.'_Num';
        $db_uniqueid_Num = $this->$db_uniqueid_Str_Num;

        $this->db->where(array(
            $db_uniqueid_Str => $db_uniqueid_Num
        ));
        $this->db->update($db_name_Str, array('status' => 2) ); 
    }

    //刪除這筆資料，將資料狀態改為-1
    public function delete()
    {
        $db_uniqueid_Str = $this->db_uniqueid_Str;
        $db_name_Str = $this->db_name_Str;

        $db_uniqueid_Str_Num = $db_uniqueid_Str.'_Num';
        $db_uniqueid_Num = $this->$db_uniqueid_Str_Num;

        $this->db->where(array(
            $db_uniqueid_Str => $db_uniqueid_Num
        ));
        $this->db->update($db_name_Str, array('status' => -1) ); 
    }

    //永久銷毀這筆資料
    public function destroy()
    {
        $db_uniqueid_Str = $this->$db_uniqueid_Str;
        $db_name_Str = $this->db_name_Str;

        $db_uniqueid_Str_Num = $db_uniqueid_Str.'_Num';
        $db_uniqueid_Num = $this->$db_uniqueid_Str_Num;

        $this->db->where(array(
            $db_uniqueid_Str => $db_uniqueid_Num
        ));
        $this->db->update($db_name_Str, array('status' => -1) ); 
    }
	
}