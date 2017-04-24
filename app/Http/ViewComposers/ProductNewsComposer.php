<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Category\CategoryInterface;

class ProductNewsComposer
{
    protected $new_products = [];

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct(ProductInterface $productRepository)
    {
        // $this->new_products = $productRepository->newProduct();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('new_products', $this->new_products);
    }
}
