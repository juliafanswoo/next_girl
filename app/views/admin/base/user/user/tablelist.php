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
        <div class="spanLineLeft text width100">
			會員ID
        </div>
        <div class="spanLineLeft text width200">
			會員名稱
        </div>
        <div class="spanLineLeft text width300">
            電子郵件帳號
        </div>
        <div class="spanLineLeft text width150">
            會員群組
        </div>
	</div>
    <?php echo form_open("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
        <div class="spanLine">
            <div class="spanLineLeft text width100">
                <input type="number" class="text" style="margin-left:-6px;" min="0" value="<?=!empty($search_uid_Num)?$search_uid_Num:''?>" name="search_uid_Num" placeholder="請填寫ID">
            </div>
            <div class="spanLineLeft text width200">
                <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_username_Str)?$search_username_Str:''?>" name="search_username_Str" placeholder="請填寫會員名稱">
            </div>
            <div class="spanLineLeft text width300">
                <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_email_Str)?$search_email_Str:''?>" name="search_email_Str" placeholder="請填寫會員電子郵件帳號">
            </div>
            <div class="spanLineLeft text width150">
                <select name="search_group_groupid_Num" style="margin-left:-6px;">
                    <option value="">不透過分類標籤篩選</option>
                    <?foreach($UserGroupList->obj_Arr as $key => $value_UserGroup):?>
                    <option value="<?=$value_UserGroup->groupid_Num?>"<?if(!empty($search_group_groupid_Num) && $search_group_groupid_Num == $value_UserGroup->groupid_Num) echo ' selected'?>><?=$value_UserGroup->groupname_Str?></option>
                    <?endforeach?>
                </select>
            </div>
            <div class="spanLineLeft text width150">
                <input type="submit" class="button" style="height: 30px; margin-left:-6px;" value="篩選">
            </div>
        </div>
    </form>
    <?if(!empty($user_UserList->obj_Arr)):?>
    <?foreach($user_UserList->obj_Arr as $key => $value_User):?>
    <div class="spanLine">
        <div class="spanLineLeft text width100">
            <?=$value_User->uid_Num?>
        </div>
        <div class="spanLineLeft text width200">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?uid=<?=$value_User->uid_Num?>"><?=$value_User->username_Str?></a>
        </div>
        <div class="spanLineLeft text width300">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?uid=<?=$value_User->uid_Num?>"><?=$value_User->email_Str?></a>
        </div>
        <div class="spanLineLeft text width150">
            <?if(!empty($value_User->group_UserGroupList->obj_Arr)):?>
            <?foreach($value_User->group_UserGroupList->obj_Arr as $key => $value_UserGroup):?>
                <?if($key !== 0):?>,<?endif?><?=$value_UserGroup->groupname_Str?>
            <?endforeach?>
            <?else:?>
            <span class="gray">沒有分類標籤</span>
            <?endif?>
        </div>
        <div class="spanLineLeft width300 hoverHidden">
            <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/edit/?uid=<?=$value_User->uid_Num?>">編輯</a>
            <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?uid=<?=$value_User->uid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
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
    <div class="pageLink"><?=$product_links?></div>
</div>
<?=$temp['admin_footer']?>