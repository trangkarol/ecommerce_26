<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Category\CategoryInterface;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\InsertProductRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ReportController as Report;
use App\Helpers\Library;
use DB;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $madeIn;
    protected $library;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductInterface $productRepository,
        CategoryInterface $categoryRepository,
        Library $library
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->madeIn = Library::getMadeIn();
        $this->library = $library;
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
        $sortPrice = $this->library->getSortPrice();
        $sortProduct = $this->library->getSortProduct();
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $products = $this->productRepository->getProduct();

        return view('admin.product.index', compact('products', 'ratings', 'sortPrice', 'parentCategory', 'sortProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function create()
    {
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));

        return view('admin.product.create')->with(['parentCategory' => $parentCategory, 'subCategory' => $subCategory, 'madeIn' => $this->madeIn]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $ressult = $this->productRepository->createProduct($request);
            if (!$ressult) {
                $request->session()->flash('fail', trans('product.msg.insert-fail'));
                DB::rollback();

                return redirect()->back();
            }

            DB::commit();
            $request->session()->flash('success', trans('product.msg.insert-success'));

            return redirect()->action('Admin\ProductController@index');
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('fail', trans('product.msg.insert-fail'));

            return redirect()->back();
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
        $product = $this->productRepository->findProduct($id);
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));

        return view('admin.product.edit')->with(['product' => $product, 'parentCategory' => $parentCategory, 'madeIn' => $this->madeIn]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $result = $this->productRepository->update($request, $id);

            if (!$result) {
                $request->session()->flash('fail', trans('product.msg.update-fail'));

                return redirect()->action('Admin\ProductController@edit', $id);
            }

            $request->session()->flash('success', trans('product.msg.update-success'));

            return redirect()->action('Admin\ProductController@edit', $id);
        } catch (\Exception $e) {
            $request->session()->flash('fail', trans('product.msg.update-fail'));

            return redirect()->back();
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
     * Get sub category
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function getSubCategory(Request $request)
    {
        $parent_id = $request->parent_id;
        $sub_id = $request->sub_id;
        try {
            $subCategory = $this->categoryRepository->getSubCategory($parent_id);
            $html = view('admin.product.sub_category', compact('subCategory', 'sub_id'))->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json('result', false);
        }
    }

    /**
     * importFile
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function importFile(Request $request)
    {
        $file = $request->file;
        try {
            $nameFile = '';
            if (isset($file)) {
                $nameFile = $this->productRepository->importFile($file);
                $products = Report::importFileExcel($nameFile);
            }

            return view('admin.product.import_product', compact('products', 'nameFile'));
        } catch (Exception $e) {
            return redirect()->action('Admin\ProductController@index');
        }
    }

    /**
     * importFile
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function saveFile(Request $request)
    {
        DB::beginTransaction();
        try {
            $products = Report::importFileExcel($request->nameFile)->toArray();
            foreach ($products as $product) {
                $inputs = $this->dataProduct($product);
                $inputs['category_id'] = $this->categoryRepository->getCategoryId($product['category_name'], $product['subcategory_name']);

                if (!$this->validator($inputs)->validate()) {
                    $this->productRepository->create($inputs);
                }
            }
            $request->session()->flash('success', trans('product.msg.import-success'));
            DB::commit();

            return redirect()->action('Admin\ProductController@index');
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('fail', trans('product.msg.import-fail'));
            DB::rollback();

            return redirect()->action('Admin\ProductController@index');
        }
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
            $input['subCategory_id'] = -1;

            if (isset($request->subCategory_id)) {
                $input['subCategory_id'] = $request->subCategory_id;
            }

            $products = $this->productRepository->searchProduct($input);
            $html = view('admin.product.table_result', compact('products'))->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (Exception $e) {
            return response()->json('result', false);
        }
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
        $data['name'] = $product['name'];
        $data['image'] = config('setting.images.product');
        $data['price']= $product['price'];
        $data['number_current']= $product['number'];
        $data['made_in'] = $product['made_in'];
        $data['date_manufacture'] = $product['date_manufacture'];
        $data['date_expiration'] = $product['date_expiration'];
        $data['description'] = $product['description'];

        return $data;
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:50|min:4|unique:products',
            'date_manufacture' => 'required',
            'date_expiration' => 'required|after:date_manufacture',
            'description' => 'required',
            'price' => 'required',
            'number_current' => 'required',
        ]);
    }
}
