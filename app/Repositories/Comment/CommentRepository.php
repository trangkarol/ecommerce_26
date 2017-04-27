<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;

class CommentRepository extends BaseRepository implements CommentInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    /**
    * function getCategoryLibrary.
     *
     * @return imageName
     */
    public function getComment($productId)
    {
        return $this->model->with('product', 'user', 'sub')->where('product_id', $productId)->orderBy('created_at', 'desc')->get();
    }
}
