<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Comment\CommentInterface;
use App\Repositories\Product\ProductInterface;
use Auth;

class CommentController extends Controller
{
    protected $productRepository;
    protected $commentRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductInterface $productRepository,
        CommentInterface $commentRepository
    ) {
        $this->productRepository = $productRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * get comment box.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCommentBox(Request $request)
    {
        try {
            $parentId = $request->parentId;
            $subCategory = true;
            $html = view('member.comment.comment_box', compact('subCategory', 'parentId'))->render();

            return response()->json(['result'=> true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json('result', false);
        }
    }

    /**
     * post comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postComment(Request $request)
    {
        try {
            $input = $request->all();
            $input['user_id'] = Auth::user()->id;
            $comment = $this->commentRepository->create($input);
            if ($comment) {
                $product = $this->productRepository->getDetailProduct($comment->product_id);
                $html = view('member.comment.comment', compact('product'))->render();
            }

            return response()->json(['result'=> true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json('result', false);
        }
    }
}
