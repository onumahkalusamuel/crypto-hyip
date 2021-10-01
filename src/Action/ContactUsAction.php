<?php

namespace App\Action;

use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ContactUsAction
{
    private $sendMail;

    public function __construct(SendMail $sendMail)
    {
        $this->sendMail = $sendMail;
    }
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $data = (array)$request->getParsedBody();

        // send a copy to admin
        try {
            $send = $this->sendMail->sendContactMail($data);
        } catch(\Exception $e) {
            $send['message'] = "Unable to send mail at the moment";
        }

        if($send['success']) $send['message'] = "Message sent successfully.";
        else $send['message'] = "Unable to send message at the moment. Please try again later.";

        $response->getBody()->write(json_encode($send));

        return $response;
    }
}
