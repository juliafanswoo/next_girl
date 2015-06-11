<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > <?if(!empty($NoteField->noteid_Num)):?>編輯<?else:?>新增<?endif?></h3>
	<h4>請填寫<?=$child3_title_Str?>之詳細資訊</h4>
	<?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                文章名稱
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="title_Str" placeholder="請輸入文章名稱" value="<?=$NoteField->title_Str?>">
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                分類標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($NoteField->class_ClassMetaList->obj_Arr)):?>
                <div>
                    <select name="classids_Arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($NoteClassMetaList->obj_Arr as $key2 => $value2_NoteClass):?>
                        <option value="<?=$value2_NoteClass->classid_Num?>"<?if($NoteField->class_ClassMetaList->obj_Arr[0]->classid_Num == $value2_NoteClass->classid_Num):?> selected<?endif?>><?=$value2_NoteClass->classname_Str?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="classids_Arr[]">
                        <option value="">沒有分類標籤</option>
                        <?foreach($NoteClassMetaList->obj_Arr as $key => $value_ClassMeta):?>
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
                <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/classmeta/tablelist">管理分類標籤</a>
            </div>
        </div>
    </div>
    <?if(0):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                文章預覽圖
            </div>
            <div class="spanLineLeft width500">
                <div class="fileMultiple1"><input type="file" name="picids_FilesArr[]" accept="image/*"></div>
                <?if(!empty($NoteField->pic_PicObjList->obj_Arr[0]->picid_Num)):?>
                <div class="picidUploadList">
                    <div fanswoo-picid="<?=$NoteField->pic_PicObjList->obj_Arr[0]->picid_Num?>" class="picidUploadLi">
                        <div fanswoo-picDelete class="picDelete"></div>
                        <img src="<?=$NoteField->pic_PicObjList->obj_Arr[0]->path_Arr['w50h50']?>">
                        <input type="hidden" name="picids_Arr[]" value="<?=$NoteField->pic_PicObjList->obj_Arr[0]->picid_Num?>">
                    </div>
                </div>
                <?endif?>
		    </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineLeft width500">
                <span class="gray">請上傳300x300之圖檔</span>
		    </div>
		</div>
	</div>
    <?endif?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                文章簡介
            </div>
            <div class="spanLineRight">
                <textarea cols="80" id="content_Str" name="content_Str" rows="10"><?=$NoteField->content_Html?></textarea>
                <script src="app/js/ckeditor/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace( 'content_Str', {
                        toolbar: 'bbcode'
                    });
                </script>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum_Num" min="0" value="<?=$NoteField->prioritynum_Num?>">
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                瀏覽數
            </div>
            <div class="spanLineLeft">
                <?=$NoteField->viewnum_Num?>
            </div>
        </div>
    </div>
    <?if(0):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                回應數
            </div>
            <div class="spanLineLeft">
                <?=$NoteField->viewnum_Num?>
            </div>
        </div>
    </div>
    <?endif?>
    <?if(!empty($NoteField->noteid_Num)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$NoteField->updatetime_DateTime->datetime_Str?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($NoteField->noteid_Num)):?><input type="hidden" name="noteid_Num" value="<?=$NoteField->noteid_Num?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($NoteField->noteid_Num)):?>儲存變更<?else:?>新增文章<?endif?>">
                <?if(!empty($NoteField->noteid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?noteid=<?=$NoteField->noteid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>