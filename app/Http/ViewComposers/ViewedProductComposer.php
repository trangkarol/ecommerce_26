<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Product\ProductInterface;
use Session;

class ViewedProductComposer
{
    protected $viewedProducts = [];

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct(ProductInterface $productRepository)
    {
        if (Session::has('viewedProducts')) {
            $viewedProducts = Session::get('viewedProducts');

            $productIds = array_pluck($viewedProducts, 'productId');
            $this->viewedProducts = $productRepository->listProduct($productIds);
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
        $view->with('viewedProducts', $this->viewedProducts);
    }
}
