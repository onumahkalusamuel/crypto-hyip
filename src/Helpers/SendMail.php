<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Psr\Container\ContainerInterface;
use App\Domain\EmailTemplates\Service\EmailTemplates;
use App\Domain\Settings\Service\Settings;

class SendMail
{
    public $mail;
    private $settings;
    private $siteName;
    private $siteUrl;
    private $contactName;
    private $contactEmail;
    private $emailBanner;
    private $emailTemplates;
    private $siteSettings;

    public function __construct(
        ContainerInterface $container,
        EmailTemplates $emailTemplates,
        Settings $siteSettings
    ) {

        $this->siteSettings = $siteSettings;
        $this->emailTemplates = $emailTemplates;
        $this->settings = $container->get('settings');
        $display = $this->settings['display_settings']();
        $smtp = $this->settings['smtp'];

        $this->contactName = $smtp['name'];
        $this->contactEmail = $smtp['email'];
        $this->siteName = $display['name'];
        $this->siteUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];

        $mail = new PHPMailer(true);

        if (gethostname() == 'localhost') {
            $mail->isMail();
        } else {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Password = $smtp['password'];
            $mail->Username = $smtp['email'];
            $mail->Host = $smtp['host'];
        }

        $mail->setFrom($smtp['email'], $smtp['name']);
        $mail->addReplyTo($smtp['email'], $this->smtp['name']);

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

    private function sendTemplatedMail($templateId, $email, $name, $replacements = array())
    {
        $template = $this->emailTemplates->readSingle(['ID' => $templateId]);

        if (empty($template->ID)) return false;

        $data['email'] = $email;
        $data['name'] = $name;

        $message = "";

        if ($template->useGeneralHeader) $message .= $this->siteSettings->generalEmailHeader;
        $message .= $template->content;
        if ($template->useGeneralFooter) $message .= $this->siteSettings->generalEmailFooter;

        $search = ['#site_url#', '#site_name#', '#site_email#', '#this_year#'];
        $replace = [$this->siteUrl, $this->siteName, $this->contactEmail, date('Y')];

        foreach ($replacements as $key => $value) {
            $search[] = $key;
            $replace[] = $value;
        }

        $message = str_replace($search, $replace, $message);

        $data['subject'] = $template->subject . " - " . $this->siteName;
        $data['message'] = $message;

        return $this->send($data);
    }

    public function sendPasswordResetEmail($email, $name, $resetLink)
    {
        return $this->sendTemplatedMail(
            2,
            $email,
            $name,
            ['#name#' => $name, '#email#' => $email, '#reset_link#' => $resetLink]
        );
    }

    public function sendRegistrationEmail($email, $name, $username)
    {
        $this->sendTemplatedMail(
            1,
            $email,
            $name,
            ['#name#' => $name, '#email#' => $email, '#username#' => $username]
        );

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
        $this->sendTemplatedMail(
            3,
            $email,
            $name,
            [
                '#name#' => $name,
                '#email#' => $email,
                '#crypto_currency#' => $cryptoCurrency,
                '#amount#' => $amount,
                '#username#' => $username
            ]
        );

        return $this->sendWithdrawalRequestEmailToAdmin($cryptoCurrency, $amount, $username);
    }

    private function sendWithdrawalRequestEmailToAdmin($cryptoCurrency, $amount, $username)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $data['email'] = $this->contactEmail;
        $data['name'] = $this->contactName;
        $data['subject'] = "Withdrawal Request has been sent";
        $data['message'] = "User $username requested to withdraw $$amount worth of " . strtoupper($cryptoCurrency) . " from IP $IP.";

        $this->mail->clearAttachments();

        return $this->send($data);
    }

    public function sendWithdrawalSentEmail($email, $cryptoCurrency, $amount, $name, $username, $account, $batch)
    {
        $this->sendTemplatedMail(
            4,
            $email,
            $name,
            [
                '#name#' => $name,
                '#email#' => $email,
                '#username#' => $username,
                '#batch#' => $batch,
                '#account#' => $account,
                '#crypto_currency#' => $cryptoCurrency,
                '#amount#' => $amount,
                '#transaction_id#' => "#TNX" . strtoupper(substr($batch, 10, 8))
            ]
        );

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

        $this->sendTemplatedMail(
            5,
            $email,
            $name,
            [
                '#name#' => $name,
                '#email#' => $email,
                '#username#' => $username,
                '#message#' => $message
            ]
        );

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

        return $this->sendTemplatedMail(
            6,
            $email,
            $name,
            [
                '#name#' => $name,
                '#email#' => $email,
                '#ref_name#' => $ref_name,
                '#ref_username#' => $ref_username,
                '#ref_email#' => $ref_email
            ]
        );
    }

    public function sendDirectReferralCommissionEmail($email, $name, $amount, $ref_username, $username, $cryptoCurrency)
    {

        $this->sendTemplatedMail(
            7,
            $email,
            $name,
            [
                '#name#' => $name,
                '#email#' => $email,
                '#username#' => $username,
                '#ref_username#' => $ref_username,
                '#crypto_currency#' => $cryptoCurrency,
                '#amount#' => $amount
            ]
        );

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

        $this->sendTemplatedMail(
            8,
            $email,
            $name,
            [
                '#name#' => $name,
                '#email#' => $email,
                '#username#' => $username,
                '#amount#' => $amount
            ]
        );

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
        $time = date("Y-M-d, H i s");

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
        return $this->sendTemplatedMail(
            9,
            $email,
            $name,
            [
                '#name#' => $name,
                '#email#' => $email,
                '#crypto_currency#' => $cryptoCurrency,
                '#amount#' => $amount
            ]
        );
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

        return $this->sendTemplatedMail(
            10,
            $email,
            $name,
            [
                '#name#' => $name,
                '#email#' => $email,
                '#crypto_currency#' => $cryptoCurrency,
                '#amount#' => $amount,
                '#reason#' => $reason
            ]
        );
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
