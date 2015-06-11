<?php

function get_user()
{
    $CI_Model = new CI_Model();
    $uid = $CI_Model->session->userdata('uid');
        
    $CI_Model->db->from('user');
    $CI_Model->db->where(array('uid' => $uid));
    $query = $CI_Model->db->get();
    $user2 = $query->row_array();
        
    if(!empty($user2))
    {
        $user = array('uid' => $user2['uid'], 'email' => $user2['email']);
        return $user;
    }
    else
    {
        return FALSE;
    }
        
}
    
//搜尋資料庫最大的ID
function db_search_max($_array = array('table_name' => '', 'id_name' => '', 'where_sql_array' => array(), 'return_name' => '') )
{

    $table_name = $_array['table_name'];
    $id_name = $_array['id_name'];
    $where_sql_array = isset($_array['where_sql_array']) ? $_array['where_sql_array'] : array();
    $return_name = isset($_array['return_name']) ? $_array['return_name'] : '';

    $CI_Model = new CI_Model();

    $CI_Model->db->select_max($id_name);

    if($where_sql_array)
    {
        $CI_Model->db->where($where_sql_array);
    }

        $query = $CI_Model->db->get($table_name);

        $value = $query->row_array();

        if(isset($return_name) && $return_name != '')
        {
            return $value[$return_name];
        }
        else
        {
            return $value[$id_name];
        }
    }
    
function norepeat_number()
{
    $CI_Model = new CI_Model();
    $norepeat_number = $CI_Model->config->item('norepeat_number');
    $norepeat_number = $norepeat_number + 1;
    $CI_Model->config->set_item('norepeat_number', $norepeat_number);
    echo 'this is a old function, you should change it.'.'<br>';
    return $norepeat_number;
}
    
//取得瀏覽器版本
function browser_agent()
{
    $CI_Model = new CI_Model();
    $CI_Model->load->library('user_agent');
    $browser = $CI_Model->agent->browser();
    if ($CI_Model->agent->is_mobile())
    {
        $browser_agent['agent'] = 'm';
    }
    else if($browser == 'Internet Explorer')
    {
        $browser_agent['agent'] = 'ie';
        $version = $CI_Model->agent->version();
        if($version == '8.0')
        {
            $browser_agent['agent_ie'] = 'ie8';
        }
        else if($version == '9.0')
        {
            $browser_agent['agent_ie'] = 'ie9';
        }
        else if($version == '10.0')
        {
            $browser_agent['agent_ie'] = 'ie10';
        }
        else if($version == '11.0')
        {
            $browser_agent['agent_ie'] = 'ie11';
        }
        $browser_agent['browser_ie'] = 'agent-'.$browser_agent['agent_ie'];
    }
    else if(stripos($_SERVER['HTTP_USER_AGENT'],'rv:')>0 && stripos($_SERVER['HTTP_USER_AGENT'],'Gecko')>0)
    {
        $browser_agent['agent'] = 'ie';
        $browser_agent['agent_ie'] = 'ie11';
        $browser_agent['browser_ie'] = 'agent-'.$browser_agent['agent_ie'];
    }
    else if($browser == 'Chrome')
    {
        $browser_agent['agent'] = 'chrome';
    }
    else if($browser == 'Firefox')
    {
        $browser_agent['agent'] = 'firefox';
    }
    else
    {
        $browser_agent['agent'] = 'other';
    }

    $browser_agent['browser'] = 'agent-'.$browser_agent['agent'];
    $browser_agent['agent_temp'] = '_'.$browser_agent['agent'];

    return $browser_agent;
}

function bbcode_convert($arg)
{
    // 移除 HTML tags
    $string = htmlentities($arg, ENT_QUOTES);
 
    $bbcode_search = array(
                '/[b](.*?)[/b]/is',
                '/[i](.*?)[/i]/is',
                '/[u](.*?)[/u]/is',
                '/[url=(.*?)](.*?)[/url]/is',
                '/[url](.*?)[/url]/is',
                '/[img](.*?)[/img]/is'
                );
 
    $bbcode_replace = array(
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<u>$1</u>',
                '<a href="$1">$2</a>',
                '<a href="$1">$1</a>',
                '<img src="$1" />'
                );
 
    return preg_replace($bbcode_search, $bbcode_replace, $string);
}

