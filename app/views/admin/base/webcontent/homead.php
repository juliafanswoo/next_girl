<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>內容管理 - 廣告設置</h2>
<div class="contentBox allWidth">
	<h3>廣告設置</h3>
	<h4>請填寫廣告設置，此設置之設置將影響網站前台之顯示</h4>
	<?php echo form_open('admin/websiteset/set/title') ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                廣告名稱
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" name="website_title_name" placeholder="請輸入網站標題名稱" value="">
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
                廣告引言
            </div>
            <div class="spanLineLeft width300">
			<input type="text" class="text" name="website_title_introduction" placeholder="請輸入網站標題文字" value="">
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
<?=$temp['admin_footer']?>