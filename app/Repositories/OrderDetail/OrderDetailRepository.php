<?php

namespace App\Repositories\OrderDetail;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;

class OrderDetailRepository extends BaseRepository implements OrderDetailInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderDetail $orderDetail)
    {
        $this->model = $orderDetail;
    }

    /**
    * function createMmultiple.
     *
     * @return true or false
     */
    public function createMmultiple($orderDetails, $orderId)
    {
        try {
            return $this->model->find($orderId)->attach($orderDetails);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
    * function statisticProduct().
     *
     * @return true or false
     */
    public function statisticProduct()
    {
        try {
            $product = $this->model->join('products', 'products.id', 'order_details.product_id')
                ->join('orders', 'orders.id', 'order_details.order_id')
                ->join('categories', 'products.category_id', 'categories.id')
                ->select(
                    'products.name',
                    \DB::raw('SUM(order_details.number) as numberProduct'),
                    \DB::raw('SUM(order_details.total_price) as toatalPrice'),
                    'products.made_in',
                    'categories.name as categoryName'
                    );
            if ($category) {
                $product = $product->where('categories.parent_id', $category);
            }

             $product = $product->groupBy('order_details.product_id','products.name', 'products.made_in', 'categories.name')
                ->orderBy('numberProduct', 'toatalPrice', 'desc')
                ->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
    * function statistic category.
     *
     * @return true or false
     */
    public function statistiCategory()
    {
        try {
            return $this->model->join('products', 'products.id', 'order_details.product_id')
                ->join('orders', 'orders.id', 'order_details.order_id')
                ->join('categories', 'products.category_id', 'categories.id')
                ->join('categories as parenCategory', 'parenCategory.parent_id', 'categories.id')
                ->select(
                    \DB::raw('SUM(order_details.number) as numberProduct'),
                    \DB::raw('SUM(order_details.total_price) as totalPrice'),
                    'parenCategory.id',
                    'parenCategory.name as parentNameCategory'
                )
                ->groupBy('parenCategory.id', 'parenCategory.name')
                ->orderBy('numberProduct', 'totalPrice', 'desc')
                ->get();
        } catch (\Exception $e) {
            return false;
        }
    }
}
