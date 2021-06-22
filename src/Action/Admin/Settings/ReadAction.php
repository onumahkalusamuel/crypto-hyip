<?php

namespace App\Action\Settings;

use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ReadAction
{
    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        // Invoke the Domain with inputs and retain the result
        $settings = $this->settings->read($args['setting'] ?? '')['settings'];

        $return = [];
        foreach ($settings as $set) $return[$set->setting] = $set->value;


        // Build the HTTP response
        $response->getBody()->write((string)json_encode($return));

        return $response;
    }
}
