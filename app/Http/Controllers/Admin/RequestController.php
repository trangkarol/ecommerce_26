<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\SuggestProduct\SuggestProductRepository;
use App\Repositories\Product\ProductInterface;
use App\Helpers\Library;

class RequestController extends Controller
{
    protected $suggestProductRepository;
    protected $categoryRepository;
    protected $library;
    protected $productRepository;
    protected $madeIn;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductInterface $productRepository,
        SuggestProductRepository $suggestProductRepository,
        CategoryInterface $categoryRepository,
        Library $library
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->suggestProductRepository = $suggestProductRepository;
        $this->library = $library;
        $this->madeIn = Library::getMadeIn();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = $this->library->getRatings();
        $sortPrice = $this->library->getSortPrice();
        $sortProduct = $this->library->getSortProduct();
        $status = $this->library->statusSuggestProduct();
        $requestProducts = $this->suggestProductRepository->getSuggestProduct();

        return view('admin.request.index', compact('requestProducts', 'ratings', 'sortPrice', 'sortProduct', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suggestId = $request->suggestId;
        try {
            $productSuggest = $this->suggestProductRepository->findSuggestProduct($suggestId);

            if ($productSuggest->category_id == 0) {
                $category = [
                    'sub_category_name' => $productSuggest->sub_category_name,
                    'category_name' => $productSuggest->category_name,
                ];

                $resultCategory = $this->categoryRepository->createName($category);

                if ($resultCategory) {
                    $productSuggest->sub_category_id = $resultCategory->id;
                }
            }

            $product = $this->dataProduct($productSuggest);
            $this->suggestProductRepository->changeAccept($suggestId, config('setting.accept'));
            $requestProduct = $this->productRepository->saveRequestProduct($product);

            if ($requestProduct) {
                $request->session()->flash('success', trans('product.msg.insert-success'));

                return redirect()->action('Admin\ProductController@edit', $requestProduct->id);
            }
        } catch (\Exception $e) {
            $request->session()->flash('fail', trans('product.msg.insert-fail'));

            return redirect()->action('Admin\RequestController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $productSuggest = $this->suggestProductRepository->find($id);

        return view('admin.request.edit')->with(['parentCategory' => $parentCategory, 'madeIn' => $this->madeIn, 'productSuggest' => $productSuggest]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $result = $this->suggestProductRepository->changeAccept($id, config('setting.cancel'));
            $request->session()->flash('success', trans('product.msg.cancel-success'));

            return redirect()->action('Admin\RequestController@index');
        } catch (\Exception $e) {
            $request->session()->flash('fail', trans('product.msg.cancel-fail'));

            return redirect()->action('Admin\RequestController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *data Product.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function dataProduct($product)
    {
        $data = [];
        $data['name'] = $product['product_name'];
        $data['image'] = $product['images'];
        $data['price']= $product['price'];
        $data['number_current']= $product['number_current'];
        $data['made_in'] = $product['made_in'];
        $data['date_manufacture'] = $product['date_manufacture'];
        $data['date_expiration'] = $product['date_expiration'];
        $data['description'] = $product['description'];
        $data['category_id'] = $product['sub_category_id'];
        return $data;
    }

    /**
     * search.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $input = $request->all();
            $requestProducts = $this->suggestProductRepository->searchProduct($input);
            $html = view('admin.request.table_result', compact('requestProducts'))->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (Exception $e) {
            return response()->json('result', false);
        }
    }
}
