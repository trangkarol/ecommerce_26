<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Category\CategoryInterface;
use App\Http\Controllers\Controller;
use Session;

class HomeController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoryInterface $categoryRepository,
        ProductInterface $productRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_hots = $this->productRepository->hotProduct();
        $product_news = $this->productRepository->newProduct();
        $categories = $this->categoryRepository->getProductHome();

        return view('member.home.home', compact('categories', 'product_hots', 'product_news'));
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
        //
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
        //
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
        //
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
     * getFormLogin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFormLogin()
    {
        try {
            $html = view('member.user.login')->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json('result', true);
        }
    }
}
