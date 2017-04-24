<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Product\ProductInterface;
use Session;

class CartComposer
{
    protected $productCats = [];
    protected $productIdCats = [];

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct(ProductInterface $productRepository)
    {
        if (Session::has('yourCart')) {
            $yourCarts = Session::get('yourCart');

            $this->productIdCats = array_pluck($yourCarts, 'productId');
            ;
            $products = $productRepository->listProduct($this->productIdCats);
            foreach ($yourCarts as $yourCart) {
                foreach ($products as $product) {
                    if ($yourCart['productId'] == $product->id) {
                        $product->total_price = $product->price * $yourCart['number'];
                        $product->number_order = $yourCart['number'];
                    }
                }
            }

            $this->productCats = $products;
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('productCats', $this->productCats);
        $view->with('productIdCats', $this->productIdCats);
    }
}
