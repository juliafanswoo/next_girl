<?php

class DateTimeObj extends CI_Model {

    public $datetime_Str = '';//ex:1988-02-26 19:31:00
    public $unix_Num = 0;//ex:1234567890
    public $getdate_Arr = '';//ex:['year','month','date','hour','minute','second']
    public $inputtime_date_Str = '';//ex:1988-02-26
    public $inputtime_time_Str = '';//ex:19:31:00
	
	public function construct($arg)
	{
            
        $datetime_Str = !empty($arg['datetime_Str']) ? $arg['datetime_Str'] : '';//ex:1988-02-26 19:31:00
        $unix_Num = !empty($arg['unix_Num']) ? $arg['unix_Num'] : 0;//ex:1234567890
        $inputtime_date_Str = !empty($arg['inputtime_date_Str']) ? $arg['inputtime_date_Str'] : '';//ex:1988-02-26
        $inputtime_time_Str = !empty($arg['inputtime_time_Str']) ? $arg['inputtime_time_Str'] : '';//ex:19:31:00
        
        if(!empty($inputtime_date_Str) && !empty($inputtime_time_Str))
        {
            $datetime_Str = $inputtime_date_Str.' '.$inputtime_time_Str;
            $unix_Num = strtotime($datetime_Str);
            $getdate_Arr = getdate($unix_Num);
        }
        else if(!empty($datetime_Str) && $datetime_Str !== '0000-00-00 00:00:00')
        {
            $inputtime_Arr = explode(' ', $datetime_Str);
            $inputtime_date_Str = $inputtime_Arr[0];
            $inputtime_time_Str = $inputtime_Arr[1];
            $unix_Num = strtotime($datetime_Str);
            $getdate_Arr = getdate($unix_Num);
        }
        else if(!empty($unix_Num))
        {
            $getdate_Arr = getdate($unix_Num);
            $datetime_Str = date('Y-m-d H:i:s', $unix_Num);
            $inputtime_Arr = explode(' ', $datetime_Str);
            $inputtime_date_Str = $inputtime_Arr[0];
            $inputtime_time_Str = $inputtime_Arr[1];
        }
        else
        {
            $FS_model = new FS_model();
            $timenow = $FS_model->config->item('timenow');
            
            $unix_Num = $timenow;
            $datetime_Str = date('Y-m-d H:i:s', $unix_Num);
            $inputtime_Arr = explode(' ', $datetime_Str);
            $inputtime_date_Str = $inputtime_Arr[0];
            $inputtime_time_Str = $inputtime_Arr[1];
            $getdate_Arr = getdate($unix_Num);
        }
        
        //set
        $this->unix_Num = $unix_Num;
        $this->getdate_Arr = $getdate_Arr;
        $this->datetime_Str = $datetime_Str;
        $this->inputtime_date_Str = $inputtime_date_Str;
        $this->inputtime_time_Str = $inputtime_time_Str;
        
        return TRUE;
    }
	
}