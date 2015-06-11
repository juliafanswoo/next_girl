<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > 基本資料<?if(!empty($user_UserFieldShop->uid_Num)):?>編輯<?else:?>新增<?endif?></h3>
	<h4>請填寫<?=$child3_title_Str?>之詳細資訊</h4>
	<?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                電子郵件帳號
            </div>
            <div class="spanLineLeft width200">
                <?=$user_UserFieldShop->email_Str?>
            </div>
        </div>
    </div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                會員名稱
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="username_Str" placeholder="請輸入會員名稱" value="<?=$user_UserFieldShop->username_Str?>">
		    </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員群組
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($user_UserFieldShop->group_UserGroupList->obj_Arr)):?>
                <div>
                    <select name="groupids_Arr[]" disabled="false">
                        <option value="">沒有分類標籤</option>
                        <?foreach($UserGroupList->obj_Arr as $key2 => $value2_UserGroup):?>
                        <option value="<?=$value2_UserGroup->groupid_Num?>"<?if($user_UserFieldShop->group_UserGroupList->obj_Arr[0]->groupid_Num == $value2_UserGroup->groupid_Num):?> selected<?endif?>><?=$value2_UserGroup->groupname_Str?></option>
                        <?endforeach?>
                    </select>
                </div>
                <?else:?>
                <div>
                    <select name="groupids_Arr[]" disabled="false">
                        <option value="">沒有分類標籤</option>
                        <?foreach($UserGroupList->obj_Arr as $key => $value_UserGroup):?>
                        <option value="<?=$value_UserGroup->groupid_Num?>"><?=$value_UserGroup->groupname_Str?></option>
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
                <a href="admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/classmeta/tablelist">會員群組列表</a>
            </div>
        </div>
    </div>
    <?if(!empty($user_UserFieldShop->uid_Num)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$user_UserFieldShop->updatetime_DateTime->datetime_Str?>
            </div>
        </div>
    </div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($user_UserFieldShop->uid_Num)):?><input type="hidden" name="uid_Num" value="<?=$user_UserFieldShop->uid_Num?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($user_UserFieldShop->uid_Num)):?>儲存變更<?else:?>新增會員<?endif?>">
                <?if(!empty($user_UserFieldShop->uid_Num)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name_Str?>/<?=$child2_name_Str?>/<?=$child3_name_Str?>/delete/?productid=<?=$user_UserFieldShop->uid_Num?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title_Str?></span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > 商店資料編輯</h3>
    <h4>請填寫<?=$child3_title_Str?>商店資料編輯之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_userfieldshop_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                常用收件人姓名
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="receive_name_Str" placeholder="請輸入收件人姓名" value="<?=$user_UserFieldShop->receive_name_Str?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                常用收件人電話
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="receive_phone_Str" placeholder="請輸入收件人電話" value="<?=$user_UserFieldShop->receive_phone_Str?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                常用收件人地址
            </div>
            <div class="spanLineLeft width200">
                <input type="text" class="text" name="receive_address_Str" placeholder="請輸入收件人地址" value="<?=$user_UserFieldShop->receive_address_Str?>">
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($user_UserFieldShop->uid_Num)):?><input type="hidden" name="uid_Num" value="<?=$user_UserFieldShop->uid_Num?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($user_UserFieldShop->uid_Num)):?>儲存變更<?else:?>新增會員<?endif?>">
            </div>
        </div>
    </div>
    </form>
</div>
<div class="contentBox allWidth">
    <h3><?=$child3_title_Str?> > 變更密碼</h3>
    <h4>請填寫新的<?=$child3_title_Str?>會員密碼</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_changepassword_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                電子郵件帳號
            </div>
            <div class="spanLineLeft width200">
                <?=$user_UserFieldShop->email_Str?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                變更密碼
            </div>
            <div class="spanLineLeft width200">
                <input type="password" class="text" name="password_Str" placeholder="請輸入欲變更的會員密碼">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
                
            </div>
            <div class="spanLineRight">
                <span class="gray">請輸入英文與數字結合之8-16個字元的密碼</span>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                確認密碼
            </div>
            <div class="spanLineLeft width200">
                <input type="password" class="text" name="password2_Str" placeholder="請再次輸入欲變更的會員密碼">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
                
            </div>
            <div class="spanLineRight">
                <span class="gray">請確認兩次輸入的密碼一致</span>
            </div>
        </div>
    </div>
    <?if(!empty($user_UserFieldShop->uid_Num)):?>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($user_UserFieldShop->uid_Num)):?><input type="hidden" name="uid_Num" value="<?=$user_UserFieldShop->uid_Num?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($user_UserFieldShop->uid_Num)):?>儲存變更<?else:?>新增會員<?endif?>">
            </div>
        </div>
    </div>
    <?endif?>
    </form>
</div>
<?=$temp['admin_footer']?>