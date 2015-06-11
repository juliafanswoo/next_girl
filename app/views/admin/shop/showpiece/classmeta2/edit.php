<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?if(!empty($class_ClassMeta->classid_Num)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title_Str?>之詳細資訊</h4>
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                分類名稱
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" name="classname_Str" placeholder="標籤名稱" value="<?=$class_ClassMeta->classname_Str?>">
            </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">請輸入分類標籤的名稱，此標籤名稱可供產品作分類</p>
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                分類代號
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" name="slug_Str" placeholder="標籤名稱" value="<?=$class_ClassMeta->slug_Str?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">請填寫分類標籤的代號，此標籤代號將作為搜尋關鍵字</p>
                <p class="gray">本值需為英文及數字組合，不得含有中文，並且不得與其它分類標籤有重複</p>
            </div>
        </div>
    </div>
    <?if(0):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                三級分類
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($showpiece_Showpiece->class_ClassMetaList->obj_Arr)):?>
                <?foreach($showpiece_Showpiece->class_ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                <div fanswoo-classidSelect>
                    <select name="class_Arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($class_ClassMetaList->obj_Arr as $key2 => $value2_ClassMeta):?>
                        <option value="<?=$value2_ClassMeta->classid_Num?>"<?if($value_ClassMeta->classid_Num == $value2_ClassMeta->classid_Num):?> selected<?endif?>><?=$value2_ClassMeta->classname_Str?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?endforeach?>
                <?endif?>
                <div fanswoo-classidSelect>
                    <select name="class_Arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($class2_ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                        <option value="<?=$value_ClassMeta->classid_Num?>"><?=$value_ClassMeta->classname_Str?></option>
                        <?endforeach?>
                    </select>
                </div>
                <p><a href="admin/showpiece/class2_list">管理二級分類</a></p>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum_Num" value="<?=$class_ClassMeta->prioritynum_Num?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
            </div>
        </div>
    </div>
    <?if(!empty($class_ClassMeta->classid_Num)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$class_ClassMeta->updatetime_DateTime->datetime_Str?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
            <?if(!empty($class_ClassMeta->classid_Num)):?><input type="hidden" name="classid_Num" value="<?=$class_ClassMeta->classid_Num?>"><?endif?>
		    <input type="submit" class="submit" value="<?if(!empty($class_ClassMeta->classid_Num)):?>儲存變更<?else:?>新增標籤<?endif?>">
            <?if(!empty($class_ClassMeta->classid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?classid=<?=$class_ClassMeta->classid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
		</div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>