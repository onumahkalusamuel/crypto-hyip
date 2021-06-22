<?php

namespace App\Base\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Read
 */
class Read
{

    /**
     * handle
     *
     * @var mixed
     */
    protected $handle;
    /**
     * select
     *
     * @var array
     */
    protected $select = [];
    /**
     * intProperties
     *
     * @var array
     */
    protected $intProperties = [];
    /**
     * floatProperties
     *
     * @var array
     */
    protected $floatProperties = [];
    /**
     * boolProperties
     *
     * @var array
     */
    protected $boolProperties = [];

    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $id = $args['id'];
        $school_id = $request->getHeader('school-id')[0];
        $select = $this->select;

        $read = $this->handle->readSingle(compact('id', 'select', 'school_id'));

        if (!empty((array)$read)) {

            //intProperties
            foreach ($this->intProperties as $prop) {
                if (isset($read->$prop)) $read->$prop = (int) $read->$prop;
            }

            //floatProperties
            foreach ($this->floatProperties as $prop) {
                if (isset($read->$prop)) $read->$prop = (float) $read->$prop;
            }

            // boolProperties
            foreach ($this->boolProperties as $prop) {
                if (isset($read->$prop)) $read->$prop = (bool) $read->$prop;
            }
        }

        $response->getBody()->write(json_encode($read));
        return $response;
    }
}
