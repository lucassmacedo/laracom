<?php

namespace App\Shop\ProductComments\Repositories;

use App\Shop\Base\BaseRepository;
use App\Shop\ProductComments\Exceptions\ProductCommentNotFoundException;
use App\Shop\ProductComments\ProductComment;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductCommentRepository extends BaseRepository implements ProductCommentRepositoryInterface
{
    /**
     * ProductCommentRepository constructor.
     * @param ProductComment $productComment
     */
    public function __construct(ProductComment $productComment)
    {
        parent::__construct($productComment);
        $this->model = $productComment;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ProductCommentNotFoundException
     */
    public function findProductCommentById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductCommentNotFoundException($e);
        }
    }
}
