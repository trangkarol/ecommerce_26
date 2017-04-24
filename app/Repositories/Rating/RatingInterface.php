<?php

namespace App\Repositories\Rating;

interface RatingInterface
{
    public function addRating($input, $productId);
}
