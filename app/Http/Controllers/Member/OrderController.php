<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Order\OrderInterface;
use App\Repositories\OrderDetail\OrderDetailInterface;
use App\Mail\SendOrder;
use Session;
use DB;
use Auth;
use Mail;

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
        if (Auth::check()) {
            $orders = $this->orderRepository->getOrderUsers();
        }

        return view('member.cart.cart_detail', compact('orders'));
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
        try {
            $yourCarts = Session::get('yourCart');
            $this->productIdCats = array_pluck($yourCarts, 'productId');
            $products = $this->productRepository->listProduct($this->productIdCats);

            foreach ($yourCarts as $yourCarts) {
                foreach ($products as $product) {
                    if ($yourCarts['productId'] == $product->id) {
                        $product->total_price = $product->price * $yourCarts['number'];
                        $product->number_order = $yourCarts['number'];
                    }
                }
            }

            $orders = [
                'user_id' => Auth::user()->id,
                'total_price' => $products->sum('total_price'),
                'number' => $products->sum('number_order'),
            ];

            $orderDetails = [];

            foreach ($products as $product) {
                $orderDetails[] = [
                    'product_id' => $product->id,
                    'number' => $product->number_order,
                    'total_price' => $product->total_price,
                ];
            }

            $order = $this->orderRepository->createOrderMultiple($orders, $orderDetails);

            if ($order) {
                $data = [
                    'order' => $order,
                ];

                Mail::to(Auth::user()->email)->queue(new SendOrder($data));
                Session::forget('yourCart');
                $request->session()->flash('success', trans('order.msg.order-success'));
            } else {
                $request->session()->flash('fail', trans('order.msg.order-fail'));
            }
        } catch (\Exception $e) {
            $request->session()->flash('fail', trans('order.msg.order-fail'));
        }

        return redirect()->action('Member\OrderController@index');
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
     * add Cart
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function addCart(Request $request)
    {
        if ($request->ajax()) {
            try {
                $yourCart = $request->only('productId', 'number');

                if (Session::has('yourCart')) {
                    $yourCarts = Session::get('yourCart');
                    $productIds = array_pluck($yourCarts, 'productId');

                    if (!in_array($yourCart['productId'], $productIds)) {
                        $yourCarts[] = $yourCart;
                        Session::put('yourCart', $yourCarts);
                    }
                } else {
                    Session::push('yourCart', $yourCart);
                }

                $html = view('member.cart.your_cart')->render();

                return response()->json(['result' => true, 'html' => $html]);
            } catch (\Exception $e) {
                return response()->json('result', false);
            }
        }
    }

    /**
     * add Cart
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function removeCart(Request $request)
    {
        if ($request->ajax()) {
            try {
                $yourCarts = $yourCartNews = Session::get('yourCart');

                foreach ($yourCarts as $key => $value) {
                    if ($value['productId'] == $request->productId) {
                        $yourCartNews = array_except($yourCartNews, $key);
                    }
                }

                Session::put('yourCart', $yourCartNews);
                if (count($yourCartNews) == 0) {
                    Session::forget('yourCart');
                }

                $html = view('member.cart.your_cart')->render();

                return response()->json(['result' => true, 'html' => $html, 'totalNumber' => count($yourCartNews)]);
            } catch (\Exception $e) {
                return response()->json('result', false);
            }
        }
    }
}
