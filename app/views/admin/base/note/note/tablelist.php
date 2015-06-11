<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
	<h3><?=$child3_title_Str?> > <?=$child4_title_Str?></h3>
	<h4>請選擇欲修改之<?=$child3_title_Str?></h4>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
			<a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit" class="button">新增<?=$child3_title_Str?></a>
        </div>
	</div>
	<div class="spanLine tableTitle">
        <div class="spanLineLeft text width100">
			文章ID
        </div>
        <div class="spanLineLeft text width500">
			文章標題
        </div>
        <div class="spanLineLeft text width150">
            文章分類標籤
        </div>
	</div>
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
        <div class="spanLine">
            <div class="spanLineLeft text width100">
                <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_noteid_Num)?$search_noteid_Num:''?>" name="search_noteid_Num" placeholder="請填寫ID">
            </div>
            <div class="spanLineLeft text width500">
                <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_title_Str)?$search_title_Str:''?>" name="search_title_Str" placeholder="請填寫文章標題">
            </div>
            <div class="spanLineLeft text width150">
                <select name="search_class_slug_Str" style="margin-left:-6px;">
                    <option value="">不透過分類標籤篩選</option>
                    <?foreach($NoteClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                    <option value="<?=$value_ClassMeta->slug_Str?>"<?if(!empty($search_class_slug_Str) && $search_class_slug_Str == $value_ClassMeta->slug_Str) echo ' selected'?>><?=$value_ClassMeta->classname_Str?></option>
                    <?endforeach?>
                </select>
            </div>
            <div class="spanLineLeft text width150">
                <input type="submit" class="button" style="height: 30px; margin-left:-6px;" value="篩選">
            </div>
        </div>
    </form>
    <?if(!empty($NoteList->obj_Arr)):?>
    <?foreach($NoteList->obj_Arr as $key => $value_Note):?>
    <div class="spanLine">
        <div class="spanLineLeft text width100">
            <?=$value_Note->noteid_Num?>
        </div>
        <div class="spanLineLeft text width500">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?noteid=<?=$value_Note->noteid_Num?>"><?=$value_Note->title_Str?></a>
        </div>
        <div class="spanLineLeft text width150">
            <?if(!empty($value_Note->class_ClassMetaList->obj_Arr)):?>
            <?foreach($value_Note->class_ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                <?if($key !== 0):?>,<?endif?><?=$value_ClassMeta->classname_Str?>
            <?endforeach?>
            <?else:?>
            <span class="gray">沒有分類標籤</span>
            <?endif?>
        </div>
        <div class="spanLineLeft width300 hoverHidden">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?noteid=<?=$value_Note->noteid_Num?>">編輯</a>
            <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?noteid=<?=$value_Note->noteid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer']?>