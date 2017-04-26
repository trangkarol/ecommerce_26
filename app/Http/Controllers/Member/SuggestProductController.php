<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Helpers\Library;
use App\Http\Controllers\Controller;
use App\Repositories\SuggestProduct\SuggestProductRepository;
use App\Http\Requests\Product\SuggestProductRequest;
use App\Repositories\Category\CategoryInterface;
use Auth;

class SuggestProductController extends Controller
{
    protected $suggestProductRepository;
    protected $categoryRepository;
    protected $madeIn;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        SuggestProductRepository $suggestProductRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->suggestProductRepository = $suggestProductRepository;
        $this->categoryRepository = $categoryRepository;
        $this->madeIn = Library::getMadeIn();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productSuggests = $this->suggestProductRepository->getSuggestProductUsers();

        return view('member.product_suggest.index', compact('productSuggests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));

        return view('member.product_suggest.create')->with(['parentCategory' => $parentCategory, 'madeIn' => $this->madeIn]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuggestProductRequest $request)
    {
        $input = $request->only(['product_name', 'made_in', 'number_current', 'description', 'price', 'category_id', 'category_name', 'sub_category_id', 'sub_category_name', 'date_manufacture', 'date_expiration']);
        $input['images'] = isset($request->file) ? $this->suggestProductRepository->uploadImages(null, $request->file, null) : config('settings.images.product');
        $input['is_accept'] = config('setting.accept_default');
        $input['user_id'] = Auth::user()->id;
        $result = $this->suggestProductRepository->create($input);

        if ($result) {
            $request->session()->flash('success', trans('product.msg.insert-success'));

            return redirect()->action('Member\SuggestProductController@show', $result->id);
        }

        $request->session()->flash('fail', trans('product.msg.insert-fail'));

        return redirect()->action('Member\SuggestProductController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $productSuggest = $this->suggestProductRepository->find($id, '*');

        return view('member.product_suggest.detail')->with(['parentCategory' => $parentCategory, 'madeIn' => $this->madeIn, 'productSuggest' => $productSuggest]);
    }

    /**
     * @return \Illuminate\Http\Response
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $productSuggest = $this->suggestProductRepository->find($id);

        return view('member.product_suggest.edit')->with(['parentCategory' => $parentCategory, 'madeIn' => $this->madeIn, 'productSuggest' => $productSuggest]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuggestProductRequest $request, $id)
    {
        $input = $request->only(['product_name', 'made_in', 'number_current', 'description', 'price', 'category_id', 'category_name', 'sub_category_id', 'sub_category_name']);
        $input['is_accept'] = config('setting.accept_default');
        $input['user_id'] = Auth::user()->id;
        $result = $this->suggestProductRepository->updateSuggestProduct($input, $request->file, $id);

        if ($result) {
            $request->session()->flash('success', trans('product.msg.update-success'));

            return redirect()->action('Member\SuggestProductController@index');
        }

        $request->session()->flash('fail', trans('product.msg.update-fail'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $result = $this->suggestProductRepository->delete($id);

        if ($result) {
            $request->session()->flash('success', trans('product.msg.delete-success'));

            return redirect()->action('Member\SuggestProductController@index');
        }

        $request->session()->flash('fail', trans('product.msg.delete-fail'));

        return redirect()->action('Member\SuggestProductController@index');
    }

    /**
     * Get sub category
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function getCategory(Request $request)
    {
        $parent_id = $request->parent_id;
        $sub_id = $request->sub_id;
        try {
            $subCategory = $this->categoryRepository->getSubCategory($parent_id);
            $html = view('member.product_suggest.sub_category', compact('subCategory', 'sub_id'))->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json('result', true);
        }
    }
}
