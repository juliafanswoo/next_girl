<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?=$child4_title_Str?></h3>
    <h4>請選擇欲修改之<?=$child3_title_Str?></h4>
    <?if(0):?>
    <div class="spanLine noneBg">
        <div class="spanLineLeft">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit" class="button">新增<?=$child3_title_Str?></a>
        </div>
    </div>
    <?endif?>
	<div class="spanLine tableTitle">
        <div class="spanLineLeft text width300">
			分類名稱
        </div>
	</div>
    <?if(!empty($AdvertisingClassList->obj_Arr)):?>
    <?foreach($AdvertisingClassList->obj_Arr as $key => $value_AdvertisingClass):?>
    <div class="spanLine">
        <div class="spanLineLeft text width300">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/advertising/tablelist/?class_slug=<?=$value_AdvertisingClass->classid_Num?>"><?=$value_AdvertisingClass->classname_Str?></a>
        </div>
        <div class="spanLineLeft width150 hoverHidden">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/advertising/tablelist/?class_slug=<?=$value_AdvertisingClass->classid_Num?>">查看廣告</a>
        </div>
	</div>
    <?endforeach?>
    <?else:?>
    <div class="spanLine">
        <div class="spanLineLeft text width500">
            這個篩選條件沒有搜尋到結果，請選擇其它篩選條件
        </div>
    </div>
    <?endif?>
    <div class="pageLink"><?=$class_links?></div>
</div>
<?=$temp['admin_footer']?>