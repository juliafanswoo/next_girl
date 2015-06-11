<?=$temp['header_up']?>
<script>
$(function(){
	$('.hotLi .pic').height($(".hotLi .pic").width());
	$('.shopLi .pic').height($(".shopLi .pic").width());
	$(window).resize(function(){
		$('.hotLi .pic').height($(".hotLi .pic").width());
		$('.shopLi .pic').height($(".shopLi .pic").width());
	});
});
</script>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<?=$temp['shop_wrapsidebar']?>
<div class="wrapContent">
	<div class="wrapContentCenter">
		<?if(0):?>
		<?if(!empty($hot_product_ProductShopList->obj_Arr)):?>
		<div class="hotList">
			<?foreach($hot_product_ProductShopList->obj_Arr as $key => $value_ProductShop):?>
			<div class="hotLi">
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="pic">
					<?if(!empty($value_ProductShop->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic2" src="<?=$value_ProductShop->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
					<?if(!empty($value_ProductShop->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic1" src="<?=$value_ProductShop->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
				</a>
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="title">
					<?=$value_ProductShop->name_Str?>
				</a>
				<div class="border"></div>
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="freePrice">
					<b class="price"><?=$value_ProductShop->price_Num?></b>
				</a>
			</div>
			<?endforeach?>
		</div>
		<?endif?>
		<?endif?>
        <?if(!empty($all_product_ProductShopList->obj_Arr)):?>
		<div class="shopList">
		<?if(!empty($hot_product_ProductShopList->obj_Arr)):?>
			<?foreach($hot_product_ProductShopList->obj_Arr as $key => $value_ProductShop):?>
			<div class="shopLi">
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="pic">
					<?if(!empty($value_ProductShop->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic2" src="<?=$value_ProductShop->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
					<?if(!empty($value_ProductShop->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic1" src="<?=$value_ProductShop->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
				</a>
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="title">
					<?=$value_ProductShop->name_Str?>
				</a>
				<div class="border"></div>
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="freePrice">
					<b class="price"><?=$value_ProductShop->price_Num?></b>
				</a>
			</div>
			<?endforeach?>
		<?endif?>
			<?foreach($all_product_ProductShopList->obj_Arr as $key => $value_ProductShop):?>
			<div class="shopLi">
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="pic">
					<?if(!empty($value_ProductShop->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic2" src="<?=$value_ProductShop->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
					<?if(!empty($value_ProductShop->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic1" src="<?=$value_ProductShop->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
				</a>
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="title">
					<?=$value_ProductShop->name_Str?>
				</a>
				<div class="border"></div>
				<a href="product/?productid=<?=$value_ProductShop->productid_Num?>" class="freePrice">
					<b class="price"><?=$value_ProductShop->price_Num?></b>
				</a>
			</div>
			<?endforeach?>
		</div>
		<div class="pageLink"><?=$product_links?></div>
		<?else:?>
		<h2 class="borderTitle">產品列表一覧</h2>
		<div style="height:500px;">
		未有搜尋的項目
		</div>
		<?endif?>
	</div>
<?=$temp['footer']?>