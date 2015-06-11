<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>訂單管理 - 訂單列表</h2>
<div class="contentBox allWidth">
	<h3>訂單列表</h3>
	<h4>請填寫欲新增或更改之訂單</h4>
	<div class="spanLine noneBg">
	</div>
	<div class="spanLine tableTitle">
        <div class="spanLineLeft text width100">
			訂單ID
        </div>
        <div class="spanLineLeft text width100">
			會員ID
        </div>
        <div class="spanLineLeft text width100">
            款項支付狀態
        </div>
        <div class="spanLineLeft text width100">
			款項確認狀態
        </div>
        <div class="spanLineLeft text width100">
			貨物處理狀態
        </div>
        <div class="spanLineLeft text width100">
			訂單執行狀態
        </div>
        <div class="spanLineLeft text width150">
            下單時間
        </div>
	</div>
    <?foreach($OrderShopList->obj_Arr as $key => $value_OrderShop):?>
    <div class="spanLine">
        <div class="spanLineLeft text width100">
            <?=$value_OrderShop->orderid_Num?>
        </div>
        <div class="spanLineLeft text width100">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?orderid=<?=$value_OrderShop->orderid_Num?>"><?=$value_OrderShop->uid_Num?></a>
        </div>
        <div class="spanLineLeft text width100">
            <?if($value_OrderShop->pay_status_Num == 1):?>
            <span class="green">會員已填單</span>
            <?elseif($value_OrderShop->pay_status_Num == 0):?>
            <span class="red">會員未填單</span>
            <?endif?>
        </div>
        <div class="spanLineLeft text width100">
            <?if($value_OrderShop->paycheck_status_Num == 1):?>
            <span class="green">款項已確認</span>
            <?elseif($value_OrderShop->paycheck_status_Num == 0):?>
            <span class="red">款項未確認</span>
            <?endif?>
        </div>
        <div class="spanLineLeft text width100">
            <?if($value_OrderShop->product_status_Num == 1):?>
            <span class="green">貨物已備妥</span>
            <?elseif($value_OrderShop->product_status_Num == 0):?>
            <span class="red">貨物準備中</span>
            <?endif?>
        </div>
        <div class="spanLineLeft text width100">
            <?if($value_OrderShop->order_status_Num == 1):?>
            <span class="green">訂單已完成</span>
            <?elseif($value_OrderShop->order_status_Num == 0):?>
            <span class="red">訂單處理中</span>
            <?endif?>
        </div>
        <div class="spanLineLeft text width150">
            <?=$value_OrderShop->setuptime_DateTimeObj->datetime_Str?>
        </div>
        <div class="spanLineLeft width300 hoverHidden">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?orderid=<?=$value_OrderShop->orderid_Num?>">編輯</a>
        </div>
	</div>
    <?endforeach?>
    <div class="pageLink"><?=$page_links?></div>
</div>
<?=$temp['admin_footer']?>
