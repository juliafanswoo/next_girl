<?php

class product_controller extends FS_controller {
    
	public function index(){
        $data = $this->data;
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $productid_Num = $this->input->get('productid');
        
        $product_ProductShop = $this->load->model('ProductShop', nrnum());
        if(!empty($productid_Num))
        {
            $product_ProductShop->construct_db(array(
                'db_where_Arr' => array(
                    'productid_Num' => $productid_Num
                )
            ));
        }
        $data['product_ProductShop'] = $product_ProductShop;
        $productid_Num = $data['product_ProductShop']->productid_Num;
        
        if(empty($productid_Num))
        {
            $Message = $this->load->model('Message', nrnum());
            $Message->show(array('message' => '產品連結輸入錯誤', 'url' => 'shop'));
        }

        $data['classid_Num'] = $this->input->get('classid');
        
        $data['class_ClassMetaList'] = new ObjList();
        $data['class_ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname_Str' => 'product_shop'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        $data['class2_ClassMetaList'] = new ObjList();
        $data['class2_ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname_Str' => 'product_shop_class2'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        $data['wrap_name_Str'] = 'product';
        
        //global
		$data['global']['style'][] = 'style';
		$data['global']['style'][] = 'shop_wrapsidebar';
		$data['global']['style'][] = 'product';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
        $data['temp']['shop_wrapsidebar'] = $this->load->view('temp/shop_wrapsidebar', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('product', $data);
	}
}

?>