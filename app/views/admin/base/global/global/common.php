<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3><?=$this->lang->line('common_website_title_management')?></h3>
    <h4>請填寫標題之詳細資訊</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_title_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                網站標題名稱
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" name="website_title_name" placeholder="請輸入網站標題名稱" value="<?=$global['website_title_name']?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">本網站標題名稱將於網站標題最前端顯示</p>
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                網站標題引言
            </div>
            <div class="spanLineLeft width300">
			<input type="text" class="text" name="website_title_introduction" placeholder="請輸入網站標題文字" value="<?=$global['website_title_introduction']?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">本網站標題文字將於網站標題最後端顯示</p>
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
	<h3>網站名稱設置</h3>
	<h4>請填寫網站名稱及LOGO圖檔，此設置之設置將影響網站前台之顯示</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_webname_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                網站名稱
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" placeholder="請輸入網站名稱" name="website_name" value="<?=$global['website_name']?>">
            </div>
        </div>
	</div>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                網站LOGO圖檔
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" placeholder="請輸入圖檔連結，http://" name="website_logo" value="<?=$global['website_logo']?>">
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">請填寫圖檔位置，可以填寫本網站圖檔之相對位置，也可以填寫外網之絕對位置網址</p>
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
	<h3>客服電子郵件</h3>
	<h4>請填寫電子郵件位置，此設置之設置將影響網站前台之顯示</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_email_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                電子郵件
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" placeholder="請輸入電子郵件，ex: service@fanswoo.com" name="website_email" value="<?=$global['website_email']?>">
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
    <h3>SMTP mail server</h3>
    <h4>若本系統擁有SMTP寄件功能，此設置將影響網站SMTP之設定</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_smtp_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                SMTP帳號
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" placeholder="請輸入SMTP帳號" name="smtp_account" value="<?if(!empty($global['smtp_account'])):?><?=$global['smtp_account']?><?endif?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                SMTP密碼
            </div>
            <div class="spanLineLeft width300">
                <input type="password" class="text" placeholder="請輸入SMTP密碼" name="smtp_password" value="<?if(!empty($global['smtp_password'])):?><?=$global['smtp_password']?><?endif?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                SMTP顯示郵件
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" placeholder="請輸入SMTP顯示郵件" name="smtp_email" value="<?if(!empty($global['smtp_email'])):?><?=$global['smtp_email']?><?endif?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                SMTP顯示姓名
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" placeholder="請輸入SMTP顯示姓名" name="smtp_username" value="<?if(!empty($global['smtp_username'])):?><?=$global['smtp_username']?><?endif?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                SMTP Host
            </div>
            <div class="spanLineLeft width300">
                <input type="text" class="text" placeholder="請輸入SMTP Host" name="smtp_host" value="<?if(!empty($global['smtp_host'])):?><?=$global['smtp_host']?><?endif?>">
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                SMTP SSL
            </div>
            <div class="spanLineLeft width300">
                <label><input type="checkbox" name="smtp_ssl_checkbox"<?if(!empty($global['smtp_ssl_checkbox']) && $global['smtp_ssl_checkbox'] == 1):?> checked<?endif?>> 連接SSL port 445</label>
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