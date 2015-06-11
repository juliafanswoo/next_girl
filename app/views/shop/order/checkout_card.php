<body onload="document.form.submit()" style="display:none;">
<form method="POST" name="form" action="https://testepos.ctbcbank.com/auth/SSLAuthUI.jsp">
	<input type="text" name="merID" value="<?=$merID?>">
	<input type="text" name="URLEnc" value="<?=$URLEnc?>">
    <input type="text" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>">
</form>
</body>