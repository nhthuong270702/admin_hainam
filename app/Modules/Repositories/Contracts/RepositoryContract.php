<?php

namespace App\Modules\Repositories\Contracts;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;

interface RepositoryContract
{
    /**
     * Return model instance.
     *
     * @return Model
     */
    public function getModel();

    /**
     * Find data by id
     *
     * @param mixed $id
     * @param array $columns
     *
     * @return Model|Collection
     */
    public function find($id, $columns = ['*']);

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param mixed $id
     *
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function findOrFail($id);

    /**
     * Find data by field and value
     *
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return Model|Collection
     */
    public function findBy($field, $value, $columns = ['*']);

    /**
     * Find data by field
     *
     * @param mixed $attribute
     * @param mixed $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findAllBy($attribute, $value, $columns = ['*']);

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*']);

    /**
     * Order results by.
     *
     * @param string $column
     * @param string $direction
     *
     * @return self
     */
    public function orderBy($column, $direction);

    /**
     * Filter results by given query params.
     *
     * @param string $queries
     *
     * @return self
     */
    public function search($queries);

    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']);

    /**
     * Get an array with the values of a given column.
     *
     * @param string $value
     * @param string $key
     *
     * @return array
     */
    public function pluck($value, $key = null);

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null  $limit
     * @param array $columns
     *
     * @return Paginator
     */
    public function paginate($limit = null, $columns = ['*']);

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null  $limit
     * @param array $columns
     *
     * @return Paginator
     */
    public function simplePaginate($limit = null, $columns = ['*']);

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     *
     * @return Model|bool
     */
    public function create(array $attributes);

    /**
     * Update an entity with the given attributes and persist it
     *
     * @param Model $entity
     * @param array $attributes
     *
     * @return bool
     */
    public function update(Model $entity, array $attributes);

    /**
     * Delete a entity in repository
     *
     * @param mixed $entity
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete($entity);

    /**
     * Get the raw SQL statements for the request
     *
     * @return string
     */
    public function toSql();

    /**
     * Add a message to the repository's error messages.
     *
     * @param string $message
     * @param string $key
     *
     * @return self
     */
    public function addError($message, string $key = 'message');

    /**
     * Get the repository's error messages.
     *
     * @return MessageBag
     */
    public function getErrors();

    /**
     * Get the repository's first error message.
     *
     * @param string $default
     *
     * @return string
     */
    public function getErrorMessage($default = '');
}
