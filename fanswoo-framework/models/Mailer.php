<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Mailer {
 
    var $mail;
 
    public function __construct()
    {
        require_once('phpmailer/class.phpmailer.php');

        $SettingList = new SettingList();
        $SettingList->construct_db([
            'db_where_Arr' => [
                'modelname' => 'smtp'
            ]
        ]);
        $settinglist_Arr = $SettingList->get_array();
 
        // the true param means it will throw exceptions on errors, which we need to catch
        $this->mail = new PHPMailer(true);
 
        $this->mail->IsSMTP(); // telling the class to use SMTP
 
        $this->mail->CharSet = "utf-8";                  // 一定要設定 CharSet 才能正確處理中文
        $this->mail->SMTPDebug  = 0;                     // enables SMTP debug information
        $this->mail->SMTPAuth   = true;                  // enable SMTP authentication
        $this->mail->IsHTML(true);

        if($settinglist_Arr['smtp_ssl_checkbox'])
        {
            $this->mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $this->mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        }
        $this->mail->Host       = $settinglist_Arr['smtp_host'];      // sets GMAIL as the SMTP server
        $this->mail->Username   = $settinglist_Arr['smtp_account'];// GMAIL username
        $this->mail->Password   = $settinglist_Arr['smtp_password'];       // GMAIL password
        $this->mail->AddReplyTo($settinglist_Arr['smtp_email'], $settinglist_Arr['smtp_username']);
        $this->mail->SetFrom($settinglist_Arr['smtp_email'], $settinglist_Arr['smtp_username']);
    }
 
    public function sendmail($to, $to_name, $subject, $body)
    {
        try{
            $this->mail->AddAddress($to, $to_name);
 
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
 
            $this->mail->Send();
                return TRUE;
 
        } catch (phpmailerException $e) {
            return $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return $e->getMessage(); //Boring error messages from anything else!
        }
    }
}
 
/* End of file mailer.php */