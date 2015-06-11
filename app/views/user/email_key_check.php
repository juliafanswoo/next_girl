<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<div class="userBox">
	<h2>確認帳號</h2>
	<div class="userBoxContent">
		<div class="message">
			<p>請輸入您的電子郵件，系統會將密碼重設資料寄至您的帳號</p>
			<?=$validation_errors?>
		</div>
		<?=form_open('user/forgetpsw_post')?>
			<div class="paragraph">
				<p>電子郵件：</p>
				<p><input type="email" name="email_Str" placeholder="請輸入您的電子郵件"></p>
			</div>
			<div class="paragraph">
				<input type="submit" value="確認送出">
			</div>
		</form>
	</div>
	<div class="userBoxOther">
		<p><a href="user/login">會員登入</a></p>
		<p><a href="user/register">註冊一個新帳號</a></p>
		<p><a href="page/index">回到首頁</a></p>
	</div>
</div>
<?=$temp['footer']?>