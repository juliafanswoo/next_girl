<?php

class PicObj extends ObjDbBase {

    public $picid_Num = 0;
    public $uid_Num = 0;
    public $title_Str = '';
    public $filename_Str = '';
    public $size_Num = '';
    public $type_Str = '';
    public $md5_Str = '';
    public $class_ClassMetaList;
    public $picfile_FileArr = array();
    public $modelname_Str = 'w50h50,w300h300';
    public $thumb_Str = '';//ex: w50h50,w300h300
    public $path_Arr = array();
    //ex: array('w0h0' => 'app/pic/00/52/85/01-abcdefg-w100h100.jpg', 'w100h100' => 'app/pic/00/52/85/01-abcdefg-w100h100.jpg')
    public $prioritynum_Num = 0;
    public $updatetime_DateTime;
    public $status_Num = 1;
    public $db_name_Str = 'pic';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'picid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'picid' => 'picid_Num',
        'uid' => 'uid_Num',
        'title' => 'title_Str',
        'thumb' => 'thumb_Str',
        'filename' => 'filename_Str',
        'size' => 'size_Num',
        'type' => 'type_Str',
        'md5' => 'md5_Str',
        'classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'prioritynum' => 'prioritynum_Num',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        $picid_Num = !empty($arg['picid_Num']) ? $arg['picid_Num'] : 0 ;
        $uid_Num = !empty($arg['uid_Num']) ? $arg['uid_Num'] : array() ;
        $picfile_FileArr = !empty($arg['picfile_FileArr']) ? $arg['picfile_FileArr'] : array() ;
        $thumb_Str = !empty($arg['thumb_Str']) ? $arg['thumb_Str'] : 'w50h50,w300h300' ;
        $title_Str = !empty($arg['title_Str']) ? $arg['title_Str'] : '' ;
        $filename_Str = !empty($arg['filename_Str']) ? $arg['filename_Str'] : '' ;
        $size_Num = !empty($arg['size_Num']) ? $arg['size_Num'] : 0 ;
        $type_Str = !empty($arg['type_Str']) ? $arg['type_Str'] : '' ;
        $md5_Str = !empty($arg['md5_Str']) ? $arg['md5_Str'] : '' ;
        $classids_Str = !empty($arg['classids_Str']) ? $arg['classids_Str'] : '' ;
        $classids_Arr = !empty($arg['classids_Arr']) ? $arg['classids_Arr'] : array() ;
        $path_Arr = !empty($arg['path_Arr']) ? $arg['path_Arr'] : '' ;
        $prioritynum_Num = !empty($arg['prioritynum_Num']) ? $arg['prioritynum_Num'] : 0;
        $updatetime_Str = !empty($arg['updatetime_Str']) ? $arg['updatetime_Str'] : '';
        $updatetime_inputtime_date_Str = !empty($arg['updatetime_inputtime_date_Str']) ? $arg['updatetime_inputtime_date_Str'] : '';
        $updatetime_inputtime_time_Str = !empty($arg['updatetime_inputtime_time_Str']) ? $arg['updatetime_inputtime_time_Str'] : '';
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1 ;
        
