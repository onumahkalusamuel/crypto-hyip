<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Helpers\CryptoHelper;

class ProfileAction
{

    protected $user;
    protected $cryptoHelper;

    public function __construct(User $user, CryptoHelper $cryptoHelper)
    {
        $this->user = $user;
        $this->cryptoHelper = $cryptoHelper;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $message = false;
        $success = false;

        $data = (array) $request->getParsedBody();
        $ID = $request->getAttribute('token')['data']->ID;
        $update = [];

        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $oldPassword = $data['oldPassword'];

        // validate email
        if (empty($email)) {
            $message = "Invalid email address";
        }

        // fetch user info
        $user = $this->user->readSingle(['ID' => $ID]);

        if (empty($message) && empty($user->ID)) {
            $message = "Your account seems to need attention. Contact admin.";
        }

        if (empty($message) && !password_verify($oldPassword, $user->password)) {
            $message = "Invalid Old Password";
        }

        // check for wallet addresses and validate
        foreach ($GLOBALS['activeCurrencies'] as $currency) {
            if (empty($message)) {
                if (!empty($data[$currency . 'Address'])) {
                    if (!$this->cryptoHelper->validate($currency, $data[$currency . 'Address'])) {
                        $message = "Invalid " . strtoupper($currency) . " Address entered.";
                    } else $update[$currency . 'Address'] = $data[$currency . 'Address'];
                } else $update[$currency . 'Address'] = "";
            }
        }

        // PM
        if (empty($message)) {
            if (!empty($data['pmAddress'])) {
                if (substr(strtoupper($data['pmAddress']), 0, 1) !== "U") {
                    $message = "Invalid PM Address entered.";
                } else $update['pmAddress'] = $data['pmAddress'];
            } else $update['pmAddress'] = "";
        }

        if (empty($message) && !empty($data['password']) && $data['password'] !== $data['confirmPassword']) {
            $message = "New password and Confirm Password do not match";
        }

        if (empty($message) && !empty($data['password'])) {
            $update['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        // email and name
        $update['email'] = $data['email'];
        $update['fullName'] = $data['fullName'];

        if (empty($message)) {
            $up = $this->user->update(['ID' => $ID, 'data' => $update]);
        }

        if (empty($message) && !empty($up)) {
            $success = true;
            $message = 'Profile updated successfully!';
        } else {
            $success = false;
            $message = !empty($message) ? $message : 'Unable to update details at the moment!';
        }

        $response->getBody()->write(json_encode(compact('success', 'message')));

        return $response;
    }
}
