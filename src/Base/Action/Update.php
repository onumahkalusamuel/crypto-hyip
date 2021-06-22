<?php

namespace App\Base\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Update
 */
class Update
{

    /**
     * handle
     *
     * @var mixed
     */
    protected $handle;

    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {

        $school_id = $request->getHeader('school-id')[0];

        $data = $request->getParsedBody();
        $id = $args['id'];

        $update = $this->handle->update(compact('id', 'data', 'school_id'));

        if (empty($update)) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Unable to update record at the moment']));
            return $response->withStatus(400);
        }

        $response->getBody()->write(json_encode(['success' => true, 'message' => 'Update successful']));
        return $response;
    }
}
