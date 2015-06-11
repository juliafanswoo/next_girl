<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<div class="wrapContent">
	<h2 class="borderTitle">付款資料確認</h2>
	<div class="checkoutBox">
	<?if($OrderShop->pay_paytype_Str === 'card'):?>
    <?=form_open('order/checkout_card_post')?>
	<?else:?>
    <?=form_open('order/checkout_post')?>
    <?endif?>
		<div class="cardTable">
			<h2 class="bigTitle">付款方式</h2>
			<div class="stage">
				<div class="floatright">
					<?if($OrderShop->pay_paytype_Str === 'atm'):?>
					ATM轉帳
					<?elseif($OrderShop->pay_paytype_Str === 'card'):?>
					信用卡
					<?elseif($OrderShop->pay_paytype_Str === 'cash_on_delivery'):?>
					貨到付款
					<?endif?>
				</div>
				<input type="hidden" id="payType" name="payType" value="$checkout[pay][payType]">
				<div class="floatleft">付款方式</div>
			</div>
			<div class="stage">
				<div class="floatright">
					NT$ <?=$OrderShop->pay_price_total_Num?> （包含運費 NT$ <?=$OrderShop->pay_price_freight_Num?> ）
					<input type="hidden" id="priceTotal" name="priceTotal" value="$checkout[price][priceTotal]">
				</div>
				<div class="floatleft">付款總金額</div>
			</div>
			<?if($OrderShop->pay_paytype_Str === 'atm'):?>
			<h2 class="bigTitle">轉帳帳號</h2>
			<div class="stage">
				<div class="floatright">中國信託（銀行代號：700）</div>
				<div class="floatleft">銀行代號</div>
			</div>
			<div class="stage">
				<div class="floatright">123-456-789-000</div>
				<div class="floatleft">銀行帳號</div>
			</div>
			<div class="stage">
				<div class="floatright">鏡花園有限公司</div>
				<div class="floatleft">銀行戶名</div>
			</div>
			<div class="stage">
				<div class="floatright">您選擇的是以ATM轉帳的方式進行下單，請於匯款完畢至後台填寫匯款資訊</div>
				<div class="floatleft">備註</div>
			</div>
			<?endif?>
			<h2 class="bigTitle">寄件資訊</h2>
			<div class="stage">
				<div class="floatright">
					<?if($OrderShop->pay_sendtype_Str === 'delivery'):?>
					宅配
					<?elseif($OrderShop->pay_sendtype_Str === 'cash_on_delivery'):?>
					貨到付款
					<?else:?>
					其它
					<?endif?>
				</div>
				<div class="floatleft">寄送方式</div>
			</div>
			<div class="stage">
				<div class="floatright"><input type="text" id="receive_name_Str" name="receive_name_Str" value=""></div>
				<div class="floatleft">收件人姓名</div>
			</div>
			<div class="stage">
				<div class="floatright"><input type="text" id="receive_address_Str" name="receive_address_Str" value="" style="width:300px;"></div>
				<div class="floatleft">寄件地址</div>
			</div>
			<div class="stage">
				<div class="floatright"><input type="text" id="receive_phone_Str" name="receive_phone_Str" value=""></div>
				<div class="floatleft">聯絡電話</div>
			</div>
			<div class="stage">
				<div class="floatright">
					<select id="receive_time_Str" name="receive_time_Str">
						<option value="morning">早上 8:00 ~ 12:00</option>
						<option value="afternoon">下午 12:00 ~ 17:00</option>
						<option value="night">晚上 17:00 以後</option>
					</select>
				</div>
				<div class="floatleft">收貨時間</div>
			</div>
			<div class="stage" style="height:100px;">
				<div class="floatright">
					<textarea style="height:90px;width:500px;" id="receive_remark_Str" name="receive_remark_Str"></textarea>
				</div>
				<div class="floatleft">備註事項</div>
			</div>
		</div>
		<div class="checkoutPost">
			<a href="order/cartlist" class="button">回上一步</a>
			<input type="hidden" id="cid" name="cid" value="$checkout[cid]">
			<input type="submit" value="送出訂單">
		</div>
	</form>
	</div>
<?=$temp['footer']?>