        //classid運算
        check_comma_array($classids_Str, $classids_Arr);
        $class_ClassMetaList = new ObjList();
        $class_ClassMetaList->construct_db(array(
            'db_where_or_Arr' => array(
                'classid' => $classids_Arr
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        //uid
        if(empty($uid_Num))
        {
            $data['user'] = get_user();
            $uid_Num = $data['user']['uid'];
        }
        
        //title size type filename
        if(empty($title_Str) && !empty($picfile_FileArr) )
        {
            $title_Str = $picfile_FileArr['name'];
        }
        if(empty($filename_Str) && !empty($picfile_FileArr) )
        {
            $filename_Str = $picfile_FileArr['name'];
        }
        if(empty($size_Num) && !empty($picfile_FileArr) )
        {
            $size_Num = $picfile_FileArr['size'];
        }
        if(empty($type_Str) && !empty($picfile_FileArr) )
        {
            $type_Str = $picfile_FileArr['type'];
        }
        
        //md5
        if( empty($md5_Str) )
        {
            $md5_Str = substr(md5('FANSWOO'.rand(10000000, 99999999)),8,16);
        }
        
        //path
        if( !empty($thumb_Str) && !empty($md5_Str) && !empty($picid_Num) )
        {
            $substr_picid_Num = abs(intval($picid_Num));
            $substr_picid_Num = sprintf("%08d", $substr_picid_Num);

            $dir1_Num = substr($substr_picid_Num, 0, 2);
            $dir2_Num = substr($substr_picid_Num, 2, 2);
            $dir3_Num = substr($substr_picid_Num, 4, 2);
            $dir4_Num = substr($substr_picid_Num, 6, 2);
            $path_Arr['w0h0'] = APPPATH.'./pic/'.$dir1_Num.'/'.$dir2_Num.'/'.$dir3_Num.'/'.$dir4_Num.'-'.$md5_Str.'.jpg';
            
            $thumb_Arr = explode(',', $thumb_Str);
            foreach($thumb_Arr as $key => $value)
            {
                $path_Arr[$value] = APPPATH.'./pic/'.$dir1_Num.'/'.$dir2_Num.'/'.$dir3_Num.'/'.$dir4_Num.'-'.$md5_Str.'-'.$value.'.jpg';
            }
        }
        else
        {
            $path_Arr = array();
        }

        //建立DateTime物件
        $updatetime_DateTime = new DateTimeObj();
        $updatetime_DateTime->construct(array(
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ));
        
        //set
        $this->picid_Num = $picid_Num;
        $this->uid_Num = $uid_Num;
        $this->filename_Str = $filename_Str;
        $this->thumb_Str = $thumb_Str;
        $this->title_Str = $title_Str;
        $this->size_Num = $size_Num;
        $this->type_Str = $type_Str;
        $this->md5_Str = $md5_Str;
        $this->class_ClassMetaList = $class_ClassMetaList;
        $this->picfile_FileArr = $picfile_FileArr;
        $this->path_Arr = $path_Arr;
        $this->prioritynum_Num = $prioritynum_Num;
        $this->updatetime_DateTime = $updatetime_DateTime;
        $this->status_Num = $status_Num;
        
        return TRUE;
    }
    
    public function upload()
    {
        $picid_Num = $this->picid_Num;
        $thumb_Str = $this->thumb_Str;
        $picfile_FileArr = $this->picfile_FileArr;
        
        if(empty($picfile_FileArr))
        {
            return FALSE;
        }
        
        $this->update(array());
        $this->cutphoto(array('width' => 0, 'height' => 0));
        
        $thumb_Arr = explode(',', $thumb_Str);
        foreach($thumb_Arr as $key => $value_Str)
        {
            if(!empty($value_Str))
            {
                $string = str_replace('w', '', $value_Str);
                $string = explode('h', $string);
                $width_Num = $string[0];
                $height_Num = $string[1];
                $this->cutphoto( array( 'width' => $width_Num, 'height' => $height_Num) );
            }
        }
        
        return TRUE;
    }
    
    //壓縮&縮圖
    private function cutphoto($arg)
    {
        $width = empty($arg['width']) ? 0 : $arg['width'];
        $height = empty($arg['height']) ? 0 : $arg['height'];
        $picfile_FileArr = $this->picfile_FileArr;
        $o_photo = $this->picfile_FileArr['tmp_name'];
        $picid_Num = $this->picid_Num;
        $md5_Str = $this->md5_Str;

        if(empty($picfile_FileArr))
        {
            return FALSE;
        }
        
		$picid_Num = abs(intval($picid_Num));
		$picid_Num = sprintf("%08d", $picid_Num);
        
		$dir1 = substr($picid_Num, 0, 2);
		$dir2 = substr($picid_Num, 2, 2);
		$dir3 = substr($picid_Num, 4, 2);
		$dir4 = substr($picid_Num, 6, 2);
        
        $path1 = APPPATH.'./pic/'.$dir1;
        if( !is_dir($path1) ) mkdir($path1, 0777);
        $path2 = APPPATH.'./pic/'.$dir1.'/'.$dir2;
        if( !is_dir($path2) ) mkdir($path2, 0777);
        $path3 = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3;
        if( !is_dir($path3) ) mkdir($path3, 0777);
        
        if($width == 0 || $height == 0)
        {
            $width = 1900;
            $height = 1600;
            $d_photo = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$md5_Str.'.jpg';
        }
        else
        {
            $d_photo = APPPATH.'./pic/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.$dir4.'-'.$md5_Str.'-w'.$width.'h'.$height.'.jpg';
        }
        
        if($data = getimagesize($o_photo)) {
            if($data[2] == 1) {
                $make_max = 0;//gif不处理
                if(function_exists("imagecreatefromgif")) {
                    $temp_img = imagecreatefromgif($o_photo);
                }
            } elseif($data[2] == 2) {
                if(function_exists("imagecreatefromjpeg")) {
                    $temp_img = imagecreatefromjpeg($o_photo);
                }
            } elseif($data[2] == 3) {
                if(function_exists("imagecreatefrompng")) {
                    $temp_img = imagecreatefrompng($o_photo);
                }
            }
        }
        if(!$temp_img) return '';
        
        $o_width = imagesx($temp_img);//取得原图宽
        $o_height = imagesy($temp_img);//取得原图高

        //判断处理方法
        if($width>$o_width || $height>$o_height)
        {
            //原图宽或高比规定的尺寸小,进行压缩
            $newwidth = $o_width;
            $newheight = $o_height;
            if($o_width > $width)
            {
                $newwidth = $width;
                $newheight = $o_height*$width/$o_width;
            }
            if($newheight > $height)
            {
                $newwidth = $newwidth*$height/$newheight;
                $newheight = $height;
            }
            //缩略图片
            $new_img = imagecreatetruecolor($newwidth, $newheight);
            
            imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height);
            imagejpeg($new_img , $d_photo);
            imagedestroy($new_img);
        }
        else
        {
        //原图宽与高都比规定尺寸大,进行压缩后裁剪
            if($o_height*$width/$o_width>$height){
                //先确定width与规定相同,如果height比规定大,则ok
                $newwidth=$width;
                $newheight=$o_height*$width/$o_width;
                $x=0;
                $y=($newheight-$height)/2;
            }
            else
            {
                //否则确定height与规定相同,width自适应
                $newwidth=$o_width*$height/$o_height;
                $newheight=$height;
                $x=($newwidth-$width)/2;
                $y=0;
            }
            //缩略图片
            $new_img = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height);

            imagejpeg($new_img , $d_photo);
            
            if($data = getimagesize($o_photo)) {
                if($data[2] == 1) {
                    $make_max = 0;//gif不处理
                    if(function_exists("imagecreatefromgif")) {
                        $temp_img = imagecreatefromgif($o_photo);
                    }
                } elseif($data[2] == 2) {
                    if(function_exists("imagecreatefromjpeg")) {
                        $temp_img = imagecreatefromjpeg($o_photo);
                    }
                } elseif($data[2] == 3) {
                    if(function_exists("imagecreatefrompng")) {
                        $temp_img = imagecreatefrompng($o_photo);
                    }
                }
            }
            if(!$temp_img) return '';
            
//            $o_width   = imagesx($temp_img);//取得缩略图宽
//            $o_height = imagesy($temp_img);//取得缩略图高
            
            //裁剪图片

            $new_imgx = imagecreatetruecolor($width,$height);
            imagecopyresampled($new_imgx,$new_img,0,0,0,0,$width,$height,$width,$height);
            imagejpeg($new_imgx , $d_photo);
            imagedestroy($new_img);
            imagedestroy($new_imgx);
        }
    }
	
}