<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Rating\RatingInterface;
use App\Repositories\Product\ProductInterface;

class RatingController extends Controller
{
    protected $ratingRepository;
    protected $categoryRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        RatingInterface $ratingRepository,
        ProductInterface $productRepository
    ) {
        $this->ratingRepository = $ratingRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRating(Request $request)
    {
        if ($request->ajax()) {
            try {
                //
            } catch (\Exception $e) {
                return response()->json('result', true);
            }
        }

        $ratings = Library::getRatings();
        $products = $this->productRepository->getProduct();
        $sortPrice = Library::getSortPrice();

        return view('member.product.products', compact('products', 'ratings', 'sortPrice'));
    }
}
