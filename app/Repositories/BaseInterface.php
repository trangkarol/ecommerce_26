<?php

namespace App\Repositories;

interface BaseInterface
{
    public function all();

    public function paginate($limit = null, $columns = ['*']);

    public function find($id, $columns = ['*']);

    public function where($conditions, $operator = null, $value = null);

    public function whereIn($column, $value);

    public function orWhere($column, $operator = null, $value = null);

    public function create($input);

    public function update($id, $input);

    public function delete($id);

    public function uploadImages($image = null, $fileImages = null, $namedefault = null);

    public function importFile($file = null);
}
