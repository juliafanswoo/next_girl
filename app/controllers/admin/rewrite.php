<?php

class rewrite_controller extends FS_controller
{
	
	public function index()
	{
        $this->config->load('admin', TRUE);
        $group_purview_Arr = $this->config->item('group_purview_Arr', 'admin');
        $admin_sidebox = $this->config->item('admin_sidebox', 'admin');

        $data['User'] = new User();
        $data['User']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $this->session->userdata('uid')
            )
        ));

        $groupid_Num = $data['User']->group_UserGroupList->obj_Arr[0]->groupid_Num;
        $sidebox_title1_Str = $group_purview_Arr[$groupid_Num][0][0];
        $sidebox_title2_Str = $group_purview_Arr[$groupid_Num][0][1];
        $sidebox_title3_Str = $group_purview_Arr[$groupid_Num][0][2];
        $sidebox_title4_Str = key($admin_sidebox[$sidebox_title1_Str]['child2'][$sidebox_title2_Str]['child3'][$sidebox_title3_Str]['child4']);

        if(!empty($sidebox_title1_Str) && !empty($sidebox_title2_Str) && !empty($sidebox_title3_Str) && !empty($sidebox_title4_Str))
        {
            $url_Str = base_url("admin/$sidebox_title1_Str/$sidebox_title2_Str/$sidebox_title3_Str/$sidebox_title4_Str");
        }
        else
        {
            $url_Str = base_url("user/login/?url=admin");
        }
        header("Location: $url_Str");
	}
	
}

?>