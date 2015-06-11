<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
	<h3>Google Analytics</h3>
	<h4>請填寫Google Analytics外掛原始碼，此設置之設置將影響網站前台之顯示</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_ga_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
			外掛原始碼
            </div>
            <div class="spanLineRight">
    			<textarea name="website_script_plugin_ga"><?=$global['website_script_plugin_ga']?></textarea>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
			<p class="gray">請複製原始碼程式，並且包含「&lt;script&gt;&lt;/script&gt;」標籤</p>
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
	<h3>facebook API</h3>
	<h4>請填寫facebook API外掛原始碼，此設置之設置將影響網站前台之顯示</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_fb_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
			外掛原始碼
            </div>
            <div class="spanLineRight">
    			<textarea name="website_script_plugin_fb"><?=$global['website_script_plugin_fb']?></textarea>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
			<p class="gray">請複製原始碼程式，並且包含「&lt;script&gt;&lt;/script&gt;」標籤</p>
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
	<h3>其它第三方外掛</h3>
	<h4>請填寫其它第三方外掛原始碼，此設置之設置將影響網站前台之顯示</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_custom_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
			外掛原始碼
            </div>
            <div class="spanLineRight">
    			<textarea name="website_script_plugin_custom"><?=$global['website_script_plugin_custom']?></textarea>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
			<p class="gray">請複製原始碼程式，並且包含「&lt;script&gt;&lt;/script&gt;」標籤</p>
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