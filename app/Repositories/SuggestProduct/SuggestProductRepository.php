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
        return $this->model->with('user')->paginate(config('setting.admin.paginate'));
    }

    /**
    * function getSuggestProduct.
     *
     * @return true or false
     */
    public function getSuggestProductUsers()
    {
        return $this->model->where('user_id', Auth::user()->id)->paginate(config('setting.admin.paginate'));
    }
}
