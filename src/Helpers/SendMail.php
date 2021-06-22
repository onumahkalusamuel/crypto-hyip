<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMail
{
    public $mail;
    private $supportEmail = "admin@bexfinance.ltd";
    private $supportName = "BexFinance Support";

    public function __construct()
    {
        $mail = new PHPMailer(true);

        $mail->isMail();

        $mail->setFrom($this->supportEmail, $this->supportName);
        $mail->addReplyTo($this->supportEmail, $this->supportName);
        $mail->AddEmbeddedImage(dirname(__FILE__) . '/bexfinance-banner.jpg', 'banner');
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

    public function sendContactMail(array $data)
    {

        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Contact Us: " . $data['subject'];
        $data['message'] =
            "<strong>Feedback Form:<br/>" .
            "<p><strong>Name:</strong> " . $data['name'] . "</p>" .
            "<p><strong>Email:</strong> " . $data['email'] . "</p>" .
            "<p><strong>Suject:</strong> " . $data['subject'] . "</p>" .
            "<p><strong>Message:</strong> " . $data['message'] . "</p>";

        return $this->send($data);
    }

    public function sendPasswordResetEmail($email, $name, $token)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Password Reset Email - BexFinance LTD";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br/>" .
              "<h2>PASSWORD RESET</h2><br/>" . 
            "Hello $name, <br/><br/>
            We received a password reset request from you.<br/> <br/>
        If you are the one, please kindly click on the link below to reset your password.<br/><br/>
        <strong><a href='https://bexfinance.ltd/reset/{$token}'>RESET PASSWORD NOW</a></strong><br/>
        <br>
        If you are unable to click on the link, please kindly copy the following to your browser.<br/><br/>
        <h4>https://bexfinance.ltd/reset/{$token}</h4>
        <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time()) ." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a><br>
            </div>
        ";

        return $this->send($data);
    }

    public function sendRegistrationEmail($email, $name, $username)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Registration Info - BexFinance LTD";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br/>
        <h2>REGISTRATION SUCCESSFUL</h2><br/>
        Hello <strong>$name</strong>,<br/><br/>
        Thank you for registration on our site.<br/>
        <strong>Your login information:</strong><br/><br/>
        <strong>Login:</strong> $username <br/>
        <strong>Password:</strong> <em>the password you chose </em><br/><br/>
        You can login here: <a href='https://bexfinance.ltd/'>BEXFINANCE LTD</a><br/><br/>
        Contact us immediately if you did not authorize this registration.<br/><br/>
        
        <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time()) ." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a><br>
            </div>";

        return $this->send($data);
    }

    public function sendWithdrawalRequestEmail($email, $amount, $name, $username)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Withdrawal Request - BexFinance LTD";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/></br>
        <h2>WITHDRAWAL REQUEST</h2><br/>
            Hello $name,<br/><br/>
            You have requested to withdraw $$amount. Please be patient while it is being processed.<br/><br/>
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time())." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a>
            </div>";

        $this->send($data);

        return $this->sendWithdrawalRequestEmailToAdmin($amount, $username);
    }

    private function sendWithdrawalRequestEmailToAdmin($amount, $username)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Withdrawal Request has been sent";
        $data['message'] = "User $username requested to withdraw $$amount from IP $IP.";

        return $this->send($data);
    }

    public function sendWithdrawalSentEmail($email, $amount, $name, $username, $account, $batch)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Withdrawal Sent - BexFinance LTD";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br/>
        <h2>WITHDRAWAL SUCCESSFUL</h2><br/>
            Hello $name,<br/><br/>
            Your withdrawal has been sent to your account successfully.<br/><br/>
            Amount: $$amount<br/><br/>
            Account: $account<br/><br/>
            Transaction batch: $batch.
            <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time())." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a>
            </div>";

        $this->send($data);

        return $this->sendWithdrawalSentEmailToAdmin($username, $amount, $account, $batch);
    }

    private function sendWithdrawalSentEmailToAdmin($username, $amount, $account, $batch)
    {
        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Withdrawal has been sent";
        $data['message'] = "User $username received $$amount to Bitcoin account $account. Batch is $batch.";

        return $this->send($data);
    }

    public function sendWithdrawalDeclinedEmail($email, $name, $username, $message)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Withdrawal Declined - BexFinance LTD";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/> <br/><br/>
        <h2> WITHDRAWAL DECLINED</h2><br/>
            Hello $name,<br/><br/>
            Your request for withdrawal has been declined with the following reasons:<br /><br/>
            <em> $message</em>.<br/><br/>
            Thank you.
            <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time())." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a>
            </div>
