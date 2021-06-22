<?php

namespace App\Base\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * ReadPaging
 */
class ReadAll
{

    /**
     * handle
     *
     * @var mixed
     */
    protected $handle;
    /**
     * whereQueryLike
     *
     * @var array
     */
    protected $whereQueryLike = [];
    /**
     * where
     *
     * @var array
     */
    protected $where = [];
    /**
     * select
     *
     * @var array
     */
    protected $select = [];

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
        
        $query = !empty($_GET['query']) ? $_GET['query'] : "";
        $filters = $params = [];

        // build search terms
        // whereLike
        if (!empty($query) && !empty($this->whereQueryLike)) {
            foreach ($this->whereQueryLike as $wql)
                $params['like'][$wql] = $query;
        }

        // where
        if (!empty($this->where)) {
            foreach ($this->where as $w)
                if (isset($_GET[$w])) $params['where'][$w] = $_GET[$w];
        }

        // sorting
        $filters['sory_by'] = !empty($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
        $filters['desc'] = $_GET['desc'] == 'true';

        $select = $this->select;

        $read = $this->handle->readAll(compact('params', 'filters', 'select', 'school_id'));

        // return
        $response->getBody()->write(json_encode($read));

        return $response;
    }
}
