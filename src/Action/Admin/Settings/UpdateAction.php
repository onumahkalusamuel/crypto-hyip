<?php

namespace App\Action\Settings;

use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UpdateAction
{
    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $auth = $request->getAttribute('token')['data'];
        $data = (array)$request->getParsedBody();
        if ($auth->userType != "admin") {
            $response->getBody()->write((string)json_encode([$auth]));
            \http_response_code(403);
            return $response;
        }

        if (empty($data['setting'])) {
            \http_response_code(400);
            return $response;
        }

        // Invoke the Domain with inputs and retain the result
        $this->settings->update($data['setting'], $data['value'] ?? "");

        // Build the HTTP response
        $response->getBody()->write((string)json_encode(['success' => true, 'message' => 'Update successful']));

        return $response;
    }
}
