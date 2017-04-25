<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Category\CategoryInterface;
use App\Http\Controllers\Controller;
use App\Helpers\Library;
use Session;

class ProductController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $library;


    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoryInterface $categoryRepository,
        ProductInterface $productRepository,
        Library $library
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->library = $library;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getProduct();
        $ratings = $this->library->getRatings();
        $sortPrice = $this->library->getSortPrice();
        $sortProduct = $this->library->getSortProduct();
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));

        return view('member.product.products', compact('products', 'ratings', 'sortPrice', 'sortProduct', 'parentCategory'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findProduct($id);
        $relatedProducts = $this->productRepository->relatedProduct($product->category_id, $product->id);

        //handel viewed products
        $viewedProduct = [
            'productId' => $id,
            'dateView' => date("Y-m-d H:i:s"),
        ];

        if (Session::has('viewedProducts')) {
            $viewedProducts = Session::get('viewedProducts');
            $productIds = array_pluck($viewedProducts, 'productId');

            if (in_array($id, $productIds)) {
                $viewedProducts = array_except($viewedProducts, $id);
            }

            $viewedProducts[] = $viewedProduct;
            Session::put('viewedProducts', $viewedProducts);
        } else {
            Session::push('viewedProducts', $viewedProduct);
        }

        return view('member.product.product_detail', compact('product', 'relatedProducts'));
    }

    /**
     * getProductCategory .
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function getProductCategory($categoryId)
    {
        $products = $this->productRepository->getProductCategory($categoryId);
        $ratings = $this->library->getRatings();
        $sortPrice = $this->library->getSortPrice();
        $sortProduct = $this->library->getSortProduct();
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));

        return view('member.product.products', compact('products', 'ratings', 'sortPrice', 'sortProduct', 'parentCategory'));
    }

    /**
     * search product .
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function searchProduct(Request $request)
    {
        if ($request->ajax()) {
            try {
                $input = $request->only(['name', 'sort_price', 'price_from', 'price_to', 'rating', 'parentCategory_id', 'sort_product']);
                $input['subCategory_id'] = -1;

                if (isset($request->subCategory_id)) {
                    $input['subCategory_id'] = $request->subCategory_id;
                }

                $products = $this->productRepository->searchProduct($input);
                dd($products->toArray());
                $html = view('member.product.result_product', compact('products'))->render();

                return response()->json(['result' => true,  'html' => $html]);
            } catch (\Exception $e) {
                return response()->json('result', true);
            }
        }
    }
}
