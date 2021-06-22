<?php

namespace App\Action;

use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ContactUsAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $data = (array)$request->getParsedBody();
        $mail = new SendMail();

        // send a copy to admin
        $send = $mail->sendContactMail($data);

        if (!$send['success']) http_response_code(400);

        $response->getBody()->write(json_encode($send));

        return $response;
    }
}
