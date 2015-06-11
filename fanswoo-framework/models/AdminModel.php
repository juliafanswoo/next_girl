<?php

class AdminModel extends FS_Model {

    public $child1_name_Str = '';
    public $child2_name_Str = '';
    public $child3_name_Str = '';
    public $child4_name_Str = '';
    public $child1_title_Str = '';
    public $child2_title_Str = '';
    public $child3_title_Str = '';
    public $child4_title_Str = '';
    public $admin_child_url_Str = '';
    public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->config->load('admin', TRUE);

		$data['User'] = new User();
		$data['User']->construct_db(array(
			'db_where_Arr' => array(
				'uid_Num' => $this->session->userdata('uid')
			)
		));
		$this->data = $data;
	}

	public function get_data($arg)
	{
		$data = $this->data;
		$child4_name_Str = !empty($arg['child4_name_Str']) ? $arg['child4_name_Str'] : '';

        $child1_name_Str = $this->child1_name_Str;
        $child2_name_Str = $this->child2_name_Str;
        $child3_name_Str = $this->child3_name_Str;
		$child_data_Arr = $this->get_child($child4_name_Str);
		$group_purview_Arr = $this->config->item('group_purview_Arr', 'admin');

		$data_Arr['admin_sidebox'] = $this->reset_sidebox();
		$data_Arr = array_merge($data_Arr, $child_data_Arr);

		$group_purview_Bln = FALSE;
		foreach($data['User']->group_UserGroupList->uniqueids_Arr as $key => $value_Num)
		{
			if(
				!empty($group_purview_Arr[$value_Num]) &&
				is_array($group_purview_Arr[$value_Num])
			)
			{
				foreach($group_purview_Arr[$value_Num] as $key => $value_Arr)
				{
					if(
						$value_Arr[0] === $child1_name_Str &&
						$value_Arr[1] === $child2_name_Str &&
						$value_Arr[2] === $child3_name_Str
					)
					{
						$group_purview_Bln = TRUE;
						break;
					}
				}
			}
		}

        if($group_purview_Bln !== TRUE)
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '沒有觀看權限',
                'url' => 'admin'
            ));
        }

        //沒有這個頁面
        if ( ! file_exists('app/views/admin/'.$data_Arr['admin_child_url_Str']))
        {
            show_404();
        }

		return $data_Arr;
	}

	public function get_child($arg)
	{
		$child4_name_Str = $arg;

        $child1_name_Str = $this->child1_name_Str;
        $child2_name_Str = $this->child2_name_Str;
        $child3_name_Str = $this->child3_name_Str;

		$admin_sidebox = $this->config->item('admin_sidebox', 'admin');

        $this->child4_name_Str = $child4_name_Str;

		$this->child1_title_Str = $admin_sidebox[$child1_name_Str]['title'];
		$this->child2_title_Str = $admin_sidebox[$child1_name_Str]['child2'][$child2_name_Str]['title'];
		$this->child3_title_Str = $admin_sidebox[$child1_name_Str]['child2'][$child2_name_Str]['child3'][$child3_name_Str]['title'];
		$this->child4_title_Str = $admin_sidebox[$child1_name_Str]['child2'][$child2_name_Str]['child3'][$child3_name_Str]['child4'][$child4_name_Str]['title'];

		$this->admin_child_url_Str = $this->child1_name_Str.'/'.$this->child2_name_Str.'/'.$this->child3_name_Str.'/'.$this->child4_name_Str.'.php';

		$return_Arr = array(
			'child1_name_Str' => $this->child1_name_Str,
			'child2_name_Str' => $this->child2_name_Str,
			'child3_name_Str' => $this->child3_name_Str,
			'child4_name_Str' => $this->child4_name_Str,
			'child1_title_Str' => $this->child1_title_Str,
			'child2_title_Str' => $this->child2_title_Str,
			'child3_title_Str' => $this->child3_title_Str,
			'child4_title_Str' => $this->child4_title_Str,
			'admin_child_url_Str' => $this->admin_child_url_Str
		);

		return $return_Arr;
	}

	public function reset_sidebox()
	{
		$data = $this->data;

		$child1_name_Str = $this->child1_name_Str;
		$child2_name_Str = $this->child2_name_Str;
		$child3_name_Str = $this->child3_name_Str;
		$child4_name_Str = $this->child4_name_Str;
		$admin_sidebox = $this->config->item('admin_sidebox', 'admin');
		$group_purview_Arr = $this->config->item('group_purview_Arr', 'admin');

		$child1_display_array[] = array();
		$child2_display_array[] = array();
		$child3_display_array[] = array();
		foreach($data['User']->group_UserGroupList->uniqueids_Arr as $key => $value_Num)
		{
			if(
				!empty($group_purview_Arr[$value_Num]) &&
				is_array($group_purview_Arr[$value_Num])
			)
			{
				foreach($group_purview_Arr[$value_Num] as $key => $value_Arr)
				{
					$child1_display_array[] = $value_Arr[0];
					$child2_display_array[] = $value_Arr[1];
					$child3_display_array[] = $value_Arr[2];
				}
			}
		}

		foreach($admin_sidebox as $key => $child1)
		{
	        if( in_array($key, $child1_display_array))
	        {
		        foreach($child1['child2'] as $key2 => $child2)
		        {
		            if(in_array($key2, $child2_display_array))
		            {
			            foreach($child2['child3'] as $key3 => $child3)
			            {
				            if(in_array($key3, $child3_display_array))
				            {
					            foreach($child3['child4'] as $key4 => $child4)
					            {
						            if(
						                $key == $child1_name_Str &&
						                $key2 == $child2_name_Str &&
						                $key3 == $child3_name_Str &&
						                $key4 == $child4_name_Str
						            )
						            {
						                $admin_sidebox[$key]['child2'][$key2]['child3'][$key3]['child4'][$key4]['select'] = TRUE;
						                $admin_sidebox[$key]['child2'][$key2]['select'] = TRUE;
						                $admin_sidebox[$key]['select'] = TRUE;
						            }
						        }
					    	}
					    	else
					    	{
		                		unset($admin_sidebox[$key]['child2'][$key2]['child3'][$key3]);
					    	}
			            }
		            }
		            else
		            {
		                unset($admin_sidebox[$key]['child2'][$key2]);
		            }
		        }
	        }
	        else
	        {
	            unset($admin_sidebox[$key]);
	        }
		}
		return $admin_sidebox;
	}
	
}