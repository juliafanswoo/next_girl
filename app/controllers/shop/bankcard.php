<?php

	$merID = '6021';
	$MerchantName = 'WantGo';
	$MerchantID = '8220130016865';
	$TerminalID = '99804617';
	$purchAmt = $_GET['purchAmt'];
	$txType = '0';
	$Option = '1';
	$OrderDetail = 'test';
	$AutoCap = '0';
	$customize = '0';
	$cid = $_GET['cid'];
	$Key = '5ZceaET0VMiI7MVdqNtwA00G';
	$AuthResURL = $_SC['siteurl']."index.php?app=checkout&do=cardsendok&cid=$cid";
	$debug = '0';
	
	$OrderDesc = 'test';
	$Pid = 'a123456789';
	$Brithday = '02261988';
	$ProdCode = '00';
	
	include_once('auth_mpi/auth_mpi_mac.php');
	
	$MACString = auth_in_mac($MerchantID,$TerminalID,$cid,$purchAmt,$txType,$Option,$Key,$MerchantName,$AuthResURL,$OrderDetail,$AutoCap,$customize,$debug);
	
	$URLEnc = get_auth_urlenc($MerchantID,$TerminalID,$cid,$purchAmt,$txType,$Option,$Key,$MerchantName,$AuthResURL,$OrderDetail,$AutoCap,$customize,$MACString,$debug);
	


	