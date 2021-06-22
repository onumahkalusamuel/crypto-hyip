<?php

namespace App\Base\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Delete
 */
class Delete
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

        $ret = array();
        $id = $args['id'];

        //add school id in case
        $school_id = $request->getHeader('school-id')[0];

        $delete = $this->handle->delete(compact('id', 'school_id'));

        if ($delete) {
            $response->getBody()->write(json_encode(['success' => true, 'message' => 'Deleted successfully.']));
            return $response;
        } else {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Unable to delete record at the moment. Please try again later.']));
            return $response->withStatus(400);
        }
    }
}
