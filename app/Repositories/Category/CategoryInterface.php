<?php

namespace App\Repositories\Category;

interface CategoryInterface
{
    public function getCategoryLibrary($type_category);

    public function getSubCategory($parent_id);

    public function getMenu();

    public function create($input);

    public function update($input, $id);

    public function delete($id);

    public function getProductHome();

    public function productCategory();

    public function createName($input);

    public function getCategoryId($category, $subCategory);

    public function getCategory();
}
