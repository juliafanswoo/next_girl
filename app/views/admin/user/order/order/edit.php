<?=$temp['header_up']?>
<script>
$(function(){
});
</script>
<?=$temp['admin_header_down']?>
<h2>訂單管理 - 確認訂單</h2>
<div class="contentBox allWidth">
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
	<h3>訂單資訊</h3>
	<h4>請確認訂單、款項、貨物及收件資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                訂單編號
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($OrderShop->orderid_Num)):?><?=$OrderShop->orderid_Num?><?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                訂購會員
            </div>
            <div class="spanLineLeft width500">
                <?if(!empty($OrderShop->uid_User->email_Str)):?><?=$OrderShop->uid_User->email_Str?><?endif?>
                （會員編號：<?if(!empty($OrderShop->uid_Num)):?><?=$OrderShop->uid_Num?><?endif?>）
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
	<h3>付款資訊</h3>
	<h4>請確認本訂單之付款資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款方式
            </div>
            <div class="spanLineLeft">
                <?if($OrderShop->pay_paytype_Str == 'atm'):?>
                ATM轉帳
                <?elseif($OrderShop->pay_paytype_Str == 'card'):?>
                信用卡
                <?elseif($OrderShop->pay_paytype_Str == 'cash_on_delivery'):?>
                貨到付款
                <?endif?>
		    </div>
		</div>
	</div>
    <?if($OrderShop->pay_paytype_Str == 'atm'):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款總金額
            </div>
            <div class="spanLineLeft">
                <?=$OrderShop->pay_price_total_Num?>（含運費 <?=$OrderShop->pay_price_freight_Num?> 元）
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                收款資訊
            </div>
            <div class="spanLineLeft width400">
                收款銀行： 中國信託（銀行代號：700）
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width400">
                收款帳號： 123-456-789-000
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width400">
                銀行戶名： 鏡花園有限公司
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                轉帳帳號
            </div>
            <div class="spanLineLeft">
                <?if($OrderShop->pay_status_Num == 1):?>
                <?=$OrderShop->pay_account_Str?>
                <?else:?>
                <input type="text" class="text" name="pay_account_Str">
                <?endif?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                轉帳人姓名
            </div>
            <div class="spanLineLeft">
                <?if($OrderShop->pay_status_Num == 1):?>
                <?=$OrderShop->pay_name_Str?>
                <?else:?>
                <input type="text" class="text" name="pay_name_Str">
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                轉帳時間
            </div>
            <div class="spanLineLeft">
                <?if($OrderShop->pay_status_Num == 1):?>
                <?=$OrderShop->pay_paytime_DateTimeObj->datetime_Str?>
                <?else:?>
                <script src="app/js/jquery-ui-timepicker-addon/script.js"></script>
                <link rel="stylesheet" type="text/css" href="app/js/jquery-ui-timepicker-addon/style.css"></link>
                <script>
                $(function(){
                    $('#pay_paytime_Str').datetimepicker({
                        dateFormat: 'yy-mm-dd',
                        timeFormat: 'HH:mm:ss'
                    });
                });
                </script>
                <input type="text" class="text" id="pay_paytime_Str" name="pay_paytime_Str">
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款備註
            </div>
            <div class="spanLineLeft width500">
                <?if($OrderShop->pay_status_Num == 1):?>
                <?=$OrderShop->pay_remark_Str?>
                <?else:?>
                <textarea name="pay_remark_Str"></textarea>
                <?endif?>
		    </div>
		</div>
	</div>
    <?endif?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                付款狀態
            </div>
            <div class="spanLineLeft width500">
                <?if($OrderShop->pay_status_Num == 0):?>
                <span class="red">會員尚未填寫付款資訊</span>
                <?elseif($OrderShop->pay_status_Num == 1):?>
                <span class="green">會員已填寫付款資訊</span>
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                款項確認狀態
            </div>
            <div class="spanLineLeft width500">
                <span class="<?if($OrderShop->paycheck_status_Num == 0):?>red<?elseif($OrderShop->paycheck_status_Num == 1):?>green<?endif?>">
                    <?if($OrderShop->paycheck_status_Num == 0):?>款項待確認<?endif?>
                    <?if($OrderShop->paycheck_status_Num == 1):?>款項已確認<?endif?>
                </span>
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
	<h3>貨物處理狀態</h3>
	<h4>請確認貨物處理狀態</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                購物貨物列表
            </div>
            <div class="spanLineLeft width300">
                貨物名稱
		    </div>
            <div class="spanLineLeft width100 aligncenter">
                單價
            </div>
            <div class="spanLineLeft width100 aligncenter">
                數量
            </div>
            <div class="spanLineLeft width100 aligncenter">
                小計
            </div>
		</div>
	</div>
    <?foreach($OrderShop->cart_CartShopList->obj_Arr as $key => $value_CartShop):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width300">
                <a href="admin/shop/product/product/edit/?productid=<?=$value_CartShop->product_ProductShop->productid_Num?>" target="_blank">
                    <?=$value_CartShop->product_ProductShop->name_Str?>
                </a>
            </div>
            <div class="spanLineLeft width100 aligncenter">
                <?=$value_CartShop->price_Num?>
            </div>
            <div class="spanLineLeft width100 aligncenter">
                <?=$value_CartShop->amount_Num?>
            </div>
            <div class="spanLineLeft width100 aligncenter">
                <?=$value_CartShop->price_total_Num?>
            </div>
        </div>
    </div>
    <?endforeach?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                貨物處理狀態
            </div>
            <div class="spanLineLeft width500">
                <span class="<?if($OrderShop->product_status_Num == 0):?>red<?elseif($OrderShop->product_status_Num == 1):?>green<?endif?>">
                    <?if($OrderShop->product_status_Num == 0):?>貨物待確認<?endif?>
                    <?if($OrderShop->product_status_Num == 1):?>貨物已確認<?endif?>
                </span>
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
	<h3>收件人資訊</h3>
	<h4>請確認訂單收件人資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件人姓名
            </div>
            <div class="spanLineLeft">
                <?=$OrderShop->receive_name_Str?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件人電話
            </div>
            <div class="spanLineLeft">
                <?=$OrderShop->receive_phone_Str?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件最佳時間
            </div>
            <div class="spanLineLeft width500">
                <?if($OrderShop->receive_time_Str == 'morning'):?>
                早上 8:00 ~ 12:00
                <?elseif($OrderShop->receive_time_Str == 'afternoon'):?>
                下午 12:00 ~ 17:00
                <?elseif($OrderShop->receive_time_Str == 'night'):?>
                晚上 17:00 以後
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件人地址
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->receive_address_Str?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                收件人備註
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->receive_remark_Str?>
		    </div>
		</div>
	</div>
    <div style="border-top: 2px #AAA dashed;margin:30px 0;"></div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                下單時間
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->setuptime_DateTimeObj->datetime_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最後更新時間
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->updatetime_DateTimeObj->datetime_Str?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                貨物寄出時間
            </div>
            <div class="spanLineLeft width500">
                <?=$OrderShop->sendtime_DateTimeObj->datetime_Str?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                訂單處理狀態
            </div>
            <div class="spanLineLeft width500">
                <span class="<?if($OrderShop->order_status_Num == 0):?>red<?elseif($OrderShop->order_status_Num == 1):?>green<?endif?>">
                    <?if($OrderShop->order_status_Num == 0):?>
                    訂單未完成
                    <?elseif($OrderShop->order_status_Num == 1):?>
                    訂單已完成，已確認貨物及付款狀態
                    <?endif?>
                </select>
		    </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">訂單確認狀態選項經確認送出後，便無法再修改本訂單所有資料</p>
            </div>
		</div>
	</div>
    <?if($OrderShop->pay_status_Num != 1):?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($OrderShop->orderid_Num)):?><input type="hidden" name="orderid_Num" value="<?=$OrderShop->orderid_Num?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($OrderShop->orderid_Num)):?>儲存變更<?else:?>確認訂單<?endif?>">
            </div>
        </div>
	</div>
    <?endif?>
	</form>
</div>
<?=$temp['admin_footer']?>