<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<div class="userBox">
	<h2>會員登入</h2>
	<div class="userBoxContent">
		<div class="message">
			<p>請輸入您的電子郵件帳號</p>
		</div>
		<?=form_open('user/login_post')?>
			<div class="paragraph">
				<p>會員電子郵件：</p>
				<p><input type="text" name="email_Str" placeholder="請輸入您的電子郵件"></p>
			</div>
			<div class="paragraph">
				<p>會員密碼：</p>
				<p><input type="password" name="password_Str" placeholder="請輸入您的密碼"></p>
			</div>
			<div class="paragraph">
				<label class="rememberme"><input type="checkbox" checked="true">保持登入狀態</label>
				<input type="submit" value="確認送出">
			</div>
			<input type="hidden" name="url_Str" value="<?=$url_Str?>">
		</form>
	</div>
	<div class="userBoxOther">
		<p><a href="user/register">註冊一個新帳號</a></p>
		<p><a href="user/forgetpsw">忘記密碼？</a></p>
		<p><a href="page/index">回到首頁</a></p>
	</div>
</div>
<?=$temp['footer']?>