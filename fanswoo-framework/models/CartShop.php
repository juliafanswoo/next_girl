<?php

class CartShop extends ObjDbBase {

    public $cartid_Num = 0;
    public $orderid_Num = 0;
    public $productid_Num = 0;
    public $stockid_Num = 0;
    public $uid_Num = '';
    public $price_Num = 0;
    public $price_total_Num = 0;
    public $product_ProductShop;
    public $amount_Num = '';
    public $status_Num = 1;
    public $db_name_Str = 'shop_cart';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'cartid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'cartid' => 'cartid_Num',
        'orderid' => 'orderid_Num',
        'productid' => 'productid_Num',
        'stockid' => 'stockid_Num',
        'uid' => 'uid_Num',
        'price' => 'price_Num',
        'amount' => 'amount_Num',
        'status' => 'status_Num'
    );
    
    public function construct($arg)
    {
            
        $cartid_Num = !empty($arg['cartid_Num']) ? $arg['cartid_Num'] : 0;
        $orderid_Num = !empty($arg['orderid_Num']) ? $arg['orderid_Num'] : 0;
        $productid_Num = !empty($arg['productid_Num']) ? $arg['productid_Num'] : 0;
        $stockid_Num = !empty($arg['stockid_Num']) ? $arg['stockid_Num'] : 0;
        $uid_Num = !empty($arg['uid_Num']) ? $arg['uid_Num'] : 0;
        $amount_Num = !empty($arg['amount_Num']) ? $arg['amount_Num'] : 1;
        $price_Num = !empty($arg['price_Num']) ? $arg['price_Num'] : 0;
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1;

        $product_ProductShop = new ProductShop();
        $product_ProductShop->construct_db(array(
            'db_where_Arr' => array(
                'productid_Num' => $productid_Num
            )
        ));

        if($price_Num === 0)
        {
            $price_Num = $product_ProductShop->price_Num;
        }

        $price_total_Num = $price_Num * $amount_Num;
        
        //set
        $this->cartid_Num = $cartid_Num;
        $this->orderid_Num = $orderid_Num;
        $this->productid_Num = $productid_Num;
        $this->stockid_Num = $stockid_Num;
        $this->uid_Num = $uid_Num;
        $this->price_Num = $price_Num;
        $this->price_total_Num = $price_total_Num;
        $this->product_ProductShop = $product_ProductShop;
        $this->amount_Num = $amount_Num;
        $this->status_Num = $status_Num;
        
        return TRUE;
    }
    
}