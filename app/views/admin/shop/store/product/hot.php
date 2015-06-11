<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2><?=$child2_title_Str?> - <?=$child3_title_Str?></h2>
<div class="contentBox allWidth">
    <h3>首頁熱門產品管理</h3>
    <h4>請填寫首頁熱門產品之PID編號</h4>
    <?php echo form_open_multipart("admin/$child1_name_Str/$child2_name_Str/$child3_name_Str/{$child4_name_Str}_post/") ?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                首頁熱門銷售產品列表
            </div>
            <div class="spanLineLeft width500">
                <textarea name="shop_hot_product" placeholder="請填寫產品PID編號，每個欲顯示的熱門產品填寫一行"><?=$global['shop_hot_product']?></textarea>
            </div>
        </div>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">請填寫產品PID編號，每個欲顯示的熱門產品填寫一行。</p>
                <p class="gray">本熱門銷售產品列表將於首頁顯示。</p>
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