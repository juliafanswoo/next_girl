<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
<div class="userBox">
	<h2>重設密碼</h2>
	<div class="userBoxContent">
		<div class="message">
			<p>請輸入您在信箱內收到的驗證碼及新密碼，驗證碼有效時間只在一小時內有效，若超過驗證時間，請<a href="user/forgetpsw">重新寄送驗證碼</a></p>
			<?=$validation_errors?>
		</div>
		<?=form_open('user/resetpsw_post')?>
			<div class="paragraph">
				<p>電子郵件帳號：</p>
				<p><input type="text" name="email_Str" placeholder="請輸入您的電子信箱帳號" value="<?if(!empty($email_Str)):?><?=$email_Str?><?endif?>"></p>
			</div>
			<div class="paragraph">
				<p>信箱驗證碼：</p>
				<p><input type="text" name="change_email_key_Str" placeholder="請輸入您的信箱驗證碼" value="<?if(!empty($change_email_key_Str)):?><?=$change_email_key_Str?><?endif?>"></p>
			</div>
			<div class="paragraph">
				<p>輸入新密碼：</p>
				<p><input type="password" name="password_Str" placeholder="請輸入您的新密碼"></p>
			</div>
			<div class="paragraph">
				<p>重複新密碼：</p>
				<p><input type="password" name="password2_Str" placeholder="請重新輸入您的密碼"></p>
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