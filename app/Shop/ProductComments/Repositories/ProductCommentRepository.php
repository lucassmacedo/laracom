<?php

namespace App\Shop\ProductComments\Repositories;

use App\Shop\Base\BaseRepository;
use App\Shop\ProductAttributes\Exceptions\ProductAttributeNotFoundException;
use App\Shop\ProductAttributes\ProductAttribute;
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
     * @throws ProductAttributeNotFoundException
     */
    public function findProductAttributeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductAttributeNotFoundException($e);
        }
    }
}
