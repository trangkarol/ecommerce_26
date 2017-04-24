<?php

namespace App\Repositories\Product;

interface ProductInterface
{
    public function createProduct($request);

    public function saveRequestProduct($products);

    public function getProduct();

    public function findProduct($productId);

    public function relatedProduct($categoryId, $productId);

    public function hotProduct();

    public function newProduct();

    public function listProduct($productIds);

    public function saveFile($products);

    public function getProductCategory($categoryId);

    public function searchProduct($input);
}
