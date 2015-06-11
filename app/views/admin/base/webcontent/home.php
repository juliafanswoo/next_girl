<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>內容管理 - 首頁內容</h2>
<div class="contentBox allWidth">
	<h3>展示藝廊</h3>
	<h4>請填寫首頁展示藝廊資料</h4>
	<?php echo form_open('admin/webcontent/home/showroom') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                展示藝廊背景圖
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="index_showroom_image" placeholder="請輸入超連結，http://" value="<?if(empty($setting_list_array['index_showroom_image']) == FALSE):?><?=$setting_list_array['index_showroom_image']?><?endif?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字介紹
            </div>
            <div class="spanLineRight">
                <textarea name="index_showroom_content"><?if(empty($setting_list_array['index_showroom_content']) == FALSE):?><?=$setting_list_array['index_showroom_content']?><?endif?></textarea>
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
	<h3>活動欄位</h3>
	<h4>請填寫活動欄位資料</h4>
	<?php echo form_open('admin/webcontent/home/activity') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                活動欄位背景圖
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="index_activity_image" placeholder="請輸入超連結，http://" value="<?if(empty($setting_list_array['index_activity_image']) == FALSE):?><?=$setting_list_array['index_activity_image']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字介紹
            </div>
            <div class="spanLineRight">
                <textarea name="index_activity_content"><?if(empty($setting_list_array['index_activity_content']) == FALSE):?><?=$setting_list_array['index_activity_content']?><?endif?></textarea>
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
	<h3>最新消息欄位</h3>
	<h4>請填寫首頁最新消息欄位資料</h4>
	<?php echo form_open('admin/webcontent/home/news') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                最新消息背景圖
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="index_news_image" placeholder="請輸入超連結，http://" value="<?if(empty($setting_list_array['index_news_image']) == FALSE):?><?=$setting_list_array['index_news_image']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字介紹
            </div>
            <div class="spanLineRight">
                <textarea name="index_news_content"><?if(empty($setting_list_array['index_news_content']) == FALSE):?><?=$setting_list_array['index_news_content']?><?endif?></textarea>
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
	<h3>品牌欄位</h3>
	<h4>請填寫首頁品牌欄位資料</h4>
	<?php echo form_open('admin/webcontent/home/brand') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                品牌背景圖
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" name="index_brand_image" placeholder="請輸入超連結，http://" value="<?if(empty($setting_list_array['index_brand_image']) == FALSE):?><?=$setting_list_array['index_brand_image']?><?endif?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                文字介紹
            </div>
            <div class="spanLineRight">
                <textarea name="index_brand_content"><?if(empty($setting_list_array['index_brand_content']) == FALSE):?><?=$setting_list_array['index_brand_content']?><?endif?></textarea>
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