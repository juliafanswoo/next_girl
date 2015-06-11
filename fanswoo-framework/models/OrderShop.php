<?php

class OrderShop extends ObjDbBase
{

    public $orderid_Num = 0;
    public $uid_Num = 0;
    public $uid_User = 0;
    public $receive_name_Str = '';
    public $receive_phone_Str = '';
    public $receive_time_Str = '';
    public $receive_address_Str = '';
    public $receive_remark_Str = '';
    public $pay_name_Str = '';
    public $pay_paytype_Str = '';
    public $pay_price_total_Num = 0;
    public $pay_account_Str = '';
    public $pay_remark_Str = '';
    public $pay_price_freight_Num = 0;
    public $pay_paytime_DateTimeObj;
    public $pay_status_Num = 0;
    public $paycheck_status_Num = 0;
    public $cart_CartShopList;
    public $setuptime_DateTimeObj;
    public $sendtime_DateTimeObj;
    public $updatetime_DateTimeObj;
    public $order_status_Num = 0;
    public $product_status_Num = 0;
    public $status_Num = 1;
    public $db_name_Str = 'shop_order';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'orderid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'orderid' => 'orderid_Num',
        'uid' => 'uid_Num',
        'receive_name' => 'receive_name_Str',
        'receive_phone' => 'receive_phone_Str',
        'receive_time' => 'receive_time_Str',
        'receive_address' => 'receive_address_Str',
        'receive_remark' => 'receive_remark_Str',
        'pay_name' => 'pay_name_Str',
        'pay_paytype' => 'pay_paytype_Str',
        'pay_sendtype' => 'pay_sendtype_Str',
        'pay_price_total' => 'pay_price_total_Num',
        'pay_account' => 'pay_account_Str',
        'pay_remark' => 'pay_remark_Str',
        'pay_price_freight' => 'pay_price_freight_Num',
        'pay_paytime' => array('pay_paytime_DateTimeObj', 'datetime_Str'),
        'sendtime' => array('sendtime_DateTimeObj', 'datetime_Str'),
        'setuptime' => array('setuptime_DateTimeObj', 'datetime_Str'),
        'pay_price_total' => 'pay_price_total_Num',
        'pay_status' => 'pay_status_Num',
        'paycheck_status' => 'paycheck_status_Num',
        'product_status' => 'product_status_Num',
        'order_status' => 'order_status_Num',
        'updatetime' => array('updatetime_DateTimeObj', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['orderid_Num', 'uid_Num', 'pay_price_total_Num', 'receive_name_Str', 'receive_phone_Str', 'receive_time_Str', 'receive_address_Str', 'receive_remark_Str', 'pay_account_Str', 'pay_paytype_Str', 'pay_sendtype_Str', 'pay_remark_Str', 'pay_price_freight_Num', 'pay_name_Str', 'pay_paytime_Str', 'sendtime_Str', 'updatetime_Str', 'setuptime_Str', 'pay_status_Num', 'paycheck_status_Num', 'product_status_Num', 'order_status_Num', 'status_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //若uid為空則以登入者uid作為本物件之預設uid
        if(empty($uid_Num) || empty($uid_Num))
        {
            $data['user'] = get_user();
            $uid_Num = $data['user']['uid'];
        }

        $uid_User = new User();
        $uid_User->construct_db(array(
            'db_where_Arr' => array(
                'uid' => $uid_Num
            )
        ));

        $cart_CartShopList = new ObjList();
        $cart_CartShopList->construct_db(array(
            'db_where_Arr' => array(
                'orderid_Num' => $orderid_Num
            ),
            'model_name_Str' => 'CartShop',
            'limitstart_Num' => 0,
            'limitcount_Num' => 9999
        ));

        //建立DateTime物件
        $updatetime_DateTimeObj = new DateTimeObj();
        $updatetime_DateTimeObj->construct(array(
            'datetime_Str' => $updatetime_Str
        ));

        //建立DateTime物件
        $pay_paytime_DateTimeObj = new DateTimeObj();
        $pay_paytime_DateTimeObj->construct(array(
            'datetime_Str' => $pay_paytime_Str
        ));

        //建立DateTime物件
        $setuptime_DateTimeObj = new DateTimeObj();
        $setuptime_DateTimeObj->construct(array(
            'datetime_Str' => $setuptime_Str
        ));

        //建立DateTime物件
        $sendtime_DateTimeObj = new DateTimeObj();
        $sendtime_DateTimeObj->construct(array(
            'datetime_Str' => $sendtime_Str
        ));
        
        //將建構方法所計算出的值存入此類別之屬性
        $this->orderid_Num = $orderid_Num;
        $this->uid_Num = $uid_Num;
        $this->uid_User = $uid_User;
        $this->receive_name_Str = $receive_name_Str;
        $this->receive_phone_Str = $receive_phone_Str;
        $this->receive_time_Str = $receive_time_Str;
        $this->receive_address_Str = $receive_address_Str;
        $this->receive_remark_Str = $receive_remark_Str;
        $this->pay_name_Str = $pay_name_Str;
        $this->pay_paytype_Str = $pay_paytype_Str;
        $this->pay_sendtype_Str = $pay_sendtype_Str;
        $this->pay_price_total_Num = $pay_price_total_Num;
        $this->pay_account_Str = $pay_account_Str;
        $this->pay_remark_Str = $pay_remark_Str;
        $this->pay_price_freight_Num = $pay_price_freight_Num;
        $this->pay_paytime_DateTimeObj = $pay_paytime_DateTimeObj;
        $this->cart_CartShopList = $cart_CartShopList;
        $this->sendtime_DateTimeObj = $sendtime_DateTimeObj;
        $this->setuptime_DateTimeObj = $setuptime_DateTimeObj;
        $this->updatetime_DateTimeObj = $updatetime_DateTimeObj;
        $this->pay_status_Num = $pay_status_Num;
        $this->paycheck_status_Num = $paycheck_status_Num;
        $this->product_status_Num = $product_status_Num;
        $this->order_status_Num = $order_status_Num;
        $this->set('status_Num', $status_Num);
        
        return TRUE;
    }

    public function change_freight($arg)
    {
        $pay_price_freight_Num = !empty($arg['pay_price_freight_Num']) ? $arg['pay_price_freight_Num'] : 0;

        $orderid_Num = $this->orderid_Num;

        $cart_CartShopList = new ObjList();
        $cart_CartShopList->construct_db(array(
            'db_where_Arr' => array(
                'orderid_Num' => $orderid_Num
            ),
            'model_name_Str' => 'CartShop',
            'limitstart_Num' => 0,
            'limitcount_Num' => 9999
        ));

        $pay_price_total_Num = 0;
        foreach($cart_CartShopList->obj_Arr as $key => $value_CartShop)
        {
            $pay_price_total_Num = $pay_price_total_Num + $value_CartShop->price_total_Num;
        }
        $pay_price_total_Num = $pay_price_total_Num + $pay_price_freight_Num;

        $this->cart_CartShopList = $cart_CartShopList;
        $this->pay_price_total_Num = $pay_price_total_Num;
        $this->pay_price_freight_Num = $pay_price_freight_Num;
    }

    public function add_cart($arg)
    {
        $productid_Num = !empty($arg['productid_Num']) ? $arg['productid_Num'] : 0;
        $amount_Num = !empty($arg['amount_Num']) ? $arg['amount_Num'] : 0;

        $uid_Num = $this->uid_Num;
        $orderid_Num = $this->orderid_Num;
        $pay_price_freight_Num = $this->pay_price_freight_Num;

        //將產品數量增加至原有的購物車
        $CartShop = new CartShop();
        $CartShop->construct_db(array(
            'db_where_Arr' => array(
                'orderid_Num' => $orderid_Num,
                'productid_Num' => $productid_Num,
                'status_Num' => 1
            )
        ));
        $CartShop->amount_Num = $CartShop->amount_Num + $amount_Num;

        //如果這個購物車是空的，就建立新的購物車
        if(empty($CartShop->cartid_Num))
        {
            $CartShop = new CartShop();
            $CartShop->construct(array(
                'productid_Num' => $productid_Num,
                'orderid_Num' => $orderid_Num,
                'uid_Num' => $uid_Num,
                'amount_Num' => $amount_Num
            ));
        }

        $CartShop->update(array());

        $cart_CartShopList = new ObjList();
        $cart_CartShopList->construct_db(array(
            'db_where_Arr' => array(
                'orderid_Num' => $orderid_Num
            ),
            'model_name_Str' => 'CartShop',
            'limitstart_Num' => 0,
            'limitcount_Num' => 9999
        ));

        $pay_price_total_Num = 0;
        foreach($cart_CartShopList->obj_Arr as $key => $value_CartShop)
        {
            $pay_price_total_Num = $pay_price_total_Num + $value_CartShop->price_total_Num;
        }
        $pay_price_total_Num = $pay_price_total_Num + $pay_price_freight_Num;

        $this->cart_CartShopList = $cart_CartShopList;
        $this->pay_price_total_Num = $pay_price_total_Num;
    }

    public function delete_cart($arg)
    {
        $cartid_Num = !empty($arg['cartid_Num']) ? $arg['cartid_Num'] : 0;

        $uid_Num = $this->uid_Num;
        $orderid_Num = $this->orderid_Num;
        $pay_price_freight_Num = $this->pay_price_freight_Num;

        //將產品數量增加至原有的購物車
        $CartShop = new CartShop();
        $CartShop->construct_db(array(
            'db_where_Arr' => array(
                'cartid_Num' => $cartid_Num
            )
        ));
        $CartShop->delete();

        $cart_CartShopList = new ObjList();
        $cart_CartShopList->construct_db(array(
            'db_where_Arr' => array(
                'orderid_Num' => $orderid_Num
            ),
            'model_name_Str' => 'CartShop',
            'limitstart_Num' => 0,
            'limitcount_Num' => 9999
        ));

        $pay_price_total_Num = 0;
        foreach($cart_CartShopList->obj_Arr as $key => $value_CartShop)
        {
            $pay_price_total_Num = $pay_price_total_Num + $value_CartShop->price_total_Num;
        }
        $pay_price_total_Num = $pay_price_total_Num + $pay_price_freight_Num;

        $this->cart_CartShopList = $cart_CartShopList;
        $this->pay_price_total_Num = $pay_price_total_Num;
    }
	
}