<?php

namespace App\Repositories\Product;

use Auth;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DateTime;

class ProductRepository extends BaseRepository implements ProductInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
    * function getProduct.
     *
     * @return imageName
     */
    public function getProduct()
    {
        return $this->model->with('category')->paginate(config('setting.admin.page'));
    }

    /**
    * function create.
     *
     * @return true or false
     */
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $input = $request->only(['name', 'made_in', 'number_current', 'description', 'price']);
            $input['date_manufacture'] = date_create($request->date_manufacture);
            $input['date_expiration'] = date_create($request->date_expiration);
            $input['category_id'] = $request->subCategory;
            $input['image'] = isset($request->file) ? parent::uploadImages(null, $request->file, null) : config('settings.images.product');
            $result = parent::create($input);
            DB::commit();

            return true;
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
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $product = parent::find($id, 'image');
            $input = $request->only(['name', 'made_in', 'number_current', 'description']);
            $input['date_manufacture'] = date_create($request->date_manufacture);
            $input['date_expiration'] = date_create($request->date_expiration);
            $input['category_id'] = $request->subCategory;
            $input['image'] = isset($request->file) ? parent::uploadImages($product->image, $request->file, config('settings.images.product')) : $product->image;

            parent::update($input, $id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function findProduct.
     *
     * @return true or false
     */
    public function findProduct($productId)
    {
        return $this->model->with('category')->where('id', $productId)->first();
    }

    /**
    * function  hotProduct.
     *
     * @return true or false
     */
    public function hotProduct()
    {
        return $this->model->join('order_details', 'products.id', 'order_details.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.image',
                'products.price',
                'products.avg_rating',
                \DB::raw('SUM(order_details.product_id) as numberProduct')
            )
            ->groupBy('products.id', 'products.name', 'products.image', 'products.price', 'products.avg_rating')
            ->orderBy('numberProduct', 'desc')->take(config('setting.user.take'))->get();
    }

    /**
    * function  new Product.
     *
     * @return true or false
     */
    public function newProduct()
    {
        return $this->model->select('products.id', 'products.name', 'products.image', 'products.price', 'products.avg_rating')
            ->where(\DB::raw('DATEDIFF(NOW(), created_at)'), '>=', config('setting.user.number_date_create'))
            ->orderBy('created_at', 'desc')->take(config('setting.user.take'))->get();
    }
}
