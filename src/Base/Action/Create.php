<?php

namespace App\Base\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Create
 */
class Create
{

    /**
     * handle
     *
     * @var mixed
     */
    protected $handle;
    /**
     * mustHaveProperties
     *
     * @var array
     */
    protected $mustHaveProperties = [];

    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // get the main	data
        $data = (array) $request->getParsedBody();

        // append get parameters too but dont overwrite post
        foreach ($_GET as $key => $val) {
            if (!isset($data[$key])) $data[$key] = $val;
        }

        // check compulsory fields
        foreach ($this->mustHaveProperties as $mhp) {
            if (empty($data[$mhp])) {
                $response->getBody()->write(json_encode(['success' => false, 'message' => 'One or more required fields are missing']));
                return $response->withStatus(400);
            }
        }

        // get the files and school id
        // mostly gonna be optional
        $files = (array) $request->getUploadedFiles();
        $school_id = $request->getHeader('school-id')[0];

        // then create
        $create = $this->handle->create(compact('data', 'files', 'school_id'));

        // check if response was an int
        if (gettype($create) === 'integer' && empty($create)) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => "Unable to create record at the moment"]));
            return $response->withStatus(400);
        }

        // check if response was an array
        if (gettype($create) === 'array' && empty($create['success'])) {
            $message = $create['message'] ? $create['message'] : "Unable to create record at the moment";
            $response->getBody()->write(json_encode(['success' => false, 'message' => $message]));
            return $response->withStatus(400);
        }

        // then return
        $message = !empty($create['message']) ? $create['message'] : 'Record(s) created successfully';
        $response->getBody()->write(json_encode(['success' => true, 'message' => $message]));
        return $response;
    }
}
