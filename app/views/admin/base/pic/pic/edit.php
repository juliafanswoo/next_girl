<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>照片管理 - 新增照片</h2>
<div class="contentBox allWidth">
	<h3>新增照片</h3>
	<h4>請填寫欲新增之照片資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
    <?if(empty($PicObj->picid_Num)):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片上傳
            </div>
            <div class="spanLineLeft width500">
                <input type="file" name="picfile_FileArr" />
		    </div>
		</div>
	</div>
    <?else:?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片預覽
            </div>
            <div class="spanLineLeft width500">
                <img src="<?if(!empty($PicObj->path_Arr['w300h300'])):?><?=$PicObj->path_Arr['w300h300']?><?endif?>">
		    </div>
		</div>
	</div>
    <?if(!empty($PicObj->path_Arr['w0h0'])):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片網址
            </div>
            <div class="spanLineLeft width500">
                <input type="text" value="<?=prep_url($_SERVER['HTTP_HOST'].base_url($PicObj->path_Arr['w0h0']))?>">
                <br>
                <a href="<?=prep_url($_SERVER['HTTP_HOST'].base_url($PicObj->path_Arr['w0h0']))?>" target="_blank">
                    <?=prep_url($_SERVER['HTTP_HOST'].base_url($PicObj->path_Arr['w0h0']))?>
                </a>
		    </div>
		</div>
	</div>
    <?endif?>
    <?endif?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                分類標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($PicObj->class_ClassMetaList->obj_Arr)):?>
                <div>
                    <select name="classids_Arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($ClassMetaList->obj_Arr as $key2 => $value2_ClassMeta):?>
                        <option value="<?=$value2_ClassMeta->classid_Num?>"<?if($PicObj->class_ClassMetaList->obj_Arr[0]->classid_Num == $value2_ClassMeta->classid_Num):?> selected<?endif?>><?=$value2_ClassMeta->classname_Str?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="classids_Arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($ClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
                        <option value="<?=$value_ClassMeta->classid_Num?>"><?=$value_ClassMeta->classname_Str?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?endif?>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/album/tablelist">管理相簿</a>
            </div>
        </div>
    </div>
    <?if(!empty($PicObj->picid_Num)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$PicObj->updatetime_DateTime->datetime_Str?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($PicObj->picid_Num)):?><input type="hidden" name="picid_Num" value="<?=$PicObj->picid_Num?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($PicObj->picid_Num)):?>儲存變更<?else:?>新增產品<?endif?>">
                <?if(!empty($PicObj->picid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?picid=<?=$PicObj->picid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>