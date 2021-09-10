<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Psr\Container\ContainerInterface;

class SendMail
{
    public $mail;
    private $settings;
    private $siteName;
    private $siteUrl;
    private  $contactPhone;
    private  $contactName;
    private  $contactEmail;
    private  $contactAddress;
    private $emailBanner;

    public function __construct(ContainerInterface $container)
    {

        $this->settings = $container->get('settings');
        $display = $this->settings['display_settings']();
        $smtp = $this->settings['smtp'];

        $this->contactName = $smtp['name'];
        $this->siteName = $display['site_name'];
        $this->contactPhone = $display['contact_phone'];
        $this->contactAddress = $display['contact_address'];
        $this->contactEmail = $display['contact_email'];
        $this->siteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
        $this->emailBanner = $this->settings['assets_dir'] . '/email/email-banner.jpg';

        $mail = new PHPMailer(true);

        if (gethostname() == 'localhost') {
            $mail->isMail();
        } else {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Password = $smtp['password'];
            $mail->Username = $smtp['email'];
            $mail->Host = gethostname();
        }

        $mail->setFrom($smtp['email'], $smtp['name']);
        $mail->addReplyTo($smtp['email'], $this->smtp['name']);

        if (is_file($this->emailBanner)) {
            $mail->AddEmbeddedImage($this->emailBanner, 'banner');
        }

        // Content
        $mail->isHTML(true);

        $this->mail = $mail;
    }

