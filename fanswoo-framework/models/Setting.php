<?php

class Setting extends ObjDbBase
{

    public $keyword_Num = '';
    public $keyword_Str = '';
    public $value_Str = '';
    public $modelname_Str = '';
    public $status_Num = 1;
    public $db_name_Str = 'setting';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'keyword';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'keyword' => 'keyword_Str',
        'value' => 'value_Str',
        'modelname' => 'modelname_Str',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        $keyword_Num = empty($arg['keyword_Num']) ? '' : $arg['keyword_Num'] ;
        $keyword_Str = empty($arg['keyword_Str']) ? '' : $arg['keyword_Str'] ;
        $value_Str = empty($arg['value_Str']) ? '' : $arg['value_Str'];
        $modelname_Str = empty($arg['modelname_Str']) ? '' : $arg['modelname_Str'];
        $status_Num = empty($arg['status_Num']) ? 1 : $arg['status_Num'];
        
        //set
        $this->keyword_Num = $keyword_Num;
        $this->keyword_Str = $keyword_Str;
        $this->value_Str = $value_Str;
        $this->modelname_Str = $modelname_Str;
        $this->status_Num = $status_Num;

        return TRUE;
    }
	
    //將物件資料更新至資料庫
    public function update()
    {
        $db_name_Str = $this->db_name_Str;
        
        $db_field_Arr = $this->get_db_field();
        
        $this->db->from('setting');
        $this->db->where(array(
            'keyword' => $db_field_Arr['keyword']
        ));
        $query = $this->db->get();
        $setting_Arr = $query->row_array();

        if(!empty($setting_Arr['keyword']))
        {
            $this->db->where(array('keyword' => $db_field_Arr['keyword']));
            $this->db->update($db_name_Str, $db_field_Arr);
        }
        else
        {
            $this->db->insert($db_name_Str, $db_field_Arr);
        }
    }

}