//文字切換
function html_code_replace($arg)
{
	$text = $arg['text'];
	$meta_all = isset($arg['meta_all']) && $arg['meta_all'] === TRUE ? TRUE : FALSE;
	$meta_img = isset($arg['meta_img']) && $arg['meta_img'] === TRUE ? TRUE : FALSE;
	$meta_url = isset($arg['meta_url']) && $arg['meta_url'] === TRUE ? TRUE : FALSE;
	$meta_b = isset($arg['meta_b']) && $arg['meta_b'] === TRUE ? TRUE : FALSE;
	$meta_red = isset($arg['meta_red']) && $arg['meta_red'] === TRUE ? TRUE : FALSE;
	$nl2br = isset($arg['nl2br']) && $arg['nl2br'] === TRUE ? TRUE : FALSE;
	$length = isset($arg['length']) ? $arg['length'] : 0;
	$dot = isset($arg['dot']) ? $arg['dot'] : ' ...';

	if($nl2br == TRUE){
		$text = nl2br($text);
	}
	if($meta_img === TRUE || $meta_all === TRUE){
		$text = preg_replace("/\[(img)\](.+?)\[\/\\1\]/si", '<img src="\\2" \\>', $text);
	}
	if($meta_url == true || $meta_all == true){
		$text = preg_replace("/\[(url)\](.+?)\[\/\\1\]/si", '<a href="\\2" target="_blank" \\>\\2</a>', $text);
	}
	if($meta_b == true || $meta_all == true){
		$text = preg_replace('#\[b\](.*?)\[/b\]#si', '<b>\1</b>', $text);
	}
	if($meta_red == true || $meta_all == true){
		$text = preg_replace('#\[red\](.*?)\[/red\]#si', '<span style="color:red;">\1</span>', $text);
	}
	if($length) {
		$text = cutstr($text, $length, $dot);
	}
	$text = trim($text);
	return $text;
}
    
function check_comma_array(&$ids_Str, &$ids_Arr)
{
    if(empty($ids_Arr) && !empty($ids_Str))
    {
        $ids_Arr = explode(',', $ids_Str);
    }
    else if(empty($ids_Str) && !empty($ids_Arr))
    {
        $ids_Str = implode(',', $ids_Arr);
    }
    
    $id_set_Arr = array();
    if(is_array($ids_Arr))
    {
        foreach($ids_Arr as $key => $value)
        {
            if($value == 0 || in_array($value, $id_set_Arr))
            {
                unset($ids_Arr[$key]);
            }
            $id_set_Arr[] = $value;
        }
    }
    if(is_array($ids_Arr))
    {
        $ids_Str = implode(',', $ids_Arr);
    }
    $ids_Arr = explode(',', $ids_Str);
}

//引入引數並將空值的變數給予空值
function reset_null_arr(&$arg1, $arg2)
{
    foreach($arg2 as $key)
    {
        if(empty($arg1[$key]))
        {
            $arg1[$key] = NULL;
        }
    }
}

function getfile_from_files($arg)
{
    $files_Arr = !empty($arg['files_Arr']) ? $arg['files_Arr'] : array();
    $key_Str = !empty($arg['key_Str']) ? $arg['key_Str'] : 0;

    $return_files_Arr['name'] = $files_Arr['name'][$key_Str];
    $return_files_Arr['type'] = $files_Arr['type'][$key_Str];
    $return_files_Arr['size'] = $files_Arr['size'][$key_Str];
    $return_files_Arr['tmp_name'] = $files_Arr['tmp_name'][$key_Str];
    $return_files_Arr['error'] = $files_Arr['error'][$key_Str];

    return $return_files_Arr;
}

function nrnum()//no repeat number
{
    $FS_model = new CI_model();
    $norepeat_number = $FS_model->config->item('norepeat_number');
    $norepeat_number = $norepeat_number + 1;
    $FS_model->config->set_item('norepeat_number', $norepeat_number);
    return $norepeat_number;
}

function nokey_to_typekey($arg)
{
    $nokey_Arr = $arg;
    
    if(is_array($nokey_Arr))
    {
        foreach($nokey_Arr as $key => $value_Arr)
        {
            $construct_Arr[$key.'_Num'] = $nokey_Arr[$key];
            $construct_Arr[$key.'_Str'] = $nokey_Arr[$key];
        }
    }
    
    if(!empty($construct_Arr))
    {
        return $construct_Arr;
    }
    else
    {
        return FALSE;
    }
}

function typekey_to_nokey($arg)
{
    $type_Arr = $arg;
    
    if(!empty($type_Arr))
    {
        foreach($type_Arr as $key => $value_Arr)
        {
            if(strpos($key, '_Str'))
            {
                $new_key_Arr = explode('_Str', $key);
                $new_key_Str = $new_key_Arr[0];
            }
            else if(strpos($key, '_Num'))
            {
                $new_key_Arr = explode('_Num', $key);
                $new_key_Str = $new_key_Arr[0];
            }
            else
            {
                $new_key_Str = $key;
            }
            $construct_Arr[$new_key_Str] = $type_Arr[$key];
            $construct_Arr[$new_key_Str] = $type_Arr[$key];
        }
    }
    
    if(!empty($construct_Arr))
    {
        return $construct_Arr;
    }
    else
    {
        return FALSE;
    }
}

//以F12物件模式輸出
//ex:
//$data['temp']['js'][] = js_console_log($arg);
function js_console_log($arg)
{
    if(is_array($arg) == TRUE || is_object($arg) == TRUE)
	{
		return "<script>console.log({'js_console_log': ".json_encode($arg)."});</script>";
	}
    else
    {
		return "<script>console.log({'js_console_log': ".$arg."});</script>";
	}
}

//輸出排列整齊的陣列
function pre($arg)
{
    echo '<pre>';
    print_r($arg);
    echo '</pre>';
}

//快速輸出加中斷點
function echoe($arg)
{
    if(is_array($arg) || is_object($arg))
    {
        pre($arg);
    }
    else
    {
        echo $arg;
    }
    exit;
}

?>