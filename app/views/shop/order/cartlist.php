<?=$temp['header_up']?>
<script>
$(function(){
	//運費變更
	$(document).on('change', ".productOther .payType", function(){
		var price_freight_before = $(".productOther .priceFreight").text();
		if($(this).val() == 'atm'){
			$(".productOther .priceFreight").text('80');
		}
		else if($(this).val() == 'cash_on_delivery'){
			$(".productOther .priceFreight").text('120');
		}
		else if($(this).val() == 'card'){
			$(".productOther .priceFreight").text('80');
		}
		$('.productPriceTotal').text(parseInt($('.productPriceTotal').text()) - price_freight_before + parseInt($(".productOther .priceFreight").text()));
	});
});
</script>
<?=$temp['header_down']?>
<?=$temp['topheader']?>

<div class="wrapContent">
	<h2 class="borderTitle">結帳中心</h2>
	<div class="checkoutBox">
    <?=form_open('order/cartlist_post')?>
		<div class="title">
			<div class="cartLi">
				<span class="name">商品名稱</span>
				<span class="price">單價</span>
				<span class="amount">數量</span>
				<span class="priceTotal">小計</span>
				<span class="delete">操作</span>
			</div>
		</div>
		<div class="cartList">
			<?if(!empty($OrderShop->cart_CartShopList->obj_Arr)):?>
			<?foreach($OrderShop->cart_CartShopList->obj_Arr as $key => $value_CartShop):?>
			<div class="cartLi">
				<span class="name"><a href="product/?productid=<?=$value_CartShop->productid_Num?>" target="_blank"><?=$value_CartShop->product_ProductShop->name_Str?></a></span>
				<span class="price"><?=$value_CartShop->price_Num?></span>
				<span class="amount">
					<?=$value_CartShop->amount_Num?>
				</span>
				<span class="priceTotal"><?=$value_CartShop->price_total_Num?></span>
				<span class="delete"><a href="order/delete_cart/?cartid=<?=$value_CartShop->cartid_Num?>" class="deleteButton" fanScript-hrefNone>刪除</a></span>
			</div>
			<?endforeach?>
			<?else:?>
			<div class="cartLi">
				<span class="name"><a href="shop">請先選擇想要購買的產品</a></span>
			</div>
			<?endif?>
		</div>
		<div class="productOther">
			<?if(!empty($OrderShop->cart_CartShopList->obj_Arr)):?>
			<div class="productTotal">消費總金額共 <b class="productPriceTotal"><?=$OrderShop->pay_price_total_Num?></b> 元</div>
			<?endif?>
			<select name="pay_paytype_Str" class="payType">
				<option value="atm"<?if($OrderShop->pay_paytype_Str == 'atm'):?> selected<?endif?>>ATM轉帳/宅配</option>
				<option value="card"<?if($OrderShop->pay_paytype_Str == 'card'):?> selected<?endif?>>信用卡/宅配</option>
				<option value="cash_on_delivery"<?if($OrderShop->pay_paytype_Str == 'cash_on_delivery'):?> selected<?endif?>>貨到付款</option>
			</select>
			運費 <span class="priceFreight"><?=$OrderShop->pay_price_freight_Num?></span> 元
		</div>
		<div class="checkoutPost">
			<a href="shop" class="button">繼續購物</a>
			<input type="submit" id="checkoutSteip1Submit" name="checkoutSteip1Submit" value="準備結帳">
		</div>
	</form>
	</div>
</div>
<?=$temp['footer']?>