<?php

namespace App\Base\Domain;

class Service
{

    protected $repository;

    // urgent need for transaction management
    public function beginTransaction() {
        $this->repository->beginTransaction();
    }
    public function commit() {
        $this->repository->commit();
    }
    
    public function rollback() {
        $this->repository->rollback();
    }

    public function readSingle(array $args = []): object
    {
        return $this->repository->readSingle($args);
    }

    public function readPaging(array $args = []): array
    {

        if (!empty($args['filters']['rpp'])) {
            $args['filters']['page'] = $args['filters']['page'] ?? 1;
            $args['filters']['offset'] = ($args['filters']['page'] - 1) * $args['filters']['rpp'];
        } else {
            $args['filters']['rpp'] = 0;
            $args['filters']['page'] = 1;
            $args['filters']['offset'] = 0;
        }

        return (array) $this->repository->readPaging($args);
    }

    public function totalRows(array $args = [])
    {
        return (int) $this->repository->totalRows($args);
    }

    public function readAll(array $args = []): array
    {
        return (array) $this->repository->readAll($args);
    }

    public function find(array $args = []): object
    {
        return (object) $this->repository->find($args);
    }

    public function create(array $args): string
    {
        if (!empty($args['data']['title'])) $args['data']['slug'] = $this->slug($args['data']['title']);
        return (string) $this->repository->create($args);
    }

    public function update(array $args = []): bool
    {
        if (!empty($args['data']['title'])) $args['data']['slug'] = $this->slug($args['data']['title']);
        return (bool) $this->repository->update($args);
    }

    public function delete(array $args = []): bool
    {
        return (bool) $this->repository->delete($args);
    }

    public function slug($text): string
    {
        $slug = strtolower($text);
        $slug = trim(preg_replace('/[^A-Za-z0-9]+/', '-', $slug), '-');
        return $slug;
    }
}
