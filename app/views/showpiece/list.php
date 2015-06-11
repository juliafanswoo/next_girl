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
		<?if(!empty($hot_ShowPieceList->obj_Arr)):?>
		<div class="hotList">
			<?foreach($hot_ShowPieceList->obj_Arr as $key => $value_ShowPiece):?>
			<div class="hotLi">
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="pic">
					<?if(!empty($value_ShowPiece->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic2" src="<?=$value_ShowPiece->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
					<?if(!empty($value_ShowPiece->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic1" src="<?=$value_ShowPiece->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
				</a>
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="title">
					<?=$value_ShowPiece->name_Str?>
				</a>
				<div class="border"></div>
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="freePrice">
					<b class="price"><?=$value_ShowPiece->price_Num?></b>
				</a>
			</div>
			<?endforeach?>
		</div>
		<?endif?>
		<?endif?>
        <?if(!empty($all_ShowPieceList->obj_Arr)):?>
		<div class="shopList">
		<?if(!empty($hot_ShowPieceList->obj_Arr)):?>
			<?foreach($hot_ShowPieceList->obj_Arr as $key => $value_ShowPiece):?>
			<div class="shopLi">
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="pic">
					<?if(!empty($value_ShowPiece->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic2" src="<?=$value_ShowPiece->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
					<?if(!empty($value_ShowPiece->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic1" src="<?=$value_ShowPiece->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
				</a>
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="title">
					<?=$value_ShowPiece->name_Str?>
				</a>
				<div class="border"></div>
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="freePrice">
					<b class="price"><?=$value_ShowPiece->price_Num?></b>
				</a>
			</div>
			<?endforeach?>
		<?endif?>
			<?foreach($all_ShowPieceList->obj_Arr as $key => $value_ShowPiece):?>
			<div class="shopLi">
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="pic">
					<?if(!empty($value_ShowPiece->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic2" src="<?=$value_ShowPiece->mainpic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
					<?if(!empty($value_ShowPiece->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600'])):?>
					<img class="pic1" src="<?=$value_ShowPiece->pic_PicObjList->obj_Arr[0]->path_Arr['w600h600']?>">
					<?endif?>
				</a>
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="title">
					<?=$value_ShowPiece->name_Str?>
				</a>
				<div class="border"></div>
				<a href="showpiece/view/?showpieceid=<?=$value_ShowPiece->showpieceid_Num?>" class="freePrice">
					<b class="price"><?=$value_ShowPiece->price_Num?></b>
				</a>
			</div>
			<?endforeach?>
		</div>
		<div class="pageLink"><?=$showpiece_links?></div>
		<?else:?>
		<h2 class="borderTitle">產品列表一覧</h2>
		<div style="height:500px;">
		未有搜尋的項目
		</div>
		<?endif?>
	</div>
<?=$temp['footer']?>