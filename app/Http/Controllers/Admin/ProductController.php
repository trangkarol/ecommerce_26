<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Category\CategoryInterface;
use App\Http\Requests\Product\ProductRequest;
use App\Helpers\Library;
use DB;

class ProductController extends Controller
{
    protected $productRepository;
    protected $cateRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductInterface $productRepository,
        CategoryInterface $cateRepository
    ) {
        $this->productRepository = $productRepository;
        $this->cateRepository = $cateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getProduct();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function create()
    {
        $parentCategory = $this->cateRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $madeIn = Library::getMadeIn();

        return view('admin.product.create', compact('parentCategory', 'subCategory', 'madeIn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $ressult = $this->productRepository->create($request);
        if (!$ressult) {
            $request->session()->flash('fail', trans('product.msg.insert-fail'));

            return redirect()->back();
        }

        $request->session()->flash('success', trans('product.msg.insert-success'));

        return redirect()->action('Admin\ProductController@index');
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
        $parentCategory = $this->cateRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $madeIn = Library::getMadeIn();

        return view('admin.product.edit', compact('product', 'parentCategory', 'madeIn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $ressult = $this->productRepository->update($request, $id);
        if (!$ressult) {
            $request->session()->flash('fail', trans('product.msg.update-fail'));

            return redirect()->action(['Admin\ProductController@edit', $id]);
        }

        $request->session()->flash('success', trans('product.msg.update-success'));

        return redirect()->action(['Admin\ProductController@edit', $id]);
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
            $subCategory = $this->cateRepository->getSubCategory($parent_id);
            $html = view('admin.product.sub_category', compact('subCategory', 'sub_id'))->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json('result', flase);
        }
    }
}
