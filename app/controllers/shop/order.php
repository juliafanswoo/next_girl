<?php

class order_controller extends FS_controller
{

    function __construct()
    {
        parent::__construct();
        $data = $this->data;

        if($data['user']['uid'] == '')
        {
            $url = base_url('user/login/?url=order');
            header('Location: '.$url);
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
    }
	
	public function index()
	{
        $url_Str = base_url('order/cartlist');
        header("Location: $url_Str");
	}

    public function cartlist()
    {
        $data = $this->data;

        //讀取建構中的訂單
        $data['OrderShop'] = new OrderShop();
        $data['OrderShop']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['user']['uid'],
                'order_status_Num' => -1//建構中的訂單
            )
        ));
        //如果沒有建構中的訂單則建立一個新的訂單
        if(empty($data['OrderShop']->orderid_Num))
        {
            $data['OrderShop'] = new OrderShop();
            $data['OrderShop']->construct(array(
                'uid_Num' => $data['user']['uid'],
                'pay_price_freight_Num' => 80,
                'pay_paytype_Str' => 'atm',
                'order_status_Num' => -1//建構中的訂單
            ));
            $data['OrderShop']->update(array());
        }
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'order';
        
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
        $data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
        
        //輸出模板
        $this->load->view('order/cartlist', $data);
    }

    public function cartlist_post()
    {
        $data = $this->data;

        $pay_paytype_Str = $this->input->post('pay_paytype_Str', TRUE);
        if($pay_paytype_Str == 'atm')
        {
            $pay_sendtype_Str = 'delivery';
            $pay_price_freight_Num = 80;
        }
        else if($pay_paytype_Str == 'card')
        {
            $pay_sendtype_Str = 'delivery';
            $pay_price_freight_Num = 80;
        }
        else if($pay_paytype_Str == 'cash_on_delivery')
        {
            $pay_sendtype_Str = 'cash_on_delivery';
            $pay_price_freight_Num = 120;
        }

        //讀取建構中的訂單
        $OrderShop = new OrderShop();
        $OrderShop->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['user']['uid'],
                'order_status_Num' => -1//建構中的訂單
            )
        ));

        if(empty($OrderShop->cart_CartShopList->obj_Arr))
        {
            $message_Str = '請先選擇想要購買的產品';
            $url_Str = 'order/cartlist';
            $this->load->model('Message');
            $this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
            return FALSE;
        }

        $OrderShop->pay_paytype_Str = $pay_paytype_Str;
        $OrderShop->pay_sendtype_Str = $pay_sendtype_Str;
        $OrderShop->change_freight(array(
            'pay_price_freight_Num' => $pay_price_freight_Num
        ));
        $OrderShop->update();

        $url_Str = base_url('order/checkout');
        header("Location: $url_Str");
    }

    public function checkout()
    {
        $data = $this->data;

        //讀取建構中的訂單
        $data['OrderShop'] = new OrderShop();
        $data['OrderShop']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['user']['uid'],
                'order_status_Num' => -1//建構中的訂單
            )
        ));
        //如果沒有建構中的訂單則建立一個新的訂單
        if(empty($data['OrderShop']->orderid_Num))
        {
            $url_Str = base_url('order/cartlist');
            header("Location: $url_Str");
        }
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'order';
        
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
        $data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
        
        //輸出模板
        $this->load->view('order/checkout', $data);
    }

    public function checkout_post()
    {
        $data = $this->data;

        $this->form_validation->set_rules('receive_name_Str', '收件人姓名', 'required');
        $this->form_validation->set_rules('receive_address_Str', '收件人地址', 'required');
        $this->form_validation->set_rules('receive_phone_Str', '收件人電話', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            $receive_name_Str = $this->input->post('receive_name_Str', TRUE);
            $receive_address_Str = $this->input->post('receive_address_Str', TRUE);
            $receive_phone_Str = $this->input->post('receive_phone_Str', TRUE);
            $receive_time_Str = $this->input->post('receive_time_Str', TRUE);
            $receive_remark_Str = $this->input->post('receive_remark_Str', TRUE);

            //讀取建構中的訂單
            $OrderShop = new OrderShop();
            $OrderShop->construct_db(array(
                'db_where_Arr' => array(
                    'uid_Num' => $data['user']['uid'],
                    'order_status_Num' => -1//建構中的訂單
                )
            ));
            if(
                $OrderShop->pay_paytype_Str === 'card' ||
                $OrderShop->pay_paytype_Str === 'cash_on_delivery')
            {
                $OrderShop->pay_status_Num = 1;
                $OrderShop->paycheck_status_Num = 1;
            }
            $OrderShop->receive_name_Str = $receive_name_Str;
            $OrderShop->receive_address_Str = $receive_address_Str;
            $OrderShop->receive_phone_Str = $receive_phone_Str;
            $OrderShop->receive_time_Str = $receive_time_Str;
            $OrderShop->receive_remark_Str = $receive_remark_Str;
            $OrderShop->order_status_Num = 0;//將訂單從建構中改為已建立
            $OrderShop->update(array());

            $message_Str = '訂單完成';
            $url_Str = 'shop';
            $this->load->model('Message');
            $this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
        }
        else
        {
            $message_Str = '請填寫詳細收件人資料';
            $url_Str = 'order/checkout';
            $this->load->model('Message');
            $this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
        }
    }

    public function checkout_card_post()
    {
        $data = $this->data;

        $this->form_validation->set_rules('receive_name_Str', '收件人姓名', 'required');
        $this->form_validation->set_rules('receive_address_Str', '收件人地址', 'required');
        $this->form_validation->set_rules('receive_phone_Str', '收件人電話', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            $receive_name_Str = $this->input->post('receive_name_Str', TRUE);
            $receive_address_Str = $this->input->post('receive_address_Str', TRUE);
            $receive_phone_Str = $this->input->post('receive_phone_Str', TRUE);
            $receive_time_Str = $this->input->post('receive_time_Str', TRUE);
            $receive_remark_Str = $this->input->post('receive_remark_Str', TRUE);

            //讀取建構中的訂單
            $OrderShop = new OrderShop();
            $OrderShop->construct_db(array(
                'db_where_Arr' => array(
                    'uid_Num' => $data['user']['uid'],
                    'order_status_Num' => -1//建構中的訂單
                )
            ));
            if(
                $OrderShop->pay_paytype_Str === 'card' ||
                $OrderShop->pay_paytype_Str === 'cash_on_delivery')
            {
                $OrderShop->pay_status_Num = 1;
                $OrderShop->paycheck_status_Num = 1;
            }
            $OrderShop->receive_name_Str = $receive_name_Str;
            $OrderShop->receive_address_Str = $receive_address_Str;
            $OrderShop->receive_phone_Str = $receive_phone_Str;
            $OrderShop->receive_time_Str = $receive_time_Str;
            $OrderShop->receive_remark_Str = $receive_remark_Str;
            $OrderShop->update(array());

            //金流開始
            include_once(APPPATH.'libraries/auth_mpi/auth_mpi_mac.php');

            $purchAmt = (int) $OrderShop->pay_price_total_Num;
            $cid = (int) $OrderShop->orderid_Num;
            // $data['AuthResURL'] = "http://localhost/ipix/order/checkout_card_response_post/";
            $data['AuthResURL'] = 'http://'.$_SERVER['HTTP_HOST'].base_url("order/checkout_card_response_post/");
            $MerchantName = '大田映像有限公司';
            $MerchantID = '8220276806380';
            $TerminalID = '90008132';
            $txType = '0';
            $Option = '1';
            $OrderDetail = '大田映像有限公司';
            $AutoCap = '1';
            $customize = '1';
            $Key = 'asxPcbeXE7o9qn2dlH0hC8ti';
            $debug = '0';
        
            $data['merID'] = '3001';
            $data['MACString'] = auth_in_mac($MerchantID,$TerminalID,$cid,$purchAmt,$txType,$Option,$Key,$MerchantName,$data['AuthResURL'],$OrderDetail,$AutoCap,$customize,$debug);
        
            $data['URLEnc'] = get_auth_urlenc($MerchantID,$TerminalID,$cid,$purchAmt,$txType,$Option,$Key,$MerchantName,$data['AuthResURL'],$OrderDetail,$AutoCap,$customize,$data['MACString'],$debug);
        
            //輸出模板
            $this->load->view('order/checkout_card', $data);
        }
        else
        {
            $message_Str = '請填寫詳細收件人資料';
            $url_Str = 'order/checkout';
            $this->load->model('Message');
            $this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
        }
    }

    public function checkout_card_response_post()
    {
        $data = $this->data;
        // error_reporting();
        
        //接收金流回傳值
        include_once(APPPATH.'libraries/auth_mpi/auth_mpi_mac.php');
        $EncRes = $this->input->post('URLResEnc');
        $Key = "asxPcbeXE7o9qn2dlH0hC8ti";
        $debug = "0";
        $EncArray=gendecrypt($EncRes,$Key,$debug);
        foreach($EncArray AS $name => $val){
            // echo $name ."=>". urlencode(trim($val,"\x00..\x08")) ."\n";
        }
        $status = isset($EncArray['status']) ? $EncArray['status'] : "";
        $errCode = isset($EncArray['errcode']) ? $EncArray['errcode'] : "";
        $authCode = isset($EncArray['authcode']) ? $EncArray['authcode'] : "";
        $authAmt = isset($EncArray['authamt']) ? $EncArray['authamt'] : "";
        $lidm = isset($EncArray['lidm']) ? $EncArray['lidm'] : "";
        $OffsetAmt = isset($EncArray['offsetamt']) ? $EncArray['offsetamt'] : "";
        $OriginalAmt = isset($EncArray['originalamt']) ? $EncArray['originalamt'] : "";
        $UtilizedPoint = isset($EncArray['utilizedpoint']) ? $EncArray['utilizedpoint'] : "";
        $Option = isset($EncArray['numberofpay']) ? $EncArray['numberofpay'] : "";
        //紅利交易時請帶入prodcode
        //$Option = isset($EncArray['prodcode']) ? $EncArray['prodcode'] : "";
        $Last4digitPAN = isset($EncArray['last4digitpan']) ? $EncArray['last4digitpan'] : "";
        $CardNumber = isset($EncArray['CardNumber']) ? $EncArray['CardNumber'] : "";
        $MACString = auth_out_mac($status,$errCode,$authCode,$authAmt,$lidm,$OffsetAmt,$OriginalAmt,$UtilizedPoint,$Option, $Last4digitPAN,$Key,$debug);
        
        //交易成功或失敗
        if($MACString === $EncArray['outmac'])
        {
            //讀取建構中的訂單
            $OrderShop = new OrderShop();
            $OrderShop->construct_db(array(
                'db_where_Arr' => array(
                    'uid_Num' => $data['user']['uid'],
                    'order_status_Num' => -1//建構中的訂單
                )
            ));
            $OrderShop->pay_status_Num = 1;
            $OrderShop->paycheck_status_Num = 1;
            $OrderShop->order_status_Num = 0;//將訂單從建構中改為已建立
            $OrderShop->update();

            $message_Str = '交易成功';
            $url_Str = 'shop';
            $this->load->model('Message');
            $this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
        }
        else
        {
            $message_Str = '信用卡交易失敗';
            $url_Str = 'order/cartlist';
            $this->load->model('Message');
            $this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
        }
    }

    public function delete_cart()
    {
        $data = $this->data;

        $cartid_Num = $this->input->get('cartid');

        //讀取建構中的訂單
        $OrderShop = new OrderShop();
        $OrderShop->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['user']['uid'],
                'order_status_Num' => -1//建構中的訂單
            )
        ));
        $OrderShop->delete_cart(array(
            'cartid_Num' => $cartid_Num
        ));

        $OrderShop->update(array());

        $url_Str = base_url('order/cartlist');
        header("Location: $url_Str");
    }

    public function add_cart()
    {
        $data = $this->data;

        $productid_Num = $this->input->post('productid_Num', TRUE);
        $amount_Num = $this->input->post('amount_Num', TRUE);

        //讀取建構中的訂單
        $OrderShop = new OrderShop();
        $OrderShop->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['user']['uid'],
                'order_status_Num' => -1//建構中的訂單
            )
        ));
        //如果沒有建構中的訂單則建立一個新的訂單
        if(empty($OrderShop->orderid_Num))
        {
            $OrderShop = new OrderShop();
            $OrderShop->construct(array(
                'uid_Num' => $data['user']['uid'],
                'pay_price_freight_Num' => 80,
                'pay_paytype_Str' => 'atm',
                'order_status_Num' => -1//建構中的訂單
            ));
            $OrderShop->update(array());
        }

        $OrderShop->add_cart(array(
            'productid_Num' => $productid_Num,
            'amount_Num' => $amount_Num
        ));

        $OrderShop->update(array());

        $url_Str = base_url('order/cartlist');
        header("Location: $url_Str");
    }
	
}

?>