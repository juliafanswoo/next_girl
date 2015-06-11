<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>內容管理 - 品牌故事</h2>
<div class="contentBox allWidth">
	<h3>品牌故事第一項</h3>
	<h4>請填寫品牌故事第一項</h4>
	<?php echo form_open('admin/webcontent/story/story1') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字標題
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="page_story_title1" placeholder="請輸入標題" value="<?if(empty($setting_list_array['page_story_title1'])===FALSE):?><?=$setting_list_array['page_story_title1']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字副標題
            </div>
            <div class="spanLineLeft width300">
			<input type="text" class="text" name="page_story_text1" placeholder="請輸入副標題" value="<?if(empty($setting_list_array['page_story_text1'])===FALSE):?><?=$setting_list_array['page_story_text1']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字內容
            </div>
            <div class="spanLineRight">
                <textarea name="page_story_content1"><?if(empty($setting_list_array['page_story_content1'])===FALSE):?><?=$setting_list_array['page_story_content1']?><?endif?></textarea>
            </div>
        </div>
	</div>
	<div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <input type="submit" class="submit" value="儲存設置">
            </div>
        </div>
	</div>
	</form>
</div>
<div class="contentBox allWidth">
	<h3>品牌故事第二項</h3>
	<h4>請填寫品牌故事第二項</h4>
	<?php echo form_open('admin/webcontent/story/story2') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字標題
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="page_story_title2" placeholder="請輸入標題" value="<?if(empty($setting_list_array['page_story_title2'])===FALSE):?><?=$setting_list_array['page_story_title2']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字副標題
            </div>
            <div class="spanLineLeft width300">
			<input type="text" class="text" name="page_story_text2" placeholder="請輸入副標題" value="<?if(empty($setting_list_array['page_story_text2'])===FALSE):?><?=$setting_list_array['page_story_text2']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字內容
            </div>
            <div class="spanLineRight">
                <textarea name="page_story_content2"><?if(empty($setting_list_array['page_story_content2'])===FALSE):?><?=$setting_list_array['page_story_content2']?><?endif?></textarea>
            </div>
        </div>
	</div>
	<div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <input type="submit" class="submit" value="儲存設置">
            </div>
        </div>
	</div>
	</form>
</div>
<div class="contentBox allWidth">
	<h3>品牌故事第三項</h3>
	<h4>請填寫品牌故事第三項</h4>
	<?php echo form_open('admin/webcontent/story/story3') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字標題
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="page_story_title3" placeholder="請輸入標題" value="<?if(empty($setting_list_array['page_story_title3'])===FALSE):?><?=$setting_list_array['page_story_title3']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字副標題
            </div>
            <div class="spanLineLeft width300">
			<input type="text" class="text" name="page_story_text3" placeholder="請輸入副標題" value="<?if(empty($setting_list_array['page_story_text3'])===FALSE):?><?=$setting_list_array['page_story_text3']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字內容
            </div>
            <div class="spanLineRight">
                <textarea name="page_story_content3"><?if(empty($setting_list_array['page_story_content3'])===FALSE):?><?=$setting_list_array['page_story_content3']?><?endif?></textarea>
            </div>
        </div>
	</div>
	<div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <input type="submit" class="submit" value="儲存設置">
            </div>
        </div>
	</div>
	</form>
</div>
<div class="contentBox allWidth">
	<h3>品牌故事第四項</h3>
	<h4>請填寫品牌故事第四項</h4>
	<?php echo form_open('admin/webcontent/story/story4') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字標題
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="page_story_title4" placeholder="請輸入標題" value="<?if(empty($setting_list_array['page_story_title4'])===FALSE):?><?=$setting_list_array['page_story_title4']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字副標題
            </div>
            <div class="spanLineLeft width300">
			<input type="text" class="text" name="page_story_text4" placeholder="請輸入副標題" value="<?if(empty($setting_list_array['page_story_text4'])===FALSE):?><?=$setting_list_array['page_story_text4']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字內容
            </div>
            <div class="spanLineRight">
                <textarea name="page_story_content4"><?if(empty($setting_list_array['page_story_content4'])===FALSE):?><?=$setting_list_array['page_story_content4']?><?endif?></textarea>
            </div>
        </div>
	</div>
	<div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <input type="submit" class="submit" value="儲存設置">
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>