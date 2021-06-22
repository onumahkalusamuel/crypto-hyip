<?php

namespace App\Base\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * ReadPaging
 */
class ReadPaging
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
     * defaultSortBy
     *
     * @var string
     */
    protected $defaultSortBy = 'id';

    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $school_id = $request->getAttribute('school_id');
        $admin_id = $request->getAttribute('admin_id');

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

        // paging
        $filters['page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        $filters['rpp'] = isset($_GET['rpp']) ? (int) $_GET['rpp'] : 50;

        // sorting
        $filters['sort_by'] = !empty($_GET['sort_by']) ? $_GET['sort_by'] : $this->defaultSortBy;
        $filters['desc'] = $_GET['desc'] == 'true';

        //add school id in case
        $school_id = $request->getHeader('school-id')[0];

        $select = $this->select;
        //then query
        $read = $this->handle->readPaging(compact('params', 'filters', 'select', 'school_id'));

        // return
        $response->getBody()->write(json_encode($read));

        return $response;
    }
}
