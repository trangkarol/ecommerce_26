<?php

namespace App\Repositories\SuggestProduct;

use Auth;
use App\Models\SuggestProduct;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DateTime;
use DB;

class SuggestProductRepository extends BaseRepository implements SuggestProductInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SuggestProduct $suggestProduct)
    {
        $this->model = $suggestProduct;
    }

    /**
    * function create.
     *
     * @return true or false
     */
    public function create($input)
    {
        DB::beginTransaction();
        try {
            $result = parent::create($input);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return false;
        }
    }

    /**
    * function updateSuggestProduct.
     *
     * @return true or false
     */
    public function updateSuggestProduct($input, $file, $id)
    {
        DB::beginTransaction();
        try {
            $suggestProduct = $this->model->find($id);

            if (!isset($file)) {
                $tnput['images'] = isset($request->file) ? parent::uploadImages($suggestProduct->images, $file, config('settings.images.product')) : $suggestProduct->images;
            }

            $result = parent::update($input, $id);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return false;
        }
    }

    /**
    * function create.
     *
     * @return true or false
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $result = parent::delete($id);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function findSuggestProduct.
     *
     * @return true or false
     */
    public function findSuggestProduct($suggestId)
    {
        return $this->model->find($suggestId);
    }

    /**
    * function accept.
     *
     * @return true or false
     */
    public function changeAccept($suggestId, $status)
    {
        DB::beginTransaction();
        try {
            $input = [
                'is_accept' => $status,
            ];

            $result = parent::update($input, $suggestId);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
        return $this->model->update($suggestId);
    }

    /**
    * function getSuggestProduct.
     *
     * @return true or false
     */
    public function getSuggestProduct()
    {
        return $this->model->with('user')->orderBy('is_accept', 'asc')->paginate(config('setting.admin.paginate'));
    }

    /**
    * function getSuggestProduct.
     *
     * @return true or false
     */
    public function getSuggestProductUsers()
    {
        return $this->model->where('user_id', Auth::user()->id)->orderBy('is_accept', 'asc')->paginate(config('setting.admin.paginate'));
    }

    /**
    * function searchProduct($input)
     *
     * @return true or false
     */
    public function searchProduct($input)
    {
        try {
            $products = $this->model;

            if ($input['status'] != config('setting.search_default')) {
                $products = $products->where('is_accept', $input['status']);
            }

            if (!empty($input['price_from'])) {
                $products = $products->where('price', '>=', $input['price_from']);
            }

            if (!empty($input['price_to'])) {
                $products = $products->where('price', '<=', $input['price_to']);
            }

            if (!empty($input['name'])) {
                $products = $products->where('product_name', 'LIKE', '%' . $input['name']);
            }

            if ($input['sort_product'] == config('setting.product.hot')) {
                $products = $products->with(['orderDetail' => function ($query) {
                    $query->sum('product_id');
                }]);
            }

            if ($input['sort_product'] == config('setting.product.new')) {
                $products = $products->orderBy('created_at', 'asc');
            }

            if ($input['sort_price'] == config('setting.sort_price.asc')) {
                $products = $products->orderBy('price', 'asc');
            }

            if ($input['sort_price'] == config('setting.sort_price.desc')) {
                $products = $products->orderBy('price', 'desc');
            }

            return $products->orderBy('is_accept', 'asc')->paginate(12);
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }
}
