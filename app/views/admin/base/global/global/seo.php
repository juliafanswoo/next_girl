<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
	<h3>SEO標籤</h3>
	<h4>請填寫網站SEO標籤，此設置之設置將影響網站前台之顯示</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
			網站標題名稱
            </div>
            <div class="spanLineRight">
    			 <textarea name="website_metatag"><?=$global['website_metatag']?></textarea>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">每個不同的SEO標籤請以「,」分隔，如要區分大段落的SEO標籤，請以斷行分隔</p>
            </div>
        </div>
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
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