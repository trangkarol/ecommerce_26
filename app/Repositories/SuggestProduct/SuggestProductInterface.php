<?php

namespace App\Repositories\SuggestProduct;

interface SuggestProductInterface
{
    public function create($input);

    public function delete($id);

    public function getSuggestProduct();

    public function getSuggestProductUsers();

    public function updateSuggestProduct($input, $file, $id);

    public function findSuggestProduct($suggestId);

    public function changeAccept($suggestId, $status);
}
