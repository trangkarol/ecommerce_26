<?php

namespace App\Repositories\Rating;

use App\Models\Rating;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;

class RatingRepository extends BaseRepository implements RatingInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Rating $rating)
    {
        $this->model = $rating;
    }

    /**
    * function getCategoryLibrary.
     *
     * @return imageName
     */
    public function addRating($input, $productId)
    {
        try {
            $rating = $this->model->where('product_id', $productId)->where('user_id', Auth::user()->id)->first();

            if ($rating) {
                $result = parent::update($input, $rating->id);
            } else {
                $result = $this->model->create($input);
            }

            if ($result) {
                return $this->model->where('product_id', $productId)->avg('point');
            }

            return false;
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }

    /**
     * function getOrders.
     *
     * @return imageName
     */
    public function getOrders()
    {
        return $this->model->with('orderDeatils.product', 'user')->paginate(config('setting.admin.paginate'));
    }

    /**
     * function getOrderUsers.
     *
     * @return imageName
     */
    public function getOrderUsers()
    {
        return $this->model->with('orderDeatils.product', 'user')->where('user_id', Auth::user()->id)->paginate(config('setting.admin.paginate'));
    }

    /**
     * function statisticProduct.
     *
     * @return imageName
     */
    public function statisticProduct()
    {
        return $this->model->with('products')->where('user_id', Auth::user()->id)->paginate(config('setting.admin.paginate'));
    }

    /**
     * function search Order.
     *
     * @return imageName
     */
    public function searchOrder($input)
    {
        try {
            $orders = $this->model;

            if (!empty($input['date_from'])) {
                $orders = $orders->where('created_at', '>=', $input['date_from'])->where('created_at', '<=', $input['date_to']);
            }

            if (!empty($input['date_to'])) {
                $orders = $orders->where('created_at', '<=', $input['date_to']);
            }

            if ($input['price_from'] != config('setting.search_default')) {
                $orders = $orders->where('price', '>=', $input['price_from']);
            }

            if ($input['price_to'] != config('setting.search_default')) {
                $orders = $orders->where('price', '<=', $input['price_to']);
            }

            if ($input['status'] == config('setting.search_default')) {
                $orders = $orders->where('status', $input['status']);
            }

            return $orders->paginate(12);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * function search Order.
     *
     * @return imageName
     */
    public function changeStatus($id, $status)
    {
        DB::beginTransaction();
        try {
            $input = [
                'status' => $status,
            ];

            $result = parent::update($input, $id);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