";

        $this->send($data);

        return $this->sendWithdrawalDeclinedEmailToAdmin($username, $message);
    }

    private function sendWithdrawalDeclinedEmailToAdmin($username, $message)
    {
        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Withdrawal Declined for user";
        $data['message'] = "Withdrawal declined for $username.<br><em>$message</em>.";

        return $this->send($data);
    }

    public function sendDirectReferralSignupEmail($email, $name, $ref_name, $ref_username, $ref_email)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Direct Referral Signup - BexFinance LTD";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/>
        <h2>REFERRAL SIGNUP</h2><br/>
            Hello $name,<br/><br/>
            You have a new direct referral signup on bexfinance.ltd<br />
            <strong>Username:</strong> $ref_username <br/>
            <strong>Name:</strong> $ref_name <br/>
            <strong>E-mail:</strong> $ref_email<br/><br/>
            Thank you. <br/><br/>
     
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time())." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a>
            </div>
            ";

        return $this->send($data);
    }

    public function sendDirectReferralCommissionEmail($email, $name, $amount, $ref_username, $username)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Direct Referral Commission - BexFinance LTD";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/>
     	<h2>REFERRAL COMMISSION</h2>
            Hello $name,<br/><br/>
            You have received a referral commission of \${$amount} from {$ref_username}'s deposit. <br/>
            Thank you. <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time())." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a>
            </div>
            ";

        $this->send($data);

        return $this->sendDirectReferralCommissionEmailToAdmin($username, $amount, $ref_username);
    }

    private function sendDirectReferralCommissionEmailToAdmin($username, $amount, $ref_username)
    {
        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Direct Referral Commission sent to user";
        $data['message'] =
            "$username received a referral commission of \${$amount} from {$ref_username}'s deposit.";

        return $this->send($data);
    }

    public function sendDepositReleaseEmail($email, $name, $username, $amount)
    {
        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Deposit Released - BexFinance LTD";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/>
        <h2>DEPOSIT RELEASED</h2>" .
            "Hello $name,<br/><br/>
            Your investment deposit of \${$amount} has been released into your available balance. You can now place a withdrawal request on it.<br/>
            Thank you. 
            <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time())." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a>
            </div>
            ";

        $this->send($data);

        return $this->sendDepositReleaseEmailToAdmin($amount, $username);
    }

    private function sendDepositReleaseEmailToAdmin($amount, $username)
    {
        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Deposit Released to user";
        $data['message'] = "Investment deposit of \${$amount} has been released to {$username} and is now available for withdrawal.";

        return $this->send($data);
    }

    public function sendAdminLoggedIn()
    {

        $IP = $_SERVER['REMOTE_ADDR'];
        $time = date("Y-M-d, H i s", time());

        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Admin Logged In";
        $data['message'] =
            "Admin entered admin area. <br/>
            IP: {$IP} <br/>
            TIME: {$time}";

        return $this->send($data);
    }

    public function sendBonusConfirmToken($token, $fullName, $userName, $amount)
    {

        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Bonus confirm token";
        $data['message'] =
            "You have requested to add bonus of $$amount to $fullName ($userName). <br/>
            Your confirmation token is: {$token} ";

        return $this->send($data);
    }

    public function sendBonusAddedMail($email, $name, $amount, $bonusType)
    {

        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Bonus added to account";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br>
        <h2> BONUS RECEIVED </h2><br/>
            Hello $name,<br/><br/>
            Congratulations, you just received a bonus <strong>$bonusType</strong> of $$amount.<br/><br/>
            Thank you.
            <br/><br/>
            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time())." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a>
            <br/>
            </div>";

        return $this->send($data);
    }

    public function sendBonusAddedMailToAdmin($userName, $name, $amount, $bonusType)
    {

        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Bonus added to user";
        $data['message'] =
            "A bonus <strong>$bonusType.</strong> of $$amount has been added successfully to $name ($userName).";

        return $this->send($data);
    }

    public function sendPenaltyConfirmToken($token, $fullName, $userName, $amount)
    {

        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Penalty confirm token";
        $data['message'] =
            "You have requested to add bonus of $$amount to $fullName ($userName). <br/>
            Your confirmation token is: {$token}";

        return $this->send($data);
    }

    public function sendPenaltySubtractedMail($email, $name, $amount, $reason)
    {

        $data['email'] = $email;
        $data['name'] = $name;
        $data['subject'] = "Penalty subtracted from account";
        $data['message'] = "
        <div style='text-align:center;color:#6d6e70'>
        <img src='cid:banner'/><br/><br>
        <h2>PENALTY</h2><br>
            Hello $name,<br/><br/>
            Sorry, a penalty of $$amount has been subtracted from your account.<br/>
            $reason.<br/><br/>
            Thank you. <br/><br/>

            If you face any challenges, please contact us at <a href='mailto:admin@bexfinance.ltd'>admin@bexfinance.ltd</a><br/><br/>
            &copy; ".date('Y',time())." BexFinance Support
            <a href='https://bexfinance.ltd'>https://bexfinance.ltd</a>
            <br/>
            </div>
            ";

        return $this->send($data);
    }

    public function sendPenaltySubtractedMailToAdmin($userName, $name, $amount, $reason)
    {

        $data['email'] = $this->supportEmail;
        $data['name'] = $this->supportName;
        $data['subject'] = "Penalty subtracted from user";
        $data['message'] =
            "A penalty of $$amount has been subtracted successfully from $name ($userName).<br/>
            $reason";

        return $this->send($data);
    }
}