    public function send(array $data)
    {

        $this->mail->clearAllRecipients();

        extract($data);

        try {
            $this->mail->addAddress($email, $name);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $message;
            $this->mail->send();
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $this->mail->ErrorInfo];
        }
    }

    public function sendContactMail(array $form)
    {

        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Contact Us: " . $form['subject'];
        $data['message'] =
            "<strong>Feedback Form:<br/>" .
            "<p><strong>Name:</strong> " . $form['name'] . "</p>" .
            "<p><strong>Email:</strong> " . $form['email'] . "</p>" .
            "<p><strong>Suject:</strong> " . $form['subject'] . "</p>" .
            "<p><strong>Message:</strong> " . $form['message'] . "</p>";

        return $this->send($data);
    }

    public function sendPasswordResetEmail($email, $name, $token)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Password Reset Email - " . $this->siteName;
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br/>" .
            "<h2>PASSWORD RESET</h2><br/>" .
            "Hello $name, <br/><br/>
            We received a password reset request from you.<br/> <br/>
        If you are the one, please kindly click on the link below to reset your password.<br/><br/>
        <strong><a href='{$this->siteUrl}/reset/{$token}/{$email}'>RESET PASSWORD NOW</a></strong><br/>
        <br>
        If you are unable to click on the link, please kindly copy the following to your browser.<br/><br/>
        <h4>{$this->siteUrl}/reset/{$token}/{$email}</h4>
        <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a><br>
            </div>
        ";

        return $this->send($data);
    }

    public function sendRegistrationEmail($email, $name, $username)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Registration Info - {$this->siteName}";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br/>
        <h2>REGISTRATION SUCCESSFUL</h2><br/>
        Hello <strong>$name</strong>,<br/><br/>
        Thank you for registration on our site.<br/>
        <strong>Your login information:</strong><br/><br/>
        <strong>Login:</strong> $username <br/>
        <strong>Password:</strong> <em>the password you chose </em><br/><br/>
        You can login here: <a href='{$this->siteUrl}/'>{$this->siteName}</a><br/><br/>
        Contact us immediately if you did not authorize this registration.<br/><br/>
        
        <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a><br>
            </div>";

        $this->send($data);

        return $this->sendRegistrationEmailToAdmin($name, $username);
    }

    public function sendRegistrationEmailToAdmin($name, $username)
    {
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "New User Registration - {$this->siteName}";
        $data['message'] = "
        A new user just registered on your website. <br/>
        Name: $name<br/>
        Username: $username <br/>";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendWithdrawalRequestEmail($email, $cryptoCurrency, $amount, $name, $username)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Withdrawal Request - {$this->siteName}";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/></br>
        <h2>WITHDRAWAL REQUEST</h2><br/>
            Hello $name,<br/><br/>
            You have requested to withdraw $$amount worth of " . strtoupper($cryptoCurrency) . ". Please be patient while it is being processed.<br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a>
            </div>";

        $this->send($data);

        return $this->sendWithdrawalRequestEmailToAdmin($cryptoCurrency, $amount, $username);
    }

    private function sendWithdrawalRequestEmailToAdmin($cryptoCurency, $amount, $username)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Withdrawal Request has been sent";
        $data['message'] = "User $username requested to withdraw $$amount worth of " . strtoupper($cryptoCurency) . " from IP $IP.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendWithdrawalSentEmail($email, $cryptoCurrency, $amount, $name, $username, $account, $batch)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Withdrawal Sent - {$this->siteName}";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br/>
        <h2>WITHDRAWAL SUCCESSFUL</h2><br/>
            Hello $name,<br/><br/>
            Your withdrawal has been sent to your account successfully.<br/><br/>
            Amount: $$amount<br/><br/>
            Currency: " . strtoupper($cryptoCurrency) . "<br/><br/>
            Account: $account<br/><br/>
            Transaction batch: $batch.
            <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a>
            </div>";

        $this->send($data);

        return $this->sendWithdrawalSentEmailToAdmin($username, $amount, $account, $batch, $cryptoCurrency);
    }

    private function sendWithdrawalSentEmailToAdmin($username, $amount, $account, $batch, $cryptoCurrency)
    {
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Withdrawal has been sent";
        $data['message'] = "User $username received $$amount ($cryptoCurrency) to address $account. Batch is $batch.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendWithdrawalDeclinedEmail($email, $name, $username, $message)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Withdrawal Declined - {$this->siteName}";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/> <br/><br/>
        <h2> WITHDRAWAL DECLINED</h2><br/>
            Hello $name,<br/><br/>
            Your request for withdrawal has been declined with the following reasons:<br /><br/>
            <em> $message</em>.<br/><br/>
            Thank you.
            <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a>
            </div>";

        $this->send($data);

        return $this->sendWithdrawalDeclinedEmailToAdmin($username, $message);
    }

    private function sendWithdrawalDeclinedEmailToAdmin($username, $message)
    {
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Withdrawal Declined for user";
        $data['message'] = "Withdrawal declined for $username.<br><em>$message</em>.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendDirectReferralSignupEmail($email, $name, $ref_name, $ref_username, $ref_email)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Direct Referral Signup - {$this->siteName}";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/>
        <h2>REFERRAL SIGNUP</h2><br/>
            Hello $name,<br/><br/>
            You have a new direct referral signup on {$this->siteName}<br />
            <strong>Username:</strong> $ref_username <br/>
            <strong>Name:</strong> $ref_name <br/>
            <strong>E-mail:</strong> $ref_email<br/><br/>
            Thank you. <br/><br/>
     
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a>
            </div>
            ";

        return $this->send($data);
    }

    public function sendDirectReferralCommissionEmail($email, $name, $amount, $ref_username, $username, $cryptoCurrency)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Direct Referral Commission - {$this->siteName}";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/>
     	<h2>REFERRAL COMMISSION</h2>
            Hello $name,<br/><br/>
            You have received a referral commission of \${$amount} ($cryptoCurrency) from {$ref_username}'s deposit. <br/>
            Thank you. <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a>
            </div>
            ";

        $this->send($data);

        return $this->sendDirectReferralCommissionEmailToAdmin($username, $amount, $ref_username, $cryptoCurrency);
    }

    private function sendDirectReferralCommissionEmailToAdmin($username, $amount, $ref_username, $cryptoCurrency)
    {
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Direct Referral Commission sent to user";
        $data['message'] =
            "$username received a referral commission of \${$amount} ($cryptoCurrency) from {$ref_username}'s deposit.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendDepositReleaseEmail($email, $name, $username, $amount)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Deposit Released - {$this->siteName}";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/>
        <h2>DEPOSIT RELEASED</h2>" .
            "Hello $name,<br/><br/>
            Your investment deposit of \${$amount} has been released into your available balance. You can now place a withdrawal request on it.<br/>
            Thank you. 
            <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a>
            </div>
            ";

        $this->send($data);

        return $this->sendDepositReleaseEmailToAdmin($amount, $username);
    }

    private function sendDepositReleaseEmailToAdmin($amount, $username)
    {
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Deposit Released to user";
        $data['message'] = "Investment deposit of \${$amount} has been released to {$username} and is now available for withdrawal.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendAdminLoggedIn()
    {

        $IP = $_SERVER['REMOTE_ADDR'];
        $time = date("Y-M-d, H i s", time());

        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Admin Logged In";
        $data['message'] =
            "Admin entered admin area. <br/>
            IP: {$IP} <br/>
            TIME: {$time}";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendBonusConfirmToken($bonusUrl, $fullName, $userName, $amount, $cryptoCurrency)
    {

        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Bonus Confirm Link for {$userName}";
        $data['message'] =
            "You have requested to add bonus of $$amount ($cryptoCurrency) to $fullName ($userName). <br/>
            Click the link below or copy to a new tab to confirm this operation. Token expires in 10 minutes.<br/><br/>
            <a href='$bonusUrl'>$bonusUrl</a> ";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendBonusAddedMail($email, $name, $amount, $cryptoCurrency)
    {

        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Bonus Added to Account";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br>
        <h2> BONUS RECEIVED </h2><br/>
            Hello $name,<br/><br/>
            Congratulations, you just received a bonus of $$amount ($cryptoCurrency).<br/><br/>
            Thank you.
            <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a>
            <br/>
            </div>";

        return $this->send($data);
    }

    public function sendBonusAddedMailToAdmin($userName, $name, $amount, $cryptoCurrency)
    {

        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Bonus added to user";
        $data['message'] =
            "A bonus of $$amount ($cryptoCurrency) has been added successfully to $name ($userName).";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendPenaltyConfirmToken($penaltyUrl, $fullName, $userName, $amount, $cryptoCurrency)
    {

        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Penalty Confirm Token for {$userName}";
        $data['message'] =
            "You have requested to subtract a penalty of $$amount ($cryptoCurrency) from $fullName ($userName). <br/>
            Click the link below or copy to a new tab to confirm this operation. Token expires in 10 minutes.<br/><br/>
            <a href='$penaltyUrl'>$penaltyUrl</a> ";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendPenaltySubtractedMail($email, $name, $amount, $cryptoCurrency, $reason)
    {

        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Penalty subtracted from account";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br>
        <h2>PENALTY</h2><br>
            Hello $name,<br/><br/>
            Sorry, a penalty of $$amount ($cryptoCurrency) has been subtracted from your account.<br/>
            Reason: $reason.<br/><br/>
            Thank you. <br/><br/>

            If you face any challenges, please contact us at <a href='mailto:{$this->contactEmail}'>{$this->contactEmail}</a><br/><br/>
            &copy; " . date('Y', time()) . " {$this->siteName}
            <a href='{$this->siteUrl}'>{$this->siteUrl}</a>
            <br/>
            </div>
            ";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendPenaltySubtractedMailToAdmin($userName, $name, $amount, $cryptoCurrency, $reason)
    {

        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Penalty subtracted from user";
        $data['message'] =
            "A penalty of $$amount ($cryptoCurrency) has been subtracted successfully from $name ($userName).<br/>
            Reason: $reason";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendSettingsChangedMail()
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Site Settings Changed";
        $data['message'] = "Some settings have been modified in the admin section from IP: $IP.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }
    public function sendAdminPasswordChangeOTP($otp)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Admin Password Change OTP";
        $data['message'] = "You requested to change the admin password from IP: $IP. Enter the following OTP where required. <br/><br/>
        <h1>$otp</h1><br/>
        <strong>Note:</strong> OTP expires in about 5 minutes.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendAdminPasswordChangedMail()
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Admin Password Changed successfully";
        $data['message'] = "Admin password has been changed from IP: $IP.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendPendingDepositMailToAdmin($username, $amount)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "New Pending Deposit";
        $data['message'] = "You have a pending deposit amount of $$amount from {$username}.";

        $this->mail->clearAttachments();
        
        return $this->send($data);
    }
}
