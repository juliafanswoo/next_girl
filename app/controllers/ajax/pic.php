<?php
		
class pic_controller extends FS_controller {
	
	public function delete_pic($do, $picid = 0)
	{
		global $admin;
        $data = $this->common_model->data;
        $child_name = 'postpic';//管理分類類別名稱
		
		if( !empty($picid) )
        {
            $PicObj = new PicObj();
            $PicObj->construct(array('picid_Num' => $picid));
            $PicObj->delete();
            return TRUE;
		}
        else
        {
            return FALSE;
        }
	}
    
}

?>