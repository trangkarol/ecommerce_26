<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Rating\RatingInterface;
use App\Repositories\Product\ProductInterface;
use DB;
use Auth;

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
            DB::beginTransaction();
            try {
                $input = $request->only('point');
                $input['user_id'] = Auth::user()->id;
                $input['product_id'] = $request->productId;
                $rating = $this->ratingRepository->addRating($input, $request->productId);

                if ($rating) {
                    $avgRating = [
                        'avg_rating' => $rating,
                    ];
                    // dd($rating);
                    $product = $this->productRepository->changeRating($avgRating, $request->productId);

                    if ($product) {
                        DB::commit();
                        return response()->json(['result' => true, 'avgRating' => $avgRating]);
                    }
                }

                DB::rollback();
            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
            }

            return response()->json('result', true);
        }
    }
}
