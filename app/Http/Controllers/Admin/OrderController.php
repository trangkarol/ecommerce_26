<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Order\OrderInterface;
use App\Repositories\OrderDetail\OrderDetailInterface;
use App\Helpers\Library;
use App\Mail\SendOrder;
use Session;
use DB;

class OrderController extends Controller
{
    protected $productRepository;
    protected $orderRepository;
    protected $orderDetailRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductInterface $productRepository,
        OrderDetailInterface $orderDetailRepository,
        OrderInterface $orderRepository
    ) {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->getOrders();
        $status = Library::getStatus();

        return view('admin.order.index', compact('orders', 'status'));
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
     * search.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $input = $request->only(['date_from', 'date_to', 'price_from', 'price_to', 'status']);
            $orders = $this->orderRepository->searchOrder($input);
            $html = view('admin.order.table_result', compact('orders'))->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (Exception $e) {
            return response()->json('result', false);
        }
    }

    /**
     * changeStatus.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        try {
            $status = $this->orderRepository->changeStatus($request->orderId, $request->status);

            return response()->json(['result' => true, 'status' => $status]);
        } catch (Exception $e) {
            return response()->json('result', false);
        }
    }
}
